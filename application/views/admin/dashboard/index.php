<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"><?= $title; ?></h3>
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
        <!-- Rekapitulasi Transaksi Per Tahun -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Transaksi Per Tahun</h6>
                    <div class="col-md-3">
                        <select name="tahun" id="tahun" class="form-control">
                            <option value="">Pilih Tahun</option>
                            <?php
                            foreach ($tahun as $tahun) {
                                echo '<option value="' . $tahun['year(tanggal)'] . '"> ' . $tahun['year(tanggal)'] . ' </option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="rekap_transaksi_pertahun"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-3">
                        </span>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-3">
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rekapitulasi Transaksi Berdasarkan Metode Pembayaran -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Transaksi Berdasarkan Metode Pembayaran</h6>
                    <div class="col-md-3" style="padding-bottom: 38px;"></div>
                </div>
                <div class="card-body">
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                        </span>
                    </div>
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="rekap_transaksi_metode_pembayaran" style="display: block; height: 245px; width: 360px;"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:rgba(255, 206, 86, 0.87)"></i> <span style="color:#666">Cash</span>
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:rgba(75, 192, 192, 0.87)"></i> <span style="color:#666">Kredit</span>
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:rgba(153, 102, 255, 0.87)"></i> <span style="color:#666">Debit</span>
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle" style="color:rgba(255, 159, 64, 0.87)"></i> <span style="color:#666">Transfer</span>
                        </span>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                        </span>
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
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <!-- <i class="fas fa-circle" style="color:rgba(56, 86, 255, 0.87)"></i> <span style="color:#666">Laki-laki</span> -->
                        </span>
                        <span class="mr-2">
                            <!-- <i class="fas fa-circle" style="color:rgba(255, 99, 132, 0.87)"></i> <span style="color:#666">Perempuan</span> -->
                        </span>
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

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Page level plugins -->
<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>
<!-- <script>
    var tahun = $('#tahun').val();
    if (tahun != '') {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>dashboard/fetch_data",
            data: {
                id: tahun,
            },
            success: function(data) {
                var jumlah = jQuery.parseJSON(data);
                var januari = jumlah.bulan1;
                var februari = jumlah.bulan2;
                var maret = jumlah.bulan3;
                var april = jumlah.bulan4;
                var mei = jumlah.bulan5;
                var juni = jumlah.bulan6;
                var juli = jumlah.bulan7;
                var agustus = jumlah.bulan8;
                var september = jumlah.bulan9;
                var oktober = jumlah.bulan10;
                var november = jumlah.bulan11;
                var desember = jumlah.bulan12;
                var bulan = [januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember];

                var ctx = document.getElementById('rekap_transaksi_pertahun').getContext('2d');
                if (window.bar != undefined)
                    window.bar.destroy();
                window.bar = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ],
                        datasets: [{
                            label: [],
                            data: bulan,
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 5,
                            pointHitRadius: 10
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        }
                    }
                });
            }
        });
    }
</script> -->

<script>
    $(document).ready(function() {
        $('#tahun').change(function() {
            var tahun = $('#tahun').val();
            if (tahun != '') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>dashboard/fetch_data",
                    data: {
                        id: tahun,
                    },
                    success: function(data) {
                        var jumlah = jQuery.parseJSON(data);
                        var januari = jumlah.bulan1;
                        var februari = jumlah.bulan2;
                        var maret = jumlah.bulan3;
                        var april = jumlah.bulan4;
                        var mei = jumlah.bulan5;
                        var juni = jumlah.bulan6;
                        var juli = jumlah.bulan7;
                        var agustus = jumlah.bulan8;
                        var september = jumlah.bulan9;
                        var oktober = jumlah.bulan10;
                        var november = jumlah.bulan11;
                        var desember = jumlah.bulan12;
                        var bulan = [januari, februari, maret, april, mei, juni, juli, agustus, september, oktober, november, desember];
                        var total = januari + februari + maret + april + mei + juni + juli + agustus + september + oktober + november + desember;
                        // showChart(bulan);
                        // updateChart();

                        var ctx = document.getElementById('rekap_transaksi_pertahun').getContext('2d');
                        if (window.bar != undefined)
                            window.bar.destroy();
                        var chart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: [
                                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                ],
                                datasets: [{
                                    label: 'Total Data : ' + total,
                                    data: bulan,
                                    fill: false,
                                    lineTension: 0.1,
                                    backgroundColor: "rgba(75,192,192,0.4)",
                                    borderColor: "rgba(75,192,192,1)",
                                    borderCapStyle: 'butt',
                                    borderDash: [],
                                    borderDashOffset: 0.0,
                                    borderJoinStyle: 'miter',
                                    pointBorderColor: "rgba(75,192,192,1)",
                                    pointBackgroundColor: "#fff",
                                    pointBorderWidth: 1,
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                                    pointHoverBorderColor: "rgba(220,220,220,1)",
                                    pointHoverBorderWidth: 2,
                                    pointRadius: 5,
                                    pointHitRadius: 10
                                }]
                            },
                            options: {
                                legend: {
                                    display: true,
                                    position: 'bottom'
                                },
                                scales: {
                                    yAxes: [{
                                        stacked: true
                                    }]
                                }
                            }
                        });

                        window.bar = chart;
                    }
                });
            }
        });
    });
</script>


<!-- $tahun = date('Y');
$query = $this->db->query("SELECT * from transaksi where MONTH(tanggal) = '8' AND YEAR(tanggal) = '" . $tahun . "'");
$jumlah1 = $query->num_rows(); -->

<!-- <script>
    function showChart(bulan) {
        var januari = bulan[0];
        var februari = bulan[1];
        var maret = bulan[2];
        var april = bulan[3];
        var mei = bulan[4];
        var juni = bulan[5];
        var juli = bulan[6];
        var agustus = bulan[7];
        var september = bulan[8];
        var oktober = bulan[9];
        var november = bulan[10];
        var desember = bulan[11];
        var ctx = document.getElementById('rekap_transaksi_pertahun').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                    label: [],
                    data: [januari, februari, maret, april, mei, juni, juli,
                        agustus, september, oktober, november, desember
                    ],
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 5,
                    pointHitRadius: 10
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    }
</script> -->

<?php
$query = $this->db->query("SELECT * FROM transaksi WHERE metode_pembayaran=1");
$jumlah1 = $query->num_rows();
$query2 = $this->db->query("SELECT * FROM transaksi WHERE metode_pembayaran=2");
$jumlah2 = $query2->num_rows();
$query3 = $this->db->query("SELECT * FROM transaksi WHERE metode_pembayaran=3");
$jumlah3 = $query3->num_rows();
$query4 = $this->db->query("SELECT * FROM transaksi WHERE metode_pembayaran=4");
$jumlah4 = $query4->num_rows();
?>

<script>
    var ctx = document.getElementById('rekap_transaksi_metode_pembayaran').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                'Cash', 'Kredit', 'Debit', 'Transfer'
            ],
            datasets: [{
                label: [],
                data: [
                    <?php echo $jumlah1; ?>,
                    <?php echo $jumlah2; ?>,
                    <?php echo $jumlah3; ?>,
                    <?php echo $jumlah4; ?>
                ],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.87)',
                    'rgba(75, 192, 192, 0.87)',
                    'rgba(153, 102, 255, 0.87)',
                    'rgba(255, 159, 64, 0.87)'
                ],
                borderColor: [
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
            rotation: 0.5 * Math.PI,
            cutoutPercentage: 80
        }
    });
</script>

<?php
$query = $this->db->query("SELECT * FROM pasien WHERE jenis_kelamin=1");
$jumlah_lk = $query->num_rows();
$query2 = $this->db->query("SELECT * FROM pasien WHERE jenis_kelamin=2");
$jumlah_pr = $query2->num_rows();
?>

<script>
    var ctx = document.getElementById('rekap_pasien_jk').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'horizontalBar',
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
                backgroundColor: ['rgba(56, 86, 255, 0.87)', 'rgba(255, 99, 132, 0.87)'],
                borderColor: ['rgba(56, 86, 255, 0.87)', 'rgba(255, 99, 132, 0.87)']
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