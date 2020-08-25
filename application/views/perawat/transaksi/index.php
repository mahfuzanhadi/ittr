<script type="text/javascript">
    var save_method;

    function delete_data(id) {
        bootbox.confirm("Anda yakin ingin menghapus data ini?", function(result) {
            if (result)
                $.ajax({
                    url: "<?= base_url('transaksi/delete/'); ?>" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        bootbox.alert("Data berhasil dihapus!", function() {
                            location.reload();
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        bootbox.alert('Gagal menghapus data!');
                    }
                });
        });
    }
</script>

<!-- DETAIL DATA TRANSAKSI -->
<script>
    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('transaksi/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#no_rekam_medis').text(data.no_rekam_medis);
                $('#nama').text(data.nama_pasien);

                var date = new Date(data.tanggal);
                var tahun = date.getFullYear();
                var bulan = date.getMonth();
                var tanggal = date.getDate();
                switch (bulan) {
                    case 0:
                        bulan = "Januari";
                        break;
                    case 1:
                        bulan = "Februari";
                        break;
                    case 2:
                        bulan = "Maret";
                        break;
                    case 3:
                        bulan = "April";
                        break;
                    case 4:
                        bulan = "Mei";
                        break;
                    case 5:
                        bulan = "Juni";
                        break;
                    case 6:
                        bulan = "Juli";
                        break;
                    case 7:
                        bulan = "Agustus";
                        break;
                    case 8:
                        bulan = "September";
                        break;
                    case 9:
                        bulan = "Oktober";
                        break;
                    case 10:
                        bulan = "November";
                        break;
                    case 11:
                        bulan = "Desember";
                        break;
                }
                var tgl = tanggal + ' ' + bulan + ' ' + tahun;

                $('#tanggal').text(tgl);

                var biaya_tindakan = new Intl.NumberFormat(['ban', 'id']).format(data.total_biaya_tindakan);
                var total_tindakan = 'Rp. ' + biaya_tindakan;
                $('#total_biaya_tindakan').text(total_tindakan);
                var biaya_obat = new Intl.NumberFormat(['ban', 'id']).format(data.total_biaya_obat);
                var total_obat = 'Rp. ' + biaya_obat;
                $('#total_biaya_obat').text(total_obat);
                var biaya_keseluruhan = new Intl.NumberFormat(['ban', 'id']).format(data.total_biaya_keseluruhan);
                var total_keseluruhan = 'Rp. ' + biaya_keseluruhan;
                $('#total_biaya_keseluruhan').text(total_keseluruhan);

                if (data.metode_pembayaran != 0 && data.jumlah_bayar < data.total_biaya_keseluruhan) {
                    $('#status_pembayaran').text('Belum lunas');
                    $('#status_pembayaran').css('color', 'orange');
                    $('#metode_pembayaran').removeAttr('disabled');
                    $('#jumlah_bayar').removeAttr('disabled');
                    $('#update').removeAttr('disabled');
                } else if (data.metode_pembayaran != 0 && data.jumlah_bayar >= data.total_biaya_keseluruhan) {
                    $('#status_pembayaran').text('Lunas');
                    $('#status_pembayaran').css('color', 'green');
                    $('#metode_pembayaran').attr('disabled', true);
                    $('#jumlah_bayar').attr('disabled', true);
                    $('#update').attr('disabled', true);
                } else {
                    $('#status_pembayaran').text('Belum melakukan pembayaran!');
                    $('#status_pembayaran').css('color', 'red');
                    $('#metode_pembayaran').removeAttr('disabled');
                    $('#jumlah_bayar').removeAttr('disabled');
                    $('#update').removeAttr('disabled');
                }

                if (data.diskon > 100) {
                    var diskon = new Intl.NumberFormat(['ban', 'id']).format(data.diskon);
                    $('#diskon').text('Rp. ' + diskon);
                } else {
                    $('#diskon').text(data.diskon + '%');
                }
                $('#keterangan').text(data.keterangan);

                var jumlah_bayar = new Intl.NumberFormat().format(data.jumlah_bayar);
                $('#jumlah_bayar').val(jumlah_bayar);
                $('#metode_pembayaran').val(data.metode_pembayaran);
                $('#added_by').text(data.added_by);

                $('#myModal').modal('show');
                $('#id_transaksi').val(data.id_transaksi);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data');
            }
        });
    }
</script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data transaksi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->
    <h3 class="h3 mb-4 text-gray-800"><?= $title; ?></h3>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <a href="<?= base_url('transaksi/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Total Biaya Tindakan</th>
                            <th>Total Biaya Obat</th>
                            <th>Diskon</th>
                            <th>Total Biaya Keseluruhan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <form method="post" id="myForm" action="<?= base_url('transaksi/update_transaksi'); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Biaya Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="no_rekam_medis" style="font-weight: bold">Nomor Rekam Medis</label>
                                <p id="no_rekam_medis"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="name" style="font-weight: bold">Nama</label>
                                <p id="nama"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tanggal" style="font-weight: bold">Tanggal</label>
                                <p id="tanggal"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="total_biaya_tindakan" style="font-weight: bold">Total Biaya Tindakan</label>
                                <p id="total_biaya_tindakan"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="total_biaya_obat" style="font-weight: bold">Total Biaya Obat</label>
                                <p id="total_biaya_obat"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="total_biaya_keseluruhan" style="font-weight: bold">Total Biaya Keseluruhan</label>
                                <p id="total_biaya_keseluruhan"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Diskon</label>
                                <p id="diskon"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Keterangan</label>
                                <p id="keterangan"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="jumlah_bayar" style="font-weight: bold">Jumlah Bayar</label>
                                <input type="text" class="form-control w-50" name="jumlah_bayar" id="jumlah_bayar" placeholder="Jumlah Bayar" onkeypress="javascript:return isNumber(event)" />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="metode_pembayaran" style="font-weight: bold">Metode Pembayaran</label>
                                <select class="custom-select custom-select-sm" id="metode_pembayaran" name="metode_pembayaran">
                                    <option value="0" selected hidden>Pilih Metode Pembayaran</option>
                                    <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                    <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                    <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                    <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                                </select>
                                <span id="error_metode_pembayaran" class="text-danger"></span>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="status_pembayaran" style="font-weight: bold">Status Pembayaran</label>
                                <p id="status_pembayaran"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label style="font-weight: bold">Diterima oleh</label>
                                <p id="added_by"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" name="update" id="update" class="btn btn-success"><i class="fas fa-edit"></i> Update</button>
                            <input type="hidden" name="id_transaksi" id="id_transaksi" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "order": [],
            "lengthMenu": [20, 50, 100],
            "ajax": {
                url: "<?= base_url('transaksi/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 6, 7],
                    "orderable": false
                },
                {
                    "width": "30px",
                    "className": "text-left",
                    "targets": 0
                },
                {
                    "width": "40px",
                    "targets": 1
                },
                {
                    "width": "95px",
                    "targets": 2,
                },
                {
                    "width": "55px",
                    "targets": 3
                },
                {
                    "width": "160px",
                    "targets": 4
                },
                {
                    "width": "180px",
                    "targets": 5
                },
                {
                    "width": "160px",
                    "targets": 6
                },
                {
                    "width": "180px",
                    "targets": 7
                },
                {
                    "width": "80px",
                    "targets": 8,
                    "render": $.fn.dataTable.render.number('.')
                },
                {
                    "width": "80px",
                    "targets": 9,
                    "render": $.fn.dataTable.render.number('.')
                },
                {
                    "width": "80px",
                    "targets": 10,
                    "render": function(data) {
                        if (data > 100) {
                            return $.fn.dataTable.render.number('.').display(data);
                        } else if (data == 0) {
                            return data;
                        } else {
                            return data + '%';
                        }
                    }
                },
                {
                    "width": "90px",
                    "targets": 11,
                    "render": $.fn.dataTable.render.number('.')
                },
                {
                    "width": "90px",
                    "targets": 12
                },
            ]
        });
    });
</script>

<!-- SCRIPT UBAH ANGKA MENJADI BERKOMA -->
<script>
    $('#jumlah_bayar').on('input', function() {
        var number, s_number, f_number;

        number = $('#jumlah_bayar').val();
        s_number = number.replace(/,/g, '');
        f_number = formatNumber(s_number);

        $('#jumlah_bayar').val(f_number);
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }
</script>

<!-- SUBMIT FORM UPDATE TRANSAKSI  -->
<script>
    $(document).ready(function() {
        $('#update').click(function() {
            var error_metode_pembayaran = '';
            var jumlah_bayar = $('#jumlah_bayar').val();
            var hasil = parseFloat(jumlah_bayar.replace(/[^0-9-.]/g, ''));
            $('#jumlah_bayar').val(hasil);
            if ($('#jumlah_bayar').val() != 0 && $('#metode_pembayaran').val() == 0) {
                error_metode_pembayaran = "Metode pembayaran harus diisi!";
                $('#error_metode_pembayaran').text(error_metode_pembayaran);
                $('#metode_pembayaran').addClass('has-error');
            } else {
                error_metode_pembayaran = '';
                $('#error_metode_pembayaran').text(error_metode_pembayaran);
                $('#metode_pembayaran').removeClass('has-error');
            }

            if (error_metode_pembayaran != '') {
                return false;
            } else {
                $('#myForm').submit();
                const id_transaksi = document.getElementById('id_transaksi').value;
                var xhr = "<?php echo base_url('transaksi/print_bill/') ?>" + id_transaksi;
                var w = window.open(xhr, 'name', 'width=800,height=800');
            }

        });
    });
</script>

</div>
<!-- End of Main Content -->