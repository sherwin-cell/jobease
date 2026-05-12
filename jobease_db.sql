-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: jobease_db
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `job_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_user_id_foreign` (`user_id`),
  KEY `activity_log_job_id_foreign` (`job_id`),
  CONSTRAINT `activity_log_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `activity_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,1,'New Account Created','New Job Seeker registered: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 04:04:52','2026-05-10 04:04:52'),(2,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 04:05:06','2026-05-10 04:05:06'),(3,NULL,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 04:17:34','2026-05-10 04:17:34'),(4,5,'New Account Created','New Employer registered: Angela Joven - Company: Acme Corp (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 04:23:03','2026-05-10 04:23:03'),(5,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 04:31:22','2026-05-10 04:31:22'),(6,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 05:35:10','2026-05-10 05:35:10'),(7,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 05:52:03','2026-05-10 05:52:03'),(8,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 05:56:39','2026-05-10 05:56:39'),(9,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 05:58:08','2026-05-10 05:58:08'),(10,5,'New job posting created','Cook at Gubat Sorsogon',8,NULL,NULL,'2026-05-10 06:24:18','2026-05-10 06:24:18'),(11,5,'New job posting created','Cook at Gubat Sorsogon',9,NULL,NULL,'2026-05-10 06:24:18','2026-05-10 06:24:18'),(12,5,'New job posting created','Cook at Gubat Sorsogon',10,NULL,NULL,'2026-05-10 06:24:18','2026-05-10 06:24:18'),(13,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 06:25:23','2026-05-10 06:25:23'),(14,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 06:30:39','2026-05-10 06:30:39'),(15,5,'New job posting created','Cook at Gubat Sorsogon',11,NULL,NULL,'2026-05-10 06:31:39','2026-05-10 06:31:39'),(16,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 06:32:07','2026-05-10 06:32:07'),(17,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 06:32:57','2026-05-10 06:32:57'),(18,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 06:35:40','2026-05-10 06:35:40'),(19,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 06:40:43','2026-05-10 06:40:43'),(20,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 06:57:42','2026-05-10 06:57:42'),(21,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-10 06:57:58','2026-05-10 06:57:58'),(22,5,'New job posting created','gdsgwerg at gwergwer',12,NULL,NULL,'2026-05-10 06:59:58','2026-05-10 06:59:58'),(23,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 07:00:35','2026-05-10 07:00:35'),(24,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 07:01:12','2026-05-10 07:01:12'),(25,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 12; SM-A125F Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/147.0.7727.138 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/560.0.0.55.69;]','2026-05-10 07:57:20','2026-05-10 07:57:20'),(26,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:25:43','2026-05-10 09:25:43'),(27,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:28:11','2026-05-10 09:28:11'),(28,5,'New job posting created','zdfsdgser at fgdrhe',13,NULL,NULL,'2026-05-10 09:28:26','2026-05-10 09:28:26'),(29,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:28:52','2026-05-10 09:28:52'),(30,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:29:08','2026-05-10 09:29:08'),(31,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:41:19','2026-05-10 09:41:19'),(32,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:48:59','2026-05-10 09:48:59'),(33,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:49:25','2026-05-10 09:49:25'),(34,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:52:44','2026-05-10 09:52:44'),(35,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:53:33','2026-05-10 09:53:33'),(36,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 09:54:32','2026-05-10 09:54:32'),(37,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:18:28','2026-05-10 10:18:28'),(38,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:20:35','2026-05-10 10:20:35'),(39,5,'New job posting created','fsdgsdg at gergerh',14,NULL,NULL,'2026-05-10 10:21:15','2026-05-10 10:21:15'),(40,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:21:34','2026-05-10 10:21:34'),(41,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:21:52','2026-05-10 10:21:52'),(42,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:45:28','2026-05-10 10:45:28'),(43,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:50:29','2026-05-10 10:50:29'),(44,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:50:51','2026-05-10 10:50:51'),(45,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:51:24','2026-05-10 10:51:24'),(46,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:51:37','2026-05-10 10:51:37'),(47,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:53:15','2026-05-10 10:53:15'),(48,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:56:55','2026-05-10 10:56:55'),(49,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 10:58:46','2026-05-10 10:58:46'),(50,5,'New job posting created','Developer at gergerh',15,NULL,NULL,'2026-05-10 10:59:36','2026-05-10 10:59:36'),(51,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 11:00:30','2026-05-10 11:00:30'),(52,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 11:01:00','2026-05-10 11:01:00'),(53,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 11:01:45','2026-05-10 11:01:45'),(54,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 12:59:44','2026-05-10 12:59:44'),(55,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 13:00:29','2026-05-10 13:00:29'),(56,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 13:01:54','2026-05-10 13:01:54'),(57,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 13:30:46','2026-05-10 13:30:46'),(58,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 13:32:06','2026-05-10 13:32:06'),(59,5,'New job posting created','bdfdfhnth at xvbdfh',16,NULL,NULL,'2026-05-10 13:32:34','2026-05-10 13:32:34'),(60,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 13:33:11','2026-05-10 13:33:11'),(61,5,'User Login','Employer (Acme Corp) logged in: Angela Joven (luj4420@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0','2026-05-10 13:33:49','2026-05-10 13:33:49'),(62,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-10 15:25:17','2026-05-10 15:25:17'),(63,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-10 15:30:36','2026-05-10 15:30:36'),(64,3,'User Login','Admin logged in: Admin (admin@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-10 15:30:59','2026-05-10 15:30:59'),(65,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-10 15:32:21','2026-05-10 15:32:21'),(66,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 12; SM-A125F Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/147.0.7727.138 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/560.0.0.55.69;]','2026-05-11 23:48:43','2026-05-11 23:48:43'),(67,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-11 23:49:46','2026-05-11 23:49:46'),(68,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 12; SM-A125F Build/SP1A.210812.016; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/147.0.7727.138 Mobile Safari/537.36 [FB_IAB/FB4A;FBAV/560.0.0.55.69;]','2026-05-11 23:55:19','2026-05-11 23:55:19'),(69,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Mobile Safari/537.36','2026-05-12 00:00:08','2026-05-12 00:00:08'),(70,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-12 00:12:25','2026-05-12 00:12:25'),(71,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-12 00:22:24','2026-05-12 00:22:24'),(72,1,'User Login','Job Seeker logged in: Sherwin (sherwinescanilla18@gmail.com)',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0','2026-05-12 06:03:25','2026-05-12 06:03:25');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `job_id` bigint unsigned NOT NULL,
  `cover_letter` text COLLATE utf8mb4_unicode_ci,
  `resume` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','shortlisted','rejected','hired','interview_scheduled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `skill_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_user_id_foreign` (`user_id`),
  KEY `applications_job_id_foreign` (`job_id`),
  CONSTRAINT `applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,1,11,'Jee','resumes/IwkPGD31a4m1uego2ZmbckjeDvntTwj4qhrPBSGK.pdf','interview_scheduled',NULL,'2026-05-10 06:40:18','2026-05-10 06:42:43'),(2,1,12,'new here','resumes/r4vDQDCXcyOZXjApKZFmit6hpz7i0kKC0ZfHaWeK.pdf','pending',NULL,'2026-05-10 07:01:35','2026-05-10 09:43:41'),(3,1,13,'grsdfgheth','resumes/LaA4f8E8CCiTmlI8GJNg1utFIQC2ZY6dtSgA60ok.pdf','pending',NULL,'2026-05-10 09:53:56','2026-05-10 10:55:04'),(4,1,15,'dsgvbsg','resumes/nXLkOOVBRlN8c8dZvwgO0pMayFO0DsA6trmwHOzq.pdf','interview_scheduled',NULL,'2026-05-10 13:31:31','2026-05-10 13:34:45');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certifications`
--

DROP TABLE IF EXISTS `certifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `certifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authority` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_obtained` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `certifications_profile_id_foreign` (`profile_id`),
  CONSTRAINT `certifications_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certifications`
--

LOCK TABLES `certifications` WRITE;
/*!40000 ALTER TABLE `certifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `certifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educations`
--

DROP TABLE IF EXISTS `educations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `educations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field_of_study` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `educations_profile_id_foreign` (`profile_id`),
  CONSTRAINT `educations_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educations`
--

LOCK TABLES `educations` WRITE;
/*!40000 ALTER TABLE `educations` DISABLE KEYS */;
/*!40000 ALTER TABLE `educations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employer_profiles`
--

DROP TABLE IF EXISTS `employer_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employer_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `business_permit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `rejection_reason` text COLLATE utf8mb4_unicode_ci,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employer_profiles_user_id_foreign` (`user_id`),
  KEY `employer_profiles_approved_by_foreign` (`approved_by`),
  CONSTRAINT `employer_profiles_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  CONSTRAINT `employer_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employer_profiles`
--

LOCK TABLES `employer_profiles` WRITE;
/*!40000 ALTER TABLE `employer_profiles` DISABLE KEYS */;
INSERT INTO `employer_profiles` VALUES (2,5,'2026-05-10 04:23:00','2026-05-10 04:41:01',0,'Acme Corp','Sorsogon, Bicol Region, PHL','09051967358','https://laragon.org/key','this is company can scam you','business_permits/qQmGOfnje7XOqFIqycyiCCy4bpRytc3O4p2j9Hmd.pdf','approved',NULL,'2026-05-10 04:41:01',3);
/*!40000 ALTER TABLE `employer_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employers`
--

DROP TABLE IF EXISTS `employers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employers_user_id_foreign` (`user_id`),
  CONSTRAINT `employers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employers`
--

LOCK TABLES `employers` WRITE;
/*!40000 ALTER TABLE `employers` DISABLE KEYS */;
/*!40000 ALTER TABLE `employers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `experiences_profile_id_foreign` (`profile_id`),
  CONSTRAINT `experiences_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `interests_profile_id_foreign` (`profile_id`),
  CONSTRAINT `interests_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interests`
--

LOCK TABLES `interests` WRITE;
/*!40000 ALTER TABLE `interests` DISABLE KEYS */;
/*!40000 ALTER TABLE `interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interview_sessions`
--

DROP TABLE IF EXISTS `interview_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `interview_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint unsigned NOT NULL,
  `application_id` bigint unsigned DEFAULT NULL,
  `employer_id` bigint unsigned NOT NULL,
  `job_seeker_id` bigint unsigned NOT NULL,
  `room_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scheduled_at` timestamp NOT NULL,
  `status` enum('pending','active','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `interview_sessions_room_id_unique` (`room_id`),
  KEY `interview_sessions_job_id_foreign` (`job_id`),
  CONSTRAINT `interview_sessions_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interview_sessions`
--

LOCK TABLES `interview_sessions` WRITE;
/*!40000 ALTER TABLE `interview_sessions` DISABLE KEYS */;
INSERT INTO `interview_sessions` VALUES (1,11,1,5,1,'room_a0958589-9ded-432c-9092-fcb6f779a0f3','2026-05-11 06:42:00','pending','2026-05-10 06:42:43','2026-05-10 06:42:43'),(2,12,2,5,1,'room_236c0224-19ce-481a-bf3e-144eead4c364','2026-05-10 07:03:00','pending','2026-05-10 07:02:25','2026-05-10 07:02:25'),(3,15,4,5,1,'room_bd8d6b4e-5be2-42bf-a476-45ff88bb9be1','2026-05-11 13:34:00','pending','2026-05-10 13:34:45','2026-05-10 13:34:45');
/*!40000 ALTER TABLE `interview_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_skill`
--

DROP TABLE IF EXISTS `job_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_skill` (
  `job_id` bigint unsigned NOT NULL,
  `skill_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`job_id`,`skill_id`),
  KEY `job_skill_skill_id_foreign` (`skill_id`),
  CONSTRAINT `job_skill_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_skill`
--

LOCK TABLES `job_skill` WRITE;
/*!40000 ALTER TABLE `job_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `employer_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skills_required` json DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_employer_id_foreign` (`employer_id`),
  CONSTRAINT `jobs_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (8,5,'Cook','Knows how to cook','Gubat Sorsogon','600','senior','[\"cooking\", \"cleaning\", \"serving\"]','pending','2026-05-10 06:24:18','2026-05-10 06:30:59','2026-05-10 06:30:59'),(9,5,'Cook','Knows how to cook','Gubat Sorsogon','600','senior','[\"cooking\", \"cleaning\", \"serving\"]','pending','2026-05-10 06:24:18','2026-05-10 06:31:01','2026-05-10 06:31:01'),(10,5,'Cook','Knows how to cook','Gubat Sorsogon','600','senior','[\"cooking\", \"cleaning\", \"serving\"]','pending','2026-05-10 06:24:18','2026-05-10 06:31:03','2026-05-10 06:31:03'),(11,5,'Cook','Need to know how to cook','Gubat Sorsogon','900','senior','[\"cooking\", \"cleaning\", \"serving\"]','active','2026-05-10 06:31:38','2026-05-10 06:35:21',NULL),(12,5,'ddsadwqtd','efrwggrgr','gwergwer','63465','mid','[\"php\", \"laravel\"]','active','2026-05-10 06:59:58','2026-05-10 10:02:02',NULL),(13,5,'zdfsdgser','gwegwrg','fgdrhe','35645','mid','[\"php\", \"laravel\"]','active','2026-05-10 09:28:26','2026-05-10 09:28:58',NULL),(14,5,'fsdgsdg','grergherh','gergerh','235423','entry','[\"php\"]','active','2026-05-10 10:21:15','2026-05-10 10:21:39',NULL),(15,5,'Developer','Programmer','gergerh','235423','entry','[\"Php\", \"Laravel\", \"Javascript\"]','active','2026-05-10 10:59:36','2026-05-10 11:01:14',NULL),(16,5,'bdfdfhnth','vdbhdfhdhdh','xvbdfh','547547','entry','[\"php\"]','active','2026-05-10 13:32:34','2026-05-10 13:33:22',NULL);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobseeker_profiles`
--

DROP TABLE IF EXISTS `jobseeker_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobseeker_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `skills` json DEFAULT NULL,
  `experience` json DEFAULT NULL,
  `education` json DEFAULT NULL,
  `certifications` json DEFAULT NULL,
  `interests` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jobseeker_profiles_user_id_unique` (`user_id`),
  CONSTRAINT `jobseeker_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobseeker_profiles`
--

LOCK TABLES `jobseeker_profiles` WRITE;
/*!40000 ALTER TABLE `jobseeker_profiles` DISABLE KEYS */;
INSERT INTO `jobseeker_profiles` VALUES (1,1,'[\"php\", \"javascript\"]','[{\"title\": \"Janitor\", \"company\": \"Peter and Piper\", \"end_date\": \"2026-05-09\", \"start_date\": \"2026-05-06\", \"description\": \"I am 3 years janitor in peter piper\"}]','[{\"degree\": \"BSIT\", \"end_date\": \"2026-05-13\", \"start_date\": \"2026-04-26\", \"description\": \"I graduated with High honor\", \"institution\": \"The lewis college\"}]','[\"AWS Certified\"]','[\"Cloud Computing\"]','2026-05-10 04:04:52','2026-05-10 05:54:59','Web developer','i am hardwoking','Sorsogon, Bicol Region, PHL','09222555100','https://laragon.org/key','resumes/Mj4v97zYfM3zgvg0bv7AfA0nJngjQB8MtioMqq10.pdf');
/*!40000 ALTER TABLE `jobseeker_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'2026_03_03_171006_create_roles_table',1),(3,'2026_03_03_174124_create_profiles_table',1),(4,'2026_03_03_174207_create_skills_table',1),(5,'2026_03_03_174251_create_profile_skill_table',1),(6,'2026_03_03_175713_create_jobs_table',1),(7,'2026_03_03_175801_create_applications_table',1),(8,'2026_03_07_122249_create_job_skill_table',1),(9,'2026_03_08_055347_create_employers_table',1),(10,'2026_03_08_071935_add_role_id_to_users_table',1),(11,'2026_03_08_090010_create_cache_table',1),(12,'2026_04_02_032829_add_admin_fields_to_users_table',1),(13,'2026_04_02_072519_remove_role_column_from_users_table',1),(14,'2026_04_09_000003_create_skill_tags_table',1),(15,'2026_04_10_000001_create_experiences_table',1),(16,'2026_04_10_000002_create_educations_table',1),(17,'2026_04_10_000003_create_certifications_table',1),(18,'2026_04_10_000004_create_interests_table',1),(19,'2026_04_12_043825_create_interview_sessions_table',1),(20,'2026_04_12_065757_update_application_status_enum',1),(21,'2026_04_22_025545_add_business_permit_to_profiles_table',1),(22,'2026_04_22_030012_create_employer_profiles_table',1),(23,'2026_04_22_030018_create_jobseeker_profiles_table',1),(24,'2026_04_22_031112_add_is_verified_to_employer_profiles_table',1),(25,'2026_04_22_031758_add_fields_to_employer_profiles_table',1),(26,'2026_04_22_032004_add_user_id_to_employer_profiles_table',1),(27,'2026_04_22_034250_add_status_to_employer_profiles_table',1),(28,'2026_04_22_133707_add_approval_status_to_employer_profiles_table',1),(29,'2026_04_22_154242_add_user_id_to_jobseeker_profiles_table',1),(30,'2026_04_22_154814_add_fields_to_jobseeker_profiles_table',1),(31,'2026_04_24_010031_add_general_info_to_jobseeker_profiles',1),(32,'2026_04_24_120000_add_profile_fields_to_jobseeker_profiles',1),(33,'2026_05_01_134934_add_company_and_status_to_jobs_table',1),(34,'2026_05_01_140510_remove_company_from_jobs_table',1),(35,'2026_05_01_162430_add_default_status_to_jobs_table',1),(36,'2026_05_02_022728_add_certifications_interests_resume_to_jobseeker_profiles',1),(37,'2026_05_02_150535_add_soft_deletes_to_jobs_and_activity_log',1),(38,'2026_05_04_104924_create_activity_log_table',1),(39,'2026_05_10_113224_add_job_id_to_activity_log',1),(40,'2026_05_10_163925_add_skill_notes_to_applications_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_skill`
--

DROP TABLE IF EXISTS `profile_skill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile_skill` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` bigint unsigned NOT NULL,
  `skill_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_skill_profile_id_foreign` (`profile_id`),
  KEY `profile_skill_skill_id_foreign` (`skill_id`),
  CONSTRAINT `profile_skill_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `profile_skill_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_skill`
--

LOCK TABLES `profile_skill` WRITE;
/*!40000 ALTER TABLE `profile_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_skill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills` json DEFAULT NULL,
  `experience` json DEFAULT NULL,
  `education` json DEFAULT NULL,
  `certifications` json DEFAULT NULL,
  `interests` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `business_permit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'job_seeker','2026-05-10 03:42:48','2026-05-10 03:42:48'),(2,'employer','2026-05-10 03:42:48','2026-05-10 03:42:48'),(3,'admin','2026-05-10 03:42:48','2026-05-10 03:42:48');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skill_tags`
--

DROP TABLE IF EXISTS `skill_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skill_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skill_tags`
--

LOCK TABLES `skill_tags` WRITE;
/*!40000 ALTER TABLE `skill_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `skill_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `skills_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '1',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Sherwin','sherwinescanilla18@gmail.com','2026-05-10 04:05:06','$2y$12$QW8bhA6UWnBmEutwcfZUduE/95vwh3QdCo8iW3fy/s.H2FnuQhmmi',NULL,'2026-05-10 04:04:48','2026-05-10 10:51:40',1,0,0,NULL),(3,3,'Admin','admin@gmail.com','2026-05-10 04:17:08','$2y$12$15223FRxMYv0tmlcscLMyedRIoK9uzX2HinYK.ox7idTFSybEXgai',NULL,'2026-05-10 04:17:08','2026-05-10 04:17:08',1,0,0,NULL),(5,2,'Angela Joven','luj4420@gmail.com','2026-05-10 04:23:10','$2y$12$e0DJrrt2icO4UNSuze4lP.LqREr3FNxx6m9Ksj0zoFwxFmrpARyoG',NULL,'2026-05-10 04:23:00','2026-05-10 10:50:10',1,0,0,NULL);
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

-- Dump completed on 2026-05-12 20:29:18
