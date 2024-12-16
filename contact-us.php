<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Liên lạc | Ong Nhỏ</title>
    <link rel="stylesheet" href="css/styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <style>
        header {
            position: fixed;
            width: 100%;
            z-index: 1000;
            top: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

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
        input[readonly],
        textarea[readonly] {
            cursor: not-allowed;
        }
    </style>
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
                        <a href="about-us.php" class="nav-link text-dark d-flex flex-column align-items-center">
                            <i class="fa-solid fa-users fa-3x mb-2"></i>
                            <span>Về chúng mình</span>
                        </a>
                    </li>

                    <!-- LIÊN LẠC -->
                    <li class="nav-item">
                        <a href="contact-us.php" class="nav-link text-dark d-flex flex-column align-items-center"
                        style="color: #feca73 !important;">
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

    <!-- FORM LIÊN LẠC -->
    <section class="py-3 py-md-5 py-xl-8" style="margin-top: 140px;">
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
                                                    Bọn mình cam kết luôn sẵn sàng hỗ trợ bạn mọi lúc, mọi nơi, đảm bảo giải quyết nhanh chóng và hiệu quả mọi vấn đề mà bạn gặp phải.
                                                    Ong Nhỏ chúng mình luôn đặt sự hài lòng của bạn lên hàng đầu và sẽ nỗ lực hết mình để mang lại trải nghiệm tốt nhất.
                                                </p>

                                                <!-- ĐỊA CHỈ -->
                                                <div class="d-flex mb-4 mb-xxl-5">
                                                    <div class="me-4" style="color: #ffb700;">
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
                                                            <div class="me-4" style="color: #ffb700;">
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
                                                            <div class="me-4" style="color: #ffb700;">
                                                                <i class="fas fa-envelope fa-3x"></i>
                                                            </div>
                                                            <div>
                                                                <h4 class="mb-3">Email</h4>
                                                                <p class="mb-0">
                                                                    <a class="link-opacity-100-hover text-decoration-none"
                                                                        href="mailto:contact@ongnho.vn">
                                                                        contact@ongnho.vn</a>
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
                                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                                        
                                                        placeholder="0912345678">

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
                                                            <button class="btn btn-lg" type="submit" style="background-color: #feca73;">Gửi tin nhắn</button>
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
</body>

</html>