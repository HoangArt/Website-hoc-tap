<header>
    <div class="container" style="background-color: #FFF9EC;">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <!-- LOGO -->
            <a href= "http://localhost/OngNho/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img src="http://localhost/OngNho/img/logo/Ongnho-logo.png" class="bi me-2" height="100px" role="img" aria-label="Bootstrap">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <!-- NÚT BẤM DÀNH CHO GIÁO VIÊN VÀ PHỤ HUYNH -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if ($_SESSION['role_name'] == "teacher"): ?>
                        <li class="nav-item">
                            <a href="http://localhost/OngNho/teacher/upload.php" class="nav-link text-dark d-flex flex-column align-items-center">
                                <i class="fa-solid fa-chalkboard-user fa-3x mb-2"></i>
                                <span>Tải bài tập</span>
                            </a>
                        </li>
                    <?php elseif ($_SESSION['role_name'] == "parent"): ?>
                        <li class="nav-item">
                            <a href="http://localhost/OngNho/parent.php" class="nav-link text-dark d-flex flex-column align-items-center">
                                <i class="fa-solid fa-hands-holding-child fa-3x mb-2"></i>
                                <span>Quản lý con cái</span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- KHÁM PHÁ -->
                <li class="nav-item">
                    <a href="http://localhost/OngNho/search.php" class="nav-link text-dark d-flex flex-column align-items-center">
                        <i class="fa-solid fa-magnifying-glass fa-3x mb-2"></i>
                        <span>Khám phá</span>
                    </a>
                </li>

                <!-- VỀ CHÚNG MÌNH -->
                <li class="nav-item">
                    <a href="http://localhost/OngNho/about-us.php" class="nav-link text-dark d-flex flex-column align-items-center">
                        <i class="fa-solid fa-users fa-3x mb-2"></i>
                        <span>Về chúng mình</span>
                    </a>
                </li>

                <!-- LIÊN LẠC -->
                <li class="nav-item">
                    <a href="http://localhost/OngNho/contact-us.php" class="nav-link text-dark d-flex flex-column align-items-center">
                        <i class="fa-regular fa-address-book fa-3x mb-2 yo"></i>
                        <span>Liên lạc</span>
                    </a>
                </li>
            </ul>

            <!-- USER -->
            <div class="position-relative">
                <?php if (isset($_SESSION['email'])): ?>
                    <!-- User Avatar -->
                    <img src="<?= htmlspecialchars($user_avatar_url); ?>" class="user-pic" id="userPic" alt="User Avatar" aria-label="User Menu">

                    <!-- Menu Dropdown -->
                    <div class="sub-menu-wrap" id="subMenu" aria-hidden="true">
                        <div class="sub-menu">
                            <!-- THÔNG TIN USER -->
                            <div class="user-info">
                                <img src="<?= htmlspecialchars($user_avatar_url); ?>" alt="User Avatar">
                                <h4><?= htmlspecialchars($_SESSION['full_name']); ?></h4>
                            </div>

                            <ul>
                                <li><a href="http://localhost/OngNho/user_settings.php"><i class="fa-solid fa-cog"></i> Cài đặt tài khoản</a></li>
                                <li><a href="http://localhost/OngNho/logout.php"><i class="fa-solid fa-sign-out-alt"></i> Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>

                <?php else: ?>
                    <a href="http://localhost/OngNho/login.php"
                        class="btn me-2"
                        aria-label="Login"
                        style="padding: 20px 20px; border: 2px solid #feca73; background-color: transparent; color: #feca73; text-decoration: none; transition: background-color 0.3s, color 0.3s;"
                        onmouseover="this.style.backgroundColor='#feca73'; this.style.color='black';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.color='#feca73';">
                        Đăng nhập
                    </a>
                    <a href="http://localhost/OngNho/role-select.php" class="btn" aria-label="Sign-up" style="padding: 20px 20px; background-color: #feca73;">Đăng ký</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</header>