-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 08:19 PM
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
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `payment_method` enum('cod','upi') NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `product_ids` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `address`, `contact`, `payment_method`, `total_amount`, `product_ids`, `status`) VALUES
(1, 'Test Name', 'Test Address', '1234567890', 'cod', 100.00, '[\"29\", \"28\"]', 'Delivered'),
(2, 'Test Name', 'Test Address', '1234567890', 'cod', 100.00, '[\"30\", \"28\"]', 'Pending'),
(3, 'Balamurugan P M', '2/109, Kombukaran Kadu, Murungapatti, Salem - 636307', '09677804820', 'cod', 5383.77, '[\"31\", \"29\"]', 'Pending'),
(4, 'Hareeswar', '56 North Old Avenue\nAliquam et amet nis', '07010375329', 'upi', 5383.77, '[\"28\", \"30\"]', 'Pending'),
(5, 'Hareeswar', '390-7 Mettu Patti Thathanur Vellaiya Gounder Kadu Salem\n390-7 மேட்டுப்பட்டி தத்தனூர் வெள்ளையா கவுண்டர் காடு, சேலம்', '07010375329', 'cod', 5383.77, '[\"30\", \"28\"]', 'Pending'),
(6, 'Hareeswar', '390-7 Mettu Patti Thathanur Vellaiya Gounder Kadu Salem\n390-7 மேட்டுப்பட்டி தத்தனூர் வெள்ளையா கவுண்டர் காடு, சேலம்', '07010375329', '', 7874.60, '[\"29\", \"31\"]', 'Pending');

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

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 30, 1, NULL),
(2, 2, 28, 1, NULL),
(3, 2, 29, 1, NULL),
(4, 2, 30, 1, NULL),
(5, 3, 28, 1, NULL),
(6, 3, 29, 1, NULL),
(7, 3, 30, 1, NULL),
(8, 4, 28, 1, NULL),
(9, 4, 29, 1, NULL),
(10, 4, 30, 1, NULL);

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
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `product_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`product_ids`)),
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_name`, `contact`, `address`, `payment_method`, `total_amount`, `product_ids`, `order_date`) VALUES
(1, 'John Doe', '9876543210', '123 Main Street, Coimbatore', 'Cash on Delivery', 1500.00, '[1, 2, 3]', '2025-01-01 04:30:00'),
(2, 'Alice Smith', '9123456789', '456 Oak Avenue, Coimbatore', 'UPI', 2500.00, '[4, 5, 6]', '2025-01-02 05:45:00'),
(3, 'Bob Johnson', '9334567890', '789 Pine Road, Coimbatore', 'Cash on Delivery', 3000.00, '[7, 8, 9]', '2025-01-03 07:00:00'),
(4, 'Carol White', '9012345678', '101 Maple Lane, Coimbatore', 'UPI', 1200.00, '[10, 11, 12]', '2025-01-04 08:15:00'),
(5, 'David Brown', '9234567891', '202 Birch Street, Coimbatore', 'UPI', 2200.00, '[13, 14, 15]', '2025-01-05 08:30:00'),
(6, 'Eve Green', '9345678901', '303 Cedar Boulevard, Coimbatore', 'Cash on Delivery', 1800.00, '[16, 17, 18]', '2025-01-06 09:30:00'),
(7, 'Frank Black', '9456789012', '404 Willow Place, Coimbatore', 'Cash on Delivery', 1600.00, '[19, 20, 21]', '2025-01-07 11:00:00'),
(8, 'Grace Adams', '9567890123', '505 Elm Avenue, Coimbatore', 'UPI', 2700.00, '[22, 23, 24]', '2025-01-08 11:45:00'),
(9, 'Hank Taylor', '9678901234', '606 Fir Street, Coimbatore', 'Cash on Delivery', 2100.00, '[25, 26, 27]', '2025-01-09 12:30:00'),
(10, 'Ivy King', '9789012345', '707 Cedar Drive, Coimbatore', 'UPI', 2400.00, '[28, 29, 30]', '2025-01-10 14:00:00'),
(11, 'Jack Lee', '9890123456', '808 Pine Avenue, Coimbatore', 'UPI', 1900.00, '[31, 32, 33]', '2025-01-11 14:30:00'),
(12, 'Kara Clark', '9901234567', '909 Oak Road, Coimbatore', 'Cash on Delivery', 1700.00, '[34, 35, 36]', '2025-01-12 15:45:00'),
(13, 'Leo Harris', '9012345679', '1010 Maple Street, Coimbatore', 'UPI', 2800.00, '[37, 38, 39]', '2025-01-13 16:30:00'),
(14, 'Mona Hall', '9123456780', '1111 Birch Road, Coimbatore', 'UPI', 2500.00, '[40, 41, 42]', '2025-01-14 18:00:00'),
(15, 'Nina Scott', '9234567893', '1212 Cedar Lane, Coimbatore', 'Cash on Delivery', 2300.00, '[43, 44, 45]', '2025-01-14 19:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `login_token` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `status`, `login_token`) VALUES
(1, 'haji', '9047178789', '123', '', NULL),
(2, 'bala', '9677804820', 'bala', '', NULL),
(3, 'krishna', '9677804820', '1234', '', NULL);

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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
