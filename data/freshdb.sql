-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: 15_drozdowski
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb6u1

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
-- Table structure for table `historia_operacji`
--

DROP TABLE IF EXISTS `historia_operacji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historia_operacji` (
  `idOperacji` int(11) NOT NULL AUTO_INCREMENT,
  `data` datetime NOT NULL,
  `idUzytkownikaOd` int(11) NOT NULL,
  `idUzytkownikaDo` int(11) NOT NULL,
  `opis` text CHARACTER SET latin1 NOT NULL,
  `kwota` decimal(12,2) NOT NULL,
  PRIMARY KEY (`idOperacji`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia_operacji`
--

LOCK TABLES `historia_operacji` WRITE;
/*!40000 ALTER TABLE `historia_operacji` DISABLE KEYS */;
INSERT INTO `historia_operacji` VALUES (1,'2017-01-30 09:18:00',0,1,'WypÅ‚ata Å›rodkÃ³w z lokaty',2000.00),(2,'2017-01-30 09:19:01',1,2,'Od Jan Kowalski do Kazimierz Potoczek, OpÅ‚ata za usÅ‚ugÄ™',324.59),(3,'2017-01-30 15:15:25',1,2,'Od Jan Kowalski do Kzimierz Potoczek, Za usÅ‚ugi',2000.54),(4,'2017-01-30 15:16:46',0,1,'WypÅ‚ata Å›rodkÃ³w z lokaty',500000.00),(5,'2017-01-30 15:33:57',1,0,'WpÅ‚ata Å›rodkÃ³w na lokatÄ™',23423.00);
/*!40000 ALTER TABLE `historia_operacji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `konta`
--

DROP TABLE IF EXISTS `konta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `konta` (
  `idKonta` int(11) NOT NULL AUTO_INCREMENT,
  `idUzytkownika` int(11) NOT NULL,
  `nrRachunku` char(26) CHARACTER SET latin1 NOT NULL,
  `stanKonta` decimal(12,2) DEFAULT NULL,
  `lokata` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`idKonta`),
  UNIQUE KEY `nrRachunku` (`nrRachunku`),
  UNIQUE KEY `idUzytkownika_UNIQUE` (`idUzytkownika`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `konta`
--

LOCK TABLES `konta` WRITE;
/*!40000 ALTER TABLE `konta` DISABLE KEYS */;
INSERT INTO `konta` VALUES (1,1,'11111111111111111111111111',477755.10,2126702.64),(2,2,'21111111111111111111111111',3378.84,20992.00),(6,6,'17940438543358153009704076',1000.00,0.00),(7,7,'74425786854290858161461675',1000.00,0.00),(8,8,'69279766431892549908479924',975.41,48.00),(9,9,'69828290154754921920298846',1000.00,0.00);
/*!40000 ALTER TABLE `konta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uzytkownicy`
--

DROP TABLE IF EXISTS `uzytkownicy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uzytkownicy` (
  `idUzytkownika` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(48) CHARACTER SET latin1 NOT NULL,
  `nazwisko` varchar(48) CHARACTER SET latin1 NOT NULL,
  `dataUrodzenia` date NOT NULL,
  `pesel` char(11) CHARACTER SET latin1 NOT NULL,
  `nrTelefonu` char(9) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `miejscowosc` varchar(48) CHARACTER SET latin1 NOT NULL,
  `kodPocztowy` char(5) CHARACTER SET latin1 NOT NULL,
  `ulica` varchar(255) CHARACTER SET latin1 NOT NULL,
  `nrBudynku` varchar(5) CHARACTER SET latin1 NOT NULL,
  `nrLokalu` varchar(5) CHARACTER SET latin1 DEFAULT NULL,
  `login` char(6) CHARACTER SET latin1 NOT NULL,
  `haslo` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`idUzytkownika`),
  UNIQUE KEY `pesel` (`pesel`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uzytkownicy`
--

LOCK TABLES `uzytkownicy` WRITE;
/*!40000 ALTER TABLE `uzytkownicy` DISABLE KEYS */;
INSERT INTO `uzytkownicy` VALUES (1,'Jan','Kowalski','1990-05-16','90051609798','669056650','kowalski@gmail.pl','KrakÃ³w','33100','Korzenna','13','31','111111','a574e0592ac8af86b2e64e40953d462e'),(2,'Kazimierz','Potoczek','1991-12-01','12311231313','344353454','potoczek@gmail.com','KrakÃ³w','33500','Krakowska','31','21','140619','09a02ed9aa7bacad659553bb0d3e2174'),(6,'Dominik','Mazur','1975-07-06','75070698732','843743843','mazurek@gmail.com','GdaÅ„sk','43432','Mazurska','1','23','223518','a2c604eab6541e99348c9db16dd3718b'),(7,'Andrzej','Niewczas','1979-02-03','79020354353','435761902','andrzej@o2.pl','Katowice','32132','BiaÅ‚owiejska','12','3','514626','50cbe0d972f9b5977ce7bf2652bcf741'),(8,'MirosÅ‚aw','WÄ…Å¼','1987-04-28','87042856379','132155654','wazek@tlen.pl','WrocÅ‚aw','43525','Kodarska','2','3','437686','6d1942c5528f413114133e6bdf0d5e05'),(9,'robert','maklowicz','2993-02-02','95022213399','664664646','email@email.com','krakow','30724','plaszo','23','23','871964','d8578edf8458ce06fbc5bb76a58c5ca4');
/*!40000 ALTER TABLE `uzytkownicy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database '15_drozdowski'
--
/*!50003 DROP PROCEDURE IF EXISTS `SprawdzKwote` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `SprawdzKwote`(id int, kwota decimal(12,2))
BEGIN
	SELECT idKonta FROM konta WHERE idUzytkownika=id AND stanKonta >= kwota;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SprawdzRachunek` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `SprawdzRachunek`(numer char(26))
BEGIN
	SELECT idKonta FROM konta WHERE nrRachunku=numer;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `WplacLokata` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `WplacLokata`(id int, kwota decimal(12,2))
BEGIN
	UPDATE konta SET stanKonta=stanKonta-kwota WHERE idUzytkownika=id;
    UPDATE konta SET lokata=lokata+kwota WHERE idUzytkownika=id;
    INSERT INTO historia_operacji (data, idUzytkownikaOd, opis, kwota) VALUES (NOW(), id, 'Wpłata środków na lokatę', kwota);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `WykonajPrzelew` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `WykonajPrzelew`(id int, kwota decimal(12,2), rachunek char(26), opis text)
BEGIN
	UPDATE konta SET stanKonta=stanKonta-kwota WHERE idUzytkownika=id;
    UPDATE konta SET stanKonta=stanKonta+kwota WHERE nrRachunku=rachunek;
	INSERT INTO historia_operacji (data, idUzytkownikaOd, idUzytkownikaDo, opis, kwota) VALUES (NOW(), id, (SELECT idUzytkownika FROM konta WHERE nrRachunku=rachunek), opis, kwota);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `WyplacLokata` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `WyplacLokata`(id int, kwota decimal(12,2))
BEGIN
	UPDATE konta SET lokata=lokata-kwota WHERE idUzytkownika=id;
    UPDATE konta SET stanKonta=stanKonta+kwota WHERE idUzytkownika=id;
    INSERT INTO historia_operacji (data, idUzytkownikaDo, opis, kwota) VALUES (NOW(), id, 'Wypłata środków z lokaty', kwota);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `WyswietlHistorie` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `WyswietlHistorie`(id int)
BEGIN
	SELECT * FROM historia_operacji WHERE idUzytkownikaOd=id OR idUzytkownikaDo=id ORDER BY data DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `WyswietlKonto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `WyswietlKonto`(id int)
BEGIN
	SELECT * FROM konta WHERE idUzytkownika=id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Zaloguj` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `Zaloguj`(log char(6), pass varchar(255))
BEGIN
	SELECT * FROM uzytkownicy WHERE login=log AND haslo=pass;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `Zysk` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`15_drozdowski`@`localhost` PROCEDURE `Zysk`(id int)
BEGIN
	update konta set lokata = lokata*2 where idUzytkownika=id;
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

-- Dump completed on 2018-08-07  9:05:13
