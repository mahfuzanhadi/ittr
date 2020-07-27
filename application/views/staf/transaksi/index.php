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
<script>
    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('transaksi/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                var no_rekam_medis = document.getElementById("no_rekam_medis");
                no_rekam_medis.innerHTML = data.no_rekam_medis;
                var name = document.getElementById("nama");
                name.innerHTML = data.nama_pasien;

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
                var tanggal = document.getElementById("tanggal");
                tanggal.innerHTML = tgl;

                // var keterangan = document.getElementById("keterangan");
                // keterangan.innerHTML = data.keterangan;

                var biaya_tindakan = new Intl.NumberFormat(['ban', 'id']).format(data.total_biaya_tindakan);
                var total_tindakan = 'Rp. ' + biaya_tindakan;
                var biaya_obat = new Intl.NumberFormat(['ban', 'id']).format(data.total_biaya_obat);
                var total_obat = 'Rp. ' + biaya_obat;
                var biaya_keseluruhan = new Intl.NumberFormat(['ban', 'id']).format(data.total_biaya_keseluruhan);
                var total_keseluruhan = 'Rp. ' + biaya_keseluruhan;

                var total_biaya_tindakan = document.getElementById("total_biaya_tindakan");
                total_biaya_tindakan.innerHTML = total_tindakan;
                var total_biaya_obat = document.getElementById("total_biaya_obat");
                total_biaya_obat.innerHTML = total_obat;
                var total_biaya_keseluruhan = document.getElementById("total_biaya_keseluruhan");
                total_biaya_keseluruhan.innerHTML = total_keseluruhan;

                var status_pembayaran = document.getElementById("status_pembayaran");
                if (data.metode_pembayaran == '' || data.metode_pembayaran == 0) {
                    status_pembayaran.innerHTML = 'Belum bayar!';
                    $('#status_pembayaran').css('color', 'red');
                } else {
                    status_pembayaran.innerHTML = 'Sudah bayar';
                    $('#status_pembayaran').css('color', 'green');
                }

                $('#metode_pembayaran').val(data.metode_pembayaran);

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
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <!-- <a href="<?= base_url('transaksi/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a> -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Perawat</th>
                            <th>Tanggal</th>
                            <th>Total Biaya Tindakan</th>
                            <th>Total Biaya Obat</th>
                            <th>Foto Rontgen</th>
                            <th>Keterangan</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Total Biaya Keseluruhan</th>
                            <th>Metode Pembayaran</th>
                            <th>Action</th>
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
                        <h4 class="modal-title">Detail Data Transaksi</h4>
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
                                <label for="metode_pembayaran" style="font-weight: bold">Metode Pembayaran</label>
                                <select class="form-control  form-control-sm required" id="metode_pembayaran" name="metode_pembayaran">
                                    <option value="1" <?= set_select('metode_pembayaran', '1'); ?>>Cash</option>
                                    <option value="2" <?= set_select('metode_pembayaran', '2'); ?>>Kredit</option>
                                    <option value="3" <?= set_select('metode_pembayaran', '3'); ?>>Debit</option>
                                    <option value="4" <?= set_select('metode_pembayaran', '4'); ?>>Transfer</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="status_pembayaran" style="font-weight: bold">Status Pembayaran</label>
                                <p id="status_pembayaran"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a type="button" name="update" id="update" class="btn btn-success" style="color:white"><i class="fas fa-edit"></i> Update</a>
                            <input type="hidden" name="id_transaksi" id="id_transaksi" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "scrollY": "400px",
            scrollCollapse: true,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1,
                heightMatch: 'auto'
            },
            "order": [],
            "lengthMenu": [20, 50, 100],
            "ajax": {
                url: "<?= base_url('transaksi/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 8, 14],
                    "orderable": false
                },
                {
                    "width": "15px",
                    "className": "text-left",
                    "targets": 0
                },
                {
                    "width": "132px",
                    "targets": 1
                },
                {
                    "width": "180px",
                    "targets": 2
                },
                {
                    "width": "180px",
                    "targets": 3
                },
                {
                    "width": "180px",
                    "targets": 4
                },
                {
                    "width": "90px",
                    "targets": 5,
                    render: function(data) {
                        return moment(data).locale("id").format('DD MMMM YYYY');
                    }
                },
                {
                    "width": "160px",
                    "targets": 6,
                    render: $.fn.dataTable.render.number('.')
                },
                {
                    "width": "130px",
                    "targets": 7,
                    render: $.fn.dataTable.render.number('.')
                },
                {
                    "width": "180px",
                    "className": "text-center",
                    "targets": 8
                },
                {
                    "width": "180px",
                    "targets": 9
                },
                {
                    "type": "time-uni",
                    "width": "80px",
                    "targets": 10,
                    render: function(data) {
                        return moment(data, "HH:mm:ss").format('HH:mm');
                    }
                },
                {
                    "type": "time-uni",
                    "width": "90px",
                    "targets": 11,
                    render: function(data) {
                        return moment(data, "HH:mm:ss").format('HH:mm');
                    }
                },
                {
                    "width": "180px",
                    "targets": 12,
                    render: $.fn.dataTable.render.number('.')
                },
                {
                    "width": "157px",
                    "targets": 13
                },
                {
                    "width": "80px",
                    "targets": 14,
                    "visible": false
                },
            ]
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#update').click(function() {
            $('#myForm').submit();
        });
    });
</script>

</div>
<!-- End of Main Content -->