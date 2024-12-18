<?php
require '../include/db2.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = $_POST['subject_id'];
    $age_group = $_POST['age_group'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Xử lý file upload
    $file_path = '';
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/OngNho/img/uploads/';
        $file_name = basename($_FILES['file']['name']);
        $file_path = $upload_dir . time() . "_" . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    }

    // Tạo link bài học
    $lesson_link = uniqid('lesson_');

    // Lưu vào cơ sở dữ liệu
    $stmt = $conn2->prepare("INSERT INTO lessons (subject_id, age_group, tittle, description, file_path, lesson_link) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$subject_id, $age_group, $title, $description, $file_path, $lesson_link]);

    echo "Bài học đã được tạo với link: <a href='http://localhost/OngNho/lesson.php?link=$lesson_link'>Xem bài học</a>";
}
?>