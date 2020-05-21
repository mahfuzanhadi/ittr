<?php
foreach ($obat as $row) {
    echo '<option value="' . $row->id_obat . '" ' . set_select('obat', $row->id_obat) . '> ' . $row->nama . ' </option>';
} ?>

<p><?= $tindakan['id_detail_transaksi']; ?></p>
<p><?= $tindakan['id_transaksi']; ?></p>
<p><?= $tindakan['id_tindakan']; ?></p>
<p><?= $tindakan['biaya_tindakan']; ?></p>