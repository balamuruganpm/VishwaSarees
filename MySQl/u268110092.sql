-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 06:15 PM
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
-- Database: `u268110092_yuginii`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_data` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `cart_data`) VALUES
(4, 1, '[{\"id\":\"1\",\"quantity\":1},{\"id\":\"2\",\"quantity\":1}]');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_id` int(11) NOT NULL,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `Price` int(11) NOT NULL,
  `w_data` text NOT NULL,
  `discount_p` int(11) NOT NULL,
  `Img_filename1` text NOT NULL,
  `Img_filename2` text NOT NULL,
  `Img_filename3` text NOT NULL,
  `Img_filename4` text NOT NULL,
  `Img_filename5` text NOT NULL,
  `Img_filename6` text NOT NULL,
  `Category` varchar(30) NOT NULL,
  `Availability` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_id`, `Name`, `Description`, `Price`, `w_data`, `discount_p`, `Img_filename1`, `Img_filename2`, `Img_filename3`, `Img_filename4`, `Img_filename5`, `Img_filename6`, `Category`, `Availability`) VALUES
(28, 'Rani Pink Mirrorwork Georgette Saree', '{\"Brand\":\"Georgette Saree\",\"Color\":\"Pink\",\"Description\":\"- Rani Pink Saree in Georgette fabric - The Saree is elevated with Mirrorwork embroidery - It comes with an Unstitched blouse - Comes with the Koskii promise of premium quality\",\"Size\":\"Saree: 5.5 Mtrs; Blouse: 0.80 Mtrs \",\"Material\":\"Georgette\",\"Wash Care\":\"Dry Wash Only\"}', 4792, '', 20, 'Women/Rani Pink Mirrorwork Georgette Saree/1.png', 'Women/Rani Pink Mirrorwork Georgette Saree/2.png', 'Women/Rani Pink Mirrorwork Georgette Saree/3.png', 'Women/Rani Pink Mirrorwork Georgette Saree/4.png', 'Women/Rani Pink Mirrorwork Georgette Saree/5.png', 'Women/Rani Pink Mirrorwork Georgette Saree/6.png', 'Women', 'Available'),
(29, 'Lavender Gotapatti Organza Saree', '{\"Brand\":\"\",\"Color\":\"Lavender \",\"Description\":\"- Lavender Saree in Organza fabric - The Saree is elevated with Gotapatti embroidery - It comes with an Unstitched blouse - Comes with the Koskii promise of premium quality\",\"Material\":\"Organza\",\"Wash Care\":\"Dry Wash Only \",\"Size\":\"Saree: 5.5 Mtrs; Blouse: 0.80 Mtrs \"}', 4490, '', 10, 'Women/Lavender Gotapatti Organza Saree/1.png', 'Women/Lavender Gotapatti Organza Saree/2.png', 'Women/Lavender Gotapatti Organza Saree/3.png', 'Women/Lavender Gotapatti Organza Saree/4.png', 'Women/Lavender Gotapatti Organza Saree/5.png', 'Women/Lavender Gotapatti Organza Saree/6.png', 'Women', 'Available'),
(30, 'Pista Green Threadwork Net Designer Saree', '{\"Brand\":\"Threadwork \",\"Size\":\"Saree: 5.5 Mtrs; Blouse: 0.80 Mtrs\",\"Wash Care\":\"Dry Wash Only\",\"Description\":\"- Pista green saree in net fabric - Embellished with threadwork embroidery - Accompanied with a matching unstitched blouse - The blouse worn by the model is for styling purpose only - Comes with the koskii promise of superior quality\",\"Color\":\"Pista Green\"}', 4490, '', 16, 'Women/Pista Green Threadwork Net Designer Saree/1.png', 'Women/Pista Green Threadwork Net Designer Saree/2.png', 'Women/Pista Green Threadwork Net Designer Saree/3.png', 'Women/Pista Green Threadwork Net Designer Saree/4.png', 'Women/Pista Green Threadwork Net Designer Saree/5.png', 'Women/Pista Green Threadwork Net Designer Saree/6.png', 'Women', 'Available'),
(31, 'Yellow Threadwork Chiffon Saree', '{\"Brand\":\"Chiffon \",\"Size\":\"Saree: 5.5 Mtrs; Blouse: 0.80 Mtrs\",\"Description\":\"- Yellow Saree in Chiffon fabric - The Saree is elevated with Threadwork embroidery - It comes with an Unstitched blouse - Comes with the Koskii promise of premium quality\",\"Material\":\"Chiffon\",\"Color\":\"Yellow\",\"Wash Care\":\"Dry Wash Only\"}', 5789, '', 7, 'Women/Yellow Threadwork Chiffon Saree/1.png', 'Women/Yellow Threadwork Chiffon Saree/2.png', 'Women/Yellow Threadwork Chiffon Saree/3.png', 'Women/Yellow Threadwork Chiffon Saree/4.png', 'Women/Yellow Threadwork Chiffon Saree/5.png', 'Women/Yellow Threadwork Chiffon Saree/6.png', 'Women', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `status`) VALUES
(1, 'haji', '9047178789', '123', ''),
(2, 'bala', '9677804820', 'bala', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
