<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('pasien') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php
    $tanggal_lahir = $pasien['tanggal_lahir'];
    $dob = new DateTime($tanggal_lahir);
    $now = new DateTime();
    $difference = $now->diff($dob);
    $age = $difference->y;
    $umur = floor((time() - strtotime($tanggal_lahir)) / 31556926);
    $age = intval($umur);
    ?>

    <div class="card my-2">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <p>No. Rekam Medis : <?= $pasien['no_rekam_medis']; ?></p>
                </div>
                <div class="col-sm-3">
                    <p>Alamat : <?= $pasien['alamat']; ?></p>
                </div>
                <div class="col-sm-3">
                    <p>Pekerjaan : <?= $pasien['pekerjaan']; ?></p>
                </div>
                <div class="col-sm-3">
                    <p>Riwayat Penyakit :
                        <?php if ($pasien['riwayat_penyakit'] != '') {
                            echo $pasien['riwayat_penyakit'];
                        } else {
                            echo '-';
                        } ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <p>Nama Pasien : <?= $pasien['nama']; ?></p>
                </div>
                <div class="col-sm-3">
                    <p>Umur : <?= $age; ?> tahun</p>
                </div>
                <div class="col-sm-3">
                    <p>No. telp : <?= $pasien['no_telp']; ?></p>
                </div>
                <div class="col-sm-3">
                    <p>Alergi Obat :
                        <?php if ($pasien['alergi_obat'] != '') {
                            echo $pasien['alergi_obat'];
                        } else {
                            echo '-';
                        } ?></p>
                </div>
            </div>
            <hr style="border: 2px solid #e0e0e0; border-radius: 5px;">
            <table class="table table-hover table-bordered" id="myTable">
                <thead>
                    <tr>
                        <th width="120px">Tanggal</th>
                        <th width="150px">Dokter</th>
                        <th width="110px">Perawat</th>
                        <th width="180px">Diagnosa</th>
                        <th width="220px">Tindakan</th>
                        <th width="220px">Rincian Tindakan</th>
                        <th width="150px">Obat</th>
                        <th width="80px">Dosis</th>
                        <th width="120px">Biaya Tindakan</th>
                        <th width="110px">Biaya Obat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $transaksi) : ?>
                        <tr>
                            <td>
                                <?php
                                setlocale(LC_ALL, 'id-ID', 'id_ID');
                                $tanggal = strftime("%d %B %Y", strtotime($transaksi['tanggal']));
                                echo $tanggal; ?>
                            </td>
                            <?php foreach ($dokter as $row) : ?>
                                <?php if ($row->id_dokter == $transaksi['id_dokter']) : ?>
                                    <td><?= $row->nama; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach ($perawat as $row) : ?>
                                <?php if ($row->id_perawat == $transaksi['id_perawat']) : ?>
                                    <td><?= $row->nama; ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <td>
                                <?php foreach ($detail_tindakan as $dt) {
                                    if ($dt->id_transaksi == $transaksi['id_transaksi']) {
                                        if ($dt->diagnosa != '') {
                                            echo '- ' . $dt->diagnosa . '<br/>';
                                        } else {
                                            echo '';
                                        }
                                    }
                                } ?>
                            </td>
                            <td>
                                <?php foreach ($detail_tindakan as $dt) {
                                    if ($dt->id_transaksi == $transaksi['id_transaksi']) {
                                        $id_tindakan = $dt->id_tindakan;
                                        foreach ((array) $tindakan as $t) {
                                            if ($t->id_tindakan == $id_tindakan) {
                                                echo '- ' . $t->nama . '<br/>';
                                            }
                                        }
                                    }
                                } ?>
                            </td>
                            <td>
                                <?php foreach ($detail_tindakan as $dt) {
                                    if ($dt->id_transaksi == $transaksi['id_transaksi']) {
                                        if ($dt->rincian != '') {
                                            echo '- ' . $dt->rincian . '<br/>';
                                        } else {
                                            echo '';
                                        }
                                    }
                                } ?>
                            </td>
                            <td>
                                <?php foreach ($detail_obat as $do) {
                                    if ($do->id_transaksi == $transaksi['id_transaksi']) {
                                        $id_obat = $do->id_obat;
                                        foreach ((array) $obat as $o) {
                                            if ($o->id_obat == $id_obat) {
                                                echo '- ' . $o->nama . '<br/>';
                                            }
                                        }
                                    }
                                } ?>
                            </td>
                            <td>
                                <?php foreach ($detail_obat as $do) {
                                    if ($do->id_transaksi == $transaksi['id_transaksi']) {
                                        echo '- ' . $do->dosis . '<br/>';
                                    }
                                } ?>
                            </td>
                            <?php $total_biaya_tindakan = "Rp " . number_format($transaksi['total_biaya_tindakan'], 0, ',', '.'); ?>
                            <td><?= $total_biaya_tindakan; ?></td>
                            <?php $total_biaya_obat = "Rp " . number_format($transaksi['total_biaya_obat'], 0, ',', '.'); ?>
                            <td><?= $total_biaya_obat;  ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            "responsive": true,
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false,
            "scrollX": true,
            "scrollCollapse": true
        });
    });
</script>