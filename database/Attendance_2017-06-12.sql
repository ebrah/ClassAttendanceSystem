# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.18)
# Database: Attendance
# Generation Time: 2017-06-12 12:26:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Course
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Course`;

CREATE TABLE `Course` (
  `Cid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(90) NOT NULL DEFAULT '',
  `Year` int(2) NOT NULL,
  PRIMARY KEY (`Cid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

LOCK TABLES `Course` WRITE;
/*!40000 ALTER TABLE `Course` DISABLE KEYS */;

INSERT INTO `Course` (`Cid`, `Name`, `Year`)
VALUES
	(8,'BACHELOR IN COMPUTER SCIENCE',2),
	(9,'BACHELOR IN BANKING AND FINANCE',3),
	(10,'BACHELOR IN INFORMATION TECHNOLOGY',1);

/*!40000 ALTER TABLE `Course` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Course_module
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Course_module`;

CREATE TABLE `Course_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Cid` int(6) unsigned DEFAULT NULL,
  `Mid` int(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Cid` (`Cid`),
  KEY `Mid` (`Mid`),
  CONSTRAINT `course_module_ibfk_1` FOREIGN KEY (`Cid`) REFERENCES `Course` (`Cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `course_module_ibfk_2` FOREIGN KEY (`Mid`) REFERENCES `Module` (`Mid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

LOCK TABLES `Course_module` WRITE;
/*!40000 ALTER TABLE `Course_module` DISABLE KEYS */;

INSERT INTO `Course_module` (`id`, `Cid`, `Mid`)
VALUES
	(4,8,6),
	(5,8,7),
	(6,8,8),
	(7,8,9),
	(8,8,10),
	(9,9,11),
	(10,9,12),
	(11,9,13),
	(12,9,14),
	(13,9,15),
	(14,10,16),
	(15,10,17),
	(16,10,18),
	(19,8,19),
	(20,8,20),
	(21,8,21),
	(22,8,22),
	(23,8,23);

/*!40000 ALTER TABLE `Course_module` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lecture_course
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lecture_course`;

CREATE TABLE `lecture_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Lid` int(6) unsigned DEFAULT NULL,
  `Cid` int(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Lid` (`Lid`),
  KEY `Cid` (`Cid`),
  CONSTRAINT `lecture_course_ibfk_1` FOREIGN KEY (`Lid`) REFERENCES `lecturer` (`Lid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lecture_course_ibfk_2` FOREIGN KEY (`Cid`) REFERENCES `Course` (`Cid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

LOCK TABLES `lecture_course` WRITE;
/*!40000 ALTER TABLE `lecture_course` DISABLE KEYS */;

INSERT INTO `lecture_course` (`id`, `Lid`, `Cid`)
VALUES
	(30,16,8);

/*!40000 ALTER TABLE `lecture_course` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Lecture_module
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Lecture_module`;

CREATE TABLE `Lecture_module` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Lid` int(6) unsigned DEFAULT NULL,
  `Mid` int(6) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Lid` (`Lid`),
  KEY `Mid` (`Mid`),
  CONSTRAINT `lecture_module_ibfk_1` FOREIGN KEY (`Lid`) REFERENCES `lecturer` (`Lid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lecture_module_ibfk_2` FOREIGN KEY (`Mid`) REFERENCES `Module` (`Mid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `Lecture_module` WRITE;
/*!40000 ALTER TABLE `Lecture_module` DISABLE KEYS */;

INSERT INTO `Lecture_module` (`id`, `Lid`, `Mid`)
VALUES
	(4,16,7);

/*!40000 ALTER TABLE `Lecture_module` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table LECTURER
# ------------------------------------------------------------

DROP TABLE IF EXISTS `LECTURER`;

CREATE TABLE `LECTURER` (
  `Lid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Fname` varchar(30) NOT NULL DEFAULT '',
  `Lname` varchar(30) NOT NULL DEFAULT '',
  `Email` varchar(30) DEFAULT NULL,
  `phone` int(16) DEFAULT NULL,
  `Occupation` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`Lid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

LOCK TABLES `LECTURER` WRITE;
/*!40000 ALTER TABLE `LECTURER` DISABLE KEYS */;

INSERT INTO `LECTURER` (`Lid`, `Fname`, `Lname`, `Email`, `phone`, `Occupation`, `username`, `password`)
VALUES
	(16,'IBRAHIM','JAME','Ibrah@yahoo.com',754200115,'lecturer','IBRA','ibra123');

/*!40000 ALTER TABLE `LECTURER` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table module
# ------------------------------------------------------------

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `Mid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL DEFAULT '',
  `Moduel_code` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Mid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;

INSERT INTO `module` (`Mid`, `Name`, `Moduel_code`)
VALUES
	(6,'COMPUTER SECURITY','ITU_07411'),
	(7,'CSU_07411','OBJECT ORIENTED PROGRAMMING'),
	(8,'MATHEMATICS','MTU_07406'),
	(9,'COMPUTER NETWORKS','CSU_07412'),
	(10,'E-COMMERCE','ITU_07408'),
	(11,'MICROFINANCE','BF_868'),
	(12,'FN_868','TREASURY MANAGEMENT'),
	(13,'MONEY AND BANKING','BF 861'),
	(14,'INTERNATIONAL TAXATION','TM 864'),
	(15,'PUBLIC FINANCE','EC 864'),
	(16,'PROGRAMMING IN C II','CSU_07202'),
	(17,'CSU_O7203','FUNDAMENTAL OF DATABASES'),
	(18,'SYSTEM ANALYSIS AND DESIGN','ITU_07203'),
	(19,'FINANCIAL REPORTING','AFU_0740'),
	(20,'TMU_07406','INCOME TAXATION LAW'),
	(21,'COST ACCOUNTING','AFU_07408'),
	(22,'RESEARCH METHODOLOGY','SMCU_07401'),
	(23,'CRETIT AND LANDING','BFU_07506');

/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table REGISTRAR
# ------------------------------------------------------------

DROP TABLE IF EXISTS `REGISTRAR`;

CREATE TABLE `REGISTRAR` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Fname` varchar(30) NOT NULL DEFAULT '',
  `Sname` varchar(30) NOT NULL DEFAULT '',
  `Email` varchar(30) NOT NULL DEFAULT '',
  `Occupation` varchar(30) NOT NULL DEFAULT '',
  `Phone` int(16) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `REGISTRAR` WRITE;
/*!40000 ALTER TABLE `REGISTRAR` DISABLE KEYS */;

INSERT INTO `REGISTRAR` (`id`, `Fname`, `Sname`, `Email`, `Occupation`, `Phone`, `username`, `password`)
VALUES
	(3,'TUKIKO','OITO','tukiko@gmail.com','registrar',716808062,'tukiko','tukiko123');

/*!40000 ALTER TABLE `REGISTRAR` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Student`;

CREATE TABLE `Student` (
  `Sid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Fname` varchar(30) NOT NULL DEFAULT '',
  `Lname` varchar(30) NOT NULL DEFAULT '',
  `RegNo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

LOCK TABLES `Student` WRITE;
/*!40000 ALTER TABLE `Student` DISABLE KEYS */;

INSERT INTO `Student` (`Sid`, `Fname`, `Lname`, `RegNo`)
VALUES
	(4,'EBRAH','JAMEE','IMC/BCS/88/09788'),
	(5,'WINNIE','DAVID','IMC/BCS/89/9900'),
	(6,'NOEL','CHUMA','IMC/BBF/26/87373'),
	(7,'OMARY','JUMA','imc/BBF/78/I993'),
	(8,'EMANUEL','LUCAS','IMC/BIT/78/90332§'),
	(9,'PRINCE','TONE','IMC/BIT/78/3025');

/*!40000 ALTER TABLE `Student` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Student_course
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Student_course`;

CREATE TABLE `Student_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Sid` int(6) unsigned NOT NULL,
  `Cid` int(6) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Sid` (`Sid`),
  KEY `Cid` (`Cid`),
  CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`Sid`) REFERENCES `Student` (`Sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`Cid`) REFERENCES `Course` (`Cid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

LOCK TABLES `Student_course` WRITE;
/*!40000 ALTER TABLE `Student_course` DISABLE KEYS */;

INSERT INTO `Student_course` (`id`, `Sid`, `Cid`)
VALUES
	(4,4,8),
	(5,5,8),
	(6,6,9),
	(7,7,9),
	(8,8,10),
	(9,9,10);

/*!40000 ALTER TABLE `Student_course` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
