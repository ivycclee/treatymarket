<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<div class="container">
    <?php if (isset($_SESSION['cart'])) { ?>
        <div class="row">
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list text-center">
                        <thead>
                            <tr>
                                <th>ProductID</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($_SESSION['cart'] as $index => $item) { ?>
                            <tr>
                                <td> <?php echo $item['productID'] ?></td>
                                <td> <?php echo $item['description'] ?></td>
                                <td> <?php echo $item['quantity'] ?></td>
                                <td><?php echo anchor('MarketController/editCart/'.$item['productID'], 'Edit'); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <?php } else { ?>
            <h4 class="text-center">No items in cart</h4>
        <?php } ?>
</div>

<?php $this->load->view('footer'); ?>