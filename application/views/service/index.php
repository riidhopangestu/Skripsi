<!-- Begin Page Content -->
<div class="container-fluid">

    <?php echo $this->session->flashdata('message'); ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6>List Data Service</h6>        
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-hover table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Order Number</th>
                            <th>Tanggal Estimasi</th>
                            <th>Customer</th>
                            <th>Kendaraan</th>
                            <th>Jenis Kendaraan</th>
                            <th>Jenis Service</th>
                            <th>Catatan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $value) { ?>
                            <?php
                            if ($value->status == 1) {
                                $status = '<span class="badge badge-warning"> Draft </span>';
                            } else if ($value->status == 2) {
                                $status = '<span class="badge badge-primary"> Menunggu Konfirmasi </span>';
                            } else if ($value->status == 3) {
                                $status = '<span class="badge badge-primary"> Prosess </span>';
                            } else if ($value->status == 4) {
                                $status = '<span class="badge badge-success"> Selesai </span>';
                            } else {
                                $status = '<span class="badge badge-danger"> Reject </span>';
                            }
                            ?>
                            <tr>
                                <td><?php echo ++$key; ?></td>
                                <td> <a href="<?php echo site_url('service/view/' . $value->id); ?>"><?php echo getReaNumber($value->prefik, $value->no); ?></a></td>
                                <td><?php echo date('d F Y', strtotime($value->tgl_estimasi)); ?></td>
                                <td><?php echo $value->nama . ' <span class="badge badge-warning"> ' . $value->no_tlpn . '</span><br>' . $value->email ?></td>
                               <!--  <td><?php echo $value->merek_kendaraan . ', ' . $value->nama_kendaraan . ', ' . $value->tahun_kendaraan ?></td> -->
                                <td><?php echo $value->nama_kendaraan . ', ' . $value->tahun_kendaraan ?></td>
                                <td><?php echo $value->nama_jenis_kendaraan ?></td>
                                <td><?php echo $value->nama_jenis_service ?></td>
                                <td><?php echo $value->catatan ?></td> 
                                <td><?php echo $status ?>
                                    <?php if ($value->catatan_admin != '') { ?>
                                        <br><b>catatan admin :</b><br><?= $value->catatan_admin; ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="<?php echo site_url('service/view/') . $value->id; ?>" class="btn btn-sm btn-info" title="View Order"><i class="fa fa-eye"></i></a
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
<!-- End of Main Content -->