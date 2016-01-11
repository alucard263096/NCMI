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
-- Table structure for table `tb_member_detail_info`
--

DROP TABLE IF EXISTS `tb_member_detail_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_member_detail_info` (
  `member_id` int(11) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `education` varchar(45) DEFAULT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `work_profession` varchar(45) DEFAULT NULL,
  `profession_category` varchar(45) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `work_years` varchar(45) DEFAULT NULL,
  `study_years` varchar(45) DEFAULT NULL,
  `disease_advantage` varchar(45) DEFAULT NULL,
  `workspace` varchar(45) DEFAULT NULL,
  `clinic_years` varchar(45) DEFAULT NULL,
  `clinic_category` varchar(45) DEFAULT NULL,
  `profession_scope` varchar(200) DEFAULT NULL,
  `college` varchar(45) DEFAULT NULL,
  `doctor_certificate` varchar(200) DEFAULT NULL,
  `work_certificate` varchar(200) DEFAULT NULL,
  `skill_certficate` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_member_detail_info`
--

LOCK TABLES `tb_member_detail_info` WRITE;
/*!40000 ALTER TABLE `tb_member_detail_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_detail_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-12  0:11:16
