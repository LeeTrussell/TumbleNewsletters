-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2013 at 12:25 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newsletter`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_lists`
--

CREATE TABLE IF NOT EXISTS `newsletter_lists` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(255) NOT NULL,
  `list_description` text NOT NULL,
  `list_created` datetime NOT NULL,
  `list_delete` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `newsletter_lists`
--

INSERT INTO `newsletter_lists` (`list_id`, `list_name`, `list_description`, `list_created`, `list_delete`) VALUES
(1, 'Important People', 'A list of reviewers.', '2013-02-27 09:41:47', 1),
(3, 'All', '', '2013-03-07 22:00:36', 0),
(6, 'Friends', '', '2013-03-07 22:25:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_login`
--

CREATE TABLE IF NOT EXISTS `newsletter_login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_seed` varchar(255) NOT NULL,
  `user_privileges` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter_login`
--

INSERT INTO `newsletter_login` (`user_id`, `user_username`, `user_password`, `user_email`, `user_seed`, `user_privileges`) VALUES
(1, 'HelgeSverre', '33jI4KFIJniZY', 'ltumbleweed@yahoo.co.uk', '33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_mailing_campaigns`
--

CREATE TABLE IF NOT EXISTS `newsletter_mailing_campaigns` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_campaign` varchar(255) NOT NULL,
  `mail_newsletter` int(11) NOT NULL,
  `mail_created` datetime NOT NULL,
  `mail_sendto_count` int(11) NOT NULL,
  `mail_to_address` varchar(1000) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `newsletter_mailing_campaigns`
--

INSERT INTO `newsletter_mailing_campaigns` (`mail_id`, `mail_campaign`, `mail_newsletter`, `mail_created`, `mail_sendto_count`, `mail_to_address`) VALUES
(2, 'A test of the Mail Campaign', 1, '2013-02-27 19:34:41', 1, ''),
(5, 'testing', 1, '2013-03-07 20:39:59', 1, ''),
(6, 'Hi, There guys', 1, '2013-03-07 21:39:12', 1, 'Switchblade subscribers'),
(7, 'Hi There', 4, '2013-03-07 22:59:14', 2, 'Helges Fans'),
(8, 'This should be the final test', 1, '2013-03-07 23:03:48', 2, 'Helge'),
(9, 'Deffo the final one', 1, '2013-03-07 23:07:44', 2, 'People'),
(10, 'Deffo, Deffo', 6, '2013-03-07 23:09:46', 2, 'p'),
(11, 'dfgdfgf', 1, '2013-03-07 23:11:32', 2, 'Helge');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletter_newsletters` (
  `newsletter_id` int(11) NOT NULL AUTO_INCREMENT,
  `newsletter_title` varchar(255) NOT NULL,
  `newsletter_description` text NOT NULL,
  `newsletter_content` text NOT NULL,
  `newsletter_created` datetime NOT NULL,
  PRIMARY KEY (`newsletter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `newsletter_newsletters`
--

INSERT INTO `newsletter_newsletters` (`newsletter_id`, `newsletter_title`, `newsletter_description`, `newsletter_content`, `newsletter_created`) VALUES
(1, 'Testing', 'Testing', '&lt;p style=&quot;text-align: left;&quot;&gt;Testing&lt;img alt=&quot;&quot; src=&quot;/newsletter/cms/./ckeditor_images/image_512e1aa04cb88.png&quot; style=&quot;width: 694px; height: 674px;&quot; /&gt;&lt;/p&gt;\r\n', '2013-02-27 14:22:54'),
(4, 'getre', 'tetee', '&lt;p&gt;eterteetet&lt;/p&gt;\r\n', '2013-03-07 20:08:35'),
(5, 'eweww', 'ewewrewrewr', '&lt;p&gt;ttretertert&lt;/p&gt;\r\n', '2013-03-07 20:09:51'),
(6, 'uyyuit', 'tyuuu', '&lt;p&gt;utu&lt;/p&gt;\r\n', '2013-03-07 20:10:55'),
(7, 'tujyttr', 'ertrert', '&lt;p&gt;ettert&lt;/p&gt;\r\n', '2013-03-07 20:12:03'),
(8, 'gsg', 'ewtewt', '&lt;p&gt;eteteteret&lt;/p&gt;\r\n', '2013-03-07 20:13:37'),
(9, 'ssfdsdf', 'sdfsdfsdfsf', '&lt;p&gt;sdfdsdfsfd&lt;/p&gt;\r\n', '2013-03-07 20:15:19'),
(10, 'etrtet', 'etet', '&lt;p&gt;rtet&lt;/p&gt;\r\n', '2013-03-07 20:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_send_lists`
--

CREATE TABLE IF NOT EXISTS `newsletter_send_lists` (
  `sending_id` int(11) NOT NULL AUTO_INCREMENT,
  `sending_list` int(11) NOT NULL,
  `sending_campaign` int(11) NOT NULL,
  PRIMARY KEY (`sending_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `newsletter_send_lists`
--

INSERT INTO `newsletter_send_lists` (`sending_id`, `sending_list`, `sending_campaign`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 1, 0),
(4, 2, 0),
(7, 1, 5),
(8, 2, 5),
(9, 1, 6),
(10, 3, 7),
(11, 3, 8),
(12, 3, 9),
(13, 3, 10),
(14, 3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_settings`
--

CREATE TABLE IF NOT EXISTS `newsletter_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `smtp_from` varchar(1000) NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `newsletter_settings`
--

INSERT INTO `newsletter_settings` (`settings_id`, `smtp_host`, `smtp_port`, `smtp_username`, `smtp_password`, `smtp_from`) VALUES
(1, '', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscribe_email` varchar(255) NOT NULL,
  `subscribe_created` datetime NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`subscribe_id`, `subscribe_email`, `subscribe_created`) VALUES
(4, 'ltumbleweed@yahoo.co.uk', '2013-03-07 23:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_to_send`
--

CREATE TABLE IF NOT EXISTS `newsletter_to_send` (
  `send_id` int(11) NOT NULL AUTO_INCREMENT,
  `send_campaign` int(11) NOT NULL,
  `send_user` int(11) NOT NULL,
  PRIMARY KEY (`send_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_users_lists`
--

CREATE TABLE IF NOT EXISTS `newsletter_users_lists` (
  `lists_id` int(11) NOT NULL AUTO_INCREMENT,
  `lists_user_id` int(11) NOT NULL,
  `lists_list_id` int(11) NOT NULL,
  PRIMARY KEY (`lists_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `newsletter_users_lists`
--

INSERT INTO `newsletter_users_lists` (`lists_id`, `lists_user_id`, `lists_list_id`) VALUES
(5, 4, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
