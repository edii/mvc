-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 14 2015 г., 18:06
-- Версия сервера: 5.5.43-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mvc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `langID` int(2) NOT NULL DEFAULT '0',
  `alias` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `UserID` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `OwnerID` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `timeCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeSaved` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `categoryID` int(11) NOT NULL DEFAULT '0',
  `extraCategoryID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` longtext NOT NULL,
  `metaTitle` varchar(255) DEFAULT NULL,
  `metaDescription` mediumtext,
  `metaKeywords` longtext,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hidden` (`hidden`),
  KEY `categoryID` (`categoryID`),
  KEY `extraCategoryID` (`extraCategoryID`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `langID`, `alias`, `UserID`, `OwnerID`, `hidden`, `timeCreated`, `timeSaved`, `categoryID`, `extraCategoryID`, `name`, `code`, `price`, `description`, `metaTitle`, `metaDescription`, `metaKeywords`, `icon`) VALUES
(1, 0, 'test', 'root', 'root', 0, '2015-05-14 14:33:01', '0000-00-00 00:00:00', 1, 0, 'test', 'test', 100.00, 'test 1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `products_category`
--

CREATE TABLE IF NOT EXISTS `products_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentID` int(11) NOT NULL,
  `UserID` varchar(30) NOT NULL,
  `OwnerID` varchar(30) NOT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT '4',
  `timeCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeSaved` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `alias` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `logo` varchar(255) NOT NULL,
  `titleIcon` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(255) NOT NULL,
  `intro` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `metaTitle` varchar(255) NOT NULL,
  `metaDescription` mediumtext NOT NULL,
  `metaKeywords` text NOT NULL,
  `showProducts` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hidden` (`hidden`),
  KEY `timeCreated` (`timeCreated`),
  KEY `parentID` (`parentID`),
  KEY `code` (`alias`),
  KEY `name` (`name`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
