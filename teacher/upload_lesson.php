<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SESSION['role_id'] = 1) {
    header("Location: ../index.php");
    exit();
}

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
    $stmt = $conn2->prepare("INSERT INTO lessons (subject_id, age_group, title, description, file_path, lesson_link) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$subject_id, $age_group, $title, $description, $file_path, $lesson_link]);

$conn2->close();
}
?>

<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Tải bài học thành công! | Ong Nhỏ</title>
</head>
<style>
    body {
        text-align: center;
        padding: 40px 0;
        background: #fff9ec;
    }

    h1 {
        color: #88B04B;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-weight: 900;
        font-size: 40px;
        margin-bottom: 10px;
    }

    p {
        color: #404F5E;
        font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
        font-size: 20px;
        margin: 0;
    }

    i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left: -15px;
    }

    .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
    }
</style>

<body>
    <div class="card">
        <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
            <i class="checkmark">✓</i>
        </div>
        <h1>Thành công</h1>
        <p>Bài học đã được tải lên thành công<br /> <a href='http://localhost/OngNho/lesson.php?link=<?= $lesson_link; ?>'>Xem bài học</a></p>
    </div>
</body>

</html>