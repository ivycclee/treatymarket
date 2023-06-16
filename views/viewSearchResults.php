<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

    <a href="<?php echo $base.'/MarketController/viewAllProducts'?>"><button class="btn btn-light col-2 offset-5" type="button">Back To All Products</button></a>

    <br><br>

    <div class="container">
    <div class="row align-items-center">

    <?php if($this->session->userdata('user') == 'admin') {?>
    <?php foreach ($search_results as $row) { ?>
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
                
                <form name="form" method="post" action="<?php echo $base.'/MarketController/addToCart/'.$row->produceCode?>">
                
                </form>
    
                </div>
            </div>
        </div>
    <?php } } else if($this->session->userdata('user') == 'member') { ?>
        <?php foreach ($search_results as $row) { ?>
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
                <button type="submit" class="btn btn-outline-info" value="Submit"> Add to cart </button>
                </form>
    
                </div>
            </div>
        </div>
    <?php } } else { ?>
        <?php foreach ($search_results as $row) { ?>
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
    </div>
    </div>

<?php $this->load->view('footer'); ?>

