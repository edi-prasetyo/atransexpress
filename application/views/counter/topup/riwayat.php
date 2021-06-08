<?php foreach ($topup as $topup) : ?>
    <a href="<?php echo base_url('counter/topup/detail/' . $topup->id); ?>" class="text-muted">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <?php if ($topup->status_bayar == "Pending") : ?>
                            <span class="fa fa-exclamation-circle text-warning" style="font-size: 30px;"></span>
                        <?php elseif ($topup->status_bayar == "Success") : ?>
                            <i class="fa fa-check-circle text-success disabled" style="font-size: 30px;"></i>
                        <?php else : ?>
                            <i class="fa fa-times-circle text-danger disabled" style="font-size: 30px;"></i>
                        <?php endif; ?>
                        <br>
                    </div>
                    <div class="col-5 text-muted">
                        <?php echo date('d/m/Y', strtotime($topup->date_created)); ?> -
                        <?php echo date('H:i:s', strtotime($topup->date_created)); ?><br>
                        <?php echo $topup->keterangan; ?><br>
                        <?php echo $topup->topup_reason; ?>
                    </div>


                    <div class="col-5 text-right">
                        <span class="text-muted" style="font-size: 25px;font-weight:bold;"> Rp. <?php echo number_format($topup->nominal, 0, ",", "."); ?></span><br>
                    </div>
                </div>
            </div>
        </div>
    </a>

<?php endforeach; ?>