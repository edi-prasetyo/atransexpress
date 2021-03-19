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
            <b>ID Agen:</b> <?php echo $transaksi->counter_code; ?><br>
            <b>Order ID:</b> <?php echo $transaksi->id; ?><br>
            <b>Tanggal Order :</b> <?php echo date('d/m/Y', $transaksi->date_created); ?> <?php echo date('H:i:s', $transaksi->date_created); ?><br>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->



    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
            <p class="font-weight-bold">Tracking Paket</p>
            Status : <?php if ($transaksi->stage == 9) : ?><span class="badge badge-success">Selesai</span> <?php else : ?> <span class="badge badge-danger">Proses</span> <?php endif; ?><br>
            Posisi : <?php echo $transaksi->status; ?>
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
    <!-- /.row -->

    <!-- this row will not appear when printing -->
    <!-- <div class="row no-print">
        <div class="col-12">
            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

        </div>
    </div> -->
</div>
<!-- /.invoice -->