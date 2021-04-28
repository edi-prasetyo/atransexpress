<?php $user_id = $this->session->userdata('id'); ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
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