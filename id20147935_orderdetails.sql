-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2023 at 12:05 PM
-- Server version: 10.5.16-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20147935_orderdetails`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `recid` bigint(20) NOT NULL,
  `order_number` bigint(20) DEFAULT 0,
  `customflag` char(1) DEFAULT 'N',
  `expected_delivery` varchar(255) DEFAULT NULL,
  `function_date` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `dateofcompletion` varchar(255) DEFAULT NULL,
  `dateadded` datetime DEFAULT NULL,
  `endeffdt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`recid`, `order_number`, `customflag`, `expected_delivery`, `function_date`, `customer_name`, `product_name`, `dateofcompletion`, `dateadded`, `endeffdt`) VALUES
(4, 588, 'Y', '26/01/2023', '28/01/2023', 'Rinto Raju', 'Custom Product', '', NULL, NULL),
(5, 589, 'Y', '31/01/2023', '05/02/2023', 'Diana Hendricks', 'Custom Product', '27/01/2023 05:30 PM', NULL, NULL),
(6, 589, 'Y', '31/01/2023', '05/02/2023', 'Diana Hendricks', 'Custom Product', '27/01/2023 05:30 PM', NULL, NULL),
(7, 52092, 'N', '', '', 'Jeena Francis', 'Luke – Christening Dress Set for Baby Boy', '', NULL, NULL),
(8, 52093, 'N', '', '', 'Prince Pravin', 'BC 002 – Christening Dress Set for Baby Boy', '', NULL, NULL),
(9, 590, 'Y', '10/02/2023', '18/02/2023', 'Soumya Abraham', 'Custom Product', '', NULL, NULL),
(10, 591, 'Y', '03/01/2023', '12/02/2023', 'Betsy Robert', 'Custom Product', '', NULL, NULL),
(11, 593, 'Y', '31/01/2023', '04/02/2023', 'Anu Anu', 'Custom Product', '', NULL, NULL),
(12, 594, 'Y', '31/01/2023', '05/02/2023', 'Christina M', 'Custom Product', '', NULL, NULL),
(13, 52094, 'N', '', '', 'Asha Pius', 'Mark – Christening Dress Set for Baby Boy', '', NULL, NULL),
(14, 595, 'Y', '31/01/2023', '05/02/2023', 'Juby Alex', 'Custom Product', '', NULL, NULL),
(15, 52114, 'N', '', '', 'Neethu Joseph', 'BC 002 – Christening Dress Set for Baby Boy', '', NULL, NULL),
(16, 52115, 'N', '', '', 'Shalna Correya', 'IAN SP Premium – Baptism Dress For Baby Boy', '', NULL, NULL),
(17, 52116, 'N', '', '', 'Joby K.J', 'BC 002 – Christening Dress Set for Baby Boy', '', NULL, NULL),
(18, 52117, 'N', '', '', 'Arsha Arun', 'BC 002 – Christening Dress Set for Baby Boy', '', NULL, NULL),
(19, 597, 'Y', '10/02/2023', '14/02/2023', 'Cinsu Thomas', 'Custom Product', '', NULL, NULL),
(20, 598, 'Y', '06/02/2023', '08/02/2023', 'Neha Christina', 'Custom Product', '', NULL, NULL),
(21, 52118, 'N', '', '', 'Jasmine M.J', 'Mark – Christening Dress Set for Baby Boy', '', NULL, NULL),
(22, 52119, 'N', '', '', 'vivian viviek', 'Isahac', '', NULL, NULL),
(23, 52135, 'N', '', '', 'Sophia R', 'GC 002 – Baptism Gown Set for Baby Girl', '', NULL, NULL),
(24, 599, 'Y', '10/02/2023', '16/02/2023', 'Ancy Koshy', 'Custom Product', '', NULL, NULL),
(25, 601, 'Y', '17/02/2023', '22/02/2023', 'Jessy Mathunni panicker', 'Custom Product', '', NULL, NULL),
(26, 602, 'Y', '03/02/2023', '11/02/2023', 'Shamil Mathew', 'Custom Product', '', NULL, NULL),
(27, 52136, 'N', '', '', 'Sagaya Mary', 'Luke – Christening Dress Set for Baby Boy', '', NULL, NULL),
(28, 52137, 'N', '', '', 'Jibin Jiji philip', 'Luke – Christening Dress Set for Baby Boy', '', NULL, NULL),
(29, 52138, 'N', '', '', 'Sagaya Mary', 'Luke – Christening Dress Set for Baby Boy', '', NULL, NULL),
(30, 603, 'Y', '07/12/2022', '11/02/2023', 'Mary Miranta', 'Custom Product', '', NULL, NULL),
(31, 604, 'Y', '28/01/2023', '30/01/2023', 'Rony Rony', 'Custom Product', '', NULL, NULL),
(32, 52139, 'N', '', '', 'Harsha Abraham', 'Louis - Premium Cotton Baptism Romper Set', '', NULL, NULL),
(33, 605, 'Y', '5th February 2023', '12/02/2023', 'Samson Rodrigues', 'Custom Product', '', NULL, NULL),
(34, 52140, 'N', '', '', 'DEEPU K JOHN', 'BC 005 – Christening Romper set for Baby Boy', '', NULL, NULL),
(35, 606, 'Y', '08/02/2023', '10/02/2023', 'Ashly Babu', 'Custom Product', '', NULL, NULL),
(36, 52141, 'N', '', '', 'Joju Mathew', 'Alberlin', '', NULL, NULL),
(37, 52142, 'N', '', '', 'Deepti Joel', 'BC 005 – Christening Romper set for Baby Boy', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`recid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `recid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
