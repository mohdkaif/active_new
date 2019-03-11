-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2019 at 12:44 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `activebaccha`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(255) NOT NULL,
  `about_image` varchar(255) NOT NULL,
  `about_heading` varchar(255) NOT NULL,
  `about_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `about_image`, `about_heading`, `about_description`) VALUES
(1, 'image-3.jpg', 'Use Get Me A Flat to find the best independent flats in Gurgaon', '<p>GMAF is not a real estate agency but a specialist service platform dedicated to you. Being in the premium real estate for the past 30 years, we have the largest selection of hand picked flats across the entire Gurgaon thereby ensuring that you get the best property at the best price.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `location`, `phone`, `email`) VALUES
(1, 'OM OIL LLC, 200 S Frontage Rd Suite 310 Burr Ridge, IL 60527', '630-568-3240', 'info@omoil.net');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(100) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nameAdmin` varchar(255) NOT NULL,
  `imageAdmin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `userName`, `password`, `email`, `nameAdmin`, `imageAdmin`) VALUES
(1, 'admin', 'admin', 'deepak784rajput@gmail.com', 'Deepak', '43743615_551389695296867_14679322044399616_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blogId` int(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `tag_one` varchar(255) NOT NULL,
  `tag_two` varchar(255) NOT NULL,
  `tag_three` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogId`, `image`, `heading`, `author`, `description`, `category`, `date`, `tag_one`, `tag_two`, `tag_three`) VALUES
(3, 'IMG-20180502-WA0050.jpg', '4 BHK INDEPENDENT FLOOR', '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur...</p>\r\n', 'for buy', '20 May 2018', '3 BHK INDEPENDENT FLOOR', '3 BHK INDEPENDENT FLOOR', '');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiry_id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiry_id`, `name`, `email`, `mobile`, `message`, `date`) VALUES
(2, 'deepak kumar', 'deepakujlayan50@gmail.com', '9910684545', 'thanks', '2018-05-07 01:59:10'),
(3, 'deepak kumar two', 'deepakujlayan50@gmail.com', '9910684545', 'thanks', '2018-05-07 01:59:10'),
(5, 'deepak kumar three', 'deepakujlayan50@gmail.com', '9910684545', 'thanks', '2018-06-07 01:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `galleryId` int(100) NOT NULL,
  `gallerypageId` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`galleryId`, `gallerypageId`, `image`, `heading`) VALUES
(3, '1', '14985656903205.jpg', 'scfsdcf'),
(11, '2', '14940274905247.jpg', ''),
(6, '1,3', '14940279371987.jpg', 'xvcxv'),
(12, '3', '14942756869713.jpg', ''),
(13, '1', '14942758682976.jpg', ''),
(10, '1', '14940282279201.jpg', 'dsgfds'),
(14, '2', '14942743019130.jpg', ''),
(16, '2', '14942741515915.jpg', ''),
(17, '4', '14940283309223.jpg', ''),
(18, '1', '14942745196025.jpg', ''),
(19, '3', '14942746865846.jpg', ''),
(20, '1', '14942748004023.jpg', ''),
(21, '1', '14942748856293.jpg', ''),
(22, '1', '14942751242791.jpg', ''),
(23, '1', '14942751838306.jpg', ''),
(24, '1', '14942753396560.jpg', ''),
(25, '1', '14942754177729.jpg', ''),
(26, '1', '14942757842214.jpg', ''),
(27, '1', '14942760304047.jpg', ''),
(28, '1', '14942761086138.jpg', ''),
(29, '2', '14942762482643.jpg', ''),
(30, '1', '14942772305754.jpg', ''),
(31, '2', '14942775262227.jpg', ''),
(32, '2', '14942776959560.jpg', ''),
(33, '1', '14942779894830.jpg', ''),
(34, '1', '14942782965844.jpg', ''),
(35, '1', '14942784314069.jpg', ''),
(36, '1', '14942785256545.jpg', ''),
(37, '1', '14942786393797.jpg', ''),
(38, '2', '14942787578948.jpg', ''),
(39, '1', '14942794133159.jpg', ''),
(40, '1', '14942794215216.jpg', ''),
(41, '1', '14942794436209.jpg', ''),
(42, '1', '14942794508404.jpg', ''),
(43, '1', '14942794604004.jpg', ''),
(44, '1', '14942794681749.jpg', ''),
(45, '1', '14942862847431.jpg', ''),
(50, '2', '14944426179975.jpg', ''),
(49, '2', '14944425137771.jpg', ''),
(51, '2', '14944427696301.jpg', ''),
(52, '4', '14944430233569.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `help_id` int(11) NOT NULL,
  `help_heading` varchar(255) NOT NULL,
  `help_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`help_id`, `help_heading`, `help_description`) VALUES
(1, '1', '<p style=\"direction: rtl;\">لقد أعددنا هذا البرنامج لإختبار معلوماتك و منحكم وسيلة مفيدة لقضاء الوقت الحر لديكم مع فرص لكسب مكافآت قيمة.&nbsp; نشجعكم على الإشتراك معنا في كل مرة تجد نفسك حرا لقضاء وقتك.&nbsp; نرحب بملاحظاتكم حتى نتمكن من تقديم أفضل خدمة.&nbsp;&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `indexslider`
--

CREATE TABLE `indexslider` (
  `indexsliderId` int(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indexslider`
--

INSERT INTO `indexslider` (`indexsliderId`, `image`, `heading`, `description`) VALUES
(15, 'image-3.jpg', 'App Development Company', '<p>Mobile App Development Company in India</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `logoId` int(100) NOT NULL,
  `logoimage` varchar(255) NOT NULL,
  `alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`logoId`, `logoimage`, `alt`) VALUES
(1, 'aafi-logo.png', 'Aafi Logo');

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `privacy_id` int(11) NOT NULL,
  `privacy_heading` varchar(255) NOT NULL,
  `privacy_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`privacy_id`, `privacy_heading`, `privacy_description`) VALUES
(1, 'Use Get Me A Flat to find the best independen	', '<p><img alt=\"\" src=\"/omoiladmin/admin/plugins/ckeditor/kcfinder/upload/images/auth-bg.jpg\" style=\"width: 100%; height: 300px;\" /></p>\r\n\r\n<p class=\"sxcs\">GMAF is not a real estate agency but a specialist service platform dedicated to you. Being in the premium real estate for the past 30 years, we have the largest selection of hand picked flats across the entire Gurgaon thereby ensuring that you get the best property at the best price.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `social_link`
--

CREATE TABLE `social_link` (
  `social_link_id` int(11) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_link`
--

INSERT INTO `social_link` (`social_link_id`, `linkedin`, `facebook`, `twitter`, `instagram`) VALUES
(1, '#', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonialsId` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonialsId`, `class`, `image`, `url`, `heading`, `location`, `description`) VALUES
(1, 'active', '1.jpg', 'https://www.youtube.com/watch?v=K8XF9bu0EEE', 'PAULA WILSON', 'south city 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante, commodo iacul viverra.'),
(2, '', '2.jpg', 'https://www.youtube.com/watch?v=K8XF9bu0EEE', 'ANTONIO MORENO', 'south city 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante, commodo iacul viverra.'),
(3, '', '2.jpg', 'https://www.youtube.com/watch?v=K8XF9bu0EEE', 'ANTONIO MORENO', 'south city 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante, commodo iacul viverra.'),
(4, '', '3.jpg', 'https://www.youtube.com/watch?v=K8XF9bu0EEE', 'MICHAEL HOLZ', 'south city 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante, commodo iacul viverra.'),
(5, '', '4.jpg', 'https://www.youtube.com/watch?v=K8XF9bu0EEE', 'MARY SAVELEY', 'south city 1', 'Vestibulum quis quam ut magna consequat faucibus. Pellentesque eget mi suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra. Quis quam ut magna consequat faucibus, metus id mi gravida.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`galleryId`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`help_id`);

--
-- Indexes for table `indexslider`
--
ALTER TABLE `indexslider`
  ADD PRIMARY KEY (`indexsliderId`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`logoId`);

--
-- Indexes for table `privacy`
--
ALTER TABLE `privacy`
  ADD PRIMARY KEY (`privacy_id`);

--
-- Indexes for table `social_link`
--
ALTER TABLE `social_link`
  ADD PRIMARY KEY (`social_link_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonialsId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiry_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `galleryId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `help_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `indexslider`
--
ALTER TABLE `indexslider`
  MODIFY `indexsliderId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `logoId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `privacy`
--
ALTER TABLE `privacy`
  MODIFY `privacy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_link`
--
ALTER TABLE `social_link`
  MODIFY `social_link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonialsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
