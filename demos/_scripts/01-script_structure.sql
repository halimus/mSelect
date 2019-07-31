-- 
-- April 2019
-- 

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mselectdb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mselectdb` ;
CREATE SCHEMA IF NOT EXISTS `mselectdb` DEFAULT CHARACTER SET utf8 ;
USE `mselectdb` ; 

-- -----------------------------------------------------
-- Table `countries`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `states`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


-- -----------------------------------------------------
-- Table `cities`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- View `view_states`
-- -----------------------------------------------------

CREATE OR REPLACE VIEW `view_states` AS (
SELECT
    `states`.`id`
    , `states`.`name`
    , `states`.`country_id`
    , `countries`.`sortname` AS country_code
    , `countries`.`name` AS country_name
    , `countries`.`phonecode` AS country_phone
FROM
    `states`
    INNER JOIN `countries` 
    ON (`states`.`country_id` = `countries`.`id`)
);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

