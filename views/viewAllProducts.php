<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

    <div class="container text-center">
        <form method="post" action="<?php echo $base.'/MarketController/searchProducts'?>">
            <input class="search-input col-5" type="text" name="search" id="search" placeholder="Search..." />
            <button class="btn btn-light search-btn col-1" type="submit"><i class="fa fa-arrow-right"></i></button>
        </form>
    </div>

    <br><br>

    <div class="container">
    <div class="row align-items-center">

    <?php if($this->session->userdata('user') == 'admin') {?>
        <div>
            <a href="<?php echo $base.'/MarketController/addProduct'?>"><button class="btn btn-light col-2 offset-5" type="button">Add Product</button></a>
            <br><br><br>
        </div>
    <?php foreach ($product_info as $row) { ?>
        <div class="col-4">
            <div class="card text-center">
            <img class="card-img-top" src="<?php echo $img_base."products/full/".$row->photo; ?>">
                <div class="card-body">
                <h5 class="card-title"><?php echo $row->description; ?></h5>
                <p class="card-text">Supplier: <?php echo $row->supplier?></p>
                <p class="card-text">Category: <?php echo $row->category?></p>
                <p class="card-text">Price (ea): <?php echo $row->bulkSalePrice?></p>
                <p class="card-text">Buy Price (ea): <?php echo $row->bulkBuyPrice?></p>
                <p class="card-text">Quantity In Stock: <?php echo $row->quantityInStock?></p>
                <a href= "<?php echo $base."/MarketController/viewProduct/".$row->produceCode?>" class="btn btn-outline-info">View</a></p>
                <a href= "<?php echo $base."/MarketController/editProduct/".$row->produceCode?>" class="btn btn-outline-info">Edit</a></p>
                <a href= "<?php echo $base."/MarketController/deleteProduct/".$row->produceCode?>" class="btn btn-outline-info">Delete</a></p>

                <form name="form" method="post" action="<?php echo $base.'/MarketController/addToCart/'.$row->produceCode?>">
                
                </form>
    
                </div>
            </div>
        </div>
    <?php } } else if ($this->session->userdata('user') == 'member'){ ?>
        <?php foreach ($product_info as $row) { ?>
        <div class="col-4">
            <div class="card text-center">
            <img class="card-img-top" src="<?php echo $img_base."products/full/".$row->photo; ?>">
                <div class="card-body">
                <h5 class="card-title"><?php echo $row->description; ?></h5>
                <p class="card-text">Supplier: <?php echo $row->supplier?></p>
                <p class="card-text">Category: <?php echo $row->category?></p>
                <p class="card-text">Sale Price (ea): <?php echo $row->bulkSalePrice?></p>
                
                <a href= "<?php echo $base."/MarketController/viewProduct/".$row->produceCode?>" class="btn btn-outline-info">View</a></p>
                
                <form name="form" method="post" action="<?php echo $base.'/MarketController/addToCart/'.$row->produceCode?>">
                    <input type="text" id="total" name="total" placeholder="0" class="col-3 text-center" />
                    <button type="submit" class="btn btn-outline-info" value="Submit"> Add To Cart </button>
                </form>

                <form method="post" action="<?php echo $base.'/MarketController/addToWishlist/'.$_SESSION['logged_in']['id'].'/'.$row->produceCode?>">
                    <button type="submit" class="btn btn-outline-info" value="Submit"> Add To Wishlist </button>
                </form>
    
                </div>
            </div>
        </div>
    <?php } } else { ?>
        <?php foreach ($product_info as $row) { ?>
        <div class="col-4">
            <div class="card text-center">
            <img class="card-img-top" src="<?php echo $img_base."products/full/".$row->photo; ?>">
                <div class="card-body">
                <h5 class="card-title"><?php echo $row->description; ?></h5>
                <p class="card-text">Supplier: <?php echo $row->supplier?></p>
                <p class="card-text">Category: <?php echo $row->category?></p>
                <p class="card-text">Sale Price (ea): <?php echo $row->bulkSalePrice?></p>
                </div>
            </div>
        </div>
    <?php } } ?>

    
    
    

<?php $this->load->view('footer'); ?>

