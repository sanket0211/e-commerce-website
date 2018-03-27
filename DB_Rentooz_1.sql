-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2016 at 10:56 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `DB_Rentooz`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
  `category_id` int(10) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`category_id`, `category_name`) VALUES
(1, 'Electronics'),
(2, 'Men'),
(3, 'Women'),
(4, 'Baby & Kids'),
(5, 'Home & Furniture'),
(6, 'Books & Media'),
(7, 'Auto & Sports');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) NOT NULL,
  `city_state` varchar(100) NOT NULL,
  PRIMARY KEY (`city_id`),
  UNIQUE KEY `cityId` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `city_state`) VALUES
(1, 'Hyderabad', 'Telangana'),
(2, 'Mumbai', 'Maharashtra');

-- --------------------------------------------------------

--
-- Table structure for table `Communities`
--

CREATE TABLE IF NOT EXISTS `Communities` (
  `community_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `community_name` varchar(200) NOT NULL,
  `city_id` int(10) NOT NULL,
  `community_desc` text NOT NULL,
  `community_img_name` varchar(32) NOT NULL DEFAULT 'default',
  `community_img_ext` varchar(8) NOT NULL DEFAULT '.jpeg',
  `community_thumb_name` varchar(32) NOT NULL,
  `community_privacy` tinyint(1) NOT NULL,
  `no_of_members` int(11) NOT NULL,
  `no_of_admins` int(11) NOT NULL,
  PRIMARY KEY (`community_id`),
  KEY `admin_id` (`admin_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Communities`
--

INSERT INTO `Communities` (`community_id`, `admin_id`, `community_name`, `city_id`, `community_desc`, `community_img_name`, `community_img_ext`, `community_thumb_name`, `community_privacy`, `no_of_members`, `no_of_admins`) VALUES
(1, 2, 'Gachibowli', 1, 'The <b>gachibowli</b> community.', 'msca005baseballcap', '.jpg', 'msca005baseballcap_thumb', 0, 2, 1),
(2, 1, 'Vijay Nagar', 2, 'Lite', 'sdfsa', '.jpg', 'sdfsa_thumb', 0, 3, 1),
(3, 2, 'Sonawala', 2, 'testing community', 'default', '.jpeg', 'default_thumb', 1, 1, 1),
(4, 2, 'time pass', 2, 'hello world', 'test', '.jpg', 'test_thumb', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Deals`
--

CREATE TABLE IF NOT EXISTS `Deals` (
  `deal_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `g_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `b_code` varchar(10) NOT NULL,
  `g_code` varchar(10) NOT NULL,
  PRIMARY KEY (`deal_id`),
  KEY `g_id` (`g_id`),
  KEY `b_id` (`b_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Deals`
--

INSERT INTO `Deals` (`deal_id`, `b_id`, `g_id`, `item_id`, `status`, `no_of_days`, `b_code`, `g_code`) VALUES
(1, 2, 1, 1, 5, 10, 'TBcSNZ', 'HiOXaU'),
(2, 2, 1, 2, 2, 2, 'Rp8r4L', 'tK1Bo7');

-- --------------------------------------------------------

--
-- Table structure for table `Demands`
--

CREATE TABLE IF NOT EXISTS `Demands` (
  `demand_id` int(11) NOT NULL AUTO_INCREMENT,
  `demand_item` varchar(200) NOT NULL,
  `demand_sub_cat` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `demand_item_desc` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`demand_id`),
  KEY `user_id` (`user_id`),
  KEY `demand_sub_cat` (`demand_sub_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `demand_hits`
--

CREATE TABLE IF NOT EXISTS `demand_hits` (
  `demand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `demand_id` (`demand_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Forgotpassword`
--

CREATE TABLE IF NOT EXISTS `Forgotpassword` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(256) NOT NULL,
  `password_change_code` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Items`
--

CREATE TABLE IF NOT EXISTS `Items` (
  `Item_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `item_desc` text NOT NULL,
  `item_category_id` int(10) NOT NULL,
  `item_end_date` date NOT NULL,
  `item_status` int(1) NOT NULL DEFAULT '0',
  `item_rent` int(11) NOT NULL,
  `item_img_name` varchar(32) NOT NULL,
  `item_img_ext` varchar(8) NOT NULL,
  `item_thumb_name` varchar(32) NOT NULL,
  `activity` int(3) NOT NULL DEFAULT '1',
  `item_key_features` varchar(500) NOT NULL DEFAULT 'not mentioned',
  `item_purchase_price` int(5) NOT NULL DEFAULT '0',
  `item_brand` varchar(256) NOT NULL DEFAULT 'not mentioned',
  `item_terms` varchar(500) NOT NULL DEFAULT 'not mentioned',
  `post_date` date NOT NULL,
  PRIMARY KEY (`Item_id`),
  KEY `user_id` (`user_id`),
  KEY `community_id` (`community_id`),
  KEY `item_sub_category` (`item_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Items`
--

INSERT INTO `Items` (`Item_id`, `user_id`, `community_id`, `item_name`, `item_desc`, `item_category_id`, `item_end_date`, `item_status`, `item_rent`, `item_img_name`, `item_img_ext`, `item_thumb_name`, `activity`, `item_key_features`, `item_purchase_price`, `item_brand`, `item_terms`, `post_date`) VALUES
(1, 2, 2, 'Casio Calculater', 'its used to calculate.', 64, '2015-12-28', 0, 10, 'cla', '.jpeg', 'cla_thumb', 1, 'not mentioned', 0, 'not mentioned', 'not mentioned', '0000-00-00'),
(2, 2, 4, 'leather belt', 'leather belt', 21, '2015-12-29', 1, 30, 'sdfsa5', '.jpg', 'sdfsa5_thumb', 0, 'not mentioned', 0, 'not mentioned', 'not mentioned', '0000-00-00'),
(3, 2, 1, 'bicycle', 'its very new and proper in all respect.', 3, '2016-01-18', 0, 500, 'sdfsa14', '.jpg', 'sdfsa14_thumb', 1, 'Its newly bought.', 5000, 'Hecules', 'none', '2016-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE IF NOT EXISTS `Members` (
  `member_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `role` tinyint(1) NOT NULL,
  KEY `member_id` (`member_id`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Members`
--

INSERT INTO `Members` (`member_id`, `community_id`, `role`) VALUES
(2, 1, 1),
(1, 1, 0),
(1, 2, 1),
(2, 2, 0),
(2, 3, 1),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Notifications`
--

CREATE TABLE IF NOT EXISTS `Notifications` (
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `notification_type` tinyint(1) NOT NULL,
  `status` smallint(2) DEFAULT '0',
  UNIQUE KEY `idx_name` (`user_id`,`admin_id`,`community_id`),
  KEY `admin_id` (`admin_id`),
  KEY `community_id` (`community_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Notifications`
--

INSERT INTO `Notifications` (`user_id`, `admin_id`, `community_id`, `notification_type`, `status`) VALUES
(1, 2, 1, 1, 3),
(2, 1, 2, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Recharge`
--

CREATE TABLE IF NOT EXISTS `Recharge` (
  `recharge_id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(10) NOT NULL,
  `operator` varchar(55) NOT NULL,
  `amount` int(55) NOT NULL,
  `uniqueorderid` varchar(55) NOT NULL,
  PRIMARY KEY (`recharge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `Recharge`
--

INSERT INTO `Recharge` (`recharge_id`, `mobile`, `operator`, `amount`, `uniqueorderid`) VALUES
(1, '2147483647', 'AT', 50, '1291430801'),
(2, '2147483647', 'AL', 50, '2410308096'),
(3, '2147483647', 'AL', 50, '9751206735'),
(4, '2147483647', 'AL', 50, '2620886017'),
(5, '2147483647', 'AL', 50, '2593853702'),
(6, '2147483647', 'MTM', 20, '2242658382'),
(7, '2147483647', 'MTM', 20, '1213668659'),
(8, '2147483647', 'AL', 2, '2651642401'),
(9, '5555555555', 'AL', 2, '4442419310'),
(10, '9757062776', 'MTM', 10, '2820736103'),
(11, '9757062776', 'MTM', 10, '2081189294'),
(12, '9757062776', 'MTM', 20, '4611091005'),
(13, '5555555555', 'AL', 10, '1013671326'),
(14, '5555555555', 'AL', 10, '8368818557'),
(15, '5555555555', 'AL', 10, '1073157067'),
(16, '5555555555', 'AL', 10, '2181841707'),
(17, '5555555555', 'AL', 10, '2028520254'),
(18, '9757062776', 'BS', 10, '1314877080'),
(19, '9757062776', 'AL', 10, '2640609103'),
(20, '9757062776', 'AL', 10, '1040798223'),
(21, '9757062776', 'AL', 10, '2720501280'),
(22, '9757062776', 'MTM', 10, '8211769846'),
(23, '9757062776', 'BS', 10, '2746587461'),
(24, '9757062776', 'MTM', 10, '7239217449');

-- --------------------------------------------------------

--
-- Table structure for table `Subscription`
--

CREATE TABLE IF NOT EXISTS `Subscription` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriber_email` varchar(256) NOT NULL,
  PRIMARY KEY (`subscriber_id`),
  KEY `subscriber` (`subscriber_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `Subscription`
--

INSERT INTO `Subscription` (`subscriber_id`, `subscriber_email`) VALUES
(1, 'ssanket369@gail.com'),
(2, 'kewal0212@ymail.com'),
(3, 'sanket.shah@research.iiit.ac.in'),
(4, 'dedhia.deep@gmail.com'),
(5, 'heema_doshi@hotmail.com'),
(6, 'sanket_shah007@ymail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Sub_Categories`
--

CREATE TABLE IF NOT EXISTS `Sub_Categories` (
  `category_id` int(10) NOT NULL,
  `sub_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`sub_category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `Sub_Categories`
--

INSERT INTO `Sub_Categories` (`category_id`, `sub_category_id`, `sub_category_name`) VALUES
(1, 1, 'Mobiles'),
(1, 2, 'Wearable Smart Devices'),
(1, 3, 'Tablets'),
(1, 4, 'Laptops'),
(1, 5, 'Computer Peripherals'),
(1, 6, 'Mobile Accessories'),
(1, 7, 'Headphones & Headsets'),
(1, 8, 'Tablet Accessories'),
(1, 9, 'Computer Accessories'),
(1, 10, 'Network Components'),
(1, 11, 'Televisions'),
(1, 12, 'Large Appliances'),
(1, 13, 'Small Appliances'),
(1, 14, 'Healthcare Appliances'),
(1, 15, 'Kitchen Appliances'),
(1, 16, 'Personal Care Appliances'),
(1, 17, 'Audio & Video'),
(1, 18, 'Camera'),
(1, 19, 'Camera Accessories'),
(1, 20, 'Gaming'),
(2, 21, 'Footwear'),
(2, 22, 'Clothing'),
(2, 23, 'Watches'),
(2, 24, 'Mens'' Accessories'),
(2, 25, 'Spectacle Frammes'),
(2, 26, 'Bags, Belts & Wallets'),
(2, 27, 'Sunglasses'),
(2, 28, 'Fragrances'),
(2, 29, 'Grooming & Wellness'),
(3, 30, 'Clothing'),
(3, 31, 'Ethnic Wear'),
(3, 32, 'Western Wear'),
(3, 33, 'Footwear'),
(3, 34, 'Bags, Belts & Wallets'),
(3, 35, 'Jewellery'),
(3, 36, 'Watches'),
(3, 37, 'Perfumes'),
(3, 38, 'Spectacle Frames'),
(3, 39, 'Sunglasses'),
(3, 40, 'Beauty & Personal Care'),
(4, 42, 'Toys'),
(4, 43, 'Clothing'),
(4, 44, 'Footwear'),
(4, 45, 'Baby Care'),
(4, 46, 'School Supplies'),
(4, 47, 'Books'),
(4, 48, 'Movies'),
(4, 49, 'Watches'),
(4, 50, 'Sunglasses'),
(5, 52, 'Kitchen & Dining'),
(5, 53, 'Home Furnishings'),
(5, 54, 'Furniture'),
(5, 55, 'Home Decor'),
(5, 56, 'Home Appliances'),
(5, 57, 'Lighting'),
(5, 58, 'Tools And Hardware'),
(5, 59, 'Photoframes & Leisure'),
(6, 60, 'Books'),
(6, 61, 'Movies & T.V. Shows'),
(6, 62, 'Music'),
(6, 63, 'Gaming'),
(6, 64, 'Stationary'),
(6, 65, 'Office Equipements'),
(7, 66, 'Car Electronics And Accessories'),
(7, 67, 'Car Essentials'),
(7, 68, 'Helmet & Riding Gear'),
(7, 69, 'Car & Bike Breakdown Equipement'),
(7, 70, 'Tyres'),
(7, 71, 'Car & Bike Care'),
(7, 72, 'Lubricants & Oils'),
(7, 73, 'Sports Footwear'),
(7, 74, 'Sports Clothing'),
(7, 75, 'Outdoors');

-- --------------------------------------------------------

--
-- Table structure for table `unverified_users`
--

CREATE TABLE IF NOT EXISTS `unverified_users` (
  `unverified_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unverified_user_name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `unverified_user_password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `unverified_user_phone` varchar(10) CHARACTER SET utf8 NOT NULL,
  `unverified_user_email` varchar(254) CHARACTER SET utf8 NOT NULL,
  `unverified_user_city_id` int(10) NOT NULL,
  `unverified_user_img_name` varchar(32) NOT NULL,
  `unverified_user_img_name_ext` varchar(8) NOT NULL,
  `unverified_user_thumb_name` varchar(32) NOT NULL,
  `unverified_user_phone_vs` tinyint(1) NOT NULL DEFAULT '0',
  `unverified_user_email_vs` tinyint(1) NOT NULL DEFAULT '0',
  `unverified_user_phone_code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `unverified_user_email_code` varchar(255) CHARACTER SET utf8 NOT NULL,
  `referral` varchar(10) NOT NULL,
  `unverified_user_address` varchar(256) NOT NULL,
  PRIMARY KEY (`unverified_user_id`),
  UNIQUE KEY `unverified_user_phone` (`unverified_user_phone`),
  UNIQUE KEY `unverified_user_email` (`unverified_user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_address` varchar(256) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_fname` varchar(200) NOT NULL,
  `user_lname` varchar(200) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `user_phone` varchar(10) NOT NULL,
  `user_email` varchar(254) NOT NULL,
  `city_id` int(11) NOT NULL,
  `user_img_name` varchar(32) NOT NULL,
  `user_img_ext` varchar(8) NOT NULL,
  `user_thumb_name` varchar(32) NOT NULL,
  `referral_code` varchar(6) NOT NULL,
  `user_coins` int(11) NOT NULL,
  `user_earnings` double NOT NULL,
  `offset` int(11) NOT NULL DEFAULT '0',
  `password_reset_hash` varchar(255) NOT NULL,
  `joined_date` datetime NOT NULL,
  `ads_limit` int(2) NOT NULL DEFAULT '5',
  `days_limit` int(3) NOT NULL DEFAULT '0',
  `sharentoozbonus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_phone` (`user_phone`,`user_email`,`referral_code`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_address`, `user_name`, `user_fname`, `user_lname`, `user_password`, `user_phone`, `user_email`, `city_id`, `user_img_name`, `user_img_ext`, `user_thumb_name`, `referral_code`, `user_coins`, `user_earnings`, `offset`, `password_reset_hash`, `joined_date`, `ads_limit`, `days_limit`, `sharentoozbonus`) VALUES
(1, '', 'Sanket Shah', 'sanket', 'shah', '$2y$10$/XfdrDPZq8oX8IPUzzqtwOo8HfMEmjpysoFY8Vx.K6MgGApcm9mt2', '9581105549', 'sanket.shah@research.iiit.ac.in', 1, 'sanket', '.jpg', 'sanket', 'Sank28', 150, 0, 0, '', '2015-12-07 18:50:28', 2, 0, 0),
(2, '', 'Shivang Nagaria', 'shivang', 'nagaria', '$2y$10$W25YHJNIuGIqgZg951Eb1uJ637VeyF/IiIncO3kxlMDbQdy98JY.i', '5555555555', 'shivang.nagaria@gmail.com', 1, 'shivang', '.jpg', 'shivang', 'Shiv30', 610, 900, 0, '', '2015-12-07 19:03:53', 15, 0, 9450),
(4, '', 'sanket shah', '', '', '$2y$10$o7B.NxJXLdoICabBa.E54eKwFVB40ChyqLa2TY4hV.2FlBFbaEnOq', '9757062776', 'ssanket369@gmail.com', 2, 'default', '.jpg', 'default_thumb', 'sanke1', 100, 0, 0, '', '2015-12-29 18:31:50', 5, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verify_user`
--

CREATE TABLE IF NOT EXISTS `verify_user` (
  `user_id` int(11) NOT NULL,
  `user_phone_otp` int(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Communities`
--
ALTER TABLE `Communities`
  ADD CONSTRAINT `Communities_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Communities_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Deals`
--
ALTER TABLE `Deals`
  ADD CONSTRAINT `Deals_ibfk_1` FOREIGN KEY (`g_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Deals_ibfk_2` FOREIGN KEY (`b_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Deals_ibfk_3` FOREIGN KEY (`item_id`) REFERENCES `Items` (`Item_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Demands`
--
ALTER TABLE `Demands`
  ADD CONSTRAINT `Demands_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Demands_ibfk_2` FOREIGN KEY (`demand_sub_cat`) REFERENCES `Sub_Categories` (`sub_category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `demand_hits`
--
ALTER TABLE `demand_hits`
  ADD CONSTRAINT `demand_hits_ibfk_1` FOREIGN KEY (`demand_id`) REFERENCES `Demands` (`demand_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demand_hits_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Forgotpassword`
--
ALTER TABLE `Forgotpassword`
  ADD CONSTRAINT `Forgotpassword_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Items`
--
ALTER TABLE `Items`
  ADD CONSTRAINT `Items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Items_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `Communities` (`community_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Items_ibfk_3` FOREIGN KEY (`item_category_id`) REFERENCES `Sub_Categories` (`sub_category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Members`
--
ALTER TABLE `Members`
  ADD CONSTRAINT `Members_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Members_ibfk_2` FOREIGN KEY (`community_id`) REFERENCES `Communities` (`community_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Notifications`
--
ALTER TABLE `Notifications`
  ADD CONSTRAINT `Notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Notifications_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Notifications_ibfk_3` FOREIGN KEY (`community_id`) REFERENCES `Communities` (`community_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Sub_Categories`
--
ALTER TABLE `Sub_Categories`
  ADD CONSTRAINT `Sub_Categories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Categories` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`) ON UPDATE CASCADE;

--
-- Constraints for table `verify_user`
--
ALTER TABLE `verify_user`
  ADD CONSTRAINT `verify_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
