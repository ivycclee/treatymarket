<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<div class="main">
    <br><br><br><br>

    <?php if ($this->session->userdata('logged_in')) 
    { 
        if($this->session->userdata('user') == 'member') { ?>
            <h1>Welcome <?= $_SESSION['logged_in']['ContactFirstName'] ?>! </h1>
            <p>You have successfully logged in.</p>
            <a href=" <?= site_url('MarketController/logout') ?> ">Logout</a>

            <br><br><br><br>

    <?php }  else if($this->session->userdata('user') == 'admin')  { ?>
            <h1>Welcome <?= $_SESSION['logged_in']['FirstName'] ?>! </h1>
            <p>You have successfully logged in.</p>
            <a href=" <?= site_url('MarketController/logout') ?> ">Logout</a>

            <br><br><br><br>

    <?php } } else { ?>
        <h1>Welcome! </h1>
    <?php } ?>
    <br><br><br><br>
</div>

<?php 
    $this->load->view('footer');
?>