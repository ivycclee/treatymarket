<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<div>
    <fieldset class="text-center">
        <legend>Edit Order Details</legend>
        <hr>
		
		<?php echo validation_errors();
	
		echo form_open('MarketController/editOrderByID/'.$_SESSION['logged_in']['id']); 
		
        foreach ($order_details as $row)
        {
            echo "<div>";
            echo "Product Code: ";
            echo form_input('productCode', $row->productCode, 'readonly');
                
            echo "<br><br>";

            echo "Description: ";
            echo form_input('description', $row->description, 'readonly');
                
            echo "<br><br>";

            echo "Quantity: ";
            echo form_input('quantity', $row->quantityOrdered);
                
            echo "<br><br><hr></div>";

        } 
        echo form_submit("Edit", "Update Order"); ?>
    </fieldset>
</div>

<?php $this->load->view('footer');?>