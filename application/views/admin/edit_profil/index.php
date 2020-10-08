<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <form action="<?= base_url('admin/update_profil'); ?>" method="post" id="form_admin">
        <input type="hidden" name="id" value="<?= $admin['id_admin']; ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profil</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama <font color="red">*</font></label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= $admin['nama']; ?>" />
                    <span id="error_nama" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>E-mail <font color="red">*</font></label>
                    <input type="text" name="email" id="email" class="form-control" value="<?= $admin['email']; ?>" />
                    <span id="error_email" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Username <font color="red">*</font></label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= $admin['username']; ?>" />
                    <span id="error_username" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Password <font color="red">*</font></label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" />
                    <span id="error_password" class="text-danger"></span>
                </div>
                <div class="form-group">
                    <label>Ulangi Password <font color="red">*</font></label>
                    <input class="form-control" type="password" name="password2" id="password2" placeholder="Ulangi Password" />
                    <span id="error_password2" class="text-danger"></span>
                </div>
                <div class="float-left small text-muted">
                    <font color="red">*</font> wajib diisi
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" name="update" id="update">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#username').keyup(function() {
            var username = $('#username').val();
            var uname = '<?php echo $admin['username']; ?>';
            if (username != '' && username != uname) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() ?>admin/isExist",
                    data: "username=" + username,
                    success: function(response) {
                        if (response != '') {
                            $('#error_username').text(response);
                            $('#username').addClass('has-error');
                            $('#update').attr('disabled', true);
                        } else {
                            error_username = response;
                            $('#error_username').text(error_username);
                            $('#username').removeClass('has-error');
                            $('#update').removeAttr('disabled');
                        }
                    }
                });
            } else if (username == uname) {
                var error_username = '';
                $('#error_username').text(error_username);
                $('#username').removeClass('has-error');
                $('#update').removeAttr('disabled');
            } else {
                var error_username = '';
                $('#error_username').text(error_username);
                $('#username').removeClass('has-error');
                $('#update').removeAttr('disabled');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#password2').keyup(function() {
            if ($.trim($('#password2').val()).length == 0) {
                error_password2 = 'Ulangi Password wajib diisi';
                $('#error_password2').text(error_password2);
                $('#password2').addClass('has-error');
            } else {
                if ($.trim($('#password').val()) != $.trim($('#password2').val())) {
                    error_password2 = 'Password tidak cocok';
                    $('#error_password2').text(error_password2);
                    $('#password2').addClass('has-error');
                    $('#update').attr('disabled', true);
                } else {
                    error_password2 = '';
                    $('#error_password2').text(error_password2);
                    $('#password2').removeClass('has-error');
                    $('#update').removeAttr('disabled');
                }
            }
        });
        $('#update').click(function() {
            var error_nama = '';
            var error_email = '';
            var error_username = '';
            var error_password = '';
            var error_password2 = '';
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var password_validation = /^.{6,}$/;

            if ($.trim($('#nama').val()).length == 0) {
                error_nama = 'Nama wajib diisi';
                $('#error_nama').text(error_nama);
                $('#nama').addClass('has-error');
            } else {
                error_nama = '';
                $('#error_nama').text(error_nama);
                $('#nama').removeClass('has-error');
            }

            if ($.trim($('#email').val()).length == 0) {
                error_email = 'Email wajib diisi';
                $('#error_email').text(error_email);
                $('#email').addClass('has-error');
            } else {
                if (!filter.test($('#email').val())) {
                    error_email = 'Mohon masukkan email yang valid';
                    $('#error_email').text(error_email);
                    $('#email').addClass('has-error');
                } else {
                    error_email = '';
                    $('#error_email').text(error_email);
                    $('#email').removeClass('has-error');
                }
            }

            if ($.trim($('#username').val()).length == 0) {
                error_username = 'Username wajib diisi';
                $('#error_username').text(error_username);
                $('#username').addClass('has-error');
            } else {
                error_username = '';
                $('#error_username').text(error_username);
                $('#username').removeClass('has-error');
            }

            if ($.trim($('#password').val()).length == 0) {
                error_password = 'Password wajib diisi';
                $('#error_password').text(error_password);
                $('#password').addClass('has-error');
            } else {
                if (!password_validation.test($('#password').val())) {
                    error_password = 'Password harus berisi minimal 6 karakter';
                    $('#error_password').text(error_password);
                    $('#password').addClass('has-error');
                } else {
                    error_password = '';
                    $('#error_password').text(error_password);
                    $('#password').removeClass('has-error');

                    error_password2 = '';
                    $('#error_password2').text(error_password);
                    $('#password2').removeClass('has-error');
                }
            }

            if (error_nama != '' || error_username != '' || error_email != '' || error_password != '') {
                return false;
            } else {
                $('#form_admin').submit();
            }
        });
    });
</script>
</div>
<!-- End of Main Content -->