# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.9)
# Database: ivplc
# Generation Time: 2012-04-01 10:50:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table authors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `pk_author_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_pub_id` int(11) unsigned NOT NULL,
  `first_name` char(1) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_author_id`),
  KEY `fk_pub_id` (`fk_pub_id`),
  CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`fk_pub_id`) REFERENCES `publications` (`pk_pub_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;

INSERT INTO `authors` (`pk_author_id`, `fk_pub_id`, `first_name`, `last_name`)
VALUES
	(1,1,'M','Mohammadi'),
	(2,1,'L','Lampe'),
	(3,1,'M','Lok'),
	(4,1,'S','Mirabbasi'),
	(5,1,'M','Mirvakili'),
	(6,1,'P','Van Veen'),
	(7,1,'R','Rosales'),
	(8,2,'M','Mirvakili'),
	(9,2,'M','Mohammadi'),
	(10,2,'R','Rosales'),
	(11,2,'L','Lampe'),
	(13,2,'M','Mirabbasi'),
	(14,3,'M','Mohmmadi'),
	(15,3,'L','Lampe'),
	(16,3,'S','Mirabbasi'),
	(17,3,'M','Mirvakili'),
	(18,4,'S','Mirvakili'),
	(19,4,'M','Mohammadi'),
	(20,4,'R','Rosales'),
	(21,4,'L','Lampe'),
	(22,4,'S','Mirabbasi');

/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table components
# ------------------------------------------------------------

DROP TABLE IF EXISTS `components`;

CREATE TABLE `components` (
  `pk_component_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_vehicle_id` int(11) unsigned NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`pk_component_id`),
  KEY `fk_vehicle_id` (`fk_vehicle_id`),
  CONSTRAINT `components_ibfk_1` FOREIGN KEY (`fk_vehicle_id`) REFERENCES `vehicles` (`pk_vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `components` WRITE;
/*!40000 ALTER TABLE `components` DISABLE KEYS */;

INSERT INTO `components` (`pk_component_id`, `fk_vehicle_id`, `name`, `url`)
VALUES
	(4,4,'Engine','/uploads/noise_files/4_noise_0.xls'),
	(5,4,'Muffler','/uploads/noise_files/4_noise_1.xls'),
	(6,4,'Brakes','/uploads/noise_files/4_noise_2.xls'),
	(13,11,'Engine',NULL),
	(14,11,'Brakes',NULL);

/*!40000 ALTER TABLE `components` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contributors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contributors`;

CREATE TABLE `contributors` (
  `pk_contributor_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `first_name` varchar(30) NOT NULL DEFAULT '',
  `last_name` varchar(30) NOT NULL DEFAULT '',
  `affiliation` varchar(100) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `verified` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`pk_contributor_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contributors` WRITE;
/*!40000 ALTER TABLE `contributors` DISABLE KEYS */;

INSERT INTO `contributors` (`pk_contributor_id`, `email`, `first_name`, `last_name`, `affiliation`, `city`, `country`, `verified`)
VALUES
	(1,'abardal@me.com','Ashley','Bardal','UBC','Vancouver','Canada',b'1'),
	(2,'ebarer@mac.com','Elliot','Barer','BCIT','Vancouver','Canada',b'1'),
	(3,'ebarer@test.com','Elliot','Barer','BCIT','Vancouver','Canada',b'1');

/*!40000 ALTER TABLE `contributors` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table group
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `pk_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(50) NOT NULL DEFAULT '5f4dcc3b5aa765d61d8327deb882cf99',
  `bio` varchar(2000) DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  `supervisor` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`pk_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;

INSERT INTO `group` (`pk_group_id`, `name`, `email`, `password`, `bio`, `url`, `supervisor`)
VALUES
	(1,'Milad Mohammadi','milad@ieee.org','5f4dcc3b5aa765d61d8327deb882cf99',NULL,NULL,b'0'),
	(2,'Mario Lok','luo97650@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99',NULL,NULL,b'0'),
	(3,'Mohammad Mirvakili','sm.mirvakili@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99',NULL,NULL,b'0'),
	(4,'Paul Van Veen','p.vveen@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99',NULL,NULL,b'0'),
	(5,'Dr. Lutz Lampe','lutz@ece.ubc.ca','5f4dcc3b5aa765d61d8327deb882cf99','Lutz Lampe is a Professor with the Department of Electrical and Computer Engineering at UBC. He received PhD degree in electrical engineering from the University of Erlangen, Germany, in 2002. His main research interests lie in the areas of communications and information theory applied to wireless and powerline transmission.Dr. Lampe has received a number of UBC and international awards for his scholarly contributions. He has been an Associate Editor for several international journals, General Chair of the International Power Line Communications and Ultra-Wideband Communications conferences, and he is the present Chair of the IEEE Communications Society Technical Committee on Power Line Communications. He is Co-Editor of the book Power Line Communications.','/uploads/group/drlampe.jpg',b'1'),
	(6,'Dr. Shahriar Mirabbasi','shahriar@ece.ubc.ca','5f4dcc3b5aa765d61d8327deb882cf99','Shahriar Mirabbasi received the BSc in electrical engineering from Sharif University of Technology in 1990, and the MASc and PhD in electrical and computer engineering from the University of Toronto in 1997 and 2002, respectively. Since August 2002, he has been with the Department of Electrical and Computer Engineering, UBC where he is currently an Associate Professor.Dr. Mirabbasi and his teamÃ¢??s research interests include analog, mixed-signal, and RF integrated circuit and system design for wireless and wireline data communication, data converter, sensor interface, and biomedical applications.','/uploads/group/shahriar.jpg',b'1'),
	(7,'Dr. Roberto Rosales','robertor@ece.ubc.ca','5f4dcc3b5aa765d61d8327deb882cf99','Roberto Rosales is an electrical engineer with 20 years of experience, specializing in the design and test of analog ICsCurrently he is the Test Lab Manager for the System-on-Chip group at UBC, responsible for managing the test lab facilities, providing technical support for the design and test of ICs as well as participating in research projects.','/uploads/group/roberto.png',b'1');

/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table images
# ------------------------------------------------------------

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `pk_image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_vehicle_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`pk_image_id`),
  KEY `fk_vehicle_id` (`fk_vehicle_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`fk_vehicle_id`) REFERENCES `vehicles` (`pk_vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;

INSERT INTO `images` (`pk_image_id`, `fk_vehicle_id`, `url`)
VALUES
	(3,4,'/uploads/car_images/4_image_0.jpg'),
	(4,4,'/uploads/car_images/4_image_1.jpg'),
	(11,11,'/uploads/car_images/11_image_0.jpg');

/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table manufacturers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `manufacturers`;

CREATE TABLE `manufacturers` (
  `pk_manufacturer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of all car manufacturers. Only the moderator has the ab';

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;

INSERT INTO `manufacturers` (`pk_manufacturer_id`, `name`)
VALUES
	(1,'Acura'),
	(2,'Audi'),
	(3,'BMW'),
	(4,'Buick'),
	(5,'Cadilac'),
	(6,'Cheverolet'),
	(7,'Chrysler'),
	(8,'Dodge'),
	(9,'Eagle'),
	(10,'Ferrari'),
	(11,'Ford'),
	(12,'GM'),
	(13,'Honda'),
	(14,'Hummer'),
	(15,'Hyundai'),
	(16,'Infiniti'),
	(17,'Isuzu'),
	(18,'Jaguar'),
	(19,'Jeep'),
	(20,'Kia'),
	(21,'Lamborghini'),
	(22,'Lexus'),
	(23,'Lincoln'),
	(24,'Lotus'),
	(25,'Mazda'),
	(26,'Mercedes'),
	(27,'Mercury'),
	(28,'Mitsubishi'),
	(29,'Nissan'),
	(30,'Oldsmobile'),
	(31,'Peugeot'),
	(32,'Pontiac'),
	(33,'Porsche'),
	(34,'Regal'),
	(35,'Saab'),
	(36,'Saturn'),
	(37,'Subaru'),
	(38,'Saturn'),
	(39,'Tesla'),
	(40,'Toyota'),
	(41,'Volkswagen'),
	(42,'Volvo');

/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table measurements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `measurements`;

CREATE TABLE `measurements` (
  `pk_measurement_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_vehicle_id` int(11) unsigned NOT NULL,
  `fk_componentA_id` int(11) unsigned NOT NULL,
  `fk_componentB_id` int(11) unsigned NOT NULL,
  `url` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`pk_measurement_id`),
  KEY `fk_compA_id` (`fk_componentA_id`),
  KEY `fk_compB_id` (`fk_componentB_id`),
  KEY `fk_vehicle_id` (`fk_vehicle_id`),
  CONSTRAINT `measurements_ibfk_4` FOREIGN KEY (`fk_vehicle_id`) REFERENCES `vehicles` (`pk_vehicle_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `measurements_ibfk_5` FOREIGN KEY (`fk_componentA_id`) REFERENCES `components` (`pk_component_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `measurements_ibfk_6` FOREIGN KEY (`fk_componentB_id`) REFERENCES `components` (`pk_component_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `measurements` WRITE;
/*!40000 ALTER TABLE `measurements` DISABLE KEYS */;

INSERT INTO `measurements` (`pk_measurement_id`, `fk_vehicle_id`, `fk_componentA_id`, `fk_componentB_id`, `url`)
VALUES
	(1,4,4,5,'/uploads/transfer_functions/4_transfer_4_5.xls'),
	(2,4,4,6,'/uploads/transfer_functions/4_transfer_4_6.xls'),
	(3,4,5,6,'/uploads/transfer_functions/4_transfer_5_6.xls'),
	(11,11,13,14,'');

/*!40000 ALTER TABLE `measurements` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table publications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `publications`;

CREATE TABLE `publications` (
  `pk_pub_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_contributor_id` int(11) unsigned NOT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `date` year(4) DEFAULT NULL,
  `affiliation` varchar(100) DEFAULT NULL,
  `url` varchar(400) NOT NULL DEFAULT '',
  `submitted` date NOT NULL,
  `view` bit(1) NOT NULL DEFAULT b'0',
  `agreement` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`pk_pub_id`),
  KEY `fk_contributor_id` (`fk_contributor_id`),
  CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`fk_contributor_id`) REFERENCES `contributors` (`pk_contributor_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `publications` WRITE;
/*!40000 ALTER TABLE `publications` DISABLE KEYS */;

INSERT INTO `publications` (`pk_pub_id`, `fk_contributor_id`, `title`, `date`, `affiliation`, `url`, `submitted`, `view`, `agreement`)
VALUES
	(1,1,'Measurement Study and Transmission for In-Vehicle Power Line Communication','2009','IEEE ISPLC 2009','http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/plc_paper.pdf','2012-03-17',b'1',b'1'),
	(2,1,'In-Vehicle Power Line Communication Poster','2009','Auto 21 2009 Conference','','2012-03-17',b'0',b'1'),
	(3,1,'Vehicle Power Line Communication System Poster','2008','Auto 21 2008 Conference','http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/poster_auto21_2008.pdf','2012-03-24',b'1',b'1'),
	(4,1,'In-Vehicle Power-Line Communication Poster','2009','Auto 21 2009 Conference','http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/poster_auto21_2009.pdf','2012-03-24',b'1',b'1');

/*!40000 ALTER TABLE `publications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vehicles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `pk_vehicle_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_contributor_id` int(11) unsigned NOT NULL,
  `fk_manufacturer_id` int(11) unsigned NOT NULL,
  `model` varchar(30) NOT NULL DEFAULT '',
  `year` year(4) NOT NULL,
  `submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `view` bit(1) NOT NULL DEFAULT b'0',
  `agreement` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`pk_vehicle_id`),
  KEY `fk_contributor_id` (`fk_contributor_id`),
  KEY `fk_manufacturer_id` (`fk_manufacturer_id`),
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`fk_contributor_id`) REFERENCES `contributors` (`pk_contributor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`fk_manufacturer_id`) REFERENCES `manufacturers` (`pk_manufacturer_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;

INSERT INTO `vehicles` (`pk_vehicle_id`, `fk_contributor_id`, `fk_manufacturer_id`, `model`, `year`, `submitted`, `view`, `agreement`)
VALUES
	(4,1,21,'Aventador','2012','2012-04-01 01:13:58',b'1',b'1'),
	(11,3,1,'Solstice','2006','2012-04-01 03:48:05',b'1',b'1');

/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
