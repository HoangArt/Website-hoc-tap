<?php
session_start();
include("../include/db.php");

// Kiểm tra xem form có được gửi không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form đăng nhập
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Kiểm tra xem các trường có rỗng hay không
    if (empty($email) || empty($password) || empty($role)) {
        $_SESSION['message'] = "<p class='text-center text-danger'>Vui lòng nhập đầy đủ thông tin (vai trò, email và mật khẩu).</p>";
    } else {
        // Truy vấn cơ sở dữ liệu để xác thực thông tin đăng nhập
        $sql = "SELECT u.user_id, u.role_id, u.full_name, u.password, u.date_of_birth, u.phone_number, u.avatar, r.role_name
                FROM users u
                JOIN roles r ON u.role_id = r.id
                WHERE u.email = ? AND r.role_name = ?";

        // Chuẩn bị câu lệnh SQL
        if ($stmt = $conn->prepare($sql)) {
            // Gán giá trị tham số vào câu lệnh SQL
            $stmt->bind_param("ss", $email, $role);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                $stmt->store_result();

                // Nếu có người dùng khớp với thông tin
                if ($stmt->num_rows == 1) {
                    // Liên kết kết quả
                    $stmt->bind_result($user_id, $role_id, $full_name, $hashed_password, $date_of_birth, $phone_number, $avatar, $role_name);
                    $stmt->fetch();

                    // Kiểm tra mật khẩu
                    if (password_verify($password, $hashed_password)) {
                        // Lưu thông tin người dùng vào session
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['email'] = $email;
                        $_SESSION['full_name'] = $full_name;
                        $_SESSION['date_of_birth'] = $date_of_birth;
                        $_SESSION['phone_number'] = $phone_number;
                        $_SESSION['role_name'] = $role_name;
                        $_SESSION['avatar'] = $avatar;
                        $_SESSION['role_id'] = $role_id;

                        // Chuyển hướng đến trang chính
                        header("Location: ../index.php");
                        exit();
                    } else {
                        $_SESSION['message'] = "<p class='text-center text-danger'>Sai thông tin đăng nhập. Vui lòng nhập lại!</p>";
                        header("Location: ../login.php");
                        exit();
                    }
                } else {
                    $_SESSION['message'] = "<p class='text-center text-danger'>Không có người dùng với thông tin này trong hệ thống.</p>";
                    header("Location: ../login.php");
                    exit();
                }
            } else {
                // Nếu câu lệnh không thực thi được
                $_SESSION['message'] = "<p class='text-center text-danger'>Lỗi: " . $stmt->error . "</p>";
                header("Location: ../login.php");
                exit();
            }

            // Đóng kết nối
            $stmt->close();
        } else {
            $_SESSION['message'] = "<p class='text-center text-danger'>Lỗi: Không thể chuẩn bị câu lệnh SQL.</p>";
            header("Location: ../login.php");
            exit();
        }
    }
}

$conn->close();
