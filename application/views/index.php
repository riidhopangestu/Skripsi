<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate-->
            <!--Report</a>-->
    </div>
    
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Mekanik
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $this->db->get('tbl_mekanik')->num_rows() ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Kriteria
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $this->db->get('tb_kriteria')->num_rows() ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Customer
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $this->db->get('tb_user_customer')->num_rows() ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-4 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                User Sistem
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $this->db->get('tb_user')->num_rows() ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Service Status Waiting
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               <?= cart_status(2); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Service Status Prosess
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= cart_status(3); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Service Status Done
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                               <?= cart_status(4); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Sistem Pendukung Keputusan - MOORA
                    </h6>
                </div>
                <div class="card-body">
                    <p>
                        Dashboard admin ini berfungsi untuk mengelola perhitungan
                        sistem pendukung keputusan untuk memilih mekanik terbaik.
                        Pada dashboard admin juga dapat mengelola data service 
                        customer yang akan diproses ke tahap berikutnya.
                    </p>
                </div>
            </div>
        </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->