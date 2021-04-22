<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>

<!-- Query Menu -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">

    <span class="brand-text font-weight-light">Admin Express</span>
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
      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>admin/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="<?php echo base_url(); ?>admin/transaksi" class="nav-link">
            <i class="nav-icon fas fa-receipt"></i>
            <p>
              Transaksi
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>admin/category" class="nav-link">
            <i class="nav-icon fas fa-tag"></i>
            <p>
              Category Barang
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Master
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/provinsi" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Provinsi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/kota" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kota</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
              Data Pengguna
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/user" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Admin Pusat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/mainagen" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Main Agen</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/counter" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Counter</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/kurirpusat" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kurir Pusat</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url(); ?>admin/kurir" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Kurir</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Agen</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/boxed.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Product Type</p>
              </a>
            </li> -->
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-ninja"></i>
            <p>
              Akun
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('admin/profile'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/profile/update'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Update</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/profile/password'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ubah Password</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url('admin/galery'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider Home</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/meta'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile Situs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/meta/logo'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Logo Situs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/meta/favicon'); ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Favicon</p>
              </a>
            </li>


          </ul>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>admin/pengaturan" class="nav-link">
            <i class="far fa-envelope nav-icon"></i>
            <p>Pengaturan Email</p>
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
            <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/' . $this->uri->segment(2)) ?>">
                <?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?>
              </a></li>
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