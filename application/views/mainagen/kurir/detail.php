<div class="row">
    <div class="col-md-5 mx-auto">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/img/avatars/' . $kurir->user_image) ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php
                                                            echo $kurir->name;
                                                            ?></h3>

                <p class="text-muted text-center"><?php echo $kurir->role; ?> </p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>No. Handphone </b> <span class="float-right"><?php echo $kurir->user_phone; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?php echo $kurir->email; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Kurir ID</b> <span class="float-right"><?php echo $kurir->user_code; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Alamat</b> <span class="float-right"><?php echo $kurir->user_address; ?></span>
                    </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Ubah Data</b></a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>