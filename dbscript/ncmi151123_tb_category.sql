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
INSERT INTO `tb_category` VALUES (1,'2016-01-12 14:59:20',1,'2016-01-12 15:16:37',1,'内科常见病','1','','','A'),(2,'2016-01-12 15:05:13',1,'2016-01-12 15:16:46',1,'神经内科常见病','2','','','A'),(3,'2016-01-12 15:11:36',1,'2016-01-12 15:11:36',1,'内分泌科常见病','','','','A'),(4,'2016-01-12 15:14:09',1,'2016-01-12 15:14:09',1,'风湿免疫科常见病','','','','A'),(5,'2016-01-12 15:20:25',1,'2016-01-12 15:20:43',1,'外科常见病','','','','A'),(6,'2016-01-12 15:29:26',1,'2016-01-12 15:29:26',1,'泌尿外科常见病','','','','A'),(7,'2016-01-12 15:31:31',1,'2016-01-12 15:31:31',1,'乳腺外科常见病','','','','A'),(8,'2016-01-12 15:51:56',1,'2016-01-12 15:53:19',1,'妇产科常见病','','','','A'),(9,'2016-01-12 16:29:12',1,'2016-01-12 16:29:12',1,'皮肤性病科常见病','','','','A'),(10,'2016-01-12 16:37:51',1,'2016-01-12 16:37:51',1,'骨科常见病','','','','A'),(11,'2016-01-12 16:40:48',1,'2016-01-12 16:40:48',1,'脊柱外科常见病','','','','A'),(12,'2016-01-12 16:42:40',1,'2016-01-12 16:42:40',1,'关节外科常见病','','','','A'),(13,'2016-01-12 16:45:39',1,'2016-01-12 16:45:39',1,'创伤骨科常见病','','','','A'),(14,'2016-01-12 16:57:20',1,'2016-01-12 16:57:20',1,'耳鼻咽喉常见病','','','','A'),(15,'2016-01-12 17:04:49',1,'2016-01-12 17:04:49',1,'心内科常见病','','','','A'),(16,'2016-01-12 17:07:50',1,'2016-01-12 17:07:50',1,'儿科常见病','','','','A'),(17,'2016-01-12 17:11:31',1,'2016-01-12 17:11:31',1,'口腔科常见病','','','','A'),(18,'2016-01-12 17:16:37',1,'2016-01-12 17:16:37',1,'精神科常见病','','','','A');
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

-- Dump completed on 2016-01-13  1:58:02
