<!-- Sidebar -->
<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
    <div class="sidebar-brand-icon">
      <i class="fas fa-mail-bulk"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SIP <sup>PNL 1B</sup></div>
  </a>


  <!-- Divider -->
  <hr class="sidebar-divider">
  
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
      <a class="nav-link pb-0" href="<?= base_url('home/index') ?>">
        <i class="fas fa-fw fa-chart-bar"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- BAB I PENDAHULUAN -->
    <li class="nav-item">
      <a class="nav-link pb-0 collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <i class="fas fa-fw fa-book"></i>
        <span>BAB I</span>
      </a>
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">A. Dasar Pelaksanaan </a>
          <a class="collapse-item" href="">B. Ruang Lingkup </a>
          <a class="collapse-item" href="">C. Tujuan </a>
          <a class="collapse-item" href="">D. Metodologi </a>
        </div>
      </div>
    </li>

    <!--BAB II -->
    <li class="nav-item">
      <a class="nav-link pb-0 collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-book "></i>
        <span>BAB II</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="">Kondisi</a>
          <a class="collapse-item" href="">Kriteria</a>
          <a class="collapse-item" href="">Sebab</a>
        </div>
      </div>
    </li>

    <!-- Cetak-->
    <li class="nav-item">
      <a class="nav-link pb-0 collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
        <i class="fas fa-fw fa-print"></i>
        <span>Cetak</span>
      </a>
    </li>

<!-- ubah Profle -->
    <li class="nav-item">
      <a class="nav-link collapsed pb-0" href="<?= base_url('user'); ?>">
        <i class="fas fa-fw fa-user"></i>
        <span>User Profile</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed pb-0" href="<?= base_url('user/ubah-password'); ?>">
        <i class="fas fa-fw fa-key"></i>
        <span>Ubah Password</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-fw fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button aria-label="toggler" class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->