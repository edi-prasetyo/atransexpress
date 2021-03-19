<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $title; ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo form_open('kurirpusat/transaksi/search'); ?>
                        <div class="input-group mb-3" style="width: 100%;">
                            <select class="form-control select2bs4" name="search">
                                <option>-- Pilih Kota --</option>
                                <?php foreach ($main_agen as $main_agen) : ?>
                                    <option value='<?php echo $main_agen->kota_name; ?>'><?php echo $main_agen->kota_name; ?> - <?php echo $main_agen->name; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <input type='submit' name='submit' value='Cari' class="btn btn-info">
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                    <thead>
                        <tr>

                            <th width="50%">Paket</th>
                            <th width="50%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <td><b><?php echo $transaksi['nomor_resi']; ?></b><br>
                                    <?php echo $transaksi['kota_from']; ?><br><?php echo $transaksi['kota_name']; ?></td>

                                <td>

                                    <?php if ($transaksi['status'] == null) : ?>
                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url('mainagen/transaksi/ambil/' . $transaksi['id']); ?>">Ambil Paket</a>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <a href="<?php echo base_url('mainagen/transaksi/lacak/' . $transaksi['id']); ?>" class="btn btn-info btn-sm">
                                        <ion-icon name="eye-outline"></ion-icon> Lacak
                                    </a>
                                    <?php if ($transaksi['status'] == null) : ?>

                                    <?php elseif ($transaksi['from_agen'] == null) : ?>

                                    <?php else : ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>


                    </tbody>
                </table>

                <?php if (count($transaksi) == 0) : ?>

                    <div class="card my-2">
                        <div class="card-body display-5 text-center">
                            <span class="my-3">Tidak Ada Iklan yang di tampilkan </span><br>
                            di Halaman <b><?php echo $title ?></b> Coba Ganti Pencarian Anda<br>
                            <div class="col-md-6 mx-auto my-3">
                                <!-- Search form (start) -->
                                <?php echo form_open('iklan/search'); ?>
                                <div class="input-group mb-3">
                                    <input type="text" name='search' class="form-control" placeholder="Cari Produk.." value='<?= $search ?>'>
                                    <div class="input-group-append">
                                        <input type='submit' name='submit' value='Cari' class="btn btn-info">
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>

                            <a href="<?php echo base_url(); ?>" class="btn btn-success text-white my-3">Kembali ke Home</a>

                        </div>

                    </div>

                <?php endif; ?>


            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white border-top">
                <ul class="pagination m-0">
                    <div class="pagination col-md-12 text-center">
                        <?php if (isset($pagination)) {
                            echo $pagination;
                        } ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->