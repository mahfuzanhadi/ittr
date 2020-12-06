<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('transaksi') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card my-2">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form method="post" id="transaksi_form" enctype="multipart/form-data">
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
                    <!-- Data Rekam Medis -->
                    <div class="tab-pane active" id="rekam_medis">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <input type="hidden" name="total_biaya_tindakan" value="0">
                                <input type="hidden" name="total_biaya_obat" value="0">
                                <input type="hidden" name="total_biaya_keseluruhan" value="0">
                                <input type="hidden" name="diskon" id="diskon" value="0">
                                <input type="hidden" name="sisa" value="0">
                                <input type="hidden" name="keterangan" id="keterangan" value="">
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="no_rekam_medis">No. Rekam Medis <font color="red">*</font></label>
                                        <input class="form-control" type="text" name="no_rekam_medis" id="no_rekam_medis" placeholder="No. Rekam Medis" onkeypress="javascript:return isNumber(event)" />
                                        <span id="error_no_rm" class="text-danger"></span>
                                        <span id="nama_pasien" class="text-success"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="dokter">Dokter <font color="red">*</font></label>
                                        <select class="custom-select custom-select-sm" name="dokter" id="dokter">
                                            <option value="" hidden>Pilih Dokter</option>
                                            <?php
                                            foreach ($dokter as $row) {
                                                echo '<option value="' . $row->id_dokter . '" ' . set_select('dokter', $row->id_dokter) . '> ' . $row->nama . ' </option>';
                                            } ?>
                                        </select>
                                        <span id="error_dokter" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="perawat">Perawat <font color="red">*</font></label>
                                        <select class="custom-select custom-select-sm" name="perawat" id="perawat">
                                            <option value="" hidden>Pilih Perawat</option>
                                            <?php
                                            foreach ($perawat as $row) {
                                                echo '<option value="' . $row->id_perawat . '" ' . set_select('perawat', $row->id_perawat) . '> ' . $row->nama . ' </option>';
                                            } ?>
                                        </select>
                                        <span id="error_perawat" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                        <label>Tanggal</label>
                                        <input class="form-control" type="text" name="tanggal" id="picker" placeholder="Tanggal" value="<?= date('Y-m-d'); ?>" /> <small>(tahun-bulan-hari)</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                        <label>Jam Mulai</label>
                                        <input class="form-control" type="time" name="jam_mulai" placeholder="jam_mulai" value="<?= date('H:i'); ?>" />
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="foto_rontgen">Foto Rontgen</label>
                                        <input class="form-control-file" type="file" name="foto_rontgen" id="foto_rontgen" />
                                        <small class="form-text text-danger"><?= form_error('foto_rontgen'); ?></small>
                                    </div>
                                </div>
                                <div align="center">
                                    <button type="button" name="btn_rekam_medis" id="btn_rekam_medis" class="mt-auto btn btn-info btn-lg active" aria-pressed="true">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Isi Detail Tindakan -->
                    <div class="tab-pane fade" id="detail_tindakan">
                        <div class="panel-body">
                            <div class="input_fields_wrap">
                                <div>
                                    <div class="form-row">
                                        <div class="form-group col-sm-2">
                                            <label>Diagnosa <font color="red">*</font></label>
                                            <textarea class="form-control" type="text" name="diagnosa[]" id="diagnosa" placeholder="Diagnosa"></textarea>
                                            <span id="error_diagnosa" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="tindakan">Tindakan <font color="red">*</font>
                                            </label>
                                            <select class="itemName js-states form-control" name="tindakan[]" id="tindakan"></select>
                                            <span id="error_tindakan" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label>Rincian Tindakan</label>
                                            <textarea class="form-control" type="text" name="rincian[]" id="rincian" placeholder="Rincian Tindakan"></textarea>
                                            <span id="error_rincian" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-1">
                                            <label>Biaya <font color="red">*</font></label>
                                            <input class="form-control" type="text" name="biaya[]" id="biaya" placeholder="Biaya" onkeypress="javascript:return isNumber(event)" />
                                            <span id="error_biaya" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-1">
                                            <label style="color: #fff">x</label>
                                            <a href="javascript:void(0);" class="add_button btn btn-info btn-sm form-control" title="Add field"><i class="fas fa-plus"></i> Add Field</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <button type="button" name="previous_btn_tindakan" id="previous_btn_tindakan" class="btn btn-outline-info btn-lg">Sebelumnya</button>
                                <button type="button" name="btn_detail_tindakan" id="btn_detail_tindakan" class="mt-auto btn btn-info btn-lg active" aria-pressed="true">Selanjutnya</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="detail_obat">
                        <!-- Isi Detail Obat -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="input_fields_wrap2">
                                    <div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-4">
                                                <label for="obat">Obat</label>
                                                <select class="itemName js-states form-control" name="obat[]" id="obat"></select>
                                                <span id="error_obat" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Harga</label>
                                                <input class="form-control" type="text" name="harga[]" id="harga" placeholder="Harga" onkeypress="javascript:return isNumber(event)" />
                                                <span id="error_harga" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Aturan Pakai</label>
                                                <input class="form-control" type="text" name="dosis[]" id="dosis" placeholder="Aturan Pakai" />
                                                <span id="error_dosis" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Jumlah Obat</label>
                                                <input type="number" class="form-control w-25" name="jumlah[]" id="jumlah" step="1" min="0" max="10" placeholder="0" />
                                                <span id="error_jumlah" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-1">
                                                <label style="color: #fff">x</label>
                                                <a href="javascript:void(0);" class="add_button2 btn btn-info btn-sm form-control" title="Add field"><i class="fas fa-plus"></i> Add Field</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <!-- MODAL REVIEW TRANSAKSI -->
    <div id="reviewModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form method="post" id="myForm" action="<?= base_url('transaksi/update_transaksi'); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Review Data Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Nomor Rekam Medis</label>
                                <p id="no_rm"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Nama Pasien</label>
                                <p id="nama"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Tanggal</label>
                                <p id="tanggal_transaksi"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Dokter</label>
                                <p id="doctor"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Perawat</label>
                                <p id="nurse"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold;">Diagnosa</label>
                                <p id="diagnose"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold;">Tindakan</label>
                                <p id="tindakans"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold;">Obat</label>
                                <p id="obats"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Total Biaya Tindakan</label>
                                <p id="biaya_tindakan"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Total Biaya Obat</label>
                                <p id="biaya_obat"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="discount" style="font-weight: bold">Diskon</label> <span id="jenis_diskon"></span>
                                <input class="form-control w-50" type="text" name="discount" id="discount" placeholder="Diskon" onkeypress="javascript:return isNumber(event)" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="ket" style="font-weight: bold">Keterangan</label>
                                <textarea class="form-control" type="text" id="ket" placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" name="update" id="update" class="btn btn-info active" aria-pressed="true">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script src="<?php echo base_url('assets/js/is-number.js') ?>"></script>
<script src="<?php echo base_url('assets/js/datepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/js/transaksi-form-val.js') ?>"></script>
<script src="<?php echo base_url('assets/js/review-transaksi.js') ?>"></script>

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

<!-- SCRIPT UBAH ANGKA MENJADI BERKOMA -->
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

    $('#discount').on('input', function() {
        var number, s_number, f_number;

        number = $('#discount').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        $('#discount').val(f_number);
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>

<!-- SCRIPT FETCH DATA TINDAKAN KE SELECT -->
<script>
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
<script>
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
                    document.getElementById('biaya').value = hasil;

                }
            });
            return false;
        });
    });
</script>

<!-- SCRIPT FETCH DATA OBAT KE SELECT -->
<script>
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
<script>
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
                    document.getElementById('harga').value = hasil;

                }
            });
            return false;
        });
    });
</script>

<!-- SCRIPT DYNAMIC FIELDS DETAIL TINDAKAN -->
<script>
    $(document).ready(function() {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_button"); //Add button ID
        var x = 1; //initlal text box count
        // var field_html = ;

        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row' + x + '"><div class="form-row"><div class="form-group col-sm-2"><label>Diagnosa</label><textarea class="form-control" type="text" name="diagnosa[]" id="diagnosa' + x + '"  placeholder="Diagnosa"></textarea><span id="error_diagnosa" class="text-danger"></span></div><div class="form-group col-sm-4"><label for="tindakan">Tindakan</label><select class="itemName js-states form-control" name="tindakan[]" id="tindakan' + x + '"></select><span id="error_tindakan" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Rincian Tindakan</label><textarea class="form-control" type="text" name="rincian[]" id="rincian' + x + '" placeholder="Rincian Tindakan"></textarea><span id="error_rincian" class="text-danger"></span></div><div class="form-group col-sm-1"><label>Biaya</label><input class="form-control" type="text" name="biaya[]" id="biaya' + x + '" placeholder="Biaya" onkeypress="javascript:return isNumber(event)" /><span id="error_biaya" class="text-danger"></span></div><div class="form-group col-sm-1"><label style="color: #fff">x</label><a href="#" class="remove_field btn btn-danger btn-sm form-control" id="' + x + '"><i class="fas fa-trash"></i> Remove</a></div></div></div>');
            }

            $("#tindakan2").select2({
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
                        document.getElementById('biaya2').value = hasil;
                    }
                });
                return false;
            });
            $('#biaya2').on('input', function() {
                var number, s_number, f_number;

                number = $('#biaya2').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#biaya2').val(f_number);
            });

            $("#tindakan3").select2({
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
                        document.getElementById('biaya3').value = hasil;
                    }
                });
                return false;
            });
            $('#biaya3').on('input', function() {
                var number, s_number, f_number;

                number = $('#biaya3').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#biaya3').val(f_number);
            });

            $("#tindakan4").select2({
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
                        document.getElementById('biaya4').value = hasil;
                    }
                });
                return false;
            });
            $('#biaya4').on('input', function() {
                var number, s_number, f_number;

                number = $('#biaya4').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#biaya4').val(f_number);
            });

            $("#tindakan5").select2({
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
                        document.getElementById('biaya5').value = hasil;
                    }
                });
                return false;
            });
            $('#biaya5').on('input', function() {
                var number, s_number, f_number;

                number = $('#biaya5').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#biaya5').val(f_number);
            });

            $("#tindakan6").select2({
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
                        document.getElementById('biaya6').value = hasil;
                    }
                });
                $('#biaya6').on('input', function() {
                    var number, s_number, f_number;

                    number = $('#biaya6').val();
                    s_number = number.replace(/,/g, '');
                    f_number = formatNumber(s_number);

                    $('#biaya6').val(f_number);
                });
                return false;
            });

            $("#tindakan7").select2({
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
            $('#tindakan7').change(function() {
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
                        document.getElementById('biaya7').value = hasil;
                    }
                });
                $('#biaya7').on('input', function() {
                    var number, s_number, f_number;

                    number = $('#biaya7').val();
                    s_number = number.replace(/,/g, '');
                    f_number = formatNumber(s_number);

                    $('#biaya7').val(f_number);
                });
                return false;
            });

            $("#tindakan8").select2({
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
            $('#tindakan8').change(function() {
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
                        document.getElementById('biaya8').value = hasil;
                    }
                });
                $('#biaya8').on('input', function() {
                    var number, s_number, f_number;

                    number = $('#biaya8').val();
                    s_number = number.replace(/,/g, '');
                    f_number = formatNumber(s_number);

                    $('#biaya8').val(f_number);
                });
                return false;
            });

            $("#tindakan9").select2({
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
            $('#tindakan9').change(function() {
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
                        document.getElementById('biaya9').value = hasil;
                    }
                });
                $('#biaya9').on('input', function() {
                    var number, s_number, f_number;

                    number = $('#biaya9').val();
                    s_number = number.replace(/,/g, '');
                    f_number = formatNumber(s_number);

                    $('#biaya9').val(f_number);
                });
                return false;
            });

            $("#tindakan10").select2({
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
            $('#tindakan10').change(function() {
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
                        document.getElementById('biaya10').value = hasil;
                    }
                });
                $('#biaya10').on('input', function() {
                    var number, s_number, f_number;

                    number = $('#biaya10').val();
                    s_number = number.replace(/,/g, '');
                    f_number = formatNumber(s_number);

                    $('#biaya10').val(f_number);
                });
                return false;
            });
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            var button_id = $(this).attr("id"); //ambil id button remove
            $('.row' + button_id + '').remove(); //remove row
            x--;
        })
    });
</script>

<!-- SCRIPT DYNAMIC FIELDS DETAIL OBAT -->
<script>
    $(document).ready(function() {
        var max_fields = 6; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap2"); //Fields wrapper
        var add_button = $(".add_button2"); //Add button ID
        var x = 1; //initlal text box count
        // var field_html = ;

        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row2' + x + '"><div class="form-row"><div class="form-group col-sm-4"><label for="obat">Obat</label><select class="itemName js-states form-control" name="obat[]" id="obat' + x + '"></select><span id="error_obat" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Harga</label><input class="form-control" type="text" name="harga[]" id="harga' + x + '" placeholder="Harga" onkeypress="javascript:return isNumber(event)" /><span id="error_harga" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Aturan Pakai</label><input class="form-control" type="text" name="dosis[]" id="dosis' + x + '" placeholder="Aturan Pakai" /> <span id="error_dosis' + x + '" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Jumlah Obat</label><input class="form-control w-25" type="number" name="jumlah[]" id="jumlah' + x + '" placeholder="0" /><span id="error_jumlah' + x + '" class="text-danger"></span></div><div class="form-group col-sm-1"><label style="color: #fff">x</label><a href="#" class="remove_field2 btn btn-danger btn-sm form-control" id="' + x + '"><i class="fas fa-trash"></i> Remove</a></div></div></div>');
            }

            $("#obat2").select2({
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
            $('#harga2').on('input', function() {
                var number, s_number, f_number;

                number = $('#harga2').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#harga2').val(f_number);
            });

            $("#obat3").select2({
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
            $('#harga3').on('input', function() {
                var number, s_number, f_number;

                number = $('#harga3').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#harga3').val(f_number);
            });

            $("#obat4").select2({
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
            $('#harga4').on('input', function() {
                var number, s_number, f_number;

                number = $('#harga4').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#harga4').val(f_number);
            });

            $("#obat5").select2({
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
            $('#harga5').on('input', function() {
                var number, s_number, f_number;

                number = $('#harga5').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#harga5').val(f_number);
            });

            $("#obat6").select2({
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
            $('#harga6').on('input', function() {
                var number, s_number, f_number;

                number = $('#harga6').val();
                s_number = number.replace(/,/g, '');
                f_number = formatNumber(s_number);

                $('#harga6').val(f_number);
            });
        });

        $(wrapper).on("click", ".remove_field2", function(e) { //user click on remove text
            e.preventDefault();
            var button_id = $(this).attr("id"); //ambil id button remove
            $('.row2' + button_id + '').remove(); //remove row
            x--;
        })
    });
</script>