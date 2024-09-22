<?php
include '../db.php'; // file cấu hình kết nối
// Lấy mã bài viết từ URL
if (isset($_GET['ma_bviet'])) {
    $ma_bviet = $_GET['ma_bviet'];

    // Thực hiện truy vấn xóa bài viết
    $sql = "DELETE FROM baiviet WHERE ma_bviet = $ma_bviet";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa bài viết thành công.";
    } else {
        echo "Lỗi khi xóa bài viết: " . $conn->error;
    }
} else {
    echo "Không tìm thấy mã bài viết để xóa.";
}

$conn->close();
?>
