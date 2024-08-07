--
-- Database: `grosmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceid` int(11) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `attendance_type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceid`, `empid`, `attendance_type`, `date`, `status`) VALUES
(1, 30, 'Present', '2020-05-13', 'Active'),
(2, 30, 'Present', '2020-05-14', 'Active'),
(3, 30, 'Absent', '2020-05-12', 'Active'),
(4, 30, 'Half day', '2020-05-11', 'Active'),
(5, 30, 'Present', '2020-05-09', 'Active'),
(6, 30, 'Present', '2020-05-08', 'Active'),
(7, 30, 'Present', '2020-05-07', 'Active'),
(8, 30, 'Present', '2020-05-06', 'Active'),
(9, 30, 'Present', '2020-05-05', 'Active'),
(10, 30, 'Absent', '2020-05-04', 'Active'),
(11, 30, 'Present', '2020-05-03', 'Active'),
(12, 30, 'Half day', '2020-05-02', 'Active'),
(13, 30, 'Present', '2020-05-01', 'Active'),
(14, 30, 'Present', '2020-05-31', 'Active'),
(15, 30, 'Absent', '2020-05-30', 'Active'),
(16, 30, 'Present', '2020-05-29', 'Active'),
(17, 30, 'Present', '2020-05-28', 'Active'),
(18, 30, 'Present', '2020-05-27', 'Active'),
(19, 30, 'Present', '2020-05-26', 'Active'),
(20, 30, 'Present', '2020-05-24', 'Active'),
(21, 30, 'Present', '2020-05-21', 'Active'),
(22, 30, 'Present', '2020-05-22', 'Active'),
(23, 30, 'Present', '2019-06-24', 'Active'),
(24, 30, 'Present', '2019-06-23', 'Active'),
(25, 30, 'Half day', '2020-06-22', 'Active'),
(26, 30, 'Present', '2020-06-25', 'Active'),
(27, 30, 'Present', '2020-06-18', 'Active'),
(28, 30, 'Absent', '2020-07-02', 'Active'),
(29, 30, 'Present', '2020-08-20', 'Active'),
(30, 30, 'Present', '2020-08-27', 'Active'),
(31, 31, 'Absent', '2020-08-27', 'Active'),
(32, 39, 'Half day', '2020-08-27', 'Active'),
(33, 31, 'Present', '2020-08-20', 'Active'),
(34, 30, 'Present', '2020-08-21', 'Active'),
(35, 30, 'Half day', '2020-08-28', 'Active'),
(36, 30, 'Absent', '2020-08-10', 'Active'),
(37, 31, 'Present', '2020-08-21', 'Active'),
(38, 34, 'Present', '2020-08-22', 'Active'),
(39, 30, 'Present', '2020-08-23', 'Active'),
(40, 30, 'Half day', '2020-08-24', 'Active'),
(41, 30, 'Half day', '2020-08-19', 'Active'),
(42, 31, 'Absent', '2020-08-19', 'Active'),
(43, 34, 'Half day', '2020-08-19', 'Active'),
(44, 34, 'Present', '2020-08-18', 'Active'),
(45, 31, 'Absent', '2020-08-18', 'Active'),
(46, 30, 'Half day', '2020-08-18', 'Active'),
(47, 30, 'Present', '2020-08-17', 'Active'),
(48, 31, 'Present', '2020-08-17', 'Active'),
(49, 34, 'Present', '2020-08-17', 'Active'),
(50, 30, 'Present', '0000-00-00', 'Active'),
(51, 31, 'Absent', '0000-00-00', 'Active'),
(52, 34, 'Half day', '0000-00-00', 'Active'),
(53, 34, 'Present', '2020-08-20', 'Active'),
(54, 35, 'Present', '2020-08-20', 'Active'),
(55, 39, 'Present', '2020-08-20', 'Active'),
(56, 30, 'Absent', '2020-07-24', 'Active'),
(57, 30, 'Present', '2020-08-25', 'Active'),
(58, 31, 'Absent', '2020-08-25', 'Active'),
(59, 34, 'Half day', '2020-08-25', 'Active'),
(60, 35, 'Present', '2020-08-25', 'Active'),
(61, 30, 'Present', '2020-08-01', 'Active'),
(65, 41, 'Present', '2020-09-09', 'Active'),
(67, 30, 'Present', '2020-09-10', 'Active'),
(68, 30, 'Present', '2020-09-09', 'Active'),
(69, 30, 'Present', '2020-09-08', 'Active'),
(70, 30, 'Present', '2020-09-07', 'Active'),
(71, 30, 'Present', '2020-09-06', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryid` int(11) NOT NULL,
  `categorytype` varchar(50) NOT NULL,
  `categoryimg` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryid`, `categorytype`, `categoryimg`, `description`, `status`) VALUES
(9, 'Fruits and Vegetables', '1371423.jpg', 'Fruits and Vegetables', 'Active'),
(10, 'Bread and Buns', '929bread.jpg', 'Breads and buns', 'Active'),
(11, 'Chocolates and Icecreams', '31587dc.webp', 'Chocolates and Icecreams', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `posteddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactid`, `name`, `email`, `message`, `posteddate`) VALUES
(18, 'Mohammed Anwar', 'mohammedanwarabbas@gmail.com', 'Hy. Your website looks amazing', '2020-05-17 04:12:48'),
(19, 'Akbar Ali', 'akbar@gmail.com', 'Who developed this site?', '2020-05-17 04:13:37'),
(20, 'sanju baaba', 'akbar@gmail.com', 'hoooi buddy. How are you??\r\n', '2020-05-17 04:14:03'),
(21, 'Mohammed Anwar', 'test@gmail.com', 'qqqqqq qqqqqqqq qqqqqqqqqjjjjjjjjjj', '2020-05-17 04:15:14'),
(22, 'dj waala baabu', 'djwaalabaabu@gmail.com', 'hi', '2020-06-17 02:02:24'),
(23, 'a', 'aabb@gmail.comaa', 'a', '2020-08-24 05:53:50'),
(24, 'Mohammed Anwar', 'djwaalabaabu@gmail.com', 'a', '2020-08-24 05:54:51'),
(25, 'male', 'mohammedanwarabbas@gmail.com', 'aa', '2020-08-24 06:00:49'),
(26, 'a', 'djwaalabaabu@gmail.com', 'a', '2020-08-25 07:41:08'),
(27, 'Mohammed Anwar', 'mohammedanwarabbas@gmail.com', 'a', '2020-08-25 07:42:11'),
(28, 'dj waala baabu', 'djwaalabaabu@gmail.com', 'yiua aa', '2020-08-25 04:04:22'),
(29, 'dj waala baabu', 'djwaalabaabu@gmail.com', 'aa', '2020-08-25 04:04:33'),
(30, 'yoyo', 'yoyo@gmail.com', 'helloo guys!!.,', '2020-08-25 07:39:13'),
(31, 'dj waala baabu', 'mohammedanwarabbas@gmail.com', 'hello', '2020-09-08 08:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerid` int(11) NOT NULL,
  `customername` varchar(100) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerid`, `customername`, `emailid`, `password`, `address`, `pincode`, `city`, `state`, `contactno`, `status`) VALUES
(5, 'male', 'djwaalabaabu@gmail.com', 'password', '"djwaalabaabu nivaas", near chota dukhan, manipur', '345231', 'manglore', 'Karnataka', '1234567891', 'Active'),
(8, 'Anwar Ali', 'mohammedanwarabbas@gmail.com', 'password', 'near raja', '574106', 'kaup1', 'Karnataka', '9972595242', 'Active'),
(10, 'cmohammed mufeed', 'mohammedmufeed@gmail.com', 'password', '"djwaalabaabu nivaas", near chota dukhan, manipur', '111111', 'manglore', 'Karnataka', '1234126667', 'Active'),
(11, 'Namrtha Shetty', 'nam@gmail.com', 'password', 'Namrtha Nilaya, Kalya', '574106', 'kaup', 'Karnataka', '9972595840', 'Active'),
(12, 'Prasanna Shetty', 'pachu@gmail.com', 'password', 'Chandrahaaas Nilaya, kumbanagar', '574121', 'Mundkur', 'Karnataka', '9972595841', 'Active'),
(13, 'Rahul Sapaliga', 'rahul@gmail.com', 'password', 'Leela Nivas, Raaj nagar', '574121', 'Mundkur', 'Karnataka', '9972595842', 'Active'),
(14, 'mufeed', 'mufeed@gmail.com', '123456', 'vnnbnnb', '574117', 'udupi', 'Chhattisgarh', '5662467799', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeid` int(11) NOT NULL,
  `empname` varchar(100) NOT NULL,
  `emptype` varchar(20) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `adharno` varchar(20) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `joindate` date NOT NULL,
  `basicsalary` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeid`, `empname`, `emptype`, `emailid`, `address`, `pincode`, `city`, `state`, `adharno`, `contactno`, `loginid`, `password`, `status`, `joindate`, `basicsalary`) VALUES
(24, 'Mohammed Anwar', 'Admin', 'mohammedanwarabbas@gmail.com', 'near raja', '111111', 'ss', 'Kerala', '111111111111', '0000000001', 'admin', '12345', 'Active', '2020-03-11', 0.00),
(30, 'Rohith', 'Employee', 'rohitkulal610@gmail.com', 'cc', '444444', 'ee', 'Haryana', '123456123456', '1212123434', 'john1', 'pwdpwd', 'Active', '2020-05-13', 10000.00),
(41, 'Mufeed', 'Employee', 'mufeed@gmail.com', '"djwaalabaabu nivaas", near chota dukhan, manipur', '345231', 'manglore', 'Karnataka', '121212121212', '1234098755', 'mufeed', 'password', 'Active', '2020-08-29', 11000.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `title` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `costbeforetax` float(10,2) NOT NULL,
  `cgsttaxpercentage` int(11) NOT NULL,
  `sgsttaxpercentage` int(11) NOT NULL,
  `igsttaxpercentage` int(11) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `costbd` float(10,2) NOT NULL,
  `costad` float(10,2) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `subcategoryid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `categoryid`, `comp_id`, `title`, `description`, `costbeforetax`, `cgsttaxpercentage`, `sgsttaxpercentage`, `igsttaxpercentage`, `discount`, `costbd`, `costad`, `quantity`, `status`, `subcategoryid`) VALUES
(19, 9, 28, 'Chikku', '', 150.00, 1, 2, 3, 9.00, 159.00, 150.00, '250 grams', 'Active', 14),
(20, 9, 28, 'orange', '', 260.00, 1, 2, 3, 20.00, 275.60, 255.60, '500 grams', 'Active', 14),
(22, 9, 27, 'strawberry', '', 80.00, 1, 2, 3, 13.00, 84.80, 71.80, '6 Pcs', 'Active', 14),
(23, 9, 27, 'Tomato', '', 110.00, 1, 2, 1, 2.00, 114.40, 112.40, '6 Pcs', 'Active', 15),
(24, 9, 27, 'Potato', '', 80.00, 2, 1, 2, 1.00, 84.00, 83.00, '6 Pcs', 'Active', 15),
(25, 9, 27, 'Cucumber', '', 150.00, 1, 2, 1, 2.00, 156.00, 154.00, '3-4Pcs, 500Grams', 'Active', 15),
(26, 10, 27, 'Sandwich bread', '', 370.00, 1, 2, 1, 4.00, 384.80, 380.80, '8-10 Pcs, 500grams', 'Active', 16),
(27, 10, 27, 'Multigrain bread', '', 390.00, 1, 1, 1, 2.00, 401.70, 399.70, '500 grams', 'Active', 16),
(28, 10, 27, 'Brown bread', '', 576.00, 1, 2, 2, 14.00, 604.80, 590.80, '750grams', 'Active', 16),
(29, 11, 27, 'Crackle', '', 49.00, 1, 2, 1, 5.00, 50.96, 45.96, '250grams', 'Active', 17),
(30, 11, 28, 'Celebration', '', 23.00, 6, 5, 6, 2.00, 26.91, 24.91, '15', 'Active', 17),
(31, 11, 28, 'Crispello', '', 23.00, 6, 5, 6, 2.00, 26.91, 24.91, '15', 'Active', 17),
(32, 11, 28, 'Choco crunch', '', 23.00, 6, 5, 6, 2.00, 26.91, 24.91, '15', 'Active', 18),
(33, 11, 28, 'Choco Chips', '', 23.00, 6, 5, 6, 2.00, 26.91, 24.91, '15', 'Active', 18),
(34, 11, 28, 'Cranberry Icecream', '', 23.00, 6, 5, 6, 2.00, 26.91, 24.91, '15', 'Active', 18);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `product_image_id` int(11) NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `imgpath` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`product_image_id`, `productid`, `imgpath`, `description`, `status`) VALUES
(2, 19, 'chikku.jpg', 'aa', 'Active'),
(3, 20, 'orange.jpg', 'pic1', 'Active'),
(4, 22, 'strawberry.jpg', 'mannu', 'Active'),
(5, 23, 'TOMATO.jpg', '', 'Active'),
(6, 24, 'potato.jpg', '', 'Active'),
(7, 25, 'cucumber.jpg', 'a', 'Active'),
(8, 26, 'sandwich.jpg', 's', 'Active'),
(9, 27, 'multigrain.jpg', '1st picture', 'Active'),
(10, 29, 'crackle.jpg', '1st picture', 'Active'),
(11, 30, 'celebration.jpg', '1st picture', 'Active'),
(12, 31, 'Crispello.jpg', '', 'Active'),
(13, 28, 'brown.jpg', '', 'Active'),
(14, 32, 'chococrunch.jpg', 'a', 'Active'),
(15, 33, 'chips.jpg', '1st picture', 'Active'),
(16, 34, 'cranberry.jpg', '2nd pic', 'Active'),
(20, NULL, '941579696Chicken-Banner-N111-700x280.jpg', '1st picture', 'Active'),
(21, NULL, '245683145banner-02.jpg', 'a', 'Active'),
(27, 19, '1230302199meatzzasalamipiece1.jpeg', '1st picture', 'Active'),
(28, 19, '156640311meatzzasalamipiece2.jpeg', 'Round piece picture', 'Active'),
(29, 19, '1784938812meatzzasalamipiece3.jpeg', 'Ingredients pic', 'Active'),
(30, 19, '1734537283meatzzasalamipiece4.jpeg', 'Ingredients details pic', 'Active'),
(31, 19, '1917933640meatzzasalamipiece5.jpeg', 'barcode picture', 'Active'),
(32, 20, '1868286337meatzza fresh thigs 500grams.jpeg', '1st picture', 'Active'),
(33, 21, '696043545fresho farm egggs.jpeg', '1st picture', 'Active'),
(34, 22, '197301590fresho country eggs 6pcs.jpeg', '1st picture', 'Active'),
(35, 23, '1701893395fresho organic eggs.jpeg', '1st picture', 'Active'),
(36, 24, '2032219449fresho protiene eggs 6 pcs.jpeg', '1st picture', 'Active'),
(37, 25, '737665317fresho legs without peiece.jpeg', '1st picture', 'Active'),
(38, 26, '1457429500fresho mutton curry cut 8-10 pcs, 500grams - 379rs pic1.jpeg', '1st picture', 'Active'),
(39, 26, '168881480fresho mutton curry cut 8-10 pcs, 500grams - 379rs pic2.jpeg', 'Additional details pic', 'Active'),
(40, 27, '84324031fresho mutton shoulder pieces 500grams pic1.jpeg', '1st picture', 'Active'),
(41, 28, '162708359fresho lamb leg boneless.jpeg', '1st picture', 'Active'),
(42, 29, '1465016835fresho chicken curry cut.jpg', '1st picture', 'Active'),
(45, 41, '892594906fresho chicken curry cut.jpg', '1st picture', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseid` int(11) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `productid` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `status` varchar(25) NOT NULL,
  `companyid` int(11) DEFAULT NULL,
  `cancellationreason` varchar(200) NOT NULL,
  `sellerpayment` varchar(20) NOT NULL,
  `purchasedate` date NOT NULL,
  `deliverystatus` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `contactno` varchar(15) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseid`, `customerid`, `productid`, `qty`, `cost`, `status`, `companyid`, `cancellationreason`, `sellerpayment`, `purchasedate`, `deliverystatus`, `address`, `city`, `state`, `contactno`, `pincode`, `note`) VALUES
(173, 10, 22, 6, 7.00, 'Active', 25, 'jj', 'notpaid', '2020-09-01', 'jj', 'jj', 'kj', 'j', '8888888888', '888888', 'jj'),
(174, 8, 19, 1, 150.00, 'Cancellation Request', 28, 'i dont like it', 'notpaid', '2020-09-10', 'Pending', 'near raja', 'kaup1', 'Karnataka', '9972595242', '574106', 'Payment type :  <br> Card Number <br> Expiry date :  <br> Card Holder : <br> CVV Number :  '),
(175, 8, 22, 10, 71.80, 'Active', 27, '', 'notpaid', '2020-09-10', 'In Transit', 'near raja', 'kaup1', 'Karnataka', '9972595242', '574106', 'Payment type :  <br> Card Number <br> Expiry date :  <br> Card Holder : <br> CVV Number :  '),
(176, 8, 26, 5, 380.80, 'Active', 27, '', 'notpaid', '2020-09-10', 'Pending', 'near raja', 'kaup1', 'Karnataka', '9972595242', '574106', 'Payment type :  <br> Card Number <br> Expiry date :  <br> Card Holder : <br> CVV Number :  '),
(177, 8, 27, 5, 399.70, 'Active', 27, '', 'notpaid', '2020-09-10', 'Pending', 'near raja', 'kaup1', 'Karnataka', '9972595242', '574106', 'Payment type :  <br> Card Number <br> Expiry date :  <br> Card Holder : <br> CVV Number :  '),
(178, 11, 22, 1, 71.80, 'Active', 27, '', 'notpaid', '2024-06-05', 'Pending', 'Namrtha Nilaya, Kalya', 'kaup', 'Karnataka', '9972595840', '574106', 'Payment type : Master Card<br> Card Number1234567878888889<br> Expiry date : 2024-08<br> Card Holder : nammu<br> CVV Number : 123'),
(179, 11, 27, 1, 399.70, 'Active', 27, '', 'notpaid', '2024-06-05', 'Pending', 'Namrtha Nilaya, Kalya', 'kaup', 'Karnataka', '9972595840', '574106', 'Payment type :  <br> Card Number <br> Expiry date :  <br> Card Holder : <br> CVV Number :  ');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `salary_id` int(11) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `basicsalary` int(11) NOT NULL,
  `salarymonth` int(11) NOT NULL,
  `noworkingdays` int(10) NOT NULL,
  `daysworked` float NOT NULL,
  `salary` float(10,2) NOT NULL,
  `date` date NOT NULL,
  `salyear` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `comp_id` int(11) NOT NULL,
  `compname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `pancardno` varchar(20) NOT NULL,
  `loginid` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `companydetail` varchar(200) NOT NULL,
  `companylogo` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `contactno` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`comp_id`, `compname`, `address`, `state`, `city`, `pincode`, `landmark`, `pancardno`, `loginid`, `password`, `companydetail`, `companylogo`, `status`, `emailid`, `contactno`) VALUES
(24, 'Al farms', 'Bharath Nagar, Divya complex  3rd foolr', 'Assam', 'Barpeta', '781329', 'Near Green land ', 'QWEDS4532Q', 'myloginid', 'password', 'We are selling chickens at good price', '31870952alf-farms-logo.png', 'Active', 'alfarms@gmail.com', '9845902040'),
(25, 'Big sams', 'Divya nagar, United complex, 2nd floor', 'Assam', 'Barpeta', '781325', 'Near laalrang fort', 'REWHG5445Q', 'bigsms', 'password', 'We are in the top 100 Chicken sellers in Assam ', '2000529326big-sams-logo.png', 'Active', 'bigsams@gmail.com', '9845902041'),
(26, 'Blue Flame', 'Shreedurga complex, 2nd floor', 'Assam', 'Barpeta', '781309', 'Near Namrtha nagar Restaurent', 'JHGFD5673A', 'wearebluflame', 'password', 'We receved good checken seller award from hygino awards 2020', '1959841629blueflame.logo.png', 'Active', 'blueflame@gmail.com', '9845902042'),
(27, 'Fresho', 'Raamnagar, vijay complex. 4th floor', 'Karnataka', 'Chikshellikeri', '587204', 'Near St. Marys College', 'KJHLP5660Y', 'fresholog', 'password', 'Fresho has a good name in all over karnataka, in the last 15 years. We are selling lamb and chicken at best prices. ', '9896587fresho-logo.png', 'Active', 'mohammedanwarabbas@gmail.com', '9972595843'),
(28, 'meatzza', 'Chandrahaas complex,  Ground floor', 'Karnataka', 'Hosur', '587207', 'Near Rajmahal Bhavan', 'UUYDF5654G', 'meatzza', 'password', 'We are ranked in top 100 meat sellers in karnataka in Meatindia survey 2019', '900192079meatzza-logo.png', 'Active', 'mufeeeeed@gmail.com', '9845902044'),
(30, 'Oppo chickens', 'kaup', 'Andhra Pradesh', 'kaup', '543321', 'kaup', 'ASDFG5432W', 'oppo', '123123', 'we sell meat at low cost', '402469078fresho legs without peiece.jpeg', 'Pending', 'oppo@gmail.com', '9972595842');

-- --------------------------------------------------------

--
-- Table structure for table `sellerpayment`
--

CREATE TABLE `sellerpayment` (
  `payid` int(11) NOT NULL,
  `sellerid` int(11) DEFAULT NULL,
  `total_amt` float(10,2) NOT NULL,
  `paidamount` float(10,2) NOT NULL,
  `admin_per` int(11) NOT NULL,
  `paid_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellerpayment`
--

INSERT INTO `sellerpayment` (`payid`, `sellerid`, `total_amt`, `paidamount`, `admin_per`, `paid_date`) VALUES
(53, NULL, 100.00, 0.00, 100, '2020-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockid` int(11) NOT NULL,
  `comp_id` int(11) DEFAULT NULL,
  `stockaddeddate` date NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `comp_id`, `stockaddeddate`, `productid`, `quantity`) VALUES
(14, 28, '2020-09-02', 19, 100),
(15, 28, '2020-09-02', 19, 50),
(16, 27, '2020-09-02', 21, 120),
(17, 27, '2020-09-02', 22, 125),
(18, 27, '2020-09-02', 23, 325),
(19, 27, '2020-09-02', 25, 34),
(20, 27, '2020-09-02', 23, 244),
(21, 27, '2020-09-02', 24, 200),
(22, 27, '2020-09-03', 28, 231),
(23, 27, '2020-09-03', 27, 200),
(24, 27, '2020-09-03', 26, 170),
(25, 27, '2020-09-03', 29, 28);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `subcategoryid` int(11) NOT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategorytype` varchar(50) NOT NULL,
  `subcategoryimg` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`subcategoryid`, `categoryid`, `subcategorytype`, `subcategoryimg`, `description`, `status`) VALUES
(14, 9, 'Fruits', '16409APPLE.jfif', 'Fresh Broiler Chicken', 'Active'),
(15, 9, 'Vegetables', '', 'Frozen Chicken', 'Active'),
(16, 10, 'Bread and Buns', 'banner-01.jpg', '', 'Active'),
(17, 11, 'Chocolates', 'dc.webp', '', 'Active'),
(18, 11, 'Icecreams', '', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tblselleraccount`
--

CREATE TABLE `tblselleraccount` (
  `actid` int(11) NOT NULL,
  `sellerid` int(11) DEFAULT NULL,
  `accountno` varchar(25) NOT NULL,
  `bankname` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `w_id` int(11) NOT NULL,
  `productid` int(11) DEFAULT NULL,
  `custid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceid`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `categoryid` (`categoryid`),
  ADD KEY `comp_id` (`comp_id`),
  ADD KEY `subcategoryid` (`subcategoryid`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseid`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `companyid` (`companyid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`comp_id`);

--
-- Indexes for table `sellerpayment`
--
ALTER TABLE `sellerpayment`
  ADD PRIMARY KEY (`payid`),
  ADD KEY `sellerid` (`sellerid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockid`),
  ADD KEY `comp_id` (`comp_id`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`subcategoryid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Indexes for table `tblselleraccount`
--
ALTER TABLE `tblselleraccount`
  ADD PRIMARY KEY (`actid`),
  ADD KEY `sellerid` (`sellerid`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `custid` (`custid`),
  ADD KEY `productid` (`productid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `product_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `comp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `sellerpayment`
--
ALTER TABLE `sellerpayment`
  MODIFY `payid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `subcategoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblselleraccount`
--
ALTER TABLE `tblselleraccount`
  MODIFY `actid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
