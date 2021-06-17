<table class="table">
    <thead>
        <tr>

            <th scope="col">Product</th>
            <th scope="col">Weight</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tarif as $data) : ?>
            <tr>
                <td><?php echo $data->product_name; ?></td>
                <td><?php echo $berat; ?> Kg</td>
                <td>Rp. <?php
                        if ($data->product_id == 2) : ?>
                        <?php
                            $berat_cargo = $berat - 20;
                            $total_harga = $berat_cargo * $data->harga_awal + $data->harga;
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
                <td>
                    <a href="<?php echo base_url('counter/example_transaksi/proccess_create/' . $data->id); ?>">ID <?php echo $data->id; ?></a>

                    <!-- <?php //echo form_open('counter/example_transaksi/proccess_create/' . $data->id, ['berat' => $berat]); 
                            ?>
                    <input type="hidden" name="berat" value="<?php //echo $berat; 
                                                                ?>">
                    <div class="col-md-6 my-3">
                        <button type="submit" class="btn btn-warning btn-block"> ID <?php //echo $data->id; 
                                                                                    ?></button>
                    </div>

                    <?php form_close(); ?> -->

                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>