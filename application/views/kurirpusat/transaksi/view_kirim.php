<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#Edit<?php echo $transaksi->id; ?>">
    <i class="fa fa-eye"></i> Lihat
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
                    <label>ID Agen</label>
                    <input type="text" class="form-control" name="transaksi_name" value="<?php echo $transaksi->user_code; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Agen</label>
                    <input type="text" class="form-control" name="transaksi_name" value="<?php echo $transaksi->name; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" class="form-control" name="transaksi_name" value="<?php echo $transaksi->user_phone; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" class="form-control" name="transaksi_name" value="<?php echo $transaksi->kota_name; ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat Agen</label>
                    <textarea class="form-control" readonly><?php echo $transaksi->user_address; ?></textarea>
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