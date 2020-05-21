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
                    <p><?= $perawat['nama']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>No. Telp</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['no_telp']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Alamat</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['alamat']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Email</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['email']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Tempat Lahir</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['tempat_lahir']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Username</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['username']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Tanggal Lahir</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['tanggal_lahir']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>No. STR</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['no_str']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Jenis Kelamin</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <?php if ($perawat['jenis_kelamin'] == 1) {
                        $perawat['jenis_kelamin'] = "Laki-laki";
                    } else {
                        $perawat['jenis_kelamin'] = "Perempuan";
                    } ?>
                    <p><?= $perawat['jenis_kelamin']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Tanggal Berlaku STR</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p><?= $perawat['tanggal_berlaku_str']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->