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
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `usuarios_roles`
--

DROP TABLE IF EXISTS `usuarios_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_roles` (
  `usuario_id` bigint(20) unsigned NOT NULL,
  `rol_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`usuario_id`,`rol_id`),
  KEY `usuarios_roles_rol_id_foreign` (`rol_id`),
  CONSTRAINT `usuarios_roles_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `usuarios_roles_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `usp_perfil_experiencia_listar`(
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

    -- Manejo de errores para MySQL
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        SELECT 
            0 AS success,
            'Error interno al actualizar usuario.' AS message,
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

        -- 2️⃣ Verificar que el email no esté repetido
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

            -- 3️⃣ Actualizar usuario
            UPDATE usuarios
            SET 
                nombre = p_nombre,
                apellido = p_apellido,
                email = p_email,
                estado = p_estado,
                updated_at = NOW()
            WHERE id = p_usuario_id;

            -- 4️⃣ Registrar en bitácora
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

-- Dump completed on 2026-03-07  1:50:56
