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
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($topup as $topup) : ?>
                            <tr>
                                <td> <?php echo date('d/m/Y', strtotime($topup->date_created)); ?></td>
                                <td> <?php echo $topup->keterangan; ?></td>

                                <td> <span class="text-success"> Rp. <?php echo number_format($topup->nominal, 0, ",", "."); ?></span></td>
                                <td>
                                    <?php if ($topup->status_bayar == "Pending") : ?>
                                        <span class="badge badge-warning">Pending</span>
                                    <?php elseif ($topup->status_bayar == "Success") : ?>
                                        <span class="badge badge-success">Sukses</span>
                                    <?php else : ?>
                                        <span class="badge badge-danger">Batal</span>
                                    <?php endif; ?>

                                </td>
                                <td> <a href="<?php echo base_url('counter/topup/detail/' . $topup->id); ?>" class="btn btn-primary btn-sm"> Detail</a></td>


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