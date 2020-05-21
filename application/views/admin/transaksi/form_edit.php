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
                                <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
                                <input type="hidden" name="jam_selesai" value="<?= $transaksi['jam_selesai']; ?>">
                                <input type="hidden" name="old_image" value="<?= $transaksi['foto_rontgen']; ?>">
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
                                        <label>Diagnosa <font color="red">*</font></label>
                                        <textarea class="form-control form-control-sm" type="text" name="diagnosa" id="diagnosa" placeholder="Diagnosa"><?= $transaksi['diagnosa']; ?></textarea>
                                        <span id="error_diagnosa" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label>Keterangan</label>
                                        <textarea class="form-control form-control-sm" type="text" name="keterangan" placeholder="Keterangan"><?= $transaksi['keterangan']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                        <label>Jam Mulai</label>
                                        <input class="form-control form-control-sm" type="time" name="jam_mulai" placeholder="jam_mulai" readonly="readonly" value="<?= $transaksi['jam_mulai']; ?>" />
                                    </div>
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
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="foto_rontgen">Foto Rontgen</label>
                                        <input class="form-control-file" type="file" name="foto_rontgen" id="foto_rontgen" />
                                    </div>
                                </div><br />
                                <div align="center">
                                    <button type="button" name="btn_rekam_medis" id="btn_rekam_medis" class="btn btn-info btn-lg">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail_tindakan">
                        <!-- <div class="panel-heading">Isi Detail Tindakan</div> -->
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="form-group col-sm-4">
                                    <label for="tindakan">Tindakan 1<font color="red">*</font>
                                        <p style="margin-bottom: 0.5rem"></p>
                                        <select class="itemName form-control form-control-sm" name="tindakan" id="tindakan" style="width: 350px">
                                        </select>
                                    </label>
                                    <span id="error_tindakan" class="text-danger"></span>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>Biaya<font color="red">*</font></label>
                                    <input class="form-control form-control-sm" type="text" name="biaya" id="biaya" placeholder="Biaya" onkeypress="javascript:return isNumber(event)" value="<?= $detail_tindakan1['biaya_tindakan']; ?>" />
                                    <span id="error_biaya" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-4">
                                    <label for="tindakan2">Tindakan 2 (kosongkan jika tidak ada)<p style="margin-bottom: 0.5rem"></p>
                                        <select class="itemName form-control form-control-sm" name="tindakan2" id="tindakan2" style="width: 350px"></select>
                                    </label>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>Biaya</label>
                                    <input class="form-control form-control-sm biaya" type="text" name="biaya2" id="biaya2" placeholder="Biaya" onkeypress="javascript:return isNumber(event)" value="<?= $detail_tindakan2['biaya_tindakan']; ?>" />
                                </div>
                            </div>
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
                                <div class="form-row">
                                    <div class="form-group col-sm-4">
                                        <label for="obat">Obat 1<font color="red">*</font></label>
                                        <select class="itemName form-control form-control-sm" name="obat" id="obat">
                                            <option value="">Choose one</option>
                                            <?php
                                            foreach ($obat as $row) {
                                                echo '<option value="' . $row->id_obat . '" ' . set_select('obat', $row->id_obat) . '> ' . $row->nama . ' </option>';
                                            } ?>
                                        </select>
                                        <span id="error_obat" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>Harga<font color="red">*</font></label>
                                        <input class="form-control form-control-sm" type="text" name="harga" id="harga" placeholder="Harga" onkeypress="javascript:return isNumber(event)" />
                                        <span id="error_harga" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>Dosis<font color="red">*</font></label>
                                        <input class="form-control form-control-sm" type="text" name="dosis" id="dosis" placeholder="Dosis" />
                                        <span id="error_dosis" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>Jumlah Obat<font color="red">*</font></label>
                                        <input class="form-control form-control-sm" type="text" name="jumlah" id="jumlah" placeholder="Jumlah Obat" />
                                        <span id="error_jumlah" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-4">
                                        <label for="obat2">Obat 2 (kosongkan jika tidak ada)</label>
                                        <select class="itemName form-control form-control-sm" name="obat2" id="obat2">
                                            <option value="">Choose one</option>
                                            <?php
                                            foreach ($obat as $row) {
                                                echo '<option value="' . $row->id_obat . '" ' . set_select('obat', $row->id_obat) . '> ' . $row->nama . ' </option>';
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>Harga</label>
                                        <input class="form-control form-control-sm harga" type="text" name="harga2" id="harga2" placeholder="Harga" onkeypress="javascript:return isNumber(event)" />
                                        <span id="error_harga2" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>Dosis</label>
                                        <input class="form-control form-control-sm" type="text" name="dosis2" id="dosis2" placeholder="Dosis" />
                                        <span id="error_dosis2" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label>Jumlah Obat</label>
                                        <input class="form-control form-control-sm" type="text" name="jumlah2" id="jumlah2" placeholder="Jumlah Obat" />
                                        <span id="error_jumlah2" class="text-danger"></span>
                                    </div>
                                </div>
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

<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }
</script>
<script>
    $('#biaya').on('input', function() {

        var number, s_number, f_number;

        number = $('#biaya').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        console.info(f_number);
        $('#biaya').val(f_number);
    });

    $('#biaya2').on('input', function() {

        var number, s_number, f_number;

        number = $('#biaya2').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        console.info(f_number);
        $('#biaya2').val(f_number);
    });

    $('#harga').on('input', function() {

        var number, s_number, f_number;

        number = $('#harga').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        console.info(f_number);
        $('#harga').val(f_number);
    });
    $('#harga2').on('input', function() {

        var number, s_number, f_number;

        number = $('#harga2').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        console.info(f_number);
        $('#harga2').val(f_number);
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>
<script>
    $(document).ready(function() {
        $('#btn_rekam_medis').click(function() {
            var error_no_rm = '';
            var error_dokter = '';
            var error_perawat = '';
            var error_diagnosa = '';
            if ($.trim($('#no_rekam_medis').val()).length == 0) {
                error_no_rm = 'Nomor Rekam Medis wajib diisi';
                $('#error_no_rm').text(error_no_rm);
                $('#no_rekam_medis').addClass('has-error');
            } else {
                error_no_rm = '';
                $('#error_no_rm').text(error_no_rm);
                $('#no_rekam_medis').removeClass('has-error');
            }

            var no_rekam_medis = $('#no_rekam_medis').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>transaksi/isExist",
                data: "no_rekam_medis=" + no_rekam_medis,
                success: function(response) {
                    if (response != '') {
                        $('#error_no_rm').text(response);
                        $('#no_rekam_medis').addClass('has-error');
                    } else {
                        error_no_rm = response;
                        error_no_rm = '';
                        $('#error_no_rm').text(error_no_rm);
                        $('#no_rekam_medis').removeClass('has-error');
                    }
                }
            });

            if ($.trim($('#dokter').val()).length == 0) {
                error_dokter = 'Data dokter wajib diisi';
                $('#error_dokter').text(error_dokter);
                $('#dokter').addClass('has-error');
            } else {
                error_dokter = '';
                $('#error_dokter').text(error_dokter);
                $('#dokter').removeClass('has-error');
            }

            if ($.trim($('#perawat').val()).length == 0) {
                error_perawat = 'Data perawat wajib diisi';
                $('#error_perawat').text(error_perawat);
                $('#perawat').addClass('has-error');
            } else {
                error_perawat = '';
                $('#error_perawat').text(error_perawat);
                $('#perawat').removeClass('has-error');
            }

            if ($.trim($('#diagnosa').val()).length == 0) {
                error_diagnosa = 'Data diagnosa wajib diisi';
                $('#error_diagnosa').text(error_diagnosa);
                $('#diagnosa').addClass('has-error');
            } else {
                error_diagnosa = '';
                $('#error_diagnosa').text(error_diagnosa);
                $('#diagnosa').removeClass('has-error');
            }

            if (error_no_rm != '' || error_dokter != '' || error_perawat != '' || error_diagnosa != '') {
                return false;
            } else {
                $('#list_rekam_medis').removeClass('active active_tab1');
                $('#list_rekam_medis').removeAttr('href data-toggle');
                $('#rekam_medis').removeClass('active');
                $('#list_rekam_medis').addClass('inactive_tab1');
                $('#list_detail_tindakan').removeClass('inactive_tab1');
                $('#list_detail_tindakan').addClass('active_tab1 active');
                $('#list_detail_tindakan').attr('href', '#detail_tindakan');
                $('#list_detail_tindakan').attr('data-toggle', 'tab');
                $('#detail_tindakan').removeClass('fade');
                $('#detail_tindakan').addClass('active in');
            }
        });

        $('#previous_btn_tindakan').click(function() {
            $('#list_detail_tindakan').removeClass('active active_tab1');
            $('#list_detail_tindakan').removeAttr('href data-toggle');
            $('#detail_tindakan').removeClass('active in');
            $('#list_detail_tindakan').addClass('inactive_tab1');
            $('#list_rekam_medis').removeClass('inactive_tab1');
            $('#list_rekam_medis').addClass('active_tab1 active');
            $('#list_rekam_medis').attr('href', '#rekam_medis');
            $('#list_rekam_medis').attr('data-toggle', 'tab');
            $('#rekam_medis').addClass('active in');
        });

        $('#btn_detail_tindakan').click(function() {
            var error_tindakan = '';
            var error_biaya = '';
            if ($.trim($('#tindakan').val()).length == 0) {
                error_tindakan = 'Tindakan 1 wajib diisi';
                $('#error_tindakan').text(error_tindakan);
                $('#tindakan').addClass('has-error');
            } else {
                error_tindakan = '';
                $('#error_tindakan').text(error_tindakan);
                $('#tindakan').removeClass('has-error');
            }

            if ($.trim($('#biaya').val()).length == 0) {
                error_biaya = 'Biaya wajib diisi';
                $('#error_biaya').text(error_biaya);
                $('#biaya').addClass('has-error');
            } else {
                error_biaya = '';
                $('#error_biaya').text(error_biaya);
                $('#biaya').removeClass('has-error');
            }

            if ($.trim($('#tindakan2').val()).length != 0) {
                if ($.trim($('#biaya2').val()).length == 0) {
                    error_biaya2 = 'Biaya wajib diisi';
                    $('#error_biaya2').text(error_biaya2);
                    $('#biaya2').addClass('has-error');
                } else {
                    error_biaya2 = '';
                    $('#error_biaya2').text(error_biaya2);
                    $('#biaya2').removeClass('has-error');
                }
            } else {
                var biaya2 = '';
                $('#biaya2').val(biaya2);
            }

            if (error_tindakan != '' || error_biaya != '') {
                return false;
            } else {
                $('#list_detail_tindakan').removeClass('active active_tab1');
                $('#list_detail_tindakan').removeAttr('href data-toggle');
                $('#detail_tindakan').removeClass('active');
                $('#list_detail_tindakan').addClass('inactive_tab1');
                $('#list_detail_obat').removeClass('inactive_tab1');
                $('#list_detail_obat').addClass('active_tab1 active');
                $('#list_detail_obat').attr('href', '#detail_obat');
                $('#list_detail_obat').attr('data-toggle', 'tab');
                $('#detail_obat').removeClass('fade');
                $('#detail_obat').addClass('active in');
            }
        });

        $('#previous_btn_obat').click(function() {
            $('#list_detail_obat').removeClass('active active_tab1');
            $('#list_detail_obat').removeAttr('href data-toggle');
            $('#detail_obat').removeClass('active in');
            $('#list_detail_obat').addClass('inactive_tab1');
            $('#list_detail_tindakan').removeClass('inactive_tab1');
            $('#list_detail_tindakan').addClass('active_tab1 active');
            $('#list_detail_tindakan').attr('href', '#detail_tindakan');
            $('#list_detail_tindakan').attr('data-toggle', 'tab');
            $('#detail_tindakan').addClass('active in');
        });

        $('#btn_detail_obat').click(function() {
            var error_obat = '';
            var error_harga = '';
            var error_dosis = '';
            var error_jumlah = '';

            if ($.trim($('#obat').val()).length == 0) {
                error_obat = 'Obat 1 wajib diisi';
                $('#error_obat').text(error_obat);
                $('#obat').addClass('has-error');
                var harga = '';
                $('#harga').val(harga);
            } else {
                error_obat = '';
                $('#error_obat').text(error_obat);
                $('#obat').removeClass('has-error');
            }

            if ($.trim($('#harga').val()).length == 0) {
                error_harga = 'Harga wajib diisi';
                $('#error_harga').text(error_harga);
                $('#harga').addClass('has-error');
            } else {
                error_harga = '';
                $('#error_harga').text(error_harga);
                $('#harga').removeClass('has-error');
            }

            if ($.trim($('#dosis').val()).length == 0) {
                error_dosis = 'Dosis wajib diisi';
                $('#error_dosis').text(error_dosis);
                $('#dosis').addClass('has-error');
            } else {
                error_dosis = '';
                $('#error_dosis').text(error_dosis);
                $('#dosis').removeClass('has-error');
            }

            if ($.trim($('#jumlah').val()).length == 0) {
                error_jumlah = 'Jumlah wajib diisi';
                $('#error_jumlah').text(error_jumlah);
                $('#jumlah').addClass('has-error');
            } else {
                error_jumlah = '';
                $('#error_jumlah').text(error_jumlah);
                $('#jumlah').removeClass('has-error');
            }


            var error_harga2 = '';
            var error_dosis2 = '';
            var error_jumlah2 = '';
            if ($.trim($('#obat2').val()).length != 0) {
                if ($.trim($('#harga2').val()).length == 0) {
                    error_harga2 = 'Harga wajib diisi';
                    $('#error_harga2').text(error_harga2);
                    $('#harga2').addClass('has-error');
                } else {
                    error_harga2 = '';
                    $('#error_harga2').text(error_harga2);
                    $('#harga2').removeClass('has-error');
                }
                if ($.trim($('#dosis2').val()).length == 0) {
                    error_dosis2 = 'Dosis wajib diisi';
                    $('#error_dosis2').text(error_dosis2);
                    $('#dosis2').addClass('has-error');
                } else {
                    error_dosis2 = '';
                    $('#error_dosis2').text(error_dosis2);
                    $('#dosis2').removeClass('has-error');
                }
                if ($.trim($('#jumlah2').val()).length == 0) {
                    error_jumlah2 = 'Jumlah wajib diisi';
                    $('#error_jumlah2').text(error_jumlah2);
                    $('#jumlah2').addClass('has-error');
                } else {
                    error_jumlah2 = '';
                    $('#error_jumlah2').text(error_jumlah2);
                    $('#jumlah2').removeClass('has-error');
                }
            } else {
                var harga2 = '';
                var dosis2 = '';
                var jumlah2 = '';
                $('#harga2').val(harga2);
                $('#dosis2').val(dosis2);
                $('#jumlah2').val(jumlah2);
            }


            if (error_obat != '' || error_harga != '' || error_dosis != '' || error_jumlah != '' || error_harga2 != '' || error_dosis2 != '' || error_jumlah2 != '') {
                return false;
            } else {
                $('#transaksi_form').submit();
            }
        });
    });
</script>
<!-- <script>
    $(document).ready(function() {
        var id_tindakan1 = "<?php echo $detail_tindakan1['id_tindakan'] ?>";
        console.log(id_tindakan1);
        $('#tindakan').select2('data', {
            id: id_tindakan1
        });
    });
</script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#tindakan").select2({
            placeholder: 'Pilih salah satu',
            width: 'resolve',
            ajax: {
                url: '<?= base_url() ?>dtindakan/get_tindakan',
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
        $("#tindakan2").select2({
            placeholder: 'Pilih salah satu',
            width: 'resolve',
            ajax: {
                url: '<?= base_url() ?>dtindakan/get_tindakan',
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#tindakan').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('dtindakan/get_biaya'); ?>",
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
        $('#tindakan2').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('dtindakan/get_biaya'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    var html = data;
                    hasil = parseInt(html).toLocaleString(); //mengubah jadi currency
                    $('#biaya2').val(hasil);

                }
            });
            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#obat").select2({
            ajax: {
                url: '<?= base_url() ?>dobat/get_obat',
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
        $("#obat2").select2({
            ajax: {
                url: '<?= base_url() ?>dobat/get_obat',
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#obat').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('dobat/get_harga'); ?>",
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
        $('#obat2').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "<?php echo site_url('dobat/get_harga'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    var html = data;
                    hasil = parseInt(html).toLocaleString(); //mengubah jadi currency
                    $('#harga2').val(hasil);

                }
            });
            return false;
        });
    });
</script>
<script>
    $('#btn_detail_obat').click(function() {
        var biaya = $('#biaya').val();
        var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
        $('#biaya').val(hasil);

        var biaya2 = $('#biaya2').val();
        var hasil2 = parseFloat(biaya2.replace(/[^0-9-.]/g, ''));
        $('#biaya2').val(hasil2);

        var harga = $('#harga').val();
        var hasil = parseFloat(harga.replace(/[^0-9-.]/g, ''));
        $('#harga').val(hasil);

        var harga2 = $('#harga2').val();
        var hasil2 = parseFloat(harga2.replace(/[^0-9-.]/g, ''));
        $('#harga2').val(hasil2);
    });
</script>