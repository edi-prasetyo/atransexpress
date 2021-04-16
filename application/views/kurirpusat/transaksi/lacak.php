<div class="col-md-8 mx-auto">
    <div class="card">
        <ul class="events">
            <?php foreach ($lacak as $lacak) : ?>
                <li>
                    <time class="col-6 text-right" datetime="10:03"><?php echo tanggal_indonesia_lengkap('Y-m-d', strtotime($transaksi->date_updated)); ?><br> <?php echo date('H:i:s', strtotime($lacak->date_created)); ?> WIB</time>
                    <span class="col-6 text-left"><strong><?php echo $lacak->provinsi_name; ?></strong> <?php echo $lacak->lacak_desc; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>