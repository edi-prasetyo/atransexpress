<div class="card">
    <div class="card-header">Detail Order</div>
    <div class="card-body">



        <!-- title row -->

        <!-- info row -->
        <div class="row">

            <div class="col-sm-6">
                <address>
                    <strong><?php echo $last_withdraw->name; ?> </strong> <br>

                    Phone : <?php echo $last_withdraw->user_phone; ?> <br>
                    Email : <?php echo $last_withdraw->email; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <b>Invoice #<?php echo $last_withdraw->code_withdraw; ?></b><br>
                <br>
                <b>Status Pembayaran :</b>
                <?php if ($last_withdraw->status_withdraw == 'Pending') : ?>
                    <span class="badge badge-warning badge-pill"> <?php echo $last_withdraw->status_withdraw; ?></span>
                <?php else : ?>
                    <span class="badge badge-success badge-pill"> <?php echo $last_withdraw->status_withdraw; ?></span>
                <?php endif; ?>
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
                            <td><strong><?php echo $last_withdraw->code_withdraw; ?></strong></td>
                            <td> <strong> Rp. <?php echo number_format($last_withdraw->nominal_withdraw, 0, ",", "."); ?></strong></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- /.col -->



            <div class="col-md-6">
            </div>


        </div><!-- /.row -->


    </div>
</div>