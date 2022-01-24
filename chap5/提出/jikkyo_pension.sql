-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2021-11-09 03:33:01
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `jikkyo_pension`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `customer_telno` char(11) COLLATE utf8_bin NOT NULL,
  `customer_address` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `reserve`
--

CREATE TABLE `reserve` (
  `reserve_no` int(11) NOT NULL,
  `reserve_date` datetime NOT NULL,
  `room_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `numbers` int(11) NOT NULL,
  `checkin_time` char(5) COLLATE utf8_bin NOT NULL,
  `message` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `room`
--

CREATE TABLE `room` (
  `room_no` int(11) NOT NULL,
  `room_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `information` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `main_image` varchar(50) COLLATE utf8_bin NOT NULL,
  `image1` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `image2` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `image3` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `amenity` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `dayfee` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `room_type`
--

CREATE TABLE `room_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(30) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- テーブルのインデックス `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserve_no`),
  ADD KEY `FK_reserve_0` (`room_no`),
  ADD KEY `FK_reserve_1` (`customer_id`);

--
-- テーブルのインデックス `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_no`),
  ADD KEY `FK_room_0` (`type_id`);

--
-- テーブルのインデックス `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`type_id`);

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `FK_reserve_0` FOREIGN KEY (`room_no`) REFERENCES `room` (`room_no`),
  ADD CONSTRAINT `FK_reserve_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- テーブルの制約 `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_room_0` FOREIGN KEY (`type_id`) REFERENCES `room_type` (`type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
