<?php
include('http://localhost/OngNho/db2.php');

// Lấy dữ liệu từ yêu cầu AJAX
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);

// Nếu không có checkbox nào được chọn, trả về tất cả sản phẩm
$whereClause = '';
if (!empty($data['subjects'])) {
    $subjectIds = implode(',', array_map('intval', $data['subjects']));
    $whereClause .= " AND subject_id IN ($subjectIds)";
}

if (!empty($data['ages'])) {
    $ageValues = implode(',', array_map('intval', $data['ages']));
    $whereClause .= " AND age IN ($ageValues)";
}

// Truy vấn cơ sở dữ liệu
$sql = "SELECT * FROM products WHERE 1 $whereClause";
$result = $conn2->query($sql);

// Trả về dữ liệu JSON
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($products);
?>