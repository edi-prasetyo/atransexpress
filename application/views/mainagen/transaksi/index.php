<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

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
                            <th>tujuan</th>
                            <!-- <th>Tracking</th> -->
                            <th>Counter</th>
                            <!-- <th>Barcode</th> -->
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <!-- <td><?php echo date('d/m/Y', $transaksi->date_created); ?> <?php echo date('H:i:s', $transaksi->date_created); ?></td> -->
                                <td><?php echo $transaksi->nomor_resi; ?></td>
                                <td><?php echo $transaksi->kota_name; ?></td>
                                <td><?php echo $transaksi->counter_code; ?></td>

                                <!-- <td><?php echo $transaksi->status; ?></td> -->
                                <!-- <td><?php echo $transaksi->harga; ?></td> -->
                                <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>"></td> -->
                                <td>

                                    <?php if ($transaksi->status == null) : ?>
                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url('mainagen/transaksi/ambil/' . $transaksi->id); ?>">Ambil Paket</a>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <a href="<?php echo base_url('mainagen/transaksi/lacak/' . $transaksi->id); ?>" class="btn btn-info btn-sm">
                                        <ion-icon name="eye-outline"></ion-icon> Lacak
                                    </a>
                                    <?php if ($transaksi->status == null) : ?>

                                    <?php elseif ($transaksi->to_agen == null) : ?>
                                        <?php include "kirim_agen.php"; ?>
                                    <?php else : ?>
                                    <?php endif; ?>
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