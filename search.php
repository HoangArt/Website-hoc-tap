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

// Số kết quả mỗi trang
$resultsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage <= 0) $currentPage = 1;

$offset = ($currentPage - 1) * $resultsPerPage;

$filteredLessons = [];
$whereClause = '';

// Lọc theo từ khóa tìm kiếm
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = htmlspecialchars(mysqli_real_escape_string($conn2, $_GET['search']));
    $whereClause .= " AND (title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%')";
}

// Lọc theo môn học
if (isset($_GET['subjects']) && !empty($_GET['subjects'])) {
    $selectedSubjects = array_map('intval', explode(',', $_GET['subjects']));
    $subjectIds = implode(",", $selectedSubjects);
    $whereClause .= " AND subject_id IN ($subjectIds)";
}

// Truy vấn cơ sở dữ liệu
$sql = "SELECT * FROM lessons WHERE 1 $whereClause LIMIT $offset, $resultsPerPage";
$result = $conn2->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['image'] = isset($subjectImages[$row['subject_id']]) ? $subjectImages[$row['subject_id']] : 'https://placehold.co/100x100';
        $filteredLessons[] = $row;
    }
}

// Tính tổng số trang
$sqlCount = "SELECT COUNT(*) AS total FROM lessons WHERE 1 $whereClause";
$totalRows = $conn2->query($sqlCount)->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $resultsPerPage);

if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
    header('Content-Type: application/json');
    echo json_encode([
        'lessons' => $filteredLessons,
        'totalPages' => $totalPages,
        'currentPage' => $currentPage
    ]);
    exit;
}
$user_avatar_url = isset($_SESSION['avatar']) 
    ? "http://localhost/OngNho/img/avatar/users/" . $_SESSION['avatar'] 
    : "http://localhost/OngNho/img/avatar/users/default-avatar.png";
    
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
    <div class="container" style="padding-top: 200px;">
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
                                    <form id="filterForm">
                                        <div class="list-group">
                                            <?php
                                            include("include/db2.php");
                                            $subjectsQuery = "SELECT * FROM subjects";
                                            $subjectsResult = $conn2->query($subjectsQuery);

                                            while ($subject = $subjectsResult->fetch_assoc()) {
                                                echo '<label class="list-group-item">';
                                                echo '<input class="form-check-input me-1" type="checkbox" name="subjects[]" value="' . $subject['id'] . '">';
                                                echo htmlspecialchars($subject['name']);
                                                echo '</label>';
                                            }
                                            ?>
                                        </div>
                                    </form>
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

                                                        <td class="lesson-image"><img src="<?= $subjectImage; ?>" alt=""></td>

                                                        <td class="lesson">
                                                            <strong><?= htmlspecialchars($lesson['title']); ?></strong><br>
                                                            <?= htmlspecialchars($lesson['description']); ?>
                                                        </td>

                                                        <td>
                                                            <p class="hero-badge py-1 px-3 mb-3 text-white d-inline-block shadow text-uppercase rounded-pill"
                                                                style="background-color: #fc7a57;">
                                                                <?= htmlspecialchars($lesson['age_group']); ?>
                                                            </p>
                                                        </td>

                                                        <td class="lesson-link">
                                                            <a href="lesson.php?link=<?= $lessonLink; ?>" class="btn btn-primary">Xem bài học</a>
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
                                                <li class="page-item">
                                                    <a href="" class="page-link" onclick="goToPage(1);">Trang đầu</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="" class="page-link" onclick="goToPage(<?= $currentPage - 1; ?>);">Trước</a>
                                                </li>
                                            <?php else: ?>
                                                <li class="page-item disabled">
                                                    <a href="" class="page-link">Trước</a>
                                                </li>
                                            <?php endif; ?>

                                            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                                                <li class="page-item <?= $page == $currentPage ? 'active' : ''; ?>">
                                                    <a href="" class="page-link" onclick="goToPage(<?= $page; ?>);"><?= $page; ?></a>
                                                </li>
                                            <?php endfor; ?>

                                            <?php if ($currentPage < $totalPages): ?>
                                                <li class="page-item">
                                                    <a href="" class="page-link" onclick="goToPage(<?= $currentPage + 1; ?>);">Sau</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="" class="page-link" onclick="goToPage(<?= $totalPages; ?>);">Trang cuối</a>
                                                </li>
                                            <?php else: ?>
                                                <li class="page-item disabled">
                                                    <a href="" class="page-link">Sau</a>
                                                </li>
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
        document.querySelectorAll('.form-check-input').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                filterResults();
            });
        });

        function filterResults() {
            const selectedSubjects = Array.from(document.querySelectorAll('.form-check-input:checked')).map(cb => cb.value);
            const searchQuery = document.querySelector('input[name="search"]').value;

            fetch(`search.php?search=${encodeURIComponent(searchQuery)}&subjects=${selectedSubjects.join(',')}&ajax=true`)
                .then(response => response.json())
                .then(data => {
                    updateResults(data.lessons);
                    updatePagination(data.currentPage, data.totalPages);
                });
        }

        function updateResults(lessons) {
            const resultsTable = document.querySelector('#results tbody');
            resultsTable.innerHTML = '';

            if (lessons.length === 0) {
                resultsTable.innerHTML = '<tr><td colspan="4" class="text-center">Không tìm thấy bài học nào.</td></tr>';
                return;
            }

            lessons.forEach((lesson, index) => {
                const row = `
                    <tr>
                <td>${index + 1}</td>
                <td><img src="${lesson.image}" alt="" class="lesson-image"></td>
                <td>
                    <strong>${lesson.title}</strong><br>
                    <span>${lesson.description}</span>
                </td>
                <td>
                    <a href="lesson.php?link=${lesson.lesson_link}" class="btn btn-primary">Xem bài học</a>
                </td>
            </tr>
                `;
                resultsTable.innerHTML += row;
            });
        }

        function updatePagination(currentPage, totalPages) {
            const pagination = document.querySelector('.pagination');
            pagination.innerHTML = '';

            // Thêm nút "Trang đầu" và "Trước"
            if (currentPage > 1) {
                pagination.innerHTML += `
            <li class="page-item">
                <a href="#" class="page-link" onclick="goToPage(1);">Trang đầu</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link" onclick="goToPage(${currentPage - 1});">Trước</a>
            </li>
        `;
            } else {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <a href="#" class="page-link">Trước</a>
            </li>
        `;
            }

            // Các trang giữa
            for (let page = 1; page <= totalPages; page++) {
                pagination.innerHTML += `
            <li class="page-item ${page === currentPage ? 'active' : ''}">
                <a href="#" class="page-link" onclick="goToPage(${page});">${page}</a>
            </li>
        `;
            }

            if (currentPage < totalPages) {
                pagination.innerHTML += `
            <li class="page-item">
                <a href="#" class="page-link" onclick="goToPage(${currentPage + 1});">Sau</a>
            </li>
            <li class="page-item">
                <a href="#" class="page-link" onclick="goToPage(${totalPages});">Trang cuối</a>
            </li>
        `;
            } else {
                pagination.innerHTML += `
            <li class="page-item disabled">
                <a href="#" class="page-link">Sau</a>
            </li>
        `;
            }
        }

        function goToPage(page) {
            const searchQuery = document.querySelector('input[name="search"]').value;
            const selectedSubjects = Array.from(document.querySelectorAll('.form-check-input:checked')).map(cb => cb.value);

            // Gửi yêu cầu AJAX
            fetch(`search.php?search=${encodeURIComponent(searchQuery)}&subjects=${selectedSubjects.join(',')}&page=${page}&ajax=true`)
                .then(response => response.json())
                .then(data => {
                    // Cập nhật kết quả và phân trang
                    updateResults(data.lessons);
                    updatePagination(data.currentPage, data.totalPages);
                });
        }
    </script>

    <script src="js/hello.js"></script>
</body>

</html>