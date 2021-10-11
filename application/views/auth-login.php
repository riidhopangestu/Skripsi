<body>
    <br>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Hai, Selamat Datang!</h1>
                                        <!--<img src="<?php echo base_url('assets'); ?>/img/kdr.png" alt="" class="img-fluid" style="width:50%">-->
                                    </div>

                                    <?= $this->session->flashdata('message'); ?>

                                    <form method="post" action="<?= base_url('auth/session_login'); ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username"
                                                name="username" autocomplete="off" value="<?= set_value('username') ?>"
                                                placeholder="Masukkan Username">
                                            <?= form_error('username','<small class="text-danger pl-3">','</small>' ); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" autocomplete="off" placeholder="Masukkan Password">
                                            <?= form_error('password','<small class="text-danger pl-3">','</small>' ); ?>
                                        </div>
                                        <hr>
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>