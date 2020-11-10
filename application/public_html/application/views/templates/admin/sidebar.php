<!-- Sidebar -->
<?php
$url = $this->uri->segment(1);
$url2 = $this->uri->segment(2);
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <img src="<?= base_url('assets/img/logordc_white.png'); ?>" width="64px" height="50px">
        <div class="sidebar-brand-text mx-2">
            <img src="<?= base_url('assets/img/rdc_white.png'); ?>" width="112px" height="50px">
        </div>
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($url === 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Data Transaksi -->
    <li class="nav-item <?= ($url === 'transaksi') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('transaksi'); ?>">
            <i class="fas fa-fw fa-notes-medical"></i>
            <span>Data Transaksi</span></a>
    </li>

    <li class="nav-item <?= ($url === 'pasien') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('pasien'); ?>">
            <i class="fas fa-fw fa-bed"></i>
            <span>Data Pasien</span></a>
    </li>

    <li class="nav-item <?= ($url === 'obat') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('obat'); ?>">
            <i class="fas fa-fw fa-pills"></i>
            <span>Data Obat</span></a>
    </li>

    <li class="nav-item <?= ($url === 'tindakan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('tindakan'); ?>">
            <i class="fas fa-fw fa-syringe"></i>
            <span>Data Tindakan</span></a>
    </li>

    <li class="nav-item <?= ($url === 'bahan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('bahan'); ?>">
            <i class="fas fa-fw fa-briefcase-medical"></i>
            <span>Data Alat dan Bahan</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($url === 'perawat' || $url === 'dokter' || $url === 'staff') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Data User</span>
        </a>
        <div id="collapseUser" class="collapse <?= ($url === 'perawat' || $url === 'dokter' || $url === 'staff') ? 'show' : '' ?>" aria-labelledby="headingUser" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= ($url === 'dokter') ? 'active' : '' ?>" href="<?= base_url('dokter'); ?>"><i class="fas fa-fw fa-user-md"></i>&nbsp&nbspData Dokter</a>
                <a class="collapse-item <?= ($url === 'perawat') ? 'active' : '' ?>" href="<?= base_url('perawat'); ?>"><i class="fas fa-fw fa-user-nurse"></i>&nbsp&nbspData Perawat</a>
                <a class="collapse-item <?= ($url === 'staff') ? 'active' : '' ?>" href="<?= base_url('staff'); ?>"><i class="fas fa-fw fa-user-cog"></i>&nbsp&nbspData Staf Administrasi</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($url === 'iobat' || $url === 'ibahan') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventaris" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventaris</span>
        </a>
        <div id="collapseInventaris" class="collapse <?= ($url === 'iobat' || $url === 'ibahan') ? 'show' : '' ?>" aria-labelledby="headingInventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?= ($url === 'iobat') ? 'active' : '' ?>" href="<?= base_url('iobat'); ?>"><i class="fas fa-fw fa-pills"></i>&nbsp&nbspObat</a>
                <a class="collapse-item <?= ($url === 'ibahan') ? 'active' : '' ?>" href="<?= base_url('ibahan'); ?>"><i class="fas fa-fw fa-briefcase-medical"></i>&nbsp&nbspAlat dan Bahan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profil
    </div>

    <!-- Nav Item - My Profile -->
    <li class="nav-item <?= ($url2 === 'profil') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/profil'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Saya</span></a>
    </li>
    <li class="nav-item <?= ($url2 === 'edit_profil') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('admin/edit_profil'); ?>">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Edit Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->