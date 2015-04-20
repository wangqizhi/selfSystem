# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 10.21.169.24 (MySQL 5.5.37)
# Database: coffeebreak
# Generation Time: 2015-04-20 08:33:39 +0000
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
  `configMeth` char(11) DEFAULT NULL,
  `configValue` char(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_config` WRITE;
/*!40000 ALTER TABLE `cb_config` DISABLE KEYS */;

INSERT INTO `cb_config` (`id`, `configMeth`, `configValue`)
VALUES
	(1,'authMeth','byrsa');

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
  `functionUrl` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_function` WRITE;
/*!40000 ALTER TABLE `cb_function` DISABLE KEYS */;

INSERT INTO `cb_function` (`id`, `functionName`, `functionTag`, `functionGroup`, `functionGroupName`, `functionPower`, `functionUrl`)
VALUES
	(1,'发单','stask','givetask','派单','-1-2-3-','/station/playstation/choose/givetask/stask'),
	(2,'接单','rtask','givetask','派单','-1-2-3-','/station/playstation/choose/givetask/rtask'),
	(3,'插入用户','insertuser','admin','管理','-3-1-',''),
	(4,'修改密码','changepwd','admin','管理','-2-',NULL),
	(5,'注销用户','deluser','admin','管理','-2-3-1-',NULL),
	(6,'管理','admintask','givetask','派单','',''),
	(7,'日志','logtask','givetask','派单','',NULL);

/*!40000 ALTER TABLE `cb_function` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cb_givetask_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_givetask_message`;

CREATE TABLE `cb_givetask_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hashValue` char(80) DEFAULT NULL,
  `msgContent` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_givetask_message` WRITE;
/*!40000 ALTER TABLE `cb_givetask_message` DISABLE KEYS */;

INSERT INTO `cb_givetask_message` (`id`, `hashValue`, `msgContent`)
VALUES
	(2,'81f11ad75e979cc8b52fd308ef7c2040','测试msg'),
	(3,'9542ab5b8b370c493df4d5d97673db91','测试msg2'),
	(4,'ff983a420df272ad35cc50309dbff071','测试msg3'),
	(5,'c4ca4238a0b923820dcc509a6f75849b','1'),
	(6,'024609caf7efe554d05376339e0e3166','我完成了'),
	(7,'81dc9bdb52d04dc20036dbd8313ed055','1234'),
	(8,'73da604317b2d44b8541aa89161e4c12','已经完成'),
	(9,'698d51a19d8a121ce581499d7b701668','111'),
	(10,'716f6b30598ba30945d84485e61c1027','close'),
	(11,'6512bd43d9caa6e02c990b0a82652dca','11'),
	(12,'f90ee2b31b1a768750cf6c22735905b1','21312321'),
	(13,'0f0b350c0099c05bab05452916807187','转给你了，文善哥'),
	(14,'a4b84c069b6d55049bc61f850cb29c6b','不要做'),
	(15,'2b2ee3fd498b0a15f9ae63e719853e68','完成了'),
	(16,'202cb962ac59075b964b07152d234b70','123'),
	(17,'769d88e425e03120b83ee4ed6b9d588e','完成');

/*!40000 ALTER TABLE `cb_givetask_message` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table cb_givetask_task
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cb_givetask_task`;

CREATE TABLE `cb_givetask_task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `typeID` int(11) DEFAULT NULL,
  `taskContent` text,
  `taskPath` text,
  `nowMan` int(11) DEFAULT NULL,
  `askMan` int(11) DEFAULT NULL,
  `taskStatus` int(11) DEFAULT NULL COMMENT '1:正常 2:完成任务 3:任务归档 0:取消任务',
  `startTime` int(11) DEFAULT NULL,
  `finishTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `cb_givetask_task` WRITE;
/*!40000 ALTER TABLE `cb_givetask_task` DISABLE KEYS */;

INSERT INTO `cb_givetask_task` (`id`, `typeID`, `taskContent`, `taskPath`, `nowMan`, `askMan`, `taskStatus`, `startTime`, `finishTime`)
VALUES
	(1,3,'请开通一下<br>什么乱七八糟<br>的好吗','10000179@1429508763-10000179@1429508776:8-10000179@1429509235:0',10000179,10000179,3,1429508763,1429509235),
	(2,3,'1','10000179@1429509359-10000179@1429509364:5-10000179@1429509372:0',10000179,10000179,3,1429509359,1429509372),
	(3,3,'1234321','10000179@1429509419-10000179@1429509424:5-10000179@1429509430:0',10000179,10000179,3,1429509419,1429509430),
	(4,3,'1234','10000179@1429510523-10000179@1429510529:5-10000179@1429510586:10',10000179,10000179,3,1429510523,1429510586),
	(5,3,'423321','10000179@1429510552-10000179@1429510559:9-10000179@1429510599:10',10000179,10000179,3,1429510552,1429510599),
	(6,3,'123','10000179@1429510697-10000179@1429510703:11-10000179@1429510708:10',10000179,10000179,3,1429510697,1429510708),
	(7,3,'12312','10000179@1429510713-10000179@1429510721:12-10000179@1429510726:10',10000179,10000179,3,1429510713,1429510726),
	(8,3,'12342','10000179@1429511217-10000179@1429511305:14',10000179,10000179,0,1429511217,1429511305),
	(9,3,'132412','10000266@1429511235',10000266,10000179,1,1429511235,0),
	(10,3,'111111','10000179@1429511362-10000179@1429511909:5-10000266@1429511926:5-10000179@1429511948:15-10000179@1429511960:10',10000179,10000179,3,1429511362,1429511960),
	(11,1,'测试一下<br>测试一下2<br>测试一3<br>测试一下4','10000245@1429512017',10000245,10000179,1,1429512017,0),
	(12,4,'111','10000245@1429513372',10000245,10000179,1,1429513372,0),
	(13,3,'1','10000179@1429513609-10000179@1429515260:16-10000179@1429515481:10',10000179,10000179,3,1429513609,1429515481),
	(14,3,'1','10000179@1429515491-10000179@1429518326:5-10000179@1429518330:10',10000179,10000179,3,1429515491,1429518330),
	(15,3,'帮我扩容一下xxxxx<br>你好','10000179@1429518188-10000245@1429518217:17-10000245@1429518246:10',10000245,10000245,3,1429518188,1429518246);

/*!40000 ALTER TABLE `cb_givetask_task` ENABLE KEYS */;
UNLOCK TABLES;


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
	(1,10000179,1,NULL,1429518740,1),
	(2,10000245,2,NULL,1429512066,1),
	(3,10000266,3,NULL,1429495924,1);

/*!40000 ALTER TABLE `cb_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
