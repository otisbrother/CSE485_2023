<?php
// Kết nối cơ sở dữ liệu
include '../db.php';
// Khởi tạo biến để lưu kết quả tìm kiếm
$articles = [];
$searchTerm = '';

// Kiểm tra nếu có từ khóa tìm kiếm
if (isset($_POST['search'])) {
    $searchTerm = $conn->real_escape_string($_POST['search']);
    $sql = "SELECT * FROM baiviet WHERE tieude LIKE '%$searchTerm%'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo2.png" alt="" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./login.php">Đăng nhập</a>
                    </li>
                </ul>
                <form class="d-flex" method="POST" role="search">
                    <input class="form-control me-2" type="search" name="search" placeholder="Nội dung cần tìm" aria-label="Search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button class="btn btn-outline-success" type="submit">Tìm</button>
                </form>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <div class="row mb-5">
                    <div class="col-sm-4">
                        <img src="<?php echo htmlspecialchars($article['hinhanh']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($article['tieude']); ?>">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title mb-2">
                            <a href="#" class="text-decoration-none"><?php echo htmlspecialchars($article['tieude']); ?></a>
                        </h5>
                        <p class="card-text"><span class="fw-bold">Bài hát: </span><?php echo htmlspecialchars($article['ten_bhat']); ?></p>
                        <p class="card-text"><span class="fw-bold">Thể loại: </span><?php echo htmlspecialchars($article['ma_tloai']); ?></p>
                        <p class="card-text"><span class="fw-bold">Tóm tắt: </span><?php echo htmlspecialchars($article['tomtat']); ?></p>
                        <p class="card-text"><span class="fw-bold">Nội dung: </span><?php echo htmlspecialchars($article['noidung']); ?></p>
                        <p class="card-text"><span class="fw-bold">Tác giả: </span><?php echo htmlspecialchars($article['ma_tgia']); ?></p>
                    </div>          
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Không có bài viết nào phù hợp.</p>
        <?php endif; ?>
    </main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
