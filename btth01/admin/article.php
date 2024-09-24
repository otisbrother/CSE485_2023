<?php
include '../db.php'; // Kết nối 
if (isset($_GET['ma_bviet'])) {
    $id = $_GET['ma_bviet'];
   
    // Thực hiện truy vấn xóa bài viết
    $sql = "DELETE FROM baiviet WHERE ma_bviet = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa bài viết thành công.";
    } else {
        echo "Lỗi khi xóa bài viết: " . $conn->error;
    }
} else {
    echo "Không tìm thấy mã bài viết để xóa.";
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
                <a href="add_article.php" class="btn btn-success">Thêm mới</a>
                <table class="table">
    <thead>
        <tr>
            <th scope="col">Mã bài viết</th>
            <th scope="col">Tiêu đề</th>
            <th scope="col">Tên bài hát</th>
            <th scope="col">Thể loại</th>
            <th scope="col">Tác giả</th>
            <th scope="col">Ngày viết</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Truy vấn lấy danh sách bài viết cùng thể loại, tác giả
        $sql = "SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, theloai.ten_tloai, tacgia.ten_tgia, baiviet.ngayviet 
                FROM baiviet 
                JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai 
                JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị danh sách bài viết
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<th scope='row'>" . $row['ma_bviet'] . "</th>";
                echo "<td>" . $row['tieude'] . "</td>";
                echo "<td>" . $row['ten_bhat'] . "</td>";
                echo "<td>" . $row['ten_tloai'] . "</td>";
                echo "<td>" . $row['ten_tgia'] . "</td>";
                echo "<td>" . $row['ngayviet'] . "</td>";
                echo "<td>
                        <a href='edit_article.php?id=" . $row['ma_bviet'] . "'><i class='fa-solid fa-pen-to-square'></i></a>
                        <a href='?id=" . $row['ma_bviet'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xóa bài viết này?\")'><i class='fa-solid fa-trash'></i></a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>Không có bài viết nào.</td></tr>";
        }
    ?>
    </tbody>
</table>

            </div>
        </div>
    </main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
