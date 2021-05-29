<?php

$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);

?>

<div class="row">


    <div class="col-md-12">

        <a href="<?php echo base_url('mainagen/transaksi'); ?>">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-archive"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Ambil Paket</span>
                </div>
            </div>
        </a>

    </div>


    <div class="col-lg-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Rp. <?php echo number_format($user->saldo_mainagen, 0, ",", ","); ?></h3>
                <p>Saldo</p>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo count($count_alltransaksi_mainagen); ?></h3>
                <p>Total Transaksi</p>
            </div>
            <div class="icon">
                <i class="fa fa-shipping-fast"></i>
            </div>
            <a href=" #" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


</div>

<div class="card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <h3 class="card-title">Jumlah Order Per Hari</h3>
            <a href="<?php echo base_url('counter/transaksi/riwayat'); ?>">Lihat Riwayat</a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <p class="d-flex flex-column">
                <span class="text-bold text-lg"><?php echo count($count_alltransaksi_mainagen); ?></span>
                <span>Order</span>
            </p>

        </div>


        <div class="position-relative mb-4">
            <canvas id="sales-chart" height="200"></canvas>
        </div>

        <div class="d-flex flex-row justify-content-end">
            <span class="mr-2">
                <i class="fas fa-square text-primary"></i> Data Per Hari
            </span>

        </div>
    </div>
</div>