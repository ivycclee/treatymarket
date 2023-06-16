<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<?php foreach($cart_item as $row) { ?>
<form class="container" method="post" action="<?php echo $base?>/MarketController/updateCart/<?php echo $row->produceCode ?>" >
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">ProductID: </label><input class="form-control" type="text" placeholder="<?php echo $row->produceCode ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Description: </label><input class="form-control" type="text" placeholder="<?php echo $row->description ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Quantity: </label><input class="form-control" type="text" placeholder="<?php echo $_SESSION['cart'][$arrayPos]['quantity'] ?>" name="cartQuantity" /></div>
            </div>
        </div>
        
        <div class="col-md-12 content-right">
            <button class="btn btn-primary form-btn" type="submit">SAVE </button>
            <button class="btn btn-danger form-btn" type="reset">CANCEL </button>
        </div>
</form>
<?php } ?>