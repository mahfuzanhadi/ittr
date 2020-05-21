<script type="text/javascript">
    var table;

    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('staff/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#jenis_kelamin').val(data.jenis_kelamin);
                $('#no_telp').val(data.no_telp);
                $('#email').val(data.email);
                $('#no_str').val(data.no_str);
                $('#tanggal_berlaku_str').val(data.tanggal_berlaku_str);
                $('#myModal').modal('show');
                $('#id_staf').val(data.id_staf);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error getting data');
            }
        });
    }

    function delete_data(id) {
        bootbox.confirm("Anda yakin ingin menghapus data ini?", function(result) {
            if (result)
                $.ajax({
                    url: "<?= base_url('staff/delete/'); ?>" + id,
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
                    Data staf administrasi <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
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
            <a href="<?= base_url('staff/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
        </div>
        <div class="card-body">
            <!-- <h5>Results : <?= $total_rows; ?></h5> -->
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>No. Telp</th>
                            <th>E-mail</th>
                            <th>Username</th>
                            <th>Password</th>
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
            <form method="post" id="myForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Data Staf Administrasi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="name">Nama</label>
                                <input class="form-control form-control-sm" type="text" name="nama" id="nama" disabled />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control form-control-sm" name="alamat" id="alamat" disabled></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input class="form-control form-control-sm" type="text" name="tanggal_lahir" id="tanggal_lahir" disabled />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control  form-control-sm required" id="jenis_kelamin" name="jenis_kelamin" disabled>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="1" <?= set_select('jenis_kelamin', '1'); ?>>Laki-laki</option>
                                    <option value="2" <?= set_select('jenis_kelamin', '2'); ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="no_telp">No. Telp</label>
                                <input class="form-control form-control-sm" type="text" name="no_telp" id="no_telp" disabled />
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="name">E-mail</label>
                                <input class="form-control form-control-sm" type="text" name="email" id="email" disabled />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label>Username</label>
                                <input type="text" name="username" id="username" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_staf" id="id_staf" />
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "order": [],
            "lengthMenu": [5, 10, 20, 50],
            "ajax": {
                url: "<?= base_url('staff/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 8, 9],
                    "orderable": false
                },
                {
                    "targets": [8],
                    "visible": false
                },
                {
                    "width": "15px",
                    "className": "text-left",
                    "targets": 0
                },
                {
                    "width": "180px",
                    "targets": 1
                },
                {
                    "width": "250px",
                    "targets": 2
                },
                {
                    "width": "120px",
                    "targets": 3,
                    render: function(data) {
                        return moment(data).locale("id").format('DD MMMM YYYY');
                    }
                },
                {
                    "width": "102px",
                    "targets": 4
                },
                {
                    "width": "102px",
                    "targets": 5
                },
                {
                    "width": "120px",
                    "targets": 6
                },
                {
                    "width": "120px",
                    "targets": 7
                },
                {
                    "width": "150px",
                    "targets": 8
                },
                {
                    "width": "80px",
                    "targets": 9
                },
            ]
        });
    });
</script>