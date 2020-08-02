<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>
    <link rel="icon" href="<?= base_url() ?>/favicon.png" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <link href="<?= base_url('assets/'); ?>css/smart_wizard_theme_arrows.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/smart_wizard_theme_circles.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/smart_wizard_theme_dots.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap.min.css" />
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> -->
    <style>
        .custom-select-sm {
            font-size: 100% !important;
            padding-top: .2rem;
            padding-left: 0.5rem;
            text-align: center;
        }

        .form-control {
            padding-left: 0.5rem;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 35%;
        }

        .box {
            width: 800px;
            margin: 0 auto;
        }

        .active_tab1 {
            background-color: #fff;
            color: #333;
            font-weight: 600;
        }

        .inactive_tab1 {
            background-color: #f5f5f5;
            color: #333;
            cursor: not-allowed;
        }

        .has-error {
            border-color: #cc0000;
            background-color: #ffff99;
        }

        .table.dataTable {
            font-size: 15px;
        }

        #total_data {
            margin-bottom: 0rem !important;
            font-weight: 400;
            font-size: 16px;
            color: rgba(75, 192, 192, 1);
        }

        .canvas_kunjungan {
            width: 100% !important;
            height: 320px !important;
        }

        .canvas_omzet {
            width: 100% !important;
            height: 320px !important;
        }

        .canvas_tindakan {
            width: 100% !important;
            height: 920px !important;
        }

        .canvas_stok_obat {
            width: 100% !important;
            height: 330px !important;
        }

        .canvas_pasien_jk {
            display: block;
            height: 200px !important;
            width: 100% !important;
        }

        .canvas_pasien_umur {
            display: block;
            height: 320px !important;
            width: 100% !important;
        }

        .canvas_metode_pembayaran {
            display: block;
            height: 125px !important;
            width: 100% !important;
        }

        @media only screen and (max-width: 800px) {
            .chart-pie {
                height: 10rem !important;
            }

            .canvas_kunjungan {
                display: block;
                height: 150px !important;
                width: 100% !important;
            }

            .canvas_omzet {
                display: block;
                height: 150px !important;
                width: 100% !important;
            }

            .canvas_pasien_umur {
                display: block;
                height: 150px !important;
                width: 100% !important;
            }

            .canvas_pasien_jk {
                display: block;
                height: 150px !important;
                width: 100% !important;
            }

            .canvas_tindakan {
                display: none;
            }

            #card_tindakan {
                display: none;
            }

            .canvas_stok_obat {
                display: block;
                height: 130px !important;
                width: 100% !important;
            }

            .canvas_riwayat_penyakit {
                display: block;
                height: 10rem !important;
                width: 100% !important;
            }

            .canvas_alergi_obat {
                display: block;
                height: 10rem !important;
                width: 100% !important;
            }
        }

        .select2-container .select2-selection--single {
            height: calc(1.8125rem + 2px) !important;
            border: 1px solid #ced4da !important;
            border-radius: 0.2rem !important;
            width: 100% !important;
        }

        #btn_rekam_medis {
            margin-top: 20px !important;
        }

        #previous_btn_tindakan {
            margin-top: 20px !important;
        }

        #btn_detail_tindakan {
            margin-top: 20px !important;
        }

        #previous_btn_obat {
            margin-top: 20px !important;
        }

        #btn_detail_obat {
            margin-top: 20px !important;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        $(window).resize(function() {
            if ($(window).width() <= 800) {
                $('#page-top').addClass('sidebar-toggled');
                $('#accordionSidebar').addClass('toggled');
            } else {
                $('#page-top').removeClass('sidebar-toggled');
                $('#accordionSidebar').removeClass('toggled');
            }
        });
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">