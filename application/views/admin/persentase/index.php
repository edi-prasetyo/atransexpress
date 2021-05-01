<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <?php echo $title; ?>

            </div>

            <div class="card-body">

                <a href="<?php echo base_url('admin/persentase/update/' . $persentase->id); ?>" class="btn btn-rounded btn-info btn-sm"><i class="fa fa-edit"></i> Ubah Data</a>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Counter Agen</h3>
                    </div>
                    <div class="col-md-3">Pemotongan Saldo</div>
                    <div class="col-md-9">: <?php echo $persentase->potong_saldo; ?> %</div>
                    <hr>
                    <div class="col-md-12">
                        <h3>Main Agen</h3>
                    </div>
                    <div class="col-md-3">Fee Dari Counter Agen</div>
                    <div class="col-md-9">: <?php echo $persentase->fee_from_counter; ?> %</div>
                    <hr>
                    <div class="col-md-3">Fee dari Luar Kota </div>
                    <div class="col-md-9">: <?php echo $persentase->fee_from_agen; ?> %</div>

                </div>
            </div>
        </div>
    </div>


</div>