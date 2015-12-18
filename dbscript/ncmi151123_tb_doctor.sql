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
  `duty_mon_m` int(11) DEFAULT NULL,
  `duty_mon_a` int(11) DEFAULT NULL,
  `duty_tue_m` int(11) DEFAULT NULL,
  `duty_tue_a` int(11) DEFAULT NULL,
  `duty_wed_m` int(11) DEFAULT NULL,
  `duty_wed_a` int(11) DEFAULT NULL,
  `duty_thu_m` int(11) DEFAULT NULL,
  `duty_thu_a` int(11) DEFAULT NULL,
  `duty_fri_m` int(11) DEFAULT NULL,
  `duty_fri_a` int(11) DEFAULT NULL,
  `duty_sat_m` int(11) DEFAULT NULL,
  `duty_sat_a` int(11) DEFAULT NULL,
  `duty_sun_m` int(11) DEFAULT NULL,
  `duty_sun_a` int(11) DEFAULT NULL,
  `duty_notice` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `expert` varchar(100) DEFAULT NULL,
  `sextual` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_doctor`
--

LOCK TABLES `tb_doctor` WRITE;
/*!40000 ALTER TABLE `tb_doctor` DISABLE KEYS */;
INSERT INTO `tb_doctor` VALUES (1,'2015-11-25 23:06:22',1,'2015-11-30 12:52:13',1,'张力','b0efaeaa9115add339e2498d4a1dd7be.png',1,1,'A','',NULL,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','副主任医师','骨科','M',1),(2,'2015-11-25 23:16:21',1,'2015-11-30 12:52:30',1,'郭仪柱','f657924d960de0d6a8be5db26655d7bc.png',2,2,'A','',NULL,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','副主任医生','脑科','M',1),(3,'2015-11-25 23:22:09',1,'2015-11-30 12:52:46',1,'王岩','f6c221659a99e1c9a24e97fd3c0f9c65.png',3,3,'A','',NULL,'',0,0,0,0,0,0,0,0,0,0,0,0,0,0,'','','主任医师（教授）','心脏科','M',1);
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

-- Dump completed on 2015-12-18 17:53:08
