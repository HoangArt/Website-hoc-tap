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
    <title>Chọn vai trò của bạn</title>

    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        /* Căn chỉnh giao diện vào giữa */
        body {
            background-color: #f5f5f5;
            /* Nền màu xám nhạt */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .container {
            background: #fff;
            /* Nền trắng cho hộp */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
        }

        .role-card {
            cursor: pointer;
            /* Đổi con trỏ chuột thành bàn tay */
            border: 2px solid transparent;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            color: #333;
            /* Màu chữ mặc định */
        }

        .role-card:hover {
            border-color: #25b1e8;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Khi chọn một lựa chọn */
        .role-card.selected {
            background-color: #25b1e8;
            /* Nền màu xanh */
            color: #fff;
            /* Màu chữ trắng */
        }

        .role-card.selected h5 {
            color: #fff;
            /* Màu chữ tiêu đề */
        }

        .role-card.selected i {
            color: #fff !important;
            /* Thay đổi màu icon khi chọn */
        }

        .btn-custom {
            border-radius: 25px;
            padding: 10px 30px;
        }
    </style>
</head>

<body>
    <div class="container text-center">
        <div id="error-alert" class="alert alert-warning alert-dismissible fade d-none mt-3" role="alert">
            <span id="error-message">Vui lòng chọn vai trò để tiếp tục.</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <h1 class="">Đăng ký tài khoản</h1>
        <p class="mb-5">Lựa chọn vai trò để tiếp tục</p>
        <div class="row justify-content-between align-items-center mb-4">
            <!-- Admin Card -->
            <div class="col-4">
                <div class="role-card p-4 text-center" onclick="selectRole(this)" data-role="student">
                    <div class="mb-3">
                        <i class="fa-solid fa-graduation-cap" style="font-size: 2rem; color: #25b1e8;"></i>
                    </div>
                    <h5>Học sinh</h5>
                </div>
            </div>

            <!-- GIÁO VIÊN -->
            <div class="col-4">
                <div class="role-card p-4 text-center" onclick="selectRole(this)" data-role="teacher">
                    <div class="mb-3">
                        <i class="fa-solid fa-person-chalkboard" style="font-size: 2rem; color: #25b1e8;"></i>
                    </div>
                    <h5>Giáo viên</h5>
                </div>
            </div>

            <!-- PHỤ HUYNH -->
            <div class="col-4">
                <div class="role-card p-4 text-center" onclick="selectRole(this)" data-role="parent">
                    <div class="mb-3">
                        <i class="fa-solid fa-person-breastfeeding" style="font-size: 2rem; color: #25b1e8;"></i>
                    </div>
                    <h5>Phụ huynh</h5>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-5">
            <a href="index.php"><button class="btn btn-secondary btn-custom text-decoration-none">Quay lại</button></a>
            <button class="btn btn-custom text-white" style="background-color: #25b1e8;" onclick="continueAction()">Tiếp
                tục</button>
        </div>
    </div>

    <script>
        // Function to handle role selection
        function selectRole(element) {
            // Remove "selected" class from all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
            });
            // Add "selected" class to the clicked card
            element.classList.add('selected');
        }

        function continueAction() {
            const selectedRole = document.querySelector('.role-card.selected')?.getAttribute('data-role');
            const errorAlert = document.getElementById('error-alert');
            const errorMessage = document.getElementById('error-message');

            if (selectedRole) {
                // Chuyển hướng đến trang tương ứng
                switch (selectedRole) {
                    case 'student':
                        window.location.href = 'sign-up/student.php';
                        break;
                    case 'teacher':
                        window.location.href = 'sign-up/teacher.php';
                        break;
                    case 'parent':
                        window.location.href = 'sign-up/parent.php';
                        break;
                }
            } else {
                // Hiển thị thông báo lỗi bằng Bootstrap Alert
                errorMessage.textContent = "Vui lòng chọn vai trò để tiếp tục.";
                errorAlert.classList.remove('d-none'); // Hiện thông báo
                errorAlert.classList.add('show');
            }
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>