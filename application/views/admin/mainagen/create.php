<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            Masukan Data Main Agen
        </div>
        <div class="card-body">

            <?php
            //Notifikasi
            if ($this->session->flashdata('message')) {
                echo '<div class="alert alert-success alert-dismissable fade show">';
                echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                echo $this->session->flashdata('message');
                unset($_SESSION['message']);
                echo '</div>';
            }
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            ?>
            <!-- Nested Row within Card Body -->

            <?php
            echo form_open('admin/mainagen/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'))
            ?>

            <!-- Provinsi -->
            <div class="form-group row">
                <label class="col-md-4 text-md-right">Provinsi</label>
                <div class="col-md-8">
                    <select class="form-control select2bs4" id='sel_provinsi' name="provinsi_id" required>
                        <option value="">-- Pilih Provinsi --</option>
                        <?php
                        foreach ($provinsi as $provinsi) {
                            echo "<option value='" . $provinsi['id'] . "'>" . $provinsi['provinsi_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Silahkan Pilih Provinsi.</div>
                </div>
            </div>

            <!-- Kota -->
            <div class="form-group row">
                <label class="col-md-4 text-md-right">Kota</label>
                <div class="col-md-8">
                    <select class="form-control select2bs4" id='sel_kota' name="kota_id" required>
                        <option value="">-- Pilih Kota --</option>
                    </select>
                    <div class="invalid-feedback">Silahkan Pilih Kota.</div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Title</label>
                <div class="col-md-8">
                    <select class="form-control select2bs4" name="user_title" value="" required>
                        <option value=''>-- Pilih Title --</option>
                        <option value='Bapak'>Bapak</option>
                        <option value='Ibu'>Ibu</option>
                        <option value='Saudara'>Saudara</option>
                        <option value='Saudari'>Saudari</option>
                    </select>
                    <div class="invalid-feedback">Silahkan Pilih Title.</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Nama Lengkap.</div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Allamat Lengkap</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="user_address" placeholder="Alamat Lengkap" value="<?php echo set_value('user_address'); ?>" required></textarea>
                    <div class="invalid-feedback">Silahkan Masukan Alamat Lengkap.</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nomor Hp</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Nomor Handphone.</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>" style="text-transform: lowercase" required>
                    <div class="invalid-feedback">Silahkan Masukan Alamat Email.</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password1" placeholder="Password">
                    <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Ulangi Password</label>
                <div class="col-md-8">
                    <input type="password" class="form-control" name="password2" placeholder="Repeat Password">

                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary btn-block">
                        Register Account
                    </button>
                </div>

                <?php echo form_close() ?>



            </div>
        </div>
    </div>
</div>





<!-- Script -->
<script src="<?php echo base_url(); ?>assets/template/admin/plugins/jquery/jquery.min.js"></script>

<script type='text/javascript'>
    // baseURL variable
    var baseURL = "<?php echo base_url(); ?>";

    $(document).ready(function() {

        // Provinsi change
        $('#sel_provinsi').change(function() {
            var provinsi = $(this).val();

            // AJAX request
            $.ajax({
                url: '<?= base_url() ?>admin/wilayah/getKota',
                method: 'post',
                data: {
                    <?= $this->security->get_csrf_token_name(); ?>: "<?= $this->security->get_csrf_hash(); ?>",
                    provinsi: provinsi
                },
                dataType: 'json',
                success: function(response) {

                    // Remove options 
                    // $('#sel_kecamatan').find('option').not(':first').remove();
                    $('#sel_kota').find('option').not(':first').remove();

                    // Add options
                    $.each(response, function(index, data) {
                        $('#sel_kota').append('<option value="' + data['id'] + '">' + data['kota_name'] + '</option>');
                    });
                }
            });
        });

        // Kota change


    });
</script>