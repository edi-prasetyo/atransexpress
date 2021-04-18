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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Paket</th>
                            <th>tujuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <td>
                                    <i class="far fa-calendar-alt"></i> <?php echo tanggal_indonesia_lengkap('Y-m-d', strtotime($transaksi->date_created)); ?> <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?> <br>
                                    Resi : <b><?php echo $transaksi->nomor_resi; ?></b><br>
                                    Rp. <?php echo number_format($transaksi->harga, 0, ",", "."); ?>
                                </td>

                                <td>
                                    <i class="far fa-dot-circle text-danger"></i> <?php echo $transaksi->kota_from; ?> <br>
                                    <i class="fa fa-map-marker-alt text-success"></i> <?php echo $transaksi->kota_name; ?><br>
                                    <?php if ($transaksi->stage == 9) : ?>
                                        <div class="badge badge-success">Selesai</div>
                                    <?php else : ?>
                                        <div class="badge badge-danger">Proses</div>

                                    <?php endif; ?>
                                </td>
                                <td>


                                    <a href="<?php echo base_url('mainagen/transaksi/lacak/' . $transaksi->id); ?>" class="btn btn-info btn-sm btn-block">
                                        <i class="fa fa-dog"></i> Lacak
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