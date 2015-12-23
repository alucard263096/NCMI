-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: www.myhkdoc.com    Database: ncmi151123
-- ------------------------------------------------------
-- Server version	5.6.21-enterprise-commercial-advanced-log

use ncmi151123;
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
-- Table structure for table `tb_member_case_attachment`
--

DROP TABLE IF EXISTS `tb_member_case_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_member_case_attachment` (
  `id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `filesavename` varchar(45) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_member_case_attachment`
--

LOCK TABLES `tb_member_case_attachment` WRITE;
/*!40000 ALTER TABLE `tb_member_case_attachment` DISABLE KEYS */;
INSERT INTO `tb_member_case_attachment` VALUES (1,8,'9d99436b384bfa466e43e18effc4e04a.jpg','01.jpg'),(2,8,'5580adbaa23c41b2d07e1bcfc1e34315.jpg','02.jpg'),(3,9,'9d99436b384bfa466e43e18effc4e04a.jpg','01.jpg'),(4,9,'5580adbaa23c41b2d07e1bcfc1e34315.jpg','02.jpg'),(5,9,'e1e2876e53a3abdaf802ffb925290985.jpg','19.jpg');
/*!40000 ALTER TABLE `tb_member_case_attachment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-22 23:36:49
