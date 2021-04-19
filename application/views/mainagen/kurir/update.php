<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">

            <?php
            // Notifikasi
            if ($this->session->flashdata('message')) {

                echo $this->session->flashdata('message');
                unset($_SESSION['message']);
            }
            //error warning
            echo validation_errors('<div class="alert alert-warning">', '</div>');
            //form open
            ?>
            <!-- Nested Row within Card Body -->
            <?php
            echo form_open_multipart('mainagen/kurir/update/' . $kurir->id)
            ?>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">
                    <img src="<?php echo base_url('assets/img/avatars/' . $kurir->user_image); ?>" class="img-fluid">
                    Upload Foto</label>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="user_image">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?php echo $kurir->name; ?>">
                    <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Allamat Lengkap</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="user_address" placeholder="Alamat Lengkap"> <?php echo $kurir->user_address; ?></textarea>
                    <?php echo form_error('user_address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nomor Hp</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo $kurir->user_phone; ?>">
                    <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary btn-block">
                        Update Account
                    </button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>