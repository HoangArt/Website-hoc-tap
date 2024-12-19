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
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải bài tập | Ong Nhỏ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="http://localhost/OngNho/css/about-us.css " rel="stylesheet">

    <link rel="stylesheet" href="http://localhost/OngNho/fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="http://localhost/OngNho/img/logo/Ongnho-icon.png">
</head>

<body style="background-color: #FFF9EC;">
    <!-- FORM LIÊN LẠC -->
    <section class="py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card rounded shadow-sm overflow-hidden">
                        <div class="card-body p-0">
                            <div class="row gy-3 gy-md-4 gy-lg-0">

                                <!-- LINH TINH BÊN TRÁI -->
                                <div class="col-12 col-lg-6 bsb-overlay background-position-center background-size-cover">
                                    <div class="row align-items-lg-center justify-content-center h-100">
                                        <div class="col-11 col-xl-10">
                                            <div class="contact-info-wrapper py-4 py-xl-5">
                                                <h2 class="h1 mb-3">Tải bài tập</h2>
                                                <p class="lead fs-5 mb-4 mb-xxl-5">
                                                    Đây là giao diện để giúp giáo viên đăng bài tập lên. Theo CEO của Ong Nhỏ, đây là phần "xương sống"
                                                    do trang web này hoạt động bằng những bài giảng, kiến thức của giáo viên khắp nơi.<br>
                                                    Do tính chất quan trọng đó, sau đây là một số nguyên tắc khi đăng bài bài tập:<br>
                                                    - Đảm bảo nội dung chính xác nhất có thể:
                                                    Ong Nhỏ chúng em luôn luôn tự hào là một trong những dịch vụ dạy học
                                                    hàng đầu Việt Nam với đội ngũ giáo viên chất lượng và uy tín cùng nội dung phong phú sinh động. Do đó, bọn em
                                                    mong muốn rằng nội dung trên Ong Nhỏ là luôn được cập nhật và chuẩn xác nhất có thể.</span><br>

                                                    - Không sao chép nội dung từ nơi khác: Nội dung bài học trên Ong Nhỏ là độc quyền nhằm đem đến trai nghiệm thú vị và
                                                    hấp dẫn cho những bạn học.<br>

                                                    - Đừng giao quá nhiều bài tập cho học sinh: Các bạn ấy còn nhỏ, chưa được trải nghiệm nhiều thế giới xung quanh
                                                    và bài tập chính là một trong những yếu tố chính ngăn cản các bạn ấy khám phá về bản thân mình. Ngoài ra, các bạn ấy
                                                    còn học nhiều môn khác chứ không riêng gì mỗi môn của thầy/ cô nên các bạn ấy cần thời gian để chơi.
                                                </p>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- NỘI DUNG BÊN PHẢI -->
                                <div class="col-12 col-lg-6">
                                    <div class="row align-items-lg-center h-100">
                                        <div class="col-12">
                                            <form method="post" action="upload_lesson.php" enctype="multipart/form-data">
                                                <div class="row gy-3 p-4 p-xl-5">
                                                    <div class="mb-4">
                                                        <a href="../index.php">
                                                            <span class="hero-badge py-1 px-3 mb-3 text-white d-inline-block shadow text-uppercase rounded-pill"
                                                                style="background-color: #ffb700;">
                                                                &larr; Quay về trang chủ
                                                            </span>
                                                        </a>
                                                    </div>

                                                    <!-- TẢI FILE -->
                                                    <div class="col-12">
                                                        <label for="file" class="form-label">Tải bài tập <span class="text-danger">*</span></label>
                                                        <input type="file" class="form-control" id="file" name="file" required>
                                                    </div>

                                                    <!-- MÔN HỌC -->
                                                    <div class="col-12">
                                                        <label for="subject_id" class="form-label">Môn học <span class="text-danger">*</span></label>
                                                        <select class="form-select" aria-label="Default select example" name="subject_id" id="subject_id" required>
                                                            <option value="1">Toán học</option>
                                                            <option value="2">Tiếng Việt</option>
                                                            <option value="3">Tiếng Anh</option>
                                                            <option value="4">Khoa học</option>
                                                            <option value="5">Xã hội</option>
                                                            <option value="6">Năng khiếu</option>
                                                        </select>
                                                    </div>

                                                    <!-- NHÓM TUỔI -->
                                                    <div class="col-12">
                                                        <label for="age_group" class="form-label">Nhóm tuổi: <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="age_group" id="age_group" placeholder="Ví dụ: 6 tuổi (Lớp 1)" required>
                                                    </div>

                                                    <!-- TIÊU ĐỀ -->
                                                    <div class="col-12">
                                                        <label for="title" class="form-label">Tiêu đề bài tập <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="title" name="title" required>
                                                    </div>

                                                    <!-- MÔ TẢ -->
                                                    <div class="col-12">
                                                        <label for="description" class="form-label">Mô tả bài tập <span class="text-danger">*</span></label>
                                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                                    </div>

                                                    <!-- NÚT GỬI -->
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-lg" type="submit" style="background-color: #feca73;">Tải bài tập</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('fileInput');
            const file = fileInput.files[0];

            // Kiểm tra kích thước file
            const maxFileSize = 10 * 1024 * 1024; // 10MB
            if (file.size > maxFileSize) {
                alert('Tệp tải lên quá lớn. Vui lòng chọn tệp nhỏ hơn 10MB.');
                e.preventDefault();
                return;
            }

            // Kiểm tra phần mở rộng file
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'docx'];
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                alert('Định dạng tệp không được chấp nhận.');
                e.preventDefault();
                return;
            }
        });
    </script>

    <script src="js/hello.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>