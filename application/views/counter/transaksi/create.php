<?php echo form_open('counter/transaksi/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
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
                    <div class="col-md-12">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Tujuan Pengiriman :</legend>

                            <div class="row">

                                <!-- Tujuan Pengiriman -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Provinsi</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kota</label>
                                        <select class="form-control select2bs4" id='sel_kota' name="kota_id" required>
                                            <option value="">-- Pilih Kota --</option>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Kota.</div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </div>

                    <div class="col-md-12">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Data Barang :</legend>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kategori Barang</label>
                                        <select class="custom-select" name="category_id" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <?php foreach ($category as $category) : ?>

                                                <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Kategori Barang.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paket</label>
                                        <select class="custom-select" name="product_id" required>
                                            <option value="">-- Pilih Paket --</option>
                                            <?php foreach ($product as $product) : ?>
                                                <option value="<?php echo $product->id; ?>"><?php echo $product->product_name; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Silahkan Pilih Jenis Paket.</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama barang</label>
                                        <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required>
                                        <div class="invalid-feedback">Silahkan Masukan Nama Barang.</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat *Kg</label>
                                        <input type="number" class="form-control" name="berat" placeholder="..Kg" required>
                                        <div class="invalid-feedback">Silahkan Masukan Berat Barang.</div>
                                    </div>
                                </div>


                                <div class="col-md-12">

                                    <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Berat Volume
                                    </a>
                                    <div class="collapse" id="collapseExample">
                                        <div class="">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Panjang *cm</label>
                                                        <input type="number" class="form-control" name="panjang" placeholder="..cm">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Lebar *cm</label>
                                                        <input type="number" class="form-control" name="lebar" placeholder="..cm">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>tinggi *cm</label>
                                                        <input type="number" class="form-control" name="tinggi" placeholder="..cm">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>






                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input type="number" class="form-control" name="harga" placeholder="Rp. .." required>
                                        <div class="invalid-feedback">Silahkan Masukan Harga Paket.</div>
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                    </div>


                    <!-- Data Pengirim dan Penerima -->

                    <div class="col-md-6">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Data Pengirim:</legend>

                            <div class="form-group">
                                <label>Nama Pengirim</label>
                                <input type="text" class="form-control" name="nama_pengirim" placeholder="Nama Pengirim" required>
                                <div class="invalid-feedback">Silahkan Masukan Nama Pengirim.</div>
                            </div>
                            <div class="form-group">
                                <label>No. Telpon Pengirim</label>
                                <input type="number" class="form-control" name="telp_pengirim" placeholder="telp Pengirim" required>
                                <div class="invalid-feedback">Silahkan Masukan Nomor HP Pengirim.</div>
                            </div>
                            <div class="form-group">
                                <label>Email Pengirim <span class="text-success">* Boleh di kosongkan</span></label>
                                <input type="text" class="form-control" name="email_pengirim" placeholder="Email Pengirim">
                            </div>

                            <div class="form-group">
                                <label>Alamat Pengirim</label>
                                <textarea class="form-control" rows="3" name="alamat_pengirim" placeholder="Alamat ..." required></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Alamat Pengiriman.</div>
                            </div>

                            <div class="form-group">
                                <label>Kode Pos Pengirim <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="kodepos_pengirim" placeholder="Kode Pos Pengirim" required>
                                <div class="invalid-feedback">Silahkan Masukan Kode Pos.</div>
                            </div>


                        </fieldset>
                    </div>




                    <div class="col-md-6">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Data Penerima:</legend>
                            <div class="form-group">
                                <label>Nama Penerima</label>
                                <input type="text" class="form-control" name="nama_penerima" placeholder="Nama Penerima.." required>
                                <div class="invalid-feedback">Silahkan Masukan nama penerima.</div>
                            </div>
                            <div class="form-group">
                                <label>No. Telpon Penerima</label>
                                <input type="number" class="form-control" name="telp_penerima" placeholder="Telp penerima" required>
                                <div class="invalid-feedback">Silahkan Masukan Nomor HP Penerima.</div>
                            </div>
                            <div class="form-group">
                                <label>Email Penerima <span class="text-success">* Boleh di kosongkan</span></label>
                                <input type="text" class="form-control" name="email_penerima" placeholder="Email Penerima">
                            </div>
                            <div class="form-group">
                                <label>Alamat Penerima</label>
                                <textarea class="form-control" rows="3" name="alamat_penerima" placeholder="Enter ..." required></textarea>
                                <div class="invalid-feedback">Silahkan Masukan Alamat Penerima.</div>
                            </div>
                            <div class="form-group">
                                <label>Kode Pos Penerima <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="kodepos_penerima" placeholder="Kode Pos Penerima" required>
                                <div class="invalid-feedback">Silahkan Masukan KOde Pos Penerima.</div>
                            </div>
                        </fieldset>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Buat Resi</button>
                </div>
            </div>
        </div>

    </div>

</div>




<?php echo form_close(); ?>


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