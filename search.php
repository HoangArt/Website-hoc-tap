<?php
session_start();
include("include/db.php");
include("include/db2.php");

// Hình ảnh môn học
$subjectImages = [
    1 => 'img/lesson-img/math.png',
    2 => 'img/lesson-img/vietnamese.png',
    3 => 'img/lesson-img/english.png',
    4 => 'img/lesson-img/science.png',
    5 => 'img/lesson-img/social.png',
    6 => 'img/lesson-img/art.png'
];

$subjectImage = isset($subjectImages[$lesson['subject_id']]) ? $subjectImages[$lesson['subject_id']] : 'https://placehold.co/100x100';


// Số kết quả mỗi trang
$resultsPerPage = 10;

// Lấy số trang hiện tại từ URL (nếu có), nếu không, mặc định là trang 1
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage <= 0) {
    $currentPage = 1;
}

// Tính toán OFFSET (vị trí bắt đầu của kết quả trên trang hiện tại)
$offset = ($currentPage - 1) * $resultsPerPage;

$filteredLessons = [];
$whereClause = '';

// Lọc theo từ khóa tìm kiếm
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $searchQuery = htmlspecialchars($searchQuery);
    $searchQuery = mysqli_real_escape_string($conn2, $searchQuery);
    $whereClause = " AND (tittle LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
}

// Kiểm tra nếu người dùng chọn môn học để lọc
if (isset($_GET['subjects']) && !empty($_GET['subjects'])) {
    $selectedSubjects = $_GET['subjects'];  // Mảng các môn học đã chọn
    $subjectIds = implode(",", array_map('intval', $selectedSubjects));  // Chuyển mảng thành chuỗi số để sử dụng trong SQL

    // Thêm điều kiện lọc môn học vào câu truy vấn SQL
    $whereClause .= " AND subject_id IN ($subjectIds)";
}

// Truy vấn cơ sở dữ liệu
$sql = "SELECT * FROM lessons WHERE 1 $whereClause LIMIT $offset, $resultsPerPage";
$result = $conn2->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $filteredLessons[] = $row;
    }
} else {
    $filteredLessons = [];
}

// Tính toán tổng số trang
$sqlCount = "SELECT COUNT(*) AS total FROM lessons WHERE 1 $whereClause";
$countResult = $conn2->query($sqlCount);
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $resultsPerPage);

$conn->close();
$conn2->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logo/Ongnho-icon.png">
    <title><?= isset($searchQuery) ? htmlspecialchars($searchQuery) . ' | ' : ''; ?>Tìm kiếm trên Ong Nhỏ </title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/search.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.6.0-web/css/all.css">
</head>

<body style="background-color: #fff9ec;">
    <!-- HEADER -->
    <?php include('include/header.php'); ?>

    <!-- Ô TÌM KIẾM -->
    <div class="container" style="padding-top: 100px;">
        <div class="row height d-flex justify-content-center ">
            <div class="col-md-8">
                <form class="search d-flex" id="searchbox" method="get" action="search.php">
                    <i class="fa fa-search"></i>
                    <input type="search" class="form-control border border-3 search_input" placeholder="Tìm kiếm khóa học..." name="search"
                        value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="search_button">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div><br><br>

    <!-- THÂN TRANG -->
    <div class="container">
        <div class="row">
            <!-- KẾT QUẢ TÌM KIẾM -->
            <div class="col-md-12">
                <div class="grid search" style="padding: 15px 20px 15px 20px;">
                    <div class="grid-body" style="padding: 15px 20px 15px 20px;">
                        <div class="row">
                            <!-- LỌC -->
                            <div class="col-md-3">
                                <h2 class="grid-title"><i class="fa fa-filter"></i> Lọc kết quả</h2>
                                <hr>

                                <!-- LỌC THEO MÔN -->
                                <div>
                                    <h5>Theo môn học:</h5>

                                    <div class="list-group">
                                        <?php
                                        include("include/db2.php");
                                        // Truy vấn danh sách môn học từ cơ sở dữ liệu
                                        $subjectsQuery = "SELECT * FROM subjects";
                                        $subjectsResult = $conn2->query($subjectsQuery);

                                        // Hiển thị checkbox cho mỗi môn học
                                        while ($subject = $subjectsResult->fetch_assoc()) {
                                            echo '<label class="list-group-item">';
                                            echo '<input class="form-check-input me-1" type="checkbox" name="subjects[]" value="' . $subject['id'] . '"';

                                            // Nếu môn học đã được chọn, đánh dấu checkbox là checked
                                            if (isset($selectedSubjects) && in_array($subject['id'], $selectedSubjects)) {
                                                echo ' checked';
                                            }

                                            echo '> ' . htmlspecialchars($subject['name']) . '</label>';
                                        }
                                        $conn2->close();
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- KẾT QUẢ -->
                            <div class="col-md-9">

                                <h2><i class="fa-solid fa-file"></i> Kết quả</h2>

                                <hr>

                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <?php if ($_SESSION['role_name'] == "teacher"): ?>
                                        <div>
                                            <a href="teacher/upload.php" class="btn btn-lg" role="button"
                                                style="background-color: #feca73; margin-bottom: 30px;">+ Tạo bài học mới</a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (count($filteredLessons) > 0): ?>
                                    <p>Hiện tất cả các kết quả<?= isset($searchQuery) ? ' cho "' . htmlspecialchars($searchQuery) . '"' : ''; ?>:</p>

                                    <div class="padding"></div>

                                    <!-- BẢNG KẾT QUẢ -->
                                    <div id="results" class="table-responsive">
                                        <table class="table table-hover">
                                            <tbody>
                                                <?php foreach ($filteredLessons as $index => $lesson): ?>
                                                    <?php
                                                    $subjectImage = isset($subjectImages[$lesson['subject_id']]) ? $subjectImages[$lesson['subject_id']] : 'https://placehold.co/100x100';
                                                    $lessonLink = $lesson['lesson_link'];
                                                    ?>
                                                    <tr>
                                                        <td class="number text-center"><?= $index + 1; ?></td>

                                                        <td class="image"><img src="<?= $subjectImage; ?>" alt=""></td>

                                                        <td class="lesson">
                                                            <strong><?= htmlspecialchars($lesson['tittle']); ?></strong><br>
                                                            <?= htmlspecialchars($lesson['description']); ?>
                                                        </td>

                                                        <td class="lesson-link">
                                                            <a href="lesson.php?link=<?= $lessonLink; ?>" >Xem bài học</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- DẤU TRANG -->
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <?php if ($currentPage > 1): ?>
                                                <li class="page-item"><a href="?search=<?= htmlspecialchars($searchQuery); ?>&page=1"
                                                        class="page-link">«</a></li>
                                                <li class="page-item"><a href="?search=<?= htmlspecialchars($searchQuery); ?>&page=<?= $currentPage - 1; ?>"
                                                        class="page-link">‹</a></li>
                                            <?php else: ?>
                                                <li class="page-item disabled"><a href="#" class="page-link">Trước</a></li>
                                            <?php endif; ?>

                                            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                                <li class="<?= $page == $currentPage ? 'active' : ''; ?>"><a
                                                        href="?search=<?= htmlspecialchars($searchQuery); ?>&page=<?= $page; ?>" class="page-link"><?= $page; ?></a></li>
                                            <?php endfor; ?>

                                            <?php if ($currentPage < $totalPages): ?>
                                                <li class="page-item"><a
                                                        href="?search=<?= htmlspecialchars($searchQuery); ?>&page=<?= $currentPage + 1; ?>" class="page-link">›</a></li>
                                                <li class="page-item"><a
                                                        href="?search=<?= htmlspecialchars($searchQuery); ?>&page=<?= $totalPages; ?>" class="page-link">»</a></li>
                                            <?php else: ?>
                                                <li class="page-item disabled"><a href="#" class="page-link">Sau</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>

                                <?php else: ?>
                                    <p>Không có kết quả tìm kiếm cho từ khóa "<?php echo isset($searchQuery) ? htmlspecialchars($searchQuery) : ''; ?>"</p>
                                <?php endif; ?>
                            </div>

                            <!-- KẾT THÚC KẾT QUẢ -->
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php include('include/footer.php'); ?>

    <script>
        // Hàm để lọc kết quả theo môn học đã chọn
        function filterResults() {
            const selectedSubjects = [];

            // Lấy tất cả các checkbox
            const checkboxes = document.querySelectorAll('.form-check-input');

            // Kiểm tra các checkbox nào được chọn
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedSubjects.push(checkbox.value); // Lưu giá trị môn học vào mảng
                }
            });

            // Gửi yêu cầu lọc kết quả về phía server
            fetchResults(selectedSubjects);
        }

        // Hàm gửi yêu cầu AJAX để lấy kết quả lọc từ server
        function fetchResults(selectedSubjects) {
            const searchQuery = document.querySelector('input[name="search"]').value;

            fetch('search.php?search=' + encodeURIComponent(searchQuery) + '&subjects=' + selectedSubjects.join(',')) // Chỉnh sửa URL để gửi yêu cầu đến search.php
                .then(response => response.json())
                .then(data => {
                    updateResults(data); // Cập nhật kết quả tìm kiếm
                })
                .catch(error => {
                    console.error('Error fetching results:', error);
                });
        }

        // Hàm để cập nhật kết quả hiển thị trên trang
        function updateResults(lessons) {
            const resultsTable = document.querySelector('#results tbody');
            resultsTable.innerHTML = ''; // Xóa tất cả các kết quả hiện tại

            // Lặp qua tất cả sản phẩm và hiển thị
            lessons.forEach(lesson => {
                const row = document.createElement('tr');
                row.setAttribute('data-subject-id', lesson.subject_id); // Gắn ID môn học vào mỗi dòng kết quả

                row.innerHTML = `
            <td class="number text-center">${lesson.id}</td>
            <td class="image"><img src="${lesson.image}" alt=""></td>
            <td class="lesson">
                <strong>${lesson.tittle}</strong><br>
                ${lesson.description}
            </td>
        `;

                resultsTable.appendChild(row);
            });
        }

        // Lắng nghe sự kiện thay đổi trạng thái checkbox
        document.querySelectorAll('.form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', filterResults);
        });
    </script>

    <script src="js/hello.js"></script>
</body>

</html>