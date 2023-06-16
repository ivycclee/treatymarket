<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
    <h1 class="text-center">Market Treaty Registration</h1>
    <div>
        <fieldset class="text-center">
            <legend>Registration!</legend>
		
			<?php echo validation_errors();
	
			echo form_open('MarketController/verify_register'); 
			
			echo "Customer Name: ";
			echo form_input('customerName');
			
			echo "<br><br>";

			echo "Contact First Name: ";
			echo form_input('contactFirstName');
			
			echo "<br><br>";

			echo "Contact Last Name: ";
			echo form_input('contactLastName');
			
			echo "<br><br>";

			echo "Phone: ";
			echo form_input('phone');
			
			echo "<br><br>";

			echo "Address Line 1: ";
			echo form_input('addressLine1');
			
			echo "<br><br>";

			echo "Address Line 2: ";
			echo form_input('addressLine2');
			
			echo "<br><br>";

			echo "City: ";
			echo form_input('city');
			
			echo "<br><br>";

			echo "Postal Code: ";
			echo form_input('postalCode');
			
			echo "<br><br>";

			echo "Country: ";
			echo form_input('country');
			
			echo "<br><br>";

			echo "Email: ";
			echo form_input('username');
			
			echo "<br><br>";
			
			echo "Password: ";
			echo form_password('password');
			
			echo "<br><br>";
			
			echo form_submit("Register", "Register!"); 
		?>
    	</fieldset>
    </div>
<?php
	$this->load->view('footer'); 
?>