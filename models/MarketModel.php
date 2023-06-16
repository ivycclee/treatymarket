<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MarketModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function login($username, $password) {
		$this->db -> select('*');
		$this->db -> from('customers');
		$this->db -> where('email', $username);
		$this->db -> where('password', MD5($password));
		$this->db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			$this->session->set_userdata('user', 'member');
			return $query->result();
		}
	   	
		else //search in admin if no customer found
		{
			$this->db -> select('*');
			$this->db -> from('admins');
			$this->db -> where('email', $username);
			$this->db -> where('password', MD5($password));
			$this->db -> limit(1);
			$query = $this -> db -> get();

			if($query -> num_rows() == 1) 
			{
				$this->session->set_userdata('user', 'admin');
				return $query->result();
			}

			return false;
		}
		return false;
	}

	function getUserByEmail($email)
	{
		if ($this->session->userdata('user') == 'admin')
		{
			$this->db -> select('*');
			$this->db -> from('admins');
			$this->db -> where('email', $email);
			$this->db -> limit(1);
			$query = $this -> db -> get();

			if($query -> num_rows() == 1) 
				return $query->result();
		}
		else
		{
			$this->db -> select('*');
			$this->db -> from('customers');
			$this->db -> where('email', $email);
			$this->db -> limit(1);
			$query = $this -> db -> get();
			if($query -> num_rows() == 1) 
				return $query->result();
		}
	}

	function getUserByCustomerNumber($custNo)
	{
		$this->db -> select('*');
		$this->db -> from('customers');
		$this->db -> where('customerNumber', $custNo);
		$this->db -> limit(1);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1) 
			return $query->result();
	   else
			return false;
	}

	function add_member($data)
	{
		$data = array(
			'customerName' => $data['customerName'],
			'contactLastName' => $data['contactLastName'],
			'contactFirstName' => $data['contactFirstName'],
			'phone' => $data['phone'],
			'addressLine1' => $data['addressLine1'],
			'addressLine2' => $data['addressLine2'],
			'city' => $data['city'],
			'postalCode' => $data['postalCode'],
			'country' => $data['country'],
			'email' => $data['email'],
			'password' => MD5($data['password'])
		);


		$this->db->insert('customers', $data);

		if ($this->db->insert_id() != NULL)
			return true;
		else
			return false;
	}

	function get_all_products()
	{
		$this->db->select("*");
		$this->db->from('products');

		$query = $this->db->get();
		return $query->result();
	}

	function drilldown($item)
	{
		$this->db->select("*");
		$this->db->from("products");
		$this->db->where('produceCode', $item);

		$query = $this->db->get();
		return $query->result();
	}
	
	function get_all_orders()
	{
		$this->db->select("*");
		$this->db->from("orders");

		$query = $this->db->get();
		return $query->result();
	}

	function getOrderByCustID($id)
	{
		$this->db->select("*");
		$this->db->from("orders");
		$this->db->where("customerNumber", $id);

		$query = $this->db->get();
		return $query->result();
	}

	function searchProducts($input)
	{
		$this->db->select("*");
		$this->db->from("products");
		$this->db->like("description", $input);

		$query = $this->db->get();
		return $query->result();
	}

	function viewOrderDetailsByID($id)
	{
		$this->db->select("orders.orderNumber, orderdetails.productCode, products.description, orderdetails.quantityOrdered");
		$this->db->from("orderdetails");
		$this->db->join("orders", "orders.orderNumber = orderdetails.orderNumber");
		$this->db->join("products", "products.produceCode = orderdetails.productCode");
		$this->db->where("orders.orderNumber", $id);

		$query = $this->db->get();
		return $query->result();
	}

	function viewOrderByID($id)
	{
		$this->db->select("*");
		$this->db->from("orders");
		$this->db->where("orderNumber", $id);

		$query = $this->db->get();
		return $query->result();
	}

	function updateComment($newComment, $orderNum)
	{
		$this->db->set('comments', $newComment);
		$this->db->where('orderNumber', $orderNum);
		return $this->db->update('orders');
	}

	function addToWishlist($custID, $productID)
	{
		$data = array("wishlistID" => "",
					"customerNumber" => $custID,
					"produceCode" => $productID);

		$this->db->insert('wishlist', $data);

		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}
	}

	function viewMyWishlist($id)
	{
		$this->db->select("wishlist.produceCode, products.description, products.category");
		$this->db->from("wishlist");
		$this->db->join("products", "wishlist.produceCode = products.produceCode");
		$this->db->where("wishlist.customerNumber", $id);

		$query = $this->db->get();
		return $query->result();
	}

	function add_product($data)
	{
		$this->db->insert('products', $data);

		if ($this->db->affected_rows() ==1) {
			return true;
		}
		else {
			return false;
		}
	}

	function updateProductQuantity($newQuantity, $prodID)
	{
		$this->db->set('quantityInStock', $newQuantity);
		$this->db->where('produceCode', $prodID);
		return $this->db->update('products');
	}

}
?>