<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?> </h3>

                <div class="card-tools">
                    <?php echo form_open('mainagen/transaksi/from_agen'); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="resi" class="form-control" placeholder="Masukan Nomor Resi" value="<?php echo set_value('resi'); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table text-nowrap">
                    <thead>
                        <tr>

                            <th>Resi</th>
                            <th>tujuan</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <td><b><?php echo $transaksi->nomor_resi; ?></b><br>
                                    Rp. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?>
                                </td>
                                <td>
                                    <i class="fa fa-map-marker-alt text-success"></i> <?php echo $transaksi->kota_name; ?><br>
                                    <?php if ($transaksi->stage == 5) : ?>
                                        <div class="badge badge-danger">Paket Dalam Perjalanan</div>
                                    <?php elseif ($transaksi->stage == 6) : ?>
                                        <div class="badge badge-success">Paket Sudah Di terima</div>
                                    <?php elseif ($transaksi->stage == 7) : ?>
                                        <div class="badge badge-danger">Belum di Ambil Kurir <?php echo $transaksi->name; ?></div>
                                    <?php endif; ?>



                                </td>
                                <td>

                                    <?php if ($transaksi->stage == 5) : ?>
                                        <a class="btn btn-danger btn-sm btn-block" href="<?php echo base_url('mainagen/transaksi/terima/' . $transaksi->id); ?>">Terima Paket</a>
                                    <?php elseif ($transaksi->stage == 6) : ?>
                                        <a class="btn btn-success btn-sm btn-block" href="<?php echo base_url('mainagen/transaksi/pilih_kurir/' . $transaksi->id); ?>"> <i class="fa fa-motorcycle"></i> Pilih Kurir</a>

                                    <?php endif; ?>

                                    <a href="<?php echo base_url('mainagen/transaksi/lacak/' . $transaksi->id); ?>" class="btn btn-info btn-sm btn-block">
                                        <ion-icon name="eye-outline"></ion-icon> Lacak
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
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