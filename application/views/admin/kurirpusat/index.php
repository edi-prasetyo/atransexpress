<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title; ?></h3>
        <div class="card-tools">
            <a href="<?php echo base_url(); ?>admin/kurirpusat/create" class="btn btn-info right"><i class="fa fa-plus"></i> Buat Kurir Pusat</a>
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
                    <th>ID Kurir</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Locked</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($kurirpusat as $kurirpusat) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $kurirpusat->user_code; ?></td>
                    <td><?php echo $kurirpusat->name; ?></td>
                    <td><?php echo $kurirpusat->role; ?></td>
                    <td>
                        <?php if ($kurirpusat->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($kurirpusat->is_locked == 1) : ?>
                            <span class="badge badge-success">No</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Yes</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($kurirpusat->is_locked == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/kurirpusat/activated/' . $kurirpusat->id); ?>"><i class="fas fa-kurirpusat-times"></i> Setujui</a>
                        <?php endif; ?>

                        <?php if ($kurirpusat->is_active == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/kurirpusat/activated/' . $kurirpusat->id); ?>"><i class="fas fa-kurirpusat-times"></i> Activated</a>
                        <?php else : ?>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/kurirpusat/banned/' . $kurirpusat->id); ?>"><i class="fas fa-kurirpusat-times"></i> Banned</a>

                        <?php endif; ?>
                        <a href="<?php echo base_url('admin/kurirpusat/detail/' . $kurirpusat->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/kurirpusat/update/' . $kurirpusat->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Update</a>
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