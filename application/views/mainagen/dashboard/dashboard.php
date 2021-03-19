<?php

$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);

?>

<div class="row">
    <div class="col-lg-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Rp. <?php echo number_format($user->user_saldo, 0, ",", ","); ?></h3>

                <p>Saldo</p>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>530</h3>

                <p>Total Transaksi</p>
            </div>
            <div class="icon">
                <i class="fa fa-shipping-fast"></i>
            </div>
            <a href=" #" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
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