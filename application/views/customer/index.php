<!-- Begin Page Content -->
<div class="container-fluid">

    <?php echo $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6>List Data Customer</h6>        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php if ($this->session->userdata('fk_id_level') == '1') : ?>
                    <div class="float-right">
                        <a class="btn btn-sm btn-success mb-2 mr-auto" href="<?php echo base_url('customer/export_excel'); ?>"><i class="fa fa-file-excel"></i> Export Excel</a>
                    </div>
                    <br/>
                    <hr/>
                <?php endif; ?>
                <table class="table table-bordered table-hover table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <?php if ($this->session->userdata('fk_id_level') == '1') : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customer as $key => $value) : ?>
                            <tr>
                                <td><?php echo ++$key; ?></td>
                                <td><?php echo $value->nama ?></td>
                                <td><?php echo $value->no_tlpn ?></td>
                                <td><?php echo $value->email ?></td>
                                <td><?php echo $value->alamat ?></td>
                                <?php if ($this->session->userdata('fk_id_level') == '1') : ?>
                                    <td>
                                        <a href="<?php echo site_url('customer/Reset_password/' . $value->id_customer); ?>" class="btn btn-sm btn-danger" title="Reset Password"><i class="fa fa-undo"></i></a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->