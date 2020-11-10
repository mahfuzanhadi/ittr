<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('tindakan') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <p></p>
    <div class="card my-2">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form action="" method="post" id="form_tindakan">
                <div class="form-row">
                    <div class="form-group col-sm-2">
                        <label for="name">Nama <font color="red">*</font></label>
                        <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" />
                        <span id="error_nama" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="biaya">Biaya <font color="red">*</font></label>
                        <input class="form-control" type="text" name="biaya" id="biaya" placeholder="Biaya" onkeypress="javascript:return isNumber(event)" />
                        <span id="error_biaya" class="text-danger"></span>
                    </div>
                </div>
                <button class="btn btn-primary active" aria-pressed="true" type="button" name="tambah" id="tambah">Save</button>
            </form>

        </div>

        <div class="card-footer small text-muted">
            <font color="red">*</font> wajib diisi
        </div>

    </div>
</div>
</div>
<!-- /.container-fluid -->

<script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }
</script>
<script>
    $('#biaya').on('input', function() {

        var number, s_number, f_number;

        number = $('#biaya').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        console.info(f_number);
        $('#biaya').val(f_number);
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>
<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var error_nama = '';
            var error_biaya = '';

            if ($.trim($('#nama').val()).length == 0) {
                error_nama = 'Nama tindakan wajib diisi';
                $('#error_nama').text(error_nama);
                $('#nama').addClass('has-error');
            } else {
                error_nama = '';
                $('#error_nama').text(error_nama);
                $('#nama').removeClass('has-error');
            }

            if ($.trim($('#biaya').val()).length == 0) {
                error_biaya = 'Biaya tindakan wajib diisi';
                $('#error_biaya').text(error_biaya);
                $('#biaya').addClass('has-error');
            } else {
                error_biaya = '';
                $('#error_biaya').text(error_biaya);
                $('#biaya').removeClass('has-error');
            }

            if (error_nama != '' || error_biaya != '') {
                return false;
            } else {
                var biaya = $('#biaya').val();
                var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
                $('#biaya').val(hasil);

                $('#form_tindakan').submit();
            }
        });
    });
</script>