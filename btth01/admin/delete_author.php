<?php
include '../db.php'; 
// Lấy mã tác giả từ URL
if (isset($_GET['ma_tgia'])) {
    $ma_tgia = $_GET['ma_tgia'];

    // Thực hiện truy vấn xóa tác giả
    $sql = "DELETE FROM tacgia WHERE ma_tgia = $ma_tgia";

    if ($conn->query($sql) === TRUE) {
        echo "Xóa tác giả thành công.";
    } else {
        echo "Lỗi khi xóa tác giả: " . $conn->error;
    }
} else {
    echo "Không tìm thấy mã tác giả để xóa.";
}

$conn->close();
?>
