a
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trang quản trị</title>
  <base href="<?= base_url()?>">
  <!-- Font Awesome -->
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  <!-- DataTables JS -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <?= $this->renderSection('style')?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('/dashboard')?>" class="nav-link">Home</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown" >
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" onclick="Notifications()" >
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div id="notifications" class="dropdown-menu dropdown-menu-lg dropdown-menu-right " style="left: inherit; right:0px">

        </div>
      </li>
      <li class="nav-item">
        <a href="<?=base_url('logout')?>" class="nav-link">
          <img src="<?=base_url('admin/assets')?>/css/images/quit.png" alt="" style="width:30px">
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard')?>" class="brand-link">
      <img src="<?=base_url('admin/ad111')?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url('admin/ad111')?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= session()->get('name') ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?= base_url('dashboard')?>" class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Dashboard
                </p>
                </a>
            </li> 
          <?php if (session()->get('dashboard/user') == true): ?>
            <li class="nav-item">
            <a href="" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Người dùng
                    </p>
                    <i class="fas fa-angle-left right"></i>
            </a>
            <ul class ="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('dashboard/user')?>" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Tài khoản 
                  </p>
                </a>
              </li>
              <?php if (session()->get('dashboard/group') == true): ?>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/group')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Chức vụ 
                    </p>
                  </a>
                </li>
              <?php endif;?>
              <?php if (session()->get('dashboard/role') == true): ?>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/role')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Các quyền
                    </p>
                  </a>
                </li>
              <?php endif;?>
            </ul>
          <?php endif;?>
          <?php if (session()->get('dashboard/material') == true): ?>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Nguyên liệu
                </p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class ="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/material')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Nguyên liệu
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/materialtype')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Loại nguyên liệu
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/materialunit')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Đơn vị đo nguyên liệu
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif;?>
          <?php if (session()->get('dashboard/dish') == true): ?>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Món ăn
                </p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class ="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/dish')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Danh sách món ăn
                    </p>
                  </a>
                </li>
                <?php if (session()->get('dashboard/menu') == true): ?>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/menu')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Menu
                    </p>
                  </a>
                </li>
                <?php endif;?>
                <?php if (session()->get('dashboard/dishtype') == true): ?>
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/dishtype')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Loại món ăn
                    </p>
                  </a>
                </li>
                <?php endif;?>
              </ul>
            </li>
          <?php endif; ?>
          <?php if (session()->get('dashboard/table') == true): ?>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Bàn
                </p>
                <i class="fas fa-angle-left right"></i>
              </a>
              <ul class ="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/table')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Danh sách Bàn ăn
                    </p>
                  </a>
                </li>
              </ul>
              <ul class ="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= base_url('dashboard/booking')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      Danh sách đặt bàn
                    </p>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?= $this->renderSection('content')?>
            
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
<script>
    async function Notifications() {
        const response = await fetch('<?= base_url('notification/unread/'.session()->get('group_id')) ?>');
        const notifications = await response.json();

        let notificationHTML = '';
        notifications.forEach(notification => {
          let style = notification.is_read ? "" : "background-color: blue; color: white;";

          notificationHTML += 
          `<form action='<?= base_url('notification/mark-as-read') ?>/${notification.id}' method="post"  class ='dropdown-item row' >
              <div class ='media' style = '${style}'>
                <div class ='media-body'>
                  <h3 class ='dropdown-item-title'>${notification.title}</h3>
                  <p class ='text-sm'>${notification.message}</p>
                </div>
              </div>
          </form>`;
        });

        document.getElementById('notifications').innerHTML = notificationHTML;
    }
</script>
</html>
