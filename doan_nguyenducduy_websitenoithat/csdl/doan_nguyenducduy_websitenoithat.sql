-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2017 at 04:06 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashion_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
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
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `email`, `phone`, `address`, `role_admin`, `status`, `img_path`, `createdAt`, `updatedAt`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', 'quangd@gmail.com', '0966111111', 'HY', 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `id_hoadon` int(10) UNSIGNED NOT NULL,
  `id_donhang` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`id_hoadon`, `id_donhang`, `created_at`, `updated_at`) VALUES
(4, 3, '2017-06-18 16:55:18', '0000-00-00 00:00:00'),
(5, 4, '2017-06-18 16:55:21', '0000-00-00 00:00:00'),
(6, 7, '2017-06-19 09:51:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
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
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id_donhang`, `id_sanpham`, `TenKH`, `email`, `SDT`, `DiaChi`, `GhiChu`, `QTY`, `ThanhTien`, `status`, `create_at`, `update_at`) VALUES
(3, 4, 'tham', 'sdsadsad', '0996645', 'dád', NULL, 1, 100000, 1, NULL, NULL),
(4, 6, 'vinh', 'adasda', '01676529879', 'sda', NULL, 2, 150000, 1, NULL, NULL),
(6, 8, 'nguyen hoang nam', 'nguyenhoangnam@gmail.com', '0966432963', 'HY', '', 1, 200000, 0, '2017-06-19 09:50:58', '0000-00-00 00:00:00'),
(7, 6, 'nguyen hoang nam', 'nguyenhoangnam@gmail.com', '0966432963', 'HY', '', 1, 100000, 1, '2017-06-19 09:50:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
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
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`id_loai`, `TenLoai`, `gioitinh`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Quần Short', 1, 1, '2017-06-17 00:00:00', NULL),
(2, 'Áo thun', 1, 1, NULL, NULL),
(3, 'Áo ba lỗ', 1, 1, NULL, NULL),
(5, 'Váy', 0, 1, '0000-00-00 00:00:00', '2017-06-17 20:59:07'),
(6, 'Áo nữ', 0, 1, '2017-06-19 08:18:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `member`
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
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `TenDangNhap`, `MatKhau`, `TenHienThi`, `DiaChi`, `SDT`, `Email`, `TrangThai`, `authen_key`, `created_time`, `updated_time`) VALUES
(5, 'admin', '25d55ad283aa400af464c76d713c07ad', 'quang', 'HY', '0966111111', 'quangducchung@gmail.com', 1, 'jPCgQhtGXx-mYZqOVrLt4EjX3MVLSOnVwzaMENjHdP8', '2017-06-19 09:37:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nhanhieu`
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
-- Dumping data for table `nhanhieu`
--

INSERT INTO `nhanhieu` (`id_nhanhieu`, `ten_nhanhieu`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GUCCI', '5292014115111.jpg', 1, '2017-06-16 00:00:00', '2017-06-17 10:55:05'),
(14, 'Luxury', '5292014133352.jpg', 1, '2017-06-17 00:00:00', '2017-06-17 10:49:08'),
(15, '360 Boutique', '5282014195748.jpg', 1, '2017-06-17 10:58:50', '0000-00-00 00:00:00'),
(16, 'RED SHOP', 'PicsArt_13383511689231.png', 1, '2017-06-19 08:20:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
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
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id_sanpham`, `TenSp`, `img_path`, `id_loai`, `id_nhanhieu`, `sex`, `GiaCu`, `GiaMoi`, `status`, `SoLuong`, `SoLuotXem`, `created_at`, `updated_at`) VALUES
(4, 'Quần jean', 'quanau2.jpg', 1, 1, 1, 100000, 0, 1, 9, 7, '0000-00-00 00:00:00', '2017-06-18 11:39:25'),
(6, 'Quần Ngố Tàu', 'quanau11.jpg', 1, 1, 1, 150000, 100000, 1, 5, 100, '0000-00-00 00:00:00', '2017-06-18 01:39:50'),
(7, 'Áo sơ mi cổ tim', 'aosomicotim.jpg', 6, 16, 0, 150000, 0, 1, 100, 0, '2017-06-19 08:21:34', '0000-00-00 00:00:00'),
(8, 'Crop top gấu ren', 'croptopgauren.jpg', 6, 16, 0, 200000, 0, 1, 20, 2, '2017-06-19 08:22:09', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`id_hoadon`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_donhang`);

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`id_loai`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `nhanhieu`
--
ALTER TABLE `nhanhieu`
  ADD PRIMARY KEY (`id_nhanhieu`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sanpham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `id_hoadon` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_donhang` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `id_loai` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `nhanhieu`
--
ALTER TABLE `nhanhieu`
  MODIFY `id_nhanhieu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sanpham` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
