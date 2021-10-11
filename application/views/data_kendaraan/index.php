<div class="header-banner">
    <h1 align="center" style="font-size:50px"><b> Vedho Motorcycle Services </b></h1>
</div>
<hr/>
<br>
<div class="container-fluid">

    <?php echo $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6>List Data Kendaraan</h6>        
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="<?php echo site_url('data_kendaraan/insert') ?>" class="btn btn-sm btn-info" title="Update Order"><i class="fa fa-plus"></i> Tambah Data Kendaraan</a>                                    
                <hr/>                  
                <table class="table table-bordered table-hover table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Gambar</th>
                            <th>Plat Nomor</th>
                            <th>Nama</th>
                            <th>Jenis Transmisi</th>
                            <th>Tahun</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $value) { ?>
                            <tr>
                                <td><?php echo ++$key; ?></td>
                                <td>
                                    <?php if ($value->nama_file !=''){?>
                                    <a href="<?php echo $value->path . $value->nama_file ?>"><img src="<?php echo $value->path . $value->nama_file ?>"width="150" height="100"> </a>
                                    <?php }else{ ?>
                                    <img src="<?php echo base_url('assets'); ?>/img/noimage.jpg" width="150" height="100">
                                    
                                    <?php } ?>
                                </td>
                                <td><?php echo $value->plat_nomor ?></td>
                                <td><?php echo $value->nama ?></td>
                                <td><?php echo $value->nama_jenis ?></td>
                                <td><?php echo $value->tahun ?></td>
                                <td>

                                    <a href="<?php echo site_url('data_kendaraan/update/') . $value->id; ?>" class="btn btn-sm btn-warning" title="Update Order"><i class="fa fa-pencil-alt"></i></a>                                    
                                    <a href="<?php echo site_url('data_kendaraan/delete/') . $value->id; ?>" class="btn btn-sm btn-danger" title="Delete Order"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content