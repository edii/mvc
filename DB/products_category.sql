CREATE TABLE IF NOT EXISTS `products_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentID` int(11) NOT NULL,
  `langID` int(2) NOT NULL DEFAULT 0,  
  `UserID` varchar(30) NOT NULL,
  `OwnerID` varchar(30) NOT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT '4',
  `timeCreated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `timeSaved` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
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
  KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `position` (`position`),
  KEY `langID` (`langID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;