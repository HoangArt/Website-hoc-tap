<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập chưa
if (isset($_SESSION['email'])) {
    $_SESSION['message'] = "Bạn đã đăng nhập rồi!";
    header("Location: index.php");
    exit();
}

// Kiểm tra thông báo thay đổi mật khẩu
if (isset($_SESSION['password_changed']) && $_SESSION['password_changed'] == true) {
    echo "<script>
        window.onload = function() {
            alert('Mật khẩu của bạn đã được thay đổi thành công! Hãy đăng nhập lại.');
        };
    </script>";
    unset($_SESSION['password_changed']); // Xóa session sau khi hiển thị
}



// Kiểm tra nếu tham số 'register' trong URL có giá trị 'success'
if (isset($_GET['register']) && $_GET['register'] == 'success') {
    echo "<p class='text-center text-warning'>Cảnh báo: Bạn đã đăng ký thành công! Hãy đăng nhập ngay bây giờ.</p>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản | Ong Nhỏ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <style>
        .form-floating .form-select {
            height: calc(2.5em + 0.75rem);
            padding: 0.375rem 0.75rem;
            display: flex;
            align-items: center;
            line-height: 1.5;
        }

        .form-label {
            color: black;
            background-color: transparent;
            padding: 0 0.25rem;
        }

        .form-check-input:checked {
            background-color: #feca7a;
            border-color: #feca7a;
        }
    </style>
</head>

<body style="background-color: #f0f0f0;">
    <section class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11 ">
                    <div class="card shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                    id="roleImage" src="img/login/dangNhap.png" alt="Đăng nhập tài khoản">
                            </div>

                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="mb-4">
                                                        <a href="index.php" style="text-decoration: none; color: #ffb700">&larr; Quay về trang chủ</a>
                                                    </div>
                                                    <h4 class="text-center">Đăng nhập tài khoản</h4>
                                                    <?php if (isset($_SESSION['message'])): ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <?php echo $_SESSION['message']; ?>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                        <?php unset($_SESSION['message']); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- FORM ĐĂNG NHẬP -->
                                        <form method="post" action="sign-up/login-process.php">
                                            <div class="row gy-3 overflow-hidden">
                                                <!-- CHỌN VAI TRÒ -->
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="roleSelect" name="role"
                                                        aria-label="Chọn vai trò" required>
                                                        <option value="" selected disabled>Chọn vai trò</option>
                                                        <option value="student">Học sinh/ Người học</option>
                                                        <option value="teacher">Giáo viên</option>
                                                        <option value="parent">Phụ huynh</option>
                                                    </select>

                                                </div>

                                                <!-- EMAIL -->
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" name="email" id="email"
                                                            placeholder="name@example.com" required>
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                </div>

                                                <!-- MẬT KHẨU -->
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" value="" placeholder="Password" required>
                                                        <label for="password" class="form-label">Mật khẩu</label>

                                                        <button type="button" id="togglePassword"
                                                            class="btn btn-outline-secondary btn-sm position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);">
                                                            Hiện
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="remember_me" id="remember_me">
                                                        <label class="form-check-label text-secondary"
                                                            for="remember_me">Ghi nhớ tài khoản
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-lg text-white"
                                                            style="background-color: #feca7a;" type="submit">Đăng nhập
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <div class="row">
                                            <div class="col-12">
                                                <div
                                                    class="d-flex gap-2 gap-md-4 flex-md-row justify-content-center mt-5">
                                                    <a href="role-select.php" class="text-decoration-none" style="color: #ffb700">Tạo tài khoản mới</a>
                                                    <a href="forgot-password.php" class="text-decoration-none" style="color: #ffb700">Quên mật khẩu?</a>
                                                </div>
                                            </div>
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

    <script>
        // Thay đổi hình ảnh đăng nhập tùy theo vai trò
        document.getElementById('roleSelect').addEventListener('change', function() {
            const selectedRole = this.value; // Lấy giá trị của vai trò đã chọn
            const roleImage = document.getElementById('roleImage'); // Lấy thẻ ảnh

            // Thay đổi ảnh dựa trên vai trò
            switch (selectedRole) {
                case 'student':
                    roleImage.src = 'img/login/student.png';
                    roleImage.alt = 'Học sinh';
                    roleImage.style.objectPosition = 'center';
                    break;
                case 'teacher':
                    roleImage.src = 'img/login/teacher.png';
                    roleImage.alt = 'Giáo viên';
                    roleImage.style.objectPosition = 'left';
                    break;
                case 'parent':
                    roleImage.src = 'img/login/parent.jpg';
                    roleImage.alt = 'Phụ huynh';
                    roleImage.style.objectPosition = 'ceneter';
                    break;
            }
        });

        // Xóa nút "Nhấn để lựa chọn" sau khi chọn một vai trò
        document.getElementById('roleSelect').addEventListener('change', function() {
            const placeholderOption = this.querySelector('option[value=""]'); // Lấy tùy chọn placeholder
            if (placeholderOption) {
                placeholderOption.remove(); // Xóa tùy chọn placeholder
            }
        });
    </script>

    <script src="js/password.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>