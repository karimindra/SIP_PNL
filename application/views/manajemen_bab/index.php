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
                                    <th>Nama Bab</th>
                                    <th>Isi</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bab as $num => $row) : ?>
                                    <tr>
                                        <td><?= $num + 1; ?></td>
                                        <td><?= $row['nama_bab']; ?></td>
                                        <td><?= $row['isi_bab']; ?></td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#ubahBab" class="btn btn-success" id="btn-ubah" data-id="<?= $row['id']; ?>">Edit</button>
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

<!-- Modal Ubah Data -->
<div class="modal fade" id="ubahBab" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900">Ubah Data Bab</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('bab/edit_bab', ['id' => 'formUbahBab']); ?>
            <div class="modal-body">
                <input type="hidden" name="id" id="id_bab">
                <label for="nama_bab" class="col-sm-3 col-form-label">Nama Bab</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_bab" class="form-control" id="nama_bab">
                    <div class="invalid-feedback"></div>
                </div>
                <label for="isi_bab" class="col-sm-3 col-form-label">Isi Bab</label>
                <div class="col-sm-9">
                    <input type="text" name="isi_bab" class="form-control" id="isi_bab">
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

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

<script>
    $(document).ready(function() {

        $(document).on("click", "#btn-ubah", function() {

            var id = $(this).data('id')

            $.ajax({
                url: "<?= base_url('bab/ajax_edit') ?>",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data) {
                    $(".modal-body #id_bab").val(data.id)
                    $(".modal-body #nama_bab").val(data.nama_bab)
                    $(".modal-body #isi_bab").val(data.isi_bab)
                    $('#ubah-dokumen').modal('show')

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Internal Error');
                }
            });
        })

        $("#formUbahBab").submit(function(e) {
            e.preventDefault();

            var form = $("#formUbahBab");
            var formData = $(this).serialize();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                dataType: 'json',
                data: formData,
                success: function(data) {
                    if (data.status) {
                        $('#ubahBab').modal('toggle');
                        location.reload();
                    } else {

                        $.each(data.errors, function(key, value) {
                            $('[name="' + key + '"]').addClass('is-invalid');
                            $('[name="' + key + '"]').next().text(value);
                            if (value == "") {
                                $('[name="' + key + '"]').removeClass('is-invalid');
                                $('[name="' + key + '"]').addClass('is-valid');
                            }
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Internal Error');
                }
            });

            $('#formUbahBab input').on('keyup', function() {
                $(this).removeClass('is-valid is-invalid');
            });
        });

        $('.modal').on('show.bs.modal', function(e) {
            $("#formUbahBab")[0].reset()
            $(".is-valid").removeClass("is-valid");
            $(".is-invalid").removeClass("is-invalid");
            $(".invalid-feedback").empty();
        });
    })
</script>

</body>

</html>