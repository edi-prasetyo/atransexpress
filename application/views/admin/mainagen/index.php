<div class="card">
    <div class="card-header">

        <div class="row">
            <div class="col-md-3">
                <?php echo form_open('admin/mainagen'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Masukan Nama" value="<?php echo set_value('search'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-3">
                <?php echo form_open('admin/mainagen'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="search_email" class="form-control" placeholder="Masukan Email" value="<?php echo set_value('search_email'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-3">
                <?php echo form_open('admin/mainagen'); ?>
                <div class="input-group mb-3">
                    <select class="form-control select2bs4" name="search_kota">
                        <option>Pilih Kota</option>
                        <?php foreach ($list_kota as $kota) : ?>
                            <option value='<?php echo $kota->kota_name; ?>'><?php echo $kota->kota_name; ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

            <div class="col-md-3">
                <div class="card-tools">
                    <a href="<?php echo base_url(); ?>admin/mainagen/create" class="btn btn-info btn-block"><i class="fa fa-plus"></i> Add Mainagen</a>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success alert-dismissable fade show">';
            echo '<button class="close" data-dismiss="alert" aria-label="Close">??</button>';
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
            echo '</div>';
        }
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        ?>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kota</th>
                    <th>Email</th>
                    <th>Saldo</th>
                    <th>Status</th>
                    <th>Locked</th>
                    <th width="30%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($main_agen as $main_agen) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $main_agen->user_code; ?></td>
                    <td><?php echo $main_agen->name; ?></td>
                    <td><?php echo $main_agen->kota_name; ?> - <?php echo $main_agen->provinsi_name; ?></td>

                    <td><?php echo $main_agen->email; ?></td>
                    <td>Rp. <?php echo number_format($main_agen->saldo_mainagen, 0, ",", "."); ?><a href="<?php echo base_url('admin/mainagen/laporan_saldo/' . $main_agen->id); ?>" class="badge badge-warning">Laporan saldo</a> </td>
                    <td>
                        <?php if ($main_agen->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($main_agen->is_locked == 1) : ?>
                            <span class="badge badge-success">No</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Yes</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($main_agen->is_locked == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/mainagen/activated/' . $main_agen->id); ?>"><i class="fas fa-check"></i> Open</a>
                        <?php else : ?>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/mainagen/banned/' . $main_agen->id); ?>"><i class="fas fa-lock"></i> Lock</a>
                        <?php endif; ?>

                        <?php if ($main_agen->is_active == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/mainagen/activated/' . $main_agen->id); ?>"><i class="fas fa-times"></i> Activated</a>
                        <?php else : ?>


                        <?php endif; ?>
                        <a href="<?php echo base_url('admin/mainagen/detail/' . $main_agen->id); ?>" class="btn btn-info btn-sm"> <i class="fas fa-external-link-alt"></i> Detail</a>
                        <a href="<?php echo base_url('admin/mainagen/data_bank/' . $main_agen->id); ?>" class="btn btn-info btn-sm"> <i class="fas fa-credit-card"></i> Data Bank</a>
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>
    </div>
    <div class="card-footer">
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>