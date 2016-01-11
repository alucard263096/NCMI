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
  `loginname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_doctor`
--

LOCK TABLES `tb_doctor` WRITE;
/*!40000 ALTER TABLE `tb_doctor` DISABLE KEYS */;
INSERT INTO `tb_doctor` VALUES (1,'2015-11-25 23:06:22',1,'2015-12-22 22:02:52',1,'张力','25e85deb228e8fa32a8ea05a04b8b464.png',1,1,'A','',NULL,'<p style=\"text-indent: 0px; \"><span style=\"\">张力教授，1927年生于河南省焦作市。主任医师、教授，中央保健委员会特聘会诊专家，中华医学会感染病学分会专家会员。1946年10月考入南京金陵女子大学医预系，1949年9月考入北京协和医学院医疗系，1953年7月任协和医学院内科住院医师。</span></p>\n',10,10,10,10,10,10,10,10,10,10,0,0,0,0,'','','副主任医师','骨科','M',100,'zhangli'),(2,'2015-11-25 23:16:21',1,'2015-12-22 22:03:01',1,'郭仪柱','20adb5401683de2fd321967e920f1d4b.png',2,2,'A','',NULL,'<p>郭仪柱<span style=\"\">教授，1927年生于河南省焦作市。主任医师、教授，中央保健委员会特聘会诊专家，中华医学会感染病学分会专家会员。1946年10月考入南京金陵女子大学医预系，1949年9月考入北京协和医学院医疗系，1953年7月任协和医学院内科住院医师。</span></p>\n',10,10,10,10,10,10,10,10,10,10,0,0,0,0,'','','副主任医生','脑科','M',100,'guoyizhu'),(3,'2015-11-25 23:22:09',1,'2015-12-01 00:12:45',1,'王岩','05e7383fd31ef907e8028de54dbc9717.png',3,3,'A','',NULL,'<p>王岩[4] &nbsp;，男，52岁，北京籍，现任中国人民解放军总医院（301医院）骨科主任医师、教授、博士生导师。享受政府特殊津贴。中国医师协会骨科医师分会会长[2] &nbsp;、中华医学会骨科学分会主任委员（2011-2013）[5] &nbsp;、中国人民解放军骨科专业委员会主任委员[1] &nbsp;，世界骨科联盟（WOA）主席[6] &nbsp;、全球华裔骨科学会（CSOS）主席、亚洲关节外科学会（ASIA）主席[7] &nbsp;；美国脊柱外科杂志《Spine》副主编[3] &nbsp;，美国关节外科杂志《Journal of Arthroplasty》副主编[3] &nbsp;；国际脊柱侧弯研究学会（SRS）Active Fellow[1] &nbsp;, 美国髋关节学会(AHS)Honored Member[1] &nbsp;，美国骨与关节医师协会(ABJS)[7] &nbsp;、北美脊柱外科学会（NASS）Active Member[7] &nbsp;，国际矫形与创伤外科学会（SICOT）[1] &nbsp;、欧洲国家矫形及创伤学会联盟（EFORT）Corresponding Member[1] &nbsp;；美国哈佛大学医学院、清华大学、南开大学、四川大学等客座教授[1] &nbsp;，《中国组织工程研究》总主编[9] &nbsp;、《中华外科杂志》[10] &nbsp;、《中华骨科杂志》[11] &nbsp;、《中国骨伤》[12] &nbsp;、《解放军医学杂志》[13] &nbsp;副主编。<br />\n王岩[1] &nbsp;教授荣获国家科学技术进步一等奖2项（第一完成人），军队科技进步一等奖1项（第一完成人），国家七部委&ldquo;百千万人才工程国家级人选&rdquo;，获中国科协&ldquo;十佳全国优秀科技工作者&rdquo;荣誉称号，&ldquo;CCTV 2012年度十大科技创新人物&rdquo;，何梁何利基金&ldquo;科学与技术进步奖&rdquo;，团中央、中国科学院、中国工程院&ldquo;第六届中国青年科学家奖&rdquo;[1] &nbsp;； 荣立一等功2次，荣获总参谋部、总政治部、总后勤部、总装备部&ldquo;中国人民解放军杰出专业人才奖&rdquo;，总政治部&ldquo;军队科技领军人才&rdquo;荣誉称号，总后勤部科技金星、&ldquo;军队科技创新群体&rdquo;奖[1] &nbsp;[15] &nbsp;；亲赴汶川、玉树、雅安抗震救灾第一线，被中共中央、国务院及中央军委授予&ldquo;全国抗震救灾模范&rdquo;荣誉称号[1] &nbsp;。以第一责任人身份承担国家863重大课题和军队重点科研等项目9项，累计科研经费过亿元[1] &nbsp;。荣获国家发明专利13项、美国发明专利授权2项，国家食品药品监督管理局颁发的医疗器械证6项[1] &nbsp;。被评为2012年度&ldquo;中国名医百强榜&rdquo;脊柱外科、关节外科上榜名医[16] &nbsp;。<br />\n在国内外发表论文578篇，其中以第一作者和通讯作者身份发表SCI论文77篇，主编主译包括《坎贝尔骨科手术学（第10、11、12版）》[17] &nbsp;等专著（教材）30部，并与世界脊柱届的著名专家Laurence Lenke教授和Oheneba Boachie-Adjei教授共同主编完成世界脊柱外科里程碑式著作《Spinal Osteotomy》[18] &nbsp;（已由著名出版社Springer全球出版发行）；参与主持编写全国高等学校教材《骨科学教程》[19] &nbsp;（人民卫生出版社出版发行）。依托中华医学会、人民军医出版社系列标准手术示教片100台。培养博士后8人，博士42人，硕士20人，专科医师400余人；先后送出青年骨干医生13人次出国深造半年以上[1] &nbsp;。</p>\n',10,10,10,10,10,10,10,10,10,10,0,0,0,0,'本医生将于10月20号至25号进行巡回讲座，请勿在此时间预约，谢谢合作。','','主任医师（教授）','心脏科','M',100,NULL);
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

-- Dump completed on 2016-01-12  0:11:18
