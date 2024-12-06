<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo lại mật khẩu mới | Herculis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/"> <!-- Tạo icon -->
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="p-3 bg-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <!-- LOGO -->
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="img/Herculis_logo.png" class="bi me-2" height="32" role="img" aria-label="Bootstrap">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                </ul>

                <div class="text-end">
                    <a href="contact-us.php" class="btn btn-default">Liên hệ</a>
                </div>
            </div>
        </div>
    </header>

    <!-- CÀI LẠI MẬT KHẨU -->
    <section>
        <div class="container">
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                        <img class="img-fluid" loading="lazy" src="img/quenMatKhau.jpg" height="500px" alt="Welcome back you've been missed!">
                    </div>

                    <!-- FORM CÀI LẠI MẬT KHẨU -->
                    <div class="col-12 col-md-6 d-flex align-items-center">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-5">
                                        <h2 class="h3">Thay đổi mật khẩu</h2>
                                        <h3 class="fs-6 fw-normal text-secondary m-0">
                                            Vui lòng điền email được liên kết với tài khoản để thay đổi mật khẩu.
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="reset-password/send-forgot-password.php">
                                <div class="row gy-3 gy-md-4 overflow-hidden">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="hello@example.com" required>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn bsb-btn-xl btn-primary" type="submit">Tiếp tục</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Hiển thị thông báo popup nếu có -->
                            <?php if (isset($_SESSION['message'])): ?>
                                <script type="text/javascript">
                                    alert("<?php echo $_SESSION['message']; ?>");
                                </script>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-5 mb-4 border-secondary-subtle">
                                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                        <a href="login.php" class="link-secondary text-decoration-none">Đăng nhập</a>
                                        <a href="register.php" class="link-secondary text-decoration-none">Đăng ký</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
