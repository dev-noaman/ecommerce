-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `drophut`;

-- Use the database
USE `drophut`;

-- Create the users table first since other tables will reference it
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `permissions` text COLLATE utf8mb4_general_ci,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the blogs table
CREATE TABLE `blogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `author_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `author_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `special_content` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the cart table
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `products` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the categories table
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the contact table
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the messages table
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the order table
CREATE TABLE `order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the order_product table
CREATE TABLE `order_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `product_price` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the products table
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `subtitle` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` int NOT NULL,
  `price_after_sale` int DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating` smallint NOT NULL DEFAULT '0',
  `review` smallint NOT NULL DEFAULT '0',
  `styles` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `properties` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the settings table
CREATE TABLE `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the slider table
CREATE TABLE `slider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the users_opinion table
CREATE TABLE `users_opinion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `opinion` text COLLATE utf8mb4_general_ci,
  `image` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert dummy data into the users table
INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `permissions`, `is_active`) VALUES
(7, 'Kareem Kadry', '12345678', 'kareemkadry1966@outlook.com', 'user', '0', 1),
(9, 'Kareem Kadry', '12345678', 'cr7.rm35@gmail.com', 'user', NULL, 1);

-- Insert dummy data into the contact table
INSERT INTO `contact` (`id`, `name`, `email`, `message`, `user_id`) VALUES
(8, 'Kareem Kadry', 'cr7.rm35@gmail.com', 'new message from user', 9),
(9, 'Kareem Kadry', 'kareemkadry1966@outlook.com', 'hellooooooooooo', 7);

-- Insert dummy data into the order table
INSERT INTO `order` (`id`, `country`, `address`, `city`, `phone`, `user_id`, `name`, `created_at`, `total_price`) VALUES
(110, '2', 'Cairo. El-Obour Bldgs...', 'Mansoura', '01211998633', 7, 'Kareem Kadry', '2024-09-21 19:00:33', 250),
(111, '2', 'Cairo. El-Obour Bldgs...', 'Mansoura', '01211998633', 7, 'Kareem Kadry', '2024-09-21 19:07:44', 110),
(112, '2', 'Cairo. El-Obour Bldgs...', 'Mansoura', '01211998633', 9, 'Kareem Kadry', '2024-09-21 19:08:32', 128);

-- Insert dummy data into the order_product table
INSERT INTO `order_product` (`id`, `order_id`, `product_name`, `product_price`, `user_id`) VALUES
(28, 110, 'Dolor corporis nihil', NULL, 7),
(29, 110, 'Doloribus distinctio quaerat', NULL, 7),
(30, 111, 'Repudiandae error quae', NULL, 7),
(31, 112, 'Ut praesentium earum', NULL, 9);

-- Insert dummy data into the products table
INSERT INTO `products` (`id`, `name`, `subtitle`, `description`, `price`, `price_after_sale`, `image`, `rating`, `review`, `styles`, `properties`) VALUES
(1, 'Ut praesentium earum', 'MEVRIK', 'Lorem ipsum...', 80, 70, '1.jpg', 4, 20, 'Multi-Rotor', 'smooth and simple landing'),
(2, 'Doloribus distinctio quaerat', 'ELECTROMAX', 'Nam vero...', 120, 100, '2.jpg', 5, 15, 'High-Speed', 'advanced stabilization technology');

-- Insert dummy data into the slider table
INSERT INTO `slider` (`id`, `image`, `title`, `description`, `link`) VALUES
(1, '01.png', 'Next level of Drone', 'Insane Quality for use', 'Special offer 20% off this week'),
(2, '02.png', 'Best Camera Included', '100% Flexible', 'exclusive offer 20% off this week'),
(3, '03.png', 'With some gifts', 'Special one for you', 'exclusive offer 20% off this week');

-- Insert dummy data into the users_opinion table
INSERT INTO `users_opinion` (`id`, `name`, `position`, `opinion`, `image`) VALUES
(1, 'Kath Young', 'CEO OF SunPark', 'Contrary to popular belief...', '01.jpg'),
(2, 'John Sullivan', 'Customer', 'There are many variations...', '02.jpg'),
(3, 'Jenifer Brown', 'Manager of AZ', 'College in Virginia...', '03.jpg');
