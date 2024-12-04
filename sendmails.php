<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php'; // Nếu tải về thủ công
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

try {
    // Cài đặt server
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true; // Bật xác thực SMTP
    $mail->Username = 'hoang0005367@huce.edu.vn';
    $mail->Password = 'dckg jwcn jbrd rknx';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->isHTML(true); // Đặt định dạng HTML cho email
    $mail->CharSet = 'UTF-8';
    
    return $mail;
} catch (Exception $e) {
    echo "Không thể gửi email. Lỗi: {$mail->ErrorInfo}";
}
?>