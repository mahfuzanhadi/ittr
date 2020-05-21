<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('transaksi') ?>"><i class="fas fa-arrow-left"></i> Back</a>

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
            <form action="" method="post" enctype="multipart/form-data" id="upload_form">
                <input type="hidden" name="total_biaya_tindakan" value="0">
                <input type="hidden" name="total_biaya_obat" value="0">
                <input type="hidden" name="total_biaya_keseluruhan" value="0">
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_rekam_medis">No. Rekam Medis <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="no_rekam_medis" placeholder="No. Rekam Medis " value="<?= set_value('no_rekam_medis'); ?>" />
                        <small class="form-text text-danger"><?= form_error('no_rekam_medis'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="dokter">Dokter <font color="red">*</font></label>
                        <select class="form-control form-control-sm" name="dokter">
                            <option value="">Choose one</option>
                            <?php
                            foreach ($dokter as $row) {
                                echo '<option value="' . $row->id_dokter . '" ' . set_select('dokter', $row->id_dokter) . '> ' . $row->nama . ' </option>';
                            } ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('dokter'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="perawat">Perawat <font color="red">*</font></label>
                        <select class="form-control form-control-sm" name="perawat">
                            <option value="">Choose one</option>
                            <?php
                            foreach ($perawat as $row) {
                                echo '<option value="' . $row->id_perawat . '" ' . set_select('perawat', $row->id_perawat) . '> ' . $row->nama . ' </option>';
                            } ?>
                            } ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('perawat'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Tanggal</label>
                        <input class="form-control form-control-sm" type="text" name="tanggal" id="picker" placeholder="Tanggal" value="<?= date('Y-m-d'); ?>" readonly="readonly" /> <small>(tahun-bulan-hari)</small>
                        <small class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label>Diagnosa <font color="red">*</font></label>
                        <textarea class="form-control form-control-sm" type="text" name="diagnosa" placeholder="Diagnosa"><?= set_value('diagnosa'); ?></textarea>
                        <small class="form-text text-danger"><?= form_error('diagnosa'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Keterangan</label>
                        <textarea class="form-control form-control-sm" type="text" name="keterangan" placeholder="Keterangan"><?= set_value('keterangan'); ?></textarea>
                        <small class="form-text text-danger"><?= form_error('keterangan'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <label>Jam Mulai <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="time" name="jam_mulai" placeholder="jam_mulai" readonly="readonly" value="<?= date('H:i'); ?>" />
                        <small class="form-text text-danger"><?= form_error('jam_mulai'); ?></small>
                    </div>
                    <!-- <div class="form-group col-sm-3">
                        <label>Jam Selesai <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="time" name="jam_selesai" placeholder="jam_selesai" value="<?= date('H:i'); ?>" />
                        <small class="form-text text-danger"><?= form_error('jam_selesai'); ?></small>
                    </div> -->
                    <div class="form-group col-sm-3">
                        <label for="metode_pembayaran">Metode Pembayaran</label>
                        <select class="form-control  form-control-sm required" id="metode_pembayaran" name="metode_pembayaran">
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                            <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                            <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                            <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                        </select>
                        <!-- <small class="form-text text-danger"><?= form_error('metode_pembayaran'); ?></small> -->
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="foto_rontgen">Foto Rontgen</label>
                        <input class="form-control-file" type="file" name="foto_rontgen" id="foto_rontgen" />
                        <small class="form-text text-danger"><?= form_error('foto_rontgen'); ?></small>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="tambah">Next</button>
            </form>
        </div>
        <!-- <div class="form-group col-sm-3">
            <input class="form-control form-control-sm" type="text" name="tanggal" id="timepicker" value="<?= date('H:i:s'); ?>" />
        </div> -->
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
    $("#timepicker").datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'H:i'
    });
</script>