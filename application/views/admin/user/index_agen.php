<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title; ?></h3>
        <div class="card-tools">
            <a href="<?php echo base_url(); ?>admin/user/create_agen" class="btn btn-info right"><i class="fa fa-plus"></i> Buat Main Agen</a>
        </div>
    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-success alert-dismissable fade show">';
        echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
        echo $this->session->flashdata('message');
        echo '</div>';
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID Agen</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>

                    <th width="30%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($user_agen as $user_agen) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $user_agen->counter_code; ?></td>
                    <td><?php echo $user_agen->name; ?></td>
                    <td><?php echo $user_agen->role; ?></td>
                    <td>
                        <?php if ($user_agen->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user_agen->is_locked == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/user/activated_counter/' . $user_agen->id); ?>"><i class="fas fa-user-times"></i> Setujui</a>
                        <?php endif; ?>

                        <?php if ($user_agen->is_active == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/seller/activated/' . $user_agen->id); ?>"><i class="fas fa-user-times"></i> Activated</a>
                        <?php else : ?>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/seller/banned/' . $user_agen->id); ?>"><i class="fas fa-user-times"></i> Banned</a>

                        <?php endif; ?>
                        <a href="<?php echo base_url('admin/user/detail/' . $user_agen->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/user/update_counter/' . $user_agen->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Update</a>
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>



    </div>
</div>