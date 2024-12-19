<?php
session_start();
$token = $_GET["token"];
$token_hash = hash("sha256", $token);

// Kết nối database
$conn = require __DIR__ . "/../include/db.php";

// Lấy thông tin người dùng dựa trên token
$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Kiểm tra nếu không tìm thấy token
if ($user == null) {
    die("Không tìm thấy token.");
}

// Kiểm tra xem token đã hết hạn chưa
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token đã hết hạn.");
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Tạo mật khẩu mới | Ong Nhỏ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <section class="d-flex align-items-center min-vh-100 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-3">
                                <a href="#!">
                                    <img src="../img/Herculis_logo.png" alt="Herculis Logo" width="175" height="57">
                                </a>
                            </div>
                            <h2 class="fs-6 fw-normal text-center mb-4">
                                Vui lòng điền mật khẩu mới của bạn.
                            </h2>

                            <!-- Hiển thị thông báo lỗi hoặc thành công -->
                            <?php if (isset($_SESSION['message'])): ?>
                                <script type="text/javascript">
                                    alert("<?php echo $_SESSION['message']; ?>");
                                </script>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif; ?>

                            <form method="post" action="process-reset-password.php">
                                <!-- Thêm token hidden để gửi trong form -->
                                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="" required>
                                            <label for="password" class="form-label">Mật khẩu</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="" required>
                                            <label for="confirm_password" class="form-label">Nhập lại mật khẩu</label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-lg text-white" style="background-color: #25b1e8" type="submit">Tạo mật khẩu mới</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
