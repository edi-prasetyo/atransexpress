<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php echo count($count_transaksi); ?></h3>

        <p>Transaksi</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="<?php echo base_url('admin/transaksi'); ?>" class="small-box-footer">Lihat Semua <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3><?php echo count($count_kota); ?></h3>

        <p>Jumlah Kota</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?php echo count($count_agen); ?></h3>

        <p>Main Agen</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?php echo count($count_counter); ?></h3>

        <p>Counter Agen</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <!-- ./col -->
</div>


<div class="card">
  <div class="card-header border-0">
    <div class="d-flex justify-content-between">
      <h3 class="card-title">Jumlah Order 7 Hari Terakhir</h3>
      <a href="<?php echo base_url('admin/transaksi/riwayat'); ?>">Lihat Riwayat</a>
    </div>
  </div>
  <div class="card-body">
    <div class="d-flex">
      <p class="d-flex flex-column">
        <span class="text-bold text-lg"><?php echo count($count_alltransaksi); ?></span>
        <span>Order</span>
      </p>

    </div>


    <div class="position-relative mb-4">
      <canvas id="sales-chart" height="200"></canvas>
    </div>

    <div class="d-flex flex-row justify-content-end">
      <span class="mr-2">
        <i class="fas fa-square text-primary"></i> Dalam Bulan
      </span>


    </div>
  </div>
</div>