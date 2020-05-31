<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Jumlah Data Rekam Medis -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Rekam Medis</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rekammedis; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-notes-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Pasien -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pasien</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pasien; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-fw fa-bed fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Inventaris Obat -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Inventaris Obat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $obat; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pills fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Inventaris Alat dan Bahan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Inventaris Alat dan Bahan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $bahan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Data Pasien Berdasarkan Umur -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien Berdasarkan Umur</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="rekap_pasien_umur" style="display: block; height: 320px; width: 791px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Pasien Berdasarkan Jenis Kelamin -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien Berdasarkan Jenis Kelamin</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="rekap_pasien_jk" style="display: block; height: 245px; width: 360px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <!-- Data Pasien Berdasarkan Riwayat Penyakit -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien Berdasarkan Riwayat Penyakit</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="rekap_pasien_riwayat_penyakit" style="max-width: 500px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Pasien Berdasarkan Alergi Obat -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien Berdasarkan Alergi Obat</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="rekap_pasien_alergi_obat" style="max-width: 500px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Direct
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Social
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Referral
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>

<?php
$query = $this->db->query("SELECT * FROM pasien WHERE jenis_kelamin=1");
$jumlah_lk = $query->num_rows();
$query2 = $this->db->query("SELECT * FROM pasien WHERE jenis_kelamin=2");
$jumlah_pr = $query2->num_rows();
?>

<script>
    var ctx = document.getElementById('rekap_pasien_jk').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                'Laki-laki', 'Perempuan'
            ],
            datasets: [{
                label: '',
                data: [
                    <?php echo $jumlah_lk; ?>,
                    <?php echo $jumlah_pr; ?>
                ],
                backgroundColor: ['rgba(56, 86, 255, 0.87)', 'rgb(255, 99, 132)'],
                borderColor: ['rgba(56, 86, 255, 0.87)', 'rgb(255, 99, 132)']
            }]
        },
        options: {
            legend: {
                position: 'right'
            },
        }
    });
</script>

<?php
$query1 = $this->db->query("SELECT * from pasien where TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 10");
$umur1 = $query1->num_rows();
$query2 = $this->db->query("SELECT * from pasien where TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 10 and TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 20");
$umur2 = $query2->num_rows();
$query3 = $this->db->query("SELECT * from pasien where TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 20 and TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 30");
$umur3 = $query3->num_rows();
$query4 = $this->db->query("SELECT * from pasien where TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 30 and TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 40");
$umur4 = $query4->num_rows();
$query5 = $this->db->query("SELECT * from pasien where TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 40 and TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 50");
$umur5 = $query5->num_rows();
$query6 = $this->db->query("SELECT * from pasien where TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 50");
$umur6 = $query6->num_rows();
?>

<script>
    var ctx = document.getElementById('rekap_pasien_umur').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                '< 10 tahun', '10-19 tahun', '20-29 tahun', '30-39 tahun', '40-49 tahun', '> 50 tahun'
            ],
            datasets: [{
                label: '',
                data: [
                    <?php echo $umur1; ?>,
                    <?php echo $umur2; ?>,
                    <?php echo $umur3; ?>,
                    <?php echo $umur4; ?>,
                    <?php echo $umur5; ?>,
                    <?php echo $umur6; ?>,
                ],
                backgroundColor: ['rgba(255, 99, 132, 0.87)',
                    'rgba(54, 162, 235, 0.87)',
                    'rgba(255, 206, 86, 0.87)',
                    'rgba(75, 192, 192, 0.87)',
                    'rgba(153, 102, 255, 0.87)',
                    'rgba(255, 159, 64, 0.87)'
                ],
                borderColor: ['rgba(255, 99, 132, 0.87)',
                    'rgba(54, 162, 235, 0.87)',
                    'rgba(255, 206, 86, 0.87)',
                    'rgba(75, 192, 192, 0.87)',
                    'rgba(153, 102, 255, 0.87)',
                    'rgba(255, 159, 64, 0.87)'
                ]
            }]
        },
        options: {
            legend: {
                display: false
            },
        }
    });
</script>

<?php
$query = $this->db->query("SELECT * FROM pasien WHERE riwayat_penyakit!=''");
$jumlah_ada = $query->num_rows();
$query2 = $this->db->query("SELECT * FROM pasien WHERE riwayat_penyakit=''");
$jumlah_tidakada = $query2->num_rows();
?>

<script>
    var ctx = document.getElementById('rekap_pasien_riwayat_penyakit').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Memiliki Riwayat Penyakit', 'Tidak Memiliki Riwayat Penyakit'
            ],
            datasets: [{
                label: '',
                data: [
                    <?php echo $jumlah_ada; ?>,
                    <?php echo $jumlah_tidakada; ?>
                ],
                backgroundColor: ['rgba(255, 159, 64, 0.87)', 'rgba(54, 162, 235, 0.87)'],
                borderColor: ['rgba(255, 159, 64, 0.87)', 'rgba(54, 162, 235, 0.87)']
            }]
        },
        options: {
            legend: {
                position: 'right'
            },
        }
    });
</script>

<?php
$query = $this->db->query("SELECT * FROM pasien WHERE alergi_obat!=''");
$jumlah_ada = $query->num_rows();
$query2 = $this->db->query("SELECT * FROM pasien WHERE alergi_obat=''");
$jumlah_tidakada = $query2->num_rows();
?>

<script>
    var ctx = document.getElementById('rekap_pasien_alergi_obat').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Memiliki Alergi Obat', 'Tidak Memiliki Alergi Obat'
            ],
            datasets: [{
                label: '',
                data: [
                    <?php echo $jumlah_ada; ?>,
                    <?php echo $jumlah_tidakada; ?>
                ],
                backgroundColor: ['rgba(255, 159, 64, 0.87)', 'rgba(54, 162, 235, 0.87)'],
                borderColor: ['rgba(255, 159, 64, 0.87)', 'rgba(54, 162, 235, 0.87)']
            }]
        },
        options: {
            legend: {
                position: 'right'
            },
        }
    });
</script>