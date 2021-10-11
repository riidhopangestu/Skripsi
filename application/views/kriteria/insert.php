<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h4 mb-4 text-gray-800">Tambah Data Kriteria</h1>
            <hr/>
            <form action="<?php echo site_url('kriteria/insert'); ?>" method="post">
                <div class="form-group col-lg-5">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" value="<?php echo set_value('nama_kriteria'); ?>" placeholder="Masukkan Nama Kriteria">
                    <?php echo form_error('nama_kriteria', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group col-lg-5">
                    <label for="tipe">Tipe Kriteria</label><br>
                    <select class="form-control" name="tipe" id="tipe">
                        <option selected>Pilih Tipe Kriteria</option>
                        <option value="0">Cost</option>
                        <option value="1">Benefit</option>
                        <?php echo form_error('tipe', '<small class="text-danger pl-3">', '</small>'); ?>
                    </select>
                </div>
                <div class="form-group col-lg-5">
                    <label for="bobot">Bobot</label>
                    <input type="text" class="form-control" name="bobot" id="bobot" value="<?php echo set_value('bobot'); ?>" placeholder="Masukkan Bilangan Bobot">
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