<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('transaksi') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- CARI PASIEN BERDASARKAN NO REKAM MEDIS -->
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

    <?php
    if ($transaksi['id_dokter'] !== $this->session->userdata('id')) {
        $previous_url = $this->session->userdata('previous_url');
        $this->session->set_flashdata('error', 'denied');
        redirect($previous_url);
    } else if ($transaksi['jumlah_bayar'] == $transaksi['total_biaya_keseluruhan']) {
        $previous_url = $this->session->userdata('previous_url');
        $this->session->set_flashdata('deny', 'denied');
        redirect($previous_url);
    }
    ?>

    <div class="card my-2">
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
                <div class="tab-content mt-4">
                    <div class="tab-pane active" id="rekam_medis">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">Data Rekam Medis</div> -->
                            <div class="panel-body">
                                <input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>" />
                                <input type="hidden" name="jam_selesai" value="<?= $transaksi['jam_selesai']; ?>" />
                                <input type="hidden" name="metode_pembayaran" value="<?= $transaksi['metode_pembayaran']; ?>" />
                                <input type="hidden" name="old_image" value="<?= $transaksi['foto_rontgen']; ?>" />
                                <input type="hidden" name="diskon" id="diskon" value="<?= $transaksi['diskon']; ?>">
                                <input type="hidden" name="jumlah_bayar" value="<?= $transaksi['jumlah_bayar']; ?>">
                                <input type="hidden" name="keterangan" id="keterangan" value="<?= $transaksi['keterangan']; ?>">
                                <input type="hidden" name="added_by" value="<?= $transaksi['added_by']; ?>">
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="no_rekam_medis">No. Rekam Medis <font color="red">*</font></label>
                                        <input class="form-control" type="text" name="no_rekam_medis" id="no_rekam_medis" placeholder="No. Rekam Medis" value="<?= $no_rekam_medis; ?>" onkeypress="javascript:return isNumber(event)" />
                                        <span id="error_no_rm" class="text-danger"></span>
                                        <span id="nama_pasien" class="text-success"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="dokter">Dokter <font color="red">*</font></label>
                                        <select class="custom-select custom-select-sm" name="dokter" id="dokter">
                                            <?php foreach ($dokter as $row) : ?>
                                                <?php if ($row->id_dokter == $transaksi['id_dokter']) : ?>
                                                    <option value="<?= $row->id_dokter; ?>" selected readonly="readonly"><?= $row->nama; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="error_dokter" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="perawat">Perawat <font color="red">*</font></label>
                                        <select class="custom-select custom-select-sm" name="perawat" id="perawat">
                                            <option value="" hidden>Pilih Perawat</option>
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
                                        <input class="form-control" type="text" name="tanggal" id="picker" placeholder="Tanggal" value="<?= $transaksi['tanggal']; ?>" readonly="readonly" /> <small>(tahun-bulan-hari)</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                        <label>Jam Mulai</label>
                                        <input class="form-control" type="time" name="jam_mulai" placeholder="jam_mulai" value="<?= $transaksi['jam_mulai']; ?>" readonly="readonly" />
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" type="text" name="keterangan" placeholder="Keterangan"><?= $transaksi['keterangan']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="foto_rontgen">Foto Rontgen</label>
                                        <input class="form-control-file" type="file" name="foto_rontgen" id="foto_rontgen" />
                                    </div>
                                </div>
                                <div align="center">
                                    <button type="button" name="btn_rekam_medis" id="btn_rekam_medis" class="btn btn-info btn-lg active" aria-pressed="true">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail_tindakan">
                        <!-- <div class="panel-heading">Isi Detail Tindakan</div> -->
                        <div class="panel-body">
                            <?php $i = 0; ?>
                            <?php foreach ($detail_tindakan as $dt) : ?>
                                <?php if ($dt->id_transaksi == $transaksi['id_transaksi']) : ?>
                                    <?php $id_tindakan = $dt->id_tindakan;
                                    $i++ ?>
                                    <input type="hidden" name="id_detail_tindakan[]" value="<?= $dt->id_detail_tindakan; ?>" />
                                    <div class="form-row">
                                        <div class="form-group col-sm-3">
                                            <label>Diagnosa</label>
                                            <input class="form-control" type="text" name="diagnosa[]" id="diagnosa<?= $i; ?>" placeholder="Diagnosa" value="<?= $dt->diagnosa; ?>" />
                                            <span id="error_diagnosa" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <?php foreach ((array) $tindakan as $t) : ?>
                                                <?php if ($t->id_tindakan == $id_tindakan) : ?>
                                                    <?php $nama_tindakan = $t->nama; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                            <label for="tindakan">Tindakan</label>
                                            <select class="itemName js-states form-control" name="tindakan[]" id="tindakan<?= $i; ?>">
                                                <option value="<?= $dt->id_tindakan; ?>"><?= $nama_tindakan; ?></option>
                                            </select>
                                            <span id="error_tindakan" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label>Biaya</label>
                                            <input class="form-control" type="text" name="biaya[]" id="biaya<?= $i; ?>" placeholder="Biaya" value="<?= $dt->biaya_tindakan; ?>" onkeypress="javascript:return isNumber(event)" />
                                            <span id="error_biaya" class="text-danger"></span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div align="center">
                                <button type="button" name="previous_btn_tindakan" id="previous_btn_tindakan" class="btn btn-outline-info btn-lg">Sebelumnya</button>
                                <button type="button" name="btn_detail_tindakan" id="btn_detail_tindakan" class="btn btn-info btn-lg active" aria-pressed="true">Selanjutnya</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail_obat">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">Isi Detail Obat</div> -->
                            <div class="panel-body">
                                <?php $j = 0; ?>
                                <?php foreach ($detail_obat as $do) : ?>
                                    <?php if ($do->id_transaksi == $transaksi['id_transaksi']) : ?>
                                        <?php $id_obat = $do->id_obat;
                                        $j++ ?>
                                        <input type="hidden" name="id_detail_biaya_obat[]" value="<?= $do->id_detail_biaya_obat; ?>" />
                                        <div class="form-row">
                                            <div class="form-group col-sm-4">
                                                <?php foreach ((array) $obat as $o) : ?>
                                                    <?php if ($o->id_obat == $id_obat) : ?>
                                                        <?php $nama_obat = $o->nama;
                                                        $harga_obat = $o->harga ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                                <label for="obat">Obat</label>
                                                <select class="itemName js-states form-control" name="obat[]" id="obat<?= $j; ?>">
                                                    <option value="<?= $do->id_obat; ?>"><?= $nama_obat; ?></option>
                                                </select>
                                                <span id="error_obat" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Harga</label>
                                                <input class="form-control" type="text" name="harga[]" id="harga<?= $j; ?>" placeholder="Harga" value="<?= $harga_obat; ?>" onkeypress="javascript:return isNumber(event)" />
                                                <span id="error_harga" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Dosis</label>
                                                <input class="form-control" type="text" name="dosis[]" id="dosis<?= $j; ?>" placeholder="Dosis" value="<?= $do->dosis; ?>" />
                                                <span id="error_dosis" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Jumlah Obat</label>
                                                <input type="number" class="form-control w-25" name="jumlah[]" id="jumlah<?= $j; ?>" step="1" placeholder="0" value="<?= $do->jumlah_obat; ?>" />
                                                <span id="error_jumlah" class="text-danger"></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div align="center">
                                    <button type="button" name="previous_btn_obat" id="previous_btn_obat" class="btn btn-outline-info btn-lg">Sebelumnya</button>
                                    <button type="button" name="btn_detail_obat" id="btn_detail_obat" class="btn btn-info btn-lg active" aria-pressed="true">Submit</button>
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

<!-- SCRIPT IS_EXIST NO REKAM MEDIS -->
<script>
    $(document).ready(function() {
        $('#no_rekam_medis').keyup(function() {
            var no_rekam_medis = $('#no_rekam_medis').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('transaksi/isExist') ?>",
                data: "no_rekam_medis=" + no_rekam_medis,
                success: function(response) {
                    if (response != '') {
                        $('#error_no_rm').text(response);
                        $('#no_rekam_medis').addClass('has-error');
                        $('#btn_rekam_medis').attr('disabled', true);
                        const kosong = '';
                        $('#nama_pasien').text(kosong);
                    } else {
                        error_no_rm = response;
                        $('#error_no_rm').text(error_no_rm);
                        $('#no_rekam_medis').removeClass('has-error');
                        $('#btn_rekam_medis').removeAttr('disabled');
                    }
                }
            });
        });
    });
</script>

<!-- SCRIPT GET NAMA PASIEN BY NO REKAM MEDIS -->
<script>
    $(document).ready(function() {
        $('#no_rekam_medis').change(function() {
            const no_rekam_medis = $('#no_rekam_medis').val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('transaksi/get_nama_pasien') ?>",
                data: "no_rekam_medis=" + no_rekam_medis,
                success: function(response) {
                    const nama_pasien = document.getElementById('nama_pasien');
                    if (response != '') {
                        nama_pasien.innerHTML = response;
                    } else {
                        const kosong = '';
                        nama_pasien.innerHTML = kosong;
                    }
                }
            });
        });
    });
</script>

<script>
    for (var i = 1; i < 7; i++) {
        var biaya = $('#biaya' + i).val();
        if (biaya != null) {
            var biaya_tindakan = new Intl.NumberFormat().format(biaya);

            $('#biaya' + i).val(biaya_tindakan);
        }
    }

    for (var i = 1; i < 7; i++) {
        var harga = $('#harga' + i).val();
        if (harga != null) {
            var harga_obat = new Intl.NumberFormat().format(harga);
            $('#harga' + i).val(harga_obat);
        }
    }
</script>

<!-- SCRIPT UBAH ANGKA FORMAT CURRENCY ONTYPE-->
<script>
    $('#biaya1').on('input', function() {
        var number, s_number, f_number;

        number = $('#biaya1').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#biaya1').val(f_number);
        }
    });
    $('#biaya2').on('input', function() {
        var number, s_number, f_number;

        number = $('#biaya2').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#biaya2').val(f_number);
        }
    });
    $('#biaya3').on('input', function() {
        var number, s_number, f_number;

        number = $('#biaya3').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#biaya3').val(f_number);
        }
    });
    $('#biaya4').on('input', function() {
        var number, s_number, f_number;

        number = $('#biaya4').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#biaya1').val(f_number);
        }
    });
    $('#biaya5').on('input', function() {
        var number, s_number, f_number;

        number = $('#biaya5').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#biaya1').val(f_number);
        }
    });
    $('#biaya6').on('input', function() {
        var number, s_number, f_number;

        number = $('#biaya6').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#biaya6').val(f_number);
        }
    });

    $('#harga1').on('input', function() {
        var number, s_number, f_number;

        number = $('#harga1').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#harga1').val(f_number);
        }
    });
    $('#harga2').on('input', function() {
        var number, s_number, f_number;

        number = $('#harga2').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#harga2').val(f_number);
        }
    });
    $('#harga3').on('input', function() {
        var number, s_number, f_number;

        number = $('#harga3').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#harga3').val(f_number);
        }
    });
    $('#harga4').on('input', function() {
        var number, s_number, f_number;

        number = $('#harga4').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#harga4').val(f_number);
        }
    });
    $('#harga5').on('input', function() {
        var number, s_number, f_number;

        number = $('#harga5').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#harga5').val(f_number);
        }
    });
    $('#harga6').on('input', function() {
        var number, s_number, f_number;

        number = $('#harga6').val();
        if (number != null) {
            s_number = number.replace(/,/g, '');
            f_number = formatNumber(s_number);

            $('#harga6').val(f_number);
        }
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>

<!-- SCRIPT FETCH DATA TINDAKAN KE SELECT -->
<script type="text/javascript">
    $(document).ready(function() {
        for (var i = 1; i < 7; i++) {
            $('#tindakan' + i).select2({
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
        }
    });
</script>

<!-- SCRIPT AMBIL BIAYA SETELAH PILIH TINDAKAN -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#tindakan1').change(function() {
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
                    $('#biaya1').val(hasil);

                }
            });
            return false;
        });
        $('#tindakan2').change(function() {
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
                    $('#biaya2').val(hasil);

                }
            });
            return false;
        });
        $('#tindakan3').change(function() {
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
                    $('#biaya3').val(hasil);

                }
            });
            return false;
        });
        $('#tindakan4').change(function() {
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
                    $('#biaya4').val(hasil);

                }
            });
            return false;
        });
        $('#tindakan5').change(function() {
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
                    $('#biaya5').val(hasil);

                }
            });
            return false;
        });
        $('#tindakan6').change(function() {
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
                    $('#biaya6').val(hasil);

                }
            });
            return false;
        });
    });
</script>

<!-- SCRIPT FETCH DATA OBAT KE SELECT -->
<script type="text/javascript">
    $(document).ready(function() {
        for (var i = 1; i < 7; i++) {
            $('#obat' + i).select2({
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
        }
    });
</script>

<!-- SCRIPT AMBIL HARGA SETELAH PILIH OBAT -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#obat1').change(function() {
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
                    $('#harga1').val(hasil);

                }
            });
            return false;
        });
        $('#obat2').change(function() {
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
                    $('#harga2').val(hasil);

                }
            });
            return false;
        });
        $('#obat3').change(function() {
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
                    $('#harga3').val(hasil);

                }
            });
            return false;
        });
        $('#obat4').change(function() {
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
                    $('#harga4').val(hasil);

                }
            });
            return false;
        });
        $('#obat5').change(function() {
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
                    $('#harga5').val(hasil);

                }
            });
            return false;
        });
        $('#obat6').change(function() {
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
                    $('#harga6').val(hasil);

                }
            });
            return false;
        });
    });
</script>

<!-- SCRIPT HILANGIN KOMA DI BIAYA TINDAKAN DAN HARGA OBAT -->
<script>
    $('#btn_detail_obat').click(function() {
        for (i = 1; i < 7; i++) {
            var biaya = $('#biaya' + i).val();
            if (biaya != null) {
                var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
                $('#biaya' + i).val(hasil);
            }

            var harga = $('#harga' + i).val();
            if (harga != null) {
                var hasil = parseFloat(harga.replace(/[^0-9-.]/g, ''));
                $('#harga' + i).val(hasil);
            }
        }
    });
</script>

<!-- SCRIPT FORM VALIDATION -->
<script>
    $(document).ready(function() {
        $('#btn_rekam_medis').click(function() {
            var error_no_rm = '';
            var error_dokter = '';
            var error_perawat = '';

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

            if (error_no_rm != '' || error_dokter != '' || error_perawat != '') {
                return false;
                // if (error_no_rm == '') {
                //     return false;
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
            var error_diagnosa = '';

            if ($.trim($('#tindakan1').val()).length == 0) {
                error_tindakan = 'Tindakan wajib diisi';
                $('#error_tindakan').text(error_tindakan);
                $('#tindakan1').addClass('has-error');
            } else {
                error_tindakan = '';
                $('#error_tindakan').text(error_tindakan);
                $('#tindakan1').removeClass('has-error');
            }

            if ($.trim($('#diagnosa1').val()).length == 0) {
                error_diagnosa = 'Diagnosa wajib diisi';
                $('#error_diagnosa').text(error_diagnosa);
                $('#diagnosa1').addClass('has-error');
            } else {
                error_diagnosa = '';
                $('#error_diagnosa').text(error_diagnosa);
                $('#diagnosa1').removeClass('has-error');
            }

            if ($.trim($('#biaya1').val()).length == 0) {
                error_biaya = 'Biaya wajib diisi';
                $('#error_biaya').text(error_biaya);
                $('#biaya1').addClass('has-error');
            } else {
                error_biaya = '';
                $('#error_biaya').text(error_biaya);
                $('#biaya1').removeClass('has-error');
            }

            if (error_tindakan != '' || error_biaya != '' || error_diagnosa != '') {
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
            $('#transaksi_form').submit();
        });
    });
</script>