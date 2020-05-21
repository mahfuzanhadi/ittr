<script type="text/javascript">
    var table;

    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('pasien/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#no_rekam_medis').val(data.no_rekam_medis);
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#tanggal_lahir').val(data.tanggal_lahir);
                $('#pekerjaan').val(data.pekerjaan);
                $('#no_telp').val(data.no_telp);
                $('#jenis_kelamin').val(data.jenis_kelamin);
                $('#riwayat_penyakit').val(data.riwayat_penyakit);
                $('#alergi_obat').val(data.alergi_obat);
                $('#email').val(data.email);
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
                            <div class="form-group col-sm-5">
                                <label for="no_rekam_medis">Nomor Rekam Medis</label>
                                <input class="form-control form-control-sm" type="text" name="no_rekam_medis" id="no_rekam_medis" disabled />
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="name">Nama</label>
                                <input class="form-control form-control-sm" type="text" name="nama" id="nama" disabled />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control form-control-sm" name="alamat" id="alamat" disabled></textarea>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input class="form-control form-control-sm" type="text" name="tanggal_lahir" id="tanggal_lahir" disabled />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input class="form-control form-control-sm" type="text" name="pekerjaan" id="pekerjaan" disabled />
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="no_telp">No. Telp</label>
                                <input class="form-control form-control-sm" type="text" name="no_telp" id="no_telp" disabled />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select class="form-control  form-control-sm required" id="jenis_kelamin" name="jenis_kelamin" disabled>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="1" <?= set_select('jenis_kelamin', '1'); ?>>Laki-laki</option>
                                    <option value="2" <?= set_select('jenis_kelamin', '2'); ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="name">E-mail</label>
                                <input class="form-control form-control-sm" type="text" name="email" id="email" disabled />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="riwayat_penyakit">Riwayat Penyakit</label>
                                <input class="form-control form-control-sm" type="text" name="riwayat_penyakit" id="riwayat_penyakit" disabled />
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="alergi_obat">Alergi Obat</label>
                                <input class="form-control form-control-sm" type="text" name="alergi_obat" id="alergi_obat" disabled />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_pasien" id="id_pasien" />
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
                    // "type": "num"
                    // render: function(data) {
                    //     const a = data;
                    //     const b = moment().format('YYYY-MM-DD');
                    //     const c = moment().diff(a, 'years');
                    //     // const sortedArray = array.sort((a, b) => a.diff(b));
                    //     // return sortedArray;
                    //     return c;
                    //     return moment().diff(data, 'years');
                    // return moment().diff(moment(data, "DD-MM-YYYY"), 'years');
                    // }
                },
                {
                    "width": "102px",
                    "targets": 4
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
                        return moment(data).locale("id").format('DD MMMM YYYY');
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