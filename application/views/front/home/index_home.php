<!-- <section class="mb-3">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>

        </ol>
        <div class="carousel-inner">
            <?php $i = 1;
            foreach ($slider as $slider) { ?>
                <div class="carousel-item <?php if ($i == 1) {
                                                echo 'active';
                                            } ?> ">
                    <a href="<?php echo base_url() . $slider->galery_url; ?>"><img width="100%" src="<?php echo base_url('assets/img/galery/' . $slider->galery_img) ?>" alt="<?php echo $slider->galery_title ?>"></a>
                    <div class="container">
                        <div class="carousel-caption text-left">
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section> -->


<section class="boot-elemant-bg py-md-5 py-4 hero" style="background-color:darkblue;height: 500px; background-image: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.9)), url('assets/img/galery/bg.webp');">
    <div class="container position-relative py-md-5 py-0">
        <div class="row">
            <div class="container" style="position: absolute;">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text-left text-white">
                            <h1><b>Jasa Pengiriman Paket di seluruh Indonesia.</b></h1>
                            <p>Temukan Agen Atrans Express di kota anda.</p>
                            <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p> -->
                        </div>
                    </div>
                    <div class="col-md-5">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="elemant-bg-overlay black"></div>
    <svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
        <path d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path>
    </svg>
</section>


<section class="py-5 bg-white">
    <div class="container cek-resi">
        <div class="card-group">
            <div class="card shadow-sm col-md-5">
                <div class="card-body">
                    <h5 class="card-title">Cek Resi</h5>
                    <?php echo form_open('lacak',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <label>Nomor Resi</label>
                    <input type="text" name="nomor_resi" class="form-control" placeholder="Nomor Resi" required>
                    <div class="invalid-feedback">Silahkan Masukan Nomor Resi</div>
                    <button type="submit" class="btn btn-info btn-block mt-3">Lacak Resi</button>
                    <?php echo form_close(); ?>
                </div>
            </div>

            <div class="card shadow-sm col-md-7">
                <div class="card-body">
                    <h5 class="card-title">Cek Tarif</h5>
                    <?php echo form_open('tarif',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                    <div class="form-row align-items-center row">
                        <div class="col-md-5">
                            <label>Kota Asal</label>
                            <select class="form-control-chosen" name="kota_asal" required>
                                <option value="">Choose...</option>
                                <?php foreach ($kota_asal as $data) : ?>
                                    <option value="<?php echo $data->kota_name; ?>"><?php echo $data->kota_name; ?> </option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback">Silahkan Pilih Kota Asal.</div>
                        </div>
                        <div class="col-md-5">
                            <label>Kota Tujuan</label>
                            <select class="form-control-chosen" name="kota_tujuan" required>
                                <option value="">Choose...</option>
                                <?php foreach ($kota_tujuan as $data) : ?>
                                    <option value="<?php echo $data->kota_name; ?>"><?php echo $data->kota_name; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Silahkan Pilih Kota Tujuan.</div>
                        </div>
                        <div class="col-md-2">
                            <label>Berat</label>
                            <input type="text" class="form-control" placeholder="kg" name="berat" required>
                            <div class="invalid-feedback">Masukian Berat</div>
                        </div>
                        <div class="col-md-6 my-3">
                            <button type="submit" class="btn btn-warning btn-block">Cek Tarif</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>
    </div>
</section>





<!-- <section>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>

        </ol>
        <div class="carousel-inner">
            <?php $i = 1;
            foreach ($slider as $slider) { ?>
                <div class="carousel-item <?php if ($i == 1) {
                                                echo 'active';
                                            } ?> ">
                    <a href="<?php echo base_url() . $slider->galery_url; ?>"><img class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $slider->galery_img) ?>" alt="<?php echo $slider->galery_title ?>"></a>
                    <div class="container">
                        <div class="carousel-caption text-left">
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section> -->


<section class="bg-info">

</section>



<!-- <section class="bg-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div style="font-size:50px;color:#00a2e9;">
                                    <i class="ti-id-badge"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <h4>Card Title</h4>
                                Card Description.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div style="font-size:50px;color:#00a2e9;">
                                    <i class="ti-id-badge"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <h4>Card Title</h4>
                                Card Description.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div style="font-size:50px;color:#00a2e9;">
                                    <i class="ti-id-badge"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <h4>Card Title</h4>
                                Card Description.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->