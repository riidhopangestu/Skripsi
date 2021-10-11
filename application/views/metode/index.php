<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <!-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Kriteria Dan Bobot</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table1" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kriteria as $val) : ?>
                            <tr>
                                <td><?php echo $val->kode_kriteria ?></td>
                                <td><?php echo $val->nama_kriteria ?></td>
                                <td><?php echo $val->tipe == 0 ? 'Cost' : 'Benefit'; ?></td>
                                <td><?php echo $val->bobot ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->
    <!-- DataTales Example -->
    <!-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menentukan Nilai Alternatif</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm" id="table1_y" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Mekanik</th>
                            <?php foreach ($kriteria as $val) : ?>
                                <th><span title="Nama Kriteria : <?php echo $val->nama_kriteria ?>"><?php echo $val->kode_kriteria ?></span></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alternatif as $alt) : ?>
                            <tr>
                                <td><?php echo $alt->nik ?></td>
                                <td><?php echo $alt->nama ?></td>
                                <?php foreach ($kriteria as $val) : ?>
                                    <td>
                                        <?php
                                        $data_perhitungan_nilai = $this->MetodeModel->get_niai_setiap_alternatif($alt->id, $val->id_kriteria);
                                        echo $data_perhitungan_nilai['total_nilai'];
                                        ?>
                                    </td>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --> 
    <!-- DataTales Example -->
    <!-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Melakukan SQRT</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Alternatif</th>
                            <th>Hasil Nilai SQRT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($sqrt as $key => $value) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><span title="Nama Kriteria : <?php echo $value['nama_kriteria'] ?>"><?php echo $value['kode_kriteria']; ?></span></td>
                                <td><?php echo $value['total']; ?></td>

                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->

    <!-- DataTales Example -->
   <!-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Melakukan Normalisasi Matriks</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Mekanik</th>
                            <?php foreach ($kriteria as $val) : ?>
                                <th><span title="Nama Kriteria : <?php echo $val->nama_kriteria ?>"><?php echo $val->kode_kriteria ?></span></th>
                            <?php endforeach ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>

                        <?php foreach ($alternatif as $alt) : ?>
                            <tr>
                                <th><?php echo $no++ ?></th>
                                <th><?php echo $alt->nik ?></th>
                                <th><?php echo $alt->nama ?></th>
                                <?php foreach ($normalisasi as $key => $value) : ?>
                                    <?php foreach ($value as $k => $v) : ?>  
                                        <?php if ($k == $alt->id) : ?>
                                            <td><?php echo $value[$k]['total']; ?></td>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div> --> 
    <!-- DataTales Example -->
    <!-- <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Menghitung Nilai Optimasi Min Max <span style="font-size:12px">(hasil normalisasi yang di kali bobot)</span></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Mekanik</th>
                            <?php foreach ($kriteria as $val) : ?>
                                <th><span title="Nama Kriteria : <?php echo $val->nama_kriteria ?>"><?php echo $val->kode_kriteria ?></span></th>
                            <?php endforeach ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($alternatif as $alt) : ?>
                            <tr>
                                <th><?php echo $no++ ?></th>
                                <th><?php echo $alt->nik ?></th>
                                <th><?php echo $alt->nama ?></th>
                                <?php foreach ($ternormalisasi as $key => $value) : ?>                                
                                    <?php if ($key == $alt->id) : ?>
                                        <?php foreach ($value as $k => $v) : ?>
                                            <td><?php echo $value[$k]['total']; ?></td>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->

    <!-- DataTales Example -->
   <!--  <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Melakukan Nilai Optimasi Setiap Alternatif </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table3" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Mekanik</th>
                            <th>Nilai Maximum</th>
                            <th>Nilai Minimum</th>
                            <th>Nilai Yi = (Max - Min)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($tabel_yi as $key => $value) : ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $nik[$key]; ?></td>
                                <td><?php echo $nama_mekanik[$key]; ?></td>
                                <td><?php echo $max[$key]; ?></td>
                                <td><?php echo $min[$key]; ?></td>
                                <td><?php echo $value; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hasil Perangkingan Mekanik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-sm display" id="table4" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Mekanik</th>
                            <th>Nilai Optimasi</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php //$key = 1; ?>
                        <?php foreach ($sorted_rank_data as $key => $value) : ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <?php foreach ($alternatif as $alt) : ?>
                                    <?php if ($alt->id == $value['id_mekanik']): ?>
                                        <th><?php echo $alt->nik ?></th>
                                        <th><?php echo $alt->nama ?></th>
                                    <?php endif; ?>
                                <?php endforeach ?>
                                <td><?php echo $value['value']; ?></td>
                                <td><?php echo $value['rank']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
    $(document).ready(function () {
        $('#table1_y').DataTable({
            
            "ordering": false,
            "info": false
        });
    });
</script>