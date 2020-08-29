<!DOCTYPE html>
<html lang=”en”>

<head>
    <meta charset=”UTF-8″>
    <meta name=”viewport” content=”width=device-width, initial-scale=1.0″>
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/style.css">
    <title>Receipt</title>
</head>

<body>
    <div class="ticket">
        <center>
            <img src="<?= base_url('assets/img/logo_header_RDC.png'); ?>" style="max-width: 155px;">
            <p><strong>Riona Dental Care</strong><br />Jl. Harapan Raya No.64, Pekanbaru 28289</p>
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $hari = date('D');

            switch ($hari) {
                case 'Sun':
                    $hari_ini = "Minggu";
                    break;

                case 'Mon':
                    $hari_ini = "Senin";
                    break;

                case 'Tue':
                    $hari_ini = "Selasa";
                    break;

                case 'Wed':
                    $hari_ini = "Rabu";
                    break;

                case 'Thu':
                    $hari_ini = "Kamis";
                    break;

                case 'Fri':
                    $hari_ini = "Jumat";
                    break;

                case 'Sat':
                    $hari_ini = "Sabtu";
                    break;

                default:
                    $hari_ini = "Tidak di ketahui";
                    break;
            }

            $date = date('d/m/Y');
            $waktu = date('H:i'); ?>
            <p><?= $hari_ini . ', ' . $date . ' ' . $waktu; ?></p>
        </center>
        <p><strong>Nama :
                <?php
                foreach ($pasien as $p) {
                    if ($transaksi['id_pasien'] == $p->id_pasien) {
                        echo $p->nama;
                    }
                } ?>
            </strong>
            <br /><strong>No. Rekam Medis :
                <?php
                foreach ($pasien as $p) {
                    if ($transaksi['id_pasien'] == $p->id_pasien) {
                        echo $p->no_rekam_medis;
                    }
                } ?>
            </strong></br>
            <hr>
            <table>
                <tbody>
                    <?php foreach ($detail_tindakan as $dt) : ?>
                        <?php if ($dt->id_transaksi == $transaksi['id_transaksi']) : ?>
                            <?php $id_tindakan = $dt->id_tindakan; ?>
                            <?php foreach ((array) $tindakan as $t) : ?>
                                <?php if ($t->id_tindakan == $id_tindakan) : ?>
                                    <tr>
                                        <td class="description">
                                            <?php echo $t->nama; ?>
                                        </td>
                                        <td class="price">
                                            <?php $biaya_tindakan = number_format($dt->biaya_tindakan, 0, ',', '.');
                                            echo $biaya_tindakan; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php foreach ($detail_obat as $do) : ?>
                        <?php if ($do->id_transaksi == $transaksi['id_transaksi']) : ?>
                            <?php $id_obat = $do->id_obat; ?>
                            <?php foreach ((array) $obat as $o) : ?>
                                <?php if ($o->id_obat == $id_obat) : ?>
                                    <tr>
                                        <td class="description">
                                            <?php echo $o->nama . ' x ' . $do->jumlah_obat; ?>
                                        </td>
                                        <td class="price">
                                            <?php
                                            $biaya_obat = number_format($do->biaya_obat, 0, ',', '.');
                                            echo $biaya_obat; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr style="border-top: 1px dashed black;">
                        <td class="description"><strong>Diskon</strong></td>
                        <td class="price"><strong>
                                <?php
                                $diskon = $transaksi['diskon'];
                                if ($diskon > 100) {
                                    $format_diskon = number_format($transaksi['diskon'], 0, ',', '.');
                                } else {
                                    $total_biaya = $transaksi['total_biaya_tindakan'] + $transaksi['total_biaya_obat'];
                                    $disc = $transaksi['diskon'];
                                    $diskon = ($total_biaya * $disc) / 100;
                                    $format_diskon = number_format($diskon, 0, ',', '.');
                                }
                                echo $format_diskon; ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="description"><strong>Total</strong></td>
                        <td class="price"><strong>
                                <?php
                                $total = number_format($transaksi['total_biaya_keseluruhan'], 0, ',', '.');
                                echo $total; ?></strong>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px dashed black;">
                        <td class="description"><strong>Sisa yang belum dibayar</strong></td>
                        <td class="price"><strong>
                                <?php $sisa_sebelum = number_format($pembayaran['sisa_sebelum'], 0, ',', '.');
                                echo $sisa_sebelum; ?>
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="description">Bayar</td>
                        <td class="price">
                            <?php
                            $jumlah_bayar = number_format($pembayaran['jumlah_bayar'], 0, ',', '.');
                            echo $jumlah_bayar; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="description">Kembali</td>
                        <td class="price">
                            <?php
                            $kembalian = number_format($pembayaran['kembalian'], 0, ',', '.');
                            echo $kembalian ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="description">Sisa</td>
                        <td class="price">
                            <?php
                            $sisa_sesudah = number_format($pembayaran['sisa_sesudah'], 0, ',', '.');
                            echo $sisa_sesudah ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <center>
                <hr>
                <?php
                if ($pembayaran['sisa_sesudah'] > 0 && $pembayaran['sisa_sesudah'] < $transaksi['total_biaya_keseluruhan']) {
                    $status_pembayaran = "### BELUM LUNAS ###";
                } else {
                    $status_pembayaran = "### LUNAS ###";
                } ?>
                <p><strong><?= $status_pembayaran; ?></strong></p>
                <hr>
            </center>
            <p class="centered">TERIMA KASIH
                <br>www.rionadentalcare.com
                <br />0822 8819 4282</p>
    </div>
    </div>
    <button id="btnPrint" class="hidden-print" onclick="window.print();">Print</button>

    <script>
        window.onload = function() {
            if (!window.location.hash) {
                window.location = window.location + '#loaded';
                window.location.reload();
            }
            window.print();
            window.focus();
        }
    </script>
</body>

</html>