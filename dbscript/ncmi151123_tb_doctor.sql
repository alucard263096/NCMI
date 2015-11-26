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
-- Table structure for table `tb_doctor`
--

DROP TABLE IF EXISTS `tb_doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_doctor` (
  `id` int(11) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `seq` varchar(100) DEFAULT NULL,
  `count` varchar(100) DEFAULT NULL,
  `content` text,
  `duty_mon_m` varchar(100) DEFAULT NULL,
  `duty_mon_a` varchar(100) DEFAULT NULL,
  `duty_tue_m` varchar(100) DEFAULT NULL,
  `duty_tue_a` varchar(100) DEFAULT NULL,
  `duty_wed_m` varchar(100) DEFAULT NULL,
  `duty_wed_a` varchar(100) DEFAULT NULL,
  `duty_thu_m` varchar(100) DEFAULT NULL,
  `duty_thu_a` varchar(100) DEFAULT NULL,
  `duty_fri_m` varchar(100) DEFAULT NULL,
  `duty_fri_a` varchar(100) DEFAULT NULL,
  `duty_sat_m` varchar(100) DEFAULT NULL,
  `duty_sat_a` varchar(100) DEFAULT NULL,
  `duty_sun_m` varchar(100) DEFAULT NULL,
  `duty_sun_a` varchar(100) DEFAULT NULL,
  `duty_notice` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `expert` varchar(100) DEFAULT NULL,
  `sextual` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_doctor`
--

LOCK TABLES `tb_doctor` WRITE;
/*!40000 ALTER TABLE `tb_doctor` DISABLE KEYS */;
INSERT INTO `tb_doctor` VALUES (1,'2015-11-25 23:06:22',1,'2015-11-25 23:20:37',1,'张力','25e85deb228e8fa32a8ea05a04b8b464.png',1,1,'A','',NULL,'','','','','','','','','','','','','','','','','','副主任医师','骨科','M'),(2,'2015-11-25 23:16:21',1,'2015-11-25 23:20:18',1,'郭仪柱','20adb5401683de2fd321967e920f1d4b.png',2,2,'A','',NULL,'','','','','','','','','','','','','','','','','','副主任医生','脑科','M'),(3,'2015-11-25 23:22:09',1,'2015-11-25 23:22:09',1,'王岩','05e7383fd31ef907e8028de54dbc9717.png',3,3,'A','',NULL,'','','','','','','','','','','','','','','','','','主任医师（教授）','心脏科','M');
/*!40000 ALTER TABLE `tb_doctor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-26 23:58:55
