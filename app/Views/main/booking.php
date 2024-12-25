<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Nhà hàng Tân Cảng</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?=base_url('home')?>/img/favicon.ico" rel="icon">

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
        <div class="container-xxl position-relative p-0">
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
                                <a href="<?=base_url('main/testmonial')?>" class="dropdown-item">Đánh giá</a>
                            </div>
                        </div>
                        <a href="<?=base_url(relativePath: 'main/contact')?>" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="<?=base_url('main/booking')?>" class="btn btn-primary py-2 px-4">Đặt bàn</a>
                </div>
        </nav>


            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Đặt Bàn</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Đặt Bàn</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Reservation Start -->
        <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="sidebar sidebar-white-primary bordered">
                                <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column p-2">
                                        <?php foreach ($floors as $table): ?>
                                            <li class="nav-item">
                                                <div class="nav-link type-item" data-id="<?= $table['floor'] ?>" style="width: 95px">
                                                    <p><?='Tầng '.$table['floor'] ?></p>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="text-center mt-4">Sơ đồ Nhà hàng</h3>
                            <div id="list">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                        <h1 class="text-white mb-4">Đặt bàn Online</h1>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="datetime">Date & Time</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="select1">
                                          <option value="1">People 1</option>
                                          <option value="2">People 2</option>
                                          <option value="3">People 3</option>
                                        </select>
                                        <label for="select1">No Of People</label>
                                      </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reservation Start -->
        

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
							Designed By <a class="border-bottom" href="">HTML Codex</a>
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
    <script src="js/main.js"></script>
    <script>
        $('.type-item').on('click', function() {
            const floor = $(this).data('id');
            $('.type-item').removeClass('active');
            $(this).addClass('active');

            $.post('<?= base_url("main/booking/getbyfloor") ?>', { floor: floor }, function (response) {
                const data = JSON.parse(response);

                if (data.status === 'success') {
                    const tables = data.data;
                    const rowCount = parseInt(data.row.row); // Số hàng (row)
                    const colCount = parseInt(data.col.col); // Số cột (col)
                    const materialList = $('#list');
                    materialList.empty();

                    // Tạo bảng 2 chiều
                    let tableHTML = '<table class="table">';

                    // Khởi tạo mảng 2 chiều để giữ các bàn ăn
                    const tableGrid = Array(rowCount).fill().map(() => Array(colCount).fill(null));

                    // Lặp qua các bàn và điền vào grid
                    tables.forEach(table => {
                        const row = parseInt(table.row) - 1; // Chuyển đổi row từ 1-indexed thành 0-indexed
                        const col = parseInt(table.col) - 1; // Chuyển đổi col từ 1-indexed thành 0-indexed
                        tableGrid[row][col] = table; // Gán bàn vào vị trí tương ứng trong grid
                    });

                    // Duyệt qua các hàng
                    for (let r = 0; r < rowCount; r++) {
                        tableHTML += '<tr>'; // Mở một hàng mới
                        
                        // Duyệt qua các cột
                        for (let c = 0; c < colCount; c++) {
                            const table = tableGrid[r][c]; // Lấy bàn tại vị trí (r, c)
                            
                            if (table) {
                                // Nếu có bàn tại vị trí đó
                                const statusClass = table.status === '1' ? 'available' : 'occupied'; // Ví dụ: 1 là có bàn trống
                                tableHTML += `<td style = "width: 100px" class="${statusClass}" data-id="${table.table_num}">
                                    ${table.table_num}
                                </td>`;
                            } else {
                                // Nếu không có bàn, hiển thị ô trống
                                tableHTML += '<td style = "width: 100px"></td>';
                            }
                        }
                        
                        tableHTML += '</tr>'; // Đóng hàng
                    }

                    tableHTML += '</table>'; // Đóng bảng
                    materialList.append(tableHTML); // Thêm bảng vào danh sách
                } else {
                    alert(data.message);
                }
            });
        });

    </script>
</body>

</html>