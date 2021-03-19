<div class="col-md-3 mx-auto">
    <div class="card mb-5 bg-white rounded">
        <div class="card-header bg-info text-light">
            <?php echo $title; ?> <br />
        </div>
        <div class="card-body">

            <?php
            //Notifikasi
            if ($this->session->flashdata('message')) {
                echo '<div class="alert alert-success alert-dismissable fade show">';
                echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                echo $this->session->flashdata('message');
                echo '</div>';
            }
            echo validation_errors('<div class="alert alert-warning">', '</div>');

            ?>

            <?php
            echo $this->session->flashdata('message');
            if (isset($error_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>

            <div class="row mb-3">
                <div class="col-4">Nama</div>
                <div class="col-8"><b>: <?php echo $transaksi->nama_penerima; ?></b></div>
                <div class="col-4">Alamat</div>
                <div class="col-8"><b>: <?php echo $transaksi->alamat_penerima; ?></b></div>

            </div>
            <?php echo form_open_multipart('kurir/transaksi/finish/' . $transaksi->id); ?>
            <div class="form-group">
                <label>Nama Penerima</label>
                <input type="text" class="form-control" name="penerima">
                <?php echo form_error('penerima', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

            <div class="custom-file">
                <input type='file' class="custom-file-input" id="customFile" name="foto">
                <label class="custom-file-label" for="customFile">Ambil Foto</label>
            </div>
            <br>
            <img class="img-fluid mt-4" id="gambar" src="#" alt="Ambil Foto" OnError=" $(this).hide();" />

            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">Selesai</button>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#customFile").change(function() {
        $('#gambar').show();
        readURL(this);
    });
</script>