-- a, Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình
SELECT * FROM baiviet where ma_tloai = 8;

-- b, Liệt kê các bài viết của tác giả “Nhacvietplus”
SELECT * FROM baiviet LEFT JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia WHERE tacgia.ten_tgia = "Nhacvietplus";

-- c, Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào.
SELECT * from theloai as tl WHERE tl.ma_tloai NOT IN (SELECT bv.ma_tloai FROM baiviet as bv);

-- d, Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết.
SELECT bv.ma_bviet as "mã bài viết", bv.ten_bhat as "tên bài hát", tg.ten_tgia as "tên tác giả", tl.ten_tloai as "tên thể loại", bv.ngayviet as "ngày viết" FROM baiviet as bv LEFT JOIN tacgia as tg ON tg.ma_tgia = bv.ma_tgia LEFT JOIN theloai as tl ON tl.ma_tloai = bv.ma_tloai;

-- e, Tìm thể loại có số bài viết nhiều nhất
SELECT theloai.*,COUNT(baiviet.ma_tloai) as "Số bài viết" FROM theloai
LEFT JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
GROUP BY theloai.ma_tloai, theloai.ten_tloai
ORDER BY COUNT(baiviet.ma_tloai) DESC
LIMIT 1

-- f, Liệt kê 2 tác giả có số bài viết nhiều nhất
SELECT tacgia.*,COUNT(baiviet.ma_tgia) as "Số bài viết" FROM tacgia
LEFT JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY tacgia.ma_tgia, tacgia.ten_tgia, tacgia.hinh_tgia
ORDER BY COUNT(baiviet.ma_tgia) DESC
LIMIT 2

-- g, Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT baiviet.ma_bviet, baiviet.ten_bhat, tacgia.ten_tgia, baiviet.ngayviet, baiviet.hinhanh, baiviet.tomtat, baiviet.noidung, baiviet.ma_tloai FROM baiviet,tacgia WHERE baiviet.ten_bhat LIKE '%yêu%' OR baiviet.ten_bhat LIKE '%thương%' OR baiviet.ten_bhat LIKE '%anh%' OR baiviet.ten_bhat LIKE '%em%';

--h, Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em” 
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia, baiviet.ngayviet, baiviet.hinhanh, baiviet.tomtat, baiviet.noidung, baiviet.ma_tloai 
FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE baiviet.tieude LIKE '%yêu%' 
   OR baiviet.tieude LIKE '%thương%' 
   OR baiviet.tieude LIKE '%anh%' 
   OR baiviet.tieude LIKE '%em%' 
   OR baiviet.ten_bhat LIKE '%yêu%' 
   OR baiviet.ten_bhat LIKE '%thương%' 
   OR baiviet.ten_bhat LIKE '%anh%' 
   OR baiviet.ten_bhat LIKE '%em%';

--i,Tạo 1 view có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên thể loại và tên tác giả 
CREATE VIEW vw_Music AS
SELECT bv.ma_bviet, bv.tieude, bv.ten_bhat, tl.ten_tloai, tg.ten_tgia, bv.ngayviet, bv.hinhanh
FROM baiviet AS bv
JOIN theloai AS tl ON bv.ma_tloai = tl.ma_tloai
JOIN tacgia AS tg ON bv.ma_tgia = tg.ma_tgia;
--j,Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi.
DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN tenTheLoai VARCHAR(100))
BEGIN
    DECLARE maTheLoai INT;
    
    -- Kiểm tra xem thể loại có tồn tại không
    SELECT ma_tloai INTO maTheLoai 
    FROM theloai 
    WHERE ten_tloai = tenTheLoai;
    
    -- Nếu không tồn tại, hiển thị thông báo lỗi
    IF maTheLoai IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Thể loại không tồn tại!';
    ELSE
        -- Nếu tồn tại, hiển thị danh sách bài viết
        SELECT bv.tieude, bv.ten_bhat, bv.ngayviet, bv.tomtat
        FROM baiviet AS bv
        WHERE bv.ma_tloai = maTheLoai;
    END IF;
END //

DELIMITER ;

--k,Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo. (
ALTER TABLE theloai ADD COLUMN SLBaiViet INT DEFAULT 0;
DELIMITER //

-- Trigger khi thêm bài viết
CREATE TRIGGER tg_CapNhatTheLoai_Insert
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai 
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END //

-- Trigger khi sửa bài viết
CREATE TRIGGER tg_CapNhatTheLoai_Update
AFTER UPDATE ON baiviet
FOR EACH ROW
BEGIN
    IF NEW.ma_tloai != OLD.ma_tloai THEN
        UPDATE theloai 
        SET SLBaiViet = SLBaiViet - 1
        WHERE ma_tloai = OLD.ma_tloai;
        
        UPDATE theloai 
        SET SLBaiViet = SLBaiViet + 1
        WHERE ma_tloai = NEW.ma_tloai;
    END IF;
END //

-- Trigger khi xóa bài viết
CREATE TRIGGER tg_CapNhatTheLoai_Delete
AFTER DELETE ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai 
    SET SLBaiViet = SLBaiViet - 1
    WHERE ma_tloai = OLD.ma_tloai;
END //

DELIMITER ;
