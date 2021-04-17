<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title; ?></h3>
        <div class="card-tools">
            <a href="<?php echo base_url(); ?>mainagen/kurir/create" class="btn btn-info right"><i class="fa fa-plus"></i> Tambah Kurir</a>
        </div>
    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID Kurir</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Locked</th>
                    <th width="30%"></th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($my_kurir as $my_kurir) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $my_kurir->user_code; ?></td>
                    <td><?php echo $my_kurir->name; ?></td>
                    <td><?php echo $my_kurir->role; ?></td>
                    <td>
                        <?php if ($my_kurir->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($my_kurir->is_locked == 1) : ?>
                            <span class="badge badge-success">No</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Yes</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($my_kurir->is_active == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('mainagen/kurir/activated/' . $my_kurir->id); ?>"><i class="fas fa-user-times"></i> Activated</a>
                        <?php else : ?>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('mainagen/kurir/banned/' . $my_kurir->id); ?>"><i class="fas fa-user-times"></i> Banned</a>

                        <?php endif; ?>
                        <a href="<?php echo base_url('mainagen/kurir/detail/' . $my_kurir->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>
                        <a href="<?php echo base_url('mainagen/kurir/update/' . $my_kurir->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Edit</a>
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