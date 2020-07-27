<script type="text/javascript">
    var table;

    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('staff/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                var nama = document.getElementById("nama");
                nama.innerHTML = data.nama;
                var alamat = document.getElementById("alamat");
                alamat.innerHTML = data.alamat;
                var tanggal_lahir = document.getElementById("tanggal_lahir");

                var date = new Date(data.tanggal_lahir);
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
                var tgl_lahir = tanggal + ' ' + bulan + ' ' + tahun;
                tanggal_lahir.innerHTML = tgl_lahir;
                var no_telp = document.getElementById("no_telp");
                no_telp.innerHTML = data.no_telp;
                var jk = data.jenis_kelamin;
                if (jk == 1) {
                    jk = 'Laki-laki';
                } else {
                    jk = 'Perempuan';
                }
                var jenis_kelamin = document.getElementById("jenis_kelamin");
                jenis_kelamin.innerHTML = jk;
                var email = document.getElementById("email");
                email.innerHTML = data.email;
                var username = document.getElementById("username");
                username.innerHTML = data.username;
                var url = '<?php echo base_url('staff/edit/') ?>';
                $('#update').attr('href', url + data.id_staf);
                $('#delete').attr('onclick', 'delete_data(' + data.id_staf + ')');
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
    <h3 class="h3 mb-4 text-gray-800"><?= $title; ?></h3>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <a href="<?= base_url('staff/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable">
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
                                <label for="name" style="font-weight: bold">Nama</label>
                                <p id="nama"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="alamat" style="font-weight: bold">Alamat</label>
                                <p id="alamat"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="tanggal_lahir" style="font-weight: bold">Tanggal Lahir</label>
                                <p id="tanggal_lahir"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="jenis_kelamin" style="font-weight: bold">Jenis Kelamin</label>
                                <p id="jenis_kelamin"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="no_telp" style="font-weight: bold">No. Telp</label>
                                <p id="no_telp"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="email" style="font-weight: bold">E-mail</label>
                                <p id="email"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="username" style="font-weight: bold">Username</label>
                                <p id="username"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a type="button" name="update" id="update" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                            <button type="button" name="delete" id="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            <input type="hidden" name="id_staf" id="id_staf" />
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
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "scrollX": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "order": [],
            "lengthMenu": [5, 10, 20],
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
                        return moment(data).locale("id").format('D MMMM YYYY');
                    }
                },
                {
                    "width": "102px",
                    "targets": 4,
                    render: function(data) {
                        if (data == '1') {
                            return 'Laki-laki';
                        } else {
                            return 'Perempuan';
                        }
                    }
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