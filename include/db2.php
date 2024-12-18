<?php
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "courses";

// Kết nối tới cơ sở dữ liệu
$conn2 = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn2->connect_error) {
    die("Kết nối thất bại: " . $conn2->connect_error);
}

return $conn2;
?>