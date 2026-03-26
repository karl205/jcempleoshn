CREATE DATABASE  IF NOT EXISTS `jcempleoshn` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `jcempleoshn`;
-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: jcempleoshn
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(500) NOT NULL,
  `tamaño_bytes` bigint(20) unsigned DEFAULT NULL,
  `tipo` varchar(50) NOT NULL COMMENT 'manual, automatico',
  `estado` varchar(50) NOT NULL COMMENT 'exitoso, fallido',
  `mensaje_error` text DEFAULT NULL,
  `duracion_segundos` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_usuario` (`usuario_id`),
  KEY `idx_tipo` (`tipo`),
  KEY `idx_estado` (`estado`),
  CONSTRAINT `fk_backups_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bitacora` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `modulo` varchar(100) NOT NULL COMMENT 'Ej: usuarios, testimonios, plazas',
  `accion` varchar(100) NOT NULL COMMENT 'crear, actualizar, eliminar, aprobar',
  `descripcion` text DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `navegador` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_usuario` (`usuario_id`),
  KEY `idx_modulo` (`modulo`),
  KEY `idx_fecha` (`created_at`),
  CONSTRAINT `fk_bitacora_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=404 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
INSERT INTO `bitacora` VALUES (1,1,'usuarios','crear','Se creó el usuario ID 2',NULL,NULL,'2026-02-21 08:29:54'),(2,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-21 08:42:40'),(3,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-21 08:43:27'),(4,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-21 08:47:27'),(11,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-21 08:58:02'),(12,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-21 08:59:25'),(13,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-21 09:05:54'),(14,1,'autenticacion','bloqueo','Usuario bloqueado por intentos fallidos',NULL,NULL,'2026-02-21 09:07:14'),(15,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 05:48:08'),(16,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 08:00:42'),(17,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 08:01:16'),(18,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 22:55:36'),(19,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 22:56:20'),(20,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:13:12'),(21,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:34:06'),(22,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:48:51'),(23,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:50:39'),(24,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:53:21'),(25,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:53:27'),(26,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:54:07'),(27,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:54:34'),(28,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:58:29'),(29,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-22 23:58:50'),(30,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:00:10'),(31,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:06:08'),(32,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:15:48'),(33,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:18:16'),(34,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:18:20'),(35,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:20:08'),(36,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:20:21'),(37,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:20:28'),(38,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:20:47'),(39,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:22:27'),(40,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:23:13'),(41,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:27:29'),(42,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-02-23 00:33:08'),(43,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-02-23 00:33:39'),(44,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-02-23 00:33:42'),(45,1,'usuarios','crear','Se creó usuario ID 3 y su perfil asociado',NULL,NULL,'2026-03-02 00:24:09'),(46,1,'usuarios','crear','Se creó usuario ID 4 y su perfil asociado',NULL,NULL,'2026-03-02 00:35:13'),(47,1,'usuarios','crear','Se creó usuario ID 5 y su perfil asociado',NULL,NULL,'2026-03-02 00:49:20'),(48,1,'usuarios','crear','Se creó usuario ID 6 y su perfil asociado',NULL,NULL,'2026-03-02 02:49:21'),(49,6,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-02 02:50:48'),(50,6,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-02 02:50:59'),(51,6,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-02 03:24:31'),(52,6,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-02 03:24:38'),(53,1,'usuarios','crear','Se creó usuario ID 7 y su perfil asociado',NULL,NULL,'2026-03-02 03:25:02'),(54,1,'usuarios','crear','Se creó usuario ID 8 y su perfil asociado',NULL,NULL,'2026-03-02 03:39:02'),(55,6,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-02 04:00:39'),(56,6,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-02 04:00:43'),(57,8,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-02 04:31:26'),(58,8,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-02 04:31:29'),(59,1,'usuarios','crear','Se creó usuario ID 9 y su perfil asociado',NULL,NULL,'2026-03-06 06:45:40'),(60,1,'usuarios','crear','Se creó usuario ID 10 y su perfil asociado',NULL,NULL,'2026-03-06 06:49:49'),(61,1,'usuarios','crear','Se creó usuario ID 11 y su perfil asociado',NULL,NULL,'2026-03-06 06:54:47'),(62,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 06:57:17'),(63,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 06:57:21'),(64,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 06:58:20'),(65,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 06:58:24'),(66,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 08:58:02'),(67,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 08:58:41'),(68,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 09:00:21'),(69,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 09:03:34'),(70,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 09:03:47'),(71,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 09:30:24'),(72,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 09:30:36'),(73,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 09:33:10'),(74,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 09:33:19'),(75,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 09:33:33'),(76,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 09:33:43'),(77,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 09:36:27'),(78,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 09:36:37'),(79,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-06 10:17:31'),(80,1,'usuarios','actualizar','Se actualizó el usuario ID 8',NULL,NULL,'2026-03-06 10:21:42'),(81,1,'usuarios','actualizar','Se actualizó el usuario ID 8',NULL,NULL,'2026-03-06 10:21:48'),(82,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-06 10:26:31'),(83,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 03:04:26'),(84,1,'usuarios','actualizar','Se actualizó el usuario ID 8',NULL,NULL,'2026-03-07 03:12:50'),(85,1,'usuarios','actualizar','Se actualizó el usuario ID 8',NULL,NULL,'2026-03-07 03:13:02'),(86,1,'usuarios','actualizar','Se actualizó el usuario ID 8',NULL,NULL,'2026-03-07 03:13:10'),(87,1,'usuarios','actualizar','Se actualizó el usuario ID 8',NULL,NULL,'2026-03-07 03:26:26'),(88,1,'usuarios','crear','Se creó usuario ID 12 y su perfil asociado',NULL,NULL,'2026-03-07 03:29:08'),(89,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 03:42:10'),(90,1,'usuarios','actualizar','Se actualizó el usuario ID 1',NULL,NULL,'2026-03-07 03:42:24'),(91,1,'usuarios','crear','Se creó usuario ID 13 y su perfil asociado',NULL,NULL,'2026-03-07 03:42:49'),(92,1,'usuarios','actualizar','Se actualizó el usuario ID 1',NULL,NULL,'2026-03-07 03:43:18'),(93,1,'usuarios','actualizar','Se actualizó el usuario ID 1',NULL,NULL,'2026-03-07 03:49:18'),(94,1,'usuarios','desactivar','Se desactivó el usuario ID 13',NULL,NULL,'2026-03-07 03:50:49'),(95,1,'usuarios','actualizar','Se actualizó el usuario ID 13',NULL,NULL,'2026-03-07 03:50:56'),(96,1,'usuarios','crear','Se creó usuario ID 14 y su perfil asociado',NULL,NULL,'2026-03-07 03:51:13'),(97,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 04:13:06'),(98,1,'usuarios','actualizar','Se actualizó el usuario ID 13',NULL,NULL,'2026-03-07 04:13:18'),(99,1,'usuarios','desactivar','Se desactivó el usuario ID 13',NULL,NULL,'2026-03-07 04:13:28'),(100,1,'usuarios','actualizar','Se actualizó el usuario ID 13',NULL,NULL,'2026-03-07 04:13:35'),(101,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 04:45:05'),(102,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-07 05:14:46'),(103,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 05:14:55'),(104,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 05:16:36'),(105,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-07 05:19:20'),(106,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 05:19:28'),(107,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-07 05:23:23'),(108,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 05:27:40'),(109,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 06:07:45'),(110,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 06:44:39'),(111,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 07:26:05'),(112,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-07 07:46:54'),(113,1,'usuarios','crear','Se creó usuario ID 15 y su perfil asociado',NULL,NULL,'2026-03-07 07:47:25'),(114,15,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 07:48:34'),(115,15,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-07 07:48:45'),(116,15,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 07:49:39'),(117,15,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-07 07:49:48'),(118,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-07 07:50:06'),(119,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-07 07:50:18'),(120,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-08 21:11:59'),(121,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-08 21:50:26'),(122,1,'usuarios','actualizar','Se actualizó el usuario ID 6',NULL,NULL,'2026-03-08 22:04:01'),(123,1,'usuarios','actualizar','Se actualizó el usuario ID 12',NULL,NULL,'2026-03-08 22:04:09'),(124,1,'usuarios','actualizar','Se actualizó el usuario ID 12',NULL,NULL,'2026-03-08 22:04:17'),(125,1,'usuarios','actualizar','Se actualizó el usuario ID 12',NULL,NULL,'2026-03-08 22:04:34'),(126,1,'usuarios','actualizar','Se actualizó el usuario ID 1',NULL,NULL,'2026-03-08 22:05:02'),(127,1,'usuarios','actualizar','Se actualizó el usuario ID 1',NULL,NULL,'2026-03-08 22:05:07'),(128,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:05:15'),(129,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:05:20'),(130,1,'usuarios','actualizar','Se actualizó el usuario ID 8',NULL,NULL,'2026-03-08 22:05:39'),(131,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:12:02'),(132,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:12:34'),(133,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:13:01'),(134,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:19:42'),(135,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:20:02'),(136,1,'usuarios','actualizar','Se actualizó el usuario ID 5',NULL,NULL,'2026-03-08 22:20:11'),(137,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-08 22:49:30'),(138,1,'usuarios','actualizar','Se actualizó el usuario ID 6',NULL,NULL,'2026-03-08 22:49:42'),(139,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:50:10'),(140,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:55:23'),(141,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:55:43'),(142,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:57:31'),(143,1,'usuarios','actualizar','Se actualizó el usuario ID 5',NULL,NULL,'2026-03-08 22:57:55'),(144,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 22:58:04'),(145,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 23:00:17'),(146,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 23:01:55'),(147,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 23:04:03'),(148,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 23:05:25'),(149,1,'usuarios','actualizar','Se actualizó el usuario ID 2',NULL,NULL,'2026-03-08 23:09:43'),(150,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-08 23:19:06'),(151,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-08 23:19:20'),(152,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-08 23:19:26'),(153,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-08 23:20:02'),(154,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-08 23:26:09'),(155,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-08 23:26:21'),(156,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-08 23:27:33'),(157,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 00:28:44'),(158,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 00:29:07'),(159,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 00:29:59'),(160,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 00:31:04'),(161,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 00:31:13'),(162,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 00:32:10'),(163,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 00:32:19'),(164,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 00:33:00'),(165,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 00:33:09'),(166,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 00:33:17'),(167,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 00:33:26'),(168,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 00:59:37'),(169,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 00:59:51'),(170,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:00:03'),(171,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:00:19'),(172,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:00:53'),(173,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:01:05'),(174,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:01:32'),(175,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:01:58'),(176,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:05:34'),(177,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:05:56'),(178,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:06:49'),(179,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:07:01'),(180,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:15:13'),(181,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:15:25'),(182,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:16:17'),(183,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:16:35'),(184,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:19:39'),(185,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:19:52'),(186,1,'usuarios','desactivar','Se desactivó el usuario ID 2',NULL,NULL,'2026-03-09 01:22:00'),(187,1,'usuarios','desactivar','Se desactivó el usuario ID 5',NULL,NULL,'2026-03-09 01:23:30'),(188,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:30:01'),(189,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:30:13'),(190,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:32:09'),(191,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:32:20'),(192,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:32:27'),(193,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:33:20'),(194,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:33:26'),(195,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-09 01:33:36'),(196,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-09 01:33:42'),(197,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-13 05:56:11'),(198,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-13 05:56:59'),(199,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-13 06:16:06'),(200,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-13 06:33:42'),(201,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-13 06:33:55'),(202,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-13 06:45:53'),(203,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-13 06:46:12'),(204,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-13 07:35:56'),(205,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-13 08:08:46'),(206,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-13 08:20:32'),(207,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-13 08:20:47'),(208,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-15 23:52:39'),(209,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-16 00:24:49'),(210,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-16 02:07:34'),(211,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-16 02:14:25'),(212,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-16 02:14:35'),(213,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-16 02:15:02'),(214,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-16 02:15:12'),(215,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-16 02:15:56'),(216,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-16 02:16:05'),(217,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-16 02:17:04'),(218,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 06:24:49'),(219,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-22 06:24:56'),(220,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 06:25:03'),(221,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-22 06:25:33'),(222,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 06:25:38'),(223,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-22 06:25:54'),(224,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 06:25:58'),(225,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-22 06:26:03'),(226,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 06:26:08'),(227,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-22 06:26:43'),(228,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 06:26:49'),(229,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 20:44:37'),(230,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-22 20:47:16'),(231,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 20:48:43'),(232,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 21:39:03'),(233,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-22 21:39:40'),(234,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-22 23:48:26'),(235,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-23 01:12:09'),(236,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-23 01:27:01'),(237,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-23 01:30:48'),(238,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-23 01:50:27'),(239,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-23 02:02:38'),(240,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-23 02:08:40'),(241,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-23 02:34:13'),(242,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 04:17:06'),(243,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 06:03:09'),(244,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-24 06:11:19'),(245,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 06:11:23'),(246,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 06:46:37'),(247,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 06:51:07'),(248,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 06:58:58'),(249,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 06:59:36'),(250,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 07:18:36'),(251,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 07:37:46'),(252,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 07:37:56'),(253,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 07:38:12'),(254,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 07:38:19'),(255,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 07:38:33'),(256,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 07:43:41'),(257,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 07:44:03'),(258,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-24 07:44:43'),(259,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 08:23:54'),(260,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-24 08:24:09'),(261,1,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 08:24:14'),(262,1,'usuarios','desactivar','Se desactivó el usuario ID 12',NULL,NULL,'2026-03-24 08:29:37'),(263,1,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-24 08:30:13'),(264,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-24 08:30:31'),(265,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-24 08:30:50'),(266,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-24 08:30:56'),(267,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 07:09:49'),(268,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 07:24:24'),(269,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 07:30:38'),(270,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 07:31:16'),(271,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 07:31:40'),(272,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 07:36:08'),(273,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 07:36:22'),(274,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 08:02:02'),(275,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:02:20'),(276,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:02:31'),(277,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:02:42'),(278,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:02:56'),(279,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:04:03'),(280,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:09:51'),(281,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:24:33'),(282,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:24:51'),(283,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:25:02'),(284,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:25:23'),(285,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:25:29'),(286,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:25:35'),(287,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:29:38'),(288,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:29:49'),(289,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:29:55'),(290,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:30:08'),(291,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:31:38'),(292,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 08:35:08'),(293,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:35:33'),(294,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:37:25'),(295,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:37:34'),(296,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:37:48'),(297,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:45:06'),(298,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:45:34'),(299,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:52:25'),(300,11,'perfil_educacion','agregar','Agregó educación ID 27',NULL,NULL,'2026-03-26 08:52:26'),(301,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:52:50'),(302,11,'perfil_educacion','agregar','Agregó educación ID 28',NULL,NULL,'2026-03-26 08:52:51'),(303,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:52:59'),(304,11,'perfil_educacion','agregar','Agregó educación ID 29',NULL,NULL,'2026-03-26 08:53:00'),(305,11,'perfil_idioma','agregar','Agregó idioma ID 51',NULL,NULL,'2026-03-26 08:53:01'),(306,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:53:09'),(307,11,'perfil_educacion','agregar','Agregó educación ID 30',NULL,NULL,'2026-03-26 08:53:10'),(308,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:53:36'),(309,11,'perfil_educacion','agregar','Agregó educación ID 31',NULL,NULL,'2026-03-26 08:53:37'),(310,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:53:45'),(311,11,'perfil_educacion','agregar','Agregó educación ID 32',NULL,NULL,'2026-03-26 08:53:46'),(312,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:54:03'),(313,11,'perfil_educacion','agregar','Agregó educación ID 33',NULL,NULL,'2026-03-26 08:54:04'),(314,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-26 08:54:35'),(315,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 08:54:40'),(316,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:54:52'),(317,11,'perfil_educacion','agregar','Agregó educación ID 34',NULL,NULL,'2026-03-26 08:54:53'),(318,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:56:21'),(319,11,'perfil_idioma','agregar','Agregó idioma ID 52',NULL,NULL,'2026-03-26 08:56:22'),(320,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 08:57:54'),(321,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-26 09:12:19'),(322,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 09:12:24'),(323,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 09:27:19'),(324,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 09:34:11'),(325,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 09:45:43'),(326,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 09:54:25'),(327,11,'perfil_educacion','actualizar','Actualizó educación ID 27',NULL,NULL,'2026-03-26 09:54:26'),(328,11,'perfil_educacion','actualizar','Actualizó educación ID 28',NULL,NULL,'2026-03-26 09:54:27'),(329,11,'perfil_educacion','actualizar','Actualizó educación ID 29',NULL,NULL,'2026-03-26 09:54:28'),(330,11,'perfil_educacion','actualizar','Actualizó educación ID 30',NULL,NULL,'2026-03-26 09:54:29'),(331,11,'perfil_educacion','actualizar','Actualizó educación ID 31',NULL,NULL,'2026-03-26 09:54:30'),(332,11,'perfil_educacion','actualizar','Actualizó educación ID 32',NULL,NULL,'2026-03-26 09:54:31'),(333,11,'perfil_educacion','actualizar','Actualizó educación ID 33',NULL,NULL,'2026-03-26 09:54:32'),(334,11,'perfil_educacion','actualizar','Actualizó educación ID 34',NULL,NULL,'2026-03-26 09:54:33'),(335,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 09:54:50'),(336,11,'perfil_educacion','actualizar','Actualizó educación ID 27',NULL,NULL,'2026-03-26 09:54:51'),(337,11,'perfil_educacion','actualizar','Actualizó educación ID 28',NULL,NULL,'2026-03-26 09:54:52'),(338,11,'perfil_educacion','actualizar','Actualizó educación ID 29',NULL,NULL,'2026-03-26 09:54:53'),(339,11,'perfil_educacion','actualizar','Actualizó educación ID 30',NULL,NULL,'2026-03-26 09:54:54'),(340,11,'perfil_educacion','actualizar','Actualizó educación ID 31',NULL,NULL,'2026-03-26 09:54:55'),(341,11,'perfil_educacion','actualizar','Actualizó educación ID 32',NULL,NULL,'2026-03-26 09:54:56'),(342,11,'perfil_educacion','actualizar','Actualizó educación ID 33',NULL,NULL,'2026-03-26 09:54:58'),(343,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-26 09:55:12'),(344,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 09:55:15'),(345,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-26 09:56:10'),(346,11,'autenticacion','login','Inicio de sesión exitoso',NULL,NULL,'2026-03-26 09:56:15'),(347,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 09:56:34'),(348,11,'perfil_educacion','actualizar','Actualizó educación ID 27',NULL,NULL,'2026-03-26 09:56:35'),(349,11,'perfil_educacion','actualizar','Actualizó educación ID 28',NULL,NULL,'2026-03-26 09:56:36'),(350,11,'perfil_educacion','actualizar','Actualizó educación ID 29',NULL,NULL,'2026-03-26 09:56:37'),(351,11,'perfil_educacion','actualizar','Actualizó educación ID 30',NULL,NULL,'2026-03-26 09:56:38'),(352,11,'perfil_educacion','actualizar','Actualizó educación ID 31',NULL,NULL,'2026-03-26 09:56:39'),(353,11,'perfil_educacion','actualizar','Actualizó educación ID 32',NULL,NULL,'2026-03-26 09:56:40'),(354,11,'perfil_educacion','actualizar','Actualizó educación ID 33',NULL,NULL,'2026-03-26 09:56:41'),(355,11,'perfil_educacion','actualizar','Actualizó educación ID 34',NULL,NULL,'2026-03-26 09:56:42'),(356,11,'perfil_educacion','agregar','Agregó educación ID 35',NULL,NULL,'2026-03-26 09:56:44'),(357,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 09:57:10'),(358,11,'perfil_educacion','actualizar','Actualizó educación ID 27',NULL,NULL,'2026-03-26 09:57:10'),(359,11,'perfil_educacion','actualizar','Actualizó educación ID 28',NULL,NULL,'2026-03-26 09:57:12'),(360,11,'perfil_educacion','actualizar','Actualizó educación ID 29',NULL,NULL,'2026-03-26 09:57:13'),(361,11,'perfil_educacion','actualizar','Actualizó educación ID 30',NULL,NULL,'2026-03-26 09:57:14'),(362,11,'perfil_educacion','actualizar','Actualizó educación ID 31',NULL,NULL,'2026-03-26 09:57:15'),(363,11,'perfil_educacion','actualizar','Actualizó educación ID 32',NULL,NULL,'2026-03-26 09:57:16'),(364,11,'perfil_educacion','actualizar','Actualizó educación ID 33',NULL,NULL,'2026-03-26 09:57:17'),(365,11,'perfil_educacion','actualizar','Actualizó educación ID 34',NULL,NULL,'2026-03-26 09:57:18'),(366,11,'perfil_educacion','agregar','Agregó educación ID 36',NULL,NULL,'2026-03-26 09:57:19'),(367,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 10:24:19'),(368,11,'perfil_educacion','actualizar','Actualizó educación ID 27',NULL,NULL,'2026-03-26 10:24:20'),(369,11,'perfil_educacion','actualizar','Actualizó educación ID 35',NULL,NULL,'2026-03-26 10:24:21'),(370,11,'perfil_educacion','actualizar','Actualizó educación ID 34',NULL,NULL,'2026-03-26 10:24:22'),(371,11,'perfil_educacion','actualizar','Actualizó educación ID 33',NULL,NULL,'2026-03-26 10:24:23'),(372,11,'perfil_educacion','actualizar','Actualizó educación ID 32',NULL,NULL,'2026-03-26 10:24:24'),(373,11,'perfil_educacion','actualizar','Actualizó educación ID 31',NULL,NULL,'2026-03-26 10:24:25'),(374,11,'perfil_educacion','actualizar','Actualizó educación ID 30',NULL,NULL,'2026-03-26 10:24:27'),(375,11,'perfil_educacion','actualizar','Actualizó educación ID 29',NULL,NULL,'2026-03-26 10:24:28'),(376,11,'perfil_educacion','actualizar','Actualizó educación ID 28',NULL,NULL,'2026-03-26 10:24:29'),(377,11,'perfil_educacion','actualizar','Actualizó educación ID 36',NULL,NULL,'2026-03-26 10:24:30'),(378,11,'perfil_idioma','actualizar','Actualizó idioma ID 52',NULL,NULL,'2026-03-26 10:24:31'),(379,11,'perfil_idioma','actualizar','Actualizó idioma ID 51',NULL,NULL,'2026-03-26 10:24:32'),(380,11,'perfil_experiencia','agregar','Agregó experiencia ID 2',NULL,NULL,'2026-03-26 10:24:33'),(381,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 10:25:07'),(382,11,'perfil_educacion','actualizar','Actualizó educación ID 27',NULL,NULL,'2026-03-26 10:25:08'),(383,11,'perfil_educacion','actualizar','Actualizó educación ID 35',NULL,NULL,'2026-03-26 10:25:09'),(384,11,'perfil_educacion','actualizar','Actualizó educación ID 34',NULL,NULL,'2026-03-26 10:25:10'),(385,11,'perfil_idioma','actualizar','Actualizó idioma ID 52',NULL,NULL,'2026-03-26 10:25:11'),(386,11,'perfil_idioma','actualizar','Actualizó idioma ID 51',NULL,NULL,'2026-03-26 10:25:12'),(387,11,'perfil_experiencia','actualizar','Actualizó experiencia ID 2',NULL,NULL,'2026-03-26 10:25:13'),(388,11,'perfiles','actualizar','Actualizó su perfil',NULL,NULL,'2026-03-26 10:25:31'),(389,11,'perfil_educacion','actualizar','Actualizó educación ID 27',NULL,NULL,'2026-03-26 10:25:32'),(390,11,'perfil_educacion','actualizar','Actualizó educación ID 35',NULL,NULL,'2026-03-26 10:25:34'),(391,11,'perfil_educacion','actualizar','Actualizó educación ID 34',NULL,NULL,'2026-03-26 10:25:35'),(392,11,'perfil_educacion','actualizar','Actualizó educación ID 33',NULL,NULL,'2026-03-26 10:25:36'),(393,11,'perfil_educacion','actualizar','Actualizó educación ID 32',NULL,NULL,'2026-03-26 10:25:37'),(394,11,'perfil_educacion','actualizar','Actualizó educación ID 31',NULL,NULL,'2026-03-26 10:25:38'),(395,11,'perfil_educacion','actualizar','Actualizó educación ID 30',NULL,NULL,'2026-03-26 10:25:40'),(396,11,'perfil_educacion','actualizar','Actualizó educación ID 29',NULL,NULL,'2026-03-26 10:25:41'),(397,11,'perfil_educacion','actualizar','Actualizó educación ID 28',NULL,NULL,'2026-03-26 10:25:42'),(398,11,'perfil_educacion','actualizar','Actualizó educación ID 36',NULL,NULL,'2026-03-26 10:25:43'),(399,11,'perfil_idioma','actualizar','Actualizó idioma ID 52',NULL,NULL,'2026-03-26 10:25:44'),(400,11,'perfil_idioma','actualizar','Actualizó idioma ID 51',NULL,NULL,'2026-03-26 10:25:45'),(401,11,'perfil_idioma','agregar','Agregó idioma ID 53',NULL,NULL,'2026-03-26 10:25:47'),(402,11,'perfil_experiencia','actualizar','Actualizó experiencia ID 2',NULL,NULL,'2026-03-26 10:25:48'),(403,11,'autenticacion','logout','Usuario cerró sesión',NULL,NULL,'2026-03-26 10:26:01');
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_actividades_laborales`
--

DROP TABLE IF EXISTS `cat_actividades_laborales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_actividades_laborales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_actividades_laborales`
--

LOCK TABLES `cat_actividades_laborales` WRITE;
/*!40000 ALTER TABLE `cat_actividades_laborales` DISABLE KEYS */;
INSERT INTO `cat_actividades_laborales` VALUES (1,'Banca',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(2,'Retail',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(3,'Educación',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(4,'Salud',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(5,'Tecnología',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(6,'Construcción',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(7,'Industria',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(8,'Logística',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(9,'Turismo',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(10,'Telecomunicaciones',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(11,'Servicios',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(12,'Finanzas',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(13,'Seguros',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(14,'Marketing',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(15,'E-commerce',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(16,'Transporte',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(17,'Energía',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(18,'Agricultura',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(19,'Ganadería',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(20,'Pesca',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(21,'Minería',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(22,'ONG',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(23,'Gobierno',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(24,'Startup',1,'2026-03-22 23:22:47','2026-03-22 23:22:47'),(25,'Consultoría',1,'2026-03-22 23:22:47','2026-03-22 23:22:47');
/*!40000 ALTER TABLE `cat_actividades_laborales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_areas_estudio`
--

DROP TABLE IF EXISTS `cat_areas_estudio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_areas_estudio` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_area_nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_areas_estudio`
--

LOCK TABLES `cat_areas_estudio` WRITE;
/*!40000 ALTER TABLE `cat_areas_estudio` DISABLE KEYS */;
/*!40000 ALTER TABLE `cat_areas_estudio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_cargos_laborales`
--

DROP TABLE IF EXISTS `cat_cargos_laborales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_cargos_laborales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `categoria_laboral_id` bigint(20) unsigned NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cargo_categoria` (`nombre`,`categoria_laboral_id`),
  KEY `idx_categoria_laboral` (`categoria_laboral_id`),
  CONSTRAINT `fk_cargos_categoria` FOREIGN KEY (`categoria_laboral_id`) REFERENCES `cat_categorias_laborales` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_cargos_laborales`
--

LOCK TABLES `cat_cargos_laborales` WRITE;
/*!40000 ALTER TABLE `cat_cargos_laborales` DISABLE KEYS */;
INSERT INTO `cat_cargos_laborales` VALUES (1,'Gerente',1,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(2,'Subgerente',1,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(3,'Asistente Administrativo',1,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(4,'Coordinador Administrativo',1,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(5,'Recepcionista',1,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(6,'Desarrollador Backend',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(7,'Desarrollador Frontend',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(8,'Full Stack',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(9,'QA Tester',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(10,'DevOps',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(11,'Soporte TI',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(12,'Administrador de Redes',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(13,'Data Analyst',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(14,'Cybersecurity Analyst',2,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(15,'Ejecutivo de Ventas',3,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(16,'Vendedor',3,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(17,'Supervisor de Ventas',3,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(18,'Gerente Comercial',3,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(19,'Telemarketing',3,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(20,'Médico General',4,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(21,'Especialista',4,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(22,'Enfermero',4,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(23,'Auxiliar de Enfermería',4,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(24,'Farmacéutico',4,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(25,'Docente',5,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(26,'Profesor Universitario',5,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(27,'Instructor',5,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(28,'Tutor',5,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(29,'Coordinador Académico',5,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(30,'Ingeniero Civil',6,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(31,'Ingeniero Industrial',6,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(32,'Ingeniero Mecánico',6,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(33,'Ingeniero Eléctrico',6,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(34,'Ingeniero Químico',6,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(35,'Operario',7,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(36,'Técnico',7,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(37,'Supervisor de Planta',7,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(38,'Mecánico',7,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(39,'Electricista',7,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(40,'Call Center',8,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(41,'Atención al Cliente',8,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(42,'Soporte al Cliente',8,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(43,'Customer Success',8,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(44,'Contador',9,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(45,'Auxiliar Contable',9,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(46,'Analista Financiero',9,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(47,'Auditor',9,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(48,'Tesorería',9,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(49,'Community Manager',10,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(50,'SEO Specialist',10,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(51,'Content Manager',10,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(52,'Diseñador Gráfico',10,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(53,'Brand Manager',10,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(54,'Logística',11,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(55,'Encargado de Bodega',11,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(56,'Distribución',11,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(57,'Compras',11,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(58,'Supply Chain',11,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(59,'Abogado',12,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(60,'Asistente Legal',12,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(61,'Notario',12,1,'2026-03-22 23:22:40','2026-03-22 23:22:40'),(62,'Asesor Jurídico',12,1,'2026-03-22 23:22:40','2026-03-22 23:22:40');
/*!40000 ALTER TABLE `cat_cargos_laborales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_categorias_laborales`
--

DROP TABLE IF EXISTS `cat_categorias_laborales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_categorias_laborales` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_categoria_nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_categorias_laborales`
--

LOCK TABLES `cat_categorias_laborales` WRITE;
/*!40000 ALTER TABLE `cat_categorias_laborales` DISABLE KEYS */;
INSERT INTO `cat_categorias_laborales` VALUES (1,'Administración',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(2,'Tecnología',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(3,'Ventas',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(4,'Salud',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(5,'Educación',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(6,'Ingeniería',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(7,'Operativo',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(8,'Atención al cliente',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(9,'Finanzas',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(10,'Marketing',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(11,'Logística',1,'2026-03-22 23:22:34','2026-03-22 23:22:34'),(12,'Legal',1,'2026-03-22 23:22:34','2026-03-22 23:22:34');
/*!40000 ALTER TABLE `cat_categorias_laborales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_ciudades`
--

DROP TABLE IF EXISTS `cat_ciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_ciudades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `departamento_id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_ciudad_departamento` (`departamento_id`,`nombre`),
  KEY `idx_ciudades_departamento` (`departamento_id`),
  CONSTRAINT `fk_ciudades_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `cat_departamentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=297 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_ciudades`
--

LOCK TABLES `cat_ciudades` WRITE;
/*!40000 ALTER TABLE `cat_ciudades` DISABLE KEYS */;
INSERT INTO `cat_ciudades` VALUES (1,1,'La Ceiba','2026-03-22 22:10:16','2026-03-22 22:10:16'),(2,1,'Tela','2026-03-22 22:10:16','2026-03-22 22:10:16'),(3,1,'Jutiapa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(4,1,'La Masica','2026-03-22 22:10:16','2026-03-22 22:10:16'),(5,1,'El Porvenir','2026-03-22 22:10:16','2026-03-22 22:10:16'),(6,1,'San Francisco','2026-03-22 22:10:16','2026-03-22 22:10:16'),(7,1,'Arizona','2026-03-22 22:10:16','2026-03-22 22:10:16'),(8,1,'Esparta','2026-03-22 22:10:16','2026-03-22 22:10:16'),(9,2,'Choluteca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(10,2,'Apacilagua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(11,2,'Concepción de María','2026-03-22 22:10:16','2026-03-22 22:10:16'),(12,2,'Duyure','2026-03-22 22:10:16','2026-03-22 22:10:16'),(13,2,'El Corpus','2026-03-22 22:10:16','2026-03-22 22:10:16'),(14,2,'El Triunfo','2026-03-22 22:10:16','2026-03-22 22:10:16'),(15,2,'Marcovia','2026-03-22 22:10:16','2026-03-22 22:10:16'),(16,2,'Morolica','2026-03-22 22:10:16','2026-03-22 22:10:16'),(17,2,'Namasigüe','2026-03-22 22:10:16','2026-03-22 22:10:16'),(18,2,'Orocuina','2026-03-22 22:10:16','2026-03-22 22:10:16'),(19,2,'Pespire','2026-03-22 22:10:16','2026-03-22 22:10:16'),(20,2,'San Antonio de Flores','2026-03-22 22:10:16','2026-03-22 22:10:16'),(21,2,'San Isidro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(22,2,'San José','2026-03-22 22:10:16','2026-03-22 22:10:16'),(23,2,'San Marcos de Colón','2026-03-22 22:10:16','2026-03-22 22:10:16'),(24,2,'Santa Ana de Yusguare','2026-03-22 22:10:16','2026-03-22 22:10:16'),(25,3,'Trujillo','2026-03-22 22:10:16','2026-03-22 22:10:16'),(26,3,'Balfate','2026-03-22 22:10:16','2026-03-22 22:10:16'),(27,3,'Iriona','2026-03-22 22:10:16','2026-03-22 22:10:16'),(28,3,'Limón','2026-03-22 22:10:16','2026-03-22 22:10:16'),(29,3,'Sabá','2026-03-22 22:10:16','2026-03-22 22:10:16'),(30,3,'Santa Fe','2026-03-22 22:10:16','2026-03-22 22:10:16'),(31,3,'Santa Rosa de Aguán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(32,3,'Sonaguera','2026-03-22 22:10:16','2026-03-22 22:10:16'),(33,3,'Tocoa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(34,3,'Bonito Oriental','2026-03-22 22:10:16','2026-03-22 22:10:16'),(35,4,'Comayagua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(36,4,'Ajuterique','2026-03-22 22:10:16','2026-03-22 22:10:16'),(37,4,'El Rosario','2026-03-22 22:10:16','2026-03-22 22:10:16'),(38,4,'Esquías','2026-03-22 22:10:16','2026-03-22 22:10:16'),(39,4,'Humuya','2026-03-22 22:10:16','2026-03-22 22:10:16'),(40,4,'La Libertad','2026-03-22 22:10:16','2026-03-22 22:10:16'),(41,4,'Lamaní','2026-03-22 22:10:16','2026-03-22 22:10:16'),(42,4,'La Trinidad','2026-03-22 22:10:16','2026-03-22 22:10:16'),(43,4,'Lejamaní','2026-03-22 22:10:16','2026-03-22 22:10:16'),(44,4,'Meámbar','2026-03-22 22:10:16','2026-03-22 22:10:16'),(45,4,'Minas de Oro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(46,4,'Ojos de Agua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(47,4,'San Jerónimo','2026-03-22 22:10:16','2026-03-22 22:10:16'),(48,4,'San José de Comayagua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(49,4,'San José del Potrero','2026-03-22 22:10:16','2026-03-22 22:10:16'),(50,4,'San Luis','2026-03-22 22:10:16','2026-03-22 22:10:16'),(51,4,'San Sebastián','2026-03-22 22:10:16','2026-03-22 22:10:16'),(52,4,'Siguatepeque','2026-03-22 22:10:16','2026-03-22 22:10:16'),(53,4,'Villa de San Antonio','2026-03-22 22:10:16','2026-03-22 22:10:16'),(54,4,'Las Lajas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(55,4,'Taulabé','2026-03-22 22:10:16','2026-03-22 22:10:16'),(56,5,'Santa Rosa de Copán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(57,5,'Cabañas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(58,5,'Concepción','2026-03-22 22:10:16','2026-03-22 22:10:16'),(59,5,'Copán Ruinas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(60,5,'Corquín','2026-03-22 22:10:16','2026-03-22 22:10:16'),(61,5,'Cucuyagua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(62,5,'Dolores','2026-03-22 22:10:16','2026-03-22 22:10:16'),(63,5,'Dulce Nombre','2026-03-22 22:10:16','2026-03-22 22:10:16'),(64,5,'El Paraíso','2026-03-22 22:10:16','2026-03-22 22:10:16'),(65,5,'Florida','2026-03-22 22:10:16','2026-03-22 22:10:16'),(66,5,'La Jigua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(67,5,'La Unión','2026-03-22 22:10:16','2026-03-22 22:10:16'),(68,5,'Nueva Arcadia','2026-03-22 22:10:16','2026-03-22 22:10:16'),(69,5,'San Agustín','2026-03-22 22:10:16','2026-03-22 22:10:16'),(70,5,'San Antonio','2026-03-22 22:10:16','2026-03-22 22:10:16'),(71,5,'San Jerónimo','2026-03-22 22:10:16','2026-03-22 22:10:16'),(72,5,'San José','2026-03-22 22:10:16','2026-03-22 22:10:16'),(73,5,'San Juan de Opoa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(74,5,'San Nicolás','2026-03-22 22:10:16','2026-03-22 22:10:16'),(75,5,'San Pedro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(76,5,'Santa Rita','2026-03-22 22:10:16','2026-03-22 22:10:16'),(77,5,'Trinidad de Copán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(78,5,'Veracruz','2026-03-22 22:10:16','2026-03-22 22:10:16'),(79,6,'San Pedro Sula','2026-03-22 22:10:16','2026-03-22 22:10:16'),(80,6,'Choloma','2026-03-22 22:10:16','2026-03-22 22:10:16'),(81,6,'Omoa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(82,6,'Pimienta','2026-03-22 22:10:16','2026-03-22 22:10:16'),(83,6,'Potrerillos','2026-03-22 22:10:16','2026-03-22 22:10:16'),(84,6,'Puerto Cortés','2026-03-22 22:10:16','2026-03-22 22:10:16'),(85,6,'San Antonio de Cortés','2026-03-22 22:10:16','2026-03-22 22:10:16'),(86,6,'San Francisco de Yojoa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(87,6,'San Manuel','2026-03-22 22:10:16','2026-03-22 22:10:16'),(88,6,'Santa Cruz de Yojoa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(89,6,'Villanueva','2026-03-22 22:10:16','2026-03-22 22:10:16'),(90,6,'La Lima','2026-03-22 22:10:16','2026-03-22 22:10:16'),(91,7,'Yuscarán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(92,7,'Alauca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(93,7,'Danlí','2026-03-22 22:10:16','2026-03-22 22:10:16'),(94,7,'El Paraíso','2026-03-22 22:10:16','2026-03-22 22:10:16'),(95,7,'Güinope','2026-03-22 22:10:16','2026-03-22 22:10:16'),(96,7,'Jacaleapa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(97,7,'Liure','2026-03-22 22:10:16','2026-03-22 22:10:16'),(98,7,'Morocelí','2026-03-22 22:10:16','2026-03-22 22:10:16'),(99,7,'Oropolí','2026-03-22 22:10:16','2026-03-22 22:10:16'),(100,7,'Potrerillos','2026-03-22 22:10:16','2026-03-22 22:10:16'),(101,7,'San Antonio de Flores','2026-03-22 22:10:16','2026-03-22 22:10:16'),(102,7,'San Lucas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(103,7,'San Matías','2026-03-22 22:10:16','2026-03-22 22:10:16'),(104,7,'Soledad','2026-03-22 22:10:16','2026-03-22 22:10:16'),(105,7,'Teupasenti','2026-03-22 22:10:16','2026-03-22 22:10:16'),(106,7,'Texiguat','2026-03-22 22:10:16','2026-03-22 22:10:16'),(107,7,'Vado Ancho','2026-03-22 22:10:16','2026-03-22 22:10:16'),(108,7,'Yauyupe','2026-03-22 22:10:16','2026-03-22 22:10:16'),(109,7,'Trojes','2026-03-22 22:10:16','2026-03-22 22:10:16'),(110,8,'Distrito Central','2026-03-22 22:10:16','2026-03-22 22:10:16'),(111,8,'Alubarén','2026-03-22 22:10:16','2026-03-22 22:10:16'),(112,8,'Cedros','2026-03-22 22:10:16','2026-03-22 22:10:16'),(113,8,'Curarén','2026-03-22 22:10:16','2026-03-22 22:10:16'),(114,8,'El Porvenir','2026-03-22 22:10:16','2026-03-22 22:10:16'),(115,8,'Guaimaca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(116,8,'La Libertad','2026-03-22 22:10:16','2026-03-22 22:10:16'),(117,8,'La Venta','2026-03-22 22:10:16','2026-03-22 22:10:16'),(118,8,'Lepaterique','2026-03-22 22:10:16','2026-03-22 22:10:16'),(119,8,'Maraita','2026-03-22 22:10:16','2026-03-22 22:10:16'),(120,8,'Marale','2026-03-22 22:10:16','2026-03-22 22:10:16'),(121,8,'Nueva Armenia','2026-03-22 22:10:16','2026-03-22 22:10:16'),(122,8,'Ojojona','2026-03-22 22:10:16','2026-03-22 22:10:16'),(123,8,'Orica','2026-03-22 22:10:16','2026-03-22 22:10:16'),(124,8,'Reitoca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(125,8,'Sabanagrande','2026-03-22 22:10:16','2026-03-22 22:10:16'),(126,8,'San Antonio de Oriente','2026-03-22 22:10:16','2026-03-22 22:10:16'),(127,8,'San Buenaventura','2026-03-22 22:10:16','2026-03-22 22:10:16'),(128,8,'San Ignacio','2026-03-22 22:10:16','2026-03-22 22:10:16'),(129,8,'San Juan de Flores','2026-03-22 22:10:16','2026-03-22 22:10:16'),(130,8,'San Miguelito','2026-03-22 22:10:16','2026-03-22 22:10:16'),(131,8,'Santa Ana','2026-03-22 22:10:16','2026-03-22 22:10:16'),(132,8,'Santa Lucía','2026-03-22 22:10:16','2026-03-22 22:10:16'),(133,8,'Talanga','2026-03-22 22:10:16','2026-03-22 22:10:16'),(134,8,'Tatumbla','2026-03-22 22:10:16','2026-03-22 22:10:16'),(135,8,'Valle de Ángeles','2026-03-22 22:10:16','2026-03-22 22:10:16'),(136,8,'Villa de San Francisco','2026-03-22 22:10:16','2026-03-22 22:10:16'),(137,8,'Vallecillo','2026-03-22 22:10:16','2026-03-22 22:10:16'),(138,9,'Puerto Lempira','2026-03-22 22:10:16','2026-03-22 22:10:16'),(139,9,'Ahuas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(140,9,'Brus Laguna','2026-03-22 22:10:16','2026-03-22 22:10:16'),(141,9,'Juan Francisco Bulnes','2026-03-22 22:10:16','2026-03-22 22:10:16'),(142,9,'Ramón Villeda Morales','2026-03-22 22:10:16','2026-03-22 22:10:16'),(143,9,'Wampusirpi','2026-03-22 22:10:16','2026-03-22 22:10:16'),(144,10,'La Esperanza','2026-03-22 22:10:16','2026-03-22 22:10:16'),(145,10,'Camasca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(146,10,'Colomoncagua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(147,10,'Concepción','2026-03-22 22:10:16','2026-03-22 22:10:16'),(148,10,'Dolores','2026-03-22 22:10:16','2026-03-22 22:10:16'),(149,10,'Intibucá','2026-03-22 22:10:16','2026-03-22 22:10:16'),(150,10,'Jesús de Otoro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(151,10,'Magdalena','2026-03-22 22:10:16','2026-03-22 22:10:16'),(152,10,'Masaguara','2026-03-22 22:10:16','2026-03-22 22:10:16'),(153,10,'San Antonio','2026-03-22 22:10:16','2026-03-22 22:10:16'),(154,10,'San Isidro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(155,10,'San Juan','2026-03-22 22:10:16','2026-03-22 22:10:16'),(156,10,'San Marcos de la Sierra','2026-03-22 22:10:16','2026-03-22 22:10:16'),(157,10,'San Miguelito','2026-03-22 22:10:16','2026-03-22 22:10:16'),(158,10,'Santa Lucía','2026-03-22 22:10:16','2026-03-22 22:10:16'),(159,10,'Yamaranguila','2026-03-22 22:10:16','2026-03-22 22:10:16'),(160,10,'San Francisco de Opalaca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(161,11,'Roatán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(162,11,'Guanaja','2026-03-22 22:10:16','2026-03-22 22:10:16'),(163,11,'José Santos Guardiola','2026-03-22 22:10:16','2026-03-22 22:10:16'),(164,11,'Utila','2026-03-22 22:10:16','2026-03-22 22:10:16'),(165,12,'La Paz','2026-03-22 22:10:16','2026-03-22 22:10:16'),(166,12,'Aguanqueterique','2026-03-22 22:10:16','2026-03-22 22:10:16'),(167,12,'Cabañas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(168,12,'Cane','2026-03-22 22:10:16','2026-03-22 22:10:16'),(169,12,'Chinacla','2026-03-22 22:10:16','2026-03-22 22:10:16'),(170,12,'Guajiquiro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(171,12,'Lauterique','2026-03-22 22:10:16','2026-03-22 22:10:16'),(172,12,'Marcala','2026-03-22 22:10:16','2026-03-22 22:10:16'),(173,12,'Mercedes de Oriente','2026-03-22 22:10:16','2026-03-22 22:10:16'),(174,12,'Opatoro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(175,12,'San Antonio del Norte','2026-03-22 22:10:16','2026-03-22 22:10:16'),(176,12,'San José','2026-03-22 22:10:16','2026-03-22 22:10:16'),(177,12,'San Juan','2026-03-22 22:10:16','2026-03-22 22:10:16'),(178,12,'San Pedro de Tutule','2026-03-22 22:10:16','2026-03-22 22:10:16'),(179,12,'Santa Ana','2026-03-22 22:10:16','2026-03-22 22:10:16'),(180,12,'Santa Elena','2026-03-22 22:10:16','2026-03-22 22:10:16'),(181,12,'Santa María','2026-03-22 22:10:16','2026-03-22 22:10:16'),(182,12,'Santiago de Puringla','2026-03-22 22:10:16','2026-03-22 22:10:16'),(183,12,'Yarula','2026-03-22 22:10:16','2026-03-22 22:10:16'),(184,13,'Gracias','2026-03-22 22:10:16','2026-03-22 22:10:16'),(185,13,'Belén','2026-03-22 22:10:16','2026-03-22 22:10:16'),(186,13,'Candelaria','2026-03-22 22:10:16','2026-03-22 22:10:16'),(187,13,'Cololaca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(188,13,'Erandique','2026-03-22 22:10:16','2026-03-22 22:10:16'),(189,13,'Gualcince','2026-03-22 22:10:16','2026-03-22 22:10:16'),(190,13,'Guarita','2026-03-22 22:10:16','2026-03-22 22:10:16'),(191,13,'La Campa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(192,13,'La Iguala','2026-03-22 22:10:16','2026-03-22 22:10:16'),(193,13,'Las Flores','2026-03-22 22:10:16','2026-03-22 22:10:16'),(194,13,'La Unión','2026-03-22 22:10:16','2026-03-22 22:10:16'),(195,13,'La Virtud','2026-03-22 22:10:16','2026-03-22 22:10:16'),(196,13,'Lepaera','2026-03-22 22:10:16','2026-03-22 22:10:16'),(197,13,'Mapulaca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(198,13,'Piraera','2026-03-22 22:10:16','2026-03-22 22:10:16'),(199,13,'San Andrés','2026-03-22 22:10:16','2026-03-22 22:10:16'),(200,13,'San Francisco','2026-03-22 22:10:16','2026-03-22 22:10:16'),(201,13,'San Juan Guarita','2026-03-22 22:10:16','2026-03-22 22:10:16'),(202,13,'San Manuel Colohete','2026-03-22 22:10:16','2026-03-22 22:10:16'),(203,13,'San Rafael','2026-03-22 22:10:16','2026-03-22 22:10:16'),(204,13,'San Sebastián','2026-03-22 22:10:16','2026-03-22 22:10:16'),(205,13,'Santa Cruz','2026-03-22 22:10:16','2026-03-22 22:10:16'),(206,13,'Talgua','2026-03-22 22:10:16','2026-03-22 22:10:16'),(207,13,'Tambla','2026-03-22 22:10:16','2026-03-22 22:10:16'),(208,13,'Tomalá','2026-03-22 22:10:16','2026-03-22 22:10:16'),(209,13,'Valladolid','2026-03-22 22:10:16','2026-03-22 22:10:16'),(210,13,'Virginia','2026-03-22 22:10:16','2026-03-22 22:10:16'),(211,14,'Ocotepeque','2026-03-22 22:10:16','2026-03-22 22:10:16'),(212,14,'Belén Gualcho','2026-03-22 22:10:16','2026-03-22 22:10:16'),(213,14,'Concepción','2026-03-22 22:10:16','2026-03-22 22:10:16'),(214,14,'Dolores Merendón','2026-03-22 22:10:16','2026-03-22 22:10:16'),(215,14,'Fraternidad','2026-03-22 22:10:16','2026-03-22 22:10:16'),(216,14,'La Encarnación','2026-03-22 22:10:16','2026-03-22 22:10:16'),(217,14,'La Labor','2026-03-22 22:10:16','2026-03-22 22:10:16'),(218,14,'Lucerna','2026-03-22 22:10:16','2026-03-22 22:10:16'),(219,14,'Mercedes','2026-03-22 22:10:16','2026-03-22 22:10:16'),(220,14,'San Fernando','2026-03-22 22:10:16','2026-03-22 22:10:16'),(221,14,'San Francisco del Valle','2026-03-22 22:10:16','2026-03-22 22:10:16'),(222,14,'San Jorge','2026-03-22 22:10:16','2026-03-22 22:10:16'),(223,14,'San Marcos','2026-03-22 22:10:16','2026-03-22 22:10:16'),(224,14,'Santa Fe','2026-03-22 22:10:16','2026-03-22 22:10:16'),(225,14,'Sensenti','2026-03-22 22:10:16','2026-03-22 22:10:16'),(226,14,'Sinuapa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(227,15,'Juticalpa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(228,15,'Campamento','2026-03-22 22:10:16','2026-03-22 22:10:16'),(229,15,'Catacamas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(230,15,'Concordia','2026-03-22 22:10:16','2026-03-22 22:10:16'),(231,15,'Dulce Nombre de Culmí','2026-03-22 22:10:16','2026-03-22 22:10:16'),(232,15,'El Rosario','2026-03-22 22:10:16','2026-03-22 22:10:16'),(233,15,'Esquipulas del Norte','2026-03-22 22:10:16','2026-03-22 22:10:16'),(234,15,'Gualaco','2026-03-22 22:10:16','2026-03-22 22:10:16'),(235,15,'Guarizama','2026-03-22 22:10:16','2026-03-22 22:10:16'),(236,15,'Guata','2026-03-22 22:10:16','2026-03-22 22:10:16'),(237,15,'Guayape','2026-03-22 22:10:16','2026-03-22 22:10:16'),(238,15,'Jano','2026-03-22 22:10:16','2026-03-22 22:10:16'),(239,15,'La Unión','2026-03-22 22:10:16','2026-03-22 22:10:16'),(240,15,'Mangulile','2026-03-22 22:10:16','2026-03-22 22:10:16'),(241,15,'Manto','2026-03-22 22:10:16','2026-03-22 22:10:16'),(242,15,'Salamá','2026-03-22 22:10:16','2026-03-22 22:10:16'),(243,15,'San Esteban','2026-03-22 22:10:16','2026-03-22 22:10:16'),(244,15,'San Francisco de Becerra','2026-03-22 22:10:16','2026-03-22 22:10:16'),(245,15,'San Francisco de la Paz','2026-03-22 22:10:16','2026-03-22 22:10:16'),(246,15,'Santa María del Real','2026-03-22 22:10:16','2026-03-22 22:10:16'),(247,15,'Silca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(248,15,'Yocón','2026-03-22 22:10:16','2026-03-22 22:10:16'),(249,15,'Patuca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(250,16,'Santa Bárbara','2026-03-22 22:10:16','2026-03-22 22:10:16'),(251,16,'Arada','2026-03-22 22:10:16','2026-03-22 22:10:16'),(252,16,'Atima','2026-03-22 22:10:16','2026-03-22 22:10:16'),(253,16,'Azacualpa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(254,16,'Ceguaca','2026-03-22 22:10:16','2026-03-22 22:10:16'),(255,16,'Concepción del Norte','2026-03-22 22:10:16','2026-03-22 22:10:16'),(256,16,'Concepción del Sur','2026-03-22 22:10:16','2026-03-22 22:10:16'),(257,16,'Chinda','2026-03-22 22:10:16','2026-03-22 22:10:16'),(258,16,'El Níspero','2026-03-22 22:10:16','2026-03-22 22:10:16'),(259,16,'Gualala','2026-03-22 22:10:16','2026-03-22 22:10:16'),(260,16,'Ilama','2026-03-22 22:10:16','2026-03-22 22:10:16'),(261,16,'Las Vegas','2026-03-22 22:10:16','2026-03-22 22:10:16'),(262,16,'Macuelizo','2026-03-22 22:10:16','2026-03-22 22:10:16'),(263,16,'Naranjito','2026-03-22 22:10:16','2026-03-22 22:10:16'),(264,16,'Nuevo Celilac','2026-03-22 22:10:16','2026-03-22 22:10:16'),(265,16,'Nueva Frontera','2026-03-22 22:10:16','2026-03-22 22:10:16'),(266,16,'Petoa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(267,16,'Protección','2026-03-22 22:10:16','2026-03-22 22:10:16'),(268,16,'Quimistán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(269,16,'San Francisco de Ojuera','2026-03-22 22:10:16','2026-03-22 22:10:16'),(270,16,'San Luis','2026-03-22 22:10:16','2026-03-22 22:10:16'),(271,16,'San Marcos','2026-03-22 22:10:16','2026-03-22 22:10:16'),(272,16,'San Nicolás','2026-03-22 22:10:16','2026-03-22 22:10:16'),(273,16,'San Pedro Zacapa','2026-03-22 22:10:16','2026-03-22 22:10:16'),(274,16,'Santa Rita','2026-03-22 22:10:16','2026-03-22 22:10:16'),(275,16,'San Vicente Centenario','2026-03-22 22:10:16','2026-03-22 22:10:16'),(276,16,'Trinidad','2026-03-22 22:10:16','2026-03-22 22:10:16'),(277,17,'Nacaome','2026-03-22 22:10:16','2026-03-22 22:10:16'),(278,17,'Alianza','2026-03-22 22:10:16','2026-03-22 22:10:16'),(279,17,'Amapala','2026-03-22 22:10:16','2026-03-22 22:10:16'),(280,17,'Aramecina','2026-03-22 22:10:16','2026-03-22 22:10:16'),(281,17,'Caridad','2026-03-22 22:10:16','2026-03-22 22:10:16'),(282,17,'Goascorán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(283,17,'Langue','2026-03-22 22:10:16','2026-03-22 22:10:16'),(284,17,'San Francisco de Coray','2026-03-22 22:10:16','2026-03-22 22:10:16'),(285,17,'San Lorenzo','2026-03-22 22:10:16','2026-03-22 22:10:16'),(286,18,'Yoro','2026-03-22 22:10:16','2026-03-22 22:10:16'),(287,18,'Arenal','2026-03-22 22:10:16','2026-03-22 22:10:16'),(288,18,'El Negrito','2026-03-22 22:10:16','2026-03-22 22:10:16'),(289,18,'El Progreso','2026-03-22 22:10:16','2026-03-22 22:10:16'),(290,18,'Jocón','2026-03-22 22:10:16','2026-03-22 22:10:16'),(291,18,'Morazán','2026-03-22 22:10:16','2026-03-22 22:10:16'),(292,18,'Olanchito','2026-03-22 22:10:16','2026-03-22 22:10:16'),(293,18,'Santa Rita','2026-03-22 22:10:16','2026-03-22 22:10:16'),(294,18,'Sulaco','2026-03-22 22:10:16','2026-03-22 22:10:16'),(295,18,'Victoria','2026-03-22 22:10:16','2026-03-22 22:10:16'),(296,18,'Yorito','2026-03-22 22:10:16','2026-03-22 22:10:16');
/*!40000 ALTER TABLE `cat_ciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_departamentos`
--

DROP TABLE IF EXISTS `cat_departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_departamentos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pais_id` bigint(20) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_departamento_pais` (`pais_id`,`nombre`),
  KEY `idx_departamentos_pais` (`pais_id`),
  CONSTRAINT `fk_departamentos_pais` FOREIGN KEY (`pais_id`) REFERENCES `cat_paises` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_departamentos`
--

LOCK TABLES `cat_departamentos` WRITE;
/*!40000 ALTER TABLE `cat_departamentos` DISABLE KEYS */;
INSERT INTO `cat_departamentos` VALUES (1,78,'Atlántida','2026-03-13 08:19:34','2026-03-13 08:19:34'),(2,78,'Choluteca','2026-03-13 08:19:34','2026-03-13 08:19:34'),(3,78,'Colón','2026-03-13 08:19:34','2026-03-13 08:19:34'),(4,78,'Comayagua','2026-03-13 08:19:34','2026-03-13 08:19:34'),(5,78,'Copán','2026-03-13 08:19:34','2026-03-13 08:19:34'),(6,78,'Cortés','2026-03-13 08:19:34','2026-03-13 08:19:34'),(7,78,'El Paraíso','2026-03-13 08:19:34','2026-03-13 08:19:34'),(8,78,'Francisco Morazán','2026-03-13 08:19:34','2026-03-13 08:19:34'),(9,78,'Gracias a Dios','2026-03-13 08:19:34','2026-03-13 08:19:34'),(10,78,'Intibucá','2026-03-13 08:19:34','2026-03-13 08:19:34'),(11,78,'Islas de la Bahía','2026-03-13 08:19:34','2026-03-13 08:19:34'),(12,78,'La Paz','2026-03-13 08:19:34','2026-03-13 08:19:34'),(13,78,'Lempira','2026-03-13 08:19:34','2026-03-13 08:19:34'),(14,78,'Ocotepeque','2026-03-13 08:19:34','2026-03-13 08:19:34'),(15,78,'Olancho','2026-03-13 08:19:34','2026-03-13 08:19:34'),(16,78,'Santa Bárbara','2026-03-13 08:19:34','2026-03-13 08:19:34'),(17,78,'Valle','2026-03-13 08:19:34','2026-03-13 08:19:34'),(18,78,'Yoro','2026-03-13 08:19:34','2026-03-13 08:19:34');
/*!40000 ALTER TABLE `cat_departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_disponibilidad_vehicular`
--

DROP TABLE IF EXISTS `cat_disponibilidad_vehicular`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_disponibilidad_vehicular` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_disponibilidad_vehicular`
--

LOCK TABLES `cat_disponibilidad_vehicular` WRITE;
/*!40000 ALTER TABLE `cat_disponibilidad_vehicular` DISABLE KEYS */;
INSERT INTO `cat_disponibilidad_vehicular` VALUES (1,'Sí',NULL,NULL),(2,'No',NULL,NULL);
/*!40000 ALTER TABLE `cat_disponibilidad_vehicular` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_idiomas`
--

DROP TABLE IF EXISTS `cat_idiomas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_idiomas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_idiomas`
--

LOCK TABLES `cat_idiomas` WRITE;
/*!40000 ALTER TABLE `cat_idiomas` DISABLE KEYS */;
INSERT INTO `cat_idiomas` VALUES (1,'Español',NULL,NULL),(2,'Inglés',NULL,NULL),(3,'Francés',NULL,NULL),(4,'Portugués',NULL,NULL),(5,'Alemán',NULL,NULL),(6,'Italiano',NULL,NULL),(7,'Chino mandarín',NULL,NULL),(8,'Japonés',NULL,NULL),(9,'Coreano',NULL,NULL),(10,'Ruso',NULL,NULL),(11,'Árabe',NULL,NULL),(12,'Hindi',NULL,NULL),(13,'Bengalí',NULL,NULL),(14,'Urdu',NULL,NULL),(15,'Turco',NULL,NULL),(16,'Polaco',NULL,NULL),(17,'Neerlandés',NULL,NULL),(18,'Sueco',NULL,NULL),(19,'Noruego',NULL,NULL),(20,'Danés',NULL,NULL),(21,'Finlandés',NULL,NULL),(22,'Checo',NULL,NULL),(23,'Eslovaco',NULL,NULL),(24,'Húngaro',NULL,NULL),(25,'Rumano',NULL,NULL),(26,'Búlgaro',NULL,NULL),(27,'Griego',NULL,NULL),(28,'Hebreo',NULL,NULL),(29,'Tailandés',NULL,NULL),(30,'Vietnamita',NULL,NULL),(31,'Indonesio',NULL,NULL),(32,'Malayo',NULL,NULL),(33,'Filipino',NULL,NULL),(34,'Swahili',NULL,NULL),(35,'Zulu',NULL,NULL),(36,'Afrikáans',NULL,NULL),(37,'Persa',NULL,NULL),(38,'Ucraniano',NULL,NULL),(39,'Croata',NULL,NULL),(40,'Serbio',NULL,NULL),(41,'Esloveno',NULL,NULL),(42,'Letón',NULL,NULL),(43,'Lituano',NULL,NULL),(44,'Estonio',NULL,NULL),(45,'Islandés',NULL,NULL),(46,'Irlandés',NULL,NULL),(47,'Galés',NULL,NULL),(48,'Catalán',NULL,NULL),(49,'Vasco',NULL,NULL),(50,'Quechua',NULL,NULL);
/*!40000 ALTER TABLE `cat_idiomas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_nacionalidades`
--

DROP TABLE IF EXISTS `cat_nacionalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_nacionalidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_nacionalidades`
--

LOCK TABLES `cat_nacionalidades` WRITE;
/*!40000 ALTER TABLE `cat_nacionalidades` DISABLE KEYS */;
INSERT INTO `cat_nacionalidades` VALUES (1,'Afgana',NULL,NULL),(2,'Albanesa',NULL,NULL),(3,'Alemana',NULL,NULL),(4,'Andorrana',NULL,NULL),(5,'Angoleña',NULL,NULL),(6,'Antiguana',NULL,NULL),(7,'Saudita',NULL,NULL),(8,'Argelina',NULL,NULL),(9,'Argentina',NULL,NULL),(10,'Armenia',NULL,NULL),(11,'Australiana',NULL,NULL),(12,'Austriaca',NULL,NULL),(13,'Azerbaiyana',NULL,NULL),(14,'Bahameña',NULL,NULL),(15,'Bangladesí',NULL,NULL),(16,'Barbadense',NULL,NULL),(17,'Bareiní',NULL,NULL),(18,'Belga',NULL,NULL),(19,'Beliceña',NULL,NULL),(20,'Beninesa',NULL,NULL),(21,'Bielorrusa',NULL,NULL),(22,'Birmana',NULL,NULL),(23,'Boliviana',NULL,NULL),(24,'Bosnia',NULL,NULL),(25,'Botsuana',NULL,NULL),(26,'Brasileña',NULL,NULL),(27,'Bruneana',NULL,NULL),(28,'Búlgara',NULL,NULL),(29,'Burkinesa',NULL,NULL),(30,'Burundesa',NULL,NULL),(31,'Butanesa',NULL,NULL),(32,'Caboverdiana',NULL,NULL),(33,'Camboyana',NULL,NULL),(34,'Camerunesa',NULL,NULL),(35,'Canadiense',NULL,NULL),(36,'Catarí',NULL,NULL),(37,'Chadiana',NULL,NULL),(38,'Chilena',NULL,NULL),(39,'China',NULL,NULL),(40,'Chipriota',NULL,NULL),(41,'Colombiana',NULL,NULL),(42,'Comorense',NULL,NULL),(43,'Congoleña',NULL,NULL),(44,'Norcoreana',NULL,NULL),(45,'Surcoreana',NULL,NULL),(46,'Costarricense',NULL,NULL),(47,'Marfileña',NULL,NULL),(48,'Croata',NULL,NULL),(49,'Cubana',NULL,NULL),(50,'Danesa',NULL,NULL),(51,'Dominicana',NULL,NULL),(52,'Ecuatoriana',NULL,NULL),(53,'Egipcia',NULL,NULL),(54,'Salvadoreña',NULL,NULL),(55,'Emiratí',NULL,NULL),(56,'Española',NULL,NULL),(57,'Estadounidense',NULL,NULL),(58,'Estonia',NULL,NULL),(59,'Etíope',NULL,NULL),(60,'Filipina',NULL,NULL),(61,'Finlandesa',NULL,NULL),(62,'Francesa',NULL,NULL),(63,'Guatemalteca',NULL,NULL),(64,'Haitiana',NULL,NULL),(65,'Hondureña',NULL,NULL),(66,'Mexicana',NULL,NULL),(67,'Nicaragüense',NULL,NULL),(68,'Panameña',NULL,NULL),(69,'Paraguaya',NULL,NULL),(70,'Peruana',NULL,NULL),(71,'Puertorriqueña',NULL,NULL),(72,'Uruguaya',NULL,NULL),(73,'Venezolana',NULL,NULL);
/*!40000 ALTER TABLE `cat_nacionalidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_niveles_educativos`
--

DROP TABLE IF EXISTS `cat_niveles_educativos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_niveles_educativos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_niveles_educativos`
--

LOCK TABLES `cat_niveles_educativos` WRITE;
/*!40000 ALTER TABLE `cat_niveles_educativos` DISABLE KEYS */;
INSERT INTO `cat_niveles_educativos` VALUES (1,'Primaria',NULL,NULL),(2,'Secundaria',NULL,NULL),(3,'Técnico',NULL,NULL),(4,'Universitario',NULL,NULL),(5,'Postgrado',NULL,NULL);
/*!40000 ALTER TABLE `cat_niveles_educativos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_niveles_idioma`
--

DROP TABLE IF EXISTS `cat_niveles_idioma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_niveles_idioma` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_niveles_idioma`
--

LOCK TABLES `cat_niveles_idioma` WRITE;
/*!40000 ALTER TABLE `cat_niveles_idioma` DISABLE KEYS */;
INSERT INTO `cat_niveles_idioma` VALUES (1,'Básico',NULL,NULL),(2,'Intermedio',NULL,NULL),(3,'Avanzado',NULL,NULL),(4,'Nativo',NULL,NULL);
/*!40000 ALTER TABLE `cat_niveles_idioma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_paises`
--

DROP TABLE IF EXISTS `cat_paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_paises` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_cat_paises_nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_paises`
--

LOCK TABLES `cat_paises` WRITE;
/*!40000 ALTER TABLE `cat_paises` DISABLE KEYS */;
INSERT INTO `cat_paises` VALUES (1,'Afganistán',NULL,NULL),(2,'Albania',NULL,NULL),(3,'Alemania',NULL,NULL),(4,'Andorra',NULL,NULL),(5,'Angola',NULL,NULL),(6,'Antigua y Barbuda',NULL,NULL),(7,'Arabia Saudita',NULL,NULL),(8,'Argelia',NULL,NULL),(9,'Argentina',NULL,NULL),(10,'Armenia',NULL,NULL),(11,'Australia',NULL,NULL),(12,'Austria',NULL,NULL),(13,'Azerbaiyán',NULL,NULL),(14,'Bahamas',NULL,NULL),(15,'Bangladés',NULL,NULL),(16,'Barbados',NULL,NULL),(17,'Baréin',NULL,NULL),(18,'Bélgica',NULL,NULL),(19,'Belice',NULL,NULL),(20,'Benín',NULL,NULL),(21,'Bielorrusia',NULL,NULL),(22,'Birmania',NULL,NULL),(23,'Bolivia',NULL,NULL),(24,'Bosnia y Herzegovina',NULL,NULL),(25,'Botsuana',NULL,NULL),(26,'Brasil',NULL,NULL),(27,'Brunéi',NULL,NULL),(28,'Bulgaria',NULL,NULL),(29,'Burkina Faso',NULL,NULL),(30,'Burundi',NULL,NULL),(31,'Bután',NULL,NULL),(32,'Cabo Verde',NULL,NULL),(33,'Camboya',NULL,NULL),(34,'Camerún',NULL,NULL),(35,'Canadá',NULL,NULL),(36,'Catar',NULL,NULL),(37,'Chad',NULL,NULL),(38,'Chile',NULL,NULL),(39,'China',NULL,NULL),(40,'Chipre',NULL,NULL),(41,'Colombia',NULL,NULL),(42,'Comoras',NULL,NULL),(43,'Congo',NULL,NULL),(44,'Corea del Norte',NULL,NULL),(45,'Corea del Sur',NULL,NULL),(46,'Costa Rica',NULL,NULL),(47,'Costa de Marfil',NULL,NULL),(48,'Croacia',NULL,NULL),(49,'Cuba',NULL,NULL),(50,'Dinamarca',NULL,NULL),(51,'Dominica',NULL,NULL),(52,'Ecuador',NULL,NULL),(53,'Egipto',NULL,NULL),(54,'El Salvador',NULL,NULL),(55,'Emiratos Árabes Unidos',NULL,NULL),(56,'Eritrea',NULL,NULL),(57,'Eslovaquia',NULL,NULL),(58,'Eslovenia',NULL,NULL),(59,'España',NULL,NULL),(60,'Estados Unidos',NULL,NULL),(61,'Estonia',NULL,NULL),(62,'Etiopía',NULL,NULL),(63,'Filipinas',NULL,NULL),(64,'Finlandia',NULL,NULL),(65,'Francia',NULL,NULL),(66,'Gabón',NULL,NULL),(67,'Gambia',NULL,NULL),(68,'Georgia',NULL,NULL),(69,'Ghana',NULL,NULL),(70,'Granada',NULL,NULL),(71,'Grecia',NULL,NULL),(72,'Guatemala',NULL,NULL),(73,'Guinea',NULL,NULL),(74,'Guinea Ecuatorial',NULL,NULL),(75,'Guinea-Bisáu',NULL,NULL),(76,'Guyana',NULL,NULL),(77,'Haití',NULL,NULL),(78,'Honduras',NULL,NULL),(79,'Hungría',NULL,NULL),(80,'India',NULL,NULL),(81,'Indonesia',NULL,NULL),(82,'Irak',NULL,NULL),(83,'Irán',NULL,NULL),(84,'Irlanda',NULL,NULL),(85,'Islandia',NULL,NULL),(86,'Israel',NULL,NULL),(87,'Italia',NULL,NULL),(88,'Jamaica',NULL,NULL),(89,'Japón',NULL,NULL),(90,'Jordania',NULL,NULL),(91,'Kazajistán',NULL,NULL),(92,'Kenia',NULL,NULL),(93,'Kirguistán',NULL,NULL),(94,'Kiribati',NULL,NULL),(95,'Kuwait',NULL,NULL),(96,'Laos',NULL,NULL),(97,'Lesoto',NULL,NULL),(98,'Letonia',NULL,NULL),(99,'Líbano',NULL,NULL),(100,'Liberia',NULL,NULL),(101,'Libia',NULL,NULL),(102,'Liechtenstein',NULL,NULL),(103,'Lituania',NULL,NULL),(104,'Luxemburgo',NULL,NULL),(105,'Madagascar',NULL,NULL),(106,'Malasia',NULL,NULL),(107,'Malaui',NULL,NULL),(108,'Maldivas',NULL,NULL),(109,'Malí',NULL,NULL),(110,'Malta',NULL,NULL),(111,'Marruecos',NULL,NULL),(112,'Mauricio',NULL,NULL),(113,'Mauritania',NULL,NULL),(114,'México',NULL,NULL),(115,'Micronesia',NULL,NULL),(116,'Moldavia',NULL,NULL),(117,'Mónaco',NULL,NULL),(118,'Mongolia',NULL,NULL),(119,'Montenegro',NULL,NULL),(120,'Mozambique',NULL,NULL),(121,'Namibia',NULL,NULL),(122,'Nauru',NULL,NULL),(123,'Nepal',NULL,NULL),(124,'Nicaragua',NULL,NULL),(125,'Níger',NULL,NULL),(126,'Nigeria',NULL,NULL),(127,'Noruega',NULL,NULL),(128,'Nueva Zelanda',NULL,NULL),(129,'Omán',NULL,NULL),(130,'Países Bajos',NULL,NULL),(131,'Pakistán',NULL,NULL),(132,'Panamá',NULL,NULL),(133,'Papúa Nueva Guinea',NULL,NULL),(134,'Paraguay',NULL,NULL),(135,'Perú',NULL,NULL),(136,'Polonia',NULL,NULL),(137,'Portugal',NULL,NULL),(138,'Reino Unido',NULL,NULL),(139,'República Centroafricana',NULL,NULL),(140,'República Checa',NULL,NULL),(141,'República Dominicana',NULL,NULL),(142,'Ruanda',NULL,NULL),(143,'Rumanía',NULL,NULL),(144,'Rusia',NULL,NULL),(145,'Samoa',NULL,NULL),(146,'San Cristóbal y Nieves',NULL,NULL),(147,'San Marino',NULL,NULL),(148,'San Vicente y las Granadinas',NULL,NULL),(149,'Santa Lucía',NULL,NULL),(150,'Santo Tomé y Príncipe',NULL,NULL),(151,'Senegal',NULL,NULL),(152,'Serbia',NULL,NULL),(153,'Seychelles',NULL,NULL),(154,'Sierra Leona',NULL,NULL),(155,'Singapur',NULL,NULL),(156,'Siria',NULL,NULL),(157,'Somalia',NULL,NULL),(158,'Sri Lanka',NULL,NULL),(159,'Sudáfrica',NULL,NULL),(160,'Sudán',NULL,NULL),(161,'Sudán del Sur',NULL,NULL),(162,'Suecia',NULL,NULL),(163,'Suiza',NULL,NULL),(164,'Surinam',NULL,NULL),(165,'Tailandia',NULL,NULL),(166,'Tanzania',NULL,NULL),(167,'Tayikistán',NULL,NULL),(168,'Timor Oriental',NULL,NULL),(169,'Togo',NULL,NULL),(170,'Tonga',NULL,NULL),(171,'Trinidad y Tobago',NULL,NULL),(172,'Túnez',NULL,NULL),(173,'Turkmenistán',NULL,NULL),(174,'Turquía',NULL,NULL),(175,'Tuvalu',NULL,NULL),(176,'Ucrania',NULL,NULL),(177,'Uganda',NULL,NULL),(178,'Uruguay',NULL,NULL),(179,'Uzbekistán',NULL,NULL),(180,'Vanuatu',NULL,NULL),(181,'Vaticano',NULL,NULL),(182,'Venezuela',NULL,NULL),(183,'Vietnam',NULL,NULL),(184,'Yemen',NULL,NULL),(185,'Yibuti',NULL,NULL),(186,'Zambia',NULL,NULL),(187,'Zimbabue',NULL,NULL);
/*!40000 ALTER TABLE `cat_paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_sexos`
--

DROP TABLE IF EXISTS `cat_sexos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cat_sexos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_sexos`
--

LOCK TABLES `cat_sexos` WRITE;
/*!40000 ALTER TABLE `cat_sexos` DISABLE KEYS */;
INSERT INTO `cat_sexos` VALUES (1,'Masculino',NULL,NULL),(2,'Femenino',NULL,NULL),(3,'Otro',NULL,NULL),(4,'Prefiero no decirlo',NULL,NULL);
/*!40000 ALTER TABLE `cat_sexos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_usuarios_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_09_15_235134_agregar_roles_a_usuarios_table',1),(5,'2026_01_31_013059_create_cat_sexos_table',1),(6,'2026_01_31_013337_create_cat_nacionalidades_table',1),(7,'2026_01_31_013459_create_cat_disponibilidad_vehicular_table',1),(8,'2026_01_31_013527_create_cat_niveles_educativos_table',1),(9,'2026_01_31_013535_create_cat_idiomas_table',1),(10,'2026_01_31_013545_create_cat_nivel_idioma_table',1),(11,'2026_01_31_013552_create_cat_paises_table',1),(12,'2026_01_31_014432_create_roles_table',1),(13,'2026_01_31_014517_create_permisos_table',1),(14,'2026_01_31_020101_create_rol_permisos_table',1),(15,'2026_01_31_020140_create_usuario_roles_table',1),(16,'2026_01_31_033246_create_perfiles_table',1),(17,'2026_01_31_033504_create_perfil_area_estudio_table',1),(18,'2026_01_31_034804_create_perfil_idiomas_table',1),(19,'2026_01_31_035032_create_perfil_experiencia_laboral_table',1),(20,'2026_02_15_043404_create_personal_access_tokens_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL,
  `pais_id` bigint(20) unsigned DEFAULT NULL,
  `departamento_id` bigint(20) unsigned DEFAULT NULL,
  `ciudad_id` bigint(20) unsigned DEFAULT NULL,
  `sexo_id` bigint(20) unsigned DEFAULT NULL,
  `nacionalidad_id` bigint(20) unsigned DEFAULT NULL,
  `disponibilidad_vehicular_id` bigint(20) unsigned DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `acerca_de_mi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfiles_usuario_id_foreign` (`usuario_id`),
  KEY `perfiles_pais_id_foreign` (`pais_id`),
  KEY `perfiles_sexo_id_foreign` (`sexo_id`),
  KEY `perfiles_nacionalidad_id_foreign` (`nacionalidad_id`),
  KEY `perfiles_disponibilidad_vehicular_id_foreign` (`disponibilidad_vehicular_id`),
  KEY `fk_perfiles_departamento` (`departamento_id`),
  KEY `fk_perfiles_ciudad` (`ciudad_id`),
  CONSTRAINT `fk_perfiles_ciudad` FOREIGN KEY (`ciudad_id`) REFERENCES `cat_ciudades` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_perfiles_departamento` FOREIGN KEY (`departamento_id`) REFERENCES `cat_departamentos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `perfiles_disponibilidad_vehicular_id_foreign` FOREIGN KEY (`disponibilidad_vehicular_id`) REFERENCES `cat_disponibilidad_vehicular` (`id`),
  CONSTRAINT `perfiles_nacionalidad_id_foreign` FOREIGN KEY (`nacionalidad_id`) REFERENCES `cat_nacionalidades` (`id`),
  CONSTRAINT `perfiles_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `cat_paises` (`id`),
  CONSTRAINT `perfiles_sexo_id_foreign` FOREIGN KEY (`sexo_id`) REFERENCES `cat_sexos` (`id`),
  CONSTRAINT `perfiles_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,1,54,NULL,NULL,NULL,NULL,2,NULL,'dgdgdg','perfil_1_1770430549.jpg','asfsafasfffffffffffffffff','2026-02-07 03:07:55','2026-02-07 08:15:50'),(4,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-02 00:49:20','2026-03-02 00:49:20'),(5,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-02 02:49:21','2026-03-02 02:49:21'),(6,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-02 03:25:02','2026-03-02 03:25:02'),(7,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-02 03:39:02','2026-03-02 03:39:02'),(10,11,78,NULL,NULL,2,NULL,NULL,NULL,'11111111','perfil_11_1774514268.jpg','Acerca de mi','2026-03-06 06:54:47','2026-03-26 10:25:31'),(11,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-07 03:29:08','2026-03-07 03:29:08'),(12,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-07 03:42:49','2026-03-07 03:42:49'),(13,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-07 03:51:13','2026-03-07 03:51:13'),(14,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-07 07:47:25','2026-03-07 07:47:25');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles_educacion`
--

DROP TABLE IF EXISTS `perfiles_educacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles_educacion` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `perfil_id` bigint(20) unsigned NOT NULL,
  `institucion` varchar(150) NOT NULL,
  `nivel_educativo_id` bigint(20) unsigned DEFAULT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `area_estudio_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfiles_educacion_perfil_id_foreign` (`perfil_id`),
  KEY `perfiles_educacion_nivel_educativo_id_foreign` (`nivel_educativo_id`),
  KEY `fk_perfiles_area` (`area_estudio_id`),
  CONSTRAINT `fk_perfiles_area` FOREIGN KEY (`area_estudio_id`) REFERENCES `cat_areas_estudio` (`id`) ON DELETE SET NULL,
  CONSTRAINT `perfiles_educacion_nivel_educativo_id_foreign` FOREIGN KEY (`nivel_educativo_id`) REFERENCES `cat_niveles_educativos` (`id`),
  CONSTRAINT `perfiles_educacion_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles_educacion`
--

LOCK TABLES `perfiles_educacion` WRITE;
/*!40000 ALTER TABLE `perfiles_educacion` DISABLE KEYS */;
INSERT INTO `perfiles_educacion` VALUES (26,1,'UNAH',4,NULL,NULL,'2026-02-07 08:59:47','2026-02-07 08:59:47',NULL),(27,10,'a',2,NULL,NULL,'2026-03-26 08:52:26','2026-03-26 10:25:32',NULL),(28,10,'b',1,NULL,NULL,'2026-03-26 08:52:51','2026-03-26 10:25:42',NULL),(29,10,'c',1,NULL,NULL,'2026-03-26 08:53:00','2026-03-26 10:25:41',NULL),(30,10,'d',1,NULL,NULL,'2026-03-26 08:53:10','2026-03-26 10:25:40',NULL),(31,10,'e',1,NULL,NULL,'2026-03-26 08:53:37','2026-03-26 10:25:38',NULL),(32,10,'f',1,NULL,NULL,'2026-03-26 08:53:46','2026-03-26 10:25:37',NULL),(33,10,'g',1,NULL,NULL,'2026-03-26 08:54:04','2026-03-26 10:25:36',NULL),(34,10,'h',2,NULL,NULL,'2026-03-26 08:54:53','2026-03-26 10:25:35',NULL),(35,10,'i',1,NULL,NULL,'2026-03-26 09:56:44','2026-03-26 10:25:34',NULL),(36,10,'i',1,NULL,NULL,'2026-03-26 09:57:19','2026-03-26 10:25:43',NULL);
/*!40000 ALTER TABLE `perfiles_educacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles_experiencias`
--

DROP TABLE IF EXISTS `perfiles_experiencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles_experiencias` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `perfil_id` bigint(20) unsigned NOT NULL,
  `empresa` varchar(150) NOT NULL,
  `pais_id` bigint(20) unsigned DEFAULT NULL,
  `cargo` varchar(150) NOT NULL,
  `fecha_desde` date DEFAULT NULL,
  `fecha_hasta` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perfiles_experiencias_perfil_id_foreign` (`perfil_id`),
  KEY `perfiles_experiencias_pais_id_foreign` (`pais_id`),
  CONSTRAINT `perfiles_experiencias_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `cat_paises` (`id`),
  CONSTRAINT `perfiles_experiencias_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles_experiencias`
--

LOCK TABLES `perfiles_experiencias` WRITE;
/*!40000 ALTER TABLE `perfiles_experiencias` DISABLE KEYS */;
INSERT INTO `perfiles_experiencias` VALUES (1,11,'XYZ',18,'Prueba','2026-03-01','2026-03-02','Prueba','2026-01-01 06:00:00','2026-01-02 06:00:00'),(2,10,'Empresa Prueba',NULL,'Cargo de ejemplo',NULL,NULL,'* Funciones','2026-03-26 10:24:33','2026-03-26 10:25:48');
/*!40000 ALTER TABLE `perfiles_experiencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles_idiomas`
--

DROP TABLE IF EXISTS `perfiles_idiomas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles_idiomas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `perfil_id` bigint(20) unsigned NOT NULL,
  `idioma_id` bigint(20) unsigned DEFAULT NULL,
  `nivel_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `perfiles_idiomas_perfil_id_idioma_id_unique` (`perfil_id`,`idioma_id`),
  KEY `perfiles_idiomas_idioma_id_foreign` (`idioma_id`),
  KEY `perfiles_idiomas_nivel_id_foreign` (`nivel_id`),
  CONSTRAINT `perfiles_idiomas_idioma_id_foreign` FOREIGN KEY (`idioma_id`) REFERENCES `cat_idiomas` (`id`),
  CONSTRAINT `perfiles_idiomas_nivel_id_foreign` FOREIGN KEY (`nivel_id`) REFERENCES `cat_niveles_idioma` (`id`),
  CONSTRAINT `perfiles_idiomas_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles_idiomas`
--

LOCK TABLES `perfiles_idiomas` WRITE;
/*!40000 ALTER TABLE `perfiles_idiomas` DISABLE KEYS */;
INSERT INTO `perfiles_idiomas` VALUES (49,1,1,4,'2026-02-07 08:59:47','2026-02-07 08:59:47'),(50,1,9,2,'2026-02-07 08:59:47','2026-02-07 08:59:47'),(51,10,18,2,'2026-03-26 08:53:01','2026-03-26 10:25:45'),(52,10,1,4,'2026-03-26 08:56:22','2026-03-26 10:25:44'),(53,10,3,3,'2026-03-26 10:25:47','2026-03-26 10:25:47');
/*!40000 ALTER TABLE `perfiles_idiomas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisos`
--

DROP TABLE IF EXISTS `permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permisos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permisos_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisos`
--

LOCK TABLES `permisos` WRITE;
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
INSERT INTO `permisos` VALUES (1,'ver_dashboard','Ver dashboard','2026-02-07 03:03:10','2026-02-07 03:03:10'),(2,'editar_perfil','Editar perfil propio','2026-02-07 03:03:10','2026-02-07 03:03:10'),(3,'postular_empleo','Postular a ofertas','2026-02-07 03:03:10','2026-02-07 03:03:10'),(4,'administrar_usuarios','Administrar usuarios','2026-02-07 03:03:10','2026-02-07 03:03:10'),(5,'ver_postulantes','Ver perfiles de postulantes','2026-02-07 03:03:10','2026-02-07 03:03:10'),(6,'gestionar_ofertas','Gestionar ofertas laborales','2026-02-07 03:03:10','2026-02-07 03:03:10'),(7,'usuarios.ver','Ver usuarios',NULL,NULL),(8,'usuarios.crear','Crear usuarios',NULL,NULL),(9,'usuarios.editar','Editar usuarios',NULL,NULL),(10,'usuarios.eliminar','Eliminar usuarios',NULL,NULL),(11,'roles.ver','Ver roles',NULL,NULL),(12,'roles.crear','Crear roles',NULL,NULL),(13,'roles.editar','Editar roles',NULL,NULL),(14,'roles.eliminar','Eliminar roles',NULL,NULL),(15,'permisos.ver','Ver permisos',NULL,NULL),(16,'permisos.asignar','Asignar permisos',NULL,NULL),(17,'plazas.ver','Ver plazas',NULL,NULL),(18,'plazas.crear','Crear plazas',NULL,NULL),(19,'plazas.editar','Editar plazas',NULL,NULL),(20,'plazas.eliminar','Eliminar plazas',NULL,NULL),(21,'testimonios.ver','Ver testimonios',NULL,NULL),(22,'testimonios.aprobar','Aprobar testimonios',NULL,NULL);
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  KEY `personal_access_tokens_expires_at_index` (`expires_at`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (8,'App\\Models\\Usuario',1,'api-token','5a52dfbca8868dbafde0085799daab8d6f670b537ff000cecb115f6835f23313','[\"*\"]','2026-02-16 02:54:59',NULL,'2026-02-16 02:54:47','2026-02-16 02:54:59'),(9,'App\\Models\\Usuario',1,'api-token','d73626bef20e55360c22fb8b61cbefa6ac85580de603307bfd304628b78e66ef','[\"*\"]',NULL,NULL,'2026-02-20 08:02:02','2026-02-20 08:02:02'),(11,'App\\Models\\Usuario',1,'api-token','893b3e5afc02bdcf6cea511d47315bb51066164c39d746ddf3e889fec53b6672','[\"*\"]','2026-02-20 08:12:21',NULL,'2026-02-20 08:11:59','2026-02-20 08:12:21'),(12,'App\\Models\\Usuario',1,'api-token','2787018bc2a1eb0a72c7706f3324a4bba76e4fbc24eb79e3c5d07ad3d9bfe5a2','[\"*\"]',NULL,NULL,'2026-02-21 14:00:38','2026-02-21 14:00:38'),(13,'App\\Models\\Usuario',1,'api-token','015dabe60afeac7b6376376cdb9974bad479419b7b7113527190bf6c76c85a9f','[\"*\"]',NULL,NULL,'2026-02-21 14:04:57','2026-02-21 14:04:57'),(14,'App\\Models\\Usuario',1,'api-token','1ad41af3297901ebd3bd43c77f7562c63c6756ad918c5b751b523c48587f72a5','[\"*\"]',NULL,NULL,'2026-02-21 14:42:40','2026-02-21 14:42:40'),(15,'App\\Models\\Usuario',1,'api-token','59dbcb746e71ab0ef9952f4619c031b3cbd11127cb3979473ecf0609f730c83d','[\"*\"]',NULL,NULL,'2026-02-21 14:47:27','2026-02-21 14:47:27'),(16,'App\\Models\\Usuario',1,'api-token','433fe352da77f775255732e5a0e72b42182b0dd182bdf13a252519842d4ddc27','[\"*\"]',NULL,NULL,'2026-02-21 14:47:39','2026-02-21 14:47:39'),(17,'App\\Models\\Usuario',1,'api-token','a04570239cb5912ba0b99ad8f49929655a569828f823108ead9ec59451fa352a','[\"*\"]',NULL,NULL,'2026-02-21 14:52:40','2026-02-21 14:52:40'),(18,'App\\Models\\Usuario',1,'api-token','5c65304471e14de1cc16d2c41ff985e16fe5d96021dae73ffaa4d7694ea1cc09','[\"*\"]',NULL,NULL,'2026-02-21 14:58:02','2026-02-21 14:58:02'),(19,'App\\Models\\Usuario',1,'api-token','393083b1e1d1ad79009b300acf73983ba4b75a0417a4dd1406cf58952d5511ba','[\"*\"]',NULL,NULL,'2026-02-21 14:59:25','2026-02-21 14:59:25'),(20,'App\\Models\\Usuario',1,'api-token','9a507a7d84dc30a3f5a7a41f570c19ed96b5c778dbe2cbf8fc937a328fb7ecde','[\"*\"]',NULL,NULL,'2026-02-21 15:05:54','2026-02-21 15:05:54'),(21,'App\\Models\\Usuario',1,'api-token','7a323a455e6a3cb370b17ebc25263649ac6235f90b27c45d04103e54bdfd8273','[\"*\"]',NULL,NULL,'2026-02-22 11:48:08','2026-02-22 11:48:08'),(22,'App\\Models\\Usuario',1,'api-token','14cc6447eb9ce6a3d001f5928736751942c4e7522774f6075c3f083c4574371b','[\"*\"]',NULL,NULL,'2026-02-22 14:00:42','2026-02-22 14:00:42'),(23,'App\\Models\\Usuario',1,'api-token','9a3624dd144fc82c9a1a7f73d0f020baf96ba3d2ef9a66aa9f2cdd873f4d17ea','[\"*\"]','2026-02-22 14:01:41',NULL,'2026-02-22 14:01:16','2026-02-22 14:01:41'),(24,'App\\Models\\Usuario',1,'api-token','77d220e02a582168a76b4dcd274ea484e712aaf2539c5f5df706770034c76ee7','[\"*\"]',NULL,NULL,'2026-02-23 04:55:36','2026-02-23 04:55:36'),(25,'App\\Models\\Usuario',1,'api-token','c2c244e496ad4b9256318c9a10b093d76335419cfdae50d5acbb9e5bbdd82f85','[\"*\"]',NULL,NULL,'2026-02-23 04:56:20','2026-02-23 04:56:20'),(26,'App\\Models\\Usuario',1,'api-token','d630ba37dca7c80c82af1e83709457138108eb14daa27fd9edff56545b156183','[\"*\"]',NULL,NULL,'2026-02-23 05:13:12','2026-02-23 05:13:12'),(27,'App\\Models\\Usuario',1,'api-token','661df11a4bc30713bbed01dc816a72e72c773a30c0a49d90eeb0c31c33617d75','[\"*\"]',NULL,NULL,'2026-02-23 05:34:06','2026-02-23 05:34:06'),(28,'App\\Models\\Usuario',1,'api-token','2849b33c337fc9ace6e991fa2133d6d815f30825769aa7d8453e5aca4fa7308b','[\"*\"]',NULL,NULL,'2026-02-23 05:48:51','2026-02-23 05:48:51'),(29,'App\\Models\\Usuario',1,'api-token','932543488dccd0d0089cafc2aa9495cddaef964880b94c4178eb78e115a35ba7','[\"*\"]',NULL,NULL,'2026-02-23 05:50:39','2026-02-23 05:50:39'),(30,'App\\Models\\Usuario',1,'api-token','2f1d790777aad3ce0772a2e99b275f1056913dd0ed3e922878e3ac96b2e58c00','[\"*\"]',NULL,NULL,'2026-02-23 05:53:21','2026-02-23 05:53:21'),(31,'App\\Models\\Usuario',1,'api-token','9e3f19a6fbd9231259bf3cb4ab8df7e1d00fb2cbffbb8d5a64c6746ea1ed0bb6','[\"*\"]',NULL,NULL,'2026-02-23 05:53:27','2026-02-23 05:53:27'),(32,'App\\Models\\Usuario',1,'api-token','7b69ae705e4346d3b1fa0570461a1849dcc62bd8fcffda7406011b8ff3d0ea68','[\"*\"]',NULL,NULL,'2026-02-23 05:54:07','2026-02-23 05:54:07'),(33,'App\\Models\\Usuario',1,'api-token','2ce017a38dea0bf9dbf95422d93dee5be9d04a7ff877f76848d096f0e2d662a4','[\"*\"]',NULL,NULL,'2026-02-23 05:54:34','2026-02-23 05:54:34'),(34,'App\\Models\\Usuario',1,'api-token','c680a5b94f073b61c9891c9f0bc65a9fe435e557bc60419b24c0c265813a5a39','[\"*\"]',NULL,NULL,'2026-02-23 05:58:29','2026-02-23 05:58:29'),(35,'App\\Models\\Usuario',1,'api-token','6732fbe291bd0eafd00d54c3403db8d057eb00323e14851aecafc31b46201c4e','[\"*\"]',NULL,NULL,'2026-02-23 05:58:50','2026-02-23 05:58:50'),(36,'App\\Models\\Usuario',1,'api-token','01399ce13e8ba037a5b3f55639662fa4412515216257ef62dc34beace26e71e3','[\"*\"]',NULL,NULL,'2026-02-23 06:00:10','2026-02-23 06:00:10'),(37,'App\\Models\\Usuario',1,'api-token','02c594c2e0fd28bd382959b7ead93ba0227f350daeb0273d0368f471c94638c3','[\"*\"]',NULL,NULL,'2026-02-23 06:06:08','2026-02-23 06:06:08'),(38,'App\\Models\\Usuario',1,'api-token','475cc468956c271ddac9102e91e62276defbacb70075b4c26bd3db7dc5934c06','[\"*\"]',NULL,NULL,'2026-02-23 06:15:48','2026-02-23 06:15:48'),(39,'App\\Models\\Usuario',1,'api-token','ce05fd7eafee84d6852adc792c5af3aa9ef5e6ebfa5c52e43c9dc849df3339c0','[\"*\"]',NULL,NULL,'2026-02-23 06:18:16','2026-02-23 06:18:16'),(40,'App\\Models\\Usuario',1,'api-token','76470ab4b15c2d2c103853ae7e2491aeba594b1960195af82ea35d2d71139b30','[\"*\"]',NULL,NULL,'2026-02-23 06:18:20','2026-02-23 06:18:20'),(41,'App\\Models\\Usuario',1,'api-token','eb89f97e52faff000c230add99a79b6c9c8bee1003bd0b830bc83086c4ff9615','[\"*\"]',NULL,NULL,'2026-02-23 06:20:08','2026-02-23 06:20:08'),(42,'App\\Models\\Usuario',1,'api-token','4244ef0d5d6969652653da6a78fc74b65682d15c036e29de5551357306680c66','[\"*\"]',NULL,NULL,'2026-02-23 06:20:21','2026-02-23 06:20:21'),(43,'App\\Models\\Usuario',1,'api-token','087efd2c380da0cb00fe91f1b7da0c12defc0ecacd64974be90ff22ce974db9c','[\"*\"]',NULL,NULL,'2026-02-23 06:20:28','2026-02-23 06:20:28'),(44,'App\\Models\\Usuario',1,'api-token','b431383121e209d88743c0f415d5bc1ff885dd820971c82525b09ad9c97de44a','[\"*\"]',NULL,NULL,'2026-02-23 06:20:47','2026-02-23 06:20:47'),(45,'App\\Models\\Usuario',1,'api-token','0efd84336132380d00c006e3f56c1d97e43eb8e7c04f99658673209bab1395e1','[\"*\"]',NULL,NULL,'2026-02-23 06:22:27','2026-02-23 06:22:27'),(46,'App\\Models\\Usuario',1,'api-token','65b4f3cb186aac223d1068e21e0547a06fb02e3f377a1ea67c70cf164b844880','[\"*\"]',NULL,NULL,'2026-02-23 06:23:13','2026-02-23 06:23:13'),(61,'App\\Models\\Usuario',1,'api-token','25d218be07584261189a68f74469e4fdc80d96a24255ff94bddbd71cf453d572','[\"*\"]','2026-03-06 16:03:29',NULL,'2026-03-06 15:36:37','2026-03-06 16:03:29'),(63,'App\\Models\\Usuario',1,'api-token','3a6c9983b3bd1605623e3cc2ac7d4d8c860091d6f5d1d992ad7c90e70b759781','[\"*\"]','2026-03-07 09:32:50',NULL,'2026-03-07 09:04:26','2026-03-07 09:32:50'),(64,'App\\Models\\Usuario',1,'api-token','aeab1896324be4500efe836f5a1e7e9fb7b02a9f9541a826f071ee100da806ee','[\"*\"]','2026-03-07 10:06:44',NULL,'2026-03-07 09:42:10','2026-03-07 10:06:44'),(65,'App\\Models\\Usuario',1,'api-token','be9078235b939d707ec6e0c402f8373f4313eb562aac7eaf91ae0dcf087ceb22','[\"*\"]','2026-03-07 10:42:01',NULL,'2026-03-07 10:13:06','2026-03-07 10:42:01'),(68,'App\\Models\\Usuario',1,'api-token','704742a60743f6a331a522c92b99a4d7cce07867873a10fb897d6edef917ed8e','[\"*\"]','2026-03-07 11:16:40',NULL,'2026-03-07 11:16:36','2026-03-07 11:16:40'),(70,'App\\Models\\Usuario',1,'api-token','3efac3f17424b45989e59f53ad6588e4a0e08ca98f207c579a1d2a95e0519868','[\"*\"]','2026-03-07 11:45:08',NULL,'2026-03-07 11:27:40','2026-03-07 11:45:08'),(71,'App\\Models\\Usuario',1,'api-token','26f2b8adcbe96d0e177bfc67c06f873abf5d4429cfd5696c3dee81a41a6b4307','[\"*\"]','2026-03-07 12:20:13',NULL,'2026-03-07 12:07:45','2026-03-07 12:20:13'),(72,'App\\Models\\Usuario',1,'api-token','7e20c42b6ab09108b1313e15ede230863c8c9cfc0087d26cdbc9aa697bc53af6','[\"*\"]','2026-03-07 12:50:51',NULL,'2026-03-07 12:44:39','2026-03-07 12:50:51'),(77,'App\\Models\\Usuario',1,'api-token','357be7d07d5befd1646e26a2840950a962b10dc56681425b2c7f1074a216b586','[\"*\"]','2026-03-09 03:30:43',NULL,'2026-03-09 03:11:59','2026-03-09 03:30:43'),(78,'App\\Models\\Usuario',1,'api-token','6165f8ae8b11ada536a62b74f24c2f40a7f2b9029e3d7699a3431454748d5560','[\"*\"]','2026-03-09 04:20:12',NULL,'2026-03-09 03:50:26','2026-03-09 04:20:12'),(105,'App\\Models\\Usuario',1,'api-token','4aee38a36e6e90c906bbd07cf986f5757000e41970d9220477429cd4dfb9c95f','[\"*\"]','2026-03-13 12:46:25',NULL,'2026-03-13 12:46:12','2026-03-13 12:46:25'),(106,'App\\Models\\Usuario',1,'api-token','63f13f560070f48b87fd51ac9518aa9e9ca59e609613a5972549a6a399f6f0da','[\"*\"]','2026-03-13 13:46:17',NULL,'2026-03-13 13:35:56','2026-03-13 13:46:17'),(108,'App\\Models\\Usuario',1,'api-token','7415e1f635fadd9de0146c640d6a2c535a88bbc2ef82cfc56fd2d87f2a1504dc','[\"*\"]','2026-03-13 14:34:00',NULL,'2026-03-13 14:20:47','2026-03-13 14:34:00'),(109,'App\\Models\\Usuario',1,'api-token','e9f0937ce1fc8adcbd5a2755709ed90a18233aeb921befa32f70b67f860a41c4','[\"*\"]','2026-03-16 06:20:57',NULL,'2026-03-16 05:52:38','2026-03-16 06:20:57'),(110,'App\\Models\\Usuario',1,'api-token','8b0e097d7bc7a3c3180cdd10515fd3e2f8cb25c8cf9e8fdd3804d0169b67bf9e','[\"*\"]','2026-03-16 06:49:07',NULL,'2026-03-16 06:24:49','2026-03-16 06:49:07'),(114,'App\\Models\\Usuario',1,'api-token','cbfae3b3a740f512dd08e08cbc4ed1bd8293ae5d419fb517df8d1e7d794e284a','[\"*\"]','2026-03-16 08:45:10',NULL,'2026-03-16 08:16:05','2026-03-16 08:45:10'),(115,'App\\Models\\Usuario',1,'api-token','67c7ceee2f37b12f499d6ab75f4dd9253961323ce37d679f6572a4ed636fee37','[\"*\"]',NULL,NULL,'2026-03-16 08:17:04','2026-03-16 08:17:04'),(121,'App\\Models\\Usuario',11,'api-token','deefa0bf2d44d4210640f706dca69a74afb05c09e95f97ad54d2dd634cb32ad7','[\"*\"]',NULL,NULL,'2026-03-22 12:26:49','2026-03-22 12:26:49'),(123,'App\\Models\\Usuario',1,'api-token','d6ccbc1a25d54532a10eff30d50aee7a497e88519bea5e80ccae5b7af246e7cc','[\"*\"]','2026-03-23 02:50:07',NULL,'2026-03-23 02:48:43','2026-03-23 02:50:07'),(125,'App\\Models\\Usuario',1,'api-token','1c9b5debc02c689ef87fd891142dd14ef81f840255cb6661338fecf78b7938f7','[\"*\"]','2026-03-23 06:13:33',NULL,'2026-03-23 05:48:26','2026-03-23 06:13:33'),(129,'App\\Models\\Usuario',11,'api-token','156c8dfc607c76592fd755bba908cd4ac015b5a014c320f2304485c1c86cdfac','[\"*\"]',NULL,NULL,'2026-03-23 08:34:13','2026-03-23 08:34:13'),(130,'App\\Models\\Usuario',11,'api-token','23904a008726519cded6b2113ff89197db60ebbc16c53a90a84cbda64f85b3fd','[\"*\"]','2026-03-24 10:43:24',NULL,'2026-03-24 10:17:05','2026-03-24 10:43:24'),(132,'App\\Models\\Usuario',11,'api-token','038018482588c14175ce1ad7636292bb5ea2e900db3b93fa83b01514a679809f','[\"*\"]','2026-03-24 12:41:21',NULL,'2026-03-24 12:11:23','2026-03-24 12:41:21'),(133,'App\\Models\\Usuario',11,'api-token','bf3024e5495d9212349ef88f9f8020150573d35fc8444334d75527b2cfc8a8bb','[\"*\"]','2026-03-24 12:59:39',NULL,'2026-03-24 12:46:37','2026-03-24 12:59:39'),(138,'App\\Models\\Usuario',11,'api-token','5127a895c5982b277149afcafbdb32c1b4b9b0cd9ae6aff7b95dd7858093ea9d','[\"*\"]','2026-03-26 13:36:26',NULL,'2026-03-26 13:09:49','2026-03-26 13:36:26'),(139,'App\\Models\\Usuario',11,'api-token','845b4d2a1f8daef5fc19e234324e20ffe72df94e919f40c998ebb8e5ab9f171a','[\"*\"]','2026-03-26 14:31:38',NULL,'2026-03-26 14:02:02','2026-03-26 14:31:38'),(142,'App\\Models\\Usuario',11,'api-token','40d6654b4d762a79211e2f27c2cdad018e0403f13cb09ca77aeb3cce24ca391c','[\"*\"]','2026-03-26 15:40:38',NULL,'2026-03-26 15:12:24','2026-03-26 15:40:38');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plazas`
--

DROP TABLE IF EXISTS `plazas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plazas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned NOT NULL COMMENT 'Quien publica',
  `ciudad_id` bigint(20) unsigned NOT NULL,
  `categoria_laboral_id` bigint(20) unsigned NOT NULL,
  `cargo_id` bigint(20) unsigned NOT NULL,
  `actividad_laboral_id` bigint(20) unsigned DEFAULT NULL,
  `nivel_educativo_id` bigint(20) unsigned DEFAULT NULL,
  `sexo_id` bigint(20) unsigned DEFAULT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `requisitos` text DEFAULT NULL,
  `beneficios` text DEFAULT NULL,
  `tipo_contratacion` varchar(50) NOT NULL COMMENT 'tiempo completo, medio tiempo, freelance',
  `experiencia_minima` int(10) unsigned DEFAULT NULL COMMENT 'años',
  `edad_minima` int(10) unsigned DEFAULT NULL,
  `edad_maxima` int(10) unsigned DEFAULT NULL,
  `salario_min` decimal(10,2) DEFAULT NULL,
  `salario_max` decimal(10,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 activa, 0 inactiva',
  `fecha_publicacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_cierre` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `vistas` int(10) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_usuario` (`usuario_id`),
  KEY `idx_ciudad` (`ciudad_id`),
  KEY `idx_categoria` (`categoria_laboral_id`),
  KEY `idx_cargo` (`cargo_id`),
  KEY `fk_plaza_actividad` (`actividad_laboral_id`),
  KEY `fk_plaza_nivel` (`nivel_educativo_id`),
  KEY `fk_plaza_sexo` (`sexo_id`),
  CONSTRAINT `fk_plaza_actividad` FOREIGN KEY (`actividad_laboral_id`) REFERENCES `cat_actividades_laborales` (`id`),
  CONSTRAINT `fk_plaza_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cat_cargos_laborales` (`id`),
  CONSTRAINT `fk_plaza_categoria` FOREIGN KEY (`categoria_laboral_id`) REFERENCES `cat_categorias_laborales` (`id`),
  CONSTRAINT `fk_plaza_ciudad` FOREIGN KEY (`ciudad_id`) REFERENCES `cat_ciudades` (`id`),
  CONSTRAINT `fk_plaza_nivel` FOREIGN KEY (`nivel_educativo_id`) REFERENCES `cat_niveles_educativos` (`id`),
  CONSTRAINT `fk_plaza_sexo` FOREIGN KEY (`sexo_id`) REFERENCES `cat_sexos` (`id`),
  CONSTRAINT `fk_plaza_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plazas`
--

LOCK TABLES `plazas` WRITE;
/*!40000 ALTER TABLE `plazas` DISABLE KEYS */;
INSERT INTO `plazas` VALUES (1,1,172,2,14,1,5,2,'Oficial de Negocios','Prueba','Prueba','Prueba','Tiempo completo',18,15,133,100.00,1110.00,1,'2026-03-16 00:20:56','2026-03-16','2026-03-16 00:20:56','2026-03-23 07:36:39',0),(2,1,4,2,3,3,1,1,'Prueba Titulo','Prueba Desc','* 3\n*4','Benf1\nBen2','Por contrato',10,15,40,100.00,150.00,0,'2026-03-16 00:32:51','2026-03-26','2026-03-16 00:32:51','2026-03-23 08:07:28',0),(3,1,102,2,8,3,4,1,'Programador Senior','Se busca programador backend experto etc.','* Mayor a 30 años\n* Experiencia de 5 años\n* Manejo de lenguajes X\n* Proactivo\n* Disponibilidad de horario','* Seguro dental privado\n* Horarios flexibles\n* Trabajo remoto\n* Bono de salario','Tiempo completo',5,30,50,40000.00,45000.00,1,'2026-03-22 20:47:10','2026-04-11','2026-03-22 20:47:10','2026-03-23 07:36:23',0),(4,1,110,2,10,24,5,1,'DevOps','Se requiere programador Senior\nRespuesta inmediata\nProactivo','* Disponibilidad de horario\n* Entusiasta\n* Innovador','* Seguro dental privado\n* Bonos\n* Horas extras','Por contrato',4,35,38,50000.00,55000.00,1,'2026-03-23 01:26:49','2026-04-11','2026-03-23 01:26:49','2026-03-23 07:36:48',0);
/*!40000 ALTER TABLE `plazas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postulaciones`
--

DROP TABLE IF EXISTS `postulaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postulaciones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plaza_id` bigint(20) unsigned NOT NULL,
  `usuario_id` bigint(20) unsigned NOT NULL COMMENT 'Postulante',
  `estado` varchar(50) NOT NULL DEFAULT 'en_revision' COMMENT 'en_revision, preseleccionado, rechazado, contratado',
  `comentario_admin` text DEFAULT NULL,
  `fecha_postulacion` timestamp NULL DEFAULT current_timestamp(),
  `fecha_respuesta` timestamp NULL DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL COMMENT 'Ruta del CV si se permite subir',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_postulacion_unica` (`plaza_id`,`usuario_id`),
  KEY `idx_plaza` (`plaza_id`),
  KEY `idx_usuario` (`usuario_id`),
  KEY `idx_estado` (`estado`),
  CONSTRAINT `fk_postulacion_plaza` FOREIGN KEY (`plaza_id`) REFERENCES `plazas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_postulacion_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postulaciones`
--

LOCK TABLES `postulaciones` WRITE;
/*!40000 ALTER TABLE `postulaciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `postulaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_nombre_unique` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrador del sistema',1,'2026-02-07 03:03:09','2026-02-07 03:03:09'),(2,'postulante','Usuario postulante a empleos',1,'2026-02-07 03:03:09','2026-03-09 05:25:30'),(5,'intermedio','Rol de Prueba',1,'2026-03-09 03:12:17','2026-03-09 05:25:58');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles_permisos`
--

DROP TABLE IF EXISTS `roles_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles_permisos` (
  `rol_id` bigint(20) unsigned NOT NULL,
  `permiso_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`rol_id`,`permiso_id`),
  KEY `roles_permisos_permiso_id_foreign` (`permiso_id`),
  CONSTRAINT `roles_permisos_permiso_id_foreign` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `roles_permisos_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles_permisos`
--

LOCK TABLES `roles_permisos` WRITE;
/*!40000 ALTER TABLE `roles_permisos` DISABLE KEYS */;
INSERT INTO `roles_permisos` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(2,2),(2,3),(2,9),(2,21),(5,1),(5,2),(5,3),(5,4),(5,5),(5,6),(5,7),(5,8),(5,9),(5,10),(5,15),(5,16),(5,17),(5,18),(5,19),(5,20),(5,21),(5,22);
/*!40000 ALTER TABLE `roles_permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sesiones` (
  `id` varchar(255) NOT NULL,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `direccion_ip` varchar(45) DEFAULT NULL,
  `agente_usuario` text DEFAULT NULL,
  `contenido` longtext NOT NULL,
  `ultima_actividad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sesiones_usuario_id_index` (`usuario_id`),
  KEY `sesiones_ultima_actividad_index` (`ultima_actividad`),
  CONSTRAINT `sesiones_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sesiones`
--

LOCK TABLES `sesiones` WRITE;
/*!40000 ALTER TABLE `sesiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `sesiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonios`
--

DROP TABLE IF EXISTS `testimonios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) unsigned DEFAULT NULL,
  `nombre_publico` varchar(100) NOT NULL COMMENT 'Nombre que se mostrará en el sitio',
  `calificacion` tinyint(3) unsigned NOT NULL COMMENT '1 a 5 estrellas',
  `comentario` text NOT NULL,
  `aprobado` tinyint(1) NOT NULL DEFAULT 0,
  `visible` tinyint(1) NOT NULL DEFAULT 1,
  `destacado` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Para carrusel principal',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_aprobado` (`aprobado`),
  KEY `idx_visible` (`visible`),
  KEY `fk_testimonios_usuario` (`usuario_id`),
  CONSTRAINT `fk_testimonios_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonios`
--

LOCK TABLES `testimonios` WRITE;
/*!40000 ALTER TABLE `testimonios` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_verificaciones`
--

DROP TABLE IF EXISTS `usuario_verificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_verificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expira_en` datetime NOT NULL,
  `usado` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_verificaciones`
--

LOCK TABLES `usuario_verificaciones` WRITE;
/*!40000 ALTER TABLE `usuario_verificaciones` DISABLE KEYS */;
INSERT INTO `usuario_verificaciones` VALUES (1,4,'fd205da2-68b1-4471-9a65-ef6f09f00244','2026-03-02 01:05:13',0,'2026-03-01 18:35:13'),(2,4,'test-token','2026-03-01 18:43:39',0,'2026-03-01 18:43:39'),(3,4,'test-token','2026-03-01 18:47:57',0,'2026-03-01 18:47:57'),(4,5,'ccc533a6-8e60-42ed-b7c4-797caf5deb01','2026-03-02 01:19:21',0,'2026-03-01 18:49:21'),(5,6,'44421456-3314-4c8a-abc2-93336f3af02f','2026-03-02 03:19:21',1,'2026-03-01 20:49:21'),(6,6,'79303912-7ce8-4853-a682-b75b86eff3db','2026-03-02 03:53:47',1,'2026-03-01 21:23:47'),(7,7,'5d1d5a53-7d0b-461b-a5b4-c94f288f9a22','2026-03-02 03:55:02',1,'2026-03-01 21:25:02'),(8,8,'261e9ce4-4eea-4213-a74a-c1e353e2bd6e','2026-03-02 04:09:02',1,'2026-03-01 21:39:02'),(9,7,'2499c717-6123-41b1-88af-31990cd69b7d','2026-03-02 04:25:34',0,'2026-03-01 21:55:34'),(10,9,'6c08b6d9-13ed-4d1e-b5a4-85cfdba671d8','2026-03-06 07:15:42',0,'2026-03-06 00:45:42'),(11,10,'9e51b57c-8ec6-4a17-b6be-14b1d9317b74','2026-03-06 07:19:49',0,'2026-03-06 00:49:49'),(12,11,'6025dcc6-8bc6-4669-9425-158e64a26676','2026-03-06 07:24:47',1,'2026-03-06 00:54:47'),(13,15,'8dec81b2-3cec-4e4c-b169-bb2adef52f65','2026-03-07 08:17:27',1,'2026-03-07 01:47:27');
/*!40000 ALTER TABLE `usuario_verificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1,
  `intentos_fallidos` int(11) DEFAULT 0,
  `bloqueado_hasta` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Jose Fernando','Gomez Lagoss','jcempleosunah@gmail.com','2026-02-07 03:05:26','$2y$12$gj3IGTzxUbz980d5yLp1H.PsIDD5kGCRcO/0B/fZ8S3PHYOIlEhnq',NULL,'2026-02-07 03:03:46','2026-03-08 22:05:07',1,0,NULL),(2,'Juan','Pérez','juan@email.com',NULL,'$2y$12$1GLJ3uTS0TTT21ovn4/CNO/YXh1MfcD.GrYrAbBAgbv3UrAF94aKm',NULL,'2026-02-21 08:29:54','2026-03-09 01:22:00',0,0,NULL),(5,'Prueba','Test','correo@email.comm',NULL,'$2y$12$8.UKZipkJ6oRW4kYCB5eKek24SwoylqY.e9d7c7w.Wr0TOkWB.2wa',NULL,'2026-03-02 00:49:20','2026-03-09 01:23:30',0,0,NULL),(6,'Test','Prueba','correo1@correo.com','2026-03-02 03:24:17','$2y$12$z8OGNFi7TWUcZNTdEegeQeCgOUwVova8A3anIephMt3kEz6wCsLxS',NULL,'2026-03-02 02:49:21','2026-03-08 22:49:42',0,0,NULL),(7,'Prueba','Prueba','correo2@correo.com',NULL,'$2y$12$4kgukItYRl3tT9HgKr8nCeJB2SfV6DBI65TSPXKEWHiXGp9Ga.En.',NULL,'2026-03-02 03:25:02','2026-03-02 03:25:02',1,0,NULL),(8,'Test','Testttttttt','correo3@correo.comm','2026-03-02 03:39:27','$2y$12$n/Imabe6I/yfMt3bxHu2kuB5A0ETE9hZQwVvIGuJT7aQ5afp1HIvu',NULL,'2026-03-02 03:39:02','2026-03-08 22:05:39',1,0,NULL),(11,'Prueba','Test','mizanvs014@gmail.com','2026-03-06 06:56:52','$2y$12$TvpBL7ypTYqlJQPDSx4GRuWTTbqWZTmuVPp.g/W.dnddvlrk.eo4W',NULL,'2026-03-06 06:54:47','2026-03-09 00:29:50',1,0,NULL),(12,'Juan','Perez','test@email.com',NULL,'12345678',NULL,'2026-03-07 03:29:08','2026-03-24 08:29:37',0,0,NULL),(13,'Juana Paola','Marquez Urbina','afgas111095@gmail.comm',NULL,'12345678',NULL,'2026-03-07 03:42:49','2026-03-07 04:13:35',1,0,NULL),(14,'Prueba','Prueba','aaaaa@aaa.com',NULL,'12345678',NULL,'2026-03-07 03:51:13','2026-03-07 03:51:13',1,0,NULL),(15,'Prueb','afsfsf','mizanvs01496@gmail.com','2026-03-07 07:48:24','$2y$12$DekdUuNKSi7AxpiAeKsA3ujLV1wy.bgN.7ltmNYD5tfa4yDmV1d9q',NULL,'2026-03-07 07:47:25','2026-03-07 07:49:29',1,0,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_roles`
--

DROP TABLE IF EXISTS `usuarios_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_roles` (
  `usuario_id` bigint(20) unsigned NOT NULL,
  `rol_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`usuario_id`,`rol_id`),
  UNIQUE KEY `usuario_id` (`usuario_id`),
  KEY `usuarios_roles_rol_id_foreign` (`rol_id`),
  CONSTRAINT `usuarios_roles_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `usuarios_roles_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_roles`
--

LOCK TABLES `usuarios_roles` WRITE;
/*!40000 ALTER TABLE `usuarios_roles` DISABLE KEYS */;
INSERT INTO `usuarios_roles` VALUES (1,1),(2,2),(5,2),(6,2),(7,2),(8,5),(11,2),(12,2),(13,2),(14,2),(15,2);
/*!40000 ALTER TABLE `usuarios_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'jcempleoshn'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_guardar_permiso_rol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_permiso_rol`(

    IN p_rol_id INT,

    IN p_permiso_id INT,

    IN p_activo TINYINT

)
BEGIN



IF p_activo = 1 THEN



    IF NOT EXISTS(

        SELECT 1

        FROM rol_permiso

        WHERE rol_id = p_rol_id

        AND permiso_id = p_permiso_id

    ) THEN



        INSERT INTO rol_permiso(

            rol_id,

            permiso_id

        )

        VALUES(

            p_rol_id,

            p_permiso_id

        );



    END IF;



ELSE



    DELETE FROM rol_permiso

    WHERE rol_id = p_rol_id

    AND permiso_id = p_permiso_id;



END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_roles_permisos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_roles_permisos`()
BEGIN



SELECT

r.id AS rol_id,

r.nombre AS rol,

p.id AS permiso_id,

p.nombre AS permiso,

p.modulo,

CASE 

    WHEN rp.permiso_id IS NULL THEN 0

    ELSE 1

END AS activo



FROM roles r



CROSS JOIN permisos p



LEFT JOIN rol_permiso rp

    ON rp.rol_id = r.id

    AND rp.permiso_id = p.id



WHERE r.estado = 1



ORDER BY r.nombre, p.modulo, p.nombre;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_usuario_por_email` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_por_email`(
    IN p_email VARCHAR(255)
)
BEGIN
    SELECT 
        id,
        nombre,
        apellido,
        email,
        password,
        email_verified_at,
        created_at,
        updated_at
    FROM usuarios
    WHERE email = p_email
    LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_cambiar_clave` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_cambiar_clave`(

    IN p_usuario_id BIGINT,

    IN p_nueva_clave VARCHAR(255)

)
BEGIN



    START TRANSACTION;



    UPDATE usuarios

    SET password = p_nueva_clave,

        updated_at = NOW()

    WHERE id = p_usuario_id;



    INSERT INTO bitacora(

        usuario_id,

        modulo,

        accion,

        descripcion,

        created_at

    )

    VALUES(

        p_usuario_id,

        'autenticacion',

        'cambiar_clave',

        'Usuario cambió su contraseña',

        NOW()

    );



    COMMIT;



    SELECT 1 AS success,

           'Contraseña actualizada correctamente.' AS message,

           NULL AS data;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_generar_codigo_reset` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_generar_codigo_reset`(

    IN p_email VARCHAR(255),

    IN p_codigo VARCHAR(255)

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;



    -- Verificar que el usuario exista

    SELECT COUNT(*) INTO v_existe

    FROM usuarios

    WHERE email = p_email;



    IF v_existe = 0 THEN



        SELECT 0 AS success;



    ELSE



        -- Eliminar código anterior (porque email es PK)

        DELETE FROM password_reset_tokens

        WHERE email = p_email;



        -- Insertar nuevo código

        INSERT INTO password_reset_tokens (

            email,

            token,

            created_at

        )

        VALUES (

            p_email,

            p_codigo,

            NOW()

        );



        SELECT 1 AS success;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_intento_fallido` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_intento_fallido`(

    IN p_usuario_id BIGINT

)
BEGIN



    DECLARE v_intentos INT;



    START TRANSACTION;



    SELECT intentos_fallidos

    INTO v_intentos

    FROM usuarios

    WHERE id = p_usuario_id;



    SET v_intentos = v_intentos + 1;



    UPDATE usuarios

    SET intentos_fallidos = v_intentos

    WHERE id = p_usuario_id;



    -- Si llega a 5 intentos → bloquear 15 minutos

    IF v_intentos >= 5 THEN



        UPDATE usuarios

        SET bloqueado_hasta = DATE_ADD(NOW(), INTERVAL 15 MINUTE),

            intentos_fallidos = 0

        WHERE id = p_usuario_id;



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'autenticacion',

            'bloqueo',

            'Usuario bloqueado por intentos fallidos',

            NOW()

        );



    END IF;



    COMMIT;



    SELECT 1 AS success,

           'Intento registrado.' AS message,

           NULL AS data;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_login`(IN `p_email` VARCHAR(255))
BEGIN



    DECLARE v_existe INT DEFAULT 0;

    DECLARE v_estado TINYINT DEFAULT 0;

    DECLARE v_usuario_id BIGINT;

    DECLARE v_bloqueado_hasta DATETIME;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        SELECT 

            0 AS success,

            'Error interno en autenticación.' AS message,

            NULL AS data;

    END;



    SELECT COUNT(*) INTO v_existe

    FROM usuarios

    WHERE email = p_email;



    IF v_existe = 0 THEN



        SELECT 0 AS success,

               'Credenciales inválidas.' AS message,

               NULL AS data;



    ELSE



        SELECT id, estado, bloqueado_hasta

        INTO v_usuario_id, v_estado, v_bloqueado_hasta

        FROM usuarios

        WHERE email = p_email

        LIMIT 1;



        IF v_estado = 0 THEN



            SELECT 0 AS success,

                   'Usuario inactivo.' AS message,

                   NULL AS data;



        ELSEIF v_bloqueado_hasta IS NOT NULL 

            AND v_bloqueado_hasta > NOW() THEN



            SELECT 0 AS success,

                   CONCAT('Usuario bloqueado hasta ', v_bloqueado_hasta) AS message,

                   NULL AS data;



        ELSE



            SELECT 1 AS success,

       'Usuario válido.' AS message,

       JSON_OBJECT(

           'id', id,

           'nombre', nombre,

           'apellido', apellido,

           'email', email,

           'password', password,

           'email_verified_at', email_verified_at

       ) AS data

FROM usuarios

WHERE id = v_usuario_id;



        END IF;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_obtener_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_obtener_usuario`(

    IN p_usuario_id BIGINT

)
BEGIN



    SELECT 

        1 AS success,

        'Usuario autenticado.' AS message,

        JSON_OBJECT(

            'id', id,

            'nombre', nombre,

            'apellido', apellido,

            'email', email

        ) AS data

    FROM usuarios

    WHERE id = p_usuario_id

    LIMIT 1;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_registrar_login` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_registrar_login`(

    IN p_usuario_id BIGINT

)
BEGIN



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 

            0 AS success,

            'Error al registrar login.' AS message,

            NULL AS data;

    END;



    START TRANSACTION;



    -- 🔄 Resetear intentos y desbloquear

    UPDATE usuarios

    SET intentos_fallidos = 0,

        bloqueado_hasta = NULL

    WHERE id = p_usuario_id;



    -- 📝 Registrar en bitácora

    INSERT INTO bitacora(

        usuario_id,

        modulo,

        accion,

        descripcion,

        created_at

    )

    VALUES(

        p_usuario_id,

        'autenticacion',

        'login',

        'Inicio de sesión exitoso',

        NOW()

    );



    COMMIT;



    SELECT 

        1 AS success,

        'Login registrado.' AS message,

        NULL AS data;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_registrar_logout` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_registrar_logout`(

    IN p_usuario_id BIGINT

)
BEGIN



    INSERT INTO bitacora(

        usuario_id,

        modulo,

        accion,

        descripcion,

        created_at

    )

    VALUES(

        p_usuario_id,

        'autenticacion',

        'logout',

        'Usuario cerró sesión',

        NOW()

    );



    SELECT 1 AS success,

           'Logout registrado.' AS message,

           NULL AS data;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_reset_password` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_reset_password`(

    IN p_email VARCHAR(255),

    IN p_password VARCHAR(255)

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;



    SELECT COUNT(*) INTO v_existe

    FROM password_reset_tokens

    WHERE email = p_email;



    IF v_existe = 0 THEN



        SELECT 0 AS success;



    ELSE



        UPDATE usuarios

        SET password = p_password,

            updated_at = NOW()

        WHERE email = p_email;



        DELETE FROM password_reset_tokens

        WHERE email = p_email;



        SELECT 1 AS success;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_autenticacion_verificar_codigo_reset` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_autenticacion_verificar_codigo_reset`(

    IN p_email VARCHAR(255),

    IN p_codigo VARCHAR(255)

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;



    SELECT COUNT(*) INTO v_existe

    FROM password_reset_tokens

    WHERE email = p_email

      AND token = p_codigo;



    IF v_existe = 0 THEN

        SELECT 0 AS success;

    ELSE

        SELECT 1 AS success;

    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_catalogos_actividades` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_catalogos_actividades`()
BEGIN



SELECT

    id,

    nombre

FROM cat_actividades_laborales

WHERE estado = 1

ORDER BY nombre;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_catalogos_cargos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_catalogos_cargos`()
BEGIN

SELECT
    c.id,
    c.nombre,
    c.categoria_laboral_id,
    cat.nombre AS categoria

FROM cat_cargos_laborales c

JOIN cat_categorias_laborales cat
    ON cat.id = c.categoria_laboral_id

WHERE c.estado = 1

ORDER BY c.nombre;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_catalogos_categorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_catalogos_categorias`()
BEGIN



SELECT

    id,

    nombre

FROM cat_categorias_laborales

WHERE estado = 1

ORDER BY nombre;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_catalogos_ciudades` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_catalogos_ciudades`()
BEGIN

SELECT
    c.id,
    c.nombre,
    c.departamento_id,      
    d.nombre AS departamento

FROM cat_ciudades c

JOIN cat_departamentos d 
    ON d.id = c.departamento_id

ORDER BY c.nombre;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_catalogos_departamentos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_catalogos_departamentos`()
BEGIN



SELECT

    id,

    nombre

FROM cat_departamentos

ORDER BY nombre;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_catalogos_niveles_educativos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_catalogos_niveles_educativos`()
BEGIN



SELECT

    id,

    nombre

FROM cat_niveles_educativos

ORDER BY nombre;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_catalogos_sexos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_catalogos_sexos`()
BEGIN



SELECT

    id,

    nombre

FROM cat_sexos

ORDER BY nombre;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_actualizar`(

    IN p_usuario_id BIGINT,

    IN p_pais_id BIGINT,

    IN p_departamento_id BIGINT,

    IN p_ciudad_id BIGINT,

    IN p_sexo_id BIGINT,

    IN p_nacionalidad_id BIGINT,

    IN p_disponibilidad_vehicular_id BIGINT,

    IN p_fecha_nacimiento DATE,

    IN p_telefono VARCHAR(20),

    IN p_foto VARCHAR(255),

    IN p_acerca_de_mi TEXT

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 

            0 AS success,

            'Error interno al actualizar perfil.' AS message,

            NULL AS data;

    END;



    START TRANSACTION;



    -- Verificar que el perfil exista

    SELECT COUNT(*) INTO v_existe

    FROM perfiles

    WHERE usuario_id = p_usuario_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 

            0 AS success,

            'Perfil no encontrado.' AS message,

            NULL AS data;



    ELSE



        UPDATE perfiles

        SET

            pais_id = p_pais_id,

            departamento_id = p_departamento_id,

            ciudad_id = p_ciudad_id,

            sexo_id = p_sexo_id,

            nacionalidad_id = p_nacionalidad_id,

            disponibilidad_vehicular_id = p_disponibilidad_vehicular_id,

            fecha_nacimiento = p_fecha_nacimiento,

            telefono = p_telefono,

            foto = p_foto,

            acerca_de_mi = p_acerca_de_mi,

            updated_at = NOW()

        WHERE usuario_id = p_usuario_id;



        -- Bitácora

        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfiles',

            'actualizar',

            CONCAT('Actualizó su perfil'),

            NOW()

        );



        COMMIT;



        SELECT 

            1 AS success,

            'Perfil actualizado correctamente.' AS message,

            NULL AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_cv_completo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_cv_completo`(

    IN p_usuario_id BIGINT

)
BEGIN



    DECLARE v_perfil_id BIGINT;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    IF v_perfil_id IS NULL THEN



        SELECT 

            0 AS success,

            'Perfil no encontrado.' AS message,

            NULL AS data;



    ELSE



        SELECT 

            1 AS success,

            'CV obtenido correctamente.' AS message,

            JSON_OBJECT(



                'perfil', (

                    SELECT JSON_OBJECT(

                        'id', p.id,

                        'telefono', p.telefono,

                        'fecha_nacimiento', p.fecha_nacimiento,

                        'acerca_de_mi', p.acerca_de_mi,

                        'pais', cp.nombre,

                        'departamento', cd.nombre,

                        'ciudad', cc.nombre,

                        'sexo', cs.nombre,

                        'nacionalidad', cn.nombre,

                        'disponibilidad_vehicular', dv.nombre

                    )

                    FROM perfiles p

                    LEFT JOIN cat_paises cp ON cp.id = p.pais_id

                    LEFT JOIN cat_departamentos cd ON cd.id = p.departamento_id

                    LEFT JOIN cat_ciudades cc ON cc.id = p.ciudad_id

                    LEFT JOIN cat_sexos cs ON cs.id = p.sexo_id

                    LEFT JOIN cat_nacionalidades cn ON cn.id = p.nacionalidad_id

                    LEFT JOIN cat_disponibilidad_vehicular dv ON dv.id = p.disponibilidad_vehicular_id

                    WHERE p.id = v_perfil_id

                ),



                'educacion', (

                    SELECT JSON_ARRAYAGG(

                        JSON_OBJECT(

                            'id', pe.id,

                            'institucion', pe.institucion,

                            'nivel', ne.nombre,

                            'area_estudio', ae.nombre,

                            'fecha_desde', pe.fecha_desde,

                            'fecha_hasta', pe.fecha_hasta

                        )

                    )

                    FROM perfiles_educacion pe

                    LEFT JOIN cat_niveles_educativos ne ON ne.id = pe.nivel_educativo_id

                    LEFT JOIN cat_areas_estudio ae ON ae.id = pe.area_estudio_id

                    WHERE pe.perfil_id = v_perfil_id

                ),



                'experiencia', (

                    SELECT JSON_ARRAYAGG(

                        JSON_OBJECT(

                            'id', px.id,

                            'empresa', px.empresa,

                            'pais', cp.nombre,

                            'cargo', px.cargo,

                            'fecha_desde', px.fecha_desde,

                            'fecha_hasta', px.fecha_hasta,

                            'descripcion', px.descripcion

                        )

                    )

                    FROM perfiles_experiencias px

                    LEFT JOIN cat_paises cp ON cp.id = px.pais_id

                    WHERE px.perfil_id = v_perfil_id

                ),



                'idiomas', (

                    SELECT JSON_ARRAYAGG(

                        JSON_OBJECT(

                            'id', pi.id,

                            'idioma', i.nombre,

                            'nivel', ni.nombre

                        )

                    )

                    FROM perfiles_idiomas pi

                    LEFT JOIN cat_idiomas i ON i.id = pi.idioma_id

                    LEFT JOIN cat_niveles_idioma ni ON ni.id = pi.nivel_id

                    WHERE pi.perfil_id = v_perfil_id

                )



            ) AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_educacion_actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_educacion_actualizar`(

    IN p_usuario_id BIGINT,

    IN p_educacion_id BIGINT,

    IN p_institucion VARCHAR(150),

    IN p_nivel_educativo_id BIGINT,

    IN p_area_estudio_id BIGINT,

    IN p_fecha_desde DATE,

    IN p_fecha_hasta DATE

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al actualizar educación.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    -- Obtener perfil

    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    -- Verificar que la educación pertenezca al perfil

    SELECT COUNT(*) INTO v_existe

    FROM perfiles_educacion

    WHERE id = p_educacion_id

      AND perfil_id = v_perfil_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Educación no encontrada.' AS message,

               NULL AS data;



    ELSE



        UPDATE perfiles_educacion

        SET

            institucion = p_institucion,

            nivel_educativo_id = p_nivel_educativo_id,

            area_estudio_id = p_area_estudio_id,

            fecha_desde = p_fecha_desde,

            fecha_hasta = p_fecha_hasta,

            updated_at = NOW()

        WHERE id = p_educacion_id;



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_educacion',

            'actualizar',

            CONCAT('Actualizó educación ID ', p_educacion_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Educación actualizada correctamente.' AS message,

               NULL AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_educacion_agregar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_educacion_agregar`(

    IN p_usuario_id BIGINT,

    IN p_institucion VARCHAR(150),

    IN p_nivel_educativo_id BIGINT,

    IN p_area_estudio_id BIGINT,

    IN p_fecha_desde DATE,

    IN p_fecha_hasta DATE

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;

    DECLARE v_educacion_id BIGINT;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al agregar educación.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    -- Obtener perfil

    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    IF v_perfil_id IS NULL THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Perfil no encontrado.' AS message,

               NULL AS data;



    ELSE



        INSERT INTO perfiles_educacion(

            perfil_id,

            institucion,

            nivel_educativo_id,

            area_estudio_id,

            fecha_desde,

            fecha_hasta,

            created_at,

            updated_at

        )

        VALUES(

            v_perfil_id,

            p_institucion,

            p_nivel_educativo_id,

            p_area_estudio_id,

            p_fecha_desde,

            p_fecha_hasta,

            NOW(),

            NOW()

        );



        SET v_educacion_id = LAST_INSERT_ID();



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_educacion',

            'agregar',

            CONCAT('Agregó educación ID ', v_educacion_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Educación agregada correctamente.' AS message,

               JSON_OBJECT('educacion_id', v_educacion_id) AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_educacion_eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_educacion_eliminar`(

    IN p_usuario_id BIGINT,

    IN p_educacion_id BIGINT

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al eliminar educación.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    -- Obtener perfil

    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    -- Verificar pertenencia

    SELECT COUNT(*) INTO v_existe

    FROM perfiles_educacion

    WHERE id = p_educacion_id

      AND perfil_id = v_perfil_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Educación no encontrada.' AS message,

               NULL AS data;



    ELSE



        DELETE FROM perfiles_educacion

        WHERE id = p_educacion_id;



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_educacion',

            'eliminar',

            CONCAT('Eliminó educación ID ', p_educacion_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Educación eliminada correctamente.' AS message,

               NULL AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_educacion_listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_educacion_listar`(
    IN p_usuario_id BIGINT
)
BEGIN

    DECLARE v_perfil_id BIGINT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 
            0 AS success,
            'Error interno al obtener educación.' AS message;
    END;

    -- Obtener perfil
    SELECT id INTO v_perfil_id
    FROM perfiles
    WHERE usuario_id = p_usuario_id
    LIMIT 1;

    IF v_perfil_id IS NULL THEN

        SELECT 
            0 AS success,
            'Perfil no encontrado.' AS message;

    ELSE

        SELECT 
            pe.id,
            pe.institucion,
            pe.nivel_educativo_id,
            ne.nombre AS nivel_educativo,
            pe.area_estudio_id,
            ae.nombre AS area_estudio,
            pe.fecha_desde,
            pe.fecha_hasta,
            pe.created_at,
            pe.updated_at
        FROM perfiles_educacion pe
        LEFT JOIN cat_niveles_educativos ne ON ne.id = pe.nivel_educativo_id
        LEFT JOIN cat_areas_estudio ae ON ae.id = pe.area_estudio_id
        WHERE pe.perfil_id = v_perfil_id
        ORDER BY pe.fecha_desde DESC;

    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_educacion_listar_BK` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_educacion_listar_BK`(IN `p_usuario_id` BIGINT)
BEGIN



    DECLARE v_perfil_id BIGINT;



    -- Obtener perfil

    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    IF v_perfil_id IS NULL THEN



        SELECT 

            0 AS success,

            'Perfil no encontrado.' AS message,

            NULL AS data;



    ELSE



        SELECT 

            1 AS success,

            'Educación obtenida correctamente.' AS message,

            NULL AS data;



        SELECT 

            pe.id,

            pe.institucion,

            pe.nivel_educativo_id,

            ne.nombre AS nivel_educativo,

            pe.area_estudio_id,

            ae.nombre AS area_estudio,

            pe.fecha_desde,

            pe.fecha_hasta,

            pe.created_at,

            pe.updated_at

        FROM perfiles_educacion pe

        LEFT JOIN cat_niveles_educativos ne ON ne.id = pe.nivel_educativo_id

        LEFT JOIN cat_areas_estudio ae ON ae.id = pe.area_estudio_id

        WHERE pe.perfil_id = v_perfil_id

        ORDER BY pe.fecha_desde DESC;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_experiencia_actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_experiencia_actualizar`(

    IN p_usuario_id BIGINT,

    IN p_experiencia_id BIGINT,

    IN p_empresa VARCHAR(150),

    IN p_pais_id BIGINT,

    IN p_cargo VARCHAR(150),

    IN p_fecha_desde DATE,

    IN p_fecha_hasta DATE,

    IN p_descripcion TEXT

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al actualizar experiencia.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    SELECT COUNT(*) INTO v_existe

    FROM perfiles_experiencias

    WHERE id = p_experiencia_id

      AND perfil_id = v_perfil_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Experiencia no encontrada.' AS message,

               NULL AS data;



    ELSE



        UPDATE perfiles_experiencias

        SET

            empresa = p_empresa,

            pais_id = p_pais_id,

            cargo = p_cargo,

            fecha_desde = p_fecha_desde,

            fecha_hasta = p_fecha_hasta,

            descripcion = p_descripcion,

            updated_at = NOW()

        WHERE id = p_experiencia_id;



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_experiencia',

            'actualizar',

            CONCAT('Actualizó experiencia ID ', p_experiencia_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Experiencia actualizada correctamente.' AS message,

               NULL AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_experiencia_agregar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_experiencia_agregar`(

    IN p_usuario_id BIGINT,

    IN p_empresa VARCHAR(150),

    IN p_pais_id BIGINT,

    IN p_cargo VARCHAR(150),

    IN p_fecha_desde DATE,

    IN p_fecha_hasta DATE,

    IN p_descripcion TEXT

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_experiencia_id BIGINT;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al agregar experiencia.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    -- Obtener perfil del usuario

    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    IF v_perfil_id IS NULL THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Perfil no encontrado.' AS message,

               NULL AS data;



    ELSE



        INSERT INTO perfiles_experiencias(

            perfil_id,

            empresa,

            pais_id,

            cargo,

            fecha_desde,

            fecha_hasta,

            descripcion,

            created_at,

            updated_at

        )

        VALUES(

            v_perfil_id,

            p_empresa,

            p_pais_id,

            p_cargo,

            p_fecha_desde,

            p_fecha_hasta,

            p_descripcion,

            NOW(),

            NOW()

        );



        SET v_experiencia_id = LAST_INSERT_ID();



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_experiencia',

            'agregar',

            CONCAT('Agregó experiencia ID ', v_experiencia_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Experiencia agregada correctamente.' AS message,

               JSON_OBJECT('experiencia_id', v_experiencia_id) AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_experiencia_eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_experiencia_eliminar`(

    IN p_usuario_id BIGINT,

    IN p_experiencia_id BIGINT

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al eliminar experiencia.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    SELECT COUNT(*) INTO v_existe

    FROM perfiles_experiencias

    WHERE id = p_experiencia_id

      AND perfil_id = v_perfil_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Experiencia no encontrada.' AS message,

               NULL AS data;



    ELSE



        DELETE FROM perfiles_experiencias

        WHERE id = p_experiencia_id;



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_experiencia',

            'eliminar',

            CONCAT('Eliminó experiencia ID ', p_experiencia_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Experiencia eliminada correctamente.' AS message,

               NULL AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_experiencia_listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_experiencia_listar`(IN `p_usuario_id` BIGINT)
BEGIN

    DECLARE v_perfil_id BIGINT;
    DECLARE v_existe INT DEFAULT 0;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 
            0 AS success,
            'Error interno al obtener experiencia.' AS message;
    END;

    -- Validar perfil
    SELECT COUNT(*) INTO v_existe
    FROM perfiles
    WHERE usuario_id = p_usuario_id;

    IF v_existe = 0 THEN

        SELECT 
            0 AS success,
            'Perfil no encontrado.' AS message;

    ELSE

        -- Obtener perfil_id seguro
        SELECT id INTO v_perfil_id
        FROM perfiles
        WHERE usuario_id = p_usuario_id
        LIMIT 1;

        SELECT 
            pe.id,
            pe.empresa,
            pe.pais_id,
            pe.cargo,
            pe.fecha_desde,
            pe.fecha_hasta,
            pe.descripcion,
            pe.created_at,
            pe.updated_at
        FROM perfiles_experiencias pe
        WHERE pe.perfil_id = v_perfil_id
        ORDER BY pe.fecha_desde DESC;

    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_experiencia_listar_BK` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_experiencia_listar_BK`(IN `p_usuario_id` BIGINT)
BEGIN



    DECLARE v_perfil_id BIGINT;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    IF v_perfil_id IS NULL THEN



        SELECT 

            0 AS success,

            'Perfil no encontrado.' AS message,

            NULL AS data;



    ELSE



        SELECT 

            1 AS success,

            'Experiencias obtenidas correctamente.' AS message,

            NULL AS data;



        SELECT 

            pe.id,

            pe.empresa,

            pe.pais_id,

            cp.nombre AS pais,

            pe.cargo,

            pe.fecha_desde,

            pe.fecha_hasta,

            pe.descripcion,

            pe.created_at,

            pe.updated_at

        FROM perfiles_experiencias pe

        LEFT JOIN cat_paises cp ON cp.id = pe.pais_id

        WHERE pe.perfil_id = v_perfil_id

        ORDER BY pe.fecha_desde DESC;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_idioma_actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_idioma_actualizar`(

    IN p_usuario_id BIGINT,

    IN p_registro_id BIGINT,

    IN p_nivel_id BIGINT

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al actualizar idioma.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    SELECT COUNT(*) INTO v_existe

    FROM perfiles_idiomas

    WHERE id = p_registro_id

      AND perfil_id = v_perfil_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Idioma no encontrado.' AS message,

               NULL AS data;



    ELSE



        UPDATE perfiles_idiomas

        SET nivel_id = p_nivel_id,

            updated_at = NOW()

        WHERE id = p_registro_id;



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_idioma',

            'actualizar',

            CONCAT('Actualizó idioma ID ', p_registro_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Idioma actualizado correctamente.' AS message,

               NULL AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_idioma_agregar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_idioma_agregar`(

    IN p_usuario_id BIGINT,

    IN p_idioma_id BIGINT,

    IN p_nivel_id BIGINT

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;

    DECLARE v_registro_id BIGINT;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al agregar idioma.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    SELECT COUNT(*) INTO v_existe

    FROM perfiles_idiomas

    WHERE perfil_id = v_perfil_id

      AND idioma_id = p_idioma_id;



    IF v_existe > 0 THEN



        ROLLBACK;



        SELECT 0 AS success,

               'El idioma ya fue agregado.' AS message,

               NULL AS data;



    ELSE



        INSERT INTO perfiles_idiomas(

            perfil_id,

            idioma_id,

            nivel_id,

            created_at,

            updated_at

        )

        VALUES(

            v_perfil_id,

            p_idioma_id,

            p_nivel_id,

            NOW(),

            NOW()

        );



        SET v_registro_id = LAST_INSERT_ID();



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_idioma',

            'agregar',

            CONCAT('Agregó idioma ID ', v_registro_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Idioma agregado correctamente.' AS message,

               JSON_OBJECT('registro_id', v_registro_id) AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_idioma_eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_idioma_eliminar`(

    IN p_usuario_id BIGINT,

    IN p_registro_id BIGINT

)
BEGIN



    DECLARE v_perfil_id BIGINT;

    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success,

               'Error interno al eliminar idioma.' AS message,

               NULL AS data;

    END;



    START TRANSACTION;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    SELECT COUNT(*) INTO v_existe

    FROM perfiles_idiomas

    WHERE id = p_registro_id

      AND perfil_id = v_perfil_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 0 AS success,

               'Idioma no encontrado.' AS message,

               NULL AS data;



    ELSE



        DELETE FROM perfiles_idiomas

        WHERE id = p_registro_id;



        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_id,

            'perfil_idioma',

            'eliminar',

            CONCAT('Eliminó idioma ID ', p_registro_id),

            NOW()

        );



        COMMIT;



        SELECT 1 AS success,

               'Idioma eliminado correctamente.' AS message,

               NULL AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_idioma_listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_idioma_listar`(
    IN p_usuario_id BIGINT
)
BEGIN

    DECLARE v_perfil_id BIGINT;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        SELECT 
            0 AS success,
            'Error interno al obtener idiomas.' AS message;
    END;

    -- Obtener perfil
    SELECT id INTO v_perfil_id
    FROM perfiles
    WHERE usuario_id = p_usuario_id
    LIMIT 1;

    IF v_perfil_id IS NULL THEN

        SELECT 
            0 AS success,
            'Perfil no encontrado.' AS message;

    ELSE

        SELECT 
            pi.id,
            pi.idioma_id,
            i.nombre AS idioma,
            pi.nivel_id,
            ni.nombre AS nivel,
            pi.created_at,
            pi.updated_at
        FROM perfiles_idiomas pi
        LEFT JOIN cat_idiomas i ON i.id = pi.idioma_id
        LEFT JOIN cat_niveles_idioma ni ON ni.id = pi.nivel_id
        WHERE pi.perfil_id = v_perfil_id
        ORDER BY i.nombre;

    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_idioma_listar_BK` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_idioma_listar_BK`(IN `p_usuario_id` BIGINT)
BEGIN



    DECLARE v_perfil_id BIGINT;



    SELECT id INTO v_perfil_id

    FROM perfiles

    WHERE usuario_id = p_usuario_id

    LIMIT 1;



    IF v_perfil_id IS NULL THEN



        SELECT 0 AS success,

               'Perfil no encontrado.' AS message,

               NULL AS data;



    ELSE



        SELECT 1 AS success,

               'Idiomas obtenidos correctamente.' AS message,

               NULL AS data;



        SELECT 

            pi.id,

            pi.idioma_id,

            i.nombre AS idioma,

            pi.nivel_id,

            ni.nombre AS nivel,

            pi.created_at,

            pi.updated_at

        FROM perfiles_idiomas pi

        LEFT JOIN cat_idiomas i ON i.id = pi.idioma_id

        LEFT JOIN cat_niveles_idioma ni ON ni.id = pi.nivel_id

        WHERE pi.perfil_id = v_perfil_id

        ORDER BY i.nombre;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_perfil_obtener` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_obtener`(

    IN p_usuario_id BIGINT

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        SELECT 

            0 AS success,

            'Error interno al obtener perfil.' AS message,

            NULL AS data;

    END;



    -- Verificar existencia

    SELECT COUNT(*) INTO v_existe

    FROM perfiles

    WHERE usuario_id = p_usuario_id;



    IF v_existe = 0 THEN



        SELECT 

            0 AS success,

            'Perfil no encontrado.' AS message,

            NULL AS data;



    ELSE



        SELECT 

            1 AS success,

            'Perfil obtenido correctamente.' AS message,

            JSON_OBJECT(

                'usuario_id', u.id,

                'nombre', u.nombre,

                'apellido', u.apellido,

                'email', u.email,



                'pais', JSON_OBJECT(

                    'id', p.pais_id,

                    'nombre', pais.nombre

                ),



                'departamento', JSON_OBJECT(

                    'id', p.departamento_id,

                    'nombre', dep.nombre

                ),



                'ciudad', JSON_OBJECT(

                    'id', p.ciudad_id,

                    'nombre', ciu.nombre

                ),



                'sexo', JSON_OBJECT(

                    'id', p.sexo_id,

                    'nombre', sexo.nombre

                ),



                'nacionalidad', JSON_OBJECT(

                    'id', p.nacionalidad_id,

                    'nombre', nac.nombre

                ),



                'disponibilidad_vehicular', JSON_OBJECT(

                    'id', p.disponibilidad_vehicular_id,

                    'nombre', dv.nombre

                ),



                'fecha_nacimiento', p.fecha_nacimiento,

                'telefono', p.telefono,

                'foto', p.foto,

                'acerca_de_mi', p.acerca_de_mi,

                'created_at', p.created_at,

                'updated_at', p.updated_at

            ) AS data



        FROM perfiles p

        INNER JOIN usuarios u ON u.id = p.usuario_id

        LEFT JOIN cat_paises pais ON pais.id = p.pais_id

        LEFT JOIN cat_departamentos dep ON dep.id = p.departamento_id

        LEFT JOIN cat_ciudades ciu ON ciu.id = p.ciudad_id

        LEFT JOIN cat_sexos sexo ON sexo.id = p.sexo_id

        LEFT JOIN cat_nacionalidades nac ON nac.id = p.nacionalidad_id

        LEFT JOIN cat_disponibilidad_vehicular dv ON dv.id = p.disponibilidad_vehicular_id

        WHERE p.usuario_id = p_usuario_id

        LIMIT 1;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_plazas_crear` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_plazas_crear`(

    IN p_titulo VARCHAR(255),

    IN p_descripcion TEXT,

    IN p_requisitos TEXT,

    IN p_beneficios TEXT,



    IN p_ciudad_id INT,

    IN p_cargo_id INT,

    IN p_categoria_laboral_id INT,

    IN p_actividad_laboral_id INT,



    IN p_tipo_contratacion VARCHAR(100),



    IN p_nivel_educativo_id INT,

    IN p_sexo_id INT,



    IN p_experiencia_minima INT,

    IN p_edad_minima INT,

    IN p_edad_maxima INT,



    IN p_salario_min DECIMAL(10,2),

    IN p_salario_max DECIMAL(10,2),



    IN p_fecha_cierre DATE,



    IN p_usuario_id INT

)
BEGIN



INSERT INTO plazas (



    titulo,

    descripcion,

    requisitos,

    beneficios,



    ciudad_id,

    cargo_id,

    categoria_laboral_id,

    actividad_laboral_id,



    tipo_contratacion,



    nivel_educativo_id,

    sexo_id,



    experiencia_minima,

    edad_minima,

    edad_maxima,



    salario_min,

    salario_max,



    fecha_cierre,



    usuario_id,

    estado,

    created_at



)

VALUES (



    p_titulo,

    p_descripcion,

    p_requisitos,

    p_beneficios,



    p_ciudad_id,

    p_cargo_id,

    p_categoria_laboral_id,

    p_actividad_laboral_id,



    p_tipo_contratacion,



    p_nivel_educativo_id,

    p_sexo_id,



    p_experiencia_minima,

    p_edad_minima,

    p_edad_maxima,



    p_salario_min,

    p_salario_max,



    p_fecha_cierre,



    p_usuario_id,

    1,

    NOW()



);



SELECT

    1 AS success,

    'Plaza creada correctamente' AS message;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_usuario_actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario_actualizar`(

    IN p_usuario_id BIGINT,

    IN p_nombre VARCHAR(255),

    IN p_apellido VARCHAR(255),

    IN p_email VARCHAR(255),

    IN p_estado TINYINT,

    IN p_usuario_ejecutor BIGINT

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;

    DECLARE v_email_existe INT DEFAULT 0;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;



        SELECT 

            0 AS success,

            'Error interno al actualizar usuario.' AS message,

            NULL AS data;

    END;



    START TRANSACTION;



    SELECT COUNT(*) INTO v_existe

    FROM usuarios

    WHERE id = p_usuario_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 

            0 AS success,

            'El usuario no existe.' AS message,

            NULL AS data;



    ELSE



        SELECT COUNT(*) INTO v_email_existe

        FROM usuarios

        WHERE email = p_email

        AND id <> p_usuario_id;



        IF v_email_existe > 0 THEN



            ROLLBACK;



            SELECT 

                0 AS success,

                'El correo ya está registrado por otro usuario.' AS message,

                NULL AS data;



        ELSE



            UPDATE usuarios

            SET 

                nombre = p_nombre,

                apellido = p_apellido,

                email = p_email,

                estado = p_estado,

                updated_at = NOW()

            WHERE id = p_usuario_id;



            INSERT INTO bitacora(

                usuario_id,

                modulo,

                accion,

                descripcion,

                created_at

            )

            VALUES(

                p_usuario_ejecutor,

                'usuarios',

                'actualizar',

                CONCAT('Se actualizó el usuario ID ', p_usuario_id),

                NOW()

            );



            COMMIT;



            SELECT 

                1 AS success,

                'Usuario actualizado correctamente.' AS message,

                NULL AS data;



        END IF;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_usuario_crear` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario_crear`(

    IN p_nombre VARCHAR(255),

    IN p_apellido VARCHAR(255),

    IN p_email VARCHAR(255),

    IN p_password VARCHAR(255),

    IN p_rol_id BIGINT,

    IN p_usuario_ejecutor BIGINT

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;

    DECLARE v_usuario_id BIGINT;



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 

            0 AS success,

            'Error interno al crear usuario.' AS message,

            NULL AS data;

    END;



    START TRANSACTION;



    -- 1️⃣ Validar email único

    SELECT COUNT(*) INTO v_existe

    FROM usuarios

    WHERE email = p_email;



    IF v_existe > 0 THEN



        ROLLBACK;



        SELECT 

            0 AS success,

            'El correo ya está registrado.' AS message,

            NULL AS data;



    ELSE



        -- 2️⃣ Insertar usuario

        INSERT INTO usuarios(

            nombre,

            apellido,

            email,

            password,

            estado,

            intentos_fallidos,

            bloqueado_hasta,

            created_at,

            updated_at

        )

        VALUES(

            p_nombre,

            p_apellido,

            p_email,

            p_password,

            1,

            0,

            NULL,

            NOW(),

            NOW()

        );



        SET v_usuario_id = LAST_INSERT_ID();



        -- 3️⃣ Asignar rol

        INSERT INTO usuarios_roles(

            usuario_id,

            rol_id

        )

        VALUES(

            v_usuario_id,

            p_rol_id

        );



        -- 4️⃣ Crear perfil vacío automáticamente

        INSERT INTO perfiles(

            usuario_id,

            created_at,

            updated_at

        )

        VALUES(

            v_usuario_id,

            NOW(),

            NOW()

        );



        -- 5️⃣ Bitácora

        INSERT INTO bitacora(

            usuario_id,

            modulo,

            accion,

            descripcion,

            created_at

        )

        VALUES(

            p_usuario_ejecutor,

            'usuarios',

            'crear',

            CONCAT('Se creó usuario ID ', v_usuario_id, ' y su perfil asociado'),

            NOW()

        );



        COMMIT;



        SELECT 

            1 AS success,

            'Usuario creado correctamente.' AS message,

            JSON_OBJECT(

                'usuario_id', v_usuario_id

            ) AS data;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_usuario_desactivar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario_desactivar`(

    IN p_usuario_id BIGINT,

    IN p_usuario_ejecutor BIGINT

)
BEGIN



    DECLARE v_existe INT DEFAULT 0;



    -- Manejo automático de error

    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 

            0 AS success,

            'Error interno al desactivar usuario.' AS message,

            NULL AS data;

    END;



    START TRANSACTION;



    -- 1️⃣ Verificar que el usuario exista

    SELECT COUNT(*) INTO v_existe

    FROM usuarios

    WHERE id = p_usuario_id;



    IF v_existe = 0 THEN



        ROLLBACK;



        SELECT 

            0 AS success,

            'El usuario no existe.' AS message,

            NULL AS data;



    ELSE



        -- 2️⃣ Evitar auto-desactivación

        IF p_usuario_id = p_usuario_ejecutor THEN



            ROLLBACK;



            SELECT 

                0 AS success,

                'No puede desactivarse a sí mismo.' AS message,

                NULL AS data;



        ELSE



            -- 3️⃣ Desactivar usuario

            UPDATE usuarios

            SET 

                estado = 0,

                updated_at = NOW()

            WHERE id = p_usuario_id;



            -- 4️⃣ Bitácora

            INSERT INTO bitacora(

                usuario_id,

                modulo,

                accion,

                descripcion,

                created_at

            )

            VALUES(

                p_usuario_ejecutor,

                'usuarios',

                'desactivar',

                CONCAT('Se desactivó el usuario ID ', p_usuario_id),

                NOW()

            );



            COMMIT;



            SELECT 

                1 AS success,

                'Usuario desactivado correctamente.' AS message,

                NULL AS data;



        END IF;



    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_usuario_generar_verificacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario_generar_verificacion`(

    IN p_usuario_id BIGINT,

    IN p_token VARCHAR(255),

    IN p_expira_en DATETIME

)
BEGIN



    DECLARE EXIT HANDLER FOR SQLEXCEPTION

    BEGIN

        ROLLBACK;

        SELECT 0 AS success;

    END;



    START TRANSACTION;



    INSERT INTO usuario_verificaciones (

        usuario_id,

        token,

        expira_en,

        created_at

    )

    VALUES (

        p_usuario_id,

        p_token,

        p_expira_en,

        NOW()

    );



    COMMIT;



    SELECT 1 AS success;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_usuario_invalidar_tokens` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario_invalidar_tokens`(

    IN p_usuario_id BIGINT

)
BEGIN

    UPDATE usuario_verificaciones

    SET usado = 1

    WHERE usuario_id = p_usuario_id

      AND usado = 0;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `usp_usuario_verificar_email` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_usuario_verificar_email`(IN `p_token` VARCHAR(255))
BEGIN

    DECLARE v_usuario_id BIGINT;



    SELECT usuario_id

    INTO v_usuario_id

    FROM usuario_verificaciones

    WHERE token = p_token

      AND usado = 0

      AND expira_en >= NOW()

    LIMIT 1;



    IF v_usuario_id IS NOT NULL THEN



        UPDATE usuarios

        SET email_verified_at = NOW()

        WHERE id = v_usuario_id;



        UPDATE usuario_verificaciones

        SET usado = 1

        WHERE token = p_token;



        SELECT 1 AS success;



    ELSE

        SELECT 0 AS success;

    END IF;



END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-26  4:27:18
