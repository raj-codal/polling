-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2019 at 09:25 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `p5`
--

DROP TABLE IF EXISTS `p5`;
CREATE TABLE IF NOT EXISTS `p5` (
  `poll_giver_id` int(255) NOT NULL,
  `opinion` int(255) NOT NULL,
  KEY `user` (`poll_giver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `p5_users`
--

DROP TABLE IF EXISTS `p5_users`;
CREATE TABLE IF NOT EXISTS `p5_users` (
  `poll_giver_id` int(255) NOT NULL,
  KEY `user` (`poll_giver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `p5_users`
--

INSERT INTO `p5_users` (`poll_giver_id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

DROP TABLE IF EXISTS `polls`;
CREATE TABLE IF NOT EXISTS `polls` (
  `poll_id` int(255) NOT NULL AUTO_INCREMENT,
  `poll_creator_id` int(255) NOT NULL,
  `poll_q` varchar(255) NOT NULL,
  `poll_options` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`poll_id`),
  KEY `poll_creator_id` (`poll_creator_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `poll_creator_id`, `poll_q`, `poll_options`, `result`) VALUES
(5, 1, 'this is a question man', 'opt 3/over/opt 2/over/opt 1', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `name` char(255) NOT NULL,
  `id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `id`, `email`, `password`) VALUES
('raj', 1, 'raj@ymail.co.in', '0000'),
('x', 2, 'x@y.com', '1111');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p5`
--
ALTER TABLE `p5`
  ADD CONSTRAINT `p5_ibfk_1` FOREIGN KEY (`poll_giver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p5_users`
--
ALTER TABLE `p5_users`
  ADD CONSTRAINT `p5_users_ibfk_1` FOREIGN KEY (`poll_giver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `polls_ibfk_1` FOREIGN KEY (`poll_creator_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
