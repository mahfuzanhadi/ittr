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
                    <p>: <?= $staf['nama']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>No. Telp</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $staf['no_telp']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Alamat</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $staf['alamat']; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Email</b></label">
                </div>
                <div class="form-group col-sm-3">
                    <p>: <?= $staf['email']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Tanggal Lahir</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <?php setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $tanggal_lahir = strftime("%d %B %Y", strtotime($staf['tanggal_lahir'])) . "\n"; ?>
                    <p>: <?= $tanggal_lahir; ?></p>
                </div>
                <div class="form-group col-sm-2">
                    <label"><b>Username</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <p>: <?= $staf['username']; ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-sm-2">
                    <label"><b>Jenis Kelamin</b></label">
                </div>
                <div class="form-group col-sm-2">
                    <?php if ($staf['jenis_kelamin'] == 1) {
                        $staf['jenis_kelamin'] = "Laki-laki";
                    } else {
                        $staf['jenis_kelamin'] = "Perempuan";
                    } ?>
                    <p>: <?= $staf['jenis_kelamin']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->