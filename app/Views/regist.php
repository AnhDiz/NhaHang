<!-- app/Views/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url('admin/ad111')?>/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?=base_url('admin/ad111')?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=base_url('admin/ad111')?>/dist/css/adminlte.min.css">
    <!-- jQuery -->
    <script src="<?=base_url('admin/ad111')?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?=base_url('admin/ad111')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?=base_url('admin/ad111')?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('admin/ad111')?>/dist/js/adminlte.min.js"></script>
</head>
<body class="login-page"style="min-height: 464.943px;">
    <div class="login-box">
        <div class="card">
            <h2 class="mt-5">Đăng nhâp</h2>
            <?= view('messages/message') ?>
            <div class="card-body login-card-body">
                <form action="<?= base_url(relativePath: 'registed') ?>" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmai">Email</label>
                                <input name="email" type="email" class="form-control" id="inputEmai"
                                    placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Tên hiển thị</label>
                                <input name="name" type="text" class="form-control" id="inputAddress"
                                    placeholder="Tên hiển thị người dùng" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Số điện thoại</label>
                                <input name="phone_number" type="text" class="form-control" id="inputAddress"
                                    placeholder="Số điện thoại" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="password">Mật khẩu</label>
                                <input name="password" type="password" class="form-control"
                                    id="password" placeholder="Nhập vào mật khẩu">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password-confirm">Xác nhận mật khẩu</label>
                                <input name="password_confirm" type="password" class="form-control"
                                    id="password-confirm" placeholder="Xác nhận lại mật khẩu">
                            </div>
                        </div>
                        <div>

                        </div>
                        <button type="submit" class="btn btn-success">Đăng ký</button>
                    </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
