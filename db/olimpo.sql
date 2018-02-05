-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: Infox
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

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
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos` (
  `aluid` int(11) NOT NULL AUTO_INCREMENT,
  `aluNome` varchar(100) NOT NULL,
  `aluMatricula` varchar(100) NOT NULL,
  `aluNascimento` datetime NOT NULL,
  `aluTelefone1` varchar(20) NOT NULL,
  `aluTelefone2` varchar(20) NOT NULL,
  PRIMARY KEY (`aluid`)
) ENGINE=InnoDB AUTO_INCREMENT=677 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `alunos_carnes`
--

DROP TABLE IF EXISTS `alunos_carnes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alunos_carnes` (
  `carId` int(11) NOT NULL AUTO_INCREMENT,
  `carNum` int(11) NOT NULL,
  `carParcela` int(11) NOT NULL,
  `aluId` int(11) NOT NULL,
  `curId` int(11) NOT NULL,
  `carVencimento` datetime NOT NULL,
  `carValor` decimal(10,2) NOT NULL,
  `carValorVencido` decimal(10,2) DEFAULT '0.00',
  `carPago` tinyint(1) NOT NULL DEFAULT '0',
  `reId` int(11) DEFAULT '0',
  `carInativo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`carId`)
) ENGINE=InnoDB AUTO_INCREMENT=10048 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contas`
--

DROP TABLE IF EXISTS `contas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contas` (
  `conId` int(11) NOT NULL AUTO_INCREMENT,
  `conNome` varchar(200) NOT NULL,
  `conMostraResumo` tinyint(1) NOT NULL,
  PRIMARY KEY (`conId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `curId` int(11) NOT NULL AUTO_INCREMENT,
  `curNome` varchar(150) NOT NULL,
  `curCursos` longtext NOT NULL,
  `curConteudo` longtext NOT NULL,
  `curCargHora` double NOT NULL,
  PRIMARY KEY (`curId`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `empid` int(11) NOT NULL AUTO_INCREMENT,
  `empNome` varchar(100) NOT NULL,
  `empTelefone1` varchar(20) NOT NULL,
  `empTelefone2` varchar(20) NOT NULL,
  PRIMARY KEY (`empid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `empresas_carnes`
--

DROP TABLE IF EXISTS `empresas_carnes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas_carnes` (
  `ecId` int(11) NOT NULL AUTO_INCREMENT,
  `ecNum` int(11) NOT NULL,
  `ecParcela` int(11) NOT NULL,
  `empId` int(11) NOT NULL,
  `ecDescricao` varchar(255) NOT NULL,
  `ecVencimento` datetime NOT NULL,
  `ecValor` decimal(10,2) NOT NULL,
  `ecValorVencido` decimal(10,2) NOT NULL,
  `ecPago` tinyint(1) NOT NULL DEFAULT '0',
  `rsId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ecId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `instrutores`
--

DROP TABLE IF EXISTS `instrutores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instrutores` (
  `insId` int(11) NOT NULL AUTO_INCREMENT,
  `insNome` varchar(255) NOT NULL,
  `insAssinatura` varchar(255) NOT NULL,
  PRIMARY KEY (`insId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registrocategorias`
--

DROP TABLE IF EXISTS `registrocategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrocategorias` (
  `rcId` int(11) NOT NULL AUTO_INCREMENT,
  `rcNome` varchar(50) NOT NULL,
  `rcSaida` tinyint(1) NOT NULL DEFAULT '0',
  `rcDescontaCaixa` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`rcId`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registroentradas`
--

DROP TABLE IF EXISTS `registroentradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registroentradas` (
  `reId` int(11) NOT NULL AUTO_INCREMENT,
  `reDescricao` varchar(100) NOT NULL,
  `reValor` decimal(10,2) NOT NULL,
  `reData` datetime NOT NULL,
  `reCategoria` int(11) NOT NULL,
  `conId` int(11) NOT NULL,
  `turId` int(11) NOT NULL,
  PRIMARY KEY (`reId`)
) ENGINE=InnoDB AUTO_INCREMENT=7370 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registrosaidas`
--

DROP TABLE IF EXISTS `registrosaidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrosaidas` (
  `rsId` int(11) NOT NULL AUTO_INCREMENT,
  `rsDescricao` varchar(100) NOT NULL,
  `rsValor` decimal(10,2) NOT NULL,
  `rsData` datetime NOT NULL,
  `rsCategoria` int(11) NOT NULL,
  `conId` int(11) NOT NULL,
  `turId` int(11) NOT NULL,
  PRIMARY KEY (`rsId`)
) ENGINE=InnoDB AUTO_INCREMENT=1477 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `turnos`
--

DROP TABLE IF EXISTS `turnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turnos` (
  `turId` int(11) NOT NULL AUTO_INCREMENT,
  `turNome` varchar(50) NOT NULL,
  `turIni` time(6) NOT NULL,
  `turFim` time(6) NOT NULL,
  PRIMARY KEY (`turId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuId` int(11) NOT NULL AUTO_INCREMENT,
  `usuNome` varchar(255) NOT NULL,
  `usuSenha` varchar(100) NOT NULL,
  `conId` int(11) NOT NULL,
  `perId` int(11) NOT NULL,
  PRIMARY KEY (`usuId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-05 19:07:48
