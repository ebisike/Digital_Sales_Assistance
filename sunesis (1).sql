-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2019 at 03:15 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sunesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(20) NOT NULL,
  `invoice` int(6) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `customer_name` varchar(30) NOT NULL,
  `date_gotten` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice`, `status`, `customer_name`, `date_gotten`) VALUES
(301, 896031, 1, 'george ebisike chigozie', 'Fri-Mar-2019'),
(302, 836830, 1, 'ogbona flora', '18-Mar-2019'),
(303, 358762, 0, '', ''),
(304, 462640, 0, '', ''),
(305, 917227, 0, '', ''),
(306, 900217, 0, '', ''),
(307, 331427, 0, '', ''),
(308, 972645, 0, '', ''),
(309, 443729, 0, '', ''),
(310, 639754, 0, '', ''),
(311, 937230, 0, '', ''),
(312, 761795, 0, '', ''),
(313, 911339, 0, '', ''),
(314, 847210, 0, '', ''),
(315, 788484, 0, '', ''),
(316, 944377, 0, '', ''),
(317, 901228, 0, '', ''),
(318, 497946, 0, '', ''),
(319, 192274, 0, '', ''),
(320, 123306, 0, '', ''),
(321, 627852, 0, '', ''),
(322, 857008, 0, '', ''),
(323, 227338, 0, '', ''),
(324, 767993, 0, '', ''),
(325, 494442, 0, '', ''),
(326, 911869, 0, '', ''),
(327, 511706, 0, '', ''),
(328, 724497, 0, '', ''),
(329, 487233, 0, '', ''),
(330, 663586, 0, '', ''),
(331, 182409, 0, '', ''),
(332, 682948, 0, '', ''),
(333, 288548, 0, '', ''),
(334, 949629, 0, '', ''),
(335, 708829, 0, '', ''),
(336, 904684, 0, '', ''),
(337, 902051, 0, '', ''),
(338, 734141, 0, '', ''),
(339, 447591, 0, '', ''),
(340, 505934, 0, '', ''),
(341, 881358, 0, '', ''),
(342, 203239, 0, '', ''),
(343, 570582, 0, '', ''),
(344, 436261, 0, '', ''),
(345, 706945, 0, '', ''),
(346, 789699, 0, '', ''),
(347, 147814, 0, '', ''),
(348, 431050, 0, '', ''),
(349, 497434, 0, '', ''),
(350, 330358, 0, '', ''),
(351, 690797, 0, '', ''),
(352, 678421, 0, '', ''),
(353, 845588, 0, '', ''),
(354, 605491, 0, '', ''),
(355, 333425, 0, '', ''),
(356, 798796, 0, '', ''),
(357, 778121, 0, '', ''),
(358, 877708, 0, '', ''),
(359, 844054, 0, '', ''),
(360, 106291, 0, '', ''),
(361, 499918, 0, '', ''),
(362, 783886, 0, '', ''),
(363, 425385, 0, '', ''),
(364, 842053, 0, '', ''),
(365, 554162, 0, '', ''),
(366, 137996, 0, '', ''),
(367, 472502, 0, '', ''),
(368, 442137, 0, '', ''),
(369, 674335, 0, '', ''),
(370, 772495, 0, '', ''),
(371, 545635, 0, '', ''),
(372, 395960, 0, '', ''),
(373, 201869, 0, '', ''),
(374, 588645, 0, '', ''),
(375, 814740, 0, '', ''),
(376, 731011, 0, '', ''),
(377, 858302, 0, '', ''),
(378, 104245, 0, '', ''),
(379, 882706, 0, '', ''),
(380, 732952, 0, '', ''),
(381, 146939, 0, '', ''),
(382, 886341, 0, '', ''),
(383, 964666, 0, '', ''),
(384, 978319, 0, '', ''),
(385, 632352, 0, '', ''),
(386, 127246, 0, '', ''),
(387, 529912, 0, '', ''),
(388, 705954, 0, '', ''),
(389, 357841, 0, '', ''),
(390, 860334, 0, '', ''),
(391, 179579, 0, '', ''),
(392, 711811, 0, '', ''),
(393, 244868, 0, '', ''),
(394, 135228, 0, '', ''),
(395, 104732, 0, '', ''),
(396, 295299, 0, '', ''),
(397, 712034, 0, '', ''),
(398, 546245, 0, '', ''),
(399, 597146, 0, '', ''),
(400, 905259, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(4) NOT NULL,
  `invoice` int(10) NOT NULL,
  `product_type` varchar(30) NOT NULL,
  `description` varchar(255) NOT NULL,
  `size` int(3) NOT NULL,
  `cobbler_price` int(12) NOT NULL,
  `company_price` int(12) NOT NULL,
  `quantity` int(3) NOT NULL,
  `cost` int(20) NOT NULL,
  `cobbler_cost` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice`, `product_type`, `description`, `size`, `cobbler_price`, `company_price`, `quantity`, `cost`, `cobbler_cost`) VALUES
(36, 896031, 'BROOKS', 'black', 45, 1000, 2000, 2, 4000, 2000),
(38, 896031, 'SLIPPERS', 'pink lether', 46, 1000, 2000, 3, 6000, 3000),
(39, 836830, 'SLIPPERS', 'pink', 23, 1200, 2000, 3, 6000, 3600),
(40, 836830, 'BROOKS', 'Black and whit', 23, 3500, 4500, 4, 18000, 14000),
(41, 836830, 'SANDALS', 'hover', 24, 2000, 4000, 2, 8000, 4000),
(42, 836830, 'TITHES', 'red', 34, 1200, 2000, 1, 2000, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `order_contact`
--

CREATE TABLE `order_contact` (
  `id` int(4) NOT NULL,
  `invoice` int(6) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `location` varchar(20) NOT NULL,
  `amount_paid` int(20) NOT NULL,
  `cobbler_price` int(20) NOT NULL,
  `payment_status` int(20) NOT NULL,
  `order_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_contact`
--

INSERT INTO `order_contact` (`id`, `invoice`, `customer_name`, `location`, `amount_paid`, `cobbler_price`, `payment_status`, `order_date`) VALUES
(8, 896031, 'george ebisike chigozie', 'Lagos', 10000, 5000, 1, 'Fri-Mar-2019'),
(9, 836830, 'ogbona flora', 'Adamawa', 34000, 22800, 1, '18-Mar-2019');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Godiya Yahaya', 'georgeebisike@gmail.', 'sunesis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_contact`
--
ALTER TABLE `order_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `order_contact`
--
ALTER TABLE `order_contact`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
