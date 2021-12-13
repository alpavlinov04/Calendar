-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 13 дек 2021 в 09:45
-- Версия на сървъра: 10.4.21-MariaDB
-- Версия на PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `calendar`
--

-- --------------------------------------------------------

--
-- Структура на таблица `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_started` datetime NOT NULL,
  `date_ended` datetime NOT NULL,
  `color` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `events`
--

INSERT INTO `events` (`id`, `user_id`, `name`, `date_started`, `date_ended`, `color`) VALUES
(1, 0, 'Study', '2021-11-30 12:00:00', '2021-11-30 17:00:00', '#f3f722'),
(2, 0, 'howerk', '2021-12-07 17:30:30', '2021-12-07 18:00:30', '#f3f722'),
(3, 0, 'Go to school', '2021-12-08 07:45:00', '2021-12-08 15:00:00', '#ec1313'),
(4, 0, 'Party', '2021-12-23 19:00:00', '2021-12-23 00:30:00', '#16e939'),
(5, 0, 'Turkey', '2021-11-21 05:45:00', '2021-11-27 00:01:00', '#24e044'),
(6, 0, 'Portugal', '2022-03-13 05:00:00', '2022-03-19 00:00:00', '#4dd006'),
(7, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '#000000'),
(8, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '#000000');

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `confirm_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `password`, `confirm_password`) VALUES
(1, 'al.pavlinov', 'alekspav2004@gmail.com', 'pavlinov', 'pavlinov'),
(2, '', 'akekspav2004@gmail.com', 'radkov1510', 'radkov1510'),
(43, '', 'akeks@gmail.com', 'akeksk1', 'akeks1');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_ended` (`date_ended`),
  ADD KEY `flag_name` (`color`),
  ADD KEY `name` (`name`),
  ADD KEY `user_id` (`user_id`);

--
-- Индекси за таблица `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `confirm_password` (`confirm_password`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
