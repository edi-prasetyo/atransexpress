<?php
$meta      = $this->meta_model->get_meta();

?>



<footer class="bg-light mt-auto">
    <div class="credit text-center text-light py-md-3">Copyright &copy; <?php echo date('Y') ?> - <?php echo $meta->title ?> - <?php echo $meta->tagline ?></div>

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







</body>

</html>