<?php
$meta = $this->meta_model->get_meta();

// error_reporting(0);
// ini_set('display_errors', 0);
?>
<div class="breadcrumb-default">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="margin-top container">
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h2>Contact Us</h2>
                <p>Untuk Informasi dan Pemesanan Silahkan Hubungi Kami melalui</p>
                <ul>
                    <li>
                        <i class="ti-home"></i> <?php echo $meta->alamat;?></li>
                    <li><i class="fa fa-phone"></i> <?php echo $meta->telepon;?></li>
                  
                </ul>
            </div>
        </div>
    </div>
</div>