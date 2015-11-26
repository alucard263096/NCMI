CREATE DATABASE  IF NOT EXISTS `ncmi151123` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ncmi151123`;
-- MySQL dump 10.13  Distrib 5.6.19, for Win32 (x86)
--
-- Host: localhost    Database: ncmi151123
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
-- Table structure for table `tb_subcategory`
--

DROP TABLE IF EXISTS `tb_subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_subcategory` (
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
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_subcategory`
--

LOCK TABLES `tb_subcategory` WRITE;
/*!40000 ALTER TABLE `tb_subcategory` DISABLE KEYS */;
INSERT INTO `tb_subcategory` VALUES (1,'2015-11-25 22:56:25',1,'2015-11-25 22:56:25',1,'癌症','','','','A',1),(2,'2015-11-25 22:56:32',1,'2015-11-25 22:56:32',1,'肿瘤','','','','A',1),(3,'2015-11-25 22:57:16',1,'2015-11-25 22:57:16',1,'心脏外科','','','','A',2),(4,'2015-11-25 22:57:45',1,'2015-11-25 22:57:45',1,'普通外科','','','','A',3),(5,'2015-11-25 22:58:01',1,'2015-11-25 22:58:01',1,'超声刀外科','','','','A',3);
/*!40000 ALTER TABLE `tb_subcategory` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-26 23:58:53
