<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4>
                Atrans Express
                <small class="float-right">Nomor Resi : <?php echo $transaksi->nomor_resi; ?></small>
            </h4>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Pengirim
            <address>
                <strong><?php echo $transaksi->nama_pengirim; ?> </strong><br>
                <?php echo $transaksi->alamat_pengirim; ?><br>
                Jakarta Selatan, DKI Jakarta 1556<br>
                Phone: <?php echo $transaksi->telp_pengirim; ?><br>
                Email: info@almasaeedstudio.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Penerima
            <address>
                <strong><?php echo $transaksi->nama_penerima; ?></strong><br>
                <?php echo $transaksi->alamat_penerima; ?><br>
                Semarang, Jawa Tengah 1432<br>
                Phone: <?php echo $transaksi->telp_penerima; ?><br>
                Email: john.doe@example.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            Info Agen <br>
            <br>
            <b>Nama Agen :</b> <?php echo $transaksi->name; ?><br>
            <b>ID Agen:</b> <?php echo $transaksi->user_code; ?><br>
            <b>Order ID:</b> <?php echo $transaksi->id; ?><br>
            <b>Tanggal Order :</b> <?php echo tanggal_indonesia_lengkap('Y-m-d', strtotime($transaksi->date_created)); ?> <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?><br>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->



    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
            <p class="font-weight-bold">Tracking Paket</p>
            Status :
            <?php if ($transaksi->stage == 9) : ?>
                <span class="badge badge-success">Selesai</span> <br>
                <img src="<?php echo base_url('assets/img/transaksi/' . $transaksi->foto); ?>">
            <?php else : ?> <span class="badge badge-danger">Proses</span> <?php endif; ?><br>
            Kurir :
            <?php if ($transaksi->stage == 7) : ?>
                Paket Belum di Ambil Kurir <?php echo $transaksi->name; ?>
            <?php elseif ($transaksi->stage == 8) : ?>
                Paket Sudah di Ambil <?php echo $transaksi->name; ?>
            <?php endif; ?>

        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="font-weight-bold">Detail Pembayaran</p>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Berat Paket :</th>
                        <td> <?php echo $transaksi->berat; ?> Kg</td>
                    </tr>
                    <tr>
                        <th style="width:50%">Total Harga:</th>
                        <td>Rp. <?php echo number_format($transaksi->harga, 0, ",", "."); ?></td>
                    </tr>


                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>

    <div class="col-md-12">


        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Posisi</th>
                        <th scope="col">Contact</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lacak as $lacak) : ?>
                        <tr>
                            <td><b><?php echo tanggal_indonesia_lengkap('Y-m-d', strtotime($transaksi->date_updated)); ?>
                                    <?php echo date('H:i:s', strtotime($lacak->date_updated)); ?></b></td>
                            <td>
                                <?php echo $lacak->lacak_desc; ?> <?php echo $lacak->name; ?></td>
                            <td>
                                <i class="fa fa-phone"></i> <?php echo $lacak->user_phone; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>



    </div>


    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <!-- <div class="row no-print">
        <div class="col-12">
            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

        </div>
    </div> -->
</div>
<!-- /.invoice -->