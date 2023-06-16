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
                                <th>Product Code</th>
                                <th>Description</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($order_details as $row) { ?>
                            <tr>
                                <td><?php echo $row->productCode ?></td>
                                <td><?php echo $row->description?></td>
                                <td><?php echo $row->quantityOrdered?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <br><br>
</div>