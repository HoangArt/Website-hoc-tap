<?php
session_start();

// Nếu người dùng đã đăng nhập nhưng lại vào login.php hoặc signup.php
if (isset($_SESSION['message'])) {
    echo "<script>
        alert('" . htmlspecialchars($_SESSION['message'], ENT_QUOTES) . "');
    </script>";
    unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herculis | Phát triển ước mơ</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="icon" type="image/x-icon" href="img/"> <!-- Tạo icon -->
    <style>
        /* Ảnh USER */
        .user-pic {
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .sub-menu-wrap {
            display: none;
            /* Ẩn menu mặc định */
            position: absolute;
            top: 60px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 10;
            width: 200px;
        }

        .sub-menu-wrap.show {
            display: block;
            /* Hiển thị menu khi có lớp 'show' */
        }

        .sub-menu {
            padding: 10px;
        }

        .sub-menu a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
        }

        .sub-menu a:hover {
            background-color: #f0f0f0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .user-info img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
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
                    <li><a href="#" class="nav-link px-2 link-dark">Khám phá</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Phương pháp học</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Diễn đàn</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Liên lạc</a></li>
                </ul>

                <!-- Ô TÌM KIẾM -->
                <form class="col-4 mb-3 mb-lg-0 me-lg-5" id="searchbox">
                    <input type="search" class="form-control border border-3" placeholder="Tìm kiếm khóa học..." aria-label="Search">
                </form>

                <!-- USER -->
                <div class="text-end position-relative">
                    <?php if (isset($_SESSION['username'])): ?>
                        <img src="img/user.png" class="user-pic" id="userPic">
                        <div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info">
                                    <img src="img/user.png" alt="User">
                                    <h4><?= htmlspecialchars($_SESSION['full_name']); ?></h4>
                                </div>
                                <a href="user_settings.php">Cài đặt tài khoản</a>
                                <a href="logout.php">Đăng xuất</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline-primary me-2">Đăng nhập</a>
                        <a href="signup.php" class="btn btn-primary">Đăng ký</a>
                    <?php endif; ?>
                    <a href="feedback.php" class="btn btn-default">Góp ý</a>
                </div>
            </div>
        </div>
    </header>




    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>Về trang web</h6>
                    <p>Trang web được tạo ra nhằm mục đích giúp đỡ trẻ em có cơ hội học tập
                        và phát triển bla bla bla...
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Môn học</h6>
                    <ul class="footer-links">
                        <li><a href="">Toán</a></li>
                        <li><a href="">Ngữ văn</a></li>
                        <li><a href="">Tiếng Anh</a></li>
                        <li><a href="">Khoa học</a></li>
                        <li><a href="">Xã hội</a></li>
                        <li><a href="">Năng khiếu</a></li>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Đường dẫn nhanh</h6>
                    <ul class="footer-links">
                        <li><a href="">About Us</a></li>
                        <li><a href="">Contact Us</a></li>
                        <li><a href="">Contribute</a></li>
                        <li><a href="">Privacy Policy</a></li>
                        <li><a href="">Sitemap</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p>&copy; 2024 Trang web được tạo bởi nhóm 10</p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Hiển thị/Ẩn menu khi nhấn vào ảnh
        const userPic = document.getElementById('userPic');
        const subMenu = document.getElementById('subMenu');

        userPic.addEventListener('click', () => {
            subMenu.classList.toggle('show');
        });

        // Ẩn menu nếu nhấn ra ngoài
        document.addEventListener('click', (e) => {
            if (!subMenu.contains(e.target) && !userPic.contains(e.target)) {
                subMenu.classList.remove('show');
            }
        });
    </script>
</body>

</html>