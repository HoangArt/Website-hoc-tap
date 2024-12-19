<?php
session_start();
include('../include/db.php');

$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM users WHERE user_id = '$user_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../logout.php");
    exit();
} else {
    echo "Lỗi: " . $conn->error;
}

$conn2->close();
?>