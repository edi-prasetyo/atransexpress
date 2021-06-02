<?php $meta = $this->meta_model->get_meta(); ?>

<style>
    label {
        font-size: 20px;
    }

    @media print {
        label {
            font-size: 10px;
        }
    }
</style>
<!-- Main content -->


<div id="print-area">
    <div class="card">
        <div class="card-header row invoice-info">
            <div class="col-sm-6 invoice-col text-left"> <img src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"><br>
                Nomor Resi : <strong><?php echo $transaksi->nomor_resi; ?></strong></div>
            <div class="col-sm-6 invoice-col text-right">
                <h4><b><?php echo $meta->title; ?></b></h4>
                <?php echo $meta->tagline; ?><br>

            </div>
        </div>
        <div class="card-body">
            <!-- title row -->

            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Pengirim
                    <address>
                        <strong><?php echo $transaksi->nama_pengirim; ?> </strong><br>
                        <?php echo $transaksi->alamat_pengirim; ?><br>
                        <?php echo $transaksi->kota_from; ?> - <?php echo $transaksi->kodepos_pengirim; ?><br>
                        Phone: <?php echo $transaksi->telp_pengirim; ?><br>
                        Email: <?php echo $transaksi->email_pengirim; ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Penerima
                    <address>
                        <strong><?php echo $transaksi->nama_penerima; ?></strong><br>
                        <?php echo $transaksi->alamat_penerima; ?><br>
                        <?php echo $transaksi->kota_name; ?> - <?php echo $transaksi->kodepos_penerima; ?><br>
                        Phone: <?php echo $transaksi->telp_penerima; ?><br>
                        Email: <?php echo $transaksi->email_penerima; ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Info Agen <br>
                    <b>Nama Counter Agen :</b> <?php echo $transaksi->name; ?><br>
                    <b>ID Counter Agen :</b> <?php echo $transaksi->user_code; ?><br>
                    <b>Telp Counter Agen :</b> <?php echo $transaksi->user_phone; ?><br>
                    <b>Tanggal Order :</b> <?php echo date('d/m/Y', strtotime($transaksi->date_created)); ?> <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?><br>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Detail Paket -->
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                        <tr>

                            <th scope="col">Berat Paket</th>
                            <th scope="col">Ongkos Kirim</th>
                            <th scope="col">Asuransi</th>
                            <th scope="col">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                            <td><?php echo $transaksi->berat; ?> Kg</td>
                            <td>Rp. <?php echo number_format($transaksi->harga, 0, ",", "."); ?></td>
                            <td>Rp. <?php echo number_format($transaksi->nilai_asuransi, 0, ",", "."); ?></td>
                            <td>Rp. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End Detail Paket -->


            <p class="font-weight-bold col-md-12">Detail Barang</p>

            <div class="row invoice-info border card-body">
                <div class="col-sm-4 invoice-col">
                    <div class="row">
                        <div class="col-4">
                            Layanan
                        </div>
                        <div class="col-8">
                            : <?php echo $transaksi->product_name; ?>
                        </div>
                        <div class="col-4">
                            Nama Barang
                        </div>
                        <div class="col-8">
                            : <?php echo $transaksi->nama_barang; ?>
                        </div>
                        <div class="col-4">
                            Jenis Barang
                        </div>
                        <div class="col-8">
                            : <?php echo $transaksi->category_name; ?>
                        </div>

                    </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <div class="row">
                        <div class="col-4">
                            Berat
                        </div>
                        <div class="col-8">
                            : <?php echo $transaksi->berat; ?> Kg
                        </div>
                        <div class="col-4">
                            Asuransi
                        </div>
                        <div class="col-8">
                            :
                            <?php if ($transaksi->asuransi == 0) : ?>
                                Tidak
                            <?php else : ?>
                                Ya
                            <?php endif; ?>
                        </div>
                        <div class="col-4">
                            Nilai Barang
                        </div>
                        <div class="col-8">
                            : Rp. <?php echo number_format($transaksi->nilai_barang, 0, ",", "."); ?>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>">
                </div>
                <!-- /.col -->
            </div>

            <div class="text-center">Terima Kasih Telah Menggunakan Jasa Layanan Kami, <br>Untuk Melacak Paket Anda silahkan kunjungi <?php echo $meta->link; ?> dan masukan nomor resi yang tertera</div>

        </div>
    </div>
</div>

<div class="col-12 p-3">
    <button type="button" onclick="printDiv('print-area')" class="btn btn-outline-primary"><i class="fa fa-print"></i> Print Resi</button>
</div>

<!-- /.invoice -->

<div class="card">
    <div class="card-header">
        Posisi Paket
    </div>

    <div class="table-responsive">
        <table class="table table-striped track_tbl">
            <thead>
                <tr>
                    <th></th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Posisi</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($lacak as $lacak) : ?>
                    <tr>
                        <td class="track_dot">
                            <span class="track_line"></span>
                        </td>
                        <td><b><?php echo date('d/m/Y', strtotime($lacak->date_updated)); ?>
                                <?php echo date('H:i:s', strtotime($lacak->date_updated)); ?> WIB</b></td>
                        <td>
                            <?php echo $lacak->lacak_desc; ?> - <span class="text-danger">
                                <?php echo $lacak->user_phone; ?> <?php echo $lacak->name; ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>



<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>