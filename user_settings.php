<?php
session_start();
include("include/db.php");

// Thông báo tình trạng email xác nhận
$email = $_SESSION['email'];

$sql = "SELECT is_verified FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($is_verified); // Liên kết kết quả truy vấn vào biến
    $stmt->fetch(); // Lấy giá trị của cột is_verified
} else {
    echo "Lỗi! Không tìm thấy người dùng với email này.";
    $is_verified = null; // Nếu không tìm thấy, gán $is_verified = null
}

if ($is_verified === 0) {
    $email_sent_status = isset($_SESSION['email_sent_status']) ? $_SESSION['email_sent_status'] : 0;
    if ($is_verified === 1) {
        $_SESSION['email_sent_status'] = 1;
        unset($_SESSION['email_sent_status']);
    }
}

$user_avatar_url = isset($_SESSION['avatar'])
    ? "http://localhost/OngNho/img/avatar/users/" . $_SESSION['avatar']
    : "http://localhost/OngNho/img/avatar/default-avatar.png";

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Cài đặt tài khoản | Ong Nhỏ</title>

    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <style>
        /* Root Variables */
        :root {
            --primary-color: #ffc107;
            /* Vàng */
            --secondary-color: #6c757d;
            --background-color: #fff7e6;
            --text-color: #212529;
            --hover-color: #e0a800;
            /* Màu vàng đậm hơn khi hover */
            --border-radius: 12px;
            --shadow-light: 0 4px 8px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 6px 15px rgba(0, 0, 0, 0.15);
            --transition-speed: 0.3s;
        }

        /* Global Styles */
        * {
            box-sizing: border-box;
            transition: all var(--transition-speed) ease;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Sidebar */
        .col-md-3 {
            background: linear-gradient(135deg, #ffffff 0%, #fff9e6 100%);
            box-shadow: var(--shadow-light);
            border-right: 1px solid #f3d9a4;
            padding: 30px;
            border-radius: var(--border-radius);
        }

        .nav-pills .nav-link {
            color: var(--secondary-color);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            position: relative;
            background-color: white;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            justify-content: center;
        }

        .nav-pills .nav-link i {
            margin-right: 20px;
            display: flex;
            align-content: center;
            justify-content: center;
            text-align: center;
            padding: 10px 20px;
            gap: 8px;
            transition: transform var(--transition-speed) ease;
        }

        .nav-pills .nav-link:hover {
            background-color: var(--hover-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            box-shadow: var(--shadow-medium);
        }

        /* Avatar */
        .ui-w-80 {
            width: 80px !important;
            height: 80px !important;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--primary-color);
            box-shadow: var(--shadow-light);
        }

        .ui-w-80:hover {
            transform: scale(1.1) rotate(3deg);
            box-shadow: var(--shadow-medium);
        }

        /* Account Info */
        .account-info {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-medium);
            padding: 25px;
            overflow: hidden;
        }

        .account-info .row {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ffe8a1;
            transition: all var(--transition-speed) ease;
        }

        .account-info .row:hover {
            background-color: rgba(255, 193, 7, 0.05);
            transform: translateX(5px);
        }

        .account-info .row:last-child {
            border-bottom: none;
        }

        .row-label {
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .row-label i {
            margin-right: 10px;
            transition: transform var(--transition-speed) ease;
        }

        .row-label i:hover {
            transform: scale(1.2);
        }

        /* Buttons */
        .btn-update {
            color: var(--primary-color);
            text-decoration: none;
            background: rgba(255, 193, 7, 0.1);
            padding: 10px 15px;
            /* Điều chỉnh để nút vừa chữ */
            border-radius: var(--border-radius);
            display: inline-block;
            transition: all var(--transition-speed) ease;
        }

        .btn-update:hover {
            background: var(--hover-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 12px 24px;
            /* Điều chỉnh để nút vừa chữ */
            border-radius: var(--border-radius);
            transition: all var(--transition-speed) ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            color: white;
            padding: 12px 24px;
            border-radius: var(--border-radius);
            transition: all var(--transition-speed) ease;
        }

        .btn-primary:hover {
            background-color: var(--hover-color);
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
        }

        /* Alerts */
        .alert {
            border-radius: var(--border-radius);
            padding: 15px;
            position: relative;
            box-shadow: var(--shadow-light);
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 5px solid #ffc107;
        }

        .alert-success {
            background-color: rgba(25, 135, 84, 0.1);
            border-left: 5px solid #198754;
        }

        /* Form Controls */
        .form-control {
            border-radius: var(--border-radius);
            border: 1px solid #ced4da;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .account-info .row {
                flex-direction: column;
                align-items: flex-start;
            }

            .row-label {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #f0f0f0">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="index.php" style="background-color: white;"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="img/logo/Ongnho-logo.png" height="200px">
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <!-- THÔNG TIN CHUNG -->
                        <li class="nav-item">
                            <a href="#account-general" data-bs-toggle="tab" class="nav-link align-middle px-0 active">
                                <i class="fs-4 bi-person-circle"></i> <span class="ms-1 d-none d-sm-inline">Thông tin chung</span>
                            </a>
                        </li>

                        <!-- THAY ĐỔI MẬT KHẨU-->
                        <li>
                            <a href="#account-change-password" data-bs-toggle="tab" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-lock fa-2x"></i> <span class="ms-1 d-none d-sm-inline">Mật khẩu</span></a>
                        </li>

                    </ul>
                    <hr>
                </div>
            </div>


            <div class="col py-3">
                <!-- NỘI DUNG BÊN PHẢI-->
                <div class="tab-content">
                    <!-- THÔNG TIN CHUNG -->
                    <div class="tab-pane fade show active" id="account-general">
                        <div class="" style="margin-left: 100px; margin-right: 100px; margin-top: 20px; margin-bottom: 20px">
                            <?php if ($is_verified === 0): ?>
                                <?php if ($email_sent_status === 0): ?>
                                    <div class="alert alert-warning" role="alert">
                                        Bạn chưa xác nhận tài khoản.
                                        Do đó, bạn sẽ không thể chỉnh sửa thông tin tài khoản.
                                        Vui lòng xác nhận tài khoản để có thể chỉnh sửa thông tin của bạn!
                                        <a href="sign-up/confirm-email-again.php">Gửi lại thư xác nhận</a>
                                    </div>
                                <?php elseif ($email_sent_status === 2): ?>
                                    <div class="alert alert-success" role="alert">
                                        Email xác nhận tài khoản đã được gửi thành công. Vui lòng kiểm tra hộp thư.<br>
                                        Nếu không tìm thấy email, hãy kiểm tra thư mục **Spam** hoặc đợi một vài phút trước khi thử lại.
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <h2>Cài đặt tài khoản</h2>
                        </div>


                        <div style="margin-left: 100px; margin-right: 100px; margin-top: 40px">
                            <div class="card-body d-flex flex-column flex-sm-row align-items-center">
                                <img src="<?= htmlspecialchars($user_avatar_url); ?>" alt="Avatar" class="ui-w-80 img-fluid mb-3 mb-sm-0">
                                <div class="ms-sm-4">
                                    <form action="change_user_information/avatar.php" method="post" enctype="multipart/form-data">
                                        <label class="btn btn-outline-primary">
                                            Tải hình ảnh mới
                                            <input type="file" name="avatar" class="account-settings-fileinput" accept="image/jpg, image/jpeg, image/png, image/gif">
                                        </label>
                                        <button type="submit" name="action" value="update" class="btn btn-primary">Cập nhật ảnh</button>
                                        <?php if (htmlspecialchars($user_avatar_url) != "http://localhost/OngNho/img/avatar/users/default-avatar.png"): ?>
                                            <button type="submit" name="action" value="delete" class="btn btn-secondary">Chọn ảnh mặc định</button>
                                        <?php endif; ?>
                                    </form>
                                    <div class="text-muted small mt-1">Cho phép định dạng JPG, GIF, hoặc PNG. Max size of 800KB.</div>
                                </div>
                            </div>


                            <hr>

                            <div class="card-body">
                                <div>
                                    <h4>Thông tin tài khoản</h4>
                                </div>
                                <div class="account-info">
                                    <!-- HỌ VÀ TÊN -->
                                    <div class="row align-items-center">
                                        <div class="col-4 row-label">
                                            <i class="fa-solid fa-user"></i> Họ và tên:
                                        </div>

                                        <div class="col-6">
                                            <?= htmlspecialchars($_SESSION['full_name']); ?>
                                        </div>

                                        <?php if ($is_verified === 0): ?>
                                            <div class="col-2 text-end">
                                                <a data-bs-toggle="tooltip" style="color: black; text-decoration: none;"
                                                    data-bs-placement="top" title="Vui lòng xác nhận tài khoản để chỉnh sửa Họ và tên">Cập nhật</a>
                                            </div>
                                        <?php elseif ($is_verified === 1): ?>
                                            <div class="col-2 text-end">
                                                <a href="change_user_information/full_name.php" class="btn-update">Cập nhật</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- NGÀY SINH -->
                                    <div class="row align-items-center">
                                        <div class="col-4 row-label">
                                            <i class="fa-solid fa-cake-candles"></i> Ngày sinh:
                                        </div>

                                        <div class="col-6">
                                            <?php
                                            if ($_SESSION['date_of_birth']) {
                                                $date = DateTime::createFromFormat('Y-m-d', $_SESSION['date_of_birth']);
                                                $formatted_date = $date->format('d/m/Y');
                                            } else {
                                                $formatted_date = "Chưa có ngày sinh";
                                            }
                                            echo htmlspecialchars($formatted_date);
                                            ?>
                                        </div>

                                        <?php if ($is_verified === 0): ?>
                                            <div class="col-2 text-end">
                                                <a data-bs-toggle="tooltip" style="color: black; text-decoration: none;"
                                                    data-bs-placement="top" title="Vui lòng xác nhận tài khoản để chỉnh sửa Họ và tên">Cập nhật</a>
                                            </div>
                                        <?php elseif ($is_verified === 1): ?>
                                            <div class="col-2 text-end">
                                                <a href="change_user_information/date_of_birth.php" class="btn-update">Cập nhật</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>


                                    <!-- SỐ ĐIỆN THOẠI -->
                                    <div class="row align-items-center">
                                        <div class="col-4 row-label"><i class="fa-solid fa-phone"></i> Số điện thoại</div>
                                        <div class="col-6">
                                            <?php if ($_SESSION['phone_number'] == NULL): ?>
                                                <div class="text-danger">Chưa có số điện thoại</div>

                                            <?php else: ?>
                                                <?= htmlspecialchars($_SESSION['phone_number']); ?>
                                            <?php endif; ?>
                                        </div>

                                        <?php if ($is_verified === 0): ?>
                                            <div class="col-2 text-end">
                                                <a data-bs-toggle="tooltip" style="color: black; text-decoration: none;"
                                                    data-bs-placement="top" title="Vui lòng xác nhận tài khoản để chỉnh sửa Họ và tên">Cập nhật</a>
                                            </div>
                                        <?php elseif ($is_verified === 1): ?>
                                            <div class="col-2 text-end">
                                                <a href="change_user_information/phone_number.php" class="btn-update">Cập nhật</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>


                                    <!-- EMAIL -->
                                    <div class="row align-items-center">
                                        <div class="col-4 row-label"><i class="fa-solid fa-envelope"></i> Email</div>
                                        <div class="col-6">
                                            <?= htmlspecialchars($_SESSION['email']); ?>
                                        </div>

                                        <?php if ($is_verified === 0): ?>
                                            <div class="col-2 text-end">
                                                <a href="sign-up/confirm-email-again.php" class="btn btn-danger"
                                                    role="button">Xác minh</a>
                                            </div>

                                            <div class="alert alert-warning mt-2">
                                                Email của bạn chưa được xác nhận!
                                            </div>
                                        <?php else: ?>
                                            <div class="col-2 text-end">
                                                <a href="change_user_information/email.php" class="btn-update">Cập nhật</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- XÓA TÀI KHOẢN -->
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <a href="change_user_information/delete.php" type="button" class="btn btn-danger">Xóa tài khoản</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MẬT KHẨU -->
                    <div class="tab-pane fade" id="account-change-password">
                        <div class="card-body" style="margin-left: 100px; margin-right: 100px; margin-top: 20px; margin-bottom: 20px">
                            <div>
                                <?php if ($is_verified === 0): ?>
                                    <?php if ($email_sent_status === 0): ?>
                                        <div class="alert alert-warning" role="alert">
                                            Bạn chưa xác nhận tài khoản.
                                            Do đó, bạn sẽ không thể chỉnh sửa thông tin tài khoản.
                                            Vui lòng xác nhận tài khoản để có thể chỉnh sửa thông tin của bạn!
                                            <a href="sign-up/confirm-email-again.php">Gửi lại thư xác nhận</a>
                                        </div>
                                    <?php elseif ($email_sent_status === 2): ?>
                                        <div class="alert alert-success" role="alert">
                                            Email xác nhận tài khoản đã được gửi thành công. Vui lòng kiểm tra hộp thư.<br>
                                            Nếu không tìm thấy email, hãy kiểm tra thư mục **Spam** hoặc đợi một vài phút trước khi thử lại.
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <h2>Thay đổi mật khẩu</h2>
                            </div>
                                <?php if ($is_verified === 0): ?>
                                    <p class="text-danger">
                                        Vui lòng xác nhận tài khoản để thay đổi mật khẩu.</a>
                                    </p>
                                <?php else: ?>
                                    <p class="text-danger">
                                        Nếu bạn quên mật khẩu của mình, vui lòng nhấn <a href="forgot-password.php">vào đây</a>
                                    </p>
                                <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>