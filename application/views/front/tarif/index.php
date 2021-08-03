<div class="container">
    <div class="row">

        <div class="col-md-8 my-5">
            <?php if ($tarif == null) : ?>
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 mx-auto">
                            <?php
                            if ($this->session->flashdata('empty_tarif')) {
                                echo $this->session->flashdata('empty_tarif');
                                unset($_SESSION['empty_tarif']);
                            }

                            ?>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-6">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header">Kota Asal</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $destinasi->kota_asal; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-header">Kota Tujuan</div>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $destinasi->kota_tujuan; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Layanan</th>
                                    <!-- <th scope="col">Berat</th> -->
                                    <th scope="col">Tarif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tarif as $data) : ?>
                                    <tr>

                                        <td><?php echo $data->product_name; ?></td>
                                        <!-- <td><?php //echo $berat; 
                                                    ?></td> -->
                                        <td>Rp. <?php
                                                if ($data->product_id == 2) : ?>
                                                <?php
                                                    $berat_cargo = $berat - 20;
                                                    $total_harga = $berat_cargo * $data->harga + $data->harga_awal;
                                                    if ($berat <= 20) {
                                                        echo number_format($data->harga_awal, 0, ",", ".");
                                                    } else {
                                                        echo number_format($total_harga, 0, ",", ".");
                                                    }

                                                ?>
                                            <?php else : ?>

                                                <?php

                                                    $total_harga = $berat * $data->harga;
                                                    echo number_format($total_harga, 0, ",", ".");

                                                ?>

                                            <?php endif; ?>


                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php endif; ?>


        </div>


        <div class="col-md-4 my-5">
            <div class="card bg-info text-white  mb-3">
                <?php //var_dump($kota_asal);
                //die; 
                ?>
                <div class="card-header">
                    <h5 class="card-title">Cek Tarif</h5>
                </div>
                <div class="card-body">

                    <?php echo form_open('tarif',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <div class="form-row align-items-center row">

                        <label>Kota Asal</label>
                        <select class="form-control-chosen" name="kota_asal" required>
                            <option value="">Kota Asal...</option>
                            <?php foreach ($kota_asal as $data) : ?>
                                <option value="<?php echo $data->kota_name; ?> "><?php echo $data->kota_name; ?> </option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback">Silahkan Pilih Kota Asal.</div>


                        <label>Kota Tujuan</label>
                        <select class="form-control-chosen" name="kota_tujuan" required>
                            <option value="">Kota tujuan...</option>
                            <?php foreach ($kota_tujuan as $data) : ?>
                                <option value="<?php echo $data->kota_name; ?>"><?php echo $data->kota_name; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Silahkan Pilih Kota Tujuan.</div>


                        <label>Berat</label>
                        <input type="text" name="berat" class="form-control" placeholder="kg" required>
                        <div class="invalid-feedback">Silahkan Masukan Berat paket</div>


                        <button type="submit" class="btn btn-warning btn-block my-3">Cek Tarif</button>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>


    </div>
</div>