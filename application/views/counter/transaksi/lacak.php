<div class="col-md-7 mx-auto">
    <div class="card">
        <ul class="events">
            <?php foreach ($lacak as $lacak) : ?>
                <li>
                    <?php if ($lacak->status == 9) : ?>
                        <time class="col-6 text-right is-done" datetime="10:03">
                        <?php else : ?><time class="col-6 text-right" datetime="10:03">
                            <?php endif; ?>
                            <?php echo tanggal_indonesia_lengkap(date('Y-m-d', $lacak->date_updated)); ?><br> <?php echo date('H:i:s', $lacak->date_updated); ?> WIB</time>
                            <span class="col-6 text-left"><strong><?php echo $lacak->provinsi_name; ?></strong> <?php echo $lacak->lacak_desc; ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>