<?php
include '../db.php'; // Kết nối đến cơ sở dữ liệu

// Xử lý khi người dùng submit form thêm bài viết
if (isset($_POST['add_article'])) {
    $ma_bviet = $_POST['ma_bviet'];
    $tieude = $_POST['tieude'];
    $ten_bhat = $_POST['ten_bhat'];
    $ma_tloai = $_POST['ma_tloai'];
    $ma_tgia = $_POST['ma_tgia']; 
    $ngayviet = $_POST['ngayviet'];
    // Câu lệnh INSERT để thêm mới bài viết
    $sql = "INSERT INTO baiviet (ma_bviet, tieude,ten_bhat, ma_tloai, ma_tgia, ngayviet) 
            VALUES ('$ma_bviet', '$tieude', '$ten_bhat', $ma_tloai, $ma_tgia NOW())";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: article.php'); // Chuyển hướng về trang danh sách bài viết
    } else {
        echo "Lỗi: " . $conn->error;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới bài viết</h3>
                <form action="add_article.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tiêu đề</span>
                        <input type="text" class="form-control" name="tieude" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tên bài hát</span>
                        <textarea class="form-control" name="ten_bhat" required></textarea>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Thể loại</span>
                        <input type="text" class="form-control" name="ma_tloai">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tác giả</span>
                        <input type="number" class="form-control" name="ma_tgia" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Ngày viết</span>
                        <input type="number" class="form-control" name="ngayviet" required>
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" name="add_article" value="Thêm mới" class="btn btn-success">
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
