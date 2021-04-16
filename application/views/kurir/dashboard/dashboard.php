<div class="row">

    <div class="col-lg-12">

        <a href="<?php echo base_url('kurir/transaksi'); ?>">
            <div class="info-box mb-3 bg-success">
                <span class="info-box-icon"><i class="fas fa-shipping-fast"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Terima Paket</span>

                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
    </div>

    <div class="col-lg-12">

        <a href="<?php echo base_url('kurir/transaksi/kirim'); ?>">
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="fas fa-motorcycle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-number">Kirim Paket</span>

                </div>
                <!-- /.info-box-content -->
            </div>
        </a>
    </div>


</div>

<div class="card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <h3 class="card-title">Jumlah Kiriman Per Bulan</h3>
            <a href="<?php echo base_url('kurir/transaksi/riwayat'); ?>">Lihat Riwayat</a>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex">
            <p class="d-flex flex-column">
                <span class="text-bold text-lg"><?php echo count($count_alltransaksi_kurir); ?></span>
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