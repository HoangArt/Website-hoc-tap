<?php
session_start();

// Lấy token từ POST
$token = $_POST["token"];
$token_hash = hash("sha256", $token);

// Kết nối database
$conn = require __DIR__ . "../include/db.php";

// Lấy thông tin người dùng dựa trên token
$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Kiểm tra nếu không tìm thấy token
if ($user == null) {
    $_SESSION['message'] = "Không tìm thấy token.";
    header("Location: reset-password.php?token=$token");
    exit();
}

// Kiểm tra xem token đã hết hạn chưa
if (strtotime($user["reset_token_expires_at"]) <= time()) {
    $_SESSION['message'] = "Token đã hết hạn.";
    header("Location: reset-password.php?token=$token");
    exit();
}

// Kiểm tra mật khẩu mới và mật khẩu xác nhận
$new_password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

// Kiểm tra mật khẩu mới có trùng mật khẩu cũ không (dùng thông tin mật khẩu cũ trong data base)
if (password_verify($new_password, $user['password'])) {
    $_SESSION['message'] = "Mật khẩu mới không được trùng mật khẩu cũ.";
    header("Location: reset-password.php?token=$token");
    exit();
}

// Kiểm tra mật khẩu mới không phải là dấu cách
if (trim($new_password) === '') {
    $_SESSION['message'] = "Mật khẩu không thể chỉ là dấu cách.";
    header("Location: reset-password.php?token=$token");
    exit();
}

// Kiểm tra mật khẩu và nhập lại mật khẩu có khớp không
if ($new_password != $confirm_password) {
    $_SESSION['message'] = "Hai mật khẩu không khớp.";
    header("Location: reset-password.php?token=$token");
    exit();
} else {
    // Mã hóa mật khẩu mới
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Cập nhật mật khẩu mới cho người dùng và xóa token
    $sql_update = "UPDATE users SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE reset_token_hash = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ss", $hashed_password, $token_hash);
    $stmt_update->execute();

    // Kiểm tra nếu mật khẩu được cập nhật thành công
    if ($stmt_update->affected_rows > 0) {
        $_SESSION['password_changed'] = true;
        header("Location: ../login.php");
        exit();
    } else {
        $_SESSION['message'] = "Có lỗi xảy ra, vui lòng thử lại.";
        header("Location: reset-password.php?token=$token");
        exit();
    }
}
?>
