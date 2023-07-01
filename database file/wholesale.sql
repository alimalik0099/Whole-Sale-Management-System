-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2023 at 07:37 PM
-- Server version: 10.3.38-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alitech_wholesale`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Tobacco');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_no` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `business_name` varchar(200) NOT NULL,
  `phone_no` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_no`, `name`, `business_name`, `phone_no`) VALUES
(1, '13162', 'Largo Poni', 'Bonmilk', '+35054088708'),
(2, '44768', 'Largo Lev', 'Bonmilk', '+35054088708'),
(3, '31623', 'Pintor', 'Moreno 2000', '+35054085295'),
(4, '473', 'Torres', 'n/a', '+34673128869'),
(5, '61559', 'Rehman malik', 'Rehman stores', '237049234');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `employee_no` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone_no` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `employee_no`, `name`, `phone_no`, `email`, `password`) VALUES
(1, '25561', 'Rehman malik', '834274728934', 'rehman@gmail.com', 'MTIz202cb962ac59075b964b07152d234b70MTIz');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `pay_via` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`id`, `name`) VALUES
(1, 'peti cash'),
(2, '100 rupees given in cash to m rafiq');

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` int(11) NOT NULL,
  `ledger_type` varchar(200) NOT NULL,
  `ledger_user` varchar(200) NOT NULL,
  `user_no` varchar(200) NOT NULL,
  `amount` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`id`, `ledger_type`, `ledger_user`, `user_no`, `amount`) VALUES
(1, 'Purchase', 'Supplier', '62784', '190199'),
(2, 'Sale', 'Customer', '13162', '-4650'),
(3, 'Sale', 'Customer', '44768', '-3850'),
(4, 'Sale', 'Customer', '31623', '2178147'),
(5, 'Sale', 'Customer', '473', '-7540'),
(6, 'Sale', 'Customer', '61559', '540');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `user_no` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `user_type`, `user_no`) VALUES
(1, 'admin@admin.com', 'MTIz202cb962ac59075b964b07152d234b70MTIz', 'Admin', '000'),
(17, 'rehman@gmail.com', 'MTIz202cb962ac59075b964b07152d234b70MTIz', 'User', '25561');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `purchase_price` varchar(200) NOT NULL,
  `sale_price` varchar(200) NOT NULL,
  `stock` varchar(200) NOT NULL,
  `supplier` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `purchase_price`, `sale_price`, `stock`, `supplier`) VALUES
(2, 'American Legend', '1', '1375', '1595', '20', '62784'),
(4, 'Camel', '1', '1665', '1885', '1', '62784'),
(5, 'Chesterfield', '1', '1610', '1830', '8', '62784'),
(7, 'Ducado Rubio', '1', '1265', '1485', '8', '62784'),
(8, 'Ducal', '1', '1265', '1485', '68', '62784'),
(9, 'Elixyr', '1', '1240', '1460', '23', '62784'),
(10, 'Fortuna Redline', '1', '1305', '1525', '-5', '62784'),
(12, 'Golden American', '1', '1320', '1540', '8', '62784'),
(13, 'Lucky Strike Double Gold', '1', '1545', '1765', '2', '62784'),
(14, 'Lucky Strike Redberry', '1', '1545', '1765', '1', '62784'),
(15, 'L & M Blue', '1', '1330', '1550', '1', '62784'),
(17, 'Marlboro Red', '1', '1780', '2000', '5', '62784'),
(19, 'Nobel', '1', '1495', '1715', '2', '62784'),
(20, 'Winston Eagle', '1', '1635', '1855', '15', '62784'),
(22, 'Marlboro Light', '1', '1780', '2000', '1', '62784'),
(23, 'American Club', '1', '1240', '1360', '4', '62784'),
(24, 'DRUM', '1', '1000', '2000', '0', '62784'),
(25, 'T', '1', '2', '2', '0', '62784'),
(26, 'Brufen syrup ', '1', '120', '90', '2', '62784'),
(27, 'tea', '1', '100', '120', '2', '62784');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `purchase_no` varchar(200) NOT NULL,
  `supplier` varchar(200) NOT NULL,
  `total_payable` varchar(200) NOT NULL,
  `total_cost_price` varchar(200) NOT NULL,
  `purchase_date` varchar(200) NOT NULL,
  `purchase_via` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `purchase_no`, `supplier`, `total_payable`, `total_cost_price`, `purchase_date`, `purchase_via`) VALUES
(1, '33086359', '62784', '0', '262635', '2022-08-31', 'Cash'),
(2, '45259011', '62784', '65105', '113575', '2022-08-31', 'Cash'),
(3, '74582726', '62784', '0', '6600', '2022-09-09', 'Cash'),
(4, '9679938', '62784', '0', '6200', '2022-09-09', 'Cash'),
(5, '16342990', '62784', '9000', '9050', '2023-02-14', 'Cash'),
(6, '91365893', '62784', '1400', '1480', '2023-02-23', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(11) NOT NULL,
  `purchase_no` varchar(200) NOT NULL,
  `product` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `cost_price` varchar(200) NOT NULL,
  `grass_amt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `purchase_no`, `product`, `qty`, `cost_price`, `grass_amt`) VALUES
(1, '33086359', '8', '68', '1265', '86020'),
(2, '33086359', '9', '22', '1240', '27280'),
(3, '33086359', '2', '20', '1375', '27500'),
(4, '33086359', '20', '15', '1635', '24525'),
(5, '33086359', '10', '15', '1305', '19575'),
(6, '33086359', '7', '8', '1265', '10120'),
(7, '33086359', '5', '4', '1610', '6440'),
(8, '33086359', '16', '6', '1330', '7980'),
(9, '33086359', '17', '5', '1780', '8900'),
(10, '33086359', '19', '2', '1495', '2990'),
(11, '33086359', '12', '3', '1320', '3960'),
(12, '33086359', '22', '1', '1780', '1780'),
(13, '33086359', '15', '2', '1330', '2660'),
(14, '33086359', '4', '14', '1665', '23310'),
(15, '33086359', '13', '2', '1545', '3090'),
(16, '33086359', '14', '1', '1545', '1545'),
(17, '33086359', '23', '4', '1240', '4960'),
(18, '45259011', '9', '11', '1240', '13640'),
(19, '45259011', '5', '1', '1610', '1610'),
(20, '45259011', '4', '1', '1665', '1665'),
(21, '45259011', '12', '0.5', '1320', '660'),
(22, '45259011', '16', '1', '1330', '1330'),
(23, '45259011', '2', '2', '1375', '2750'),
(24, '45259011', '8', '52', '1265', '65780'),
(25, '45259011', '17', '2.5', '1780', '4450'),
(26, '45259011', '13', '1', '1545', '1545'),
(27, '45259011', '20', '10', '1635', '16350'),
(28, '45259011', '7', '3', '1265', '3795'),
(29, '74582726', '12', '5', '1320', '6600'),
(30, '9679938', '9', '5', '1240', '6200'),
(31, '16342990', '27', '10', '100', '1000'),
(32, '16342990', '5', '5', '1610', '8050'),
(33, '91365893', '9', '1', '1240', '1240'),
(34, '91365893', '26', '2', '120', '240');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `sale_no` varchar(200) NOT NULL,
  `customer` varchar(200) NOT NULL,
  `total_payable` varchar(200) NOT NULL,
  `total_cost_price` varchar(200) NOT NULL,
  `sale_date` varchar(200) NOT NULL,
  `sale_via` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `sale_no`, `customer`, `total_payable`, `total_cost_price`, `sale_date`, `sale_via`) VALUES
(1, '35062833', '13162', '0', '21530', '2022-08-31', 'Cash'),
(2, '7599152', '44768', '0', '30810', '2022-08-31', 'Cash'),
(3, '12621505', '31623', '72895', '79935', '2022-08-31', 'Cash'),
(4, '3515015', '31623', '15000', '24675', '2022-09-07', 'Cash'),
(5, '91556728', '31623', '15000', '', '2022-09-07', 'Cash'),
(6, '26810053', '44768', '5000', '7300', '2022-09-07', 'Cash'),
(7, '10451527', '13162', '0', '4650', '2022-09-07', 'Cash'),
(8, '72588431', '13162', '0', '', '2022-09-07', 'Cash'),
(9, '64984465', '44768', '0', '1550', '2022-09-07', 'Cash'),
(10, '93455352', '473', '0', '3770', '2022-09-09', 'Cash'),
(11, '88109487', '473', '0', '', '2022-09-09', 'Cash'),
(12, '52353241', '473', '0', '3770', '2022-09-09', 'Cash'),
(13, '35370039', '473', '0', '', '2022-09-09', 'Cash'),
(14, '51877678', '31623', '2222222', '32670', '2022-11-17', 'Bank'),
(15, '83035670', '31623', '100', '1830', '2023-02-13', 'Cash'),
(16, '58108981', '61559', '400', '600', '2023-02-14', 'Cash'),
(17, '70275966', '61559', '1000', '360', '2023-02-14', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `sale_details`
--

CREATE TABLE `sale_details` (
  `id` int(11) NOT NULL,
  `sale_no` varchar(200) NOT NULL,
  `product` varchar(200) NOT NULL,
  `qty` varchar(200) NOT NULL,
  `sale_price` varchar(200) NOT NULL,
  `grass_amt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_details`
--

INSERT INTO `sale_details` (`id`, `sale_no`, `product`, `qty`, `sale_price`, `grass_amt`) VALUES
(1, '35062833', '8', '12', '1485', '17820'),
(2, '35062833', '20', '2', '1855', '3710'),
(3, '7599152', '8', '17', '1485', '25245'),
(4, '7599152', '20', '3', '1855', '5565'),
(5, '12621505', '7', '3', '1485', '4455'),
(6, '12621505', '20', '5', '1855', '9275'),
(7, '12621505', '13', '1', '1765', '1765'),
(8, '12621505', '17', '2.5', '2000', '5000'),
(9, '12621505', '8', '23', '1485', '34155'),
(10, '12621505', '2', '2', '1595', '3190'),
(11, '12621505', '16', '1', '1550', '1550'),
(12, '12621505', '12', '0.5', '1540', '770'),
(13, '12621505', '4', '1', '1885', '1885'),
(14, '12621505', '5', '1', '1830', '1830'),
(15, '12621505', '9', '11', '1460', '16060'),
(16, '3515015', '10', '10', '1525', '15250'),
(17, '3515015', '4', '5', '1885', '9425'),
(18, '91556728', '10', '10', '', ''),
(19, '26810053', '9', '5', '1460', '7300'),
(20, '10451527', '16', '3', '1550', '4650'),
(21, '72588431', '16', '3', '', ''),
(22, '64984465', '15', '1', '1550', '1550'),
(23, '93455352', '4', '2', '1885', '3770'),
(24, '88109487', '4', '2', '', ''),
(25, '52353241', '4', '2', '1885', '3770'),
(26, '35370039', '4', '2', '', ''),
(27, '51877678', '8', '22', '1485', '32670'),
(28, '83035670', '5', '1', '1830', '1830'),
(29, '58108981', '27', '5', '120', '600'),
(30, '70275966', '27', '3', '120', '360');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `project_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `project_name`) VALUES
(1, 'Point Of Sale');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `supplier_no` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `business_name` varchar(200) NOT NULL,
  `phone_no` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_no`, `name`, `business_name`, `phone_no`) VALUES
(1, '62784', 'Ali Malik', 'xyz', '034111111');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `type`, `date`, `description`) VALUES
(1, '0', 'Cash', '2022-08-31', 'Purchasing'),
(2, '0', 'Cash', '2022-08-31', 'Sale'),
(3, '0', 'Cash', '2022-08-31', 'Sale'),
(4, '72895', 'Cash', '2022-08-31', 'Sale'),
(5, '65105', 'Cash', '2022-08-31', 'Purchasing'),
(6, '5000', 'Cash', '2022-09-07', 'Ledger Adjustment'),
(7, '30810', 'Cash', '2022-09-07', 'Ledger Adjustment'),
(8, '40000', 'Cash', '2022-09-07', 'Ledger Adjustment'),
(9, '2040', 'Cash', '2022-09-07', 'Ledger Adjustment'),
(10, '21530', 'Cash', '2022-09-07', 'Ledger Adjustment'),
(11, '27170', 'Cash', '2022-09-07', 'Ledger Adjustment'),
(12, '15000', 'Cash', '2022-09-07', 'Sale'),
(13, '15000', 'Cash', '2022-09-07', 'Sale'),
(14, '5000', 'Cash', '2022-09-07', 'Sale'),
(15, '0', 'Cash', '2022-09-07', 'Sale'),
(16, '0', 'Cash', '2022-09-07', 'Sale'),
(17, '0', 'Cash', '2022-09-07', 'Sale'),
(18, '0', 'Cash', '2022-09-09', 'Sale'),
(19, '0', 'Cash', '2022-09-09', 'Sale'),
(20, '0', 'Cash', '2022-09-09', 'Sale'),
(21, '0', 'Cash', '2022-09-09', 'Sale'),
(22, '0', 'Cash', '2022-09-09', 'Purchasing'),
(23, '0', 'Cash', '2022-09-09', 'Purchasing'),
(24, '5000', 'Cash', '17-09-2022 07:37:08', 'Add Balance Into Cash'),
(25, '2222222', 'Bank', '2022-11-17', 'Sale'),
(26, '66666', 'Bank', '2022-11-18', 'Ledger Adjustment'),
(27, '100', 'Cash', '2023-02-13', 'Sale'),
(28, '9000', 'Cash', '2023-02-14', 'Purchasing'),
(29, '400', 'Cash', '2023-02-14', 'Sale'),
(30, '100', 'Cash', '2023-02-14', 'Ledger Adjustment'),
(31, '1000', 'Cash', '2023-02-14', 'Sale'),
(32, '250', 'Cash', '20-02-2023 13:06:16', 'Add Balance Into Cash'),
(33, '50000', 'Cash', '20-02-2023 14:01:22', 'Add Balance Into Cash'),
(34, '1400', 'Cash', '2023-02-23', 'Purchasing');

-- --------------------------------------------------------

--
-- Table structure for table `user_access`
--

CREATE TABLE `user_access` (
  `id` int(11) NOT NULL,
  `user_no` varchar(200) NOT NULL,
  `access` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access`
--

INSERT INTO `user_access` (`id`, `user_no`, `access`) VALUES
(1, '25561', 'Manage Products'),
(2, '25561', 'Manage Customers'),
(3, '25561', 'Manage Expenses');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `cash_balance` varchar(200) NOT NULL,
  `bank_balance` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `cash_balance`, `bank_balance`) VALUES
(1, '81450', '2155556');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_details`
--
ALTER TABLE `sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access`
--
ALTER TABLE `user_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sale_details`
--
ALTER TABLE `sale_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_access`
--
ALTER TABLE `user_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
