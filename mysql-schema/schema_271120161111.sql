CREATE DATABASE  IF NOT EXISTS `cie` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `cie`;
-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: cie
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'announcements','This category is for every news-entry which deals mainly with announcements.',NULL,NULL),(2,'others','This category is for every news-entry which can\'t be related to any other category.',NULL,NULL),(3,'reviews','This category is for every news-entry that contains information about events which happened in the past.',NULL,NULL),(4,'info','This category is for every news-entry that general information such as maintenance-notifications.',NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_news`
--

DROP TABLE IF EXISTS `category_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_news` (
  `news_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  KEY `category_news_news_id_foreign` (`news_id`),
  KEY `category_news_category_id_foreign` (`category_id`),
  CONSTRAINT `category_news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_news_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_news`
--

LOCK TABLES `category_news` WRITE;
/*!40000 ALTER TABLE `category_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gameday_user`
--

DROP TABLE IF EXISTS `gameday_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gameday_user` (
  `user_id` int(10) unsigned NOT NULL,
  `gameday_id` int(10) unsigned NOT NULL,
  KEY `gameday_user_user_id_foreign` (`user_id`),
  KEY `gameday_user_gameday_id_foreign` (`gameday_id`),
  CONSTRAINT `gameday_user_gameday_id_foreign` FOREIGN KEY (`gameday_id`) REFERENCES `gamedays` (`id`) ON DELETE CASCADE,
  CONSTRAINT `gameday_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gameday_user`
--

LOCK TABLES `gameday_user` WRITE;
/*!40000 ALTER TABLE `gameday_user` DISABLE KEYS */;
INSERT INTO `gameday_user` VALUES (7,7),(3,7),(14,7),(12,7),(38,7),(44,7),(11,7),(36,7),(8,7),(37,7),(4,7),(22,7),(13,7),(1,7),(2,7),(31,7),(54,7),(30,7),(23,7),(21,6),(3,6),(14,6),(12,6),(56,6),(38,6),(44,6),(32,6),(11,6),(39,6),(36,6),(8,6),(4,6),(13,6),(1,6),(2,6),(19,6),(3,8),(12,8),(56,8),(63,8),(44,8),(32,8),(11,8),(57,8),(8,8),(45,8),(22,8),(13,8),(1,8),(2,8),(19,8),(49,8),(7,9),(41,9),(3,9),(14,9),(12,9),(38,9),(16,9),(44,9),(32,9),(11,9),(8,9),(13,9),(1,9),(2,9),(31,9),(49,9),(7,10),(21,10),(3,10),(14,10),(38,10),(16,10),(63,10),(32,10),(57,10),(36,10),(8,10),(22,10),(1,10),(2,10),(49,10),(53,10),(7,11),(59,11),(21,11),(41,11),(58,11),(3,11),(12,11),(38,11),(16,11),(63,11),(44,11),(32,11),(60,11),(57,11),(36,11),(8,11),(4,11),(45,11),(1,11),(59,12),(61,12),(58,12),(3,12),(38,12),(16,12),(44,12),(32,12),(11,12),(60,12),(57,12),(50,12),(8,12),(4,12),(45,12),(13,12),(1,12),(2,12),(19,12),(61,13),(5,13),(58,13),(14,13),(38,13),(16,13),(44,13),(11,13),(52,13),(57,13),(36,13),(50,13),(8,13),(22,13),(13,13),(1,13),(30,13),(59,14),(41,14),(58,14),(3,14),(14,14),(12,14),(16,14),(63,14),(44,14),(11,14),(64,14),(60,14),(8,14),(22,14),(1,14),(2,14),(62,14),(7,15),(59,15),(21,15),(61,15),(5,15),(58,15),(3,15),(14,15),(38,15),(16,15),(63,15),(44,15),(32,15),(52,15),(60,15),(50,15),(8,15),(4,15),(45,15),(1,15),(62,15),(30,15),(59,16),(41,16),(5,16),(58,16),(3,16),(14,16),(16,16),(11,16),(60,16),(65,16),(36,16),(45,16),(22,16),(1,16),(2,16),(62,16),(7,17),(61,17),(58,17),(3,17),(14,17),(12,17),(56,17),(16,17),(44,17),(32,17),(52,17),(39,17),(65,17),(36,17),(8,17),(1,17),(2,17),(62,17),(23,17),(7,18),(5,18),(58,18),(14,18),(16,18),(63,18),(44,18),(24,18),(50,18),(8,18),(13,18),(1,18),(62,18);
/*!40000 ALTER TABLE `gameday_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gamedays`
--

DROP TABLE IF EXISTS `gamedays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gamedays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notes` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `duration_in_minutes` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location_id` int(10) unsigned NOT NULL,
  `playercount_redundant` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gamedays_location_id_foreign_idx` (`location_id`),
  CONSTRAINT `gamedays_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gamedays`
--

LOCK TABLES `gamedays` WRITE;
/*!40000 ALTER TABLE `gamedays` DISABLE KEYS */;
INSERT INTO `gamedays` VALUES (6,'Spieltag-02/2016-17','2016-09-03 14:30:00',0,'2016-11-01 14:12:53','2016-11-27 09:46:46',2,17),(7,'Spieltag-01/2016-17','2016-08-20 15:00:00',0,'2016-11-01 14:50:40','2016-11-27 09:46:24',2,19),(8,'Spieltag-03/2016-17','2016-09-17 15:00:00',0,'2016-11-06 15:31:08','2016-11-27 09:47:08',1,16),(9,'Spieltag-04/2016-17','2016-09-24 15:00:00',0,'2016-11-06 15:36:35','2016-11-27 09:47:35',1,16),(10,'Spieltag-05/2016-17','2016-10-01 15:00:00',0,'2016-11-06 15:40:08','2016-11-27 09:47:53',1,16),(11,'Spieltag-06/2016-17','2016-10-08 15:00:00',0,'2016-11-06 15:44:25','2016-11-27 09:48:48',1,19),(12,'Spieltag-07/2016-17','2016-10-15 15:00:00',0,'2016-11-06 15:51:12','2016-11-27 09:49:10',1,19),(13,'Spieltag-08/2016-17','2016-10-22 15:00:00',0,'2016-11-06 15:55:39','2016-11-27 09:49:35',1,17),(14,'Spieltag-09/2016-17','2016-10-29 15:00:00',0,'2016-11-06 16:01:56','2016-11-27 09:49:53',1,17),(15,'Spieltag-10/2016-17','2016-11-05 15:00:00',0,'2016-11-06 16:07:15','2016-11-27 09:50:09',1,22),(16,'Spieltag-11/2016-17','2016-11-12 15:00:00',0,'2016-11-06 16:11:06','2016-11-27 09:50:28',1,16),(17,'Spieltag-12/2016-17','2016-11-19 14:30:00',0,'2016-11-20 09:42:50','2016-11-27 09:50:46',1,19),(18,'Spieltag-13/2016-17','2016-11-26 14:30:00',0,'2016-11-20 10:06:57','2016-11-27 09:51:15',1,13),(19,'Spieltag-14/2016-17','2016-12-03 15:00:00',0,'2016-11-27 09:27:27','2016-11-27 09:51:31',1,0);
/*!40000 ALTER TABLE `gamedays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Radenthein','Die Nockhalle in Radenthein wurde erst 2008 errichtet.','2016-10-23 08:05:05','2016-10-23 08:05:05'),(2,'Villach','Stadthalle in Villach','2016-10-23 08:05:05','2016-10-23 08:05:05'),(3,'Steindorf','Ossiacher-See-Halle in Steindorf','2016-10-23 08:05:05','2016-10-23 08:05:05'),(4,'Althofen','Eishalle in St. Veit','2016-11-27 09:25:12','2016-11-27 09:25:12'),(5,'Velden','Stadthalle in Velden','2016-11-27 09:25:12','2016-11-27 09:25:12'),(6,'Zauchen','Freilufteisrink in Zauchen','2016-11-27 09:25:12','2016-11-27 09:25:12'),(7,'Klagenfurt','Messehalle in Klagenfurt','2016-11-27 09:25:12','2016-11-27 09:25:12'),(8,'Spittal','Eishalle in Spittal','2016-11-27 09:25:12','2016-11-27 09:25:12'),(9,'Patergassen','Eishalle in Patergassen/Kärnten','2016-11-27 09:25:12','2016-11-27 09:25:12');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logcategories`
--

DROP TABLE IF EXISTS `logcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logcategories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `logcategories_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logcategories`
--

LOCK TABLES `logcategories` WRITE;
/*!40000 ALTER TABLE `logcategories` DISABLE KEYS */;
INSERT INTO `logcategories` VALUES (1,'news','every event related to news',NULL,NULL),(2,'playercardmanagement','every event related to playercards',NULL,NULL),(3,'usermanagement','every event related to usermanagement',NULL,NULL),(4,'permissionmanagement','every event related to permissionmanagement',NULL,NULL),(5,'gamedaymanagement','every event related to gamedaymanagement',NULL,NULL),(6,'session','every event related to gamedaymanagement',NULL,NULL);
/*!40000 ALTER TABLE `logcategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(600) COLLATE utf8_unicode_ci NOT NULL,
  `description_idformat` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `affecteduser_id` int(10) unsigned DEFAULT NULL,
  `logcategory_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_user_id_foreign` (`user_id`),
  KEY `logs_logcategory_id_foreign` (`logcategory_id`),
  KEY `logs_affecteduser_id_foreign` (`affecteduser_id`),
  CONSTRAINT `logs_affecteduser_id_foreign` FOREIGN KEY (`affecteduser_id`) REFERENCES `users` (`id`),
  CONSTRAINT `logs_logcategory_id_foreign` FOREIGN KEY (`logcategory_id`) REFERENCES `logcategories` (`id`),
  CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (2,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-06 14:29:00','2016-11-06 14:29:00',1,NULL,6),(3,'The user Gerald Rosic was created by user Michael Hammerl.','The user with id=11 was created by the user with id=1.','2016-11-06 14:30:10','2016-11-06 14:30:10',1,11,3),(4,'The user Christian Warmuth was edited by user Michael Hammerl.','The user with id=3 was edited by the user with id=1.','2016-11-06 14:31:24','2016-11-06 14:31:24',1,3,3),(5,'The user Mario Ronacher was edited by user Michael Hammerl.','The user with id=4 was edited by the user with id=1.','2016-11-06 14:32:53','2016-11-06 14:32:53',1,4,3),(6,'The user Dominik Liebetegger was edited by user Michael Hammerl.','The user with id=5 was edited by the user with id=1.','2016-11-06 14:33:08','2016-11-06 14:33:08',1,5,3),(7,'The user Alexander Affritsch was edited by user Michael Hammerl.','The user with id=7 was edited by the user with id=1.','2016-11-06 14:33:26','2016-11-06 14:33:26',1,7,3),(8,'The user Manuel Rossbacher was edited by user Michael Hammerl.','The user with id=8 was edited by the user with id=1.','2016-11-06 14:33:43','2016-11-06 14:33:43',1,8,3),(9,'The user Thomas Ronacher was edited by user Michael Hammerl.','The user with id=9 was edited by the user with id=1.','2016-11-06 14:33:57','2016-11-06 14:33:57',1,9,3),(10,'The user Alexander Klump was edited by user Michael Hammerl.','The user with id=10 was edited by the user with id=1.','2016-11-06 14:34:21','2016-11-06 14:34:21',1,10,3),(11,'The user Dana Sauerbier was created by user Michael Hammerl.','The user with id=12 was created by the user with id=1.','2016-11-06 14:41:16','2016-11-06 14:41:16',1,12,3),(12,'The user Martin Tarmann was created by user Michael Hammerl.','The user with id=13 was created by the user with id=1.','2016-11-06 14:41:44','2016-11-06 14:41:44',1,13,3),(13,'The user Christoph Lagler was created by user Michael Hammerl.','The user with id=14 was created by the user with id=1.','2016-11-06 14:42:16','2016-11-06 14:42:16',1,14,3),(14,'The user Armin Horner was created by user Michael Hammerl.','The user with id=15 was created by the user with id=1.','2016-11-06 14:42:45','2016-11-06 14:42:45',1,15,3),(15,'The user Dominik Gratzl was created by user Michael Hammerl.','The user with id=16 was created by the user with id=1.','2016-11-06 14:43:16','2016-11-06 14:43:16',1,16,3),(16,'The user Manuel Gratzl was created by user Michael Hammerl.','The user with id=17 was created by the user with id=1.','2016-11-06 14:43:41','2016-11-06 14:43:41',1,17,3),(17,'The user Wolfgong Toelpitzer was created by user Michael Hammerl.','The user with id=18 was created by the user with id=1.','2016-11-06 14:44:28','2016-11-06 14:44:28',1,18,3),(18,'The user Wolfgong Toeplitzer was edited by user Michael Hammerl.','The user with id=18 was edited by the user with id=1.','2016-11-06 14:45:37','2016-11-06 14:45:37',1,18,3),(19,'The user Patrick Unterweger was created by user Michael Hammerl.','The user with id=19 was created by the user with id=1.','2016-11-06 14:46:45','2016-11-06 14:46:45',1,19,3),(20,'The user Mario Mottnig was created by user Michael Hammerl.','The user with id=20 was created by the user with id=1.','2016-11-06 14:47:25','2016-11-06 14:47:25',1,20,3),(21,'The user Alexander Raab was created by user Michael Hammerl.','The user with id=21 was created by the user with id=1.','2016-11-06 14:47:50','2016-11-06 14:47:50',1,21,3),(22,'The user Markus Marinschek was created by user Michael Hammerl.','The user with id=22 was created by the user with id=1.','2016-11-06 14:48:33','2016-11-06 14:48:33',1,22,3),(23,'The user Markus Marinschek was edited by user Michael Hammerl.','The user with id=22 was edited by the user with id=1.','2016-11-06 14:48:59','2016-11-06 14:48:59',1,22,3),(24,'The user Stefan Pfurner was created by user Michael Hammerl.','The user with id=23 was created by the user with id=1.','2016-11-06 14:50:06','2016-11-06 14:50:06',1,23,3),(25,'The user Jürgen Wachter was created by user Michael Hammerl.','The user with id=24 was created by the user with id=1.','2016-11-06 14:51:05','2016-11-06 14:51:05',1,24,3),(26,'The user Rene Lang was created by user Michael Hammerl.','The user with id=25 was created by the user with id=1.','2016-11-06 14:51:47','2016-11-06 14:51:47',1,25,3),(27,'The user Martin Unterweger was created by user Michael Hammerl.','The user with id=26 was created by the user with id=1.','2016-11-06 14:52:13','2016-11-06 14:52:13',1,26,3),(28,'The user Rene Tranacher was created by user Michael Hammerl.','The user with id=27 was created by the user with id=1.','2016-11-06 14:53:10','2016-11-06 14:53:10',1,27,3),(29,'The user Harald Jonach was created by user Michael Hammerl.','The user with id=28 was created by the user with id=1.','2016-11-06 14:53:50','2016-11-06 14:53:50',1,28,3),(30,'The user Marko Harder was created by user Michael Hammerl.','The user with id=29 was created by the user with id=1.','2016-11-06 14:54:14','2016-11-06 14:54:14',1,29,3),(31,'The user Simon Brentner was created by user Michael Hammerl.','The user with id=30 was created by the user with id=1.','2016-11-06 14:55:02','2016-11-06 14:55:02',1,30,3),(32,'The user Patrick Gasteiger was created by user Michael Hammerl.','The user with id=31 was created by the user with id=1.','2016-11-06 14:55:27','2016-11-06 14:55:27',1,31,3),(33,'The user Gerald Kleber was created by user Michael Hammerl.','The user with id=32 was created by the user with id=1.','2016-11-06 14:55:52','2016-11-06 14:55:52',1,32,3),(34,'The user Dominik Kenzian was created by user Michael Hammerl.','The user with id=33 was created by the user with id=1.','2016-11-06 14:56:30','2016-11-06 14:56:30',1,33,3),(35,'The user Dominik Aichholzer was created by user Michael Hammerl.','The user with id=34 was created by the user with id=1.','2016-11-06 14:57:02','2016-11-06 14:57:02',1,34,3),(36,'The user Armin Pausch was created by user Michael Hammerl.','The user with id=35 was created by the user with id=1.','2016-11-06 14:57:42','2016-11-06 14:57:42',1,35,3),(37,'The user Ludwig Oberrieser was created by user Michael Hammerl.','The user with id=36 was created by the user with id=1.','2016-11-06 14:58:28','2016-11-06 14:58:28',1,36,3),(38,'The user Marcel Oberrieser was created by user Michael Hammerl.','The user with id=37 was created by the user with id=1.','2016-11-06 14:59:17','2016-11-06 14:59:17',1,37,3),(39,'The user David Kraschl was created by user Michael Hammerl.','The user with id=38 was created by the user with id=1.','2016-11-06 14:59:43','2016-11-06 14:59:43',1,38,3),(40,'The user Kurt Malle was created by user Michael Hammerl.','The user with id=39 was created by the user with id=1.','2016-11-06 15:00:06','2016-11-06 15:00:06',1,39,3),(41,'The user Stefan Kreuzer was created by user Michael Hammerl.','The user with id=40 was created by the user with id=1.','2016-11-06 15:01:28','2016-11-06 15:01:28',1,40,3),(42,'The user Andreas Miklautsch was created by user Michael Hammerl.','The user with id=41 was created by the user with id=1.','2016-11-06 15:01:57','2016-11-06 15:01:57',1,41,3),(43,'The user Christian Hafner was created by user Michael Hammerl.','The user with id=42 was created by the user with id=1.','2016-11-06 15:02:24','2016-11-06 15:02:24',1,42,3),(44,'The user Luca Zarre was created by user Michael Hammerl.','The user with id=43 was created by the user with id=1.','2016-11-06 15:02:50','2016-11-06 15:02:50',1,43,3),(45,'The user Fabian Filzmaier was created by user Michael Hammerl.','The user with id=44 was created by the user with id=1.','2016-11-06 15:03:18','2016-11-06 15:03:18',1,44,3),(46,'The user Mario Stückelberger was created by user Michael Hammerl.','The user with id=45 was created by the user with id=1.','2016-11-06 15:04:08','2016-11-06 15:04:08',1,45,3),(47,'The user Thomas Buchacher was created by user Michael Hammerl.','The user with id=46 was created by the user with id=1.','2016-11-06 15:04:36','2016-11-06 15:04:36',1,46,3),(48,'The user Michael Ofner was created by user Michael Hammerl.','The user with id=47 was created by the user with id=1.','2016-11-06 15:05:55','2016-11-06 15:05:55',1,47,3),(49,'The user could not be created by user Michael Hammerl.','The user could not be created by the user with id=1.','2016-11-06 15:06:26','2016-11-06 15:06:26',1,NULL,3),(50,'The user Richard Schleiner was created by user Michael Hammerl.','The user with id=49 was created by the user with id=1.','2016-11-06 15:07:40','2016-11-06 15:07:40',1,49,3),(51,'The user Manuel Ellegast was created by user Michael Hammerl.','The user with id=50 was created by the user with id=1.','2016-11-06 15:08:12','2016-11-06 15:08:12',1,50,3),(52,'The user Peter Domnik was created by user Michael Hammerl.','The user with id=51 was created by the user with id=1.','2016-11-06 15:08:43','2016-11-06 15:08:43',1,51,3),(53,'The user Hubert Fest was created by user Michael Hammerl.','The user with id=52 was created by the user with id=1.','2016-11-06 15:09:11','2016-11-06 15:09:11',1,52,3),(54,'The user Stefan Telesklav was created by user Michael Hammerl.','The user with id=53 was created by the user with id=1.','2016-11-06 15:09:40','2016-11-06 15:09:40',1,53,3),(55,'The user Roman Rottensteiner was created by user Michael Hammerl.','The user with id=54 was created by the user with id=1.','2016-11-06 15:10:07','2016-11-06 15:10:07',1,54,3),(56,'The user Daniel Spindelberger was created by user Michael Hammerl.','The user with id=55 was created by the user with id=1.','2016-11-06 15:10:54','2016-11-06 15:10:54',1,55,3),(57,'The user Benjamin Liebetegger was edited by user Michael Hammerl.','The user with id=5 was edited by the user with id=1.','2016-11-06 15:11:38','2016-11-06 15:11:38',1,5,3),(58,'The user Daniel Riedler was created by user Michael Hammerl.','The user with id=56 was created by the user with id=1.','2016-11-06 15:12:03','2016-11-06 15:12:03',1,56,3),(59,'The user Julian Pirker was created by user Michael Hammerl.','The user with id=57 was created by the user with id=1.','2016-11-06 15:12:25','2016-11-06 15:12:25',1,57,3),(60,'The user Chiara Lube was created by user Michael Hammerl.','The user with id=58 was created by the user with id=1.','2016-11-06 15:12:52','2016-11-06 15:12:52',1,58,3),(61,'The user Alexander Hallegger was created by user Michael Hammerl.','The user with id=59 was created by the user with id=1.','2016-11-06 15:13:33','2016-11-06 15:13:33',1,59,3),(62,'The user Johannes Hallegger was created by user Michael Hammerl.','The user with id=60 was created by the user with id=1.','2016-11-06 15:13:59','2016-11-06 15:13:59',1,60,3),(63,'The user Aquay Vong was created by user Michael Hammerl.','The user with id=61 was created by the user with id=1.','2016-11-06 15:14:23','2016-11-06 15:14:23',1,61,3),(64,'The user Michael Neher was created by user Michael Hammerl.','The user with id=62 was created by the user with id=1.','2016-11-06 15:14:50','2016-11-06 15:14:50',1,62,3),(65,'The gamedayentry with the id=7 was edited by user Michael Hammerl.','The gamedayentry with the id=7 was edited by the user with id=1.','2016-11-06 15:20:18','2016-11-06 15:20:18',1,NULL,5),(66,'The gamedayentry with the id=6 was edited by user Michael Hammerl.','The gamedayentry with the id=6 was edited by the user with id=1.','2016-11-06 15:26:22','2016-11-06 15:26:22',1,NULL,5),(67,'The gamedayentry with the id=6 was edited by user Michael Hammerl.','The gamedayentry with the id=6 was edited by the user with id=1.','2016-11-06 15:27:29','2016-11-06 15:27:29',1,NULL,5),(68,'The gamedayentry with the id=7 was edited by user Michael Hammerl.','The gamedayentry with the id=7 was edited by the user with id=1.','2016-11-06 15:30:23','2016-11-06 15:30:23',1,NULL,5),(69,'The gamedayentry with the id=8 was created by user Michael Hammerl.','The gamedayentry with the id=8 was created by the user with id=1.','2016-11-06 15:31:08','2016-11-06 15:31:08',1,NULL,5),(70,'The gamedayentry with the id=8 was edited by user Michael Hammerl.','The gamedayentry with the id=8 was edited by the user with id=1.','2016-11-06 15:34:39','2016-11-06 15:34:39',1,NULL,5),(71,'The user Elena Kleber was created by user Michael Hammerl.','The user with id=63 was created by the user with id=1.','2016-11-06 15:35:11','2016-11-06 15:35:11',1,63,3),(72,'The gamedayentry with the id=8 was edited by user Michael Hammerl.','The gamedayentry with the id=8 was edited by the user with id=1.','2016-11-06 15:35:39','2016-11-06 15:35:39',1,NULL,5),(73,'The gamedayentry with the id=9 was created by user Michael Hammerl.','The gamedayentry with the id=9 was created by the user with id=1.','2016-11-06 15:36:35','2016-11-06 15:36:35',1,NULL,5),(74,'The gamedayentry with the id=9 was edited by user Michael Hammerl.','The gamedayentry with the id=9 was edited by the user with id=1.','2016-11-06 15:38:53','2016-11-06 15:38:53',1,NULL,5),(75,'The gamedayentry with the id=10 was created by user Michael Hammerl.','The gamedayentry with the id=10 was created by the user with id=1.','2016-11-06 15:40:08','2016-11-06 15:40:08',1,NULL,5),(76,'The gamedayentry with the id=10 was edited by user Michael Hammerl.','The gamedayentry with the id=10 was edited by the user with id=1.','2016-11-06 15:43:52','2016-11-06 15:43:52',1,NULL,5),(77,'The gamedayentry with the id=11 was created by user Michael Hammerl.','The gamedayentry with the id=11 was created by the user with id=1.','2016-11-06 15:44:25','2016-11-06 15:44:25',1,NULL,5),(78,'The gamedayentry with the id=11 was edited by user Michael Hammerl.','The gamedayentry with the id=11 was edited by the user with id=1.','2016-11-06 15:47:44','2016-11-06 15:47:44',1,NULL,5),(79,'The gamedayentry with the id=11 was edited by user Michael Hammerl.','The gamedayentry with the id=11 was edited by the user with id=1.','2016-11-06 15:50:28','2016-11-06 15:50:28',1,NULL,5),(80,'The gamedayentry with the id=12 was created by user Michael Hammerl.','The gamedayentry with the id=12 was created by the user with id=1.','2016-11-06 15:51:12','2016-11-06 15:51:12',1,NULL,5),(81,'The gamedayentry with the id=12 was edited by user Michael Hammerl.','The gamedayentry with the id=12 was edited by the user with id=1.','2016-11-06 15:54:41','2016-11-06 15:54:41',1,NULL,5),(82,'The gamedayentry with the id=13 was created by user Michael Hammerl.','The gamedayentry with the id=13 was created by the user with id=1.','2016-11-06 15:55:39','2016-11-06 15:55:39',1,NULL,5),(83,'The gamedayentry with the id=13 was edited by user Michael Hammerl.','The gamedayentry with the id=13 was edited by the user with id=1.','2016-11-06 15:59:49','2016-11-06 15:59:49',1,NULL,5),(84,'The gamedayentry with the id=13 was edited by user Michael Hammerl.','The gamedayentry with the id=13 was edited by the user with id=1.','2016-11-06 16:01:03','2016-11-06 16:01:03',1,NULL,5),(85,'The gamedayentry with the id=13 was edited by user Michael Hammerl.','The gamedayentry with the id=13 was edited by the user with id=1.','2016-11-06 16:01:24','2016-11-06 16:01:24',1,NULL,5),(86,'The gamedayentry with the id=14 was created by user Michael Hammerl.','The gamedayentry with the id=14 was created by the user with id=1.','2016-11-06 16:01:56','2016-11-06 16:01:56',1,NULL,5),(87,'The gamedayentry with the id=14 was edited by user Michael Hammerl.','The gamedayentry with the id=14 was edited by the user with id=1.','2016-11-06 16:05:16','2016-11-06 16:05:16',1,NULL,5),(88,'The user Hubert Frohner was created by user Michael Hammerl.','The user with id=64 was created by the user with id=1.','2016-11-06 16:05:55','2016-11-06 16:05:55',1,64,3),(89,'The gamedayentry with the id=14 was edited by user Michael Hammerl.','The gamedayentry with the id=14 was edited by the user with id=1.','2016-11-06 16:06:38','2016-11-06 16:06:38',1,NULL,5),(90,'The gamedayentry with the id=15 was created by user Michael Hammerl.','The gamedayentry with the id=15 was created by the user with id=1.','2016-11-06 16:07:15','2016-11-06 16:07:15',1,NULL,5),(91,'The gamedayentry with the id=15 was edited by user Michael Hammerl.','The gamedayentry with the id=15 was edited by the user with id=1.','2016-11-06 16:08:45','2016-11-06 16:08:45',1,NULL,5),(92,'The gamedayentry with the id=15 was edited by user Michael Hammerl.','The gamedayentry with the id=15 was edited by the user with id=1.','2016-11-06 16:10:27','2016-11-06 16:10:27',1,NULL,5),(93,'The gamedayentry with the id=16 was created by user Michael Hammerl.','The gamedayentry with the id=16 was created by the user with id=1.','2016-11-06 16:11:06','2016-11-06 16:11:06',1,NULL,5),(94,'The gamedayentry with the id=16 was edited by user Michael Hammerl.','The gamedayentry with the id=16 was edited by the user with id=1.','2016-11-06 16:40:05','2016-11-06 16:40:05',1,NULL,5),(95,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-14 21:25:01','2016-11-14 21:25:01',1,NULL,6),(96,'The gamedayentry with the id=16 was edited by user Michael Hammerl.','The gamedayentry with the id=16 was edited by the user with id=1.','2016-11-14 21:27:02','2016-11-14 21:27:02',1,NULL,5),(97,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-14 21:37:53','2016-11-14 21:37:53',1,NULL,6),(98,'The user Christian Warmuth was edited by user Michael Hammerl.','The user with id=3 was edited by the user with id=1.','2016-11-14 21:38:29','2016-11-14 21:38:29',1,3,3),(99,'The playercardsettings of the user Christian Warmuth were edited by user Michael Hammerl.','The playercardsettings of the user with id=3 were edited by the user with id=1.','2016-11-14 21:42:37','2016-11-14 21:42:37',1,3,2),(100,'The rolegroup-allocations for the user Christian Warmuth were edited by user Michael Hammerl.','The rolegroup-allocations for the user with id=3 were edited by the user with id=1.','2016-11-14 21:43:18','2016-11-14 21:43:18',1,3,4),(101,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-14 21:56:30','2016-11-14 21:56:30',1,NULL,6),(102,'The playercardsettings of the user Michael Hammerl were edited by user Michael Hammerl.','The playercardsettings of the user with id=1 were edited by the user with id=1.','2016-11-14 21:58:03','2016-11-14 21:58:03',1,1,2),(103,'The playercardsettings of the user Michael Hochsteiner were edited by user Michael Hammerl.','The playercardsettings of the user with id=2 were edited by the user with id=1.','2016-11-14 21:58:14','2016-11-14 21:58:14',1,2,2),(104,'The playercardsettings of the user Christian Warmuth were edited by user Michael Hammerl.','The playercardsettings of the user with id=3 were edited by the user with id=1.','2016-11-14 21:58:29','2016-11-14 21:58:29',1,3,2),(105,'The playercardsettings of the user Benjamin Liebetegger were edited by user Michael Hammerl.','The playercardsettings of the user with id=5 were edited by the user with id=1.','2016-11-14 21:58:42','2016-11-14 21:58:42',1,5,2),(106,'The playercardsettings of the user Michael Hammerl were edited by user Michael Hammerl.','The playercardsettings of the user with id=1 were edited by the user with id=1.','2016-11-14 21:58:59','2016-11-14 21:58:59',1,1,2),(107,'The playercardsettings of the user Michael Hammerl were edited by user Michael Hammerl.','The playercardsettings of the user with id=1 were edited by the user with id=1.','2016-11-14 21:59:29','2016-11-14 21:59:29',1,1,2),(108,'The playercardsettings of the user Michael Hochsteiner were edited by user Michael Hammerl.','The playercardsettings of the user with id=2 were edited by the user with id=1.','2016-11-14 22:00:00','2016-11-14 22:00:00',1,2,2),(109,'The playercardsettings of the user Christian Warmuth were edited by user Michael Hammerl.','The playercardsettings of the user with id=3 were edited by the user with id=1.','2016-11-14 22:00:35','2016-11-14 22:00:35',1,3,2),(110,'The playercardsettings of the user Mario Ronacher were edited by user Michael Hammerl.','The playercardsettings of the user with id=4 were edited by the user with id=1.','2016-11-14 22:01:21','2016-11-14 22:01:21',1,4,2),(111,'The playercardsettings of the user Manuel Rossbacher were edited by user Michael Hammerl.','The playercardsettings of the user with id=8 were edited by the user with id=1.','2016-11-14 22:02:07','2016-11-14 22:02:07',1,8,2),(112,'The playercardsettings of the user Ludwig Oberrieser were edited by user Michael Hammerl.','The playercardsettings of the user with id=36 were edited by the user with id=1.','2016-11-14 22:38:02','2016-11-14 22:38:02',1,36,2),(113,'User Alexander Raab logged in.','User with id=21 logged in.','2016-11-14 22:42:04','2016-11-14 22:42:04',21,NULL,6),(114,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-14 22:51:52','2016-11-14 22:51:52',1,NULL,6),(115,'The rolegroup-allocations for the user Michael Hochsteiner were edited by user Michael Hammerl.','The rolegroup-allocations for the user with id=2 were edited by the user with id=1.','2016-11-14 22:54:10','2016-11-14 22:54:10',1,2,4),(116,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-19 19:15:29','2016-11-19 19:15:29',1,NULL,6),(117,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-20 08:40:32','2016-11-20 08:40:32',1,NULL,6),(118,'The user Luca Sauerbier was created by user Michael Hammerl.','The user with id=65 was created by the user with id=1.','2016-11-20 09:42:01','2016-11-20 09:42:01',1,65,3),(119,'The gamedayentry with the id=16 was edited by user Michael Hammerl.','The gamedayentry with the id=16 was edited by the user with id=1.','2016-11-20 09:42:23','2016-11-20 09:42:23',1,NULL,5),(120,'The gamedayentry with the id=17 was created by user Michael Hammerl.','The gamedayentry with the id=17 was created by the user with id=1.','2016-11-20 09:42:50','2016-11-20 09:42:50',1,NULL,5),(121,'The gamedayentry with the id=17 was edited by user Michael Hammerl.','The gamedayentry with the id=17 was edited by the user with id=1.','2016-11-20 09:44:26','2016-11-20 09:44:26',1,NULL,5),(122,'The user Michael Hammerl2 was edited by user Michael Hammerl.','The user with id=1 was edited by the user with id=1.','2016-11-20 10:04:59','2016-11-20 10:04:59',1,1,3),(123,'The user Michael Hammerl was edited by user Michael Hammerl2.','The user with id=1 was edited by the user with id=1.','2016-11-20 10:05:21','2016-11-20 10:05:21',1,1,3),(124,'The playercardsettings of the user Michael Hammerl were edited by user Michael Hammerl.','The playercardsettings of the user with id=1 were edited by the user with id=1.','2016-11-20 10:05:48','2016-11-20 10:05:48',1,1,2),(125,'The rolegroup-allocations for the user Michael Hochsteiner were edited by user Michael Hammerl.','The rolegroup-allocations for the user with id=2 were edited by the user with id=1.','2016-11-20 10:06:20','2016-11-20 10:06:20',1,2,4),(126,'The gamedayentry with the id=18 was created by user Michael Hammerl.','The gamedayentry with the id=18 was created by the user with id=1.','2016-11-20 10:06:57','2016-11-20 10:06:57',1,NULL,5),(127,'The newsentry with the id=9 was created by user Michael Hammerl.','The newsentry with the id=9 was created by the user with id=1.','2016-11-20 10:07:29','2016-11-20 10:07:29',1,NULL,1),(128,'The newsentry with the id=9 was edited by user Michael Hammerl.','The newsentry with the id=9 was edited by the user with id=1.','2016-11-20 10:07:51','2016-11-20 10:07:51',1,NULL,1),(129,'The newsentry with the id=9 was edited by user Michael Hammerl.','The newsentry with the id=9 was edited by the user with id=1.','2016-11-20 10:08:36','2016-11-20 10:08:36',1,NULL,1),(130,'The playercardsettings of the user Michael Hammerl were edited by user Michael Hammerl.','The playercardsettings of the user with id=1 were edited by the user with id=1.','2016-11-20 10:13:07','2016-11-20 10:13:07',1,1,2),(131,'The playercardsettings of the user Michael Hammerl were edited by user Michael Hammerl.','The playercardsettings of the user with id=1 were edited by the user with id=1.','2016-11-20 10:14:53','2016-11-20 10:14:53',1,1,2),(132,'The playercardsettings of the user Fabian Filzmaier were edited by user Michael Hammerl.','The playercardsettings of the user with id=44 were edited by the user with id=1.','2016-11-20 10:21:16','2016-11-20 10:21:16',1,44,2),(133,'The playercardpicture of the user Fabian Filzmaier could not be uploaded by user Michael Hammerl.','The playercardpicture of the user with id=44 could not be uploaded by the user with id=1.','2016-11-20 10:22:17','2016-11-20 10:22:17',1,44,2),(134,'The newsentry with the id=9 was edited by user Michael Hammerl.','The newsentry with the id=9 was edited by the user with id=1.','2016-11-20 10:35:39','2016-11-20 10:35:39',1,NULL,1),(135,'The playercardpicture of the user Michael Hammerl was uploaded by user Michael Hammerl.','The playercardpicture of the user with id=1 was uploaded by the user with id=1.','2016-11-20 10:38:44','2016-11-20 10:38:44',1,1,2),(136,'The newsentry with the id=9 was deleted by user Michael Hammerl.','The newsentry with the id=9 was deleted by the user with id=1.','2016-11-20 10:39:30','2016-11-20 10:39:30',1,NULL,1),(137,'The newsentry with the id=8 was deleted by user Michael Hammerl.','The newsentry with the id=8 was deleted by the user with id=1.','2016-11-20 10:39:41','2016-11-20 10:39:41',1,NULL,1),(138,'The newsentry with the id=5 was deleted by user Michael Hammerl.','The newsentry with the id=5 was deleted by the user with id=1.','2016-11-20 10:39:56','2016-11-20 10:39:56',1,NULL,1),(139,'The newsentry with the id=4 was deleted by user Michael Hammerl.','The newsentry with the id=4 was deleted by the user with id=1.','2016-11-20 10:40:04','2016-11-20 10:40:04',1,NULL,1),(140,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-20 10:59:18','2016-11-20 10:59:18',1,NULL,6),(141,'The playercardpicture of the user Michael Hammerl was uploaded by user Michael Hammerl.','The playercardpicture of the user with id=1 was uploaded by the user with id=1.','2016-11-20 11:01:30','2016-11-20 11:01:30',1,1,2),(142,'User Michael Hochsteiner logged in.','User with id=2 logged in.','2016-11-20 11:18:32','2016-11-20 11:18:32',2,NULL,6),(143,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-20 18:31:18','2016-11-20 18:31:18',1,NULL,6),(144,'The gamedayentry with the id=18 was edited by user Michael Hammerl.','The gamedayentry with the id=18 was edited by the user with id=1.','2016-11-20 18:33:18','2016-11-20 18:33:18',1,NULL,5),(145,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-25 08:03:23','2016-11-25 08:03:23',1,NULL,6),(146,'The user Christian Hafner was edited by user Michael Hammerl.','The user with id=42 was edited by the user with id=1.','2016-11-25 08:03:58','2016-11-25 08:03:58',1,42,3),(147,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-25 08:07:22','2016-11-25 08:07:22',1,NULL,6),(148,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-27 09:25:34','2016-11-27 09:25:34',1,NULL,6),(149,'The gamedayentry with the id=18 was edited by user Michael Hammerl.','The gamedayentry with the id=18 was edited by the user with id=1.','2016-11-27 09:26:54','2016-11-27 09:26:54',1,NULL,5),(150,'The gamedayentry with the id=19 was created by user Michael Hammerl.','The gamedayentry with the id=19 was created by the user with id=1.','2016-11-27 09:27:27','2016-11-27 09:27:27',1,NULL,5),(151,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-27 09:43:15','2016-11-27 09:43:15',1,NULL,6),(152,'The user Michael Hammerl was edited by user Michael Hammerl.','The user with id=1 was edited by the user with id=1.','2016-11-27 09:43:41','2016-11-27 09:43:41',1,1,3),(153,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-27 09:44:01','2016-11-27 09:44:01',1,NULL,6),(154,'User Michael Hammerl logged in.','User with id=1 logged in.','2016-11-27 09:45:48','2016-11-27 09:45:48',1,NULL,6),(155,'The gamedayentry with the id=7 was edited by user Michael Hammerl.','The gamedayentry with the id=7 was edited by the user with id=1.','2016-11-27 09:46:25','2016-11-27 09:46:25',1,NULL,5),(156,'The gamedayentry with the id=6 was edited by user Michael Hammerl.','The gamedayentry with the id=6 was edited by the user with id=1.','2016-11-27 09:46:46','2016-11-27 09:46:46',1,NULL,5),(157,'The gamedayentry with the id=8 was edited by user Michael Hammerl.','The gamedayentry with the id=8 was edited by the user with id=1.','2016-11-27 09:47:08','2016-11-27 09:47:08',1,NULL,5),(158,'The gamedayentry with the id=9 was edited by user Michael Hammerl.','The gamedayentry with the id=9 was edited by the user with id=1.','2016-11-27 09:47:35','2016-11-27 09:47:35',1,NULL,5),(159,'The gamedayentry with the id=10 was edited by user Michael Hammerl.','The gamedayentry with the id=10 was edited by the user with id=1.','2016-11-27 09:47:53','2016-11-27 09:47:53',1,NULL,5),(160,'The gamedayentry with the id=11 was edited by user Michael Hammerl.','The gamedayentry with the id=11 was edited by the user with id=1.','2016-11-27 09:48:49','2016-11-27 09:48:49',1,NULL,5),(161,'The gamedayentry with the id=12 was edited by user Michael Hammerl.','The gamedayentry with the id=12 was edited by the user with id=1.','2016-11-27 09:49:10','2016-11-27 09:49:10',1,NULL,5),(162,'The gamedayentry with the id=13 was edited by user Michael Hammerl.','The gamedayentry with the id=13 was edited by the user with id=1.','2016-11-27 09:49:35','2016-11-27 09:49:35',1,NULL,5),(163,'The gamedayentry with the id=14 was edited by user Michael Hammerl.','The gamedayentry with the id=14 was edited by the user with id=1.','2016-11-27 09:49:53','2016-11-27 09:49:53',1,NULL,5),(164,'The gamedayentry with the id=15 was edited by user Michael Hammerl.','The gamedayentry with the id=15 was edited by the user with id=1.','2016-11-27 09:50:10','2016-11-27 09:50:10',1,NULL,5),(165,'The gamedayentry with the id=16 was edited by user Michael Hammerl.','The gamedayentry with the id=16 was edited by the user with id=1.','2016-11-27 09:50:29','2016-11-27 09:50:29',1,NULL,5),(166,'The gamedayentry with the id=17 was edited by user Michael Hammerl.','The gamedayentry with the id=17 was edited by the user with id=1.','2016-11-27 09:50:46','2016-11-27 09:50:46',1,NULL,5),(167,'The gamedayentry with the id=18 was edited by user Michael Hammerl.','The gamedayentry with the id=18 was edited by the user with id=1.','2016-11-27 09:51:15','2016-11-27 09:51:15',1,NULL,5),(168,'The gamedayentry with the id=19 was edited by user Michael Hammerl.','The gamedayentry with the id=19 was edited by the user with id=1.','2016-11-27 09:51:31','2016-11-27 09:51:31',1,NULL,5);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_07_23_153117_create_news_table',1),('2016_07_23_153218_create_categories_table',1),('2016_07_23_153229_create_logs_table',1),('2016_07_23_153235_create_logcategories_table',1),('2016_07_23_153250_create_gamedays_table',1),('2016_07_23_153300_create_locations_table',1),('2016_07_23_153313_create_rolegroups_table',1),('2016_07_23_153322_create_roles_table',1),('2016_07_23_153528_create_rolegroup_user_table',1),('2016_07_23_153611_create_role_rolegroup_table',1),('2016_07_23_153709_create_gameday_user_table',1),('2016_07_23_153710_create_category_news_table',1),('2016_07_24_085554_add_fk_news_table',1),('2016_07_24_090035_add_fk_logs_table',1),('2016_07_24_090738_add_fk_gamedays_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `creator_id` int(10) unsigned NOT NULL,
  `modifier_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `news_creator_id_foreign` (`creator_id`),
  KEY `news_modifier_id_foreign` (`modifier_id`),
  CONSTRAINT `news_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`),
  CONSTRAINT `news_modifier_id_foreign` FOREIGN KEY (`modifier_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_rolegroup`
--

DROP TABLE IF EXISTS `role_rolegroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_rolegroup` (
  `rolegroup_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  KEY `role_rolegroup_rolegroup_id_foreign` (`rolegroup_id`),
  KEY `role_rolegroup_role_id_foreign` (`role_id`),
  CONSTRAINT `role_rolegroup_rolegroup_id_foreign` FOREIGN KEY (`rolegroup_id`) REFERENCES `rolegroups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_rolegroup_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_rolegroup`
--

LOCK TABLES `role_rolegroup` WRITE;
/*!40000 ALTER TABLE `role_rolegroup` DISABLE KEYS */;
INSERT INTO `role_rolegroup` VALUES (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,1),(8,2),(8,3),(8,4),(8,5),(8,7),(9,1),(9,2),(9,3),(9,4),(9,5),(9,6),(9,7),(9,8),(8,8),(10,8);
/*!40000 ALTER TABLE `role_rolegroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rolegroup_user`
--

DROP TABLE IF EXISTS `rolegroup_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rolegroup_user` (
  `rolegroup_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  KEY `rolegroup_user_rolegroup_id_foreign` (`rolegroup_id`),
  KEY `rolegroup_user_user_id_foreign` (`user_id`),
  CONSTRAINT `rolegroup_user_rolegroup_id_foreign` FOREIGN KEY (`rolegroup_id`) REFERENCES `rolegroups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rolegroup_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rolegroup_user`
--

LOCK TABLES `rolegroup_user` WRITE;
/*!40000 ALTER TABLE `rolegroup_user` DISABLE KEYS */;
INSERT INTO `rolegroup_user` VALUES (9,1),(1,3),(7,3),(1,2),(2,2),(3,2),(4,2),(10,2);
/*!40000 ALTER TABLE `rolegroup_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rolegroups`
--

DROP TABLE IF EXISTS `rolegroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rolegroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolegroups_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rolegroups`
--

LOCK TABLES `rolegroups` WRITE;
/*!40000 ALTER TABLE `rolegroups` DISABLE KEYS */;
INSERT INTO `rolegroups` VALUES (1,'newsmanager','rolegroup required to manage news',NULL,NULL),(2,'gamedaymanager','rolegroup required to manage gamedays',NULL,NULL),(3,'usermanager','rolegroup required to manage users',NULL,NULL),(4,'playercardmanager','rolegroup required to manage playercards',NULL,NULL),(5,'permissionmanager','rolegroup required to manage permissions',NULL,NULL),(6,'troubleshooter','rolegroup required to be authorized for troubleshooting',NULL,NULL),(7,'statisticviewer','rolegroup required to be authorized for viewing the statistic-page',NULL,NULL),(8,'webmaster','rolegroup required to be authorized for everything except troubleshooting',NULL,NULL),(9,'administrator','rolegroup required to be authorized for everything',NULL,NULL),(10,'logviewer','rolegroup required to be authorized for viewing the logentries',NULL,NULL);
/*!40000 ALTER TABLE `rolegroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'newsmanager','role required to manage news',NULL,NULL),(2,'gamedaymanager','role required to manage gamedays',NULL,NULL),(3,'usermanager','role required to manage users',NULL,NULL),(4,'playercardmanager','role required to manage playercards',NULL,NULL),(5,'permissionmanager','role required to manage permissions',NULL,NULL),(6,'troubleshooter','role required to be authorized for troubleshooting',NULL,NULL),(7,'statisticviewer','role required to be authorized for viewing the statistic-page',NULL,NULL),(8,'logviewer','role required to be authorized for viewing the logentries',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customattribute1` int(11) DEFAULT NULL,
  `customattribute2` int(11) DEFAULT NULL,
  `customattribute3` int(11) DEFAULT NULL,
  `customattribute4` int(11) DEFAULT NULL,
  `customattribute5` int(11) DEFAULT NULL,
  `customattribute6` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customattribute7` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customattribute8` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customattribute9` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customattribute10` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_playercard` tinyint(1) NOT NULL,
  `picture_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Michael Hammerl','michael.hammerl1996@gmail.com','$2y$10$4hOUUeS4BTncrWDCzjAgv.3Fk5ClhVPM38WS6PeddMoEJJFEHyYI6','oGYyX6qFU31qx6pZ03NoFU5h3LMzEWfuNJ0RrzkE9FofXMn8UtGROgANjpPf','2016-10-09 14:11:04','2016-11-27 09:44:05',4,73,6,5,51,'Left-Wing',NULL,NULL,NULL,NULL,1,'pics/user1.JPG',0),(2,'Michael Hochsteiner','hochsteiner.michael@inode.at','$2y$10$eEsjUb4i051twZreFkUREeLe35n2eK9OD8R8QpywXZgIz3p7b0aCu','ckeiUbI2Bm2rEWeCK7erjkT6lwBo61SqUQYbSpjTp0ZDfmnkMB1LPQwySfkY','2016-10-09 14:11:35','2016-11-27 09:42:12',4,18,7,5,50,'Verteidiger',NULL,NULL,NULL,NULL,1,'pics/default.png',0),(3,'Christian Warmuth','christian.warmuth1970@gmail.com','$2y$10$sOCOxRt.djYdyI51maHa7OBLD1wu5hNbjvB84TXEhL/E57f7Q5VVy','x38VPdCCAT3TVzLruxNyj47GVFS4zXLmNzbPLp4947mkMdqjdPnCZXdSbjrz','2016-10-09 14:12:05','2016-11-27 09:42:12',4,16,7,5,50,'Verteidiger',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(4,'Mario Ronacher','mario.ronacher@example.local','$2y$10$i27WEnwE.xMCIHl.9NVAw.pVEr2wcZDS5LASAst1GUOlLeXcROWYe','oJr4ix7pdekhc4XkAgF0fjT8E4V9H7btfZq8IETmoPaS6qz1CNhzRhZRFNoW','2016-10-12 06:43:37','2016-11-27 09:42:12',2,88,10,5,50,'Verteidiger',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(5,'Benjamin Liebetegger','benjamin.liebetegger@example.local','$2y$10$1QEHT7MDu/7Q8icT.JlQN.vVFN9IS75CDepZrdp17wuQi9Ba9WRAO','34dA0CHVkJx4gbKvbL7hbqx3gr7xZCnCyJGGgYc8cC18ny4GYqn5mq9jYAco','2016-10-30 07:47:10','2016-11-27 09:42:12',3,3,3,3,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(7,'Alexander Affritsch','alexander.affritsch@example.local','$2y$10$2OlzO6Aqo4mE3azBz6anI.orhITXdALu.oDrblabQbTMKpkYHrcfm',NULL,'2016-10-30 07:50:00','2016-11-27 09:42:12',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(8,'Manuel Rossbacher','manuel.rossbacher@example.local','$2y$10$C9hzW5NfZgpJnzcZEyQF.u1.0hTwBo9K0dxzrZ2TIFguSTIhjWa7e',NULL,'2016-10-30 09:22:15','2016-11-27 09:42:12',NULL,21,9,4,50,'Stürmer',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(9,'Thomas Ronacher','thomas.ronacher@example.local','$2y$10$VDcDzcP64OdDD3w7OHBzZe5yFtZhmpkQ4X4vWsSseK8KrVqEvzYU6',NULL,'2016-10-30 09:26:18','2016-11-27 09:42:13',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(10,'Alexander Klump','alexander.klump@example.local','$2y$10$IMo6HbnGn6ZylbNVYD90n.n/4IS9f42QoWbgUxF78jqpffCA3z/4i','GoWShe3JIgShwk10eRfKilkktnvGFhKF1QcMC1JoeePYthO1yeHKnG6iPi6D','2016-11-01 14:26:19','2016-11-27 09:42:13',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(11,'Gerald Rosic','gerald.rosic@example.local','$2y$10$foxwiC.Nd3VixKlHu49tJOMwgogNhbYjAG3a1jbTZh4mCnajDrXCm',NULL,'2016-11-06 14:30:10','2016-11-27 09:42:13',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(12,'Dana Sauerbier','dana.sauerbier@example.local','$2y$10$Ijx2KAzA.BLbFbNQphfBDeNueuJYg6vWiT4iUCTmj./k4XezDZKIG',NULL,'2016-11-06 14:41:16','2016-11-27 09:42:13',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(13,'Martin Tarmann','martin.tarmann@example.local','$2y$10$xkFkvtbXMqwX13kpYlMwuOqLEtfcRnCmO7kIgjACcu8YMB/ewVPhi',NULL,'2016-11-06 14:41:44','2016-11-27 09:42:13',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(14,'Christoph Lagler','christoph.lagler@example.local','$2y$10$7Xv/7JiTePJfFu5GnUcbt.m8/Zdlrc3FuQfj0uz4kxf0kz7unHjRq',NULL,'2016-11-06 14:42:16','2016-11-27 09:42:13',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(15,'Armin Horner','armin.horner@example.local','$2y$10$9tNAf7ajyMe65qY/mU8Eou4qtmsLFo2zUZFgNoex0VZ/Wj0OD9Wpa',NULL,'2016-11-06 14:42:45','2016-11-27 09:42:13',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(16,'Dominik Gratzl','dominik.gratzl@example.local','$2y$10$1IZqf6GBCBiKaFBNE6RT2OENB7tsUkQ0t4LZltlCQRRpjXXa6rQ/2',NULL,'2016-11-06 14:43:16','2016-11-27 09:42:14',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(17,'Manuel Gratzl','manuel.gratzl@example.local','$2y$10$PHCbrJ.hscMJEmnOOrIEbOnh0Ke6JlW4Rf7kZyelM7hkE.jE4FG0y',NULL,'2016-11-06 14:43:41','2016-11-27 09:42:14',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(18,'Wolfgong Toeplitzer','wolfgang.toeplitzer@example.local','$2y$10$AyUqAxWgQtb3nFOcFGhtCemkzL2sR8eAGOVf8rYW7Zf3BDxrQqAfa',NULL,'2016-11-06 14:44:28','2016-11-27 09:42:14',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(19,'Patrick Unterweger','patrick.unterweger@example.local','$2y$10$jvAOVHb1IttXQhALM6ZGqO4EQs0lLMixsysz/dVg.LhgfBrcn2Sn2',NULL,'2016-11-06 14:46:45','2016-11-27 09:42:14',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(20,'Mario Mottnig','mario.mottnig@example.local','$2y$10$t0YgNluOjOemlOvKfG9kfeVI/ngH9ebs6mfZIm3gYZjCIH6QnBsf2',NULL,'2016-11-06 14:47:25','2016-11-27 09:42:14',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(21,'Alexander Raab','alexander.raab@example.local','$2y$10$8wTCnbziJcv61OrRQoH8tuRL/gR5fveiailj.oG1p337qPUQZG7he','q8HSRfZoCNp6vnNphEhcEFodKoV6H3V9d23ra9R3hdvmUx7RFHpzywjBCkYj','2016-11-06 14:47:50','2016-11-27 09:42:14',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(22,'Markus Marinschek','markus.marinschek@example.local','$2y$10$suY.TIohLFsz662bruy8JO.v2zlKTi.aDA1bbvHtikmfn1Ei.MClO',NULL,'2016-11-06 14:48:33','2016-11-27 09:42:14',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(23,'Stefan Pfurner','stefan.pfurner@example.local','$2y$10$wFmiR7sP9SqNi/G.3DrmTO7ZFY6Yb32x4yBC5ni0SF13omxinMP86',NULL,'2016-11-06 14:50:06','2016-11-27 09:42:15',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(24,'Jürgen Wachter','juergen.wachter@example.local','$2y$10$JGo07tlTDg0e2SeZFlolcO1YFwuNQUJb63hI1anBs0EDUwjgk1jAu',NULL,'2016-11-06 14:51:05','2016-11-27 09:42:15',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(25,'Rene Lang','rene.lang@example.local','$2y$10$fediUJrblzxUOGEN0AIQCuGrKA/bKLCWRc239Fm.6/3SpdqmEksl6',NULL,'2016-11-06 14:51:47','2016-11-27 09:42:15',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(26,'Martin Unterweger','martin.unterweger@example.local','$2y$10$xV98XYAGDSN0RwFmmQlfTuQRvLuT.yHuOfA.Jcfj.YGW6kzo7EkJu',NULL,'2016-11-06 14:52:13','2016-11-27 09:42:15',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',1),(27,'Rene Tranacher','rene.tranacher@example.local','$2y$10$U092RQsJgcBgvaYxUZLOJ.iU.I04VFMEq4dOBHeh3y9ezx6DcYOdu',NULL,'2016-11-06 14:53:10','2016-11-27 09:42:15',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(28,'Harald Jonach','harald.jonach@example.local','$2y$10$lpOrPlidSR6/iwQt03iitO6Zu54JMJ3UATydhkl17R7qqjxl9ob7.',NULL,'2016-11-06 14:53:50','2016-11-27 09:42:15',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(29,'Marko Harder','marko.harder@example.local','$2y$10$xnUJI5pJkm1.agWeFLbPVe8c10kY49uUOWPlDl8Iwux3trpLWtgkC',NULL,'2016-11-06 14:54:14','2016-11-27 09:42:15',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(30,'Simon Brentner','simon.brentner@example.local','$2y$10$YSOoBPSoIXv6lhYCrKjnVOSkqFzrfYIAydjZfV4MpY.BsZaF4pFq2',NULL,'2016-11-06 14:55:02','2016-11-27 09:42:16',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(31,'Patrick Gasteiger','patrick.gasteiger@example.local','$2y$10$isD.q0DIy30sNHafQwLIL.eJgELHdzU3x0l9cOGodTd.iwQmfVYPO',NULL,'2016-11-06 14:55:27','2016-11-27 09:42:16',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(32,'Gerald Kleber','gerald.kleber@example.local','$2y$10$7L2GFmNoZ8j0jz3CTbarUOOAttgSrt7JBAel0DbJMCxnRKKXVGuZu',NULL,'2016-11-06 14:55:52','2016-11-27 09:42:16',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(33,'Dominik Kenzian','dominik.kenzian@example.local','$2y$10$kLLMOYEgbT8yBgQBneZhBebZsOgDUdgALSRP6wZIKLTWq5Xt8rJMW',NULL,'2016-11-06 14:56:30','2016-11-27 09:42:16',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(34,'Dominik Aichholzer','dominik.aichholzer@example.local','$2y$10$p3zzNbxWcs3LVGEVGOkcmeuotl1ebE3WchU3R1c9WCyc97feE86T2',NULL,'2016-11-06 14:57:02','2016-11-27 09:42:16',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',1),(35,'Armin Pausch','armin.pausch@example.local','$2y$10$pIUxlOBzg3Zq16G3XKbIQO0XAM.20qW9ao1ACpdtDOttkNXvxo2la',NULL,'2016-11-06 14:57:42','2016-11-27 09:42:16',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',1),(36,'Ludwig Oberrieser','ludwig.oberrieser@example.local','$2y$10$d2r2TpVRR43rsOlVnjivbOSblQr9Vx4tR8oPbiPeznNBdVDtM7Auq',NULL,'2016-11-06 14:58:28','2016-11-27 09:42:16',NULL,45,3,7,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(37,'Marcel Oberrieser','marcel.oberrieser@example.local','$2y$10$yFbG6t0NCymbIpJMjyNAmuggu53K3y6psv47xBmGHhC9ZoEf1JFQW',NULL,'2016-11-06 14:59:17','2016-11-27 09:42:17',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(38,'David Kraschl','david.krasch@example.local','$2y$10$c3zxwdqUsNhJJgn5NpIm7ufTuAT9R2hFFABmUmQFKZ131KWGMHfHC',NULL,'2016-11-06 14:59:43','2016-11-27 09:42:17',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(39,'Kurt Malle','kurt.malle@example.local','$2y$10$3lenL676hocM5PHigCejVO/bi0dBfqsuZp4UfJYVitaxqJV1r4nuy',NULL,'2016-11-06 15:00:06','2016-11-27 09:42:17',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(40,'Stefan Kreuzer','stefan.kreuzer@example.local','$2y$10$I90BvmtTR.T3nHOQlyXPsOwB9JqCR4YEYDEP6paGDBP5a//HcEbLy',NULL,'2016-11-06 15:01:28','2016-11-27 09:42:17',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(41,'Andreas Miklautsch','andreas.miklautsch@example.local','$2y$10$7dHf2uYEXZSxVdtzVHbVw.CYcdQ2As7tnRTBfgsZzgwgwnd7Ehbhe',NULL,'2016-11-06 15:01:57','2016-11-27 09:42:17',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(42,'Christian Hafner','christian.hafner@example.local','$2y$10$A7R6ZnaKjJIEMMRq1azvWuyOa3ZRYdDqghMU3qy.kedc50BO9MBYi','AabhBTZbIlWZglbN8GokPnlLCYxee3jMinuBXwcqITBUDVQbLBvjE9zxhjTR','2016-11-06 15:02:24','2016-11-27 09:42:17',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',1),(43,'Luca Zarre','luca.zarre@example.local','$2y$10$/.3KPbouW4w3X6Egm7cwpeq6JG2xnzgL9KHCvnuA.bhOCI0htmmR6',NULL,'2016-11-06 15:02:50','2016-11-27 09:42:17',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',1),(44,'Fabian Filzmaier','fabian.filzmaier@example.local','$2y$10$.QYOqjz5mPrjtiG34g5FQ.W5sNEsh/m129UvvlQOqYhLf80PTL1QG',NULL,'2016-11-06 15:03:18','2016-11-27 09:42:17',NULL,54,8,7,50,'Stürmer',NULL,NULL,NULL,NULL,0,'pics/user44.jpeg',0),(45,'Mario Stückelberger','mario.stueckelberger@example.local','$2y$10$K3V89wragOfr988idiTHHuEbCDAdM2DnDkyeBScqVLos2WbdebEum',NULL,'2016-11-06 15:04:08','2016-11-27 09:42:18',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(46,'Thomas Buchacher','thomas.buchacher@example.local','$2y$10$.dJgTP8aYKTJ/vdsp64Y4uUULXGYMB.onY1AguQNG2WKWEh81cJgi',NULL,'2016-11-06 15:04:36','2016-11-27 09:42:18',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(47,'Michael Ofner','michael.ofner@example.local','$2y$10$vHkHjEr6EhSl0qwXnFcY0ezkvI2NRS3rtiZry3seiHwX5Dx5cCDQq',NULL,'2016-11-06 15:05:55','2016-11-27 09:42:18',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(49,'Richard Schleiner','richard.schleiner@example.local','$2y$10$nseYc5Wj.wcu02yznIX6hu79a6Y89dhNml.voBn0BFPgtVW6bm2Bi',NULL,'2016-11-06 15:07:40','2016-11-27 09:42:18',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(50,'Manuel Ellegast','manuel.ellegast@example.local','$2y$10$Qjw4Ux3RFwwuojf0m7JHr.yEyVb1mLppFTWnw6nn/9T3rWWbv58mW',NULL,'2016-11-06 15:08:12','2016-11-27 09:42:18',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(51,'Peter Domnik','peter.domnik@example.local','$2y$10$z3mWF.LEXcIrZNIsyy93F.f.g4Ljy5osF/4Lpkw6tTcLclSLQ3hLW',NULL,'2016-11-06 15:08:43','2016-11-27 09:42:18',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(52,'Hubert Fest','hubert.fest@example.local','$2y$10$RZOhzMdoBFiu5q3.u8Pni.CD4GcrWmDRz02mAbT0/6txun30GI1ye',NULL,'2016-11-06 15:09:11','2016-11-27 09:42:18',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(53,'Stefan Telesklav','stefan.telesklav@example.local','$2y$10$mdpiiasAU5shFSDBNmwzle5EtG1vsOuoeVzIFPxacs6NIAiID9zzO',NULL,'2016-11-06 15:09:40','2016-11-27 09:42:19',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(54,'Roman Rottensteiner','roman.rottensteiner@example.local','$2y$10$0ATlUDLmzn3z4irMVwE61ehaqPjFLnDh/P7RS5Hr2s3bGCwk1pEaG',NULL,'2016-11-06 15:10:07','2016-11-27 09:42:19',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(55,'Daniel Spindelberger','daniel.spindelberger@example.local','$2y$10$5UDzVNU.G4ijzY2gdfDqEO9aY2qHjuc8N1zILBNVpHYtT4IdkpUk6',NULL,'2016-11-06 15:10:54','2016-11-27 09:42:19',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(56,'Daniel Riedler','daniel.riedler@example.local','$2y$10$5UbwWqAgOytFIduTBQbzt.MSL9lVvUqg2ToWpgr2vHt4mJGqVJ/KG',NULL,'2016-11-06 15:12:03','2016-11-27 09:42:19',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(57,'Julian Pirker','julian.pirker@example.local','$2y$10$0usIuKUkMdeQh7/tCbK.Fuhxug9NobZqJnV2drp7tF9Nn1WIvFrPu',NULL,'2016-11-06 15:12:25','2016-11-27 09:42:19',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(58,'Chiara Lube','chiara.lube@example.local','$2y$10$inLGcYpQjeKk2Rn4DPyKL.iO5lO3fceuG9WjodqeBTeaZWqc.nWei',NULL,'2016-11-06 15:12:52','2016-11-27 09:42:19',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(59,'Alexander Hallegger','alexander.hallegger@example.local','$2y$10$8PX74EhJB56ImoZTVer1IeZsdZOnM7DYXxpO2qGXt7W5CUiS1K2e2',NULL,'2016-11-06 15:13:33','2016-11-27 09:42:19',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(60,'Johannes Hallegger','johannes.hallegger@example.local','$2y$10$4DqFiRAJfisNrMbGNoIcTePz.AL925DfB6aJOtUo9C0pUxTpIvvVC',NULL,'2016-11-06 15:13:59','2016-11-27 09:42:20',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(61,'Aquay Vong','aquay.vong@example.local','$2y$10$eP3Gib8FO5dNWYFUr7t3RukFJ6gEq9GzGHHwLxJyrVaAyUkPdQFAO',NULL,'2016-11-06 15:14:23','2016-11-27 09:42:20',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(62,'Michael Neher','michael.neher@example.local','$2y$10$TkXLI5EAafEoq9govva/heOcdbuh52QwuMfdKt7vMTsPaUAWnVRMq',NULL,'2016-11-06 15:14:50','2016-11-27 09:42:20',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(63,'Elena Kleber','elena.kleber@example.local','$2y$10$CC8BCJs6EStgQIOc7C6.zOdVQOSVpbHc3Y3.ZGS96AvU0UKfK1Nx.',NULL,'2016-11-06 15:35:11','2016-11-27 09:42:20',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(64,'Hubert Frohner','hubert.frohner@example.local','$2y$10$ACAuJv/WWC.Il1kIQCgVe.dpMXy2wkwMVfpwUUCqHoG1nrPCb72fa',NULL,'2016-11-06 16:05:55','2016-11-27 09:42:20',NULL,NULL,NULL,NULL,50,'Universal',NULL,NULL,NULL,NULL,0,'pics/default.png',0),(65,'Luca Sauerbier','luca.sauerbier@example.local','$2y$10$Ija2oROSTcR7y2f.EwUU8.TSWnYf5Npfe0Iz4sAXknj86gvVTf9J.',NULL,'2016-11-20 09:42:01','2016-11-27 09:42:20',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,'pics/default.png',0);
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

-- Dump completed on 2016-11-27 11:12:12
