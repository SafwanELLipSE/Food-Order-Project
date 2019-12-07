-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2019 at 06:37 PM
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
-- Database: `druglife`
--

-- --------------------------------------------------------

--
-- Table structure for table `admininfo`
--

CREATE TABLE `admininfo` (
  `admin_id` int(20) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_password` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admininfo`
--

INSERT INTO `admininfo` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'safwan@gmail.com', '1234'),
(2, 'foodbd@gmail.com', '2345');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(100) NOT NULL,
  `cat_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Desert '),
(5, 'Beverages');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(20) NOT NULL,
  `contact_name` varchar(80) NOT NULL,
  `contact_Email` varchar(120) NOT NULL,
  `contact_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_Email`, `contact_message`) VALUES
(1, 'K M Safwan Hassan', 'safwan@gmail', 'Hello! can i get some help!!'),
(2, 'fdsgasfdg', 'sdfsad@Gmail', '<p>dsfad</p>\r\n'),
(3, 'fdsgasfdg', 'sdfsad@Gmail', '<p>dsfad</p>\r\n'),
(6, 'abdullah', '75aaa6@gmail.com', '<p>you food sucks!! we dun like it.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(10) NOT NULL,
  `customer_ip` varchar(255) NOT NULL,
  `customer_name` text NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_pass` varchar(100) NOT NULL,
  `customer_country` text NOT NULL,
  `customer_city` text NOT NULL,
  `customer_contact` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_ip`, `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) VALUES
(1, '::1', 'Tanvir ahmed', 'tan@gmail.com', '1234', 'Bangladesh', 'Dhaka', '01613311184', '193/2 motijheel dhaka', '56184268_1945958548849694_8103878756633935872_n.jpg'),
(2, '::1', 'Mowmita Khan', 'Khanmoumita234@gmail.com', '435213hf ', 'Bangladesh', 'Dhaka', '01628350418', 'House-92, Road-3, Block-C, Basundhara R/A', '56158302_309287503049386_6644686033252253696_n.jpg'),
(3, '::1', 'Adeeb Imtiaz', 'adb141094@gmail.com', 'ruin1234098', 'Bangladesh', 'Dhaka', '01907448641', '458 East Shewrapara, Mirpur, Dhaka-1216', '28168690_10208818555460965_3504732449577078302_n.jpg'),
(4, '::1', 'K M Safwan Hassan', 'safwanhassan13@gmail.com', '+safn9912', 'Bangladesh', 'Dhaka', '01943837962', '458 west Shewrapara, Mirpur, Dhaka-1216', 'pic of birth CV.jpg'),
(5, '::1', 'Sabbir Rahman Sajan', 'sabbir.sajan67@gmail.com', 'sdfasf123123', 'Bangladesh', 'Faridpur', '0173257278', 'faridpur jhiltuli', '53548586_2231839730171226_5629001292236980224_n.jpg'),
(6, '::1', 'Nirupam Shuvo', 'silenceshuvo21@gmail.com', '1234', 'Bangladesh', 'Dhaka', '01521333105', '504 west shewrapara', '55949088_273145900240342_8776904534258614272_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `men_id` int(100) NOT NULL,
  `men_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`men_id`, `men_name`) VALUES
(1, 'Tea'),
(2, 'Juice'),
(3, 'Rice'),
(4, 'Soup'),
(5, 'Pie '),
(6, 'Pizza'),
(7, 'Burger'),
(8, 'Hot Dog'),
(9, 'Grill'),
(10, 'Salad'),
(11, 'Cake');

-- --------------------------------------------------------

--
-- Table structure for table `ordertbl`
--

CREATE TABLE `ordertbl` (
  `order_id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL,
  `qty` int(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordertbl`
--

INSERT INTO `ordertbl` (`order_id`, `p_id`, `c_id`, `qty`, `order_date`, `amount`) VALUES
(9, 8, 1, 4, '2019-04-14 07:10:49', 360),
(10, 5, 2, 0, '2019-04-14 07:28:47', 450),
(11, 7, 1, 2, '2019-04-14 07:28:35', 2000),
(12, 4, 1, 0, '2019-04-14 08:38:59', 420),
(13, 1, 0, 2, '2019-04-15 07:16:43', 500),
(14, 3, 0, 0, '2019-04-15 08:41:59', 70),
(15, 9, 1, 3, '2019-04-15 08:45:29', 900),
(17, 9, 1, 0, '2019-04-15 10:21:56', 300);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `product_men` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_image` text NOT NULL,
  `product_desc` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_cat`, `product_men`, `product_name`, `product_price`, `product_image`, `product_desc`, `product_keywords`) VALUES
(1, 1, 7, 'Cheese Burger', 250, 'newitem2.jpg', 'Quarter pound cheeseburger with lettuce and tomatoes.', 'burger, breakfast, old'),
(2, 1, 8, 'Hot Dog', 200, 'newitem3.jpg', 'Two hot dogs topped with chili and cheese.', 'hot dog, breakfast, new'),
(3, 4, 5, 'Pumpkin Pie', 70, 'itemmenu1.jpg', 'Pumpkin pie fresh from the oven.', 'Pie, desert, Pumpkin'),
(4, 3, 4, 'Tomato Soup', 350, 'itemmenu2.jpg', 'Hot tomato soup.', 'tomato, soup, dinner'),
(5, 2, 10, 'Antipasti Salad', 450, 'itemmenu9.jpg', 'A generous plate of Italian specialties over a bed of mixed lettuce.', 'salad, lunch, special'),
(6, 3, 10, 'Caesar Salad', 450, 'itemmenu10.jpg', 'Crispy beef bacon and Shavings of reggiano parmesan mixed.', 'salad, dinner, new'),
(7, 3, 9, 'El Patron Beef Steak', 1000, 'itemmenu12.jpg', 'Grilled beef with focaccia bread, iceberg tomato and lettuce.', 'grilled, beef, desert, special'),
(8, 2, 9, 'Special Grilled Beef', 90, 'offerItem4.jpg', 'Grilled Beef with special tomato sauce.', 'grilled, beef, special'),
(9, 2, 9, 'Steak', 300, 'newitem4.jpg', 'Grilled sirloin steak with tomato sauce.', 'grilled, beef, lunch, special'),
(10, 2, 3, 'cvbzc', 50, '', '<p>afgadg</p>\r\n', 'afgadfga');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(20) NOT NULL,
  `reservation_email` varchar(120) NOT NULL,
  `reservation_person` int(20) NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reservation_email`, `reservation_person`, `reservation_date`, `reservation_time`) VALUES
(1, 'tan@gmail.com', 3, '2019-04-11', '21:30:00'),
(2, 'Khanmoumita234@gmail.com', 2, '2019-04-13', '18:30:00'),
(3, 'safwan@gmail.com', 1, '2019-04-14', '15:45:00'),
(4, 'tan@gmail.com', 2, '2019-04-23', '15:45:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admininfo`
--
ALTER TABLE `admininfo`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`men_id`);

--
-- Indexes for table `ordertbl`
--
ALTER TABLE `ordertbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admininfo`
--
ALTER TABLE `admininfo`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `men_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ordertbl`
--
ALTER TABLE `ordertbl`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
