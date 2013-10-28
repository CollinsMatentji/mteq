
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2013 at 02:39 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a4246565_mteq`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `B_NAME` varchar(50) NOT NULL,
  PRIMARY KEY (`B_NAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` VALUES('Apple');
INSERT INTO `brand` VALUES('Samsung');
INSERT INTO `brand` VALUES('Toshiba');
INSERT INTO `brand` VALUES('Vodacom');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `U_MAIL` varchar(50) NOT NULL,
  `B_NAME` varchar(50) NOT NULL,
  `I_MODEL` varchar(50) NOT NULL,
  `C_QTY` int(100) NOT NULL,
  `P_NUM` float NOT NULL,
  PRIMARY KEY (`U_MAIL`,`B_NAME`,`I_MODEL`,`P_NUM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` VALUES('mrtrmello', 'Samsung', '5050', 1, 1);
INSERT INTO `cart` VALUES('mrtrmello', 'Samsung', '5050', 1, 2);
INSERT INTO `cart` VALUES('mrtrmello', 'Samsung', '5050', 1, 5);
INSERT INTO `cart` VALUES('mrtrmello', 'Samsung', '5050', 1, 6);
INSERT INTO `cart` VALUES('mrtrmello', 'Toshiba', '623', 1, 5);
INSERT INTO `cart` VALUES('mrtrmello', 'Toshiba', '623', 1, 6);
INSERT INTO `cart` VALUES('mrtrmello', 'Vodacom', '5050s', 1, 5);
INSERT INTO `cart` VALUES('mrtrmelo@yahoo.com', 'Apple', 'utu03', 1, 7);
INSERT INTO `cart` VALUES('mrtrmelo@yahoo.com', 'Apple', '2.1 w', 2, 7);
INSERT INTO `cart` VALUES('modikoe@gmail.com', 'Apple', 'g550', 2, 8);
INSERT INTO `cart` VALUES('modikoe@gmail.com', 'Apple', '60ssr', 1, 8);
INSERT INTO `cart` VALUES('modikoe@gmail.com', 'Toshiba', '623', 1, 8);
INSERT INTO `cart` VALUES('mrtrmello@yahoo.com', 'Samsung', '5050', 3, 9);
INSERT INTO `cart` VALUES('thapelo@mindinteractive.co.za', 'Apple', '3.5 vf', 4, 10);
INSERT INTO `cart` VALUES('thapelo@mindinteractive.co.za', 'Apple', 'utu03', 1, 10);
INSERT INTO `cart` VALUES('lebosekelr@yahoo.com', 'Apple', 'uzz87', 1, 11);
INSERT INTO `cart` VALUES('lebosekelr@yahoo.com', 'Apple', 'g550', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `I_CAT` varchar(50) NOT NULL,
  `B_NAME` varchar(50) NOT NULL,
  `I_MODEL` varchar(50) NOT NULL,
  `I_DESC` varchar(200) NOT NULL,
  `I_PRICE` varchar(50) NOT NULL,
  `I_PIC` varchar(50) NOT NULL,
  `I_SEX` varchar(50) NOT NULL,
  `I_SELL` varchar(50) DEFAULT NULL,
  `I_QTY` int(50) DEFAULT NULL,
  PRIMARY KEY (`B_NAME`,`I_MODEL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` VALUES('Ipods', 'Apple', '2.1 w', '          ', '500', 'Apple_2.1 w', 'men and ladies', 'yes', 8);
INSERT INTO `item` VALUES('Ipods', 'Apple', '3.5 vf', '                ', '450', 'Apple_3.5 vf', 'men and ladies', 'yes', 11);
INSERT INTO `item` VALUES('Ipods', 'Apple', '60ssr', '16g 1000songs 500 pictures        ', '250', 'Apple_60ssr', 'men and ladies', 'yes', 25);
INSERT INTO `item` VALUES('Laptops', 'Apple', 'g550', '250 gb 2.5 ghz              ', '6000', 'Apple_g550', 'men and ladies', 'yes', 7);
INSERT INTO `item` VALUES('Modems', 'Apple', 'utu03', 'free 100 mb    ', '300', 'Apple_utu03', 'men and ladies', 'yes', 28);
INSERT INTO `item` VALUES('Modems', 'Apple', 'uzz87', '                ', '450', 'Apple_uzz87', 'men and ladies', 'yes', 0);
INSERT INTO `item` VALUES('Laptops', 'Samsung', '5050', '                ', '600', 'Samsung_5050', 'men and ladies', 'yes', 53);
INSERT INTO `item` VALUES('Laptops', 'Toshiba', '623', '                ', '3000', 'Toshiba_623', 'men and ladies', 'yes', 18);
INSERT INTO `item` VALUES('Modems', 'Vodacom', '5050s', '                ', '6000', 'Vodacom_5050', 'men and ladies', 'yes', 299);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `P_NUM` float NOT NULL AUTO_INCREMENT,
  `P_STATUS` varchar(100) DEFAULT NULL,
  `P_DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`P_NUM`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` VALUES(1, 'expired', '2012-10-29 06:55:00');
INSERT INTO `purchase` VALUES(2, 'expired', '2012-10-29 07:11:00');
INSERT INTO `purchase` VALUES(3, 'pending', NULL);
INSERT INTO `purchase` VALUES(4, 'pending', NULL);
INSERT INTO `purchase` VALUES(5, 'completed', '2012-10-29 07:17:00');
INSERT INTO `purchase` VALUES(6, 'expired', '2012-10-29 07:21:00');
INSERT INTO `purchase` VALUES(7, 'started', '2012-10-29 03:12:00');
INSERT INTO `purchase` VALUES(8, 'cancelled', '2012-10-29 15:48:00');
INSERT INTO `purchase` VALUES(9, 'started', '2013-10-02 15:25:00');
INSERT INTO `purchase` VALUES(10, 'started', '2013-03-27 04:41:00');
INSERT INTO `purchase` VALUES(11, 'pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `U_MAIL` varchar(50) NOT NULL,
  `U_PASS` varchar(50) NOT NULL,
  `U_ROLE` varchar(50) NOT NULL,
  `U_FNAME` varchar(50) NOT NULL,
  `U_LNAME` varchar(50) NOT NULL,
  `U_TEL` varchar(50) NOT NULL,
  `U_ADDRESS` varchar(50) NOT NULL,
  `U_SUBSC` varchar(3) NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`U_MAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES('85', '85', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('ddd', 'ddd', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('dumi@gmail.com', '123456', 'buyer', 'Dumisani', 'Tsela', '0728740961', 'ghghghghghgh77-qqqqqqqq45aa-10111', 'Yes');
INSERT INTO `user` VALUES('gghhgh', 'ggghhgg', 'buyer', 'Bonnyssss', 'Bonny', 'ghghgggh', '3046 Block L-Bonnyssss-Bonnyssss', 'No');
INSERT INTO `user` VALUES('ghghggh', 'ghgggh', 'buyer', 'Bonnyssss', 'Bonny', 'aaaa', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('hhhh', '21', 'buyer', 'Bonnyssss', 'Bonny', 'ttttt', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('lu@gmail.com', '123456', 'admin', 'Lu', 'Nkosi', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('mokhari@tut.ac.za', '123456789', 'buyer', 'Bonnyssss', 'Bonny', '0732819436', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('mrtrmell', 'gggggg', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('mrtrmelllll@hhh.com', '111111111', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('mrtrmelllll@hhh.com.nn', 'sssssss', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('mrtrmelllll@hhh.comaaa', '111111111', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('mrtrmello', 'mello', 'admin', 'Mello', 'Raymonds', '0721925102', '3046 Block L-Soshanguve-0153', 'Yes');
INSERT INTO `user` VALUES('nolutushongwe@gmail.com', '1234567', 'buyer', 'Noluntu', 'Shongwe', '0721925102', 'Line1-Line2-', 'Yes');
INSERT INTO `user` VALUES('ntefu@mail.com', 'ntefumail', 'buyer', 'Phooko', 'Ntefu', '0721925102', 'Block L--0152', 'Yes');
INSERT INTO `user` VALUES('ntefu@mail2.com', 'ntefumail', 'buyer', 'Phooko', 'Ntefu', '0721925102', 'Block L-Soshanguve-0152', 'Yes');
INSERT INTO `user` VALUES('riva', 'mello', 'buyer', 'Mello', 'Hutame', '0721925102', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('ss', 's', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('sss', 'ss', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('sssss', 'ssssss', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('ssssss@hhhhh.co.za', 'sssssss', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('wwww', 'wwww', 'buyer', 'Bonnyssss', 'Bonny', '', '3046 Block L-Bonnyssss-Bonnyssss', 'Yes');
INSERT INTO `user` VALUES('mrtrmelo@yahoo.com', '808217', 'buyer', 'ray', 'matome', '', 'Line1-Line2-', 'Yes');
INSERT INTO `user` VALUES('modikoe@gmail.com', '123456', 'buyer', 'dookie', 'modikoe', '', 'Line1-Line2-', 'Yes');
INSERT INTO `user` VALUES('mrtrmello@yahoo.com', '808217', 'buyer', 'Raymond', 'Mello', '0721925102', 'Line1-Line2-', 'Yes');
INSERT INTO `user` VALUES('thapelo@mindinteractive.co.za', '123456', 'buyer', 'Thapelo', 'Kenoshi', '27118078600', 'Line1-Line2-2191', 'Yes');
INSERT INTO `user` VALUES('tjmandli@gmail.co.za', 'Tshepiso', 'buyer', 'Tshepiso', 'Mandli', '', 'Line1-Line2-', 'Yes');
INSERT INTO `user` VALUES('lebosekelr@yahoo.com', 'lebo001', 'buyer', 'lebogang', 'sekele', '0736399055', 'Line1-Line2-', 'Yes');
INSERT INTO `user` VALUES('collins@gmail.com', 'admin', 'admin', 'Collins', 'Matentji', '0736399055', 'Line1-Line2-', 'Yes');
