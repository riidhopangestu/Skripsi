<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h4 mb-4 text-gray-800">Update  Nilai Kriteria</h1>
            <hr/>
                <form action="<?php echo site_url('nilai/update/' . $nilai->id_nilai); ?>" method="post">
                    <div class="form-group col-md-6">
                        <label for="total_nilai">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" value="<?php echo $nilai->nik; ?>"  readonly="true">
                        <?php echo form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="total_nilai">Nama Mekanik</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nilai->nama; ?>"  readonly="true">
                        <?php echo form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>            
                    <div class="form-group col-md-6">
                        <label for="total_nilai">Nama Kriteria</label>
                        <input type="text" class="form-control" name="nama_kriteria" id="nama_kriteria" value="<?php echo $nilai->nama_kriteria; ?>" readonly="true">
                        <?php echo form_error('nama_kriteria', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="total_nilai">Nilai Kriteria</label>
                        <input type="text" class="form-control" name="total_nilai" id="total_nilai" value="<?php echo $nilai->total_nilai; ?>" placeholder="Masukkan Nilai Total Kriteria">
                        <?php echo form_error('total_nilai', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <hr/>
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