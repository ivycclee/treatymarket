<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->helper('url');
    $cssbase = base_url()."assets/css/";
    $jsbase = base_url()."assets/js/";
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<!DOCTYPE>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <title>Treaty Market</title>
        <link href="<?php echo $cssbase."style.css"?>" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?php echo $cssbase."bootstrap.css"?>" rel="stylesheet">
        <link href="<?php echo $cssbase."bootstrap.min.css"?>" rel="stylesheet">
        <script src="<?php echo $jsbase."bootstrap.min.js"?>"></script>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-light bg-light navbar-expand-lg navigation-clean-button text-center">
            <div class="container">

                <div id="navcol-1" class="collapse navbar-collapse text-center">
                <a class="nav-link active" href="<?php echo $base ?>"><img class="img-thumbnail w-50 h-75" src="<?php echo $img_base."site/logo.png"?>" /></a>

                    <ul class="navbar-nav me-auto">

                        <?php if (!$this->session->userdata('logged_in')) { ?>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base."/MarketController/login" ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo $base."/MarketController/register" ?>"> Register</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base."/MarketController/viewAllProducts" ?>">View Products</a>
                        </li>
                    </ul>

                <span class="navbar-text actions"> </span>

                </div>
            
                
                <?php } ?>

                <?php if ($this->session->userdata('logged_in')) { ?>
                    
                    <div id="navcol-1" class="collapse navbar-collapse text-center">
                    <ul class="navbar-nav me-auto">

                    <?php if ($this->session->userdata('user') == 'admin') { ?>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base."/MarketController/viewAllProducts" ?>">View Products</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base."/MarketController/viewOrders" ?>">View Orders</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base."/MarketController/logout" ?>">Logout</a>
                        </li>
                    </ul>

                    <span class="navbar-text actions"> </span>

                    </div>
                    <?php } else { ?>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base.'/MarketController/viewAllProducts' ?>">View Products</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base.'/MarketController/viewCart' ?>">View Cart</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base.'/MarketController/viewMyOrders/'.$_SESSION['logged_in']['id'] ?>">View My Orders</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base.'/MarketController/viewMyWishlist/'.$_SESSION['logged_in']['id'] ?>">View My Wishlist</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base.'/MarketController/viewMyAccount/' ?>">My Account</a>
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link active" href="<?php echo $base.'/MarketController/logout' ?>">Logout</a>
                        </li>
                    </ul>

                <span class="navbar-text actions"> </span>

                </div>
                <?php } }?>


            </div> 
            </nav>
            <br><br>

            <script src="assets/bootstrap/js/bootstrap.min.js"> </script>
        </header>