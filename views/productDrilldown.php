<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<div class="col-4 offset-md-4 fadeInDown text-center">
    <?php if($this->session->userdata('user') == 'admin') { 
        foreach ($item_data as $row) { ?>
        <ul class="list-group">
        <li class="list-group-item heading">
            <img src="<?php echo $img_base.'products/full/'.$row->photo?>" />
            <h1><?php echo $row->description ?></h1>
        </li>
        <li class="list-group-item">Category: <span><?php echo $row->category ?></span></li>
        <li class="list-group-item">Supplier: <span><?php echo $row->supplier ?></span></li>
        <li class="list-group-item">Sale Price (ea): €<span><?php echo $row->bulkSalePrice ?></span></li>
        <li class="list-group-item">Buy (ea): €<span><?php echo $row->bulkBuyPrice ?></span></li>
        <li class="list-group-item">Quantity In Stock: <span><?php echo $row->quantityInStock ?></span></li>       
    </ul>
    
    <?php } } else { ?>

    <?php foreach ($item_data as $row) { ?>

    <ul class="list-group">
        <li class="list-group-item heading">
            <img src="<?php echo $img_base.'products/full/'.$row->photo?>" />
            <h1><?php echo $row->description ?></h1>
        </li>
        <li class="list-group-item">Category: <span><?php echo $row->category ?></span></li>
        <li class="list-group-item">Supplier: <span><?php echo $row->supplier ?></span></li>
        <li class="list-group-item">Price (ea): €<span><?php echo $row->bulkSalePrice ?></span></li>
        
        <li class="list-group-item plan-action">
            <div>
                <input type="text" name="total" value="1" />
                
                <a class="btn btn-secondary" href="#">Add to Cart</a>
            </div>
        </li>
    </ul>

    <?php } }?>

    <br><br>
</div>