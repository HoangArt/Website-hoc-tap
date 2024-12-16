<?php
session_start();
include("../db.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $user_id = $_SESSION['user_id'];

    // Kiểm tra nếu để trống
    if (empty($full_name)) {
        $error = "Vui lòng nhập Họ và tên.";
    } elseif ($full_name == $_SESSION['full_name']) {
        // Kiểm tra nếu không thay đổi
        $error = "Vui lòng thay đổi tên của bạn.";
    } else {
        if (empty($user_id)) {
            $error = 'Không tìm thấy ID người dùng';
        } else {
            // Nếu không có lỗi, cập nhật dữ liệu vào CSDL
            $sql = "UPDATE users SET full_name = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);

            // Kiểm tra lỗi câu lệnh SQL
            if ($stmt === false) {
                $error = 'Lỗi chuẩn bị câu lệnh SQL: ' . $conn->error;
            } else {
                $stmt->bind_param("ss", $full_name, $user_id); // Liên kết tham số với câu lệnh SQL

                // Kiểm tra thực thi câu lệnh SQL
                if ($stmt->execute()) {
                    // Cập nhật thành công, lưu lại vào session
                    $_SESSION['full_name'] = $full_name;
                    header("Location: ../user_settings.php");
                    exit;
                } else {
                    $error = 'Cập nhật thất bại, vui lòng thử lại.';
                }
                $stmt->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/logo/Ongnho-icon.png">
    <title>Thay đổi Họ và tên | Ong Nhỏ</title>

    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/css/all.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #f0f0f0">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="index.php" style="background-color: white;"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="../img/logo/Ongnho-logo.png" height="200px">
                    </a>
                </div>
            </div>

            <div class="col py-3">
                <div class="container">
                    <h2 class="mb-4">Thay đổi Họ và tên</h2>

                    <!-- Hiển thị thông báo lỗi -->
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>

                    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="full_name" class="form-control <?= !empty($error) ? 'is-invalid' : ''; ?>"
                                value="<?= htmlspecialchars($_SESSION['full_name']); ?>" required>
                            <div class="invalid-feedback">
                                <?= $error; ?>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        <a href="../user_settings.php" class="btn btn-secondary" role="button">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
