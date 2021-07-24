-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 09:36 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eaddress`
--

CREATE TABLE `eaddress` (
  `aid` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `add_line1` varchar(250) NOT NULL,
  `states` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eaddress`
--

INSERT INTO `eaddress` (`aid`, `employee_id`, `add_line1`, `states`, `country`) VALUES
(18, 178, 'line ali panvel', 'MH', 'India'),
(43, 182, 'Address 4', 'state111', 'India'),
(35, 181, 'malad', 'MH', 'Country'),
(5, 180, 'Address new007ffdf', 'Kerala', 'India'),
(6, 180, 'Address 122', 'MH', 'IN'),
(38, 179, 'qwert ggfg 444', 'gfgfg', 'gfgfg'),
(42, 182, 'test007', 'state111', 'India'),
(45, 183, 'teet', 'state', 'India'),
(24, 180, 'Address new007ffdf', 'MH', 'India'),
(36, 181, 'Update ID: 36', 'MH', 'Country'),
(39, 179, 'qwert ggfg 444', 'gfgfg', 'gfgfg'),
(30, 181, ' Update ID: 30', 'MH', 'Country'),
(31, 181, 'test  22', 'MH', 'Country'),
(32, 181, 'eerere', 'MH', 'Country'),
(46, 183, 'new22 ', 'state', 'India'),
(44, 182, ' s test tests test test', 'state111', 'India');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `eid` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mobile_no` int(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `photograph` varchar(100) NOT NULL,
  `e_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `fname`, `mname`, `lname`, `gender`, `mail`, `mobile_no`, `date_of_birth`, `photograph`, `e_status`) VALUES
(177, 'Owen Swanson', 'Arthur Floyd', 'Mattie Underwood', 'Select Gender', 'za@host.local', 2147483647, '2020-09-10', '2b8be2e592c33415fdb7aa327ea16aaa.jpg', 'Active'),
(178, 'Manuel Harvey', 'Claudia Pope', 'Cornelia Robertson', 'Male', 'gacvu@example.com', 2147483647, '2020-09-27', '3e3470f6fb048077ed0ff31a0eb228b5.jpg', 'Inactive'),
(179, 'Clarence Cunningham', 'Melvin Fleming', 'Rodney Oliver', 'Other', 'bovot@example.com', 2147483647, '2020-09-06', '443ab817191f1793dc0571636f8e25fd.jpg', 'Active'),
(180, 'test', 'tesdt jjjj', 'lname', 'male', 'zo@host.test', 2147483647, '2020-09-19', '', 'Inactive'),
(181, 'Betty Benson', 'Ola Hernandez', 'Lewis Gibson', 'Other', 'pigwed@host.local', 2147483647, '2020-09-30', '', 'Active'),
(182, 'Dorothy Hale', 'Jerome Gutierrez', 'Sarah Ross', 'Female', 'cegu@host.test', 2147483647, '2020-09-06', '18460.jpeg', 'Active'),
(183, 'Jane White', 'Daniel Holloway', 'Laura Briggs', 'Female', 'da@host.invalid', 2147483647, '2020-09-06', '', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eaddress`
--
ALTER TABLE `eaddress`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`eid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eaddress`
--
ALTER TABLE `eaddress`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
