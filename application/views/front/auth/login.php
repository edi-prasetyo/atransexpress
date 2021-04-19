<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="card my-5">
            <div class="card-header bg-white">
                <h5 class="text-center">Silahkan Login!</h5>
            </div>
            <div class="card-body">
                <!-- Nested Row within Card Body -->


                <div class="text-center">

                    <?php echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                    ?>
                </div>
                <?php
                $attributes = array('class' => 'user');
                echo form_open('auth', $attributes)
                ?>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-md-right"></label>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                        </button>
                    </div>
                </div>



                <?php echo form_close() ?>



            </div>

            <div class="card-footer bg-white">
                <div class="text-center">
                    <a href="<?php echo base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                </div>
                <!-- <div class="text-center">
                                <a class="small" href="<?php echo base_url('auth/register') ?> ">Create an Account!</a>
                            </div> -->
            </div>

        </div>
    </div>

</div>