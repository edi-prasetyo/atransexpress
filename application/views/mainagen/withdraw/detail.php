<div class="card">
    <div class="card-header">Detail Order</div>
    <div class="card-body">



        <!-- title row -->

        <!-- info row -->
        <div class="row">

            <div class="col-sm-6">
                <address>
                    <strong><?php echo $withdraw->name; ?> </strong> <br>

                    Phone : <?php echo $withdraw->user_phone; ?> <br>
                    Email : <?php echo $withdraw->email; ?><br>
                    <b>Invoice #<?php echo $withdraw->code_withdraw; ?></b><br>
                    <b>Status Pembayaran :</b>
                    <?php if ($withdraw->status_withdraw == 'Pending') : ?>
                        <span class="badge badge-warning badge-pill"> <?php echo $withdraw->status_withdraw; ?></span>
                    <?php else : ?>
                        <span class="badge badge-success badge-pill"> <?php echo $withdraw->status_withdraw; ?></span>
                    <?php endif; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <img src="<?php echo base_url('assets/img/struk/' . $withdraw->foto_struk); ?>" class="img-fluid">
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
                            <td><strong><?php echo $withdraw->code_withdraw; ?></strong></td>
                            <td> <strong> Rp. <?php echo number_format($withdraw->nominal_withdraw, 0, ",", "."); ?></strong></td>
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