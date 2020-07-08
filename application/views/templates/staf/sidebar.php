<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tooth"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Riona Dental Care</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Staf Administrasi
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-notes-medical"></i>
            <span>Rekam Medis</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-bed"></i>
            <span>Data Pasien</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Data Dokter</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-user-nurse"></i>
            <span>Data Perawat</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventaris" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Inventaris</span>
        </a>
        <div id="collapseInventaris" class="collapse" aria-labelledby="headingInventaris" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html"><i class="fas fa-fw fa-pills"></i>&nbsp&nbspObat</a>
                <a class="collapse-item" href="cards.html"><i class="fas fa-fw fa-hospital"></i>&nbsp&nbspAlat dan Bahan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRekap" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Rekapitulasi</span>
        </a>
        <div id="collapseRekap" class="collapse" aria-labelledby="headingRekap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html"><i class="fas fa-fw fa-notes-medical"></i>&nbsp&nbsp Rekam Medis</a>
                <a class="collapse-item" href="cards.html"><i class="fas fa-fw fa-bed"></i>&nbsp&nbsp Pasien</a>
                <a class="collapse-item" href="cards.html"><i class="fas fa-fw fa-boxes"></i>&nbsp&nbsp Inventaris</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Profile
    </div>

    <!-- Nav Item - My Profile -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-user"></i>
            <span>My Profile</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Edit Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->