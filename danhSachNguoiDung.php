<?php
// Kết nối cơ sở dữ liệu
include("http://localhost/OngNho/db.php");

// Truy vấn để lấy danh sách người dùng
$sql = "SELECT u.id, u.full_name, u.date_of_birth, u.email, r.role_name FROM users u JOIN roles r ON u.role_id = r.id";
$result = $conn->query($sql);

// Kiểm tra xem có kết quả không
if ($result->num_rows > 0) {
    // Bắt đầu bảng
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Họ và Tên</th>
                <th>Ngày Sinh</th>
                <th>Thông Tin Liên Hệ</th>
                <th>Vai Trò</th>
            </tr>";
    
    // Lặp qua kết quả và hiển thị mỗi người dùng
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["full_name"] . "</td>
                <td>" . $row["date_of_birth"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>" . $row["role_name"] . "</td>
              </tr>";
    }
    
    // Kết thúc bảng
    echo "</table>";
} else {
    echo "Không có người dùng nào trong cơ sở dữ liệu.";
}

// Đóng kết nối
$conn->close();
?>
