<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('pasien') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (is_array($last)) {
        foreach ($last as $last) {
            // print $last;
        }
    } ?>
    <!-- <?php foreach ($last as $last) : ?>
    <?php endforeach; ?> -->
    <div class="card my-2">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form action="" method="post" id="form_pasien">
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_rekam_medis">Nomor Rekam Medis <font color="red">*</font></label>
                        <input class="form-control" type="text" name="no_rekam_medis" id="no_rekam_medis" placeholder="Nomor Rekam Medis" value="<?= set_value('no_rekam_medis', $last + 1) ?>" />
                        <span id="error_no_rm" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="name">Nama <font color="red">*</font></label>
                        <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama Pasien" />
                        <span id="error_nama" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="alamat">Alamat <font color="red">*</font></label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                        <span id="error_alamat" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="tanggal_lahir">Tanggal Lahir <font color="red">*</font></label>
                        <input class="form-control" type="text" name="tanggal_lahir" id="picker" placeholder="Tanggal Lahir" value="<?= set_value('tanggal_lahir'); ?>" /> <small>(tahun-bulan-hari)</small><br />
                        <span id="error_picker" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="pekerjaan">Pekerjaan <font color="red">*</font></label>
                        <input class="form-control" type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" />
                        <span id="error_pekerjaan" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="no_telp">No. Telp</label>
                        <input class="form-control" type="text" name="no_telp" id="no_telp" placeholder="No. Telp" onkeypress="javascript:return isNumber(event)" />
                        <span id="error_no_telp" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="jenis_kelamin">Jenis Kelamin <font color="red">*</font></label>
                        <select class="custom-select custom-select-sm" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="" hidden>Pilih Jenis Kelamin</option>
                            <option value="1" <?= set_select('jenis_kelamin', '1'); ?>>Laki-laki</option>
                            <option value="2" <?= set_select('jenis_kelamin', '2'); ?>>Perempuan</option>
                        </select>
                        <span id="error_jenis_kelamin" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="name">E-mail</label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="E-mail" />
                        <span id="error_email" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="riwayat_penyakit">Riwayat Penyakit</label>
                        <input class="form-control" type="text" name="riwayat_penyakit" id="riwayat_penyakit" placeholder="Riwayat Penyakit" />
                        <!-- <span id="error_riwayat_penyakit" class="text-danger"></span> -->
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="alergi_obat">Alergi Obat</label>
                        <input class="form-control" type="text" name="alergi_obat" id="alergi_obat" placeholder="Alergi Obat" />
                        <!-- <span id="error_alergi_obat" class="text-danger"></span> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label>Username Pasien</label>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username" />
                        <span id="error_username" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Password Pasien</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
                        <span id="error_password" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <input type="checkbox" class="form-checkbox" style="margin-top: 40px"> Show password
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

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script>
    jQuery.datetimepicker.setLocale('id')
    $('#picker').datetimepicker({
        timepicker: false,
        datepicker: true,
        format: 'Y-m-d', // formatDate
        mask: true,
        lang: 'id',
        il8n: {
            month: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            dayOfWeek: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        }
    });
</script>

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
    $(document).ready(function() {
        $('#no_rekam_medis').keyup(function() {
            var no_rekam_medis = $('#no_rekam_medis').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>pasien/isExist",
                data: "no_rekam_medis=" + no_rekam_medis,
                success: function(response) {
                    if (response != '') {
                        $('#error_no_rm').text(response);
                        $('#no_rekam_medis').addClass('has-error');
                        $('#tambah').attr('disabled', true);
                    } else {
                        error_no_rm = response;
                        $('#error_no_rm').text(error_no_rm);
                        $('#no_rekam_medis').removeClass('has-error');
                        $('#tambah').removeAttr('disabled');
                    }
                }
            });
        });
    });
</script>

<!-- SCRIPT SHOW/HIDE PASSWORD -->
<script>
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var error_no_rm = '';
            var error_nama = '';
            var error_alamat = '';
            var error_picker = '';
            var error_pekerjaan = '';
            var error_jenis_kelamin = '';
            var error_no_telp = '';
            var error_email = '';
            var error_username = '';
            var error_password = '';
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var mobile_validation = /^\d{10,12}$/;
            var password_validation = /^.{6,}$/;

            if ($.trim($('#no_rekam_medis').val()).length == 0) {
                error_no_rm = 'Nomor Rekam Medis wajib diisi';
                $('#error_no_rm').text(error_no_rm);
                $('#no_rekam_medis').addClass('has-error');
            } else {
                error_no_rm = '';
                $('#error_no_rm').text(error_no_rm);
                $('#no_rekam_medis').removeClass('has-error');
            }

            if ($.trim($('#nama').val()).length == 0) {
                error_nama = 'Nama wajib diisi';
                $('#error_nama').text(error_nama);
                $('#nama').addClass('has-error');
            } else {
                error_nama = '';
                $('#error_nama').text(error_nama);
                $('#nama').removeClass('has-error');
            }

            if ($.trim($('#alamat').val()).length == 0) {
                error_alamat = 'Alamat wajib diisi';
                $('#error_alamat').text(error_alamat);
                $('#alamat').addClass('has-error');
            } else {
                error_alamat = '';
                $('#error_alamat').text(error_alamat);
                $('#alamat').removeClass('has-error');
            }

            var tanggal = $.trim($('#picker').val());
            var dateMax = (new Date()).toISOString().split('T')[0];
            var dateMin = '1940-01-01';

            if ($.trim($('#picker').val()).length == 0 || $.trim($('#picker').val()) == '____-__-__') {
                error_picker = 'Tanggal Lahir wajib diisi';
                $('#error_picker').text(error_picker);
                $('#picker').addClass('has-error');
            } else if (tanggal.localeCompare(dateMax) == 1) {
                error_picker = 'Tanggal Lahir tidak valid';
                $('#error_picker').text(error_picker);
                $('#picker').addClass('has-error');
            } else if (tanggal.localeCompare(dateMin) == -1) {
                error_picker = 'Tanggal Lahir tidak valid';
                $('#error_picker').text(error_picker);
                $('#picker').addClass('has-error');
            } else {
                error_picker = '';
                $('#error_picker').text(error_picker);
                $('#picker').removeClass('has-error');
            }

            if ($.trim($('#pekerjaan').val()).length == 0) {
                error_pekerjaan = 'Pekerjaan wajib diisi';
                $('#error_pekerjaan').text(error_pekerjaan);
                $('#pekerjaan').addClass('has-error');
            } else {
                error_pekerjaan = '';
                $('#error_pekerjaan').text(error_pekerjaan);
                $('#pekerjaan').removeClass('has-error');
            }

            if ($.trim($('#jenis_kelamin').val()).length == 0) {
                error_jenis_kelamin = 'Jenis Kelamin wajib diisi';
                $('#error_jenis_kelamin').text(error_jenis_kelamin);
                $('#jenis_kelamin').addClass('has-error');
            } else {
                error_jenis_kelamin = '';
                $('#error_jenis_kelamin').text(error_jenis_kelamin);
                $('#jenis_kelamin').removeClass('has-error');
            }

            if ($.trim($('#no_telp').val()).length == 0) {
                error_no_telp = '';
                $('#error_no_telp').text(error_no_telp);
                $('#no_telp').removeClass('has-error');
            } else {
                if (!mobile_validation.test($('#no_telp').val())) {
                    error_no_telp = 'Mohon masukkan no telp yang valid';
                    $('#error_no_telp').text(error_no_telp);
                    $('#no_telp').addClass('has-error');
                } else {
                    error_no_telp = '';
                    $('#error_no_telp').text(error_no_telp);
                    $('#no_telp').removeClass('has-error');
                }
            }

            if ($.trim($('#email').val()).length == 0) {
                error_email = '';
                $('#error_email').text(error_email);
                $('#email').removeClass('has-error');
            } else {
                if (!filter.test($('#email').val())) {
                    error_email = 'Mohon masukkan email yang valid';
                    $('#error_email').text(error_email);
                    $('#email').addClass('has-error');
                } else {
                    error_email = '';
                    $('#error_email').text(error_email);
                    $('#email').removeClass('has-error');
                }
            }

            if ($.trim($('#password').val()).length == 0) {
                error_password = '';
                $('#error_password').text(error_password);
                $('#password').removeClass('has-error');
            } else {
                if (!password_validation.test($('#password').val())) {
                    error_password = 'Password harus berisi minimal 6 karakter';
                    $('#error_password').text(error_password);
                    $('#password').addClass('has-error');
                } else {
                    error_password = '';
                    $('#error_password').text(error_password);
                    $('#password').removeClass('has-error');
                }
            }

            if (error_no_rm != '' || error_nama != '' || error_alamat != '' || error_picker != '' || error_pekerjaan != '' || error_jenis_kelamin != '' || error_no_telp != '' || error_email != '' || error_password != '') {
                return false;
            } else {
                $('#form_pasien').submit();
            }
        });
    });
</script>