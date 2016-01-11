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
  `majority` varchar(45) DEFAULT NULL,
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
  `health_level` varchar(450) DEFAULT NULL,
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
  `block` varchar(45) DEFAULT NULL,
  `block_office` varchar(45) DEFAULT NULL,
  `identity_type` varchar(45) DEFAULT NULL,
  `insurance_no` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_member_file`
--

LOCK TABLES `tb_member_file` WRITE;
/*!40000 ALTER TABLE `tb_member_file` DISABLE KEYS */;
INSERT INTO `tb_member_file` VALUES (1,1,'父亲的档案','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',NULL,'2016-01-09 23:49:30','A','','','',''),(2,1,'母亲的档案','','','','','','','','','','','','家庭地址','','家庭地址','家庭地址','','家庭地址','日哦','','','','','日哦','家庭地址','','日哦','家庭地址','','','','','','','','','','','','','','家庭地址','家庭地址','','','','','','','','','','','','','',NULL,'2016-01-09 23:49:41','A','','','',''),(3,1,'妻子的档案','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',NULL,'2016-01-09 23:49:57','A','','','',''),(4,1,'我的档案','蔡笋','M','18','1986-03-24','','中国','汉','广东','13751082562','M','M','440301198603247514','工程师','深圳东海国际中心','龙岗怡龙枫景园1栋A座201','刘存','1234567','87954541','刘存','夫妻','13622353259','西丽','没有什么主要诊断','男的没有月经','一个女儿','没有','脂溢性皮炎既往病史','脂溢性皮炎个人史','无家族史','0','0','0','0','5','1','2','足球','A','无饮食嗜好','无生活事件','药物滥用','卫生习惯','宗教信仰:','W','','健康状况','181','74','','38','49','50','10','ABC','GGD','2015-12-10 01:51:20','2016-01-05 23:22:18','A','隶属社区','隶属派出所','U','852');
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

-- Dump completed on 2016-01-12  0:11:15
