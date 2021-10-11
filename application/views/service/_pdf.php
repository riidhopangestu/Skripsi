<!DOCTYPE html>
<html><head>
    <title></title>
</head><body>
    <h2 align="center">INVOICE <br/>
    #<?php echo getReaNumber($data->prefik,$data->no); ?><br/>
    <span style="font-size:15px">Tanggal Estimasi <?= date('d F Y', strtotime($data->tgl_estimasi)); ?></sapan>
    </h2>
    
    <hr/>
    <br/>
   
                        <table class="table table-responsive table-borderless" style="margin-top:30px">
                            <tr>
                                <td>Tanggal Estimasi</td><td>:</td><td><?= date('d F Y', strtotime($data->tgl_estimasi)); ?></td>
                            </tr>
                            <tr>
                                <td>Nama</td><td>:</td><td><?= $data->nama; ?></td>
                            </tr>
                            <tr>
                                <td>No Telepon</td><td>:</td><td><?= $data->no_tlpn; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td><td>:</td><td><?= $data->email; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat </td><td>:</td><td><?= $data->alamat; ?></td>
                            </tr>
                        </table>
                        <table style="width:100%;margin-top:30px" border="1">
                            <tr>
                                <td>Kendaraan</td>
                                <td>Jenis Kendaraan</td>
                                <td>Jenis Service</td>
                                <td>Mekanik </td>
                            </tr>
                            <tr>
                                
                                <td><?= $data->nama_kendaraan; ?>,&nbsp;<!-- <?= $data->merek_kendaraan; ?>,&nbsp; --><?= $data->tahun_kendaraan; ?></td>
                                <td><?= $data->nama_jenis_kendaraan; ?></td>
                                <td><?= $data->nama_jenis_service; ?></td>
                                <td><?= $data->nama_mekanik; ?></td>
                           
                        </table>
                        <table class="table table-responsive table-borderless" style="margin-top:30px">
                             <tr>
                                <th>Catatan </th><td>:</td><td><?= $data->catatan; ?></td>
                            </tr>
                        </table>
                        <hr/>
    <h5 align='center'> Print Date <?= date('yy m d H:i:s');?> </h5>
    <h6 align="right">Powered by Vedho Motorcycle Services 2020</h6>
</body></html>