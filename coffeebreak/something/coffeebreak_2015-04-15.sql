# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.21.169.24 (MySQL 5.5.37)
# Database: coffeebreak
# Generation Time: 2015-04-15 11:06:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table cb_config
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_config`;

CREATE TABLE `cb_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `authMeth` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_config` WRITE;
/*!40000 ALTER TABLE `cb_config` DISABLE KEYS */;

INSERT INTO `cb_config` (`id`, `authMeth`)
VALUES
	(1,'byrsa');

/*!40000 ALTER TABLE `cb_config` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cb_function
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_function`;

CREATE TABLE `cb_function` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `functionName` char(11) DEFAULT NULL,
  `functionTag` char(11) DEFAULT NULL,
  `functionGroup` char(11) DEFAULT NULL,
  `functionGroupName` char(11) DEFAULT NULL,
  `functionPower` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_function` WRITE;
/*!40000 ALTER TABLE `cb_function` DISABLE KEYS */;

INSERT INTO `cb_function` (`id`, `functionName`, `functionTag`, `functionGroup`, `functionGroupName`, `functionPower`)
VALUES
	(1,'发单','stask','givetask','派单','-1-'),
	(2,'接单','rtask','givetask','派单','-1-3-'),
	(3,'插入用户','insertuser','admin','管理','-3-1-'),
	(4,'修改密码','changepwd','admin','管理','-2-'),
	(5,'注销用户','deluser','admin','管理','-2-3-1-'),
	(6,'管理','admintask','givetask','派单','-1-'),
	(7,'日志','logtask','givetask','派单','-1-');

/*!40000 ALTER TABLE `cb_function` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cb_givetask_task
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_givetask_task`;

CREATE TABLE `cb_givetask_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table cb_givetask_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_givetask_type`;

CREATE TABLE `cb_givetask_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `taskLevelOne` char(11) DEFAULT NULL,
  `taskLevelTwo` char(11) DEFAULT NULL,
  `dealDefault` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_givetask_type` WRITE;
/*!40000 ALTER TABLE `cb_givetask_type` DISABLE KEYS */;

INSERT INTO `cb_givetask_type` (`id`, `taskLevelOne`, `taskLevelTwo`, `dealDefault`)
VALUES
	(1,'服务器','发布',10000266),
	(2,'服务器','修改配置',10000179),
	(3,'存储','扩容',10000179),
	(4,'虚拟机','搭建虚拟机',10000245);

/*!40000 ALTER TABLE `cb_givetask_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cb_power
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_power`;

CREATE TABLE `cb_power` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `groupName` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_power` WRITE;
/*!40000 ALTER TABLE `cb_power` DISABLE KEYS */;

INSERT INTO `cb_power` (`id`, `groupName`)
VALUES
	(1,'root'),
	(2,'systemadmin'),
	(3,'monitor');

/*!40000 ALTER TABLE `cb_power` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cb_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_users`;

CREATE TABLE `cb_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `gid` int(11) DEFAULT NULL,
  `createTime` int(11) DEFAULT NULL,
  `lastLoginTime` int(11) DEFAULT NULL,
  `loginPower` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_users` WRITE;
/*!40000 ALTER TABLE `cb_users` DISABLE KEYS */;

INSERT INTO `cb_users` (`id`, `uid`, `gid`, `createTime`, `lastLoginTime`, `loginPower`)
VALUES
	(1,10000179,1,NULL,1428988551,1),
	(2,10000245,2,NULL,1428973561,1),
	(3,10000266,3,NULL,1428983810,1);

/*!40000 ALTER TABLE `cb_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
