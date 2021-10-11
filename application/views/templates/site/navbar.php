<style>
    .badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
#lblCartCount {
    font-size: 12px;
    background: yellow;
    color: black;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px; 
}
</style>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column sticky">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar --> 
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url('site'); ?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('site/prosedur'); ?>">Prosedur</a>
                    </li>
                    <?php if (!empty($login) &&!empty($login_sesion)) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('site/service'); ?>">Pesan Service</a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('site/kontak'); ?>">Kontak Kami</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <?php if (!empty($login) &&!empty($login_sesion)) { ?>
                    <a  href="<?php echo base_url('site/order'); ?>">
                        <i class="fas fa-shopping-cart fa-lg fa-fw mr-2 text-blue-500 " style="font-size:24px">                       
                        </i>
                        <?php if(cart_draft($this->session->userdata('id_customer')) != 0){ ?>
                        <span class="badge badge-warning"  id='lblCartCount'><?= cart_draft($this->session->userdata('id_customer')); ?></span>
                        <?php } ?>
                    </a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Hai, <?php echo $session_login['nama']; ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url('assets'); ?>/img/default.jpg" />
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo base_url('site/profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url('site/order'); ?>">
                                    <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Order Service
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url('data_kendaraan'); ?>">
                                    <i class="fas fa-motorcycle fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Data Kendaraan
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                    <?php } ?>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <?php if (empty($login)) { ?>
                        <a class="btn btn-success" href="<?php echo base_url('auth_customer'); ?>">Login</a>&nbsp;
                        <a class="btn btn-info my-2 my-sm-0" href="<?php echo base_url('site/register'); ?>">Daftar</a>
                    <?php } ?>
                </form>
            </div>
        </nav>
    </div>
</div>