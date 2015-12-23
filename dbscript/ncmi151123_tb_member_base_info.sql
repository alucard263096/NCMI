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
-- Table structure for table `tb_member_base_info`
--

DROP TABLE IF EXISTS `tb_member_base_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_member_base_info` (
  `member_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `identity` varchar(45) DEFAULT NULL,
  `nation` varchar(45) DEFAULT NULL,
  `birth` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `photo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_member_base_info`
--

LOCK TABLES `tb_member_base_info` WRITE;
/*!40000 ALTER TABLE `tb_member_base_info` DISABLE KEYS */;
INSERT INTO `tb_member_base_info` VALUES (1,'蔡笋','440301198603247514','汉','1986-03-24','25547926','暗杀教室看的哈快睡觉的哈萨克接电话','53b4f5e091fcb8e1d28f17b30a4dc464.jpg');
/*!40000 ALTER TABLE `tb_member_base_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-22 23:36:48
