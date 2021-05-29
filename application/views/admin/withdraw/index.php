<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4">
                <?php echo $title; ?>
            </div>
            <div class="col-md-4">
                <?php echo form_open('admin/withdraw'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="resi" class="form-control" placeholder="Masukan Nomor Resi" value="<?php echo set_value('resi'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table">
            <thead class="thead-white">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Kode Top Up</th>
                    <th>MainAgen</th>
                    <th>Nominal</th>
                    <th>Status</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($withdraw as $withdraw) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($withdraw->date_created)); ?><br> <?php echo date('H:i:s', strtotime($withdraw->date_created)); ?></td>
                    <td><b><?php echo $withdraw->code_withdraw; ?></b></td>
                    <td><?php echo $withdraw->name; ?></td>
                    <td>Rp. <?php echo number_format($withdraw->nominal_withdraw, 0, ",", "."); ?></td>
                    <td>
                        <?php if ($withdraw->status_withdraw == "Pending") : ?>
                            <span class="badge badge-warning badge-pill">Pending</span>
                        <?php elseif ($withdraw->status_withdraw == "Process") : ?>
                            <span class="badge badge-info badge-pill">Proses</span>
                        <?php elseif ($withdraw->status_withdraw == "Cancel") : ?>
                            <span class="badge badge-danger badge-pill">Batal</span>
                        <?php else : ?>
                            <span class="badge badge-success badge-pill">Selesai</span>
                        <?php endif; ?>

                    </td>
                    <td>

                        <a href="<?php echo base_url('admin/withdraw/detail/' . $withdraw->id); ?>" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
            <?php $no++;
            }; ?>
        </table>
    </div>
    <div class="card-footer bg-white border-top">
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>