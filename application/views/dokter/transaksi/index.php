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

                if (data.metode_pembayaran != 0 && data.jumlah_bayar >= data.total_biaya_keseluruhan) {
                    $('#status_pembayaran').text('Lunas');
                    $('#status_pembayaran').css('color', 'green');
                } else if (data.metode_pembayaran != 0 && data.jumlah_bayar < data.total_biaya_keseluruhan) {
                    $('#status_pembayaran').text('Belum lunas');
                    $('#status_pembayaran').css('color', 'orange');
                } else {
                    $('#status_pembayaran').text('Belum melakukan pembayaran!');
                    $('#status_pembayaran').css('color', 'red');
                }

                if (data.diskon > 100) {
                    var diskon = new Intl.NumberFormat(['ban', 'id']).format(data.diskon);
                    $('#diskon').text('Rp. ' + diskon);
                } else {
                    const tindakan = parseInt(data.total_biaya_tindakan);
                    const obat = parseInt(data.total_biaya_obat);
                    var total_biaya = tindakan + obat;
                    var diskon = data.diskon;
                    var total_diskon = (total_biaya * diskon) / 100;
                    const format_diskon = new Intl.NumberFormat(['ban', 'id']).format(total_diskon);
                    const html = '<span><i class="fas fa-fw fa-long-arrow-alt-right"></i></span>';

                    $('#diskon').html(data.diskon + '% ' + html + 'Rp. ' + format_diskon);
                }

                $('#keterangan').text(data.keterangan);

                var jumlah_bayar = new Intl.NumberFormat(['ban', 'id']).format(data.jumlah_bayar);
                var format_jumlah_bayar = 'Rp. ' + jumlah_bayar;
                $('#jumlah_bayar').text(format_jumlah_bayar);

                const id_metode = data.metode_pembayaran;
                if (id_metode == 1) {
                    $('#metode_pembayaran').text("Cash");
                } else if (id_metode == 2) {
                    $('#metode_pembayaran').text("Kredit");
                } else if (id_metode == 3) {
                    $('#metode_pembayaran').text("Debit");
                } else if (id_metode == 4) {
                    $('#metode_pembayaran').text("Transfer");
                } else {
                    $('#metode_pembayaran').text("-");
                }
                // $('#metode_pembayaran').val(data.metode_pembayaran);
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

    <?php if ($this->session->flashdata('error')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Anda tidak memiliki akses ke data ini!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('deny')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Anda tidak dapat mengubah data ini! Silahkan hubungi super admin jika ingin mengubah data ini.
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
                                <p id="jumlah_bayar"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="metode_pembayaran" style="font-weight: bold">Metode Pembayaran</label>
                                <p id="metode_pembayaran"></p>
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
            "language": {
                "infoFiltered": ""
            },
            "order": [],
            "lengthMenu": [20, 50, 100],
            "ajax": {
                url: "<?= base_url('transaksi/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 6, 7, 12, 13],
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
                    "width": "100px",
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
                {
                    "width": "75px",
                    "targets": 13
                },
            ]
        });
    });
</script>


</div>
<!-- End of Main Content -->