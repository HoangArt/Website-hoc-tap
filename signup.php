<?php
include("db.php");

// Khởi tạo biến thông báo lỗi
$error_message = "";

// Kiểm tra xem form có được gửi không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận giá trị từ form
    $role = $_POST['role'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $contact_info = $_POST['contact_info'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Kiểm tra dữ liệu hợp lệ
    if (empty($full_name) || empty($date_of_birth) || empty($contact_info) || empty($password) || empty($confirm_password)) {
        $error_message = "<p class='text-center text-danger'>Vui lòng điền đầy đủ thông tin.</p>";
    } elseif ($password !== $confirm_password) {
        $error_message = "<p class='text-center text-danger'>Mật khẩu không khớp.</p>";
    } else {
        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check_email = "SELECT * FROM users WHERE contact_info = ?";
        if ($stmt = $conn->prepare($sql_check_email)) {
            $stmt->bind_param("s", $contact_info);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $error_message = "<p class='text-center text-danger'>Email này đã được đăng ký, vui lòng chọn email khác.</p>";
            } else {
                // Mã hóa mật khẩu
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Thêm dữ liệu vào cơ sở dữ liệu
                $sql = "INSERT INTO users (role_id, full_name, date_of_birth, contact_info, password) VALUES (?, ?, ?, ?, ?)";

                // Chuẩn bị câu lệnh
                if ($stmt = $conn->prepare($sql)) {
                    // Gán giá trị cho các tham số
                    $stmt->bind_param("issss", $role_id, $full_name, $date_of_birth, $contact_info, $hashed_password);

                    // Thực thi câu lệnh
                    if ($stmt->execute()) {
                        echo "<p class='text-center text-success'>Đăng ký thành công!</p>";
                        header("Location: login.php");
                        exit();
                    } else {
                        $error_message = "<p class='text-center text-danger'>Lỗi: " . $stmt->error . "</p>";
                    }

                    // Đóng kết nối
                    $stmt->close();
                } else {
                    $error_message = "<p class='text-center text-danger'>Lỗi: Không thể chuẩn bị câu lệnh SQL.</p>";
                }
            }
            
            // Đóng kết nối
            $stmt->close();
        } else {
            $error_message = "<p class='text-center text-danger'>Lỗi: Không thể chuẩn bị câu lệnh kiểm tra email.</p>";
        }
    }
}

// Đóng kết nối
$conn->close();
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
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img id="roleImage" src="img/dangNhap.jpg" class="img-fluid" alt="Đăng nhập">
                </div>

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <a href="index.php" class="back-link">&larr; Quay lại trang chủ</a><br>
                        <div id="loginTitle">
                            <h3>Tạo tài khoản mới</h3>
                        </div>

                        <div class="divider d-flex align-items-center my-4" style="border-top: 2px solid #DE5499;"></div>
                        <!-- HIỆN THÔNG BÁO LỖI -->
                        <div><?php echo $error_message; ?></div>
                        <!-- CHỌN VAI TRÒ -->
                        <div class="form-group">
                            <label for="role">Chọn vai trò của bạn:</label>
                            <select id="roleSelect" name="role" class="form-select form-select-lg mb-3 border border-2 border-dark rounded-2" aria-label=".form-select-lg example">
                                <option value="" disabled selected>Nhấn để lựa chọn</option>
                                <option value="student">Học sinh</option>
                                <option value="teacher">Giáo viên</option>
                                <option value="parent">Phụ huynh</option>
                            </select>
                        </div><br>

                        <!-- THÔNG TIN CÁ NHÂN -->
                        <div class="form-group">
                            <label for="">Thông tin cá nhân</label>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input name="full_name" type="text" id="form3Example3" class="form-control form-control-lg border border-2 border-dark rounded-2"
                                    placeholder="Họ và tên" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input name="date_of_birth" type="date" id="form3Example3" class="form-control form-control-lg border border-2 border-dark rounded-2" />
                            </div>
                        </div><br>

                        <!-- THÔNG TIN TÀI KHOẢN -->
                        <div class="form-group">
                            <label for="">Thông tin tài khoản</label>
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input name="contact_info" type="text" id="form3Example3" class="form-control form-control-lg border border-2 border-dark rounded-2"
                                    placeholder="Email hoặc số điện thoại" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-3">
                                <input name="password" type="password" id="form3Example4" class="form-control form-control-lg border border-2 border-dark rounded-2"
                                    placeholder="Mật khẩu" />
                            </div>

                            <div data-mdb-input-init class="form-outline mb-3">
                                <input name="confirm_password" type="password" id="form3Example4" class="form-control form-control-lg border border-2 border-dark rounded-2"
                                    placeholder="Nhập lại mật khẩu" />
                            </div>
                        </div>



                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #DE5499; border-color: #DE5499" id="loginButton">Đăng ký tài khoản mới</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Đã có tài khoản? <a href="login.php"
                                    class="link-danger">Đăng nhập ngay!</a></p>
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
                case 'student': // Học sinh
                    roleImage.src = 'img/student.jpg';
                    roleImage.alt = 'Học sinh';
                    break;
                case 'teacher': // Giáo viên
                    roleImage.src = 'img/teacher.jpg';
                    roleImage.alt = 'Giáo viên';
                    break;
                case 'parent': // Giáo viên
                    roleImage.src = 'img/teacher.jpg';
                    roleImage.alt = 'Giáo viên';
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