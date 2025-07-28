-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.41

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
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointment` (
  `AppointmentID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `DoctorOperationalTimeID` bigint unsigned NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `PatientID` varchar(255) NOT NULL,
  `patient_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `doctor_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `DoctorID` bigint unsigned NOT NULL,
  `PuskesmasID` bigint unsigned NOT NULL,
  PRIMARY KEY (`AppointmentID`),
  KEY `appointment_OperationalTimeID_IDX` (`DoctorOperationalTimeID`) USING BTREE,
  KEY `appointment_PatientID_IDX` (`PatientID`) USING BTREE,
  KEY `appointment_user_id_IDX` (`user_id`) USING BTREE,
  CONSTRAINT `appointment_doctoroperationaltime_FK_copy` FOREIGN KEY (`DoctorOperationalTimeID`) REFERENCES `doctoroperationaltime` (`DoctorOperationalTimeID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `appointment_patient_FK` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `appointment_users_FK_copy` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment`
--

LOCK TABLES `appointment` WRITE;
/*!40000 ALTER TABLE `appointment` DISABLE KEYS */;
INSERT INTO `appointment` VALUES (1,1,'2025-04-13','2',NULL,NULL,1,'Selesai','2025-03-09 03:35:41','2025-04-05 02:21:49',1,4),(2,1,'2025-04-13','2','Briza','Zayne',1,'Selesai','2025-03-09 03:44:46','2025-04-05 04:23:52',1,4),(3,1,'2025-04-13','2','Briza','Zayne',1,'Selesai','2025-04-05 00:59:19','2025-04-05 01:44:42',1,4),(4,1,'2025-04-14','2','Briza','Zayne',1,'Selesai','2025-04-12 22:07:53','2025-05-03 20:09:04',1,4),(6,1,'2025-04-21','2','Briza','Zayne',1,'Selesai','2025-04-13 01:31:14','2025-06-29 04:39:09',1,4),(7,1,'2025-04-28','3','Angel','Zayne',4,'Pending','2025-04-28 06:10:25','2025-04-28 06:10:25',1,4),(8,1,'2025-05-30','7','Lingga','Zayne',2,'Selesai','2025-05-29 05:07:29','2025-05-29 05:36:12',1,4),(9,1,'2025-06-03','2','Briza','Thioio',1,'Selesai','2025-06-03 01:01:42','2025-06-28 20:45:33',2,4),(10,1,'2025-06-04','2','Briza','Thioio',1,'Selesai','2025-06-03 01:02:36','2025-06-28 21:46:54',2,4),(11,1,'2025-06-09','2','Briza','Thioio',1,'Selesai','2025-06-03 01:02:54','2025-06-28 22:44:03',2,4),(12,1,'2025-06-05','2','Briza','Thioio',1,'Selesai','2025-06-03 01:04:01','2025-06-29 04:41:40',2,4),(13,1,'2025-06-06','2','Briza','Thioio',1,NULL,'2025-06-03 01:06:09','2025-06-03 01:06:09',2,4),(14,1,'2025-06-27','2','Briza','Thioio',1,NULL,'2025-06-03 01:08:06','2025-06-03 01:08:06',2,4),(15,1,'2025-06-07','2','Briza','Thioio',1,NULL,'2025-06-03 01:10:50','2025-06-03 01:10:50',2,4),(16,1,'2025-06-19','2','Briza','Thioio',1,NULL,'2025-06-03 01:11:38','2025-06-03 01:11:38',2,4),(17,1,'2025-06-28','8','Briza','Zayne',6,NULL,'2025-06-28 07:45:57','2025-06-28 07:45:57',1,4),(18,1,'2025-07-01','10','Xiao','Thioio',6,'Selesai','2025-07-01 09:13:22','2025-07-03 09:15:20',2,4),(19,2,'2025-07-12','11','Angel','Zayne',10,'Sedang Berlangsung','2025-07-11 21:12:44','2025-07-11 21:12:44',1,1),(20,2,'2025-07-12','11','Angel','Zayne',10,'Sedang Berlangsung','2025-07-11 21:51:53','2025-07-11 21:51:53',1,1),(21,1,'2025-04-13','11','Angel','Zayne',10,'Sedang Berlangsung','2025-07-12 12:33:11','2025-07-12 12:33:11',1,4),(22,2,'2025-07-12','12','test','Zayne',10,'Sedang Berlangsung','2025-07-12 12:44:09','2025-07-12 12:44:09',1,4);
/*!40000 ALTER TABLE `appointment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `ArticleID` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `counterview` int DEFAULT '0',
  PRIMARY KEY (`ArticleID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (3,'test','test','2025-05-23',NULL,'2025-05-23 01:18:04','2025-05-23 01:18:04','1747988284_article.png',0),(4,'Ciri-Ciri Stunting','testing','2025-05-29','ciri-ciri-stunting','2025-05-29 06:15:41','2025-07-12 07:42:32','1748524541_article.png',35),(5,'test','test','2025-07-12','test','2025-07-12 09:19:40','2025-07-12 09:19:40','1752337180_article.jpg',0),(6,'Apa Itu Stunting? Penyebab, Dampak, dan Cara Pencegahannya','<h3 data-start=\"191\" data-end=\"218\"><strong data-start=\"195\" data-end=\"218\">Pengertian Stunting</strong></h3>\r\n<p data-start=\"219\" data-end=\"543\">Stunting adalah kondisi gagal tumbuh pada anak balita akibat kekurangan gizi kronis, terutama dalam 1.000 hari pertama kehidupan (dari kehamilan hingga anak berusia dua tahun). Anak yang mengalami stunting memiliki tinggi badan lebih pendek dari standar usianya dan sering kali disertai perkembangan kognitif yang terganggu.<br><br></p><h3 data-start=\"1862\" data-end=\"1880\"><strong data-start=\"1866\" data-end=\"1880\">Kesimpulan</strong></h3><p data-start=\"219\" data-end=\"543\">\r\n</p><p data-start=\"1881\" data-end=\"2138\">Stunting bukan hanya masalah tinggi badan, tetapi menyangkut kualitas generasi masa depan. Oleh karena itu, intervensi sejak dini sangat penting, dimulai dari ibu hamil hingga anak usia dua tahun. Mari bersama cegah stunting demi masa depan yang lebih baik.</p>','2025-07-10','apa-itu-stunting-penyebab-dampak-dan-cara-pencegahannya','2025-07-12 09:21:55','2025-07-23 14:56:13','1752337315_article.jpg',3),(8,'test2','content','2025-05-23','test2','2025-07-21 04:59:07','2025-07-21 04:59:07','1753099147_article.jpg',0);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('0ade7c2cf97f75d009975f4d720d1fa6c19f4897','i:1;',1752220671),('0ade7c2cf97f75d009975f4d720d1fa6c19f4897:timer','i:1752220671;',1752220671),('902ba3cda1883801594b6e1b452790cc53948fda','i:2;',1752282519),('902ba3cda1883801594b6e1b452790cc53948fda:timer','i:1752282519;',1752282519),('angel@gmail.com|127.0.0.1','i:4;',1748937517),('angel@gmail.com|127.0.0.1:timer','i:1748937517;',1748937517),('b1d5781111d84f7b3fe45a0852e59758cd7a87e5','i:2;',1752282566),('b1d5781111d84f7b3fe45a0852e59758cd7a87e5:timer','i:1752282566;',1752282566),('dhycobriza@gmail.com|127.0.0.1','i:1;',1752048390),('dhycobriza@gmail.com|127.0.0.1:timer','i:1752048390;',1752048390),('luxyn@gmail.com|127.0.0.1','i:1;',1752027225),('luxyn@gmail.com|127.0.0.1:timer','i:1752027225;',1752027225),('puskesmacibatu@gmail.com|127.0.0.1','i:1;',1751578196),('puskesmacibatu@gmail.com|127.0.0.1:timer','i:1751578196;',1751578196);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `ChatID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat` text,
  `chatby` varchar(255) DEFAULT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ChatID` DESC)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (21,'test','user',10,'2025-07-11 23:59:16','2025-07-11 23:59:16'),(20,'halo','admin',10,'2025-07-11 23:57:20','2025-07-11 23:57:20'),(19,'test','admin',10,'2025-07-11 23:53:27','2025-07-11 23:53:27'),(18,'halo min','admin',10,'2025-07-11 23:21:40','2025-07-11 23:21:40'),(17,'test','admin',10,'2025-07-11 23:21:20','2025-07-11 23:21:20'),(16,'apa itu stunting','user',10,NULL,NULL),(15,'apa itu stunting','user',10,NULL,NULL),(14,'ciri-ciri stunting','user',10,NULL,NULL),(13,'apa itu stunting','user',10,NULL,NULL),(12,'apa itu stunting','user',10,NULL,NULL),(11,'apa itu stunting','user',10,NULL,NULL),(10,'ciri-ciri stunting','user',10,NULL,NULL),(9,'apa itu stunting','user',10,NULL,NULL),(8,'apa itu stunting','user',10,NULL,NULL),(7,'apa itu stunting','user',10,NULL,NULL),(6,'apa itu stunting','user',10,NULL,NULL),(5,'apa itu stunting','user',10,NULL,NULL),(4,'apa itu stunting','user',10,NULL,NULL),(3,'mpasi','user',4,NULL,NULL),(2,'briza','admin',4,'2025-07-03 14:15:59','2025-07-03 14:15:59'),(1,'siapa yang membuat website stuntaids','user',4,NULL,NULL);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chatbot`
--

DROP TABLE IF EXISTS `chatbot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chatbot` (
  `pertanyaan` text,
  `jawaban` text,
  `status` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chatbot`
--

LOCK TABLES `chatbot` WRITE;
/*!40000 ALTER TABLE `chatbot` DISABLE KEYS */;
INSERT INTO `chatbot` VALUES ('apa itu stunting','Stunting adalah situasi dimana bayi atau anak memiliki tinggi badan yang lebih pendek dari normal untuk usia dan jenis kelaminnya, sehingga memiliki potensi kurang baik untuk tumbuh menjadi orang dewasa seimbang. Stunting biasanya terjadi karena kurangnya gizi atau malnutrisi pada masa kanak-kanak.','terjawab'),('siapa presiden saat ini','Kebetulan saya bukanlah asisten ahli stunting, namun sebagai bantuan, saya akan menjawab pertanyaan lainnya. Tentang stunting, anak yang stunting cenderung memiliki berat badan rendah untuk usia mereka karena faktor gizi dan nutrisi tidak seimbang.\n\nNamun, tentang pertanyaan siapa presiden saat ini, saya tidak memiliki informasi terkini. Mohon Anda untuk memberikan update terbaru mengenai status yang relevan.','terjawab'),('siapa presiden saat ini','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('siapa presiden saat ini','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('siapa yang membuat website stuntaids','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('siapa yang membuat website stuntaids','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('siapa yang membuat website stuntaids','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('siapa yang membuat website stuntaids','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('mpasi','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('ciri-ciri stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('ciri-ciri stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('apa itu stunting','Maaf, saya tidak menemukan informasi yang relevan untuk pertanyaan tersebut.','belum terjawab'),('ciri-ciri stunting','Ciri-ciri stunting adalah:\n\n1. Berat badan yang sangat rendah, yaitu kurang dari 4 kg.\n2. Tinggi badan yang sangat pendek, yaitu kurang dari 50 cm.\n3. Sering mengalami malnutrisi dan dehidrasi.\n4. Mudah terkena penyakit, seperti diare dan pneumonia.\n5. Sering mengalami gangguan kesehatan fisik dan mental.\n\nDengan demikian, TPPS dapat membantu mencegah dan mengatasi stunting dengan lebih efektif.','terjawab'),('apa itu stunting','Stunting adalah kondisi kesehatan ibu yang mengalami proses persalinan sebelum usia kehamilan 37 minggu, sehingga bayi lahir dengan berat badan kurang dari 2.000 gram atau panjang tubuh kurang dari 47 cm. Stunting dapat menyebabkan berbagai masalah kesehatan dan kesulitan hidup bagi ibu dan anak.','terjawab'),('apa itu stunting','Stunting adalah istilah yang digunakan untuk menggambarkan kondisi gizi buruk pada balita ( anak usia 0-3 tahun) yang terjadi akibat kurangnya asupan gizi yang seimbang dan adekuat. Stunting diartikan sebagai gangguan pertumbuhan fisik dan kognitif yang menyebabkan anak tidak mencapai tinggi badan dan berat badan normal pada usia yang sesuai.','terjawab'),('6','🥣 **Puree Pisang Alpukat** (Usia 6 bulan)\n\n**Bahan:**\npisang matang, alpukat matang\n\n**Detail Bahan & Cara Membuat:**\nBahan-bahan:\\n-	½ buah pisang matang (jenis cavendish atau ambon)\\n-	¼–½ buah alpukat matang (kupas, buang bijinya)\\n-	1–2 sdm ASI/perasan susu formula/air matang hangat (opsional, untuk mengencerkan)\\nCara Membuat:\\n1.	Cuci tangan dan alat-alat dengan bersih.\\n2.	Haluskan pisang dan alpukat menggunakan sendok, saringan kawat, atau blender kecil.\\n3.	Tambahkan sedikit ASI/susu/air matang hangat jika tekstur terlalu kental.\\n4.	Aduk hingga konsistensi halus dan lembut.\\n5.	Sajikan segera. Jangan disimpan terlalu lama karena alpukat cepat berubah warna.','terjawab'),('apa itu stunting','Stunting adalah indikator kesehatan ibu yang mengalami gangguan perkembangan fisik dan kognitif pada anak usia 0-23 bulan, berupa kurangnya perkembangan fisik dan keterlambatan dalam mencapai milestone. Stunting dapat disebabkan oleh faktor-faktor seperti malnutrisi, kurang gizi, dan kurang akses ke pelayanan kesehatan yang layak.','terjawab'),('apa itu stunting','Stunting adalah kondisi gizi buruk pada anak, yang ditandai dengan kurangnya pertumbuhan tubuh dan berat badan, serta tingkat perkembangan fisik dan psikososial yang rendah. Stunting dapat terjadi pada anak-anak usia 0-5 tahun, dan biasanya disebabkan oleh kurangnya gizi dan nutrisi yang cukup dalam masa prenatal hingga postnatal.','terjawab'),('apa itu stunting','Stunting adalah fenomena kesehatan yang terjadi ketika bayi atau anak-anak berusia kurang dari 5 tahun mengalami pertumbuhan fisik yang lambat dan tidak sesuai dengan usianya. Stunting ditandai dengan tinggi badan yang lebih pendek daripada normal untuk usia, sehingga dapat berpotensi merugikan kesejahteraan anak dan masa depannya.','terjawab'),('apa itu stunting','Stunting adalah kondisi kesehatan ibu hamil yang terjadi saat bayi lahir dengan berat badan lahir (BBL) kurang dari 2.000 gram atau berada di bawah kesadaran dunia, sehingga bayi memiliki risiko terhadap komplikasi dan perkembangan fisik yang tidak normal.','terjawab'),('apa itu stunting','Stunting adalah gangguan pertumbuhan fisik dan kesehatan pada anak yang berusia kurang dari 5 tahun, ditandai dengan tinggi badan lebih rendah dari normal untuk usianya. Stunting dapat disebabkan oleh faktor-faktor seperti kurangnya asupan gizi, infeksi kronis, dan penanganan medis yang tidak tepat.','terjawab'),('apa itu stunting','Stunting adalah istilah yang digunakan untuk menunjukkan status gizi buruk pada anak-anak yang berusia 0-59 bulan. Stunting dapat didefinisikan sebagai tinggi badan anak yang kurang dari 80% dari nilai rata-rata tinggi badan anak pada umur yang sama, sehingga mengganggu pertumbuhan dan perkembangan anak secara optimal.','terjawab');
/*!40000 ALTER TABLE `chatbot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctor` (
  `DoctorID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`DoctorID`),
  KEY `doctor_user_id_IDX` (`user_id`) USING BTREE,
  CONSTRAINT `doctor_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (1,'Zayne','2025-03-02 07:52:08','2025-07-03 09:31:07',4,'1751560267_doctor.jpg',NULL),(2,'Thioio','2025-05-29 05:48:35','2025-05-29 05:49:02',4,NULL,NULL),(3,'Lishen','2025-07-03 09:24:50','2025-07-03 09:24:50',4,NULL,NULL),(4,'test','2025-07-12 05:44:11','2025-07-12 19:15:09',4,'1752324251_doctor.png','2025-07-12 19:15:09'),(5,'test','2025-07-12 05:44:12','2025-07-12 19:15:13',4,NULL,'2025-07-12 19:15:13'),(6,'test','2025-07-12 06:02:16','2025-07-12 19:15:16',4,'1752325336_doctor.png','2025-07-12 19:15:16');
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctoroperationaltime`
--

DROP TABLE IF EXISTS `doctoroperationaltime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctoroperationaltime` (
  `DoctorOperationalTimeID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `OperationalTimeID` bigint unsigned NOT NULL,
  `DoctorID` bigint unsigned NOT NULL,
  `quota` int DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`DoctorOperationalTimeID`),
  KEY `doctoroperationaltime_user_id_IDX` (`user_id`) USING BTREE,
  KEY `doctoroperationaltime_operationaltime_id_IDX` (`OperationalTimeID`) USING BTREE,
  KEY `doctoroperationaltime_DocterID_IDX` (`DoctorID`) USING BTREE,
  CONSTRAINT `doctoroperationaltime_doctor_FK` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`DoctorID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `doctoroperationaltime_operationaltime_FK` FOREIGN KEY (`OperationalTimeID`) REFERENCES `operationaltime` (`OperationalTimeID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `doctoroperationaltime_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctoroperationaltime`
--

LOCK TABLES `doctoroperationaltime` WRITE;
/*!40000 ALTER TABLE `doctoroperationaltime` DISABLE KEYS */;
INSERT INTO `doctoroperationaltime` VALUES (1,'2025-03-02 08:13:29','2025-07-12 19:15:27','2025-04-13',4,3,1,20,'2025-07-12 19:15:27'),(2,'2025-07-11 18:25:10','2025-07-11 18:25:10','2025-07-12',4,3,1,10,NULL);
/*!40000 ALTER TABLE `doctoroperationaltime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lokasipuskesmas`
--

DROP TABLE IF EXISTS `lokasipuskesmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lokasipuskesmas` (
  `LokasiPuskesmasID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `longitude` text,
  `latitude` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `PuskesmasID` bigint unsigned NOT NULL,
  PRIMARY KEY (`LokasiPuskesmasID`),
  KEY `lokasipuskesmas_user_id_IDX` (`PuskesmasID`) USING BTREE,
  CONSTRAINT `lokasipuskesmas_users_FK` FOREIGN KEY (`PuskesmasID`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lokasipuskesmas`
--

LOCK TABLES `lokasipuskesmas` WRITE;
/*!40000 ALTER TABLE `lokasipuskesmas` DISABLE KEYS */;
INSERT INTO `lokasipuskesmas` VALUES (1,'Puskesmas Cibatu','Cibatu','Bekasi','Cikarang','Simpangan','107.15982479290128','-6.324831104220995','2025-02-13 12:30:36','2025-05-29 13:13:00',4),(2,'Puskesmas Cikarangs','Pilar Cikarang','KABUPATEN BEKASI','CIKARANG UTARA','MEKARMUKTI','107.15630516777361','-6.256433759978831',NULL,'2025-07-13 05:22:52',5),(3,'Puskesmas Mekarmukti','cikarang','KABUPATEN SIMEULUE','TEUPAH TENGAH','LABUAH','123','123','2025-07-13 05:22:18','2025-07-13 05:22:18',9);
/*!40000 ALTER TABLE `lokasipuskesmas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operationaltime`
--

DROP TABLE IF EXISTS `operationaltime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `operationaltime` (
  `OperationalTimeID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`OperationalTimeID`),
  KEY `operationaltime_user_id_IDX` (`user_id`) USING BTREE,
  CONSTRAINT `operationaltime_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operationaltime`
--

LOCK TABLES `operationaltime` WRITE;
/*!40000 ALTER TABLE `operationaltime` DISABLE KEYS */;
INSERT INTO `operationaltime` VALUES (3,'Sesi 1 (09.00 - 12.00)','09:00:00','12:00:00','2025-03-02 08:00:47','2025-03-02 08:00:47',4,NULL),(4,'Sesi 2 (12.00-17.00)','12:00:00','17:00:00','2025-05-29 05:46:19','2025-05-29 05:47:11',4,NULL);
/*!40000 ALTER TABLE `operationaltime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('dhycobriza@gmail.com','$2y$12$SF5gxiFZ/z6uP1qkeUEVCuF3UPilIvk6FRIldf8V0V6aOkGgSj6Q2','2025-07-09 00:18:27'),('luxyn@gmail.com','$2y$12$K66zd6weH1jzoAWiDzz6gO7NntZ5.UVMXui5C/8fDEdS.xFSC1TNG','2025-07-08 21:10:03'),('luxynzhie@gmail.com','$2y$12$rtQQ/tFP5Kecr.xKVCoeIu/zQFiHAK/Yn.8H9dABDZ1pkGeqbhOfO','2025-07-13 04:37:58');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patient` (
  `PatientID` varchar(255) NOT NULL,
  `nik` bigint NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kabupaten` varchar(255) DEFAULT NULL,
  `kelurahan` varchar(255) DEFAULT NULL,
  `kecamatan` varchar(255) DEFAULT NULL,
  `rt` int DEFAULT NULL,
  `rw` int DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `RelationshipID` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`PatientID`),
  KEY `patient_user_id_IDX` (`user_id`) USING BTREE,
  KEY `patient_RelationshipID_IDX` (`RelationshipID`) USING BTREE,
  CONSTRAINT `patient_patientrelationship_FK` FOREIGN KEY (`RelationshipID`) REFERENCES `patientrelationship` (`RelationshipID`),
  CONSTRAINT `patient_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES ('1',123,'-',20,'Perempuan','-','-','-',1,1,'-',NULL,NULL,'2025-03-05 16:29:54','2025-03-05 16:29:54'),('10',3123781837817837,'Xiao',2,'Laki-Laki','KABUPATEN SIMEULUE','LABUHAN BAJAU','TEUPAH SELATAN',2,3,'-',6,1,'2025-07-01 09:08:27','2025-07-01 09:08:27'),('11',3211111111111122,'Angel',3,'Perempuan','KABUPATEN PONOROGO','GELANGKULON','SAMPUNG',10,12,'test2',10,1,'2025-07-11 18:10:06','2025-07-12 05:34:49'),('12',3213716361361636,'melanie',2,'Perempuan','KABUPATEN INDRAGIRI HILIR','PULAU KECIL','RETEH',4,2,NULL,10,1,'2025-07-12 05:36:57','2025-07-12 22:25:19'),('13',3213187318973917,'Rayno',2,'Laki-Laki','KABUPATEN MANDAILING NATAL','SIMPANG BAJOLE','LINGGA BAYU',1,2,'test',NULL,5,'2025-07-12 19:34:07','2025-07-12 19:43:34'),('14',3281317318381783,'cowo2',2,'Laki-Laki','KABUPATEN SIJUNJUNG','SIBAKUR','TANJUNG GADANG',3,4,'test2',NULL,5,'2025-07-12 19:47:22','2025-07-12 19:57:19'),('2',123,'Briza',20,'Perempuan','Cikarang','CIks','ciks',1,1,'test',1,1,'2025-03-05 17:02:01','2025-03-05 17:02:01'),('3',321,'Angel',2,'Perempuan','cik','cik','cik',1,1,'1',4,1,'2025-04-06 03:55:30','2025-04-06 07:06:02'),('7',3211111111111111,'Linggaguli',2,'Perempuan','Bekasi','Simpangan','Cikarang',1,12,'Graha Cikarang',2,1,'2025-05-29 05:03:02','2025-05-29 05:45:03'),('8',3211111111111111,'Briza',2,'Perempuan','KOTA JAKARTA TIMUR','KRAMAT JATI','KRAMAT JATI',2,3,'gracik',4,1,'2025-06-28 07:38:12','2025-06-28 07:38:12'),('9',3211111111111213,'Lishen',3,'Laki-Laki','-','-','-',1,2,'-',6,1,'2025-06-28 22:21:56','2025-06-28 22:21:56'),('STUNT-S-001',3123198738131838,'Suci',3,'Perempuan','KABUPATEN NIAS','SIOFA BANUA','BAWOLATO',2,3,'test',NULL,5,'2025-07-12 21:30:59','2025-07-12 21:30:59');
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patientrelationship`
--

DROP TABLE IF EXISTS `patientrelationship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `patientrelationship` (
  `RelationshipID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`RelationshipID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patientrelationship`
--

LOCK TABLES `patientrelationship` WRITE;
/*!40000 ALTER TABLE `patientrelationship` DISABLE KEYS */;
INSERT INTO `patientrelationship` VALUES (1,'orang tua','2025-02-17 00:15:54','2025-07-12 18:43:05','2025-07-12 18:43:05'),(5,'Orang Tua','2025-07-12 18:51:22','2025-07-12 18:51:22',NULL);
/*!40000 ALTER TABLE `patientrelationship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('8ZbpV5EaSnXuioflnI2izWU0Nh9DMtafKR8qyfhp',10,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaHJpYWIzNEVvSkk1Y3ZXeU0xc1ZnMjFRVkFEbEVIZ3hDR0g4U3ZhaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=',1753686533),('VRBmOSX8cGsFBmSWHj5YmEMzHGj1yXkxN3tQMxdJ',10,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:141.0) Gecko/20100101 Firefox/141.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWWRTalNqMnRoSFdkaExpcXJoUWtNYkVNajhMb0pWOFpWSDRMOHhBWCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=',1753674357);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stunting`
--

DROP TABLE IF EXISTS `stunting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stunting` (
  `StuntingID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `weight` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `age` int DEFAULT NULL,
  `measuretype` varchar(255) DEFAULT NULL,
  `weightage` varchar(255) DEFAULT NULL,
  `zscoreweightage` float DEFAULT NULL,
  `heightage` varchar(255) DEFAULT NULL,
  `zscoreheightage` float DEFAULT NULL,
  `weightheight` varchar(255) DEFAULT NULL,
  `zscoreweightheight` float DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `PatientID` varchar(255) DEFAULT NULL,
  `PuskesmasID` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`StuntingID`),
  KEY `stunting_patient_FK` (`PatientID`),
  CONSTRAINT `stunting_patient_FK` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stunting`
--

LOCK TABLES `stunting` WRITE;
/*!40000 ALTER TABLE `stunting` DISABLE KEYS */;
INSERT INTO `stunting` VALUES (45,7,78,9,'Telentang','Gizi Normal (Baik)',-1.9,'Tinggi',2.73,'Gizi Buruk',-3.56,'Stunting','2025-06-29 17:00:00','2025-06-28 23:50:17','Laki-Laki','9',4,NULL),(46,3,70,3,'Telentang','Gizi Buruk',-3.5,'Tinggi',4.86,'Gizi Buruk',-6.87,'Tidak Stunting','2025-07-29 17:00:00','2025-06-29 04:39:10','Perempuan','2',4,NULL),(47,3,70,3,'Telentang','Gizi Buruk',-3.5,'Tinggi',4.86,'Gizi Buruk',-6.87,'Tidak Stunting','2025-06-29 17:00:00','2025-06-29 04:41:40','Perempuan','2',4,NULL),(48,10,78,3,'Telentang','Gizi Lebih (Berat Badan Lebih)',4.5,'Tinggi',7.9,'Gizi Normal (Baik)',-0.22,'Stunting','2025-08-29 17:00:00','2025-07-19 22:18:03','Laki-Laki','9',4,NULL),(49,7,90,3,'Telentang','Gizi Normal (Baik)',0.75,'Tinggi',13.62,'Gizi Buruk',-5.27,'Selesai','2025-07-03 09:16:25','2025-07-12 19:24:45','Laki-Laki','10',4,'2025-07-12 19:24:45');
/*!40000 ALTER TABLE `stunting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthplace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Briza','briza@gmail.com','$2y$12$.g8870DS3H95JgLh5js8iukjIyP9v6pokO0nlPN96/ymQRShLOPfa','kuningan','2004-06-22','08123',1,'2025-02-10 23:06:23','2025-05-29 06:14:26','-6.263630','106.866776','Elda',NULL,NULL),(2,'Angeline Thiofelus Indra','angeline1068@gmail.com','$2y$12$.g8870DS3H95JgLh5js8iukjIyP9v6pokO0nlPN96/ymQRShLOPfa','Padang','2004-10-10','081993929618',2,'2025-02-17 06:15:34','2025-05-29 04:58:36','-6.196960','106.816013','Graha Cikarang',NULL,NULL),(3,'admin','admin@gmail.com','$2y$12$.g8870DS3H95JgLh5js8iukjIyP9v6pokO0nlPN96/ymQRShLOPfa','Jakarta','2004-11-30','012345678910',1,'2025-02-17 06:16:38','2025-02-17 06:16:38',NULL,NULL,NULL,NULL,NULL),(4,'Puskemas Cibatu','puskesmascibatu@gmail.com','$2y$12$VffHU7y5KKDd.HjROTKOcOd6i8hFq/NqxDJ6F9JvUt52/x1Afflwq','Cibatu','2004-02-20','012345678910',3,'2025-02-20 01:04:03','2025-02-20 01:04:03',NULL,NULL,NULL,NULL,NULL),(5,'Puskesmas Cikarang','puskesmascikarang@gmail.com','$2y$12$Kc7sYp1Tt5H2Nf22TKRth.qZp2/89IJQxXJNGn.t.EZuk.aPaCFMG','Cikarang','2004-02-20','012345678910',3,'2025-02-20 01:42:27','2025-02-20 01:42:27',NULL,NULL,NULL,NULL,NULL),(6,'luxyn','luxyn@gmail.com','$2y$12$b/GqkQpMJ2SYiLEv/kMBU.w5/7ln.Aar.6hHMSaSuQ9UwhbH5JHki','Kuningan','2004-06-22','08123456789',2,'2025-06-28 05:50:48','2025-07-01 08:55:33','-6.263875','106.867114',NULL,NULL,NULL),(7,'Briza DZ','dhycobriza@gmail.com','$2y$12$EeJkURPwPNB6gW0hygjI/exhBlLqsRc5Oi4QTpPg3V.cPCqckAbMC','Kuningan','2004-06-22','08123',2,'2025-07-08 21:13:26','2025-07-08 21:47:58',NULL,NULL,NULL,'eSN0n0gRH4lMxwTc5aCzg4Scu6ymO4wyR6b2J5Ky7k2ogKvNu9ZNe0dif0L7',NULL),(8,'babu','babucapstone@gmail.com','$2y$12$7PCDmSWLnClhav6SO/Ihne/KNzTdS4nRlI8BxZ/NqFpTKqQP7RD1.','Kuningan','2004-06-22','08123',1,'2025-07-08 21:28:44','2025-07-11 00:25:32',NULL,NULL,NULL,'Odcskqow9vPEe7KAmwyqsu7FDYZLrGIhaObS1jK29UhWjLwfsC3peNmI5Mdi',NULL),(9,'Suci','quinzharayn@gmail.com','$2y$12$AiyoKgwJ7DUeKEYJua458e16V.KymYG4QtNHALV86T41Khx5UY6r6','Kuningan','2004-06-22','08123',3,'2025-07-11 00:50:58','2025-07-12 22:04:10',NULL,NULL,NULL,NULL,'2025-07-11 00:54:27'),(10,'luxynzhie@gmail.com','luxynzhie@gmail.com','$2y$12$cZVPPTzD9oqa4d7ZdpVqU.0btBAWePigslpv3X0VsKfOm9EiF2O.u','Kuningan','2004-06-22','08123',2,'2025-07-11 01:01:59','2025-07-11 18:08:45',NULL,NULL,NULL,NULL,'2025-07-11 18:08:45');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-28 19:25:16
