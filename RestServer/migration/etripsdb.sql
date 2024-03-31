-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2020 at 07:15 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7



--
-- Database: `etripsdb`
--
CREATE DATABASE IF NOT EXISTS `etripsdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `etripsdb`;
-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `filename` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`id`, `start_date`, `end_date`, `description`, `location`, `city`, `country`, `filename`) VALUES
(1, '2015-02-01', '2015-02-28', 'Embracing the KL City', 'Kuala Lumpur', 'KL dsfdssfdd', 'Malaysia', 'kl6.jpg'),
(2, '2015-03-01', '2015-03-31', 'Embracing the meticulous', 'Marina Bay', 'Singapore', 'Singapore', 'singapore7.jpg'),
(3, '2015-04-01', '2015-04-30', 'Embracing the landscape of Vietname', 'Halong Bay', 'Hanoi', 'Vietnam', 'vietnam1.jpg'),
(4, '2015-05-01', '2015-05-30', 'Embracing the landscape of China', 'Great Wall', 'Beijing', 'China', 'beijing1.jpg'),
(5, '2015-06-01', '2015-06-30', 'Embracing the cutlure of Vietnam', 'Districts of Ho Chi Minh', 'Ho Chi Minh City', 'Vietnam', 'vietnam2.jpg'),
(6, '2015-07-01', '2015-07-30', 'Embracing the history of India', 'Taj Mahal', 'Agra Uttar Pradesh', 'India', 'tajmahal4.jpg'),
(7, '2015-08-01', '2015-08-30', 'Embracing the Island of Singapore', 'Sentosa Island', 'Singapore', 'Singapore', 'singapore3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

