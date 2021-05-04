<div class="col-md-8 mx-auto">
    <?php if ($topup->status_bayar == 'Success') : ?>
        <div class="card alert alert-success">
            <div class="card-body text-center">
                Order Anda sudah di konfirmasi<br>
                <a href="<?php echo base_url('topup'); ?>" class="btn btn-info btn-block my-3">Kembali</a>
            </div>
        </div>
    <?php elseif ($topup->status_bayar == 'Process') : ?>
        <div class="card alert alert-success">
            <div class="card-body text-center">
                Order Anda sudah di konfirmasi<br>
                <a href="<?php echo base_url('topup'); ?>" class="btn btn-info btn-block my-3">Kembali</a>
            </div>
        </div>
    <?php else : ?>
        <div class="card">
            <div class="card-header">
                Detail Pembayaran
            </div>
            <div class="card-body">



                Jumlah yang harus di Transfer
                <div class="display-4 font-weight-bold"> Rp. <?php echo number_format($topup->nominal, 0, ",",  "."); ?></div>
                Silahkan Transfer Pembayaran ke Rekening
                <div class="alert alert-success">




                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" width="15%"></th>
                                <th scope="col">Bank</th>
                                <th scope="col">Nomor Rek</th>
                                <th scope="col">Atas Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bank as $bank) : ?>
                                <tr>
                                    <td><img src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>" class="img-fluid"> </td>
                                    <td> <?php echo $bank->bank_name; ?></td>
                                    <td><?php echo $bank->bank_number; ?></td>
                                    <td><?php echo $bank->bank_account; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>



                </div>
                Upload Bukti Struk Pembayaran : <br>

                <?php echo form_open_multipart('topup/konfirmasi/' . $topup->id); ?>
                <div class="form-group row mt-3">
                    <div class="col-12">
                        <div class="wrap-custom-file col-md-12">
                            <input type="file" name="bukti_bayar" id="image1" accept=".gif, .jpg, .png, jpeg">
                            <label for="image1">
                                <span>Foto Struk Transfer</span>
                                <i class="fa fa-plus-circle"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="Process" name="transaction_status">
                <button type="submit" class="btn btn-success btn-block text-white">Konfirmasi Pembayaran</button>
                <?php echo form_close(); ?>


            </div>
        </div>

    <?php endif; ?>
</div>