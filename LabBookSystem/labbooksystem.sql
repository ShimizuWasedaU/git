-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-01-11 04:47:45
-- 服务器版本： 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `labbooksystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `book`
--

CREATE TABLE IF NOT EXISTS `book` (
`book_id` int(11) NOT NULL,
  `isbn` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `book_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `writer_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `publisher` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `price` varchar(6) COLLATE utf8_bin DEFAULT NULL,
  `shelf_id` varchar(10) COLLATE utf8_bin NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `book`
--

INSERT INTO `book` (`book_id`, `isbn`, `book_name`, `writer_name`, `publisher`, `price`, `shelf_id`, `available`) VALUES
(1, '978-1598633740', 'Programming for the Beginner', 'Jerry Lee Ford Jr.', 'Cengage Learning PTR', '$20.48', 'N355-1', 0),
(2, '978-0990582908', 'Game Programming Patterns', 'Robert Nystrom', 'Genever Benning', '$35.96', 'N355-2', 0),
(3, '978-1449392772', 'Programming PHP', 'Kevin Tatroe', 'O''Reilly Media', '$28.96', 'N355-1', 0),
(4, '978-1449319267', 'Learning PHP, MySQL, JavaScrip', 'Robin Nixon', 'O''Reilly Media', '$29.57', 'N355-4', 0),
(5, '978-1449303587', 'Learning Perl', 'Randal L. Schwartz', 'O''Reilly Media', '$28.84', 'N309-1', 0),
(6, NULL, 'Collection of 2014 paper', 'Ikenaga Takeshi', 'Ikenaga Lab', NULL, 'N355-7', 1),
(7, '978-1449355739', 'Learning Python, 5th Edition', 'Mark Lutz', 'O''Reilly Media', '$41.35', 'N355-6', 0),
(8, '978-0596009656', 'Learning the bash Shell', 'Cameron Newham', 'O''Reilly Media', '$24.40', 'N355-7', 0),
(9, '978-0596153601', 'grep Pocket Reference', 'John Bambenek', 'O''Reilly Media;', '$10.01', 'N309-4', 0),
(10, '978-1449316693', 'Linux Pocket Guide, 2nd Editio', 'Daniel J. Barrett', 'O''Reilly Media', '$9.61', 'N309-2', 0),
(11, NULL, 'Collection of Student Work', 'Ikenaga Takashi', 'Ikenaga Lab', NULL, 'N309-3', 0),
(17, NULL, 'Collection of student pictures', 'Ikenaga Takeshi', 'Ikenaga Lab', NULL, 'N355-7', 0);

-- --------------------------------------------------------

--
-- 表的结构 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
`record_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `returned` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `record`
--

INSERT INTO `record` (`record_id`, `user_id`, `book_id`, `borrow_date`, `return_date`, `returned`) VALUES
(3, 1, 9, '2015-01-09 20:39:23', '2015-01-09 23:00:38', 1),
(4, 4, 6, '2015-01-10 23:13:17', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `identity` varchar(10) COLLATE utf8_bin NOT NULL,
  `authority` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `email`, `identity`, `authority`) VALUES
(1, 'Shimizu', '1234567', 'syuoguojin@akane.waseda.jp', 'master', 'user'),
(3, 'Nana', '123456', '827950525@qq.com', 'master', 'user'),
(4, 'Gaoxing', '123456', 'cgxsdtca@akane.waseda.jp', 'doctor', 'admin'),
(6, 'SyuuSan', '123456', 'njublithe@gmail.com', 'master', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
 ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
 ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
