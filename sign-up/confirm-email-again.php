<?php
session_start();
include("../include/db.php");
require "../sendmails.php";

// Tạo confirm_email_token mới và gửi cho người dùng
$email = $_SESSION['email'];
$full_name = $_SESSION['full_name'];
$confirm_email_token = bin2hex(random_bytes(32));

$sql_insert_user = "UPDATE users 
                    SET confirm_email_token = ?
                    WHERE email = ?";
$stmt = $conn->prepare($sql_insert_user);
$stmt->bind_param("ss", $confirm_email_token, $email);

if ($stmt->execute()) {
    // Gửi email xác nhận
    $subject = "Xác nhận tài khoản của bạn";
    $body = "Xin chào $full_name,<br><br>";
    $body .= "Vui lòng nhấn vào liên kết sau để xác nhận tài khoản của bạn:<br>";
    $body .= "<a href='http://localhost/OngNho/sign-up/confirm-email.php?token=$confirm_email_token'>Click để xác nhận</a>";

    if (sendConfirmationEmail($email, $subject, $body)) {
        $_SESSION['email_sent_status'] = 2;

        header("Location: ../user_settings.php");
        exit();
    } else {
        $_SESSION['message'] = "Không thể gửi email xác nhận. Vui lòng thử lại sau.";
        throw new Exception("Email sending failed");
    }
} else {
    $_SESSION['message'] = "Lỗi: Không thể thêm người dùng vào cơ sở dữ liệu.";
    throw new Exception("Database insertion failed");
}
?>