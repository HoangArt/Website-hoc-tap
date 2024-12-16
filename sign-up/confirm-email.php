<?php
session_start();
include("../db.php");

if (isset($_GET['token'])) {
    $confirm_email_token = $_GET['token'];

    // Kiểm tra token hợp lệ
    $stmt = $conn->prepare("SELECT * FROM users WHERE confirm_email_token = ?");
    $stmt->bind_param("s", $confirm_email_token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($user['is_verified'] == 0) {
            // Xác nhận tài khoản
            $stmt = $conn->prepare("UPDATE users SET is_verified = 1, confirm_email_token = NULL WHERE confirm_email_token = ?");
            $stmt->bind_param("s", $confirm_email_token);
            $stmt->execute();

            // Giao diện xác nhận thành công
            $_SESSION['email_sent_status'] = 1;
            header("Location: ../sign-up/confirm-account-successful.php");
            exit();
        } else {
            echo "<p class='text-center text-warning'>Email này đã được xác nhận trước đó. Vui lòng <a href='../login.php'>đăng nhập</a>.</p>";
        }
    } else {
        echo "<p class='text-center text-danger'>Token không hợp lệ hoặc đã hết hạn. Vui lòng thử lại.</p>";
    }
} else {
    echo "<p class='text-center text-danger'>Không có token xác nhận được cung cấp.</p>";
}

$conn->close();
