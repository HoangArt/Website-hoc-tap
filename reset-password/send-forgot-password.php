<?php
session_start();
include("../db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    $sql = "SELECT full_name FROM users WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            $full_name = $user['full_name'];
        } else {
            $_SESSION['message'] = "Lỗi! Không tìm thấy địa chỉ email trong hệ thống.";
            header("Location: ../forgot-password.php");
            exit;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Lỗi SQL.";
        header("Location: ../forgot-password.php");
        exit;
    }

    $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $token_hash, $expiry, $email);
        $stmt->execute();
        if ($conn->affected_rows) {
            $mail = require __DIR__ . "/../sendmails.php";

            $mail->setFrom('noreply@Herculis.com');
            $mail->addAddress($email);

            $mail->Subject = 'Yêu cầu thay đổi mật khẩu cho tài khoản của bạn';

            $mail->Body = "Xin chào $full_name,<br><br>";
            $mail->Body .= "Chúng tôi nhận được yêu cầu thay đổi mật khẩu cho tài khoản của bạn tại trang web của chúng tôi.<br><br>";
            $mail->Body .= "Để thay đổi mật khẩu của bạn, vui lòng nhấn vào liên kết dưới đây trong vòng 30 phút kể từ khi nhận được email này:<br><br>";
            $mail->Body .= "<a href='http://localhost/Website-hoc-tap/reset-password/reset-password.php?token=$token'>Thay đổi mật khẩu</a><br><br>";
            $mail->Body .= "Nếu bạn gặp khó khăn, vui lòng liên hệ với chúng tôi để được hỗ trợ.<br><br>";
            $mail->Body .= "Nếu bạn không yêu cầu thay đổi mật khẩu, vui lòng bỏ qua email này.<br><br>";
            $mail->Body .= "Trân trọng,<br>";
            $mail->Body .= "Đội ngũ hỗ trợ của Herculis.";

            if ($mail->send()) {
                header("Location: ../mail-sent-successfully/reset-password-message.html");
                exit;
            } else {
                $_SESSION['message'] = "Lỗi! Không gửi được đến địa chỉ email của bạn. Vui lòng thử lại sau ít phút.";
            }
        } else {
            $_SESSION['message'] = "Không thể thay đổi mật khẩu của bạn vui lòng thử lại sau.";
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Lỗi SQL.";
    }

    // Redirect to forgot-password.php with message
    header("Location: ../forgot-password.php");
    exit;
}
