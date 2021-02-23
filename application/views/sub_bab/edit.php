<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm">
                <div class="card-header">
                    <a href="<?= base_url('sub_bab'); ?>" class="btn btn-primary">Kembali</a>
                </div>
                <?= form_open('sub_bab/edit_subbab', ['class' => 'text-gray-900']); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="bab">Bab</label>
                                <input type="text" name="bab_id" id="bab" class="form-control" value="<?= $data['bab']; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nama_sub_bab">Sub Bab</label>
                                <input type="text" name="nama_sub_bab_id" id="nama_sub_bab" class="form-control" value="<?= $data['nama_sub_bab']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="isi_sub_bab">Isi Sub Bab</label>
                        <textarea name="isi_sub_bab" id="isi_sub_bab" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Simpan Data</button>
                </div>
                <?= form_close() ?>
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