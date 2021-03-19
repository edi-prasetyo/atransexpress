<?php if ($this->session->userdata('id')) : ?>

    <div class="breadcrumb-default">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
                <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ul>
        </div>
    </div>

    <div class="margin-top container">
        <div class="row">
            <div class="col-md-3">
                <?php include "sidebar_account.php"; ?>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <?php echo $title; ?>
                    </div>
                    <div class="card-body">


                        <div class="text-center">
                            <?php
                            echo $this->session->flashdata('message');
                            if (isset($errors_upload)) {
                                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
                            }
                            ?>
                        </div>
                        <?php
                        echo form_open_multipart('myaccount/updateproduct/' . $products->id);
                        ?>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Produk <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo $products->product_name; ?>">
                                <?php echo form_error('product_name', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Harga Produk <span class="text-danger">Optional</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="product_price" placeholder="Harga Produk" value="<?php echo $products->product_price; ?>">
                                <?php echo form_error('product_price', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Stok Produk <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="product_stock" placeholder="Stok Produk" value="<?php echo $products->product_stock; ?>">
                                <?php echo form_error('product_stock', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Ukuran Produk <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="product_size" placeholder="Ukuran Produk" value="<?php echo $products->product_size; ?>">
                                <?php echo form_error('product_size', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select name="category_id" class="form-control form-control-chosen select2_demo_1">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($category_products as $category_products) { ?>
                                        <option value="<?php echo $category_products->id ?>" <?php if ($products->category_product_id == $category_products->id) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                            <?php echo $category_products->category_product_name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Status Product <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <select name="product_status" class="form-control form-control-chosen select2_demo_1">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif" <?php if ($products->product_status == "Nonaktif") {
                                                                    echo "selected";
                                                                } ?>>Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-6">
                                <div class="input-group mb-3">
                                    <input type="file" name="product_img">
                                    <?php if ($products->product_img == NULL) : ?>
                                        <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/empty_image.jpg'); ?>"></div>
                                    <?php else : ?>
                                        <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/') . $products->product_img; ?>"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Deskripsi Produk <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">

                                <textarea class="form-control" id="summernote" name="product_desc"><?php echo $products->product_desc; ?></textarea>
                                <?php echo form_error('product_desc', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Update Produk
                                </button>
                            </div>
                        </div>

                        <?php echo form_close() ?>


                    </div>
                </div>
            </div>
        </div>
    </div>


<?php else : ?>

    <?php redirect('auth'); ?>

<?php endif; ?>