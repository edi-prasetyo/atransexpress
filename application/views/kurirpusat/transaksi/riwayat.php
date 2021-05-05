<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Resi/Tujuan</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transaksi as $transaksi) : ?>
                            <tr>
                                <td>

                                    <?php echo date('d/m/Y', strtotime($transaksi->date_updated)); ?><br>
                                    <?php echo date('H:i', strtotime($transaksi->date_created)); ?> WIB
                                </td>
                                <td>
                                    <b><?php echo $transaksi->nomor_resi; ?></b><br>
                                    <i class="fa fa-map-marker-alt"></i> <?php echo $transaksi->kota_name; ?>
                                </td>
                                <td><a href="<?php echo base_url('kurirpusat/transaksi/lacak/' . $transaksi->id); ?>" class="btn btn-info btn-sm btn-block">
                                        <i class="fa fa-route"></i> Lacak
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white border-top">
                <ul class="pagination m-0">
                    <div class="pagination col-md-12 text-center">
                        <?php if (isset($pagination)) {
                            echo $pagination;
                        } ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->