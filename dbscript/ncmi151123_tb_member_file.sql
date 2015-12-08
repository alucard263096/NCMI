CREATE DATABASE  IF NOT EXISTS `ncmi151123` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ncmi151123`;
-- MySQL dump 10.13  Distrib 5.6.19, for Win32 (x86)
--
-- Host: 120.24.239.49    Database: ncmi151123
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
-- Table structure for table `tb_member_file`
--

DROP TABLE IF EXISTS `tb_member_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_member_file` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `sexual` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `birth` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `nation` varchar(45) DEFAULT NULL,
  `oriplace` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `marriaged` varchar(45) DEFAULT NULL,
  `education` varchar(45) DEFAULT NULL,
  `identity` varchar(45) DEFAULT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `workspace` varchar(45) DEFAULT NULL,
  `home_address` varchar(200) DEFAULT NULL,
  `postcode` varchar(45) DEFAULT NULL,
  `internal_code` varchar(45) DEFAULT NULL,
  `diagnosis_code` varchar(45) DEFAULT NULL,
  `contact_people` varchar(45) DEFAULT NULL,
  `contact_relationship` varchar(45) DEFAULT NULL,
  `contact_tel` varchar(45) DEFAULT NULL,
  `contact_address` varchar(200) DEFAULT NULL,
  `diagnosis` varchar(500) DEFAULT NULL,
  `menstrual_history` varchar(200) DEFAULT NULL,
  `childbearing_history` varchar(200) DEFAULT NULL,
  `allergic_history` varchar(500) DEFAULT NULL,
  `disease_history` varchar(500) DEFAULT NULL,
  `person_history` varchar(500) DEFAULT NULL,
  `family_history` varchar(500) DEFAULT NULL,
  `smoke` varchar(45) DEFAULT NULL,
  `smoke_months` varchar(45) DEFAULT NULL,
  `drink` varchar(45) DEFAULT NULL,
  `drink_months` varchar(45) DEFAULT NULL,
  `exercise` varchar(45) DEFAULT NULL,
  `exercise_inweek` varchar(45) DEFAULT NULL,
  `exercise_intime` varchar(45) DEFAULT NULL,
  `exercise_type` varchar(45) DEFAULT NULL,
  `blood_type` varchar(45) DEFAULT NULL,
  `diet` varchar(45) DEFAULT NULL,
  `live` varchar(45) DEFAULT NULL,
  `medical` varchar(45) DEFAULT NULL,
  `health` varchar(45) DEFAULT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `insurance` varchar(45) DEFAULT NULL,
  `household` varchar(45) DEFAULT NULL,
  `health_level` varchar(45) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL,
  `BMI` varchar(45) DEFAULT NULL,
  `bust` varchar(45) DEFAULT NULL,
  `waistlines` varchar(45) DEFAULT NULL,
  `hip` varchar(45) DEFAULT NULL,
  `income` varchar(45) DEFAULT NULL,
  `pingyin` varchar(45) DEFAULT NULL,
  `wubi` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_member_file`
--

LOCK TABLES `tb_member_file` WRITE;
/*!40000 ALTER TABLE `tb_member_file` DISABLE KEYS */;
INSERT INTO `tb_member_file` VALUES (1,1,'测试1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-12-09 00:21:03','A'),(2,1,'测试2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-12-09 00:21:03','A'),(3,1,'测试3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-12-09 00:20:39','A');
/*!40000 ALTER TABLE `tb_member_file` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-09  0:23:33
