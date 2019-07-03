-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: estga-dev.clients.ua.pt    Database: ptaw-gr1-2017
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `id_alerta` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alerta_id` (`id_alerta`),
  CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_alerta`) REFERENCES `alertas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `af_andar`
--

DROP TABLE IF EXISTS `af_andar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `af_andar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `frequencia` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL,
  `duracao` int(10) NOT NULL,
  `condicao_saude` enum('Melhorou','Manteve','Agravou') NOT NULL,
  `data` date NOT NULL,
  `id_af` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_af` (`id_af`),
  CONSTRAINT `af_andar_ibfk_1` FOREIGN KEY (`id_af`) REFERENCES `atividade_fisica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `af_andar`
--

LOCK TABLES `af_andar` WRITE;
/*!40000 ALTER TABLE `af_andar` DISABLE KEYS */;
INSERT INTO `af_andar` VALUES (4,'4',30,'Melhorou','2017-06-11',6),(5,'10',33,'Manteve','2017-06-12',7),(6,'6',39,'Agravou','2017-06-13',8),(7,'7',12,'Manteve','2017-06-14',9),(8,'5',10,'Melhorou','2017-06-15',10),(9,'8',40,'Melhorou','2017-06-16',11),(10,'1',2,'Agravou','2017-06-17',12),(11,'8',30,'Melhorou','2017-06-18',13),(12,'1',1,'Manteve','2017-06-19',18),(14,'4',70,'Melhorou','2017-07-04',20),(15,'4',30,'Melhorou','2017-06-01',22),(16,'5',45,'Manteve','2017-06-02',23),(17,'3',25,'Melhorou','2017-06-03',24),(18,'3',10,'Melhorou','2017-06-06',28),(19,'8',42,'Agravou','2017-06-07',29),(20,'6',26,'Melhorou','2017-06-08',30),(21,'4',33,'Melhorou','2017-06-09',31),(22,'6',27,'Melhorou','2017-06-09',32),(23,'9',60,'Melhorou','2017-06-10',33);
/*!40000 ALTER TABLE `af_andar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `af_sentado`
--

DROP TABLE IF EXISTS `af_sentado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `af_sentado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duracao` int(10) NOT NULL,
  `condicao_saude` enum('Melhorou','Manteve','Agravou') NOT NULL,
  `data` date NOT NULL,
  `id_af` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_af` (`id_af`),
  CONSTRAINT `af_sentado_ibfk_1` FOREIGN KEY (`id_af`) REFERENCES `atividade_fisica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `af_sentado`
--

LOCK TABLES `af_sentado` WRITE;
/*!40000 ALTER TABLE `af_sentado` DISABLE KEYS */;
INSERT INTO `af_sentado` VALUES (1,11,'Agravou','2017-06-10',3),(2,3,'Melhorou','2017-06-11',5),(3,30,'Agravou','2017-06-12',14),(4,1,'Manteve','2017-06-13',15),(5,5,'Melhorou','2017-06-14',16),(6,50,'Melhorou','2017-06-15',17),(7,2,'Melhorou','2017-06-11',21),(8,20,'Manteve','2017-06-02',25),(9,15,'Agravou','2017-06-03',26),(10,35,'Melhorou','2017-06-04',27),(11,10,'Agravou','2017-06-12',35);
/*!40000 ALTER TABLE `af_sentado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alertas`
--

DROP TABLE IF EXISTS `alertas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alertas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` int(10) NOT NULL,
  `descrição` varchar(250) NOT NULL,
  `limite_minimo` int(10) DEFAULT NULL,
  `limite_maximo` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alertas`
--

LOCK TABLES `alertas` WRITE;
/*!40000 ALTER TABLE `alertas` DISABLE KEYS */;
/*!40000 ALTER TABLE `alertas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atividade_fisica`
--

DROP TABLE IF EXISTS `atividade_fisica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atividade_fisica` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_utente` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `utente_id` (`id_utente`),
  CONSTRAINT `atividade_fisica_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atividade_fisica`
--

LOCK TABLES `atividade_fisica` WRITE;
/*!40000 ALTER TABLE `atividade_fisica` DISABLE KEYS */;
INSERT INTO `atividade_fisica` VALUES (1,1),(2,1),(3,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(31,1),(32,1),(34,1),(35,1),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(33,2),(4,4);
/*!40000 ALTER TABLE `atividade_fisica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dados_biometricos`
--

DROP TABLE IF EXISTS `dados_biometricos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dados_biometricos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_utente` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_utente_2` (`id_utente`),
  KEY `id_utente` (`id_utente`),
  CONSTRAINT `dados_biometricos_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dados_biometricos`
--

LOCK TABLES `dados_biometricos` WRITE;
/*!40000 ALTER TABLE `dados_biometricos` DISABLE KEYS */;
INSERT INTO `dados_biometricos` VALUES (1,2),(31,3),(35,4);
/*!40000 ALTER TABLE `dados_biometricos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dor`
--

DROP TABLE IF EXISTS `dor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dor` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cabeca` int(2) NOT NULL DEFAULT '0',
  `pesoco` int(2) NOT NULL DEFAULT '0',
  `ombros` int(2) NOT NULL DEFAULT '0',
  `bracos` int(2) NOT NULL DEFAULT '0',
  `punhos_maos` int(2) NOT NULL DEFAULT '0',
  `coluna_toracica` int(2) NOT NULL DEFAULT '0',
  `lombar` int(2) NOT NULL DEFAULT '0',
  `anca` int(2) NOT NULL DEFAULT '0',
  `coxa` int(2) DEFAULT '0',
  `joelho` int(2) NOT NULL DEFAULT '0',
  `tornozelos_pes` int(2) NOT NULL DEFAULT '0',
  `id_historico_saude` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_historico_saude` (`id_historico_saude`),
  CONSTRAINT `dor_ibfk_1` FOREIGN KEY (`id_historico_saude`) REFERENCES `historico_saude` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dor`
--

LOCK TABLES `dor` WRITE;
/*!40000 ALTER TABLE `dor` DISABLE KEYS */;
INSERT INTO `dor` VALUES (1,0,0,0,0,0,0,0,0,0,0,0,1);
/*!40000 ALTER TABLE `dor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `educacao_formal`
--

DROP TABLE IF EXISTS `educacao_formal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `educacao_formal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(250) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `educacao_formal_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `educacao_formal`
--

LOCK TABLES `educacao_formal` WRITE;
/*!40000 ALTER TABLE `educacao_formal` DISABLE KEYS */;
/*!40000 ALTER TABLE `educacao_formal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `familiar`
--

DROP TABLE IF EXISTS `familiar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `familiar` (
  `id_familiar` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `id_utente_associado` int(11) NOT NULL,
  `grau_parentesco` varchar(250) NOT NULL,
  PRIMARY KEY (`id_familiar`),
  KEY `user_id` (`id_user`),
  KEY `id_utente_associado` (`id_utente_associado`),
  CONSTRAINT `familiar_ibfk_1` FOREIGN KEY (`id_utente_associado`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `familiar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `familiar`
--

LOCK TABLES `familiar` WRITE;
/*!40000 ALTER TABLE `familiar` DISABLE KEYS */;
INSERT INTO `familiar` VALUES (1,5,1,'nada');
/*!40000 ALTER TABLE `familiar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequencia_cardiaca`
--

DROP TABLE IF EXISTS `frequencia_cardiaca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequencia_cardiaca` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` varchar(250) NOT NULL,
  `frequencia_cardiaca` int(11) NOT NULL,
  `responsavel` varchar(250) NOT NULL,
  `id_dados_biometricos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dados_biometricos` (`id_dados_biometricos`),
  CONSTRAINT `frequencia_cardiaca_ibfk_1` FOREIGN KEY (`id_dados_biometricos`) REFERENCES `dados_biometricos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequencia_cardiaca`
--

LOCK TABLES `frequencia_cardiaca` WRITE;
/*!40000 ALTER TABLE `frequencia_cardiaca` DISABLE KEYS */;
INSERT INTO `frequencia_cardiaca` VALUES (1,'2017-06-14','4:45 PM',33,'retrtwe',31),(2,'2017-06-08','4:45 PM',33,'sefdsd',35),(3,'2017-06-15','5:00 PM',33,'wesdf',35),(4,'2017-06-23','1:00 PM',44,'xdfv',31);
/*!40000 ALTER TABLE `frequencia_cardiaca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historico_saude`
--

DROP TABLE IF EXISTS `historico_saude`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historico_saude` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_utente` int(10) NOT NULL,
  `data` date NOT NULL,
  `hipertensao_arterial` varchar(250) NOT NULL,
  `diabetes` varchar(250) NOT NULL,
  `artrose` varchar(250) NOT NULL,
  `espondiloartrose` varchar(250) NOT NULL,
  `patologia_vascular` varchar(250) NOT NULL,
  `patologia_respiratoria` varchar(250) NOT NULL,
  `cancro` varchar(250) NOT NULL,
  `depressao` varchar(250) NOT NULL,
  `trombose` varchar(250) NOT NULL,
  `outra` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `utente_id` (`id_utente`),
  CONSTRAINT `historico_saude_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utente` (`id_utente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historico_saude`
--

LOCK TABLES `historico_saude` WRITE;
/*!40000 ALTER TABLE `historico_saude` DISABLE KEYS */;
INSERT INTO `historico_saude` VALUES (1,1,'2017-06-12','13/8','','','','','','','','','');
/*!40000 ALTER TABLE `historico_saude` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `literacia_informatica`
--

DROP TABLE IF EXISTS `literacia_informatica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `literacia_informatica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telemovel` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `computador_ou_tablet` enum('0','1') NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `literacia_informatica_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `literacia_informatica`
--

LOCK TABLES `literacia_informatica` WRITE;
/*!40000 ALTER TABLE `literacia_informatica` DISABLE KEYS */;
/*!40000 ALTER TABLE `literacia_informatica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tensao_arterial`
--

DROP TABLE IF EXISTS `tensao_arterial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tensao_arterial` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `hora` varchar(250) NOT NULL,
  `tensao_arterial` int(11) NOT NULL,
  `responsavel` varchar(250) NOT NULL,
  `id_dados_biometricos` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_dados_biometricos` (`id_dados_biometricos`),
  CONSTRAINT `tensao_arterial_ibfk_1` FOREIGN KEY (`id_dados_biometricos`) REFERENCES `dados_biometricos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tensao_arterial`
--

LOCK TABLES `tensao_arterial` WRITE;
/*!40000 ALTER TABLE `tensao_arterial` DISABLE KEYS */;
INSERT INTO `tensao_arterial` VALUES (1,'2017-06-21','4:45 PM',33,'ers',31),(2,'2017-06-22','5:15 PM',44,'s',35);
/*!40000 ALTER TABLE `tensao_arterial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `data_nascimento` date NOT NULL,
  `gender` enum('Masculino','Feminino') NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `data_conta` date NOT NULL,
  `bloqueado` enum('0','1') NOT NULL DEFAULT '0',
  `tipo` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Daniel','1996-12-04','Masculino','dfilipeloja@ua.pt','65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5','2017-06-09','0','utente'),(2,'dante','2017-06-04','Feminino','dante@mail.com.pt','16814e8cd706b29de1ba77f011fd96f1b245ca6641b3af63b0f787af54284f90','2017-06-10','0','utente'),(3,'borys','2017-06-08','Masculino','borys@ua.pt','65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5','2017-06-10','0','utente'),(4,'utente','2017-06-10','Masculino','utente@ua.pt','65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5','2017-06-10','0','utente'),(5,'teste','1994-10-10','Masculino','teste@ua.pt','65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5','2017-06-11','0','familiar'),(6,'familiar','2017-06-08','Masculino','familiar@ua.pt','65e84be33532fb784c48129675f9eff3a682b27168c0ea744b2cf58ee02337c5','2017-06-11','0','familiar');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utente`
--

DROP TABLE IF EXISTS `utente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utente` (
  `id_utente` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  PRIMARY KEY (`id_utente`),
  KEY `user_id` (`id_user`),
  CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utente`
--

LOCK TABLES `utente` WRITE;
/*!40000 ALTER TABLE `utente` DISABLE KEYS */;
INSERT INTO `utente` VALUES (1,1),(2,2),(3,3),(4,4);
/*!40000 ALTER TABLE `utente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ptaw-gr1-2017'
--

--
-- Dumping routines for database 'ptaw-gr1-2017'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-12 16:33:34
