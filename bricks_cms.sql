-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2022 at 11:58 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bricks_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL COMMENT '1=Bricks, 2=Picket',
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=Ac, 1=InAc',
  `stock_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `quantity`, `price`, `status`, `stock_date`) VALUES
(1, 1, 100000, 8, 1, '2022-05-07'),
(2, 2, 140000, 13, 1, '2022-05-08'),
(3, 1, 90000, 10, 1, '2022-05-08'),
(4, 2, 160000, 12, 1, '2022-05-30'),
(5, 2, 15000, 13, 1, '2022-05-31'),
(6, 2, 40000, 13, 1, '2022-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0 = Inactive, 1 =Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `product_name`, `status`) VALUES
(1, 'Bricks', 1),
(2, 'Picket', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr_materials`
--

CREATE TABLE `pr_materials` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL DEFAULT 1,
  `p_date` date NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pr_materials`
--

INSERT INTO `pr_materials` (`id`, `item_name`, `quantity`, `unit_id`, `unit_price`, `p_date`, `note`) VALUES
(1, 'Soil', '15', 4, 20000, '2022-05-07', ''),
(2, 'Gravel', '20', 4, 900, '2022-05-07', ''),
(3, 'Oil', '25', 1, 68, '2022-05-07', ''),
(4, 'Coal', '35', 3, 3500, '2022-05-07', ''),
(5, 'Oil', '25', 1, 75, '2022-05-07', ''),
(6, 'Soil', '30', 4, 1100, '2022-05-07', ''),
(7, 'Oil', '35', 1, 90, '2022-05-07', ''),
(8, 'Coal', '10', 3, 50, '2022-05-30', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `sells_info`
--

CREATE TABLE `sells_info` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `selling_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sells_info`
--

INSERT INTO `sells_info` (`id`, `name`, `phone`, `email`, `address`, `product_id`, `quantity`, `price`, `selling_date`) VALUES
(1, 'Shafiq', '01723456437', 'shafiq@gmail.com', 'Khilkhet,Dhaka', 2, 10000, 8, '2022-05-29'),
(2, 'Zamil', '01898675466', 'zamil@gmail.com', 'Mirpur-10', 1, 20000, 9, '2022-05-12'),
(3, 'sarrick', '01318768532', 'sarrick2022@gmail.com', 'Uttara,Dhaka', 2, 40000, 0, '2022-05-29'),
(4, 'Taijul Islam', '01723896767', 'taijul@gmail.com', 'Nikunja 2, Dhaka', 1, 13000, 9, '2022-05-30'),
(5, 'Tanvir mita', '01723896767', 'tanvir@gmail.com', 'Nikunja 2, Dhaka', 2, 50000, 13, '2022-05-31'),
(6, 'Hira', '01318768532', 'hira@gmail.com', 'Nikunja 2, Dhaka', 1, 35000, 9, '2022-06-01'),
(7, 'Zamil', '01723896767', 'zamil@gmail.com', 'Nikunja 2, Dhaka', 1, 55000, 9, '2022-06-01'),
(8, 'Thaher Islam', '01737002681', 'thaher@gmail.com', 'Uttara,Dhaka', 1, 45000, 9, '2022-06-03');

-- --------------------------------------------------------

--
-- Table structure for table `unit_type`
--

CREATE TABLE `unit_type` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=Inactive, 1=Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_type`
--

INSERT INTO `unit_type` (`id`, `unit_name`, `status`) VALUES
(1, 'Litter', 1),
(2, 'Ton', 0),
(3, 'Ton', 1),
(4, 'CFt', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `phone` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT 2 COMMENT '0=SA, 1=ACC, 2=CM',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=inactive, 1=active',
  `j_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`, `phone`, `address`, `image`, `role`, `status`, `j_date`) VALUES
(1, 'Md. Rahim', 'rahim@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '', '01734546567', 'Mirpur-10', '1024688-me.jpg', 2, 1, '0000-00-00'),
(2, 'Md. Rakib', 'rakib@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '01645890712', 'Banani,Dhaka', NULL, 2, 1, '0000-00-00'),
(3, 'Shafiq Islam', 'shafiq@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '01998563488', 'Mirpur-2', NULL, 2, 1, '0000-00-00'),
(4, 'Mrs.Taniya', 'taniya@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '4dba7059ff059ff8944609115d408d', '01774356799', 'Badda, Dhaka', NULL, 2, 1, '0000-00-00'),
(5, 'Sabbir', 'sabbir@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '01318768532', 'Uttara-9,Dhaka', NULL, 2, 1, '0000-00-00'),
(6, 'Zamil Ahmed', 'zamil@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '01577565566', 'Banani, Dhaka', NULL, 2, 1, '0000-00-00'),
(7, 'Ehsan Mahmud', 'ehsan@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '4dba7059ff059ff8944609115d408d', '01465779032', 'Saver, Dhaka', NULL, 2, 1, '0000-00-00'),
(8, 'Yusuf Ahmed', 'yusuf@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '4dba7059ff059ff8944609115d408d', '01782438707', 'Banani, Dhaka', NULL, 2, 1, '0000-00-00'),
(9, 'Ashik', 'ashik@hmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '4dba7059ff059ff8944609115d408d', '01745604759', 'Mohakhali, Dhaka', NULL, 2, 1, '0000-00-00'),
(10, 'Sohag', 'sohag2021@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '4dba7059ff059ff8944609115d408d', '01676456456', 'Uttara-11,Dhaka', NULL, 2, 1, '0000-00-00'),
(11, 'Saiful Islam', 'saifur@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '4dba7059ff059ff8944609115d408d', '01923454565', 'Uttara-7, shaka', NULL, 2, 1, '0000-00-00'),
(12, 'Firoz Kabir', 'firoz10@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc', '', '01311768535', 'Nikunja 2, Dhaka', NULL, 2, 1, '0000-00-00'),
(13, 'Md. Shaown', 'shaown12345@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '01728895656', 'Nikunja 2, Dhaka', NULL, 1, 0, '2022-04-30'),
(14, 'Akib Ahmed', 'akib2022@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '01345897876', 'Gulshan, Dhaka', NULL, 0, 1, '0000-00-00'),
(15, 'Sarrick', 'sarrick2021@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '94a897281d8d1f44fdf6023ace4aa9', '01961028434', 'Mirpur-1', NULL, 2, 0, '0000-00-00'),
(32, 'Taijul Islam', 'taijul@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '', '01737002444', 'Khilkhet,Dhaka', '4872983-ariful.jpg', 1, 0, '2022-05-31'),
(33, 'Khusi', 'khusi@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'da366039881da69186aedc49ecc5e9', '01765454449', 'Shamolly,Dhaka', NULL, 2, 0, '2022-05-31'),
(42, 'Taniya', 'sarrick2022@gmail.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 'e535c90abdbd2c14cc11c228372e8b', NULL, NULL, NULL, 2, 0, '2022-06-16'),
(43, 'Sabbir', 'tanvir3121@gmail.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', '8a3f63c2174e6276d5cf1c867f990e', NULL, NULL, NULL, 2, 0, '2022-06-16'),
(44, 'tanvir', 'sarrick2020882@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '7f91b17dc0544bd9d7ca54a06546db', NULL, NULL, NULL, 2, 0, '2022-06-16'),
(46, 'Tanvir Sarrick', 'sarricktanvir@gmail.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', '2c90d367efac48de8ed764ce89dbc6', '', '', '8314359-18-38389-2.jpg', 2, 1, '2022-06-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_materials`
--
ALTER TABLE `pr_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sells_info`
--
ALTER TABLE `sells_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_type`
--
ALTER TABLE `unit_type`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pr_materials`
--
ALTER TABLE `pr_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sells_info`
--
ALTER TABLE `sells_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unit_type`
--
ALTER TABLE `unit_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
