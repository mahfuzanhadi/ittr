<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('ibahan') ?>"><i class="fas fa-arrow-left"></i> Back</a>

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
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $ibahan['id_inventaris_bahan']; ?>">
                <div class="form-row">
                    <div class="form-group col-sm-2">
                        <label for="nama">Nama <font color="red">*</font></label>
                        <select class="form-control form-control-sm" name="id_bahan" id="id_bahan">

                            <?php foreach ($bahan as $row) : ?>
                                <?php if ($row->id_bahan == $ibahan['id_bahan']) : ?>
                                    <option value="<?= $row->id_bahan; ?>" selected><?= $row->nama . ' --- ' . $row->satuan ?></option>
                                <?php else : ?>
                                    <option value="<?= $row->id_bahan; ?>"><?= $row->nama . ' --- ' . $row->satuan ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                    </div>
                    <div class="form-group col-sm-2">
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <label>Tanggal Masuk <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="tgl_masuk" id="picker" placeholder="Tanggal Masuk" value="<?= $ibahan['tgl_masuk'] ?>" /> <small>(tahun-bulan-hari)</small>
                        <small class="form-text text-danger"><?= form_error('tgl_masuk'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-2">
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <label>Expired <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="expired" id="datepicker" placeholder="Expired" value="<?= $ibahan['expired'] ?>" /> <small>(tahun-bulan-hari)</small>
                        <small class="form-text text-danger"><?= form_error('expired'); ?></small>
                    </div>
                    <div class="form-group col-sm-2">
                        <label for="jumlah_masuk">Jumlah Masuk <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="jumlah_masuk" placeholder="Jumlah Masuk " value="<?= $ibahan['jumlah_masuk'] ?>" />
                        <small class="form-text text-danger"><?= form_error('jumlah_masuk'); ?></small>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Update</button>
            </form>

        </div>

        <div class="card-footer small text-muted">
            * wajib diisi
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