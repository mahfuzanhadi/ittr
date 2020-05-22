<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('pasien') ?>"><i class="fas fa-arrow-left"></i> Back</a>
    <p></p>

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
                <input type="hidden" name="id" value="<?= $pasien['id_pasien']; ?>">
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_rekam_medis">Nomor Rekam Medis <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="no_rekam_medis" placeholder="Nomor Rekam Medis" value="<?= set_value('no_rekam_medis', $pasien['no_rekam_medis']) ?>" />
                        <small class="form-text text-danger"><?= form_error('no_rekam_medis'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="name">Nama <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="nama" placeholder="Nama Pasien" value="<?= $pasien['nama'] ?>" />
                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="alamat">Alamat <font color="red">*</font></label>
                        <input class="form-control form-control-sm" name="alamat" placeholder="Alamat" value="<?= $pasien['alamat'] ?>" />
                        <small class="form-text text-danger"><?= form_error('alamat'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="tanggal_lahir">Tanggal Lahir <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="tanggal_lahir" id="picker" placeholder="Tanggal Lahir" value="<?= $pasien['tanggal_lahir'] ?>" /> <small>(tahun-bulan-hari)</small>
                        <small class="form-text text-danger"><?= form_error('tanggal_lahir'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="pekerjaan">Pekerjaan <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="pekerjaan" placeholder="Pekerjaan" value="<?= $pasien['pekerjaan'] ?>" />
                        <small class="form-text text-danger"><?= form_error('pekerjaan'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="no_telp">No. Telp</label>
                        <input class="form-control form-control-sm" type="text" name="no_telp" placeholder="No. Telp" value="<?= $pasien['no_telp'] ?>" />
                        <small class="form-text text-danger"><?= form_error('no_telp'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="jenis_kelamin">Jenis Kelamin <font color="red">*</font></label>
                        <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin">
                            <?php if ($pasien['jenis_kelamin'] == 1) : ?>
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
                        <label for="name">E-mail</label>
                        <input class="form-control form-control-sm" type="text" name="email" placeholder="E-mail" value="<?= $pasien['email'] ?>" />
                        <small class="form-text text-danger"><?= form_error('email'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="riwayat_penyakit">Riwayat Penyakit</label>
                        <input class="form-control form-control-sm" type="text" name="riwayat_penyakit" placeholder="Riwayat Penyakit" value="<?= $pasien['riwayat_penyakit'] ?>" />
                        <small class="form-text text-danger"><?= form_error('riwayat_penyakit'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="alergi_obat">Alergi Obat</label>
                        <input class="form-control form-control-sm" type="text" name="alergi_obat" placeholder="Alergi Obat" value="<?= $pasien['alergi_obat'] ?>" />
                        <small class="form-text text-danger"><?= form_error('alergi_obat'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label>Username Pasien</label>
                        <input class="form-control form-control-sm" type="text" name="username" id="username" placeholder="Username" value="<?= $pasien['username'] ?>" />
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Password Pasien</label>
                        <input class="form-control form-control-sm" type="password" name="password" id="password" placeholder="Password" value="<?= $pasien['password'] ?>" />
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="tambah">Update</button>
            </form>

        </div>

        <div class="card-footer small text-muted">
            <font color="red">*</font> wajib diisi
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