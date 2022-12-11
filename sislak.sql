-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 11, 2022 at 07:00 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sislak`
--

-- --------------------------------------------------------

--
-- Table structure for table `ais_accounts_config`
--

CREATE TABLE `ais_accounts_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `particular` varchar(30) NOT NULL,
  `particular_name` varchar(100) NOT NULL,
  `coa_level` tinyint(4) NOT NULL COMMENT '2=GL, 3=SL',
  `account_code` varchar(20) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_types.id',
  `gl_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_general_ledger.id',
  `sl_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_subsidiary_ledger.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ais_accounts_config`
--

INSERT INTO `ais_accounts_config` (`id`, `particular`, `particular_name`, `coa_level`, `account_code`, `type_id`, `gl_id`, `sl_id`) VALUES
(1, 'cash', 'Cash', 2, '1001000', 1, 1, 0),
(2, 'cash_in_hand', 'Cash In Hand', 3, '1001001', 1, 1, 1),
(3, 'accounts_payable', 'Accounts Payable', 2, '2005000', 3, 4, 0),
(4, 'accounts_payable_suppliers', 'Accounts Payable (Suppliers)', 3, '2005001', 3, 4, 2),
(5, 'accounts_receivable', 'Accounts Receivable', 2, '1020000', 1, 3, 0),
(6, 'accounts_receivable_customers', 'Accounts Receivable (Customers)', 3, '1020001', 1, 3, 3),
(7, 'others_income', 'Others Income', 0, '', 0, 0, 0),
(8, 'bad_debt_income', 'Bad Debt Income', 0, '3008001', 0, 0, 0),
(9, 'others_expense', 'Others Expense', 0, '4017000', 0, 0, 0),
(10, 'bad_debt_expense', 'Bad Debt Expense', 0, '4017001', 0, 0, 0),
(11, 'sales_income', 'Sales Income', 0, '3001000', 0, 0, 0),
(12, 'sales', 'Sales', 0, '3001002', 0, 0, 0),
(13, 'inventory_stock', 'Inventory Stock', 0, '1009001', 0, 0, 0),
(14, 'purchase_expenses', 'Purchase Expenses', 0, '4018000', 0, 0, 0),
(15, 'cost_of_goods', 'Cost of Goods Sold', 0, '4018001', 0, 0, 0),
(16, 'net_earnings', 'Net Earnings', 0, '2002000', 0, 0, 0),
(17, 'retain_surplus', 'Retain Surplus', 3, '2002000', 3, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ais_coa_general_ledger`
--

CREATE TABLE `ais_coa_general_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `ledger_head` varchar(250) NOT NULL,
  `ledger_code` varchar(100) NOT NULL,
  `type_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_types.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ais_coa_general_ledger`
--

INSERT INTO `ais_coa_general_ledger` (`id`, `ledger_head`, `ledger_code`, `type_id`) VALUES
(1, 'Tunai dan Bank', '1001000', 1),
(2, 'Pinjaman dari penjualan saat ini', '2002000', 3),
(3, 'Akun Piutang', '1020000', 1),
(4, 'Akun Hutang', '2005000', 3),
(5, 'Peralatan Kantor', '1002000', 1),
(9, 'Modal', '2003000', 3),
(10, 'Modal Bank', '2004000', 3),
(11, 'Penjualan Produk', '3001000', 4),
(13, 'Gaji', '4001000', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ais_coa_subsidiary_ledger`
--

CREATE TABLE `ais_coa_subsidiary_ledger` (
  `id` int(10) UNSIGNED NOT NULL,
  `ledger_head` varchar(250) NOT NULL,
  `ledger_code` varchar(100) NOT NULL,
  `general_ledger_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_general_ledger.id   ',
  `type_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_types.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ais_coa_subsidiary_ledger`
--

INSERT INTO `ais_coa_subsidiary_ledger` (`id`, `ledger_head`, `ledger_code`, `general_ledger_id`, `type_id`) VALUES
(1, 'Tunai', '1001001', 1, 1),
(2, 'Suppliers', '2005001', 4, 1),
(3, 'Customers', '1020001', 3, 1),
(4, 'Pendapatan Sebelumnya', '2002001', 2, 3),
(5, 'Bank BRI', '1001002', 1, 1),
(6, 'Pegawai', '4001001', 13, 2),
(7, 'Bank BCA', '1001003', 1, 1),
(8, 'Penjualan Genting', '3002001', 12, 4),
(9, 'Penjualan Genting', '3001001', 11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ais_coa_types`
--

CREATE TABLE `ais_coa_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `type_code` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ais_coa_types`
--

INSERT INTO `ais_coa_types` (`id`, `type_name`, `type_code`) VALUES
(1, 'PROPERTY AND ASSETS', '1000000'),
(2, 'EXPENSE', '4000000'),
(3, 'LIABILITY AND CAPITAL', '2000000'),
(4, 'INCOME', '3000000');

-- --------------------------------------------------------

--
-- Table structure for table `ais_general_config`
--

CREATE TABLE `ais_general_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `opening_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ais_subsidiary_calculation`
--

CREATE TABLE `ais_subsidiary_calculation` (
  `id` int(10) UNSIGNED NOT NULL,
  `particular_sl` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_subsidiary_ledger.id',
  `gl_ledger` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_general_ledger.id',
  `sub_ledger` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_subsidiary_ledger.id',
  `acc_type` int(11) NOT NULL COMMENT 'Foreign Key: ais_coa_types.id',
  `transaction_date` date NOT NULL,
  `debit_amount` double(11,2) NOT NULL,
  `credit_amount` double(11,2) NOT NULL,
  `voucher_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_vouchers.id',
  `voucher_details_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_voucher_details.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ais_subsidiary_calculation`
--

INSERT INTO `ais_subsidiary_calculation` (`id`, `particular_sl`, `gl_ledger`, `sub_ledger`, `acc_type`, `transaction_date`, `debit_amount`, `credit_amount`, `voucher_id`, `voucher_details_id`) VALUES
(1, 1, 1, 1, 1, '2022-08-25', 10000.00, 0.00, 1, 1),
(2, 1, 1, 1, 1, '2022-08-25', 0.00, 10000.00, 1, 1),
(25, 9, 1, 1, 1, '2022-12-10', 500000.00, 0.00, 12, 13),
(26, 1, 11, 9, 4, '2022-12-10', 0.00, 500000.00, 12, 13),
(27, 9, 1, 5, 1, '2022-12-10', 1500000.00, 0.00, 12, 14),
(28, 5, 11, 9, 4, '2022-12-10', 0.00, 1500000.00, 12, 14),
(29, 1, 13, 6, 2, '2022-12-04', 2000000.00, 0.00, 13, 15),
(30, 6, 1, 1, 1, '2022-12-04', 0.00, 2000000.00, 13, 15),
(31, 9, 1, 1, 1, '2022-12-09', 2000000.00, 0.00, 14, 16),
(32, 1, 11, 9, 4, '2022-12-09', 0.00, 2000000.00, 14, 16),
(33, 2, 1, 1, 1, '2022-12-11', 1000000.00, 0.00, 15, 17),
(34, 1, 4, 2, 1, '2022-12-11', 0.00, 1000000.00, 15, 17),
(35, 1, 4, 2, 1, '2022-12-11', 500000.00, 0.00, 16, 18),
(36, 2, 1, 1, 1, '2022-12-11', 0.00, 500000.00, 16, 18),
(37, 9, 1, 7, 1, '2022-12-11', 1000000.00, 0.00, 17, 19),
(38, 7, 11, 9, 4, '2022-12-11', 0.00, 1000000.00, 17, 19);

-- --------------------------------------------------------

--
-- Table structure for table `ais_vouchers`
--

CREATE TABLE `ais_vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `voucher_code` varchar(50) NOT NULL,
  `voucher_code_number` int(11) NOT NULL,
  `transaction_type` tinyint(4) NOT NULL COMMENT '1=Payment, 2=Receive, 3=Journal, 4=Contra',
  `transaction_amount` double(11,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ais_vouchers`
--

INSERT INTO `ais_vouchers` (`id`, `voucher_code`, `voucher_code_number`, `transaction_type`, `transaction_amount`, `transaction_date`, `remarks`) VALUES
(1, 'CV-1', 1, 4, 10000.00, '2022-08-25', 'Test'),
(12, 'RV-1', 1, 2, 2000000.00, '2022-12-10', 'Penjualan genting'),
(13, 'PV-1', 1, 1, 2000000.00, '2022-12-04', 'Gaji Pegawai'),
(14, 'RV-2', 2, 2, 2000000.00, '2022-12-09', 'Penjualan genting'),
(15, 'RV-3', 3, 2, 1000000.00, '2022-12-11', 'Bahan Baku'),
(16, 'PV-2', 2, 1, 500000.00, '2022-12-11', 'Bayar Hutang'),
(17, 'RV-4', 4, 2, 1000000.00, '2022-12-11', 'Penjualan Genting');

-- --------------------------------------------------------

--
-- Table structure for table `ais_voucher_details`
--

CREATE TABLE `ais_voucher_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `voucher_id` int(11) NOT NULL COMMENT 'Foreign Key: ais_vouchers.id',
  `dr_gl_ledger` int(11) NOT NULL,
  `dr_sub_ledger` int(11) NOT NULL,
  `cr_gl_ledger` int(11) NOT NULL,
  `cr_sub_ledger` int(11) NOT NULL,
  `transaction_amount` double(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ais_voucher_details`
--

INSERT INTO `ais_voucher_details` (`id`, `voucher_id`, `dr_gl_ledger`, `dr_sub_ledger`, `cr_gl_ledger`, `cr_sub_ledger`, `transaction_amount`) VALUES
(1, 1, 1, 1, 1, 1, 10000.00),
(13, 12, 1, 1, 11, 9, 500000.00),
(14, 12, 1, 5, 11, 9, 1500000.00),
(15, 13, 13, 6, 1, 1, 2000000.00),
(16, 14, 1, 1, 11, 9, 2000000.00),
(17, 15, 1, 1, 4, 2, 1000000.00),
(18, 16, 4, 2, 1, 1, 500000.00),
(19, 17, 1, 7, 11, 9, 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `currency_setting`
--

CREATE TABLE `currency_setting` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency` varchar(256) NOT NULL,
  `symbol` varchar(256) NOT NULL,
  `currency_text` varchar(256) NOT NULL,
  `currency_position` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency_setting`
--

INSERT INTO `currency_setting` (`id`, `currency`, `symbol`, `currency_text`, `currency_position`) VALUES
(1, '41', 'Rp', '-', '2');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(256) NOT NULL,
  `phone` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `logo` varchar(256) NOT NULL,
  `favicon` varchar(256) NOT NULL,
  `soft_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `phone`, `email`, `address`, `logo`, `favicon`, `soft_name`) VALUES
(1, 'CV. Super Dimas Amazing', '026171716171', 'superdimasamazing@gmail.com', 'Majalengka', '1660793959.png', '1576596798.png', 'CA Expert Accounting v1.0');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL,
  `user_name` varchar(256) NOT NULL,
  `table` varchar(256) NOT NULL,
  `action` varchar(256) NOT NULL,
  `changes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `date_time`, `user_id`, `user_name`, `table`, `action`, `changes`) VALUES
(1, '2022-08-25 08:58:57', 1, 'Admin', 'Contra Voucher Manage', 'Add New Data', 'CV-1, 1, 4, 10000, 2022-08-25, Test'),
(2, '2022-12-11 05:12:52', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-1, 1, 2, 5000000, 2022-12-11, Penjualan Product'),
(3, '2022-12-11 06:21:35', 1, 'Admin', 'Payment Voucher Manage', 'Add New Data', 'PV-1, 1, 1, 2500000, 2022-12-11, Beli Bahan Baku'),
(4, '2022-12-11 09:20:18', 1, 'Admin', 'Payment Voucher Manage', 'Add New Data', 'PV-2, 2, 1, 500000, 2022-12-11, Gaji Karyawan Minggu Ke-1 Bulan Desember'),
(5, '2022-12-11 09:26:46', 1, 'Admin', 'DESIGNATION', 'Add New Data', 'Andria, 087242145125, andria@gmail.com, Rumah, andria, $2y$10$tBKybbhJewpZdiuSrrKJ8OKGNU3vAAuCJTEMeEFPCHYXT6FudopIS, 2, , , , , 0, 1, Active'),
(6, '2022-12-11 09:28:01', 1, 'Admin', 'User Role Manage', 'Delete Data', '3, Assistant Accountant'),
(7, '2022-12-11 09:28:34', 1, 'Admin', 'User Role Manage', 'Delete Data', '2, Accounts Manager'),
(8, '2022-12-11 09:28:41', 1, 'Admin', 'User Role Manage', 'Add New Data', 'Bendahara'),
(9, '2022-12-11 09:30:14', 1, 'Admin', 'DESIGNATION', 'Add New Data', 'andria, 08724142913, andria@gmail.com, Rumah, andria, $2y$10$b.0d9Q.PvRhn0zbDnFJwSeikSisG59U2lC5/FyPyO6iSp5XbX2N86, 4, , , , , 0, 1, Active'),
(10, '2022-12-11 09:38:48', 1, 'Admin', 'DESIGNATION', 'Update Data', 'Admin, 021151252, superdimasamazing@gmail.com, Majalengka, admin, 1, , , , , 1, 1, Active'),
(11, '2022-12-11 14:18:28', 1, 'Admin', 'Journal Voucher Manage', 'Add New Data', 'JV-1, 1, 3, 2000000, 2022-12-10, Penjualan Genting'),
(12, '2022-12-11 14:21:39', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-2, 2, 2, 6000000, 2022-11-10, Gaji Karyawan Minggu Ke-2 Bulan November'),
(13, '2022-12-11 14:30:24', 1, 'Admin', 'Subsidiary Ledger Manage', 'Add New Data', 'Bank BRI, 1001002, 1, 1'),
(14, '2022-12-11 14:46:47', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-3, 3, 2, 1000000, 2022-12-11, a'),
(15, '2022-12-11 14:48:36', 1, 'Admin', 'Payment Voucher Delete', 'Delete Data', '3, PV-1, 1, 1, 2500000, 2022-12-11, Beli Bahan Baku'),
(16, '2022-12-11 14:49:00', 1, 'Admin', 'Receive Voucher Delete', 'Delete Data', '6, RV-2, 2, 2, 6000000, 2022-11-10, Gaji Karyawan Minggu Ke-2 Bulan November'),
(17, '2022-12-11 14:49:10', 1, 'Admin', 'Receive Voucher Delete', 'Delete Data', '2, RV-1, 1, 2, 5000000, 2022-12-11, Penjualan Product'),
(18, '2022-12-11 14:49:24', 1, 'Admin', 'Receive Voucher Delete', 'Delete Data', '7, RV-3, 3, 2, 1000000, 2022-12-11, a'),
(19, '2022-12-11 15:42:45', 1, 'Admin', 'Payment Voucher Delete', 'Delete Data', '4, PV-2, 2, 1, 500000, 2022-12-11, Gaji Karyawan Minggu Ke-1 Bulan Desember'),
(20, '2022-12-11 15:43:38', 1, 'Admin', 'Journal Voucher Delete', 'Delete Data', '5, JV-1, 1, 3, 2000000, 2022-12-10, Penjualan Genting'),
(21, '2022-12-11 15:43:57', 1, 'Admin', 'Subsidiary Ledger Manage', 'Add New Data', 'Pegawai, 4001001, 13, 2'),
(22, '2022-12-11 15:44:27', 1, 'Admin', 'Journal Voucher Manage', 'Add New Data', 'JV-1, 1, 3, 1500000, 2022-12-11, Gaji'),
(23, '2022-12-11 15:46:38', 1, 'Admin', 'Payment Voucher Manage', 'Add New Data', 'PV-1, 1, 1, 2000000, 2022-12-11, gaji'),
(24, '2022-12-11 15:47:45', 1, 'Admin', 'Subsidiary Ledger Manage', 'Add New Data', 'Cash in Foot, 1001003, 1, 1'),
(25, '2022-12-11 15:48:08', 1, 'Admin', 'Payment Voucher Manage', 'Add New Data', 'PV-2, 2, 1, 1000000, 2022-12-11, Gaji'),
(26, '2022-12-11 15:50:21', 1, 'Admin', 'Subsidiary Ledger Manage', 'Add New Data', 'Superman, 3002001, 12, 4'),
(27, '2022-12-11 15:50:42', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-1, 1, 2, 500000, 2022-12-11, duit'),
(28, '2022-12-11 15:52:04', 1, 'Admin', 'Payment Voucher Delete', 'Delete Data', '10, PV-2, 2, 1, 1000000, 2022-12-11, Gaji'),
(29, '2022-12-11 15:52:06', 1, 'Admin', 'Payment Voucher Delete', 'Delete Data', '9, PV-1, 1, 1, 2000000, 2022-12-11, gaji'),
(30, '2022-12-11 15:52:28', 1, 'Admin', 'Receive Voucher Delete', 'Delete Data', '11, RV-1, 1, 2, 500000, 2022-12-11, duit'),
(31, '2022-12-11 15:53:41', 1, 'Admin', 'Journal Voucher Delete', 'Delete Data', '8, JV-1, 1, 3, 1500000, 2022-12-11, Gaji'),
(32, '2022-12-11 15:54:15', 1, 'Admin', 'General Ledger Manage', 'Delete Data', '12, Hosting Sell, 3002000, 4'),
(33, '2022-12-11 16:13:08', 1, 'Admin', 'Subsidiary Ledger Manage', 'Add New Data', 'Penjualan Genting, 3001001, 11, 4'),
(34, '2022-12-11 16:14:05', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-1, 1, 2, 2000000, 2022-12-10, Penjualan genting'),
(35, '2022-12-11 16:17:44', 1, 'Admin', 'Payment Voucher Manage', 'Add New Data', 'PV-1, 1, 1, 2000000, 2022-12-04, Gaji Pegawai'),
(36, '2022-12-11 16:18:51', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-2, 2, 2, 2000000, 2022-12-09, Penjualan genting'),
(37, '2022-12-11 16:39:49', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-3, 3, 2, 1000000, 2022-12-11, Bahan Baku'),
(38, '2022-12-11 16:41:14', 1, 'Admin', 'Payment Voucher Manage', 'Add New Data', 'PV-2, 2, 1, 500000, 2022-12-11, Bayar Hutang'),
(39, '2022-12-11 16:49:01', 1, 'Admin', 'Receive Voucher Manage', 'Add New Data', 'RV-4, 4, 2, 1000000, 2022-12-11, Penjualan Genting');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(99) NOT NULL,
  `username` varchar(33) NOT NULL,
  `password` varchar(66) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_role` tinyint(4) NOT NULL COMMENT '1=Admin',
  `create_per` int(11) DEFAULT NULL,
  `edit_per` int(11) DEFAULT NULL,
  `delete_per` int(11) DEFAULT NULL,
  `report_per` int(11) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `accounts` int(11) NOT NULL,
  `status` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `designation`, `mobile`, `address`, `email`, `username`, `password`, `remember_token`, `user_role`, `create_per`, `edit_per`, `delete_per`, `report_per`, `admin`, `accounts`, `status`) VALUES
(1, 'Admin', 'Admin', '021151252', 'Majalengka', 'superdimasamazing@gmail.com', 'admin', '$2y$10$Ydjfa22tILZjybXlS7Tm7uRHfxFFrcDYdAABwUsZHvttsjShi4buq', 'vAL4vRitGVxLbEMjHf5v5WpptmN1gCInQ8zgbgXds0UdJV9yEGSxAcw3mZqs', 1, NULL, NULL, NULL, NULL, 1, 1, 'Active'),
(2, 'Andria', NULL, '087242145125', 'Rumah', 'andria@gmail.com', 'andria', '$2y$10$tBKybbhJewpZdiuSrrKJ8OKGNU3vAAuCJTEMeEFPCHYXT6FudopIS', '7ih5NEUqko6V1MQo9RzKdR7yxOACidoPipNsvpdYVrgsd5xfEdhK71hOCyZt', 2, NULL, NULL, NULL, NULL, 0, 1, 'Active'),
(3, 'andria', NULL, '08724142913', 'Rumah', 'andria@gmail.com', 'andria', '$2y$10$b.0d9Q.PvRhn0zbDnFJwSeikSisG59U2lC5/FyPyO6iSp5XbX2N86', NULL, 4, NULL, NULL, NULL, NULL, 0, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role_name`) VALUES
(1, 'Admin'),
(4, 'Bendahara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ais_accounts_config`
--
ALTER TABLE `ais_accounts_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ais_coa_general_ledger`
--
ALTER TABLE `ais_coa_general_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ais_coa_subsidiary_ledger`
--
ALTER TABLE `ais_coa_subsidiary_ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ais_coa_types`
--
ALTER TABLE `ais_coa_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ais_general_config`
--
ALTER TABLE `ais_general_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ais_subsidiary_calculation`
--
ALTER TABLE `ais_subsidiary_calculation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ais_vouchers`
--
ALTER TABLE `ais_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ais_voucher_details`
--
ALTER TABLE `ais_voucher_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency_setting`
--
ALTER TABLE `currency_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ais_accounts_config`
--
ALTER TABLE `ais_accounts_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ais_coa_general_ledger`
--
ALTER TABLE `ais_coa_general_ledger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ais_coa_subsidiary_ledger`
--
ALTER TABLE `ais_coa_subsidiary_ledger`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ais_coa_types`
--
ALTER TABLE `ais_coa_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ais_general_config`
--
ALTER TABLE `ais_general_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ais_subsidiary_calculation`
--
ALTER TABLE `ais_subsidiary_calculation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `ais_vouchers`
--
ALTER TABLE `ais_vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ais_voucher_details`
--
ALTER TABLE `ais_voucher_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `currency_setting`
--
ALTER TABLE `currency_setting`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
