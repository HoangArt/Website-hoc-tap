<?php
session_start();
include('include/db2.php');

$lesson = null;
if (isset($_GET['link'])) {
    $lesson_link = $_GET['link'];

    // Chuẩn bị câu truy vấn
    $stmt = $conn2->prepare("SELECT * FROM lessons WHERE lesson_link = ?");
    $stmt->bind_param("s", $lesson_link);
    $stmt->execute();

    // Lấy kết quả
    $result = $stmt->get_result();
    $lesson = $result->fetch_assoc();
    $stmt->close();
}

$file_path = htmlspecialchars($lesson['file_path']);
$document_root = $_SERVER['DOCUMENT_ROOT']; 
$file_url = "http://localhost/" . substr($file_path, strlen($document_root));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title><?= htmlspecialchars($lesson['tittle']); ?> | Ong Nhỏ</title>
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="http://localhost/OngNho/css/index.css " rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">

    <style>
        .lesson-container {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background: #f0f0f0;
        }

        .lesson-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .lesson-description {
            margin-top: 10px;
            color: #555;
        }

        .viewer {
            margin-top: 20px;
        }

        iframe {
            width: 100%;
            height: 500px;
            border: none;
        }

        .image-viewer img {
            max-width: 100%;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>

<body style="background-color: #fff9ec;">
    <!-- HEADER -->
    <?php include('include/header.php') ?>

    <!-- NỘI DUNG -->
    <div class="container" style="padding-top: 200px; padding-bottom: 200px;">
        <div class="lesson-container">
            <a href="search.php">Quay lại</a>
            <?php if ($lesson): ?>
                <h1 class="lesson-title"><?= htmlspecialchars($lesson['tittle']) ?></h1>
                <p class="lesson-description"><?= nl2br(htmlspecialchars($lesson['description'])) ?></p>

                <div class="viewer">
                    <?php
                    $file_path = htmlspecialchars($lesson['file_path']);
                    $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

                    if ($file_extension === 'pdf'): ?>
                        <!-- PDF Viewer -->
                        <iframe src="<?= $file_url; ?>" width="100%" height="1000px" allowfullscreen></iframe>
                    
                    <?php elseif (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                        <!-- Image Viewer -->
                        <div class="image-viewer">
                            <img src="<?= $file_path ?>" alt="Hình ảnh bài tập">
                        </div>
                    <?php else: ?>
                        <!-- Unsupported file -->
                        <p>Định dạng file không được hỗ trợ. Vui lòng <a href="<?= $file_path ?>" download>Tải xuống</a> để xem.</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p class="text-danger">Bài học không tồn tại hoặc đường dẫn không hợp lệ.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FOOTER -->
    <?php include('include/footer.php'); ?>

    <script src="js/hello.js"></script>
</body>

</html>