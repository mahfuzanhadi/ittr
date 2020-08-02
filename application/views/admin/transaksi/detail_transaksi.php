<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <a href="<?php echo base_url('transaksi') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <div class="card my-2">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <?php foreach ($pasien as $row) : ?>
                <?php if ($row->id_pasien == $transaksi['id_pasien']) : ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <p><strong>No. Rekam Medis</strong> : <?= $row->no_rekam_medis; ?></p>
                        </div>
                        <div class="col-sm-3">
                            <p><strong>Alamat</strong> : <?= $row->alamat; ?></p>
                        </div>
                        <div class="col-sm-3">
                            <p><strong>Pekerjaan</strong> : <?= $row->pekerjaan; ?></p>
                        </div>
                        <div class="col-sm-3">
                            <p><strong>Riwayat Penyakit</strong> :
                                <?php if ($row->riwayat_penyakit != '') {
                                    echo $row->riwayat_penyakit;
                                } else {
                                    echo '-';
                                } ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <p><strong>Nama Pasien</strong> : <?= $row->nama; ?></p>
                        </div>
                        <div class="col-sm-3">
                            <?php
                            $tanggal_lahir = $row->tanggal_lahir;
                            $dob = new DateTime($tanggal_lahir);
                            $now = new DateTime();
                            $difference = $now->diff($dob);
                            $age = $difference->y;
                            $umur = floor((time() - strtotime($tanggal_lahir)) / 31556926);
                            $age = intval($umur);
                            ?>
                            <p><strong>Umur</strong> : <?= $age; ?> tahun</p>
                        </div>
                        <div class="col-sm-3">
                            <p><strong>No. telp</strong> : <?= $row->no_telp; ?></p>
                        </div>
                        <div class="col-sm-3">
                            <p><strong>Alergi Obat</strong> :
                                <?php if ($row->alergi_obat != '') {
                                    echo $row->alergi_obat;
                                } else {
                                    echo '-';
                                } ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <hr style="border: 2px solid #e0e0e0; border-radius: 5px;">
            <div class="row">
                <div class="col-sm-3">
                    <?php foreach ($dokter as $row) : ?>
                        <?php if ($row->id_dokter == $transaksi['id_dokter']) : ?>
                            <p><strong>Dokter</strong> : <?= $row->nama; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-sm-3">
                    <?php foreach ($perawat as $row) : ?>
                        <?php if ($row->id_perawat == $transaksi['id_perawat']) : ?>
                            <p><strong>Perawat</strong> : <?= $row->nama; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-sm-3">
                    <p><strong>Jam Mulai</strong> : <?= $transaksi['jam_mulai']; ?></p>
                </div>
                <div class="col-sm-3">
                    <p><strong>Jam Selesai</strong> : <?= $transaksi['jam_selesai']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Tanggal</strong> : <?= $transaksi['tanggal']; ?></p>
                </div>
                <div class="col-sm-3">
                    <p><strong>Keterangan</strong> : <?= $transaksi['keterangan']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Diagnosa</strong> : </p>
                    <?php foreach ($detail_tindakan as $dt) {
                        if ($dt->id_transaksi == $transaksi['id_transaksi']) {
                            echo '- ' . $dt->diagnosa . '</p>';
                        }
                    } ?>
                </div>
                <div class="col-sm-3">
                    <p><strong>Tindakan</strong> : </p>
                    <?php foreach ($detail_tindakan as $dt) {
                        if ($dt->id_transaksi == $transaksi['id_transaksi']) {
                            $id_tindakan = $dt->id_tindakan;
                            foreach ((array) $tindakan as $t) {
                                if ($t->id_tindakan == $id_tindakan) {
                                    echo '- ' . $t->nama . '</p>';
                                }
                            }
                        }
                    } ?>
                </div>
                <div class="col-sm-3">
                    <p><strong>Obat</strong> : </p>
                    <?php foreach ($detail_obat as $do) {
                        if ($do->id_transaksi == $transaksi['id_transaksi']) {
                            $id_obat = $do->id_obat;
                            foreach ((array) $obat as $o) {
                                if ($o->id_obat == $id_obat) {
                                    echo '- ' . $o->nama . '</p>';
                                }
                            }
                        }
                    } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <?php $total_biaya_tindakan = "Rp " . number_format($transaksi['total_biaya_tindakan'], 2, ',', '.'); ?>
                    <p><strong>Total Biaya Tindakan</strong> : <?= $total_biaya_tindakan; ?></p>
                </div>
                <div class="col-sm-3">
                    <?php $total_biaya_obat = "Rp " . number_format($transaksi['total_biaya_obat'], 2, ',', '.'); ?>
                    <p><strong>Total Biaya Obat</strong> : <?= $total_biaya_obat;  ?></p>
                </div>
                <div class="col-sm-3">
                    <?php $total_biaya_keseluruhan = "Rp " . number_format($transaksi['total_biaya_keseluruhan'], 2, ',', '.'); ?>
                    <p><strong>Total Biaya Keseluruhan</strong> : <?= $total_biaya_keseluruhan;  ?></p>
                </div>
                <div class="col-sm-3">
                    <p><strong>Metode Pembayaran</strong> :
                        <?php if ($transaksi['metode_pembayaran'] == 1) : ?>
                            Cash
                        <?php elseif ($transaksi['metode_pembayaran'] == 2) : ?>
                            Kredit
                        <?php elseif ($transaksi['metode_pembayaran'] == 3) : ?>
                            Debit
                        <?php elseif ($transaksi['metode_pembayaran'] == 4) : ?>
                            Transfer
                        <?php else : ?>
                            Belum dibayar
                        <?php endif; ?> </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Foto Rontgen</strong> :
                        <?php if ($transaksi['foto_rontgen'] != 'default.jpg') : ?>
                            <?php
                            $base = base_url('uploads/rontgen/' . $transaksi['foto_rontgen']); ?>
                            <img width="64px" height="64px" src="<?= $base ?>" />
                        <?php else : ?> -
                        <?php endif; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>