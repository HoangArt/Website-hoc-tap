<?php
session_start();

// Kiểm tra nếu người dùng đã đăng nhập chưa
if (isset($_SESSION['email'])) {
    $_SESSION['message'] = "Bạn đã đăng nhập rồi!";
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi thành công | Herculis</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/"> <!-- Tạo icon -->
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .mail-seccess {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background: #f4f4f4;
        }

        .container {
            text-align: center;
            background: #fff;
            border-top: 1px solid #eee;
            padding: 40px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .success-inner h1 {
            font-size: 80px;
            text-shadow: 3px 5px 2px #3333;
            color: #25b1e8;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .success-inner h1 span {
            display: block;
            font-size: 24px;
            color: #333;
            font-weight: 600;
            text-shadow: none;
            margin-top: 10px;
        }

        .success-inner p {
            font-size: 18px;
            padding: 20px 15px;
            text-align: center;
        }

        .success-inner .btn {
            color: #fff;
            background-color: #25b1e8;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .success-inner .btn:hover {
            background-color: #1a91c3;
        }

        .success-inner .btn:active {
            background-color: #187a9b;
            color: white;
        }

        footer {
            background-color: #25b1e8;
            text-align: center;
            color: white;
            padding: 10px 0;
            width: 100%;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .success-inner p {
                white-space: normal;
            }
        }
    </style>
</head>

<body>
    <section class="mail-seccess section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <div class="success-inner">
                        <h1><i class="bi bi-check-circle"></i><span>Xác nhận tài khoản thành công!</span>
                        </h1>
                        <p>
                            Bây giờ bạn đã có thể đăng nhập và khám phá những khả năng vô hạn cùng Herculis.
                        </p>
                        <a href="../login.php" class="btn btn-lg">Đăng nhập tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center text-lg-start text-white" id="footer">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: #25b1e8">
            &copy; 2024 Copyright Herculis.
        </div>
    </footer>
</body>

</html>