<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $title; ?>
                    </div>
                    <!-- <div class="col-md-6">
                        <?php echo form_open('kurirpusat/transaksi'); ?>
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
                    </div> -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Paket</th>
                            <th>Destinasi</th>
                            <th width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <td><b><?php echo $transaksi->nomor_resi; ?></b><br>
                                    Rp. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?>
                                </td>
                                <td>
                                    <i class="far fa-dot-circle text-danger"></i> <?php echo $transaksi->kota_from; ?> <br>
                                    <i class="fa fa-map-marker-alt text-success"></i> <?php echo $transaksi->kota_name; ?>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm btn-block" href="<?php echo base_url('kurirpusat/transaksi/ambil/' . $transaksi->id); ?>">Ambil Paket</a>
                                    <?php include "view_ambil.php"; ?>
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