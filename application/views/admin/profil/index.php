<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!--   <div class="card mb-3" style="max-width: 640px;">
        <div class="row no-gutters">
            <div class="col-md-3">
                <img src="<?= base_url('assets/img/profile/avatar.png'); ?>" class="card-img">
            </div>
            <div class="col-md-8">
                <div class="card-body" style="margin-left: 30px">
                    <h5 class="card-title"><?= $staf['nama']; ?></h5>
                    <p class="card-text">Email : <?= $staf['email']; ?></p>
                    <p class="card-text">Alamat : <?= $staf['alamat']; ?></p>
                    <p class="card-text">Tanggal lahir : <?= $staf['tanggal_lahir']; ?></p>
                    <?php $umur = date('Y-m-d') - $staf['tanggal_lahir']; ?>
                    <p class="card-text">Umur : <?= $umur; ?></p>
                    <?php if ($staf['jenis_kelamin'] == 1) {
                        $jk = "Laki-laki";
                    } else {
                        $jk = "Perempuan";
                    } ?>
                    <p class="card-text">Jenis Kelamin : <?= $jk ?></p>
                    <p class="card-text">No. telp : <?= $staf['no_telp']; ?></p>
                    <p class="card-text"><small class="text-muted">Username : <?= $staf['username']; ?></small></p>
                </div>
            </div>
        </div>
    </div> -->

    <div class="card" style="width: 18rem;">
        <div class="card-header">
            <h5></h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Nama : <?= $admin['nama']; ?></li>
            <li class="list-group-item">E-mail : <?= $admin['email']; ?></li>
            <li class="list-group-item">Username : <?= $admin['username']; ?></li>
        </ul>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->