<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MarketController extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MarketModel');
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    function index()
    {
        //need to check if logged in
        if($this->session->userdata('logged_in'))
        {
            print_r($_SESSION);
            redirect('MarketController/home');
        }
        else
            $this->load->view('index.php');
    }

    function home()
    {
        if ($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            
            if ($this->session->userdata('user') == 'admin')
            {
                //print_r($session_data);
                $data['firstName'] = $session_data['FirstName'];
            }
            else
            {
                $data['username'] = $session_data['username'];
                $data['firstName'] = $session_data['ContactFirstName'];
            }

            $this->load->view('index', $data);
        }
        else
            $this->load->view('login_view');
    }

    function login()
    {
        $this->load->view('login_view');
    }

    function verify_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
    
        if ($this->form_validation->run() == false)
            $this->load->view('login_view');

        else
        {
            $data = $this->MarketModel->getUserByEmail($this->input->post('username'));
            redirect('MarketController/home', $data);
        }
    }

    function register()
    {
        $this->load->view('register');
    }

    function verify_register()
    {
        $this->form_validation->set_rules('customerName', 'Customer Name', 'trim|required');
        $this->form_validation->set_rules('contactFirstName', 'Contact First Name', 'trim|required');
        $this->form_validation->set_rules('contactLastName', 'Contact Last Name', 'trim|required');
        $this->form_validation->set_rules('addressLine1', 'Address Line 1', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('username', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

        $data = array(
			'customerName' => $this->input->post('customerName'),
			'contactLastName' => $this->input->post('contactLastName'),
			'contactFirstName' => $this->input->post('contactFirstName'),
			'phone' => $this->input->post('phone'),
			'addressLine1' => $this->input->post('addressLine1'),
			'addressLine2' => $this->input->post('addressLine2'),
			'city' => $this->input->post('city'),
			'postalCode' => $this->input->post('postalCode'),
			'country' => $this->input->post('country'),
			'email' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);

        if ($this->form_validation->run() == false)
            $this->load->view('register');

        else
            $this->add_member($data);

    }

    function check_database($password)
    {
        $username = $this->input->post('username');

        $result = $this->MarketModel->login($username, $password);
        
        if($result && $this->session->userdata('user') == 'admin')
        {
            $sess_array = array();
            foreach ($result as $row)
            {
                $sess_array = array('FirstName' => $row->firstName,
                                    'LastName' => $row->lastName,
                                    'email' => $row->email,
                                    'id' => $row->adminID);
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        }

        else if($result) 
        {
            $sess_array = array();
            foreach ($result as $row)
            {
                $sess_array = array('ContactFirstName' => $row->contactFirstName,
                                    'ContactLastName' => $row->contactLastName,
                                    'username' => $row->email,
                                    'id' => $row->customerNumber);
                $this->session->set_userdata('logged_in', $sess_array);
            }
            return true;
        }

        else
        {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    function add_member($data)
    {
        $result = $this->MarketModel->add_member($data);

        if($result)
            $this->load->view('login_view');

        else
            $this->load->view('register');
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('admin');
        $this->session->sess_destroy();
        $this->load->view('index');
    }

    function viewAllProducts()
    {
        $data['product_info'] = $this->MarketModel->get_all_products();
        $this->load->view('viewAllProducts', $data);
    }

    function viewProduct($id)
    {
        $data["item_data"] = $this->MarketModel->drilldown($id);
        $this->load->view('productDrilldown', $data);
    }

    function viewMyAccount()
    {
        $data['user_data'] = $this->MarketModel->getUserByCustomerNumber($_SESSION['logged_in']['id']);
        $this->load->view('myAccount', $data);
    }

    function addToCart($itemID)
    {
        $quantity = $_POST['total'];

        $data['allproducts'] = $this->MarketModel->get_all_products();
        //print_r($data['allproducts']);

        $existsInDB = false;
        $existsInCart = false;
        $existsInPosition;
        $description;

        foreach ($data['allproducts'] as $index => $obj)
        {
            //print($obj->{'produceCode'});
            if ($obj->{'produceCode'} == $itemID) //check that item exists in db
            {
                //print("Item found in database: ".$itemID." == ".$obj->{'produceCode'});
                $existsInDB = true;
                $description = $obj->{'description'};
            }
        }
        
        if ($this->session->userdata('cart') != NULL)
        {
            foreach($this->session->userdata('cart') as $index => $item)
            {
                //check if item is already in the cart so there are no duplicates
                if ($item['productID'] == $itemID)
                {
                    $existsInCart = true;
                    $existsInPosition = $index;
                }
            }
        }

        if (!$existsInCart)
        {
            $_SESSION['cart'][] = array('productID' => $itemID, 'description' => $description,'quantity' => $quantity);
            redirect('MarketController/viewCart');
        }
        else
        {
            $_SESSION['cart'][$existsInPosition]['quantity'] = $_SESSION['cart'][$existsInPosition]['quantity'] + $quantity;
            redirect('MarketController/viewCart');
        }

    }

    function viewCart()
    {
        $this->load->view('cart');
    }

    function editCart($prodID)
    {
        foreach($this->session->userdata('cart') as $index => $item)
        {
            if ($item['productID'] == $prodID)
            {
                $data['arrayPos'] = $index;
            }
        }

        $data['cart_item'] = $this->MarketModel->drilldown($prodID);

        $this->load->view('editCartView', $data);
    }

    function updateCart($prodID)
    {
        $newQuantity = $_POST['cartQuantity'];
        $arrayPos; 

        foreach($this->session->userdata('cart') as $index => $item)
        {
            if ($item['productID'] == $prodID)
            {
                $arrayPos = $index;
            }
        }

        if($newQuantity == 0)
        {
            //remove from cart completely
            unset($_SESSION['cart'][$arrayPos]);
            redirect('MarketController/viewCart');
        }
        else
        {
            $_SESSION['cart'][$arrayPos]['quantity'] = $newQuantity;
            redirect('MarketController/viewCart');        
        }
        

    }

    function viewOrders()
    {
        $data["all_orders"] = $this->MarketModel->get_all_orders();
        $this->load->view('viewAllOrders', $data);
    }

    function viewMyOrders($custID)
    {
        $data["my_orders"] = $this->MarketModel->getOrderByCustID($custID);
        $this->load->view('viewMyOrders', $data);
    }

    function searchProducts()
    {
        $input = $_POST['search'];
        if (!empty(($input)))
        {
            $data['search_results'] = $this->MarketModel->searchProducts($input);
            $this->load->view('viewSearchResults', $data);
        }

        else
            redirect('MarketController/viewAllProducts');
    }

    function viewOrderDetailsByID($id)
    {
        $data['order_details'] = $this->MarketModel->viewOrderDetailsByID($id);
        $this->load->view('orderDrilldown', $data);
    }

    function editOrderByID($id)
    {
        $data['order_details'] = $this->MarketModel->viewOrderDetailsByID($id);
        $this->load->view('editOrderView', $data);
    }

    function editOrderComment($id)
    {
        $data['order_info'] = $this->MarketModel->viewOrderByID($id);
        $this->load->view('editCommentView', $data);
    }

    function updateComment($orderNum)
    {
        $newComment = $_POST['newComment'];

        if (!empty($newComment))
        {
            if ($this->MarketModel->updateComment($newComment, $orderNum))
            {
                redirect('MarketController/viewOrders');
            }
            
            else
            {
                $data['message'] = "Uh oh, problem with update";
            }
        }
    }

    function addToWishlist($custID, $productID)
    {
        $data['my_wishlist'] = $this->MarketModel->viewMyWishlist($custID);
        $exists = false;

        foreach ($data['my_wishlist'] as $index => $object)
        {
            print_r($exists);
            if ($object->{'produceCode'} == $productID)
            {
                $exists = true;
                $data['message']="Item already exists on your wishlist";
            }
        }

        if($exists == false)
        {
            if ($this->MarketModel->addToWishlist($custID, $productID)) {
                $data['my_wishlist'] = $this->MarketModel->viewMyWishlist($custID); //need updated data
                $this->load->view('viewWishlist', $data);
            }
            else {
                $data['message']="Uh oh ... problem on insert";
            }
        }
        else
        {
            $this->load->view('viewWishlist', $data);
        }
    }

    function viewMyWishlist($custID)
    {
        $data['my_wishlist'] = $this->MarketModel->viewMyWishlist($custID);
        $this->load->view('viewWishlist', $data);
    }

    function addProduct()
    {
        $this->load->view('addProduct');
    }

    function verify_add_product()
    {
        $this->form_validation->set_rules('add_produceCode', 'Produce Code', 'trim|required');
        $this->form_validation->set_rules('add_description', 'Description', 'trim|required');
        $this->form_validation->set_rules('add_category', 'Category', 'trim|required');
        $this->form_validation->set_rules('add_supplier', 'Supplier', 'trim|required');
        $this->form_validation->set_rules('add_quantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('add_bbprice', 'Bulk Buy Price', 'trim|required');
        $this->form_validation->set_rules('add_bsprice', 'Bulk Sale Price', 'trim|required');

        $data = array(
			'produceCode' => $this->input->post('add_produceCode'),
			'description' => $this->input->post('add_description'),
			'category' => $this->input->post('add_category'),
			'supplier' => $this->input->post('add_supplier'),
			'quantityInStock' => $this->input->post('add_quantity'),
			'bulkBuyPrice' => $this->input->post('add_bbprice'),
			'bulkSalePrice' => $this->input->post('add_bsprice'),
			'photo' => $_FILES['add_photo']['name']
		);

        if ($this->form_validation->run() == false)
            $this->load->view('addProduct');

        else
            $this->add_product($data);
    }

    function add_product($arr)
    {
        $result = $this->MarketModel->add_product($arr);

        if($result)
            redirect('MarketController/viewAllProducts');

        else
            $this->load->view('index');
    }

    function editProduct($prodID)
    {
        $data['product_info'] = $this->MarketModel->drilldown($prodID);
        $this->load->view('editProductView', $data);
    }

    function updateProduct($prodID)
    {
        $newQuantity = $_POST['newQuantity'];

        if (!empty($newQuantity))
        {
            if ($this->MarketModel->updateProductQuantity($newQuantity, $prodID))
            {
                redirect('MarketController/viewAllProducts');
            }
            
            else
            {
                $data['message'] = "Uh oh, problem with update";
            }
        }
    }


}//end class

?>
