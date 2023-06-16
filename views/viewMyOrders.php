<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<div class="container">
    <div class="row">
    <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list text-center">
                        <thead>
                            <tr>
                                <th class="hidden-xs">Order Number</th>
                                <th>Order Date</th>
                                <th>Required Date</th>
                                <th>Shipped Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($my_orders as $row) { ?>
                            <tr>
                                <td class="hidden-xs"> <?php echo $row->orderNumber ?></td>
                                <td><?php echo $row->orderDate?></td>
                                <td><?php echo $row->requiredDate?></td>
                                <td><?php echo $row->shippedDate?></td>
                                <td><?php echo $row->status?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
</div>

<?php $this->load->view('footer'); ?>