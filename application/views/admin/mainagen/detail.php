<div class="row">
    <div class="col-md-5 mx-auto">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <?php if ($main_agen->user_image == NULL) : ?>
                        <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/img/avatars/default.jpg') ?>" alt="User profile picture">
                    <?php else : ?>
                        <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/img/avatars/' . $main_agen->user_image) ?>" alt="User profile picture">
                    <?php endif; ?>
                </div>
                <h3 class="profile-username text-center"><?php
                                                            echo $main_agen->name;
                                                            ?></h3>

                <p class="text-muted text-center"><?php echo $main_agen->role; ?> </p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>No. Handphone </b> <span class="float-right"><?php echo $main_agen->user_phone; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?php echo $main_agen->email; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>ID</b> <span class="float-right"><?php echo $main_agen->user_code; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Kota</b> <span class="float-right"><?php echo $main_agen->kota_name; ?> - <?php echo $main_agen->provinsi_name; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Alamat</b> <span class="float-right"><?php echo $main_agen->user_address; ?></span>
                    </li>

                </ul>

                <h5 class="my-5">Data Bank</h5>

                <ul class="list-group list-group-unbordered mb-3">

                    <li class="list-group-item">
                        <b>Nama Bank</b> <span class="float-right"><?php echo $main_agen->bank_name; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Atas Nama</b> <span class="float-right"><?php echo $main_agen->bank_account; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Nomor Rekening</b> <span class="float-right"><?php echo $main_agen->bank_number; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Cabang</b> <span class="float-right"><?php echo $main_agen->bank_branch; ?></span>
                    </li>
                </ul>

                <a href="<?php echo base_url('admin/mainagen/data_bank/' . $main_agen->id); ?>" class="btn btn-info btn-block"><b>Ubah Data Bank</b></a>
                <a href="<?php echo base_url('admin/mainagen/update/' . $main_agen->id); ?>" class="btn btn-primary btn-block"><b>Ubah Profile</b></a>
                <a href="<?php echo base_url('admin/mainagen/update_password/' . $main_agen->id); ?>" class="btn btn-success btn-block"><b>Ubah Password</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>