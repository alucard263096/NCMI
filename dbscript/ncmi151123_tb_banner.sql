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
-- Table structure for table `tb_banner`
--

DROP TABLE IF EXISTS `tb_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_banner` (
  `id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `index_key` varchar(500) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `name` varchar(500) DEFAULT NULL,
  `position` varchar(500) DEFAULT NULL,
  `cont` text,
  `link` varchar(500) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_banner`
--

LOCK TABLES `tb_banner` WRITE;
/*!40000 ALTER TABLE `tb_banner` DISABLE KEYS */;
INSERT INTO `tb_banner` VALUES (1,'2015-11-27 16:47:44',1,'2015-11-27 21:39:21',1,'index_banner_1','首页广告大图1测试','首页广告大图1','首页广告大图1','','http://www.baidu.com','945759faefa942432e2e42b7777c58e3.jpg','A'),(2,'2015-11-27 16:51:10',1,'2015-11-27 21:39:32',1,'index_banner_2','首页广告大图2测试','首页广告大图2','首页广告大图2','','http://www.baidu.com','cfb71fe21a034334977d92586813353b.jpg','A'),(3,'2015-11-27 16:51:10',1,'2015-11-27 21:39:40',1,'index_banner_3','首页广告大图3测试','首页广告大图3','首页广告大图3','','http://www.baidu.com','cbe4e99305826484d514c67767f5d1cf.jpg','A'),(4,'2015-11-27 16:51:10',1,'2015-11-27 21:39:49',1,'index_banner_4','首页广告大图4测试','首页广告大图4','首页广告大图4','','http://www.baidu.com','fc42a9254d5439f1803e5b7a4a59510e.jpg','A'),(5,'2015-11-27 16:51:10',1,'2015-11-27 21:39:57',1,'index_banner_5','首页广告大图5测试','首页广告大图5','首页广告大图5','','http://www.baidu.com','2be6b3998ecba1534de7de8ba036ce79.jpg','A'),(6,'2015-11-27 16:51:10',1,'2015-11-27 21:40:06',1,'index_banner_6','首页广告大图6测试','首页广告大图6','首页广告大图6','','http://www.baidu.com','5e8829a818a872e8fc932bbec7b4a44c.jpg','A'),(7,'2015-11-27 16:51:10',1,'2015-11-27 21:40:14',1,'index_banner_7','首页广告大图7测试','首页广告大图7','首页广告大图7','','http://www.baidu.com','067e60f3d5189e485132ecf78297a3a7.jpg','A'),(8,'2015-11-27 16:51:10',1,'2015-11-27 21:40:22',1,'index_banner_8','首页广告大图8测试','首页广告大图8','首页广告大图8','','http://www.baidu.com','48030ba1af38e1b22fbeab55c4327803.jpg','A');
/*!40000 ALTER TABLE `tb_banner` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-05  1:19:12
