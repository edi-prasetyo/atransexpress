<div class="card">
    <div class="card-header">
        <h5 class="card-title">Cek Tarif</h5>
    </div>
    <div class="card-body">

        <?php echo form_open('counter/example_transaksi/create'); ?>
        <div class="form-row align-items-center row">
            <div class="col-md-5">
                <label>Kota Asal</label>
                <input type="text" name="kota_asal" class="form-control" value="<?php echo $kota_asal; ?>" readonly>


            </div>
            <div class="col-md-5">
                <label>Kota Tujuan</label>
                <select class="form-control select2bs4" name="kota_tujuan">
                    <option selected>Choose...</option>
                    <?php foreach ($kota_tujuan as $data) : ?>
                        <option value="<?php echo $data->kota_name; ?>"><?php echo $data->kota_name; ?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label>Berat</label>
                <input type="text" name="berat" class="form-control" placeholder="kg">
            </div>
            <div class="col-md-6 my-3">
                <button type="submit" class="btn btn-warning btn-block">Cek Tarif</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>