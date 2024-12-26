-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 02:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `horoscope_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_admin` int(1) NOT NULL DEFAULT '0',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(150) NOT NULL,
  `birth_month` int(2) NOT NULL,
  `birth_day` int(2) NOT NULL,
  `birth_year` int(4) NOT NULL,
  `gender` char(6) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`,`is_admin`, `first_name`, `last_name`, `email`, `password`, `birth_month`, `birth_day`, `birth_year`, `created_at`) VALUES
(0, 1, 'Todin', 'Castaneda', 'todin.castaneda@gmail.com', '$2y$12$uXbLUIvW3xvBekIMyNoFveyz1UCKZ9xuY8Pll.mx6PAgGxLswQMVy', 2, 26, 2004, current_timestamp(6)),  
(1, 0, 'Kyle', 'Flores', 'genekylemichaelf@gmail.com', '$2y$12$rwobRHctp.0jVOwQLPF9ROQHJVSjp.Pg.P8nu9O1F6S3q9e3Uxipm', 10, 14, 2003, current_timestamp(6)),
(2, 0, 'Erin', 'Lorzano', 'erinlorzano@gmail.com', '$2y$12$25XuOEw.hlj064v2sYgG8uNghcWyhKE7pKB3wPvt1FIs7Dy8ABzh6', 9, 28, 2003, current_timestamp(6));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;