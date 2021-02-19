<script src="<?php base_url('assets/ckeditor/ckeditor.js'); ?>"></script>

<!-- Load Library Chart.js -->
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

<div class="container-fluid">

    <?php if ($this->session->flashdata('message')) : ?>
        <!-- Modal Dialog berhasil login-->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Login</strong> berhasil, selamat datang <strong><?= $this->session->flashdata('message'); ?></strong>.
        </div>
    <?php endif; ?>
 </div>

<!-- text Area -->
        <div class="form-floating">
        <h3 align="center"> BAB 1 </h3>
        <h5 align="center"> PENDAHULUAN </h5>
            <textarea class="form-control" placeholder="TUlis Dengan RAPI YA BOSQUE" id="testing" style="height: 500px"></textarea>
            
        </div>

<script >
        CKEDITOR.replace('testing');
</script>

