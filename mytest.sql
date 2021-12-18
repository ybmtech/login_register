-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2021 at 06:51 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mytest`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `checkKey` varchar(250) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `reg_date` varchar(100) NOT NULL,
  `activate_user` int(11) NOT NULL,
  `reg_key` varchar(100) NOT NULL,
  `exp_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `full_name`, `user_email`, `user_role`, `username`, `user_password`, `reg_date`, `activate_user`, `reg_key`, `exp_date`) VALUES
(1, 'alao akala', 'akala@gmail.com', 'backend', 'akala', '$2y$10$QtC/Gd2IJv9B1Sv98s6g7O1Z9YIT6TVQ9hURGON5ybTGn/eZfMqv2', '17-12-2021 01:10:pm', 0, '', '0000-00-00 00:00:00'),
(2, 'yusuf', 'yusuf@gmail.com', 'frontend', 'yusuf', '$2y$10$lfRtiDvnUstlE/PjW7koGe6TeJ/JLKbDjZCjYKn.cU32ojLLA4Xnu', '17-12-2021 01:20:pm', 0, '', '0000-00-00 00:00:00'),
(3, 'yuu', 'yus@gmk.com', 'frontend', 'yuu', '$2y$10$HzHlDOcjxvIBGuiqyDGYEuz/YNhQeMwrwcIm5lwh7wuNQLQpff3R2', '17-12-2021 01:21:pm', 0, '', '0000-00-00 00:00:00'),
(4, 'alao', 'al@gmail.com', 'ui-ux', 'ppp', '$2y$10$DXPE7hTEgwgX0DrD100n9Op6w3Gpe0DkNHThdxT0FvdgPD8qIvTm.', '17-12-2021 03:10:pm', 0, '', '0000-00-00 00:00:00'),
(5, 'musa', 'yb@gm.com', 'ui-ux', 'rtr', '$2y$10$VgxDgSGNIulq5WQ8fgXhh.D4JShiBHtJ9UUdqfxtKwoZLevp.Upr2', '17-12-2021 03:54:pm', 0, '', '0000-00-00 00:00:00'),
(6, 'musa', 'ms@gmail.com', 'backend', 'ms', '$2y$10$WtucEImfwrt9qO1K2DfIpu39PGIGO7cp9U607X3eEUtuLrZk8Mq1m', '17-12-2021 05:57:pm', 1, '768e78024aa8fdb9b8fe87be86f647457e10cc95f8', '2021-12-18 17:57:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
