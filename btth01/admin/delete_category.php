<?php
include '.../db.php'; // file cấu hình kết nối
if (isset($_GET['ma_tloai'])) {
    $ma_tloai = $_GET['ma_tloai'];

    // Thực hiện truy vấn xóa thể loại
    $sql = "DELETE FROM theloai WHERE ma_tloai = $ma_tloai";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa thể loại thành công.";
    } else {
        echo "Lỗi khi xóa thể loại: " . $conn->error;
    }
} else {
    echo "Không tìm thấy mã thể loại để xóa.";
}

$conn->close();
?>
?>
