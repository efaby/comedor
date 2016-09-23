-- MySQL dump 10.13  Distrib 5.7.9, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: comedor
-- ------------------------------------------------------
-- Server version	5.5.52-0ubuntu0.14.04.1

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
-- Table structure for table `confronta`
--

DROP TABLE IF EXISTS `confronta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `confronta` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `confronta_general_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `desayuno` tinyint(4) NOT NULL DEFAULT '0',
  `almuerzo` tinyint(4) NOT NULL DEFAULT '0',
  `merienda` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_registro` date NOT NULL,
  `fecha_acceso` date NOT NULL,
  `acceso` tinyint(4) NOT NULL DEFAULT '1',
  `guardia` tinyint(4) NOT NULL DEFAULT '0',
  `usuario_id` int(11) DEFAULT NULL,
  `unidad_id` int(11) DEFAULT NULL,
  `novedad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_confronta_persona1_idx` (`persona_id`),
  KEY `fk_confronta_confronta_general1_idx` (`confronta_general_id`),
  CONSTRAINT `fk_confronta_confronta_general1` FOREIGN KEY (`confronta_general_id`) REFERENCES `confronta_general` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_confronta_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confronta`
--

LOCK TABLES `confronta` WRITE;
/*!40000 ALTER TABLE `confronta` DISABLE KEYS */;
/*!40000 ALTER TABLE `confronta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `confronta_general`
--

DROP TABLE IF EXISTS `confronta_general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `confronta_general` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_id` int(11) NOT NULL DEFAULT '0',
  `desayuno_ofi` int(11) NOT NULL DEFAULT '0',
  `desayuno_vol` int(11) NOT NULL DEFAULT '0',
  `desayuno_con` int(11) NOT NULL DEFAULT '0',
  `almuerzo_ofi` int(11) NOT NULL DEFAULT '0',
  `almuerzo_vol` int(11) NOT NULL DEFAULT '0',
  `almuerzo_con` int(11) NOT NULL DEFAULT '0',
  `merienda_ofi` int(11) NOT NULL DEFAULT '0',
  `merienda_vol` int(11) NOT NULL DEFAULT '0',
  `merienda_con` int(11) NOT NULL DEFAULT '0',
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_acceso` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `usuario_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `confronta_general`
--

LOCK TABLES `confronta_general` WRITE;
/*!40000 ALTER TABLE `confronta_general` DISABLE KEYS */;
/*!40000 ALTER TABLE `confronta_general` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `extra_confronta`
--

DROP TABLE IF EXISTS `extra_confronta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `extra_confronta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `tipo_servicio` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_extra_confronta_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_extra_confronta_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `extra_confronta`
--

LOCK TABLES `extra_confronta` WRITE;
/*!40000 ALTER TABLE `extra_confronta` DISABLE KEYS */;
/*!40000 ALTER TABLE `extra_confronta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grado_persona`
--

DROP TABLE IF EXISTS `grado_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grado_persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_persona_id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `abreviatura` varchar(64) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_grado_persona_tipo_persona1_idx` (`tipo_persona_id`),
  CONSTRAINT `fk_grado_persona_tipo_persona1` FOREIGN KEY (`tipo_persona_id`) REFERENCES `tipo_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grado_persona`
--

LOCK TABLES `grado_persona` WRITE;
/*!40000 ALTER TABLE `grado_persona` DISABLE KEYS */;
INSERT INTO `grado_persona` VALUES (1,1,'General de Ejército','General de Ejército','GRAE',1),(2,1,'General de División','General de División','GRAD',1),(3,1,'General de Brigada','General de Brigada','GRAB',1),(4,1,'Coronel','Coronel','CRNL',1),(5,1,'Teniente Coronel','Teniente Coronel','TCRN',1),(6,1,'Mayor','Mayor','MAYO',1),(7,1,'Capitán','Capitán','CAPT',1),(8,1,'Teniente','Teniente','TNTE',1),(9,1,'Subteniente','Subteniente','SUBT',1),(10,1,'Cadete','Cadete','KDTE',1),(11,2,'Suboficial Mayor','Suboficial Mayor','SUBM',1),(12,2,'Suboficial 1ro','Suboficial 1ro','SUBP',1),(13,2,'Suboficial 2do','Suboficial 2do','SUBS',1),(14,2,'Sargento 1ro','Sargento 1ro','SGOP',1),(15,2,'Sargento 2do','Sargento 2do','SGOS',1),(16,2,'Cabo 1ro','Cabo 1ro','CBOP',1),(17,2,'Cabo 2do','Cabo 2do','CBOS',1),(18,2,'Soldado','Soldado','SLDO',1),(19,2,'Conscripto','Conscripto','CPTO',1);
/*!40000 ALTER TABLE `grado_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `novedad`
--

DROP TABLE IF EXISTS `novedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `tipo_novedad_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `url` varchar(64) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_novedad_tipo_novedad1_idx` (`tipo_novedad_id`),
  KEY `fk_novedad_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_novedad_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_novedad_tipo_novedad1` FOREIGN KEY (`tipo_novedad_id`) REFERENCES `tipo_novedad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedad`
--

LOCK TABLES `novedad` WRITE;
/*!40000 ALTER TABLE `novedad` DISABLE KEYS */;
INSERT INTO `novedad` VALUES (1,1,1,'2016-09-20','2016-09-23','novedad201609211109051_1540318128.pdf',0,1),(2,1,2,'2016-09-21','2016-09-21','novedad201609211109171_1784309635.pdf',0,0),(3,55,2,'2016-09-21','2016-09-30','novedad2016092111091655_165729210.pdf',0,1);
/*!40000 ALTER TABLE `novedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametros`
--

DROP TABLE IF EXISTS `parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(45) NOT NULL,
  `key` varchar(45) NOT NULL,
  `value` varchar(45) NOT NULL,
  `pattern` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametros`
--

LOCK TABLES `parametros` WRITE;
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_id` int(11) NOT NULL,
  `grado_persona_id` int(11) NOT NULL,
  `identificacion` varchar(10) NOT NULL,
  `nombres` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `arma` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `tarjeta` tinyint(4) NOT NULL DEFAULT '0',
  `usuario_id` int(11) DEFAULT '0',
  `activo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_persona_unidad1_idx` (`unidad_id`),
  KEY `fk_persona_grado_persona1_idx` (`grado_persona_id`),
  CONSTRAINT `fk_persona_grado_persona1` FOREIGN KEY (`grado_persona_id`) REFERENCES `grado_persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_unidad1` FOREIGN KEY (`unidad_id`) REFERENCES `unidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,13,7,'0603264474','MARCO ELEICIO','INCA CHUNATA','COM.','','',0,0,1),(2,13,7,'1718240573','VICTOR ORLANDO','SANCHEZ CARDENAS','COM.','','',0,0,1),(3,13,12,'0602248031','JUAN ANIBAL','MERINO CHAVEZ','COM','','',0,0,1),(4,13,12,'1101751343','PABLO ADALBERTO','JIMENEZ RIOS','COM.','','',0,0,1),(5,13,12,'0602468637','RODRIGO MANUEL','NOGALES PINDUISACA','I.','','',0,0,1),(6,13,14,'0602536377','LUIS ANGEL','CHAVEZ ','COM','','',0,0,1),(7,13,14,'1001491131','JAIME BENITO','TIERRA LEMA','COM','','',0,0,1),(8,13,14,'0602485971','JORGE SANDRO','SEGURA RODRIGUEZ','COM','','',0,0,1),(9,13,14,'1802648566','WILLIAM ROBERTO','IBARRA FALCONI','COM.','','',0,0,1),(10,13,14,'1802803575','WILLIAM FERNANDO','RUIZ GARCES','COM','','',0,0,1),(11,13,14,'0602462343','MIGUEL OSWALDO','QUISHPE QUISHPE','COM.','','',0,0,1),(12,13,15,'1712548021','LUIS REINALDO','VALVERDE PACHECO','COM.','','',0,0,1),(13,13,15,'1002520201','EDUARDO GUILLERMO','CRIOLLO BARAHONA','COM','','',0,0,1),(14,13,15,'1802987709','ANGEL FERNANDO','SALGUERO ZUMBA','COM.','','',0,0,1),(15,13,15,'0916365208','WILLIAM WLADIMIR','BASTIDAS GONZALEZ','COM.','','',0,0,1),(16,13,15,'0600299368','JORGE MILTON','CABEZAS QUINZO','COM.','','',0,0,1),(17,13,15,'1803092459','LUIS OLMEDO','NOGALES POVEDA','COM.','','',0,0,1),(18,13,15,'0600279133','CHRISTIAN RAMIRO','SANTOS LLERENA','COM.','','',0,0,1),(19,13,15,'0802083063','RONALD RICARDO','ARROYO MONTA','ELEC.','','',0,0,1),(20,13,15,'502621006','LUIS MARCELO','SUAREZ BUNSHI','COM','','',0,0,1),(21,13,15,'0603618372','HUGO BLADIMIR','CUJI SECAIRA','COM','','',0,0,1),(22,13,15,'0802326439','LUIS GERARDO','BURBANO TORRES','COM','','',0,0,1),(23,13,15,'1500621949','BLADIMIR MANUEL','TAPUY SHIGUANGO','COM.','','',0,0,1),(24,13,15,'1204449266','EDUARDO JAVIER','DIAZ COCHA','COM','','',0,0,1),(25,13,16,'1803589793','WILLIAM FABEICIO','SANCHEZ BUENA','COM.','','',0,0,1),(26,13,16,'0918152117','MARCELO IVAN','INTRIAGO DELGADO','COM.','','',0,0,1),(27,13,16,'1714678347','WILLIAM PATRICIO','PAILLACHO PAILLACHO','COM.','','',0,0,1),(28,13,16,'0603365735','OSWALDO PATRICIO','LATA AZACATA','COM.','','',0,0,1),(29,13,16,'1803488483','PORFIRIO EUCLIDES','AGUAGALLO AGUAGALLO','COM.','','',0,0,1),(30,13,16,'50292059','VICTOR HUGO','MEDINA MEDINA','COM.','','',0,0,1),(31,13,16,'0603225384','LUIS ENRIQUE','YAUTIBUG SAGNAY','COM.','','',0,0,1),(32,13,16,'0921752820','DENNYS HOMERO','MONCAYO ICAZA','COM.','','',0,0,1),(33,13,16,'1803279171','MARIO ROLANDO','SANCHEZ CARRASCO','ELEC.','','',0,0,1),(34,13,16,'0920372497','JUSTO ELIAS','GUAMAN CULLISPOMA','COM','','',0,0,1),(35,13,16,'1804455853','DIEGO ARMANDO','MACAS VILEMA','COM.','','',0,0,1),(36,13,16,'1720410610','CRISTHIAN GEOVANY','QUILLE CASPI','ELEC.','','',0,0,1),(37,13,16,'1718146150','LUIS ALFREDO','COLLAGUAZO ULCO','COM','','',0,0,1),(38,13,16,'0604116673','GUILLERMO ','RAMIREZ CABEZAS','COM.','','',0,0,1),(39,13,17,'0401559240','LUIS MIGUEL','VILLOTA VIANA','COM.','','',0,0,1),(40,13,17,'0401543095','JORGE GEOVANY','CUASQUER CUASPUD','COM','','',0,0,1),(41,13,17,'2200016000','JHONATAN VINICIO','GREFA NOTENO','COM.','','',0,0,1),(42,13,17,'1718472489','WILFRIDO ISAAC','FLORES COLCHA','COM.','','',0,0,1),(43,13,17,'1804645537','DARIO ALEJANDRO','LLERENA TIRADO','COM.','','',0,0,1),(44,13,17,'1600472391','GABRIEL ALEXANDER','TORRES JURADO','COM.','','',0,0,1),(45,13,17,'1002975512','ALVARO MANUEL','PAREDES LOMAS','COM.','','',0,0,1),(46,13,17,'1600579898','JIMY PATRICIO','SHIGUANGO ANDY','COM.','','',0,0,1),(47,13,17,'1718422890','WILLIAM VINICIO','ZABALA VEGA','COM.','','',0,0,1),(48,13,17,'1717836223','CHIRSTIAM DANILO','PERALTA TAYUPANTA','COM.','','',0,0,1),(49,13,17,'0503227266','JONHATAN XAVIER','IZA ANCHAPAXI','COM.','','',0,0,1),(50,13,17,'0401580766','FAUSTO ANTONIO','QUISHPI PEREZ','COM.','','',0,0,1),(51,13,17,'0604094607','BOLIVAR FERNANDO','CEPEDA VALLE','COM.','','',0,0,1),(52,13,17,'1723716088','LUIS ','SANCHEZVARGAS JOSE','COM.','','',0,0,1),(53,13,17,'1722575410','JORGE ANDRES','VELA ORTIZ','COM.','','',0,0,1),(54,13,17,'1717099053','ALEJANDRO ANTONIO','BARRIGA AREQUIPA','COM','','',0,0,1),(55,13,18,'0604631465','BYRON GEOVANY','CAGUANA SHIQUIGUA','COM.','','',0,0,1),(56,13,18,'0202132544','ANGEL JESUS','GAVILANES ESPIN','COM.','','',0,0,1),(57,13,18,'0503375701','JUAN CARLOS','JAMI LEMA','COM.','','',0,0,1),(58,13,18,'0503514341','ALEX FABIAN','CHIMBA TOAQUIZA','COM.','','',0,0,1),(59,13,18,'1105197634','JAIME VINICIO','AGILA MASA','COM.','','',0,0,1),(60,13,18,'0604624585','WALTER GEOVANNY','GUSQUI LLAMUCA','COM.','','',0,0,1),(61,13,18,'0503647174','WILSON PATRICIO','HERRERA TOAPANTA','COM.','','',0,0,1),(62,13,18,'0503618696','MIGUEL ANGEL','O','COM.','','',0,0,1),(63,13,18,'0604132381','DIEGO FERNANDO','CAJAMARCA TENE','COM.','','',0,0,1),(64,13,18,'0602759888','ALEXANDER ','CHIGUANO ONTANEDA','ELEC.','','',0,0,1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_novedad`
--

DROP TABLE IF EXISTS `tipo_novedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_novedad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_novedad`
--

LOCK TABLES `tipo_novedad` WRITE;
/*!40000 ALTER TABLE `tipo_novedad` DISABLE KEYS */;
INSERT INTO `tipo_novedad` VALUES (1,'Permiso','Cuando una Persona pide permiso',1),(2,'Dieta Blanda','Cuando alguien esta con Dieta Blanda',1),(3,'Franco','Cuando alguien sale Franco',1);
/*!40000 ALTER TABLE `tipo_novedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_persona`
--

DROP TABLE IF EXISTS `tipo_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_persona`
--

LOCK TABLES `tipo_persona` WRITE;
/*!40000 ALTER TABLE `tipo_persona` DISABLE KEYS */;
INSERT INTO `tipo_persona` VALUES (1,'Oficial','Oficial 1',1),(2,'Voluntario','Voluntario 5',1);
/*!40000 ALTER TABLE `tipo_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador','Admnsitra el sistema',1),(2,'Amanuence','Admnsitra Unidad',1),(3,'Supervisor','Supervisa el proceso',1),(4,'Ranchero','Verifica el consumo',1);
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unidad`
--

DROP TABLE IF EXISTS `unidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(128) NOT NULL,
  `descripcion` varchar(256) NOT NULL,
  `abreviatura` varchar(64) NOT NULL,
  `num_conscriptos` int(11) DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unidad`
--

LOCK TABLES `unidad` WRITE;
/*!40000 ALTER TABLE `unidad` DISABLE KEYS */;
INSERT INTO `unidad` VALUES (1,'CEM-11','CEM-11','CEM-11',0,1,'12:00:00','14:00:00'),(2,'GCB-30','GCB-30','GCB-30',0,1,'12:00:00','14:00:00'),(3,'GCB-31','GCB-31','GCB-31',0,1,'12:00:00','14:00:00'),(4,'ECABLIN','ECABLIN','ECABLIN',0,1,'12:00:00','14:00:00'),(5,'GCB-32','GCB-32','GCB-32',0,1,'12:00:00','14:00:00'),(6,'UNIDAD TIPO','UNIDAD TIPO','UNIDAD TIPO',0,1,'12:00:00','14:00:00'),(7,'GCB-33','GCB-33','GCB-33',0,1,'12:00:00','14:00:00'),(8,'GCB-34','GCB-34','GCB-34',0,1,'12:00:00','14:00:00'),(9,'GAAP-11','GAAP-11','GAAP-11',0,1,'12:00:00','14:00:00'),(10,'GAAA 4/5','GAAA 4/5','GAAA 4/5',0,1,'12:00:00','14:00:00'),(11,'CAL-11','CAL-11','CAL-11',0,1,'12:00:00','14:00:00'),(12,'ERS-11','ERS-11','ERS-11',0,1,'12:00:00','14:00:00'),(13,'EC-11','EC-11','EC-11',0,1,'12:00:00','14:00:00'),(14,'EEB-11','EEB-11','EEB-11',0,1,'12:00:00','14:00:00'),(15,'EPM-11','EPM-11','EPM-11',0,1,'12:00:00','14:00:00'),(16,'CABALL','CABALL','CABALL',0,1,'12:00:00','14:00:00'),(17,'PBM-11','PBM-11','PBM-11',0,1,'12:00:00','14:00:00'),(18,'COMIL-6','COMIL-6','COMIL-6',0,1,'12:00:00','14:00:00'),(19,'EADYA-11','EADYA-11','EADYA-11',0,1,'12:00:00','14:00:00'),(20,'CEMAB.','CEMAB.','CEMAB.',0,1,'12:00:00','14:00:00'),(21,'CI-11','CI-11','CI-11',0,1,'12:00:00','14:00:00'),(22,'S.P.','S.P.','S.P.',0,1,'12:00:00','14:00:00');
/*!40000 ALTER TABLE `unidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `persona_id` int(11) NOT NULL,
  `tipo_usuario_id` int(11) NOT NULL,
  `usuario` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `unidad_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_usuario_tipo_usuario_idx` (`tipo_usuario_id`),
  KEY `fk_usuario_persona1_idx` (`persona_id`),
  CONSTRAINT `fk_usuario_persona1` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
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

-- Dump completed on 2016-09-23 16:57:08
