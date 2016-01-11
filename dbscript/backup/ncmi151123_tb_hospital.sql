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
-- Table structure for table `tb_hospital`
--

DROP TABLE IF EXISTS `tb_hospital`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_hospital` (
  `id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `seq` varchar(100) DEFAULT NULL,
  `shortname` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `website` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `content` text,
  `count` varchar(100) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  `property` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_hospital`
--

LOCK TABLES `tb_hospital` WRITE;
/*!40000 ALTER TABLE `tb_hospital` DISABLE KEYS */;
INSERT INTO `tb_hospital` VALUES (1,'2015-11-25 22:36:37',1,'2015-11-25 22:36:37',1,'解放军总医院','','解放军总医院','0c3ffb80ed4c0586912ace7e4a164c87.jpg','北京市海淀区复兴路28号','100853','http://www.baidu.com','admin@baidu.com','<p>解放军总医院是全军规模最大的综合性医院，集医疗、保健、教学、科研于一体，是国家重要保健基地之一，负责中央、军委和总部的医疗保健工作，承担全军各军区、军兵种疑难病的诊治，医院同时也收治来自全国的地方病人。<br />\\n全院共展开床位4400余张，其中院本部3400余张，三0四临床部1000余张。共设临床、医技科室103余个，其中耳鼻咽喉-头颈外科、骨科、老年医学等6个国家级重点学科，8个全军重点实验室，13个全军医学专科中心，13个全军医学研究所，1个全军医学专病中心。<br />\\n医院位于北京市复兴路28号院，占地面积118.8万平方米，建筑面积110.07万平方米。</p>\\n',NULL,'','A',NULL,NULL),(2,'2015-11-25 22:41:02',1,'2016-01-08 00:49:10',1,'宣武医院','','宣武医院','879489346c25b6549b4ffe2ebab1895a.jpg','宣武医院地址','100000','http://www,baidu.com','admin@test.com','<p>解放军总医院是全军规模最大的综合性医院，集医疗、保健、教学、科研于一体，是国家重要保健基地之一，负责中央、军委和总部的医疗保健工作，承担全军各军区、军兵种疑难病的诊治，医院同时也收治来自全国的地方病人。<br />\n\\n全院共展开床位4400余张，其中院本部3400余张，三0四临床部1000余张。共设临床、医技科室103余个，其中耳鼻咽喉-头颈外科、骨科、老年医学等6个国家级重点学科，8个全军重点实验室，13个全军医学专科中心，13个全军医学研究所，1个全军医学专病中心。<br />\n\\n医院位于北京市复兴路28号院，占地面积118.8万平方米，建筑面积110.07万平方米。</p>\n\n<p>\\n</p>\n',NULL,'','A',NULL,NULL),(3,'2015-11-25 22:42:01',1,'2015-11-28 01:09:09',1,'北京老年人医院','','北京老年人医院','983562fddd3c4ab78a3cbd0ed252cb7b.jpg','北京老年人医院地址','100000','http://www,baidu.com','admin@test.com','',NULL,'','A',NULL,NULL);
/*!40000 ALTER TABLE `tb_hospital` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-12  0:11:17
