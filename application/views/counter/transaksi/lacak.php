<div class="col-md-7 mx-auto">
    <div class="card">
        <div class="card-body">
            <h5 class="text-center">
                <?php echo $transaksi->kota_from; ?> - <?php echo $transaksi->kota_name; ?>
            </h5>
            <ul class="events">
                <?php foreach ($lacak as $lacak) : ?>
                    <li>
                        <?php if ($lacak->status == 9) : ?>
                            <time class="col-6 text-right is-done" datetime="10:03">
                            <?php else : ?><time class="col-6 text-right" datetime="10:03">
                                <?php endif; ?>
                                <?php echo date('d/m/Y', strtotime($lacak->date_updated)); ?><br> <?php echo date('H:i:s', strtotime($lacak->date_updated)); ?> WIB</time>
                                <span class="col-6 text-left"><strong><?php echo $lacak->provinsi_name; ?></strong> <?php echo $lacak->lacak_desc; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>