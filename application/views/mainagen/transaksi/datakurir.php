<button type="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#Edit<?php echo $transaksi->id; ?>">
    <i class="fa fa-eye"></i> Lihat Kurir
</button>

<div class="modal modal-default fade" id="Edit<?php echo $transaksi->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="transaksi_name" value="<?php echo $transaksi->name ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="transaksi_name" value="<?php echo $transaksi->email ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" class="form-control" name="transaksi_name" value="<?php echo $transaksi->user_phone ?>" readonly>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->