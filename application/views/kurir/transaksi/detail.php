<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#Edit<?php echo $transaksi->id; ?>">
    <i class="fa fa-eye"></i> Lihat
</button>

<div class="modal modal-default fade" id="Edit<?php echo $transaksi->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Paket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nomor Resi</label><br>
                    <input class="form-control" value="<?php echo $transaksi->nomor_resi ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Penerima</label><br>
                    <input class="form-control" value="<?php echo $transaksi->nama_penerima ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat</label><br>
                    <textarea class="form-control" readonly> <?php echo $transaksi->alamat_penerima ?></textarea>
                </div>
                <div class="form-group">
                    <label>No. Telp</label><br>
                    <input class="form-control" value="<?php echo $transaksi->telp_penerima ?>" readonly>
                </div>

            </div>
            <div class="modal-footer">
                <?php if ($transaksi->stage == 7) : ?>
                <?php else : ?>
                    <a href="<?php echo base_url('kurir/transaksi/finish/' . $transaksi->id); ?>" class="btn btn-success pull-left">
                        <i class="fas fa-parachute-box"></i> Selesai
                    </a>
                <?php endif; ?>
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->