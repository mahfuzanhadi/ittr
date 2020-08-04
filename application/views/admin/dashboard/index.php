<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 class="h3 mb-0 text-gray-800"><?= $title; ?></h3>
    </div>

    <!-- Show alert if stok obat < 10 -->
    <div class="row mt-3 d-none" id="row">
        <div class="col-md-6">
            <div class="alert alert-danger alert-dismissible fade hide" role="alert">
                <a href="#stok_obat" class="d-none" id="notif"></i> Salah satu stok obat menipis!</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Jumlah Data Transaksi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $transaksi; ?></div>
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

        <!-- Jumlah Data Obat -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Obat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $obat; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pills fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Data Alat dan Bahan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Alat dan Bahan</div>
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

    <!-- Rekapitulasi Kunjungan Per Tahun -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Kunjungan Per Tahun</h6>
                    <div class="col-md-3">
                        <select name="tahun" id="tahun" class="custom-select custom-select-sm">
                            <option value="" hidden>Pilih Tahun</option>
                            <?php
                            foreach ($tahun as $year) {
                                echo '<option value="' . $year['year(tanggal)'] . '"> ' . $year['year(tanggal)'] . ' </option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center small">
                        <span class="mr-3">
                            <h6 class="m-0 font-weight-bold text-primary" id="total_data"></h6>
                        </span>
                    </div>
                    <div class="chart-area" id="chart-kunjungan">
                        <canvas id="rekap_kunjungan_pertahun" class="canvas_kunjungan"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekapitulasi Omzet Per Tahun -->
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Omzet Per Tahun</h6>
                    <div class="col-md-3">
                        <select name="tahun_omzet" id="tahun_omzet" class="custom-select custom-select-sm">
                            <option value="" hidden>Pilih Tahun</option>
                            <?php
                            foreach ($tahun as $tahun) {
                                echo '<option value="' . $tahun['year(tanggal)'] . '"> ' . $tahun['year(tanggal)'] . ' </option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area" id="chart-omzet">
                        <canvas id="rekap_omzet_pertahun" class="canvas_omzet"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekapitulasi Data Pasien Berdasarkan Umur dan Jenis Kelamin -->
    <div class="row">
        <!-- Data Pasien Berdasarkan Umur -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien Berdasarkan Umur</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="rekap_pasien_umur" class="canvas_pasien_umur"></canvas>
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
                        <canvas id="rekap_pasien_jk" class="canvas_pasien_jk"></canvas>
                    </div>
                    <div class="mt-4 text-center small" style="padding-bottom: 20px;">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Rekapitulasi Metode Pembayaran dan Stok Obat -->
    <div class="row">
        <!-- Rekapitulasi Metode Pembayaran -->
        <div class="col-xl-3 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Metode Pembayaran</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4" style="height: 16rem !important;">
                        <canvas id="rekap_transaksi_metode_pembayaran" class="canvas_metode_pembayaran"></canvas>
                    </div>
                    <div class="text-justify pl-3">
                        <div class="row pt-2">
                            <div class="col">
                                <i class="fas fa-circle" style="color:rgba(255, 206, 86, 0.87)"></i> <span style="color:#666">Cash : </span>
                                <span id="cash" style="color:#666"></span>
                            </div>
                            <div class="col">
                                <i class="fas fa-circle" style="color:rgba(75, 192, 192, 0.87)"></i> <span style="color:#666">Kredit : </span>
                                <span id="kredit" style="color:#666"></span>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col">
                                <i class="fas fa-circle" style="color:rgba(153, 102, 255, 0.87)"></i> <span style="color:#666">Debit : </span>
                                <span id="debit" style="color:#666"></span>
                            </div>
                            <div class="col">
                                <i class="fas fa-circle" style="color:rgba(255, 159, 64, 0.87)"></i> <span style="color:#666">Transfer : </span>
                                <span id="transfer" style="color:#666"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekapitulasi Stok Obat -->
        <div class="col-xl-9 col-lg-6" id="stok_obat">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Stok Obat</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="rekap_stok_obat" class="canvas_stok_obat"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekapitulasi Data Pasien Berdasarkan Riwayat Penyakit dan Alergi Obat -->
    <div class="row">
        <!-- Data Pasien Berdasarkan Riwayat Penyakit -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Pasien Berdasarkan Riwayat Penyakit</h6>
                </div>
                <div class="card-body">
                    <span id="legend_riwayat_penyakit"></span>
                    <div class="chart-pie">
                        <canvas id="rekap_pasien_riwayat_penyakit" class="canvas_riwayat_penyakit"></canvas>
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
                    <span id="legend_alergi_obat"></span>
                    <div class="chart-pie">
                        <canvas id="rekap_pasien_alergi_obat" class="canvas_alergi_obat"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekapitulasi Tindakan -->
    <div class="row" id="card_tindakan">
        <div class="col-xl-12">
            <div class="card shadow mb-4" style="height: 1000px;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Tindakan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="rekap_tindakan" class="canvas_tindakan"></canvas>
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

<!-- AMBIL DATA REKAP KUNJUNGAN PER TAHUN -->
<script>
    $(document).ready(function() {
        let tahun = new Date().getFullYear();
        $('#tahun').val(tahun);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("dashboard/fetch_kunjungan"); ?>",
            data: {
                id: tahun,
            },
            success: function(data) {
                let jumlah = jQuery.parseJSON(data);
                showChart(jumlah);
            }
        });
    });

    $('#tahun').change(function() {
        let tahun = $('#tahun').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("dashboard/fetch_kunjungan"); ?>",
            data: {
                id: tahun,
            },
            success: function(data) {
                let jumlah = jQuery.parseJSON(data);
                resetCanvasKunjungan();
                showChart(jumlah);
            }
        });
    });
</script>

<!-- FUNCTION SHOW CHART REKAP KUNJUNGAN -->
<script>
    var resetCanvasKunjungan = function() {
        $('#rekap_kunjungan_pertahun').remove(); // this is my <canvas> element
        $('#chart-kunjungan').append('<canvas id="rekap_kunjungan_pertahun" class="canvas_kunjungan"></canvas>');
    };

    function showChart(jumlah) {
        let total = 0;
        for (let i in jumlah) {
            total += jumlah[i];
        }

        var month = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        var total_data = document.getElementById("total_data");
        total_data.innerHTML = 'Total data : ' + total;

        var ctx = document.getElementById('rekap_kunjungan_pertahun').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: month,
                datasets: [{
                    label: [],
                    data: jumlah,
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,1)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0,
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
                    display: false,
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            stepValue: 5,
                            suggestedMax: 100,
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
</script>

<!-- AMBIL DATA REKAP OMZET PER TAHUN -->
<script>
    $(document).ready(function() {
        let tahun_omzet = new Date().getFullYear();
        $('#tahun_omzet').val(tahun_omzet);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('dashboard/fetch_omzet'); ?>",
            data: {
                year: tahun_omzet
            },
            success: function(data) {
                let data_omzet = jQuery.parseJSON(data);
                showOmzetChart(data_omzet);
            }
        });

        $('#tahun_omzet').change(function() {
            let tahun_omzet = $('#tahun_omzet').val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('dashboard/fetch_omzet') ?>',
                data: {
                    year: tahun_omzet
                },
                success: function(data) {
                    let data_omzet = jQuery.parseJSON(data);
                    resetCanvasOmzet();
                    showOmzetChart(data_omzet);
                }
            })
        });
    });
</script>

<!-- FUNCTION SHOW CHART OMZET -->
<script>
    var resetCanvasOmzet = function() {
        $('#rekap_omzet_pertahun').remove(); // this is my <canvas> element
        $('#chart-omzet').append('<canvas id="rekap_omzet_pertahun" class="canvas_omzet"></canvas>');
    };

    function showOmzetChart(data) {
        let month = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        var ctx = document.getElementById('rekap_omzet_pertahun').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: month,
                datasets: [{
                    label: [],
                    data: data,
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,1)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0,
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
                tooltips: {
                    callbacks: {
                        label: function(t, d) {
                            var xLabel = d.datasets[t.datasetIndex].label;
                            var yLabel = t.yLabel >= 1000 ? 'Rp. ' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : 'Rp. ' + t.yLabel;
                            return xLabel + ': ' + yLabel;
                        }
                    }
                },
                legend: {
                    display: false,
                    position: 'bottom'
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            beginAtZero: true,
                            stepValue: 5,
                            suggestedMax: 100,
                            callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                } else {
                                    return 'Rp. ' + value;
                                }
                            }
                        }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
</script>

<!--CHART TRANSAKSI BERDASARKAN METODE PEMBAYARAN-->
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("dashboard/fetch_metode_pembayaran"); ?>",
            success: function(data) {
                let jumlah = jQuery.parseJSON(data);
                let cash_p = document.getElementById('cash');
                cash_p.innerText = jumlah[0];
                let kredit_p = document.getElementById('kredit');
                kredit_p.innerText = jumlah[1];
                let debit_p = document.getElementById('debit');
                debit_p.innerText = jumlah[2];
                let transfer_p = document.getElementById('transfer');
                transfer_p.innerText = jumlah[3];

                var ctx = document.getElementById('rekap_transaksi_metode_pembayaran').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            'Cash', 'Kredit', 'Debit', 'Transfer'
                        ],
                        datasets: [{
                            label: [],
                            data: jumlah,
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
            }
        })
    });
</script>

<!-- CHART PASIEN BERDASARKAN JENIS KELAMIN -->
<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url("dashboard/fetch_jk"); ?>",
            success: function(data) {
                let jumlah = jQuery.parseJSON(data);

                var ctx = document.getElementById('rekap_pasien_jk').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: [
                            'Laki-laki', 'Perempuan'
                        ],
                        datasets: [{
                            label: [],
                            data: jumlah,
                            backgroundColor: ['rgba(56, 86, 255, 0.87)', 'rgba(255, 99, 132, 0.87)'],
                            borderColor: ['rgba(56, 86, 255, 0.87)', 'rgba(255, 99, 132, 0.87)']
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                stacked: true,
                                ticks: {
                                    suggestedMax: 100,
                                    beginAtZero: true,
                                    stepValue: 5,
                                }
                            }]
                        }
                    }
                });
            }
        })
    });
</script>

<!-- CHART PASIEN BERDASARKAN UMUR -->
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('dashboard/fetch_umur'); ?>",
            success: function(data) {
                let jumlah = jQuery.parseJSON(data);

                var ctx = document.getElementById('rekap_pasien_umur').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            '< 10 tahun', '10-19 tahun', '20-29 tahun', '30-39 tahun', '40-49 tahun', '> 50 tahun'
                        ],
                        datasets: [{
                            label: [],
                            data: jumlah,
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
                        scales: {
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true,
                                    stepValue: 5
                                }
                            }]
                        }
                    }
                });
            }
        })
    })
</script>

<!-- CHART PASIEN BERDASARKAN RIWAYAT PENYAKIT -->
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('dashboard/fetch_riwayat_penyakit') ?>",
            success: function(data) {
                let jumlah = jQuery.parseJSON(data);

                var ctx = document.getElementById('rekap_pasien_riwayat_penyakit').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            'Memiliki Riwayat Penyakit', 'Tidak Memiliki Riwayat Penyakit'
                        ],
                        datasets: [{
                            label: [],
                            data: jumlah,
                            backgroundColor: ['rgba(75, 192, 192, 0.87)', 'rgba(255, 206, 86, 0.87)'],
                            borderColor: ['rgba(75, 192, 192, 0.87)', 'rgba(255, 206, 86, 0.87)']
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false,
                            position: 'right'
                        },
                        legendCallback: function(chart) {
                            var text = [];

                            var data = chart.data;
                            var datasets = data.datasets;
                            var labels = data.labels;

                            if (datasets.length) {
                                for (var i = 0; i < datasets[0].data.length; ++i) {
                                    if (labels[i]) {
                                        text.push('<div class="row ml-2 mb-2"><i class="fas fa-square" style="color:' + datasets[0].backgroundColor[i] + '"></i>&nbsp;<span style="color: #666">' + labels[i] + ' : ' + datasets[0].data[i] + '</span>');
                                    }
                                    text.push('</div>');
                                }
                            }
                            return text.join('');
                        },
                    }
                });

                var riwayat_penyakit = chart.generateLegend();
                document.getElementById("legend_riwayat_penyakit").innerHTML = riwayat_penyakit;
            }
        })
    })
</script>

<!-- CHART PASIEN BERDASARKAN ALERGI OBAT -->
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('dashboard/fetch_alergi_obat'); ?>",
            success: function(data) {
                let jumlah = jQuery.parseJSON(data);

                var ctx = document.getElementById('rekap_pasien_alergi_obat').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            'Memiliki Alergi Obat', 'Tidak Memiliki Alergi Obat'
                        ],
                        datasets: [{
                            label: [],
                            data: jumlah,
                            backgroundColor: ['rgba(75, 192, 192, 0.87)', 'rgba(255, 206, 86, 0.87)'],
                            borderColor: ['rgba(75, 192, 192, 0.87)', 'rgba(255, 206, 86, 0.87)']
                        }]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            display: false,
                            position: 'right'
                        },
                        legendCallback: function(chart) {
                            var text = [];

                            var data = chart.data;
                            var datasets = data.datasets;
                            var labels = data.labels;

                            if (datasets.length) {
                                for (var i = 0; i < datasets[0].data.length; ++i) {
                                    if (labels[i]) {
                                        text.push('<div class="row ml-2 mb-2"><i class="fas fa-square" style="color:' + datasets[0].backgroundColor[i] + '"></i>&nbsp;<span style="color: #666">' + labels[i] + ' : ' + datasets[0].data[i] + '</span>');
                                    }
                                    text.push('</div>');
                                }
                            }
                            return text.join('');
                        },
                    }
                });

                var alergi_obat = chart.generateLegend();
                document.getElementById("legend_alergi_obat").innerHTML = alergi_obat;
            }
        })
    })
</script>

<!-- CHART REKAP STOK OBAT -->
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('dashboard/fetch_obat') ?>",
            success: function(data) {
                let obat = jQuery.parseJSON(data);
                let nama_obat = obat[0];
                let stok_obat = obat[1];

                /* MUNCULIN NOTIF JIKA STOK OBAT < 10 */
                stok_obat.forEach(cekStok);

                function cekStok(value) {
                    if (value < 10) {
                        $("#row").removeClass('d-none');
                        $("div.alert").addClass('show');
                        $("#notif").removeClass('d-none');
                        $("#notif").addClass('d-sm-inline-block');
                        $("#notif").css('color', '#721c24');
                    } else {
                        $("#notif").removeClass('d-sm-inline-block');
                        $("#notif").addClass('d-none');
                    }
                }

                var ctx = document.getElementById('rekap_stok_obat').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: nama_obat,
                        datasets: [{
                            label: [],
                            data: stok_obat,
                            backgroundColor: ['rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)',
                                'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)',
                                'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)',
                                'rgba(255, 99, 132, 0.87)',
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
                                'rgba(255, 159, 64, 0.87)',
                                'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)',
                                'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)',
                                'rgba(255, 99, 132, 0.87)',
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
                        scales: {
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true,
                                    stepValue: 5
                                }
                            }]
                        }
                    }
                });
            }
        })
    })
</script>

<!-- SCROLL TO REKAP STOK OBAT -->
<script>
    $(document).ready(function() {
        // Add smooth scrolling to all links
        $("#notif").on('click', function(event) {
            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function() {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    // window.location.hash = hash;
                });
            } // End if
        });
    });
</script>

<!-- CHART REKAP TINDAKAN -->
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('dashboard/fetch_rekap_tindakan') ?>",
            success: function(data) {
                let data_tindakan = jQuery.parseJSON(data);
                let total_tindakan = data_tindakan[0];
                let nama_tindakan = data_tindakan[1];

                var ctx = document.getElementById('rekap_tindakan').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: nama_tindakan,
                        datasets: [{
                            label: [],
                            data: total_tindakan,
                            backgroundColor: ['rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)',
                            ],
                            borderColor: ['rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)', 'rgba(255, 99, 132, 0.87)',
                                'rgba(54, 162, 235, 0.87)',
                                'rgba(255, 206, 86, 0.87)',
                                'rgba(75, 192, 192, 0.87)',
                                'rgba(153, 102, 255, 0.87)',
                                'rgba(255, 159, 64, 0.87)',
                            ]
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true,
                                    stepValue: 5,
                                    fontSize: 8
                                }
                            }],
                            xAxes: [{
                                stacked: true,
                                ticks: {
                                    beginAtZero: true,
                                    suggestedMax: 10,
                                    stepValue: 5,
                                    fontSize: 8
                                }
                            }]
                        }
                    }
                });
            }
        })
    })
</script>