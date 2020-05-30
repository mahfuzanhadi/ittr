<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data profil <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h5><?= $title; ?></h5>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Nama</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $dokter['nama']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Username</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $dokter['username']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Alamat</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $dokter['alamat']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>No. SIP</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $dokter['no_sip']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Tempat, Tanggal Lahir</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $tanggal_lahir = strftime("%d %B %Y", strtotime($dokter['tanggal_lahir'])) . "\n"; ?>
                    <p>: <?= $dokter['tempat_lahir'] . ', ' . $tanggal_lahir ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Tanggal Berlaku SIP</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $tanggal_berlaku_sip = strftime("%d %B %Y", strtotime($dokter['tanggal_berlaku_sip'])) . "\n"; ?>
                    <p>: <?= $tanggal_berlaku_sip; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Jenis Kelamin</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <?php if ($dokter['jenis_kelamin'] == 1) {
                        $dokter['jenis_kelamin'] = "Laki-laki";
                    } else {
                        $dokter['jenis_kelamin'] = "Perempuan";
                    } ?>
                    <p>: <?= $dokter['jenis_kelamin']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>No. STR</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $dokter['no_str']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>No. Telp</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $dokter['no_telp']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Tanggal Berlaku STR</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $tanggal_berlaku_str = strftime("%d %B %Y", strtotime($dokter['tanggal_berlaku_str'])) . "\n"; ?>
                    <p>: <?= $tanggal_berlaku_str; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Email</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $dokter['email']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->