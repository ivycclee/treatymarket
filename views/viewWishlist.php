<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";

    //print_r($my_wishlist);
?>

<div class="container">
    <div class="row">
    <div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-list text-center">
                        <thead>
                            <tr>
                                <th>ProductID</th>
                                <th>Description</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($my_wishlist as $row) { ?>
                            <tr>
                                <td> <?php echo $row->produceCode ?></td>
                                <td> <?php echo $row->description ?></td>
                                <td> <?php echo $row->category ?></td>
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