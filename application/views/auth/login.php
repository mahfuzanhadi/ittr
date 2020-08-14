<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-7 col-lg-7 col-md-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h2 class="h2 mb-4" style="color:#456AD8">Login Page</h2>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <center>
                                    <form method="post" action="<?= base_url('auth'); ?>" style="width: 80%; margin-top:4rem">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter username or email address..." value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger text-justify">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger text-justify">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mt-4 active" aria-pressed="true" style="background-color: #2653d4; border-color:#244ec9;">
                                            L O G I N
                                        </button>
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>