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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/smart_wizard_theme_arrows.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/smart_wizard_theme_circles.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/smart_wizard_theme_dots.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap.min.css" />
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/smartwizard@4.4.1/dist/css/smart_wizard.min.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/dataRender/datetime.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/time.js"></script>

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css"> -->
    <style>
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

        #total_data_omzet {
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
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">