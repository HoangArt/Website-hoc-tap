<?php
session_start();
include("http://localhost/OngNho/db.php");

$error = "";
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $avatar_dir = "../uploads/avatars/"; // Thư mục lưu trữ ảnh đại diện
    $max_size = 1000 * 1024; // Giới hạn dung lượng 1000KB

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $file = $_FILES['avatar'];
        $file_name = basename($file['name']);
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Kiểm tra loại tệp
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_type, $allowed_types)) {
            $error = "Chỉ cho phép tải lên ảnh định dạng JPG, PNG, hoặc GIF.";
        } elseif ($file_size > $max_size) {
            $error = "Ảnh quá lớn. Vui lòng chọn ảnh dưới 800KB.";
        } else {
            // Tạo tên file duy nhất
            $new_file_name = "avatar_" . $user_id . "." . $file_type;
            $target_path = $avatar_dir . $new_file_name;

            // Di chuyển file từ thư mục tạm vào thư mục đích
            if (move_uploaded_file($file_tmp, $target_path)) {
                // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
                $update_sql = "UPDATE users SET avatar = ? WHERE user_id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $new_file_name, $user_id);

                if ($stmt->execute()) {
                    // Cập nhật thành công
                    $success_message = "Ảnh đại diện đã được cập nhật thành công!";
                    $_SESSION['avatar'] = $new_file_name; // Cập nhật avatar trong session
                } else {
                    $error = "Lỗi cập nhật avatar trong cơ sở dữ liệu.";
                }

                $stmt->close();
            } else {
                $error = "Lỗi tải lên ảnh. Vui lòng thử lại.";
            }
        }
    } else {
        $error = "Vui lòng chọn ảnh để tải lên.";
    }
}

// Lấy đường dẫn ảnh hiện tại của người dùng (nếu có)

?>
