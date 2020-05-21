<!-- <script>
    function myFunction1() {
        var x = document.getElementById("password1");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script> -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $perawat['id_perawat']; ?>">
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="name">Nama <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="nama" placeholder="Nama" value="<?= $perawat['nama'] ?>" />
                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="alamat">Alamat <font color="red">*</font></label>
                        <input class="form-control form-control-sm" name="alamat" placeholder="Alamat" value="<?= $perawat['alamat'] ?>" />
                        <small class="form-text text-danger"><?= form_error('alamat'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="tempat_lahir">Tempat Lahir <font color="red">*</font></label>
                        <input class="form-control form-control-sm" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $perawat['tempat_lahir'] ?>" />
                        <small class="form-text text-danger"><?= form_error('tempat_lahir'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="tanggal_lahir">Tanggal Lahir <font color="red">*</font></label>
                        <!-- <input class="form-control form-control-sm" type="date" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?= set_value('tanggal_lahir'); ?>" /> -->
                        <input class="form-control form-control-sm" type="text" name="tanggal_lahir" id="picker" placeholder="Tanggal Lahir" value="<?= $perawat['tanggal_lahir'] ?>" /> <small>(tahun-bulan-hari)</small>
                        <small class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="jenis_kelamin">Jenis Kelamin <font color="red">*</font></label>
                        <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin">
                            <?php if ($perawat['jenis_kelamin'] == 1) : ?>
                                <option value="1" selected>Laki-laki</option>
                                <option value="2">Perempuan</option>
                            <?php else : ?>
                                <option value="1">Laki-laki</option>
                                <option value="2" selected>Perempuan</option>
                            <?php endif; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('jenis_kelamin'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="email">E-mail <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="email" placeholder="E-mail" value="<?= $perawat['email'] ?>" />
                        <small class="form-text text-danger"><?= form_error('email'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_telp">No. Telp <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="no_telp" placeholder="No. Telp" value="<?= $perawat['no_telp'] ?>" />
                        <small class="form-text text-danger"><?= form_error('no_telp'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_str">No. STR</label>
                        <input class="form-control form-control-sm" type="text" name="no_str" placeholder="No. STR" value="<?= $perawat['no_str'] ?>" />
                        <small class="form-text text-danger"><?= form_error('no_str'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="tanggal_berlaku_str">Tanggal Berlaku STR</label>
                        <!-- <input class="form-control form-control-sm" type="date" name="tanggal_berlaku_str" placeholder="Tanggal berlaku_str" value="<?= set_value('tanggal_berlaku_str'); ?>" /> -->
                        <input class="form-control form-control-sm" type="text" name="tanggal_berlaku_str" id="datepicker2" placeholder="Tanggal Berlaku STR" value="<?= $perawat['tanggal_berlaku_str'] ?>" /> <small>(tahun-bulan-hari)</small>
                        <small class="form-text text-danger"><?= form_error('tanggal_berlaku_str'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label>Username</label>
                        <input class="form-control form-control-sm" type="text" name="username" id="username" placeholder="Username" value="<?= $perawat['username'] ?>" />
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Password</label>
                        <input class="form-control form-control-sm" type="password" name="password1" id="password1" placeholder="Password" />
                        <!-- <input type="checkbox" onclick="myFunction1()">Show Password
                        <small class="form-text text-danger"><?= form_error('password1'); ?></small> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label>Ulangi Password</label>
                        <input class="form-control form-control-sm" type="password" name="password2" id="password2" placeholder="Ulangi Password" />
                        <small class="form-text text-danger"><?= form_error('password2'); ?></small>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
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