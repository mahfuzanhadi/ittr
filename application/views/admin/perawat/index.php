<script type="text/javascript">
    var table;

    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('perawat/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                var nama = document.getElementById("nama");
                nama.innerHTML = data.nama;
                var alamat = document.getElementById("alamat");
                alamat.innerHTML = data.alamat;
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
                var ttlahir = data.tempat_lahir + ', ' + tgl_lahir;
                var ttl = document.getElementById("ttl");
                ttl.innerHTML = ttlahir;

                var no_str = document.getElementById("no_str");
                if (data.no_str == '') {
                    str = 'Tidak ada';
                } else {
                    str = data.no_str;
                }
                no_str.innerHTML = str;

                var date2 = new Date(data.tanggal_berlaku_str);
                var tahun = date2.getFullYear();
                var bulan = date2.getMonth();
                var tanggal = date2.getDate();
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
                var tanggal_berlaku_str = document.getElementById("tanggal_berlaku_str");
                if (data.tanggal_berlaku_str == '' || data.tanggal_berlaku_str == '0000-00-00') {
                    berlaku_str = 'Tidak ada';
                } else {
                    berlaku_str = tanggal + ' ' + bulan + ' ' + tahun;
                }

                var status = data.status;
                if (status == 1) {
                    status = 'Aktif';
                } else {
                    status = 'Tidak Aktif';
                }
                document.getElementById("status").innerHTML = status;
                tanggal_berlaku_str.innerHTML = berlaku_str;
                var email = document.getElementById("email");
                email.innerHTML = data.email;
                var url = '<?php echo base_url('perawat/edit/') ?>';
                $('#update').attr('href', url + data.id_perawat);
                $('#delete').attr('onclick', 'delete_data(' + data.id_perawat + ')');
                $('#myModal').modal('show');
                $('#id_perawat').val(data.id_perawat);
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
                    url: "<?= base_url('perawat/delete/'); ?>" + id,
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
                    Data perawat <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->
    <h3 class="h3 my-2 text-gray-800"><?= $title; ?></h3>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-header">
            <a href="<?= base_url('perawat/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>No. Telp</th>
                            <th>No. STR</th>
                            <th>Tanggal Berlaku STR</th>
                            <th>E-mail</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Status</th>
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
                        <h4 class="modal-title">Detail Data Perawat</h4>
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
                                <label for="ttl" style="font-weight: bold">Tempat Tanggal Lahir</label>
                                <p id="ttl"></p>
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
                                <label for="no_str" style="font-weight: bold">No. STR</label>
                                <p id="no_str"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="tanggal_berlaku_str" style="font-weight: bold">Tanggal Berlaku STR</label>
                                <p id="tanggal_berlaku_str"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="status" style="font-weight: bold">Status</label>
                                <p id="status"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a type="button" name="update" id="update" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                            <button type="button" name="delete" id="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            <input type="hidden" name="id_perawat" id="id_perawat" />
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
            "fixedColumns": {
                leftColumns: 1,
                rightColumns: 1
            },
            "order": [],
            "lengthMenu": [5, 10, 20, 50],
            "ajax": {
                url: "<?= base_url('perawat/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 11, 13],
                    "orderable": false
                },
                {
                    "targets": [11],
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
                    "width": "100px",
                    "targets": 3
                },
                {
                    "width": "120px",
                    "targets": 4,
                    render: function(data) {
                        return moment(data).locale("id").format('D MMMM YYYY');
                    }
                },
                {
                    "width": "102px",
                    "targets": 5,
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
                    "targets": 6
                },
                {
                    "width": "120px",
                    "targets": 7
                },
                {
                    "width": "155px",
                    "targets": 8,
                    render: function(data) {
                        if (data != '') {
                            return moment(data).locale("id").format('D MMMM YYYY');
                        } else return null;
                    }
                },
                {
                    "width": "102px",
                    "targets": 9
                },
                {
                    "width": "150px",
                    "targets": 10
                },
                {
                    "width": "120px",
                    "targets": 11
                },
                {
                    "width": "102px",
                    "targets": 12
                },
                {
                    "width": "80px",
                    "targets": 13
                },
            ]
        });
    });
</script>