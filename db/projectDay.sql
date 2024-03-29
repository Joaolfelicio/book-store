-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2019 at 06:49 PM
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
  `picture` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year_birth` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `biography` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `picture`, `name`, `year_birth`, `gender`, `biography`) VALUES
(1, 'https://jamesclear.com/wp-content/uploads/2018/07/about-james-clear.jpg', 'James Clear', '1955-02-02', 'Male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(2, 'https://media1.popsugar-assets.com/files/thumbor/6j4QtP0kTb0cNF9A7vvMG2lWzbc/fit-in/1024x1024/filters:format_auto-!!-:strip_icc-!!-/2019/03/18/739/n/1922283/c460649f5c8fcb249041a7.72354065_/i/JK-Rowling-Backlash-LGBTQ-Inclusion-Comments.jpg', 'J.K. Rowling', '1966-01-01', 'Female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(3, 'https://static1.squarespace.com/static/55f1b6a3e4b03fe764698337/t/5628176be4b0bace718537cc/1445468013030/J.R.R.+Tolkein', 'J.R.R. Tolkien', '1944-03-03', 'Male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(4, 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/06/Alexander_Dumas_p%C3%A8re_par_Nadar_-_Google_Art_Project.jpg/250px-Alexander_Dumas_p%C3%A8re_par_Nadar_-_Google_Art_Project.jpg', 'Alexandre Dumas', '1933-04-04', 'Male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(5, 'https://gbatemp.b-cdn.net/attachments/14-george-rr-martin-w330-h330-jpg.167613/', 'George R.R. Martin', '1915-05-05', 'Male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(6, 'https://cbsnews1.cbsistatic.com/hub/i/r/2016/02/19/be7a81d7-399f-4ad3-acd3-a8e90abb9a73/resize/620x465/6e78c1c746240ea912ec91c2f315e0ce/harper-lee-ap061211013687.jpg', 'Harper Lee', '1979-03-27', 'Female', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(7, 'http://www.linflux.com/wp-content/uploads/2017/09/St-EX.jpg', 'Antoine de Saint-Exupery', '1987-12-11', 'Male', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error magnam eveniet iure expedita, fugiat similique eos ad, quos numquam excepturi dolores nihil asperiores? Maxime dignissimos possimus molestias quaerat quia vero?\r\n'),
(8, 'https://upload.wikimedia.org/wikipedia/commons/a/a7/Paulo_Coelho_30102007.jpg', 'Paulo Coelho', '1947-08-24', 'male', 'Coelho was born in Rio de Janeiro, Brazil and attended a Jesuit school. As a teenager, Coelho wanted to become a writer. Upon telling his mother this, she responded, \"My dear, your father is an engineer. He\'s a logical, reasonable man with a very clear vision of the world. Do you actually know what it means to be a writer?\" At 17, Coelho\'s introversion and opposition to following a traditional path led to his parents committing him to a mental institution from which he escaped three times before being released at the age of 20');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(3) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `author_id` int(3) NOT NULL,
  `category` varchar(50) NOT NULL,
  `format` varchar(50) NOT NULL,
  `price` int(3) NOT NULL,
  `soldNum` int(10) NOT NULL,
  `isAvailable` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `poster`, `title`, `release_date`, `author_id`, `category`, `format`, `price`, `soldNum`, `isAvailable`) VALUES
(1, 'https://images-na.ssl-images-amazon.com/images/I/914axpnsYZL.jpg', 'Atomic Habits', '1999-02-01', 1, 'Book Humor', 'Pocket Book', 25, 110, 0),
(8, 'https://lh3.googleusercontent.com/_Y1RgkKRdM5qGVUvT8HCGsCevaWK8IH6AooROLEsosRObyqJwWaPxiGGxAADKomSNQ5Y', 'The Harry Potter 2', '1996-09-13', 2, 'Book Drama', 'Large Book', 598, 9987, 1),
(9, 'https://uauposters.com.br/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/1/7/173620140528-uau-posters-filmes-harry-potter-1-e-a-pedra-filosofal--harry-potter-and-the-sorcerer-s-stone-3.jpg', 'The Harry Potter 1', '2006-06-14', 2, 'Book Drama', 'Large Format', 22, 90000, 1),
(10, 'https://jamesclear.com/wp-content/uploads/2015/02/Lord-of-the-Rings-by-JRR-Tolkien-541x700.jpg', 'The Lord of The Rings', '2005-02-08', 3, 'Book Action', 'XL Book', 49, 21269, 1),
(11, 'https://jamesclear.com/wp-content/uploads/2015/02/A-Game-of-Thrones-by-George-RR-Martin-461x700.jpg', 'A Game of Thrones', '1992-10-08', 5, 'Book Classic', 'Large Format', 70, 692400, 1),
(12, 'https://jamesclear.com/wp-content/uploads/2015/02/The-Alchemist-by-Paulo-Coelho-461x700.jpg', 'The alchemist', '2014-01-01', 8, 'Book Humor', 'Pocket Book', 14, 10000, 1),
(13, 'https://jamesclear.com/wp-content/uploads/2017/04/The-Martian-by-Andy-Weir.jpeg', 'The Martian', '2017-10-12', 7, 'Book Drama', 'Large Format', 42, 502000, 1),
(14, 'https://jamesclear.com/wp-content/uploads/2015/02/The-Girl-With-the-Dragon-Tattoo-by-Stieg-Larsson.jpg', 'The girl with the Dragon Tatoo', '2016-06-10', 1, 'Book Action', 'Pocket Book', 33, 60219, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `paid` int(1) NOT NULL DEFAULT 0,
  `user_id` int(3) NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `address` varchar(255) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `paid`, `user_id`, `date`, `address`, `payment_method`) VALUES
(68, 1, 3, '2019-07-10', NULL, NULL),
(69, 1, 3, '2019-07-10', NULL, NULL),
(70, 1, 3, '2019-07-15', NULL, NULL),
(71, 1, 11, '2019-07-10', NULL, NULL),
(72, 1, 11, '2019-07-10', NULL, NULL),
(73, 1, 11, '2019-07-10', NULL, NULL),
(74, 1, 11, '2019-07-10', NULL, NULL),
(75, 1, 11, '2019-07-10', NULL, NULL),
(76, 1, 11, '2019-07-10', NULL, NULL),
(77, 1, 11, '2019-07-10', NULL, NULL),
(78, 1, 11, '2019-07-10', NULL, NULL),
(79, 1, 11, '2019-07-10', NULL, NULL),
(80, 1, 11, '2019-07-21', 'asdasd', 'Visa'),
(81, 1, 11, '2019-07-21', 'asdasd', 'Visa'),
(82, 1, 3, '2019-07-15', '1 Place d\'Armes, 1136 Luxembourg', 'Mastercard'),
(83, 1, 11, '2019-07-21', '1 Place d\'Armes, 1136 Luxembourg', 'Mastercard'),
(84, 1, 11, '2019-07-21', '1 Place d\'Armes, 1136 Luxembourg', 'Visa'),
(85, 1, 11, '2019-07-21', '1 Place d\'Armes, 1136 Luxembourg', 'Mastercard'),
(86, 1, 11, '2019-07-21', '1 Place d\'Armes, 1136 Luxembourg', 'Visa'),
(87, 0, 11, '2019-07-21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_content`
--

CREATE TABLE `order_content` (
  `order_content_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(3) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_content`
--

INSERT INTO `order_content` (`order_content_id`, `item_id`, `order_id`, `quantity`) VALUES
(62, 8, 68, 1),
(63, 1, 68, 1),
(64, 1, 68, 1),
(65, 1, 69, 1),
(66, 1, 70, 1),
(67, 8, 71, 1),
(68, 8, 72, 1),
(69, 8, 72, 1),
(70, 1, 72, 1),
(71, 1, 73, 1),
(72, 8, 74, 1),
(73, 1, 74, 1),
(74, 1, 75, 1),
(75, 1, 75, 1),
(76, 1, 75, 1),
(77, 1, 75, 1),
(78, 1, 75, 1),
(79, 1, 75, 1),
(80, 1, 75, 1),
(81, 1, 75, 1),
(82, 1, 75, 1),
(83, 1, 75, 1),
(84, 1, 75, 1),
(85, 8, 76, 1),
(86, 13, 76, 1),
(87, 14, 76, 1),
(88, 10, 76, 1),
(89, 10, 76, 1),
(90, 10, 76, 1),
(91, 10, 76, 1),
(92, 10, 76, 1),
(93, 9, 76, 1),
(94, 9, 76, 1),
(95, 8, 77, 1),
(96, 1, 78, 1),
(97, 1, 78, 1),
(98, 13, 78, 1),
(99, 8, 79, 1),
(100, 8, 79, 1),
(101, 8, 79, 1),
(102, 8, 79, 1),
(103, 11, 79, 1),
(104, 12, 79, 1),
(105, 14, 79, 1),
(106, 11, 79, 1),
(107, 10, 79, 1),
(108, 8, 79, 1),
(109, 8, 79, 1),
(110, 9, 79, 1),
(111, 8, 79, 1),
(112, 8, 70, 1),
(113, 8, 79, 1),
(123, 11, 82, 1),
(124, 13, 82, 1),
(131, 10, 80, 0),
(132, 11, 80, 0),
(133, 8, 80, 0),
(134, 13, 80, 1),
(135, 9, 80, 2),
(136, 11, 83, 1),
(137, 14, 83, 3),
(138, 8, 84, 2),
(139, 9, 84, 1),
(140, 8, 85, 2),
(141, 9, 85, 0),
(142, 11, 86, 2),
(143, 12, 86, 1),
(144, 14, 86, 1),
(145, 14, 87, 0),
(146, 11, 87, 1),
(147, 1, 87, 1),
(148, 10, 87, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `isAdmin`) VALUES
(1, 'joao', 'portu', 'joao0dds@gmail.com', '123456', 0),
(2, 'nasser', 'alkar', 'alkar0aokjsflas@gmail.com', '123456', 0),
(3, 'joao', 'felicio', 'joao@asd.com', '$2y$10$rCW6JUTue4W5W1iLJ81mqOBlAIWhGhlQGw4iAcPHbAjKXkFJUZa6m', 0),
(4, 'this', 'test', 'asdasd@asd.com', '$2y$10$O7CN1y681Iz.LAZtCWKcs.SHZwLGtlpMrqZK4V43g4hH59Kj6ueUC', 0),
(5, 'joking', 'lobeu', 'joaolfelicio@gmail.com', '$2y$10$R.saA7tyfhTGC9hpyaNSAuwpASCCKetQ.1eYAfZTiXnhtQ6Z0xJ1O', 0),
(7, 'asda', 'dasdasd22', 'asdasda@dasdasdas.com', '$2y$10$XQxVpAUupdBEUv7H6TW/POaRFAc0HHSHbtWlFk5Z2MIA9kEGIcpLq', 0),
(9, 'what', 'fuck', 'weirdbug@bug.com', '$2y$10$H/ynBCMfQ7XRxe6nnt9ureVE4njlHT.Hvh9FaoLf0.ZQ0Wz2HNuNi', 0),
(11, 'asdasd', 'asdasd', 'asd@asd.com', '$2y$10$sy2vYqk9lm3bzlRHgl25SOcp2IFMqgwNVpcxMvMSGNqq/GSHjBWBK', 1),
(14, 'dasdad', 'dasdas', 'dasdasdasd@easdad.com', '$2y$10$Pyw6QuSuP14QNkryiXgwpevJAjbs9CPoKeLmOWWgOSbu85MRPIFwK', 0),
(15, 'dasdad', 'dasda', 'asdasdadasd@dasda.net', '$2y$10$V.F/tZkXlm.VXRzkIOmqiOaUBkF7NYEW7fEmxJz6Jq/uaV9nb5UDa', 0),
(16, 'dasdasd', 'dasdas', 'sadadads@dsadas.sad', '$2y$10$R7gCz/wdI04AvkbH8VGYIOtrQ3XwDI73.WhrUgIud0cPDrXpVy0Nu', 0),
(17, 'DASDASD', 'DASDA', 'asddas2AS@DAS.COM', '$2y$10$vK56c2AsoLvM9SPC54Vv9uBvhaGxN3aQ/NtIc915b1oLfzhwlCYiW', 0),
(18, 'dasdad', 'dasdada', 'adasd@dasda.com', '$2y$10$Bp4lJIp0BnAmZ5BD6bg7jeQeBtiYT3CSOc3C9UFQ.TZxsJTqI.iae', 0);

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
  MODIFY `author_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `order_content`
--
ALTER TABLE `order_content`
  MODIFY `order_content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
