<script type="text/javascript">
    var table;

    function _calculateAge(tanggal_lahir) { // tanggal_lahir is a date
        var tgl = new Date(tanggal_lahir).getTime();
        var ageDifMs = Date.now() - tgl;
        var ageDate = new Date(ageDifMs); // miliseconds from epoch
        return Math.abs(ageDate.getUTCFullYear() - 1970);
    }

    function detail_data(id) {
        $('#myForm')[0].reset();
        $.ajax({
            url: "<?= base_url('pasien/detail_data/'); ?>" + id,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#no_rekam_medis').text(data.no_rekam_medis);
                $('#nama').text(data.nama);
                $('#alamat').text(data.alamat);
                var age = _calculateAge(data.tanggal_lahir);

                var umur = document.getElementById("umur");
                var umur_pasien = age + ' tahun';
                $('#umur').text(umur_pasien);

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
                $('#tanggal_lahir').text(tgl_lahir);
                $('#pekerjaan').text(data.pekerjaan);
                $('#no_telp').text(data.no_telp);
                if (data.jenis_kelamin == 1) {
                    $('#jenis_kelamin').text('Laki-laki');
                } else {
                    $('#jenis_kelamin').text('Perempuan');
                }

                if (data.riwayat_penyakit == '') {
                    $('#riwayat_penyakit').text('Tidak ada');
                } else {
                    $('#riwayat_penyakit').text(data.riwayat_penyakit);
                }

                if (data.alergi_obat == '') {
                    $('#riwayat_penyakit').text('Tidak ada');
                } else {
                    $('#riwayat_penyakit').text(data.alergi_obat);
                }

                $('#email').text(data.email);
                $('#username').text(data.username);

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
    <h3 class="h3 mb-4 text-gray-800"><?= $title; ?></h3>

    <!-- DataTables -->
    <div class="card mb-3">
        <div class="card-body">
            <table class="table table-hover table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. RM</th>
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
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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
                                <label for="no_rekam_medis" style="font-weight: bold">Nomor Rekam Medis</label>
                                <p id="no_rekam_medis"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="name" style="font-weight: bold">Nama</label>
                                <p id="nama"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="jenis_kelamin" style="font-weight: bold">Jenis Kelamin</label>
                                <p id="jenis_kelamin"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="umur" style="font-weight: bold">Umur</label>
                                <p id="umur"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="alamat" style="font-weight: bold">Alamat</label>
                                <p id="alamat"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="tanggal_lahir" style="font-weight: bold">Tanggal Lahir</label>
                                <p id="tanggal_lahir"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="pekerjaan" style="font-weight: bold">Pekerjaan</label>
                                <p id="pekerjaan"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="no_telp" style="font-weight: bold">No. Telp</label>
                                <p id="no_telp"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="riwayat_penyakit" style="font-weight: bold">Riwayat Penyakit</label>
                                <p id="riwayat_penyakit"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="alergi_obat" style="font-weight: bold">Alergi Obat</label>
                                <p id="alergi_obat"></p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-5">
                                <label for="email" style="font-weight: bold">E-mail</label>
                                <p id="email"></p>
                            </div>
                            <div class="form-group col-sm-5">
                                <label for="username" style="font-weight: bold">Username</label>
                                <p id="username"></p>
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

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        var dataTable = $('#dataTable').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "dom": "<'row'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-9'<'custom-search'>>>" +
                "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "scrollX": true,
            "scrollY": "400px",
            "scrollCollapse": true,
            "order": [],
            "lengthMenu": [20, 50, 100],
            "ajax": {
                url: "<?= base_url('pasien/fetch_data'); ?>",
                type: "POST",
                data: function(data) {
                    data.no_rekam_medis = $('#no_rm').val();
                    data.nama = $('#nama_pasien').val();
                    data.alamat = $('#alamat_pasien').val();
                    data.no_telp = $('#no_telp_pasien').val();
                }
            },
            "columnDefs": [{
                    "targets": [0, 11, 13],
                    "orderable": false
                },
                {
                    "targets": [11, 12, 13],
                    "visible": false
                },
                {
                    "width": "30px",
                    "className": "text-left",
                    "targets": 0
                },
                {
                    "width": "55px",
                    "targets": 1
                },
                {
                    "width": "180px",
                    "targets": 2
                },
                {
                    "width": "50px",
                    "targets": 3,
                    render: function(data) {
                        var tgl = new Date(data).getTime();
                        var ageDifMs = Date.now() - tgl;
                        var ageDate = new Date(ageDifMs);
                        var age = Math.abs(ageDate.getUTCFullYear() - 1970);
                        var umur = parseInt(age);
                        return umur;
                    }
                },
                {
                    "width": "100px",
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
                    "width": "250px",
                    "targets": 5
                },
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
                    "targets": 9,
                    render: function(data) {
                        if (data == '') {
                            return '-';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    "width": "200px",
                    "targets": 10,
                    render: function(data) {
                        if (data == '') {
                            return '-';
                        } else {
                            return data;
                        }
                    }
                },
                {
                    "width": "120px",
                    "targets": 13
                },
            ]
        });

        $("div.custom-search").html('<form id="form-filter"><div class="form-row"><div class="col-sm-2"></div><div class="col-sm-1"><label style="padding-top: 0.5rem">Search:</label></div><div class="col-sm-1"><input type="text" class="form-control form-control-sm" id="no_rm" name="no_rm" placeholder="No. RM" style="padding-left: 0.25rem;"></div><div class="col-sm-2"><input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" placeholder="Nama"></div><div class="col-sm-2"><input type="text" class="form-control form-control-sm" id="alamat_pasien" name="alamat_pasien" placeholder="Alamat"></div><div class="col-sm-2"><input type="text" class="form-control form-control-sm" id="no_telp_pasien" name="no_telp_pasien" placeholder="No. Telp"></div><div class="col-sm-2"><button type="button" id="btn-filter" class="btn btn-info btn-sm active" aria-pressed="true">Search</button><button type="button" id="btn-reset" class="btn btn-default btn-sm active" aria-pressed="true">Reset</button></div></div></form>');

        $('#btn-filter').click(function() { //button filter event click
            dataTable.ajax.reload(); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            dataTable.ajax.reload(); //just reload table
        });
    });
</script>

</div>
<!-- End of Main Content -->