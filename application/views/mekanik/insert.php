<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h4 mb-4 text-gray-800">Tambah Data Mekanik</h1>
            <hr/>
            <form action="<?php echo site_url('mekanik/insert'); ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" value="<?php echo set_value('nik'); ?>" placeholder="Masukkan NIK">
                        <?php echo form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nama_warga">Nama </label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo set_value('nama'); ?>" placeholder="Masukkan Nama">
                        <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="umur">Umur</label>
                        <input type="text" class="form-control" name="umur" id="umur" value="<?php echo set_value('umur'); ?>" placeholder="Masukkan Umur" onkeypress='return isNumberKey(event)'>
                        <?php echo form_error('umur', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="nama_warga">Alamat </label>
                        <textarea rows="4" cols="50" placeholder="Masukan Alamat" class="form-control" name="alamat" id="alamat"><?php echo set_value('umur'); ?></textarea>
                        <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <hr/>
                <div class="form-group">
                    <a href="<?php echo base_url('mekanik'); ?>" class="btn btn-sm btn-secondary">Cancel</a>
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
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>