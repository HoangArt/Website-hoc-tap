<?php
session_start();
include("../include/db.php");

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$email = $_SESSION['email'];
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action === 'update') {
    // Kiểm tra nếu có ảnh được tải lên
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatar = $_FILES['avatar'];

        // Kiểm tra định dạng tệp ảnh
        $allowed_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($avatar['type'], $allowed_types)) {
            $_SESSION['message'] = "Chỉ chấp nhận ảnh JPG, JPEG, PNG hoặc GIF.";
            header("location: ../user_settings.php");
            exit();
        }

        // Kiểm tra kích thước tệp (tối đa 800KB)
        if ($avatar['size'] > 800 * 1024) {
            $_SESSION['message'] = "Kích thước tệp không được vượt quá 800KB.";
            header("location: ../user_settings.php");
            exit();
        }

        // Tạo tên tệp mới để tránh trùng lặp
        $file_extension = pathinfo($avatar['name'], PATHINFO_EXTENSION);
        $new_avatar_name = uniqid('avatar_', true) . '.' . $file_extension;
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/OngNho/img/avatar/users/';
        $upload_path = $upload_dir . $new_avatar_name;

        // Di chuyển tệp vào thư mục
        if (move_uploaded_file($avatar['tmp_name'], $upload_path)) {
            // Cập nhật vào cơ sở dữ liệu
            $sql = "UPDATE users SET avatar = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $new_avatar_name, $email);

            if ($stmt->execute()) {
                // Xóa avatar cũ nếu không phải avatar mặc định
                if (!empty($_SESSION['avatar']) && $_SESSION['avatar'] !== 'default-avatar.png') {
                    $old_avatar_path = $upload_dir . $_SESSION['avatar'];
                    if (file_exists($old_avatar_path)) {
                        unlink($old_avatar_path);
                    }
                }

                // Cập nhật thành công, cập nhật lại session
                $_SESSION['avatar'] = $new_avatar_name;
                header("location: ../user_settings.php");
                exit();
            } else {
                $_SESSION['message'] = "Có lỗi xảy ra khi cập nhật avatar.";
                header("location: ../user_settings.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Lỗi khi tải tệp lên.";
            header("location: ../user_settings.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Vui lòng chọn tệp hình ảnh để tải lên.";
        header("location: ../user_settings.php");
        exit();
    }
} elseif ($action === 'delete') {
    // Xử lý khi nhấn nút "Reset"
    $default_avatar = 'default-avatar.png';

    // Cập nhật avatar mặc định trong cơ sở dữ liệu
    $sql = "UPDATE users SET avatar = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $default_avatar, $email);

    if ($stmt->execute()) {
        // Xóa avatar cũ nếu không phải avatar mặc định
        if (!empty($_SESSION['avatar']) && $_SESSION['avatar'] !== $default_avatar) {
            $old_avatar_path = $_SERVER['DOCUMENT_ROOT'] . '/OngNho/img/avatar/users/' . $_SESSION['avatar'];
            if (file_exists($old_avatar_path)) {
                unlink($old_avatar_path);
            }
        }

        // Cập nhật lại session
        $_SESSION['avatar'] = $default_avatar;
        header("Location: ../user_settings.php");
    } else {
        $_SESSION['message'] = "Có lỗi xảy ra khi đặt lại avatar.";
        header("location: ../user_settings.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Hành động không hợp lệ.";
    header("location: ../user_settings.php");
    exit();
}

$conn->close();
