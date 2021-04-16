<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-body">
            <div class="text-muted text-center">
                <h2> <?php echo $transaksi->kota_from; ?></h2>
                <span style="background:green;width:auto;height:auto;border-radius:50%;padding:8px 10px;color:#fff">ke</span>
                <h2><?php echo $transaksi->kota_name; ?></h2>

            </div>
            <ul class="events">
                <?php foreach ($lacak as $lacak) : ?>
                    <li>
                        <time class="col-6 text-right" datetime="10:03"><?php echo tanggal_indonesia_lengkap('Y-m-d', strtotime($transaksi->date_updated)); ?><br> <?php echo date('H:i:s', strtotime($lacak->date_updated)); ?> WIB</time>
                        <span class="col-6 text-left"><strong><?php echo $lacak->provinsi_name; ?></strong> <?php echo $lacak->lacak_desc; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>