<?php
session_start();

// Nếu người dùng đã đăng nhập nhưng lại vào login.php hoặc signup.php
if (isset($_SESSION['message'])) {
    echo "<script>
        alert('" . htmlspecialchars($_SESSION['message'], ENT_QUOTES) . "');
    </script>";
    unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Herculis | Phát triển ước mơ</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/"> <!-- Tạo icon -->
    <style>
        /* Ảnh USER */
        .user-pic {
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .sub-menu-wrap {
            display: none;
            /* Ẩn menu mặc định */
            position: absolute;
            top: 60px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 10;
            width: 200px;
        }

        .sub-menu-wrap.show {
            display: block;
            /* Hiển thị menu khi có lớp 'show' */
        }

        .sub-menu {
            padding: 10px;
        }

        .sub-menu a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #333;
            border-radius: 5px;
        }

        .sub-menu a:hover {
            background-color: #f0f0f0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .user-info img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        /* KHOẢNG CÁCH GIỮA CÁC PHẦN TỬ */
        .custom-spacing {
            margin-top: 150px;
            /* Tăng khoảng cách trên */
            margin-bottom: 150px;
            /* Tăng khoảng cách dưới */
        }

        /* VỀ CHÚNG TÔI */
        section.py-5 {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        /* Tăng kích thước tiêu đề */
        h2.display-5 {
            font-size: 2.5rem;
            line-height: 1.4;
            font-weight: bold;
        }

        /* Cải thiện độ sáng của văn bản */
        p.lead {
            font-size: 1.1rem;
            color: #333;
        }

        /* Đảm bảo hình ảnh luôn phù hợp với cột */
        img.img-fluid {
            object-fit: cover;
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <!-- LOGO -->
                <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <img src="img/Herculis_logo.png" class="bi me-2" height="32" role="img" aria-label="Bootstrap">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-dark">Khám phá</a></li>
                    <li><a href="forum.php" class="nav-link px-2 link-dark">Diễn đàn</a></li>
                    <li><a href="#about_us" class="nav-link px-2 link-dark">Về chúng tôi</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Liên lạc</a></li>
                </ul>

                <!-- Ô TÌM KIẾM -->
                <form class="col-4 mb-3 mb-lg-0 me-lg-5" id="searchbox">
                    <input type="search" class="form-control border border-3" placeholder="Tìm kiếm khóa học..." aria-label="Search">
                </form>

                <!-- USER -->
                <div class="text-end position-relative">
                    <?php if (isset($_SESSION['username'])): ?>
                        <img src="img/user.png" class="user-pic" id="userPic">
                        <div class="sub-menu-wrap" id="subMenu">
                            <div class="sub-menu">
                                <div class="user-info">
                                    <img src="img/user.png" alt="User">
                                    <h4><?= htmlspecialchars($_SESSION['full_name']); ?></h4>
                                </div>
                                <a href="user_settings.php">Cài đặt tài khoản</a>
                                <a href="logout.php">Đăng xuất</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline-primary me-2">Đăng nhập</a>
                        <a href="signup.php" class="btn btn-primary">Đăng ký</a>
                    <?php endif; ?>
                    <a href="feedback.php" class="btn btn-default">Góp ý</a>
                </div>
            </div>
        </div>
    </header>

    <!-- BANNER -->
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Hình ảnh -->
            <div class="col-md-6 text-center">
                <img src="img/banner.jpg" class="img-fluid rounded shadow" alt="Banner học tập" style="max-height: 400px; object-fit: cover;">
            </div>

            <!-- Nội dung -->
            <div class="col-md-6">
                <h3 class="display-6 fw-normal">
                    Chia sẻ kiến thức,<br>khơi nguồn đam mê,<br>học tập hiệu quả cho
                    <span class="display-6 fw-bold text-decoration-underline">mọi người!</span>
                </h3>


                <p class="lead fw-light">
                    Sứ mệnh của chúng tôi là cung cấp tài liệu học tập miễn phí, giúp học sinh và những người đam mê học hỏi có thể tiếp cận kiến thức một cách dễ dàng.<br>
                    Chúng tôi cam kết tạo ra một môi trường học tập năng động, sáng tạo, giúp mọi người không chỉ học hỏi một cách hiệu quả mà còn cảm thấy hứng thú và đam mê với quá trình học tập.
                </p>
                <a class="btn btn-outline-primary btn-lg" href="#">Bắt đầu học</a>
            </div>
        </div>
    </div>

    <!-- Tính năng -->
    <section class="container my-10 custom-spacing">
        <!-- Tiêu đề chú thích -->
        <div class="text-center mb-4">
            <h2>Một số tính năng nổi bật</h2>
            <br>
            <hr>
        </div>

        <div class="row text-center">
            <!-- Thẻ Tính Năng 1 -->
            <div class="col-md-4 mb-4">
                <div class="">
                    <div class="card-body">
                        <i class="fas fa-book fa-3x text-danger mb-3"></i>
                        <h3 class="card-title">Bài học tương tác</h3><br>
                        <p class="card-text">
                            Những nội dung học tập được thiết kế một cách sinh động và trực quan, giúp học sinh dễ dàng tiếp thu kiến thức.
                            Các bài học không chỉ mang tính giáo dục mà còn tạo cảm giác hào hứng, khiến việc học trở nên thú vị hơn.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Thẻ Tính Năng 2 -->
            <div class="col-md-4 mb-4">
                <div class="">
                    <div class="card-body">
                        <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                        <h3 class="card-title">Theo dõi tiến trình</h3><br>
                        <p class="card-text">
                            Cung cấp công cụ phân tích chi tiết giúp phụ huynh và học sinh dễ dàng theo dõi tiến độ học tập.
                            Mỗi bài học hoàn thành sẽ được ghi nhận, giúp bạn hiểu rõ điểm mạnh và những phần cần cải thiện.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Thẻ Tính Năng 3 -->
            <div class="col-md-4 mb-4">
                <div class="">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h3 class="card-title">Hỗ trợ cộng đồng</h3><br>
                        <p class="card-text">
                            Kết nối với các bậc phụ huynh, giáo viên và học sinh khác trong cộng đồng học tập trực tuyến.
                            Trao đổi kinh nghiệm, hỗ trợ lẫn nhau và cùng nhau xây dựng một môi trường học tập hiệu quả hơn.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- GIÁO VIÊN -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Chữ bên trái -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Giáo viên</h6>
                    <h1 class="mb-4">
                        Dễ dàng giảng dạy<br>
                        và quản lý lớp học</h1>
                    <p class="mb-4">
                        Herculis cung cấp một loạt các công cụ tiên tiến, giúp giáo viên phát huy tối đa khả năng giảng dạy và nâng cao hiệu quả công tác giảng dạy của mình.
                        Chúng tôi không chỉ tập trung vào việc hỗ trợ học sinh, mà còn cam kết tạo ra những công cụ mạnh mẽ giúp giáo viên truyền đạt kiến thức một cách hiệu quả nhất.
                    </p>

                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Quản lý khóa học</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Tạo bài kiểm tra và đánh giá</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Tương tác với học sinh</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Cộng tác với các giáo viên khác</p>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="signup.php">Bắt đầu quản lý lớp học tại đây</a>
                </div>

                <!-- Ảnh bên phải -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/index/teacher.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NGƯỜI HỌC VÀ HỌC SINH-->
    <div class="container-xxl py-5 custom-spacing">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/index/student.jpg" alt="" style="object-fit: cover;">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Người học và học sinh</h6>
                    <h1 class="mb-4">Dễ dàng tiếp thu kiến thức</h1>
                    <p class="mb-4">
                        &bull; Nội dung các bài giảng được kiểm soát một cách chặt chẽ và nghiêm ngặt nhằm đảm bảo rằng tất cả kiến thức được truyền đạt là chính xác và đáng tin cậy.<br>
                        &bull; Mỗi bài giảng không chỉ được biên soạn cẩn thận mà còn được trình bày một cách mạch lạc và dễ hiểu, giúp người học dễ dàng tiếp thu thông tin.<br>
                        &bull; Thêm vào đó, kiến thức được trình bày ngắn gọn, súc tích, giúp người học có thể học mọi lúc, mọi nơi, mà không gặp phải bất kỳ rào cản nào về thời gian hay không gian.
                    </p>


                    <a class="btn btn-primary py-3 px-5 mt-2" href="signup.php">Bắt đầu quản lý lớp học tại đây</a>
                </div>
            </div>
        </div>
    </div>

    <!-- VỀ CHÚNG TÔi-->
    <section class="custom-spacing" id="about_us">
        <div class="container">
            <div class="row align-items-center gx-4">
                <!-- Hình ảnh bên trái -->
                <div class="col-md-5">
                    <div class="ms-md-2 ms-lg-5">
                        <img class="img-fluid rounded-3" src="img/index/hello.jpg" alt="Herculis" style="object-fit: cover; height: 500px;">
                    </div>
                </div>
                <!-- Nội dung bên phải -->
                <div class="col-md-6 offset-md-1">
                    <div class="ms-md-2 ms-lg-5">
                        <span class="text-muted">Câu chuyện của chúng tôi</span>
                        <h2 class="display-5 fw-bold">Về Herculis</h2>
                        <p class="lead mb-4">
                            "Làm thế nào để trẻ em có thể học tập miễn phí?"<br>
                            Đây là câu hỏi mà chúng tôi đã trăn trở từ lâu.
                            Trong bối cảnh lạm phát gia tăng và chi phí sinh hoạt không ngừng tăng, chúng tôi nhận thấy rằng nhiều gia đình đang gặp khó khăn trong việc cho con cái họ tiếp cận giáo dục.
                            Vì vậy, chúng tôi quyết định xây dựng Herculis — một sản phẩm mà chúng tôi vô cùng tâm huyết.
                            Chúng tôi cam kết không ngừng nỗ lực để cải tiến dịch vụ mỗi ngày, mang lại cơ hội học tập miễn phí và dễ dàng tiếp cận tri thức cho mọi người, đặc biệt là cho trẻ em, giúp các em phát triển và học hỏi mà không bị rào cản về tài chính.
                        </p>
                        <!-- Bạn có thể thêm các thông tin hoặc nút CTA ở đây -->
                        <!-- <a class="btn btn-primary py-3 px-5 mt-3" href="#">Tìm hiểu thêm</a> -->
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
                        <h2>Mọi người nói gì về Herculis</h2>
                    </div>

                    <div class="text-center mb-4 pb-2">
                        <i class="fas fa-quote-left fa-3x"></i>
                    </div>

                    <div class="card">
                        <div class="card-body px-4 py-5">
                            <!-- Carousel wrapper -->
                            <div id="carouselDarkVariant" data-mdb-carousel-init class="carousel slide carousel-dark" data-mdb-ride="carousel">
                                <!-- Indicators -->
                                <div class="carousel-indicators mb-0">
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button data-bs-target="#carouselDarkVariant" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <!-- Inner -->
                                <div class="carousel-inner pb-5">
                                    <!-- Single item -->
                                    <div class="carousel-item active">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="img/review/Cristiano Ronaldo.jpg"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="woman avatar" width="150" />
                                                    </div>
                                                    <div
                                                        class="col-9 col-md-9 col-lg-7 col-xl-8 text-center text-lg-start mx-auto mx-lg-0">
                                                        <h4 class="mb-4">Cristiano Ronaldo</h4>
                                                        <p class="mb-0 pb-3">
                                                            Là một cầu thủ luôn bận rộn, tôi rất ấn tượng với sự linh hoạt và hiệu quả của dịch vụ học online này.
                                                            Nội dung bài học dễ hiểu, sáng tạo, giúp tôi học nhanh chóng dù lịch trình kín.
                                                            Đây là nền tảng tuyệt vời để phát triển không chỉ trên sân cỏ mà cả trong cuộc sống!
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single item -->
                                    <div class="carousel-item">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(2).webp"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="woman avatar" width="150"
                                                            height="150" />
                                                    </div>
                                                    <div
                                                        class="col-9 col-md-9 col-lg-7 col-xl-8 text-center text-lg-start mx-auto mx-lg-0">
                                                        <h4 class="mb-4">Lisa Cudrow - Graphic Designer</h4>
                                                        <p class="mb-0 pb-3">
                                                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                                                            accusantium doloremque laudantium, totam rem aperiam, eaque
                                                            ipsa quae ab illo inventore veritatis et quasi architecto
                                                            beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem
                                                            quia voluptas sit aspernatur.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Single item -->
                                    <div class="carousel-item">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="row">
                                                    <div class="col-lg-4 d-flex justify-content-center">
                                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(9).webp"
                                                            class="rounded-circle shadow-1 mb-4 mb-lg-0" alt="woman avatar" width="150"
                                                            height="150" />
                                                    </div>
                                                    <div
                                                        class="col-9 col-md-9 col-lg-7 col-xl-8 text-center text-lg-start mx-auto mx-lg-0">
                                                        <h4 class="mb-4">John Smith - Marketing Specialist</h4>
                                                        <p class="mb-0 pb-3">
                                                            At vero eos et accusamus et iusto odio dignissimos qui
                                                            blanditiis praesentium voluptatum deleniti atque corrupti quos
                                                            dolores et quas molestias excepturi sint occaecati cupiditate
                                                            non provident, similique sunt in culpa qui officia mollitia
                                                            animi id laborum et dolorum fuga.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ĐIỀU KHIỂN -->
                                <!-- NÚT LÙI -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDarkVariant" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>

                                <!-- NÚT TIẾN -->
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


    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>Về trang web</h6>
                    <p>
                        Trang web được tạo ra với mục tiêu mang lại cơ hội học tập và phát triển cho trẻ em, giúp các em tiếp cận với những tài liệu giáo dục chất lượng, sáng tạo và dễ hiểu.
                        Chúng tôi cam kết tạo ra một môi trường học tập an toàn và thú vị, nơi trẻ em có thể khám phá và phát triển kỹ năng, đồng thời nuôi dưỡng đam mê học hỏi suốt đời.
                    </p>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Đường dẫn nhanh</h6>
                    <ul class="footer-links">
                        <li><a href="courses.php">Các khóa học</a></li>
                        <li><a href="">Diễn đàn</a></li>
                        <li><a href="#about_us">Về chúng tôi</a></li>
                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Hỗ trợ</h6>
                    <ul class="footer-links">
                        <li><a href="">Trung tâm hỗ trợ</a></li>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Chính sách quyền riêng tư</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p>&copy; 2024 Trang web được tạo bởi nhóm 10</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Hiển thị/Ẩn menu khi nhấn vào ảnh
        const userPic = document.getElementById('userPic');
        const subMenu = document.getElementById('subMenu');

        userPic.addEventListener('click', () => {
            subMenu.classList.toggle('show');
        });

        // Ẩn menu nếu nhấn ra ngoài
        document.addEventListener('click', (e) => {
            if (!subMenu.contains(e.target) && !userPic.contains(e.target)) {
                subMenu.classList.remove('show');
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>