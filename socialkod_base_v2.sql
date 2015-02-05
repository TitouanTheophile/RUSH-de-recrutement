SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `socialkod` DEFAULT CHARACTER SET utf8 ;
USE `socialkod` ;

-- -----------------------------------------------------
-- Table `socialkod`.`profiles`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`profiles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `firstname` VARCHAR(50) NOT NULL ,
  `lastname` VARCHAR(50) NOT NULL ,
  `study_place` VARCHAR(255) NULL ,
  `work_place` VARCHAR(255) NULL ,
  `user_place` VARCHAR(255) NULL ,
  `birthday` DATETIME NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`users` (
  `profiles_id` INT NOT NULL ,
  `mail` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(40) NOT NULL ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`profiles_id`) ,
  INDEX `fk_users_profiles1` (`profiles_id` ASC) ,
  CONSTRAINT `fk_users_profiles1`
    FOREIGN KEY (`profiles_id` )
    REFERENCES `socialkod`.`profiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`messages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`messages` (
  `from_id` INT NOT NULL ,
  `target_id` INT NOT NULL ,
  `content` TEXT NOT NULL ,
  `read` TINYINT(1) NULL DEFAULT false ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_messages_profiles1` (`from_id` ASC) ,
  INDEX `fk_messages_profiles2` (`target_id` ASC) ,
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
  `id` INT NOT NULL ,
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
  `album_id` INT NOT NULL ,
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
  `points_like` INT NULL DEFAULT 0 ,
  `points_connard` INT NULL DEFAULT 0 ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_contents_groups1` (`target_id` ASC) ,
  INDEX `fk_contents_posts1` (`content_id` ASC) ,
  INDEX `fk_contents_contentTypes1` (`contentType_id` ASC) ,
  INDEX `fk_contents_targetTypes1` (`targetType_id` ASC) ,
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
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `socialkod`.`comments`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `socialkod`.`comments` (
  `from_id` INT NOT NULL ,
  `content_id` INT NOT NULL ,
  `content` TEXT NOT NULL ,
  `points_likes` INT NULL DEFAULT 0 ,
  `points_connard` INT NULL DEFAULT 0 ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_comments_profiles1` (`from_id` ASC) ,
  INDEX `fk_comments_contents1` (`content_id` ASC) ,
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
  `from_id` INT NOT NULL ,
  `target_id` INT NOT NULL ,
  `notificationType_id` INT NOT NULL ,
  `content_id` INT NULL ,
  `read` TINYINT(1) NULL DEFAULT false ,
  `created` DATETIME NOT NULL ,
  `modified` DATETIME NOT NULL ,
  INDEX `fk_notifications_notificationTypes1` (`notificationType_id` ASC) ,
  INDEX `fk_notifications_profiles1` (`from_id` ASC) ,
  INDEX `fk_notifications_profiles2` (`target_id` ASC) ,
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



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
