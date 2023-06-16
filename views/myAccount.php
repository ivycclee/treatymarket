<?php
    $this->load->view('header');
    $this->load->helper('url');
    $base = base_url().index_page();
    $img_base = base_url()."assets/images/";
?>

<div id="profile" class="container profile profile-view">
    
    <form>
        <div class="row profile-row">
            <div class="col-md-4 relative">
                <div class="avatar">
                    <div class="avatar-bg center"></div>
                </div>
            </div>
            <div class="col-md-8">
                <h1>Profile </h1>
                <hr />

                <?php foreach ($user_data as $row) { ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group mb-3"><label class="form-label">Firstname </label><input class="form-control" type="text" placeholder="<?php echo $row->contactFirstName ?>" readonly /></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group mb-3"><label class="form-label">Lastname </label><input class="form-control" type="text" placeholder="<?php echo $row->contactLastName ?>" readonly /></div>
                    </div>
                    </div>
                        <div class="form-group mb-3"><label class="form-label">Email </label><input class="form-control" type="email" autocomplete="off" required name="email" placeholder="<?php echo $row->email ?>" readonly /></div>
                    </div>
                </div>
                <?php } ?>
                <hr />
            </div>
        </div>
    </form>
</div>

<?php $this->load->view('footer'); ?>