<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Tambah Data Aletrnatif</h1>

    <div class="col-lg-5">
        <form action="<?php echo site_url('alternatif/insert'); ?>" method="post">
            <div class="form-group">
                <label for="fk_id_warga">ID / Nama Warga</label>
                <select class="form-control" name="fk_id_mekanik" id="fk_id_mekanik">
                    <option selected>-- Pilih Nama Warga --</option>
                    <?php foreach ($this->db->get('tbl_mekanik')->result_array() as $key => $value) : ?>
                        <option value="<?php echo $value['id'] ?>"> <?php echo $value['nama'] ?></option>
                    <?php endforeach ?>
                    <?php echo form_error('fk_id_mekanik', '<small class="text-danger pl-3">', '</small>'); ?>
                </select>
            </div>
            <div class="form-group">
                <a href="<?php echo base_url('kriteria'); ?>" class="btn btn-sm btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->