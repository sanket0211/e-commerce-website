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
-- Table structure for table `FaceBookDetails`
--

CREATE TABLE IF NOT EXISTS `FaceBookDetails` (
  `fb_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(256) NOT NULL,
  `user_fb_id` varchar(255) NOT NULL,
  `user_fb_email` varchar(256) NOT NULL,
  `fb_verified` int(2) NOT NULL,
  PRIMARY KEY (`fb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
 
-- ----------------------------------------------------------

--
-- Table structure for table `Sub_Categories`
--

CREATE TABLE IF NOT EXISTS `Sub_Categories` (
  `category_id` int(10) NOT NULL,
  `sub_category_id` int(10) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`sub_category_id`),
  KEY `category_id` (`category_id`),

  FOREIGN KEY category_id(category_id)
	REFERENCES Categories(category_id)
	ON UPDATE CASCADE
	ON DELETE CASCADE
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
  `fb_verified` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_phone` (`user_phone`,`user_email`,`referral_code`),
  KEY `city_id` (`city_id`),

  FOREIGN KEY city_id(city_id)
  REFERENCES cities(city_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

ALTER IGNORE TABLE `Users`
ADD UNIQUE INDEX email_index (`user_email`);


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
  `create_date` DATE NOT NULL,
  PRIMARY KEY (`community_id`),
  KEY `admin_id` (`admin_id`),
  KEY `city_id` (`city_id`),

  FOREIGN KEY admin_id(admin_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY city_id(city_id)
  REFERENCES cities(city_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT

) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

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
  KEY `item_sub_category` (`item_category_id`),


  FOREIGN KEY user_id(user_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE,

  FOREIGN KEY community_id(community_id)
  REFERENCES Communities(community_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY item_category_id(item_category_id)
  REFERENCES Sub_Categories(sub_category_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT

) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

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
  `start_date` DATE NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `deal_days` int(11) NOT NULL,
  `b_reviewed` tinyint(1) NOT NULL DEFAULT 0,
  `g_reviewed` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`deal_id`),
  KEY `g_id` (`g_id`),
  KEY `b_id` (`b_id`),
  KEY `item_id` (`item_id`),
  KEY `start_date` (`start_date`),

  FOREIGN KEY b_id(b_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY g_id(g_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY item_id(item_id)
  REFERENCES Items(Item_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT

) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Demands`
--

CREATE TABLE IF NOT EXISTS `Demands` (
  `demand_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `demand_item` varchar(200) NOT NULL,
  `demand_sub_cat` int(11) NOT NULL,
  `demand_item_desc` text NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`demand_id`),
  KEY `user_id` (`user_id`),
  KEY `demand_sub_cat` (`demand_sub_cat`),

  FOREIGN KEY user_id(user_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY demand_sub_cat(demand_sub_cat)
  REFERENCES Sub_Categories(sub_category_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `demand_hits`
--

CREATE TABLE IF NOT EXISTS `demand_hits` (
  `demand_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `demand_id` (`demand_id`),
  KEY `user_id` (`user_id`),

  FOREIGN KEY demand_id(demand_id)
  REFERENCES Demands(demand_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

  FOREIGN KEY user_id(user_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Forgotpassword`
--

CREATE TABLE IF NOT EXISTS `Forgotpassword` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(256) NOT NULL,
  `password_change_code` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`),

  FOREIGN KEY user_id(user_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `item_review` (
   	`deal_id` int(11) NOT NULL,
  	`item_id` int(11) NOT NULL,
   	`reviewer_id` int(11) NOT NULL,
   	`stars` float NOT NULL,
   	`comment` varchar(500) NOT NULL,

	FOREIGN KEY deal_id(deal_id)
	REFERENCES Deals(deal_id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,

	FOREIGN KEY item_id(item_id)
	REFERENCES Items(item_id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,

	FOREIGN KEY reviewer_id(reviewer_id)
	REFERENCES Users(user_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER IGNORE TABLE `item_review`
ADD UNIQUE INDEX item_review_index (`deal_id`, `item_id`, `reviewer_id`);


-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `user_review` (
        `deal_id` int(11) NOT NULL,
   	`reviewer_id` int(11) NOT NULL,
        `reviewee_id` int(11) NOT NULL,
        `stars` int(11) NOT NULL,
   	`comment` varchar(500) NOT NULL,

        FOREIGN KEY deal_id(deal_id)
        REFERENCES Deals(deal_id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,

	FOREIGN KEY reviewer_id(reviewer_id)
	REFERENCES Users(user_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT,

	FOREIGN KEY reviewee_id(reviewee_id)
	REFERENCES Users(user_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER IGNORE TABLE `user_review`
ADD UNIQUE INDEX user_review_index (`deal_id`, `reviewer_id`, `reviewee_id`);

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE IF NOT EXISTS `Members` (
  `member_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `role` tinyint(1) NOT NULL,
  KEY `member_id` (`member_id`),
  KEY `community_id` (`community_id`),

  FOREIGN KEY member_id(member_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE CASCADE,

  FOREIGN KEY community_id(community_id)
	REFERENCES Communities(community_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER IGNORE TABLE `Members`
ADD UNIQUE INDEX members_index (`member_id`, `community_id`);

-- --------------------------------------------------------

--
-- Table structure for table `Notifications`
--

CREATE TABLE IF NOT EXISTS `Notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `community_id` int(11) NOT NULL,
  `notification_type` tinyint(1) NOT NULL,
  `status` smallint(2) DEFAULT '0',
  PRIMARY KEY(`notification_id`),
  KEY `user_id` (`user_id`),
  KEY `admin_id` (`admin_id`),
  KEY `community_id` (`community_id`),


  FOREIGN KEY user_id(user_id)
	REFERENCES Users(user_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT,

  FOREIGN KEY admin_id(admin_id)
  REFERENCES Users(user_id)
  ON UPDATE CASCADE
  ON DELETE RESTRICT,

	FOREIGN KEY community_id(community_id)
	REFERENCES Communities(community_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Subscription`
--

CREATE TABLE IF NOT EXISTS `Subscription` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscriber_email` varchar(256) NOT NULL,
  PRIMARY KEY (`subscriber_id`),
  KEY `subscriber` (`subscriber_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `unverified_users`
--

CREATE TABLE IF NOT EXISTS `unverified_users` (
  `unverified_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `unverified_user_address` varchar(256) NOT NULL,
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
  PRIMARY KEY (`unverified_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `verify_user`
--

CREATE TABLE IF NOT EXISTS `verify_user` (
  `user_id` int(11) NOT NULL,
  `user_phone_otp` int(4) NOT NULL,
  PRIMARY KEY (`user_id`),

  FOREIGN KEY user_id(user_id)
	REFERENCES Users(user_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--
CREATE TABLE IF NOT EXISTS `activity` (
  	`activity_id` int(11) NOT NULL AUTO_INCREMENT,
   	`user_id` int(11) NOT NULL,
   	`community_id` int(11),
   	`item_id` int(11),
    	`deal_id` int(11),
   	`other_user_id` int(11),
   	`activity_type` int(2) NOT NULL,
	`activity_date` DATE NOT NULL,
	PRIMARY KEY (`activity_id`),
	KEY (`user_id`),
	KEY (`activity_date`),

	FOREIGN KEY user_id(user_id)
	REFERENCES Users(user_id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,

	FOREIGN KEY community_id(community_id)
	REFERENCES Communities(community_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT,

	FOREIGN KEY (Item_id)
	REFERENCES Items(Item_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT,

	FOREIGN KEY (deal_id)
	REFERENCES Deals(deal_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT,

  	FOREIGN KEY (other_user_id)
	REFERENCES Users(user_id)
	ON UPDATE CASCADE
	ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `recharge_codes` (
  `recharge_code` varchar(6) NOT NULL,
  `recharge_value` int(2) NOT NULL,
  `given` tinyint(1) NOT NULL DEFAULT 0,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `used_by` int(11),
  `date_used` DATE,
  `expiry_date` DATE NOT NULL,

  FOREIGN KEY used_by(used_by)
  REFERENCES Users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER IGNORE TABLE `recharge_codes`
ADD UNIQUE INDEX recharge_codes_index (`recharge_code`);

-- --------------------------------------------------------

