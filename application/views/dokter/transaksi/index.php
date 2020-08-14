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
                    "targets": [0, 5, 6, 11, 12],
                    "orderable": false
                },
                {
                    "width": "30px",
                    "className": "text-left",
                    "targets": 0
                },
                {
                    "width": "95px",
                    "targets": 1,
                },
                {
                    "width": "55px",
                    "targets": 2
                },
                {
                    "width": "160px",
                    "targets": 3
                },
                {
                    "width": "180px",
                    "targets": 4
                },
                {
                    "width": "160px",
                    "targets": 5
                },
                {
                    "width": "180px",
                    "targets": 6
                },
                {
                    "width": "80px",
                    "targets": 7,
                    "render": $.fn.dataTable.render.number('.')
                },
                {
                    "width": "80px",
                    "targets": 8,
                    "render": $.fn.dataTable.render.number('.')
                },
                {
                    "width": "80px",
                    "targets": 9,
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
                    "targets": 10,
                    "render": $.fn.dataTable.render.number('.')
                },
                {
                    "width": "90px",
                    "targets": 11
                },
                {
                    "width": "75px",
                    "targets": 12
                },
            ]
        });
    });
</script>


</div>
<!-- End of Main Content -->