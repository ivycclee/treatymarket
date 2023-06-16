<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<?php foreach($product_info as $row) { ?>
<form class="container" method="post" action="<?php echo $base?>/MarketController/updateProduct/<?php echo $row->produceCode ?>" >
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Category: </label><input class="form-control" type="text" placeholder="<?php echo $row->produceCode ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Description: </label><input class="form-control" type="text" placeholder="<?php echo $row->description ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Bulk Sale Price: </label><input class="form-control" type="text" placeholder="<?php echo $row->bulkSalePrice ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Bulk Buy Price: </label><input class="form-control" type="text" placeholder="<?php echo $row->bulkBuyPrice ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Quantity: </label><input class="form-control" type="text" placeholder="<?php echo $row->quantityInStock ?>" name="newQuantity" /></div>
            </div>
        </div>
        
        <div class="col-md-12 content-right">
            <button class="btn btn-primary form-btn" type="submit">SAVE </button>
            <button class="btn btn-danger form-btn" type="reset">CANCEL </button>
        </div>
</form>
<?php } ?>