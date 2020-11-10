<!-- Begin Page Content -->
<div class="container-fluid">

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
    <!-- Page Heading -->
    <h3 class="h3 mb-4 text-gray-800"><?= $title; ?></h3>

    <div class="card" style="width: 24rem;">
        <div class="card-header">
            <a href="<?= base_url("admin/edit_profil") ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit Profil</a>
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