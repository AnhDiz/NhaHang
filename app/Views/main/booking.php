<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Nhà hàng Tân Cảng</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <link href="<?=base_url('home')?>/css/table.css" rel="stylesheet">
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
                                <a href="<?=base_url('main/personal')?>" class="dropdown-item">Cá nhân</a>
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
                <div class="col-md-8 bg-info">
                    <div class="row">
                        <h3 class="text-center mt-4">Sơ đồ Nhà hàng</h3>
                        <p class="text-center text-muted"><span style="color: blue;">Xanh dương</span> - Bàn trống, <span style="color: red;">Đỏ</span> - Bàn có khách, <span style="color: black;">Đen</span> - Bàn đã đặt trước.</p>
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
                        <div class="col-md-10 bg-white">
                            
                            <div id="list">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                        <h1 class="text-white mb-4">Đặt bàn Online</h1>
                        <form action="booking/create" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <table class ="table table-head-fixed table-bordered text-nowrap bg-white" id="Table">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input name="time" type="datetime-local" class="form-control datetimepicker-input" id="datetime" placeholder="Thời gian" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="datetime">Thời gian</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="request" class="form-control" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Yêu cầu</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Đặt ngay</button>
                                </div>
                            </div>
                        </form>
                        <div id="notification" style="display: none; position: fixed; top: 20px; right: 20px; background: #fff; border: 1px solid #ccc; padding: 10px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); z-index: 1000;">
                            <span id="notification-message"></span>
                        </div>

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
        let count = 1;
        $(document).on('click', '.add-to-selected', function () {
            const tableId = $(this).data('id');
            const tableNumberNow = $(this).data('number-now'); 
            const existingRow = $('#Table tbody').find(`tr[data-id="${tableId}"]`);
            
            let status = $(this).data('status');
            if(status != "available"){
                alert("Bàn này đã được đặt trược hoặc đang được sử dụng");
                return;
            }
            if (existingRow.length > 0) {
                existingRow.remove();
                $(this).removeClass("bg-info");
                count --;
                return;
            } else {
                const newRow = `
                    <tr data-id="${tableId}" id="${tableId}">
                        <td><input name = "tables[${count}]" value ="${tableId}" readonly></input></td>
                    </tr>
                `;
                $('#Table tbody').append(newRow); // Thêm phần tử nếu chưa tồn tại
            }
            $(this).addClass("bg-info");
            count ++;
        });
        $('.type-item').on('click', function() {
            const floor = $(this).data('id');
            $('.type-item').removeClass('active');
            $(this).addClass('active');

            $.post('<?= base_url("main/booking/getbyfloor") ?>', { floor: floor }, function (response) {
                const data = JSON.parse(response);

                if (data.status === 'success') {
                    const tables = data.data;
                    const rowCount = parseInt(data.row);
                    const colCount = parseInt(data.col); 
                    const materialList = $('#list');
                    materialList.empty();

                    let tableHTML = '<table class="table table-borderless">';

                    const tableGrid = Array(rowCount).fill().map(() => Array(colCount).fill(null));

                    tables.forEach(table => {
                        const row = parseInt(table.row) - 1;
                        const col = parseInt(table.col) - 1;
                        tableGrid[row][col] = table;
                    });

                    for (let r = 0; r < rowCount; r++) {
                        tableHTML += '<tr>'; 
                       
                        for (let c = 0; c < colCount; c++) {
                            const table = tableGrid[r][c]; 
                            
                            if (table) {
                                let statusClass;
                                switch (table.status) {
                                    case '2':
                                        statusClass = 'ordered';
                                        break;
                                    case '3':
                                        statusClass = 'eating';
                                        break;
                                    default:
                                        statusClass = 'available';
                                }
                                tableHTML += `<td style = "width: 100px;height:100px">
                                    <button 
                                        type="button" 
                                        class="add-to-selected"
                                        data-id="${table.table_num}"
                                        data-status = "${statusClass}">
                                        <div class="row">
                                            <div class="col-md-6">
                                            ${table.table_num}
                                            <div class="${statusClass}"></div>
                                            </div>
                                            <div class="col-md-6 column">
                                                <div class = "row-md-6">
                                                    ${table.capacity}
                                                    <i class="bi bi-person" style = "width: 40px"></i>
                                                </div>
                                                <div class = "row-md-6">

                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                </td>`;
                            } else {
                                if(r == 2 && c == 0){
                                tableHTML += `<td style = "width: 100px;height:100px" class="" data-id="">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <i class="bi-bar-chart-steps" style = "width: 40px"></i>
                                        Cầu thang
                                        </div>
                                    </div>
                                </td>`;
                                }else if(r == 0 && c==4){
                                    tableHTML += `<td style = "width: 100px;height:100px" class="" data-id="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <i class="bi-door-open-fill" style = "width: 40px"></i>
                                                Cửa
                                                </div>
                                            </div>
                                        </td>`;
                                }else{
                                    tableHTML += '<td style = "width: 100px;height:100px"></td>'
                                }
                            }
                        }
                        
                        tableHTML += '</tr>'; 
                    }

                    tableHTML += '</table>'; 
                    materialList.append(tableHTML);
                } else {
                    alert(data.message);
                }
            });
        });
        function showNotification(message, status) {
            let notification = document.getElementById('notification');
            let messageBox = document.getElementById('notification-message');
            
            messageBox.textContent = message;
            notification.style.backgroundColor = status === 'success' ? '#d4edda' : '#f8d7da';
            notification.style.borderColor = status === 'success' ? '#c3e6cb' : '#f5c6cb';
            notification.style.color = status === 'success' ? '#155724' : '#721c24';
            
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        function handleResponse(response) {
            showNotification(response.message, response.status);
        }
    </script>
</body>

</html>