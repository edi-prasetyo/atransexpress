<?php
$meta = $this->meta_model->get_meta();
?>

<div class="container my-5">
    <div class="card">


        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-md-7 border-right">
                <div class="card-body">
                    <div style="line-height: 35px;">
                        <h3><b>Lacak Kiriman Paket Anda</b></h3>
                        Untuk mengecek paket yang anda kirim silahkan masukan Nomor Resi yang di berikan Oleh Counter saat melakukan order<br><br>

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card-body">



                    <?php echo form_open('lacak',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <h4><i class="bi bi-bag"></i> Lacak Paket!</h4>
                    <p></p>

                    <div class="form-group">
                        <label> Nomor Resi </label>
                        <input class="form-control mb-3" type="text" name="nomor_resi" placeholder="Masukan Nomor Resi" required>
                        <div class="invalid-feedback">Silahkan Masukan Nomor Resi</div>
                        <?php
                        // Notifikasi
                        if ($this->session->flashdata('message')) {

                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        }
                        ?>
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-lock text-light"></i>Lacak Paket</button>
                    </div>


                    <?php echo form_close(); ?>



                </div>
            </div>
        </div>
    </div>
</div>


</div>