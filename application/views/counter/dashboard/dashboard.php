<?php

$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);

?>

<div class="row">

    <div class="col-md-12">

        <a href="<?php echo base_url('counter/transaksi/create'); ?>">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-archive"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Buat Paket Baru</span>
                </div>
            </div>
        </a>
    </div>

    <?php if ($user->deposit_counter <= 0) : ?>
        <div class="col-lg-10">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Rp. <?php echo number_format($user->deposit_counter, 0, ",", ","); ?></h3>
                    <p>Deposit</p>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <a href="<?php echo base_url('counter/saldo'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    <?php else : ?>
        <div class="col-lg-10">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>Rp. <?php echo number_format($user->deposit_counter, 0, ",", ","); ?></h3>
                    <p>Deposit</p>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <a href="<?php echo base_url('counter/saldo'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php endif; ?>



    <div class="col-lg-2">

        <a href="<?php echo base_url('counter/topup'); ?>" class="small-box-footer" style="color: transparent;">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Top Up</h3>

                    <p style="color:transparent">Total Transaksi</p>
                </div>
                <div class="icon">
                    <i class="fa fa-arrow-circle-up"></i>
                </div>
                <i class="fas fa-arrow-circle-right" style="color: transparent;"></i>
            </div>
        </a>
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
                <span class="text-bold text-lg"><?php echo count($count_alltransaksi_counter); ?></span>
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