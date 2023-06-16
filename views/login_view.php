<?php
	$this->load->view('header'); 
	$this->load->helper('url');
	$base = base_url() . index_page();
	$img_base = base_url()."assets/images/";
?>
    <h1 class="text-center">Market Treaty Login</h1>
    <div class="text-center">
        <fieldset>
            <legend>Please log in!</legend>
			<?php echo validation_errors();
		
				echo form_open('MarketController/verify_login'); 
				
				echo "Enter Username: ";
				echo form_input('username');
				
				echo "<br><br>";
				
				echo "Enter Password: ";
				echo form_password('password');
				
				echo "<br><br>";
				
				echo form_submit("Login", "Login!"); 
			?>
    	</fieldset>
	
		<p> Not a member? <a href="register"> Register! </a></p>
    </div>
<?php
	$this->load->view('footer'); 
?>