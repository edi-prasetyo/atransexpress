<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>
    <div class="card-body">
        <?php
        //Error warning
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        echo form_open('kurirpusat/transaksi/agen/' . $transaksi->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));

        ?>

        Paket Akan di kirim ke Kota <?php echo $transaksi->kota_name; ?> - <?php echo $transaksi->provinsi_name; ?>

        <input type="hidden" name="status" value="Paket Dikirim Ke <?php echo $transaksi->kota_name; ?>">
        <input type="hidden" name="provinsi_id" value="<?php echo $transaksi->provinsi_id; ?>">

        <div class="form-group">
            <label>Agen tujuan</label>
            <select class="form-control select2bs4" name="to_agen" value="" required>

                <option value="">-- Pilih Agen --</option>
                <?php foreach ($main_agen_kota as $main_agen_kota) : ?>
                    <option value='<?php echo $main_agen_kota->id; ?>'><?php echo $main_agen_kota->name; ?> - <?php echo $main_agen_kota->kota_name; ?> </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">Silahkan Pilih Agen Tujuan.</div>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Kirim">
        </div>


        <?php
        //Form Close
        echo form_close();
        ?>
    </div>
</div>