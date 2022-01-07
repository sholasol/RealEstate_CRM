-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2021 at 01:22 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kerea`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_list`
--

CREATE TABLE `account_list` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `account` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `account_list`
--

INSERT INTO `account_list` (`id`, `code`, `account`) VALUES
(1, 1000, 'Cash to Deposit'),
(2, 1001, 'Cash Draw'),
(3, 1002, 'Petty Cash'),
(4, 1003, 'Saving Account'),
(5, 1004, 'Chequing Account'),
(6, 1006, 'foreign currency '),
(7, 1007, 'total cash'),
(8, 1008, 'visa receivable '),
(9, 1009, 'master and receivable '),
(10, 1010, 'other credit receivable '),
(11, 1011, 'investment '),
(12, 1012, 'account receivable '),
(13, 1013, 'allowance for doubt   account'),
(14, 1014, 'advance and loan '),
(15, 1015, 'total receivable '),
(16, 1016, 'purchase repayment '),
(17, 1017, 'prepaid expenses '),
(18, 1018, 'total current asset '),
(19, 1019, 'inventory asset'),
(20, 1020, 'capital asset'),
(21, 1020, 'lease hold improvement '),
(22, 1021, 'office furniture and equipment '),
(23, 1022, 'account amount and equipment '),
(24, 1023, 'net furniture and equipment '),
(25, 1024, 'Vehicle'),
(26, 1025, 'federal fax payable '),
(27, 1026, 'total receiver general '),
(28, 1027, 'WCB payable'),
(29, 1028, 'user-defined expense/pay '),
(30, 1029, 'user-defined expense 2 payable'),
(31, 1030, 'user-defined 3 payable '),
(32, 1031, 'user-defined expense  4 payable '),
(33, 1032, 'user-defined expense 5 payable'),
(34, 1033, 'deduction 1 payable '),
(35, 1034, 'deduction 2 payable '),
(36, 1035, 'deduction 3 payable '),
(37, 1036, 'deduction 4 payable '),
(38, 1037, 'deduction 5 payable '),
(39, 1038, 'GST/HST paid on sales '),
(40, 1039, 'GST/HST changed on sales-rate 2'),
(41, 1040, 'GST/HST paid on purchases'),
(42, 1041, 'GST/HST payroll deduction '),
(43, 1042, 'GST/HST adjustment '),
(44, 1043, 'ITC adjustment '),
(45, 1044, 'GST/HST owing (defined)'),
(46, 1045, 'prepaid sale /expense '),
(47, 1046, 'total current liabilities '),
(48, 1047, 'cony term liabilities '),
(49, 1048, 'bank loan '),
(50, 1049, 'mortagage payable'),
(51, 1050, 'loan from owners '),
(52, 1051, 'adjustment write -off '),
(53, 1052, 'transfer cost'),
(54, 1053, 'subcontract '),
(55, 1054, 'purchases '),
(56, 1055, 'purchases return '),
(57, 1056, 'early payment purchases discount '),
(58, 1057, 'net purchases '),
(59, 1058, 'freight expenses '),
(60, 1059, 'total lost of good sold '),
(61, 1060, 'payroll expense '),
(62, 1061, 'wages and salaries '),
(63, 1062, 'EL expense '),
(64, 1063, 'ECP expense '),
(65, 1064, 'WCB expense '),
(66, 1065, 'user-defined expense 1 expense '),
(67, 1066, 'user-defined expense 2 expense '),
(68, 1067, 'user-defined expense 3 expense '),
(69, 1068, 'user-defined expense 4 expense '),
(70, 1069, 'user-defined expense 5 expense '),
(71, 1070, 'employee benefit '),
(72, 1071, 'total payroll expense '),
(73, 1072, 'general and administrative expense '),
(74, 1073, 'accounting and legal '),
(75, 1074, 'advertising and promoting '),
(76, 1075, 'bad debt '),
(77, 1076, 'business fee and license '),
(78, 1077, 'cash short/over'),
(79, 1078, 'carries and postage '),
(80, 1079, 'credit card changes '),
(81, 1080, 'current exchange and rounding '),
(82, 1081, 'amortization expense '),
(83, 1082, 'income taxes '),
(84, 1083, 'insurance '),
(85, 1084, 'interest and bank changes '),
(86, 1085, 'office sup[lies '),
(87, 1086, 'properly taxes '),
(88, 1087, 'motor vehicle expense '),
(89, 1088, 'miscellaneous expense '),
(90, 1089, 'realized exchange gain/lose '),
(91, 1090, 'rent'),
(92, 1091, 'repair and maintenance  '),
(93, 1092, 'telephone '),
(94, 1093, 'travel and entertainment '),
(95, 1094, 'travel and entertainment -non- reimbursable '),
(96, 1095, 'utilities '),
(97, 1096, 'visa commission '),
(98, 1097, 'master and commission '),
(99, 1098, 'america express commission '),
(100, 1099, 'other credit card commission '),
(101, 1100, 'total credit admin expense '),
(102, 1101, 'building account- amort -vehicle '),
(103, 1102, 'net- vehicle '),
(104, 1103, 'building '),
(105, 1104, 'accounting- amort -building '),
(106, 1105, 'net- building '),
(107, 1106, 'land'),
(108, 1107, 'total capital asset '),
(109, 1108, 'other non- current asset '),
(110, 1109, 'computer software '),
(111, 1110, 'goodwill '),
(112, 1111, 'incorporation cost '),
(113, 1112, 'total other non-current asset '),
(114, 1113, 'current liabilities '),
(115, 1114, 'account payable '),
(116, 1115, 'import duty cleaning '),
(117, 1116, 'bank loan current portion '),
(118, 1117, 'bank advance '),
(119, 1118, 'master card payable '),
(120, 1119, 'visa payable '),
(121, 1120, 'american express payable '),
(122, 1121, 'other credit card payable '),
(123, 1122, 'total credit card payable '),
(124, 1123, 'corporate taxes payable '),
(125, 1124, 'vacation payable '),
(126, 1125, 'EL payable '),
(127, 1126, 'cpp payable'),
(128, 1127, 'total loan long term liabilities '),
(129, 1128, 'owners equity '),
(130, 1129, 'owners contribution '),
(131, 1130, 'owners withdrawals '),
(132, 1131, 'retained earnings -previous year '),
(133, 1132, 'current earnings '),
(134, 1133, 'total owners equity '),
(135, 1134, 'sales revenue '),
(136, 1135, 'sales revenue A'),
(137, 1136, 'sales revenue B'),
(138, 1137, 'sales revenue C'),
(139, 1138, 'sales '),
(140, 1139, 'sales return '),
(141, 1140, 'early payment sales discount '),
(142, 1141, 'Net sales '),
(143, 1142, 'other revenue '),
(144, 1143, 'freight revenue '),
(145, 1144, 'interest revenue '),
(146, 1145, 'miscellaneous revenue '),
(147, 1146, 'total other revenue '),
(148, 1147, 'cost of good sold '),
(149, 1148, 'inventory A cost'),
(150, 1149, 'inventory B cost '),
(151, 1150, 'inventory C cost'),
(152, 1151, 'inventory variance '),
(153, 1152, 'item assembly costs ');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `activity` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `userID`, `activity`, `created`) VALUES
(1, 5, 'User System Admin logged in', '2021-10-02 13:35:35');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `purchased` date NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `replace_value` decimal(10,0) NOT NULL,
  `serialno` varchar(50) NOT NULL,
  `doc` varchar(100) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `asset_type`
--

CREATE TABLE `asset_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` enum('current','fixed','intangible','investment','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `time_in` varchar(20) NOT NULL,
  `time_out` varchar(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `account` varchar(13) NOT NULL,
  `account_name` varchar(200) NOT NULL,
  `routing` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `obalance` decimal(10,0) NOT NULL,
  `balance` decimal(65,2) NOT NULL,
  `transactions` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `compID` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `last_transact` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `bank`, `account`, `account_name`, `routing`, `code`, `obalance`, `balance`, `transactions`, `created`, `createdby`, `compID`, `status`, `last_transact`) VALUES
(1, 'Guarantees Trust Bank', '0162022242', 'Kerae Homes Limited', '', '', '10000000', '10000000.00', NULL, '2020-07-04', 4, 4, 'Active', '2021-09-29 08:01:06'),
(2, 'Zenith Bank', '1014432931', 'Kerae Homes Limited', '', '', '10000000', '10000000.00', NULL, '2020-07-06', 4, 4, 'Active', '2021-09-29 08:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `benefit`
--

CREATE TABLE `benefit` (
  `id` int(11) NOT NULL,
  `bebefit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `post_title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `blog_images`
--

CREATE TABLE `blog_images` (
  `id` int(11) NOT NULL,
  `post_id` int(50) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `branch` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `contact` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch`, `phone`, `contact`, `created`, `createdby`) VALUES
(1, 'Headquarter', '09013032243', 10, '2019-09-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `capital`
--

CREATE TABLE `capital` (
  `id` int(11) NOT NULL,
  `amount` decimal(65,5) NOT NULL,
  `note` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `type` enum('deposit','withdrawal') NOT NULL,
  `expenseid` int(11) NOT NULL,
  `account_credited_id` int(11) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `account_debited_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `claim`
--

CREATE TABLE `claim` (
  `id` int(11) NOT NULL,
  `userID` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `cphone` varchar(15) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `estate` varchar(200) DEFAULT NULL,
  `plot` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `fromaccount` varchar(100) DEFAULT NULL,
  `amountpaid` varchar(200) DEFAULT NULL,
  `paymentplan` varchar(200) DEFAULT NULL,
  `evidence` varchar(50) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `datepaid` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `commission` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `company_type` varchar(70) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `email`, `phone`, `state`, `zip`, `company_type`, `account_type`, `logo`) VALUES
(1, 'KERAE HOMES LIMITED', 'Km 36, Ero’s House, Duplex 2 Eputu, Lekki, Expressway, Lagos', 'info@keraehomes.com', '0913 3332 200', 'Lagos', '105101', NULL, NULL, 'upload/264238.png');

-- --------------------------------------------------------

--
-- Table structure for table `companyAccount`
--

CREATE TABLE `companyAccount` (
  `id` int(11) NOT NULL,
  `account` varchar(20) NOT NULL,
  `start_no` int(11) NOT NULL,
  `end_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `companyAccount`
--

INSERT INTO `companyAccount` (`id`, `account`, `start_no`, `end_no`) VALUES
(1, 'liability', 1000, 1999);

-- --------------------------------------------------------

--
-- Table structure for table `consultantC`
--

CREATE TABLE `consultantC` (
  `id` int(11) NOT NULL,
  `consultant` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consultants`
--

CREATE TABLE `consultants` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `bank` varchar(200) DEFAULT NULL,
  `account` varchar(15) DEFAULT NULL,
  `accname` varchar(200) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `origin` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `createdby` int(11) DEFAULT NULL,
  `referral` varchar(11) DEFAULT NULL,
  `mycode` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultants`
--

INSERT INTO `consultants` (`id`, `fname`, `lname`, `phone`, `email`, `bank`, `account`, `accname`, `dob`, `city`, `origin`, `country`, `address`, `created`, `createdby`, `referral`, `mycode`) VALUES
(1, 'Ayomide', 'Akerele', '09088877700', 'ay@yahoo.com', 'GTBank', '00012340909', 'Ayomide Akerele', '2021-09-08', 'Badore', 'Lagos', 'Nigeria', NULL, '2021-09-07 23:00:00', NULL, NULL, NULL),
(2, 'John', 'Paul', '09088899900', 'john@mail.com', 'Access Bank', '12345678923', 'John Paul', '2021-09-07', 'Abijo', 'Lagos', 'Nigeria', NULL, '2021-09-07 23:00:00', NULL, NULL, NULL),
(3, 'Seun', 'Adetona', '08012345678', 'seun@email.com', 'Zenith', '00123987601', 'Seun Adetona', '2021-09-06', 'Abijo', 'Ekiti', 'Nigeria', NULL, '2021-09-07 23:00:00', NULL, NULL, NULL),
(4, 'Ola', 'Olu', '07044567809', 'ola@yahoo.com', 'GTBank', '0102345670', 'Ola Olu', NULL, 'Lagos', NULL, NULL, NULL, '2021-09-07 23:00:00', 5, '', NULL),
(5, 'Emmanuel', 'James', '08076543241', 'emmanuel@email.com', 'Access Bank', '02345678900', 'Emmanuel James', '2008-08-14', 'Lagos', 'Ekiti', 'Nigeria', NULL, '2021-09-07 23:00:00', NULL, 'KERAE12423', NULL),
(6, 'Solomon', 'Emmanuel', '07034256700', 'solomon.e@yahoo.com', 'GTbank', '1000100010', 'Solomon Emmanuel', '2021-09-16', 'Lagos', 'Lagos', 'Nigeria', NULL, '2021-09-15 23:00:00', NULL, 'KERAE12423', NULL),
(7, 'Wess', 'Brown', '07099900090', 'wess@email.com', '', '', '', '2021-09-16', 'Lagos', 'Lagos', 'N', NULL, '2021-09-17 23:00:00', NULL, '', 'KERAE12423');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `occupation` varchar(200) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `marital` varchar(50) DEFAULT NULL,
  `dateofbirth` varchar(20) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `kinFN` varchar(100) DEFAULT NULL,
  `kinLN` varchar(110) DEFAULT NULL,
  `kinPhone` varchar(100) DEFAULT NULL,
  `kinEmail` varchar(100) DEFAULT NULL,
  `kinAddress` varchar(100) DEFAULT NULL,
  `kinState` varchar(100) DEFAULT NULL,
  `kinRelation` varchar(100) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Active',
  `modifyby` int(11) DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `dedComponent`
--

CREATE TABLE `dedComponent` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `deduction` varchar(50) NOT NULL,
  `value` double NOT NULL,
  `amount` double(65,2) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `cheque` varchar(10) DEFAULT NULL,
  `bank` int(11) NOT NULL,
  `account` varchar(12) NOT NULL,
  `amount` double NOT NULL,
  `depositor` int(11) NOT NULL,
  `received` int(11) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `depreciationAcc`
--

CREATE TABLE `depreciationAcc` (
  `id` int(11) NOT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `oname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `marital` varchar(20) NOT NULL,
  `job` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `bank` varchar(100) DEFAULT NULL,
  `account` varchar(15) DEFAULT NULL,
  `address` text NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `deduction_id` int(11) DEFAULT NULL,
  `entitlement_id` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `emp_deduction`
--

CREATE TABLE `emp_deduction` (
  `id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `deduction` varchar(100) NOT NULL,
  `rate` double NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `emp_pay`
--

CREATE TABLE `emp_pay` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `gross` double(65,2) DEFAULT NULL,
  `basic` double(65,2) DEFAULT NULL,
  `benefit` double(65,2) DEFAULT NULL,
  `deduction` double(65,2) DEFAULT NULL,
  `net` double(65,2) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `paidby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary`
--

CREATE TABLE `emp_salary` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `component` varchar(50) NOT NULL,
  `value` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `emp_tax`
--

CREATE TABLE `emp_tax` (
  `id` int(11) NOT NULL,
  `tax` text NOT NULL,
  `grade` int(11) NOT NULL,
  `rate` double NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `entitlement`
--

CREATE TABLE `entitlement` (
  `id` int(11) NOT NULL,
  `entitlement` varchar(100) NOT NULL,
  `grade` int(11) NOT NULL,
  `category` varchar(40) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `value` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `estate`
--

CREATE TABLE `estate` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `createdby` varchar(255) DEFAULT NULL,
  `updatedby` varchar(200) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estateImg`
--

CREATE TABLE `estateImg` (
  `id` int(11) NOT NULL,
  `estate` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

CREATE TABLE `estates` (
  `id` int(11) NOT NULL,
  `estate_name` varchar(255) DEFAULT NULL,
  `estate_description` longtext DEFAULT NULL,
  `feature1` text DEFAULT NULL,
  `feature2` text DEFAULT NULL,
  `feature3` text DEFAULT NULL,
  `estate_location` varchar(50) DEFAULT NULL,
  `feature4` text DEFAULT NULL,
  `feature5` text DEFAULT NULL,
  `feature6` text DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `added` date DEFAULT NULL,
  `price` double DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `estate_name`, `estate_description`, `feature1`, `feature2`, `feature3`, `estate_location`, `feature4`, `feature5`, `feature6`, `amenities`, `added`, `price`, `type`) VALUES
(1, 'BAYLINE ESTATE', '&lt;p style=&quot;text-align: justify;&quot;&gt;Bayline estate strikes the lead into an uncultivated piece of real estate in Nigeria, bringing you home so close to the bay, a broad inlet of the sea where the land shrubs with deep green leaves. The creation of Kerae homes a perfect show of creativity and an architectural masterpiece on various levels, Bayline estate is the comparatively wild passage connecting to the future refuge island, given you an opportunity to behold the display of mastery of God&amp;rsquo;s creation at its peak. We take the vision which comes from our dreams synergized with thought and applies the magic of engineering and architectural prowess, building you a heritage out of our profession. A stunning waterfront community in Area with rapid development expected to become a central hub for business, manufacturing, warehousing, and logistics of the Africa continent. Our vision is to explore the virgin dimensions of architecture, giving Nigeria a reputation among other African nations when luxurious and vintage homes. And creating a home that soothes the curiosity of every buyer given the most profound satisfaction. Bayline estate is an estate with four different communities namely: Olga, Harmony, Jaspa, and Concord. Each community has its unique state-of-the-art modern design structures furnished with 21st-century facilities.&lt;/p&gt;', 'Serene Environment', 'Shopping Mall', 'Secure Packing', 'Ibeju Lekki', 'Indoor Lounge', 'Swimming Pool', 'Sport Center', NULL, '2021-10-02', 19000000, 'Duplex'),
(2, 'BIJOU', '&lt;p style=&quot;text-align: justify;&quot;&gt;Inspired by over two thousand years of great architectural works from Greece, and our founder&amp;rsquo;s love for vintage home designs, comes BIJOU Estate.&lt;br /&gt;A mini-estate at the heart of Sangotedo, behind Novaro mall. This masterpiece of both architectural and artistic design will blow your mind.&lt;br /&gt;Not just Bijou, at Kerae Home Limited, we do not follow trends; we pride ourselves in designs of monumental and luxury.&lt;br /&gt;At the estate of only 15 units with features like swimming pool, sport center, indoor lounge and many more.&lt;/p&gt;', 'Serene Environment', 'Shopping Mall', 'Secure Packing', 'Sangotedo', 'Indoor Lounge', 'Swimming Pool', 'Sport Center', NULL, '2021-10-02', 20000000, 'Duplex'),
(3, 'HAMLET APARTMENTS', '&lt;p style=&quot;text-align: justify;&quot;&gt;Hamlet Apartment is a luxury estate in Nigeria, located in the heart of new Lagos Ibeju-Lekki lagos Nigeria. An area with rapid development expected to become a central hub for business, manufacturing, warehousing, and logistics of Africa continent. An area that housed Dangote refinery, free trade zone, Deepsea port, pan Atlantic university, international airport among others. Infact the place is refers to as new lagos.&lt;br /&gt;Hamlet Apartment Is a full serviced apartment community, comprising 1-BD, 2-BD, 3-BD &amp;amp; 3BED TERRACES with BQ. Each of the apartments are Spacious for the family. The designs are carefully created to synergize comfort and elegance giving you that perfect home experience.&lt;br /&gt;It is a family affair here. When you buy from Kerae Homes, you automatically become a family. We don&amp;rsquo;t treat you like number, we know you to be family. In as much that we are in business for real estate development, we never forget the fact that there&amp;rsquo;s human side to what we do. That&amp;rsquo;s what makes us thick. Owns a home at hamlet apartments and Enjoy the facilities such as.&lt;/p&gt;', 'Serene Environment', 'Shopping Mall', 'Secure Packing', 'Ibeju Lekki', 'Indoor Lounge', 'Swimming Pool', 'Sport Center', NULL, '2021-10-02', 20000000, 'Terrace');

-- --------------------------------------------------------

--
-- Table structure for table `estate_front`
--

CREATE TABLE `estate_front` (
  `id` int(11) NOT NULL,
  `estate_id` int(11) NOT NULL,
  `estate_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estate_images`
--

CREATE TABLE `estate_images` (
  `id` int(40) NOT NULL,
  `estate_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `estate_images`
--

INSERT INTO `estate_images` (`id`, `estate_name`, `image`, `created`) VALUES
(1, 'BAYLINE ESTATE', 'upload/bayline.jpg', '2021-10-02'),
(2, 'BAYLINE ESTATE', 'upload/bayline2.jpg', '2021-10-02'),
(3, 'BAYLINE ESTATE', 'upload/bayline3.jpg', '2021-10-02'),
(4, 'BAYLINE ESTATE', 'upload/bayline4.jpg', '2021-10-02'),
(5, 'BAYLINE ESTATE', 'upload/bayline5.jpg', '2021-10-02'),
(6, 'BIJOU', 'upload/bijou.jpg', '2021-10-02'),
(7, 'BIJOU', 'upload/bijou2.jpg', '2021-10-02'),
(8, 'BIJOU', 'upload/bijou3.jpg', '2021-10-02'),
(9, 'BIJOU', 'upload/bijou4.jpg', '2021-10-02'),
(10, 'BIJOU', 'upload/bijou5.jpg', '2021-10-02'),
(11, 'HAMLET APARTMENTS', 'upload/hamlet.jpg', '2021-10-02'),
(12, 'HAMLET APARTMENTS', 'upload/hamlet2.jpg', '2021-10-02'),
(13, 'HAMLET APARTMENTS', 'upload/hamlet3.jpg', '2021-10-02'),
(14, 'HAMLET APARTMENTS', 'upload/hamlet4.jpg', '2021-10-02'),
(15, 'HAMLET APARTMENTS', 'upload/hamlet5.jpg', '2021-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `type` text DEFAULT NULL,
  `item` varchar(200) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `amount` decimal(65,2) NOT NULL,
  `total` double(65,2) DEFAULT NULL,
  `recurring` varchar(5) NOT NULL DEFAULT 'No',
  `recurring_freq` varchar(50) DEFAULT NULL,
  `rec_start` date DEFAULT NULL,
  `rec_end` date DEFAULT NULL,
  `rec_next` date DEFAULT NULL,
  `rec_type` enum('day','week','month','year') DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `code` int(11) NOT NULL,
  `notify` varchar(5) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`id`, `type`) VALUES
(1, 'Internet'),
(2, 'Transportation'),
(3, 'Entertainment'),
(4, 'Stationary'),
(5, 'Fuel');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `head` varchar(255) DEFAULT NULL,
  `baale` varchar(255) DEFAULT NULL,
  `secretary` varchar(255) DEFAULT NULL,
  `member1` varchar(255) DEFAULT NULL,
  `member2` varchar(255) DEFAULT NULL,
  `member3` varchar(255) DEFAULT NULL,
  `family` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `fee` varchar(100) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `fee`, `created`, `createdby`) VALUES
(1, 'Deed of Assignment', '2020-03-13', 5),
(2, 'Survey Fee', '2020-03-13', 5),
(3, 'Developmental Fee', '2020-03-13', 5),
(4, 'Test', '2021-09-16', 5);

-- --------------------------------------------------------

--
-- Table structure for table `fyear`
--

CREATE TABLE `fyear` (
  `id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `year` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int(11) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `grade`, `created`, `createdby`) VALUES
(1, 'General Manager', '2020-06-12', 1),
(2, 'Manager', '2020-06-12', 2),
(3, 'Secretary', '2020-06-12', 2),
(4, 'Operation Manager', '2020-06-12', 2),
(5, 'Account Manager', '2020-06-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permission`) VALUES
(1, 'Standard User', ''),
(2, 'Administrator', '{\"admin\": 1, \"moderator\": 1}');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `job` varchar(200) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `job`, `created`, `createdby`) VALUES
(1, 'Software Developer', '2019-08-28', 2),
(2, 'Accountant', '2019-08-28', 2),
(3, 'Human Resources', '2019-08-28', 2),
(4, 'General Manager', '2020-03-23', 5),
(5, 'Operation Manager', '2020-03-23', 5),
(6, 'Secretary', '2020-03-23', 5),
(7, 'Sales', '2020-03-23', 5);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `id` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `journal_entry`
--

CREATE TABLE `journal_entry` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `transaction` enum('repayment','disbursement','payment','deposit','withdrawal','charge','expense','payroll','income') NOT NULL,
  `name` text NOT NULL,
  `expense_id` int(11) NOT NULL,
  `income_id` int(11) NOT NULL,
  `capital_id` int(11) NOT NULL,
  `debit` decimal(65,5) NOT NULL,
  `credit` decimal(65,5) NOT NULL,
  `balance` decimal(65,5) NOT NULL,
  `branch` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `month` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE `lead` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `interest` text DEFAULT NULL,
  `progress` varchar(255) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL,
  `remark` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_activity`
--

CREATE TABLE `lead_activity` (
  `id` int(11) NOT NULL,
  `lead` int(11) NOT NULL,
  `activity` text DEFAULT NULL,
  `progress` varchar(50) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `purpose` text NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `created` date NOT NULL,
  `branch` int(11) NOT NULL,
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE `leave_type` (
  `id` int(11) NOT NULL,
  `type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `type`) VALUES
(1, 'Education'),
(2, 'Maternity'),
(3, 'Sick'),
(4, 'Annual'),
(5, 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int(11) NOT NULL,
  `item` varchar(300) NOT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `amount` double(65,2) NOT NULL,
  `term` int(11) NOT NULL,
  `repay` varchar(50) NOT NULL,
  `purpose` text NOT NULL,
  `type` text DEFAULT NULL,
  `created` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `branch` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `loan_type`
--

CREATE TABLE `loan_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `loan_type`
--

INSERT INTO `loan_type` (`id`, `type`) VALUES
(1, 'Study'),
(2, 'Car');

-- --------------------------------------------------------

--
-- Table structure for table `mgtSalAcc`
--

CREATE TABLE `mgtSalAcc` (
  `id` int(11) NOT NULL,
  `management` int(11) DEFAULT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_transportation`
--

CREATE TABLE `mode_of_transportation` (
  `id` int(11) NOT NULL,
  `mode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `mode_of_transportation`
--

INSERT INTO `mode_of_transportation` (`id`, `mode`) VALUES
(1, 'Airplane'),
(2, 'Train'),
(3, 'Road'),
(4, 'Sea');

-- --------------------------------------------------------

--
-- Table structure for table `next_kin`
--

CREATE TABLE `next_kin` (
  `id` bigint(20) NOT NULL,
  `employee` bigint(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `relationship` enum('Child','Spouse','Parent','Other') DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `officeSupAcc`
--

CREATE TABLE `officeSupAcc` (
  `id` int(11) NOT NULL,
  `item` varchar(200) DEFAULT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `operationAcc`
--

CREATE TABLE `operationAcc` (
  `id` int(11) NOT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` bigint(20) NOT NULL,
  `order_no` varchar(15) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `datepaid` varchar(20) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `teller_num` varchar(50) DEFAULT NULL,
  `name_on_teller` varchar(50) DEFAULT NULL,
  `confirmation` varchar(5) NOT NULL DEFAULT 'no',
  `custID` bigint(20) DEFAULT NULL,
  `payment_type` varchar(50) NOT NULL DEFAULT 'Land Payment',
  `staff` int(11) DEFAULT NULL,
  `remark` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account` varchar(12) NOT NULL,
  `amount` decimal(65,5) NOT NULL,
  `month` varchar(20) NOT NULL,
  `year` varchar(10) NOT NULL,
  `recurrring` varchar(5) NOT NULL DEFAULT 'Yes',
  `rec_next` date NOT NULL,
  `rec_type` enum('day','month','year') NOT NULL,
  `branch` int(11) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `pettyCash`
--

CREATE TABLE `pettyCash` (
  `id` int(11) NOT NULL,
  `item` int(11) DEFAULT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `pinvoice`
--

CREATE TABLE `pinvoice` (
  `id` int(11) NOT NULL,
  `venID` int(11) NOT NULL,
  `order_no` varchar(10) NOT NULL,
  `item` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `tax` double NOT NULL,
  `tax_value` double NOT NULL,
  `total` double NOT NULL,
  `code` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `porder`
--

CREATE TABLE `porder` (
  `id` int(11) NOT NULL,
  `venID` int(11) NOT NULL,
  `order_no` varchar(200) NOT NULL,
  `item` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `tax_value` double DEFAULT NULL,
  `total` double NOT NULL,
  `tax` double NOT NULL,
  `salesperson` int(11) DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL,
  `code` int(11) NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `pquote`
--

CREATE TABLE `pquote` (
  `id` int(11) NOT NULL,
  `venID` int(11) NOT NULL,
  `quote_no` varchar(10) DEFAULT NULL,
  `item` varchar(300) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `tax` double DEFAULT NULL,
  `tax_value` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `branch` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product` varchar(200) NOT NULL,
  `cprice` double NOT NULL,
  `sprice` double NOT NULL,
  `qty` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `qsold` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `project` varchar(200) NOT NULL,
  `start` date DEFAULT NULL,
  `unit` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Active',
  `description` text DEFAULT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `receipt` varchar(10) NOT NULL,
  `invoice_date` date NOT NULL,
  `inv_dep` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `amount_owing` double NOT NULL,
  `discount` double NOT NULL,
  `total` double NOT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `salaryAcc`
--

CREATE TABLE `salaryAcc` (
  `id` int(11) NOT NULL,
  `employee` int(11) DEFAULT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL,
  `sales_person` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `salaryComponent`
--

CREATE TABLE `salaryComponent` (
  `id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `component` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `salesAcc`
--

CREATE TABLE `salesAcc` (
  `id` int(11) NOT NULL,
  `customer` varchar(300) NOT NULL,
  `obalance` double(65,2) NOT NULL,
  `credit` double(65,2) NOT NULL,
  `debit` double(65,2) NOT NULL,
  `created` date NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `saletax`
--

CREATE TABLE `saletax` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `tax_no` int(11) NOT NULL,
  `transactions` int(11) NOT NULL,
  `total_amount` double NOT NULL,
  `last_tran_amount` double NOT NULL,
  `last_tran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `sinvoice`
--

CREATE TABLE `sinvoice` (
  `id` int(11) NOT NULL,
  `custID` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `order_no` varchar(10) NOT NULL,
  `item` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `tax` double NOT NULL,
  `tax_value` double DEFAULT NULL,
  `total` double NOT NULL,
  `created` date NOT NULL,
  `salesperson` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `sorder`
--

CREATE TABLE `sorder` (
  `id` int(11) NOT NULL,
  `custID` int(11) DEFAULT NULL,
  `order_no` varchar(10) DEFAULT NULL,
  `item` varchar(200) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `consultAmt` int(11) DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `tax_value` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `consultant` int(11) DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `note` text DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `kfn` varchar(100) DEFAULT NULL,
  `kln` varchar(100) DEFAULT NULL,
  `kphone` varchar(100) DEFAULT NULL,
  `kaddress` text DEFAULT NULL,
  `kemail` varchar(100) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `squote`
--

CREATE TABLE `squote` (
  `id` int(11) NOT NULL,
  `custID` int(11) NOT NULL,
  `quote_no` varchar(10) NOT NULL,
  `item` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `amount` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `salesperson` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `created` date NOT NULL,
  `note` text DEFAULT NULL,
  `code` int(11) NOT NULL,
  `branch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `statutory`
--

CREATE TABLE `statutory` (
  `id` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statutory`
--

INSERT INTO `statutory` (`id`, `project`, `fees`, `amount`, `created`, `createdby`) VALUES
(1, 1, 1, 50000, '2021-01-06', 5),
(2, 1, 2, 50000, '2021-01-06', 5),
(3, 1, 3, 300000, '2021-01-06', 5),
(4, 2, 1, 50000, '2021-09-09', 5),
(5, 4, 1, 100000, '2021-09-09', 5);

-- --------------------------------------------------------

--
-- Table structure for table `statutorypay`
--

CREATE TABLE `statutorypay` (
  `id` int(11) NOT NULL,
  `custID` int(11) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `fee` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stax`
--

CREATE TABLE `stax` (
  `id` int(11) NOT NULL,
  `tax` text NOT NULL,
  `rate` double NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `subscriberId` bigint(20) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `marrital` varchar(50) DEFAULT NULL,
  `dateofbirth` varchar(20) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `which_estate` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `allocation_num` varchar(255) DEFAULT NULL,
  `quantity` int(5) DEFAULT NULL,
  `amount_agreed` varchar(20) DEFAULT NULL,
  `consultantId` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `account` varchar(100) DEFAULT NULL,
  `debit` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  `transaction` text DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE `travel` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `transportation` int(11) DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `travel_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fund` double(65,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Pending',
  `created` date NOT NULL,
  `branch` text NOT NULL,
  `reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `travelB`
--

CREATE TABLE `travelB` (
  `id` int(11) NOT NULL,
  `benefit` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salt` varchar(150) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `created` date NOT NULL,
  `createdby` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `fname`, `lname`, `email`, `password`, `salt`, `group`, `role`, `created`, `createdby`, `branch`, `status`) VALUES
(2, 'Adeniyi', 'Opebiyi', 'gm@gm.com', '$2y$12$Tnvj9JmdWwVlCTrpy1TIVuHRNTRlm5px/c9SsDisimZ0zZSX8C3YS', NULL, NULL, 'General Manager', '2020-06-12', 1, 1, 'Active'),
(3, 'Faith', 'Sec', 'sec@sec.com', '$2y$12$wkPKuvK00bAdV/nD/mw7huBqTeqlI1iotNV92IQb8sivorKUlpMba', NULL, NULL, 'Secretary', '2020-06-12', 2, 1, 'Active'),
(5, 'System', 'Admin', 'admin@admin.com', '$2y$12$Tnvj9JmdWwVlCTrpy1TIVuHRNTRlm5px/c9SsDisimZ0zZSX8C3YS', NULL, NULL, 'Admin', '2020-06-18', 1, 1, 'Active'),
(6, 'Account', 'Admin', 'admin@account.com', '$2y$12$Tnvj9JmdWwVlCTrpy1TIVuHRNTRlm5px/c9SsDisimZ0zZSX8C3YS', NULL, NULL, 'Accountant', '2020-07-01', 2, 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `userz`
--

CREATE TABLE `userz` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  `status` varchar(9) NOT NULL DEFAULT 'Active',
  `group` int(11) NOT NULL,
  `joined` datetime NOT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userz`
--

INSERT INTO `userz` (`id`, `fname`, `lname`, `email`, `password`, `salt`, `phone`, `role`, `status`, `group`, `joined`, `gender`, `department`) VALUES
(1, 'User', 'Admin', 'admin@admin.com', '72eb72cd70b3395d04e0c01aada6447e23754988e0913030f35bef6c5c9d312a', 'ªœÖ!Há¿H”$’=Í®¹ü.JÕS&ÍrÓ ‘', '08170000000', 'admin', 'Active', 2, '2020-04-02 15:59:02', NULL, NULL),
(2, 'Mary', 'Ojo', 'mary@yahoo.com', 'a59c5627c8ce0e94678657a8d6ba806b1d050bd69d276d9c906df6dc793f3615', 'M(6ùo*g ÄË¼—%P›3%cJ©RšnhÔ¹&å\ZÒ\n', '08122202090', 'user', 'Active', 1, '2020-04-29 22:33:44', 'Female', 'Consultant'),
(3, 'Ayo', 'Akeju', 'ay.akj@yahoo.com', '239ae5ab0fbcfca11ccc39a1ae8cf72d564f31444792bc821c162dfe183af949', 'Öxá=Ø¾×KEÆ¸\n&¼C T¤,êrFÄ«Ïw˜hP', '08076789000', 'user', 'Active', 1, '2020-04-29 22:42:40', 'Female', 'Laboratory'),
(4, 'Kenor', 'Asaboro', 'k.asaboro@gmail.com', '28304391d6228664c1d5b3802107afadd2ca83cd8ec85d4b9712ff0ca4cf3696', 'Ò	W]ÐäK©£H&[“†èc) ijYG¼³zTÈ™', '09087609800', 'user', 'Active', 1, '2020-04-30 00:47:03', 'Male', 'Consultant'),
(5, 'Use', 'Admin', 'user@admin.com', '79d48463983dbfa730bbfc3fef32c30afbe521f91387697e355e0e887390131e', 'cxÐŽàuH@ÓƒåUËPžÝþÊâ0sþna”È(ø ', '08132354300', 'admin', 'Active', 1, '2020-07-02 11:41:55', 'Male', NULL),
(6, 'Ifeanyi', 'Briggs', 'ify@yahoo.com', 'bc60d93c3ec76aaccebf2f541e35b398fd494f2300f79c1b34d897ddec15b280', ')ByGäÝ³”]J.\nßƒ«ìÒ44—Í¾‰çª„e$è=!Ã', '09088899900', 'marketer', 'Active', 1, '2020-07-02 11:58:49', 'Male', NULL),
(7, 'Abass', 'Alade', 'abass@yahoo.com', 'b260df7dd8612ac32020173962df8cb7470785cca6b0814e881c8f07ff0464d0', 'è\rGG3GÈâIB¼C£0¿t\0.Ý¤\'Bcd€¼È„', '08123456700', 'it', 'Active', 1, '2020-07-02 12:16:22', 'Male', NULL),
(8, 'Doris', 'David', 'doris@yahoo.com', '7837408a02ed9e02b4925d045e78d4294c234a4fba85052a98f73ef90fefcabe', 'k]Â±3ÃT/·ÿ<t€lÃê¬¥åØ›-\Z\\¸ËœSå', '09087654323', 'hr', 'Active', 1, '2020-07-02 12:17:10', 'Female', NULL),
(10, 'Partner', 'Ade', 'ade@partner.com', '72eb72cd70b3395d04e0c01aada6447e23754988e0913030f35bef6c5c9d312a', 'ªœÖ!Há¿H”$’=Í®¹ü.JÕS&ÍrÓ ‘', '07012342311', 'consultant', 'Active', 1, '2020-07-11 17:55:19', NULL, NULL),
(11, 'Adeniyi', 'Adeniyi', 'adeniyi@partner.com', 'a12117a8d716d2bc57eb6bb3087c58df8f1a9644aab0a63ef4850a09f00bca38', '¢cÕéô/Qˆô>àfýŽÙÛ@Þêœù!½AÒ&XX', '09087654312', 'consultant', 'Active', 1, '2020-07-13 19:25:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_session`
--

CREATE TABLE `user_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `web` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `expenseAcc` int(11) DEFAULT NULL,
  `taxID` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `created` date DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `modifyby` int(11) DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_list`
--
ALTER TABLE `account_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `benefit`
--
ALTER TABLE `benefit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_images`
--
ALTER TABLE `blog_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capital`
--
ALTER TABLE `capital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `claim`
--
ALTER TABLE `claim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyAccount`
--
ALTER TABLE `companyAccount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultantC`
--
ALTER TABLE `consultantC`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultants`
--
ALTER TABLE `consultants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `dedComponent`
--
ALTER TABLE `dedComponent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depreciationAcc`
--
ALTER TABLE `depreciationAcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_deduction`
--
ALTER TABLE `emp_deduction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_pay`
--
ALTER TABLE `emp_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_salary`
--
ALTER TABLE `emp_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_tax`
--
ALTER TABLE `emp_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entitlement`
--
ALTER TABLE `entitlement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estate`
--
ALTER TABLE `estate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estateImg`
--
ALTER TABLE `estateImg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estates`
--
ALTER TABLE `estates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `estate_name` (`estate_name`);

--
-- Indexes for table `estate_front`
--
ALTER TABLE `estate_front`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estate_images`
--
ALTER TABLE `estate_images`
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
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fyear`
--
ALTER TABLE `fyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_entry`
--
ALTER TABLE `journal_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead`
--
ALTER TABLE `lead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_activity`
--
ALTER TABLE `lead_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_type`
--
ALTER TABLE `leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_type`
--
ALTER TABLE `loan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mgtSalAcc`
--
ALTER TABLE `mgtSalAcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode_of_transportation`
--
ALTER TABLE `mode_of_transportation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `next_kin`
--
ALTER TABLE `next_kin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `officeSupAcc`
--
ALTER TABLE `officeSupAcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operationAcc`
--
ALTER TABLE `operationAcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pettyCash`
--
ALTER TABLE `pettyCash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinvoice`
--
ALTER TABLE `pinvoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `porder`
--
ALTER TABLE `porder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pquote`
--
ALTER TABLE `pquote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project` (`project`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaryAcc`
--
ALTER TABLE `salaryAcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaryComponent`
--
ALTER TABLE `salaryComponent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesAcc`
--
ALTER TABLE `salesAcc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saletax`
--
ALTER TABLE `saletax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sinvoice`
--
ALTER TABLE `sinvoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sorder`
--
ALTER TABLE `sorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `squote`
--
ALTER TABLE `squote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statutory`
--
ALTER TABLE `statutory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statutorypay`
--
ALTER TABLE `statutorypay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stax`
--
ALTER TABLE `stax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`subscriberId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travelB`
--
ALTER TABLE `travelB`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `userz`
--
ALTER TABLE `userz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_session`
--
ALTER TABLE `user_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_list`
--
ALTER TABLE `account_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `benefit`
--
ALTER TABLE `benefit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_images`
--
ALTER TABLE `blog_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `capital`
--
ALTER TABLE `capital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claim`
--
ALTER TABLE `claim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companyAccount`
--
ALTER TABLE `companyAccount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consultantC`
--
ALTER TABLE `consultantC`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultants`
--
ALTER TABLE `consultants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dedComponent`
--
ALTER TABLE `dedComponent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `depreciationAcc`
--
ALTER TABLE `depreciationAcc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_deduction`
--
ALTER TABLE `emp_deduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_pay`
--
ALTER TABLE `emp_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_salary`
--
ALTER TABLE `emp_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_tax`
--
ALTER TABLE `emp_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entitlement`
--
ALTER TABLE `entitlement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estate`
--
ALTER TABLE `estate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estateImg`
--
ALTER TABLE `estateImg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `estate_front`
--
ALTER TABLE `estate_front`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estate_images`
--
ALTER TABLE `estate_images`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fyear`
--
ALTER TABLE `fyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_entry`
--
ALTER TABLE `journal_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead`
--
ALTER TABLE `lead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_activity`
--
ALTER TABLE `lead_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_type`
--
ALTER TABLE `leave_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_type`
--
ALTER TABLE `loan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mgtSalAcc`
--
ALTER TABLE `mgtSalAcc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mode_of_transportation`
--
ALTER TABLE `mode_of_transportation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `next_kin`
--
ALTER TABLE `next_kin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `officeSupAcc`
--
ALTER TABLE `officeSupAcc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `operationAcc`
--
ALTER TABLE `operationAcc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pettyCash`
--
ALTER TABLE `pettyCash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pinvoice`
--
ALTER TABLE `pinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `porder`
--
ALTER TABLE `porder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pquote`
--
ALTER TABLE `pquote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaryAcc`
--
ALTER TABLE `salaryAcc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaryComponent`
--
ALTER TABLE `salaryComponent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesAcc`
--
ALTER TABLE `salesAcc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saletax`
--
ALTER TABLE `saletax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sinvoice`
--
ALTER TABLE `sinvoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sorder`
--
ALTER TABLE `sorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `squote`
--
ALTER TABLE `squote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `statutory`
--
ALTER TABLE `statutory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `statutorypay`
--
ALTER TABLE `statutorypay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stax`
--
ALTER TABLE `stax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `subscriberId` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `travelB`
--
ALTER TABLE `travelB`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `userz`
--
ALTER TABLE `userz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_session`
--
ALTER TABLE `user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
