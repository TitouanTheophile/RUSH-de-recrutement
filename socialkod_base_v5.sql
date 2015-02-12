SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `socialkod` DEFAULT CHARACTER SET utf8 ;
USE `socialkod` ;

-- -----------------------------------------------------
-- Table `socialkod`.`groups`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`posts` (
  `id` INT NOT NULL ,
  `content` TEXT NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`albums`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`albums` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `profile_id` INT NOT NULL ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_albums_profiles1` (`profile_id` ASC) ,
  CONSTRAINT `fk_albums_profiles1`
    FOREIGN KEY (`profile_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`pictures`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`pictures` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `description` TEXT NULL ,
  `album_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_pictures_albums1` (`album_id` ASC) ,
  CONSTRAINT `fk_pictures_albums1`
    FOREIGN KEY (`album_id` )
    REFERENCES `socialkod`.`albums` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`contentTypes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`contentTypes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`targetTypes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`targetTypes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`contents`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`contents` (
  `id` INT NOT NULL ,
  `contentType_id` INT NOT NULL ,
  `targetType_id` INT NOT NULL ,
  `content_id` INT NOT NULL ,
  `from_id` INT NOT NULL ,
  `target_id` INT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_contents_groups1` (`target_id` ASC) ,
  INDEX `fk_contents_posts1` (`content_id` ASC) ,
  INDEX `fk_contents_contentTypes1` (`contentType_id` ASC) ,
  INDEX `fk_contents_targetTypes1` (`targetType_id` ASC) ,
  INDEX `fk_contents_profiles2` (`from_id` ASC) ,
  CONSTRAINT `fk_contents_groups1`
    FOREIGN KEY (`target_id` )
    REFERENCES `socialkod`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contents_profiles1`
    FOREIGN KEY (`target_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contents_posts1`
    FOREIGN KEY (`content_id` )
    REFERENCES `socialkod`.`posts` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contents_pictures1`
    FOREIGN KEY (`content_id` )
    REFERENCES `socialkod`.`pictures` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contents_contentTypes1`
    FOREIGN KEY (`contentType_id` )
    REFERENCES `socialkod`.`contentTypes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contents_targetTypes1`
    FOREIGN KEY (`targetType_id` )
    REFERENCES `socialkod`.`targetTypes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contents_profiles2`
    FOREIGN KEY (`from_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`profiles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `gender` TINYINT(1) NULL ,
  `firstname` VARCHAR(50) NOT NULL ,
  `lastname` VARCHAR(50) NOT NULL ,
  `study_place` VARCHAR(255) NULL ,
  `work_place` VARCHAR(255) NULL ,
  `user_place` VARCHAR(255) NULL ,
  `birthday` DATETIME NOT NULL ,
  `picture_id` INT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  `email` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(40) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `mail_UNIQUE` (`email` ASC) ,
  INDEX `fk_profiles_contents1` (`picture_id` ASC) ,
  CONSTRAINT `fk_profiles_contents1`
    FOREIGN KEY (`picture_id` )
    REFERENCES `socialkod`.`contents` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `from_id` INT NOT NULL ,
  `target_id` INT NOT NULL ,
  `content` TEXT NOT NULL ,
  `viewed` TINYINT(1) NULL DEFAULT false ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_messages_profiles1` (`from_id` ASC) ,
  INDEX `fk_messages_profiles2` (`target_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_messages_profiles1`
    FOREIGN KEY (`from_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_messages_profiles2`
    FOREIGN KEY (`target_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `from_id` INT NOT NULL ,
  `content_id` INT NOT NULL ,
  `content` TEXT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_comments_profiles1` (`from_id` ASC) ,
  INDEX `fk_comments_contents1` (`content_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_comments_profiles1`
    FOREIGN KEY (`from_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_contents1`
    FOREIGN KEY (`content_id` )
    REFERENCES `socialkod`.`contents` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`friends`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`friends` (
  `profile1_id` INT NOT NULL ,
  `profile2_id` INT NOT NULL ,
  `pending` INT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  INDEX `fk_friends_profiles2` (`profile2_id` ASC) ,
  CONSTRAINT `fk_friends_profiles1`
    FOREIGN KEY (`profile1_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_friends_profiles2`
    FOREIGN KEY (`profile2_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_friends_profiles3`
    FOREIGN KEY (`pending` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`notificationTypes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`notificationTypes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`notifications`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`notifications` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `from_id` INT NOT NULL ,
  `target_id` INT NOT NULL ,
  `notificationType_id` INT NOT NULL ,
  `content_id` INT NULL ,
  `viewed` TINYINT(1) NULL DEFAULT false ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_notifications_notificationTypes1` (`notificationType_id` ASC) ,
  INDEX `fk_notifications_profiles1` (`from_id` ASC) ,
  INDEX `fk_notifications_profiles2` (`target_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_notifications_notificationTypes1`
    FOREIGN KEY (`notificationType_id` )
    REFERENCES `socialkod`.`notificationTypes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notifications_profiles1`
    FOREIGN KEY (`from_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notifications_profiles2`
    FOREIGN KEY (`target_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`groups_profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`groups_profiles` (
  `group_id` INT NOT NULL ,
  `profile_id` INT NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_groups_has_profiles_profiles1` (`profile_id` ASC) ,
  INDEX `fk_groups_has_profiles_groups1` (`group_id` ASC) ,
  CONSTRAINT `fk_groups_has_profiles_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `socialkod`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_groups_has_profiles_profiles1`
    FOREIGN KEY (`profile_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`profiles_comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`profiles_comments` (
  `profile_id` INT NOT NULL ,
  `comment_id` INT NOT NULL ,
  `pointType` INT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  INDEX `fk_profiles_has_comments_comments1` (`comment_id` ASC) ,
  INDEX `fk_profiles_has_comments_profiles1` (`profile_id` ASC) ,
  CONSTRAINT `fk_profiles_has_comments_profiles1`
    FOREIGN KEY (`profile_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_has_comments_comments1`
    FOREIGN KEY (`comment_id` )
    REFERENCES `socialkod`.`comments` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`profiles_contents`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`profiles_contents` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `profile_id` INT NOT NULL ,
  `content_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `pointType` INT NULL ,
  INDEX `fk_profiles_has_contents_contents1` (`content_id` ASC) ,
  INDEX `fk_profiles_has_contents_profiles1` (`profile_id` ASC) ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_profiles_has_contents_profiles1`
    FOREIGN KEY (`profile_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profiles_has_contents_contents1`
    FOREIGN KEY (`content_id` )
    REFERENCES `socialkod`.`contents` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `socialkod`.`groups`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`groups` (`id`, `name`, `description`, `created`, `modified`) VALUES (1, 'tek1', 'Premiere annee', '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`groups` (`id`, `name`, `description`, `created`, `modified`) VALUES (2, 'tek2', 'Deuxieme annee', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`posts`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`posts` (`id`, `content`) VALUES (1, 'BLABLABLA');
INSERT INTO `socialkod`.`posts` (`id`, `content`) VALUES (2, 'LOREM IPSUM');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`albums`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`albums` (`id`, `profile_id`, `title`, `description`, `created`, `modified`) VALUES (1, 2, 'album1', '1er album', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`pictures`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`pictures` (`id`, `description`, `album_id`) VALUES (1, 'pic1', NULL);
INSERT INTO `socialkod`.`pictures` (`id`, `description`, `album_id`) VALUES (2, 'pic2', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`contentTypes`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`contentTypes` (`id`, `name`, `created`, `modified`) VALUES (1, 'post', '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`contentTypes` (`id`, `name`, `created`, `modified`) VALUES (2, 'picture', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`targetTypes`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`targetTypes` (`id`, `name`, `created`, `modified`) VALUES (1, 'profile', '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`targetTypes` (`id`, `name`, `created`, `modified`) VALUES (2, 'group', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`contents`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`contents` (`id`, `contentType_id`, `targetType_id`, `content_id`, `from_id`, `target_id`, `created`, `modified`) VALUES (1, 1, 1, 1, 1, 2, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`contents` (`id`, `contentType_id`, `targetType_id`, `content_id`, `from_id`, `target_id`, `created`, `modified`) VALUES (2, 1, 2, 2, 2, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`contents` (`id`, `contentType_id`, `targetType_id`, `content_id`, `from_id`, `target_id`, `created`, `modified`) VALUES (3, 2, 1, 1, 3, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`contents` (`id`, `contentType_id`, `targetType_id`, `content_id`, `from_id`, `target_id`, `created`, `modified`) VALUES (4, 2, 2, 2, 4, 4, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`profiles`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`profiles` (`id`, `gender`, `firstname`, `lastname`, `study_place`, `work_place`, `user_place`, `birthday`, `picture_id`, `created`, `modified`, `email`, `password`) VALUES (1, NULL, 'kod1', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod1@socialkod.com', '1111');
INSERT INTO `socialkod`.`profiles` (`id`, `gender`, `firstname`, `lastname`, `study_place`, `work_place`, `user_place`, `birthday`, `picture_id`, `created`, `modified`, `email`, `password`) VALUES (2, NULL, 'kod2', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod2@socialkod.com', '2222');
INSERT INTO `socialkod`.`profiles` (`id`, `gender`, `firstname`, `lastname`, `study_place`, `work_place`, `user_place`, `birthday`, `picture_id`, `created`, `modified`, `email`, `password`) VALUES (3, NULL, 'kod3', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod3@socialkod.com', '3333');
INSERT INTO `socialkod`.`profiles` (`id`, `gender`, `firstname`, `lastname`, `study_place`, `work_place`, `user_place`, `birthday`, `picture_id`, `created`, `modified`, `email`, `password`) VALUES (4, NULL, 'kod4', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod4@socialkod.com', '4444');
INSERT INTO `socialkod`.`profiles` (`id`, `gender`, `firstname`, `lastname`, `study_place`, `work_place`, `user_place`, `birthday`, `picture_id`, `created`, `modified`, `email`, `password`) VALUES (5, NULL, 'kod1', 'kod', '', '', '', '2015-02-06 00:00:00', NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00', 'kod5@socialkod.com', '5555');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`comments`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`comments` (`id`, `from_id`, `content_id`, `content`, `created`, `modified`) VALUES (NULL, 1, 2, 'Wow !', '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`friends`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`friends` (`profile1_id`, `profile2_id`, `pending`, `created`, `modified`) VALUES (1, 2, NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`friends` (`profile1_id`, `profile2_id`, `pending`, `created`, `modified`) VALUES (1, 3, 3, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`friends` (`profile1_id`, `profile2_id`, `pending`, `created`, `modified`) VALUES (2, 3, NULL, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`friends` (`profile1_id`, `profile2_id`, `pending`, `created`, `modified`) VALUES (1, 5, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `socialkod`.`groups_profiles`
-- -----------------------------------------------------
START TRANSACTION;
USE `socialkod`;
INSERT INTO `socialkod`.`groups_profiles` (`group_id`, `profile_id`, `created`, `modified`) VALUES (1, 2, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`groups_profiles` (`group_id`, `profile_id`, `created`, `modified`) VALUES (1, 3, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`groups_profiles` (`group_id`, `profile_id`, `created`, `modified`) VALUES (1, 4, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`groups_profiles` (`group_id`, `profile_id`, `created`, `modified`) VALUES (2, 1, '2015-02-06 00:00:00', '2015-02-06 00:00:00');
INSERT INTO `socialkod`.`groups_profiles` (`group_id`, `profile_id`, `created`, `modified`) VALUES (2, 5, '2015-02-06 00:00:00', '2015-02-06 00:00:00');

COMMIT;
