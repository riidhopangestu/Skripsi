<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1 class="h4 mb-4 text-gray-800">Tambah Data User</h1>
            <hr/>
            <form action="<?php echo site_url('user/insert'); ?>" method="post">
                <div class="form-group col-lg-5">
                    <label for="nama_kriteria">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?php echo set_value('nama_lengkap'); ?>" placeholder="Masukkan Nama Lengkap">
                    <?php echo form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group col-lg-5">
                    <label for="nama_kriteria">Username</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username'); ?>" placeholder="Masukkan Username">
                    <?php echo form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group col-lg-5">
                    <label for="nama_kriteria">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email'); ?>" placeholder="Masukkan Email">
                    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group col-lg-5">
                    <label for="nama_kriteria">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password'); ?>" placeholder="Masukkan Password">
                    <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group col-lg-5">
                    <label for="tipe">Role</label><br>
                    <select class="form-control" name="role" id="role">
                        <option selected>Pilih User Role</option>
                        <option value="1">Administrator</option>
                        <!-- <option value="2">Karyawan</option> -->
                        <?php echo form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                    </select>
                </div>
                <hr/>
                <div class="form-group">
                    <a href="<?php echo base_url('user'); ?>" class="btn btn-sm btn-secondary">Cancel</a>
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
        $("#role").chosen();
    });
</script>