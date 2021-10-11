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
    #image-preview{
        display:none;
        width : 250px;
        height : 300px;
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
            <h1>Data Kendaraan</h1>
            <hr/>
            <div class="card">
                <h5 class="card-header">Form Kendaraan</h5>
                <div class="card-body">
                    <form action="<?php echo site_url('data_kendaraan/insert'); ?>" method="post" enctype="multipart/form-data" >
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Upload Gambar </label><br/>
                                <img id="image-preview" alt="image preview"/>
                                <br/>
                                <input type="file" id="gambar" name="gambar" onchange="previewImage();" />
                                <br/><br/><span title="size foto maxsimal 1mb"> size foto maxsimal 1mb</span>
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Plat Nomor </label>
                                <input type="text" class="form-control" name="plat_nomor" id="plat_nomor" placeholder="Masukkan Plat Nomor" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="kriteria1">Nama Kendaraan </label>
                                <input type="text" class="form-control" name="nama_kendaraan" id="nama_kendaraan" placeholder="Masukkan Nama" required="true">
                            </div>
                            <!-- <div class="form-group col-md-5">
                                <label for="kriteria1">Merek </label>
                                <input type="text" class="form-control" name="merek" id="merek" placeholder="Masukkan Merek" required="true">
                            </div> -->
                            <div class="form-group col-md-3">
                                <label for="kriteria1">Tahun </label>
                                <input type="number" class="form-control" name="tahun" id="tahun" placeholder="Masukkan Tahun" required="true">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="fk_id_warga">Jenis Transmisi</label>
                                <select class="form-control" name="jenis" id="jenis" required="required">
                                    <option selected value=""> Jenis Transmisi</option>
                                    <?php foreach ($this->db->get('tbl_jenis_kendaraan')->result_array() as $key => $value) : ?>
                                        <option value="<?php echo $value['id'] ?>"><?php echo $value['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            
                        </div>
                        <hr/>
                        <div class="form-group">
                            <a href="<?php echo base_url('data_kendaraan'); ?>" class="btn btn-lg btn-secondary">Back</a>
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

    function previewImage() {
        document.getElementById("image-preview").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("gambar").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("image-preview").src = oFREvent.target.result;
        };
    }
    ;
</script>