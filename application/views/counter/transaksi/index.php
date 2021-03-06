<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th>Resi</th>
                            <th>Tujuan</th>
                            <!-- <th>Barcode</th> -->
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <td>
                                    <b> <?php echo $transaksi->nomor_resi; ?></b><br>
                                    <?php echo date('d/m/Y', strtotime($transaksi->date_created)); ?><br> <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?> WIB
                                </td>

                                <td><?php echo $transaksi->kota_name; ?><br>
                                    <span class="badge badge-warning">Menunggu Di Ambil</span><br>
                                    <b>Rp. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?></b>
                                </td>

                                <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>"></td> -->
                                <td>
                                    <a href="<?php echo base_url('counter/transaksi/detail/' . $transaksi->id); ?>" class="btn btn-primary btn-sm btn-block">
                                        <i class="fa fa-eye"></i> Lihat
                                    </a>
                                    <a href="<?php echo base_url('counter/transaksi/update/' . $transaksi->id); ?>" class="btn btn-success btn-sm btn-block">
                                        <i class="fa fa-edit"></i> Ubah
                                    </a>
                                    <?php include "cancel.php"; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white border-top">
                <ul class="pagination m-0">
                    <div class="pagination col-md-12 text-center">
                        <?php if (isset($pagination)) {
                            echo $pagination;
                        } ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->