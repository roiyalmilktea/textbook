-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-02-01 06:54:37
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
-- データベース: `book`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `book_type`
--

CREATE TABLE `book_type` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(30) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `book_type`
--

INSERT INTO `book_type` (`type_id`, `type_name`) VALUES
(1, 'low_layer'),
(2, 'web_aplication'),
(3, 'net_work');

-- --------------------------------------------------------

--
-- テーブルの構造 `low_layer`
--

CREATE TABLE `low_layer` (
  `id` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `value` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `low_layer`
--

INSERT INTO `low_layer` (`id`, `name`, `value`) VALUES
(1, '新しいLinuxの教科書', 2970),
(2, 'できるＣentOS7サーバー', 3300),
(3, '大熱血！アセンブラ入門', 5060);

-- --------------------------------------------------------

--
-- テーブルの構造 `net_work`
--

CREATE TABLE `net_work` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `value` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- テーブルの構造 `web_aplication`
--

CREATE TABLE `web_aplication` (
  `id` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `value` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `web_aplication`
--

INSERT INTO `web_aplication` (`id`, `name`, `value`) VALUES
(1, '安全なWebアプリケーションの作り方', 3520);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
