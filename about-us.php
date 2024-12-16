<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="http://localhost/OngNho/css/about-us.css " rel="stylesheet">

    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Về chúng mình | Ong nhỏ</title>
</head>

<body style="background-color: #FFF9EC">
    <!-- HEADER -->
    <header>
        <div class="container" style="background-color: #FFF9EC;">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <!-- LOGO -->
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="img/logo/Ongnho-logo.png" class="bi me-2" height="100px" role="img" aria-label="Bootstrap">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <!-- KHÁM PHÁ -->
                    <li class="nav-item">
                        <a href="search.php" class="nav-link text-dark d-flex flex-column align-items-center">
                            <i class="fa-solid fa-magnifying-glass fa-3x mb-2"></i>
                            <span>Khám phá</span>
                        </a>
                    </li>

                    <!-- VỀ CHÚNG MÌNH -->
                    <li class="nav-item">
                        <a href="about-us.php" class="nav-link text-dark d-flex flex-column align-items-center"
                            style="color: #feca73 !important;">
                            <i class="fa-solid fa-users fa-3x mb-2"></i>
                            <span>Về chúng mình</span>
                        </a>
                    </li>

                    <!-- LIÊN LẠC -->
                    <li class="nav-item">
                        <a href="contact-us.php" class="nav-link text-dark d-flex flex-column align-items-center">
                            <i class="fa-regular fa-address-book fa-3x mb-2"></i>
                            <span>Liên lạc</span>
                        </a>
                    </li>
                </ul>


                <!-- USER -->
                <div class="position-relative">
                    <?php if (isset($_SESSION['email'])): ?>
                        <!-- User Avatar -->
                        <img src="img/avatar/default-avatar.png" class="user-pic" id="userPic" alt="User Avatar" aria-label="User Menu">

                        <!-- Menu Dropdown -->
                        <div class="sub-menu-wrap" id="subMenu" aria-hidden="true">
                            <div class="sub-menu">
                                <!-- Thông tin người dùng -->
                                <div class="user-info">
                                    <img src="img/user.png" alt="User Avatar">
                                    <h4><?= htmlspecialchars($_SESSION['full_name']); ?></h4>
                                </div>

                                <ul>
                                    <li><a href="#"><i class="fa-solid fa-user"></i> Hồ sơ</a></li>
                                    <li><a href="user_settings.php"><i class="fa-solid fa-cog"></i> Cài đặt tài khoản</a></li>
                                    <li><a href="#"><i class="fa-solid fa-life-ring"></i> Trung tâm hỗ trợ</a></li>
                                    <li><a href="logout.php"><i class="fa-solid fa-sign-out-alt"></i> Đăng xuất</a></li>
                                </ul>
                            </div>
                        </div>

                    <?php else: ?>
                        <a href="login.php"
                            class="btn me-2"
                            aria-label="Login"
                            style="padding: 20px 20px; border: 2px solid #feca73; background-color: transparent; color: #feca73; text-decoration: none; transition: background-color 0.3s, color 0.3s;"
                            onmouseover="this.style.backgroundColor='#feca73'; this.style.color='black';"
                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#feca73';">
                            Đăng nhập
                        </a>
                        <a href="role-select.php" class="btn" aria-label="Sign-up" style="padding: 20px 20px; background-color: #feca73;">Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div class="about-us-link">
        <div class="container d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ul class="uk-breadcrumb about__breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li> / </li>
                    <li aria-current="page">Về chúng mình</li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- THÂN TRANG -->

    <div class="" style="height: 200px; overflow: hidden; ">
        <img src="img/about-us/studying.jpg">
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Chữ bên trái -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h3 class="section-title text-start text-primary pe-3">Lời nói đầu</h3>
                    <h2 class="mb-4">Kính gửi phụ huynh, giáo viên và học sinh</h2>
                    <p class="lead">

                    </p>
                    <p class="lead mb-0">

                    </p>


                </div>

                <!-- Ảnh bên phải -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/index/teacher.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="py-5">
        <div class="container">
            <div class="row align-items-center gx-4">
                <div class="col-md-5">
                    <div class="ms-md-2 ms-lg-5"><img class="img-fluid rounded-3" src="img/logo/Ongnho-logo.png"></div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="ms-md-2 ms-lg-5">
                        <h2 class="display-5 fw-bold">Về Ong Nhỏ</h2>
                        <p class="lead">
                            Được thành lập và phát triển từ năm 2024 tại Hà Nội, cho đến này, Ong Nhỏ đã mang đến cơ hội học tập
                            cho hàng nghìn bạn nhỏ và người lớn trong một môi trường ấm áp, sáng tạo và tràn đầy cảm hứng.
                        </p>
                        <p class="lead mb-0">
                            Với sứ mệnh mang đến nền giáo dục chất lượng cao, Ong Nhỏ luôn nỗ lực phát triển các phương pháp học tập tiên tiến,
                            kết hợp giữa lý thuyết và thực hành, giúp các em nhỏ không chỉ nắm vững kiến thức mà còn phát triển toàn diện về kỹ năng và tư duy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CON SỐ KHÔNG NÓI DỐI-->
    <section class="achivements py-4 py-sm-5">
        <div class="container">
            <div class="text-center mb-4 mb-lg-5">
                <span class="d-inline-block sub-heading fw-semibold mb-2">
                    Những con số không nói dối
                </span>
                <h2 class="fw-bold text-dark display-5">Thành tựu nổi bật*</h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-face-smile"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-semibold mb-2">1 triệu</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                            Học sinh và người học đang theo học tại Ong Nhỏ
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-face-smile"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-semibold mb-2">1 triệu</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                            Học sinh và người học đang theo học tại Ong Nhỏ
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user-graduate"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-semibold mb-2">99,99%</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                        Bạn nhỏ đỗ vào các trường trung học cơ sở khi theo học tại Ong Nhỏ
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-award"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-semibold mb-2">100+</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                            Số giải thưởng trong và ngoài nước Ong Nhỏ đã đạt được
                        </p>
                    </div>
                </div>

            </div>

            <p>
                * Số liệu được lấy từ trong trí tưởng tượng của Ong Nhỏ. 
                Trí tưởng tượng quả là một điều tuyệt vời phải không?
                Nó biến điều không tưởng thành hiện thực, biến giấc mơ thành
                thực tế
            </p>
        </div>

        
    </section>

    <!-- FOOTER -->
    <footer class="text-center text-lg-start" id="footer">
        <div class="container p-4">
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">

                    <div class="bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 250px; height: 150px;">
                        <img src="img/logo/Ongnho-logo.png" height="150px" alt="" loading="lazy" />
                    </div>

                    <p class="text-center">
                        Sứ mệnh của chúng tôi là giúp cho mọi trẻ em trên thế giới đều có thể học tập.
                    </p>
                </div>

                <!-- ĐƯỜNG DẪN NHANH -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Đường dẫn nhanh</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#!" class="text-dark">Bắt đầu học</a>
                        </li>
                        <li class="mb-2">
                            <a href="about-us.php" class="text-dark">Về chúng mình</a>
                        </li>
                    </ul>
                </div>

                <!-- HỖ TRỢ -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Hỗ trợ</h5>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="" class="text-dark">Trung tâm hỗ trợ</a>
                        </li>
                        <li class="mb-2">
                            <a href="support/privacy-policy.php" class="text-dark">Chính sách quyền riêng tư</a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="text-dark">FAQ</a>
                        </li>
                        <li class="mb-2">
                            <a href="contact-us.php" class="text-dark">Liên lạc</a>
                        </li>
                    </ul>
                </div>

                <!-- LIÊN LẠC -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Liên lạc với chúng tôi</h5>

                    <ul class="list-unstyled">
                        <li>
                            <p><i class="fas fa-map-marker-alt pe-2"></i>55 Đ. Giải Phóng, Đồng Tâm, Hai Bà Trưng, Hà Nội</p>
                        </li>
                        <li>
                            <p><i class="fas fa-phone pe-2"></i>024 3863 0001</p>
                        </li>
                        <li>
                            <p><i class="fas fa-envelope pe-2 mb-0"></i>contact@ongnho.vn</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.1)">
            &copy; 2024 Copyright Ong Nhỏ.
        </div>
    </footer>


    <script src="js/hello.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>