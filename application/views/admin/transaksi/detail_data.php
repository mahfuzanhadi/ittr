<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('transaksi') ?>"><i class="fas fa-arrow-left"></i> Back</a>
    <p></p>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php
    $id = $transaksi['id_pasien'];
    $this->db->select('*');
    $this->db->from('pasien');
    $this->db->where('id_pasien', $id);
    $row = $this->db->get()->row();
    if (isset($row)) {
        $no_rekam_medis = $row->no_rekam_medis;
        $tanggal_lahir = $row->tanggal_lahir;
    } else {
        $no_rekam_medis = null;
    }

    $dob = new DateTime($tanggal_lahir);
    $now = new DateTime();
    $difference = $now->diff($dob);
    $age = $difference->y;
    $umur = floor((time() - strtotime($tanggal_lahir)) / 31556926);
    $age = intval($umur);
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
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <p>No. Rekam Medis : <?= $row->no_rekam_medis; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <p>Alamat : <?= $row->alamat; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <p>Pekerjaan : <?= $row->pekerjaan; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <p>Riwayat Penyakit : <?php if ($row->riwayat_penyakit != '') {
                                                        echo $row->riwayat_penyakit;
                                                    } else {
                                                        echo '-';
                                                    } ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-3">
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <labe>Pasien : <?= $row->nama; ?></labe>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <p>Umur : <?= $age; ?> tahun</p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <p>No. telp : <?= $row->no_telp; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-group col-sm-3">
                    <?php foreach ($pasien as $row) : ?>
                        <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                            <p>Alergi Obat : <?php if ($row->alergi_obat != '') {
                                                    echo $row->alergi_obat;
                                                } else {
                                                    echo '-';
                                                } ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
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
                <a href="<?= base_url('transaksi/edit/' . $transaksi['id_transaksi']); ?>" class="btn btn btn-success"><i class="fas fa-edit"></i> Edit Data</a>&nbsp;
                <a href="<?= base_url('transaksi/delete/' . $transaksi['id_transaksi']); ?>" class="btn btn btn-danger"><i class="fas fa-trash"></i> Delete Data</a>
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