-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2020 at 12:36 PM
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
(1, 'CT0001', 'CAT12', '2020-02-26 10:21:10');

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
(1, 'SCT00001', 'CT0001', 'SUBCAT12', '2020-02-26 10:22:05');

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
(1, 'CS0226200001', 'L', 'JP', '(3__) ___-____', 'SDFSDF', '2020-02-26 10:30:18'),
(2, 'CS0226200002', 'GORDON', 'ERICA', '31231231231', 'ASDASD', '2020-02-26 10:33:14'),
(3, 'CS0226200003', 'GORDON', 'ERICA', '31231231231', 'ASDASD', '2020-02-26 10:34:03'),
(4, 'CS0226200004', 'GORDON', 'GRIM', '45455464', 'GFH', '2020-02-26 10:34:14'),
(5, 'CS0226200005', 'ASD', 'DFS', '123123', 'SDFSDF', '2020-02-26 10:36:15');

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
(1, 'PO0226200000001', '3123', 'WH0001', 50, '2021-02-26', 'Approved', 'Vince', '2020-02-26 10:28:31');

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
(2, 'PM0226200000002', 'ASD', 'ADSASD', 'CT0001', 'SCT00001', 'SP00001', '55', '15', '13', 'SDFSDF', '2020-02-26 10:26:08'),
(3, 'PM0226200000003', 'SDF', 'SDFS', 'CT0001', 'SCT00001', 'SP00001', '14', '133', '12', 'SFDSDF', '2020-02-26 10:26:33'),
(4, 'PM0226200000004', 'DFG', '3123', 'CT0001', 'SCT00001', 'SP00001', '45', '54', '200', 'SFSDF', '2020-02-26 10:27:19'),
(5, 'PM0226200000005', 'ASD', 'ASDAS', 'CT0001', 'SCT00001', 'SP00001', '31', '333', '12', 'SFDD', '2020-02-26 10:27:40');

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
(1, 'SI02262000001', 'SC00000002', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Cash', 1, 'ADMIN', '0000-00-00'),
(2, 'SI02262000002', 'SC00000001', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Installment', 1, 'ADMIN', '0000-00-00'),
(3, 'SI02262000003', 'SC00000003', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Installment', 0, 'ADMIN', '0000-00-00'),
(4, 'SI02262000004', 'SC00000004', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(5, 'SI02262000005', 'SC00000005', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(6, 'SI02262000006', 'SC00000006', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(8, 'SI02262000008', 'SC00000008', '3123', 1, 54, 'CS0226200004', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(9, 'SI02262000008', 'SC00000010', '3123', 1, 54, 'CS0226200004', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(10, 'SI02262000010', 'SC00000009', '3123', 1, 54, 'CS0226200004', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(11, 'SI02262000011', 'SC00000011', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(12, 'SI02262000011', 'SC00000012', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(13, 'SI02262000011', 'SC00000014', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(14, 'SI02262000014', 'SC00000013', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, '', '0000-00-00'),
(15, 'SI02262000015', 'SC00000015', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, '', '0000-00-00'),
(16, 'SI02262000016', 'SC00000016', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, '', '0000-00-00'),
(17, 'SI02262000016', 'SC00000017', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, '', '0000-00-00'),
(18, 'SI02262000016', 'SC00000020', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, '', '0000-00-00'),
(19, 'SI02262000019', 'SC00000019', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(20, 'SI02262000019', 'SC00000018', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(21, 'SI02262000021', 'SC00000021', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(22, 'SI02262000021', 'SC00000024', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(23, 'SI02262000023', 'SC00000022', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(24, 'SI02262000024', 'SC00000023', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(25, 'SI02262000024', 'SC00000026', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(26, 'SI02262000026', 'SC00000025', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(27, 'SI02262000027', 'SC00000032', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(28, 'SI02262000027', 'SC00000028', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(29, 'SI02262000029', 'SC00000027', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '0000-00-00'),
(30, 'SI02262000030', 'SC00000029', '3123', 1, 54, 'CS0226200005', 'WH0001', 'Cash', 0, 'ADMIN', '2020-02-26'),
(31, 'SI02262000031', 'SC00000030', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Installment', 0, 'ADMIN', '2020-02-26'),
(32, 'SI02262000031', 'SC00000033', '3123', 1, 54, 'CS0226200001', 'WH0001', 'Installment', 0, 'ADMIN', '2020-02-26');

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
(1, 'SC00000001', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(2, 'SC00000002', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(3, 'SC00000003', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(4, 'SC00000004', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(5, 'SC00000005', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(6, 'SC00000006', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(7, 'SC00000007', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(8, 'SC00000008', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(9, 'SC00000009', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(10, 'SC00000010', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:06'),
(11, 'SC00000011', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(12, 'SC00000012', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(13, 'SC00000013', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(14, 'SC00000014', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(15, 'SC00000015', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(16, 'SC00000016', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(17, 'SC00000017', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(18, 'SC00000018', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(19, 'SC00000019', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(20, 'SC00000020', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(21, 'SC00000021', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(22, 'SC00000022', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:07'),
(23, 'SC00000023', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(24, 'SC00000024', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(25, 'SC00000025', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(26, 'SC00000026', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(27, 'SC00000027', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(28, 'SC00000028', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(29, 'SC00000029', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(30, 'SC00000030', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(31, 'SC00000031', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(32, 'SC00000032', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(33, 'SC00000033', 'PO0226200000001', '3123', 'WH0001', 'Sold', 0, '2021-02-26', 'ADMIN', '2020-02-26 10:29:08'),
(34, 'SC00000034', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(35, 'SC00000035', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(36, 'SC00000036', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(37, 'SC00000037', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(38, 'SC00000038', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(39, 'SC00000039', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(40, 'SC00000040', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(41, 'SC00000041', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(42, 'SC00000042', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(43, 'SC00000043', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(44, 'SC00000044', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(45, 'SC00000045', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:09'),
(46, 'SC00000046', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:10'),
(47, 'SC00000047', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:10'),
(48, 'SC00000048', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:10'),
(49, 'SC00000049', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:10'),
(50, 'SC00000050', 'PO0226200000001', '3123', 'WH0001', 'In Stock', 1, '2021-02-26', 'ADMIN', '2020-02-26 10:29:10');

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
(1, 'SP00001', 'SP122', 'HENRY23', '(123) 123-1231', 'sy@sm.com.ph', 'ADDRESSER', '2020-02-26 10:19:55');

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
(7, 'ACC0105200007', 'CASHIER', '1234', 'Cashier', '2020-01-05 22:15:38');

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
(1, 'WH0001', 'WH12', '123123', '2020-02-26 10:22:45');

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
-- Indexes for table `product_model`
--
ALTER TABLE `product_model`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories_sub`
--
ALTER TABLE `categories_sub`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expired_stocks`
--
ALTER TABLE `expired_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generate_po`
--
ALTER TABLE `generate_po`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `installment_history`
--
ALTER TABLE `installment_history`
  MODIFY `insID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_model`
--
ALTER TABLE `product_model`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `soID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
