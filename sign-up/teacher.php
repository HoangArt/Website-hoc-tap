<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập chưa
if (isset($_SESSION['email'])) {
    $_SESSION['message'] = "Bạn đã đăng nhập rồi!";
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/sign-up.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/logo/Ongnho-icon.png">
    <title>Tạo tài khoản mới cho Giáo viên | Ong Nhỏ</title>
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11 ">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6 ">
                                <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy"
                                    id="roleImage" src="../img/login/teacher.png" alt="Đăng ký tài khoản">
                            </div>

                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="mb-4">
                                                        <a href="../role-select.php" style="text-decoration: none; color: #ffb700">&larr; Thay đổi vai trò</a>
                                                    </div>
                                                    <!-- THÔNG BÁO LỖI -->
                                                    <?php if (isset($_SESSION['message'])): ?>
                                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                            <?php echo $_SESSION['message']; ?>
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                        <?php unset($_SESSION['message']); ?>
                                                    <?php endif; ?>

                                                    <h4 class="text-center">Tạo tài khoản mới cho giáo viên</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- FORM ĐĂNG NHẬP -->
                                        <form method="post" action="sign-up-process.php">
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <input type="hidden" name="role" value="2">
                                                </div>

                                                <!-- HỌ VÀ TÊN -->
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="full_name" id="full_name"
                                                            placeholder="Nguyễn Văn A" required>
                                                        <label for="full_name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>

                                                <!-- NGÀY SINH -->
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="date" class="form-control"
                                                            name="date_of_birth" id="date_of_birth" required>
                                                        <label for="date_of_birth" class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>

                                                <!-- EMAIL -->
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control <?php echo isset($_SESSION['email_error']) ? 'is-invalid' : ''; ?>"
                                                            name="email" id="email" placeholder="name@example.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                        <?php if (isset($_SESSION['email_error'])): ?>
                                                            <div class="invalid-feedback">Email này đã được đăng ký.</div>
                                                            <?php unset($_SESSION['email_error']); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>


                                                <!-- SỐ ĐIỆN THOẠI -->
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Số điện thoại">
                                                        <label for="phone_number" class="form-label">Số điện thoại</label>
                                                    </div>
                                                </div>

                                                <!-- MẬT KHẨU -->
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" value="" placeholder="Password" required>
                                                        <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                                                        <label for="confirm_password" class="form-label">Nhập lại mật khẩu <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="agree_terms" id="agree_terms" required>
                                                        <label class="form-check-label text-secondary" for="agree_terms">
                                                            Tôi đồng ý với <a href="../support/terms-of-service.php" target="_blank">Điều khoản dịch vụ</a> và <a href="../support/privacy-policy.php" target="_blank">Chính sách quyền riêng tư</a> <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-lg text-white" style="background-color: #feca7a;" type="submit">Tạo tài khoản</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                        <div class="row">
                                            <div class="col-12">
                                                <div
                                                    class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                                                    <p>Đã có tài khoản?<a href="../login.php" class="text-decoration-none" style="color: #ffb700"> Đăng nhập ngay!</a></p>
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
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');

            // Thêm lắng nghe sự kiện input
            emailInput.addEventListener('input', function() {
                // Nếu ô email có lớp is-invalid thì loại bỏ lớp đó
                if (emailInput.classList.contains('is-invalid')) {
                    emailInput.classList.remove('is-invalid');
                }
            });
        });

        roleImage.style.objectPosition = 'left';
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>