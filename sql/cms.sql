-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for osx10.15 (x86_64)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('Y','N','T') NOT NULL COMMENT 'Y : active, N : non active, T : trash',
  `type` enum('Gallery','Content','Page','Slider Banner','Section','Product') NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `trash_date` datetime DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime DEFAULT NULL,
  `user_id` smallint(6) NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `status` enum('Y','N','T') NOT NULL DEFAULT 'N' COMMENT 'Y : active, N : non active, T : trash',
  `picture` varchar(100) NOT NULL,
  `trash_date` datetime DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `seo_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `seo_id` (`seo_id`),
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `seo_id` FOREIGN KEY (`seo_id`) REFERENCES `seo` (`seo_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `path` varchar(500) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `category_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  PRIMARY KEY (`gallery_id`),
  KEY `category_id` (`category_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `category_idr` (`category_id`) USING BTREE,
  KEY `user_idr` (`user_id`) USING BTREE,
  CONSTRAINT `category_idr` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_idr` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `images_list`
--

DROP TABLE IF EXISTS `images_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images_list` (
  `id_images` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `user_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id_images`),
  KEY `user_id_img` (`user_id`),
  CONSTRAINT `user_id_img` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `mailbox`
--

DROP TABLE IF EXISTS `mailbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mailbox` (
  `mailbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `send_date` datetime NOT NULL DEFAULT current_timestamp(),
  `read_date` datetime DEFAULT NULL,
  `is_read` enum('Y','N') NOT NULL DEFAULT 'N',
  `message` text NOT NULL,
  `status` enum('A','T') NOT NULL DEFAULT 'A' COMMENT 'A : active, T : trash',
  `status_update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`mailbox_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `user_id` smallint(6) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`menu_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'default','2019-01-27 21:56:37',NULL,1,'Y');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_detail`
--

DROP TABLE IF EXISTS `menu_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_detail` (
  `menu_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` smallint(6) NOT NULL,
  `name` varchar(150) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `drop_down` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1 = drop down ,0 = no',
  `content_id` int(11) NOT NULL DEFAULT 0,
  `custom_link` varchar(255) DEFAULT NULL,
  `order_id` tinyint(4) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `seo_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`menu_detail_id`),
  KEY `menu_id` (`menu_id`),
  KEY `seo_id2` (`seo_id`),
  CONSTRAINT `menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `seo_id2` FOREIGN KEY (`seo_id`) REFERENCES `seo` (`seo_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

DROP TABLE IF EXISTS `plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugins` (
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('video','slider','page','section') NOT NULL,
  `install_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `key` varchar(50) NOT NULL,
  `render_filename` varchar(50) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_theme` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`plugin_id`),
  UNIQUE KEY `key` (`key`),
  KEY `id_theme` (`id_theme`),
  CONSTRAINT `FK_plugins_themes` FOREIGN KEY (`id_theme`) REFERENCES `themes` (`id_theme`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugins`
--

LOCK TABLES `plugins` WRITE;
/*!40000 ALTER TABLE `plugins` DISABLE KEYS */;
INSERT INTO `plugins` VALUES (1,'page','2019-02-21 22:45:45',NULL,'Service Page',NULL,'service_page','service_page','Y',1),(2,'section','2019-04-08 22:39:16',NULL,'Area Coverage',NULL,'area_coverage','area_coverage','Y',1),(3,'section','2019-04-17 09:01:34',NULL,'Why Choose Us',NULL,'why_choose_us','why_choose_us','Y',1),(4,'page','2020-02-17 16:17:18',NULL,'Product Category Page',NULL,'product_category_page','product_category_page','Y',2),(5,'page','2020-02-20 06:13:32',NULL,'Where To Buy Page',NULL,'where_to_buy_page','template_multi_input2','Y',2),(6,'page','2020-02-20 14:27:01',NULL,'Our Story Page',NULL,'our_story_page','dbemotion_our_story_page','Y',2),(7,'video','2020-03-15 17:31:59',NULL,'Youtube Review',NULL,'youtube_review','youtube_review','Y',2),(8,'section','2020-03-29 15:34:23',NULL,'Homepage Section 1',NULL,'section_1','template_single_input3','Y',2),(9,'section','2020-03-29 16:04:30',NULL,'Homepage Section 2',NULL,'section_2','template_single_input2','Y',2),(10,'section','2020-03-29 16:10:38',NULL,'Homepage Section 3',NULL,'section_3','template_single_input4','Y',2),(11,'section','2020-03-29 17:35:00',NULL,'Homepage Section 4',NULL,'section_4','template_multi_input2','Y',2),(12,'section','2020-03-30 08:53:44',NULL,'Service Centre List',NULL,'service_centre','template_multi_input2_no_image','Y',2),(13,'page','2020-03-30 09:50:24',NULL,'Contact Page',NULL,'contact_page','template_single_input2_no_image','Y',2),(14,'page','2020-03-30 09:58:56',NULL,'Warranty Information Page',NULL,'warranty_information_page','template_single_input3_no_image','Y',2),(15,'section','2020-04-02 22:59:57',NULL,'Featured Category Product',NULL,'featured_category_product','featured_category_product','Y',2);
/*!40000 ALTER TABLE `plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugins_detail`
--

DROP TABLE IF EXISTS `plugins_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugins_detail` (
  `plugin_detail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `value_1` varchar(500) DEFAULT NULL,
  `value_2` text DEFAULT NULL,
  `value_3` mediumtext DEFAULT NULL,
  PRIMARY KEY (`plugin_detail_id`),
  KEY `FK_plugin_detail_plugin` (`plugin_id`),
  CONSTRAINT `FK_plugin_detail_plugin` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`plugin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `unique_id` char(15) NOT NULL,
  `subtitle` varchar(200) DEFAULT NULL,
  `description_1` text DEFAULT NULL,
  `description_2` text DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `price` varchar(70) NOT NULL,
  `prefix_currency` char(8) NOT NULL,
  `specification` mediumtext DEFAULT NULL,
  `features` text DEFAULT NULL,
  `features_color` varchar(10) NOT NULL DEFAULT '#fff',
  `feature_note` varchar(500) DEFAULT NULL,
  `img_path` text DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `render_template_filename` varchar(100) NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `author` smallint(6) NOT NULL,
  `last_updated_by` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `products_UN` (`unique_id`),
  KEY `products_FK` (`category_id`),
  KEY `products_FK_1` (`author`),
  KEY `products_FK_2` (`last_updated_by`),
  CONSTRAINT `products_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  CONSTRAINT `products_FK_1` FOREIGN KEY (`author`) REFERENCES `users` (`user_id`),
  CONSTRAINT `products_FK_2` FOREIGN KEY (`last_updated_by`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `review_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `is_show` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seo` (
  `seo_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(250) NOT NULL,
  `meta_description` varchar(320) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`seo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themes` (
  `id_theme` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `index` varchar(15) NOT NULL,
  `install_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y : Active, N : Not Active',
  `type` char(10) NOT NULL,
  PRIMARY KEY (`id_theme`),
  UNIQUE KEY `theme` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'ElectronicServices',NULL,'','2019-01-12 07:16:11',NULL,'N',''),(2,'DbeMotion',NULL,'','2020-02-13 22:34:10',NULL,'Y','');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes_setting`
--

DROP TABLE IF EXISTS `themes_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themes_setting` (
  `id_theme` tinyint(4) NOT NULL,
  `key` varchar(100) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `group` enum('footer','template','social_media','section','company','contact','image','heading','plugin') DEFAULT NULL,
  `value_1` text DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `type` enum('embed','text','image') NOT NULL DEFAULT 'text',
  `category` enum('Slider Banner','Page','Section','Plugin','MultiSelect') DEFAULT NULL,
  PRIMARY KEY (`id_theme`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes_setting`
--

LOCK TABLES `themes_setting` WRITE;
/*!40000 ALTER TABLE `themes_setting` DISABLE KEYS */;
INSERT INTO `themes_setting` VALUES (1,'area_coverage','Area Coverage Plugin','plugin','','Y','embed','Plugin'),(1,'area_coverage_title','Area Coverage Title','plugin','','Y','text',NULL),(1,'company_title','Company Title','company','','Y','text',NULL),(1,'contact_email','Contact Email','contact','','Y','text',NULL),(1,'contact_phone','Contact Phone','contact','','Y','text',NULL),(1,'contact_whatsapp','Contact Whatsapp','contact','','Y','text',NULL),(1,'footer_address','Footer Address','footer','','Y','text',NULL),(1,'footer_address_title','Footer Address Title','heading','','Y','text',NULL),(1,'footer_copyright','Footer CopyRight','footer','','Y','text',NULL),(1,'footer_title_blog','Footer Artikel Title','heading','','Y','text',NULL),(1,'footer_title_contact','Footer Contact Title','heading','','Y','text',NULL),(1,'image_logo','Image Logo','image','','Y','image',NULL),(1,'menu_header','Menu Header',NULL,'1','Y','embed','Page'),(1,'path_url_admin','Path Url Admin',NULL,'','Y','text',NULL),(1,'section_1','Section Welcome Homepage','section','','Y','embed','Section'),(1,'section_1_title','Title Welcome Homepage','heading','','Y','text',NULL),(1,'service_page','Service Page Plugin','plugin','','Y','embed','Plugin'),(1,'service_page_title','Service Page Title','plugin','','Y','text',NULL),(1,'top_image_carousel','Homepage Image Banner','image','','Y','embed','Slider Banner'),(1,'why_choose_us','Why Choose Us Plugin','plugin','','Y','embed','Plugin'),(1,'why_choose_us_title','Why Choose Us Title','plugin','','Y','text',NULL),(2,'captcha_secret_key','Captcha Secret Key',NULL,'6LcrnOEUAAAAANmHnOZ9ghsa_b0844FzRd1pDKac','Y','text',NULL),(2,'captcha_site_key','Captcha Site Key',NULL,'6LcrnOEUAAAAAMqhYt3AY5lXkkNDEWcGfyM8DvP9','Y','text',NULL),(2,'company_title','Company Title','company','DbE Acoustics','Y','text',NULL),(2,'contact_page','Contact Page','plugin','13','Y','embed','Plugin'),(2,'email','Email','contact','info@dbe-id.com','Y','text',NULL),(2,'facebook','Facebook Link','social_media','https://www.facebook.com/DbE-Indonesia-111625933761626/','Y','text',NULL),(2,'featured_category_product','Featured Category Product','plugin','15','Y','embed','Plugin'),(2,'featured_top_image_carousel','Featured Homepage Top Image Carousel',NULL,'2','Y','embed','Slider Banner'),(2,'filename_product_template','Filename Product Template List','template','[\"template_1\",\"template_2\",\"template_3\"]','Y','text','MultiSelect'),(2,'filename_product_template_note','Filename Product Template Note','template','template_1(GM500), template_2(Dbe Comfit Eartips), template_3(dbe hardcase)','Y','text',NULL),(2,'images_upload_note','Images Upload Note',NULL,'Sort Image: SRP Image, Image Detail Product from Top to Down','Y','text',NULL),(2,'image_logo','Image Logo','image','http://localhost/cms-admin/img/Images/20200404/397dc070d9767a4763b013f678d6cb83.png','Y','image',NULL),(2,'instagram','Instagram Link','social_media','https://www.instagram.com/dbe.id/','Y','text',NULL),(2,'menu_footer','Menu Footer',NULL,'1','Y','embed','Page'),(2,'menu_header','Menu Header',NULL,'1','Y','embed','Page'),(2,'our_story_page','Our Story Page','plugin','6','Y','embed','Plugin'),(2,'phone_number','Phone Number','contact','+62 22 423 4642','Y','text',NULL),(2,'product_category_page','Product Category Page Plugin','plugin','4','Y','embed','Plugin'),(2,'section_1','Homepage Section 1','plugin','8','Y','embed','Plugin'),(2,'section_2','Homepage Section 2','plugin','9','Y','embed','Plugin'),(2,'section_3','Homepage Section 3','plugin','10','Y','embed','Plugin'),(2,'section_4','Homepage Section 4','plugin','11','Y','embed','Plugin'),(2,'service_centre','Service Centre List','plugin','12','Y','embed','Plugin'),(2,'shopee','Shopee Link','social_media','https://shopee.co.id/dbeofficial','Y','text',NULL),(2,'tokopedia','Tokopedia Link','social_media','https://www.tokopedia.com/dbeofficial','Y','text',NULL),(2,'top_image_carousel','Homepage Top Image Carousel',NULL,'1','Y','embed','Slider Banner'),(2,'warranty_information_page','Warranty Information Page','plugin','14','Y','embed','Plugin'),(2,'whatsapp_number','WhatsApp Number','contact','6281319991783','Y','text',NULL),(2,'where_to_buy_page','Where to Buy Page','plugin','5','Y','embed','Plugin'),(2,'youtube_review','Youtube Review Plugin','plugin','7','Y','embed','Plugin');
/*!40000 ALTER TABLE `themes_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(60) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` enum('Administrator','User') NOT NULL,
  `path_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`user_name`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Candra','Rahmawan','candra','1973287G2E4355795E7313B031B169GF7G39C851848E6708G033G7G95190GGCG4341CF8823BBF6GB9B194FBE31D0BE3354E40678E2BE60GFG9C7E6674ECEGF6E','candra.assasin@gmail.com','Y','2016-12-02 13:41:00','2019-04-17 09:14:02','Administrator','');
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

-- Dump completed on 2020-04-08 11:29:27
