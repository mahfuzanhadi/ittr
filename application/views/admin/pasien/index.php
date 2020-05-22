<script type="text/javascript">
    var table;

    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('pasien/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
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

                var no_rekam_medis = document.getElementById("no_rekam_medis");
                no_rekam_medis.innerHTML = data.no_rekam_medis;
                var nama = document.getElementById("nama");
                nama.innerHTML = data.nama;
                var alamat = document.getElementById("alamat");
                alamat.innerHTML = data.alamat;
                var tanggal_lahir = document.getElementById("tanggal_lahir");
                tanggal_lahir.innerHTML = tgl_lahir;
                var pekerjaan = document.getElementById("pekerjaan");
                pekerjaan.innerHTML = data.pekerjaan;
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
                var riwayat_penyakit = document.getElementById("riwayat_penyakit");
                if (data.riwayat_penyakit == '') {
                    riwayat = 'Tidak ada';
                } else {
                    riwayat = data.riwayat_penyakit;
                }
                console.log('riwayat : ' + riwayat);
                riwayat_penyakit.innerHTML = riwayat;
                var alergi_obat = document.getElementById("alergi_obat");
                if (data.alergi_obat == '') {
                    alergi = 'Tidak ada';
                } else {
                    alergi = data.alergi_obat;
                }
                alergi_obat.innerHTML = alergi;
                var email = document.getElementById("email");
                email.innerHTML = data.email;
                var url = '<?php echo base_url('pasien/edit/') ?>';
                $('#update').attr('href', url + data.id_pasien);
                $('#delete').attr('onclick', 'delete_data(' + data.id_pasien + ')');
                $('#myModal').modal('show');
                $('#id_pasien').val(data.id_pasien);
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
                    url: "<?= base_url('pasien/delete/'); ?>" + id,
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
                    Data pasien <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
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
            <a href="<?= base_url('pasien/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Data</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Rekam Medis</th>
                            <th>Nama</th>
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Tanggal Lahir</th>
                            <th>Pekerjaan</th>
                            <th>No. Telp</th>
                            <th>Riwayat Penyakit</th>
                            <th>Alergi Obat</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>E-mail</th>
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
                        <h4 class="modal-title">Detail Data Pasien</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="no_rekam_medis" style="font-weight: bold">Nomor Rekam Medis</label>
                                <p id="no_rekam_medis"></p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="name" style="font-weight: bold">Nama</label>
                                <p id="nama"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="alamat" style="font-weight: bold">Alamat</label>
                                <p id="alamat"></p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="tanggal_lahir" style="font-weight: bold">Tanggal Lahir</label>
                                <p id="tanggal_lahir"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="pekerjaan" style="font-weight: bold">Pekerjaan</label>
                                <p id="pekerjaan"></p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="no_telp" style="font-weight: bold">No. Telp</label>
                                <p id="no_telp"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="jenis_kelamin" style="font-weight: bold">Jenis Kelamin</label>
                                <p id="jenis_kelamin"></p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="name" style="font-weight: bold">E-mail</label>
                                <p id="email"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="riwayat_penyakit" style="font-weight: bold">Riwayat Penyakit</label>
                                <p id="riwayat_penyakit"></p>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="alergi_obat" style="font-weight: bold">Alergi Obat</label>
                                <p id="alergi_obat"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="container">
                                <div class="center-block text-center">
                                    <a type="button" name="update" id="update" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
                                    <button type="button" name="delete" id="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                </div>
                                <input type="hidden" name="id_pasien" id="id_pasien" />
                            </div>
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
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1,
                heightMatch: 'auto'
            },
            "order": [],
            "lengthMenu": [20, 50, 100],
            "ajax": {
                url: "<?= base_url('pasien/fetch_data'); ?>",
                type: "POST"
            },
            "columnDefs": [{
                    "targets": [0, 11, 13],
                    "orderable": false
                },
                {
                    "targets": [10, 11, 12],
                    "visible": false
                },
                {
                    "width": "30px",
                    "className": "text-left",
                    "targets": 0
                },
                {
                    "width": "140px",
                    "targets": 1
                },
                {
                    "width": "180px",
                    "targets": 2
                },
                {
                    "width": "60px",
                    "targets": 3,
                    "type": "num"
                },
                {
                    "width": "102px",
                    "targets": 4,
                },
                {
                    "width": "250px",
                    "targets": 5
                },
                // {

                //     "targets": 6
                // },
                {
                    "width": "120px",
                    "targets": 6,
                    render: function(data) {
                        return moment(data).locale("id").format('D MMMM YYYY');
                    }
                },
                {
                    "width": "102px",
                    "targets": 7
                },
                {
                    "width": "102px",
                    "targets": 8
                },
                {
                    "width": "200px",
                    "targets": 9
                },
                {
                    "width": "200px",
                    "targets": 10
                },
                {
                    "width": "120px",
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

</div>
<!-- End of Main Content -->