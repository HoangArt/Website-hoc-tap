<?php
session_start();
include("db.php");  // Đảm bảo kết nối cơ sở dữ liệu đã được thực hiện trong db.php

// Kiểm tra nếu người dùng đã đăng nhập chưa
if (isset($_SESSION['username'])) {
    $_SESSION['message'] = "Bạn đã đăng nhập rồi!";
    header("Location: index.php");
    exit();
}

// Khởi tạo biến thông báo lỗi
$error_message = "";

// Kiểm tra xem form có được gửi không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form đăng nhập
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Kiểm tra xem các trường có rỗng hay không
    if (empty($username) || empty($password) || empty($role)) {
        $error_message = "<p class='text-center text-danger'>Vui lòng nhập đầy đủ thông tin (username, password, và role).</p>";
    } else {
        // Truy vấn cơ sở dữ liệu để xác thực thông tin đăng nhập
        $sql = "SELECT u.id, u.full_name, u.password, r.role_name
                FROM users u
                JOIN roles r ON u.role_id = r.id
                WHERE u.contact_info = ? AND r.role_name = ?";

        // Chuẩn bị câu lệnh SQL
        if ($stmt = $conn->prepare($sql)) {
            // Gán giá trị tham số vào câu lệnh SQL
            $stmt->bind_param("ss", $username, $role);

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
                        $_SESSION['username'] = $username;
                        $_SESSION['full_name'] = $full_name;
                        $_SESSION['role_name'] = $role_name;

                        // Chuyển hướng đến trang chính
                        header("Location: index.php");
                        exit();
                    } else {
                        $error_message = "<p class='text-center text-danger'>Sai mật khẩu.</p>";
                    }
                } else {
                    $error_message = "<p class='text-center text-danger'>Không tìm thấy người dùng với thông tin này.</p>";
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
// Kiểm tra nếu tham số 'signup' trong URL có giá trị 'success'
if (isset($_GET['signup']) && $_GET['signup'] == 'success') {
    echo "<p class='text-center text-warning'>Cảnh báo: Bạn đã đăng ký thành công! Hãy đăng nhập ngay bây giờ.</p>";
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản của bạn | Herculis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="img/"> <!-- Tạo icon -->
    <style>
        /* FORM */
        form {
            background-color: #EDDCD9;
            border: 2px solid #264143;
            border-radius: 20px;
            /* Bo góc cho form */
            padding: 20px;
            box-shadow: 3px 4px 0px 1px #E99F4C;
            /* Hiệu ứng đổ bóng */
        }

        .form-control,
        .form-select {
            box-shadow: 3px 4px 0px 1px #E99F4C;
            border: 1px solid #ccc;
            transition: box-shadow 0.3s ease-in-out;
        }

        .form-control:focus {
            outline: none;
            transform: translateY(4px);
            box-shadow: 1px 2px 0px 0px #E99F4C;
        }


        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }



        /* NÚT */
        #loginButton {
            box-shadow: 3px 4px 0px 1px #D62980;
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        /* NÚT GÓP Ý */
        #feedbackButton {
            box-shadow: 3px 4px 0px 1px #E99F4C;
            border: 2px solid #264143;
            border-radius: 4px;
        }

        #feedbackButton:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        /* NÚT QUAY LẠI TRANG CHỦ */
        .back-link {
            font-size: 0.9rem;
            color: #007bff;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 1rem;
        }

        /* NHẴN ĐĂNG NHẬP */
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #264143;
        }

        /* HÌNH ẢNH */
        /* Đặt kích thước tối đa cho hình ảnh để không làm thay đổi bố cục */
        #roleImage {
            max-height: 500px;
            max-width: 100%; /* Đảm bảo ảnh không vượt quá khung */
            object-fit: cover; /* Duy trì tỷ lệ ảnh mà không làm méo */
            margin: auto; /* Căn giữa */
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
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <p>Herculis</p>
                </a>


                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">

                </ul>


                <div class="text-end">
                    <a href="feedback.php" class="btn btn-default btn-feedback" id="feedbackButton">Góp ý</a>
                </div>
            </div>
        </div>
    </header>

    <!-- FORM ĐĂNG NHẬP -->
    <section>
        <!-- HÌNH ẢNH -->
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <!-- HÌNH ẢNH -->
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img id="roleImage" src="img/dangNhap.jpg" class="img-fluid" alt="Đăng nhập">
                </div>

                <!-- CỘT FORM -->
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <a href="index.php" class="back-link">&larr; Quay lại trang chủ</a><br>
                        <div id="loginTitle">
                            <h3>Đăng nhập tài khoản</h3>
                        </div>

                        <div class="divider d-flex align-items-center my-4" style="border-top: 2px solid #DE5499;"></div>

                        <!-- CHỌN VAI TRÒ -->
                        <div class="form-group">
                            <label for="">Chọn vai trò của bạn:</label>
                            <select id="roleSelect" name="role" class="form-select form-select-lg mb-3 border border-2 border-dark rounded-2" aria-label=".form-select-lg example">
                                <option value="" disabled selected>Nhấn để lựa chọn</option>
                                <option value="student">Học sinh</option>
                                <option value="teacher">Giáo viên</option>
                                <option value="parent">Phụ huynh</option>
                            </select>
                        </div>

                        <!-- NHẬP EMAIL -->
                        <div class="form-group">
                            <label for="">Tài khoản:</label>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input name="username" type="text" id="form3Example3" class="form-control form-control-lg border border-2 border-dark rounded-2"
                                    placeholder="Email hoặc số điện thoại" />
                            </div>
                        </div>

                        <!-- NHẬP MẬT KHẨU -->
                        <div class="form-group">
                            <label for="">Mật khẩu:</label>
                            <div data-mdb-input-init class="form-outline mb-3">
                                <input name="password" type="password" id="form3Example4" class="form-control form-control-lg border border-2 border-dark rounded-2"
                                    placeholder="Mật khẩu" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- GHI NHỚ TÀI KHOẢN -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">Ghi nhớ tài khoản</label>
                            </div>

                            <a href="reset-password.php" class="text-body">Quên mật khẩu?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <!-- HIỆN THÔNG BÁO LỖI -->
                            <?php
                            echo $error_message;
                            ?>
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #DE5499; border-color: #DE5499" id="loginButton">Đăng
                                nhập</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Bạn chưa có tài khoản? <a href="signup.php"
                                    class="link-danger">Đăng ký ngay!</a></p>
                        </div>

                    </form>
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
                    roleImage.src = 'img/student.jpg';
                    roleImage.alt = 'Học sinh';
                    break;
                case 'teacher':
                    roleImage.src = 'img/teacher.jpg';
                    roleImage.alt = 'Giáo viên';
                    break;
                case 'parent':
                    roleImage.src = 'img/parent.jpg';
                    roleImage.alt = 'Phụ huynh';
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