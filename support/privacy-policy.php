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
    <header>
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
        <h1>Chính sách quyền riêng tư</h1><br>
        <p>
            Ong Nhỏ ("chúng tôi", "của chúng tôi") cam kết bảo vệ thông tin cá nhân của bạn và
            tuân thủ các quy định pháp luật hiện hành về bảo mật và quyền riêng tư.
            Chính sách này cung cấp thông tin về cách chúng tôi thu thập, sử dụng, lưu trữ và
            bảo vệ thông tin cá nhân của người dùng.
        </p>

        <p class="fw-bold">1. MỤC ĐÍCH THU THẬP THÔNG TIN</p>
        <p>
            Chúng tôi thu thập thông tin cá nhân và thông tin liên quan từ người dùng để đáp ứng các mục đích sau:
        </p>
        <p>
            1.1. Cung cấp dịch vụ học tập và dạy học trực tuyến:
            Học viên và giáo viên sử dụng các tính năng học tập trên Ong Nhỏ như đăng ký khóa học,
            tham gia lớp học và làm bài tập.<br>

            1.2. Hỗ trợ người dùng và cải tiến dịch vụ:
            Đáp ứng yêu cầu hỗ trợ và cải thiện trải nghiệm người dùng dựa trên hành vi và thông tin thu thập.<br>

            1.3. Giao tiếp và cung cấp thông tin quan trọng:
            Thông báo về tin tức, cập nhật dịch vụ, thông tin từ các lớp học và các thông tin khác qua email hoặc thông báo.<br>

            1.4. Thực hiện các nghĩa vụ pháp lý và tuân thủ quy định pháp luật:
            Tuân thủ yêu cầu pháp luật và hợp tác với cơ quan nhà nước khi cần thiết.<br>

            1.5. Quản lý thông tin người dùng trong các hoạt động như đăng ký tài khoản, đăng nhập và tạo lớp học:
            Hỗ trợ giáo viên và học viên thiết lập thông tin liên quan đến lớp học và bài giảng.<br><br>
        </p>

        <p class="fw-bold">2. THÔNG TIN CHÚNG TÔI THU THẬP</p>
        <p>Chúng tôi thu thập các loại thông tin sau đây:</p>
        <p>
            a. Thông tin do bạn cung cấp trực tiếp:
            Thông tin cá nhân khi bạn đăng ký tài khoản hoặc tham gia các dịch vụ của Ong Nhỏ.
            Ví dụ: Tên, địa chỉ email, thông tin số điện thoại, thông tin lớp học hoặc thông tin giáo viên.<br>

            b. Thông tin sử dụng dịch vụ:
            Thông tin liên quan đến việc bạn sử dụng các tính năng của trang web, bao gồm
            Thao tác của bạn khi sử dụng dịch vụ của Ong Nhỏ,
            Thời gian truy cập, các trang bạn truy cập và Các thông tin liên quan đến hành vi của bạn.<br>

            c. Cookie và các công cụ theo dõi tương tự:<br>
            Chúng tôi sử dụng Cookie và các công cụ khác để cải thiện trải nghiệm của bạn và phân tích hành vi trên trang web.<br>
            Cookie giúp chúng tôi:
            Ghi nhớ thông tin và các lựa chọn của bạn.
            Giảm thiểu thời gian cần thiết khi bạn truy cập và sử dụng các tính năng.<br>

            d. Thông tin liên quan đến hoạt động của giáo viên và học sinh:
            Giáo viên có thể đăng thông tin bài tập, nội dung lớp học và thông tin giảng dạy.
            Học viên cung cấp thông tin về tiến độ học tập và tương tác trong lớp học.
        </p>

        <p class="fw-bold">3. CÁCH CHÚNG TÔI SỬ DỤNG THÔNG TIN</p>
        <p>Thông tin cá nhân thu thập từ người dùng sẽ được sử dụng cho các mục đích sau:
        <p>
            3.1. Đảm bảo cung cấp và duy trì các dịch vụ học tập và giảng dạy trên Ong Nhỏ:
            Giúp bạn đăng nhập, học tập và tương tác với lớp học một cách hiệu quả.
            Duy trì và nâng cấp các tính năng mới cho người dùng.<br>

            3.2. Liên lạc với bạn về các thông tin quan trọng liên quan đến tài khoản và lớp học:
            Thông báo về cập nhật dịch vụ, thông tin từ giáo viên hoặc thông tin hệ thống.<br>

            3.3. Nâng cao chất lượng dịch vụ thông qua phân tích hành vi và phản hồi từ người dùng:
            Phân tích dữ liệu thông qua Cookie và thông tin hành vi để cải tiến trải nghiệm người dùng.<br>

            3.4. Tuân thủ các yêu cầu pháp luật và bảo vệ quyền lợi của người dùng:
            Thực hiện nghĩa vụ hợp pháp theo yêu cầu pháp luật hoặc trong trường hợp khẩn cấp.<br>

        </p>

        <p class="fw-bold">4. CÁCH BẢO MẬT THÔNG TIN</p>
        <p>
            Chúng tôi áp dụng các biện pháp bảo mật sau đây để bảo vệ thông tin của bạn:<br>

            4.1. Giới hạn quyền truy cập:
            Chỉ các nhân viên được ủy quyền mới có thể truy cập thông tin người dùng.<br>

            4.2. Theo dõi và phát hiện hành vi truy cập không được phép:
            Dùng các công cụ bảo mật tiên tiến để phát hiện và ngăn chặn các truy cập lạ.<br>

            4.3. Đào tạo nhân viên về bảo mật thông tin:
            Đảm bảo tất cả nhân viên đều được đào tạo về các chính sách bảo mật thông tin.
        </p>

        <p class="fw-bold">5. CHIA SẺ THÔNG TIN</p>
        <p>
            Chúng tôi không trực tiếp bán, cho thuê hoặc chia sẻ thông tin cá nhân của bạn với bên thứ ba
            vì mục đích tiếp thị. Tuy nhiên, thông tin của bạn có thể được chia sẻ trong các trường hợp sau:<br>

            5.1. Khi pháp luật yêu cầu thông tin từ chúng tôi:
            Đáp ứng các yêu cầu từ các cơ quan nhà nước hoặc cơ quan pháp luật.<br>

            5.2. Khi thông tin cần thiết để bảo vệ quyền lợi của chúng tôi hoặc có thể là người dùng:
            Bảo vệ tài sản và an ninh của Ong Nhỏ hoặc người dùng.

            5.3. Khi sử dụng dịch vụ của bên thứ ba hợp tác với Ong Nhỏ để cung cấp dịch vụ:
            Bên thứ ba này có thể sẽ tuân thủ các nguyên tắc bảo mật nghiêm ngặt.
        </p>

        <p class="fw-bold">6. QUYỀN HẠN CỦA BẠN</p>
        <p>
            Bạn có toàn quyền kiểm soát thông tin của mình và có thể thực hiện các quyền sau:<br>
            6.1. Quyền tiếp cận thông tin: Xem thông tin cá nhân mà chúng tôi lưu trữ về bạn.<br>
            6.2. Quyền chỉnh sửa thông tin: Cập nhật thông tin nếu thông tin không chính xác hoặc chưa đầy đủ.<br>
            6.3 Quyền xoá thông tin:
            Yêu cầu chúng tôi xoá thông tin của bạn khỏi hệ thống nếu bạn không còn muốn sử dụng dịch vụ.<br>
        </p>

        <p class="fw-bold">7. COOKIE</p>
        <p>
            Cookie là thông tin lưu trữ trên trình duyệt của người dùng. Cookie được sử dụng để tạo trải nghiệm người dùng linh hoạt và ghi nhớ các thông tin cần thiết.
            Bạn có thể tắt Cookie trong phần cài đặt của trình duyệt nếu không muốn Cookie được lưu trữ.
        </p>

        <p class="fw-bold">8. LIÊN LẠC</p>
        <p>
            Nếu bạn cần thông tin, yêu cầu, hoặc giải đáp về chính sách quyền riêng tư của chúng tôi, vui lòng liên hệ qua thông tin sau:<br>

            Email: contact@ongnho.com<br>
            Website hỗ trợ: https://www.ongnho.com/lien-lac
        </p>

        <p class="fw-bold"> 9. CẬP NHẬT CHÍNH SÁCH</p>
        <p>
            Chúng tôi có thể cập nhật chính sách này theo thời gian để phù hợp với các thay đổi về pháp luật và công nghệ mới.
            Mọi thay đổi sẽ được công bố trên trang web chính thức và thông báo qua email nếu cần.
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