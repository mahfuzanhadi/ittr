<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('bahan') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <p></p>
    <div class="card mb-3">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form action="<?= base_url('bahan/update'); ?>" method="post" id="form_bahan">
                <input type="hidden" name="id" value="<?= $bahan['id_bahan']; ?>">
                <div class="form-row">
                    <div class="form-group col-sm-2">
                        <label for="name">Nama <font color="red">*</font></label>
                        <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" value="<?= $bahan['nama'] ?>" />
                        <span id="error_nama" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="satuan">Satuan <font color="red">*</font></label>
                        <input class="form-control" type="text" name="satuan" id="satuan" placeholder="Satuan" value="<?= $bahan['satuan'] ?>" />
                        <span id="error_satuan" class="text-danger"></span>
                    </div>
                </div>
                <button class="btn btn-primary" type="button" name="update" id="update">Update</button>
            </form>

        </div>

        <div class="card-footer small text-muted">
            * wajib diisi
        </div>

    </div>
</div>
</div>
<!-- /.container-fluid -->

<script>
    $(document).ready(function() {
        $('#update').click(function() {
            var error_nama = '';
            var error_satuan = '';

            if ($.trim($('#nama').val()).length == 0) {
                error_nama = 'Nama wajib diisi';
                $('#error_nama').text(error_nama);
                $('#nama').addClass('has-error');
            } else {
                error_nama = '';
                $('#error_nama').text(error_nama);
                $('#nama').removeClass('has-error');
            }

            if ($.trim($('#satuan').val()).length == 0) {
                error_satuan = 'Satuan wajib diisi';
                $('#error_satuan').text(error_satuan);
                $('#satuan').addClass('has-error');
            } else {
                error_satuan = '';
                $('#error_satuan').text(error_satuan);
                $('#satuan').removeClass('has-error');
            }

            if (error_nama != '' || error_satuan != '') {
                return false;
            } else {
                $('#form_bahan').submit();
            }
        });
    });
</script>