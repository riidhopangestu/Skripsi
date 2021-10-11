<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h4 mb-4 text-gray-800">Update Data Kriteria</h1>
            <hr/>
            <form action="<?php echo site_url('kriteria/update/' . $data->id_kriteria); ?>" method="post">
                <div class="form-group col-lg-5">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" value="<?php echo $data->nama_kriteria; ?>" placeholder="Masukkan Nama Kriteria">
                    <?php echo form_error('nama_kriteria', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group col-lg-5">
                    <label for="tipe">Tipe Kriteria</label>
                    <select class="form-control select2" name="tipe" id="tipe">
                        <option value="0" <?php echo $data->tipe == 0 ? "selected" : ""; ?>>Cost</option>
                        <option value="1" <?php echo $data->tipe == 0 ? "" : "selected"; ?>>Benefit</option>
                        <?php echo form_error('tipe', '<small class="text-danger pl-3">', '</small>'); ?>
                    </select>
                </div>
                <div class="form-group col-lg-5">
                    <label for="bobot">Bobot</label>
                    <input type="text" class="form-control" name="bobot" id="bobot" value="<?php echo $data->bobot; ?>" placeholder="Masukkan Bilangan Bobot">
                    <?php echo form_error('bobot', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <hr/>
                <div class="form-group">
                    <a href="<?php echo base_url('kriteria'); ?>" class="btn btn-sm btn-secondary">Cancel</a>
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
        $("#tipe").chosen();
    });
</script>