<!-- Begin Page Content -->
<div class="container-fluid">

    <?php
    $last_transaksi = $this->Dtindakan_model->get_last_transaksi();
    foreach ($last_transaksi as $last) {
        $last;
    }
    ?>
    <!-- Page Heading -->
    <!-- <a href="<?php echo base_url('transaksi/edit/') . $last ?>"><i class="fas fa-arrow-left"></i> Back</a> -->

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
                        <label for="tindakan">Tindakan 1<font color="red">*</font></label>
                        <select class="itemName form-control form-control-sm" name="tindakan" id="tindakan">
                            <option value="">Choose one</option>
                            <?php
                            foreach ($tindakan as $row) {
                                echo '<option value="' . $row->id_tindakan . '" ' . set_select('tindakan', $row->id_tindakan) . '> ' . $row->nama . ' </option>';
                            } ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('tindakan'); ?></small>
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Biaya<font color="red">*</font></label>
                        <input class="form-control form-control-sm" type="text" name="biaya" id="biaya" placeholder="Biaya" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="tindakan2">Tindakan 2 (kosongkan jika tidak ada)</label>
                        <select class="itemName form-control form-control-sm" name="tindakan2" id="tindakan2">
                            <option value="">Choose one</option>
                            <?php
                            foreach ($tindakan as $row) {
                                echo '<option value="' . $row->id_tindakan . '" ' . set_select('tindakan', $row->id_tindakan) . '> ' . $row->nama . ' </option>';
                            } ?>
                        </select>
                        <small class="form-text text-danger"><?= form_error('tindakan2'); ?></small>
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Biaya</label>
                        <input class="form-control form-control-sm biaya" type="text" name="biaya2" id="biaya2" placeholder="Biaya" />
                    </div>
                </div>
                <a class="btn btn-primary" href="<?php echo base_url('transaksi/edit/') . $last ?>">Previous</a>
                <button class="btn btn-primary" type="submit" name="tambah" id="tambah">Next</button>
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
        $("#tindakan").select2({
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
                    hasil = parseInt(html).toLocaleString();
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
                    $('#biaya2').val(html);

                }
            });
            return false;
        });
    });
</script>
<script>
    $('#tambah').click(function() {
        var biaya = $('#biaya').val();
        var hasil = parseFloat(biaya.replace(/[^0-9-.]/g, ''));
        $('#biaya').val(hasil);
    });
</script>
<!-- <script type="text/javascript">
    $('#biaya').on('input', function() {

        var number, s_number, f_number;

        number = $('#biaya').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        console.info(f_number);
        $('#biaya').val(f_number);
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script> -->