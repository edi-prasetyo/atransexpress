<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>

<!-- Query Menu -->



<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('kurirpusat/dashboard'); ?>" class="brand-link">

    <span class="brand-text font-weight-light">Atrans Express</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if ($user->user_image == NULL) : ?>
          <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/img/avatars/default.jpg') ?>" alt="User profile picture">
        <?php else : ?>
          <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" class="img-circle elevation-2" alt="User Image">


        <?php endif; ?>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $user->name; ?></a>
        <span class="text-light badge badge-success badge-pill"><?php echo $user->role; ?></span><br>
        <span class="text-light badge badge-info badge-pill"><?php echo $user->kota_name; ?></span>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>kurirpusat/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>kurirpusat/transaksi" class="nav-link">
            <i class="nav-icon fas fa-truck"></i>
            <p>
              Ambil Paket
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>kurirpusat/transaksi/kirim" class="nav-link">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Kirim Paket
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>kurirpusat/transaksi/riwayat" class="nav-link">
            <i class="nav-icon fas fa-history"></i>
            <p>
              Riwayat
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Setings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('kurirpusat/profile'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url('kurirpusat/profile/password'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ubah Password</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>auth/logout" class="nav-link btn bg-gradient-danger text-left">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><?php echo $title; ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard') ?>"> Dashboard</a></li>
            <li class="breadcrumb-item active">
              <?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?>
            </li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->




  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">