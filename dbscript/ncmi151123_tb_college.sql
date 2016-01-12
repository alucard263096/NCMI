CREATE DATABASE  IF NOT EXISTS `ncmi151123` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ncmi151123`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: www.myhkdoc.com    Database: ncmi151123
-- ------------------------------------------------------
-- Server version	5.6.21-enterprise-commercial-advanced-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_college`
--

DROP TABLE IF EXISTS `tb_college`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_college` (
  `id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `seq` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_college`
--

LOCK TABLES `tb_college` WRITE;
/*!40000 ALTER TABLE `tb_college` DISABLE KEYS */;
INSERT INTO `tb_college` VALUES (101,'2016-01-12 01:27:46',1,'2016-01-12 01:27:46',1,'内科','101','','','A'),(102,'2016-01-12 01:27:47',1,'2016-01-12 01:27:47',1,'外科','102','','','A'),(103,'2016-01-12 01:27:47',1,'2016-01-12 01:27:47',1,'妇产科','103','','','A'),(104,'2016-01-12 01:27:47',1,'2016-01-12 01:27:47',1,'儿科','104','','','A'),(105,'2016-01-12 01:27:47',1,'2016-01-12 01:27:47',1,'骨科','105','','','A'),(106,'2016-01-12 01:27:47',1,'2016-01-12 01:27:47',1,'口腔科','106','','','A'),(107,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'眼科','107','','','A'),(108,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'中医科','108','','','A'),(109,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'精神心理科','109','','','A'),(110,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'皮肤性病科','110','','','A'),(111,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'传染病科','111','','','A'),(112,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'整形科','112','','','A'),(113,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'肿瘤科','113','','','A'),(114,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'男科','114','','','A'),(115,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'疼痛科','115','','','A'),(116,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'耳鼻喉科','116','','','A'),(117,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'预防保健科','117','','','A'),(118,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'重症医学科','118','','','A'),(119,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'康复科','119','','','A'),(120,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'理疗科','120','','','A'),(121,'2016-01-12 01:27:48',1,'2016-01-12 01:27:48',1,'临床其它','121','','','A'),(122,'2016-01-12 01:27:49',1,'2016-01-12 01:27:49',1,'急诊科','122','','','A'),(123,'2016-01-12 01:27:49',1,'2016-01-12 01:27:49',1,'民族医学科','123','','','A'),(124,'2016-01-13 00:00:23',1,'2016-01-13 00:00:23',1,'超声科','','','','A'),(125,'2016-01-13 00:09:48',1,'2016-01-13 00:09:48',1,'放射科','','','','A'),(126,'2016-01-13 00:12:32',1,'2016-01-13 00:12:32',1,'门诊科','','','','A');
/*!40000 ALTER TABLE `tb_college` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-13  1:58:02
