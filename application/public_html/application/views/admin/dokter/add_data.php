<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('dokter') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <div class="card my-2">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form action="" method="post" id="form_dokter">
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="name">Nama <font color="red">*</font></label>
                        <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama" />
                        <span id="error_nama" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="alamat">Alamat <font color="red">*</font></label>
                        <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"></textarea>
                        <span id="error_alamat" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="tempat_lahir">Tempat Lahir <font color="red">*</font></label>
                        <input class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" />
                        <span id="error_tempat_lahir" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="tanggal_lahir">Tanggal Lahir <font color="red">*</font></label>
                        <input class="form-control" type="text" name="tanggal_lahir" id="picker" placeholder="Tanggal Lahir" value="<?= set_value('tanggal_lahir'); ?>" /> <small>(tahun-bulan-hari)</small><br />
                        <span id="error_picker" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="jenis_kelamin">Jenis Kelamin <font color="red">*</font></label>
                        <select class="custom-select custom-select-sm" id="jenis_kelamin" name="jenis_kelamin">
                            <option value="" hidden>Pilih Jenis Kelamin</option>
                            <option value="1" <?= set_select('jenis_kelamin', '1'); ?>>Laki-laki</option>
                            <option value="2" <?= set_select('jenis_kelamin', '2'); ?>>Perempuan</option>
                        </select>
                        <span id="error_jenis_kelamin" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="name">E-mail <font color="red">*</font></label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="E-mail" />
                        <span id="error_email" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_telp">No. Telp <font color="red">*</font></label>
                        <input class="form-control" type="text" name="no_telp" id="no_telp" placeholder="No. Telp" onkeypress="javascript:return isNumber(event)" />
                        <span id="error_no_telp" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_sip">No. SIP <font color="red">*</font></label>
                        <input class="form-control" type="text" name="no_sip" id="no_sip" placeholder="No. SIP" />
                        <span id="error_no_telp" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="tanggal_berlaku_sip">Tanggal Berlaku SIP <font color="red">*</font></label>
                        <input class="form-control" type="text" name="tanggal_berlaku_sip" id="datepicker" placeholder="Tanggal Berlaku SIP" /> <small>(tahun-bulan-hari)</small><br />
                        <span id="error_datepicker" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_str">No. STR <font color="red">*</font></label>
                        <input class="form-control" type="text" name="no_str" id="no_str" placeholder="No. STR" />
                        <span id="error_no_str" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="tanggal_berlaku_str">Tanggal Berlaku STR <font color="red">*</font></label>
                        <input class="form-control" type="text" name="tanggal_berlaku_str" id="datepicker2" placeholder="Tanggal Berlaku STR" /> <small>(tahun-bulan-hari)</small><br />
                        <span id="error_datepicker2" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Username" />
                        <span id="error_username" class="text-danger"></span>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
                        <span id="error_password" class="text-danger"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="status">Status <font color="red">*</font></label>
                        <select class="custom-select custom-select-sm" id="status" name="status">
                            <option value="" hidden>Pilih Status</option>
                            <option value="1" <?= set_select('status', '1'); ?>>Aktif</option>
                            <option value="0" <?= set_select('status', '0'); ?>>Tidak Aktif</option>
                        </select>
                        <span id="error_status" class="text-danger"></span>
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
    })
</script>

<script>
    jQuery.datetimepicker.setLocale('id')
    $('#datepicker').datetimepicker({
        timepicker: false,
        datepicker: true,
        format: 'Y-m-d', // formatDate
        mask: true,
        lang: 'id',
        il8n: {
            month: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            dayOfWeek: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        }
    })
</script>

<script>
    jQuery.datetimepicker.setLocale('id')
    $('#datepicker2').datetimepicker({
        timepicker: false,
        datepicker: true,
        format: 'Y-m-d', // formatDate
        mask: true,
        lang: 'id',
        il8n: {
            month: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            dayOfWeek: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
        }
    })
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
        $('#username').keyup(function() {
            var username = $('#username').val();
            if (username != '') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>dokter/isExist",
                    data: "username=" + username,
                    success: function(response) {
                        if (response != '') {
                            $('#error_username').text(response);
                            $('#username').addClass('has-error');
                            $('#tambah').attr('disabled', true);
                        } else {
                            error_username = response;
                            $('#error_username').text(error_username);
                            $('#username').removeClass('has-error');
                            $('#tambah').removeAttr('disabled');
                        }
                    }
                });
            } else {
                var error_username = '';
                $('#error_username').text(error_username);
                $('#username').removeClass('has-error');
                $('#tambah').removeAttr('disabled');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#tambah').click(function() {
            var error_nama = '';
            var error_alamat = '';
            var error_tempat_lahir = '';
            var error_picker = '';
            var error_datepicker = '';
            var error_datepicker2 = '';
            var error_jenis_kelamin = '';
            var error_no_telp = '';
            var error_email = '';
            var error_no_sip = '';
            var error_no_str = '';
            var error_username = '';
            var error_password = '';
            var error_status = '';
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var mobile_validation = /^\d{10,12}$/;
            var password_validation = /^.{6,}$/;

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

            if ($.trim($('#tempat_lahir').val()).length == 0) {
                error_tempat_lahir = 'Tempat Lahir wajib diisi';
                $('#error_tempat_lahir').text(error_tempat_lahir);
                $('#tempat_lahir').addClass('has-error');
            } else {
                error_tempat_lahir = '';
                $('#error_tempat_lahir').text(error_tempat_lahir);
                $('#tempat_lahir').removeClass('has-error');
            }

            if ($.trim($('#picker').val()).length == 0 || $.trim($('#picker').val()) == '____-__-__') {
                error_picker = 'Tanggal Lahir wajib diisi';
                $('#error_picker').text(error_picker);
                $('#picker').addClass('has-error');
            } else {
                error_picker = '';
                $('#error_picker').text(error_picker);
                $('#picker').removeClass('has-error');
            }

            if ($.trim($('#datepicker').val()).length == 0 || $.trim($('#datepicker').val()) == '____-__-__') {
                error_datepicker = 'Tanggal Berlaku SIP wajib diisi';
                $('#error_datepicker').text(error_datepicker);
                $('#datepicker').addClass('has-error');
            } else {
                error_datepicker = '';
                $('#error_datepicker').text(error_datepicker);
                $('#datepicker').removeClass('has-error');
            }

            if ($.trim($('#datepicker2').val()).length == 0 || $.trim($('#datepicker2').val()) == '____-__-__') {
                error_datepicker2 = 'Tanggal Berlaku STR wajib diisi';
                $('#error_datepicker2').text(error_datepicker2);
                $('#datepicker2').addClass('has-error');
            } else {
                error_datepicker2 = '';
                $('#error_datepicker2').text(error_datepicker2);
                $('#datepicker2').removeClass('has-error');
            }

            if ($.trim($('#no_sip').val()).length == 0) {
                error_no_sip = 'No. SIP wajib diisi';
                $('#error_no_sip').text(error_no_sip);
                $('#no_sip').addClass('has-error');
            } else {
                error_no_sip = '';
                $('#error_no_sip').text(error_no_sip);
                $('#no_sip').removeClass('has-error');
            }

            if ($.trim($('#no_str').val()).length == 0) {
                error_no_str = 'No. STR wajib diisi';
                $('#error_no_str').text(error_no_str);
                $('#no_str').addClass('has-error');
            } else {
                error_no_str = '';
                $('#error_no_str').text(error_no_str);
                $('#no_str').removeClass('has-error');
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
                error_no_telp = 'No. Telp wajib diisi';
                $('#error_no_telp').text(error_no_telp);
                $('#no_telp').addClass('has-error');
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
                error_email = 'Email wajib diisi';
                $('#error_email').text(error_email);
                $('#email').addClass('has-error');
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

            if ($.trim($('#status').val()).length == 0) {
                error_status = 'Status wajib diisi';
                $('#error_status').text(error_status);
                $('#status').addClass('has-error');
            } else {
                error_status = '';
                $('#error_status').text(error_status);
                $('#status').removeClass('has-error');
            }

            if (error_nama != '' || error_alamat != '' || error_picker != '' || error_datepicker != '' || error_datepicker2 != '' || error_jenis_kelamin != '' || error_no_telp != '' || error_no_sip != '' || error_no_str != '' || error_email != '' || error_password != '' || error_status != '') {
                return false;
            } else {
                $('#form_dokter').submit();
            }
        });
    });
</script>