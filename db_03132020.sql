-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2020 at 07:17 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vipfouuo_dcstarrgazes`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `custID`, `category_name`, `created_at`) VALUES
(1, 'CT0001', 'CAT1', '2020-03-12 16:56:54'),
(2, 'CT0002', 'CAT2', '2020-03-12 16:56:58');

-- --------------------------------------------------------

--
-- Table structure for table `categories_sub`
--

CREATE TABLE `categories_sub` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) NOT NULL,
  `parent_category` varchar(255) NOT NULL,
  `sub_category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_sub`
--

INSERT INTO `categories_sub` (`id`, `custID`, `parent_category`, `sub_category_name`, `created_at`) VALUES
(1, 'SCT00001', 'CAT2', 'SUBCAT1', '2020-03-12 17:01:12'),
(2, 'SCT00002', 'CAT2', 'SUBCAT2', '2020-03-12 17:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `custID`, `lastName`, `firstName`, `contact`, `address`, `created_at`) VALUES
(1, 'CS0312200001', 'CUST1', 'L', '31231231231', 'SDFSDF', '2020-03-12 17:22:41'),
(2, 'CS0312200002', 'CUST2', 'J', '45345', 'SDFSDF', '2020-03-12 17:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `expired_stocks`
--

CREATE TABLE `expired_stocks` (
  `id` int(11) NOT NULL,
  `custID` varchar(150) NOT NULL,
  `PO_ID` varchar(150) NOT NULL,
  `product_SKU` varchar(150) NOT NULL,
  `warehouse_ID` varchar(150) NOT NULL,
  `stock_status` varchar(150) NOT NULL,
  `expiry_date` varchar(20) NOT NULL,
  `approved_by` varchar(150) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generate_po`
--

CREATE TABLE `generate_po` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `expiry_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `po_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `generate_po`
--

INSERT INTO `generate_po` (`id`, `custID`, `product_description`, `warehouse_name`, `qty`, `expiry_date`, `po_status`, `created_by`, `created_at`) VALUES
(1, 'PO0312200000001', 'TEA123456', 'WH0001', 10, '2020-03-14', 'Approved', 'Vince', '2020-03-12 17:17:26'),
(2, 'PO0312200000002', 'COF12345', 'WH0002', 10, '2020-03-15', 'Approved', 'Vince', '2020-03-12 17:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `installment_history`
--

CREATE TABLE `installment_history` (
  `insID` int(11) NOT NULL,
  `in_tx_id` varchar(255) NOT NULL,
  `si_id` varchar(255) NOT NULL,
  `ins_amount` int(11) NOT NULL,
  `ins_mop` varchar(255) NOT NULL,
  `ins_ref_no` varchar(255) NOT NULL,
  `ins_tx_date` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `installment_history`
--

INSERT INTO `installment_history` (`insID`, `in_tx_id`, `si_id`, `ins_amount`, `ins_mop`, `ins_ref_no`, `ins_tx_date`, `created_by`, `created_at`) VALUES
(8, 'SITX031220000008', 'SI03122000002', 12, 'Cash', '', '01/11/2020', 'ADMIN', '2020-03-13 01:42:42'),
(7, 'SITX031220000001', 'SI03122000002', 12, 'Cash', '', '01/08/2020', 'ADMIN', '2020-03-13 01:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `info` varchar(255) NOT NULL,
  `info2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_model`
--

CREATE TABLE `product_model` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_SKU` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_sub_category` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `product_supplier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sell_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suggested_retail_price` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `product_detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_model`
--

INSERT INTO `product_model` (`id`, `custID`, `product_description`, `product_SKU`, `product_category`, `product_sub_category`, `product_supplier`, `supplier_price`, `sell_price`, `suggested_retail_price`, `product_detail`, `created_at`) VALUES
(1, 'PM0312200000001', 'TEA', 'TEA123456', 'CT0001', 'SCT00001', 'SP00001', '12', '13', '600', 'SFSDF', '2020-03-12 17:11:44'),
(2, 'PM0312200000002', 'COFFEE', 'COF12345', 'CT0001', 'SCT00001', 'SP00001', '11', '13', '600', 'FDS', '2020-03-12 17:11:59'),
(4, 'PM0312200000003', 'COFFEE34234', '456456', 'CT0001', 'SCT00001', 'SP00001', '213', '123', '123', 'SFDFDDD2', '2020-03-12 17:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `date_purchase` varchar(255) NOT NULL,
  `trans_id` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `cashier` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `returns`
--

INSERT INTO `returns` (`id`, `date_purchase`, `trans_id`, `customer`, `item`, `qty`, `cashier`, `remarks`, `created_at`) VALUES
(2, '2020-03-13', 'SI03122000001', 'CUST1,L', 'TEA', 21, 'CASHIER', 'dsf', '2020-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `soID` int(11) NOT NULL,
  `txID` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `stock_ID` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `so_desc` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `so_qty` int(11) NOT NULL,
  `so_price` int(11) NOT NULL,
  `so_cust` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `so_warehouse` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mop` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `created_by` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`soID`, `txID`, `stock_ID`, `so_desc`, `so_qty`, `so_price`, `so_cust`, `so_warehouse`, `mop`, `discount`, `created_by`, `created_at`) VALUES
(1, 'SI03122000001', 'SC00000001', 'TEA123456', 1, 13, 'CS0312200001', 'WH0001', 'Cash', 3, 'ADMIN', '2020-03-12'),
(2, 'SI03122000002', 'SC00000002', 'TEA123456', 1, 13, 'CS0312200002', 'WH0001', 'Installment', 3, 'ADMIN', '2020-03-12'),
(3, 'SI03122000003', 'SC00000003', 'TEA123456', 1, 13, 'CS0312200001', 'WH0001', 'Void', 0, 'ADMIN', '2020-03-12');

--
-- Triggers `sales_order`
--
DELIMITER $$
CREATE TRIGGER `update_stocks_on_sales_order` AFTER INSERT ON `sales_order` FOR EACH ROW begin
       update stock
	 set stock_status = 'Sold',
	      qty=0
	 where custID = NEW.stock_ID ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `custID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_SKU` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PO_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stock_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `expiry_date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `approved_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `custID`, `product_SKU`, `PO_ID`, `warehouse_ID`, `stock_status`, `qty`, `expiry_date`, `approved_by`, `created_at`) VALUES
(1, 'SC00000001', 'PO0312200000001', 'TEA123456', 'WH0001', 'Sold', 0, '2020-03-14', 'ADMIN', '2020-03-12 17:17:30'),
(2, 'SC00000002', 'PO0312200000001', 'TEA123456', 'WH0001', 'Sold', 0, '2020-03-14', 'ADMIN', '2020-03-12 17:17:30'),
(3, 'SC00000003', 'PO0312200000001', 'TEA123456', 'WH0001', 'Sold', 0, '2020-03-14', 'ADMIN', '2020-03-12 17:17:30'),
(4, 'SC00000004', 'PO0312200000001', 'TEA123456', 'WH0001', 'In Stock', 1, '2020-03-14', 'ADMIN', '2020-03-12 17:17:31'),
(5, 'SC00000005', 'PO0312200000001', 'TEA123456', 'WH0001', 'In Stock', 1, '2020-03-14', 'ADMIN', '2020-03-12 17:17:31'),
(6, 'SC00000006', 'PO0312200000001', 'TEA123456', 'WH0001', 'In Stock', 1, '2020-03-14', 'ADMIN', '2020-03-12 17:17:31'),
(7, 'SC00000007', 'PO0312200000001', 'TEA123456', 'WH0001', 'In Stock', 1, '2020-03-14', 'ADMIN', '2020-03-12 17:17:31'),
(8, 'SC00000008', 'PO0312200000001', 'TEA123456', 'WH0001', 'In Stock', 1, '2020-03-14', 'ADMIN', '2020-03-12 17:17:31'),
(9, 'SC00000009', 'PO0312200000001', 'TEA123456', 'WH0001', 'In Stock', 1, '2020-03-14', 'ADMIN', '2020-03-12 17:17:31'),
(10, 'SC00000010', 'PO0312200000001', 'TEA123456', 'WH0001', 'In Stock', 1, '2020-03-14', 'ADMIN', '2020-03-12 17:17:31'),
(11, 'SC00000011', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:13'),
(12, 'SC00000012', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:13'),
(13, 'SC00000013', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:13'),
(14, 'SC00000014', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:14'),
(15, 'SC00000015', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:14'),
(16, 'SC00000016', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:14'),
(17, 'SC00000017', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:14'),
(18, 'SC00000018', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:14'),
(19, 'SC00000019', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:14'),
(20, 'SC00000020', 'PO0312200000002', 'COF12345', 'WH0002', 'In Stock', 1, '2020-03-15', 'ADMIN', '2020-03-12 17:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_contact_person` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_contact_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `supplier_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `custID`, `supplier_name`, `supplier_contact_person`, `supplier_contact_no`, `supplier_email`, `supplier_address`, `created_at`) VALUES
(1, 'SP00001', 'SUP1', 'HENRY', '(090) 343-4212', 'sy@sm.com', 'ADFAD', '2020-03-12 16:48:26'),
(2, 'SP00002', 'SUP2', 'JOY', '(231) 242-3970', 'joy@gmail.com', 'IHJFUSOIDHF', '2020-03-12 16:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `custID`, `username`, `password`, `usertype`, `created_at`) VALUES
(1, 'ACC0819190001', 'ADMIN', '1234', 'Administrator', '2019-10-19 23:42:42'),
(2, 'ACC0819190002', 'MANAGER', '1234', 'Manager', '2019-10-19 23:42:42'),
(3, 'ACC0819190003', 'ACCOUNTING', '1234', 'Administrator', '2019-10-19 23:42:42'),
(4, 'ACC0819190004', 'HELLO', '1234', 'Administrator', '2019-10-19 23:42:42'),
(5, 'ACC0819190005', 'TEST', '1234', 'Administrator', '2019-10-19 23:42:42'),
(6, 'ACC0819190006', 'MDJS', '1234', 'Administrator', '2019-10-19 23:42:42'),
(7, 'ACC0105200007', 'CASHIER', '1234', 'Cashier', '2020-01-05 22:15:38'),
(8, 'ACC0311200008', 'LJP', '$2y$10$7uNvfEKOBxfZo10mhPsvn.tQPvUSGnwgE8LGOe5g/Z59FiPWsRxv6', 'Cashier', '2020-03-11 04:44:49'),
(9, 'ACC0312200009', 'L', '$2y$10$3.lk8metkqhYwiawPAI80.5S7mm.flvlNR4oSDzbJl6fjxx3HR19G', 'Administrator', '2020-03-12 15:34:50'),
(10, 'ACC0312200010', 'LJ', '$2y$10$3Fy2p9ghhc3LvxjQ4tBeE.KAmsVST9q0Sz.Rm0MKsT0AzuD2R.BUu', 'Administrator', '2020-03-12 15:35:15'),
(11, 'ACC0312200011', 'J', '$2y$10$a1pDRg9rarsgAW0KcTKHQOCdQqTYlR3AoJuH325PM1Htt1TXXdRHa', 'Administrator', '2020-03-12 15:36:14'),
(12, 'ACC0312200012', 'USE1', '1234', 'Administrator', '2020-03-12 17:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `void_so`
--

CREATE TABLE `void_so` (
  `soID` int(11) NOT NULL,
  `txID` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `stock_ID` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `so_desc` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `so_qty` int(11) NOT NULL,
  `so_price` int(11) NOT NULL,
  `so_cust` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `so_warehouse` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mop` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `created_by` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `void_so`
--

INSERT INTO `void_so` (`soID`, `txID`, `stock_ID`, `so_desc`, `so_qty`, `so_price`, `so_cust`, `so_warehouse`, `mop`, `discount`, `created_by`, `created_at`) VALUES
(1, 'SI03122000001', 'SC00000001', 'TEA123456', 1, 13, 'CS0312200001', 'WH0001', 'Cash', 3, 'ADMIN', '2020-03-12'),
(2, 'SI03122000002', 'SC00000002', 'TEA123456', 1, 13, 'CS0312200002', 'WH0001', 'Installment', 3, 'ADMIN', '2020-03-12'),
(3, 'SI03122000003', 'SC00000003', 'TEA123456', 1, 13, 'CS0312200001', 'WH0001', 'Void', 0, 'ADMIN', '2020-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(255) NOT NULL,
  `custID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `warehouse_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `crated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `custID`, `warehouse_name`, `address`, `crated_at`) VALUES
(1, 'WH0001', 'WH1', 'ADD1', '2020-03-12 17:04:50'),
(2, 'WH0002', 'WH2', 'ADD2', '2020-03-12 17:04:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories_sub`
--
ALTER TABLE `categories_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expired_stocks`
--
ALTER TABLE `expired_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generate_po`
--
ALTER TABLE `generate_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installment_history`
--
ALTER TABLE `installment_history`
  ADD PRIMARY KEY (`insID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_model`
--
ALTER TABLE `product_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`soID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `void_so`
--
ALTER TABLE `void_so`
  ADD PRIMARY KEY (`soID`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories_sub`
--
ALTER TABLE `categories_sub`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expired_stocks`
--
ALTER TABLE `expired_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generate_po`
--
ALTER TABLE `generate_po`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `installment_history`
--
ALTER TABLE `installment_history`
  MODIFY `insID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_model`
--
ALTER TABLE `product_model`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `soID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `void_so`
--
ALTER TABLE `void_so`
  MODIFY `soID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
