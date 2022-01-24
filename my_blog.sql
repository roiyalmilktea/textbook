-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成時間: 2009 年 6 月 23 日 06:40
-- サーバのバージョン: 5.0.67
-- PHP のバージョン: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- データベース: `my_blog`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `comment_table`
--

CREATE TABLE IF NOT EXISTS `comment_table` (
  `comment_id` int(11) NOT NULL auto_increment,
  `entry_id` int(11) NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `email` varchar(255) collate utf8_unicode_ci default NULL,
  `url` varchar(255) collate utf8_unicode_ci default NULL,
  `comment` text collate utf8_unicode_ci,
  `post_table` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- テーブルのデータをダンプしています `comment_table`
--

INSERT INTO `comment_table` (`comment_id`, `entry_id`, `name`, `email`, `url`, `comment`, `post_table`) VALUES
(1, 4, 'aa', 'aa', 'aa', 'aa', '2009-03-22 00:13:32'),
(2, 3, 'aaaa', 'aaa', 'aaaa', 'aaaa', '2009-03-22 00:19:28'),
(3, 3, 'gege', 'gege', 'gge', 'eggeeg', '2009-03-22 00:19:31'),
(4, 7, 'ざっぱ', 'ざっぱ', 'ざっぱ', 'おおざっぱ', '2009-03-22 00:21:24'),
(5, 7, 'ざっぱ', 'ざっぱ', 'ざっぱ', 'おおざっぱ', '2009-03-22 00:27:19'),
(6, 7, 'ざっぱ', 'ざっぱ', 'ざっぱ', 'おおざっぱ', '2009-03-22 00:27:27'),
(7, 7, 'ざっぱ', 'ざっぱ', 'ざっぱ', 'おおざっぱ', '2009-03-22 00:27:53'),
(8, 6, 'gege', 'gegeeg', 'eggeege', 'gegeeg', '2009-03-22 00:28:15'),
(9, 6, 'gege', 'gegeeg', 'eggeege', 'gegeeg', '2009-03-22 00:28:34'),
(10, 4, '名無しさん', 'gege', 'gege', 'gegeg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `entry_table`
--

CREATE TABLE IF NOT EXISTS `entry_table` (
  `entry_id` int(11) NOT NULL auto_increment,
  `subject` varchar(255) collate utf8_unicode_ci NOT NULL,
  `digest` text collate utf8_unicode_ci NOT NULL,
  `document` text collate utf8_unicode_ci,
  `post_date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`entry_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- テーブルのデータをダンプしています `entry_table`
--

INSERT INTO `entry_table` (`entry_id`, `subject`, `digest`, `document`, `post_date`) VALUES
(4, 'わはは', 'おほほ', 'いひひ・えへへ', '2009-03-21 23:01:41'),
(5, 'あいう', 'いいい', 'ううう', '2009-03-21 23:04:41'),
(6, 'あああ', 'あああ', 'あああ', '2009-03-21 23:25:00'),
(3, 'ポリンキー', 'ポリンキー', '三角形の秘密はね', '2009-02-23 23:46:39'),
(7, 'いいい', 'いいい', 'いいい', '2009-03-21 23:25:13'),
(8, 'ううう', 'ううう', 'ううう', '2009-03-21 23:25:28'),
(9, 'えええ', 'えええ', 'えええ', '2009-03-21 23:25:42'),
(10, 'おおお', 'おおお', 'おおお', '2009-03-21 23:26:02'),
(11, '111', '11', '111', '2009-03-21 23:26:10'),
(12, '222', '222', '222', '2009-03-21 23:26:14'),
(13, '333', '333', '333', '2009-03-21 23:26:18'),
(14, '444', '444', '444', '2009-03-21 23:26:24'),
(15, '555', '555', '555', '2009-03-21 23:26:29'),
(16, '666', '666', '666', '2009-03-21 23:26:33');

-- --------------------------------------------------------

--
-- テーブルの構造 `login_table`
--

CREATE TABLE IF NOT EXISTS `login_table` (
  `admin_id` varchar(25) collate utf8_unicode_ci NOT NULL,
  `password` varchar(25) collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータをダンプしています `login_table`
--

INSERT INTO `login_table` (`admin_id`, `password`) VALUES
('admin', '12345');
