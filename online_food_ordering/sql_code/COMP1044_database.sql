-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2024 at 06:02 PM
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
-- Database: `food_ordering`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_password`) VALUES
(1002, 'mysecretpassword'),
(1000, 'password123'),
(1001, 'securepass');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `delivery_address` varchar(150) NOT NULL,
  `contact_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`delivery_address`, `contact_number`) VALUES
('123 Main St, Cityville', 123456789),
('456 Elm St, Townsville', 987654321),
('789 Oak St, Villagetown', 555123456);

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `delivery_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `delivery_address` varchar(150) NOT NULL,
  `order_status` text NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`delivery_id`, `order_id`, `driver_id`, `delivery_address`, `order_status`, `delivery_date`) VALUES
(300, 200, 3001, '123 Main St, Cityville', 'Delivered', '2024-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `driver_details`
--

CREATE TABLE `driver_details` (
  `driver_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_name` text NOT NULL,
  `contact_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_details`
--

INSERT INTO `driver_details` (`driver_id`, `vehicle_id`, `driver_name`, `contact_number`) VALUES
(3001, 101, 'John Smith', 193456789),
(3002, 102, 'Jane Doe', 11020304),
(3003, 103, 'Bob Johnson', 12203040);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `food_id` int(11) NOT NULL,
  `food_image` varchar(255) NOT NULL,
  `food_name` text NOT NULL,
  `food_description` text DEFAULT NULL,
  `food_price` int(11) NOT NULL,
  `food_availibility` int(11) DEFAULT NULL,
  `food_categories` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`food_id`, `food_image`, `food_name`, `food_description`, `food_price`, `food_availibility`, `food_categories`) VALUES
(1, 'fried jalapenos and onions.jpg', 'Fried Jalapenos and Onions', 'yummy', 10, 1, 'Ala Carte'),
(2, 'hamburquesa mexicana.jpg', 'Hamburquesa Mexicana', 'abc', 12, 1, 'Platillos Mexicanos'),
(3, 'shrimp taco.jpg', 'Shrimp Tacos', 'asd', 15, 1, 'Platillos Mexicanos'),
(4, 'taco salad.jpg', 'Taco Salad', 'adf', 18, 1, 'Salads'),
(5, 'cheese nacos.jpg', 'Cheese Nacos', 'asdf', 18, 1, 'Appetizer');

-- --------------------------------------------------------

--
-- Table structure for table `order_menu`
--

CREATE TABLE `order_menu` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_name` text NOT NULL,
  `food_image` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `quantity_ordered` int(11) DEFAULT NULL,
  `food_price` int(11) NOT NULL,
  `delivery_option` bit(1) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `payment_method` text NOT NULL,
  `payment_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_menu`
--

INSERT INTO `order_menu` (`order_id`, `customer_id`, `worker_id`, `food_id`, `food_name`, `food_image`, `order_date`, `quantity_ordered`, `food_price`, `delivery_option`, `payment_date`, `payment_method`, `payment_status`) VALUES
(200, 1000, 2000, 1, 'Fried Jalapenos and Onions', 'fried jalapenos and onions.jpg', '2024-03-26', 2, 20, b'1', '2024-03-26', 'Credit Card', 'Paid'),
(201, 1001, 2002, 2, 'Hamburquesa Mexicana', 'hamburquesa mexicana.jpg', '2024-03-27', 1, 12, b'0', '2024-03-27', 'Cash', 'Paid'),
(202, 1002, 2000, 3, 'Shrimp Tacos', 'shrimp tacos.jpg', '2024-03-28', 3, 15, b'0', '2024-03-28', 'QR Payment', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_type` text NOT NULL,
  `vehicle_colour` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_type`, `vehicle_colour`) VALUES
(101, 'Car', 'Red'),
(102, 'Van', 'White'),
(103, 'Motorcycle', 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `worker`
--

CREATE TABLE `worker` (
  `worker_id` int(11) NOT NULL,
  `worker_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worker`
--

INSERT INTO `worker` (`worker_id`, `worker_password`) VALUES
(2001, 'strongpassword'),
(2002, 'workerpass'),
(2000, 'workerpass123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_password` (`customer_password`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`delivery_address`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`delivery_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `delivery_address` (`delivery_address`);

--
-- Indexes for table `driver_details`
--
ALTER TABLE `driver_details`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `order_menu`
--
ALTER TABLE `order_menu`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `worker_id` (`worker_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`worker_id`),
  ADD UNIQUE KEY `worker_password` (`worker_password`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `driver_details`
--
ALTER TABLE `driver_details`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3004;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_menu`
--
ALTER TABLE `order_menu`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `worker`
--
ALTER TABLE `worker`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2003;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_menu` (`order_id`),
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver_details` (`driver_id`),
  ADD CONSTRAINT `deliveries_ibfk_3` FOREIGN KEY (`delivery_address`) REFERENCES `customer_details` (`delivery_address`);

--
-- Constraints for table `driver_details`
--
ALTER TABLE `driver_details`
  ADD CONSTRAINT `driver_details_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicle` (`vehicle_id`);

--
-- Constraints for table `order_menu`
--
ALTER TABLE `order_menu`
  ADD CONSTRAINT `order_menu_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `order_menu_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `worker` (`worker_id`),
  ADD CONSTRAINT `order_menu_ibfk_3` FOREIGN KEY (`food_id`) REFERENCES `menu_item` (`food_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
