<?php
$meta      = $this->meta_model->get_meta();

?>


<footer class="footer py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-box-info">
                    <a href="index.html" class="footer-logo">
                        <img src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>" alt="footer_logo" class="img-fluid footer-logo">
                    </a>
                    <p class="footer-info-text">
                        <?php echo $meta->description; ?>
                    </p>
                    <div class="footer-social-link">
                        <h3>Follow us</h3>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Social link -->
                </div>
            </div>
            <!-- End Col -->


            <div class="col-md-8 my-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-us">
                            <div class="contact-icon">
                                <i class="fa fa-map-marked-alt" aria-hidden="true"></i>
                            </div>
                            <!-- End contact Icon -->
                            <div class="contact-info">
                                <h3>Tangerang, Indonesia</h3>
                                <p>Jl. H. Adam Malik Kav. 65</p>
                            </div>
                            <!-- End Contact Info -->
                        </div>
                        <!-- End Contact Us -->
                    </div>
                    <!-- End Col -->
                    <div class="col-md-6">
                        <div class="contact-us contact-us-last">
                            <div class="contact-icon">
                                <i class="fa fa-headset" aria-hidden="true"></i>
                            </div>
                            <!-- End contact Icon -->
                            <div class="contact-info">
                                <h3><?php echo $meta->telepon; ?> </h3>
                                <p>Customer Service</p>
                            </div>
                            <!-- End Contact Info -->
                        </div>
                        <!-- End Contact Us -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Contact Row -->
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="footer-widget footer-left-widget">
                            <div class="section-heading">
                                <h3>Links</h3>
                                <span class="border-black"></span>
                            </div>
                            <ul>
                                <li>
                                    <a href="#">Tentang Kami</a>
                                </li>
                                <li>
                                    <a href="#">Hubungi Kami</a>
                                </li>
                                <li>
                                    <a href="#">Layanan</a>
                                </li>

                            </ul>
                            <ul>
                                <li>
                                    <a href="#">Kebijakan Privasi</a>
                                </li>
                                <li>
                                    <a href="#">Syarat dan Ketentuan</a>
                                </li>
                                <li>
                                    <a href="#">Faq</a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Footer Widget -->
                    </div>
                    <!-- End col -->
                    <div class="col-md-12 col-lg-4">
                        <div class="footer-widget">
                            <div class="section-heading">
                                <h3>Subscribe</h3>
                                <span class="animate-border border-black"></span>
                            </div>
                            <p>
                                <!-- Don’t miss to subscribe to our new feeds, kindly fill the form below. -->
                                <?php echo $meta->tagline; ?>
                            </p>
                            <form action="#">
                                <div class="form-row">
                                    <div class="col footer-form">
                                        <input type="email" class="form-control" placeholder="Email Address">
                                        <button type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- End form -->
                        </div>
                        <!-- End footer widget -->
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Widget Row -->
    </div>
    <!-- End Contact Container -->


    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>Copyright © 2019, All Right Reserved <?php echo $meta->title; ?></span>
                </div>
                <!-- End Col -->
                <div class="col-md-6">
                    <div class="copyright-menu">
                        <ul>
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">Terms</a>
                            </li>
                            <li>
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Copyright Container -->
    </div>
    <!-- End Copyright -->
    <!-- Back to top -->
    <div id="back-to-top" class="back-to-top">
        <button class="btn btn-dark" title="Back to Top" style="display: block;">
            <i class="fa fa-angle-up"></i>
        </button>
    </div>
    <!-- End Back to top -->
</footer>
<!-- Load javascript Jquery -->
<script src="<?php echo base_url() ?>assets/template/front/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/front/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/js/chosen.jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/assets/js/vendor/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/js/moment-with-locales.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/js/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url() ?>assets/template/front/js/timepicker.js"></script>


<script>
    $(function() {
        $('#id_tanggal').datetimepicker({
            locale: 'id',
            format: 'D MMMM YYYY',
            minDate: new Date(),
        });
    });
    $('.form-control-chosen').chosen({});
    $('#timepicker').timepicker();
</script>



<script type="text/javascript">
    $('#menu-utama').affix({
        offset: {
            top: 500
        }
    })
</script>

<!-- Google Analitycs -->
<?php echo $meta->google_analytics; ?>
<!-- End Google Analitycs -->




<!-- SUMMERNOTE -->
<link href="<?php echo base_url('assets/template/admin/js/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/template/admin/js/summernote/summernote-lite.min.js'); ?>"></script>

<script>
    $('#summernote').summernote({
        tabsize: 2,
        height: 130,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>


<script>
    $(document).on('click', '.number-spinner button', function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') == 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });
</script>



<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>



</body>

</html>