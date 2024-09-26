<?php
include '../db.php';

// Kiểm tra xem có ID được truyền vào không
$category = null; // Khởi tạo biến $category để tránh lỗi undefined variable

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Lấy thể loại hiện tại
    $result = $conn->query("SELECT * FROM theloai WHERE ma_tloai = $id");

    if ($result && $result->num_rows > 0) {
        $category = $result->fetch_assoc();
    }

    // Cập nhật thể loại nếu có dữ liệu gửi lên
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $category) {
        $ten_tloai = $conn->real_escape_string(trim($_POST['ten_tloai']));

        // Cập nhật vào cơ sở dữ liệu
        $sql = "UPDATE theloai SET ten_tloai='$ten_tloai' WHERE ma_tloai=$id";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Sửa thể loại thành công!'); window.location.href='category.php';</script>";
        } else {
            echo "<script>alert('Lỗi: " . $conn->error . "'); history.back();</script>";
        }
    }
}

// Kiểm tra nếu không tìm thấy thể loại
if (!$category) {
    echo "Thể loại không tồn tại.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin thể loại</h3>
                <form action="" method="post">
                <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã thể loại</span>
                        <input type="text" class="form-control" name="ma_tloai" readonly value="<?php echo $category['ma_tloai']; ?>">
                    </div>

                    <div class="input-group mt-3 mb-3"> 
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="ten_tloai" value="<?php echo $category['ten_tloai']; ?>">

                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>