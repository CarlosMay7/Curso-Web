-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: bienesraices_crud
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `propiedades`
--

DROP TABLE IF EXISTS `propiedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `propiedades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` varchar(45) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedores_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_propiedades_vendedores1_idx` (`vendedores_id`),
  CONSTRAINT `fk_propiedades_vendedores1` FOREIGN KEY (`vendedores_id`) REFERENCES `vendedores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propiedades`
--

LOCK TABLES `propiedades` WRITE;
/*!40000 ALTER TABLE `propiedades` DISABLE KEYS */;
INSERT INTO `propiedades` VALUES (7,'Extravagante casa en la playa',7894652.00,'642212961aa53d61be075f490a87a12e.jpg','Hermosa casa en la playa con acabados extravagantes Hermosa casa en la playa con acabados extravagantes Hermosa casa en la playa con acabados extravagantes',2,3,'1','2023-05-10',1),(34,'Una más',70000000.00,'38b44a2aeb5d2baf8d20d562a36879c6.jpg','Para llegar a 6 propiedades Para llegar a 6 propiedadesPara llegar a 6 propiedades',1,2,'3','2023-05-12',2),(39,' Nueva casa bonita',784651.00,'849b96f2f8d3f72846cd07526bbe9d8e.jpg','Mensaje de pruevaMensaje de pruevaMensaje de pruevaMensaje de pruevaMensaje de pruevaMensaje de pruevaMensaje de prueva',2,3,'4','2023-05-16',1),(40,' Otra casa',4657899.00,'6ee1dbff90804af833e7d74e53b7fcf7.jpg','Mensaje de pruevaMensaje de pruevaMensaje de pruevaMensaje de pruevaMensaje de pruevaMensaje de prueva',8,9,'2','2023-05-16',2),(47,' Nueva casa otra',647890.00,'69836f84fdefc6d639990497294b0e39.jpg','casacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasacasa',6,3,'1','2023-05-29',1),(55,' Casa nueva nueva OFERTA',67845.00,'05926c40d1038a82a985ecd28175f0c1.jpg','propiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedadpropiedad',5,5,'6','2023-05-30',1),(56,' Propiedad nueva',87451.00,'51e3d042bbffa624e2451d7acc045ea2.jpg','Prueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creadoPrueba creado',2,4,'5','2023-05-30',1);
/*!40000 ALTER TABLE `propiedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'correo@correo.com','$2y$10$smxhYWS5fRVso2t.x6FD9Omw966zbaTCCsH8ghazzvW/.R9P7uQ1S'),(3,'usuario@correo.com','$2y$10$HDxlv0dhTAaJILOBNxFHDeyo1i8IITzVoj1CaI1vmWqasteLFghri');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendedores`
--

LOCK TABLES `vendedores` WRITE;
/*!40000 ALTER TABLE `vendedores` DISABLE KEYS */;
INSERT INTO `vendedores` VALUES (1,'Carlos','May','9993240874'),(2,'Benito','Martínez','7884412154');
/*!40000 ALTER TABLE `vendedores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-30  1:18:19
