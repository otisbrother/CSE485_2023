<?php
require './view/includes/header.php';
?>
<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="index.php?controller=article&action=add" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã bài viết</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Tên bài hát</th>
                        <th scope="col">Tên thể loại</th>
                        <th scope="col">Tóm tắt</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Tên tác giả</th>
                        <th scope="col">Ngày viết</th>
                        <th scope="col">Hình ảnh</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($articles as $key => $item) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $item->getMaBviet() ?></th>
                            <td><?php echo $item->getTieude() ?></td>
                            <td><?php echo $item->getTenBhat() ?></td>
                            <td><?php echo $item->getMaTloai() ?></td>
                            <td><?php echo $item->getTomtat() ?></td>
                            <td><?php echo $item->getNoidung() ?></td>
                            <td><?php echo $item->getMaTgia() ?></td>
                            <td><?php echo $item->getNgayviet() ?></td>
                            <td>
                                <img src="./asset/images/article/<?php echo $item->getHinhanh() ?>" class="rounded-3" style="width: 150px;" alt="...">
                            </td>
                            <td>
                                <a href="index.php?controller=article&action=edit&id=<?php echo $item->getMaBviet() ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="showConfirmationDialog(<?php echo $item->getMaBviet() ?>)"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script>
    function showConfirmationDialog(id) {
        if (confirm("Bạn có muốn xóa không?")) {
            window.location.href = "index.php?controller=article&action=delete&id=" + id;
        }
    }
</script>
<?php
require './view/includes/footer.php';
?>