<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = $_ENV['SMTP_HOST'];
$mail->SMTPAuth = true;
$mail->Username = $_ENV['SMTP_USERNAME'];
$mail->Password = $_ENV['SMTP_PASSWORD'];
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = $_ENV['SMTP_PORT'];
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    try {
        $mail->setFrom($email, $full_name);
        $mail->addAddress($_ENV['SMTP_USERNAME']);

        $mail->Subject = $subject;
        $mail->Body    =    "<h2>Thông tin người liên lạc:</h2>
                            <p><strong>Tên:</strong> $full_name</p>
                            <p><strong>Email:</strong> $email</p>
                            <p><strong>Số điện thoại:</strong> $phone</p>
                            
                            <h2>Nội dung:</h2>
                            <p>$message</P>";
        $mail->send();
        header("Location: mail-sent-successfully/contact-us-message.html");
        exit();
    } catch (Exception $e) {
        $errorMessage = "Không thể gửi tin nhắn. Lỗi: {$mail->ErrorInfo}";
    }
}
