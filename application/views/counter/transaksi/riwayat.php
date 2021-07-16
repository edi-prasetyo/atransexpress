<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <?php echo form_open('counter/transaksi/riwayat'); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Masukan  Nomor Resi" value="<?php echo set_value('search'); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                    <?php form_close(); ?>
                </h3>

                <div class="card-tools">

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table">
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
                                    <b><?php echo $transaksi->nomor_resi; ?></b><br>
                                    <?php echo date('d/m/Y', strtotime($transaksi->date_created)); ?><br>
                                    <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?> WIB
                                </td>
                                <td>
                                    <?php echo $transaksi->kota_name; ?><br>
                                    <?php if ($transaksi->stage == 9) : ?>
                                        <span class="badge badge-success">Selesai</span>
                                    <?php elseif ($transaksi->stage == 10) : ?>
                                        <span class="badge badge-danger">Cancel</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Proses</span>
                                    <?php endif; ?><br>
                                    Rp. <?php echo number_format($transaksi->harga, 0, ",", "."); ?>
                                </td>

                                <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>"></td> -->
                                <td>
                                    <a href="<?php echo base_url('counter/transaksi/lacak/' . $transaksi->id); ?>" class="btn btn-info btn-sm btn-block">
                                        <i class="fa fa-dog"></i> Lacak
                                    </a>
                                    <a href="<?php echo base_url('counter/transaksi/detail/' . $transaksi->id); ?>" class="btn btn-primary btn-sm btn-block">
                                        <i class="fa fa-eye"></i> Lihat
                                    </a>

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