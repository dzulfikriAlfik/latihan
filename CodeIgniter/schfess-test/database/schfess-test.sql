-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 02, 2021 at 02:04 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schfess-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre_list`
--

DROP TABLE IF EXISTS `genre_list`;
CREATE TABLE IF NOT EXISTS `genre_list` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre_list`
--

INSERT INTO `genre_list` (`id_genre`, `genre`) VALUES
(1, 'Anime / Manga'),
(2, 'Movie'),
(3, 'TV Series'),
(4, 'Drama'),
(5, 'Horror'),
(6, 'Fiction'),
(7, 'Action'),
(8, 'Documentary'),
(9, 'Comedy'),
(10, 'Musical');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `id_genre` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `id_genre`) VALUES
(1, 'Naruto saepudin', 1),
(2, 'One Piece', 1),
(3, 'Detective Conan', 1),
(7, 'High and Low', 2),
(9, 'Great Teacher Onizuka', 3),
(10, 'Comic 8', 9),
(11, 'Cek Toko Sebelah', 9),
(12, 'Annabelle Creation', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(8, 'Schoolfess', 'schfess@gmail.com', '$2y$10$Tcr/woTY7MwuLJNAVz9S0OwEobCVZp2pNiehIPdWEkJosXG/Wb2aW', '2021-10-02 01:46:04'),
(7, 'Dzulfikri Alkautsari', 'alfikperfect@gmail.com', '$2y$10$5h5Yi4xdEoCLMUEWpxDAzOloMRHFWNufowUjK.7XiRmITyW69cRsW', '2021-10-01 10:49:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
