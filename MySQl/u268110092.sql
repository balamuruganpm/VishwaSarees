-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 12:46 PM
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
  `order_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `product_ids` text NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `address`, `contact`, `payment_method`, `total_amount`, `product_ids`, `status`, `created_at`) VALUES
(1, 'krishna', 'Incrocio Antonio 3, Piersilvio veneto, MB 37340', '6798679679', '0', 3771.60, '[\"30\"]', 'pending', '2025-02-10 09:25:06'),
(2, 'bala', '3815, Shingleton Road', '89875651132', '0', 3861.40, '[\"29\",\"30\",\"31\"]', 'pending', '2025-02-10 09:49:52'),
(3, 'deva', '3 hoog Roselinepark 821b, Marbusdam, VA 5060 FT', '456452434', '0', 13016.77, '[\"29\",\"30\",\"31\",\"48\"]', 'pending', '2025-02-10 10:27:52'),
(4, 'sridhar', 'sidhar kovil, bustop, salem', '8464564', '0', 5383.77, '[\"31\",\"40\"]', 'pending', '2025-02-10 11:20:08'),
(5, 'bala', 'zssxvgh', '9876543213', '0', 9245.17, '[\"29\",\"31\",\"38\",\"35\",\"41\"]', 'pending', '2025-02-21 10:21:29'),
(6, 'sxghjnk', 'rdtygik,l;', '9875342325', '0', 13016.77, '[\"29\",\"30\",\"31\",\"46\"]', 'pending', '2025-02-21 10:21:53'),
(7, 'rffeggreg', 'edfrgseggr', '96735524254', '0', 3861.40, '[\"29\",\"35\"]', 'pending', '2025-02-21 11:16:30'),
(8, 'dvd', 'dsvsd', '322564y', '0', 3771.60, '[\"30\",\"38\",\"35\"]', 'pending', '2025-02-21 11:44:06');

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
(29, 'Lavender Gotapatti Organza Saree', '{\"Brand\":\"\",\"Color\":\"Lavender \",\"Description\":\"- Lavender Saree in Organza fabric - The Saree is elevated with Gotapatti embroidery - It comes with an Unstitched blouse - Comes with the Koskii promise of premium quality\",\"Material\":\"Organza\",\"Wash Care\":\"Dry Wash Only \",\"Size\":\"Saree: 5.5 Mtrs; Blouse: 0.80 Mtrs \"}', 4490, '{\"min_product\":0,\"min_price\":0,\"price_ranges\":[],\"max_price\":0}', 14, 'Women/Lavender Gotapatti Organza Saree/1.png', 'Women/Lavender Gotapatti Organza Saree/2.png', 'Women/Lavender Gotapatti Organza Saree/3.png', 'Women/Lavender Gotapatti Organza Saree/4.png', 'Women/Lavender Gotapatti Organza Saree/5.png', 'Women/Lavender Gotapatti Organza Saree/6.png', 'Women', 'Available'),
(30, 'Pista Green Threadwork Net Designer Saree', '{\"Brand\":\"Threadwork \",\"Size\":\"Saree: 5.5 Mtrs; Blouse: 0.80 Mtrs\",\"Wash Care\":\"Dry Wash Only\",\"Description\":\"- Pista green saree in net fabric - Embellished with threadwork embroidery - Accompanied with a matching unstitched blouse - The blouse worn by the model is for styling purpose only - Comes with the koskii promise of superior quality\",\"Color\":\"Pista Green\"}', 4490, '', 16, 'Women/Pista Green Threadwork Net Designer Saree/1.png', 'Women/Pista Green Threadwork Net Designer Saree/2.png', 'Women/Pista Green Threadwork Net Designer Saree/3.png', 'Women/Pista Green Threadwork Net Designer Saree/4.png', 'Women/Pista Green Threadwork Net Designer Saree/5.png', 'Women/Pista Green Threadwork Net Designer Saree/6.png', 'Women', 'Available'),
(31, 'Yellow Threadwork Chiffon Saree', '{\"Brand\":\"Chiffon \",\"Size\":\"Saree: 5.5 Mtrs; Blouse: 0.80 Mtrs\",\"Description\":\"- Yellow Saree in Chiffon fabric - The Saree is elevated with Threadwork embroidery - It comes with an Unstitched blouse - Comes with the Koskii promise of premium quality\",\"Material\":\"Chiffon\",\"Color\":\"Yellow\",\"Wash Care\":\"Dry Wash Only\"}', 5789, '', 7, 'Women/Yellow Threadwork Chiffon Saree/1.png', 'Women/Yellow Threadwork Chiffon Saree/2.png', 'Women/Yellow Threadwork Chiffon Saree/3.png', 'Women/Yellow Threadwork Chiffon Saree/4.png', 'Women/Yellow Threadwork Chiffon Saree/5.png', 'Women/Yellow Threadwork Chiffon Saree/6.png', 'Women', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `product_ids` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_name`, `contact`, `address`, `payment_method`, `total_amount`, `product_ids`, `order_date`) VALUES
(1, 'Ravi Kumar', '9876543210', 'No. 45, Kamaraj Street, Velachery, Chennai - 600042, Tamil Nadu', 'Credit Card', 1200.50, '31', '2025-02-10 10:15:30'),
(2, 'Priya Ramesh', '9087654321', 'Flat 12B, Tower 5, Sun City Apartments, OMR, Chennai - 600100, Tamil Nadu', 'Debit Card', 850.75, '32', '2025-02-10 11:30:25'),
(3, 'Suresh Babu', '9448321550', 'No. 78, Bharathi Nagar, Coimbatore - 641035, Tamil Nadu', 'Cash on Delivery', 500.00, '33', '2025-02-09 15:45:10'),
(4, 'Anjali Devi', '9898765432', 'No. 5, Pudur Road, Trichy - 620015, Tamil Nadu', 'Net Banking', 2150.90, '34', '2025-02-08 12:20:40'),
(5, 'Karthik Rajan', '9944556677', '123, Gandhi Street, Madurai - 625020, Tamil Nadu', 'UPI', 950.60, '35', '2025-02-07 18:05:55'),
(6, 'Vidhya Krishnan', '9765432109', 'No. 12, Anna Nagar, Erode - 638001, Tamil Nadu', 'Credit Card', 3200.00, '36', '2025-02-06 09:10:30'),
(7, 'Bharath Kumar', '9888765432', 'No. 17, Nehru Street, Tirunelveli - 627001, Tamil Nadu', 'Debit Card', 1500.25, '37', '2025-02-06 11:50:15'),
(8, 'Meera Sharma', '9876549876', 'No. 22, Ranganathan Street, Salem - 636001, Tamil Nadu', 'Cash on Delivery', 1250.80, '38', '2025-02-05 14:40:05'),
(9, 'Kavitha Srinivasan', '9865323456', 'No. 9, Subramaniam Street, Karaikal - 609602, Tamil Nadu', 'Credit Card', 2700.90, '39', '2025-02-05 16:30:40'),
(10, 'Arun Prakash', '9098764321', 'No. 63, MGR Road, Taramani, Chennai - 600113, Tamil Nadu', 'Net Banking', 2000.60, '40', '2025-02-04 10:20:35'),
(11, 'Anita Sundaram', '9456784321', 'No. 12, Sundar Nagar, Kanchipuram - 631502, Tamil Nadu', 'UPI', 950.75, '41', '2025-02-03 12:05:50'),
(12, 'Ramesh Kumar', '9867543210', 'No. 34, Kannagi Nagar, Trichy - 620016, Tamil Nadu', 'Debit Card', 1850.40, '42', '2025-02-02 13:50:10'),
(13, 'Latha Lakshman', '9487654321', 'No. 88, Ramesh Nagar, Pollachi - 642002, Tamil Nadu', 'Cash on Delivery', 1500.75, '43', '2025-02-02 14:30:25'),
(14, 'Murugan Raj', '9123456789', 'No. 25, Station Road, Kumbakonam - 612001, Tamil Nadu', 'Credit Card', 1800.60, '44', '2025-02-01 11:05:40'),
(15, 'Gokulakrishnan', '9198765432', 'No. 15, Chidambaram Street, Puducherry - 605001, Tamil Nadu', 'Debit Card', 1100.90, '45', '2025-02-01 10:25:35'),
(16, 'Aishwarya Ravi', '9308765432', 'No. 40, Palani Road, Dindigul - 624001, Tamil Nadu', 'Cash on Delivery', 1100.10, '46', '2025-01-31 15:40:50'),
(17, 'Sakthivel J', '9876123456', 'No. 11, Nandhi Kovil Street, Virudhunagar - 626001, Tamil Nadu', 'Net Banking', 1750.25, '47', '2025-01-30 13:15:10'),
(18, 'Nisha Kumar', '9675432109', 'No. 17, Tidel Park Road, Coimbatore - 641023, Tamil Nadu', 'UPI', 1300.40, '48', '2025-01-29 11:50:25'),
(19, 'Raghavan V', '9789345678', 'No. 9, Thiruvalluvar Nagar, Vellore - 632002, Tamil Nadu', 'Debit Card', 1950.80, '49', '2025-01-28 10:35:45'),
(20, 'Shruti Narayanan', '9023456789', 'No. 33, Kamaraj Nagar, Tirupur - 641604, Tamil Nadu', 'Credit Card', 2200.60, '50', '2025-01-28 12:20:30'),
(21, 'Bala', '9876543210', 'No. 45, Kamaraj Street, Velachery, Chennai - 600042, Tamil Nadu', 'Credit Card', 1200.50, '31', '2025-02-10 10:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `password`, `created_at`) VALUES
(1, 'John Doe', '1234567890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-02-10 07:46:50'),
(2, 'Jane Smith', '9876543210', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2025-02-10 07:46:50');

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
  ADD PRIMARY KEY (`order_id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `session_token` (`session_token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `Product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
