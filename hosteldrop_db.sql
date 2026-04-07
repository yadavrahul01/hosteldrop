-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 06:57 PM
-- Server version: 8.0.43
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `messages` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `room_details` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `messages` (`id`, `name`, `room_details`, `message`, `created_at`) VALUES
(30, 'rahul', 'block a (room no =121)', 'can you sell the chocolates?', '2026-04-07 00:41:47'),
(31, 'rahul', 'block a (room no =121)', 'can you keep the biscuits in stock?', '2026-04-07 01:02:22');

-- --------------------------------------------------------


CREATE TABLE `orders` (
  `id` int NOT NULL,
  `hostel_block` varchar(50) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `total_price` int NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `orders` (`id`, `hostel_block`, `room_number`, `total_price`, `status`, `created_at`, `order_date`) VALUES
(1, 'Block A', '101', 130, 'Delivered', '2026-04-06 20:18:55', '2026-04-06 19:45:18'),
(2, 'Block B', '102', 130, 'Delivered', '2026-04-06 20:18:55', '2026-04-06 19:46:11'),
(3, 'Block A', '234', 180, 'Delivered', '2026-04-06 20:18:55', '2026-04-06 19:54:29'),
(4, 'Block A', '106', 80, 'Pending', '2026-04-06 20:18:55', '2026-04-06 20:04:04'),
(5, 'Block B', '342', 130, 'Pending', '2026-04-06 20:18:55', '2026-04-06 20:07:21'),
(6, 'block b', '243', 70, 'Pending', '2026-04-06 20:55:06', '2026-04-06 20:55:06'),
(7, 'block b', '43', 130, 'Pending', '2026-04-06 21:33:15', '2026-04-06 21:33:15'),
(8, 'block a', '23', 130, 'Pending', '2026-04-06 23:32:19', '2026-04-06 23:32:19'),
(9, 'block b', '24', 140, 'Delivered', '2026-04-06 23:43:30', '2026-04-06 23:43:30'),
(10, 'block a', '35', 30, 'Pending', '2026-04-07 00:07:37', '2026-04-07 00:07:37');

-- --------------------------------------------------------



CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` longtext NOT NULL,
  `category` varchar(50) DEFAULT 'Snacks'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`) VALUES
(1, 'Maggi Noodles', 20, 'images/maggy.jpg', 'Snacks'),
(2, 'Redbull Energy', 110, 'images/redbull.png', 'Beverages'),
(3, 'Paracetamol', 30, 'images/medicine.jpg', 'Essentials'),
(4, 'Lays Chips', 20, 'images/lays.jpg', 'Snacks'),
(5, 'Moov spray', 40, 'images/moov.jpg', 'Essentials'),
(6, 'coke', 30, 'images/Coke-cans-min.jpg', 'Beverages');


ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);




ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;


ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

