-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2015 at 08:21 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE`_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;



-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `serial_no` int(15) NOT NULL,
  `model` varchar(50) DEFAULT NULL,
  `auc_cab` tinyint(1) DEFAULT NULL,
  `bluetooth` tinyint(1) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `car_type` varchar(50) DEFAULT NULL,
  `hour_rate` float DEFAULT NULL,
  `daily_rate` float DEFAULT NULL,
  `capacity` int(2) DEFAULT NULL,
  `transmission` varchar(20) DEFAULT NULL,
  `loc_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`serial_no`),
  KEY `loc_name` (`loc_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`serial_no`, `model`, `auc_cab`, `bluetooth`, `color`, `car_type`, `hour_rate`, `daily_rate`, `capacity`, `transmission`, `loc_name`) VALUES
(78, 'hkh', 1, 1, 'jkh', 'Hybrid', 78, 787, 7, 'Automatic', 'Boys hostel'),
(122, 'Honda Civic', 1, 1, 'WHite', 'Hybrid', 8, 8, 8, 'Automatic', 'Electrical Dept.'),
(787, 'Swift', 1, 1, 'SHie', 'Working on CNG', 8, 8, 8, 'Automatic', 'SSC'),
(898, 'Honda Prius', 1, 1, 'Black', 'Hybrid', 8, 8, 8, 'Automatic', 'Electrical Dept.'),
(1111, 'Honda', 1, 1, 'Black', 'sedan', 200, 2000, 4, 'auto', 'VC office'),
(2222, 'Honda', 1, 0, 'white', 'SUV', 100, 1000, 6, 'manual', 'Main Block'),
(3333, 'Swift', 0, 1, 'green', 'sedan', 300, 3000, 5, 'auto', 'EE Dept'),
(4444, 'Audi', 0, 0, 'white', 'SUV', 40, 400, 6, 'manual', 'EE Dept'),
(8989, 'Honda 125', 1, 1, 'White', 'Hybrid', 8, 8, 8, 'Automatic', 'Electrical Dept.'),
(898989898, 'Hyundai', 1, 1, 'White', 'Hybrid', 7, 70, 8, 'Auto', 'Electrical Dept.');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `card_no` int(16) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `cvv` varchar(50) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `billing_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`card_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_no`, `name`, `cvv`, `expiry_date`, `billing_address`) VALUES
(89, 'hkjhk', 'jhkjh', '0007-07-07', 'hkjhkj');

-- --------------------------------------------------------

--
-- Table structure for table `driving_plan`
--

CREATE TABLE IF NOT EXISTS `driving_plan` (
  `plan_name` varchar(50) NOT NULL,
  `discount` float DEFAULT NULL,
  `monthly_payment` float DEFAULT NULL,
  `annual_fee` int(11) DEFAULT NULL,
  PRIMARY KEY (`plan_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driving_plan`
--

INSERT INTO `driving_plan` (`plan_name`, `discount`, `monthly_payment`, `annual_fee`) VALUES
('frequent', 15, 100, NULL),
('monthly', 10, 60, NULL),
('occasional', NULL, NULL, 50);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `name` varchar(50) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `cap` varchar(50) DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`name`, `address`, `cap`, `username`) VALUES
('Auditorium', 'Auditorium', '11', 'zeeshan'),
('Boys hostel', 'Boys hostel', '11', 'zeeshan'),
('EE Dept', 'UET lahore', '5', 'mota'),
('Electrical Dept.', 'EE', '12', 'aqib'),
('Main Block', 'UET Lahore', '20', 'zeeshan'),
('SSC', 'SSC', '11', 'zeeshan'),
('VC office', 'UET Lahore', '10', 'zeeshan');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `username` varchar(60) NOT NULL,
  `fisrt_name` varchar(40) DEFAULT NULL,
  `middle_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phnoe_no` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `card_no` int(16) DEFAULT NULL,
  `plan_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`),
  KEY `card_no` (`card_no`),
  KEY `plan_name` (`plan_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `fisrt_name`, `middle_name`, `last_name`, `address`, `phnoe_no`, `email`, `card_no`, `plan_name`) VALUES
('aqib', 'aqib', 'javaid', 'butt', 'uet lahore', '03236229970', 'aqibbutt@gmail.com', 89, 'monthly');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_log`
--

CREATE TABLE IF NOT EXISTS `reservation_log` (
  `r_id` int(15) NOT NULL AUTO_INCREMENT,
  `late_by` datetime DEFAULT NULL,
  `username` varchar(60) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `res_status` varchar(50) DEFAULT NULL,
  `return_date_time` datetime DEFAULT NULL,
  `pick_up_date_time` datetime DEFAULT NULL,
  `car_serial_no` int(15) DEFAULT NULL,
  `late_fee` float DEFAULT NULL,
  `extended_date_time` datetime DEFAULT NULL,
  `location_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`r_id`),
  KEY `car_serial_no` (`car_serial_no`),
  KEY `location_name` (`location_name`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reservation_log`
--

INSERT INTO `reservation_log` (`r_id`, `late_by`, `username`, `amount`, `res_status`, `return_date_time`, `pick_up_date_time`, `car_serial_no`, `late_fee`, `extended_date_time`, `location_name`) VALUES
(1, NULL, 'aqib', 400, NULL, '2015-05-17 14:22:00', '2015-05-16 14:22:00', 1111, 3600, NULL, 'VC office'),
(2, NULL, 'fahad', 300, NULL, '2015-05-16 02:00:10', '2015-05-16 00:00:10', 3333, NULL, NULL, 'Main Block'),
(4, '0000-00-00 00:00:00', 'aqib', 777, 'null', '2015-05-21 03:00:10', '2015-05-20 03:00:10', 1111, NULL, NULL, 'VC office');

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE IF NOT EXISTS `service_request` (
  `car_serial_no` int(15) NOT NULL DEFAULT '0',
  `username` varchar(60) NOT NULL DEFAULT '',
  `service_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `problem` text,
  PRIMARY KEY (`car_serial_no`,`username`,`service_date_time`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_request`
--

INSERT INTO `service_request` (`car_serial_no`, `username`, `service_date_time`, `problem`) VALUES
(78, 'fahad', '2015-05-17 20:22:34', 'Rim problem'),
(78, 'fahad', '2015-05-19 00:00:00', 'Some dash problem'),
(122, 'fahad', '2015-05-17 20:21:38', 'hjkh'),
(1111, 'mota', '2015-05-06 00:00:00', 'Penkture');

-- --------------------------------------------------------

--
-- Stand-in structure for view `temo`
--
CREATE TABLE IF NOT EXISTS `temo` (
`count(a.car_serial_no)` bigint(21)
,`car_serial_no` int(15)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `temp`
--
CREATE TABLE IF NOT EXISTS `temp` (
`count(a.car_serial_no)` bigint(21)
,`car_serial_no` int(15)
);
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(60) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `type`) VALUES
('aqib', '46e30ecdb0ad27543c75fae202e42705', '3'),
('fahad', 'd3702b6010c84898b96b5e7dd79dd5fa', '2'),
('faizan', '744cf14ef3a45a73677f68867e5ac40c', '1'),
('Heavy', 'rel3', '1'),
('ibraheem', 'rel4', '2'),
('mota', 'rel0', '3'),
('zeeshan', '6a8b34a9e786ff641b9b122cd1891722', '1');

-- --------------------------------------------------------

--
-- Structure for view `temo`
--
DROP TABLE IF EXISTS `temo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `temo` AS select count(`a`.`car_serial_no`) AS `count(a.car_serial_no)`,`a`.`car_serial_no` AS `car_serial_no` from `service_request` `a` group by `a`.`car_serial_no`;

-- --------------------------------------------------------

--
-- Structure for view `temp`
--
DROP TABLE IF EXISTS `temp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `temp` AS select count(`a`.`car_serial_no`) AS `count(a.car_serial_no)`,`a`.`car_serial_no` AS `car_serial_no` from `service_request` `a` group by `a`.`car_serial_no`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`loc_name`) REFERENCES `location` (`name`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`card_no`) REFERENCES `card` (`card_no`),
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`plan_name`) REFERENCES `driving_plan` (`plan_name`),
  ADD CONSTRAINT `member_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `reservation_log`
--
ALTER TABLE `reservation_log`
  ADD CONSTRAINT `reservation_log_ibfk_1` FOREIGN KEY (`car_serial_no`) REFERENCES `car` (`serial_no`),
  ADD CONSTRAINT `reservation_log_ibfk_2` FOREIGN KEY (`location_name`) REFERENCES `location` (`name`),
  ADD CONSTRAINT `reservation_log_ibfk_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Constraints for table `service_request`
--
ALTER TABLE `service_request`
  ADD CONSTRAINT `service_request_ibfk_1` FOREIGN KEY (`car_serial_no`) REFERENCES `car` (`serial_no`),
  ADD CONSTRAINT `service_request_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
