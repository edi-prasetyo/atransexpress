<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $transaksi->id; ?>">
    <i class="fa fa-edit"></i> Kirim Ke Agen
</button>

<div class="modal modal-default fade" id="Edit<?php echo $transaksi->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Agen Tujuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Error warning
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                echo form_open(base_url('mainagen/transaksi/kirim/' . $transaksi->id));

                ?>

                Paket Akan di kirim ke Kota <?php echo $transaksi->kota_name; ?> - <?php echo $transaksi->provinsi_name; ?>

                <input type="hidden" name="status" value="Paket Dikirim Ke <?php echo $transaksi->kota_name; ?>">
                <input type="hidden" name="provinsi_id" value="<?php echo $transaksi->provinsi_id; ?>">

                <div class="form-group">
                    <label>Agen tujuan</label>
                    <select class="form-control select2bs4" name="from_agen" value="">

                        <option>-- Pilih Agen --</option>
                        <?php foreach ($kurir as $kurir) : ?>
                            <option value='<?php echo $main_agen->id; ?>'><?php echo $main_agen->kota_name; ?> - <?php echo $main_agen->name; ?> </option>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->