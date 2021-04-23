<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Invoice Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/template/admin/plugins/bootstrap/css/bootstrap.min.css">

    <style>
        @media print {
            .noPrint {
                display: none;
            }
        }

        h1 {
            color: #f6f6;
        }
    </style>

</head>

<body>

    <div class="">
        <?php $meta = $this->meta_model->get_meta(); ?>
        <!-- Main content -->
        <div class="card">
            <div class="card-header">
                <img src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"><br>
                Nomor Resi : <strong><?php echo $transaksi->nomor_resi; ?></strong>
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
                            Jakarta Selatan, DKI Jakarta 1556<br>
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
                            Semarang, Jawa Tengah 1432<br>
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
                        <b>Tanggal Order :</b> <?php echo tanggal_indonesia_lengkap(date('Y-m-d', strtotime($transaksi->date_created))); ?> <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?><br>

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

                <p class="font-weight-bold col-md-12">Detail Paket</p>

                <div class="row invoice-info alert alert-success">
                    <div class="col-sm-4 invoice-col">
                        <div class="row">
                            <div class="col-4">
                                Layanan
                            </div>
                            <div class="col-8">
                                : <?php echo $transaksi->product_name; ?>
                            </div>
                            <div class="col-4">
                                Nama
                            </div>
                            <div class="col-8">
                                : <?php echo $transaksi->nama_barang; ?>
                            </div>
                            <div class="col-4">
                                Jenis
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
                    </div>
                    <!-- /.col -->
                </div>


            </div>





            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-12">
                    <a href="<?php echo base_url('counter/transaksi/detail/' . $transaksi->id); ?>" rel="noopener" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button onclick="window.print();" class="noPrint btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.invoice -->


    <!--  

    <script>
        window.addEventListener("load", window.print());
    </script> -->


</body>

</html>