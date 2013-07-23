-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2013 at 10:22 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`pk_author_id`, `fk_pub_id`, `first_name`, `last_name`) VALUES
(23, 5, 'N', 'Taherinejad'),
(24, 5, 'R', 'Rosales'),
(25, 5, 'L', 'Lampe'),
(26, 5, 'S', 'Mirabbasi'),
(27, 6, 'N', 'Taherinejad'),
(28, 6, 'R', 'Rosales'),
(29, 6, 'S', 'Mirabbasi'),
(30, 6, 'L', 'Lampe'),
(31, 7, 'X', 'Zhang'),
(32, 7, 'S', 'Mirabbasi'),
(33, 7, 'L', 'Lampe'),
(34, 8, 'N', 'Taherinejad'),
(35, 8, 'R', 'Rosales'),
(36, 8, 'S', 'Mirabbasi'),
(37, 8, 'L', 'Lampe'),
(38, 9, 'M', 'Mohammadi'),
(39, 9, 'L', 'Lampe'),
(40, 9, 'M', 'Lok'),
(41, 9, 'S', 'Mirabbasi'),
(42, 9, 'M', 'Mirvakili'),
(43, 9, 'R', 'Rosales'),
(44, 9, 'P', 'Van Veen'),
(45, 10, 'M', 'Mirvakili'),
(46, 10, 'M', 'Mohammadi'),
(47, 10, 'R', 'Rosales'),
(48, 10, 'L', 'Lampe'),
(49, 10, 'S', 'Mirabbasi'),
(50, 11, 'M', 'Mohammadi'),
(51, 11, 'L', 'Lampe'),
(52, 11, 'S', 'Mirabbasi'),
(53, 11, 'M', 'Mirvakili'),
(54, 12, 'P', 'Tanguy'),
(55, 12, 'F', 'Nouvel'),
(56, 13, 'F', 'Nouvel'),
(57, 13, 'P', 'Tanguy'),
(58, 13, 'S', 'Pillement'),
(59, 14, 'F', 'Nouvel'),
(60, 14, 'W', 'Gouret');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`pk_component_id`, `fk_sub_id`, `name`, `url`, `file_name`) VALUES
(1, 1, 'VCU', '', NULL),
(2, 1, 'ESS', '', NULL),
(3, 1, 'TMDMOC', '', NULL),
(4, 1, 'DC/DC', '', NULL),
(5, 1, 'Relay', '', NULL),
(6, 2, 'Cigar Lighter', '', NULL),
(7, 2, 'Mirror Control', '', NULL),
(8, 2, 'Front Left', '', NULL),
(9, 2, 'Front Right', '', NULL),
(10, 2, 'Rear Left', '', NULL),
(11, 2, 'Rear Right', '', NULL),
(12, 2, 'Air Conditioning', '', NULL),
(13, 2, 'BCM', '', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `contributors`
--

INSERT INTO `contributors` (`pk_contributor_id`, `email`, `first_name`, `last_name`, `affiliation`, `city`, `country`, `verified`) VALUES
(1, 'abardal@me.com', 'Ashley', 'Bardal', 'UBC', 'Vancouver', 'Canada', ''),
(2, 'ebarer@mac.com', 'Elliot', 'Barer', 'BCIT', 'Vancouver', 'Canada', ''),
(3, 'ebarer@test.com', 'Elliot', 'Barer', 'BCIT', 'Vancouver', 'Canada', ''),
(4, 'roham.sameni@gmail.com', 'roham', 'sameni', 'ubc', 'vancouver', 'Canada', ''),
(8, 'lampe@ece.ubc.ca', 'Lutz', 'Lampe', 'UBC', 'Vancouver', 'Canada', '');

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
  `supervisor` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`pk_group_id`, `name`, `email`, `password`, `bio`, `url`, `supervisor`) VALUES
(5, 'Dr. Lutz Lampe', 'lampe@ece.ubc.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Lutz Lampe is a Professor in the Department of Electrical and Computer Engineering at UBC. He received PhD degree in electrical engineering from the University of Erlangen, Germany, in 2002. His main research interests lie in the areas of communications and information theory applied to wireless and powerline transmission.Dr. Lampe has received a number of UBC and international awards for his scholarly contributions. He has been an Associate Editor for several international journals, General Chair of the International Power Line Communications and Ultra-Wideband Communications conferences, and he is the present Chair of the IEEE Communications Society Technical Committee on Power Line Communications. He is Co-Editor of the book "Power Line Communications" providing a comprehensive coverage of this field.', '/uploads/group/drlampe.jpg', 1),
(6, 'Dr. Shahriar Mirabbasi', 'shahriar@ece.ubc.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Shahriar Mirabbasi received the BSc in electrical engineering from Sharif University of Technology in 1990, and the MASc and PhD in electrical and computer engineering from the University of Toronto in 1997 and 2002, respectively. Since August 2002, he has been with the Department of Electrical and Computer Engineering, UBC where he is currently an Associate Professor. Dr. Mirabbasi and his team''s research interests include analog, mixed-signal, and RF integrated circuit and system design for wireless and wireline data communication, data converter, sensor interface, and biomedical applications.', '/uploads/group/shahriar.jpg', 1),
(7, 'Dr. Roberto Rosales', 'robertor@ece.ubc.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Roberto Rosales is an electrical engineer with 20 years of experience, specializing in the design and test of analog ICsCurrently he is the Test Lab Manager for the System-on-Chip group at UBC, responsible for managing the test lab facilities, providing technical support for the design and test of ICs as well as participating in research projects.', '/uploads/group/roberto.png', 1),
(8, 'Nima Taherinejad', 'nimat@ece.ubc.ca', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 0),
(9, 'Nazafarin Shabehpour', '', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 0),
(10, 'Xiaolang Zhang', '', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 0),
(11, 'Milad Mohammadi', 'milad@ieee.org', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 0),
(12, 'Mario Lok', 'luo97650@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '', '', 0),
(21, 'Mohammad Mirvakili', 'sm.mirvakili@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 0),
(22, 'Paul Van Veen', 'p.vveen@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`pk_image_id`, `fk_sub_id`, `url`) VALUES
(1, 1, '/uploads/car_images/1_image_0.jpg'),
(2, 2, '/uploads/car_images/2_image_0.jpg'),
(3, 2, '/uploads/car_images/2_image_1.jpg'),
(4, 2, '/uploads/car_images/2_image_2.jpg'),
(5, 2, '/uploads/car_images/2_image_3.jpg'),
(6, 2, '/uploads/car_images/2_image_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `manuals`
--

CREATE TABLE `manuals` (
  `pk_manual_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fk_sub_id` int(11) unsigned NOT NULL,
  `url` varchar(400) DEFAULT NULL,
  `file_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`pk_manual_id`),
  KEY `fk_sub_id` (`fk_sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `manuals`
--

INSERT INTO `manuals` (`pk_manual_id`, `fk_sub_id`, `url`, `file_name`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `pk_manufacturer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`pk_manufacturer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='List of all car manufacturers. Only the moderator has the ab' AUTO_INCREMENT=44 ;

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
(42, 'Volvo'),
(43, 'Azure Dynamics');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`pk_measurement_id`, `fk_sub_id`, `fk_componentA_id`, `fk_componentB_id`, `url`, `file_name`) VALUES
(1, 1, 1, 2, '/uploads/transfer_functions/1_transfer_1_2.xls', '1_transfer_1_2.xls'),
(2, 1, 1, 3, '/uploads/transfer_functions/1_transfer_1_3.xls', '1_transfer_1_3.xls'),
(3, 1, 1, 4, '/uploads/transfer_functions/1_transfer_1_4.xls', '1_transfer_1_4.xls'),
(4, 1, 1, 5, '/uploads/transfer_functions/1_transfer_1_5.xls', '1_transfer_1_5.xls'),
(5, 1, 2, 3, '/uploads/transfer_functions/1_transfer_2_3.xls', '1_transfer_2_3.xls'),
(6, 1, 2, 4, '/uploads/transfer_functions/1_transfer_2_4.xls', '1_transfer_2_4.xls'),
(7, 1, 2, 5, '/uploads/transfer_functions/1_transfer_2_5.xls', '1_transfer_2_5.xls'),
(8, 1, 3, 4, '/uploads/transfer_functions/1_transfer_3_4.xls', '1_transfer_3_4.xls'),
(9, 1, 3, 5, '/uploads/transfer_functions/1_transfer_3_5.xls', '1_transfer_3_5.xls'),
(10, 1, 4, 5, '/uploads/transfer_functions/1_transfer_4_5.xls', '1_transfer_4_5.xls'),
(11, 2, 6, 7, '/uploads/transfer_functions/2_transfer_6_7.xls', '2_transfer_6_7.xls'),
(12, 2, 6, 8, '/uploads/transfer_functions/2_transfer_6_8.xls', '2_transfer_6_8.xls'),
(13, 2, 6, 9, '', NULL),
(14, 2, 6, 10, '', NULL),
(15, 2, 6, 11, '', NULL),
(16, 2, 6, 12, '', NULL),
(17, 2, 6, 13, '/uploads/transfer_functions/2_transfer_6_13.xls', '2_transfer_6_13.xls'),
(18, 2, 7, 8, '', NULL),
(19, 2, 7, 9, '/uploads/transfer_functions/2_transfer_7_9.xls', '2_transfer_7_9.xls'),
(20, 2, 7, 10, '/uploads/transfer_functions/2_transfer_7_10.xls', '2_transfer_7_10.xls'),
(21, 2, 7, 11, '/uploads/transfer_functions/2_transfer_7_11.xls', '2_transfer_7_11.xls'),
(22, 2, 7, 12, '/uploads/transfer_functions/2_transfer_7_12.xls', '2_transfer_7_12.xls'),
(23, 2, 7, 13, '/uploads/transfer_functions/2_transfer_7_13.xls', '2_transfer_7_13.xls'),
(24, 2, 8, 9, '/uploads/transfer_functions/2_transfer_8_9.xls', '2_transfer_8_9.xls'),
(25, 2, 8, 10, '', NULL),
(26, 2, 8, 11, '', NULL),
(27, 2, 8, 12, '', NULL),
(28, 2, 8, 13, '', NULL),
(29, 2, 9, 10, '/uploads/transfer_functions/2_transfer_9_10.xls', '2_transfer_9_10.xls'),
(30, 2, 9, 11, '/uploads/transfer_functions/2_transfer_9_11.xls', '2_transfer_9_11.xls'),
(31, 2, 9, 12, '', NULL),
(32, 2, 9, 13, '/uploads/transfer_functions/2_transfer_9_13.xls', '2_transfer_9_13.xls'),
(33, 2, 10, 11, '/uploads/transfer_functions/2_transfer_10_11.xls', '2_transfer_10_11.xls'),
(34, 2, 10, 12, '', NULL),
(35, 2, 10, 13, '', NULL),
(36, 2, 11, 12, '/uploads/transfer_functions/2_transfer_11_12.xls', '2_transfer_11_12.xls'),
(37, 2, 11, 13, '/uploads/transfer_functions/2_transfer_11_13.xls', '2_transfer_11_13.xls');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`pk_pub_id`, `fk_contributor_id`, `title`, `date`, `affiliation`, `url`, `submitted`, `view`, `agreement`) VALUES
(5, 8, 'Channel Characterization For Power Line Communication In A Hybrid Electric Vehicle', 2012, 'IEEE ISPLC 2012', 'http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=06201336', '2013-07-23', '', ''),
(6, 8, 'On The Design Of Impedance Matching Circuits For Vehicular Power Line Communication Systems', 2012, 'IEEE ISPLC 2012', 'http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&arnumber=6201294', '2013-07-23', '', ''),
(7, 8, 'A Temperature-Stable 60-dB Programmable-Gain Amplifier In 0.13-um CMOS', 2011, 'IEEE ISCAS 2011', 'http://ieeexplore.ieee.org/stamp/stamp.jsp?tp=&arnumber=5937739', '2013-07-23', '', ''),
(8, 8, 'A Study On Access Impedance For Vehicular Power Line Communications', 2011, 'IEEE ISPLC 2011', 'http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=05764438', '2013-07-23', '', ''),
(9, 8, 'Measurement Study And Transmission For In-Vehicle Power Line Communication', 2009, 'IEEE ISPLC 2009', 'http://ieeexplore.ieee.org/stamp/stamp.jsp?arnumber=04913407', '2013-07-23', '', ''),
(10, 8, 'In-Vehicle Power Line Communication Poste', 2009, 'Auto 21 2009 Conference', 'http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/poster_auto21_2009.pdf', '2013-07-23', '', ''),
(11, 8, 'Vehicle Power Line Communication System Poster', 2008, 'Auto 21 2008 Conference', 'http://www.ece.ubc.ca/~lampe/VehiclePLC_folder/plc/poster_auto21_2008.pdf', '2013-07-23', '', ''),
(12, 8, 'Flexible OFDM Waveform For PLC/RF In-vehicle Communications', 2012, 'EUROMICRO Conference On Digital System Design, DSD 2012', 'http://ieeexplore.ieee.org/xpl/login.jsp?tp=&arnumber=6386928&url=http%3A%2F%2Fieeexplore.ieee.org%2Fxpls%2Fabs_all.jsp%3Farnumber%3D6386928', '2013-07-23', '', ''),
(13, 8, 'Experiments Of In-Vehicle Power Line Communications', 2011, 'INTECH', 'http://cdn.intechopen.com/pdfs/14996/InTech-Experiments_of_in_vehicle_power_line_communications.pdf', '2013-07-23', '', ''),
(14, 8, 'Automotive Network Architecture For ECUs Communications', 2009, 'IGI Global', 'http://www.igi-global.com/chapter/automotive-network-architecture-ecus-communications/5481#chapter-list', '2013-07-23', '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`pk_sub_id`, `vehicle_id`, `revision`, `fk_contributor_id`, `fk_manufacturer_id`, `model`, `year`, `submitted`, `view`, `agreement`) VALUES
(1, 1, 0, 8, 43, 'Balanced Hybrid Electric Vehic', 2011, '2013-07-23 20:07:24', 1, ''),
(2, 2, 0, 8, 32, 'Solstice', 2006, '2013-07-23 20:22:19', 1, '');

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
-- Constraints for table `manuals`
--
ALTER TABLE `manuals`
  ADD CONSTRAINT `manuals_ibfk_1` FOREIGN KEY (`fk_sub_id`) REFERENCES `vehicles` (`pk_sub_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
