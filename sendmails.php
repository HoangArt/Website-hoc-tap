<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

function getMailer() {
    $mail = new PHPMailer(true);

    try {
        // SMTP server thông qua .env file
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST']; 
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USERNAME'];
        $mail->Password   = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'];
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
    } catch (Exception $e) {
        error_log("Không thể khởi động PHPMailer: {$e->getMessage()}");
    }

    return $mail;
}

// Hàm gửi email xác nhận
function sendConfirmationEmail($toEmail, $subject, $body) {
    $mail = getMailer();
    
    try {
        $mail->setFrom($_ENV['SMTP_USERNAME'], 'Ong Nhỏ');
        $mail->addAddress($toEmail);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        
        if ($mail->send()) {
            return true;
        } else {
            error_log("Lỗi khi gửi email: {$mail->ErrorInfo}");
            return false;
        }
    } catch (Exception $e) {
        error_log("Gặp lỗi trong quá trình gửi email: {$e->getMessage()}");
        return false;
    }
}
?>
