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
            <h1>Update Profile</h1>
            <hr/>
            <div class="card">
                <h5 class="card-header">Form Update <td></td></h5>
                <div class="card-body">
                    <form action="<?php echo site_url('site/update_profile/' . $data->id_customer) ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $data->username; ?>" placeholder="Masukkan Username" required="true" readonly="true">
                                <?php echo form_error('username', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $data->nama; ?>" placeholder="Masukkan Nama" required="true">
                                <?php echo form_error('nama', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">No Telepon</label>
                                <input type="number" class="form-control" name="notlp" id="notlp" value="<?php echo $data->no_tlpn; ?>" placeholder="Masukkan NO Telepon" required="true">
                                <?php echo form_error('notlp', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Email</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo $data->email; ?>" placeholder="Masukkan Email" required="true">
                                <?php echo form_error('email', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_warga">Alamat </label>
                                <textarea rows="4" cols="50" placeholder="Masukan Alamat" class="form-control" name="alamat" id="alamat"><?php echo $data->alamat; ?></textarea>
                                <?php echo form_error('alamat', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <a href="<?php echo base_url('site/profile'); ?>" class="btn btn-lg btn-secondary">Back</a>
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
