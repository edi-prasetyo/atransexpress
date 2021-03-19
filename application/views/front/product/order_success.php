<?php
$meta      = $this->meta_model->get_meta();
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
<div class="card">
    <div class="card-body">
        <div class="text-center">
        <div style="font-size:70px">Sukses</div>
            <h1 style="font-size:150px"><span class="text-success"><i class="ti-check-box"></i></span></h1><br>
<h3>Detail Pesanan</h3>
         
            Kode Transaksi : <br>
            <div class="alert alert-success"><strong><?php echo $last_transaksi->kode_transaksi;?></strong></div><br>
    
            <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <th>Item</th>
                <th>QTY</th>
                <th>Harga Unit</th>
                <th>Total Harga</th>
            </tr>
            <tr>
                <td><?php echo $last_transaksi->product_name;?></td>
                <td><?php echo $last_transaksi->product_qty;?> </a></td>
                <td>Rp. <?php echo number_format($last_transaksi->product_price,'0',',','.');?></td>
                <td>Rp. <?php $total = $last_transaksi->product_price * $last_transaksi->product_qty; echo number_format($total,'0',',','.'); ?></td>
            </tr>
            
            <tr>
                <th colspan="3"><span class="pull-right">Total</span></th>
                <th>Rp. <?php $total = $last_transaksi->product_price * $last_transaksi->product_qty; echo number_format($total,'0',',','.'); ?></th>
            </tr>
            <tr>
                
                <td colspan="4">Harga Belum Termasuk Ongkos Kirim dan Asuransi, Silahkan menghubungi Admin untuk Info lebih Lanjut<br>
                <b>Phone:</b> <?php echo $meta->telepon;?><br>
          <b>Email:</b> <?php echo $meta->email;?>
            
            </td>
            </tr>
        </tbody>
    </table>  
        Terima Kasih Telah Belanja di  <?php echo $meta->title;?>
        </div>
    </div>
</div>

</div>