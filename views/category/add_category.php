<?php
    require './view/includes/header.php';  
?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới thể loại</h3>
                <form action="./index.php?controller=category&action=store" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="txtCatName" >
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php
    require './view/includes/footer.php';  
?>
<script>
        const form = document.querySelector('form');
        form.addEventListener('submit',(event)=>{
            event.preventDefault();
            var tenTheLoai = document.querySelector('input[name="txtCatName"]');
            if (tenTheLoai.value.trim() === '') {
                    alert('Bạn chưa nhập Tên thể loại');
                    tenTheLoai.style.border = '1px solid red';
                }
                else{
                    form.submit();
                }
        });
</script>