-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2013 at 04:34 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ivplc`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `pk_author_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_pub_id` int(11) unsigned NOT NULL,
  `first_name` char(1) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_author_id`),
  KEY `fk_pub_id` (`fk_pub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`pk_author_id`, `fk_pub_id`, `first_name`, `last_name`) VALUES
(1, 1, 'M', 'Mohammadi'),
(2, 1, 'L', 'Lampe'),
(3, 1, 'M', 'Lok'),
(4, 1, 'S', 'Mirabbasi'),
(5, 1, 'M', 'Mirvakili'),
(6, 1, 'P', 'Van Veen'),
(7, 1, 'R', 'Rosales'),
(8, 2, 'M', 'Mirvakili'),
(9, 2, 'M', 'Mohammadi'),
(10, 2, 'R', 'Rosales'),
(11, 2, 'L', 'Lampe'),
(13, 2, 'M', 'Mirabbasi'),
(14, 3, 'M', 'Mohmmadi'),
(15, 3, 'L', 'Lampe'),
(16, 3, 'S', 'Mirabbasi'),
(17, 3, 'M', 'Mirvakili'),
(18, 4, 'S', 'Mirvakili'),
(19, 4, 'M', 'Mohammadi'),
(20, 4, 'R', 'Rosales'),
(21, 4, 'L', 'Lampe'),
(22, 4, 'S', 'Mirabbasi');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `pk_component_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_sub_id` int(11) unsigned NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  `file_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`pk_component_id`),
  KEY `fk_sub_id` (`fk_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=680 ;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`pk_component_id`, `fk_sub_id`, `name`, `url`, `file_name`) VALUES
(4, 4, 'Engine', '/uploads/noise_files/4_noise_0.xls', NULL),
(5, 4, 'Muffler', '/uploads/noise_files/4_noise_1.xls', NULL),
(6, 4, 'Brakes', '/uploads/noise_files/4_noise_2.xls', NULL),
(13, 11, 'Engine', NULL, NULL),
(14, 11, 'Brakes', NULL, NULL),
(21, 15, 'Gear', '', NULL),
(22, 15, 'Brakes', '', NULL),
(235, 184, 'brake', '/uploads/noise_files/184_noise_0.xls', '184_noise_0.xls'),
(236, 184, 'engine', '/uploads/noise_files/184_noise_1.xls', '184_noise_1.xls'),
(237, 184, 'abs', '/uploads/noise_files/184_noise_2.xls', '184_noise_2.xls'),
(238, 185, 'brake', '/uploads/noise_files/185_noise_0.xls', '185_noise_0.xls'),
(239, 185, 'gear', '', NULL),
(240, 185, 'window', '/uploads/noise_files/185_noise_2.xls', '185_noise_2.xls'),
(479, 278, 'a', '/uploads/noise_files/278_noise_0.xls', '278_noise_0.xls'),
(480, 278, 'b', '/uploads/noise_files/278_noise_1.xls', '278_noise_1.xls'),
(481, 278, 'c', '/uploads/noise_files/278_noise_2.xls', '278_noise_2.xls'),
(522, 298, '1', '', NULL),
(523, 298, '2', '', NULL),
(551, 308, '1', '/uploads/noise_files/308_noise_0.xls', '308_noise_0.xls'),
(552, 308, '2', '/uploads/noise_files/308_noise_1.xls', '308_noise_1.xls'),
(553, 308, '3', '/uploads/noise_files/308_noise_2.xls', '308_noise_2.xls'),
(666, 348, '1', '/uploads/noise_files/308_noise_0.xls', '308_noise_0.xls'),
(667, 348, '2', '/uploads/noise_files/308_noise_1.xls', '308_noise_1.xls'),
(668, 348, '3', '/uploads/noise_files/308_noise_2.xls', '308_noise_2.xls'),
(675, 351, '1', '', NULL),
(676, 351, '2', '', NULL),
(677, 351, '3', '', NULL),
(678, 352, 'Gear', '', NULL),
(679, 352, 'Brakes', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contributors`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `contributors`
--

INSERT INTO `contributors` (`pk_contributor_id`, `email`, `first_name`, `last_name`, `affiliation`, `city`, `country`, `verified`) VALUES
(1, 'abardal@me.com', 'Ashley', 'Bardal', 'UBC', 'Vancouver', 'Canada', ''),
(2, 'ebarer@mac.com', 'Elliot', 'Barer', 'BCIT', 'Vancouver', 'Canada', ''),
(3, 'ebarer@test.com', 'Elliot', 'Barer', 'BCIT', 'Vancouver', 'Canada', ''),
(4, 'roham.sameni@gmail.com', 'roham', 'sameni', 'ubc', 'vancouver', 'Canada', ''),
(5, 'roham.sameni@gmail.co', 'ro', 'sa', 'ub', 'va', 'ca', '\0'),
(6, 'ali.hamidi@gmail.com', 'Ali', 'Hamidi', 'sfu', 'vancouver', 'Canada', ''),
(7, 'reza.sameni@gmail.com', 'reza', 'sameni', 'ubc', 'london', 'uk', '\0');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `pk_group_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(50) NOT NULL DEFAULT '5f4dcc3b5aa765d61d8327deb882cf99',
  `bio` varchar(2000) DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  `supervisor` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`pk_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`pk_group_id`, `name`, `email`, `password`, `bio`, `url`, `supervisor`) VALUES
(1, 'Milad Mohammadi', 'milad@ieee.org', '5f4dcc3b5a', NULL, NULL, '\0'),
(2, 'Mario Lok', 'luo97650@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, '\0'),
(3, 'Mohammad Mirvakili', 'sm.mirvakili@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, '\0'),
(4, 'Paul Van Veen', 'p.vveen@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, NULL, '\0'),
(5, 'Dr. Lutz Lampe', 'lampe@ece.ubc.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Lutz Lampe is a Professor with the Department of Electrical and Computer Engineering at UBC. He received PhD degree in electrical engineering from the University of Erlangen, Germany, in 2002. His main research interests lie in the areas of communications and information theory applied to wireless and powerline transmission.Dr. Lampe has received a number of UBC and international awards for his scholarly contributions. He has been an Associate Editor for several international journals, General Chair of the International Power Line Communications and Ultra-Wideband Communications conferences, and he is the present Chair of the IEEE Communications Society Technical Committee on Power Line Communications. He is Co-Editor of the book Power Line Communications.', '/uploads/group/drlampe.jpg', ''),
(6, 'Dr. Shahriar Mirabbasi', 'shahriar@ece.ubc.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Shahriar Mirabbasi received the BSc in electrical engineering from Sharif University of Technology in 1990, and the MASc and PhD in electrical and computer engineering from the University of Toronto in 1997 and 2002, respectively. Since August 2002, he has been with the Department of Electrical and Computer Engineering, UBC where he is currently an Associate Professor.Dr. Mirabbasi and his teamÃ¢??s research interests include analog, mixed-signal, and RF integrated circuit and system design for wireless and wireline data communication, data converter, sensor interface, and biomedical applications.', '/uploads/group/shahriar.jpg', ''),
(7, 'Dr. Roberto Rosales', 'robertor@ece.ubc.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Roberto Rosales is an electrical engineer with 20 years of experience, specializing in the design and test of analog ICsCurrently he is the Test Lab Manager for the System-on-Chip group at UBC, responsible for managing the test lab facilities, providing technical support for the design and test of ICs as well as participating in research projects.', '/uploads/group/roberto.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `pk_image_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_sub_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`pk_image_id`),
  KEY `fk_sub_id` (`fk_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=306 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`pk_image_id`, `fk_sub_id`, `url`) VALUES
(3, 4, '/uploads/car_images/4_image_0.jpg'),
(4, 4, '/uploads/car_images/4_image_1.jpg'),
(11, 11, '/uploads/car_images/11_image_0.jpg'),
(15, 15, '/uploads/car_images/15_image_0.jpg'),
(170, 184, '/uploads/car_images/184_image_0.jpg'),
(171, 185, '/uploads/car_images/185_image_0.jpg'),
(262, 278, '/uploads/car_images/278_image_0.jpg'),
(277, 298, '/uploads/car_images/298_image_0.jpg'),
(278, 298, '/uploads/car_images/298_image_1.jpg'),
(279, 308, '/uploads/car_images/308_image_0.jpg'),
(301, 348, '/uploads/car_images/308_image_0.jpg'),
(304, 351, '/uploads/car_images/351_image_0.jpg'),
(305, 352, '/uploads/car_images/352_image_0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `pk_manufacturer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='List of all car manufacturers. Only the moderator has the ab' AUTO_INCREMENT=43 ;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`pk_manufacturer_id`, `name`) VALUES
(1, 'Acura'),
(2, 'Audi'),
(3, 'BMW'),
(4, 'Buick'),
(5, 'Cadilac'),
(6, 'Cheverolet'),
(7, 'Chrysler'),
(8, 'Dodge'),
(9, 'Eagle'),
(10, 'Ferrari'),
(11, 'Ford'),
(12, 'GM'),
(13, 'Honda'),
(14, 'Hummer'),
(15, 'Hyundai'),
(16, 'Infiniti'),
(17, 'Isuzu'),
(18, 'Jaguar'),
(19, 'Jeep'),
(20, 'Kia'),
(21, 'Lamborghini'),
(22, 'Lexus'),
(23, 'Lincoln'),
(24, 'Lotus'),
(25, 'Mazda'),
(26, 'Mercedes'),
(27, 'Mercury'),
(28, 'Mitsubishi'),
(29, 'Nissan'),
(30, 'Oldsmobile'),
(31, 'Peugeot'),
(32, 'Pontiac'),
(33, 'Porsche'),
(34, 'Regal'),
(35, 'Saab'),
(36, 'Saturn'),
(37, 'Subaru'),
(38, 'Saturn'),
(39, 'Tesla'),
(40, 'Toyota'),
(41, 'Volkswagen'),
(42, 'Volvo');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `pk_measurement_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_sub_id` int(11) unsigned NOT NULL,
  `fk_componentA_id` int(11) unsigned NOT NULL,
  `fk_componentB_id` int(11) unsigned NOT NULL,
  `url` varchar(400) DEFAULT NULL,
  `file_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`pk_measurement_id`),
  KEY `fk_compA_id` (`fk_componentA_id`),
  KEY `fk_compB_id` (`fk_componentB_id`),
  KEY `fk_sub_id` (`fk_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=200 ;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`pk_measurement_id`, `fk_sub_id`, `fk_componentA_id`, `fk_componentB_id`, `url`, `file_name`) VALUES
(1, 4, 4, 5, '/uploads/transfer_functions/4_transfer_4_5.xls', NULL),
(2, 4, 4, 6, '/uploads/transfer_functions/4_transfer_4_6.xls', NULL),
(3, 4, 5, 6, '/uploads/transfer_functions/4_transfer_5_6.xls', NULL),
(11, 11, 13, 14, '', NULL),
(15, 15, 21, 22, '/uploads/transfer_functions/3_transfer_13_14.xls', NULL),
(18, 184, 235, 236, '/uploads/transfer_functions/184_transfer_235_236.xls', '184_transfer_235_236.xls'),
(19, 184, 235, 237, '/uploads/transfer_functions/184_transfer_235_237.xls', '184_transfer_235_237.xls'),
(20, 184, 236, 237, '/uploads/transfer_functions/184_transfer_236_237.xls', '184_transfer_236_237.xls'),
(21, 185, 238, 239, '/uploads/transfer_functions/185_transfer_238_239.xls', '185_transfer_238_239.xls'),
(22, 185, 239, 240, '/uploads/transfer_functions/185_transfer_239_240.xls', '185_transfer_239_240.xls'),
(29, 278, 479, 480, '/uploads/transfer_functions/278_transfer_479_480.xls', '278_transfer_479_480.xls'),
(30, 278, 479, 481, '', NULL),
(31, 278, 480, 481, '/uploads/transfer_functions/278_transfer_480_481.xls', '278_transfer_480_481.xls'),
(54, 298, 522, 523, '', NULL),
(57, 308, 551, 552, '/uploads/transfer_functions/308_transfer_551_552.xls', '308_transfer_551_552.xls'),
(58, 308, 551, 553, '/uploads/transfer_functions/308_transfer_551_553.xls', '308_transfer_551_553.xls'),
(59, 308, 552, 553, '/uploads/transfer_functions/308_transfer_552_553.xls', '308_transfer_552_553.xls'),
(187, 348, 666, 667, '', NULL),
(188, 348, 666, 668, '', NULL),
(189, 348, 667, 668, '', NULL),
(196, 351, 675, 676, '', NULL),
(197, 351, 675, 677, '', NULL),
(198, 351, 676, 677, '', NULL),
(199, 352, 678, 679, '/uploads/transfer_functions/3_transfer_13_14.xls', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

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
  KEY `fk_contributor_id` (`fk_contributor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`pk_pub_id`, `fk_contributor_id`, `title`, `date`, `affiliation`, `url`, `submitted`, `view`, `agreement`) VALUES
(1, 1, 'Measurement Study and Transmission for In-Vehicle Power Line Communication', 2009, 'IEEE ISPLC 2009', 'http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/plc_paper.pdf', '2012-03-17', '', ''),
(2, 1, 'In-Vehicle Power Line Communication Poster', 2009, 'Auto 21 2009 Conference', '', '2012-03-17', '\0', ''),
(3, 1, 'Vehicle Power Line Communication System Poster', 2008, 'Auto 21 2008 Conference', 'http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/poster_auto21_2008.pdf', '2012-03-24', '', ''),
(4, 1, 'In-Vehicle Power-Line Communication Poster', 2009, 'Auto 21 2009 Conference', 'http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/poster_auto21_2009.pdf', '2012-03-24', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `pk_sub_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) unsigned NOT NULL,
  `revision` int(11) unsigned NOT NULL,
  `fk_contributor_id` int(11) unsigned NOT NULL,
  `fk_manufacturer_id` int(11) unsigned NOT NULL,
  `model` varchar(30) NOT NULL DEFAULT '',
  `year` year(4) NOT NULL,
  `submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `view` tinyint(1) NOT NULL DEFAULT '0',
  `agreement` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`pk_sub_id`),
  KEY `fk_contributor_id` (`fk_contributor_id`),
  KEY `fk_manufacturer_id` (`fk_manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=353 ;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`pk_sub_id`, `vehicle_id`, `revision`, `fk_contributor_id`, `fk_manufacturer_id`, `model`, `year`, `submitted`, `view`, `agreement`) VALUES
(4, 1, 0, 1, 21, 'Aventador', 2012, '2013-06-21 07:21:11', 1, ''),
(11, 2, 0, 3, 1, 'Solstice', 2006, '2013-06-21 07:21:26', 1, ''),
(15, 3, 0, 4, 32, 'Sunfire', 2001, '2013-07-17 23:41:40', 3, ''),
(184, 30, 0, 4, 33, '911', 1971, '2013-07-12 21:55:48', 1, ''),
(185, 31, 0, 4, 18, 'Fx', 1979, '2013-07-17 23:39:05', 1, ''),
(278, 33, 0, 4, 19, 'Thunder', 1979, '2013-07-17 23:39:03', 1, ''),
(298, 35, 0, 4, 1, '1', 1979, '2013-07-17 11:01:45', 0, ''),
(308, 36, 0, 4, 13, 'Civic', 2000, '2013-07-17 23:38:58', 1, ''),
(348, 36, 1, 4, 13, 'Civic', 2000, '2013-07-17 23:38:58', 3, ''),
(351, 36, 4, 4, 13, 'Civic', 2000, '2013-07-17 23:38:58', 3, ''),
(352, 3, 1, 4, 32, 'Sunfire', 2001, '2013-07-17 23:41:40', 1, '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
  ADD CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`fk_pub_id`) REFERENCES `publications` (`pk_pub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `components`
--
ALTER TABLE `components`
  ADD CONSTRAINT `components_ibfk_1` FOREIGN KEY (`fk_sub_id`) REFERENCES `vehicles` (`pk_sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`fk_sub_id`) REFERENCES `vehicles` (`pk_sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `measurements`
--
ALTER TABLE `measurements`
  ADD CONSTRAINT `measurements_ibfk_3` FOREIGN KEY (`fk_sub_id`) REFERENCES `vehicles` (`pk_sub_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `measurements_ibfk_5` FOREIGN KEY (`fk_componentA_id`) REFERENCES `components` (`pk_component_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `measurements_ibfk_6` FOREIGN KEY (`fk_componentB_id`) REFERENCES `components` (`pk_component_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`fk_contributor_id`) REFERENCES `contributors` (`pk_contributor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`fk_contributor_id`) REFERENCES `contributors` (`pk_contributor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`fk_manufacturer_id`) REFERENCES `manufacturers` (`pk_manufacturer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
