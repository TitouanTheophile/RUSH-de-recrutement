-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 20 Février 2015 à 18:04
-- Version du serveur: 5.5.41
-- Version de PHP: 5.3.10-1ubuntu3.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `socialkod`
--

-- --------------------------------------------------------

--
-- Structure de la table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_albums_profiles1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `albums`
--

INSERT INTO `albums` (`id`, `user_id`, `title`, `description`, `created`, `modified`) VALUES
(1, 2, 'album1', '1er album', '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 6, 'Test', 'Mon premier album !', '2015-02-16 16:52:27', '2015-02-16 16:52:27');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_profiles1` (`from_id`),
  KEY `fk_comments_contents1` (`content_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id`, `from_id`, `content_id`, `content`, `created`, `modified`) VALUES
(1, 1, 2, 'Wow !', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `comments_users`
--

CREATE TABLE IF NOT EXISTS `comments_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `pointType` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profiles_has_comments_comments1` (`comment_id`),
  KEY `fk_profiles_has_comments_profiles1` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contentType_id` int(11) NOT NULL,
  `targetType_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contents_posts1` (`content_id`),
  KEY `fk_contents_contentTypes1` (`contentType_id`),
  KEY `fk_contents_targetTypes1` (`targetType_id`),
  KEY `fk_contents_users2` (`from_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `contents`
--

INSERT INTO `contents` (`id`, `contentType_id`, `targetType_id`, `content_id`, `from_id`, `target_id`, `created`, `modified`) VALUES
(1, 1, 1, 1, 1, 2, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 1, 2, 2, 2, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(3, 2, 1, 1, 3, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(4, 2, 2, 2, 4, 2, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(9, 1, 1, 4, 6, 6, '2015-02-16 16:53:12', '2015-02-16 16:53:12'),
(10, 1, 1, 5, 6, 6, '2015-02-16 16:53:24', '2015-02-16 16:53:24'),
(12, 1, 1, 7, 6, 5, '2015-02-16 16:59:44', '2015-02-16 16:59:44'),
(13, 1, 1, 6, 6, 6, '2015-02-18 14:32:59', '2015-02-18 14:32:59'),
(14, 1, 1, 8, 6, 4, '2015-02-18 15:04:59', '2015-02-18 15:04:59');

-- --------------------------------------------------------

--
-- Structure de la table `contents_users`
--

CREATE TABLE IF NOT EXISTS `contents_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `pointType` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_profiles_has_contents_contents1` (`content_id`),
  KEY `fk_profiles_has_contents_profiles1` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `contents_users`
--

INSERT INTO `contents_users` (`id`, `user_id`, `content_id`, `pointType`, `created`, `modified`) VALUES
(8, 6, 9, 2, '2015-02-18 14:10:40', '2015-02-18 14:10:40');

-- --------------------------------------------------------

--
-- Structure de la table `contentTypes`
--

CREATE TABLE IF NOT EXISTS `contentTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `contentTypes`
--

INSERT INTO `contentTypes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'post', '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 'picture', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `pending` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_friends_profiles2` (`user2_id`),
  KEY `fk_friends_profiles1` (`user1_id`),
  KEY `fk_friends_profiles3` (`pending`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`id`, `user1_id`, `user2_id`, `pending`, `created`, `modified`) VALUES
(1, 1, 2, NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 1, 3, 3, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(3, 2, 3, NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(4, 1, 5, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(9, 6, 8, NULL, '2015-02-20 17:32:35', '2015-02-20 17:53:11'),
(10, 1, 6, 1, '2015-02-20 18:01:44', '2015-02-20 18:01:44'),
(11, 2, 6, 2, '2015-02-20 18:02:25', '2015-02-20 18:02:25');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
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
-- Contenu de la table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'tek1', 'Premiere annee', '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 'tek2', 'Deuxieme annee', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `groups_users`
--

CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_groups_has_profiles_profiles1` (`user_id`),
  KEY `fk_groups_has_profiles_groups1` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `groups_users`
--

INSERT INTO `groups_users` (`id`, `group_id`, `user_id`, `created`, `modified`) VALUES
(1, 1, 2, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 1, 3, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(3, 1, 4, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(4, 2, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(5, 2, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `viewed` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messages_profiles1` (`from_id`),
  KEY `fk_messages_profiles2` (`target_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `from_id`, `target_id`, `content`, `viewed`, `created`, `modified`) VALUES
(1, 2, 1, 'salut', 0, '2015-02-13 14:32:43', '2015-02-13 14:32:43'),
(2, 2, 1, 'salut', 0, '2015-02-13 14:33:19', '2015-02-13 14:33:19'),
(3, 2, 3, 'Coucou', 0, '2015-02-16 11:41:56', '2015-02-16 11:41:56'),
(4, 2, 6, 'Coucou', 1, '2015-02-16 11:42:20', '2015-02-16 11:42:20'),
(5, 6, 2, 'salut', 0, '2015-02-16 14:30:49', '2015-02-16 14:30:49'),
(6, 6, 2, 'salut', 0, '2015-02-16 14:31:53', '2015-02-16 14:31:53'),
(7, 6, 2, 'salut', 0, '2015-02-16 14:31:57', '2015-02-16 14:31:57'),
(8, 6, 2, 'salut', 0, '2015-02-16 14:32:36', '2015-02-16 14:32:36'),
(9, 6, 2, 'salut', 0, '2015-02-16 14:33:04', '2015-02-16 14:33:04'),
(10, 6, 2, 'salut', 0, '2015-02-16 14:34:09', '2015-02-16 14:34:09'),
(11, 6, 2, 'salut', 0, '2015-02-16 14:35:00', '2015-02-16 14:35:00'),
(12, 6, 2, 'salut', 0, '2015-02-16 14:35:03', '2015-02-16 14:35:03'),
(13, 6, 2, 'paoghaogh[agha[gha[oghao[hgaohoghaoghaseuogheuoghaeo[hga[eobnaeuo[bhuoahgao[ghaoghhuohuo[ehgo[ahg''a<hgoa''ehgaoghao[ghao[''ghbve[ugo[<ubgruaro[''<ugar]\\wg\\\r\n', 0, '2015-02-17 11:29:53', '2015-02-17 11:29:53'),
(14, 6, 1, 'Salut ca va ', 0, '2015-02-17 11:46:47', '2015-02-17 11:46:47'),
(15, 8, 6, 'Yop', 1, '2015-02-19 10:55:20', '2015-02-19 10:55:20');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `notificationType_id` int(11) NOT NULL,
  `content_id` int(11) DEFAULT NULL,
  `viewed` tinyint(1) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_notifications_notificationTypes1` (`notificationType_id`),
  KEY `fk_notifications_profiles1` (`from_id`),
  KEY `fk_notifications_profiles2` (`target_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `from_id`, `target_id`, `notificationType_id`, `content_id`, `viewed`, `created`, `modified`) VALUES
(2, 2, 1, 1, 2, 0, '2015-02-13 14:33:19', '2015-02-13 14:33:19'),
(3, 2, 3, 1, 3, 0, '2015-02-16 11:41:56', '2015-02-16 11:41:56'),
(4, 2, 6, 1, 4, 1, '2015-02-16 11:42:20', '2015-02-16 11:42:20'),
(5, 6, 2, 1, 5, 0, '2015-02-16 14:30:49', '2015-02-16 14:30:49'),
(6, 6, 2, 1, 6, 0, '2015-02-16 14:31:53', '2015-02-16 14:31:53'),
(7, 6, 2, 1, 7, 0, '2015-02-16 14:31:57', '2015-02-16 14:31:57'),
(8, 6, 2, 1, 8, 0, '2015-02-16 14:32:36', '2015-02-16 14:32:36'),
(9, 6, 2, 1, 9, 0, '2015-02-16 14:33:04', '2015-02-16 14:33:04'),
(10, 6, 2, 1, 10, 0, '2015-02-16 14:34:09', '2015-02-16 14:34:09'),
(11, 6, 2, 1, 11, 0, '2015-02-16 14:35:00', '2015-02-16 14:35:00'),
(12, 6, 2, 1, 12, 0, '2015-02-16 14:35:03', '2015-02-16 14:35:03'),
(13, 6, 2, 1, 13, 0, '2015-02-17 11:29:53', '2015-02-17 11:29:53'),
(14, 6, 1, 1, 14, 0, '2015-02-17 11:46:47', '2015-02-17 11:46:47'),
(15, 8, 6, 1, 15, 1, '2015-02-19 10:55:20', '2015-02-19 10:55:20');

-- --------------------------------------------------------

--
-- Structure de la table `notificationTypes`
--

CREATE TABLE IF NOT EXISTS `notificationTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `notificationTypes`
--

INSERT INTO `notificationTypes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Message', '2015-02-13 00:00:00', '2015-02-13 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pictures_albums1` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `pictures`
--

INSERT INTO `pictures` (`id`, `description`, `album_id`) VALUES
(1, 'pic1', NULL),
(2, 'pic2', 1),
(4, 'Agent Smith', 2);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`id`, `content`) VALUES
(1, 'BLABLABLA'),
(2, 'LOREM IPSUM'),
(3, 'arhjsjkswjk wj'),
(4, 'Test'),
(5, 'Test'),
(6, 'Test'),
(7, 'Salut Kod 5 !'),
(8, 'Salut Kod4 !');

-- --------------------------------------------------------

--
-- Structure de la table `targetTypes`
--

CREATE TABLE IF NOT EXISTS `targetTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `targetTypes`
--

INSERT INTO `targetTypes` (`id`, `name`, `created`, `modified`) VALUES
(1, 'profile', '2015-02-06 00:00:00', '2015-02-06 00:00:00'),
(2, 'group', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` tinyint(1) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `study_place` varchar(255) DEFAULT NULL,
  `work_place` varchar(255) DEFAULT NULL,
  `user_place` varchar(255) DEFAULT NULL,
  `birthday` datetime NOT NULL,
  `picture_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail_UNIQUE` (`email`),
  KEY `fk_profiles_contents1` (`picture_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `gender`, `firstname`, `lastname`, `study_place`, `work_place`, `user_place`, `birthday`, `picture_id`, `created`, `modified`, `email`, `password`) VALUES
(1, NULL, 'kod1', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod1@socialkod.com', '1111'),
(2, NULL, 'kod2', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod2@socialkod.com', '2222'),
(3, NULL, 'kod3', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod3@socialkod.com', '3333'),
(4, NULL, 'kod4', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod4@socialkod.com', '4444'),
(5, NULL, 'kod5', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod5@socialkod.com', '5555'),
(6, NULL, 'Titou', 'Banana', 'Epitech', 'Kod', '', '2035-01-01 00:00:00', 6, '2015-02-13 14:29:39', '2015-02-18 17:53:52', 'titoubanana@socialkod.com', '4c9d8d7b86f67f48f76101f93082916d8fbd3fe3'),
(8, NULL, 'Benoit', 'Sida', NULL, NULL, NULL, '0000-00-00 00:00:00', NULL, '2015-02-18 13:37:59', '2015-02-18 13:37:59', 'benoit.sida@gmail.com', 'd36a823b010e3678208839d6f29a4908a76f102b');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `fk_albums_profiles1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_profiles1` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_contents1` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comments_users`
--
ALTER TABLE `comments_users`
  ADD CONSTRAINT `fk_profiles_has_comments_profiles1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profiles_has_comments_comments1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `fk_contents_contentTypes1` FOREIGN KEY (`contentType_id`) REFERENCES `contentTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_targetTypes1` FOREIGN KEY (`targetType_id`) REFERENCES `targetTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contents_users2` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contents_users`
--
ALTER TABLE `contents_users`
  ADD CONSTRAINT `fk_profiles_has_contents_profiles10` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_profiles_has_contents_contents10` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `fk_friends_profiles1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_friends_profiles2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_friends_profiles3` FOREIGN KEY (`pending`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `groups_users`
--
ALTER TABLE `groups_users`
  ADD CONSTRAINT `fk_groups_has_profiles_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_has_profiles_profiles1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_profiles1` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_profiles2` FOREIGN KEY (`target_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_notificationTypes1` FOREIGN KEY (`notificationType_id`) REFERENCES `notificationTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifications_profiles1` FOREIGN KEY (`from_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notifications_profiles2` FOREIGN KEY (`target_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_albums1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;