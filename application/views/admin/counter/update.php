<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">
            <!-- Nested Row within Card Body -->

            <?php
            echo form_open('admin/counter/update/' . $user->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate'))
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
                <label class="col-md-4 col-form-label text-md-right">Ubah main Agen</label>
                <div class="col-md-8">
                    <select class="form-control custom-select" name="id_agen" value="" required>

                        <?php foreach ($main_agen as $main_agen) : ?>
                            <option value="<?php echo $main_agen->id; ?>" <?php if ($user->id_agen == $main_agen->id) {
                                                                                echo "selected";
                                                                            }; ?>><?php echo $main_agen->kota_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Silahkan Pilih Main Agen.</div>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?php echo $user->name; ?>">
                    <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Allamat Lengkap</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="user_address" placeholder="Alamat Lengkap"><?php echo $user->user_address; ?></textarea>
                    <?php echo form_error('user_address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nomor Hp</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo $user->user_phone; ?>">
                    <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $user->email; ?>" style="text-transform: lowercase">
                    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
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