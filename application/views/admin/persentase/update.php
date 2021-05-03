<div class="card shadow mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        echo form_open('admin/persentase/update/' . $persentase->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label"> Potongan Saldo Counter Agen <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="potong_saldo" value="<?php echo $persentase->potong_saldo; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">fee Dari Counter <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="fee_from_counter" value="<?php echo $persentase->fee_from_counter; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">fee Dari Luar Kota <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="fee_from_agen" value="<?php echo $persentase->fee_from_agen; ?>">
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-info btn-lg btn-block">
                    Update Data
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>