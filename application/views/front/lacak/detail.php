<div class="container">
    <div class="row">
        <div class="col-md-4 my-5">
            <div class="card bg-warning">
                <div class="card-header">
                    Lacak Paket
                </div>
                <div class="card-body">
                    <?php echo form_open('lacak'); ?>
                    <div class="form-group">
                        <label> Nomor Resi </label>
                        <input class="form-control" type="text" name="nomor_resi" placeholder="Masukan Nomor Resi">
                        <?php echo form_error('nomor_resi', '<span class="text-danger">', '</span>'); ?>
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-lock text-light"></i>Lacak Paket</button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>

        <div class="col-md-8 my-5">
            <div class="row">
                <div class="col-6">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Kota Asal</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $transaksi['kota_from']; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header">Kota Tujuan</div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $transaksi['kota_to']; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
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
                    <ul class="events">
                        <?php foreach ($lacak as $lacak) : ?>
                            <li>
                                <time class="col-6 text-right is-done">

                                    <?php echo date('d/m/Y', strtotime($lacak->date_updated)); ?><br>
                                    <?php echo date('H:i', strtotime($lacak->date_updated)); ?> WIB
                                </time>
                                <span class="col-6 text-left"><strong><?php echo $lacak->provinsi_name; ?><?php echo $lacak->provinsi_name; ?></strong> <?php echo $lacak->lacak_desc; ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</div>