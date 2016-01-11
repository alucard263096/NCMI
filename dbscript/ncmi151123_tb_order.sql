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
-- Table structure for table `tb_order`
--

DROP TABLE IF EXISTS `tb_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_order` (
  `id` int(11) NOT NULL,
  `case_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `submit_date` datetime DEFAULT NULL,
  `meeting_date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_user` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_user` int(11) DEFAULT NULL,
  `order_no` varchar(45) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `tac` varchar(45) DEFAULT NULL,
  `meeting_time` varchar(45) DEFAULT NULL,
  `meeting_id` varchar(45) DEFAULT NULL,
  `meeting_number` varchar(45) DEFAULT NULL,
  `meeting_organizerJoinUrl` varchar(250) DEFAULT NULL,
  `meeting_organizerToken` varchar(45) DEFAULT NULL,
  `meeting_panelistJoinUrl` varchar(250) DEFAULT NULL,
  `meeting_panelistToken` varchar(45) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `send` varchar(45) DEFAULT NULL,
  `trade_no` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_order`
--

LOCK TABLES `tb_order` WRITE;
/*!40000 ALTER TABLE `tb_order` DISABLE KEYS */;
INSERT INTO `tb_order` VALUES (1,10,100,'2015-12-19 15:45:25','2015-12-14','T','2015-12-19 15:45:25',1,'2015-12-19 15:45:25',1,'PT201512000001',1,'m',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(2,11,100,'2015-12-22 22:06:31','2015-12-24','A','2015-12-22 22:06:31',1,'2015-12-22 22:06:31',1,'PT201512000002',1,'m','15:00-17:00',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(3,12,100,'2015-12-22 23:07:05','2015-12-23','A','2015-12-22 23:07:05',1,'2015-12-22 23:07:05',1,'PT201512000003',1,'a','14:00-14:18',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(4,13,100,'2015-12-22 23:08:23','2015-12-23','A','2015-12-22 23:08:23',1,'2015-12-22 23:08:23',1,'PT201512000004',1,'a','16:42-17:00',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(5,14,100,'2015-12-22 23:18:03','2015-12-23','A','2015-12-22 23:18:03',1,'2015-12-22 23:18:03',1,'PT201512000005',1,'a','14:18-14:36',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(6,15,100,'2015-12-22 23:25:04','2015-12-23','A','2015-12-22 23:25:04',1,'2015-12-22 23:25:04',1,'PT201512000006',1,'a','14:54-15:12',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(7,16,100,'2015-12-31 00:22:13','2016-01-04','A','2015-12-31 00:22:13',1,'2015-12-31 00:22:13',1,'PT201512000007',1,'m','08:00-08:24',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL),(8,17,100,'2016-01-04 23:33:32','2016-01-05','A','2016-01-04 23:33:32',1,'2016-01-04 23:33:32',1,'PT201601000001',1,'m','08:00-08:24','09a7205435564a6d8938fff6f7a69523','13353207','http://jwyk.gensee.com/webcast/site/live/organizer-29272-c395a761-bab8-4c5b-9f29-2dc5f5a436fd','888888','http://jwyk.gensee.com/webcast/site/entry/live-09a7205435564a6d8938fff6f7a69523','657064',1,NULL,NULL),(9,18,100,'2016-01-05 00:10:14','2016-01-06','A','2016-01-05 00:10:14',1,'2016-01-05 00:10:14',1,'PT201601000002',1,'m','08:00-08:24','e8567933ae8a416eb042e76090ea305d','51193243','http://jwyk.gensee.com/webcast/site/live/organizer-29272-4a1bc9ea-9ac1-47ce-b3d3-cdb656039e93','888888','http://jwyk.gensee.com/webcast/site/entry/live-e8567933ae8a416eb042e76090ea305d','983582',1,NULL,NULL),(10,19,100,'2016-01-05 23:06:49','2016-01-06','A','2016-01-05 23:06:49',1,'2016-01-05 23:06:49',1,'PT201601000003',1,'a','14:00-14:18','69ca06492a73454986218f3c3cc87623','64261699','http://jwyk.gensee.com/webcast/site/live/organizer-29272-27023bd7-956c-4fe1-80d7-5c016dc56058','333333','http://jwyk.gensee.com/webcast/site/entry/live-69ca06492a73454986218f3c3cc87623','888888',1,NULL,NULL),(11,20,100,'2016-01-05 23:20:15','2016-01-06','A','2016-01-05 23:20:15',1,'2016-01-05 23:20:15',1,'PT201601000004',1,'a','14:18-14:36','3a889403e1eb43f48f77319460e5d0d8','15084471','http://jwyk.gensee.com/webcast/site/live/organizer-29272-10d80ea9-a0e8-48c9-9ecd-3d6530ff9cfd','333333','http://jwyk.gensee.com/webcast/site/entry/live-3a889403e1eb43f48f77319460e5d0d8','888888',1,NULL,NULL),(12,21,100,'2016-01-05 23:32:03','2016-01-07','A','2016-01-05 23:32:03',1,'2016-01-05 23:32:03',1,'PT201601000005',1,'m','09:12-09:36','384b73548dfb482d84d3c0532aff750b','89838412','http://jwyk.gensee.com/webcast/site/live/organizer-29272-28e9ff71-542a-4630-9ac9-6992a3cfa5dd','333333','http://jwyk.gensee.com/webcast/site/entry/live-384b73548dfb482d84d3c0532aff750b','888888',1,NULL,NULL),(13,22,100,'2016-01-05 23:34:54','2016-01-10','A','2016-01-05 23:34:54',1,'2016-01-05 23:34:54',1,'PT201601000006',1,'m','08:00-08:24','2244b8fd2076444ca93f3dd9c528351b','80734450','http://jwyk.gensee.com/webcast/site/live/organizer-29272-8850424e-810d-4033-8433-e93952927c28','333333','http://jwyk.gensee.com/webcast/site/entry/live-2244b8fd2076444ca93f3dd9c528351b','888888',1,NULL,NULL),(14,23,100,'2016-01-07 00:20:38','2016-01-10','F','2016-01-07 00:20:38',1,'2016-01-07 00:20:38',1,'PT201601000007',1,'a','14:00-14:18','450be9b598984d3fbdda469722869600','06190715','http://jwyk.gensee.com/webcast/site/live/organizer-29272-5318281e-584c-4e2d-a15a-4e4f2c741e88','333333','http://jwyk.gensee.com/webcast/site/entry/live-450be9b598984d3fbdda469722869600','888888',1,NULL,'2016010721001004690085206127'),(15,24,100,'2016-01-07 12:45:00','2016-01-10','A','2016-01-07 12:45:00',1,'2016-01-07 12:45:00',1,'PT201601000008',2,'m','08:48-09:12','e789c9476fea480db075e70c35f4864b','47127412','http://jwyk.gensee.com/webcast/site/live/organizer-29272-2ff093ff-6176-4fd0-bdd9-a75ad8ba96b6','333333','http://jwyk.gensee.com/webcast/site/entry/live-e789c9476fea480db075e70c35f4864b','888888',1,NULL,'2016010721001004690084389255'),(16,25,100,'2016-01-07 22:56:31','2016-01-10','A','2016-01-07 22:56:31',1,'2016-01-07 22:56:31',1,'PT201601000009',3,'m','08:24-08:48','b043f39f1ac340419d1f7fc33be115d2','97064957','http://jwyk.gensee.com/webcast/site/live/organizer-29272-4eee32e6-bbd4-41d9-a520-6aca65e5968d','333333','http://jwyk.gensee.com/webcast/site/entry/live-b043f39f1ac340419d1f7fc33be115d2','888888',1,NULL,'2016010721001004690084460746'),(17,26,100,'2016-01-07 22:59:23','2016-01-10','A','2016-01-07 22:59:23',1,'2016-01-07 22:59:23',1,'PT201601000010',3,'m','09:12-09:36','e64100d0750f4bd88b40bbcee24488e5','78937073','http://jwyk.gensee.com/webcast/site/live/organizer-29272-cf4abd08-a648-45af-8fc3-9cfb1b25a420','333333','http://jwyk.gensee.com/webcast/site/entry/live-e64100d0750f4bd88b40bbcee24488e5','888888',1,NULL,'2016010721001004690086054702'),(18,27,100,'2016-01-08 23:28:20','2016-01-11','A','2016-01-08 23:28:20',1,'2016-01-08 23:28:20',1,'PT201601000011',1,'m','09:12-09:36','4e10a51f6080491fb699a98fa7a96e81','31295971','http://jwyk.gensee.com/webcast/site/live/organizer-29272-5b238503-b1f6-46f4-84bb-7341f0061199','333333','http://jwyk.gensee.com/webcast/site/entry/live-4e10a51f6080491fb699a98fa7a96e81','888888',1,NULL,'2016010821001004690098601625');
/*!40000 ALTER TABLE `tb_order` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-12  1:29:00
