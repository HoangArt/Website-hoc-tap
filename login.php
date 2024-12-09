<?php
session_start();
include("db.php");

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

// Khởi tạo biến thông báo lỗi
$error_message = "";

// Kiểm tra xem form có được gửi không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form đăng nhập
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Kiểm tra xem các trường có rỗng hay không
    if (empty($email) || empty($password) || empty($role)) {
        $error_message = "<p class='text-center text-danger'>Vui lòng nhập đầy đủ thông tin (vai trò, email và mật khẩu).</p>";
    } else {
        // Truy vấn cơ sở dữ liệu để xác thực thông tin đăng nhập
        $sql = "SELECT u.id, u.full_name, u.password, r.role_name
                FROM users u
                JOIN roles r ON u.role_id = r.id
                WHERE u.email = ? AND r.role_name = ?";

        // Chuẩn bị câu lệnh SQL
        if ($stmt = $conn->prepare($sql)) {
            // Gán giá trị tham số vào câu lệnh SQL
            $stmt->bind_param("ss", $email, $role);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                $stmt->store_result();

                // Nếu có người dùng khớp với thông tin
                if ($stmt->num_rows == 1) {
                    // Liên kết kết quả
                    $stmt->bind_result($user_id, $full_name, $hashed_password, $role_name);
                    $stmt->fetch();

                    // Kiểm tra mật khẩu
                    if (password_verify($password, $hashed_password)) {
                        // Lưu thông tin người dùng vào session
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['email'] = $email;
                        $_SESSION['full_name'] = $full_name;
                        $_SESSION['role_name'] = $role_name;

                        // Chuyển hướng đến trang chính
                        header("Location: index.php");
                        exit();
                    } else {
                        $error_message = "<p class='text-center text-danger'>Sai thông tin đăng nhập. Vui lòng nhập lại!</p>";
                    }
                } else {
                    $error_message = "<p class='text-center text-danger'>Không tìm thấy người dùng với thông tin này trong hệ thống.</p>";
                }
            } else {
                // Nếu câu lệnh không thực thi được
                $error_message = "<p class='text-center text-danger'>Lỗi: " . $stmt->error . "</p>";
            }

            // Đóng kết nối
            $stmt->close();
        } else {
            $error_message = "<p class='text-center text-danger'>Lỗi: Không thể chuẩn bị câu lệnh SQL.</p>";
        }
    }
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

<?php
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
    <title>Đăng nhập tài khoản của bạn | Herculis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/"> <!-- Tạo icon -->
    <style>
        body {
            background-color: #f0f0f0;
        }

        .form-floating .form-select {
            height: calc(2.5em + 0.75rem);
            padding: 0.375rem 0.75rem;
            display: flex;
            align-items: center;
            line-height: 1.5;
        }
    </style>
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
                                    id="roleImage" src="img/login/dangNhap.jpg" alt="Đăng nhập tài khoản">
                            </div>

                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="mb-4">
                                                        <a href="index.php" style="text-decoration: none; color: #25b1e8">&larr; Quay về trang chủ</a>
                                                    </div>
                                                    <h4 class="text-center">Đăng nhập tài khoản</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- FORM ĐĂNG NHẬP -->
                                        <form method="post" action="#!">
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
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="remember_me" id="remember_me">
                                                        <label class="form-check-label text-secondary"
                                                            for="remember_me">
                                                            Ghi nhớ tài khoản
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-lg text-white" style="background-color: #25b1e8;" type="submit">Đăng nhập</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                        <div class="row">
                                            <div class="col-12">
                                                <div
                                                    class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                                                    <a href="role-select.php" class="text-decoration-none" style="color: #25b1e8">Tạo tài khoản mới</a>
                                                    <a href="forgot-password.php" class="text-decoration-none" style="color: #25b1e8">Quên mật khẩu?</a>
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
                    roleImage.src = 'img/login/student.jpg';
                    roleImage.alt = 'Học sinh';
                    roleImage.style.objectPosition = 'center';
                    break;
                case 'teacher':
                    roleImage.src = 'img/login/teacher.jpg';
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
</body>

</html>