-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: misdb
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_type_id` int DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `category_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_categories_request_types1_idx` (`request_type_id`),
  CONSTRAINT `fk_cat_rqt` FOREIGN KEY (`request_type_id`) REFERENCES `request_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,'ICT Equipment Service',NULL),(2,1,'Network Service',NULL),(3,1,'Software/Application Service',NULL),(4,2,'Account Management',NULL),(5,2,'Report Generation',NULL),(6,2,'Activity-Based Assistance',NULL),(7,2,'Others',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_types`
--

DROP TABLE IF EXISTS `client_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_type` varchar(150) DEFAULT NULL,
  `client_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_types`
--

LOCK TABLES `client_types` WRITE;
/*!40000 ALTER TABLE `client_types` DISABLE KEYS */;
INSERT INTO `client_types` VALUES (1,'Business','Entities engaged in commercial activities for profit.'),(2,'Citizen','Individual residents or community members.'),(3,'Government','Public-sector entities governing and providing services.');
/*!40000 ALTER TABLE `client_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `csf`
--

DROP TABLE IF EXISTS `csf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `csf` (
  `id` int NOT NULL AUTO_INCREMENT,
  `helpdesks_id` int DEFAULT NULL,
  `crit1` int DEFAULT NULL,
  `crit2` int DEFAULT NULL,
  `crit3` int DEFAULT NULL,
  `crit4` int DEFAULT NULL,
  `overall` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `csf`
--

LOCK TABLES `csf` WRITE;
/*!40000 ALTER TABLE `csf` DISABLE KEYS */;
/*!40000 ALTER TABLE `csf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `divisions`
--

DROP TABLE IF EXISTS `divisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `divisions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `division` varchar(150) DEFAULT NULL,
  `division_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `divisions`
--

LOCK TABLES `divisions` WRITE;
/*!40000 ALTER TABLE `divisions` DISABLE KEYS */;
INSERT INTO `divisions` VALUES (1,'ORD','Office of the Regional Director'),(2,'BDD','Business Development Division'),(3,'CPD','Consumer Protection Division'),(4,'FAD','Finance and Admin Division'),(5,'IDD','Industry Development Division'),(6,'COA','Commision On Audit'),(7,'DTI Aklan','Aklan Provincial Office'),(8,'DTI Antique','Antique Provincial Office'),(9,'DTI Capiz','Capiz Provincial Office'),(10,'DTI Guimaras','Guimaras Provincial Office'),(11,'DTI Iloilo','Iloilo Provincial Office'),(12,'DTI Negros Occidental','Negros Occidental Provincial Office');
/*!40000 ALTER TABLE `divisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipment_type_id` int DEFAULT NULL,
  `brand` varchar(150) DEFAULT NULL,
  `model_number` varchar(150) DEFAULT NULL,
  `serial_number` varchar(150) DEFAULT NULL,
  `property_number` varchar(150) DEFAULT NULL,
  `cost` double(65,2) DEFAULT NULL,
  `description` text,
  `remarks` text,
  `status_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_equipment_equipment_type1_idx` (`equipment_type_id`),
  KEY `fk_equipment_equipment_statuses1_idx` (`status_id`),
  CONSTRAINT `fk_equ_eqs` FOREIGN KEY (`status_id`) REFERENCES `equipment_statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_equ_eqt` FOREIGN KEY (`equipment_type_id`) REFERENCES `equipment_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_statuses`
--

DROP TABLE IF EXISTS `equipment_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(150) DEFAULT NULL,
  `status_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_statuses`
--

LOCK TABLES `equipment_statuses` WRITE;
/*!40000 ALTER TABLE `equipment_statuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipment_type`
--

DROP TABLE IF EXISTS `equipment_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equipment_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipment_type` varchar(150) DEFAULT NULL,
  `equipment_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_type`
--

LOCK TABLES `equipment_type` WRITE;
/*!40000 ALTER TABLE `equipment_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `equipment_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reference_id` int DEFAULT NULL,
  `file_name` varchar(150) DEFAULT NULL,
  `file_path` text,
  `file_mime` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_fil_hel_idx` (`reference_id`),
  CONSTRAINT `fk_fil_hel` FOREIGN KEY (`reference_id`) REFERENCES `helpdesks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpdesks`
--

DROP TABLE IF EXISTS `helpdesks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_number` varchar(150) DEFAULT NULL COMMENT 'ICT-2024-01-001',
  `requested_by` int DEFAULT NULL,
  `date_requested` date DEFAULT NULL,
  `request_type_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `sub_category_id` int DEFAULT NULL,
  `complaint` varchar(150) DEFAULT NULL,
  `datetime_preferred` datetime DEFAULT NULL,
  `status_id` int DEFAULT '1',
  `sent_id` int DEFAULT '1',
  `priority_level_id` int DEFAULT NULL,
  `repair_type_id` int DEFAULT NULL,
  `repair_class_id` int DEFAULT NULL,
  `medium_id` int DEFAULT NULL,
  `assigned_to` int DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  `serviced_by` int DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  `diagnosis` text,
  `remarks` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_helpdesks_users_idx` (`requested_by`),
  KEY `fk_helpdesks_repair_types1_idx` (`repair_type_id`),
  KEY `fk_helpdesks_categories1_idx` (`category_id`),
  KEY `fk_helpdesks_request_types1_idx` (`request_type_id`),
  KEY `fk_helpdesks_sub_categories1_idx` (`sub_category_id`),
  KEY `fk_helpdesks_repair_classes1_idx` (`repair_class_id`),
  KEY `fk_helpdesks_mediums1_idx` (`medium_id`),
  KEY `fk_helpdesks_priority_levels1_idx` (`priority_level_id`),
  KEY `fk_helpdesks_users1_idx` (`assigned_to`),
  KEY `fk_helpdesks_users2_idx` (`approved_by`),
  KEY `fk_helpdesks_users3_idx` (`serviced_by`),
  KEY `fk_helpdesks_helpdesks_statuses1_idx` (`status_id`),
  CONSTRAINT `fk_hel_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_hes` FOREIGN KEY (`status_id`) REFERENCES `helpdesks_statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_med` FOREIGN KEY (`medium_id`) REFERENCES `mediums` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_prl` FOREIGN KEY (`priority_level_id`) REFERENCES `priority_levels` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_rec` FOREIGN KEY (`repair_class_id`) REFERENCES `repair_classes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_ret` FOREIGN KEY (`repair_type_id`) REFERENCES `repair_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_rqt` FOREIGN KEY (`request_type_id`) REFERENCES `request_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_sca` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_hel_use4` FOREIGN KEY (`serviced_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks`
--

LOCK TABLES `helpdesks` WRITE;
/*!40000 ALTER TABLE `helpdesks` DISABLE KEYS */;
INSERT INTO `helpdesks` VALUES (83,'REQ-2024-02-001',20,'2024-02-02',1,1,1,'wala ga siga akon monitors','2024-02-02 14:49:00',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-02 06:50:27','2024-02-04 15:56:32'),(84,'REQ-2024-02-002',19,'2024-02-02',1,3,11,'asdasdasdas','2024-02-02 15:28:00',6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-02-02 07:28:30','2024-02-02 07:29:04');
/*!40000 ALTER TABLE `helpdesks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpdesks_statuses`
--

DROP TABLE IF EXISTS `helpdesks_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesks_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(150) DEFAULT NULL,
  `status_desc` text,
  `color` varchar(45) DEFAULT NULL,
  `color_hex` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesks_statuses`
--

LOCK TABLES `helpdesks_statuses` WRITE;
/*!40000 ALTER TABLE `helpdesks_statuses` DISABLE KEYS */;
INSERT INTO `helpdesks_statuses` VALUES (1,'Open',NULL,'warning','#ffc107'),(2,'Pending',NULL,'primary','#0d6efd'),(3,'Pre-repair',NULL,'secondary','#adb5bd'),(4,'Unserviceable',NULL,'secondary','#adb5bd'),(5,'Completed',NULL,'success','#198754'),(6,'Cancelled',NULL,'danger','#dc3545');
/*!40000 ALTER TABLE `helpdesks_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hosts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `host_name` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
INSERT INTO `hosts` VALUES (1,'Judith Guillo'),(2,'Ermelinda Pollentes');
/*!40000 ALTER TABLE `hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iar`
--

DROP TABLE IF EXISTS `iar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `po_id` int DEFAULT NULL,
  `division_id` int DEFAULT NULL,
  `iar_number` varchar(150) DEFAULT NULL COMMENT 'IAR-2024-01-001',
  `iar_date` date DEFAULT NULL,
  `invoice_number` varchar(150) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `date_inspected` date DEFAULT NULL,
  `inspected_by_id` int DEFAULT NULL,
  `date_accepted` date DEFAULT NULL,
  `accepted_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_iar_suppliers1_idx` (`supplier_id`),
  KEY `fk_iar_divisions1_idx` (`division_id`),
  KEY `fk_iar_users1_idx` (`inspected_by_id`),
  KEY `fk_iar_users2_idx` (`accepted_by`),
  KEY `fk_iar_procurements1_idx` (`po_id`),
  CONSTRAINT `fk_iar_div` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_pro` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_sup` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_use1` FOREIGN KEY (`inspected_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_iar_use2` FOREIGN KEY (`accepted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iar`
--

LOCK TABLES `iar` WRITE;
/*!40000 ALTER TABLE `iar` DISABLE KEYS */;
/*!40000 ALTER TABLE `iar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iar_items`
--

DROP TABLE IF EXISTS `iar_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iar_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iar_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_items_equipment1_idx` (`equipment_id`),
  KEY `fk_procurement_items_copy1_iar1_idx` (`iar_id`),
  CONSTRAINT `fk_iai_equ` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_iai_iar` FOREIGN KEY (`iar_id`) REFERENCES `iar` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iar_items`
--

LOCK TABLES `iar_items` WRITE;
/*!40000 ALTER TABLE `iar_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `iar_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mediums`
--

DROP TABLE IF EXISTS `mediums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mediums` (
  `id` int NOT NULL AUTO_INCREMENT,
  `medium` varchar(150) DEFAULT NULL,
  `medium_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mediums`
--

LOCK TABLES `mediums` WRITE;
/*!40000 ALTER TABLE `mediums` DISABLE KEYS */;
INSERT INTO `mediums` VALUES (1,'DTI6 MIS',NULL),(2,'Telecom',NULL),(3,'Email',NULL),(4,'Memo',NULL),(5,'Others',NULL);
/*!40000 ALTER TABLE `mediums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `meeting_number` varchar(150) DEFAULT NULL COMMENT 'MTG-2024-01-001',
  `requested_by` int DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `date_scheduled` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `host_id` int DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `meetingid` varchar(150) DEFAULT NULL,
  `passcode` varchar(150) DEFAULT NULL,
  `join_link` text,
  `start_link` text,
  `remarks` text,
  `date_requested` date DEFAULT NULL,
  `generated_by` int DEFAULT NULL,
  `approved_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_meetings_users1_idx` (`requested_by`),
  KEY `fk_meetings_hosts1_idx` (`host_id`),
  KEY `fk_meetings_users2_idx` (`generated_by`),
  KEY `fk_meetings_users3_idx` (`approved_by`),
  KEY `fk_meetings_meetings_statuses1_idx` (`status_id`),
  CONSTRAINT `fk_mtg_hos` FOREIGN KEY (`host_id`) REFERENCES `hosts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_mts` FOREIGN KEY (`status_id`) REFERENCES `meetings_statuses` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_use1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_use2` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_mtg_use3` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (5,'MTG-2024-01-001',7,'meeting 1','2024-01-30','08:00:00','09:00:00',1,2,NULL,NULL,NULL,NULL,NULL,'2024-01-30',NULL,NULL,'2024-01-30 14:33:11','2024-01-30 15:11:39'),(6,'MTG-2024-01-002',7,'meeting 2','2024-01-30','08:00:00','08:00:00',2,2,NULL,NULL,NULL,NULL,NULL,'2024-01-30',NULL,NULL,'2024-01-30 14:34:24','2024-01-30 15:19:35'),(7,'MTG-2024-01-003',7,'meeting 3','2024-01-30','08:00:00','09:00:00',NULL,1,NULL,NULL,NULL,NULL,NULL,'2024-01-30',NULL,NULL,'2024-01-30 15:19:15','2024-01-30 15:19:15'),(8,'MTG-2024-01-004',7,'meeting 4','2024-01-30','13:00:00','14:00:00',NULL,1,NULL,NULL,NULL,NULL,NULL,'2024-01-30',NULL,NULL,'2024-01-30 15:39:33','2024-01-30 15:39:33'),(9,'MTG-2024-01-005',7,'GS1 Phil briefing on Barcode / GS1 Membership for Capiz MSMEs','2024-01-30','16:00:00','17:00:00',NULL,1,NULL,NULL,NULL,NULL,NULL,'2024-01-30',NULL,NULL,'2024-01-30 15:58:13','2024-01-30 15:58:13'),(10,'MTG-2024-01-006',7,NULL,'2024-01-31','08:13:00','08:13:00',NULL,1,NULL,NULL,NULL,NULL,NULL,'2024-01-31',NULL,NULL,'2024-01-31 00:13:21','2024-01-31 00:13:21'),(11,'MTG-2024-01-007',7,NULL,'2024-01-31','08:13:00','08:13:00',NULL,1,NULL,NULL,NULL,NULL,NULL,'2024-01-31',NULL,NULL,'2024-01-31 00:13:53','2024-01-31 00:13:53'),(12,'MTG-2024-01-008',7,'meeting 6','2024-02-01','08:00:00','09:00:00',1,2,'843231231231','131223','https:/asdajdoiasjdas','https:/asdjasoidjaosdji','scheduled','2024-01-31',7,7,'2024-01-31 00:18:45','2024-01-31 00:18:45'),(13,'MTG-2024-02-001',7,NULL,'2024-02-02','09:38:00','09:38:00',NULL,1,NULL,NULL,NULL,NULL,NULL,'2024-02-02',NULL,NULL,'2024-02-02 01:39:26','2024-02-02 01:39:26');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings_statuses`
--

DROP TABLE IF EXISTS `meetings_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(150) DEFAULT NULL,
  `status_desc` text,
  `color` varchar(45) DEFAULT NULL,
  `color_hex` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings_statuses`
--

LOCK TABLES `meetings_statuses` WRITE;
/*!40000 ALTER TABLE `meetings_statuses` DISABLE KEYS */;
INSERT INTO `meetings_statuses` VALUES (1,'Pending',NULL,'warning','#ffc107'),(2,'Scheduled',NULL,'success','#198754'),(3,'Unavailable',NULL,'secondary','#adb5bd'),(4,'Cancelled',NULL,'danger','#dc3545');
/*!40000 ALTER TABLE `meetings_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `par`
--

DROP TABLE IF EXISTS `par`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `par` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entity_name` varchar(150) DEFAULT NULL,
  `par_number` varchar(150) DEFAULT NULL COMMENT 'PAR-2024-01-001',
  `received_by` int DEFAULT NULL,
  `issued_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_users1_idx` (`received_by`),
  KEY `fk_par_users2_idx` (`issued_by`),
  CONSTRAINT `fk_par_use1` FOREIGN KEY (`issued_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_par_use2` FOREIGN KEY (`received_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `par`
--

LOCK TABLES `par` WRITE;
/*!40000 ALTER TABLE `par` DISABLE KEYS */;
/*!40000 ALTER TABLE `par` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `par_items`
--

DROP TABLE IF EXISTS `par_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `par_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `par_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_items_par1_idx` (`par_id`),
  KEY `fk_par_items_equipment1_idx` (`equipment_id`),
  CONSTRAINT `fk_pai_equ` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pai_par` FOREIGN KEY (`par_id`) REFERENCES `par` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `par_items`
--

LOCK TABLES `par_items` WRITE;
/*!40000 ALTER TABLE `par_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `par_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po`
--

DROP TABLE IF EXISTS `po`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `po` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `date_purchased` date DEFAULT NULL,
  `cost` double(11,2) DEFAULT NULL,
  `po_number` varchar(150) DEFAULT NULL,
  `date_po` date DEFAULT NULL,
  `place_delivery` varchar(150) DEFAULT NULL,
  `date_delivery` date DEFAULT NULL,
  `delivery_term` varchar(150) DEFAULT NULL,
  `payment_term` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_procurements_suppliers1_idx` (`supplier_id`),
  CONSTRAINT `fk_p_s` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po`
--

LOCK TABLES `po` WRITE;
/*!40000 ALTER TABLE `po` DISABLE KEYS */;
/*!40000 ALTER TABLE `po` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_items`
--

DROP TABLE IF EXISTS `po_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `po_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `po_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_par_items_equipment1_idx` (`equipment_id`),
  KEY `fk_par_items_copy1_procurements1_idx` (`po_id`),
  CONSTRAINT `fk_poi_e` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_poi_po` FOREIGN KEY (`po_id`) REFERENCES `po` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_items`
--

LOCK TABLES `po_items` WRITE;
/*!40000 ALTER TABLE `po_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `po_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pre_post_repair`
--

DROP TABLE IF EXISTS `pre_post_repair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pre_post_repair` (
  `id` int NOT NULL AUTO_INCREMENT,
  `helpdesk_id` int DEFAULT NULL,
  `equipment_id` int DEFAULT NULL,
  `requested_by_id` int DEFAULT NULL,
  `received_by_id` int DEFAULT NULL,
  `approved_by_id` int DEFAULT NULL,
  `date_prepared` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_pre_post_repair_equipment1_idx` (`equipment_id`),
  KEY `fk_pre_post_repair_users2_idx` (`received_by_id`),
  KEY `fk_pre_post_repair_users3_idx` (`approved_by_id`),
  KEY `fk_pre_post_repair_helpdesks1_idx` (`helpdesk_id`),
  KEY `fk_ppr_u1_idx` (`requested_by_id`),
  CONSTRAINT `fk_ppr_equ` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_hel` FOREIGN KEY (`helpdesk_id`) REFERENCES `helpdesks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_use1` FOREIGN KEY (`requested_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_use2` FOREIGN KEY (`received_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_ppr_use3` FOREIGN KEY (`approved_by_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pre_post_repair`
--

LOCK TABLES `pre_post_repair` WRITE;
/*!40000 ALTER TABLE `pre_post_repair` DISABLE KEYS */;
/*!40000 ALTER TABLE `pre_post_repair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `priority_levels`
--

DROP TABLE IF EXISTS `priority_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `priority_levels` (
  `id` int NOT NULL AUTO_INCREMENT,
  `priority_level` varchar(150) DEFAULT NULL,
  `priority_level_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `priority_levels`
--

LOCK TABLES `priority_levels` WRITE;
/*!40000 ALTER TABLE `priority_levels` DISABLE KEYS */;
INSERT INTO `priority_levels` VALUES (1,'Low',NULL),(2,'Normal',NULL),(3,'High',NULL),(4,'Critical',NULL);
/*!40000 ALTER TABLE `priority_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_classes`
--

DROP TABLE IF EXISTS `repair_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `repair_class` varchar(150) DEFAULT NULL,
  `repair_class_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_classes`
--

LOCK TABLES `repair_classes` WRITE;
/*!40000 ALTER TABLE `repair_classes` DISABLE KEYS */;
INSERT INTO `repair_classes` VALUES (1,'Simple',NULL),(2,'Medium',NULL),(3,'Complex',NULL),(4,'Highly Technical',NULL);
/*!40000 ALTER TABLE `repair_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_types`
--

DROP TABLE IF EXISTS `repair_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `repair_type` varchar(150) DEFAULT NULL,
  `repair_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_types`
--

LOCK TABLES `repair_types` WRITE;
/*!40000 ALTER TABLE `repair_types` DISABLE KEYS */;
INSERT INTO `repair_types` VALUES (1,'Minor',NULL),(2,'Major',NULL);
/*!40000 ALTER TABLE `repair_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_types`
--

DROP TABLE IF EXISTS `request_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `request_type` varchar(150) DEFAULT NULL,
  `request_type_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_types`
--

LOCK TABLES `request_types` WRITE;
/*!40000 ALTER TABLE `request_types` DISABLE KEYS */;
INSERT INTO `request_types` VALUES (1,'Maintenance Job Request',NULL),(2,'Other ICT Service',NULL);
/*!40000 ALTER TABLE `request_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(150) DEFAULT NULL,
  `role_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','Manages system settings and user access.'),(2,'Officer','Handles complex technical issues and coordinates with other support teams.'),(3,'Staff','Provides frontline support, troubleshoots routine issues, and logs support requests.'),(4,'Employee','End-user seeking assistance with IT-related concerns, reports issues, and collaborates with helpdesk staff for resolutions.');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sub_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `sub_category` varchar(45) DEFAULT NULL,
  `sub_category_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_sub_categories_categories1_idx` (`category_id`),
  CONSTRAINT `fk_sca_cat` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_categories`
--

LOCK TABLES `sub_categories` WRITE;
/*!40000 ALTER TABLE `sub_categories` DISABLE KEYS */;
INSERT INTO `sub_categories` VALUES (1,1,'Desktop',NULL),(2,1,'Laptop',NULL),(3,1,'Printer',NULL),(4,1,'Others',NULL),(5,2,'Internet Access',NULL),(6,2,'LAN',NULL),(7,2,'Network Sharing',NULL),(8,2,'Others',NULL),(9,3,'Payroll',NULL),(10,3,'eNGAS',NULL),(11,3,'HR System',NULL),(12,3,'DTR System',NULL),(13,3,'Others',NULL),(14,4,'O365 Account',NULL),(15,4,'IHRIS',NULL),(16,4,'eNGAS',NULL),(17,4,'iMMIS',NULL),(18,4,'Others',NULL),(19,5,'O365 Account',NULL),(20,5,'IHRIS',NULL),(21,5,'eNGAS',NULL),(22,5,'iMMIS',NULL),(23,5,'Others',NULL),(24,6,'Graphics',NULL),(25,6,'Video Editting',NULL),(26,6,'Pitch Deck/PPT Presentation',NULL),(27,6,'Set up Venue',NULL),(28,6,'Others',NULL),(29,7,'Others',NULL);
/*!40000 ALTER TABLE `sub_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(150) DEFAULT NULL,
  `supplier_address` varchar(150) DEFAULT NULL,
  `supplier_contact` varchar(150) DEFAULT NULL,
  `supplier_email` varchar(150) DEFAULT NULL,
  `active` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers`
--

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_number` varchar(150) DEFAULT NULL,
  `first_name` varchar(150) DEFAULT NULL,
  `middle_name` varchar(150) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `position` varchar(150) DEFAULT NULL,
  `division_id` int DEFAULT NULL,
  `client_type_id` int DEFAULT '3',
  `date_birth` date DEFAULT NULL,
  `sex` enum('Male','Female') DEFAULT NULL,
  `pwd` tinyint DEFAULT '0',
  `phone` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `temp_password` varchar(255) DEFAULT NULL,
  `temp_password_expiry` varchar(150) DEFAULT NULL,
  `active` tinyint DEFAULT '1',
  `role_id` int DEFAULT '4',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_users_divisions1_idx` (`division_id`),
  KEY `fk_users_roles1_idx` (`role_id`),
  KEY `fk_users_client_types1_idx` (`client_type_id`),
  CONSTRAINT `fk_users_client_types1` FOREIGN KEY (`client_type_id`) REFERENCES `client_types` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_division` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_users_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,NULL,'User',' ','1',NULL,1,3,NULL,'Female',0,NULL,'dace.phage1@gmail.com',NULL,'admin','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,1,'2024-01-23 08:15:41','2024-01-23 15:24:28'),(8,NULL,'User',' ','2',NULL,2,3,NULL,'Female',0,NULL,'dace.phage2@gmail.com',NULL,'officer','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,2,'2024-01-23 08:15:41','2024-01-24 01:49:46'),(9,'cos6-005','User',' ','3','Support Staff',3,3,'2023-02-09','Male',0,'091234567890','dace.phage3@gmail.com','asdas','staff','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,3,'2024-01-23 08:15:41','2024-01-24 01:49:51'),(18,'6-051','Aisel Joyce','M.','Tupas','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'aj.moyani@gmail.com',NULL,'6-051','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(19,'6-036','Amiel','P.','Sumait','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'amielsumait@dti.gov.ph',NULL,'6-036','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(20,'6-056','Andrea','S.','Reyes','Trade-industry Development Specialist',5,3,'2024-02-04','Female',0,'09818098637','AndreaReyes@dti.gov.ph','Iloilo','6-056','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-04 13:23:59'),(21,'6-053','Anelyn','L.','Apiag','Administrative Aide Vi',NULL,3,NULL,'Female',0,NULL,'anelyn1995@gmail.com',NULL,'6-053','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(22,'6-006','Angelo','G.','Patrimonio','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'AngeloPatrimonio@dti.gov.ph',NULL,'6-006','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(23,'6-016','Ariane','L.','Fuentespina','Administrative Assistant Iii-secretary',NULL,3,NULL,'Female',0,NULL,'ArianeFuentespina@dti.gov.ph',NULL,'6-016','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(24,'6-023','Arnel','B.','Oliveros','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'ArnelOliveros@dti.gov.ph',NULL,'6-023','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(25,'6-041','Aurora Teresa','J.','Alisen','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'AuroraTeresaAlisen@dti.gov.ph',NULL,'6-041','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(26,'6-010','Belinda','B.','Roldan','Administrative Officer Iii',NULL,3,NULL,'Female',0,NULL,'BelindaRoldan@dti.gov.ph',NULL,'6-010','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(27,'6-004','Bella','B.','Bonto','Administrative Officer Iii',NULL,3,NULL,'Female',0,NULL,'BellaBonto@dti.gov.ph',NULL,'6-004','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(28,'6-038','Bemy John','A.','Collado','Trade-industry Development Analyst',NULL,3,NULL,'Male',0,NULL,'itsbeenawhile93@gmail.com',NULL,'6-038','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(29,'6-079','Billy','B.','Regondon','Administrative Aide Vi',NULL,3,NULL,'Male',0,NULL,'BillyRegondon@dti.gov.ph',NULL,'6-079','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(30,'6-045','Charlene Joy','A.','Adeja','Trade-industry Development Analyst',NULL,3,NULL,'Female',0,NULL,'cjaltillero@gmail.com',NULL,'6-045','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(31,'6-128','Cheryl','D.','Fernandez','Trade-industry Development Analyst',NULL,3,NULL,'Female',0,NULL,'Cherylfernandez@dti.gov.ph',NULL,'6-128','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(32,'6-162','Daniel','S.','Agan','Trade-industry Development Analyst',NULL,3,NULL,'Male',0,NULL,'danielagan@dti.gov.ph',NULL,'6-162','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(33,'C6-004','Daryl Mae Lorene','F.','Salveron','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'DarylMaeLoreneSalveron@dti.gov.ph',NULL,'C6-004','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(34,'6-050','Dessa Anh','T.','Flores','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'dessaanhflores987@gmail.com',NULL,'6-050','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(35,'C6-014','Dicof','D.','Cofreros','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'DicofCofreros@dti.gov.ph',NULL,'C6-014','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(36,'6-062','Emily','S.','Pasaporte','Administrative Aide Vi',NULL,3,NULL,'Female',0,NULL,'EmilyPasaporte@dti.gov.ph',NULL,'6-062','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(37,'6-113','Engiemar','B.','Tupas','Senior Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'engiemartupas@dti.gov.ph',NULL,'6-113','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(38,'6-002','Ermelinda','P.','Pollentes','Director Iii-assistant Regional Director',1,3,'2024-02-05','Female',1,'09123456789','ErmelindaPollentes@dti.gov.ph','Iloilo City','6-002','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-04 16:11:42'),(39,'6-142','Felisa Judith','L.','Degala','Provincial Trade-industry Officer',NULL,3,NULL,'Female',0,NULL,'felisajudithdegala@dti.gov.ph',NULL,'6-142','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(40,'6-156','Florenda Octoberiana','C.','Abian','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'FlorendaOctoberianaAbian@dti.gov.ph',NULL,'6-156','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(41,'C6-040','Florielee','S.','Clavel','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'FlorieleeSasabo@dti.gov.ph',NULL,'C6-040','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(42,'6-029','Frauleine','B.','Bautista','Administrative Officer Ii',NULL,3,NULL,'Female',0,NULL,'frauleinebautista@dti.gov.ph',NULL,'6-029','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(43,'6-117','Gerin','E.','Vergara','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'gerinvergara@dti.gov.ph',NULL,'6-117','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(44,'6-012','Gevi Kristina','O.','Sandoy','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'gk.sandoy@gmail.com',NULL,'6-012','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(45,'6-138','Grace','M.','Benedicto','Supervising Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'GraceBenedicto@dti.gov.ph',NULL,'6-138','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:17','2024-02-02 06:52:39'),(46,'6-119','Honey Mae','F.','Osimco','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'honeymaeosimco@dti.gov.ph',NULL,'6-119','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(47,'6-039','Iris Mae','I.','Sarabia','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'immibisate@gmail.com',NULL,'6-039','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(48,'6-137','Jane Russel','B.','Prudente','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'JaneRusselPrudente@dti.gov.ph',NULL,'6-137','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(49,'6-013','Janice','T.','Abellar','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'janiceabellar@dti.gov.ph',NULL,'6-013','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(50,'6-042','Jenny May','B.','Tabalanza','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'jennytabaolanza532@yahoo.com',NULL,'6-042','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(51,'6-037','John Mchale','C.','Benid','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'johnzekebenid2711@gmail.com',NULL,'6-037','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(52,'6-009','Jomar','B.','Benedicto','Utility Worker',NULL,3,NULL,'Male',0,NULL,'jbenedicto.cti@gmail.com',NULL,'6-009','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(53,'6-005','Jonas Richard','F.','Fondevilla','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'JonasRichardFondevilla@dto.gov.ph',NULL,'6-005','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(54,'6-147','Jonathan','T.','Tejida','Senior Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'jonathantejida@dti.gov.ph',NULL,'6-147','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(55,'6-080','Jose Marie','T.','Tanchuan','Driver I',NULL,3,NULL,'Male',0,NULL,'josemarietanchuan@gmail.com',NULL,'6-080','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(56,'C6-007','Joy Anne','S.','Erazo','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'JOyAnneErazo@dti.gov.ph',NULL,'C6-007','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(57,'6-043','Juan Carlos','V.','Corros','Trade-industry Development Analyst',NULL,3,NULL,'Male',0,NULL,'jcorros.gk@gmail.com',NULL,'6-043','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(58,'6-008','Judith','G.','Kelly','Chief Administrative Officer',NULL,3,NULL,'Female',0,NULL,'JudithKelly@dti.gov.ph',NULL,'6-008','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(59,'6-024','Judy Mae','M.','Sajo','Information Officer Iii',NULL,3,NULL,'Female',0,NULL,'judymaesajo@gmail.com',NULL,'6-024','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(60,'6-083','Juvy','D.','Benliro','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'JuvyBenliro@dti.gov.ph',NULL,'6-083','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(61,'6-087','Ken Queenie','R.','Cuñada','Provincial Trade-industry Officer',NULL,3,NULL,'Female',0,NULL,'kenqueeniecunada@dti.gov.ph',NULL,'6-087','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(62,'6-030','Kenneth','C.','Villarosa','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'kennethvillarosa@hotmail.com',NULL,'6-030','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(63,'6-052','Kent Novie','T.','Tacsagon','Trade-industry Development Analyst',NULL,3,NULL,'Male',0,NULL,'kntacsagon01@gmail.com',NULL,'6-052','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(64,'C6-009','Kher Jake Martin','A.','Trayco','Senior Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'traycomartin@gmail.com',NULL,'C6-009','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(65,'6-089','Kurt Maurice','S.','Tugaff','Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'kurttugaff1@gmail.com',NULL,'6-089','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(66,'6-121','Lakambini','T.','Regalado','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'bambeetle79@gmail.com',NULL,'6-121','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(67,'C6-039','Lovely Claire','D.','Rebatado','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'LovelyClaireDulaca@dti.gov.ph',NULL,'C6-039','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(68,'6-020','Lyndy Exzyle','D.','Miranda','Accountant Ii',NULL,3,NULL,'Female',0,NULL,'LyndyExzyleDemegillo@dti.gov.ph',NULL,'6-020','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(69,'6-158','Ma. Aurora','E.','Bangcaya','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'maia.seb82@gmail.com',NULL,'6-158','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(70,'6-127','Ma. Carmen','I.','Iturralde','Provincial Trade-industry Officer',NULL,3,NULL,'Female',0,NULL,'MaCarmenIturralde@dti.gov.ph',NULL,'6-127','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(71,'6-033','Ma. Dinda','R.','Tamayo','Provincial Trade-industry Officer',NULL,3,NULL,'Female',0,NULL,'madindatamayo@dti.gov.ph',NULL,'6-033','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(72,'6-046','Ma. Dorita','D.','Chavez','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'MaDoritaChavez@dti.gov.ph',NULL,'6-046','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(73,'6-034','Ma. Kristine','B.','Rosaldes','Administrative Assistant Iii-bookkeeper',NULL,3,NULL,'Female',0,NULL,'bueronrosaldes@gmail.com',NULL,'6-034','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(74,'6-157','Maria Victoria','D.','Aspera','Trade-industry Development Analyst',NULL,3,NULL,'Female',0,NULL,'MariaVictoriaAspera@dti.gov.ph',NULL,'6-157','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(75,'6-026','Mariecon','A.','Burla','Administrative Aide Vi',NULL,3,NULL,'Female',0,NULL,'marzalvarez@gmail.com',NULL,'6-026','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(76,'6-017','Marjorie','F.','Tendras','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'MarjorieTendras@dti.gov.ph',NULL,'6-017','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(77,'6-872','Mark','C.','Jurilla','Attorney Iii',NULL,3,NULL,'Male',0,NULL,'markjurilla@gmail.com',NULL,'6-872','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(78,'6-031','Mary Jade','R.','Gonzales','Planning Officer Iii',NULL,3,NULL,'Female',0,NULL,'MaryJadeGonzales@dti.gov.ph',NULL,'6-031','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(79,'6-035','May Angeli','V.','Tayona','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'girlie_0529@yahoo.com',NULL,'6-035','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(80,'6-082','Merian','A.','Asas','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'MerianAsas@dti.gov.ph',NULL,'6-082','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(81,'6-049','Mia','A.','Aujero','Trade-industry Development Analyst',NULL,3,NULL,'Female',0,NULL,'miacuh181@gmail.com',NULL,'6-049','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(82,'6-007','Michelle','C.','Ladigohon','Administrative Officer V',NULL,3,NULL,'Female',0,NULL,'michelleladigohon@dti.gov.ph',NULL,'6-007','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(83,'6-154','Mutya','D.','Eusores','Chief Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'MUTYAEUSORES@DTI.GOV.PH',NULL,'6-154','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(84,'6-011','Nesgen Rhea','C.','Zerrudo','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'NesgenRheaCaburlan@dti.gov.ph',NULL,'6-011','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(85,'6-066','Pamela','S.','Roldan','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'PamelaRoldan@dti.gov.ph',NULL,'6-066','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(86,'6-141','Procilito','G.','Sadaya','Senior Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'pros_sadaya@yahoo.com',NULL,'6-141','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(87,'6-054','Rachel','N.','Nufable','Provincial Trade-industry Officer',NULL,3,NULL,'Female',0,NULL,'RachelNufable@dti.gov.ph',NULL,'6-054','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(88,'6-047','Reginald','S.','Hudierez','Senior Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'ReginaldHudierez@dti.gov.ph',NULL,'6-047','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(89,'6-044','Rejoice','S.','Orquia','Trade-industry Development Analyst',NULL,3,NULL,'Female',0,NULL,'rejorquia@yahoo.com',NULL,'6-044','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(90,'6-131','Reynaldo','T.','Tejero','Driver I',NULL,3,NULL,'Male',0,NULL,'tejeroreynaldo@yahoo.com',NULL,'6-131','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(91,'6-134','Rhea','B.','Jocsing','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'RheaJocsing@dti.gov.ph',NULL,'6-134','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(92,'6-015','Rhea Jepee','L.','Legario','Administrative Officer Ii',NULL,3,NULL,'Female',0,NULL,'RheaJepeeLegario@dti.gov.ph',NULL,'6-015','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(93,'6-085','Richeline','A.','Borres','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'RichelineBorres@dti.gov.ph',NULL,'6-085','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(94,'6-027','Romel','L.','Amihan','Senior Trade-industry Development Specialist',NULL,3,NULL,'Male',0,NULL,'romelamihan@dti.gov.ph',NULL,'6-027','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(95,'6-143','Rosalie','A.','Panganiban','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'RosaliePanganiban@dti.gov.ph',NULL,'6-143','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(96,'6-105','Rosie','Y.','Evangelista','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'rosieevangelista@dti.gov.ph',NULL,'6-105','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(97,'C6-003','Rowena','D.','Barcelona','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'RowenaBarcelona@dti.gov.ph',NULL,'C6-003','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(98,'6-025','Roxanne','B.','Arbatin','Administrative Officer Ii',NULL,3,NULL,'Female',0,NULL,'roxannebedeo@yahoo.com',NULL,'6-025','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(99,'6-109','Rudy','G.','Montalbo','Administrative Aide Iv-driver',NULL,3,NULL,'Male',0,NULL,'rudymontalbo@gmail.com',NULL,'6-109','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(100,'6-028','Sealbia','Y.','Quilino','Administrative Officer Ii',NULL,3,NULL,'Female',0,NULL,'SealbiaQuilino@dti.gov.ph',NULL,'6-028','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(101,'6-014','Shayne','G.','Jornadal','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'ShayneJornadal@dti.gov.ph',NULL,'6-014','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(102,'6-155','Sheryl','E.','Dioteles','Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'Sheryldioteles@dti.gov.ph',NULL,'6-155','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(103,'6-160','Therese Grace','J.','Marla','Administrative Officer V',NULL,3,NULL,'Female',0,NULL,'theresegracemarla@dti.gov.ph',NULL,'6-160','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(104,'C6-145','Verna','A.','Belegera','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'VernaBelgera@dti.gov.ph',NULL,'C6-145','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39'),(105,'6-048','Yolanda','O.','Gallenero','Senior Trade-industry Development Specialist',NULL,3,NULL,'Female',0,NULL,'YolandaGallenero@dti.gov.ph',NULL,'6-048','$2y$10$UPRLQNRDq4LWpJELvJsAQuf/WEUuC1KGOEXKyeUrh1SbBAJDkyNYu',NULL,NULL,1,4,'2024-02-02 03:59:18','2024-02-02 06:52:39');
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

-- Dump completed on 2024-02-05  9:28:41
