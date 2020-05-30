<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('obat') ?>"><i class="fas fa-arrow-left"></i> Back</a>

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
            <form action="" method="post" id="form_obat">
                <div class="form-row">
                    <div class="form-group col-sm-2">
                        <label for="name">Nama <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="nama" id="nama" placeholder="Nama" />
                        <span id="error_nama" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="satuan">Satuan <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="satuan" id="satuan" placeholder="Satuan" />
                        <span id="error_satuan" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-2">
                        <label for="jenis">Jenis <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="jenis" id="jenis" placeholder="Jenis" />
                        <span id="error_jenis" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="ukuran">Ukuran <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="ukuran" id="ukuran" placeholder="Ukuran" />
                        <span id="error_ukuran" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-2">
                        <label for="harga">Harga <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="harga" id="harga" placeholder="Harga" onkeypress="javascript:return isNumber(event)" />
                        <span id="error_harga" class="text-danger"></span>
                    </div>
                </div>
                <button class="btn btn-primary" type="button" name="tambah" id="tambah">Save</button>
            </form>

        </div>

        <div class="card-footer small text-muted">
            <font color="red">*</font> wajib diisi
        </div>

    </div>
</div>
</div>
<!-- /.container-fluid -->

<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
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
    $('#harga').on('input', function() {

        var number, s_number, f_number;

        number = $('#harga').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        console.info(f_number);
        $('#harga').val(f_number);
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>
<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var error_nama = '';
            var error_satuan = '';
            var error_jenis = '';
            var error_ukuran = '';
            var error_harga = '';

            if ($.trim($('#nama').val()).length == 0) {
                error_nama = 'Nama obat wajib diisi';
                $('#error_nama').text(error_nama);
                $('#nama').addClass('has-error');
            } else {
                error_nama = '';
                $('#error_nama').text(error_nama);
                $('#nama').removeClass('has-error');
            }

            if ($.trim($('#satuan').val()).length == 0) {
                error_satuan = 'Satuan obat wajib diisi';
                $('#error_satuan').text(error_satuan);
                $('#satuan').addClass('has-error');
            } else {
                error_satuan = '';
                $('#error_satuan').text(error_satuan);
                $('#satuan').removeClass('has-error');
            }

            if ($.trim($('#jenis').val()).length == 0) {
                error_jenis = 'Jenis obat wajib diisi';
                $('#error_jenis').text(error_jenis);
                $('#jenis').addClass('has-error');
            } else {
                error_jenis = '';
                $('#error_jenis').text(error_jenis);
                $('#jenis').removeClass('has-error');
            }

            if ($.trim($('#ukuran').val()).length == 0) {
                error_ukuran = 'Ukuran obat wajib diisi';
                $('#error_ukuran').text(error_ukuran);
                $('#ukuran').addClass('has-error');
            } else {
                error_ukuran = '';
                $('#error_ukuran').text(error_ukuran);
                $('#ukuran').removeClass('has-error');
            }

            if ($.trim($('#harga').val()).length == 0) {
                error_harga = 'Harga obat wajib diisi';
                $('#error_harga').text(error_harga);
                $('#harga').addClass('has-error');
            } else {
                error_harga = '';
                $('#error_harga').text(error_harga);
                $('#harga').removeClass('has-error');
            }

            if (error_nama != '' || error_satuan != '' || error_jenis != '' || error_ukuran != '' || error_harga != '') {
                return false;
            } else {
                var harga = $('#harga').val();
                var hasil = parseFloat(harga.replace(/[^0-9-.]/g, ''));
                $('#harga').val(hasil);

                $('#form_obat').submit();
            }
        });
    });
</script>