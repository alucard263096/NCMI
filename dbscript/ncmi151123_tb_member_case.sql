CREATE DATABASE  IF NOT EXISTS `ncmi151123` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ncmi151123`;
-- MySQL dump 10.13  Distrib 5.6.19, for Win64 (x86_64)
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
-- Table structure for table `tb_member_case`
--

DROP TABLE IF EXISTS `tb_member_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_member_case` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `apply_hospital` varchar(45) DEFAULT NULL,
  `apply_date` date DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `sexual` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `way` varchar(45) DEFAULT NULL,
  `urgent` varchar(45) DEFAULT NULL,
  `necessary` varchar(200) DEFAULT NULL,
  `meeting_date` date DEFAULT NULL,
  `first_result` varchar(1000) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `doctor_name` varchar(45) DEFAULT NULL,
  `result` varchar(1000) DEFAULT NULL,
  `checking` varchar(1000) DEFAULT NULL,
  `solution` varchar(1000) DEFAULT NULL,
  `caution` varchar(1000) DEFAULT NULL,
  `signature` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_member_case`
--

LOCK TABLES `tb_member_case` WRITE;
/*!40000 ALTER TABLE `tb_member_case` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_member_case` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-03 17:15:35
