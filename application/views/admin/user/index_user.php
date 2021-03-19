<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5><?php echo $title; ?></h5>
        <a href="<?php echo base_url(); ?>" class="btn btn-info right">Daftarkan Akun Counter</a>
    </div>
    <div class="card-body">
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
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Status</th>

                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($list_user as $list_user) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $list_user->name; ?></td>
                        <td><?php echo $list_user->role; ?></td>
                        <td>

                            <?php if ($list_user->is_active == 1) : ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php else : ?>
                                <span class="badge badge-danger">Nonactive</span>
                            <?php endif; ?>

                        </td>

                        <td>
                            <?php if ($list_user->is_active == 0) : ?>
                                <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/seller/activated/' . $list_user->id); ?>"><i class="fas fa-user-times"></i> Activated</a>
                            <?php else : ?>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/seller/banned/' . $list_user->id); ?>"><i class="fas fa-user-times"></i> Banned</a>

                            <?php endif; ?>





                            <a href="<?php echo base_url('products/user/' . $list_user->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>

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
</div>