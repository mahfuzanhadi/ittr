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
            <!-- <input type="hidden" name="id" value="<?= $transaksi['id_transaksi']; ?>">
            <input type="hidden" name="old_image" value="<?= $transaksi['foto_rontgen']; ?>"> -->
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <label for="no_rekam_medis">No. Rekam Medis : <?= $no_rekam_medis; ?> </label>
                </div>
                <div class="form-group col-sm-3">
                    <label for="tanggal">Tanggal : <?= $transaksi['tanggal']; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <?php foreach ($dokter as $row) : ?>
                        <?php if ($row->id_dokter == $transaksi['id_dokter']) : ?>
                            <label for="dokter">Dokter : <?= $row->nama; ?></label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($perawat as $row) : ?>
                        <?php if ($row->id_perawat == $transaksi['id_perawat']) : ?>
                            <label for="perawat">Perawat : <?= $row->nama; ?></label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <label>Diagnosa : <?= $transaksi['diagnosa']; ?></label>
                </div>
                <div class="form-group col-sm-3">
                    <label>Keterangan : <?= $transaksi['keterangan']; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <label>Jam Mulai : <?= $transaksi['jam_mulai']; ?></label>
                </div>
                <div class="form-group col-sm-3">
                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                    <label>Jam Selesai : <?= $transaksi['jam_selesai']; ?></label>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <label for="foto_rontgen">Foto Rontgen : </label>
                    <?php
                    $base = base_url('uploads/rontgen/' . $transaksi['foto_rontgen']); ?>
                    <img width="64px" height="64px" src="<?= $base ?>" />
                </div>
                <div class="form-group col-sm-3">
                    <?php if ($transaksi['metode_pembayaran'] == 1) : ?>
                        <label for="metode_pembayaran">Metode Pembayaran : Cash</label>
                    <?php elseif ($transaksi['metode_pembayaran'] == 2) : ?>
                        <label for="metode_pembayaran">Metode Pembayaran : Kredit</label>
                    <?php elseif ($transaksi['metode_pembayaran'] == 3) : ?>
                        <label for="metode_pembayaran">Metode Pembayaran : Debit</label>
                    <?php elseif ($transaksi['metode_pembayaran'] == 4) : ?>
                        <label for="metode_pembayaran">Metode Pembayaran : Transfer</label>
                    <?php else : ?>
                        <label for="metode_pembayaran">Metode Pembayaran : </label>
                    <?php endif; ?>
                </div>
            </div>
            <div align="center">
                <a href="<?= base_url('transaksi/edit/' . $transaksi['id_transaksi']); ?>" class="btn btn btn-success"><i class="fas fa-edit"></i> Edit Data</a>&nbsp;
                <a href="<?= base_url('transaksi/delete/' . $transaksi['id_transaksi']); ?>" class="btn btn btn-danger"><i class="fas fa-trash"></i> Delete Data</a>
            </div>
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