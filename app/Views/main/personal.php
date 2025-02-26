<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?=base_url('home')?>/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?=base_url('home')?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?=base_url('home')?>/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?=base_url('home')?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?=base_url('home')?>/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">

        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0" ">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="<?=base_url('')?>" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Nhà hàng Tân Cảng</h1>
                    <!-- <img src="<?=base_url('')?>/img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="<?=base_url('')?>" class="nav-item nav-link active">Trang chủ</a>
                        <a href="<?=base_url('main/service')?>" class="nav-item nav-link">Service</a>
                        <a href="<?=base_url('main/menu')?>" class="nav-item nav-link">Menu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="<?=base_url('main/booking')?>" class="dropdown-item">Đặt bàn</a>
                                <a href="<?=base_url('main/testmonial')?>" class="dropdown-item">Cá nhân</a>
                            </div>
                        </div>
                        <a href="<?=base_url(relativePath: 'main/contact')?>" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="<?=base_url('main/booking')?>" class="btn btn-primary py-2 px-4">Đặt bàn</a>
                    <?php if(session()->get('logged_in')){ ?>
                    <div class="user-icon-container" style="position: relative; display: inline-block; cursor: pointer;">
                        <i class="fas fa-user-circle" style="font-size: 40px;"></i>
                        <div class="logout-menu" style="display: none; position: absolute; top: 30px; right: 0; background: white; border: 1px solid #ccc; padding: 10px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                            <a href="logout" style="text-decoration: none; color: black;">Đăng xuất</a>
                        </div>
                    </div>
                    <?php }?>
                </div>
        </nav>
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Cá nhân</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Cá nhân</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s" style="height: 800px;">
            <div class="container" style="height: 100%;">
            <div class="row" style="height: 100%;">
                <!-- Sidebar -->
                <div class="col-md-2 bg-info">
                    <div class="sidebar sidebar-white-primary bordered">
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column p-2">
                                <li class="nav-item">
                                    <div class="nav-link type-item active" data-target="table-booked" style="width: 100%;">
                                        <p>Bàn đã đặt</p>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <div class="nav-link type-item" data-target="table-payment" style="width: 100%;">
                                        <p>Thanh toán</p>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-md-10">
                    <!-- Bảng "Bàn đã đặt" -->
                    <div id="table-booked" class="table-container">
                        <h3>Bàn đã đặt</h3>
                        <div class="row g-4">
                            <?php foreach($bookedtable as $table): ?>
                                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                                    <div class="service-item rounded pt-3">
                                        <div class="p-4">
                                            <i class="fa fa-3x fa-chair text-primary mb-4"></i>
                                            <h5>Bàn <?= $table['table_num'] ?></h5>
                                            <p>Tầng <?= $table['floor']?></p>
                                            <p><?= $table['request']?></p>
                                            <button class="btn bg-info"><?=$table['status'] == '2'? 'Nhận bàn' : 'Đang ăn'?></button>
                                            <a href="personal/detail/<?=$table['id']?>" class="btn btn-primary"> chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>

                    <!-- Bảng "Thanh toán" (Ẩn mặc định) -->
                    <div id="table-payment" class="table-container" style="display: none;">
                        <h3>Thanh toán</h3>
                        
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Testimonial End -->
        

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Reservation</a>
                        <a class="btn btn-link" href="">Privacy Policy</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Saturday</h5>
                        <p>09AM - 09PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 08PM</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url('home')?>/lib/wow/wow.min.js"></script>
    <script src="<?=base_url('home')?>/lib/easing/easing.min.js"></script>
    <script src="<?=base_url('home')?>/lib/waypoints/waypoints.min.js"></script>
    <script src="<?=base_url('home')?>/lib/counterup/counterup.min.js"></script>
    <script src="<?=base_url('home')?>/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?=base_url('home')?>/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?=base_url('home')?>/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?=base_url('home')?>/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?=base_url('home')?>/js/main.js"></script>
    <script>
        $(document).on('click', '.user-icon-container', function () {
            $('.logout-menu').toggle();
        });
        
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.user-icon-container').length) {
                $('.logout-menu').hide();
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navItems = document.querySelectorAll(".type-item");
            const tables = document.querySelectorAll(".table-container");

            navItems.forEach(item => {
                item.addEventListener("click", function () {
                    // 1. Xóa class 'active' của tất cả các nav-item
                    navItems.forEach(i => i.classList.remove("active"));
                    this.classList.add("active");

                    // 2. Ẩn tất cả các bảng
                    tables.forEach(table => table.style.display = "none");

                    // 3. Hiển thị bảng tương ứng với data-target
                    const targetTable = document.getElementById(this.dataset.target);
                    if (targetTable) {
                        targetTable.style.display = "block";
                    }
                });
            });
        });
    </script>
</body>

</html>