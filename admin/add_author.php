<?php
include '../db.php'; // Kết nối đến cơ sở dữ liệu

// Xử lý khi người dùng submit form thêm tác giả
if (isset($_POST['add_author'])) {
    $ten_tgia = $_POST['ten_tgia'];
    $hinh_tgia = $_POST['hinh_tgia'];
    
    // Câu lệnh INSERT để thêm mới tác giả
    $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia) 
            VALUES ('$ten_tgia', '$hinh_tgia')";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: author.php'); // Chuyển hướng về trang danh sách tác giả
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
                <h3 class="text-center text-uppercase fw-bold">Thêm mới tác giả</h3>
                <form action="add_author.php" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Tên tác giả</span>
                        <input type="text" class="form-control" name="ten_tgia" required>
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text">Hình ảnh</span>
                        <input type="file" class="form-control" name="hinh_tgia">
                    </div>

                    <div class="form-group float-end">
                        <input type="submit" name="add_author" value="Thêm mới" class="btn btn-success">
                        <a href="author.php" class="btn btn-warning">Quay lại</a>
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
