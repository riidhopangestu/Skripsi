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
<div class="col d-flex justify-content-center">
    <!-- Page Heading -->
    <div class="card shadow mb-4 col-md-8">
        <div class="card-header">
            <?php if ($data->status == 3 || $data->status == 4) { ?>
                <div class="float-right">
                    <a href="<?php echo base_url('service/print_order/' . $data->id); ?>" class="btn btn-md btn-info" target="blank"><i class="fa fa-print"> Print</i></a>
                </div>
            <?php } ?>
            <h1 class="h4 mb-4 text-gray-800"> Data Service</h1> 
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('service/view/' . $data->id); ?>" id="update_status" method="post">
                <div class="form-group col-lg-12">
                    <fieldset class="scheduler-border">
                        <legend class="w-auto">&nbsp;Info Order&nbsp; </legend>
                        <table class="table table-responsive table-borderless">
                            <tr>
                                <th>No Order</th><td>:</td><td><?php echo getReaNumber($data->prefik, $data->no); ?></td>
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
                <?php if ($data->status < 3) { ?>
                    <div class="form-group col-md-7">
                        <label for="fk_id_warga">Pilih Mekanik</label>
                        <select class="form-control" name="mekanik" id="mekanik" >
                            <option value="">Pilih mekanik</option>
                           <?php foreach ($mekanik as $key => $value) : ?>
                                <?php if ($value['rank'] < 6): ?>
                                <option value="<?php echo $value['id_mekanik'] ?>"><?php echo $value['nama_mekanik'] . ' (' . $value['nik'] . ')&nbsp; Rank: '.$value['rank'] ?></option>
                            <?php endif; ?>
                            <?php endforeach ?>
                            <?php echo form_error('id_alternatif', '<small class="text-danger pl-3">', '</small>'); ?>
                        </select>
                    </div>
                  
                        <div class="form-group col-md-6">
                            <label for="nama_warga">Catatan </label>
                            <textarea rows="4" cols="50" placeholder="Masukan Catatan (opsional)" class="form-control" name="catatan_admin" id="catatan_admin"><?php echo set_value('umur'); ?></textarea>
                            <?php echo form_error('catatan_admin', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    
                    <hr/>
                <?php } ?>
                <input type="hidden" name="status" value="<?= $data->status; ?>">
                <div class="form-group">
                    <a href="<?php echo base_url('service'); ?>" class="btn btn-sm btn-secondary">Back</a>
                    <div class='float-right'>
                        <?php if ($data->status < 3) { ?>
                             <button type="submit" name="prosess"  value="reject" class="btn btn-sm btn-danger pro_submit">Reject</button>
                        <?php } ?>
                        <?php if ($data->status < 4) { ?>
                            <button type="submit" name="prosess" value="prosess" class="btn btn-sm <?= $data->status == 2 ? 'btn-primary' : 'btn-success'; ?> pro_submit"><?= $data->status == 2 ? "Prosess" : "Selesai"; ?></button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function () {
        
        $("#mekanik").chosen();
        $(document).on("click", ":submit", function(e){
            var submit_pro = $(this).val();
//            alert(submit_pro);
            var status = '<?php echo $data->status; ?>';
            if (status == 2 && submit_pro =='prosess') {
                if ($('#mekanik').val() == '') {
                    alert("Silahkan Pilih Mekanik Terlebih Dahulu");
                    return false;
                }
            }
        });
    });
</script>