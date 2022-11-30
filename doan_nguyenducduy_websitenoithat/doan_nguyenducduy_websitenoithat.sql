-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 29, 2022 lúc 04:14 PM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan_nguyenducduy_websitenoithat`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `role_admin` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `img_path` varchar(120) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`, `phone`, `address`, `role_admin`, `status`, `img_path`, `createdAt`, `updatedAt`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 'quangd@gmail.com', '0966111111', 'HY', 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `id_hoadon` int(10) UNSIGNED NOT NULL,
  `id_donhang` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`id_hoadon`, `id_donhang`, `created_at`, `updated_at`) VALUES
(1, 10, '2022-11-29 09:55:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id_donhang` int(10) UNSIGNED NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `TenKH` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `SDT` varchar(12) NOT NULL,
  `DiaChi` varchar(100) NOT NULL,
  `GhiChu` mediumtext,
  `QTY` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`id_donhang`, `id_sanpham`, `TenKH`, `email`, `SDT`, `DiaChi`, `GhiChu`, `QTY`, `ThanhTien`, `status`, `create_at`, `update_at`) VALUES
(10, 10, 'nguyen duc duy ', 'duycute200285@gmaiil.com', '0888694303', 'Trảng bom', 'hellooo nhớ đóng hàng cẩn thận nha', 1, 1000000, 1, '2022-11-29 04:32:48', '0000-00-00 00:00:00'),
(11, 9, 'nguyen duc duy ', 'duycute200285@gmaiil.com', '0888694303', 'Trảng bom', 'hellooo nhớ đóng hàng cẩn thận nha', 1, 100000000, 0, '2022-11-29 04:32:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisp`
--

CREATE TABLE `loaisp` (
  `id_loai` int(10) UNSIGNED NOT NULL,
  `TenLoai` varchar(200) NOT NULL,
  `gioitinh` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `loaisp`
--

INSERT INTO `loaisp` (`id_loai`, `TenLoai`, `gioitinh`, `status`, `created_at`, `updated_at`) VALUES
(8, 'Bàn ăn già đình', 1, 1, '0000-00-00 00:00:00', '2022-11-29 09:03:58'),
(9, 'Bàn văn phòng', 1, 1, '0000-00-00 00:00:00', '2022-11-29 09:04:09'),
(10, 'Bàn decor phòng khách', 1, 1, '2022-11-29 09:21:43', '0000-00-00 00:00:00'),
(11, 'Ghế gia đình ', 0, 1, '2022-11-29 09:26:35', '0000-00-00 00:00:00'),
(12, 'ghế văn phòng ', 0, 1, '2022-11-29 09:26:46', '0000-00-00 00:00:00'),
(13, 'Ghế decor', 0, 1, '2022-11-29 09:27:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member`
--

CREATE TABLE `member` (
  `id_member` int(10) UNSIGNED NOT NULL,
  `TenDangNhap` varchar(200) NOT NULL,
  `MatKhau` varchar(200) NOT NULL,
  `TenHienThi` varchar(200) NOT NULL,
  `DiaChi` varchar(200) NOT NULL,
  `SDT` varchar(12) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `TrangThai` tinyint(4) NOT NULL,
  `authen_key` varchar(255) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `member`
--

INSERT INTO `member` (`id_member`, `TenDangNhap`, `MatKhau`, `TenHienThi`, `DiaChi`, `SDT`, `Email`, `TrangThai`, `authen_key`, `created_time`, `updated_time`) VALUES
(6, 'admin', '25d55ad283aa400af464c76d713c07ad', 'nguyen duc duy', 'trang bom', '', 'duycute200285@gmaiil.com', 0, 'AxhmXCzYPWUpKzhLBVUP4PbopFAachBurIO5hXEyF9U', '2022-11-29 04:20:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanhieu`
--

CREATE TABLE `nhanhieu` (
  `id_nhanhieu` int(10) UNSIGNED NOT NULL,
  `ten_nhanhieu` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nhanhieu`
--

INSERT INTO `nhanhieu` (`id_nhanhieu`, `ten_nhanhieu`, `image`, `status`, `created_at`, `updated_at`) VALUES
(17, 'AConcept', 'tabble.jpg', 1, '2022-11-29 03:01:08', '0000-00-00 00:00:00'),
(18, 'Baya', 'tabble_4.jpg', 1, '2022-11-29 03:18:23', '0000-00-00 00:00:00'),
(19, 'Carpanese Home', 'slider_2.jpg', 1, '2022-11-29 09:06:31', '0000-00-00 00:00:00'),
(20, 'Mobilpiu', 'slider_1.jpg', 1, '2022-11-29 09:07:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id_sanpham` int(10) UNSIGNED NOT NULL,
  `TenSp` varchar(100) NOT NULL,
  `img_path` varchar(200) NOT NULL,
  `id_loai` int(11) NOT NULL,
  `id_nhanhieu` int(11) NOT NULL,
  `sex` int(11) NOT NULL,
  `GiaCu` int(11) NOT NULL,
  `GiaMoi` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `SoLuotXem` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id_sanpham`, `TenSp`, `img_path`, `id_loai`, `id_nhanhieu`, `sex`, `GiaCu`, `GiaMoi`, `status`, `SoLuong`, `SoLuotXem`, `created_at`, `updated_at`) VALUES
(4, 'Quần jean', 'quanau2.jpg', 1, 1, 1, 100000, 0, 1, 9, 9, '0000-00-00 00:00:00', '2017-06-18 11:39:25'),
(6, 'Quần Ngố Tàu', 'quanau11.jpg', 1, 1, 1, 150000, 100000, 1, 5, 101, '0000-00-00 00:00:00', '2017-06-18 01:39:50'),
(7, 'Áo sơ mi cổ tim', 'aosomicotim.jpg', 6, 16, 0, 150000, 0, 1, 100, 2, '2017-06-19 08:21:34', '0000-00-00 00:00:00'),
(8, 'Crop top gấu ren', 'croptopgauren.jpg', 1, 1, 0, 200000, 0, 1, 20, 3, '0000-00-00 00:00:00', '2022-11-28 14:42:14'),
(9, 'Bàn ăn gia đình ', 'tabble6.jpg', 8, 17, 1, 100000000, 0, 1, 1, 6, '0000-00-00 00:00:00', '2022-11-29 09:24:13'),
(10, 'Bàn làm việc', 'tabble_4.jpg', 8, 17, 1, 2000000, 0, 1, 1, 2, '0000-00-00 00:00:00', '2022-11-29 09:25:40'),
(11, 'Bàn decor phòng khách', 'slider_1.jpg', 10, 17, 1, 100000000, 0, 1, 1, 0, '0000-00-00 00:00:00', '2022-11-29 09:23:09'),
(12, 'Ghế gia đình ', 'slider_6.jpg', 11, 20, 0, 1000000, 0, 1, 5, 0, '2022-11-29 09:28:35', '0000-00-00 00:00:00'),
(13, 'Ghế văn phòng', 'slider_9.jpg', 12, 19, 1, 192000, 0, 1, 6, 0, '2022-11-29 09:30:20', '0000-00-00 00:00:00');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`id_hoadon`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_donhang`);

--
-- Chỉ mục cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`id_loai`);

--
-- Chỉ mục cho bảng `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Chỉ mục cho bảng `nhanhieu`
--
ALTER TABLE `nhanhieu`
  ADD PRIMARY KEY (`id_nhanhieu`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sanpham`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `id_hoadon` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_donhang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `id_loai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nhanhieu`
--
ALTER TABLE `nhanhieu`
  MODIFY `id_nhanhieu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sanpham` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
