<?php $user_id = $this->session->userdata('id'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>

                <div class="card-tools">
                    <?php echo form_open('mainagen/transaksi/kirim'); ?>
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
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($transaksi->date_created)); ?> - <?php echo date('H:i:s', strtotime($transaksi->date_created)); ?> WIB<br>

                                    <b><?php echo $transaksi->nomor_resi; ?></b><br>
                                    Rp. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?>
                                </td>
                                <td>
                                    <i class="far fa-dot-circle text-danger"></i> <?php echo $transaksi->kota_from; ?> <br>
                                    <i class="fa fa-map-marker-alt text-success"></i> <?php echo $transaksi->kota_name; ?>
                                </td>
                                <td>

                                    <?php if ($transaksi->user_stage == $user_id && $transaksi->stage == 6) : ?>
                                        <a href="<?php echo base_url('mainagen/transaksi/kurir/' . $transaksi->id); ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-motorcycle"></i> Pilih Kurir
                                        </a>
                                    <?php elseif ($transaksi->stage == 2) : ?>
                                        <a href="<?php echo base_url('mainagen/transaksi/kurir/' . $transaksi->id); ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-motorcycle"></i> Pilih Kurir
                                        </a>

                                    <?php else : ?>
                                        <span class="text-danger">Belum di Ambil<br>Kurir </span>
                                        <?php include "datakurir.php"; ?>
                                    <?php endif; ?>

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