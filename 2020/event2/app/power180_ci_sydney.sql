-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2016 �?03 ??14 ??09:04
-- 服务器版本: 5.6.16
-- PHP 版本: 5.5.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `power180_ci_sydney`
--

-- --------------------------------------------------------

--
-- 表的结构 `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(15) NOT NULL,
  `browser` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `stage`
--

CREATE TABLE IF NOT EXISTS `stage` (
  `stid` int(1) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET utf8 NOT NULL,
  `gift` varchar(40) CHARACTER SET utf8 NOT NULL COMMENT '禮品',
  `num` smallint(3) NOT NULL DEFAULT '0' COMMENT '抽出人數',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sort` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`stid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(1) NOT NULL AUTO_INCREMENT,
  `fbuid` varchar(25) CHARACTER SET utf8 NOT NULL,
  `fbname` varchar(25) CHARACTER SET utf8 NOT NULL,
  `token` varchar(255) NOT NULL,
  `name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `msg` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ticket` varchar(40) NOT NULL,
  `album1` varchar(40) NOT NULL,
  `album2` varchar(40) NOT NULL,
  `photo` varchar(40) NOT NULL,
  `img` varchar(40) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `stid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
