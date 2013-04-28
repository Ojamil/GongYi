-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 19 日 11:03
-- 服务器版本: 5.1.49
-- PHP 版本: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `GongYi`
--
drop database if exists `GongYi`;
create database `GongYi`;
grant all on `GongYi`.* to `GongYiAdmin`@`localhost` identified by 'GongYiAdmin';
use `GongYi`;


-- --------------------------------------------------------

--
-- 表的结构 `Comity`
--

CREATE TABLE IF NOT EXISTS `Comity` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` char(50) NOT NULL,
  `password` char(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `weibo` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `Comity`
--

-- --------------------------------------------------------

--
-- 表的结构 `Activity`
--

CREATE TABLE IF NOT EXISTS `Activity` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `aname` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `defaultScore` int(11) NOT NULL,
  `timeBegin` timestamp NOT NULL,
  `timeEnd` timestamp NOT NULL,
  `address` varchar(100) NOT NULL,
  `cid` int(11) NOT NULL,
  `manNum` int(11) NOT NULL,
  `applyDeadline` date NOT NULL,
  `repeatable` boolean NOT NULL,
  `opt` text NOT NULL,
  PRIMARY KEY (`aid`),
  FOREIGN KEY (`cid`) REFERENCES Comity(`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `Activity`
--


-- --------------------------------------------------------

--
-- 表的结构 `School`
--

CREATE TABLE IF NOT EXISTS `School` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(50) NOT NULL,
  `password` char(40) NOT NULL,
  PRIMARY KEY (`sid`),
  UNIQUE (`sname` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `School`
--


-- --------------------------------------------------------

--
-- 表的结构 `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50)  NOT NULL,
  `password` char(40)  NOT NULL,
  `uname` char(50)  NOT NULL,
  `gender` boolean NOT NULL,
  `birthdate` date NOT NULL,
  `sid` int not NULL,
  `telephone` char(11)  NOT NULL,
  `selfIntroduction` text NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`),
  FOREIGN KEY (`sid`) REFERENCES School(`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `User`
--

-- --------------------------------------------------------

--
-- 表的结构 `Autho`
--

CREATE TABLE IF NOT EXISTS `Autho` (
  `aid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY(`aid`, `sid` ),
  FOREIGN KEY( `aid` ) REFERENCES Activity(`aid`) ON DELETE CASCADE,
  FOREIGN KEY( `sid` ) REFERENCES School(`sid` ) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `Autho`
--


CREATE TABLE  `Apply` (
  `aid` int(11) NOT NULL ,
  `uid` int(11) NOT NULL,
  `isApprove` boolean NOT NULL,
  PRIMARY KEY(`aid`, `uid`),
  FOREIGN KEY(`aid`) REFERENCES Activity(`aid`) ON DELETE CASCADE,
  FOREIGN KEY(`uid`) REFERENCES User(`uid`) ON DELETE CASCADE
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

