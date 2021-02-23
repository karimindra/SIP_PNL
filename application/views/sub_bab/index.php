<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- .row -->
    <div class="row mt-4">
        <!-- .col -->
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12">

            <!-- cek session -->
            <?php if ($this->session->flashdata('msg')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Data berhasil <strong><?= $this->session->flashdata('msg'); ?></strong>
                </div>
            <?php endif; ?>

            <!-- page heading - judul -->
            <h1 class="h3 my-3 text-gray-900"><?= $judul; ?></h1>

        </div>
    </div>

    <div class="row">
        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12">

            <div class="card shadow-sm">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped display nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <td>Bab</td>
                                    <th>Sub Bab</th>
                                    <th>Isi</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $num => $row) : ?>
                                    <tr>
                                        <td><?= $num + 1; ?></td>
                                        <td><?= $row['nama_bab']; ?></td>
                                        <td><?= $row['nama_sub_bab']; ?></td>
                                        <td><?= $row['isi_sub_bab'] ? $row['isi_sub_bab'] : '-'; ?></td>
                                        <td>
                                            <a href="<?= base_url('sub_bab/edit/') . $row['id']; ?>" class="btn btn-success">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>DIbuat Oleh &copy; Karimullah <?= date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->


</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>