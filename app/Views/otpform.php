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
            <?php if (session()->getFlashdata('msg')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif; ?>
            <div class="card-body login-card-body">
                <form action="<?= base_url('login/authenticate') ?>" method="post">
                    <input type="text" name="otp" placeholder="Enter your OTP" required>
                    <button type="submit">Verify OTP</button>
                </form>
                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
