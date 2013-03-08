-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2013 at 04:29 PM
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
(1, 'Reviewers', 'A list of reviewers.', '2013-02-27 09:41:47', 1),
(3, 'All', '', '2013-03-07 22:00:36', 0),
(6, 'Friends', 'Friends and family', '2013-03-07 22:25:01', 1);

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
  `mail_content` longtext NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `newsletter_mailing_campaigns`
--

INSERT INTO `newsletter_mailing_campaigns` (`mail_id`, `mail_campaign`, `mail_newsletter`, `mail_created`, `mail_sendto_count`, `mail_to_address`, `mail_content`) VALUES
(13, 'Reviewers Update 1', 11, '2013-03-08 09:23:32', 2, 'helge.sverre@gmail.com', '&lt;p&gt;just a test&lt;/p&gt;\r\n'),
(14, 'Testing For Helge', 11, '2013-03-08 09:37:47', 2, 'Switchblade Subscribers', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n'),
(15, 'Fans of Switchblade', 11, '2013-03-08 09:41:05', 2, 'Fans Of Switchblade', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n'),
(16, 'dgfdg', 11, '2013-03-08 09:43:11', 2, 'dfgddg', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n'),
(17, 'dfgdg', 11, '2013-03-08 09:45:16', 2, 'dgg', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n'),
(18, 'Another Test of the Mailing System', 11, '2013-03-08 09:47:59', 2, 'Helge&#039;s Fans', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n'),
(19, 'Should not have html entities', 11, '2013-03-08 09:50:29', 2, 'Helge&#039;s Fans', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n'),
(20, 'Testing', 11, '2013-03-08 09:52:23', 2, 'Helge&#039;s Switchblade Subscribers', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n'),
(21, 'They Should Be Gone Now', 11, '2013-03-08 09:56:09', 2, 'Helge&#039;s Switchblade subscribers', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `newsletter_newsletters`
--

INSERT INTO `newsletter_newsletters` (`newsletter_id`, `newsletter_title`, `newsletter_description`, `newsletter_content`, `newsletter_created`) VALUES
(11, 'Switchblade Version x.x Released', 'This is a template that will be used when new versions are released', '&lt;h2 style=&quot;text-align: left;&quot;&gt;Helge&amp;#39;s Switchblade x.x Released&amp;nbsp;&lt;/h2&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;Changelog xx.xx.xx&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;Change 1&amp;nbsp;&lt;img alt=&quot;&quot; src=&quot;http://switchblade.helgesverre.com/images/slides/logo.png&quot; style=&quot;width: 392px; height: 274px; float: right;&quot; /&gt;&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;change 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 1&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;bug 2&lt;/li&gt;\r\n	&lt;li style=&quot;text-align: left;&quot;&gt;minor bug fix 1&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;p style=&quot;text-align: left;&quot;&gt;You can download the newest version on the main website by click &amp;quot;Download for FREE&amp;quot; or by clicking &lt;a href=&quot;http://switchblade.helgesverre.com/files/xxxx.exe&quot;&gt;HERE&lt;/a&gt;&lt;/p&gt;\r\n', '2013-03-08 09:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_send_lists`
--

CREATE TABLE IF NOT EXISTS `newsletter_send_lists` (
  `sending_id` int(11) NOT NULL AUTO_INCREMENT,
  `sending_list` int(11) NOT NULL,
  `sending_campaign` int(11) NOT NULL,
  PRIMARY KEY (`sending_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `newsletter_send_lists`
--

INSERT INTO `newsletter_send_lists` (`sending_id`, `sending_list`, `sending_campaign`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 1, 0),
(4, 2, 0),
(16, 1, 13),
(17, 3, 14),
(18, 3, 15),
(19, 3, 16),
(20, 3, 17),
(21, 3, 18),
(22, 3, 19),
(23, 3, 20),
(24, 3, 21);

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
(1, 'ssl://smtp.gmail.com', 465, 'ltumbleweed2@gmail.com', '', 'Helge&#039;s Switchblade');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `subscribe_id` int(11) NOT NULL AUTO_INCREMENT,
  `subscribe_email` varchar(255) NOT NULL,
  `subscribe_created` datetime NOT NULL,
  PRIMARY KEY (`subscribe_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `newsletter_subscribers`
--

INSERT INTO `newsletter_subscribers` (`subscribe_id`, `subscribe_email`, `subscribe_created`) VALUES
(4, 'ltumbleweed@yahoo.co.uk', '2013-03-07 23:22:37'),
(5, 'helge.sverre@gmail.com', '2013-03-08 09:20:04'),
(6, 'gunstein@bjornevoll.no', '2013-03-08 11:02:32');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `newsletter_users_lists`
--

INSERT INTO `newsletter_users_lists` (`lists_id`, `lists_user_id`, `lists_list_id`) VALUES
(5, 4, 3),
(7, 5, 3),
(11, 4, 1),
(12, 5, 1),
(13, 5, 6),
(14, 6, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
