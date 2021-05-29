<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <?php echo form_open('admin/mainagen'); ?>
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Masukan Nama / Email" value="<?php echo set_value('search'); ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </h3>



        <div class="card-tools">
            <a href="<?php echo base_url(); ?>admin/mainagen/create" class="btn btn-info right"><i class="fa fa-plus"></i> Buat Main Agen</a>
        </div>
    </div>
    <div class="card-body">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success alert-dismissable fade show">';
            echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
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
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/mainagen/activated/' . $main_agen->id); ?>"><i class="fas fa-mainagen-times"></i> Setujui</a>
                        <?php endif; ?>

                        <?php if ($main_agen->is_active == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/mainagen/activated/' . $main_agen->id); ?>"><i class="fas fa-mainagen-times"></i> Activated</a>
                        <?php else : ?>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/mainagen/banned/' . $main_agen->id); ?>"><i class="fas fa-mainagen-times"></i> Banned</a>

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