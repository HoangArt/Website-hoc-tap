<?php
session_start();

$user_avatar_url = isset($_SESSION['avatar']) 
    ? "http://localhost/OngNho/img/avatar/users/" . $_SESSION['avatar'] 
    : "http://localhost/OngNho/img/avatar/default-avatar.png";
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://localhost/OngNho/css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/css/all.css">
    <title>Chính sách quyền riêng tư | Ong Nhỏ</title>
    <link rel="icon" type="image/x-icon" href="../img/logo/Ongnho-icon.png">
</head>

<body style="background-color: #fff9ec;">
    <!-- HEADER -->
    <?php include('../include/header.php'); ?>

    <div class="container" style="margin-top: 160px; margin-bottom: 100px; font-size: large;">
        <h1>Điều Khoản Dịch Vụ</h1><br>
        <p class="fw-bold">1. Giới Thiệu về Ong Nhỏ</p>
        <p>
            Ong Nhỏ là một nền tảng giáo dục trực tuyến giúp trẻ em học tập qua các khóa học đa dạng,
            được dạy bởi các giáo viên có kinh nghiệm.
            Phụ huynh có thể theo dõi tiến độ học tập của trẻ và hỗ trợ quá trình học tập tại nhà.
        </p>

        <p class="fw-bold">2. Đối Tượng Sử Dụng</p>
        <p>Dịch vụ của chúng tôi được cung cấp cho các học sinh từ độ tuổi tiểu học đến đầu trung học cơ sơ
            hoặc đối với bất kỳ ai muốn học tập kiến thức cơ bản.
            Đối với học sinh, phụ huynh hoặc người giám hộ hợp pháp phải đồng ý với các điều khoản dịch vụ
            và giám sát hoạt động học tập của trẻ.
        </p>

        <p class="fw-bold">3. Trách Nhiệm của Người Dùng</p>
        <p>
            - Phụ huynh: Phụ huynh cần đảm bảo rằng trẻ em sử dụng nền tảng Ong Nhỏ dưới sự giám sát và hướng dẫn của họ.
            Phụ huynh có trách nhiệm cung cấp thông tin chính xác và cập nhật về trẻ em, bao gồm các chi tiết như tên, ngày sinh, và liên lạc.<br>

            - Giáo viên: Giáo viên sẽ cung cấp các bài giảng, hướng dẫn, và đánh giá tiến độ học tập của trẻ.
            Giáo viên phải tuân thủ các tiêu chuẩn nghề nghiệp và bảo vệ quyền lợi của học sinh.
        </p>

        <p class="fw-bold">4. Điều Kiện Đăng Ký</p>
        <p>
            Để đăng ký tài khoản trên Ong Nhỏ, phụ huynh cần cung cấp thông tin cá nhân và thông tin của trẻ em.
            Mọi thông tin phải được cung cấp đầy đủ và chính xác.
            Phụ huynh phải đảm bảo rằng họ có quyền sử dụng thông tin này và đồng ý cung cấp cho Ong Nhỏ.
        </p>

        <p class="fw-bold">5. Quyền và Nghĩa Vụ của Ong Nhỏ</p>
        <p>
            Ong Nhỏ cam kết bảo vệ sự riêng tư và bảo mật thông tin của người dùng.
            Chúng tôi có quyền thay đổi, cập nhật hoặc ngừng cung cấp dịch vụ mà không cần thông báo trước.
            Chúng tôi sẽ không trực tiếp chia sẻ thông tin cá nhân của học sinh với bên thứ ba mà không có sự đồng ý của phụ huynh hoặc người giám hộ.
        </p>

        <p class="fw-bold">6. Tiến Độ Học Tập và Đánh Giá</p>
        <p>
            Ong Nhỏ cung cấp các báo cáo và công cụ theo dõi tiến độ học tập của trẻ em.
            Phụ huynh có thể xem các đánh giá này để nắm bắt tiến trình học tập của con em mình.
        </p>

        <p class="fw-bold">7. Quyền Sử Dụng Nội Dung</p>
        <p>
            Tất cả các tài liệu giảng dạy và bài học được cung cấp trên nền tảng Ong Nhỏ
            thuộc quyền sở hữu của chúng tôi hoặc các bên cấp phép.
            Người dùng không được sao chép, sửa đổi hoặc phân phối lại nội dung mà không có sự cho phép của chúng tôi.
            Nếu vi phạm, chúng tôi hoàn toàn có quyền bán thông tin của bạn cho các nhà quảng cáo
            để bồi thường thiệt hại về tài chính.
        </p>

        <p class="fw-bold">8. Hỗ Trợ và Khiếu Nại</p>
        <p>
            Nếu có bất kỳ vấn đề gì liên quan đến dịch vụ,
            người dùng có thể liên hệ với bộ phận hỗ trợ khách hàng của Ong Nhỏ qua email
            hoặc số điện thoại hỗ trợ được cung cấp trên trang web.<br>

            Email: contact@ongnho.com<br>
            Website hỗ trợ: https://www.ongnho.com/lien-lac
        </p>

        <p class="fw-bold"> 9. Sửa Đổi Điều Khoản Dịch Vụ</p>
        <p>
            Chúng tôi có quyền sửa đổi các điều khoản dịch vụ này bất cứ lúc nào mà không cần thông báo trước.
            Mọi thay đổi sẽ có hiệu lực ngay khi được đăng tải trên trang web.
        </p>


        <p>
            Khi bạn tiếp tục sử dụng dịch vụ của Ong Nhỏ, điều đó đồng nghĩa với việc bạn đã đọc,
            hiểu và đồng ý với các điều khoản của chính sách này.
        </p>
    </div>

    <!-- FOOTER -->
    <?php include('../include/footer.php'); ?>
</body>

</html>