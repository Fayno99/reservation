-- MariaDB dump 10.19  Distrib 10.6.16-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: Reservation
-- ------------------------------------------------------
-- Server version	10.6.16-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Vadim','vadim@gmail.com','+380969716130','2024-04-21 17:17:31','2024-04-21 17:17:31'),(2,'Andrey','Andrey@test.com','+380974563245','2024-04-21 17:17:31','2024-04-21 17:17:31'),(3,'Степан','Stepan@tets.com','380965732213','2024-04-21 17:17:31','2024-04-21 17:17:31'),(4,'Maksim','Maksim@gmail.com','08456278823','2024-04-28 11:57:35','2024-04-28 11:57:35'),(7,'Andreu','Andreu@test.com','1234567','2024-04-28 12:25:36','2024-04-28 12:25:36'),(8,'Stepan','Stepan@gmail.com','0987654321','2024-04-28 12:27:47','2024-04-28 12:27:47'),(42,'Danil','Danil@mai.hi','2134567','2024-04-29 09:17:54','2024-04-29 09:17:54'),(44,'Maksim','Danil@mai.his','08456278823','2024-04-29 13:34:44','2024-04-29 13:34:44'),(45,'Maksim','Maksim@gmail.comf','08456278823','2024-04-29 13:43:36','2024-04-29 13:43:36'),(46,'sfdsjvh','Maksim@gmail.coma','2345678','2024-04-29 13:44:36','2024-04-29 13:44:36'),(47,'Maksim','Andrey@test.comkk','123456789876','2024-04-29 13:49:31','2024-04-29 13:49:31'),(48,'Andreu','Maksim@gmil.com','3456768345','2024-04-29 13:57:28','2024-04-29 13:57:28'),(49,'Maksimw','Maksim@gmail.comww','0987654','2024-04-29 14:18:58','2024-04-29 14:18:58'),(50,'Maksim','Maksim@gmail.comdf','123456789','2024-04-29 14:29:33','2024-04-29 14:29:33'),(52,'Andre','Danil@mai.hisjh','567588564653','2024-04-29 14:38:03','2024-04-29 14:38:03'),(54,'Andre','Danil@mai.hin','567588564653','2024-04-29 14:39:37','2024-04-29 14:39:37'),(55,'fdgbhsdglhslg','fayno99@gmail.comsgzs','123456789','2024-04-30 16:50:14','2024-04-30 16:50:14'),(56,'Inokentiy','Inokentiy@pipka.ua','09739264822','2024-05-01 13:53:40','2024-05-01 13:53:40'),(58,'Maksim','Maksim@gmail.comasa','435q43635474658','2024-05-01 13:54:49','2024-05-01 13:54:49'),(59,'sfdsjvh','Maksim@gmail.comer','123456789','2024-05-01 15:34:15','2024-05-01 15:34:15'),(60,'Maksim','Maksim@gmail.cod','09845048','2024-05-01 18:11:09','2024-05-01 18:11:09'),(62,'Danil','Danil@mai.hidr','0945809245','2024-05-01 18:12:25','2024-05-01 18:12:25'),(63,'Andreu','Danil@mai.hids','2345678','2024-05-01 20:02:05','2024-05-01 20:02:05'),(64,'Maksim','Maksim@gmail.comfdg','121345678','2024-05-03 15:54:15','2024-05-03 15:54:15'),(65,'Sagil','Sagil@test.com','453676756','2024-05-04 13:32:48','2024-05-04 13:32:48'),(66,'Артур','Artur@gmail.com','0961733849','2024-05-04 14:28:02','2024-05-04 14:28:02'),(68,'Артур','Artur@gmail.co','0961733849','2024-05-04 14:29:37','2024-05-04 14:29:37'),(69,'Генадій','gena@test.com','3020832084','2024-05-04 15:50:36','2024-05-04 15:50:36');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'KingCustom','NordStreet','Moto repair Garage','2024-04-21 17:18:36','2024-04-22 21:19:40'),(2,'KingCustom','WestStreet','Moto repair Service','2024-04-22 21:19:40','2024-04-22 21:19:40');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_schedules`
--

DROP TABLE IF EXISTS `master_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `masters_id` bigint(20) unsigned NOT NULL,
  `work_day` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `master_schedules_masters_id_foreign` (`masters_id`),
  CONSTRAINT `master_schedules_masters_id_foreign` FOREIGN KEY (`masters_id`) REFERENCES `masters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_schedules`
--

LOCK TABLES `master_schedules` WRITE;
/*!40000 ALTER TABLE `master_schedules` DISABLE KEYS */;
INSERT INTO `master_schedules` VALUES (149,1,'2024-04-30','2024-04-30 17:09:40','2024-04-30 17:09:40'),(150,1,'2024-05-01','2024-04-30 17:09:40','2024-04-30 17:09:40'),(151,1,'2024-05-02','2024-04-30 17:09:40','2024-04-30 17:09:40'),(152,3,'2024-04-30','2024-04-30 17:19:27','2024-04-30 17:19:27'),(153,3,'2024-05-01','2024-04-30 17:19:27','2024-04-30 17:19:27'),(154,3,'2024-05-02','2024-04-30 17:19:27','2024-04-30 17:19:27'),(155,3,'2024-05-04','2024-04-30 17:19:27','2024-05-01 18:08:16'),(199,2,'2024-05-01','2024-04-30 20:49:14','2024-04-30 20:49:14'),(200,2,'2024-05-02','2024-04-30 20:49:14','2024-04-30 20:49:14'),(201,2,'2024-05-03','2024-04-30 20:49:14','2024-04-30 20:49:14'),(202,2,'2024-05-01','2024-04-30 20:49:41','2024-04-30 20:49:41'),(223,2,'2024-05-02','2024-04-30 21:03:53','2024-04-30 21:03:53'),(224,2,'2024-05-03','2024-04-30 21:03:53','2024-04-30 21:03:53'),(225,2,'2024-05-08','2024-04-30 21:13:26','2024-04-30 21:13:26'),(226,2,'2024-05-09','2024-04-30 21:13:26','2024-04-30 21:13:26'),(227,4,'2024-05-01','2024-05-01 21:56:21','2024-05-01 21:56:21'),(228,4,'2024-05-02','2024-05-01 21:56:21','2024-05-01 21:56:21'),(229,4,'2024-05-03','2024-05-01 21:56:21','2024-05-01 21:56:21'),(230,4,'2024-05-13','2024-05-04 15:52:48','2024-05-04 15:52:48'),(231,4,'2024-05-14','2024-05-04 15:52:48','2024-05-04 15:52:48'),(232,4,'2024-05-15','2024-05-04 15:52:48','2024-05-04 15:52:48'),(233,4,'2024-05-16','2024-05-04 15:52:48','2024-05-04 15:52:48'),(234,4,'2024-05-17','2024-05-04 15:52:48','2024-05-04 15:52:48'),(235,4,'2024-05-18','2024-05-04 15:52:48','2024-05-04 15:52:48'),(236,4,'2024-05-19','2024-05-04 15:52:48','2024-05-04 15:52:48'),(237,4,'2024-05-20','2024-05-04 15:52:48','2024-05-04 15:52:48');
/*!40000 ALTER TABLE `master_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `masters`
--

DROP TABLE IF EXISTS `masters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `masters` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `companies_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `masters_companies_id_foreign` (`companies_id`),
  CONSTRAINT `masters_companies_id_foreign` FOREIGN KEY (`companies_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `masters`
--

LOCK TABLES `masters` WRITE;
/*!40000 ALTER TABLE `masters` DISABLE KEYS */;
INSERT INTO `masters` VALUES (1,'Maксим',1,'2024-04-21 17:19:26','2024-05-01 19:55:03','image_1.jpeg'),(2,'Микола',1,'2024-04-22 21:17:25','2024-05-01 19:55:03','image_2.jpeg'),(3,'Дмитро',1,'2024-04-22 21:17:25','2024-05-01 19:55:03','image_3.jpeg'),(4,'Тарас',1,'2024-05-01 19:55:03','2024-05-01 19:55:03','image_4.jpeg');
/*!40000 ALTER TABLE `masters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_04_20_204807_create_clients_table',1),(5,'2024_04_20_204831_create_masters_table',1),(6,'2024_04_20_204843_create_works_table',1),(7,'2024_04_20_204901_create_work_orders_table',1),(8,'2024_04_20_204932_create_master_schedules_table',1),(9,'2024_04_20_205002_create_companies_table',1),(10,'2024_04_20_205015_create_reviews_table',1),(11,'2024_04_21_152326_add_key',1),(22,'1',1),(23,'1',1),(24,'1',3),(25,'1',1),(26,'1',3),(27,'1',3),(28,'1',3),(29,'1',3),(30,'1',3),(31,'1',2),(32,'1',2),(33,'1',1),(34,'1',1),(35,'1',3),(36,'1',3),(37,'1',4),(38,'1',3),(39,'2024_05_04_141128_create_motorcycles_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
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
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  `stars` bigint(20) unsigned NOT NULL,
  `masters_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `reviews_masters_id_foreign` (`masters_id`),
  CONSTRAINT `reviews_masters_id_foreign` FOREIGN KEY (`masters_id`) REFERENCES `masters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'Крутяк зробили все швидко',5,1,'2024-04-22 21:15:32','2024-04-22 21:15:32'),(2,'Майстер що треба кінь вже 3 дні їзде без бензіка',5,2,'2024-04-22 21:16:49','2024-04-22 21:22:17'),(3,'Не протер фару перед здачою мото',3,1,'2024-04-22 21:16:49','2024-04-22 21:16:49'),(4,'Все по феншую дякую',4,2,'2024-04-22 21:22:17','2024-04-22 21:22:17'),(5,'Не встиг допити кофевжевсе зробили',5,3,'2024-04-22 21:22:17','2024-04-22 21:22:17'),(6,'Колиприїзджаюу сервіс мотоцикл самовідновлюється',5,2,'2024-04-22 21:22:17','2024-04-22 21:22:17');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
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
INSERT INTO `sessions` VALUES ('XN9NTerhWAWuuyYyBCt7GnwGaJ8pPlue1OrFjldC',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:125.0) Gecko/20100101 Firefox/125.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmlkZ0FwdGt0TDhOYksyZVN2TzJZMkZDTUJsQXNjVjE1RUE3MzNoNiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9sb2NhbGhvc3Qvc2VydmljZXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1714834322),('yPcyB0wFEitBO0Sljy6vdWDaC2VkOzGLGyTrtVKQ',5,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:125.0) Gecko/20100101 Firefox/125.0','YTo5OntzOjY6Il90b2tlbiI7czo0MDoibG5oV0k3NFM4TjN5TUxGREJNQ3prMHRrUmVlVEFMUkdXa3BONmVjaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly9sb2NhbGhvc3Qvb3JkZXIvMjAyNC0wNS0xOCUyMDA4OjAwLzIwMjQtMDUtMTglMjAxMTowMCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo5OiJtYXN0ZXJfaWQiO3M6MToiMSI7czoxMDoic2VydmljZV9pZCI7czoxOiI2IjtzOjIxOiJzZXJ2aWNlX3RpbWVfZm9yX3dvcmsiO3M6MzoiMTgwIjtzOjEwOiJzdGFydC10aW1lIjtzOjE2OiIyMDI0LTA1LTE4IDA4OjAwIjtzOjg6ImVuZC10aW1lIjtzOjE2OiIyMDI0LTA1LTE4IDExOjAwIjt9',1714838000);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Адмін','admin@test.com',NULL,'$2y$12$pWwcZArAKdmJVUgqswEMfOeUIyjGdsl0EfFRzr6vwUfWXOBHLQ1.e',NULL,3,NULL,'2024-05-03 17:30:34','2024-05-03 20:41:33'),(4,'User','user@test.com',NULL,'$2y$12$MBfY0VND0cdFO48E7ec55uQqux4Vq0oJDRF0SgnxQCWMhJvxiGMjK',NULL,1,NULL,'2024-05-03 20:04:19','2024-05-03 20:04:19'),(5,'Manager','manager@test.com',NULL,'$2y$12$evpKHEg3M0yUal7iZ9UnKuA7/daoiwEzu70hKuhKB8XJ/BR7d/ktG',NULL,4,NULL,'2024-05-03 20:05:31','2024-05-03 20:41:33'),(6,'Assistant','assistant@test.com',NULL,'$2y$12$BtuLCARdTo8VpGvucnSt5Ol7l2BmypzHaM47..w.4H.Knau/9uvqm',NULL,2,NULL,'2024-05-03 20:13:56','2024-05-03 20:41:33'),(7,'Natalia','nata@ukr.net',NULL,'$2y$12$M0Q9EA3yvMKi03AIJ8VRtOZCpHoB1.r6Qvu3BB4R.BGvG4vfu9b3y',NULL,1,NULL,'2024-05-04 14:31:07','2024-05-04 14:31:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_orders`
--

DROP TABLE IF EXISTS `work_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `companies_id` bigint(20) unsigned NOT NULL,
  `masters_id` bigint(20) unsigned NOT NULL,
  `clients_id` bigint(20) unsigned NOT NULL,
  `works_id` bigint(20) unsigned NOT NULL,
  `start_order` datetime NOT NULL,
  `stop_order` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `users_id` bigint(20) unsigned DEFAULT NULL,
  `motorcycles` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `work_orders_masters_id_foreign` (`masters_id`),
  KEY `work_orders_clients_id_foreign` (`clients_id`),
  KEY `work_orders_works_id_foreign` (`works_id`),
  KEY `work_orders_companies_id_foreign` (`companies_id`),
  CONSTRAINT `work_orders_clients_id_foreign` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `work_orders_companies_id_foreign` FOREIGN KEY (`companies_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `work_orders_masters_id_foreign` FOREIGN KEY (`masters_id`) REFERENCES `masters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `work_orders_works_id_foreign` FOREIGN KEY (`works_id`) REFERENCES `works` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_orders`
--

LOCK TABLES `work_orders` WRITE;
/*!40000 ALTER TABLE `work_orders` DISABLE KEYS */;
INSERT INTO `work_orders` VALUES (1,1,1,1,1,'2024-04-21 14:00:00','2024-04-21 17:00:00','2024-04-21 17:22:55','2024-04-21 17:22:55',NULL,NULL),(22,1,1,45,16,'2024-05-13 14:40:00','2024-05-13 18:00:00','2024-04-29 13:43:36','2024-04-29 13:43:36',NULL,NULL),(23,1,1,46,16,'2024-05-13 14:40:00','2024-05-13 18:00:00','2024-04-29 13:44:36','2024-04-29 13:44:36',NULL,NULL),(24,1,3,47,9,'2024-05-13 13:00:00','2024-05-13 18:00:00','2024-04-29 13:49:31','2024-04-29 13:49:31',NULL,NULL),(25,1,1,48,1,'2024-04-29 17:00:00','2024-04-29 18:00:00','2024-04-29 13:57:28','2024-04-29 13:57:28',NULL,NULL),(26,1,3,49,9,'2024-05-13 13:00:00','2024-05-13 18:00:00','2024-04-29 14:18:58','2024-04-29 14:18:58',NULL,NULL),(27,1,3,50,9,'2024-05-13 13:00:00','2024-05-13 18:00:00','2024-04-29 14:29:33','2024-04-29 14:29:33',NULL,NULL),(28,1,3,52,3,'2024-05-13 17:00:00','2024-05-13 18:00:00','2024-04-29 14:38:03','2024-04-29 14:38:03',NULL,NULL),(29,1,3,54,3,'2024-05-13 17:00:00','2024-05-13 18:00:00','2024-04-29 14:39:37','2024-04-29 14:39:37',NULL,NULL),(30,1,3,55,3,'2024-05-05 09:00:00','2024-05-05 10:00:00','2024-04-30 16:50:14','2024-04-30 16:50:14',NULL,NULL),(31,1,2,56,2,'2024-05-04 08:00:00','2024-05-04 08:40:00','2024-05-01 13:53:40','2024-05-01 13:53:40',NULL,NULL),(32,1,2,58,2,'2024-05-04 08:00:00','2024-05-04 08:40:00','2024-05-01 13:54:49','2024-05-01 13:54:49',NULL,NULL),(33,1,1,59,1,'2024-05-04 10:00:00','2024-05-04 11:00:00','2024-05-01 15:34:15','2024-05-01 17:35:06',NULL,NULL),(34,1,1,59,1,'2024-05-04 13:30:00','2024-05-04 14:50:00','2024-05-01 15:34:15','2024-05-01 17:11:18',NULL,NULL),(35,1,3,60,6,'2024-05-03 11:10:00','2024-05-03 14:10:00','2024-05-01 18:11:09','2024-05-01 18:11:09',NULL,NULL),(36,1,3,62,11,'2024-05-03 14:20:00','2024-05-03 17:20:00','2024-05-01 18:12:25','2024-05-01 18:12:25',NULL,NULL),(37,1,4,63,2,'2024-05-01 08:50:00','2024-05-01 09:30:00','2024-05-01 20:02:05','2024-05-01 20:02:05',NULL,NULL),(38,1,3,64,3,'2024-05-08 08:00:00','2024-05-08 09:00:00','2024-05-03 15:54:15','2024-05-03 15:54:15',NULL,NULL),(39,1,1,65,2,'2024-05-05 08:50:00','2024-05-05 09:30:00','2024-05-04 13:32:48','2024-05-04 13:32:48',NULL,NULL),(40,1,1,65,2,'2024-05-05 08:50:00','2024-05-05 09:30:00','2024-05-04 13:58:07','2024-05-04 13:58:07',4,NULL),(41,1,1,65,2,'2024-05-05 08:50:00','2024-05-05 09:30:00','2024-05-04 14:22:10','2024-05-04 14:22:10',4,'BMW 1000RR'),(42,1,1,68,1,'2024-05-05 11:30:00','2024-05-05 12:30:00','2024-05-04 14:29:37','2024-05-04 14:29:37',0,'Kawasaki Z750'),(43,1,1,68,3,'2024-05-05 10:20:00','2024-05-05 11:20:00','2024-05-04 14:31:57','2024-05-04 14:31:57',7,'Kawasaki H2R'),(44,1,1,68,16,'2024-05-05 15:00:00','2024-05-05 18:20:00','2024-05-04 14:33:04','2024-05-04 14:33:04',7,'Norton F1'),(46,1,2,1,2,'2024-05-04 08:50:00','2024-05-04 09:30:00','2024-05-04 15:24:41','2024-05-04 15:24:41',7,'Tula'),(47,1,4,1,15,'2024-05-05 13:10:00','2024-05-05 18:10:00','2024-05-04 15:31:48','2024-05-04 15:31:48',7,'GSX-R'),(48,1,2,69,5,'2024-05-05 08:00:00','2024-05-05 08:20:00','2024-05-04 15:50:36','2024-05-04 15:50:36',0,'Honda Dio');
/*!40000 ALTER TABLE `work_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name_of_work` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `time_for_work` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works`
--

LOCK TABLES `works` WRITE;
/*!40000 ALTER TABLE `works` DISABLE KEYS */;
INSERT INTO `works` VALUES (1,'Повна діагностика','Прям реально повна',1200,60,'2024-04-21 17:22:06','2024-04-21 17:22:06'),(2,'Шиномонтаж','Заміна шин,балансування ',300,40,'2024-04-22 20:59:45','2024-04-22 20:59:45'),(3,'Чистка карбюратора','Чистка в ультразвуковій ванні, заміна жиклерів за необхідністю при налаштуванні',400,60,'2024-04-22 20:59:45','2024-04-22 20:59:45'),(4,'Чистка паливної магістралі','Чистка паливного баку, заміна фільтрів, діагностика насосу, чистка інжектора',1200,120,'2024-04-22 20:59:45','2024-04-22 20:59:45'),(5,'Зварювальні роботи','Званювання аргоном, чи вуглекислотою',200,20,'2024-04-22 20:59:45','2024-04-22 20:59:45'),(6,'Заміна сальників вилки','Повне то вашої пеедньої підвіски, заміна масла, сальників ',1000,180,'2024-04-22 20:59:45','2024-04-22 20:59:45'),(7,'Регулювання клапанів','Ціна регулювання залежить від кількості клапанів і важкості доступу',300,60,'2024-04-22 20:59:45','2024-04-22 20:59:45'),(8,'Ремонт коробки передач','Ремонт коробки перевірка на стенді ',5000,480,'2024-04-22 21:01:46','2024-04-22 21:01:46'),(9,'Ремонт задньої підвіски','замані сальнків підшипників',1000,300,'2024-04-22 21:06:00','2024-04-22 21:06:00'),(10,'Ремонт гальмівної системи','Ремонт гальмівних супортів',1200,240,'2024-04-22 21:06:00','2024-04-22 21:06:00'),(11,'Передсезонне ТО','Замана гальмівних калодок, заміна масла, фільтра масляного, фільтра повітряного ',800,180,'2024-04-22 21:06:00','2024-04-22 21:06:00'),(12,'Електика','Заміна лампочок перевірка концевиків',100,30,'2024-04-22 21:12:33','2024-04-22 21:12:33'),(13,'Електрика','модифікація створення коригування будь якого єлектричного вузла',500,60,'2024-04-22 21:12:33','2024-04-22 21:12:33'),(14,'Компєютерна діагностика','Перевірка сканаером або осцилографом',500,30,'2024-04-22 21:12:33','2024-04-22 21:12:33'),(15,'Фарбування','Барбування як одної деталі так і всього мотоцикла',200,300,'2024-04-22 21:14:44','2024-04-22 21:14:44'),(16,'Токарні і фрезерні роботи','Відновлення двигуна, форсування, чи розточка ЦПГ',1000,200,'2024-04-22 21:14:44','2024-04-22 21:14:44');
/*!40000 ALTER TABLE `works` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-04 18:59:05
