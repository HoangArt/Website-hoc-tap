<?php
session_start();
include("../db.php");
require "../sendmails.php";

// Kiểm tra nếu người dùng đã đăng nhập chưa
if (isset($_SESSION['email'])) {
    $_SESSION['message'] = "Bạn đã đăng nhập rồi!";
    header("Location: ../index.php");
    exit();
}

// Hàm kiểm tra email đã tồn tại trong Cơ sở dữ liệu
function checkEmailExists($email)
{
    global $conn;
    $sql_check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql_check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $exists = $stmt->num_rows > 0;

    $stmt->close();
    return $exists;
}

// Hàm điều hướng dựa theo vai trò
function redirectBasedOnRole($role)
{
    if ($role == '1') {
        header("Location: student.php");
    } elseif ($role == '2') {
        header("Location: teacher.php");
    } elseif ($role == '3') {
        header("Location: parent.php");
    } else {
        $_SESSION['message'] = "Vai trò không hợp lệ.";
        header("Location: ../role-select.php");
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'] ?? '';
    $full_name = trim($_POST['full_name'] ?? '');
    $date_of_birth = trim($_POST['date_of_birth'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Khởi tạo thông báo lỗi
    $_SESSION['message'] = null;

    try {
        // Kiểm tra thông tin đầu vào
        if (empty($full_name) || empty($date_of_birth) || empty($email) || empty($password) || empty($confirm_password)) {
            $_SESSION['message'] = "Vui lòng điền đầy đủ thông tin.";
            redirectBasedOnRole($role);
        }

        if ($password !== $confirm_password && checkEmailExists($email)){
            $_SESSION['message'] = "Lỗi khi đăng nhập. Vui lòng thử lại";
            redirectBasedOnRole($role);
        }

        if ($password !== $confirm_password) {
            $_SESSION['message'] = "Mật khẩu không khớp. Vui lòng nhập lại!";
            redirectBasedOnRole($role);
        }

        if (checkEmailExists($email)) {
            $_SESSION['message'] = "Email này đã được đăng ký.";
            $_SESSION['email_error'] = True;
            redirectBasedOnRole($role);
        }

        // Hash password và tạo token xác nhận email
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $confirm_email_token = bin2hex(random_bytes(32));

        // Thêm thông tin người dùng mới vào Cơ sở dữ liệu
        $sql_insert_user = "INSERT INTO users (role_id, full_name, date_of_birth, email, phone_number, password, confirm_email_token) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert_user);
        $stmt->bind_param("sssssss", $role, $full_name, $date_of_birth, $email, $phone_number, $hashed_password, $confirm_email_token);

        if ($stmt->execute()) {
            // Gửi email xác nhận
            $subject = "Xác nhận tài khoản của bạn";
            $body = "Xin chào $full_name,<br><br>";
            $body .= "Vui lòng nhấn vào liên kết sau để xác nhận tài khoản của bạn:<br>";
            $body .= "<a href='http://localhost/Website-hoc-tap/sign-up/confirm-email.php?token=$confirm_email_token'>Click để xác nhận</a>";

            if (sendConfirmationEmail($email, $subject, $body)) {
                header("Location: ../mail-sent-successfully/confirm-email.html");
                exit();
            } else {
                $_SESSION['message'] = "Không thể gửi email xác nhận. Vui lòng thử lại sau.";
                throw new Exception("Email sending failed");
            }
        } else {
            $_SESSION['message'] = "Lỗi: Không thể thêm người dùng vào cơ sở dữ liệu.";
            throw new Exception("Database insertion failed");
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        $_SESSION['message'] = "Lỗi khi đăng ký tài khoản. Vui lòng thử lại!";
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }

    redirectBasedOnRole($role);
}
