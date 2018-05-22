
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS biolab;
USE biolab;
--
-- Database: `biolab`
--
--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
<<<<<<< HEAD
CREATE TABLE IF NOT EXISTS `users` (
=======
CREATE TABLE `users` (
>>>>>>> fe66bdb266cf75ed6542ae77ca69e76808e3626f
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `surname1` varchar(150) NOT NULL,
  `nick` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `userType` varchar(150) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `telephone` int(11),
  `mail` varchar(150) NOT NULL,
  `birthDate` varchar(150) NOT NULL,
  `entryDate` varchar(150) NOT NULL,
  `dropOutDate` varchar(150) NOT NULL,
  `active` boolean NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `name`, `surname1`, `nick`, `password`, `userType`,`address`, `city`, `state`,`telephone`, `mail`, `birthDate`, `entryDate`, `dropOutDate`, `active`, `image`) VALUES
(null, 'Jhon', 'Peterson', 'user1', '123456', 0,'Address1', 'Barcelona', 'Spain',933333333, 'r1@r.com', '1975-01-01', '2014-01-01', '0000-00-00', true, 'images/usersImages/user1.jpeg'),
(null, 'Jhon1', 'Peterson1', 'user2', '123456', 1,'Address2', 'Barcelona', 'Spain', 933333333, 'r2@r.com', '1975-01-01', '2014-01-01', '0000-00-00', true, 'images/usersImages/user2.jpeg'),
(null, 'Jhon2', 'Peterson2', 'user3', '123456', 1,'Address3', 'Barcelona', 'Spain', 933333333, 'r3@r.com', '1975-01-01', '2014-01-01', '0000-00-00', true, 'images/usersImages/user3.jpeg');

<<<<<<< HEAD
=======
DROP TABLE IF EXISTS `molecules`;
CREATE TABLE `molecules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accessionNumber` varchar (10) NOT NULL,
  `moleculeFormula` varchar(150) NOT NULL,
  `moleculeWeight` float NOT NULL,
  `moleculeSimilarity1` varchar(150) NOT NULL,
  `moleculeSimilarity2` varchar(150) NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;
--
-- Dumping data for table `users`
--
--
-- Dumping data for table `users`
--
INSERT INTO `molecules` (`id`, `accessionNumber`, `moleculeFormula`,`moleculeWeight`, `moleculeSimilarity1`, `moleculeSimilarity2`) VALUES
(1, 'C8CN33', 'ACH2CHN3OCHN', 12.36, 'MoleculeSimilarity11', 'MoleculeSimilarity21'),
(2, 'P20231','CN3H2OHN3', 43.57,'MoleculeSimilarity12', 'MoleculeSimilarity22'),
(3, 'C8CNP3','H2O3NCHN3O2', 105.23,'MoleculeSimilarity13', 'MoleculeSimilarity23');
>>>>>>> fe66bdb266cf75ed6542ae77ca69e76808e3626f

CREATE USER IF NOT EXISTS 'biolab'@'localhost' IDENTIFIED BY 'biolab';
GRANT ALL ON biolab.* TO 'biolab'@'localhost';
GRANT ALL ON biolab TO 'biolab'@'localhost';
GRANT CREATE ON biolab TO 'biolab'@'localhost';
FLUSH PRIVILEGES;
