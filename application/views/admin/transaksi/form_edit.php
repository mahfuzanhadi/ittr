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
    } else {
        $no_rekam_medis = null;
    }
    ?>

    <div class="card mb-3">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form method="post" id="transaksi_form" enctype="multipart/form-data" action="<?= base_url('transaksi/update'); ?>">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_rekam_medis">Data Rekam Medis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" style="border:1px solid #ccc" id="list_detail_tindakan">Detail Tindakan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link inactive_tab1" style="border:1px solid #ccc" id="list_detail_obat">Detail Obat</a>
                    </li>
                </ul>
                <div class="tab-content" style="margin-top:16px">
                    <div class="tab-pane active" id="rekam_medis">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">Data Rekam Medis</div> -->
                            <div class="panel-body">
                                <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>" />
                                <input type="hidden" name="jam_selesai" value="<?= $transaksi['jam_selesai']; ?>" />
                                <input type="hidden" name="old_image" value="<?= $transaksi['foto_rontgen']; ?>" />
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="no_rekam_medis">No. Rekam Medis <font color="red">*</font></label>
                                        <input class="form-control form-control-sm" type="text" name="no_rekam_medis" id="no_rekam_medis" placeholder="No. Rekam Medis" value="<?= $no_rekam_medis; ?>" onkeypress="javascript:return isNumber(event)" />
                                        <span id="error_no_rm" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="dokter">Dokter <font color="red">*</font></label>
                                        <select class="form-control form-control-sm" name="dokter" id="dokter">
                                            <option value="">Choose one</option>
                                            <?php foreach ($dokter as $row) : ?>
                                                <?php if ($row->id_dokter == $transaksi['id_dokter']) : ?>
                                                    <option value="<?= $row->id_dokter; ?>" selected><?= $row->nama; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $row->id_dokter; ?>"><?= $row->nama; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="error_dokter" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="perawat">Perawat <font color="red">*</font></label>
                                        <select class="form-control form-control-sm" name="perawat" id="perawat">
                                            <option value="">Choose one</option>
                                            <?php foreach ($perawat as $row) : ?>
                                                <?php if ($row->id_perawat == $transaksi['id_perawat']) : ?>
                                                    <option value="<?= $row->id_perawat; ?>" selected><?= $row->nama; ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $row->id_perawat; ?>"><?= $row->nama; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="error_perawat" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                        <label>Tanggal</label>
                                        <input class="form-control form-control-sm" type="text" name="tanggal" id="picker" placeholder="Tanggal" value="<?= $transaksi['tanggal']; ?>" readonly="readonly" /> <small>(tahun-bulan-hari)</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                        <label>Jam Mulai</label>
                                        <input class="form-control form-control-sm" type="time" name="jam_mulai" placeholder="jam_mulai" readonly="readonly" value="<?= $transaksi['jam_mulai']; ?>" />
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label>Keterangan</label>
                                        <textarea class="form-control form-control-sm" type="text" name="keterangan" placeholder="Keterangan"><?= $transaksi['keterangan']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="metode_pembayaran">Metode Pembayaran</label>
                                        <select class="form-control  form-control-sm" id="metode_pembayaran" name="metode_pembayaran">
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
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="foto_rontgen">Foto Rontgen</label>
                                        <input class="form-control-file" type="file" name="foto_rontgen" id="foto_rontgen" />
                                    </div>
                                </div>
                                <div align="center">
                                    <button type="button" name="btn_rekam_medis" id="btn_rekam_medis" class="btn btn-info btn-lg">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail_tindakan">
                        <!-- <div class="panel-heading">Isi Detail Tindakan</div> -->
                        <div class="panel-body">
                            <?php foreach ($detail_tindakan as $dt) : ?>
                                <?php if ($dt->id_transaksi == $transaksi['id_transaksi']) : ?>
                                    <?php $id_tindakan = $dt->id_tindakan; ?>
                                    <div class="form-row">
                                        <div class="form-group col-sm-3">
                                            <label>Diagnosa</label>
                                            <input class="form-control form-control-sm" type="text" name="diagnosa[]" id="diagnosa" placeholder="Diagnosa" value="<?= $dt->diagnosa; ?>" />
                                            <span id="error_diagnosa" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <?php foreach ((array) $tindakan as $t) : ?>
                                                <?php if ($t->id_tindakan == $id_tindakan) : ?>
                                                    <?php $nama_tindakan = $t->nama; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <label for="tindakan">Tindakan</label>
                                            <select class="itemName js-states form-control" name="tindakan[]" id="tindakan">
                                                <option value="<?= $dt->id_tindakan; ?>"><?= $nama_tindakan; ?></option>
                                            </select>
                                            <span id="error_tindakan" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label>Biaya</label>
                                            <input class="form-control form-control-sm" type="text" name="biaya[]" id="biaya" placeholder="Biaya" value="<?= $dt->biaya_tindakan; ?>" onkeypress="javascript:return isNumber(event)" />
                                            <span id="error_biaya" class="text-danger"></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div align="center">
                                <button type="button" name="previous_btn_tindakan" id="previous_btn_tindakan" class="btn btn-outline-info btn-lg">Sebelumnya</button>
                                <button type="button" name="btn_detail_tindakan" id="btn_detail_tindakan" class="btn btn-info btn-lg">Selanjutnya</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail_obat">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">Isi Detail Obat</div> -->
                            <div class="panel-body">
                                <?php foreach ($detail_obat as $do) : ?>
                                    <?php if ($do->id_transaksi == $transaksi['id_transaksi']) : ?>
                                        <?php $id_obat = $do->id_obat; ?>
                                        <div class="form-row">
                                            <div class="form-group col-sm-4">
                                                <?php foreach ((array) $obat as $o) : ?>
                                                    <?php if ($o->id_obat == $id_obat) : ?>
                                                        <?php $nama_obat = $o->nama; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <label for="obat">Obat</label>
                                                <select class="itemName js-states form-control" name="obat[]" id="obat">
                                                    <option value="<?= $do->id_obat; ?>"><?= $nama_obat; ?></option>
                                                </select>
                                                <span id="error_obat" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Harga <font color="red">*</font></label>
                                                <input class="form-control form-control-sm" type="text" name="harga[]" id="harga" placeholder="Harga" value="<?= $do->biaya_obat; ?>" onkeypress="javascript:return isNumber(event)" />
                                                <span id="error_harga" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Dosis <font color="red">*</font></label>
                                                <input class="form-control form-control-sm" type="text" name="dosis[]" id="dosis" placeholder="Dosis" value="<?= $do->dosis; ?>" />
                                                <span id="error_dosis" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Jumlah Obat <font color="red">*</font></label>
                                                <input class="form-control form-control-sm" type="text" name="jumlah[]" id="jumlah" placeholder="Jumlah Obat" value="<?= $do->jumlah_obat; ?>" />
                                                <span id="error_jumlah" class="text-danger"></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div align="center">
                                    <button type="button" name="previous_btn_obat" id="previous_btn_obat" class="btn btn-outline-info btn-lg">Sebelumnya</button>
                                    <button type="button" name="btn_detail_obat" id="btn_detail_obat" class="btn btn-info btn-lg">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script src="<?php echo base_url('assets/js/is-number.js') ?>"></script>
<script src="<?php echo base_url('assets/js/datepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/js/transaksi-form-val.js') ?>"></script>

<script>
    var biaya = $('#biaya').val();
    var biaya_tindakan = new Intl.NumberFormat().format(biaya);
    $('#biaya').val(biaya_tindakan);

    var harga = $('#harga').val();
    var harga_obat = new Intl.NumberFormat().format(harga);
    $('#harga').val(harga_obat);
</script>

<script>
    $('#biaya').on('input', function() {
        var number, s_number, f_number;

        number = $('#biaya').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        $('#biaya').val(f_number);
    });

    $('#harga').on('input', function() {
        var number, s_number, f_number;

        number = $('#harga').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        $('#harga').val(f_number);
    });

    for (var i = 2; i < 7; i++) {
        var s_number, f_number;
        var biaya = $('#biaya' + i + '').val();
        if (biaya != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#biaya' + i + '').val(f_number);
        }
    }

    for (var i = 2; i < 7; i++) {
        var s_number, f_number;
        var harga = $('#harga' + i + '').val();
        if (harga != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#harga' + i + '').val(f_number);
        }
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>

<!-- SCRIPT FETCH DATA TINDAKAN KE SELECT -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#tindakan").select2({
            placeholder: 'Pilih salah satu',
            width: '100%',
            ajax: {
                url: '<?= base_url() ?>transaksi/get_tindakan',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>

<!-- SCRIPT AMBIL BIAYA SETELAH PILIH TINDAKAN -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tindakan').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('transaksi/get_biaya'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    var html = data;
                    hasil = parseInt(html).toLocaleString(); //mengubah jadi currency
                    $('#biaya').val(hasil);

                }
            });
            return false;
        });
    });
</script>

<!-- SCRIPT FETCH DATA OBAT KE SELECT -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#obat").select2({
            placeholder: 'Pilih salah satu',
            width: '100%',
            ajax: {
                url: '<?= base_url() ?>transaksi/get_obat',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    });
</script>

<!-- SCRIPT AMBIL HARGA SETELAH PILIH OBAT -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#obat').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('transaksi/get_harga'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    var html = data;
                    hasil = parseInt(html).toLocaleString(); //mengubah jadi currency
                    $('#harga').val(hasil);

                }
            });
            return false;
        });
    });
</script>

<!-- SCRIPT HILANGIN KOMA DI BIAYA TINDAKAN DAN HARGA OBAT -->
<script>
    $('#btn_detail_obat').click(function() {
        var biaya = $('#biaya').val();
        var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
        $('#biaya').val(hasil);

        var harga = $('#harga').val();
        if (harga != '') {
            var hasil = parseFloat(harga.replace(/[^0-9-.]/g, ''));
            $('#harga').val(hasil);
        }

        for (var i = 2; i < 7; i++) {
            var biaya = $('#biaya' + i + '').val();
            if (biaya != null) {
                var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
                $('#biaya' + i + '').val(hasil);
            }
        }

        for (var i = 2; i < 7; i++) {
            var harga = $('#harga' + i + '').val();
            if (harga != null) {
                var hasil = parseFloat(harga.replace(/[^0-9-.]/g, ''));
                $('#harga' + i + '').val(hasil);
            }
        }
    });
</script>