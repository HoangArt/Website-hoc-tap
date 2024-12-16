<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/css/all.css">
    <title>Chính sách quyền riêng tư | Ong Nhỏ</title>
    <link rel="icon" type="image/x-icon" href="../img/logo/Ongnho-icon.png">
</head>

<body style="background-color: #fff9ec;">
    <!-- HEADER -->
    <header style="position: fixed; width: 100%; z-index: 1000; top: 0; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <div class="container" style="background-color: #FFF9EC;">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <!-- LOGO -->
                <a href="../index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="../img/logo/Ongnho-logo.png" class="bi me-2" height="100px" role="img" aria-label="Bootstrap">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <!-- KHÁM PHÁ -->
                    <li class="nav-item">
                        <a href="../search.php" class="nav-link text-dark d-flex flex-column align-items-center">
                            <i class="fa-solid fa-magnifying-glass fa-3x mb-2"></i>
                            <span>Khám phá</span>
                        </a>
                    </li>

                    <!-- VỀ CHÚNG MÌNH -->
                    <li class="nav-item">
                        <a href="../about-us.php" class="nav-link text-dark d-flex flex-column align-items-center">
                            <i class="fa-solid fa-users fa-3x mb-2"></i>
                            <span>Về chúng mình</span>
                        </a>
                    </li>

                    <!-- LIÊN LẠC -->
                    <li class="nav-item">
                        <a href="../contact-us.php" class="nav-link text-dark d-flex flex-column align-items-center">
                            <i class="fa-regular fa-address-book fa-3x mb-2"></i>
                            <span>Liên lạc</span>
                        </a>
                    </li>
                </ul>


                <!-- USER -->
                <div class="position-relative">
                    <?php if (isset($_SESSION['email'])): ?>
                        <!-- User Avatar -->
                        <img src="../img/user.png" class="user-pic" id="userPic" alt="User Avatar" aria-label="User Menu">

                        <!-- Menu Dropdown -->
                        <div class="sub-menu-wrap" id="subMenu" aria-hidden="true">
                            <div class="sub-menu">
                                <!-- Thông tin người dùng -->
                                <div class="user-info">
                                    <img src="../img/user.png" alt="User Avatar">
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

    <div class="container" style="margin-top: 160px; margin-bottom: 100px; font-size: large;">
        <h1>Điều Khoản Dịch Vụ</h1><br>
        <p class="fw-bold">1. Giới Thiệu về Ong Nhỏ</p>
        <p>
            Ong Nhỏ là một nền tảng giáo dục trực tuyến giúp trẻ em học tập qua các khóa học đa dạng,
            được dạy bởi các giáo viên có kinh nghiệm.
            Phụ huynh có thể theo dõi tiến độ học tập của trẻ và hỗ trợ quá trình học tập tại nhà.
        </p>

        <p class="fw-bold">2. Đối Tượng Sử Dụng</p>
        <p>Dịch vụ của chúng tôi được cung cấp cho các học sinh từ độ tuổi tiểu học đến đầu trung học cơ sơ
            hoặc đối với bất kỳ ai muốn học tập kiến thức cơ bản.
            Đối với học sinh, phụ huynh hoặc người giám hộ hợp pháp phải đồng ý với các điều khoản dịch vụ
            và giám sát hoạt động học tập của trẻ.
        </p>

        <p class="fw-bold">3. Trách Nhiệm của Người Dùng</p>
        <p>
            - Phụ huynh: Phụ huynh cần đảm bảo rằng trẻ em sử dụng nền tảng Ong Nhỏ dưới sự giám sát và hướng dẫn của họ.
            Phụ huynh có trách nhiệm cung cấp thông tin chính xác và cập nhật về trẻ em, bao gồm các chi tiết như tên, ngày sinh, và liên lạc.<br>

            - Giáo viên: Giáo viên sẽ cung cấp các bài giảng, hướng dẫn, và đánh giá tiến độ học tập của trẻ.
            Giáo viên phải tuân thủ các tiêu chuẩn nghề nghiệp và bảo vệ quyền lợi của học sinh.
        </p>

        <p class="fw-bold">4. Điều Kiện Đăng Ký</p>
        <p>
            Để đăng ký tài khoản trên Ong Nhỏ, phụ huynh cần cung cấp thông tin cá nhân và thông tin của trẻ em.
            Mọi thông tin phải được cung cấp đầy đủ và chính xác.
            Phụ huynh phải đảm bảo rằng họ có quyền sử dụng thông tin này và đồng ý cung cấp cho Ong Nhỏ.
        </p>

        <p class="fw-bold">5. Quyền và Nghĩa Vụ của Ong Nhỏ</p>
        <p>
            Ong Nhỏ cam kết bảo vệ sự riêng tư và bảo mật thông tin của người dùng.
            Chúng tôi có quyền thay đổi, cập nhật hoặc ngừng cung cấp dịch vụ mà không cần thông báo trước.
            Chúng tôi sẽ không trực tiếp chia sẻ thông tin cá nhân của học sinh với bên thứ ba mà không có sự đồng ý của phụ huynh hoặc người giám hộ.
        </p>

        <p class="fw-bold">6. Tiến Độ Học Tập và Đánh Giá</p>
        <p>
            Ong Nhỏ cung cấp các báo cáo và công cụ theo dõi tiến độ học tập của trẻ em.
            Phụ huynh có thể xem các đánh giá này để nắm bắt tiến trình học tập của con em mình.
        </p>

        <p class="fw-bold">7. Quyền Sử Dụng Nội Dung</p>
        <p>
            Tất cả các tài liệu giảng dạy và bài học được cung cấp trên nền tảng Ong Nhỏ
            thuộc quyền sở hữu của chúng tôi hoặc các bên cấp phép.
            Người dùng không được sao chép, sửa đổi hoặc phân phối lại nội dung mà không có sự cho phép của chúng tôi.
            Nếu vi phạm, chúng tôi hoàn toàn có quyền bán thông tin của bạn cho các nhà quảng cáo
            để bồi thường thiệt hại về tài chính.
        </p>

        <p class="fw-bold">8. Hỗ Trợ và Khiếu Nại</p>
        <p>
            Nếu có bất kỳ vấn đề gì liên quan đến dịch vụ,
            người dùng có thể liên hệ với bộ phận hỗ trợ khách hàng của Ong Nhỏ qua email
            hoặc số điện thoại hỗ trợ được cung cấp trên trang web.<br>

            Email: contact@ongnho.com<br>
            Website hỗ trợ: https://www.ongnho.com/lien-lac
        </p>

        <p class="fw-bold"> 9. Sửa Đổi Điều Khoản Dịch Vụ</p>
        <p>
            Chúng tôi có quyền sửa đổi các điều khoản dịch vụ này bất cứ lúc nào mà không cần thông báo trước.
            Mọi thay đổi sẽ có hiệu lực ngay khi được đăng tải trên trang web.
        </p>


        <p>
            Khi bạn tiếp tục sử dụng dịch vụ của Ong Nhỏ, điều đó đồng nghĩa với việc bạn đã đọc,
            hiểu và đồng ý với các điều khoản của chính sách này.
        </p>
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-lg-start" id="footer">
        <div class="container p-4">
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">

                    <div class="bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 250px; height: 150px;">
                        <img src="../img/logo/Ongnho-logo.png" height="150px" alt="" loading="lazy" />
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
                            <a href="privacy-policy.php" class="text-dark">Chính sách quyền riêng tư</a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="text-dark">FAQ</a>
                        </li>
                        <li class="mb-2">
                            <a href="../contact-us.php" class="text-dark">Liên lạc</a>
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
</body>

</html>