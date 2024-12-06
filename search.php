<?php
session_start();
include("db.php");

$filteredProducts = [];

if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];

    // Ensure the search query is properly sanitized
    $searchQuery = htmlspecialchars($searchQuery); // Avoid XSS
    $searchQuery = mysqli_real_escape_string($conn, $searchQuery); // Prevent SQL injection

    // Tìm kiếm trong cơ sở dữ liệu
    $sql = "SELECT * FROM products WHERE tittle LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    // Kiểm tra xem có kết quả không
    if ($result->num_rows > 0) {
        // Lấy tất cả sản phẩm khớp với từ khóa
        $filteredProducts = [];
        while ($row = $result->fetch_assoc()) {
            $filteredProducts[] = $row;
        }
    } else {
        $filteredProducts = [];
    }
} else {
    // This message will only show if the 'search' parameter is missing
    echo "Vui lòng nhập thông tin tìm kiếm.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $searchQuery; ?> | Tìm kiếm trên Herculis </title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/search.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="img/"> <!-- Tạo icon -->
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
                    <li>
                        <div class="dropdown custom-dropdown">
                            <a href="" data-toggle="dropdown" class="dropdown-link nav-link px-2 link-dark"
                                aria-haspopup="true" aria-expanded="false">
                                Khám phá
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="mega-menu d-flex">
                                    <!-- MÔN 1 -->
                                    <div>
                                        <h3 class="text-primary">Toán học</h3>
                                        <ul class="list-unstyled border-primary">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 2 -->
                                    <div>
                                        <h3 class="text-warning">Tiếng Việt</h3>
                                        <ul class="list-unstyled border-warning">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 3 -->
                                    <div>
                                        <h3 class="text-danger">Tiếng Anh</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 4 -->
                                    <div>
                                        <h3 class="text-danger">Khoa học tự nhiên</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 5 -->
                                    <div>
                                        <h3 class="text-danger">Khoa học xã hội</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>

                                    <!-- MÔN 6 -->
                                    <div>
                                        <h3 class="text-danger">Năng khiếu</h3>
                                        <ul class="list-unstyled border-danger">
                                            <li><a href="#">6 tuổi (Lớp 1)</a></li>
                                            <li><a href="#">7 tuổi (Lớp 2)</a></li>
                                            <li><a href="#">8 tuổi (Lớp 3)</a></li>
                                            <li><a href="#">9 tuổi (Lớp 4)</a></li>
                                            <li><a href="#">10 tuổi (Lớp 5)</a></li>
                                            <li><a href="#">11 tuổi (Lớp 6)</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="about-us.php" class="nav-link px-2 link-dark">Về chúng tôi</a></li>
                    <li><a href="contact-us.php" class="nav-link px-2 link-dark">Liên lạc</a></li>
                </ul>

                <!-- USER -->
                <div class="text-end position-relative">
                    <?php if (isset($_SESSION['email'])): ?>
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
                        <a href="register.php" class="btn btn-primary">Đăng ký</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Ô TÌM KIẾM -->
    <div class="container">
        <div class="row height d-flex justify-content-center ">
            <div class="col-md-8">
                <form class="search d-flex" id="searchbox" method="get" action="search.php">
                    <i class="fa fa-search"></i>
                    <input type="search" class="form-control border border-3" placeholder="Tìm kiếm khóa học..." name="search"
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div><br><br>

    <!-- THÂN TRANG -->
    <div class="container">
        <div class="row">
            <!-- BEGIN SEARCH RESULT -->
            <div class="col-md-12">
                <div class="grid search">
                    <div class="grid-body">
                        <div class="row">
                            <!-- LỌC -->
                            <div class="col-md-3">
                                <h4 class="grid-title"><i class="fa fa-filter"></i> Lọc kết quả tìm kiếm</h4>
                                <hr>

                                <!-- LỌC THEO MÔN -->
                                <h6>Theo môn học:</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="toan" value="Toán học">
                                    <label class="form-check-label" for="toan">Toán học</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tiengViet" value="Tiếng Việt">
                                    <label class="form-check-label" for="tiengViet">Tiếng Việt</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="tiengAnh" value="Tiếng Anh">
                                    <label class="form-check-label" for="tiengAnh">Tiếng Anh</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="khoaHocTuNhien" value="Khoa học tự nhiên">
                                    <label class="form-check-label" for="khoaHocTuNhien">Khoa học tự nhiên</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="khoaHocXaHoi" value="Khoa học xã hội">
                                    <label class="form-check-label" for="khoaHocXaHoi">Khoa học xã hội</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="monNangKhieu" value="Môn năng khiếu">
                                    <label class="form-check-label" for="monNangKhieu">Môn năng khiếu</label>
                                </div>


                                <div class="padding"></div>

                                <!-- LỌC THEO ĐỘ TUỔI -->
                                <h6>Theo độ tuổi:</h6>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> 6 tuổi (Lớp 1)</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> 7 tuổi (Lớp 2)</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> 8 tuổi (Lớp 3)</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> 9 tuổi (Lớp 4)</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> 10 tuổi (Lớp 5)</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> 11 tuổi (Lớp 6)</label>
                                </div>
                                <!-- KẾT THÚC LỌC THEO ĐỘ TUỔI -->
                            </div>

                            <!-- KẾT QUẢ -->
                            <div class="col-md-9">
                                <h2><i class="fa fa-file-o"></i> Kết quả</h2>
                                <hr>

                                <?php if ($searchQuery && count($filteredProducts) > 0): ?>
                                    <p>Hiện tất cả các kết quả cho "<?php echo $searchQuery; ?>":</p>

                                    <div class="padding"></div>

                                    <!-- BẢNG KẾT QUẢ -->
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <?php foreach ($filteredProducts as $index => $product): ?>
                                                    <tr>
                                                        <td class="number text-center"><?= $index + 1; ?></td>
                                                        <td class="image"><img src="https://via.placeholder.com/150" alt=""></td> <!-- Placeholder image -->
                                                        <td class="product">
                                                            <strong><?= htmlspecialchars($product['tittle']); ?></strong><br>
                                                            <?= htmlspecialchars($product['description']); ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- DẤU TRANG -->
                                    <ul class="pagination">
                                        <li class="disabled"><a href="#">«</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">»</a></li>
                                    </ul>

                                <?php else: ?>
                                    <p>Không có kết quả tìm kiếm cho từ khóa "<?php echo htmlspecialchars($searchQuery); ?>"</p>
                                <?php endif; ?>
                            </div>
                            <!-- END RESULT -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SEARCH RESULT -->
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-lg-start text-white" id="footer">
        <div class="container p-4" style="background-color: #25b1e8">
            <div class="row my-4">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">

                    <div class="bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto"
                        style="width: 250px; height: 150px;">
                        <img src="img/Herculis_logo.png" height="70" alt="" loading="lazy" />
                    </div>

                    <p class="text-center">
                        Sứ mệnh của chúng tôi là giúp cho mọi trẻ em trên thế giới đều có thể học tập.
                    </p>
                </div>

                <!-- ĐƯỜNG DẪN NHANH -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Đường dẫn nhanh</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="#!" class="text-white">Bắt đầu học</a>
                        </li>
                        <li class="mb-2">
                            <a href="#!" class="text-white">Góp ý</a>
                        </li>
                    </ul>
                </div>

                <!-- HỖ TRỢ -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Hỗ trợ</h5>

                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="" class="text-white">Trung tâm hỗ trợ</a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="text-white">Chính sách quyền riêng tư</a>
                        </li>
                        <li class="mb-2">
                            <a href="" class="text-white">FAQ</a>
                        </li>
                        <li class="mb-2">
                            <a href="contact-us.php" class="text-white">Liên lạc</a>
                        </li>
                    </ul>
                </div>

                <!-- LIÊN LẠC -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-4">Liên lạc với chúng tôi</h5>

                    <ul class="list-unstyled">
                        <li>
                            <p><i class="fas fa-map-marker-alt pe-2"></i>55 Đ. Giải Phóng, Đồng Tâm, Hai Bà Trưng, Hà Nội</p>
                        </li>
                        <li>
                            <p><i class="fas fa-phone pe-2"></i>024 3863 0001</p>
                        </li>
                        <li>
                            <p><i class="fas fa-envelope pe-2 mb-0"></i>contact@herculis.com</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            &copy; 2024 Copyright Herculis.
        </div>
    </footer>
</body>

</html>