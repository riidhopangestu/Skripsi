<style>
    .form-check-label{
        position: relative;
        color: #fff;
        background-color: #aaa;
        text-align: center;
        display: block;
        cursor: pointer;
        border: 3px solid transparent;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width:100px;
        font-size: 20px;
    }
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
        box-shadow:  0px 0px 0px 0px #000;
        border:none;
    }

</style>
<!-- Begin Page Content -->
<?php
if ($data->status == 1) {
    $status = '<span class="badge badge-warning"> Draft </span>';
} else if ($data->status == 2) {
    $status = '<span class="badge badge-primary"> Menunggu Konfirmasi </span>';
} else if ($data->status == 3) {
    $status = '<span class="badge badge-primary"> Prosess </span>';
} else if ($data->status == 4) {
    $status = '<span class="badge badge-success"> Selesai </span>';
} else {
    $status = '<span class="badge badge-danger"> Reject </span>';
}
?>
<div class="header-banner">
    <h1 align="center" style="font-size:50px"><b> Vedho Motorcycle Services </b></h1>
</div>
<hr/>
<br>
<div class="col d-flex justify-content-center">
    <!-- Page Heading -->
    <div class="card shadow mb-4 col-md-6">
        <div class="card-body">
            <h6> Detail Pesanan Service #<?php echo getReaNumber($data->prefik,$data->no); ?></h6>
            <hr/>
            <form action="<?php echo site_url('service/update/' . $data->id); ?>" method="post">
                <div class="form-group col-lg-12">
                    <fieldset class="scheduler-border">
                        <legend class="w-auto">&nbsp;Info Order&nbsp; </legend>
                        <table class="table table-responsive table-borderless">
                            <tr>
                                <th>No Order</th><td>:</td><td><?php echo getReaNumber($data->prefik,$data->no); ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Estimasi</th><td>:</td><td><?= date('d F Y', strtotime($data->tgl_estimasi)); ?></td>
                            </tr>
                            <tr>
                                <th>Nama</th><td>:</td><td><?= $data->nama; ?></td>
                            </tr>
                            <tr>
                                <th>No Telepon</th><td>:</td><td><?= $data->no_tlpn; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th><td>:</td><td><?= $data->email; ?></td>
                            </tr>
                            <tr>
                                <th>Alamat </th><td>:</td><td><?= $data->alamat; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th><td>:</td><td><?= $status; ?></td>
                            </tr>
                            <?php if ($data->catatan_admin != '') { ?>
                                <tr>
                                    <th>Catatan Admin </th><td>:</td><td><?= $data->catatan_admin; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th>Kendaraan</th><td>:</td><td><?= $data->nama_kendaraan; ?>,&nbsp;<!-- <?= $data->merek_kendaraan; ?>,&nbsp; --><?= $data->tahun_kendaraan; ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kendaraan</th><td>:</td><td><?= $data->nama_jenis_kendaraan; ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Service</th><td>:</td><td><?= $data->nama_jenis_service; ?></td>
                            </tr>
                            <?php if ($data->id_mekanik != 0) { ?>
                                <tr>
                                    <th>Mekanik </th><td>:</td><td><?= $data->nama_mekanik; ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th>Catatan </th><td>:</td><td><?= $data->catatan; ?></td>
                            </tr>
                        </table>
                    </fieldset>
                </div>
                <hr/>
                <div class="form-group">
                    <a href="<?php echo base_url('site/order'); ?>" class="btn btn-lg btn-secondary">Back</a>
                    <?php if ($data->status == 1 || $data->status == 3) {?>
                    <a href="<?php echo site_url('site/update_status_order/') . $data->id; ?>" class="btn btn-lg <?=$data->status == 1?'btn-info':'btn-success';?>" title="Update Status Order"><?=$data->status == 1?"Prosess":"Selesai";?></a> 
                    <?php } ?>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
