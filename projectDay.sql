-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 09, 2019 at 11:26 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectDay`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `biography` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `name`, `year_birth`, `gender`, `biography`) VALUES
(1, 'James Clear', '1955-02-02', 'm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(2, 'J.K. Rowling', '1966-01-01', 'f', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(3, 'J.R.R. Tolkien', '1944-03-03', 'm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(4, 'Alexandre Dumas', '1933-04-04', 'm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(5, 'George R.R. Martin', '1915-05-05', 'm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(6, 'Harper Lee', '1979-03-27', 'f', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(7, 'Antoine de Saint-Exupery', '1987-12-11', 'm', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(3) NOT NULL,
  `title` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `author_id` int(3) NOT NULL,
  `category` varchar(50) NOT NULL,
  `format` varchar(50) NOT NULL,
  `price` int(3) NOT NULL,
  `soldNum` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `title`, `release_date`, `author_id`, `category`, `format`, `price`, `soldNum`) VALUES
(1, 'Atomic Habits', '1999-02-01', 1, 'Book Humor', 'Pocket Book', 12, 110),
(2, 'The Harry Potter 1', '1994-05-21', 2, 'Book Drama', 'Large Book', 27, 8000),
(3, 'The Count of Monte Cristo', '1825-02-05', 4, 'Book Classic', 'Large Book', 5, 3000),
(4, 'The Lord of The Rings', '2000-02-05', 3, 'Book Action', 'Large Book', 54, 9555),
(5, 'A Game of Thrones', '2015-04-03', 5, 'Book Action', 'Large Book', 42, 800),
(6, 'To Kill a Mockingbird', '1995-06-08', 6, 'Book Classic', 'Pocket Book', 14, 15),
(7, 'The Little Prince', '2000-05-07', 7, 'Book Humor', 'Pocket Book', 58, 985),
(8, 'The Harry Potter 2', '1996-08-06', 2, 'Book Drama', 'Large Book', 598, 9987);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `paid` int(1) NOT NULL DEFAULT 0,
  `user_id` int(3) NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `order_price` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `paid`, `user_id`, `date`, `order_price`) VALUES
(21, 1, 3, '2019-07-09', 27),
(22, 1, 3, '2019-07-09', 598),
(23, 1, 3, '2019-07-09', 54),
(24, 1, 11, '2019-07-09', 42),
(25, 1, 11, '2019-07-09', 58),
(26, 1, 3, '2019-07-09', 12),
(27, 1, 3, '2019-07-09', 54),
(28, 1, 3, '2019-07-09', 54),
(29, 1, 3, '2019-07-09', 14),
(30, 1, 3, '2019-07-09', 42),
(31, 1, 3, '2019-07-09', 42);

-- --------------------------------------------------------

--
-- Table structure for table `order_content`
--

CREATE TABLE `order_content` (
  `order_content_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_content`
--

INSERT INTO `order_content` (`order_content_id`, `item_id`, `order_id`) VALUES
(11, 2, 21),
(12, 8, 22),
(13, 4, 23),
(14, 5, 24),
(15, 7, 25),
(16, 1, 26),
(17, 4, 27),
(18, 4, 28),
(19, 6, 29),
(20, 5, 30),
(21, 5, 31);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'joao', 'portu', 'joao0dds@gmail.com', '123456'),
(2, 'nasser', 'alkar', 'alkar0aokjsflas@gmail.com', '123456'),
(3, 'joao', 'felicio', 'joao@asd.com', '$2y$10$rCW6JUTue4W5W1iLJ81mqOBlAIWhGhlQGw4iAcPHbAjKXkFJUZa6m'),
(4, 'this', 'test', 'asdasd@asd.com', '$2y$10$O7CN1y681Iz.LAZtCWKcs.SHZwLGtlpMrqZK4V43g4hH59Kj6ueUC'),
(5, 'joking', 'lobeu', 'joaolfelicio@gmail.com', '$2y$10$R.saA7tyfhTGC9hpyaNSAuwpASCCKetQ.1eYAfZTiXnhtQ6Z0xJ1O'),
(6, 'joking', 'lobeu', 'joaolfelicio@gmail.com', '$2y$10$R.saA7tyfhTGC9hpyaNSAuwpASCCKetQ.1eYAfZTiXnhtQ6Z0xJ1O'),
(7, 'asda', 'dasdasd22', 'asdasda@dasdasdas.com', '$2y$10$XQxVpAUupdBEUv7H6TW/POaRFAc0HHSHbtWlFk5Z2MIA9kEGIcpLq'),
(8, 'asda', 'dasdasd22', 'asdasda@dasdasdas.com', '$2y$10$XQxVpAUupdBEUv7H6TW/POaRFAc0HHSHbtWlFk5Z2MIA9kEGIcpLq'),
(9, 'what', 'fuck', 'weirdbug@bug.com', '$2y$10$H/ynBCMfQ7XRxe6nnt9ureVE4njlHT.Hvh9FaoLf0.ZQ0Wz2HNuNi'),
(11, 'asdasd', 'asdasd', 'asd@asd.com', '$2y$10$sy2vYqk9lm3bzlRHgl25SOcp2IFMqgwNVpcxMvMSGNqq/GSHjBWBK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`order_content_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_content`
--
ALTER TABLE `order_content`
  MODIFY `order_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`);

--
-- Constraints for table `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `order_content_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `order_content_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
