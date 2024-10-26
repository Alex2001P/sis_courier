-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sis_courier_guatemala
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `idDepa` int NOT NULL AUTO_INCREMENT,
  `Departamento` varchar(50) NOT NULL,
  `km` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idDepa`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'Alta Verapaz','172'),(2,'Baja Verapaz','233'),(3,'Chimaltenango','302'),(4,'Chiquimula','89'),(5,'El Progreso','150'),(6,'Escuintla','357'),(7,'Guatemala','294'),(8,'Huehuetenango','455'),(9,'Izabal','0'),(10,'Jalapa','168'),(11,'Jutiapa','201'),(12,'Petén','365'),(13,'Quetzaltenango','404'),(14,'Quiché','360'),(15,'Retalhuleu','421'),(16,'Sacatepéquez','312'),(17,'San Marcos','449'),(18,'Santa Rosa','267'),(19,'Solola','376'),(20,'Suchitepéquez','383'),(21,'Totonicapán','389'),(22,'Zacapa','120');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distritos`
--

DROP TABLE IF EXISTS `distritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distritos` (
  `idDist` int NOT NULL AUTO_INCREMENT,
  `Distrito` varchar(50) NOT NULL,
  `idProv` int NOT NULL,
  PRIMARY KEY (`idDist`),
  KEY `FK_idProv_Dist` (`idProv`),
  CONSTRAINT `distritos_ibfk_1` FOREIGN KEY (`idProv`) REFERENCES `provincias` (`idProv`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=1833 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distritos`
--

LOCK TABLES `distritos` WRITE;
/*!40000 ALTER TABLE `distritos` DISABLE KEYS */;
/*!40000 ALTER TABLE `distritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresa` (
  `id_empresa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `ubicacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (1,'TOURS SANTA ROSA DE LIMA','envios y recepcion de encomiendas','Jr. Grau santa rosa','925310896','santa_rosa@gmail.com','logo.png');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envio`
--

DROP TABLE IF EXISTS `envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `envio` (
  `id_envio` int NOT NULL AUTO_INCREMENT,
  `numero_reg` varchar(255) DEFAULT NULL,
  `id_remitente` int DEFAULT NULL,
  `id_receptor` int DEFAULT NULL,
  `fecha_salida` datetime DEFAULT NULL,
  `fecha_recojo` datetime DEFAULT NULL,
  `desde_distrito` int DEFAULT NULL,
  `desde_barrio` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `desde_direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hasta_distrito` int DEFAULT NULL,
  `hasta_barrio` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `hasta_direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `cantidad` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `precio` decimal(10,2) DEFAULT NULL,
  `pago_estado` tinyint DEFAULT NULL,
  `envio_estado` int DEFAULT NULL,
  `registrado_por` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `recepcionado_por` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tipo_envio` varchar(255) DEFAULT NULL,
  `tarifa` varchar(255) DEFAULT NULL,
  `km` varchar(255) DEFAULT NULL,
  `peso` varchar(255) DEFAULT NULL,
  `largo` varchar(255) DEFAULT NULL,
  `ancho` varchar(255) DEFAULT NULL,
  `alto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_envio`),
  KEY `fk1` (`id_remitente`),
  KEY `fk2` (`id_receptor`),
  KEY `fk3` (`desde_distrito`),
  KEY `fk4` (`hasta_distrito`),
  KEY `fk5` (`envio_estado`),
  KEY `fk06` (`tipo_envio`),
  CONSTRAINT `fk1` FOREIGN KEY (`id_remitente`) REFERENCES `remitente` (`id_remitente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk2` FOREIGN KEY (`id_receptor`) REFERENCES `receptor` (`id_receptor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk3` FOREIGN KEY (`desde_distrito`) REFERENCES `provincias` (`idProv`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk4` FOREIGN KEY (`hasta_distrito`) REFERENCES `provincias` (`idProv`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk5` FOREIGN KEY (`envio_estado`) REFERENCES `estado_envio` (`id_estado_envio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envio`
--

LOCK TABLES `envio` WRITE;
/*!40000 ALTER TABLE `envio` DISABLE KEYS */;
INSERT INTO `envio` VALUES (24,'1',6,5,'2024-09-18 00:00:00','0000-00-00 00:00:00',125,'AMATES','LOS INCAS 123',180,'BOLIVIA 4','AV. EJERCITO S/N','1','un documento',40.00,1,1,'Isai Ismael Sandoval Ccaccro','','documento',NULL,'404',NULL,NULL,NULL,NULL),(25,'2',6,5,'2024-09-18 00:00:00','0000-00-00 00:00:00',125,'AMATES','LOS INCAS 123',226,'LA VICTORIA','AV. EJERCITO S/N','1','un paquete',290.56,1,1,'Isai Ismael Sandoval Ccaccro','','paquetes','peso','312','100',NULL,NULL,NULL),(26,'3',6,5,'2024-09-18 00:00:00','2024-09-18 01:59:22',125,'AMATES','LOS INCAS 123',179,'BABAHOYO','av ejercito','1','una caja',188.69,1,4,'Isai Ismael Sandoval Ccaccro','','paquetes','volumen','404','150','45','50','55'),(27,'4',6,5,'2024-09-20 00:00:00','0000-00-00 00:00:00',125,'AMATES','LOS INCAS 123',130,'LA VICTORIA','AV. EJERCITO S/N','1','un documento',30.64,1,1,'Isai Ismael Sandoval Ccaccro','','paquetes','volumen','168','100','20','20','20'),(28,'5',13,12,'2024-09-20 00:00:00','0000-00-00 00:00:00',127,'EL MANANTIAL','17 CALLE 10 AV.',271,'LA VICTORIA','22 CALLE','1','SE ESTA ENVIANDO UN DOCUMENTO',38.42,0,1,'Isai Ismael Sandoval Ccaccro','','paquetes','volumen','267','2','15','15','15');
/*!40000 ALTER TABLE `envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_envio`
--

DROP TABLE IF EXISTS `estado_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_envio` (
  `id_estado_envio` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_estado_envio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_envio`
--

LOCK TABLES `estado_envio` WRITE;
/*!40000 ALTER TABLE `estado_envio` DISABLE KEYS */;
INSERT INTO `estado_envio` VALUES (1,'recepcionado'),(2,'en transito'),(3,'en destino'),(4,'entregado');
/*!40000 ALTER TABLE `estado_envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincias`
--

DROP TABLE IF EXISTS `provincias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provincias` (
  `idProv` int NOT NULL AUTO_INCREMENT,
  `Provincia` varchar(50) NOT NULL,
  `idDepa` int NOT NULL,
  PRIMARY KEY (`idProv`),
  KEY `FK_idDepa_Prov` (`idDepa`),
  CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`idDepa`) REFERENCES `departamentos` (`idDepa`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=339 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincias`
--

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` VALUES (1,'Chahal',1),(2,'Chisec',1),(3,'Cobán',1),(4,'Fray Bartolomé de las Casas',1),(5,'La Tinta',1),(6,'Lanquín',1),(7,'Panzós',1),(8,'Raxruhá',1),(9,'San Cristóbal Verapaz',1),(10,'San Juan Chamelco',1),(11,'San Pedro Carchá',1),(12,'Santa Cruz Verapaz',1),(13,'Santa María Cahabón',1),(14,'Senahú',1),(15,'Tamahú',1),(16,'Tactic',1),(17,'Tucurú',1),(18,'Cubulco',2),(19,'Granados',2),(20,'Purulhá',2),(21,'Rabinal',2),(22,'Salamá',2),(23,'San Jerónimo',2),(24,'San Miguel Chicaj',2),(25,'Santa Cruz el Chol',2),(26,'Acatenango',3),(27,'Chimaltenango',3),(28,'El Tejar',3),(29,'Parramos',3),(30,'Patzicía',3),(31,'Patzún',3),(32,'Pochuta',3),(33,'San Andrés Itzapa',3),(34,'San José Poaquíl',3),(35,'San Juan Comalapa',3),(36,'San Martín Jilotepeque',3),(37,'Santa Apolonia',3),(38,'Santa Cruz Balanyá',3),(39,'Tecpán',3),(40,'Yepocapa',3),(41,'Zaragoza',3),(42,'Camotán',4),(43,'Chiquimula',4),(44,'Concepción Las Minas',4),(45,'Esquipulas',4),(46,'Ipala',4),(47,'Jocotán',4),(48,'Olopa',4),(49,'Quezaltepeque',4),(50,'San Jacinto',4),(51,'San José la Arada',4),(52,'San Juan Ermita',4),(53,'El Jícaro',5),(54,'Guastatoya',5),(55,'Morazán',5),(56,'San Agustín Acasaguastlán',5),(57,'San Antonio La Paz',5),(58,'San Cristóbal Acasaguastlán',5),(59,'Sanarate',5),(60,'Sansare',5),(61,'Escuintla',6),(62,'Guanagazapa',6),(63,'Iztapa',6),(64,'La Democracia',6),(65,'La Gomera',6),(66,'Masagua',6),(67,'Nueva Concepción',6),(68,'Palín',6),(69,'San José',6),(70,'San Vicente Pacaya',6),(71,'Santa Lucía Cotzumalguapa',6),(72,'Siquinalá',6),(73,'Tiquisate',6),(74,'Amatitlán',7),(75,'Chinautla',7),(76,'Chuarrancho',7),(77,'Guatemala',7),(78,'Fraijanes',7),(79,'Mixco',7),(80,'Palencia',7),(81,'San José del Golfo',7),(82,'San José Pinula',7),(83,'San Juan Sacatepéquez',7),(84,'San Miguel Petapa',7),(85,'San Pedro Ayampuc',7),(86,'San Pedro Sacatepéquez',7),(87,'San Raymundo',7),(88,'Santa Catarina Pinula',7),(89,'Villa Canales',7),(90,'Villa Nueva',7),(91,'Aguacatán',8),(92,'Chiantla',8),(93,'Colotenango',8),(94,'Concepción Huista',8),(95,'Cuilco',8),(96,'Huehuetenango',8),(97,'Jacaltenango',8),(98,'La Democracia',8),(99,'La Libertad',8),(100,'Malacatancito',8),(101,'Nentón',8),(102,'San Antonio Huista',8),(103,'San Gaspar Ixchil',8),(104,'San Ildefonso Ixtahuacán',8),(105,'San Juan Atitán',8),(106,'San Juan Ixcoy',8),(107,'San Mateo Ixtatán',8),(108,'San Miguel Acatán',8),(109,'San Pedro Nécta',8),(110,'San Pedro Soloma',8),(111,'San Rafael La Independencia',8),(112,'San Rafael Pétzal',8),(113,'San Sebastián Coatán',8),(114,'San Sebastián Huehuetenango',8),(115,'Santa Ana Huista',8),(116,'Santa Bárbara',8),(117,'Santa Cruz Barillas',8),(118,'Santa Eulalia',8),(119,'Santiago Chimaltenango',8),(120,'Tectitán',8),(121,'Todos Santos Cuchumatán',8),(122,'Unión Cantinil',8),(123,'El Estor',9),(124,'Livingston',9),(125,'Los Amates',9),(126,'Morales',9),(127,'Puerto Barrios',9),(128,'Jalapa',10),(129,'Mataquescuintla',10),(130,'Monjas',10),(131,'San Carlos Alzatate',10),(132,'San Luis Jilotepeque',10),(133,'San Manuel Chaparrón',10),(134,'San Pedro Pinula',10),(135,'Agua Blanca',11),(136,'Asunción Mita',11),(137,'Atescatempa',11),(138,'Comapa',11),(139,'Conguaco',11),(140,'El Adelanto',11),(141,'El Progreso',11),(142,'Jalpatagua',11),(143,'Jerez',11),(144,'Jutiapa',11),(145,'Moyuta',11),(146,'Pasaco',11),(147,'Quesada',11),(148,'San José Acatempa',11),(149,'Santa Catarina Mita',11),(150,'Yupiltepeque',11),(151,'Zapotitlán',11),(152,'Dolores',12),(153,'El Chal',12),(154,'Ciudad Flores',12),(155,'La Libertad',12),(156,'Las Cruces',12),(157,'Melchor de Mencos',12),(158,'Poptún',12),(159,'San Andrés',12),(160,'San Benito',12),(161,'San Francisco',12),(162,'San José',12),(163,'San Luis',12),(164,'Santa Ana',12),(165,'Sayaxché',12),(166,'Almolonga',13),(167,'Cabricán',13),(168,'Cajolá',13),(169,'Cantel',13),(170,'Coatepeque',13),(171,'Colomba Costa Cuca',13),(172,'Concepción Chiquirichapa',13),(173,'El Palmar',13),(174,'Flores Costa Cuca',13),(175,'Génova',13),(176,'Huitán',13),(177,'La Esperanza',13),(178,'Olintepeque',13),(179,'Palestina de Los Altos',13),(180,'Quetzaltenango',13),(181,'Salcajá',13),(182,'San Carlos Sija',13),(183,'San Francisco La Unión',13),(184,'San Juan Ostuncalco',13),(185,'San Martín Sacatepéquez',13),(186,'San Mateo',13),(187,'San Miguel Sigüilá',13),(188,'Sibilia',13),(189,'Zunil',13),(190,'Canillá',14),(191,'Chajul',14),(192,'Chicamán',14),(193,'Chiché',14),(194,'Chichicastenango',14),(195,'Chinique',14),(196,'Cunén',14),(197,'Ixcán Playa Grande',14),(198,'Joyabaj',14),(199,'Nebaj',14),(200,'Pachalum',14),(201,'Patzité',14),(202,'Sacapulas',14),(203,'San Andrés Sajcabajá',14),(204,'San Antonio Ilotenango',14),(205,'San Bartolomé Jocotenango',14),(206,'San Juan Cotzal',14),(207,'San Pedro Jocopilas',14),(208,'Santa Cruz del Quiché',14),(209,'Uspantán',14),(210,'Zacualpa',14),(211,'Champerico',15),(212,'El Asintal',15),(213,'Nuevo San Carlos',15),(214,'Retalhuleu',15),(215,'San Andrés Villa Seca',15),(216,'San Felipe Reu',15),(217,'San Martín Zapotitlán',15),(218,'San Sebastián',15),(219,'Santa Cruz Muluá',15),(220,'Alotenango',16),(221,'Ciudad Vieja',16),(222,'Jocotenango',16),(223,'Antigua Guatemala',16),(224,'Magdalena Milpas Altas',16),(225,'Pastores',16),(226,'San Antonio Aguas Calientes',16),(227,'San Bartolomé Milpas Altas',16),(228,'San Lucas Sacatepéquez',16),(229,'San Miguel Dueñas',16),(230,'Santa Catarina Barahona',16),(231,'Santa Lucía Milpas Altas',16),(232,'Santa María de Jesús',16),(233,'Santiago Sacatepéquez',16),(234,'Santo Domingo Xenacoj',16),(235,'Sumpango',16),(236,'Ayutla',17),(237,'Catarina',17),(238,'Comitancillo',17),(239,'Concepción Tutuapa',17),(240,'El Quetzal',17),(241,'El Tumbador',17),(242,'Esquipulas Palo Gordo',17),(243,'Ixchiguán',17),(244,'La Blanca',17),(245,'La Reforma',17),(246,'Malacatán',17),(247,'Nuevo Progreso',17),(248,'Ocós',17),(249,'Pajapita',17),(250,'Río Blanco',17),(251,'San Antonio Sacatepéquez',17),(252,'San Cristóbal Cucho',17),(253,'San José El Rodeo',17),(254,'San José Ojetenam',17),(255,'San Lorenzo',17),(256,'San Marcos',17),(257,'San Miguel Ixtahuacán',17),(258,'San Pablo',17),(259,'San Pedro Sacatepéquez',17),(260,'San Rafael Pie de la Cuesta',17),(261,'Sibinal',17),(262,'Sipacapa',17),(263,'Tacaná',17),(264,'Tajumulco',17),(265,'Tejutla',17),(266,'Barberena',18),(267,'Casillas',18),(268,'Chiquimulilla',18),(269,'Cuilapa',18),(270,'Guazacapán',18),(271,'Nueva Santa Rosa',18),(272,'Oratorio',18),(273,'Pueblo Nuevo Viñas',18),(274,'San Juan Tecuaco',18),(275,'San Rafael las Flores',18),(276,'Santa Cruz Naranjo',18),(277,'Santa María Ixhuatán',18),(278,'Santa Rosa de Lima',18),(279,'Taxisco',18),(280,'Concepción',19),(281,'Nahualá',19),(282,'Panajachel',19),(283,'San Andrés Semetabaj',19),(284,'San Antonio Palopó',19),(285,'San José Chacayá',19),(286,'San Juan La Laguna',19),(287,'San Lucas Tolimán',19),(288,'San Marcos La Laguna',19),(289,'San Pablo La Laguna',19),(290,'San Pedro La Laguna',19),(291,'Santa Catarina Ixtahuacán',19),(292,'Santa Catarina Palopó',19),(293,'Santa Clara La Laguna',19),(294,'Santa Cruz La Laguna',19),(295,'Santa Lucía Utatlán',19),(296,'Santa María Visitación',19),(297,'Santiago Atitlán',19),(298,'Sololá',19),(299,'Chicacao',20),(300,'Cuyotenango',20),(301,'Mazatenango',20),(302,'Patulul',20),(303,'Pueblo Nuevo',20),(304,'Río Bravo',20),(305,'Samayac',20),(306,'San Antonio Suchitepéquez',20),(307,'San Bernardino',20),(308,'San Francisco Zapotitlán',20),(309,'San Gabriel',20),(310,'San José El Idolo',20),(311,'San José La Maquina',20),(312,'San Juan Bautista',20),(313,'San Lorenzo',20),(314,'San Miguel Panán',20),(315,'San Pablo Jocopilas',20),(316,'Santa Bárbara',20),(317,'Santo Domingo Suchitepéquez',20),(318,'Santo Tomás La Unión',20),(319,'Zunilito',20),(320,'Momostenango',21),(321,'San Andrés Xecul',21),(322,'San Bartolo',21),(323,'San Cristóbal Totonicapán',21),(324,'San Francisco El Alto',21),(325,'Santa Lucía La Reforma',21),(326,'Santa María Chiquimula',21),(327,'Totonicapán',21),(328,'Cabañas',22),(329,'Estanzuela',22),(330,'Gualán',22),(331,'Huité',22),(332,'La Unión',22),(333,'Río Hondo',22),(334,'San Diego',22),(335,'San Jorge',22),(336,'Teculután',22),(337,'Usumatlán',22),(338,'Zacapa',22);
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receptor`
--

DROP TABLE IF EXISTS `receptor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receptor` (
  `id_receptor` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) DEFAULT NULL,
  `nombre_razon_social` varchar(255) DEFAULT NULL,
  `departamento` int DEFAULT NULL,
  `provincia` int DEFAULT NULL,
  `distrito` int DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_receptor`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receptor`
--

LOCK TABLES `receptor` WRITE;
/*!40000 ALTER TABLE `receptor` DISABLE KEYS */;
INSERT INTO `receptor` VALUES (5,'78945612','juanito quispe mamanis',NULL,NULL,NULL,'los incass','9996660005'),(6,'74433542','juanito quispe mamanis',NULL,NULL,NULL,'los incass','9996660005'),(9,'78945600','luz',NULL,NULL,NULL,'los incas','123'),(10,'12345678','Marlon Marmolejo Gonzales',NULL,NULL,NULL,'av. san marcos','987456321'),(11,'22222222','Maria',NULL,NULL,NULL,NULL,'456'),(12,'1234567897891','JUAN',NULL,NULL,NULL,NULL,'98745632');
/*!40000 ALTER TABLE `receptor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remitente`
--

DROP TABLE IF EXISTS `remitente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `remitente` (
  `id_remitente` int NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) DEFAULT NULL,
  `nombre_razon_social` varchar(255) DEFAULT NULL,
  `departamento` int DEFAULT NULL,
  `provincia` int DEFAULT NULL,
  `distrito` int DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_remitente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remitente`
--

LOCK TABLES `remitente` WRITE;
/*!40000 ALTER TABLE `remitente` DISABLE KEYS */;
INSERT INTO `remitente` VALUES (6,'74433542','julio',NULL,NULL,NULL,'ayacucho','123'),(7,'12345678','juan carlos gonzles',NULL,NULL,NULL,'la mar','999888777'),(8,'74433545','julio gonzales quispe',NULL,NULL,NULL,'ayacucho','123'),(11,'78945612','julian',NULL,NULL,NULL,'ayacucho','123'),(12,'11111111','Pepito',NULL,NULL,NULL,NULL,'123'),(13,'1234567891011','ALEX',NULL,NULL,NULL,NULL,'12345678');
/*!40000 ALTER TABLE `remitente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sucursal`
--

DROP TABLE IF EXISTS `sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sucursal` (
  `id_sucursal` int NOT NULL AUTO_INCREMENT,
  `distrito` int DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `barrio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sucursal`),
  KEY `fk` (`distrito`),
  CONSTRAINT `fk` FOREIGN KEY (`distrito`) REFERENCES `provincias` (`idProv`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sucursal`
--

LOCK TABLES `sucursal` WRITE;
/*!40000 ALTER TABLE `sucursal` DISABLE KEYS */;
INSERT INTO `sucursal` VALUES (6,127,'SUCURSAL 1','17 CALLE 10 AV.','12345678','EL MANANTIAL');
/*!40000 ALTER TABLE `sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_envio`
--

DROP TABLE IF EXISTS `tipo_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_envio` (
  `id_tipo_envio` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) DEFAULT NULL,
  `precio` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_envio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_envio`
--

LOCK TABLES `tipo_envio` WRITE;
/*!40000 ALTER TABLE `tipo_envio` DISABLE KEYS */;
INSERT INTO `tipo_envio` VALUES (1,'paquetes','0'),(2,'documento','40');
/*!40000 ALTER TABLE `tipo_envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `id_sucursal` int DEFAULT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombres` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT '',
  PRIMARY KEY (`id_usuario`),
  KEY `fk7` (`id_sucursal`),
  CONSTRAINT `fk7` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursal` (`id_sucursal`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,6,'isai','202cb962ac59075b964b07152d234b70','Isai Ismael Sandoval Ccaccro','987456321','isai.ismael1999@gmail.com','904908','1.jpg'),(5,6,'ismael','202cb962ac59075b964b07152d234b70','ismael gonzales','999888777','isma@gmail.com',NULL,'');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-23 22:08:08
