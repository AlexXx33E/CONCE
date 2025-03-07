-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: concesionario
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alquileres`
--

DROP TABLE IF EXISTS `alquileres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alquileres` (
  `id_alquiler` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned DEFAULT NULL,
  `id_coche` int(10) unsigned DEFAULT NULL,
  `prestado` datetime DEFAULT NULL,
  `devuelto` datetime DEFAULT NULL,
  PRIMARY KEY (`id_alquiler`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_coche` (`id_coche`),
  CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `alquileres_ibfk_2` FOREIGN KEY (`id_coche`) REFERENCES `coches` (`id_coche`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alquileres`
--

LOCK TABLES `alquileres` WRITE;
/*!40000 ALTER TABLE `alquileres` DISABLE KEYS */;
INSERT INTO `alquileres` VALUES (34,10,38,'2025-03-07 09:21:41',NULL);
/*!40000 ALTER TABLE `alquileres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coches`
--

DROP TABLE IF EXISTS `coches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coches` (
  `id_coche` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `color` varchar(30) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `alquilado` tinyint(1) NOT NULL DEFAULT '0',
  `foto` varchar(100) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  PRIMARY KEY (`id_coche`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coches`
--

LOCK TABLES `coches` WRITE;
/*!40000 ALTER TABLE `coches` DISABLE KEYS */;
INSERT INTO `coches` VALUES (37,'Gran Torino','Ford','Rojo',45000.00,0,'img/gran_torino.jpeg',5),(38,'Sandero','Dacia','Negro',40000.00,1,'img/dacia_sandero.jpeg',2),(39,'Aventador','Lamborghini','Amarillo',350000.00,0,'img/aventador.jpg',6),(40,'Twingo','Renault','Naranja',35000.00,0,'img/twingo.jpg',4),(41,'Koennigsegg','Jesko','Negro',60000.00,0,'img/koennigsegg.jpg',7),(42,'Testarrossa','Ferrari','Granate',70000.00,0,'',9);
/*!40000 ALTER TABLE `coches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipo_usuario` enum('Comprador','Vendedor','Administrador') NOT NULL,
  `saldo` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (9,'adolfo','adolfogo@gmail.com','$2y$10$H7yJfAWkevibWMxxqsGwg.97rgneX5rvoDELFlReP1n5O7n5HG7jm','Vendedor',60000.00),(10,'paco','paco@gmail.com','$2y$10$JHBLUfXPhvItzoDot7ky2.WrWDWTby6fPwzHr.rco.4nBAXgJd9Oq','Comprador',60000.00),(11,'pepe','adolfogoo@gmail.com','$2y$10$.6164ZzTug1PqXEXg8LaduubxZMetenqj1H58qEvsJorKeCNKHcWS','Vendedor',300000.00),(12,'jose','jose@gmail.com','$2y$10$FIkFnpO9sAiq.VYWuM8ywefpGrPg2beUadabLJ/15Dhbax.rNa8Ny','Administrador',300000.00);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-07 11:46:57
