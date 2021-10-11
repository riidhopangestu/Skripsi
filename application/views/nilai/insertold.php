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
<!-- Begin Page Content -->
<div class="container-fluid">

    <?php echo $this->session->flashdata('message'); ?>

    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h4 mb-2 text-gray-800">Tambah Data Nilai Setiap Alternatif</h1>
            <hr/>
            <form action="<?php echo site_url('nilai/insert'); ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="fk_id_warga">Nama Mekanik</label>
                        <select class="form-control" name="id_alternatif" id="id_alternatif">
                            <option selected></option>
                            <?php foreach ($this->db->get('tbl_mekanik')->result_array() as $key => $value) : ?>
                                <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] . ' (' . $value['nik'] . ')' ?></option>
                            <?php endforeach ?>
                            <?php echo form_error('id_alternatif', '<small class="text-danger pl-3">', '</small>'); ?>
                        </select>
                    </div>
                </div>
                <br>
                <fieldset class="scheduler-border">
                        <legend class="w-auto">&nbsp;Kriteria&nbsp; </legend> 
                        <br>
                <div class="form-row">
                    <?php
//                die(var_dump($data_kriteria));
                    foreach ($data_kriteria as $data) {
                        ?>

                        <div class="form-group col-md-4">
                            <label for="kriteria1"><?= $data->nama_kriteria; ?></label>
                            <input type="number" class="form-control" name="<?= $data->kode_kriteria; ?>" id="<?= $data->kode_kriteria; ?>" placeholder="Masukkan Nilai" required="true">
                            <?php echo form_error('kriteria1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                    <?php } ?>
                </div>
                </fieldset>
                          
                <div class="form-group">
                    <a href="<?php echo base_url('nilai'); ?>" class="btn btn-sm btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
  $(document).ready(function () {
        $("#id_alternatif").chosen();
    });
</script>
