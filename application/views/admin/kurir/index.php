<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title; ?></h3>
        <div class="card-tools">

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
                    <th>Kota</th>
                    <th>Role</th>
                    <th>Status</th>

                    <th width="10%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($main_agen as $main_agen) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $main_agen->user_code; ?></td>
                    <td><?php echo $main_agen->name; ?></td>
                    <td><?php echo $main_agen->kota_name; ?></td>
                    <td><?php echo $main_agen->role; ?></td>
                    <td>
                        <?php if ($main_agen->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('admin/kurir/detail/' . $main_agen->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>
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