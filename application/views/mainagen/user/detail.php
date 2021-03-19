<div class="row">
    <div class="col-md-8 mx-auto">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <!-- <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                </div> -->

                <h3 class="profile-username text-center"><?php
                                                            echo $my_counter->name;
                                                            ?></h3>

                <p class="text-muted text-center"><?php echo $my_counter->role; ?></p>

                <div class="row">
                    <div class="col-md-6 text-right">
                        <b>ID Counter</b>
                    </div>
                    <div class="col-md-6">
                        : <?php echo $my_counter->counter_code; ?>
                    </div>

                    <div class="col-md-6 text-right">
                        <b>Email</b>
                    </div>
                    <div class="col-md-6">
                        : <?php echo $my_counter->email; ?>
                    </div>

                    <div class="col-md-6 text-right">
                        <label>No. Handphone</label>
                    </div>
                    <div class="col-md-6">
                        : <?php echo $my_counter->user_phone; ?>
                    </div>
                    <div class="col-md-6 text-right">
                        <label>Alamat</label>
                    </div>
                    <div class="col-md-6">
                        : <?php echo $my_counter->user_address; ?>
                    </div>

                </div>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>