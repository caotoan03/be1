-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th10 21, 2024 lúc 01:23 AM
-- Phiên bản máy phục vụ: 5.7.36
-- Phiên bản PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `product`
--
CREATE DATABASE IF NOT EXISTS `product` DEFAULT CHARACTER SET utf32 COLLATE utf32_general_ci;
USE `product`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

DROP TABLE IF EXISTS `account`;
CREATE TABLE IF NOT EXISTS `account` (
  `id_account` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `hoten` varchar(200) NOT NULL,
  `quyen` varchar(50) NOT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`id_account`, `email`, `password`, `hoten`, `quyen`) VALUES
(1, 'quangtien900@gmail.com', '@Quangtien38', 'Trương Quang Tiến', 'admin'),
(2, 'trumoggy@gmail.com', '@Quangtien38', 'Trương Quang Tiến', 'user');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `madanhmuc` int(11) NOT NULL AUTO_INCREMENT,
  `tendanhmuc` varchar(200) NOT NULL,
  `ghichu` text NOT NULL,
  PRIMARY KEY (`madanhmuc`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`madanhmuc`, `tendanhmuc`, `ghichu`) VALUES
(11, 'Laptop', 'CÃ¡c sáº£n pháº©m laptop'),
(10, 'Äiá»‡n Thoáº¡i', 'CÃ¡c sáº£n pháº©m Ä‘iá»‡n thoáº¡i');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categorybyproducer`
--

DROP TABLE IF EXISTS `categorybyproducer`;
CREATE TABLE IF NOT EXISTS `categorybyproducer` (
  `maproducer` int(11) NOT NULL AUTO_INCREMENT,
  `tenproducer` varchar(244) NOT NULL,
  `ghichu` varchar(255) NOT NULL,
  PRIMARY KEY (`maproducer`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf32;

--
-- Đang đổ dữ liệu cho bảng `categorybyproducer`
--

INSERT INTO `categorybyproducer` (`maproducer`, `tenproducer`, `ghichu`) VALUES
(1, 'Apple', 'CÃ¡c sáº£n pháº©m cá»§a Apple'),
(3, 'Samsung', 'CÃ¡c sáº£n pháº©m cá»§a Samsung'),
(4, 'Xiaomi', 'CÃ¡c sáº£n pháº©m cá»§a Xiaomi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `masanpham` varchar(20) NOT NULL,
  `tensanpham` varchar(200) NOT NULL,
  `gia` int(200) NOT NULL,
  `mota` text NOT NULL,
  `hinh` varchar(200) NOT NULL,
  `madanhmuc` int(11) NOT NULL,
  `maproducer` int(11) NOT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id_product`, `masanpham`, `tensanpham`, `gia`, `mota`, `hinh`, `madanhmuc`, `maproducer`) VALUES
(43, '1', 'iPhone15 Pro Max', 33890000, 'iPhone 15 Pro Max 256GB', '291703442.jpeg', 10, 1),
(44, '2', 'iPhone15 Pro', 24000000, 'iPhone 15 Pro 128GB', '291703442.jpeg', 10, 1),
(45, '3', 'iPhone 13 ProMax', 22990000, 'iPhone 13 Pro Max', 'iphone-13-pro-max.webp', 10, 1),
(46, '4', 'Äiá»‡n thoáº¡i Samsung Galaxy Z Flip 4 5G', 10690000, ' RAM 8GB - 128GB', 'z-flip-4-2_1660372223.webp', 10, 3),
(49, '5', 'Samsung Galaxy S23 Ultra 5G', 22990000, 'Äiá»‡n thoáº¡i Samsung Galaxy S23 Ultra 5G 256GB ', 'samsung-galaxy-s23-ultra-5g-mau-xanh.webp', 10, 3),
(50, '6', 'Xiaomi Redmi Note 13 Pro', 7290000, 'Sá»± bÃ¹ng ná»• cá»§a cÃ´ng nghá»‡ di Ä‘á»™ng trong nhá»¯ng nÄƒm gáº§n Ä‘Ã¢y Ä‘Ã£ mang Ä‘áº¿n cho ngÆ°á»i dÃ¹ng vÃ´ sá»‘ lá»±a chá»n smartphone Ä‘a dáº¡ng. Trong phÃ¢n khÃºc táº§m trung, Xiaomi Redmi Note 13 Pro 128GB ná»•i lÃªn nhÆ° má»™t á»©ng cá»­ viÃªn sÃ¡ng giÃ¡ vá»›i nhá»¯ng Æ°u Ä‘iá»ƒm vÆ°á»£t trá»™i vá» thiáº¿t káº¿, hiá»‡u nÄƒng nhá» chip Helio G99-Ultra, camera 200 MP vÃ  káº¿t há»£p sáº¡c nhanh 67 W.', 'xiaomi-13-pro-thumb-1-2-600x600.jpg', 10, 4),
(51, 'aaa', 'aaaa', 24000000, 'aaaaa', 'jrmnt_x6r1wd.jpg', 10, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
