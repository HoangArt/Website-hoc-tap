<?php
session_start();

$user_avatar_url = isset($_SESSION['avatar']) 
    ? "http://localhost/OngNho/img/avatar/users/" . $_SESSION['avatar'] 
    : "http://localhost/OngNho/img/avatar/users/default-avatar.png";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="/css/about-us.css " rel="stylesheet">

    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title>Về chúng mình | Ong nhỏ</title>
    <style>
        .about-us-link {
            padding: 15px 114px;
            background-color: #FFF9EC;
            border-bottom: 2px solid #333;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
        }

        .about-us-link nav {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .about__breadcrumb {
            list-style: none;
            display: flex;
            gap: 10px;
            margin: 0;
            padding: 0;
        }

        .about__breadcrumb li {
            display: inline;
        }

        .about__breadcrumb a {
            text-decoration: none;
            color: #feca73;
            transition: color 0.3s;
        }

        .about__breadcrumb a:hover {
            color: black;
        }

        :root {
            --primary-color: #FFC107;
            --secondary-color: #6c757d;
            --background-color: #FFF9EC;
            --text-color: #333;
            --hover-color: #FFD54F;
            --accent-color: #FF5722;
            --border-color: rgba(0, 0, 0, 0.1);
        }

        .about-us-link {
            background-color: #FFF3E0;
            padding: 18px 0;
            border-radius: 10px;
        }



        .about__breadcrumb li {
            margin-right: 15px;
        }

        .about__breadcrumb a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease, transform 0.3s ease;
            font-size: 1.1rem;
        }

        .about__breadcrumb a:hover {
            color: var(--hover-color);
            transform: translateX(5px);
        }

        .section-title {
            position: relative;
            padding-bottom: 12px;
            margin-bottom: 25px;
            font-size: 2.2rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary-color);
        }

        .achivements {
            background-color: #FFEBEE;
            padding: 30px 0;
        }

        .sub-heading {
            color: var(--secondary-color);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .card-wrapper {
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            margin-top: 30px;
            overflow: hidden;
        }

        .card-wrapper:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .card-wrapper i {
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }

        .card-wrapper:hover i {
            transform: scale(1.2) rotate(10deg);
        }

        .img-fluid {
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .img-fluid:hover {
            transform: scale(1.07);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        @media (max-width: 768px) {
            .display-5 {
                font-size: 2.7rem;
            }

            .lead {
                font-size: 1.1rem;
            }

            .card-wrapper {
                margin-bottom: 25px;
            }

            .section-title {
                font-size: 1.8rem;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .wow {
            animation: fadeInUp 1s;
        }

        .button-hover:hover {
            background-color: var(--accent-color);
            color: #fff;
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body style="background-color: #FFF9EC">
    <!-- HEADER -->
    <?php include('include/header.php'); ?>

    <div class="about-us-link" style="margin-top:140px;">
        <div class="container d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ul class="uk-breadcrumb about__breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li> / </li>
                    <li aria-current="page">Về chúng mình</li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- THÂN TRANG -->

    <div class="" style="height: 200px; overflow: hidden; ">
        <img src="img/about-us/studying.jpg">
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- Chữ bên trái -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h3 class="section-title text-start text-dark pe-3">Lời nói đầu</h3>
                    <h2 class="mb-4">Kính gửi phụ huynh, giáo viên và học sinh</h2>
                    <p class="lead">
                        Chúng tôi tin rằng mỗi đứa trẻ đều là một tài năng tiềm ẩn, chờ được khơi gợi và phát triển.
                        Tại Ong Nhỏ, chúng tôi không chỉ là một nơi học thuật, mà còn là một môi trường nuôi dưỡng đam mê.
                    </p>
                    <p class="lead mb-0">
                        Với sứ mệnh khơi dậy tinh thần học hỏi và sáng tạo, chúng tôi cam kết cung cấp một trải nghiệm giáo dục
                        toàn diện, giúp các em phát triển không chỉ về kiến thức mà còn về kỹ năng sống và tư duy phản biện.
                    </p>


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


    <section class="py-5">
        <div class="container">
            <div class="row align-items-center gx-4">
                <div class="col-md-5">
                    <div class="ms-md-2 ms-lg-5"><img class="img-fluid rounded-3" src="img/logo/Ongnho-logo.png"></div>
                </div>
                <div class="col-md-6 offset-md-1">
                    <div class="ms-md-2 ms-lg-5">
                        <h2 class="display-5 fw-bold">Về Ong Nhỏ</h2>
                        <p class="lead">
                            Được thành lập và phát triển từ năm 2024 tại Hà Nội, cho đến này, Ong Nhỏ đã mang đến cơ hội học tập
                            cho hàng nghìn bạn nhỏ và người lớn trong một môi trường ấm áp, sáng tạo và tràn đầy cảm hứng.
                        </p>
                        <p class="lead mb-0">
                            Với sứ mệnh mang đến nền giáo dục chất lượng cao, Ong Nhỏ luôn nỗ lực phát triển các phương pháp học tập tiên tiến,
                            kết hợp giữa lý thuyết và thực hành, giúp các em nhỏ không chỉ nắm vững kiến thức mà còn phát triển toàn diện về kỹ năng và tư duy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CON SỐ KHÔNG NÓI DỐI-->
    <section class="achivements py-4 py-sm-5">
        <div class="container">
            <div class="text-center mb-4 mb-lg-5">
                <span class="d-inline-block sub-heading fw-semibold mb-2">
                    Những con số không nói dối
                </span>
                <h2 class="fw-bold text-dark display-5">Thành tựu nổi bật*</h2>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0"
                        style="height: 340px;">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-face-smile"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-semibold mb-2">1 triệu</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                            Học sinh và người học đang theo học tại Ong Nhỏ
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0"
                        style="height: 340px;">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-file"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-file mb-2">10 triệu</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                            Bài tập được đăng trên ong nhỏ
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0"
                        style="height: 340px;">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-user-graduate"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-semibold mb-2">99,99%</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                            Bạn nhỏ đỗ vào các trường trung học cơ sở khi theo học tại Ong Nhỏ
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card-wrapper position-relative bg-white text-center px-2 pb-2 mx-auto mt-5 mb-4 mb-lg-0"
                        style="height: 340px;">
                        <div class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-award"
                                style="font-size: 100px; margin-top: 50px; margin-bottom: 50px;"></i>
                        </div>

                        <h5 class="fs-4 fw-semibold mb-2">100+</h5>
                        <p class="text-muted mx-3 mx-lg-2 mx-xl-4">
                            Số giải thưởng trong và ngoài nước Ong Nhỏ đã đạt được
                        </p>
                    </div>
                </div>

            </div>

            <p style="margin-top: 10px;">
                * Số liệu được lấy từ trong trí tưởng tượng của Ong Nhỏ.
                Trí tưởng tượng quả là một điều tuyệt vời phải không?
                Nó biến điều không tưởng thành hiện thực, biến giấc mơ thành
                thực tế
            </p>
        </div>


    </section>

    <!-- FOOTER -->
    <?php include('include/footer.php'); ?>


    <script src="js/hello.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>