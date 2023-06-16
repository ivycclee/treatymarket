<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>
<?php print_r($order_info); ?>
<?php foreach($order_info as $row) { ?>
<form class="container" method="post" action="<?php echo $base?>/MarketController/updateComment/<?php echo $order_info[0]->{'orderNumber'}?>">
    
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Order Number: </label><input class="form-control" type="text" placeholder="<?php echo $row->orderNumber ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Order Date: </label><input class="form-control" type="text" placeholder="<?php echo $row->orderDate ?>" readonly /></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Required Date:  </label><input class="form-control" type="text" placeholder="<?php echo $row->requiredDate ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Shipped Date:  </label><input class="form-control" type="text" placeholder="<?php echo $row->shippedDate ?>" readonly /></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Status:  </label><input class="form-control" type="text" placeholder="<?php echo $row->status ?>" readonly /></div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group mb-3"><label class="form-label">Comments:  </label><input class="form-control" type="text" placeholder="<?php echo $row->comments ?>" name="newComment" /></div>
            </div>
        </div>
        <div class="col-md-12 content-right">
            <button class="btn btn-primary form-btn" type="submit">SAVE </button>
            <button class="btn btn-danger form-btn" type="reset">CANCEL </button>
        </div>
</form>
<?php } ?>