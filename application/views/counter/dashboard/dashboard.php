<?php

$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);

?>

<div class="row">
    <div class="col-lg-10">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Rp. <?php echo number_format($user->user_deposit, 0, ",", ","); ?></h3>

                <p>Deposit</p>
            </div>
            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2">
        <!-- small box -->
        <a href=" #" class="small-box-footer" style="color: transparent;">
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
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>

                <p>Total Counter</p>
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
                <h3>65</h3>

                <p>Total Kurir</p>
            </div>
            <div class="icon">
                <i class="fa fa-motorcycle"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Total Kurir</p>
            </div>
            <div class="icon">
                <i class="fa fa-tags"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>

                <p>Total Kurir</p>
            </div>
            <div class="icon">
                <i class="fa fa-calendar"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>