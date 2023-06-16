<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
    <h1 class="text-center">Add Product</h1><br>
    <div>
        <fieldset class="text-center">
		
			<?php echo validation_errors();
	
			echo form_open_multipart('MarketController/verify_add_product'); 
			
			echo "Produce Code: ";
			echo form_input('add_produceCode');
			
			echo "<br><br>";

			echo "Description: ";
			echo form_input('add_description');
			
			echo "<br><br>";

			echo "Category: ";
			echo form_input('add_category');
			
			echo "<br><br>";

			echo "Supplier: ";
			echo form_input('add_supplier');
			
			echo "<br><br>";

			echo "Quantity In Stock: ";
			echo form_input('add_quantity');
			
			echo "<br><br>";

			echo "Bulk Buy Price: ";
			echo form_input('add_bbprice');
			
			echo "<br><br>";

			echo "Bulk Sale Price: ";
			echo form_input('add_bsprice');
			
			echo "<br><br>";

			echo "Photo: ";
			echo form_upload('add_photo');
			
			echo "<br><br>";
			
			echo form_submit("Add", "Add Product"); 
		?>
    	</fieldset>
    </div>
<?php
	$this->load->view('footer'); 
?>