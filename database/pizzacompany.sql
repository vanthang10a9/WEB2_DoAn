-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 18, 2020 lúc 06:35 AM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pizzacompany`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `MADH` int(10) NOT NULL,
  `MASP` varchar(5) NOT NULL,
  `SOLUONG` int(10) NOT NULL,
  `GIASP` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`MADH`, `MASP`, `SOLUONG`, `GIASP`) VALUES
(1, 'HS003', 2, 119000),
(1, 'TT005', 4, 99000),
(2, 'NN001', 4, 99000),
(2, 'TT002', 5, 99000),
(3, 'HS002', 5, 239000),
(3, 'NN003', 2, 89000),
(4, 'NN003', 4, 89000),
(4, 'TC004', 2, 109000),
(5, 'TC006', 2, 109000),
(5, 'TT004', 3, 99000),
(6, 'HS002', 5, 239000),
(6, 'HS004', 3, 119000),
(6, 'NN001', 3, 99000),
(6, 'TC006', 4, 109000),
(7, 'HS001', 2, 239000),
(7, 'HS002', 2, 239000),
(7, 'HS004', 4, 119000),
(7, 'TC006', 3, 109000),
(7, 'TT001', 2, 99000),
(7, 'TT002', 2, 99000),
(7, 'TT003', 2, 99000),
(8, 'TT002', 2, 99000),
(10, 'HS004', 1, 119000),
(10, 'NN001', 2, 99000),
(10, 'TT006', 5, 99000),
(26, 'HS001', 1, 215100),
(26, 'HS002', 1, 191200);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdonnhap`
--

CREATE TABLE `chitietdonnhap` (
  `MADN` int(10) NOT NULL,
  `MASP` varchar(5) NOT NULL,
  `SOLUONG` int(10) NOT NULL,
  `GIANHAP` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitietdonnhap`
--

INSERT INTO `chitietdonnhap` (`MADN`, `MASP`, `SOLUONG`, `GIANHAP`) VALUES
(1, 'TC002', 2, 75000),
(2, 'TC001', 2, 109000),
(3, 'NN002', 2, 40000),
(4, 'TC001', 2, 109000),
(5, 'TT002', 2, 50000),
(6, 'TT005', 3, 50000),
(7, 'TC003', 5, 75000),
(8, 'TT001', 1, 50000),
(9, 'NN002', 3, 40000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `MADH` int(20) NOT NULL,
  `IDUSER` int(20) NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHONE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ADDRESS` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TONGTIEN` int(20) NOT NULL,
  `NGAYDH` date NOT NULL,
  `STATUS` int(1) NOT NULL,
  `MANV` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`MADH`, `IDUSER`, `NAME`, `PHONE`, `ADDRESS`, `EMAIL`, `TONGTIEN`, `NGAYDH`, `STATUS`, `MANV`) VALUES
(1, 7, 'Nguyễn Hồng Như', '0987654797', 'TháiThuận', 'TháiThuận@gmail.com', 634000, '2019-11-20', 1, 3),
(2, 11, 'Lê Hồng Ngọc', '0987654873', 'TháiPhúc', 'TháiPhúc@gmail.com', 1980000, '2019-10-22', 1, 3),
(3, 13, 'Phan Quốc Tuấn', '0987654798', 'ÁiLinh', 'ÁiLinh@gmail.com', 2568000, '2019-06-11', 1, 3),
(4, 16, 'Lương Văn Thắng', '0987654618', 'VănThuận', 'VănThuận@gmail.com', 930000, '2019-06-15', 1, 3),
(5, 21, 'Vỗ Hồng Ngọc', '0987654595', 'TháiThuận', 'TháiThuận@gmail.com', 951000, '2019-11-25', 1, 3),
(6, 24, 'Võ Ái Lan', '0987654214', 'ÁiNhư', 'ÁiNhư@gmail.com', 27055000, '2019-10-20', 1, 4),
(7, 9, 'Nguyễn Anh Thuận', '0987654479', 'VănTuấn', 'VănTuấn@gmail.com', 79956000, '2019-10-20', 1, 4),
(8, 25, 'Lương Thái Tuấn', '0987654630', 'HuyềnLan', 'HuyềnLan@gmail.com', 118000, '2019-04-30', 1, 4),
(10, 13, 'Phan Quốc Tuấn', '0987654798', 'ÁiLinh', 'ÁiLinh@gmail.com', 2675000, '2019-01-01', 1, 3),
(26, 26, '', '', '', '', 421300, '2020-05-12', 0, 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donnhap`
--

CREATE TABLE `donnhap` (
  `MADN` int(10) NOT NULL,
  `MANV` int(10) NOT NULL,
  `TONGTIEN` int(20) NOT NULL,
  `NGAYNHAP` datetime NOT NULL DEFAULT current_timestamp(),
  `DUYET` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donnhap`
--

INSERT INTO `donnhap` (`MADN`, `MANV`, `TONGTIEN`, `NGAYNHAP`, `DUYET`) VALUES
(1, 3, 150000, '2017-02-06 00:00:00', 1),
(2, 3, 218000, '2017-02-14 00:00:00', 1),
(3, 4, 80000, '2019-04-02 00:00:00', 1),
(4, 3, 218000, '2018-02-28 00:00:00', 1),
(5, 4, 100000, '2019-06-11 00:00:00', 1),
(6, 3, 150000, '2019-08-07 00:00:00', 1),
(7, 3, 375000, '2019-10-25 00:00:00', 1),
(8, 4, 50000, '2017-03-18 00:00:00', 1),
(9, 4, 120000, '2018-12-26 00:00:00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `MAKM` int(20) NOT NULL,
  `TENKM` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TENKM_KD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IDUSER` int(20) NOT NULL,
  `NGAYDANGKM` date NOT NULL,
  `NGAYBD` date NOT NULL,
  `NGAYKT` date NOT NULL,
  `MOTAKM` text COLLATE utf8_unicode_ci NOT NULL,
  `HINHANHKM` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`MAKM`, `TENKM`, `TENKM_KD`, `IDUSER`, `NGAYDANGKM`, `NGAYBD`, `NGAYKT`, `MOTAKM`, `HINHANHKM`) VALUES
(1, 'COMBO MÓN NGON SAY MÊ (2-3 người)', 'combo mon ngon say me', 1, '2019-04-01', '2019-04-01', '2019-04-30', '<p><strong>COMBO MÓN NGON SAY MÊ (2-3 người)</strong></p>\r\n<p>Combo bao gồm: 1 Pizza Classic (cỡ M, đế đặc biệt viền phô mai/viền phô mai xúc xích), 1 Mỳ Ý (bất kỳ), 1 Cánh gà nướng BBQ/Cánh gà tẩm bột chiên giòn (10pcs).</p>\r\n<p>&diams;  Áp dụng tất cả các ngày trong tuần</p>\r\n\r\n', 'combo2-3nguoi.png'),
(2, 'MUA 1 TẶNG 1', 'mua 1 tang 1', 1, '2019-04-01', '2019-04-01', '2019-04-30', '<p><strong>MUA 1 TẶNG 1</strong></p>\r\n<p>Mua 1 Pizza bất kỳ từ size M tặng 1 Pizza (Pan/Crispy Thin) dòng Classic cùng cỡ.</br>\r\n&diams;  Áp dụng từ 17h-19h thứ 5 hàng tuần\r\n<p>&diams; Không áp dụng với các chương trình ưu đãi khác</p>\r\n', 'mua1tang1.png'),
(3, 'GIẢM 50% CHO PIZZA THỨ 2', 'giam 50% cho pizza thu 2', 1, '2019-04-01', '2019-04-01', '2019-04-30', '<p><strong> GIẢM 50% CHO PIZZA THỨ 2</strong></p>\r\n<p>Mua 1 Pizza (size M, L) và bất kỳ 1 nước kèm theo được giảm 50% Pizza cho Pizza thứ 2 (cùng size, giá trị thấp hơn hoặc bằng pizza nguyên giá). Áp dụng cho mua mang về hoặc giao hàng tận nơi khi đặt hàng qua website. Miễn phí giao hàng tận nơi trong phạm vi bán kính 3km</p>\r\n<p>&diams;  Chỉ áp dụng thứ 2 hàng tuần</p>\r\n<p>&diams;  Không áp dụng với các ưu đãi khác</p>\r\n', 'giam50.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MACL` int(20) NOT NULL,
  `TENCL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `HINHANHSP` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`MACL`, `TENCL`, `HINHANHSP`) VALUES
(1, 'Truyền thống', 'TruyenThong'),
(2, 'Thập cẩm', 'ThapCam'),
(3, 'Hải sản cao cấp', 'HaiSanCaoCap'),
(4, 'Nhân nhồi', 'NhanNhoi'),
(5, 'Pizza Nướng', 'Nuong'),
(6, 'Pizza Chay', 'Chay'),
(7, 'Loại Đặc Biệt', 'DacBiet'),
(8, 'Hawaii', 'Hawaiian');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MANCC` int(10) NOT NULL,
  `TENNCC` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `THONGTIN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhacungcap`
--

INSERT INTO `nhacungcap` (`MANCC`, `TENNCC`, `THONGTIN`) VALUES
(1, 'Anh Tuấn', 'Công ty cung cấp nguyên liệu Anh Tuấn'),
(2, 'Ái Lan', 'Công ty cung cấp nguyên liệu Ái Lan'),
(3, 'Thái Phúc', 'Công ty cung cấp nguyên liệu Thái Phúc'),
(4, 'Hồng Lan', 'Công ty cung cấp nguyên liệu Hồng Lan'),
(5, 'Hồng Linh', 'Công ty cung cấp nguyên liệu Hồng Linh'),
(6, 'Huyền Ngọc', 'Công ty cung cấp nguyên liệu Huyền Ngọc'),
(7, 'Anh Tuấn', 'Công ty cung cấp nguyên liệu Anh Tuấn'),
(8, 'Quốc Thắng', 'Công ty cung cấp nguyên liệu Quốc Thắng'),
(9, 'Huyền Linh', 'Công ty cung cấp nguyên liệu Huyền Linh'),
(10, 'Huyền Linh', 'Công ty cung cấp nguyên liệu Huyền Linh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phanhoi`
--

CREATE TABLE `phanhoi` (
  `IDPH` int(20) NOT NULL,
  `IDUSER` int(20) NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ADDRESS` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHONE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TIEUDE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MOTA` text COLLATE utf8_unicode_ci NOT NULL,
  `NGAYPH` date NOT NULL,
  `STATUS` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phanhoi`
--

INSERT INTO `phanhoi` (`IDPH`, `IDUSER`, `NAME`, `ADDRESS`, `PHONE`, `TIEUDE`, `MOTA`, `NGAYPH`, `STATUS`) VALUES
(1, 15, 'Tuấn Hùng', '123 ngô quyền, quận 5, tp hcm', '1234567890', 'Tuyệt Vời', '<p><strong>Đồ ăn của cửa hàng rất &nbsp;ư l&agrave; tuyệt vời&nbsp;ạ.</strong></p>\r\n', '2017-05-19', 0),
(2, 14, 'Dân Thường', 'nhà đối diện', '2147483647', 'Cửa hàng đẹp', 'Thức ăn ngon, cửa hàng sạch đẹp\r\n', '2017-06-01', 1),
(3, 15, 'Cô hàng xóm', 'sát vách', '2147483647', 'Anh chủ shop đẹp trai', '<p>Cho hỏi anh chủ shop c&oacute; người y&ecirc;u chưa&nbsp;ạ?</p>\r\n', '2018-04-16', 1),
(4, 14, 'Nguyễn Duy Vàng', '123 đường 3 tháng 2 quận 10 tp hcm', '01234567890', 'Chất lượng sản phẩm', '<p>thức ăn ngon lắm cửa h&agrave;ng ơi!!!</p>\r\n', '2019-05-17', 1),
(5, 13, 'duy vang', '132 3 tháng 2 quận 10 tp hcm', '0911482088', 'dịch vụ', '<p>dịch vụ của cửa h&agrave;ng rất tốt</p>\r\n', '2019-05-17', 0),
(6, 13, 'duy vang', '132 3 tháng 2 quận 10 tp hcm', '0911482088', 'Chất lượng sản phẩm', '<p>ngon v&agrave; rẻ</p>\r\n', '2019-05-18', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MASP` varchar(10) CHARACTER SET utf8 NOT NULL,
  `MACL` int(10) NOT NULL,
  `TENSP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TENSPKD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `GIASP` int(20) NOT NULL,
  `KMSP` int(100) NOT NULL,
  `MOTASP` text COLLATE utf8_unicode_ci NOT NULL,
  `MANCC` int(10) NOT NULL,
  `DUYET` tinyint(2) NOT NULL DEFAULT 2,
  `HINHANHSP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `SOLUONGSP` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MASP`, `MACL`, `TENSP`, `TENSPKD`, `GIASP`, `KMSP`, `MOTASP`, `MANCC`, `DUYET`, `HINHANHSP`, `SOLUONGSP`) VALUES
('DB001', 7, 'Pizza Đặc Biệt', 'pizza dac biet', 240000, 0, 'Pizza đặc biệt kết hợp nhiều toppong', 3, 2, 'DacBiet.png', 1),
('HS001', 3, 'Pizza \"Lẩu\" Thái Tom', 'pizza lau thai tom', 239000, 10, '<p>Pizza Tom Yum Kung, lấy cảm hứng từ món lẩu Tom Yum nổi tiếng Thái Lan,\"đánh bật\" vị giác với sốt Tom Yum chua chua, cay cay, ngọt ngọt, béo béo làm thay đổi hoàn toàn nhận định của bạn về chiếc bánh pizza đơn thuần.</p>\r\n', 1, 2, 'LauThaiTom.png', 1),
('HS002', 3, 'Pizza Hải Sản Pesto', 'pizza hai san pesto', 239000, 20, '<p>Quý cô Pizza Hải Sản sốt Pesto đúng chất \"sành điệu kiểu Ý\": Làm cho bạn có cảm giác khác lạ lúc ban đầu, nhưng một khi đã \"tiếp xúc\" thì sẽ mê mẩn ngay càng xa càng nhớ.</p>\r\n', 5, 2, 'HaiSanPesto.png', 1),
('HS003', 3, 'Pizza Hải Sản Cao Cấp', 'hai san cao cap', 119000, 0, '<p>Pizza tuyệt hảo từ hải sản tươi ngon tôm, cua, mực và nghêu mang bạn đến thiên đường hải sản></p>\r\n', 10, 2, 'HaiSanCaoCap.png', 1),
('HS004', 3, 'Pizza Hải Sản Cocktail', 'hai san cocktail', 119000, 0, '<p>Pizza hải sản với sốt Thousand Island và vô vàn các topping tươi ngon từ tôm, cua, giăm bông,...</p>\r\n', 5, 2, 'HaiSanCocktail.png', 1),
('HS005', 3, 'Pizza Hải Sản Nhiệt Đới', 'hai san nhiet doi', 119000, 0, '<p>Với sự kết hợp hoàn hảo của hải sản vùng nhiệt đới như tôm, nghêu, mực, cua, dứa với sốt Thousand Island.></p>\r\n', 3, 2, 'HaiSanNhietDoi.png', 1),
('HS006', 3, 'Pizza Tôm Cocktail', 'tom cocktail', 119000, 0, '<p>Pizza cocktail tôm với nấm, dứa, cà chua và sốt Thousand Island.</p>\r\n', 4, 2, 'TomCocktail.png', 1),
('HW001', 8, 'Pizza Hawaii', 'pizza hawaii', 150000, 0, 'Pizza hawaii kết hợp nhiều toppong', 3, 2, 'Hawaiian.png', 1),
('NN001', 4, '5 Loại Thịt Đặc Biệt', '5 loai thit dac biet', 99000, 0, '<p>Nhân nhồi bên trong siêu thượng hạng với nhiểu loại thịt và rau phong phú.</p>\r\n', 7, 2, '5LoaiThitDD.png', 1),
('NN002', 4, 'Hawaiian Nhân Nhồi', 'hawaiian nhân nhồi', 89000, 0, '<p>Nhân nhồi bên trong là đặc trưng miền nhiệt đới với giăm bông, thịt muối và dứa.</p>\r\n', 1, 2, 'HawaiianNN.png', 1),
('NN003', 4, 'Gà Nướng 3 Vị Nhân Nhồi', 'ga nuong 3 vi nhan nhoi', 89000, 15, '<p>Nhân nhồi bên trong được kết hợp giữa ba cách chế biến gà nướng, gà bơ tỏi và gà ướp sốt nấm mang đến cho bạn hương vị mới lạ.</p>\r\n', 9, 2, 'GaNuong3ViNN.png', 1),
('PC001', 6, 'Pizza Chay', 'pizza chay', 120000, 0, 'Pizza chay thơm ngon, giòn', 6, 2, 'Chay.png', 1),
('PN001', 5, 'Pizza Nướng', 'pizza nuong', 120000, 0, 'Pizza Nướng thơm ngon, giòn', 2, 2, 'Nuong.png', 1),
('TC001', 2, 'Pizza Aloha', 'aloha', 109000, 0, '<p>Thịt nguội, xúc xích tiêu cay và dứa hòa quyện với sôt Thousand Island mang đến hương vị đặc trưng của bánh./p>\r\n', 5, 2, 'aloha.png', 1),
('TC002', 2, 'Ba Loại Thịt Thập Cẩm', 'ba loai thit thap cam', 109000, 0, '<p>Bánh là sự kết hợp hài hòa\r\ncủa ba loại thịt và rau củ.</p>\r\n', 4, 2, 'BaLoaiThit.png', 1),
('TC003', 2, 'Pizza Thịt Xông Khói', 'thit xong khoi', 109000, 30, '<p>Bánh pizza kết hợp giữa thịt giăm bông, thịt xông khói và hai loại rau của ớt xanh, cà chua.</p>\r\n', 6, 2, 'ThitXongKhoi.png', 1),
('TC004', 2, 'Pizza Gà Nướng 3 Vị', 'ga nuong 3 vi', 109000, 0, '<p>Bánh pizza được kết hợp giữa ba cách chế biến gà nướng, gà bơ tỏi và gà ướp sốt nấm mang đến cho bạn hương vị mới lạ.</p>\r\n', 2, 2, 'GaNuong3Vi.png', 1),
('TC005', 2, 'Pizza Kiểu Canada', 'pizza kieu canada', 109000, 0, '<p>Bánh pizza thịt nguội kiểu Canada mang đến cho bạn phong cách Canadian bằng sự kết hợp giữa thịt nguội và bắp ngọt.</p>\r\n', 6, 2, 'Canada.png', 1),
('TC006', 2, '5 Loại Thịt Đặc Biệt', '5 loại thịt đặc biệt', 109000, 45, '<p>Bánh pizza siêu thượng hạng với vô vàn loại thịt đặc biệt như xúc xích heo, giăm bông, thịt xông khói,...và cả thế giới rau phong phú.</p>\r\n', 7, 2, '5LoaiThit.png', 1),
('TT001', 1, 'Pizza Xúc xích Ý', 'xuc xich y', 99000, 0, '<p>Bánh Pizza xúc xích cay kiểu Ý trên nền sốt cà chua mang lại hương vị trộn lẫn giữa cay cay và chua chua.</p>', 9, 2, 'XucXichY.png', 1),
('TT002', 1, 'Pizza Phô mai', 'pho mai', 99000, 0, '<p>Bánh pizza với vô vàn phô mai để bạn tha hồ tận hưởng.</p>\r\n\r\n\r\n', 8, 2, 'PhoMai.png', 1),
('TT003', 1, 'Pizza Thịt nguội & Nấm', 'thit nguoi & nam', 99000, 0, '<p>Bánh pizza giăm bông với nấm đem đến cho bạn đến những trãi nghiệm thú vị.</p>\r\n', 3, 2, 'ThitNguoi&Nam.png', 1),
('TT004', 1, 'Pizza Gà Nướng Dứa', 'ga nuong dua', 99000, 0, '<p>Bánh pizza thịt gà mang vị ngọt của dứa kết với vị cay nóng của ớt tạo nên một nét rất riêng.</p>\r\n', 5, 2, 'GaNuongDua.png', 1),
('TT005', 1, 'Pizza Rau Củ', 'rau cu', 99000, 25, '<p>Bánh pizza rau củ gồm hành, ớt chuông, nấm, dứa, cà chua là sự lựa chọn tuyệt vời cho người ăn chay.</p>\r\n', 9, 2, 'RauCu.png', 1),
('TT006', 1, 'Pizza Hawaiian', 'hawaiian', 99000, 0, '<p>Bánh pizza đặc trưng miền nhiệt đới với giăm bông, thịt muối và dứa tạo nên sự kết hợp ngon tuyệt giữa vị ngọt và chua.></p>\r\n', 10, 2, 'Hawaiian.png', 1),
('TT007', 1, 'Pizza Bò', 'pizzabo', 159000, 0, '<p>vị b&ograve; ngon</p>\r\n', 10, 2, 'Bo.png', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `IDUSER` int(10) NOT NULL,
  `USERNAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CMND` varchar(10) CHARACTER SET utf8 NOT NULL,
  `ADDRESS` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PHONE` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `LEVEL` int(1) NOT NULL,
  `DUYET` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`IDUSER`, `USERNAME`, `PASSWORD`, `NAME`, `CMND`, `ADDRESS`, `EMAIL`, `PHONE`, `LEVEL`, `DUYET`) VALUES
(1, 'admin', '123456', 'Nguyễn Thái Thuận', '0234567892', 'Bình Định', 'ntthuan1998z@gmail.com', '0902636465', 3, 1),
(2, 'manager', '123456', 'Trần Quốc Thắng', '025639954', 'TP.HCM', 'tranquocthang@gmail.com', '0902634567', 2, 1),
(3, 'nhanvien1', '123456', 'Lê Văn Thắng', '0563214563', 'An Giang', 'levanthang@gmail.com', '0987654321', 1, 1),
(4, 'nhanvien2', '123456', 'Hồ Hồng Phúc', '0773214563', 'Đắc Lắc', 'phucpink@gmail.com', '0987653421', 1, 1),
(5, 'khachhang1', '123456', 'Trần Tuấn Anh', '0773214563', 'Cà Mau', 'uchiha@gmail.com', '0563852789', 1, 1),
(6, 'khachhang7', '123456', 'Trần Văn Tuấn', '0182977990', 'TháiThắng', 'TháiThắng@gmail.com', '0987654490', 1, 1),
(7, 'khachhang8', '123456', 'Nguyễn Hồng Như', '0711587671', 'TháiThuận', 'TháiThuận@gmail.com', '0987654797', 1, 1),
(8, 'khachhang9', '123456', 'Võ Hồng Như', '0605335167', 'HuyềnLan', 'HuyềnLan@gmail.com', '0987654416', 1, 1),
(9, 'khachhang10', '123456', 'Nguyễn Anh Thuận', '0374847041', 'VănTuấn', 'VănTuấn@gmail.com', '0987654479', 1, 1),
(10, 'khachhang11', '123456', 'Nguyễn Anh Phúc', '0642477320', 'QuốcThắng', 'QuốcThắng@gmail.com', '0987654793', 1, 1),
(11, 'khachhang12', '123456', 'Lê Hồng Ngọc', '0531468710', 'TháiPhúc', 'TháiPhúc@gmail.com', '0987654873', 1, 1),
(12, 'khachhang13', '123456', 'Trần Hồng Ngọc', '0165115804', 'VănThuận', 'VănThuận@gmail.com', '0987654298', 1, 1),
(13, 'khachhang14', '123456', 'Phan Quốc Tuấn', '0186722131', 'ÁiLinh', 'ÁiLinh@gmail.com', '0987654798', 1, 1),
(14, 'khachhang15', '123456', 'Lương Huyền Linh', '0705424307', 'QuốcTuấn', 'QuốcTuấn@gmail.com', '0987654489', 1, 1),
(15, 'khachhang16', '123456', 'Hồ Văn Tuấn', '0451139523', 'HồngNhư', 'HồngNhư@gmail.com', '0987654167', 1, 1),
(16, 'khachhang17', '123456', 'Lương Văn Thắng', '0410029475', 'VănThuận', 'VănThuận@gmail.com', '0987654618', 1, 1),
(17, 'khachhang18', '123456', 'Nguyễn Thị Linh', '0613676445', 'TháiTuấn', 'TháiTuấn@gmail.com', '0987654776', 1, 1),
(18, 'khachhang19', '123456', 'Nguyễn Thái Thắng', '0868865163', 'ThịNgọc', 'ThịNgọc@gmail.com', '0987654488', 1, 1),
(19, 'khachhang20', '123456', 'Trần Ái Ngọc', '0810193192', 'HồngNhư', 'HồngNhư@gmail.com', '0987654415', 1, 1),
(20, 'khachhang21', '123456', 'Nguyễn Quốc Phúc', '0534552421', 'ÁiNgọc', 'ÁiNgọc@gmail.com', '0987654882', 1, 1),
(21, 'khachhang22', '123456', 'Võ Hồng Ngọc', '0874584250', 'TháiThuận', 'TháiThuận@gmail.com', '0987654595', 1, 1),
(22, 'khachhang23', '123456', 'Trần Hồng Ngọc', '0154809071', 'HồngNgọc', 'HồngNgọc@gmail.com', '0987654635', 1, 1),
(23, 'khachhang24', '123456', 'Nguyễn Quốc Thắng', '0476762185', 'AnhPhúc', 'AnhPhúc@gmail.com', '0987654445', 1, 1),
(24, 'khachhang25', '123456', 'Võ Ái Lan', '0464515268', 'ÁiNhư', 'ÁiNhư@gmail.com', '0987654214', 1, 1),
(25, 'khachhang26', '123456', 'Lương Thái Tuấn', '0478465707', 'HuyềnLan', 'HuyềnLan@gmail.com', '0987654630', 1, 1),
(26, 'trunghien', '123123', 'huỳnh trung hiển', '', '6', 'hienhuynh076@gmail.com', '0925351662', 0, 1),
(27, '', '', '', '', '', '', '', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`MADH`,`MASP`),
  ADD KEY `fk_ctdh_sp` (`MASP`);

--
-- Chỉ mục cho bảng `chitietdonnhap`
--
ALTER TABLE `chitietdonnhap`
  ADD PRIMARY KEY (`MADN`,`MASP`),
  ADD KEY `fk_ctdn_sp` (`MASP`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MADH`),
  ADD KEY `fk_dh_user` (`IDUSER`),
  ADD KEY `fk_dh_manv` (`MANV`);

--
-- Chỉ mục cho bảng `donnhap`
--
ALTER TABLE `donnhap`
  ADD PRIMARY KEY (`MADN`),
  ADD KEY `fk_dn_manv` (`MANV`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`MAKM`),
  ADD KEY `fk_km_user` (`IDUSER`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MACL`);

--
-- Chỉ mục cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  ADD PRIMARY KEY (`MANCC`);

--
-- Chỉ mục cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  ADD PRIMARY KEY (`IDPH`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MASP`),
  ADD KEY `fk_sp_cl` (`MACL`),
  ADD KEY `fk_sp_ncc` (`MANCC`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`IDUSER`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MADH` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `donnhap`
--
ALTER TABLE `donnhap`
  MODIFY `MADN` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `MAKM` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `MACL` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `nhacungcap`
--
ALTER TABLE `nhacungcap`
  MODIFY `MANCC` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `phanhoi`
--
ALTER TABLE `phanhoi`
  MODIFY `IDPH` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `IDUSER` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `fk_ctdh_dh` FOREIGN KEY (`MADH`) REFERENCES `donhang` (`MADH`),
  ADD CONSTRAINT `fk_ctdh_sp` FOREIGN KEY (`MASP`) REFERENCES `sanpham` (`MASP`);

--
-- Các ràng buộc cho bảng `chitietdonnhap`
--
ALTER TABLE `chitietdonnhap`
  ADD CONSTRAINT `fk_ctdn_dn` FOREIGN KEY (`MADN`) REFERENCES `donnhap` (`MADN`),
  ADD CONSTRAINT `fk_ctdn_sp` FOREIGN KEY (`MASP`) REFERENCES `sanpham` (`MASP`);

--
-- Các ràng buộc cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `fk_dh_manv` FOREIGN KEY (`MANV`) REFERENCES `taikhoan` (`IDUSER`),
  ADD CONSTRAINT `fk_dh_user` FOREIGN KEY (`IDUSER`) REFERENCES `taikhoan` (`IDUSER`);

--
-- Các ràng buộc cho bảng `donnhap`
--
ALTER TABLE `donnhap`
  ADD CONSTRAINT `fk_dn_manv` FOREIGN KEY (`MANV`) REFERENCES `taikhoan` (`IDUSER`);

--
-- Các ràng buộc cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `fk_km_user` FOREIGN KEY (`IDUSER`) REFERENCES `taikhoan` (`IDUSER`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sp_cl` FOREIGN KEY (`MACL`) REFERENCES `loaisanpham` (`MACL`),
  ADD CONSTRAINT `fk_sp_ncc` FOREIGN KEY (`MANCC`) REFERENCES `nhacungcap` (`MANCC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
