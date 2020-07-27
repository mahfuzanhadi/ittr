<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <a href="<?php echo base_url('transaksi') ?>"><i class="fas fa-arrow-left"></i> Back</a>

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="card mb-3" style="height: 700px !important">
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
                <div class="tab-content" style="margin-top:16px">
                    <!-- Data Rekam Medis -->
                    <div class="tab-pane active" id="rekam_medis">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <input type="hidden" name="total_biaya_tindakan" value="0">
                                <input type="hidden" name="total_biaya_obat" value="0">
                                <input type="hidden" name="total_biaya_keseluruhan" value="0">
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="no_rekam_medis">No. Rekam Medis <font color="red">*</font></label>
                                        <input class="form-control form-control-sm" type="text" name="no_rekam_medis" id="no_rekam_medis" placeholder="No. Rekam Medis" onkeypress="javascript:return isNumber(event)" />
                                        <span id="error_no_rm" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="dokter">Dokter <font color="red">*</font></label>
                                        <select class="form-control form-control-sm" name="dokter" id="dokter">
                                            <option value="">Pilih Dokter</option>
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
                                        <select class="form-control form-control-sm" name="perawat" id="perawat">
                                            <option value="">Pilih Perawat</option>
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
                                        <input class="form-control form-control-sm" type="text" name="tanggal" id="picker" placeholder="Tanggal" value="<?= date('Y-m-d'); ?>" /> <small>(tahun-bulan-hari)</small>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                        <label>Jam Mulai</label>
                                        <input class="form-control form-control-sm" type="time" name="jam_mulai" placeholder="jam_mulai" value="<?= date('H:i'); ?>" />
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label>Keterangan</label>
                                        <textarea class="form-control form-control-sm" type="text" name="keterangan" placeholder="Keterangan"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm-3">
                                        <label for="metode_pembayaran">Metode Pembayaran</label>
                                        <select class="form-control  form-control-sm" id="metode_pembayaran" name="metode_pembayaran">
                                            <option value="">Pilih Metode Pembayaran</option>
                                            <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                            <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                            <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                            <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="foto_rontgen">Foto Rontgen</label>
                                        <input class="form-control-file" type="file" name="foto_rontgen" id="foto_rontgen" />
                                        <small class="form-text text-danger"><?= form_error('foto_rontgen'); ?></small>
                                    </div>
                                </div>
                                <div align="center">
                                    <button type="button" name="btn_rekam_medis" id="btn_rekam_medis" class="mt-auto btn btn-info btn-lg">Selanjutnya</button>
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
                                        <div class="form-group col-sm-3">
                                            <label>Diagnosa <font color="red">*</font></label>
                                            <input class="form-control form-control-sm" type="text" name="diagnosa[]" id="diagnosa" placeholder="Diagnosa" />
                                            <span id="error_diagnosa" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="tindakan">Tindakan <font color="red">*</font>
                                            </label>
                                            <select class="itemName js-states form-control" name="tindakan[]" id="tindakan"></select>
                                            <span id="error_tindakan" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <label>Biaya <font color="red">*</font></label>
                                            <input class="form-control form-control-sm" type="text" name="biaya[]" id="biaya" placeholder="Biaya" onkeypress="javascript:return isNumber(event)" />
                                            <span id="error_biaya" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-sm-1">
                                            <label style="color: #fff">x</label>
                                            <a href="javascript:void(0);" class="add_button btn btn-info btn-sm form-control form-control-sm" title="Add field"><i class="fas fa-plus"></i> Add Field</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <button type="button" name="previous_btn_tindakan" id="previous_btn_tindakan" class="btn btn-outline-info btn-lg">Sebelumnya</button>
                                <button type="button" name="btn_detail_tindakan" id="btn_detail_tindakan" class="mt-auto btn btn-info btn-lg">Selanjutnya</button>
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
                                                <label for="obat">Obat <font color="red">*</font>
                                                </label>
                                                <select class="itemName js-states form-control" name="obat[]" id="obat"></select>
                                                <span id="error_obat" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Harga <font color="red">*</font></label>
                                                <input class="form-control form-control-sm" type="text" name="harga[]" id="harga" placeholder="Harga" onkeypress="javascript:return isNumber(event)" />
                                                <span id="error_harga" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Dosis <font color="red">*</font></label>
                                                <input class="form-control form-control-sm" type="text" name="dosis[]" id="dosis" placeholder="Dosis" />
                                                <span id="error_dosis" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <label>Jumlah Obat <font color="red">*</font></label>
                                                <input class="form-control form-control-sm" type="text" name="jumlah[]" id="jumlah" placeholder="Jumlah Obat" />
                                                <span id="error_jumlah" class="text-danger"></span>
                                            </div>
                                            <div class="form-group col-sm-1">
                                                <label style="color: #fff">x</label>
                                                <a href="javascript:void(0);" class="add_button2 btn btn-info btn-sm form-control form-control-sm" title="Add field"><i class="fas fa-plus"></i> Add Field</a>
                                            </div>
                                        </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script src="<?php echo base_url('assets/js/is-number.js') ?>"></script>
<script src="<?php echo base_url('assets/js/datepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/js/transaksi-form-val.js') ?>"></script>

<!-- SCRIPT AMBIL DATA BIAYA TINDAKAN -->
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

<!-- SCRIPT IS_EXIST NO REKAM MEDIS -->
<script>
    $(document).ready(function() {
        $('#no_rekam_medis').keyup(function() {
            var no_rekam_medis = $('#no_rekam_medis').val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ?>transaksi/isExist",
                data: "no_rekam_medis=" + no_rekam_medis,
                success: function(response) {
                    if (response != '') {
                        $('#error_no_rm').text(response);
                        $('#no_rekam_medis').addClass('has-error');
                        $('#btn_rekam_medis').attr('disabled', true);
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

<!-- SCRIPT DYNAMIC FIELDS DETAIL TINDAKAN -->
<script>
    $(document).ready(function() {
        var max_fields = 6; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_button"); //Add button ID
        var x = 1; //initlal text box count
        // var field_html = ;

        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row' + x + '"><div class="form-row"><div class="form-group col-sm-3"><label>Diagnosa</label><input class="form-control form-control-sm" type="text" name="diagnosa[]" id="diagnosa' + x + '" placeholder="Diagnosa" /><span id="error_diagnosa" class="text-danger"></span></div><div class="form-group col-sm-4"><label for="tindakan">Tindakan</label><select class="itemName js-states form-control" name="tindakan[]" id="tindakan' + x + '"></select><span id="error_tindakan" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Biaya</label><input class="form-control form-control-sm" type="text" name="biaya[]" id="biaya' + x + '" placeholder="Biaya" onkeypress="javascript:return isNumber(event)" /><span id="error_biaya" class="text-danger"></span></div><div class="form-group col-sm-1"><label style="color: #fff">x</label><a href="#" class="remove_field btn btn-danger btn-sm form-control form-control-sm" id="' + x + '"><i class="fas fa-trash"></i> Remove</a></div></div></div>');
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

                        $('#biaya2').val(hasil);
                    }
                });
                return false;
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

                        $('#biaya3').val(hasil);
                    }
                });
                return false;
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

                        $('#biaya4').val(hasil);
                    }
                });
                return false;
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

                        $('#biaya5').val(hasil);
                    }
                });
                return false;
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

                        $('#biaya6').val(hasil);
                    }
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
                $(wrapper).append('<div class="row2' + x + '"><div class="form-row"><div class="form-group col-sm-4"><label for="obat">Obat</label><select class="itemName js-states form-control" name="obat[]" id="obat' + x + '"></select><span id="error_obat" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Harga</label><input class="form-control form-control-sm" type="text" name="harga[]" id="harga' + x + '" placeholder="Harga" onkeypress="javascript:return isNumber(event)" /><span id="error_harga" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Dosis</label><input class="form-control form-control-sm" type="text" name="dosis[]" id="dosis' + x + '" placeholder="Dosis" /> <span id="error_dosis" class="text-danger"></span></div><div class="form-group col-sm-2"><label>Jumlah Obat</label><input class="form-control form-control-sm" type="text" name="jumlah[]" id="jumlah' + x + '" placeholder="Jumlah Obat" /><span id="error_jumlah" class="text-danger"></span></div><div class="form-group col-sm-1"><label style="color: #fff">x</label><a href="#" class="remove_field2 btn btn-danger btn-sm form-control form-control-sm" id="' + x + '"><i class="fas fa-trash"></i> Remove</a></div></div></div>');
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
        });

        $(wrapper).on("click", ".remove_field2", function(e) { //user click on remove text
            e.preventDefault();
            var button_id = $(this).attr("id"); //ambil id button remove
            $('.row2' + button_id + '').remove(); //remove row
            x--;
        })
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