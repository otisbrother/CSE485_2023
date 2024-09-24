<?php
include '../db.php'; // Kết nối tới cơ sở dữ liệu

// Xử lý xóa tác giả nếu có yêu cầu từ URL
if (isset($_GET['delete_id'])) {
    $ma_tgia = $_GET['delete_id'];

    // Câu lệnh SQL để xóa tác giả
    $sql = "DELETE FROM tacgia WHERE ma_tgia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ma_tgia);

    if ($stmt->execute()) {
        echo "Xóa tác giả thành công.";
    } else {
        echo "Lỗi khi xóa tác giả: " . $conn->error;
    }

    // Đóng câu lệnh
    $stmt->close();
}

// Truy vấn danh sách tác giả
$sql = "SELECT ma_tgia, ten_tgia, hinh_tgia FROM tacgia";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Tác giả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Danh sách Tác giả</h1>
        <a href="add_author.php" class="btn btn-success mb-3">Thêm Tác giả</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Mã tác giả</th>
                    <th scope="col">Tên tác giả</th>
                    <th scope="col">Hình tác giả</th>
                    <th scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['ma_tgia']; ?></td>
                            <td><?php echo $row['ten_tgia']; ?></td>
                            <td><img src="<?php echo $row['hinh_tgia']; ?>" alt="Hình tác giả" width="100"></td>
                            <td>
                                <a href="edit_author.php?id=<?php echo $row['ma_tgia']; ?>" class="btn btn-warning">Sửa</a>
                                <a href="author.php?delete_id=<?php echo $row['ma_tgia']; ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tác giả này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có tác giả nào.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Đóng kết nối
?>
