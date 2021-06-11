<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>

                <div class="card-tools">
                    <?php echo form_open('mainagen/transaksi/riwayat'); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="search" class="form-control" placeholder="Masukan Nomor Resi" value="<?php echo set_value('search'); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                    <?php form_close(); ?>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal/Code</th>
                            <th>Nominal</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($my_withdraw as $my_withdraw) : ?>
                            <tr>
                                <td>
                                    <i class="far fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($my_withdraw->date_created)); ?> <?php echo date('H:i:s', strtotime($my_withdraw->date_created)); ?> <br>
                                    <b><?php echo $my_withdraw->code_withdraw; ?></b><br>

                                </td>

                                <td>

                                    <b>Rp. <?php echo number_format($my_withdraw->nominal_withdraw, 0, ",", "."); ?></b>
                                    <br>
                                    <?php if ($my_withdraw->status_withdraw == 'Pending') : ?>
                                        <div class="badge badge-warning">Pending</div>
                                    <?php elseif ($my_withdraw->status_withdraw == 'Process') : ?>
                                        <div class="badge badge-info">Proses</div>
                                    <?php elseif ($my_withdraw->status_withdraw == 'Decline') : ?>
                                        <div class="badge badge-danger">Decline</div>
                                    <?php else : ?>
                                        <div class="badge badge-success">Selesai</div>

                                    <?php endif; ?>

                                </td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="<?php echo base_url('mainagen/withdraw/detail/' . $my_withdraw->id); ?>">Detail</a>
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