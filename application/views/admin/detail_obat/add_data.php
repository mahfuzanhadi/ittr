<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    $last_transaksi = $this->Dobat_model->get_last_transaksi();
    foreach ($last_transaksi as $last) {
        $last;
    }
    ?>
    <!-- Page Heading -->

    <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <div class="card mb-3">
        <div class="card-header">
            <b class="text-gray-800"><?= $title; ?></b>
        </div>
        <div class="card-body">
            <form action="" method="post">
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
                        <small class="form-text text-danger"><?= form_error('obat'); ?></small>
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Harga<font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="harga" id="harga" placeholder="Harga" />
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Dosis</label>
                        <input class="form-control form-control-sm" type="text" name="dosis" id="dosis" placeholder="Dosis" />
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Jumlah Obat</label>
                        <input class="form-control form-control-sm" type="text" name="jumlah_obat" id="jumlah_obat" placeholder="Jumlah Obat" />
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
                        <input class="form-control form-control-sm harga" type="text" name="harga2" id="harga2" placeholder="Harga" />
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Dosis</label>
                        <input class="form-control form-control-sm" type="text" name="dosis2" id="dosis2" placeholder="Dosis" />
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Jumlah Obat</label>
                        <input class="form-control form-control-sm" type="text" name="jumlah_obat2" id="jumlah_obat2" placeholder="Jumlah Obat" />
                    </div>
                </div>
                <a class="btn btn-primary" href="<?php echo base_url('dtindakan/edit/') . $last ?>">Previous</a>
                <button class="btn btn-primary" type="submit" name="tambah">Save</button>
            </form>
        </div>
        <div class="card-footer small text-muted">
            <font color="red">*</font> wajib diisi
        </div>

    </div>
</div>
</div>
<!-- /.container-fluid -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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
                    $('#harga').val(html);

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
                    $('#harga2').val(html);

                }
            });
            return false;
        });
    });
</script>