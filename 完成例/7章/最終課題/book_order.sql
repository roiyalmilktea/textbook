-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-02-05 06:18:30
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
-- データベース: `library`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `book_order`
--

CREATE TABLE `book_order` (
  `order_id` int(30) NOT NULL,
  `order_title` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `author` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `publisher` varchar(20) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `book_order`
--

INSERT INTO `book_order` (`order_id`, `order_title`, `author`, `publisher`) VALUES
(1, 'xyz', 'rytu', 'koudansha'),
(2, 'kodaitaro', '123-4567-8910', 'kodai@cc.it-hiroshim'),
(3, 'kodaitaro', 'aa', 'aaaaa'),
(4, 'ログ分析入門', '折原慎吾', 'SDplus'),
(5, 'ログ分析入門', 'aa', ''),
(6, 'a', '123-4567-8910', ''),
(7, 'a', '1', ''),
(8, 'ログ分析入門', 'orihara', ''),
(9, 'ログ分析入門', '123-4567-8910', ''),
(10, 'kodaitaro', 'aa', ''),
(11, 'kodaitaro kodaikanji', 'aaaaaaaaa', ''),
(12, 'jskaopj', 'sfasgr', ''),
(13, 'fksdsak', 'sjgn', ''),
(14, 'fksdsak', 'sjgn', ''),
(15, 'イ', 'i3ro', ''),
(16, 'ログ分析入門', 'ddd', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
