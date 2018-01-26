-- MySQL dump 10.13  Distrib 5.7.19, for osx10.12 (x86_64)
--
-- Host: localhost    Database: twist
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `account_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `consumerkey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumersecret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accesstoken` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accesstokensecret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `accounts_screenname_unique` (`screenname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apis`
--

DROP TABLE IF EXISTS `apis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `consumerkey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consumersecret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apis`
--

LOCK TABLES `apis` WRITE;
/*!40000 ALTER TABLE `apis` DISABLE KEYS */;
/*!40000 ALTER TABLE `apis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `botmoniters`
--

DROP TABLE IF EXISTS `botmoniters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `botmoniters` (
  `account_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `botmoniters`
--

LOCK TABLES `botmoniters` WRITE;
/*!40000 ALTER TABLE `botmoniters` DISABLE KEYS */;
/*!40000 ALTER TABLE `botmoniters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `botrules`
--

DROP TABLE IF EXISTS `botrules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `botrules` (
  `botrule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Default Name',
  `span` int(11) NOT NULL DEFAULT '30',
  `botlimit` int(11) NOT NULL DEFAULT '48',
  `allowtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '9,10,11,12,13,14,15,16,17,18,19,20,21',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`botrule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `botrules`
--

LOCK TABLES `botrules` WRITE;
/*!40000 ALTER TABLE `botrules` DISABLE KEYS */;
INSERT INTO `botrules` VALUES (0,0,'送信しない',10000,0,'9,10,11,12,13,14,15,16,17,18,19,20,21','2017-11-26 00:27:14','2017-11-26 00:27:14');
/*!40000 ALTER TABLE `botrules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `botsettings`
--

DROP TABLE IF EXISTS `botsettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `botsettings` (
  `setting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `botrule_id` int(11) NOT NULL DEFAULT '0',
  `botstory_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `botsettings`
--

LOCK TABLES `botsettings` WRITE;
/*!40000 ALTER TABLE `botsettings` DISABLE KEYS */;
/*!40000 ALTER TABLE `botsettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `botstories`
--

DROP TABLE IF EXISTS `botstories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `botstories` (
  `botstory_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Default Name',
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`botstory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `botstories`
--

LOCK TABLES `botstories` WRITE;
/*!40000 ALTER TABLE `botstories` DISABLE KEYS */;
INSERT INTO `botstories` VALUES (0,'送信しない',0,0,'2017-11-26 00:27:14','2017-11-26 00:27:14');
/*!40000 ALTER TABLE `botstories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copyfollows`
--

DROP TABLE IF EXISTS `copyfollows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copyfollows` (
  `copyfollow_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `targetid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`copyfollow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copyfollows`
--

LOCK TABLES `copyfollows` WRITE;
/*!40000 ALTER TABLE `copyfollows` DISABLE KEYS */;
/*!40000 ALTER TABLE `copyfollows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dmmoniters`
--

DROP TABLE IF EXISTS `dmmoniters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dmmoniters` (
  `account_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dmmoniters`
--

LOCK TABLES `dmmoniters` WRITE;
/*!40000 ALTER TABLE `dmmoniters` DISABLE KEYS */;
/*!40000 ALTER TABLE `dmmoniters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dmrules`
--

DROP TABLE IF EXISTS `dmrules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dmrules` (
  `dmrule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Default Name',
  `span` int(11) NOT NULL DEFAULT '1',
  `response` int(11) NOT NULL DEFAULT '6',
  `dmlimit` int(11) NOT NULL DEFAULT '0',
  `allowtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '9,10,11,12,13,14,15,16,17,18,19,20,21',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dmrule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dmrules`
--

LOCK TABLES `dmrules` WRITE;
/*!40000 ALTER TABLE `dmrules` DISABLE KEYS */;
INSERT INTO `dmrules` VALUES (0,0,'送信しない',0,6,0,'9,10,11,12,13,14,15,16,17,18,19,20,21','2017-11-26 00:27:14','2017-11-26 00:27:14');
/*!40000 ALTER TABLE `dmrules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dmsettings`
--

DROP TABLE IF EXISTS `dmsettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dmsettings` (
  `dmsetting_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `dmrule_id` int(11) NOT NULL DEFAULT '0',
  `dmstory_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dmsetting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dmsettings`
--

LOCK TABLES `dmsettings` WRITE;
/*!40000 ALTER TABLE `dmsettings` DISABLE KEYS */;
/*!40000 ALTER TABLE `dmsettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dmstories`
--

DROP TABLE IF EXISTS `dmstories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dmstories` (
  `dmstory_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Default Name',
  `id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dmstory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dmstories`
--

LOCK TABLES `dmstories` WRITE;
/*!40000 ALTER TABLE `dmstories` DISABLE KEYS */;
INSERT INTO `dmstories` VALUES (0,'送信しない',0,0,'2017-11-26 00:27:14','2017-11-26 00:27:14');
/*!40000 ALTER TABLE `dmstories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dmtexts`
--

DROP TABLE IF EXISTS `dmtexts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dmtexts` (
  `dmtext_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dmstory_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`dmtext_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dmtexts`
--

LOCK TABLES `dmtexts` WRITE;
/*!40000 ALTER TABLE `dmtexts` DISABLE KEYS */;
/*!40000 ALTER TABLE `dmtexts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followers` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` int(11) NOT NULL,
  `target_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dmwait` int(11) NOT NULL DEFAULT '0',
  `replywait` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followers`
--

LOCK TABLES `followers` WRITE;
/*!40000 ALTER TABLE `followers` DISABLE KEYS */;
/*!40000 ALTER TABLE `followers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followmoniters`
--

DROP TABLE IF EXISTS `followmoniters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followmoniters` (
  `account_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followmoniters`
--

LOCK TABLES `followmoniters` WRITE;
/*!40000 ALTER TABLE `followmoniters` DISABLE KEYS */;
/*!40000 ALTER TABLE `followmoniters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followrules`
--

DROP TABLE IF EXISTS `followrules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `followrules` (
  `followrule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `span` int(11) NOT NULL DEFAULT '10',
  `followlimit` int(11) NOT NULL DEFAULT '0',
  `allowtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '9,10,11,12,13,14,15,16,17,18,19,20,21',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`followrule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followrules`
--

LOCK TABLES `followrules` WRITE;
/*!40000 ALTER TABLE `followrules` DISABLE KEYS */;
/*!40000 ALTER TABLE `followrules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `follows`
--

DROP TABLE IF EXISTS `follows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `target_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follows`
--

LOCK TABLES `follows` WRITE;
/*!40000 ALTER TABLE `follows` DISABLE KEYS */;
/*!40000 ALTER TABLE `follows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keywordfollows`
--

DROP TABLE IF EXISTS `keywordfollows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keywordfollows` (
  `keywordfollow_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`keywordfollow_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keywordfollows`
--

LOCK TABLES `keywordfollows` WRITE;
/*!40000 ALTER TABLE `keywordfollows` DISABLE KEYS */;
/*!40000 ALTER TABLE `keywordfollows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likerules`
--

DROP TABLE IF EXISTS `likerules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likerules` (
  `account_id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `allowtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '9,10,11,12,13,14,15,16,17,18,19,20,21',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likerules`
--

LOCK TABLES `likerules` WRITE;
/*!40000 ALTER TABLE `likerules` DISABLE KEYS */;
/*!40000 ALTER TABLE `likerules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(177) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (93,'2014_10_12_000000_create_users_table',1),(94,'2014_10_12_100000_create_password_resets_table',1),(95,'2017_10_14_081703_account',1),(96,'2017_10_14_090756_copyfollow',1),(97,'2017_10_14_090811_keywordfollow',1),(98,'2017_10_14_090820_dmstory',1),(99,'2017_10_14_090826_dmrule',1),(100,'2017_10_14_090831_followrule',1),(101,'2017_10_14_090838_botstory',1),(102,'2017_10_16_020734_statistics',1),(103,'2017_10_16_024848_botrules',1),(104,'2017_10_16_054426_dmtexts',1),(105,'2017_10_16_054426_storytexts',1),(106,'2017_10_27_142129_followers',1),(107,'2017_10_29_185035_botmoniter',1),(108,'2017_10_29_185045_dmmoniter',1),(109,'2017_10_30_095002_thanksreply',1),(110,'2017_11_18_022356_apis',1),(111,'2017_11_20_163637_likerules',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `replymoniters`
--

DROP TABLE IF EXISTS `replymoniters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `replymoniters` (
  `account_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `replymoniters`
--

LOCK TABLES `replymoniters` WRITE;
/*!40000 ALTER TABLE `replymoniters` DISABLE KEYS */;
/*!40000 ALTER TABLE `replymoniters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `st_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `follow` int(11) NOT NULL DEFAULT '0',
  `follower` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`st_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storytexts`
--

DROP TABLE IF EXISTS `storytexts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storytexts` (
  `text_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `story_id` int(11) NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`text_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storytexts`
--

LOCK TABLES `storytexts` WRITE;
/*!40000 ALTER TABLE `storytexts` DISABLE KEYS */;
/*!40000 ALTER TABLE `storytexts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thanksreplies`
--

DROP TABLE IF EXISTS `thanksreplies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thanksreplies` (
  `account_id` int(11) NOT NULL,
  `span` int(11) NOT NULL DEFAULT '1',
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `allowtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '9,10,11,12,13,14,15,16,17,18,19,20,21',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thanksreplies`
--

LOCK TABLES `thanksreplies` WRITE;
/*!40000 ALTER TABLE `thanksreplies` DISABLE KEYS */;
/*!40000 ALTER TABLE `thanksreplies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unfollowmoniters`
--

DROP TABLE IF EXISTS `unfollowmoniters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unfollowmoniters` (
  `account_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unfollowmoniters`
--

LOCK TABLES `unfollowmoniters` WRITE;
/*!40000 ALTER TABLE `unfollowmoniters` DISABLE KEYS */;
/*!40000 ALTER TABLE `unfollowmoniters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unfollowrules`
--

DROP TABLE IF EXISTS `unfollowrules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unfollowrules` (
  `unfollowrule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `span` int(11) NOT NULL DEFAULT '10',
  `unfollowlimit` int(11) NOT NULL DEFAULT '0',
  `allowtime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '9,10,11,12,13,14,15,16,17,18,19,20,21',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unfollowrule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unfollowrules`
--

LOCK TABLES `unfollowrules` WRITE;
/*!40000 ALTER TABLE `unfollowrules` DISABLE KEYS */;
/*!40000 ALTER TABLE `unfollowrules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accountlimit` int(11) NOT NULL DEFAULT '100',
  `accountcount` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'kurosu','knowrop1208@gmail.com','$2y$10$6Sitv1HHn6SbLVmBg.meTeaEUJEfgn2TlSNGm2W7MpSMokWqi9B6S',100,0,NULL,'2017-11-26 00:27:14','2017-11-26 00:27:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-26  9:27:29
