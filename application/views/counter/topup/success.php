<div class="card">
    <div class="card-header">Detail Order</div>
    <div class="card-body">



        <!-- title row -->

        <!-- info row -->
        <div class="row">

            <div class="col-sm-6">
                <address>
                    <strong><?php echo $last_topup->name; ?> </strong> <br>

                    Phone : <?php echo $last_topup->user_phone; ?> <br>
                    Email : <?php echo $last_topup->email; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <b>Invoice #<?php echo $last_topup->code_topup; ?></b><br>
                <br>
                <b>Status Pembayaran :</b> <?php echo $last_topup->status_bayar; ?>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Top Up</th>
                            <th>Nominal</th>

                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td><strong><?php echo $last_topup->code_topup; ?></strong></td>
                            <td> <strong> Rp. <?php echo number_format($last_topup->nominal, 0, ",", "."); ?></strong></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <a href="<?php echo base_url('counter/topup/konfirmasi/' . $last_topup->id); ?>" class="btn btn-success pull-right"><i class="fa fa-check"></i> Konfirmasi Pembayaran</a>
                <a href="<?php echo base_url('counter/topup/batal/' . $last_topup->id); ?>" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Batalkan</a>
            </div>

            <div class="col-md-6">
            </div>


        </div><!-- /.row -->


    </div>
</div>