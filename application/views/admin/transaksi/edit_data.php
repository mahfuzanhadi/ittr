<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('transaksi') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php
    $id = $transaksi['id_pasien'];
    $this->db->select('no_rekam_medis');
    $this->db->from('pasien');
    $this->db->where('id_pasien', $id);
    $row = $this->db->get()->row();
    if (isset($row)) {
        $no_rekam_medis = $row->no_rekam_medis;
        // return $no_rekam_medis;
    } else {
        $no_rekam_medis = null;
    }
    ?>

    <div class="card mb-3">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" id="upload_form">
                <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                <input type="hidden" name="old_image" value="<?= $transaksi['foto_rontgen']; ?>">
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="no_rekam_medis">No. Rekam Medis <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="no_rekam_medis" placeholder="No. Rekam Medis " value="<?= set_value('no_rekam_medis', $no_rekam_medis); ?>" />
                        <small class="form-text text-danger"><?= form_error('no_rekam_medis'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="dokter">Dokter <font color="red">*</font></label>
                        <select class="form-control form-control-sm" name="dokter">
                            <!-- <option value="">Choose one</option> -->
                            <?php foreach ($dokter as $row) : ?>
                                <?php if ($row->id_dokter == $transaksi['id_dokter']) : ?>
                                    <option value="<?= $row->id_dokter; ?>" selected><?= $row->nama; ?></option>
                                <?php else : ?>
                                    <option value="<?= $row->id_dokter; ?>"><?= $row->nama; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('dokter'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label for="perawat">Perawat <font color="red">*</font></label>
                        <select class="form-control form-control-sm" name="perawat">
                            <?php foreach ($perawat as $row) : ?>
                                <?php if ($row->id_perawat == $transaksi['id_perawat']) : ?>
                                    <option value="<?= $row->id_perawat; ?>" selected><?= $row->nama; ?></option>
                                <?php else : ?>
                                    <option value="<?= $row->id_perawat; ?>"><?= $row->nama; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('perawat'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Tanggal<font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="tanggal" id="picker" placeholder="Tanggal" value="<?= $transaksi['tanggal'] ?>" /> <small>(tahun-bulan-hari)</small>
                        <small class="form-text text-danger"><?= form_error('tanggal'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <label>Diagnosa <font color="red">*</font></label>
                        <textarea class="form-control form-control-sm" type="text" name="diagnosa" placeholder="Diagnosa"><?= set_value('diagnosa', $transaksi['diagnosa']) ?></textarea>
                        <small class=" form-text text-danger"><?= form_error('diagnosa'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Keterangan</label>
                        <textarea class="form-control form-control-sm" type="text" name="keterangan" placeholder="Keterangan"><?= set_value('keterangan', $transaksi['keterangan']) ?></textarea>
                        <small class="form-text text-danger"><?= form_error('keterangan'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                        <label>Jam Mulai <font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="time" name="jam_mulai" placeholder="jam_mulai" value="<?= $transaksi['jam_mulai'] ?>" />
                        <small class="form-text text-danger"><?= form_error('jam_mulai'); ?></small>
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Jam Selesai <font color="red">*</font></label>
                        <!-- <input class="form-control form-control-sm" type="time" name="jam_selesai" placeholder="jam_selesai" value="<?= date('H:i:s'); ?>" step="1" /> -->
                        <input class="form-control form-control-sm" type="text" name="jam_selesai" placeholder="jam_selesai" id="timepicker" value="<?= $transaksi['jam_selesai'] ?>" />
                        <small class="form-text text-danger"><?= form_error('jam_selesai'); ?></small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-3">
                        <!-- <div class="form-group"> -->
                        <label for="foto_rontgen">Foto Rontgen</label>
                        <input class="form-control-file" type="file" name="foto_rontgen" id="foto_rontgen" />
                        <small class="form-text text-danger"><?= form_error('foto_rontgen'); ?></small>
                        <!-- </div> -->
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="metode_pembayaran">Metode Pembayaran <font color="red">*</font></label>
                        <select class="form-control  form-control-sm required" id="metode_pembayaran" name="metode_pembayaran">
                            <?php if ($transaksi['metode_pembayaran'] == 1) : ?>
                                <option value="1" selected <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                            <?php elseif ($transaksi['metode_pembayaran'] == 2) : ?>
                                <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                <option value="2" selected <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                            <?php elseif ($transaksi['metode_pembayaran'] == 3) : ?>
                                <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                <option value="3" selected <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                            <?php elseif ($transaksi['metode_pembayaran'] == 4) : ?>
                                <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                <option value="4" selected <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                            <?php else : ?>
                                <option value="0" selected>Pilih Metode Pembayaran</option>
                                <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                            <?php endif; ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('metode_pembayaran'); ?></small>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="tambah">Next</button>
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
    $("#timepicker").datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'H:i'
    });
</script>