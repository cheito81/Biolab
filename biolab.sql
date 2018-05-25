
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS dawbio1805;
USE dawbio1805;
--
-- Database: `biolab`
--
--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (

  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `surname1` varchar(150) NOT NULL,
  `nick` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `userType` varchar(150) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `entryDate` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `name`, `surname1`, `nick`, `password`, `userType`,`mail`, `entryDate`,`image`) VALUES
(null, 'Jhon', 'Peterson', 'user1', '123456', 0,'r1@r.com','2014-01-01','images/usersImages/user1.jpeg'),
(null, 'Jhon1', 'Peterson1', 'user2', '123456', 1,'r2@r.com','2014-01-01','images/usersImages/user2.jpeg'),
(null, 'Jhon2', 'Peterson2', 'user3', '123456', 1,'r3@r.com','2014-01-01','images/usersImages/user3.jpeg');


DROP TABLE IF EXISTS `molecules`;
--
-- Estructura de tabla para la tabla `molecules`
--

CREATE TABLE `molecules` (
  `molecule_chembl_id` varchar(150) NOT NULL,
  `full_molformula` varchar(100) NOT NULL,
  `full_mwt` float NOT NULL,
  `molecular_species` varchar(100) NOT NULL,
  `canonical_smiles` varchar(2000) NOT NULL,
  `molecule_type` varchar(250) NOT NULL,
  `pref_name` varchar(150) NOT NULL,
  `structure_type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `molecules`
--

INSERT INTO `molecules` (`molecule_chembl_id`, `full_molformula`, `full_mwt`, `molecular_species`, `canonical_smiles`, `molecule_type`, `pref_name`, `structure_type`) VALUES
('CHEMBL396778', 'C17H19FN2O2', 302.34, 'NEUTRAL', 'C[C@H(NCc1ccc(OCc2cccc(F)c2)cc1)C(=O)N', 'Small molecule', 'SAFINAMIDE', 'MOL'),
('CHEMBL6329', 'C17H12ClN3O3', 341.75, 'ACID', 'Cc1cc(ccc1C(=O)c2ccccc2Cl)N3N=CC(=O)NC3=O', 'Small molecule', '', 'MOL'),
('CHEMBL82327', 'C17H19FN2O2', 302.34, 'NEUTRAL', 'C[C@@H (NCc1ccc(OCc2cccc(F)c2)cc1)C(=O)N', 'Small molecule', '', 'MOL');


CREATE USER IF NOT EXISTS 'dawbio1805'@'localhost' IDENTIFIED BY 'Ew5kaer6';
GRANT ALL ON dawbio1805.* TO 'dawbio1805'@'localhost';
GRANT ALL ON dawbio1805 TO 'dawbio1805'@'localhost';
GRANT CREATE ON dawbio1805 TO 'dawbio1805'@'localhost';
FLUSH PRIVILEGES;