-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 16, 2021 at 06:01 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `love_you_a_latte`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `image`, `price`, `description`) VALUES
(1, 'Brewed Coffee Small', 'brewedcoffee1', 'product-images/brewed-coffee.jpg', 2.00, 'placeholder'),
(2, 'Brewed Coffee Medium', 'brewedcoffee2', 'product-images/brewed-coffee.jpg', 2.50, 'placeholder'),
(3, 'Brewed Coffee Large', 'brewedcoffee3', 'product-images/brewed-coffee.jpg', 3.00, 'placeholder'),
(4, 'Cappucino Small', 'cappucino1', 'product-images/Cappucino.jpg', 3.00, 'placeholder'),
(5, 'Cappucino Medium', 'cappucino2', 'product-images/Cappucino.jpg', 3.50, 'placeholder'),
(6, 'Cappucino Large', 'cappucino3', 'product-images/Cappucino.jpg', 4.00, 'placeholder'),
(7, 'Esspresso Small', 'esspresso1', 'product-images/Esspresso.jpg', 1.95, 'placeholder'),
(8, 'Esspresso Medium', 'esspresso2', 'product-images/Esspresso.jpg', 2.45, 'placeholder'),
(9, 'Esspresso Large', 'esspresso3', 'product-images/Esspresso.jpg', 2.95, 'placeholder'),
(10, 'Latte Small', 'latte1', 'product-images/Latte.jpg', 3.00, 'placeholder'),
(11, 'Latte Medium', 'latte2', 'product-images/Latte.jpg', 3.50, 'placeholder'),
(12, 'Latte Large', 'latte3', 'product-images/Latte.jpg', 4.00, 'placeholder');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
