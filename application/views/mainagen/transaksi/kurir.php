<?php $user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);
?>
<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <?php
        //Error warning
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        echo form_open('mainagen/transaksi/kurir/' . $transaksi->id, array('class' => 'needs-validation', 'novalidate' => 'novalidate'));

        ?>



        <input type="hidden" name="status" value="Paket Dikirim Ke <?php echo $transaksi->kota_name; ?>">
        <input type="hidden" name="provinsi_id" value="<?php echo $transaksi->provinsi_id; ?>">




        <?php if ($transaksi->kota_id == $user->kota_id) : ?>

            <div class="form-group">
                <label>Pilih Kurir <?php echo $transaksi->kota_name; ?></label>
                <select class="form-control select2bs4" name="kurir" value="" required>

                    <option value="">-- Pilih Kurir --</option>

                    <?php foreach ($kurir_agen as $kurir_agen) : ?>
                        <option value='<?php echo $kurir_agen->id; ?>'><?php echo $kurir_agen->name; ?> </option>
                    <?php endforeach; ?>

                </select>
                <div class="invalid-feedback">Silahkan Pilih Kurir.</div>
            </div>
            <input type="hidden" name="stage" value="7">

        <?php else : ?>


            <div class="form-group">
                <label>Pilih Kurir <?php echo $transaksi->kota_name; ?></label>
                <select class="form-control select2bs4" name="kurir" value="" required>

                    <option value="">-- Pilih Kurir --</option>
                    <?php foreach ($kurir as $kurir) : ?>
                        <option value='<?php echo $kurir->id; ?>'><?php echo $kurir->name; ?> </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">Silahkan Pilih Kurir.</div>
            </div>


            <input type="hidden" name="stage" value="3">

        <?php endif; ?>


        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Kirim">
        </div>


        <?php
        //Form Close
        echo form_close();
        ?>
    </div>
</div>