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

-- g, . Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT baiviet.ma_bviet, baiviet.ten_bhat, tacgia.ten_tgia, baiviet.ngayviet, baiviet.hinhanh, baiviet.tomtat, baiviet.noidung, baiviet.ma_tloai FROM baiviet,tacgia WHERE baiviet.ten_bhat LIKE '%yêu%' OR baiviet.ten_bhat LIKE '%thương%' OR baiviet.ten_bhat LIKE '%anh%' OR baiviet.ten_bhat LIKE '%em%';
