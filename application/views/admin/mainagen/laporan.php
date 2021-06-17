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
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <!-- <th>Transaksi</th> -->
                            <!-- <th>Fee Paket</th> -->
                            <th>Withdraw</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($saldo_mainagen as $saldo) : ?>
                            <tr>
                                <td> <?php echo date('d/m/Y', strtotime($saldo->date_created)); ?><br>
                                    <?php echo date('H:i:s', strtotime($saldo->date_created)); ?>
                                </td>
                                <td>
                                    <?php echo $saldo->keterangan; ?><br>
                                    <?php if ($saldo->reason == NULL) : ?>
                                    <?php elseif ($saldo->reason == 'Pengiriman') : ?>
                                        <span class="badge badge-success badge-pill"> <?php echo $saldo->reason; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-primary badge-pill"> <?php echo $saldo->reason; ?></span>

                                    <?php endif; ?>


                                </td>
                                <!-- <td> Rp. <?php echo number_format($saldo->transaksi, 0, ",", "."); ?></td> -->
                                <!-- <td> </td> -->
                                <td> <span class="text-danger"> Rp. <?php echo number_format($saldo->pengeluaran, 0, ",", "."); ?></span></td>
                                <td> <b>Rp. <?php echo number_format($saldo->total_saldo, 0, ",", "."); ?></b><br>
                                    <span class="text-success"> <i class="fa fa-level-up-alt"></i> Rp. <?php echo number_format($saldo->pemasukan, 0, ",", "."); ?></span>

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