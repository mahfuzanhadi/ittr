<!-- Sidebar -->
<?php
$url = $this->uri->segment(1);
$url2 = $this->uri->segment(2);
?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('transaksi'); ?>">
        <img src="<?= base_url('assets/img/logordc_white.png'); ?>" width="64px" height="50px">
        <div class="sidebar-brand-text mx-2">
            <img src="<?= base_url('assets/img/rdc_white.png'); ?>" width="112px" height="50px">
        </div>
    </a>

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Rekap Data -->
    <li class="nav-item <?= ($url === 'rekap') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('rekap'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Rekap Data</span></a>
    </li>

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

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profil
    </div>

    <!-- Nav Item - My Profile -->
    <li class="nav-item <?= ($url2 === 'profil') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('perawat/profil'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil Saya</span></a>
    </li>
    <li class="nav-item <?= ($url2 === 'edit_profil') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('perawat/edit_profil'); ?>">
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