<div class="col-md-5 mx-auto">
    <div class="card">
        <div class="card-header">
            <?php echo $title; ?> - <?php echo $user->name; ?>
        </div>
        <div class="card-body">
            <?php
            echo form_open('admin/mainagen/data_bank/' . $user->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate'))
            ?>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nama Bank</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="bank_name" placeholder="Nama Bank" value="<?php echo $user->bank_name; ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Nama Bank.</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Atas Nama</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="bank_account" placeholder="Nama Pemilik Rekening" value="<?php echo $user->bank_account; ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Nama Pemilik Akun Bank.</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nomor Rekening</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="bank_number" placeholder="Nomor Rekening Akun Bank" value="<?php echo $user->bank_number; ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Nomor Rekening Akun Bank.</div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Cabang</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="bank_branch" placeholder="Cabang" value="<?php echo $user->bank_branch; ?>" required>
                    <div class="invalid-feedback">Silahkan Masukan Wilayah atau Cabang Akun Bank.</div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary btn-block">
                        Update Data Bank
                    </button>
                </div>
            </div>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>