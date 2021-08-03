<div class="col-md-7 mx-auto my-5">
    <div class="card">

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


            <h5 class="card-title">Cek Tarif</h5>
            <?php echo form_open('tarif'); ?>
            <div class="form-row align-items-center row">
                <div class="col-md-5">
                    <label>Kota Asal</label>
                    <select class="custom-select" name="kota_asal">
                        <option selected>Choose...</option>
                        <?php foreach ($kota_asal as $data) : ?>
                            <option value="<?php echo $data->kota_name; ?> "><?php echo $data->kota_name; ?> </option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="col-md-5">
                    <label>Kota Tujuan</label>
                    <select class="custom-select" name="kota_tujuan">
                        <option selected>Choose...</option>
                        <?php foreach ($kota_tujuan as $data) : ?>
                            <option value="<?php echo $data->kota_name; ?>"><?php echo $data->kota_name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Berat</label>
                    <input type="text" name="berat" class="form-control" placeholder="kg">
                </div>
                <div class="col-md-6 my-3">
                    <button type="submit" class="btn btn-warning btn-block">Cek Tarif</button>
                </div>
            </div>
            <?php echo form_close(); ?>



            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Layananasasdasd</th>
                        <th scope="col">Berat</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarif as $data) : ?>
                        <tr>

                            <td><?php echo $data->product_name; ?></td>
                            <td><?php echo $berat; ?></td>
                            <td><?php
                                if ($data->product_id == 2) : ?>
                                    <?php
                                    $berat_cargo = $berat - 20;
                                    $total_harga = $berat_cargo * $data->harga_awal + $data->harga;
                                    echo number_format($total_harga, 0, ",", ".");

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
</div>