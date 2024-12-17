<?php
session_start();
include("db.php");

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

$user_avatar_url = isset($_SESSION['avatar']) ? "../uploads/avatars/" . $_SESSION['avatar'] : "../img/avatar/default-avatar.png";

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
        .ui-w-80 {
            width: 80px !important;
            height: auto;
        }

        .account-info .row {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .account-info .row:last-child {
            border-bottom: none;
        }

        .row-label {
            font-weight: bold;
            color: #555;
        }

        .btn-update {
            color: #007bff;
            text-decoration: none;
        }

        .btn-update:hover {
            text-decoration: underline;
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

                        <!-- BẢO MẬT -->
                        <li>
                            <a href="#account-security" data-bs-toggle="tab" class="nav-link px-0 align-middle">
                                <i class="fa-solid fa-shield-halved fa-2x"></i> <span class="ms-1 d-none d-sm-inline">Bảo mật</span> </a>
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
                                    <form action="change_user_information/update_profile.php" method="post" enctype="multipart/form-data">
                                        <label class="btn btn-outline-primary">
                                            Tải hình ảnh mới
                                            <input type="file" name="avatar" class="account-settings-fileinput" accept="image/jpg, image/jpeg, image/png, image/gif">
                                        </label>
                                        <button type="submit" class="btn btn-primary">Cập nhật ảnh</button>
                                    </form>
                                    <button type="button" class="btn btn-default" onclick="resetAvatar()">Reset</button>
                                    <div class="text-muted small mt-1">Cho phép định dạng JPG, GIF, hoặc PNG. Max size of 800KB.</div>
                                </div>
                            </div>

                            <script>
                                // Hàm reset avatar (nếu cần)
                                function resetAvatar() {
                                    // Cài đặt lại hình ảnh mặc định hoặc yêu cầu người dùng tải lại hình ảnh gốc
                                    // Bạn có thể sử dụng logic này để hiển thị ảnh mặc định hoặc gửi yêu cầu đến server
                                }
                            </script>

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

                            <form method="post" action="change_user_information/change_password.php">
                                <div class="mb-3">
                                    <label class="form-label">Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control"
                                        <?= ($is_verified == 0) ? 'readonly' : ''; ?>
                                        style="background-color: <?= ($is_verified == 0) ? '#f0f0f0' : 'white'; ?>"
                                        value="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mật khẩu mới</label>
                                    <input type="password" class="form-control"
                                        <?= ($is_verified == 0) ? 'readonly' : ''; ?>
                                        style="background-color: <?= ($is_verified == 0) ? '#f0f0f0' : 'white'; ?>"
                                        value="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nhập lại mật khẩu mới</label>
                                    <input type="password" class="form-control"
                                        <?= ($is_verified == 0) ? 'readonly' : ''; ?>
                                        style="background-color: <?= ($is_verified == 0) ? '#f0f0f0' : 'white'; ?>"
                                        value="">
                                </div>

                                <?php if ($is_verified === 0): ?>
                                <?php else: ?>
                                    <p class="text-danger">
                                        Nếu bạn quên mật khẩu của mình, vui lòng nhấn <a href="forgot-password.php">vào đây</a>
                                    </p>
                                <?php endif; ?>
                                <button type="button" class="btn btn-primary">Lưu thay đổi</button>
                            </form>
                        </div>
                    </div>

                    <!-- BẢO MẬT -->
                    <div class="tab-pane fade" id="account-security">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Facebook</label>
                                <input type="text" class="form-control" value="https://facebook.com/username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Twitter</label>
                                <input type="text" class="form-control" value="https://twitter.com/username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">LinkedIn</label>
                                <input type="text" class="form-control" value="https://linkedin.com/in/username">
                            </div>
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