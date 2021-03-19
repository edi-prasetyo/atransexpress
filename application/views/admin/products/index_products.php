<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5><?php echo $title; ?></h5>
        </div>
        <div class="card-header-right">
<a class="btn btn-primary" href="<?php echo base_url('admin/products/create');?>"> Buat Produk</a>
        </div>

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

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Type</th>
                        <th>Harga</th>
                        <th>Reseller</th>
                        <th>Stok</th>

                        <th>Views</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($products as $products) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $products->product_name; ?></td>
                        <td><?php echo $products->category_product_name; ?></td>
                        <td>Rp. <?php echo number_format($products->product_price,'0',',','.'); ?></td>
                        <td>Rp. <?php echo number_format($products->price_reseller,'0',',','.'); ?></td>
                        <td><?php echo $products->product_stock; ?> Pcs</td>

                        <td><?php echo $products->product_views; ?></td>
                        <td>
                            <a href="<?php echo base_url('products/detail/' . $products->product_slug); ?>" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/products/update/' . $products->id); ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i> Edit</a>
                            <?php include "delete_product.php"; ?>
                        </td>
                    </tr>

                <?php $no++;
                }; ?>
            </table>
            <hr>
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>

        </div>

    </div>
</div>