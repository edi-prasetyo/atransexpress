<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
echo validation_errors('<div class="alert alert-warning">', '</div>');
?>

<?php if ($my_topup == NULL) : ?>
<?php else : ?>
    <div class="card table-responsive p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Top Up</th>
                    <th>Noominal</th>
                    <!-- <th>Barcode</th> -->
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($my_topup as $my_topup) : ?>
                    <tr>
                        <td><?php echo $my_topup->code_topup; ?></td>
                        <td>Rp. <?php echo number_format($my_topup->nominal, 0, ",", "."); ?><br>
                            <span class="badge badge-pill badge-danger"> <?php echo $my_topup->status_bayar; ?></span>
                        </td>
                        <td>
                            <a href="<?php echo base_url('counter/topup/batal/' . $my_topup->id); ?>" class="btn btn-danger btn-sm btn-block">Batalkan</a>
                            <a href="<?php echo base_url('counter/topup/konfirmasi/' . $my_topup->id); ?>" class="btn btn-success btn-sm btn-block">Konfirmasi</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if ($my_topup == NULL) : ?>
    <?php echo form_open('counter/topup'); ?>
    <div class="row">
        <?php foreach ($nominal as $nominal) : ?>
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio<?php echo $nominal->id; ?>" name="nominal" value="<?php echo $nominal->nilai_topup; ?>">
                            <label for="customRadio<?php echo $nominal->id; ?>" class="custom-control-label">Rp. <?php echo number_format($nominal->nilai_topup, 0, ",", "."); ?></label>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-info btn-block" href="<?php echo base_url('counter/topup/order/' . $nominal->id); ?>">Lanjutkan</button>
    <?php echo form_close(); ?>
<?php else : ?>
    <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Transaksi Pending!</h5>Maaf Anda tidak dapat melakukan Top Up karena Masih Ada Top Up Pending, silahkan Batalkan Atau Konfirmasi Top Up Di atas Untuk Request Top Up Baru
    </div>
<?php endif; ?>