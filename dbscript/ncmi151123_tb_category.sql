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
-- Table structure for table `tb_category`
--

DROP TABLE IF EXISTS `tb_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_category` (
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
-- Dumping data for table `tb_category`
--

LOCK TABLES `tb_category` WRITE;
/*!40000 ALTER TABLE `tb_category` DISABLE KEYS */;
INSERT INTO `tb_category` VALUES (1,'2015-11-25 22:56:14',1,'2015-11-30 22:10:25',1,'癌症肿瘤','','','','A'),(2,'2015-11-25 22:57:07',1,'2015-11-25 22:57:07',1,'心脏外科疾病','','','','A'),(3,'2015-11-25 22:57:36',1,'2015-11-25 22:57:36',1,'普通外科','','','','A');
/*!40000 ALTER TABLE `tb_category` ENABLE KEYS */;
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
