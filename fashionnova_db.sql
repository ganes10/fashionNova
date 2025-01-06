-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 11:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionnova_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `fullname`, `email`, `password`, `phone`, `created_at`) VALUES
(7, 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', '$2y$10$RAb25rlxrq7DDCYl7L.Pl.tq611CEyYlmkT9e64QmOQ3MQ3oDf2Cy', '9823423452', '2023-11-26 16:54:23'),
(8, 'Saneel Karmacharya', 'saneel@gmail.com', '$2y$10$HVS9z4njRuT1e/HZfUhZeOsCm.lNGVB9fu/mIH87f3pRq.5L7WWEG', '9823423452', '2023-12-18 15:00:48'),
(9, 'Rohan Chudal', 'rohan@gmail.com', '$2y$10$KfzKuUOmDuPqPFpDxdjk7.H06yMby4AiBWfSq4ilrWzfiE96f2ypS', '9823423452', '2023-12-18 15:02:35'),
(10, 'Rajiv Silwal', 'rajiv@gmail.com', '$2y$10$wNpOzUljaWvf4IyJQqJ27Oqs5YgZJvCgxIKiIWXacW/7rOJG1L4jW', '9823423452', '2023-12-18 15:10:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_reset_tokens`
--

CREATE TABLE `admin_password_reset_tokens` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `expiry_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `customer_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `quantity`, `customer_id`) VALUES
(121, 41, 1, 46),
(123, 40, 1, 46),
(128, 61, 1, 46);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `reset_password_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fullname`, `email`, `password`, `phone`, `created_at`, `reset_password_status`) VALUES
(46, 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', '$2y$10$8yG0YgOWEFLG2QsfQy.OsuiMa61jj2X34qsq/ZGruDJ8csMAlwK7m', '9823423452', '2023-11-26 16:48:49', 0),
(47, 'Rohan Chudal', 'rohan123@gmail.com', '$2y$10$hOsmW.zKo93nAwi/6YKIQevgN2GBd0sqFXRX1xraO4IlohSDIpPfe', '9823423452', '2023-12-18 14:51:12', 0),
(48, 'Saneel Karmacharya', 'saneel@gmail.com', '$2y$10$JvCaMxBhEplFSnKUz4UtKOo4nVqc96KcaZhJL.53HpDz0EDmybKS2', '9823423452', '2023-12-18 15:03:54', 0),
(49, 'Rajiv Silwal', 'rajiv@gmail.com', '$2y$10$2Oge9cLRDnORqFzx8wVjUegFcde4QWnTt4RTUt0Mbr7XGT5qC1WTu', '9823423452', '2023-12-21 11:35:01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `message_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `fullname`, `email`, `message`, `message_date`) VALUES
(9, 'Saneel Karmacharya', 'xyz@gmail.com', 'Hi Im saneel.Nice to meet you!', '2023-11-27'),
(11, 'Rajiv Silwal', 'saneel@gmail.com', 'hey hey', '2023-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `product_id`, `total_price`, `product_name`, `customer_name`, `email`, `address`, `payment`, `status`, `order_date`) VALUES
(330, 46, 65, 42000, 'VelocityTech Hoodie', 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 'duwakot,Kathmandu', 'COD', 'Pending', '2023-12-20 12:09:00'),
(331, 46, 73, 42000, 'White Gathered Mini Dress', 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 'duwakot,Kathmandu', 'COD', 'Pending', '2023-12-20 12:09:00'),
(332, 46, 74, 35000, 'Long Sleeve Pocket Shirt', 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 'duwakot,Kathmandu', 'COD', 'Pending', '2023-12-20 12:09:00'),
(333, 46, 63, 191968, 'ArcticShield Jacket', 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 'duwakot,Kathmandu', 'COD', 'Order Sucessful', '2023-12-21 11:20:51'),
(334, 46, 65, 54000, 'VelocityTech Hoodie', 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 'duwakot,Kathmandu', 'COD', 'Pending', '2023-12-21 14:31:41'),
(335, 46, 65, 300000, 'VelocityTech Hoodie', 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 'duwakot,Kathmandu', 'COD', 'Order Sucessful', '2023-12-21 16:01:39'),
(336, 46, 67, 59990, 'SerenitySilk Wrap Dress', 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 'duwakot,Kathmandu', 'COD', 'Order Sucessful', '2023-12-21 16:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `expiry_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(10) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `img_main` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `category`, `price`, `quantity`, `img_main`, `description`, `created_at`, `admin_id`) VALUES
(63, 'ArcticShield Jacket', 'Men', 5999, 20, 'product_6583db999b683_1703140249.png', 'Embrace the chill with our ArcticShield Jacket. This insulated, weather-resistant outerwear ensures you stay warm and stylish in the coldest climates. Adventure awaits, and this jacket is your ultimate companion.', '2023-12-18 08:01:06', 7),
(65, 'VelocityTech Hoodie', 'Men', 6000, 12, 'hoodie.png', 'Unleash the power of performance with our VelocityTech Hoodie. Engineered for comfort and style, this hoodie seamlessly blends technology and fashion. Elevate your active lifestyle with a touch of urban flair.', '2023-12-18 08:11:02', 7),
(66, 'LushLayer Cardigan', 'Women', 5000, 10, 'women1.png', ' Wrap yourself in coziness with the LushLayer Cardigan. This versatile layering piece combines warmth with timeless style.', '2023-12-18 08:15:09', 7),
(67, 'SerenitySilk Wrap Dress', 'Women', 5999, 5, 'Women5.png', ' Embrace elegance with the SerenitySilk Wrap Dress. Luxuriously soft and effortlessly chic, this dress is perfect for any occasion. Wrap yourself in sophistication and grace.', '2023-12-18 08:18:41', 7),
(68, 'RadianceFlare Jumpsuit', 'Women', 5999, 10, 'women7.png', 'lluminate any room with the RadianceFlare Jumpsuit. A perfect blend of glamour and comfort, this jumpsuit is a statement piece for the modern woman. Shine bright, wherever the day takes you.', '2023-12-18 08:27:33', 7),
(69, 'HarborFlex Cargo Pants', 'Men', 5000, 12, 'pant.png', 'Navigate your day with ease in our HarborFlex Cargo Pants. Designed for the modern man on the move, these pants offer comfort, durability, and a touch of utilitarian style.', '2023-12-18 08:41:23', 7),
(73, 'White Gathered Mini Dress', 'Women', 6000, 7, 'women9.png', 'Cut from our crisp white cotton, it has a pretty gathering to the bust in a sweetheart design, extending down to the elasticated waistline that nips in for the perfect silhouette.', '2023-12-19 06:01:13', 7),
(74, 'Long Sleeve Pocket Shirt', 'Men', 5000, 6, 'menshirt.png', 'The Long Sleeve Pocket Shirt is a versatile and comfortable wardrobe essential. ', '2023-12-19 06:14:49', 7);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_details`
--

CREATE TABLE `shipping_details` (
  `shipping_id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(10) NOT NULL,
  `address` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_details`
--

INSERT INTO `shipping_details` (`shipping_id`, `fullname`, `email`, `phone`, `address`, `zip`, `customer_id`) VALUES
(58, 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 2147483647, 'duwakot,Kathmandu', '10', 46),
(59, 'Ganesh Basnet', 'praswishbasnet1011@gmail.com', 2147483647, 'duwakot,bhaktapur', '10', 46),
(60, 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 2147483647, 'duwakot,bhaktapur', '10', 46),
(61, 'Saneel Karmacharya', 'saneel@gmail.com', 2147483647, 'Tinkune,Kathmandu', '10', 48),
(62, 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 2147483647, 'Tinkune,bhaktapur', '10', 46),
(63, 'Rohan Chudel', 'rohan1221@gmail.com', 2147483647, 'Baneshowor,Kathmandu', '11', 46),
(64, 'Ganesh Basnet', 'basnetganesh371@gmail.com', 2147483647, 'Tinkune,bhaktapur', '11', 46),
(65, 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 2147483647, 'Baneshowor,bhaktapur', '112', 46),
(66, 'Ganesh Basnet', 'praswishbasnet1011@gmail.com', 2147483647, 'duwakot,bhaktapur', '10', 46),
(67, 'Ganesh Basnet', 'ganeshbasnet881@icloud.com', 2147483647, 'Tinkune,Kathmandu', '11', 46),
(68, 'Saneel Karmacharya', 'saneel@gmail.com', 2147483647, 'Baneshowor,Kathmandu', '112', 46);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `admin_password_reset_tokens`
--
ALTER TABLE `admin_password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin_password_reset_tokens_admins` (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_ibfk_1` (`customer_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_ibfk_1` (`customer_id`),
  ADD KEY `orders_ibfk_2` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_ibfk_1` (`admin_id`);

--
-- Indexes for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD PRIMARY KEY (`shipping_id`),
  ADD KEY `shipping_details_ibfk_1` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `admin_password_reset_tokens`
--
ALTER TABLE `admin_password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `shipping_details`
--
ALTER TABLE `shipping_details`
  MODIFY `shipping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_password_reset_tokens`
--
ALTER TABLE `admin_password_reset_tokens`
  ADD CONSTRAINT `fk_admin_password_reset_tokens_admins` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_details`
--
ALTER TABLE `shipping_details`
  ADD CONSTRAINT `shipping_details_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
