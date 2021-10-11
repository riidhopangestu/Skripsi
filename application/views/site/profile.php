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
    .legend2 {
        position: absolute;
        top: 2.5em;
        left: 650px;
        line-height: 1.2em;
        padding: 0 10px;
    }

</style>
<!-- Begin Page Content -->

<div class="header-banner">
    <h1 align="center" style="font-size:50px"><b> Vedho Motorcycle Services </b></h1>
</div>
<hr/>
<br>
<div class="col d-flex justify-content-center">
    <!-- Page Heading -->
    <div class="card shadow mb-4 col-md-6">
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#overview" data-toggle="tab"><h6> Informasi</h6></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#change-password" data-toggle="tab"><h6> Ubah Password</h6></a>
                </li>
            </ul>
            <br/>
            <div class="tab-content">
                <div class="active tab-pane" id="overview">
                    <?= $this->session->flashdata('message'); ?>
                    <div class="form-group col-lg-12">
                        <h6>Profile</h6>
                        <hr/>
                        <br/>
                        <fieldset class="scheduler-border">
                            <legend class="legend2">&nbsp;<a href="<?php echo base_url('site/update_profile/' . $data->id_customer); ?>" class="btn btn-sm btn-info" title="Update Profile"><i class="fa fa-pencil-alt"></i></a>&nbsp; </legend>
                            <table class="table table-responsive table-borderless">
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
                            </table>
                        </fieldset>
                    </div>

                </div>

                <div class="tab-pane" id="change-password">
                    <h6>Ubah Password</h6>
                    <hr/>
                    <form action="<?php echo site_url('site/update_password/' . $data->id_customer) ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $data->username; ?>" placeholder="Masukkan Username" required="true" readonly="true">
                                <?php echo form_error('username', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Old Password</label>
                                <input type="password" class="form-control" name="passord_old" id="passord_old"  placeholder="Masukkan Password Lama" required="true">
                                <?php echo form_error('passord_old', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="kriteria1">New Password</label>
                                <input type="password" class="form-control" name="passord_new" id="passord_new"  placeholder="Masukkan Password Baru" required="true">
                                <?php echo form_error('passord_new', '<div class="text-danger small ml-3">', '</div>') ?>
                            </div>
                        </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-md btn-primary">Submit</button>
                            </div>
                        
                    </form>
                </div>
            </div>
            <hr/>
            <div class="form-group float-right">
                <a href="<?php echo base_url('site'); ?>" class="btn btn-lg btn-secondary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
