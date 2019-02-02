-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2017 at 07:40 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klikkita_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `agenda_id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` tinytext,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `status` enum('Y','N','T') NOT NULL COMMENT 'Y : active, N : non active, T : trash',
  `trash_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` smallint(6) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('Y','N','T') NOT NULL COMMENT 'Y : active, N : non active, T : trash',
  `type` enum('Gallery','Content','Page','Slider Banner','Section') NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `trash_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `content_id` int(11) NOT NULL,
  `title` varchar(80) DEFAULT NULL,
  `description` text NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `user_id` smallint(6) NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `status` enum('Y','N','T') NOT NULL COMMENT 'Y : active, N : non active, T : trash',
  `picture` varchar(100) NOT NULL,
  `trash_date` datetime DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `path` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `category_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `is_active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `guestbook`
--

CREATE TABLE `guestbook` (
  `guestbook_id` int(11) NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` tinytext NOT NULL,
  `send_date` datetime NOT NULL,
  `read_msg` enum('Y','N') NOT NULL DEFAULT 'N',
  `read_date` datetime DEFAULT NULL,
  `read_by` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `guestcounter`
--

CREATE TABLE `guestcounter` (
  `ip_address` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(80) DEFAULT NULL,
  `hit` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `images_list`
--

CREATE TABLE `images_list` (
  `id_images` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `user_id` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` smallint(6) NOT NULL,
  `name` varchar(60) NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `user_id` smallint(6) NOT NULL,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `menu_detail`
--

CREATE TABLE `menu_detail` (
  `menu_detil_id` int(11) NOT NULL,
  `menu_id` smallint(6) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `drop_down` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 = drop down ,0 = no',
  `category_id` smallint(6) NOT NULL,
  `order_id` tinyint(4) DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ended_date` datetime NOT NULL DEFAULT '3014-12-31 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `from_msg` varchar(80) NOT NULL,
  `to_msg` varchar(80) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` tinytext NOT NULL,
  `send_date` datetime NOT NULL,
  `send_by` smallint(6) NOT NULL,
  `guestbook_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `plugin`
--

CREATE TABLE `plugin` (
  `id_plugin` int(11) NOT NULL,
  `type` enum('video','slider') NOT NULL,
  `embed` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(11) NOT NULL,
  `keys` varchar(100) NOT NULL,
  `value_1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id_theme` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `index` varchar(15) NOT NULL,
  `install_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y : Active, N : Not Active',
  `type` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`id_theme`, `name`, `path`, `index`, `install_date`, `update_date`, `active`, `type`) VALUES
(1, 'TopBiz', NULL, '', '2016-12-04 17:00:00', NULL, 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `themes_setting`
--

CREATE TABLE `themes_setting` (
  `id_theme` tinyint(4) NOT NULL,
  `key` varchar(100) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `group` varchar(50) DEFAULT NULL,
  `value_1` mediumtext,
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `type` enum('embed','text') NOT NULL DEFAULT 'text',
  `category` enum('Slider Banner','Page','Section') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `themes_setting`
--

INSERT INTO `themes_setting` (`id_theme`, `key`, `field_name`, `group`, `value_1`, `is_active`, `type`, `category`) VALUES
(1, 'base_url', 'Base Url Admin', NULL, 'http://klikkitas.com/content-manage/', 'Y', 'text', NULL),
(1, 'copyright_footer', 'Footer CopyRight', 'footer', 'Copyright © 2016 By PT. Rafindo Sejahtera', 'Y', 'text', NULL),
(1, 'description_meta', 'Description Meta', NULL, 'meta', 'Y', 'text', NULL),
(1, 'facebook', 'Link Account Facebook', 'social_media', 'https://www.facebook.com/candra.ramadhan', 'Y', 'text', NULL),
(1, 'footer_info', 'Footer Info', 'footer', '<h2 class=\"wow fadeInUp\" data-wow-duration=\"700ms\" data-wow-delay=\"300ms\">(+62)2180885245 / (+62)811935106</h2>\r\n<h2 class=\"wow fadeInUp\" data-wow-duration=\"700ms\" data-wow-delay=\"350ms\">mudji.rafindo@gmail.com</h2>\r\n<p class=\"wow fadeInUp\" data-wow-duration=\"700ms\" data-wow-delay=\"400ms\">Jl. Permata No.4 RT.007/04 Kebon Pala, Makasar Jakarta Timur</p>', 'Y', 'text', NULL),
(1, 'google', 'Link Account Google Plus', 'social_media', 'https://plus.google.com/', 'Y', 'text', NULL),
(1, 'menu_header', 'Menu Header', NULL, '2', 'Y', 'embed', 'Page'),
(1, 'section_1', 'Section 1', 'section', '2', 'Y', 'embed', 'Section'),
(1, 'section_2', 'Section 2', 'section', '3', 'Y', 'embed', 'Section'),
(1, 'section_3', 'Section 3', 'section', '4', 'Y', 'embed', 'Section'),
(1, 'section_4', 'Section 4', 'section', '5', 'Y', 'embed', 'Section'),
(1, 'section_5', 'Section 5', 'section', '6', 'Y', 'embed', 'Section'),
(1, 'section_6', 'Section 6', 'section', '7', 'Y', 'embed', 'Section'),
(1, 'title_logo', 'Title Logo', NULL, 'KlikKitas.com', 'Y', 'text', NULL),
(1, 'title_web', 'Title Website', NULL, 'Jasa Pembuatan Kitas dan Visa', 'Y', 'text', NULL),
(1, 'top_slider', 'Top Slider', NULL, '1', 'Y', 'embed', 'Slider Banner'),
(1, 'twitter', 'Link Twitter', 'social_media', 'https://www.twitter.com', 'Y', 'text', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` smallint(6) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(60) NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `status` enum('Administrator','User') NOT NULL,
  `path_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `user_name`, `password`, `email`, `is_active`, `create_date`, `update_date`, `status`, `path_img`) VALUES
(1, 'Candra', 'Rahmawan', 'candra', '1973287G2E4355795E7313B031B169GF7G39C851848E6708G033G7G95190GGCG4341CF8823BBF6GB9B194FBE31D0BE3354E40678E2BE60GFG9C7E6674ECEGF6E', 'candra.assasin@gmail.com', 'Y', '2016-12-02 13:41:00', NULL, 'Administrator', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `userid` (`user_id`) USING BTREE;

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `category_id` (`category_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `category_idr` (`category_id`) USING BTREE,
  ADD KEY `user_idr` (`user_id`) USING BTREE;

--
-- Indexes for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`guestbook_id`),
  ADD KEY `read_by` (`read_by`);

--
-- Indexes for table `guestcounter`
--
ALTER TABLE `guestcounter`
  ADD PRIMARY KEY (`ip_address`,`date`);

--
-- Indexes for table `images_list`
--
ALTER TABLE `images_list`
  ADD PRIMARY KEY (`id_images`),
  ADD KEY `user_id_img` (`user_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menu_detail`
--
ALTER TABLE `menu_detail`
  ADD PRIMARY KEY (`menu_detil_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `cat_id` (`category_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `send_by` (`send_by`),
  ADD KEY `guestbook_id` (`guestbook_id`);

--
-- Indexes for table `plugin`
--
ALTER TABLE `plugin`
  ADD PRIMARY KEY (`id_plugin`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id_theme`),
  ADD UNIQUE KEY `theme` (`name`);

--
-- Indexes for table `themes_setting`
--
ALTER TABLE `themes_setting`
  ADD PRIMARY KEY (`id_theme`,`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`user_name`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agenda_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `content_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `guestbook_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images_list`
--
ALTER TABLE `images_list`
  MODIFY `id_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu_detail`
--
ALTER TABLE `menu_detail`
  MODIFY `menu_detil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plugin`
--
ALTER TABLE `plugin`
  MODIFY `id_plugin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id_theme` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `category_idr` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_idr` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `guestbook`
--
ALTER TABLE `guestbook`
  ADD CONSTRAINT `read_by` FOREIGN KEY (`read_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `images_list`
--
ALTER TABLE `images_list`
  ADD CONSTRAINT `user_id_img` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu_detail`
--
ALTER TABLE `menu_detail`
  ADD CONSTRAINT `cat_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `guestbook_id` FOREIGN KEY (`guestbook_id`) REFERENCES `guestbook` (`guestbook_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `send_by` FOREIGN KEY (`send_by`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;