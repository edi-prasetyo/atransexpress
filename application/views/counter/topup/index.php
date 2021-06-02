<?php
$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);
//Notifikasi
if ($this->session->flashdata('message')) {
    echo $this->session->flashdata('message');
    unset($_SESSION['message']);
}
echo validation_errors('<div class="alert alert-warning">', '</div>');
$meta = $this->meta_model->get_meta();
?>


<div class="small-box bg-info">
    <div class="inner">
        <h3>Rp. <?php echo number_format($user->deposit_counter, 0, ",", ","); ?></h3>
        <a class="text-white" href="<?php echo base_url('counter/topup/riwayat'); ?>">Riwayat Top Up Saldo</a>
    </div>
    <div class="icon">
        <i class="fas fa-coins"></i>
    </div>

</div>


<div class="card" style="height:200px;overflow:hidden">
    <img class="card-img" src="<?php echo base_url('assets/img/galery/bg_bank.jpg'); ?>" alt="Card image">
    <div class="card-img-overlay d-flex flex-column align-items-start text-white" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,0.8))">
        <img width="20%" src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>" class="img-fluid mb-2">
        <h3><?php echo $bank->bank_account; ?></h3>
        <h1><?php echo $bank->bank_number; ?></h1>
    </div>
</div>


<?php if ($my_topup == NULL) : ?>
<?php else : ?>
    <div class="card table-responsive p-0">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Top Up</th>
                    <th>Nominal</th>
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
                            <a href="<?php echo base_url('counter/topup/detail/' . $my_topup->id); ?>" class="btn btn-success btn-sm btn-block">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if ($my_topup == NULL) : ?>
    <?php echo form_open_multipart('counter/topup', array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>


    <h4>Silahkan Pilih Nominal Top Up</h4>
    <div class="row">
        <?php foreach ($nominal as $nominal) : ?>
            <div class="col-md-3 col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="customRadio<?php echo $nominal->id; ?>" name="nominal" value="<?php echo $nominal->nilai_topup; ?>" required>
                            <label for="customRadio<?php echo $nominal->id; ?>" class="custom-control-label">Rp. <?php echo number_format($nominal->nilai_topup, 0, ",", "."); ?></label>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="invalid-feedback">Silahkan Pilih Nominal Top Up.</div>


    <div class="col-12 mx-auto my-3">
        <h4>Silahkan Unggah Foto Bukti Transfer</h4>
        <div class="custom-file">
            <input type='file' class="custom-file-input" id="customFile" name="foto_struk" required>
            <label class="custom-file-label" for="customFile">Ambil Foto</label>
        </div>

        <br>
        <img class="img-fluid mt-4" id="gambar" src="#" alt="Ambil Foto" OnError=" $(this).hide();" />
        <div class="invalid-feedback">Silahkan Masukan Foto Stuk transfer.</div>
    </div>

    <button type="submit" class="btn btn-info btn-block">Lanjutkan</button>
    <?php echo form_close(); ?>
<?php else : ?>
    <div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Transaksi Pending!</h5>Maaf Anda tidak dapat melakukan Top Up karena Masih Ada Top Up Pending, silahkan Batalkan Atau Konfirmasi Ke Admin melalui Whatsapp : <?php echo $meta->telepon; ?>
    </div>
<?php endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#customFile").change(function() {
        $('#gambar').show();
        readURL(this);
    });
</script>