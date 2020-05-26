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

    <?php
    $tanggal_lahir = $pasien['tanggal_lahir'];
    $dob = new DateTime($tanggal_lahir);
    $now = new DateTime();
    $difference = $now->diff($dob);
    $age = $difference->y;
    $umur = floor((time() - strtotime($tanggal_lahir)) / 31556926);
    $age = intval($umur);

    foreach ($transaksi as $transaksi) {
        echo $transaksi['id_transaksi'];
    }
    ?>

    <div class="card mb-3">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <p>No. Rekam Medis : <?= $pasien['no_rekam_medis']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Alamat : <?= $pasien['alamat']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Pekerjaan : <?= $pasien['pekerjaan']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Riwayat Penyakit : <?php if ($pasien['riwayat_penyakit'] != '') {
                                                echo $pasien['riwayat_penyakit'];
                                            } else {
                                                echo '-';
                                            } ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <p>Pasien : <?= $pasien['nama']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Umur : <?= $age; ?> tahun</p>
                </div>
                <div class="form-group col-sm-3">
                    <p>No. telp : <?= $pasien['no_telp']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Alergi Obat : <?php if ($pasien['alergi_obat'] != '') {
                                            echo $pasien['alergi_obat'];
                                        } else {
                                            echo '-';
                                        } ?></p>
                </div>
            </div>
            <hr style="border: 2px solid #e0e0e0;">
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <?php foreach ($dokter as $row) : ?>
                        <?php if ($row->id_dokter == $transaksi['id_dokter']) : ?>
                            <p>Dokter : <?= $row->nama; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($perawat as $row) : ?>
                        <?php if ($row->id_perawat == $transaksi['id_perawat']) : ?>
                            <p>Perawat : <?= $row->nama; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <p>Jam Mulai : <?= $transaksi['jam_mulai']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Jam Selesai : <?= $transaksi['jam_selesai']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <p>Tanggal : <?= $transaksi['tanggal']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Diagnosa : <?= $transaksi['diagnosa']; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <p>Keterangan : <?= $transaksi['keterangan']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <?php $total_biaya_tindakan = "Rp " . number_format($transaksi['total_biaya_tindakan'], 2, ',', '.'); ?>
                    <p>Total Biaya Tindakan : <?= $total_biaya_tindakan; ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <?php $total_biaya_obat = "Rp " . number_format($transaksi['total_biaya_obat'], 2, ',', '.'); ?>
                    <p>Total Biaya Obat : <?= $total_biaya_obat;  ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <?php $total_biaya_keseluruhan = "Rp " . number_format($transaksi['total_biaya_keseluruhan'], 2, ',', '.'); ?>
                    <p>Total Biaya Keseluruhan : <?= $total_biaya_keseluruhan;  ?></p>
                </div>
                <div class="form-group col-sm-3">
                    <?php if ($transaksi['metode_pembayaran'] == 1) : ?>
                        <p for="metode_pembayaran">Metode Pembayaran : Cash</p>
                    <?php elseif ($transaksi['metode_pembayaran'] == 2) : ?>
                        <p for="metode_pembayaran">Metode Pembayaran : Kredit</p>
                    <?php elseif ($transaksi['metode_pembayaran'] == 3) : ?>
                        <p for="metode_pembayaran">Metode Pembayaran : Debit</p>
                    <?php elseif ($transaksi['metode_pembayaran'] == 4) : ?>
                        <p for="metode_pembayaran">Metode Pembayaran : Transfer</p>
                    <?php else : ?>
                        <p for="metode_pembayaran">Metode Pembayaran : Belum dibayar</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <?php if ($transaksi['foto_rontgen'] != 'default.jpg') : ?>
                    <div class="form-group col-sm-3">
                        <p for="foto_rontgen">Foto Rontgen : </p>
                        <?php
                        $base = base_url('uploads/rontgen/' . $transaksi['foto_rontgen']); ?>
                        <img width="64px" height="64px" src="<?= $base ?>" />
                    </div>
                <?php else : ?>
                    <div class="form-group col-sm-3">
                        <p>Foto Rontgen : -</p>
                    </div>
                <?php endif; ?>
            </div>
            <div align="center">
                <a href="<?= base_url('pasien/edit/' . $pasien['id_pasien']); ?>" class="btn btn btn-success"><i class="fas fa-edit"></i> Edit Data</a>&nbsp;
                <a href="<?= base_url('pasien/delete/' . $pasien['id_pasien']); ?>" class="btn btn btn-danger"><i class="fas fa-trash"></i> Delete Data</a>
            </div>
        </div>
        <!-- <div class="form-group col-sm-3">
            <input class="form-control form-control-sm" type="text" name="tanggal" id="timepicker" value="<?= date('H:i:s'); ?>" />
        </div> -->
        <div class="card-footer small text-muted">
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