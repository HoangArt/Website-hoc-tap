<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên lạc | Herculis</title>
    <link rel="stylesheet" href="css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <style>
        #contact-button {
            background-color: #25b1e8;
            /* Màu nền khi mục được chọn */
            color: white;
            /* Màu chữ khi mục được chọn */
            border-radius: 5px;
        }

        #message {
            width: 100%;
            height: 200px;
            resize: none;
        }

        .readonly-field {
            background-color: #f0f0f0 !important;
            cursor: not-allowed;
        }

        /* Đảm bảo các trường readonly không thể chọn được */
        input[readonly], textarea[readonly] {
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <!-- LOGO -->
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="img/Herculis_logo.png" class="bi me-2" height="32" role="img" aria-label="Bootstrap">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li>
                        <div class="dropdown custom-dropdown">
                            <a href="" data-toggle="dropdown" class="dropdown-link nav-link px-2 link-dark"
                                aria-haspopup="true" aria-expanded="false">
                                Khám phá
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="mega-menu d-flex">
                                    <!-- MÔN 1 -->
                                    <div>
                                        <h3 class="text-primary">Toán học</h3>
                                        <ul class="list-unstyled border-primary">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 2 -->
                                    <div>
                                        <h3 class="text-warning">Tiếng Việt</h3>
                                        <ul class="list-unstyled border-warning">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 3 -->
                                    <div>
                                        <h3 class="text-danger">Tiếng Anh</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 4 -->
                                    <div>
                                        <h3 class="text-danger">Khoa học tự nhiên</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 5 -->
                                    <div>
                                        <h3 class="text-danger">Khoa học xã hội</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 6 -->
                                    <div>
                                        <h3 class="text-danger">Năng khiếu</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="about-us.php" class="nav-link px-2 link-dark">Về chúng tôi</a></li>
                    <li><a href="" class="nav-link px-2 link-dark" id="contact-button">Liên lạc</a></li>
                </ul>

                <!-- Ô TÌM KIẾM -->
                <form class="col-4 mb-3 mb-lg-0 me-lg-5" id="searchbox">
                    <input type="search" class="form-control border border-3" placeholder="Tìm kiếm khóa học..."
                        aria-label="Search">
                </form>

                <!-- USER -->
                <div class="text-end position-relative">
                    <?php if (isset($_SESSION['email'])): ?>
                        <img src="img/user.png" class="user-pic" id="userPic">
                        <div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info">
                                    <img src="img/user.png" alt="User">
                                    <h4>
                                        <?= htmlspecialchars($_SESSION['full_name']); ?>
                                    </h4>
                                </div>
                                <a href="user_settings.php">Cài đặt tài khoản</a>
                                <a href="logout.php">Đăng xuất</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline-primary me-2">Đăng nhập</a>
                        <a href="register.php" class="btn btn-primary">Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- FORM LIÊN LẠC -->
    <section class="py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card rounded shadow-sm overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row gy-3 gy-md-4 gy-lg-0">
                                <div class="col-12 col-lg-6 bsb-overlay background-position-center background-size-cover">
                                    <div class="row align-items-lg-center justify-content-center h-100">
                                        <div class="col-11 col-xl-10">
                                            <div class="contact-info-wrapper py-4 py-xl-5">
                                                <h2 class="h1 mb-3">Liên lạc</h2>
                                                <p class="lead fs-4 mb-4 mb-xxl-5">
                                                    Chúng tôi cam kết luôn sẵn sàng hỗ trợ bạn mọi lúc, mọi nơi, đảm bảo giải quyết nhanh chóng và hiệu quả mọi vấn đề mà bạn gặp phải.
                                                    Chúng tôi luôn đặt sự hài lòng của bạn lên hàng đầu và sẽ nỗ lực hết mình để mang lại trải nghiệm tốt nhất.
                                                </p>

                                                <!-- ĐỊA CHỈ -->
                                                <div class="d-flex mb-4 mb-xxl-5">
                                                    <div class="me-4 text-primary">
                                                        <i class="fas fa-map-marker-alt fa-3x"></i>
                                                    </div>

                                                    <div>
                                                        <h4 class="mb-3">Trụ sở</h4>
                                                        <address class="mb-0">
                                                            55 Đ. Giải Phóng, Đồng Tâm, Hai Bà Trưng, Hà Nội
                                                        </address>
                                                    </div>
                                                </div>

                                                <!-- SỐ ĐIỆN THOẠI -->
                                                <div class="row mb-4 mb-xxl-5">
                                                    <div class="col-12 col-xxl-6">
                                                        <div class="d-flex mb-4 mb-xxl-0">
                                                            <div class="me-4 text-primary">
                                                                <i class="fas fa-phone fa-3x"></i>
                                                            </div>
                                                            <div>
                                                                <h4 class="mb-3">Số điện thoại</h4>
                                                                <p class="mb-0">
                                                                    <a class="link-opacity-100-hover text-decoration-none"
                                                                        href="tel:+024 3863 0001">
                                                                        024 3863 0001
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- EMAIL -->
                                                    <div class="col-12 col-xxl-6">
                                                        <div class="d-flex mb-0">
                                                            <div class="me-4 text-primary">
                                                                <i class="fas fa-envelope fa-3x"></i>
                                                            </div>
                                                            <div>
                                                                <h4 class="mb-3">Email</h4>
                                                                <p class="mb-0">
                                                                    <a class="link-opacity-100-hover text-decoration-none"
                                                                        href="mailto:contact@herculis.com">
                                                                        contact@herculis.com</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- NỘI DUNG BÊN PHẢI -->
                                <div class="col-12 col-lg-6">
                                    <div class="row align-items-lg-center h-100">
                                        <div class="col-12">
                                            <form method="post" action="send-contact-us-message.php">
                                                <div class="row gy-3 p-4 p-xl-5">
                                                    <!-- HỌ VÀ TÊN -->
                                                    <div class="col-12">
                                                        <label for="fullname" class="form-label">
                                                            Họ và tên <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" id="full_name" name="full_name"
                                                            value="<?= isset($_SESSION['full_name']) ? htmlspecialchars($_SESSION['full_name']) : ''; ?>"
                                                            <?= isset($_SESSION['full_name']) ? 'readonly' : ''; ?>
                                                            style="background-color: <?= isset($_SESSION['email']) ? '#f0f0f0' : 'white'; ?>" 
                                                            placeholder="Nguyễn Văn A" required>
                                                    </div>

                                                    <!-- EMAIL -->
                                                    <div class="col-12">
                                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="email" name="email"
                                                            value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>"
                                                            <?= isset($_SESSION['full_name']) ? 'readonly' : ''; ?>
                                                            style="background-color: <?= isset($_SESSION['email']) ? '#f0f0f0' : 'white'; ?>"
                                                            placeholder="hello@example.com" required>
                                                    </div>

                                                    <!-- SỐ ĐIỆN THOẠI -->
                                                    <div class="col-12">
                                                        <label for="phone" class="form-label">Phone Number</label>
                                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="0912345678">

                                                    </div>

                                                    <!-- CHỦ ĐỀ -->
                                                    <div class="col-12">
                                                        <label for="subject" class="form-label">Chủ đề <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="subject" name="subject" required>
                                                    </div>

                                                    <!-- NỘI DUNG -->
                                                    <div class="col-12">
                                                        <label for="message" class="form-label">Nội dung <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                                    </div>

                                                    <!-- NÚT GỬI -->
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary btn-lg" type="submit">Gửi tin nhắn</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center text-lg-start text-white" id="footer">
        <div class="container p-4" style="background-color: #25b1e8">
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">

                    <div class="bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 250px; height: 150px;">
                        <img src="img/Herculis_logo.png" height="70" alt="" loading="lazy" />
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
                            <a href="#!" class="text-white">Bắt đầu học</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-white">Góp ý</a>
                        </li>
                    </ul>
                </div>

                <!-- HỖ TRỢ -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Hỗ trợ</h5>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="" class="text-white">Trung tâm hỗ trợ</a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="text-white">Chính sách quyền riêng tư</a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="text-white">FAQ</a>
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
                            <p><i class="fas fa-envelope pe-2 mb-0"></i>contact@herculis.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            &copy; 2024 Copyright Herculis.
        </div>
    </footer>

    <script src="js/hello.js"></script>
</body>

</html>