<script type="text/javascript">
    var table;

    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('dokter/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
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

                var no_sip = document.getElementById("no_sip");
                sip = data.no_sip;
                no_sip.innerHTML = sip;
                var no_str = document.getElementById("no_str");
                str = data.no_str;
                no_str.innerHTML = str;

                var date2 = new Date(data.tanggal_berlaku_sip);
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
                var tanggal_berlaku_sip = document.getElementById("tanggal_berlaku_sip");
                berlaku_sip = tanggal + ' ' + bulan + ' ' + tahun;
                tanggal_berlaku_sip.innerHTML = berlaku_sip;

                var date3 = new Date(data.tanggal_berlaku_str);
                var tahun = date3.getFullYear();
                var bulan = date3.getMonth();
                var tanggal = date3.getDate();
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
                berlaku_str = tanggal + ' ' + bulan + ' ' + tahun;
                tanggal_berlaku_str.innerHTML = berlaku_str;

                var email = document.getElementById("email");
                email.innerHTML = data.email;
                var url = '<?php echo base_url('dokter/edit/') ?>';
                $('#update').attr('href', url + data.id_dokter);
                $('#delete').attr('onclick', 'delete_data(' + data.id_dokter + ')');
                $('#myModal').modal('show');
                $('#id_dokter').val(data.id_dokter);
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
                    url: "<?= base_url('dokter/delete/'); ?>" + id,
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
                    Data dokter <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
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
            <a href="<?= base_url('dokter/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
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
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>No. SIP</th>
                            <th>No. STR</th>
                            <th>Tanggal Berlaku SIP</th>
                            <th>Tanggal Berlaku STR</th>
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
                        <h4 class="modal-title">Detail Data Dokter</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="name" style="font-weight: bold">Nama</label>
                                <p id="nama"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="alamat" style="font-weight: bold">Alamat</label>
                                <p id="alamat"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="ttl" style="font-weight: bold">Tempat Tanggal Lahir</label>
                                <p id="ttl"></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="jenis_kelamin" style="font-weight: bold">Jenis Kelamin</label>
                                <p id="jenis_kelamin"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="no_sip" style="font-weight: bold">No. SIP</label>
                                <p id="no_sip"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="tanggal_berlaku_sip" style="font-weight: bold">Tanggal Berlaku SIP</label>
                                <p id="tanggal_berlaku_sip"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="no_str" style="font-weight: bold">No. STR</label>
                                <p id="no_str"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="tanggal_berlaku_str" style="font-weight: bold">Tanggal Berlaku STR</label>
                                <p id="tanggal_berlaku_str"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="email" style="font-weight: bold">E-mail</label>
                                <p id="email"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="no_telp" style="font-weight: bold">No. Telp</label>
                                <p id="no_telp"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a type="button" name="update" id="update" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                            <button type="button" name="delete" id="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                            <input type="hidden" name="id_dokter" id="id_dokter" />
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
                rightColumns: 1,
                heightMatch: 'auto'
            },
            "order": [],
            "lengthMenu": [5, 10, 20, 50],
            "ajax": {
                url: "<?= base_url('dokter/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 6, 7, 13, 14],
                    "orderable": false
                },
                {
                    "targets": [13],
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
                    "targets": 6,
                },
                {
                    "width": "102px",
                    "targets": 7,
                },
                {
                    "width": "150px",
                    "targets": 8
                },
                {
                    targets: 8,
                    render: function(data) {
                        return moment(data).locale("id").format('DD MMMM YYYY');
                    }
                },
                {
                    "width": "155px",
                    "targets": 9
                },
                {
                    targets: 9,
                    render: function(data) {
                        return moment(data).locale("id").format('DD MMMM YYYY');
                    }
                },
                {
                    "width": "102px",
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
                    "width": "102px",
                    "targets": 13
                },
                {
                    "width": "80px",
                    "targets": 14
                },
            ]
        });
    });
</script>