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
-- Table structure for table `tb_member_case`
--

DROP TABLE IF EXISTS `tb_member_case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_member_case` (
  `id` int(11) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
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
  `position` varchar(45) DEFAULT NULL,
  `result` varchar(1000) DEFAULT NULL,
  `checking` varchar(1000) DEFAULT NULL,
  `solution` varchar(1000) DEFAULT NULL,
  `caution` varchar(1000) DEFAULT NULL,
  `signature` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `summary` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `apply_department` varchar(45) DEFAULT NULL,
  `apply_doctor` varchar(45) DEFAULT NULL,
  `apply_history` varchar(1000) DEFAULT NULL,
  `apply_situation` varchar(1000) DEFAULT NULL,
  `apply_report` varchar(1000) DEFAULT NULL,
  `apply_procedure` varchar(1000) DEFAULT NULL,
  `apply_first_result` varchar(1000) DEFAULT NULL,
  `contact_tel` varchar(45) DEFAULT NULL,
  `contact_address` varchar(45) DEFAULT NULL,
  `hospital` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `meeting_time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_member_case`
--

LOCK TABLES `tb_member_case` WRITE;
/*!40000 ALTER TABLE `tb_member_case` DISABLE KEYS */;
INSERT INTO `tb_member_case` VALUES (1,1,1,'病历1',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-23',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A','2015-12-10 15:11:28','2015-12-10 15:11:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,1,2,'病历2',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A','2015-12-10 15:11:28','2015-12-10 15:11:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,1,3,'病历3',3,'远东医院','2015-12-11','蔡笋','','18',NULL,NULL,NULL,NULL,'2015-10-25',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A','2015-12-10 15:11:28','2015-12-10 15:11:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,1,1,'病历4',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'A','2015-12-10 16:26:21','2015-12-10 16:26:21',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,2,'病历5',2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'T','2015-12-10 16:26:21','2015-12-10 16:41:34',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,1,4,'申请单2015-12-16',1,'解放军总医院会诊','2015-12-15','蔡笋','F','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-16','','','','','','','','T','2015-12-15 00:47:59','2015-12-15 00:47:59','','刘存','普通外科会诊','张力会诊','既往史','会诊现病情:','会诊化验结果','会诊治疗经过','会诊初步诊断','13622353259','西丽','解放军总医院','普通外科','255479261',NULL),(7,1,4,'申请单2015-12-16',1,'会诊医院:','2015-12-16','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-16','','','','','','','','T','2015-12-16 00:22:19','2015-12-16 00:22:19','','刘存','会诊医院:','会诊医院:','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926',NULL),(8,1,4,'申请单2015-12-16',1,'会诊医院:','2015-12-16','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-16','','','','','','','','T','2015-12-16 00:22:48','2015-12-16 00:22:48','','刘存','会诊医院:','会诊医院:','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926',NULL),(9,1,4,'申请单2015-12-16',1,'会诊医院:','2015-12-16','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-16','','','','','','','','T','2015-12-16 00:23:15','2015-12-16 00:23:15','','刘存','会诊医院:','会诊医院:','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926',NULL),(10,1,4,'申请单2015-12-14',1,'医院','2015-12-18','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-14','','','Array','','','','','T','2015-12-19 15:45:25','2015-12-19 15:45:25','','刘存','外科','张力','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926',NULL),(11,1,4,'申请单2015-12-25',1,'军总医','2015-12-17','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-25','','','','','','','','T','2015-12-22 22:06:31','2015-12-22 22:06:31','','刘存','外','张力','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926',NULL),(12,1,4,'申请单2015-12-23',1,'aaa','2015-12-23','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-23','','','','','','','','T','2015-12-22 23:07:05','2015-12-22 23:07:05','','刘存','eee','eee','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926','14:00-14:18'),(13,1,4,'申请单2015-12-23',1,'aa','2015-12-16','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-23','','','','','','','','T','2015-12-22 23:08:23','2015-12-22 23:08:23','','刘存','aa','aa','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926','16:42-17:00'),(14,1,4,'申请单2015-12-23',1,'a','2015-12-22','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-23','','','','','','','','T','2015-12-22 23:18:03','2015-12-22 23:18:03','','刘存','a','a','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926','14:18-14:36'),(15,1,4,'申请单2015-12-23',1,'aa','2015-12-22','蔡笋','M','18','单科会诊','视频会诊','普通','会诊方要求','2015-12-23','','','','','','','','T','2015-12-22 23:25:04','2015-12-22 23:25:04','','刘存','aa','aa','','','','','','13622353259','西丽','解放军总医院','普通外科','25547926','14:54-15:12');
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

-- Dump completed on 2015-12-22 23:36:44
