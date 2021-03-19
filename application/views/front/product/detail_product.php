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
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Detail Produk</div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <?php if ($products->product_img == NULL) : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/empty_image.jpg'); ?>"></div>
                            <?php else : ?>
                                <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/product/') . $products->product_img; ?>"></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h2><?php echo $products->product_name; ?></h2>
                            <?php if ($products->product_stock == 0) : ?>
                                Stok : <span class="badge badge-danger"> Habis</span>
                            <?php else : ?>
                                Stok : <span class="badge badge-success"><?php echo $products->product_stock; ?></span>
                            <?php endif; ?><br>
                            Ukuran :
                            <div class="alert alert-info"><?php echo $products->product_size; ?></div>
                            Kategori Produk :
                            <div class="alert alert-info"><?php echo $products->category_product_name; ?></div>
                        </div>

                        <hr>
                        <div class="col-md-12">

                            <h3>Deskripsi Produk</h3>

                            <?php echo $products->product_desc; ?><br>
                            <h3> <?php if ($this->session->userdata('id')) : ?>
                                            Rp. <?php echo number_format($products->price_reseller,'0',',','.'); ?>
                                        
                                        <?php  else: ?>
                                            Rp. <?php echo number_format($products->product_price,'0',',','.'); ?>
                                        <?php endif; ?></h3><br>


                            <a class="btn btn-primary" href="<?php echo base_url('products/order/' .$products->id);?>">Beli Emas</a>


                        </div>



                    </div>



                </div>
            </div>
        </div>


        <div class="col-md-4">
            


            <div class="card">
                <div class="card-header">Produk Lainya</div>
                <div class="card-body">


                    <?php foreach ($related_products as $related_products) : ?>
                       
                                <div class="row">
                                    <span class="col-md-4"><img src="<?php echo base_url('assets/img/product/' . $related_products->product_img); ?>" class="img img-thumbnail img-fluid"></span>


                                    <span class="col-md-8">
                                        <h5><a href="<?php echo base_url('products/detail/' . $related_products->product_slug); ?>"> <?php echo $related_products->product_name; ?></a></h5>
                                        <a class="btn btn-primary btn-sm" href="<?php echo base_url('products/detail/' . $related_products->product_slug); ?>"> Detail Produk</a>
                                    </span>
                                </div>
                                <hr>

                           
                    <?php endforeach; ?>













                </div>
            </div>

        </div>
    </div>

</div>