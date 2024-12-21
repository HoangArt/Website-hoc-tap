<?php
session_start();

// Nếu người dùng đã đăng nhập nhưng lại vào login.php hoặc register.php
if (isset($_SESSION['message'])) {
    echo "<script>
        alert('" . htmlspecialchars($_SESSION['message'], ENT_QUOTES) . "');
    </script>";
    unset($_SESSION['message']);
}

$user_avatar_url = isset($_SESSION['avatar']) 
    ? "http://localhost/OngNho/img/avatar/users/" . $_SESSION['avatar'] 
    : "http://localhost/OngNho/img/avatar/users/default-avatar.png";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="http://localhost/OngNho/css/index.css " rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Ong nhỏ, tri thức lớn!</title>
</head>

<body style="background-color: #FFF9EC">
    <!-- HEADER -->
    <?php include('include/header.php'); ?>

    <!-- BANNER -->
    <div class="banner" style="margin-top: 140px; height: 90vh;">
        <div class="container py-5 banner">
            <div class="row align-items-center" style="margin-top: 40px">
                <!-- Hình ảnh -->
                <div class="col-md-6">
                    <img src="img/banner.jpg" class="img-fluid rounded shadow"
                        alt="Banner học tập" style="max-height: 450px; object-fit: cover;">
                </div>

                <!-- Nội dung -->
                <div class="col-md-6">
                    <span class="hero-badge py-1 px-3 mb-3 text-white d-inline-block shadow text-uppercase rounded-pill"
                        style="background-color: #fc7a57;">
                        Dịch vụ chất lượng cao
                    </span>

                    <h1 class="mb-3 fw-bolder display-6">
                        Chia sẻ kiến thức,<br>
                        Khơi nguồn đam mê,<br>
                        Học tập hiệu quả cho <span class="text-primary">mọi người</span></h1>
                    <p class="text-secondary mb-4 fs-5 pe-md-5 me-md-5">
                        Sứ mệnh của chúng mình là cung cấp tài liệu học tập miễn phí cho mọi người.<br>
                        Chúng mình cam kết tạo ra một môi trường học tập năng động, sáng tạo, giúp
                        mọi người học tập hiệu quả, hứng thú và đam mê với quá trình học tập.
                    </p>
                    <a href="search.php" class="btn btn-md btn-primary px-5 py-3 rounded-pill shadow-lg text-white">Bắt đầu học</a>

                </div>
            </div>
        </div>
    </div>


    <!-- KHÓA HỌC -->
    <section>
        <?php
        include('include/db2.php');

        // Truy vấn để đếm số lượng bài học theo môn học
        $sql = "SELECT subjects.name, COUNT(lessons.id) AS lesson_count
                FROM subjects
                LEFT JOIN lessons ON subjects.id = lessons.subject_id
                GROUP BY subjects.id";

        $result = $conn2->query($sql);

        // Lưu kết quả vào một mảng
        $subjectCounts = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $subjectCounts[$row['name']] = $row['lesson_count'];
            }
        }

        $conn2->close();
        ?>
        <div class="container" style="margin-top: 100px;">
            <div class="text-center mb-4">
                <h1>Các môn học chúng mình dạy</h1>
            </div>

            <div class="row justify-content-between align-items-center"
                style="margin-top: 100px;">
                <div class="col-3">
                    <div class="border p-4 text-center courses" style="background-color:white;">
                        <div class="mb-4">
                            <i class="fa-solid fa-calculator" style="font-size: 3rem;"></i>
                        </div>
                        <h4>Toán học</h4>
                        <p><?php echo isset($subjectCounts['Toán học']) ? $subjectCounts['Toán học'] : '0'; ?> bài học</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="border p-4 text-center courses" style="background-color:white;">
                        <div class="mb-4">
                            <i class="fa-solid fa-book" style="font-size: 3rem;"></i>
                        </div>
                        <h4>Tiếng Việt</h4>
                        <p><?php echo isset($subjectCounts['Tiếng Việt']) ? $subjectCounts['Tiếng Việt'] : '0'; ?> bài học</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="border p-4 text-center courses" style="background-color:white;">
                        <div class="mb-4">
                            <i class="fa-solid fa-language" style="font-size: 3rem;"></i>
                        </div>
                        <h4>Tiếng Anh</h4>
                        <p><?php echo isset($subjectCounts['Tiếng Anh']) ? $subjectCounts['Tiếng Anh'] : '0'; ?> bài học</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="border p-4 text-center courses" style="background-color:white;">
                        <div class="mb-4">
                            <i class="fa-solid fa-flask" style="font-size: 3rem;"></i>
                        </div>
                        <h4>Khoa học</h4>
                        <p><?php echo isset($subjectCounts['Khoa học tự nhiên']) ? $subjectCounts['Khoa học tự nhiên'] : '0'; ?> bài học</p>
                    </div>
                </div>
            </div>

            <div class="row  align-items-center"
                style="margin-top: 50px;">
                <div class="col-3">
                    <div class="border p-4 text-center courses" style="background-color:white;">
                        <div class="mb-4">
                            <i class="fa-solid fa-people-arrows" style="font-size: 3rem;"></i>
                        </div>
                        <h4>Xã hội</h4>
                        <p><?php echo isset($subjectCounts['Khoa học xã hội']) ? $subjectCounts['Khoa học xã hội'] : '0'; ?> bài học</p>
                    </div>
                </div>

                <div class="col-3">
                    <div class="border p-4 text-center courses" style="background-color:white;">
                        <div class="mb-4">
                            <i class="fa-solid fa-palette" style="font-size: 3rem;"></i>
                        </div>
                        <h4>Năng khiếu</h4>
                        <p><?php echo isset($subjectCounts['Môn năng khiếu']) ? $subjectCounts['Môn năng khiếu'] : '0'; ?> bài học</p>
                    </div>
                </div>


            </div>
        </div>
    </section>



    <div>
        <div class="mb-4 d-flex justify-content-center align-items-center" style="margin-top: 150px; background-color: #feca73; height: 150px;">
            <h1>Hỗ trợ nhiều tính năng dành cho tất cả mọi người</h1>
        </div>

        <!-- GIÁO VIÊN -->
        <div class="container-xxl py-5" style="margin-top: 100px">
            <div class="container">
                <div class="row g-5">
                    <!-- CHỮ -->
                    <div class="col-lg-6">
                        <h6 class="section-title text-start pe-3" style="color: #ffb700;">Giáo viên</h6>
                        <h1 class="mb-4">
                            Dễ dàng giảng dạy<br>
                            và quản lý lớp học</h1>
                        <p class="mb-4">
                            Ong nhỏ chúng em cung cấp một loạt các công cụ tiên tiến,
                            giúp các thầy/ cô phát huy tối đa khả năng giảng dạy và nâng cao hiệu quả công tác giảng dạy của mình.
                            Chúng em không chỉ tập trung vào việc hỗ trợ các bạn học sinh,
                            mà còn cam kết tạo ra những công cụ mạnh mẽ giúp các thầy, các cô truyền đạt kiến thức một cách hiệu quả nhất.
                        </p>

                        <div class="row gy-2 gx-4 mb-4">
                            <div class="col-sm-6">
                                <p class="mb-0 fw-semibold"><i class="fa fa-arrow-right me-2" style="color: #ffb700;"></i>Quản lý khóa học</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0 fw-semibold"><i class="fa fa-arrow-right me-2" style="color: #ffb700;"></i>Tạo bài kiểm tra và đánh giá</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0 fw-semibold"><i class="fa fa-arrow-right me-2" style="color: #ffb700;"></i>Tương tác với học sinh</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0 fw-semibold"><i class="fa fa-arrow-right me-2" style="color: #ffb700;"></i>Cộng tác với các giáo viên khác</p>
                            </div>
                        </div>
                        <a class="btn py-3 px-5 mt-2" style="background-color: #feca73;" href="sign-up/teacher.php">Bắt đầu quản lý lớp học tại đây</a>
                    </div>

                    <!-- HÌNH ẢNH -->
                    <div class="col-lg-6" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="img-fluid position-absolute w-100 h-100" src="img/index/teacher.jpg" alt="" style="object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NGƯỜI HỌC VÀ HỌC SINH-->
        <div class="py-5 custom-spacing" style="margin-top: 80px">
            <div class="container">
                <div class="row g-5">
                    <!-- HÌNH ẢNH -->
                    <div class="col-lg-6" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="img-fluid position-absolute w-100 h-100" src="img/index/student.jpg" alt="" style="object-fit: cover;">
                        </div>
                    </div>

                    <!-- CHŨ -->
                    <div class="col-lg-6 d-flex flex-column justify-content-between">
                        <h6 class="section-title text-start pe-3" style="color: #ffb700;">Người học và học sinh</h6>
                        <h1 class="mb-4">Dễ dàng tiếp thu kiến thức</h1>
                        <p class="mb-4">
                            <i class="fa fa-arrow-right me-2" style="color: #ffb700;"></i>
                            Nội dung các bài giảng được kiểm soát một cách chặt chẽ và
                            nghiêm ngặt nhằm đảm bảo rằng tất cả kiến thức được truyền đạt là chính xác và đáng tin cậy.<br>

                            <i class="fa fa-arrow-right me-2" style="color: #ffb700;"></i>
                            Mỗi bài giảng không chỉ được biên soạn cẩn thận mà còn được trình bày một cách mạch lạc và
                            dễ hiểu, giúp các bạn dễ dàng tiếp thu thông tin.<br>

                            <i class="fa fa-arrow-right me-2" style="color: #ffb700;"></i>
                            Kiến thức được trình bày ngắn gọn, súc tích,
                            giúp các bạn có thể học mọi lúc, mọi nơi, mà không gặp phải bất kỳ rào cản nào về thời gian hay không gian.
                        </p>

                        <a class="btn py-3 px-5 mt-2 align-self-start" style="background-color: #feca73;" href="sign-up/student.php">Bắt đầu quản lý lớp học tại đây</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VỀ CHÚNG MÌNH-->
    <section class="about_us">
        <div class="container" style="background-color: #feca73">
            <div class="row align-items-center gx-4">
                <!-- Hình ảnh bên trái -->
                <div class="col-md-5">
                    <div class="ms-md-2 ms-lg-5">
                        <figure>
                            <img class="img-fluid rounded-3" src="img/index/hello.jpg" alt="Đẹp trai" style="object-fit: cover; height: 500px;">
                            <figcaption class="text-center" style="margin-top: 20px;">Nhà sáng lập Herculis</figcaption>
                        </figure>
                    </div>
                </div>

                <!-- Nội dung bên phải -->
                <div class="col-md-6 offset-md-1">
                    <div class="ms-md-2 ms-lg-5 ">
                        <span class="fw-bold">Câu chuyện của chúng mình</span>
                        <h2 class="display-5 fw-bold">Về Ong Nhỏ</h2>
                        <p class="fs-5 fst-italic mb-4">"Làm thế nào để trẻ em có thể học tập miễn phí?"</p>
                        <p class="fs-5 mb-4">
                            Đây là câu hỏi mà bọn mình đã trăn trở từ rất lâu.
                            Trong bối cảnh lạm phát gia tăng và chi phí sinh hoạt không ngừng tăng,
                            chúng mình nhận thấy rằng nhiều gia đình đang gặp khó khăn trong việc cho con cái họ tiếp cận giáo dục.
                            Từ đó, Ong Nhỏ đã được ra đời.
                            Chúng tôi cam kết không ngừng nỗ lực để cải tiến dịch vụ mỗi ngày,
                            mang lại cơ hội học tập miễn phí và dễ dàng tiếp cận tri thức cho mọi người,
                            đặc biệt là cho trẻ em, giúp các bạn nhỏ phát triển hết tất cả khả năng và học hỏi mà không bị rào cản về tài chính.
                        </p>

                        <a class="btn btn-primary py-3 px-5 mt-2" href="about-us.php">Đọc tiếp</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ĐÁNH GIÁ -->
    <section class="gradient-custom">
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="text-center mb-4 pb-2">
                        <h1>Mọi người nói gì về Herculis</h1>
                        <p>
                            Đây là những phản hồi thật lòng từ một số người học đối với dịch vụ của chúng tôi<br>
                            Chúng tôi luôn luôn lắng nghe tất cả ý kiến từ người dùng, dù tốt hay xấu (nhưng chúng tôi thích nghe điều tốt hơn).
                        </p>
                    </div>

                    <div class="text-center mb-4 pb-2">
                        <i class="fas fa-quote-left fa-3x"></i>
                    </div>

                    <div class="card">
                        <div class="card-body px-4 py-5">
                            <div id="carouselDarkVariant" class="carousel slide carousel-dark" data-bs-ride="carousel">
                                <!-- Indicators -->
                                <div class="carousel-indicators mb-0">
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                </div>

                                <!-- Inner -->
                                <div class="carousel-inner pb-5">
                                    <!-- Review 1: Cristiano Ronaldo -->
                                    <div class="carousel-item active">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="img/review/Cristiano Ronaldo.jpg"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="Cristiano Ronaldo" width="220" />
                                                    </div>
                                                    <div class="col-lg-7 text-center text-lg-start mx-auto">
                                                        <h4 class="mb-4">Cristiano Ronaldo</h4>
                                                        <p class="mb-0 pb-3">
                                                            Là một cầu thủ luôn bận rộn, tôi rất ấn tượng với sự linh hoạt và hiệu quả của dịch vụ học online này.
                                                            Nội dung bài học dễ hiểu, sáng tạo, giúp tôi học nhanh chóng dù lịch trình kín.
                                                            Đây là nền tảng tuyệt vời để phát triển không chỉ trên sân cỏ mà cả trong cuộc sống!
                                                        </p>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Review 2: Taylor Swift -->
                                    <div class="carousel-item">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="img/review/Taylor Swift.jpg"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="Taylor Swift" height="220" />
                                                    </div>
                                                    <div class="col-lg-7 text-center text-lg-start mx-auto">
                                                        <h4 class="mb-4">Taylor Swift</h4>
                                                        <p class="mb-0 pb-3">
                                                            Là một nghệ sĩ yêu trẻ em, tôi rất cảm kích trước cách mà trang web này biến việc học trở thành
                                                            một cuộc phiêu lưu sáng tạo. Nội dung thú vị và dễ hiểu, đặc biệt phù hợp với trí tò mò của trẻ.
                                                            Tôi tin rằng nền tảng này không chỉ giúp trẻ học tốt mà còn khuyến khích các em phát triển
                                                            sự tự tin và khả năng sáng tạo vượt trội.
                                                        </p>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Review 3: John Smith -->
                                    <div class="carousel-item">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="img/review/Sơn Tùng MTP.png"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="John Smith" height="220" />
                                                    </div>
                                                    <div class="col-lg-7 text-center text-lg-start mx-auto">
                                                        <h4 class="mb-4">Sơn Tùng M-TP</h4>

                                                        <p class="mb-0 pb-3">
                                                            Âm nhạc và học tập đều cần cảm hứng, và tôi tìm thấy sự kết hợp hoàn hảo giữa hai điều này trên nền tảng học tập này.
                                                            Cách tiếp cận sáng tạo và đầy năng lượng giúp trẻ em không chỉ học mà còn nuôi dưỡng đam mê.
                                                            Hãy luôn giữ cho trái tim mình rực cháy, bởi vì “Sky is the limit!”.
                                                        </p>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Review 4: Elon Musk -->
                                    <div class="carousel-item">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="img/review/Elon Musk.jpg"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="Elon Musk" height="220" />
                                                    </div>
                                                    <div class="col-lg-7 text-center text-lg-start mx-auto">
                                                        <h4 class="mb-4">Elon Musk</h4>
                                                        <p class="mb-0 pb-3">
                                                            Tôi tin rằng công nghệ có thể thay đổi thế giới, và nền tảng học tập này là minh chứng tuyệt vời.
                                                            Nó cung cấp một cách tiếp cận mới, đầy sáng tạo và thú vị, giúp trẻ em học hỏi hiệu quả và phát triển
                                                            khả năng tư duy logic vượt trội.
                                                        </p>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Review 5: Emma Watson -->
                                    <div class="carousel-item">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="img/review/Emma Watson.png"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="Emma Watson" height="220" />
                                                    </div>
                                                    <div class="col-lg-7 text-center text-lg-start mx-auto">
                                                        <h4 class="mb-4">Emma Watson</h4>
                                                        <p class="mb-0 pb-3">
                                                            Giáo dục là sức mạnh, và tôi rất vui khi thấy một nền tảng hỗ trợ trẻ em học hỏi một cách dễ dàng và
                                                            đầy cảm hứng như thế này. Đây là một bước tiến lớn trong việc mang lại tri thức cho mọi trẻ em,
                                                            bất kể xuất thân hay hoàn cảnh.
                                                        </p>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                        <i class="fa-solid fa-star" style="color: gold;"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDarkVariant" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselDarkVariant" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4 pt-2">
                        <i class="fas fa-quote-right fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ĐƠN VỊ HỖ TRỢ-->
    <section class="speedyui speedyui-partner py-5"
        style="margin-bottom: 100px;">
        <div class="container">
            <h3 class="text-center mb-0">Đơn vị đồng hành hỗ trợ</h3>
            <div class="row g-lg-0 g-3 mt-lg-5 mt-3">
                <div class="col-3">
                    <div class="border p-4 text-center d-flex align-items-center justify-content-center"
                        style="background-color:white; height: 150px">
                        <img src="img/partner/huce.png" style="height: 100px;">
                    </div>
                </div>

                <div class="col-3">
                    <div class="border p-4 text-center d-flex align-items-center justify-content-center"
                        style="background-color:white; height: 150px">
                        <img src="img/partner/Google_2015_logo.svg" style="height: 50px;">
                    </div>
                </div>

                <div class="col-3">
                    <div class="border p-4 text-center d-flex align-items-center justify-content-center"
                        style="background-color:white; height: 150px">
                        <img src="img/partner/OpenAI_Logo.png" style="height: 50px;">
                    </div>
                </div>

                <div class="col-3">
                    <div class="border p-4 text-center d-flex align-items-center justify-content-center"
                        style="background-color:white; height: 150px">
                        <img src="img/partner/Claude_AI_logo.svg.png" style="height: 50px;">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <?php include('include/footer.php'); ?>


    <script src="js/hello.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>