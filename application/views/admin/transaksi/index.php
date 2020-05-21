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
            <a href="<?= base_url('transaksi/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Perawat</th>
                            <th>Tanggal</th>
                            <th>Diagnosa</th>
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
                    "targets": [0, 9, 15],
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
                    "width": "180px",
                    "targets": 6
                },
                {
                    "width": "160px",
                    "targets": 7,
                    render: $.fn.dataTable.render.number('.')
                },
                {
                    "width": "130px",
                    "targets": 8,
                    render: $.fn.dataTable.render.number('.')
                },
                {
                    "width": "180px",
                    "className": "text-center",
                    "targets": 9
                },
                {
                    "width": "180px",
                    "targets": 10
                },
                {
                    "type": "time-uni",
                    "width": "80px",
                    "targets": 11,
                    render: function(data) {
                        return moment(data, "HH:mm:ss").format('HH:mm');
                    }
                },
                {
                    "type": "time-uni",
                    "width": "90px",
                    "targets": 12,
                    render: function(data) {
                        return moment(data, "HH:mm:ss").format('HH:mm');
                    }
                },
                {
                    "width": "180px",
                    "targets": 13,
                    render: $.fn.dataTable.render.number('.')
                },
                {
                    "width": "157px",
                    "targets": 14
                },
                {
                    "width": "80px",
                    "targets": 15
                },
            ]
        });
    });
</script>

</div>
<!-- End of Main Content -->