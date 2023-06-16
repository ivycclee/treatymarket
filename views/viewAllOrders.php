<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<div class="container">
    <div class="row">
        <p></p>
        <p> </p>
        <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list text-center">
                        <thead>
                            <tr>
                                <th class="hidden-xs">Order Number</th>
                                <th>Customer Number</th>
                                <th>Order Date</th>
                                <th>Required Date</th>
                                <th>Shipped Date</th>
                                <th>Status</th>
                                <th>Comments</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($all_orders as $row) { ?>
                            <tr>
                                <td class="hidden-xs"> <?php echo $row->orderNumber ?></td>
                                <td><?php echo $row->customerNumber ?></td>
                                <td><?php echo $row->orderDate?></td>
                                <td><?php echo $row->requiredDate?></td>
                                <td><?php echo $row->shippedDate?></td>
                                <td><?php echo $row->status?></td>
                                <td><?php echo $row->comments?></td>
                                <td><?php echo anchor('MarketController/viewOrderDetailsByID/'.$row->orderNumber, 'View'); ?></td>
                                <?php if($this->session->userdata('user') == 'member') { ?>
                                    <td><?php echo anchor('MarketController/editOrderByID/'.$row->orderNumber, 'Edit'); ?></td>
                                <?php } else if($this->session->userdata('user') == 'admin') { ?>
                                    <td><?php echo anchor('MarketController/editOrderComment/'.$row->orderNumber, 'Edit'); ?></td>
                                </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer'); ?>
