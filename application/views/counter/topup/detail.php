<?php
$meta = $this->meta_model->get_meta();
?>
<div class="col-md-7 mx-auto">


    <div class="card shadow-none border text-center">
        <div class="card-header">
            <h3>Detail Top Up Anda </h3>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <address>
                    <strong><?php echo $topup->name; ?> </strong> <br>

                    Phone : <?php echo $topup->user_phone; ?> <br>
                    Email : <?php echo $topup->email; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <b>Kode Topup #<?php echo $topup->code_topup; ?></b><br>
                <br>
                <b>Status :</b> <span class="badge badge-danger badge-pill"> <?php echo $topup->status_bayar; ?></span>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->

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
                        <td><strong><?php echo $topup->code_topup; ?></strong></td>
                        <td> <strong> Rp. <?php echo number_format($topup->nominal, 0, ",", "."); ?></strong></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>