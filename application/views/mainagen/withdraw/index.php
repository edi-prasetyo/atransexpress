<?php
$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);
//Notifikasi
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
echo validation_errors('<div class="alert alert-warning">', '</div>');
?>


<div class="small-box bg-info">
    <div class="inner">
        <h3>Rp. <?php echo number_format($user->saldo_mainagen, 0, ",", ","); ?></h3>
        <a class="text-white" href="<?php echo base_url('mainagen/withdraw/riwayat'); ?>">Riwayat Penarikan Saldo</a>
    </div>
    <div class="icon">
        <i class="fas fa-coins"></i>
    </div>

</div>


<?php if ($my_withdraw == NULL) : ?>
<?php else : ?>
    <div class="card table-responsive p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Withdraw</th>
                    <th>Noominal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($my_withdraw as $my_withdraw) : ?>
                    <tr>
                        <td><b><?php echo $my_withdraw->code_withdraw; ?></b></td>
                        <td><b>Rp. <?php echo number_format($my_withdraw->nominal_withdraw, 0, ",", "."); ?></b><br>
                            <span class="badge badge-pill badge-warning badge-pill"> <?php echo $my_withdraw->status_withdraw; ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php endif; ?>


<?php if ($user->saldo_mainagen >= 50000 && $my_withdraw == NULL) : ?>

    <?php echo form_open('mainagen/withdraw'); ?>
    <input type="hidden" name="keterangan" value="Tarik Saldo">
    <button type="submit" class="btn btn-info btn-block" href="">Tarik Saldo</button>
    <?php echo form_close(); ?>

<?php elseif ($my_withdraw) : ?>
    <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Tidak dapat Melakukan Penarikan!</h5>Maaf Anda tidak dapat melakukan Penarikan Saldo Karena Masih Ada penarikan yang belum di setujui silahkan hubungi admin
    </div>

<?php else : ?>
    <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Tidak dapat Melakukan Penarikan!</h5>Maaf Anda tidak dapat melakukan Penarikan Saldo Karena Saldo Belum Mencapai Rp. 50.000
    </div>


<?php endif; ?>