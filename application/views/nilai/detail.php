<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menentukan Nilai Alternatif</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table1" width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Mekanik</th>
                            <th>Nama Kriteria</th>
                            <th>Total Nilai</th>
                            <?php if ($this->session->userdata('fk_id_level') == '1') : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($nilai as $value) { ?>
                            <tr>
                                <td><?php echo $value->nik; ?></td>
                                <td><?php echo $value->nama; ?></td>
                                <td><?php echo $value->nama_kriteria; ?></td>
                                <td><?php echo $value->total_nilai; ?></td>
                                <td>
                                    <?php if ($this->session->userdata('fk_id_level') == '1') : ?>
                                    <a href="<?= site_url('nilai/update/') . $value->id_nilai ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt"></i></a>
                                </td>
                                <?php endif; ?>
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