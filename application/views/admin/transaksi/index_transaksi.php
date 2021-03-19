<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <?php echo $title; ?>
            </div>
            <div class="col-md-6">
                <?php echo form_open('admin/transaksi/cari'); ?>
                <div class="input-group mb-3" style="width: 100%;">
                    <select class="form-control select2bs4" name="search">
                        <option>-- Pilih Kota --</option>
                        <?php foreach ($main_agen as $main_agen) : ?>
                            <option value='<?php echo $main_agen->kota_id; ?>'><?php echo $main_agen->kota_name; ?> - <?php echo $main_agen->name; ?> </option>
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


    <div class="table-responsive">
        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Counter</th>
                    <th>Resi</th>
                    <th>Status</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Harga</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($transaksi as $transaksi) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d/m/Y', $transaksi->date_created); ?> <?php echo date('H:i:s', $transaksi->date_created); ?></td>
                    <td><?php echo $transaksi->name; ?></td>
                    <td><?php echo $transaksi->nomor_resi; ?></td>
                    <td>
                        <?php if ($transaksi->stage == 9) : ?>
                            <span class="badge badge-success badge-pill">Selesai</span>
                        <?php else : ?>
                            <span class="badge badge-danger badge-pill">Proses</span>
                        <?php endif; ?>

                    </td>
                    <td><?php echo $transaksi->kota_from; ?></td>
                    <td><?php echo $transaksi->kota_name; ?></td>
                    <td>Rp. <?php echo number_format($transaksi->harga, 0, ",", "."); ?></td>
                    <!-- <td><img class="img-fluid" src="<?php echo base_url('assets/img/barcode/' . $transaksi->barcode); ?>"></td> -->
                    <td>
                        <a href="<?php echo base_url('admin/transaksi/lacak/' . $transaksi->id); ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-code-branch"></i> Lacak
                        </a>
                        <a href="<?php echo base_url('admin/transaksi/detail/' . $transaksi->id); ?>" class="btn btn-success btn-sm">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
            <?php $no++;
            }; ?>
        </table>
        <hr>
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>