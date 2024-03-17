-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2024 at 10:03 PM
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
-- Database: `voyageur`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `airport_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `airport_name`) VALUES
(1, 'Katowice Airport'),
(2, 'Warsaw Chopin Airport'),
(3, 'Warsaw Modlin Airport');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` mediumint(9) NOT NULL,
  `country` varchar(70) NOT NULL,
  `town` varchar(100) NOT NULL,
  `transport_type_id` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `country`, `town`, `transport_type_id`) VALUES
(1, 'Germany', 'Cochem', 1),
(2, 'Germany', 'Berlin', 1),
(3, 'Estonia', 'Tallinn', 2),
(4, 'Slovakia', 'Bratislava', 3);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `photo` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `travel_id` int(10) NOT NULL,
  `order_price` decimal(8,2) NOT NULL,
  `ammount_of_adults` bit(1) NOT NULL DEFAULT b'0',
  `ammount_of_children` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `travel_id` int(11) NOT NULL,
  `base_price` decimal(7,2) DEFAULT NULL,
  `ticket` decimal(5,2) DEFAULT NULL,
  `dis_ticket` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `travel_id`, `base_price`, `ticket`, `dis_ticket`) VALUES
(1, 1, 10000.00, 999.99, 899.99),
(2, 2, 6000.00, 499.99, 399.99),
(3, 3, 9000.00, 699.99, 599.99),
(4, 4, 4000.00, 399.99, 320.99);

-- --------------------------------------------------------

--
-- Table structure for table `travels`
--

CREATE TABLE `travels` (
  `id` int(11) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `destination_id` mediumint(9) DEFAULT NULL,
  `length` tinyint(3) UNSIGNED DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `airport_id` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travels`
--

INSERT INTO `travels` (`id`, `title`, `description`, `destination_id`, `length`, `status`, `airport_id`) VALUES
(1, 'Berlin sightseeing', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur ipsa optio adipisci dolorem labore facere officiis cum consectetur, facilis obcaecati suscipit, et laudantium voluptate, consequuntur harum? Nulla, quas cum magnam repellat rem iusto inventore dolorum, ipsum ratione dolore mollitia rerum fugit repellendus amet nemo qui optio magni laboriosam tempora numquam? Numquam eum ex quia! Mollitia ipsam nemo harum asperiores consequatur sint recusandae vero saepe corporis laboriosam numquam dolorem at qui labore, nobis adipisci ducimus accusantium a pariatur quisquam sapiente libero odit aspernatur earum? Quaerat consequuntur dolor aut, ducimus et id distinctio ratione quis, magni itaque fuga repellendus autem est excepturi?', 2, 7, NULL, 1),
(2, 'Mountain Adventure', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur ipsa optio adipisci dolorem labore facere officiis cum consectetur, facilis obcaecati suscipit, et laudantium voluptate, consequuntur harum? Nulla, quas cum magnam repellat rem iusto inventore dolorum, ipsum ratione dolore mollitia rerum fugit repellendus amet nemo qui optio magni laboriosam tempora numquam? Numquam eum ex quia! Mollitia ipsam nemo harum asperiores consequatur sint recusandae vero saepe corporis laboriosam numquam dolorem at qui labore, nobis adipisci ducimus accusantium a pariatur quisquam sapiente libero odit aspernatur earum? Quaerat consequuntur dolor aut, ducimus et id distinctio ratione quis, magni itaque fuga repellendus autem est excepturi?', 4, 5, 'last minute', NULL),
(3, 'Fairly Castle', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur ipsa optio adipisci dolorem labore facere officiis cum consectetur, facilis obcaecati suscipit, et laudantium voluptate, consequuntur harum? Nulla, quas cum magnam repellat rem iusto inventore dolorum, ipsum ratione dolore mollitia rerum fugit repellendus amet nemo qui optio magni laboriosam tempora numquam? Numquam eum ex quia! Mollitia ipsam nemo harum asperiores consequatur sint recusandae vero saepe corporis laboriosam numquam dolorem at qui labore, nobis adipisci ducimus accusantium a pariatur quisquam sapiente libero odit aspernatur earum? Quaerat consequuntur dolor aut, ducimus et id distinctio ratione quis, magni itaque fuga repellendus autem est excepturi?', 1, 7, 'all inclusive', 1),
(4, 'At Baltic\'s Coastline', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur ipsa optio adipisci dolorem labore facere officiis cum consectetur, facilis obcaecati suscipit, et laudantium voluptate, consequuntur harum? Nulla, quas cum magnam repellat rem iusto inventore dolorum, ipsum ratione dolore mollitia rerum fugit repellendus amet nemo qui optio magni laboriosam tempora numquam? Numquam eum ex quia! Mollitia ipsam nemo harum asperiores consequatur sint recusandae vero saepe corporis laboriosam numquam dolorem at qui labore, nobis adipisci ducimus accusantium a pariatur quisquam sapiente libero odit aspernatur earum? Quaerat consequuntur dolor aut, ducimus et id distinctio ratione quis, magni itaque fuga repellendus autem est excepturi?', 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type`) VALUES
(1, 'departure by plane'),
(2, 'departure by coach'),
(3, 'self-transport');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_on_transport_type_id` (`transport_type_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_on_travel_id_2` (`travel_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_on_user_id` (`user_id`),
  ADD KEY `foreign_key_on_travel_id` (`travel_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_on_travel_id` (`travel_id`);

--
-- Indexes for table `travels`
--
ALTER TABLE `travels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_on_destination_id` (`destination_id`),
  ADD KEY `foreign_key_on_airport_id` (`airport_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `travels`
--
ALTER TABLE `travels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `destinations`
--
ALTER TABLE `destinations`
  ADD CONSTRAINT `foreign_key_on_transport_type_id` FOREIGN KEY (`transport_type_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `Images_ibfk_1` FOREIGN KEY (`travel_id`) REFERENCES `travels` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `foreign_key_on_travel_id` FOREIGN KEY (`travel_id`) REFERENCES `travels` (`id`),
  ADD CONSTRAINT `foreign_key_on_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `Prices_ibfk_1` FOREIGN KEY (`travel_id`) REFERENCES `travels` (`id`);

--
-- Constraints for table `travels`
--
ALTER TABLE `travels`
  ADD CONSTRAINT `Travels_ibfk_1` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`),
  ADD CONSTRAINT `foreign_key_on_airport_id` FOREIGN KEY (`airport_id`) REFERENCES `airports` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
