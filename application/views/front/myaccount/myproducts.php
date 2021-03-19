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

                    <?php
                    //Notifikasi
                    if ($this->session->flashdata('message')) {
                        echo '<div class="alert alert-success alert-dismissable fade show">';
                        echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                        echo $this->session->flashdata('message');
                        echo '</div>';
                    }


                    ?>

                    <div class="card-body">
                        <h2><?php echo $title; ?></h2>
                        <p>Selamat Datang di Web <b><?php echo $meta->title; ?></b></p>
                        <a href="<?php echo base_url('myaccount/create'); ?>" class="btn btn-primary btn-user ">
                            Tambah Produk
                        </a>
                        <hr>


                        <?php if (!empty($myproducts)) : ?>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="text-light" style="background: #008fe1;">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th scope="col">Produk</th>
                                            <th scope="col">Kategory</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">status</th>
                                            <th width="40%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($myproducts as $myproducts) : ?>

                                            <tr>
                                                <th><?php echo $no; ?></th>
                                                <td><?php echo $myproducts->product_name; ?></td>
                                                <td><?php echo $myproducts->category_product_name; ?></td>
                                                <td><?php echo $myproducts->product_price; ?></td>
                                                <td><?php echo $myproducts->product_status; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('products/detail/' . $myproducts->product_slug); ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Lihat</a>
                                                    <a href="<?php echo base_url('myaccount/updateproduct/' . $myproducts->id); ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                                    <?php include "delete_product.php"; ?>

                                                </td>
                                            </tr>

                                        <?php $no++;
                                        endforeach; ?>

                                    </tbody>
                                </table>
                            </div>


                        <?php else : ?>

                            <div class="alert alert-success text-center">
                                Belum Ada Produk Yang di buat<br>

                                <a href="<?php echo base_url('myaccount/create'); ?>" class="btn btn-primary btn-user ">
                                    Buat Produk Baru
                                </a>

                            </div>

                        <?php endif; ?>




                        <div class="pagination col-md-12 text-center">
                            <?php if (isset($pagination)) {
                                echo $pagination;
                            } ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


<?php else : ?>

    <?php redirect('auth'); ?>

<?php endif; ?>