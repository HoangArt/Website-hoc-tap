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
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Phụ huynh | Ong Nhỏ</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        :root {
            --primary-color: #1a73e8;
            --text-color: #202124;
            --background-color: #f8f9fa;
            --card-background: #ffffff;
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar {
            background-color: var(--primary-color);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            transition: opacity 0.3s ease;
        }

        .navbar a:hover {
            opacity: 0.8;
        }

        .navbar .left,
        .navbar .right {
            display: flex;
            align-items: center;
        }

        .navbar .right {
            position: relative;
        }

        .navbar .right .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            color: black;
            min-width: 200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 10;
            overflow: hidden;
        }

        .navbar .right .dropdown a {
            color: var(--text-color);
            padding: 12px 16px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .navbar .right .dropdown a:hover {
            background-color: var(--background-color);
            opacity: 1;
        }

        .container h1 {
            color: var(--primary-color);
            margin-bottom: 20px;
            text-align: center;
        }

        .account-section,
        .ad-section {
            background-color: var(--card-background);
            padding: 25px;
            margin: 20px 0;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .account-section .add-account {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .account-section .add-account:hover {
            background-color: #1557b0;
        }

        .account-section .account {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.3s ease;
        }

        .account-section .account:hover {
            background-color: var(--background-color);
        }

        .account-section .account img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .account-section .account .name {
            flex-grow: 1;
            text-align: left;
            margin-left: 15px;
        }

        .account-section .account .settings,
        .account-section .account .delete {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .account-section .account .settings {
            color: var(--primary-color);
            background-color: rgba(26, 115, 232, 0.1);
        }

        .account-section .account .delete {
            color: #ff4d4d;
            background-color: rgba(255, 77, 77, 0.1);
            margin-left: 10px;
        }

        .ad-section {
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-color), #6a11cb);
            color: white;
        }

        .ad-section img {
            width: 100px;
            height: auto;
            margin-right: 20px;
            border-radius: 8px;
        }

        .ad-section .ad-text {
            flex-grow: 1;
        }

        .ad-section .ad-button {
            background-color: white;
            color: var(--primary-color);
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .ad-section .ad-button:hover {
            background-color: #f0f0f0;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 60px;
        }

        .modal-content {
            background-color: var(--card-background);
            margin: 5% auto;
            padding: 25px;
            border-radius: var(--border-radius);
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .form-group button {
            background-color: var(--primary-color);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-group button:hover {
            background-color: #1557b0;
        }


        /* Responsive design */
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                align-items: center;
            }

            .footer-section {
                text-align: center;
            }

            .social-icons {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
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
                                <!-- THÔNG TIN USER -->
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

    <div class="container" style="margin-top: 200px;">
        <h1>Chào mừng, <?= $_SESSION['full_name']; ?></h1>
        <p style="text-align:center; color: var(--text-color); margin-bottom: 20px;">
            Tài liệu dành cho phụ huynh
        </p>

        <div class="account-section" id="accountSection">
            <div class="add-account" onclick="document.getElementById('myModal').style.display='block'">
                Thêm tài khoản cho con
            </div>
            <h2>Con của bạn</h2>
            <p>Đây là tài khoản con của các bạn nhấp vào để xem tiến độ</p>
            <div class="account">
                <img alt="Child account icon" src="https://storage.googleapis.com/a1aa/image/TXHppP8hWPYJNpy4uy90ky0z6d3QnV4gVtI3bosRCEd3yreJA.jpg" />
                <div class="name" id="childName">duongcuti123</div>
                <a class="settings" href="#" onclick="document.getElementById('editModal').style.display='block'">Chỉnh sửa cài đặt</a>
                <a class="delete" href="#" onclick="deleteAccount(this)">Xóa</a>
            </div>
        </div>

        <!-- QUẢNG CÁO -->
        <div class="ad-section">
            <img alt="Khan Academy Kids characters" src="https://storage.googleapis.com/a1aa/image/bd4ektKmOepQbk85f7obJNC9XwTYEZxly5na6Nwarztft8qPB.jpg" />
            <div class="ad-text">
                <h3>
                    Đặt cược dễ dàng, thắng lớn cùng Fishy
                </h3>
                <p>
                    Nhà cái thể thao trực tuyến với tỷ lệ chơi hấp dẫn và các ưu đãi đặc biệt!
                </p>
            </div>
            <a class="ad-button" href="https://youtu.be/dQw4w9WgXcQ?si=N8TEFuLldi5mDnpM">Tìm hiểu thêm!</a>
        </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
            <h2>Thêm tài khoản con</h2>
            <div class="form-group">
                <label for="username">Rên</label>
                <input id="username" name="username" type="text" />
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input id="password" name="password" type="password" />
            </div>
            <div class="form-group">
                <label for="dob">Ngày tháng năm sinh</label>
                <input id="dob" name="dob" type="date" />
            </div>
            <div class="form-group">
                <button onclick="addAccount()" type="button">Đăng ký</button>
            </div>
        </div>
    </div>

    <div class="modal" id="editModal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('editModal').style.display='none'">&times;</span>
            <h2>Chỉnh sửa cài đặt</h2>
            <div class="form-group">
                <label for="edit-username">Tên:</label>
                <input id="edit-username" name="edit-username" type="text" value="duongcuti123" />
            </div>
            <div class="form-group">
                <label for="edit-dob">Ngày tháng năm sinh</label>
                <input id="edit-dob" name="edit-dob" type="date" />
            </div>
            <div class="form-group">
                <button onclick="saveChanges()" type="button">Lưu thay đổi</button>
            </div>
        </div>
    </div>

    <div class="modal" id="accountSettingsModal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('accountSettingsModal').style.display='none'">&times;</span>
            <h2>Cài đặt tài khoản</h2>
            <div class="form-group">
                <label for="account-username">Tài khoản</label>
                <input id="account-username" name="account-username" type="text" value="youlovecat113" />
            </div>
            <div class="form-group">
                <label for="account-password">Mật khẩu</label>
                <input id="account-password" name="account-password" type="password" />
            </div>
            <div class="form-group">
                <button type="button">Lưu thay đổi</button>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-lg-start" id="footer">
        <div class="container p-4">
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0 ">
                    <div class="bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 100px; height: 100px;">
                        <img src="img/logo/Ongnho-logo.png" height="100px" alt="" loading="lazy" />
                    </div>

                    <p class="text-center">
                        Sứ mệnh của chúng mình là giúp cho mọi trẻ em trên thế giới đều có thể học tập.
                    </p>
                </div>

                <!-- ĐƯỜNG DẪN NHANH -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Truy cập</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#!" class="text-dark footer-links">Bắt đầu học</a>
                        </li>
                        <li class="mb-2">
                            <a href="about-us.php" class="text-dark footer-links">Về chúng mình</a>
                        </li>
                    </ul>
                </div>

                <!-- DẠY HỌC-->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Giáo viên</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#!" class="text-dark footer-links">Trở thành giáo viên tại Ong Nhỏ</a>
                        </li>
                        <li class="mb-2">
                            <a href="about-us.php" class="text-dark footer-links">Cách sử dụng dịch vụ</a>
                        </li>
                    </ul>
                </div>

                <!-- HỖ TRỢ -->
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Hỗ trợ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="support/terms-of-service.php" class="text-dark footer-links">Điều khoản Dịch vụ</a>
                        </li>
                        <li class="mb-2">
                            <a href="support/privacy-policy.php" class="text-dark footer-links">Chính sách quyền riêng tư</a>
                        </li>
                        <li class="mb-2">
                            <a href="contact-us.php" class="text-dark footer-links">Liên lạc</a>
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
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.1)">
            &copy; 2024 Ong Nhỏ
        </div>
    </footer>

    <script>
        var modal = document.getElementById('myModal');
        var editModal = document.getElementById('editModal');
        var accountSettingsModal = document.getElementById('accountSettingsModal');
        var accountDropdown = document.getElementById('accountDropdown');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            if (event.target == editModal) {
                editModal.style.display = "none";
            }
            if (event.target == accountSettingsModal) {
                accountSettingsModal.style.display = "none";
            }
            if (!event.target.matches('.navbar .right a')) {
                accountDropdown.style.display = "none";
            }
        }

        function toggleDropdown() {
            var dropdown = document.getElementById('accountDropdown');
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }

        function addAccount() {
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var dob = document.getElementById('dob').value;

            if (username && password && dob) {
                var accountSection = document.getElementById('accountSection');
                var newAccount = document.createElement('div');
                newAccount.className = 'account';
                newAccount.innerHTML = `
                    <img src="https://storage.googleapis.com/a1aa/image/TXHppP8hWPYJNpy4uy90ky0z6d3QnV4gVtI3bosRCEd3yreJA.jpg" alt="Child account icon" width="50" height="50">
                    <div class="name">${username}</div>
                    <a class="settings" href="#" onclick="document.getElementById('editModal').style.display='block'">Chỉnh sửa cài đặt</a>
                    <a class="delete" href="#" onclick="deleteAccount(this)">Xóa</a>
                `;
                accountSection.appendChild(newAccount);
                modal.style.display = 'none';
            }
        }

        function saveChanges() {
            var username = document.getElementById('edit-username').value;
            var password = document.getElementById('edit-password').value;
            var dob = document.getElementById('edit-dob').value;

            if (username && password && dob) {
                document.getElementById('childName').innerText = username;
                editModal.style.display = 'none';
            }
        }

        function deleteAccount(element) {
            var account = element.parentElement;
            account.remove();
        }
    </script>

    <script src="js/hello.js"></script>
</body>

</html>