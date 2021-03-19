<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <?php
        //Error warning
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        echo form_open(base_url('mainagen/transaksi/pilih_kurir/' . $transaksi->id));

        ?>



        <input type="hidden" name="status" value="Paket Dikirim Ke <?php echo $transaksi->kota_name; ?>">
        <input type="hidden" name="provinsi_id" value="<?php echo $transaksi->provinsi_id; ?>">

        <div class="form-group">
            <label>Pilih Kurir <?php echo $transaksi->kota_name; ?></label>
            <select class="form-control select2bs4" name="kurir" value="">

                <option>-- Pilih Kurir --</option>
                <?php foreach ($kurir_agen as $kurir_agen) : ?>
                    <option value='<?php echo $kurir_agen->id; ?>'><?php echo $kurir_agen->name; ?> </option>
                <?php endforeach; ?>
            </select>
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