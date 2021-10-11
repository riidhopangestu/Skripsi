<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
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
<!-- Page Heading -->
<div class="header-banner">
    <h1 align="center" style="font-size:50px"><b> Vedho Motorcycle Services </b></h1>
</div>
<hr/>
<br>
<div class="header-banner"> <!-- style="background-image: url('assets/img/backgroundwelcome.jpg');
 background-position: top;"> -->
    <div class="header-banner-content">
        <div class="container">
            <h1>Service Update #<?php echo getReaNumber($data->prefik, $data->no); ?></h1>
            <hr/>
            <div class="card">
                <h5 class="card-header">Form Update <td></td></h5>
                <div class="card-body">
                    <a href="<?php echo site_url('data_kendaraan/insert') ?>" class="btn btn-sm btn-info" title="Update Order"><i class="fa fa-plus"></i> Tambah Data Kendaraan</a>                                    
                    <hr/>
                    <form action="<?php echo site_url('site/update_order/' . $data->id); ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Tanggal Estimasi</label>
                                <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo date('d-m-Y', strtotime($data->tgl_estimasi)); ?>" placeholder="Masukkan Tanggal Estimasi" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="fk_id_warga">Kendaraan </label>
                                <select class="form-control" name="kendaraan" id="kendaraan" required="required">
                                    <option selected value=""> Pilih Kendaraan </option>
                                    <?php
                                    $query = $this->db->from('tbl_kendaraan');
                                    $query = $this->db->where('created_by', $this->session->userdata('id_customer'));
                                    $query = $this->db->get();
                                    ?>
                                    <?php foreach ($query->result_array() as $key => $value) : ?>
                                        <option value="<?php echo $value['id'] ?>" <?php echo $data->kendaraan_id == $value['id'] ? "selected" : ""; ?>><?php echo $value['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="fk_id_warga">Jenis Service</label>
                                <select class="form-control" name="jenis_service" id="jenis_service" required="required">
                                    <option selected value=""> Jenis Service</option>
                                    <?php foreach ($this->db->get('tbl_jenis_service')->result_array() as $key => $value) : ?>
                                        <option value="<?php echo $value['id'] ?>" <?php echo $data->jenis_service_id == $value['id'] ? "selected" : ""; ?>><?php echo $value['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_warga">Catatan </label>
                                <textarea rows="4" cols="50" placeholder="Masukan Catatan" class="form-control" name="catatan" id="catatan"><?php echo $data->catatan; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function () {
        $('#tanggal').datepicker({
            format: 'dd-mm-yyyy',
            daysOfWeekDisabled: "0",
            autoclose: true
        })
    })
</script>
