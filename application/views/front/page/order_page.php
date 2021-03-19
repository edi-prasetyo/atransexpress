<?php
$meta = $this->meta_model->get_meta();
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
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- <h2>Cara Order</h2> -->
                <div class="row">
                    <div class="col-md-6">
                <img class="img-fluid" src="<?php echo base_url('assets/img/galery/cara-order.png');?>"> 
                </div>
                <div class="col-md-6">
                    <h3>Cara Order</h3>
                    <div style="line-height: 40px;">
                    <ol>
                        <li>Pilih Produk pada menu Produk lalu pilih salah satu jenis Produk Antam atau Minigold</li>
                        <li>Klik Order Produk, lalu klik tombol Beli emas</li>
                        <li>Isi data diri anda, lalu klik Order sekarang</li>
                        <li>Transfer Pembayaran</li>
                        <li>Konfirmasi Pembayaran dengan menghubungi Nomor whatsaap <?php echo $meta->telepon;?> </li>
                        <li>Produk akan di kirim ke data alamat yang anda input di point nomor 3  </li>

                    </ol>
                    </div>
                </div>
                </div>          
            </div>
        </div>
    </div>
</div>