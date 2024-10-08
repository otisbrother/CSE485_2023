<?php
include '../db.php'; 

$ma_bviet = $_GET['id']; // Lấy ID bài viết từ URL

// Xử lý khi người dùng submit form sửa bài viết
if (isset($_POST['edit_article'])) {
    $tieude = $_POST['tieude'];
    $noidung = $_POST['noidung'];
    $hinhanh = $_POST['hinhanh'];
    
    // Câu lệnh UPDATE để cập nhật thông tin bài viết
    $sql = "UPDATE baiviet SET tieude='$tieude', noidung='$noidung', hinhanh='$hinhanh' WHERE ma_bviet=$ma_bviet";
    if ($conn->query($sql) === TRUE) {
        header('Location: article.php'); // Chuyển hướng về trang danh sách bài viết
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Truy vấn lấy thông tin bài viết dựa vào ID
$sql = "SELECT * FROM baiviet WHERE ma_bviet=$ma_bviet";
$result = $conn->query($sql);
$article = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Trang ngoài</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php">Thể loại</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="author.php">Tác giả</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin bài viết</h3>
                <form action="" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleId">Mã bài viết</span>
                        <input type="text" class="form-control" name="ma_bviet" readonly value="<?php echo $article['ma_bviet']; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleTitle">Tiêu đề</span>
                        <input type="text" class="form-control" name="tieude" value="<?php echo $article['tieude']; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleContent">Tên bài hát</span>
                        <textarea class="form-control" name=""><?php echo $article['ten_bhat']; ?></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleImage">Thể loại</span>
                        <input type="text" class="form-control" name="hinhanh" value="<?php echo $article['ma_tloai']; ?>">
                    </div>
                    
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleImage">Tác giả</span>
                        <input type="text" class="form-control" name="hinhanh" value="<?php echo $article['ma_tgia']; ?>">
                    </div>
                    
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblArticleImage">Ngày viết</span>
                        <input type="text" class="form-control" name="hinhanh" value="<?php echo $article['ngayviet']; ?>">
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" name="edit_article" value="Lưu lại" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
