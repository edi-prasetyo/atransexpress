<?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success alert-dismissable fade show">';
    echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>

<?php echo form_open('counter/transaksi/create'); ?>
<div class="row">


    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Paket</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <input type="hidden" value="<?php echo $user->provinsi_name; ?>" name="provinsi_from">
                    <input type="hidden" value="<?php echo $user->kota_name; ?>" name="kota_from">

                    <!-- Tujuan Pengiriman -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Provinsi Tujuan</label>
                            <select class="form-control select2bs4" id='sel_provinsi' name="provinsi_id">
                                <option>-- Pilih Provinsi --</option>
                                <?php
                                foreach ($provinsi as $provinsi) {
                                    echo "<option value='" . $provinsi['id'] . "'>" . $provinsi['provinsi_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kota Tujuan</label>
                            <select class="form-control select2bs4" id='sel_kota' name="kota_id">
                                <option>-- Pilih Kota --</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kategori Barang</label>
                            <select class="custom-select" name="category_id">
                                <?php foreach ($category as $category) : ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Paket</label>
                            <select class="custom-select" name="product_id">
                                <?php foreach ($product as $product) : ?>
                                    <option value="<?php echo $product->id; ?>"><?php echo $product->product_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama barang</label>
                            <input type="text" class="form-control" name="jenis_barang" placeholder="Nama Barang">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Berat</label>
                            <input type="text" class="form-control" name="berat" placeholder="..Kg">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Panjang</label>
                            <input type="text" class="form-control" name="panjang" placeholder="..cm">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lebar</label>
                            <input type="text" class="form-control" name="lebar" placeholder="..cm">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>tinggi</label>
                            <input type="text" class="form-control" name="tinggi" placeholder="..cm">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga" placeholder="Rp. ..">
                        </div>
                    </div>




                    <!-- Data Pengirim dan Penerima -->

                    <hr>
                    <div class="col-md-6">
                        <div class="card bg-primary">
                            <div class="card-header">
                                Data Pengirim
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Pengirim</label>
                                    <input type="text" class="form-control" name="nama_pengirim" placeholder="Nama Pengirim">
                                </div>
                                <div class="form-group">
                                    <label>No. Telpon Pengirim</label>
                                    <input type="text" class="form-control" name="telp_pengirim" placeholder="telp Pengirim">
                                </div>
                                <div class="form-group">
                                    <label>Email Pengirim <span class="text-warning">* Boleh di kosongkan</span></label>
                                    <input type="text" class="form-control" name="email_pengirim" placeholder="Email Pengirim">
                                </div>

                                <div class="form-group">
                                    <label>Alamat Pengirim</label>
                                    <textarea class="form-control" rows="3" name="alamat_pengirim" placeholder="Alamat ..."></textarea>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-success">
                            <div class="card-header">
                                Data Penerima
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Penerima</label>
                                    <input type="text" class="form-control" name="nama_penerima" placeholder="Nama Penerima..">
                                </div>
                                <div class="form-group">
                                    <label>No. Telpon Penerima</label>
                                    <input type="text" class="form-control" name="telp_penerima" placeholder="Telp penerima">
                                </div>
                                <div class="form-group">
                                    <label>Email Penerima <span class="text-warning">* Boleh di kosongkan</span></label>
                                    <input type="text" class="form-control" name="email_penerima" placeholder="Email Penerima">
                                </div>
                                <div class="form-group">
                                    <label>Alamat Penerima</label>
                                    <textarea class="form-control" rows="3" name="alamat_penerima" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary btn-block">Buat Resi</button>
            </div>

        </div>

    </div>


    <?php echo form_close(); ?>




    <!-- <div class="form-group">
        <label>Provinsi</label>
        <select class="form-control custom-select" id='sel_provinsi' name="provinsi_id">
            <option>-- Pilih Provinsi --</option>
            <?php
            foreach ($provinsi as $provinsi) {
                echo "<option value='" . $provinsi['id'] . "'>" . $provinsi['provinsi_name'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Kota</label>
        <select class="form-control custom-select" id='sel_kota' name="kota_id">
            <option>-- Pilih Kota --</option>
        </select>
    </div>
    <div class="form-group">
        <label>Kecamatan</label>
        <select class="form-control custom-select" id='sel_kecamatan' name="kecamatan_id">
            <option>-- Pilih Kecamatan --</option>
        </select>
    </div> -->



    <!-- <div class="form-group">
        <label>Provinsi</label>

        <select class="form-control custom-select" id='sel_provinsi2' name="provinsi_id">
            <option>-- Pilih Provinsi --</option>
            <?php
            foreach ($provinsi2 as $provinsi2) {
                echo "<option value='" . $provinsi2['id'] . "'>" . $provinsi2['provinsi_name'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Kota</label>
        <select class="form-control custom-select" id='sel_kota2' name="kota_id">
            <option>-- Pilih Kota --</option>
        </select>
    </div>
    <div class="form-group">
        <label>Kecamatan</label>
        <select class="form-control custom-select" id='sel_kecamatan2' name="kecamatan_id">
            <option>-- Pilih Kecamatan --</option>
        </select>
    </div> -->


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
                        $('#sel_kecamatan').find('option').not(':first').remove();
                        $('#sel_kota').find('option').not(':first').remove();

                        // Add options
                        $.each(response, function(index, data) {
                            $('#sel_kota').append('<option value="' + data['id'] + '">' + data['kota_name'] + '</option>');
                        });
                    }
                });
            });

            // Kota change
            $('#sel_kota').change(function() {
                var kota = $(this).val();

                // AJAX request
                $.ajax({
                    url: '<?= base_url() ?>admin/wilayah/getKecamatan',
                    method: 'post',
                    data: {
                        kota: kota
                    },
                    dataType: 'json',
                    success: function(response) {

                        // Remove options
                        $('#sel_kecamatan').find('option').not(':first').remove();

                        // Add options
                        $.each(response, function(index, data) {
                            $('#sel_kecamatan').append('<option value="' + data['id'] + '">' + data['kecamatan_name'] + '</option>');
                        });
                    }
                });
            });

        });
    </script>

    <!-- Script 2 -->

    <script type='text/javascript'>
        // baseURL variable
        var baseURL = "<?php echo base_url(); ?>";

        $(document).ready(function() {

            // Provinsi change
            $('#sel_provinsi2').change(function() {
                var provinsi = $(this).val();

                // AJAX request
                $.ajax({
                    url: '<?= base_url() ?>admin/wilayah/getKota',
                    method: 'post',
                    data: {
                        provinsi: provinsi
                    },
                    dataType: 'json',
                    success: function(response) {

                        // Remove options 
                        $('#sel_kecamatan2').find('option').not(':first').remove();
                        $('#sel_kota2').find('option').not(':first').remove();

                        // Add options
                        $.each(response, function(index, data) {
                            $('#sel_kota2').append('<option value="' + data['id'] + '">' + data['kota_name'] + '</option>');
                        });
                    }
                });
            });

            // Kota change
            $('#sel_kota2').change(function() {
                var kota = $(this).val();

                // AJAX request
                $.ajax({
                    url: '<?= base_url() ?>admin/wilayah/getKecamatan',
                    method: 'post',
                    data: {
                        kota: kota
                    },
                    dataType: 'json',
                    success: function(response) {

                        // Remove options
                        $('#sel_kecamatan2').find('option').not(':first').remove();

                        // Add options
                        $.each(response, function(index, data) {
                            $('#sel_kecamatan2').append('<option value="' + data['id'] + '">' + data['kecamatan_name'] + '</option>');
                        });
                    }
                });
            });

        });
    </script>