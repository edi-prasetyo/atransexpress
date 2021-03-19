<section>
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
</section>



<section class="bg-white py-5">
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
</section>