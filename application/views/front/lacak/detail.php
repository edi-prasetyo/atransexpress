<div class="col-md-7 mx-auto my-5">
    <div class="card">

        <div class="card-body">

            <?php
            // Notifikasi
            if ($this->session->flashdata('message')) {

                echo $this->session->flashdata('message');
                unset($_SESSION['message']);
            }
            //error warning
            echo validation_errors('<div class="alert alert-warning">', '</div>');
            //form open


            ?>

            <?php echo form_open('lacak'); ?>
            <h4><i class="bi bi-bag"></i> Lacak Paket!</h4>
            <p></p>

            <div class="form-group">
                <label> Nomor Resi </label>
                <input class="form-control" type="text" name="nomor_resi" placeholder="Masukan Nomor Resi">
                <?php echo form_error('nomor_resi', '<span class="text-danger">', '</span>'); ?>
            </div>
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-lock text-light"></i>Lacak Paket</button>
            </div>

            <?php echo form_close(); ?>


            <ul class="events">
                <?php foreach ($lacak as $lacak) : ?>
                    <li>
                        <time class="col-6 text-right is-done">

                            <?php echo date('d/m/Y', strtotime($lacak->date_updated)); ?><br>
                            <?php echo date('H:i', strtotime($lacak->date_updated)); ?> WIB
                        </time>
                        <span class="col-6 text-left"><strong><?php echo $lacak->provinsi_name; ?></strong> <?php echo $lacak->lacak_desc; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>