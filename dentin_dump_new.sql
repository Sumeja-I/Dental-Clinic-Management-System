CREATE DATABASE  IF NOT EXISTS `dentist_office` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dentist_office`;
-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dentist_office
-- ------------------------------------------------------
-- Server version	8.0.45

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
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointment` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `appointment_status` varchar(500) DEFAULT 'Pending',
  `appointment_start` datetime NOT NULL,
  `appointment_end` datetime DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `people` int NOT NULL,
  `dentist` int NOT NULL,
  `treatment` int NOT NULL,
  `app_total_price` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `people` (`people`),
  KEY `dentist` (`dentist`),
  KEY `treatment` (`treatment`),
  CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`people`) REFERENCES `people` (`pid`),
  CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`dentist`) REFERENCES `dentist` (`did`),
  CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`treatment`) REFERENCES `treatment` (`tid`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (1,'Confirmed','2026-06-01 09:00:00',NULL,NULL,1,1,1,NULL),(2,'completed','2026-01-02 10:00:00','2026-06-02 10:30:00','Braces adjustment follow-up',2,2,17,50.00),(3,'completed','2026-05-03 11:00:00','2026-05-03 12:00:00','Child anxious, went smoothly',3,3,10,100.00),(4,'completed','2026-04-24 14:00:00','2026-04-24 15:00:00','',4,3,9,60.00),(5,'completed','2026-03-15 09:30:00','2026-03-15 10:30:00',NULL,5,4,27,80.00),(6,'confirmed','2026-04-26 13:00:00','2026-04-26 14:00:00','Filling on upper right',6,1,7,70.00),(7,'confirmed','2026-03-17 10:00:00','2026-03-17 11:30:00','First braces fitting',5,2,11,NULL),(8,'confirmed','2026-02-18 09:00:00','2026-02-18 09:30:00',NULL,4,3,2,NULL),(9,'pending','2026-06-10 15:00:00',NULL,'Root canal scheduled',2,1,8,NULL),(10,'cancelled','2026-03-11 11:00:00',NULL,'Client cancelled same day',3,4,29,NULL),(13,'Pending','2026-06-02 12:00:00','2026-06-02 12:30:00',NULL,1,7,11,80.00),(14,'Pending','2026-06-03 12:30:00','2026-06-03 13:00:00',NULL,1,2,1,40.00),(15,'Pending','2026-06-03 11:00:00','2026-06-03 11:30:00',NULL,1,2,1,40.00),(16,'Pending','2026-05-19 15:00:00','2026-05-19 15:30:00',NULL,13,7,11,80.00),(17,'Pending','2026-06-09 15:30:00','2026-06-09 16:00:00',NULL,12,2,1,40.00),(18,'Pending','2026-06-09 16:00:00','2026-06-09 16:30:00',NULL,1,2,1,40.00),(19,'Pending','2026-06-09 15:30:00','2026-06-09 16:30:00',NULL,1,7,13,1000.00),(20,'Pending','2026-06-08 15:30:00','2026-06-08 16:30:00',NULL,12,7,14,1200.00),(21,'Pending','2026-09-08 16:00:00','2026-09-08 16:30:00',NULL,12,2,9,60.00),(22,'Completed','2026-06-04 09:30:00','2026-06-04 10:15:00',NULL,12,7,15,600.00),(23,'Pending','2026-06-12 15:00:00','2026-06-12 15:45:00',NULL,12,7,15,600.00),(24,'Pending','2026-06-09 14:00:00','2026-06-09 14:45:00',NULL,1,7,15,600.00),(25,'Pending','2026-06-10 13:30:00','2026-06-10 14:15:00',NULL,1,7,15,600.00),(26,'Pending','2026-06-11 13:30:00','2026-06-11 14:30:00',NULL,1,2,4,70.00),(27,'Pending','2026-06-23 12:00:00','2026-06-23 12:30:00',NULL,1,7,11,80.00),(28,'Pending','2026-06-08 10:00:00','2026-06-08 10:30:00',NULL,1,2,1,40.00),(29,'Pending','2026-06-17 12:00:00','2026-06-17 13:00:00',NULL,1,7,13,1000.00),(30,'Pending','2026-06-17 13:00:00','2026-06-17 14:00:00',NULL,1,7,14,1200.00),(31,'Pending','2026-06-09 10:00:00','2026-06-09 10:30:00',NULL,1,2,1,40.00),(32,'Pending','2026-06-24 14:30:00','2026-06-24 15:00:00',NULL,14,2,1,40.00),(33,'Pending','2026-07-08 09:00:00','2026-07-08 09:45:00',NULL,14,4,30,400.00);
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `appointment_overlap` BEFORE INSERT ON `appointment` FOR EACH ROW BEGIN
    DECLARE overlap_count INT;
    DECLARE new_end DATETIME;

    SELECT DATE_ADD(NEW.appointment_start, INTERVAL t_duration MINUTE)
    INTO new_end
    FROM treatment
    WHERE tid = NEW.treatment;

    SELECT COUNT(*) INTO overlap_count
    FROM appointment a
    WHERE a.dentist = NEW.dentist
      AND lower(a.appointment_status) != 'cancelled'
      AND (
        (NEW.appointment_start > a.appointment_start AND NEW.appointment_start < a.appointment_end)
            OR
        (new_end > a.appointment_start AND new_end < a.appointment_end)
            OR
        (NEW.appointment_start <= a.appointment_start AND new_end >= a.appointment_end)
        );

    IF overlap_count > 0 THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'That time slot is already taken for the selected dentist.';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `appointment_search`
--

DROP TABLE IF EXISTS `appointment_search`;
/*!50001 DROP VIEW IF EXISTS `appointment_search`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `appointment_search` AS SELECT 
 1 AS `id`,
 1 AS `app`,
 1 AS `dateapp`,
 1 AS `fname`,
 1 AS `email`,
 1 AS `dentist`,
 1 AS `status`,
 1 AS `t_name`,
 1 AS `t_duration`,
 1 AS `price`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `c_name` varchar(200) NOT NULL,
  `c_description` text,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'General dentistry','Provides oral health care and routine dental services'),(2,'Orthodontics','Teeth straightening and correcting'),(3,'Aesthetics','Teeth improving through whitening, veneers, and bonding'),(4,'Implantology','Concerned with replacing missing teeth using implants and prostheses');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dentist`
--

DROP TABLE IF EXISTS `dentist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dentist` (
  `did` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `specialty` int NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `room` int NOT NULL,
  `d_status` varchar(500) DEFAULT 'Active',
  PRIMARY KEY (`did`),
  KEY `specialty` (`specialty`),
  KEY `dentist_first_name` (`first_name`),
  KEY `dentist_last_name` (`last_name`),
  CONSTRAINT `dentist_ibfk_1` FOREIGN KEY (`specialty`) REFERENCES `speciality` (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dentist`
--

LOCK TABLES `dentist` WRITE;
/*!40000 ALTER TABLE `dentist` DISABLE KEYS */;
INSERT INTO `dentist` VALUES (1,'Rachel','Greene',6,'+1-555-0201','r.greene@clinic.com',1,'Active'),(2,'Marcus','Hiding',1,'+1-555-0202','m.holt@clinic.com',2,'Active'),(3,'Emma','Ross',3,'+1-555-0204','s.kovac@clinic.com',4,'Active'),(4,'Laura','Simmons',4,'+1-555-0205','l.simmons@clinic.com',5,'Active'),(7,'John','Doe',2,'060000001','john.doe@clinic.com',5,'Active'),(8,'Anna','Bell',5,'060000002','anna.bell@clinic.com',6,'Active'),(14,'naida','mstg',2,'39429','naida@gmail',2,'Inactive');
/*!40000 ALTER TABLE `dentist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'1_create_people_table.sql'),(2,'2_create_specialty_table.sql'),(3,'3_create_dentist_table.sql'),(4,'4_create_category_table.sql'),(5,'5_create_treatment_table.sql'),(6,'6_create_appointment_table.sql'),(7,'7_insert_people.sql'),(8,'8_insert_specialty.sql'),(9,'9_insert_dentist.sql'),(10,'10_insert_categories.sql'),(11,'11_insert_treatments.sql'),(12,'12_insert_appointment.sql'),(13,'13_appointment_trigger.sql'),(14,'14_book_appointment_procedure.sql'),(15,'15_alter_dentist_table.sql'),(16,'16_create_appointment_search_view.sql'),(17,'17_create_fname_index.sql'),(18,'18_create_lname_index.sql'),(19,'19_create_email_index.sql'),(20,'20_create_dentist_fname_index.sql'),(21,'21_create_dentist_lname_index.sql'),(22,'22_create_treatment_name_index.sql'),(23,'23_calculating_price_function.sql'),(24,'24_create_treatment_search_view.sql');
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `people` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(500) NOT NULL,
  `last_name` varchar(500) NOT NULL,
  `DOB` date NOT NULL,
  `phone` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `p_password` varchar(500) NOT NULL,
  `p_status` varchar(100) DEFAULT 'Active',
  `deleted_at` date DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`pid`),
  KEY `people_first_name` (`first_name`),
  KEY `people_last_name` (`last_name`),
  KEY `people_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,'James','Carter','1990-03-14','+1-555-0101','james.carter@email.com','james1234','Active',NULL,0),(2,'Sofia','Mendez','1985-07-22','+1-555-0102','sofia.mendez@email.com','sofia123','Active',NULL,0),(3,'Liam','Novak','1995-11-05','+1-555-0103','liam.novak@email.com','liam123','Active',NULL,0),(4,'Aisha','Patel','1992-01-30','+1-555-0104','aisha.patel@email.com','aisha123','Active',NULL,0),(5,'Marco','Rossi','1988-09-18','+1-555-0105','marco.rossi@email.com','marco123','Active',NULL,0),(6,'Emily','Brooks','1997-04-11','+1-555-0106','emily.brooks@email.com','brook123','Active',NULL,0),(7,'Daniel','Kim','1983-12-25','+1-555-0107','daniel.kim@email.com','daniel123','Active',NULL,0),(8,'Priya','Singh','1999-06-03','+1-555-0108','priya.singh@email.com','mj123','Active',NULL,0),(9,'Natalie','Fontaine','1994-02-09','+1-555-0109','natalie.fontaine@email.com','natalie','Active',NULL,0),(10,'Sumeja','Imamovic','2002-01-12','+1-555-0110','sumeja.imamovic@email.com','admin','Active',NULL,1),(11,'','','2026-05-28','','','admin','Inactive',NULL,0),(12,'','','1000-01-01','','','','Inactive','2026-06-06',0),(13,'','','2026-06-06','','','zara123','Inactive',NULL,0),(14,'emilija','emili','2005-05-05','093480398','emilija@gmail.com','emilija123','Active',NULL,0);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speciality`
--

DROP TABLE IF EXISTS `speciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `speciality` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speciality`
--

LOCK TABLES `speciality` WRITE;
/*!40000 ALTER TABLE `speciality` DISABLE KEYS */;
INSERT INTO `speciality` VALUES (1,'Orthodontist','Straightens teeth and corrects bite issues using braces and aligners'),(2,'Periodontist','Treats gum disease and performs procedures on gums and supporting bone'),(3,'Oral Surgeon','Performs tooth extractions, jaw surgeries, and implant placements'),(4,'Prosthodontist','Restores and replaces teeth with crowns, bridges, dentures, and implants'),(5,'Dental Radiologist','Interprets dental X-rays and imaging to diagnose oral conditions'),(6,'General Dentist','Provides routine checkups, cleanings, fillings, and overall oral care');
/*!40000 ALTER TABLE `speciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treatment`
--

DROP TABLE IF EXISTS `treatment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `treatment` (
  `tid` int NOT NULL AUTO_INCREMENT,
  `t_name` varchar(500) NOT NULL,
  `t_duration` int NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `category` int NOT NULL,
  `t_status` varchar(100) DEFAULT 'Active',
  PRIMARY KEY (`tid`),
  KEY `category` (`category`),
  KEY `treat_name` (`t_name`),
  CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treatment`
--

LOCK TABLES `treatment` WRITE;
/*!40000 ALTER TABLE `treatment` DISABLE KEYS */;
INSERT INTO `treatment` VALUES (1,'Dental examination',30,40.00,1,'Active'),(2,'Examination + panoramic X-ray (OPG)',45,90.00,1,'Active'),(3,'Ultrasonic cleaning (removal of tartar)',45,50.00,1,'Active'),(4,'Cleaning + polishing package',60,70.00,1,'Active'),(5,'Composite filling - 1 surface',30,50.00,1,'Active'),(6,'Composite filling - 2 surfaces',45,60.00,1,'Active'),(7,'Composite filling - multiple surfaces',60,70.00,1,'Active'),(8,'Root canal (per canal)',60,50.00,1,'Active'),(9,'Tooth extraction - general',30,60.00,1,'Active'),(10,'Tooth extraction - surgical',60,100.00,1,'Active'),(11,'Orthodontic consultation',30,80.00,2,'Active'),(12,'Metal braces - per jaw',60,800.00,2,'Active'),(13,'Ceramic braces - per jaw',60,1000.00,2,'Active'),(14,'Clear aligners',60,1200.00,2,'Active'),(15,'Removable orthodontic appliances - per jaw',45,600.00,2,'Active'),(16,'Fixed retainer (wire)',30,200.00,2,'Active'),(17,'Control visit',20,50.00,2,'Active'),(18,'Aesthetic consultation',30,40.00,3,'Active'),(19,'Teeth whitening - per jaw',60,200.00,3,'Active'),(20,'Composite veneers',60,200.00,3,'Active'),(21,'Ceramic veneers',90,400.00,3,'Active'),(22,'E-max veneers',90,600.00,3,'Active'),(23,'Metal-ceramic crown',60,150.00,3,'Active'),(24,'Full ceramic crown',60,300.00,3,'Active'),(25,'Zirconia crown',60,500.00,3,'Active'),(26,'Implant consultation',30,60.00,4,'Active'),(27,'Treatment planning (implant positioning)',45,80.00,4,'Active'),(28,'Dental implant - OSSTEM',90,1200.00,4,'Active'),(29,'Dental implant - Straumann',90,1500.00,4,'Active'),(30,'Abutment - OSSTEM',45,400.00,4,'Active'),(31,'Abutment - Straumann',45,500.00,4,'Active'),(32,'All-on-6 / metal-ceramic',180,6500.00,4,'Active'),(33,'All-on-6 / prettau zirconia',180,7500.00,4,'Active'),(34,'All-on-4 / metal-ceramic',180,5500.00,4,'Active'),(35,'All-on-4 / prettau zirconia',180,6500.00,4,'Active');
/*!40000 ALTER TABLE `treatment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vtreatment_details`
--

DROP TABLE IF EXISTS `vtreatment_details`;
/*!50001 DROP VIEW IF EXISTS `vtreatment_details`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vtreatment_details` AS SELECT 
 1 AS `tid`,
 1 AS `tName`,
 1 AS `tDuration`,
 1 AS `tPrice`,
 1 AS `tStatus`,
 1 AS `cName`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'dentist_office'
--
/*!50003 DROP FUNCTION IF EXISTS `calculate_appointment_total_price` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `calculate_appointment_total_price`(p_treatment_id INT) RETURNS decimal(8,2)
    DETERMINISTIC
BEGIN
    DECLARE v_price DECIMAL(8,2);

SELECT price INTO v_price
FROM treatment
WHERE tid = p_treatment_id;

RETURN v_price;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `book_appointment` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `book_appointment`(
    IN p_patient_id   INT,
    IN p_treatment_id INT,
    IN p_start        DATETIME
)
BEGIN
    DECLARE v_dentist_id  INT;
    DECLARE v_end         DATETIME;
    DECLARE v_price       DECIMAL(8,2);

    -- Compute end time and grab price from treatment
    SELECT
        DATE_ADD(p_start, INTERVAL t_duration MINUTE),
        price
    INTO v_end, v_price
    FROM treatment
    WHERE tid = p_treatment_id;

    -- Find the dentist whose speciality matches the treatment's category
    -- treatment.category (FK) -> category.cid
    -- category.cid is matched against speciality.sid (same domain — speciality covers a category)
    -- dentist.specialty (FK) -> speciality.sid
    SELECT d.did
    INTO   v_dentist_id
    FROM   dentist d
               JOIN   speciality s ON s.sid = d.specialty
               JOIN   treatment  t ON t.category = s.sid
    WHERE  t.tid = p_treatment_id
    LIMIT 1;

    -- No dentist covers this treatment's category
    IF v_dentist_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No dentist found for the selected treatment.';
    END IF;

    IF p_start < NOW() THEN
        SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'Appointment date cannot be in the past.';
    END IF;

    -- Insert — the appointment_overlap trigger fires here automatically
    INSERT INTO appointment
    (appointment_start, appointment_end,
     people, dentist, treatment, app_total_price)
    VALUES
        ( p_start, v_end,
         p_patient_id, v_dentist_id, p_treatment_id, calculate_appointment_total_price(p_treatment_id));

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `appointment_search`
--

/*!50001 DROP VIEW IF EXISTS `appointment_search`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `appointment_search` AS select `a`.`aid` AS `id`,`a`.`appointment_start` AS `app`,cast(`a`.`appointment_start` as date) AS `dateapp`,concat(`p`.`first_name`,' ',`p`.`last_name`) AS `fname`,`p`.`email` AS `email`,concat(`d`.`first_name`,' ',`d`.`last_name`) AS `dentist`,`a`.`appointment_status` AS `status`,`t`.`t_name` AS `t_name`,`t`.`t_duration` AS `t_duration`,`a`.`app_total_price` AS `price` from (((`appointment` `a` join `dentist` `d` on((`a`.`dentist` = `d`.`did`))) join `people` `p` on((`a`.`people` = `p`.`pid`))) join `treatment` `t` on((`a`.`treatment` = `t`.`tid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vtreatment_details`
--

/*!50001 DROP VIEW IF EXISTS `vtreatment_details`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vtreatment_details` AS select `t`.`tid` AS `tid`,`t`.`t_name` AS `tName`,`t`.`t_duration` AS `tDuration`,`t`.`price` AS `tPrice`,lower(`t`.`t_status`) AS `tStatus`,`c`.`c_name` AS `cName` from (`treatment` `t` join `category` `c` on((`t`.`category` = `c`.`cid`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-07 20:17:38
