-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 01:32 PM
-- Server version: 5.5.41
-- PHP Version: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `socialkod`
--
CREATE DATABASE `socialkod` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `socialkod`;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_albums_profiles1` (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `profile_id`, `title`, `description`, `created`, `modified`) VALUES
(1, 2, 'album1', '1er album', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `from_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `points_likes` int(11) DEFAULT '0',
  `points_connard` int(11) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  KEY `fk_comments_profiles1` (`from_id`),
  KEY `fk_comments_contents1` (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`from_id`, `content_id`, `content`, `points_likes`, `points_connard`, `created`, `modified`) VALUES
(1, 2, 'Wow !', 1, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contentTypes`
--

CREATE TABLE IF NOT EXISTS `contentTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contentTypes`
--

INSERT INTO `contentTypes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'post', '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 'picture', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL,
  `contentType_id` int(11) NOT NULL,
  `targetType_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `points_like` int(11) DEFAULT '0',
  `points_connard` int(11) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contents_groups1` (`target_id`),
  KEY `fk_contents_posts1` (`content_id`),
  KEY `fk_contents_contentTypes1` (`contentType_id`),
  KEY `fk_contents_targetTypes1` (`targetType_id`),
  KEY `fk_contents_profiles2` (`from_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `contentType_id`, `targetType_id`, `content_id`, `from_id`, `target_id`, `points_like`, `points_connard`, `created`, `modified`) VALUES
(1, 1, 1, 1, 1, 2, 1, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 1, 2, 2, 2, 1, 0, 0, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(3, 2, 1, 1, 3, 1, 2, 0, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(4, 2, 2, 2, 4, 2, 4, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `profile1_id` int(11) NOT NULL,
  `profile2_id` int(11) NOT NULL,
  `pending` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  KEY `fk_friends_profiles2` (`profile2_id`),
  KEY `fk_friends_profiles1` (`profile1_id`),
  KEY `fk_friends_profiles3` (`pending`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`profile1_id`, `profile2_id`, `pending`, `created`, `modified`) VALUES
(1, 2, NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(1, 3, 3, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 3, NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(1, 5, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'tek1', 'Premiere annee', '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 'tek2', 'Deuxieme annee', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `groups_profiles`
--

CREATE TABLE IF NOT EXISTS `groups_profiles` (
  `group_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  KEY `fk_groups_has_profiles_profiles1` (`profile_id`),
  KEY `fk_groups_has_profiles_groups1` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_profiles`
--

INSERT INTO `groups_profiles` (`group_id`, `profile_id`, `created`, `modified`) VALUES
(1, 2, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(1, 3, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(1, 4, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `view` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_profiles1` (`from_id`),
  KEY `fk_messages_profiles2` (`target_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_id`, `target_id`, `content`, `view`, `created`, `modified`) VALUES
(1, 2, 1, 'Hello', 0, '2015-02-11 13:28:32', '2015-02-11 13:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `notificationTypes`
--

CREATE TABLE IF NOT EXISTS `notificationTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `notificationTypes`
--

INSERT INTO `notificationTypes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Message', '2015-02-11 13:19:00', '2015-02-11 13:19:00');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `from_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `notificationType_id` int(11) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `view` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  KEY `fk_notifications_notificationTypes1` (`notificationType_id`),
  KEY `fk_notifications_profiles1` (`from_id`),
  KEY `fk_notifications_profiles2` (`target_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`from_id`, `target_id`, `notificationType_id`, `content_id`, `view`, `created`, `modified`) VALUES
(2, 1, 1, 1, 0, '2015-02-11 13:28:32', '2015-02-11 13:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pictures_albums1` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `description`, `album_id`) VALUES
(1, 'pic1', NULL),
(2, 'pic2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`) VALUES
(1, 'BLABLABLA'),
(2, 'LOREM IPSUM');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `study_place` varchar(255) DEFAULT NULL,
  `work_place` varchar(255) DEFAULT NULL,
  `user_place` varchar(255) DEFAULT NULL,
  `birthday` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  KEY `fk_profiles_contents1` (`picture_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `firstname`, `lastname`, `study_place`, `work_place`, `user_place`, `birthday`, `created`, `modified`, `picture_id`, `mail`, `password`) VALUES
(1, 'kod1', 'kod', '', '', '', '2015-02-06 00:00:00', '2015-02-06 00:00:00', '2015-02-06 00:00:00', NULL, 'kod1@socialkod.com', '1111'),
(2, 'kod2', 'kod', '', '', '', '2015-02-06 00:00:00', '2015-02-06 00:00:00', '2015-02-06 00:00:00', NULL, 'kod2@socialkod.com', '2222'),
(3, 'kod3', 'kod', '', '', '', '2015-02-06 00:00:00', '2015-02-06 00:00:00', '2015-02-06 00:00:00', NULL, 'kod3@socialkod.com', '3333'),
(4, 'kod4', 'kod', '', '', '', '2015-02-06 00:00:00', '2015-02-06 00:00:00', '2015-02-06 00:00:00', NULL, 'kod4@socialkod.com', '4444'),
(5, 'kod1', 'kod', '', '', '', '2015-02-06 00:00:00', '2015-02-06 00:00:00', '2015-02-06 00:00:00', NULL, 'kod5@socialkod.com', '5555');

-- --------------------------------------------------------

--
-- Table structure for table `targetTypes`
--

CREATE TABLE IF NOT EXISTS `targetTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `targetTypes`
--

INSERT INTO `targetTypes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'profile', '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 'group', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `fk_albums_profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_profiles1` FOREIGN KEY (`from_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_contents1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `fk_contents_groups1` FOREIGN KEY (`target_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_profiles1` FOREIGN KEY (`target_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_posts1` FOREIGN KEY (`content_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_pictures1` FOREIGN KEY (`content_id`) REFERENCES `pictures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_contentTypes1` FOREIGN KEY (`contentType_id`) REFERENCES `contentTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_targetTypes1` FOREIGN KEY (`targetType_id`) REFERENCES `targetTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_profiles2` FOREIGN KEY (`from_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `fk_friends_profiles1` FOREIGN KEY (`profile1_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_friends_profiles2` FOREIGN KEY (`profile2_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_friends_profiles3` FOREIGN KEY (`pending`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `groups_profiles`
--
ALTER TABLE `groups_profiles`
  ADD CONSTRAINT `fk_groups_has_profiles_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_has_profiles_profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_profiles1` FOREIGN KEY (`from_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_profiles2` FOREIGN KEY (`target_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_notificationTypes1` FOREIGN KEY (`notificationType_id`) REFERENCES `notificationTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifications_profiles1` FOREIGN KEY (`from_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifications_profiles2` FOREIGN KEY (`target_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_albums1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_profiles_contents1` FOREIGN KEY (`picture_id`) REFERENCES `contents` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
