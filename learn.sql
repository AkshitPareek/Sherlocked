-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2018 at 05:42 PM
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
-- Database: `learn`
--

-- --------------------------------------------------------

--
-- Table structure for table `gameplay`
--

CREATE TABLE `gameplay` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `clear_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gameplay`
--

INSERT INTO `gameplay` (`id`, `username`, `level`, `clear_time`) VALUES
(7, 'new', 4, '2018-05-23 16:30:50'),
(10, 'test2', 0, '2018-05-19 14:23:08'),
(13, 'full', 15, '2018-05-21 01:19:45'),
(14, 'ses', 16, '2018-05-21 02:07:18'),
(15, 'ipc', 16, '2018-05-23 20:56:55'),
(16, 'test', 1, '2018-05-25 04:10:06'),
(17, 'test4', 1, '2018-05-25 04:33:28'),
(18, 'test5', 1, '2018-05-25 04:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `question` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`question`, `answer`) VALUES
(0, 'ans0'),
(1, 'ans1'),
(2, 'ans2'),
(3, 'ans3'),
(4, 'ans4'),
(5, 'ans5'),
(6, 'ans6'),
(7, 'ans7'),
(8, 'ans8'),
(9, 'ans9'),
(10, 'ans10'),
(11, 'ans11'),
(12, 'ans12'),
(13, 'ans13'),
(14, 'ans14'),
(15, 'ans15');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `attempts` varchar(255) NOT NULL,
  `attempt_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `username`, `level`, `attempts`, `attempt_time`, `ip`) VALUES
(24, 'new', 0, 'ans0', '2018-05-23 16:24:51', ''),
(25, 'test2', 0, 'ans0', '2018-05-23 16:24:51', ''),
(26, 'test2', 0, 'ans0', '2018-05-23 16:24:51', ''),
(27, 'test2', 0, 'ans0', '2018-05-23 16:24:51', ''),
(28, 'new', 0, 'ans0', '2018-05-23 16:24:51', ''),
(29, 'new', 0, 'ans0', '2018-05-23 16:24:51', ''),
(30, 'new', 0, 'ans0', '2018-05-23 16:24:51', ''),
(31, 'new', 0, 'ans0', '2018-05-23 16:24:51', ''),
(32, 'test2', 0, 'afa', '2018-05-23 16:24:51', ''),
(33, 'test2', 0, 'ans0', '2018-05-23 16:24:51', ''),
(34, 'new', 0, 'ans0', '2018-05-23 16:24:51', ''),
(35, 'new', 1, 'ans', '2018-05-23 16:24:51', ''),
(36, 'new', 1, 'ans1', '2018-05-23 16:24:51', ''),
(37, 'test2', 0, 'ans0', '2018-05-23 16:24:51', ''),
(38, 'test2', 0, 'ans0', '2018-05-23 16:24:51', ''),
(39, 'test2', 0, 'ans0', '2018-05-23 16:24:51', ''),
(40, 'test3', 0, 'aegewg', '2018-05-23 16:24:51', ''),
(41, 'test3', 0, 'ans0', '2018-05-23 16:24:51', ''),
(42, 'dt', 0, 'ans0', '2018-05-23 16:24:51', ''),
(43, 'dt', 1, 'ce', '2018-05-23 16:24:51', ''),
(44, 'dt', 1, 'wdwd', '2018-05-23 16:24:51', ''),
(45, 'full', 0, 'agfed', '2018-05-23 16:24:51', ''),
(46, 'full', 0, 'ans0', '2018-05-23 16:24:51', ''),
(47, 'full', 1, 'wewad', '2018-05-23 16:24:51', ''),
(48, 'full', 1, 'ans1', '2018-05-23 16:24:51', ''),
(49, 'full', 2, 'wd3q3', '2018-05-23 16:24:51', ''),
(50, 'full', 2, 'ans2', '2018-05-23 16:24:51', ''),
(51, 'full', 3, 'qd', '2018-05-23 16:24:51', ''),
(52, 'full', 3, 'ans3', '2018-05-23 16:24:51', ''),
(53, 'full', 4, 'myname', '2018-05-23 16:24:51', ''),
(54, 'full', 4, 'ans4', '2018-05-23 16:24:51', ''),
(55, 'full', 5, 'efff', '2018-05-23 16:24:51', ''),
(56, 'full', 5, 'ans5', '2018-05-23 16:24:51', ''),
(57, 'full', 6, 'ed3d3', '2018-05-23 16:24:51', ''),
(58, 'full', 6, 'ans6', '2018-05-23 16:24:51', ''),
(59, 'full', 7, 'ad33d', '2018-05-23 16:24:51', ''),
(60, 'full', 7, 'ans7', '2018-05-23 16:24:51', ''),
(61, 'full', 8, 'd23e3', '2018-05-23 16:24:51', ''),
(62, 'full', 8, 'ans8', '2018-05-23 16:24:51', ''),
(63, 'full', 9, 'qwdd', '2018-05-23 16:24:51', ''),
(64, 'full', 9, 'ans9', '2018-05-23 16:24:51', ''),
(65, 'full', 10, 'efdfd', '2018-05-23 16:24:51', ''),
(66, 'full', 10, 'ans10', '2018-05-23 16:24:51', ''),
(67, 'full', 11, 'wdwede', '2018-05-23 16:24:51', ''),
(68, 'full', 11, 'ans11', '2018-05-23 16:24:51', ''),
(69, 'full', 12, 'awdd', '2018-05-23 16:24:51', ''),
(70, 'full', 12, 'ans12', '2018-05-23 16:24:51', ''),
(71, 'full', 13, 'awdd', '2018-05-23 16:24:51', ''),
(72, 'full', 13, 'ans13', '2018-05-23 16:24:51', ''),
(73, 'full', 14, 'edawd', '2018-05-23 16:24:51', ''),
(74, 'full', 14, 'ans14', '2018-05-23 16:24:51', ''),
(75, 'full', 15, 'awed', '2018-05-23 16:24:51', ''),
(76, 'full', 15, 'ans15', '2018-05-23 16:24:51', ''),
(77, 'ses', 0, 'ans0', '2018-05-23 16:24:51', ''),
(78, 'ses', 1, 'ans1', '2018-05-23 16:24:51', ''),
(79, 'ses', 2, 'ans2', '2018-05-23 16:24:51', ''),
(80, 'ses', 3, 'ans3', '2018-05-23 16:24:51', ''),
(81, 'ses', 4, 'ans4', '2018-05-23 16:24:51', ''),
(82, 'ses', 5, 'ans5', '2018-05-23 16:24:51', ''),
(83, 'ses', 6, 'ans6', '2018-05-23 16:24:51', ''),
(84, 'ses', 7, 'ans7', '2018-05-23 16:24:51', ''),
(85, 'ses', 8, 'ans8', '2018-05-23 16:24:51', ''),
(86, 'ses', 9, 'ans9', '2018-05-23 16:24:51', ''),
(87, 'ses', 10, 'ans10', '2018-05-23 16:24:51', ''),
(88, 'ses', 11, 'ans11', '2018-05-23 16:24:51', ''),
(89, 'ses', 12, 'ans12', '2018-05-23 16:24:51', ''),
(90, 'ses', 13, 'ans13', '2018-05-23 16:24:51', ''),
(91, 'ses', 14, 'ans14', '2018-05-23 16:24:51', ''),
(92, 'ses', 15, 'ans15', '2018-05-23 16:24:51', ''),
(98, 'admin', 4, 'ans0', '2018-05-23 16:24:51', ''),
(99, 'admin', 4, 'ans4', '2018-05-23 16:24:51', ''),
(100, 'admin', 3, 'ans3', '2018-05-23 16:24:51', ''),
(101, 'admin', 2, 'ans2', '2018-05-23 16:24:51', ''),
(102, 'admin', 3, 'ans3', '2018-05-23 16:24:51', ''),
(103, 'admin', 4, 'ans4', '2018-05-23 16:24:51', ''),
(104, 'admin', 5, 'ans5', '2018-05-23 16:24:51', ''),
(105, 'new', 2, 'ans2', '2018-05-23 16:24:51', ''),
(106, 'new', 1, 'ans1', '2018-05-23 16:24:51', ''),
(107, 'new', 2, 'ans2', '2018-05-23 16:24:51', ''),
(108, 'new', 3, 'efewf', '2018-05-23 16:28:44', ''),
(109, 'new', 3, 'sdfsdv', '2018-05-23 16:30:44', ''),
(110, 'new', 3, 'regrg', '2018-05-23 16:30:46', ''),
(111, 'new', 3, 'vrgrg', '2018-05-23 16:30:47', ''),
(112, 'new', 3, 'ans3', '2018-05-23 16:30:50', ''),
(113, 'new', 4, 'fefe', '2018-05-23 16:30:52', ''),
(114, 'test', 0, 'srg', '2018-05-23 15:56:14', ''),
(115, 'test', 0, 'aefcef', '2018-05-23 16:17:38', ''),
(116, 'test', 0, 'sxca', '2018-05-23 16:36:34', ''),
(117, 'test', 0, 'excsc', '2018-05-23 16:36:37', ''),
(118, 'test', 0, 'dcec', '2018-05-23 16:36:38', ''),
(119, 'test', 0, ' 54 tg', '2018-05-23 16:43:22', ''),
(120, 'test', 0, 'grt5g', '2018-05-23 16:43:23', ''),
(121, 'test', 0, 'egrtg', '2018-05-23 16:43:25', ''),
(122, 'test', 0, 'rfgr', '2018-05-23 16:52:02', ''),
(123, 'test', 0, 'sefe', '2018-05-23 16:52:03', ''),
(124, 'admin', 0, 'wdwa', '2018-05-23 16:58:47', ''),
(125, 'ipc', 0, 'hdherh', '2018-05-23 20:36:30', '::1'),
(126, 'ipc', 0, 'sdfw', '2018-05-23 20:42:43', '::1'),
(127, 'ipc', 0, 'ans0', '2018-05-23 20:54:21', '::1'),
(128, 'ipc', 1, 'AMIRIGHT', '2018-05-23 20:54:30', '::1'),
(129, 'ipc', 1, 'am i', '2018-05-23 20:54:34', '::1'),
(130, 'ipc', 1, 'ans1', '2018-05-23 20:54:38', '::1'),
(131, 'ipc', 1, 'ans1', '2018-05-23 20:55:36', '::1'),
(132, 'ipc', 1, 'ans1', '2018-05-23 20:55:37', '::1'),
(133, 'ipc', 2, 'ans2', '2018-05-23 20:56:14', '::1'),
(134, 'ipc', 3, 'ans3', '2018-05-23 20:56:18', '::1'),
(135, 'ipc', 4, 'ans4', '2018-05-23 20:56:20', '::1'),
(136, 'ipc', 4, 'ans4', '2018-05-23 20:56:20', '::1'),
(137, 'ipc', 5, 'ans5', '2018-05-23 20:56:23', '::1'),
(138, 'ipc', 5, 'ans5', '2018-05-23 20:56:23', '::1'),
(139, 'ipc', 6, 'ans6', '2018-05-23 20:56:27', '::1'),
(140, 'ipc', 7, 'ans7', '2018-05-23 20:56:30', '::1'),
(141, 'ipc', 8, 'ans8', '2018-05-23 20:56:33', '::1'),
(142, 'ipc', 9, 'ans9', '2018-05-23 20:56:36', '::1'),
(143, 'ipc', 10, 'ans10', '2018-05-23 20:56:40', '::1'),
(144, 'ipc', 11, 'ans11', '2018-05-23 20:56:43', '::1'),
(145, 'ipc', 12, 'ans12', '2018-05-23 20:56:46', '::1'),
(146, 'ipc', 12, 'ans12', '2018-05-23 20:56:46', '::1'),
(147, 'ipc', 13, 'ans13', '2018-05-23 20:56:49', '::1'),
(148, 'ipc', 14, 'ans14', '2018-05-23 20:56:52', '::1'),
(149, 'ipc', 15, 'ans15', '2018-05-23 20:56:55', '::1'),
(150, 'test', 0, 'ans0', '2018-05-25 04:10:06', '::1'),
(151, 'test4', 0, 'ans0', '2018-05-25 04:33:28', '::1'),
(152, 'test5', 0, 'ans0', '2018-05-25 04:39:08', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(15) NOT NULL,
  `tokenExpire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `grade`, `password`, `created_at`, `token`, `tokenExpire`) VALUES
(1, 'new', 'apareek.fb@gmail.com', '12a', '$2y$10$mvEHiIcrCKtcM8d4aPSLkuQ2Sv2kFK1cYwiSjcj9/L5GLFjDQb01e', '2018-05-18 15:20:33', '', '0000-00-00 00:00:00'),
(3, 'test2', 'aylematthews@gmail.com', '9b', '$2y$10$7wHLM4fJNiwhh5uc.Et9tOzjAoU6Lh122j4we/k1rl8KNRn2lzSt.', '2018-05-19 03:54:36', '', '0000-00-00 00:00:00'),
(7, 'Akshit Pareek', 'usak@gmail.com', 'ADM', '$2y$10$kwgimGlSe7YN74NN9Kkzx.YGjjT0teav5kv0MzPBgARh/HqPDiA0S', '2018-05-20 03:20:08', '', '0000-00-00 00:00:00'),
(8, 'full', 'full@full.com', '12A', '$2y$10$Gs9ghqYDTQiGg9g8iW5/A.WTfKm9/HfnWtVP.TaJKn07Jma4Oia.y', '2018-05-21 01:16:10', '', '0000-00-00 00:00:00'),
(9, 'ses', 'ses@ses.com', '12a', '$2y$10$W77OwmG08x.fvFKY0SGINeuzmB/Ix3N4S1Gmgs24o/Hhayl1tkk4a', '2018-05-21 01:58:41', '', '0000-00-00 00:00:00'),
(10, 'admin', 'aisdigit@gmail.com', 'ADM', '$2y$10$.8IED9XaSiejD0KZP5hp0.LCb4qmYuXbRLPqMdQjeYK0pe5tWj2MS', '2018-05-21 02:13:09', '', '0000-00-00 00:00:00'),
(12, 'test', 'test@test.com', 'aks', '$2y$10$dfYkzJQmFNkObkth4EQ6EOBGWOUTM1KiQDdnFOoQG1a9wysioQtl.', '2018-05-23 15:56:03', '', '0000-00-00 00:00:00'),
(13, 'ipc', 'ipc@ipc.com', 'ipc', '$2y$10$wv2rzJ7WZ7uX6SR0u9IB.ubjXRoP76.Lkn4eOq4NSjCoeL8SudYJ6', '2018-05-23 20:36:12', '', '0000-00-00 00:00:00'),
(14, 'test4', 'tet@tet.com', '123', '$2y$10$rJBHNI.Wn1OWEtXM43M71OWznpx/ZNvXd6t8Jbk5gRYt.Ex5iWaDi', '2018-05-25 04:33:16', '', '0000-00-00 00:00:00'),
(15, 'test5', 'dqwed@afd.com', '12a', '$2y$10$qUf.KPZw.kg8utCQaeULj.Qug5jb7MuLvfIqC1LEqomxiFtHMOUvS', '2018-05-25 04:38:55', '', '0000-00-00 00:00:00'),
(16, 'amay pareek', 'amay@amay.com', '1J', '$2y$10$zUHrWurohBjEQTuvStRvouwVmM86P6BcawS0XQ87LCumlDrNtNAl6', '2018-05-26 00:10:39', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `username`, `status`) VALUES
(1, 'Akshit Pareek', 'admin'),
(2, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gameplay`
--
ALTER TABLE `gameplay`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`question`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_userlog` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gameplay`
--
ALTER TABLE `gameplay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
