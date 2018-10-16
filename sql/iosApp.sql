-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2018 at 10:30 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iosApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `commsettings`
--

CREATE TABLE IF NOT EXISTS `commsettings` (
`id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `whatsapp` tinyint(4) DEFAULT NULL,
  `email` tinyint(4) DEFAULT NULL,
  `sms` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commsettings`
--

INSERT INTO `commsettings` (`id`, `userid`, `whatsapp`, `email`, `sms`) VALUES
(1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `datasource`
--

CREATE TABLE IF NOT EXISTS `datasource` (
`id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datasource`
--

INSERT INTO `datasource` (`id`, `name`, `logo`) VALUES
(1, 'Snapchat', 'snapchat-icon.png'),
(2, 'Facebook', 'facebook-icon.png'),
(3, 'Youtube', 'youtube-icon.png'),
(4, 'Web browser', 'webbrowser-icon.png'),
(5, 'GPS', 'gps-icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `streamapprove`
--

CREATE TABLE IF NOT EXISTS `streamapprove` (
`id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `datasourceid` int(11) DEFAULT NULL,
  `subsourceid` int(11) DEFAULT NULL,
  `contents` text
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `streamapprove`
--

INSERT INTO `streamapprove` (`id`, `userid`, `datasourceid`, `subsourceid`, `contents`) VALUES
(1, 1, 1, 1, 'Name: Michael<br>Location: Reading, England<br>Age: 36'),
(2, 1, 2, 1, 'Name: Michael<br>Location: Reading, England<br>Age: 36'),
(3, 1, 3, 1, 'Name: Michael<br>Location: Reading, England<br>Age: 36'),
(4, 1, 4, 1, 'Name: Michael<br>Location: Reading, England<br>Age: 36'),
(5, 1, 5, 1, 'Name: Michael<br>Location: Reading, England<br>Age: 36'),
(6, 1, 1, 2, 'Out in the sunshine today, can anyone suggest a place for lunch?'),
(7, 1, 2, 2, 'Out in the sunshine today, can anyone suggest a place for lunch?'),
(8, 1, 3, 2, 'Out in the sunshine today, can anyone suggest a place for lunch?'),
(9, 1, 4, 2, 'Out in the sunshine today, can anyone suggest a place for lunch?'),
(10, 1, 5, 2, 'Out in the sunshine today, can anyone suggest a place for lunch?'),
(11, 1, 1, 3, 'Hey Michael, check out https://belandthedragon-reading.co.uk/'),
(12, 1, 2, 3, 'Hey Michael, check out https://belandthedragon-reading.co.uk/'),
(13, 1, 3, 3, 'Hey Michael, check out https://belandthedragon-reading.co.uk/'),
(14, 1, 4, 3, 'Hey Michael, check out https://belandthedragon-reading.co.uk/'),
(15, 1, 5, 3, 'Hey Michael, check out https://belandthedragon-reading.co.uk/'),
(16, 1, 1, 4, 'Today at the Bel and Dragon our new chef is preparing blackend cod'),
(17, 1, 2, 4, 'Today at the Bel and Dragon our new chef is preparing blackend cod'),
(18, 1, 3, 4, 'Today at the Bel and Dragon our new chef is preparing blackend cod'),
(19, 1, 4, 4, 'Today at the Bel and Dragon our new chef is preparing blackend cod'),
(20, 1, 5, 4, 'Today at the Bel and Dragon our new chef is preparing blackend cod');

-- --------------------------------------------------------

--
-- Table structure for table `subsource`
--

CREATE TABLE IF NOT EXISTS `subsource` (
`id` int(11) NOT NULL,
  `datasourceid` int(11) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subsource`
--

INSERT INTO `subsource` (`id`, `datasourceid`, `description`) VALUES
(1, NULL, 'Biography'),
(2, NULL, 'Posts'),
(3, NULL, 'Linked posts'),
(4, NULL, 'Friends posts');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE IF NOT EXISTS `uploads` (
`id` int(11) NOT NULL,
  `datasourceid` int(11) DEFAULT NULL,
  `subsourceid` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(2084) DEFAULT NULL,
  `contents` varchar(2000) DEFAULT NULL,
  `uploaded` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `datasourceid`, `subsourceid`, `date`, `url`, `contents`, `uploaded`) VALUES
(1, 1, 1, '2018-05-16 02:58:53', 'http://firebase.com/', 'Firebase gives you functionality like analytics, databases, messaging and crash reporting so you can move quickly and focus on your users.', 0),
(2, 1, 2, '2018-05-16 02:58:53', 'http://firebase.com/', 'Firebase gives you functionality like analytics, databases, messaging and crash reporting so you can move quickly and focus on your users.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userbalance`
--

CREATE TABLE IF NOT EXISTS `userbalance` (
  `userid` int(11) NOT NULL,
  `current` decimal(10,1) DEFAULT NULL,
  `oneweek` decimal(10,1) DEFAULT NULL,
  `onemonth` decimal(10,1) DEFAULT NULL,
  `oneyear` decimal(10,1) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userbalance`
--

INSERT INTO `userbalance` (`userid`, `current`, `oneweek`, `onemonth`, `oneyear`, `date`) VALUES
(1, '2.4', '6.5', '6.2', '31.5', '2018-05-14 16:06:10'),
(2, '4.5', '3.1', '4.5', '25.9', '2018-05-16 16:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `userdatasources`
--

CREATE TABLE IF NOT EXISTS `userdatasources` (
`id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `datasourceid` int(11) DEFAULT NULL,
  `subsourceid` int(11) DEFAULT NULL,
  `enabled` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdatasources`
--

INSERT INTO `userdatasources` (`id`, `userid`, `datasourceid`, `subsourceid`, `enabled`) VALUES
(1, 1, 1, 1, 1),
(2, 1, 2, 1, 2),
(3, 1, 5, 1, 0),
(4, 1, 1, 2, 2),
(5, 1, 1, 3, 2),
(6, 1, 1, 4, 0),
(7, 1, 2, 2, 0),
(8, 1, 2, 3, 0),
(9, 1, 2, 4, 0),
(10, 1, 5, 2, 2),
(11, 1, 5, 3, 2),
(12, 1, 5, 4, 2),
(13, 1, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `uploading` tinyint(4) DEFAULT NULL,
  `uid` varchar(100) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `uploading`, `uid`, `country`, `age`) VALUES
(1, 'aaa', '$2a$05$qJBjnPx73iC2nzGaROXAX.e9CsUOX4g8lKziI1yt8KbuHplW84G6S', 'qJBjnPx73iC2nzGaROXAX', 'aaa@gmail.com', 0, '000-01-FC0001', 'NL', 31),
(2, 'bbb', '$2a$05$A.BpSY4zutCyWyYcddHTB.rhXcXwlq6nptHTvb3FIOCgpp8nBw4nO', 'A.BpSY4zutCyWyYcddHTB', 'bbb@hotmail.com', NULL, '000-02-FC0002', 'UK', 36);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commsettings`
--
ALTER TABLE `commsettings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datasource`
--
ALTER TABLE `datasource`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streamapprove`
--
ALTER TABLE `streamapprove`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subsource`
--
ALTER TABLE `subsource`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userbalance`
--
ALTER TABLE `userbalance`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `userdatasources`
--
ALTER TABLE `userdatasources`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commsettings`
--
ALTER TABLE `commsettings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `datasource`
--
ALTER TABLE `datasource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `streamapprove`
--
ALTER TABLE `streamapprove`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `subsource`
--
ALTER TABLE `subsource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `userdatasources`
--
ALTER TABLE `userdatasources`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
