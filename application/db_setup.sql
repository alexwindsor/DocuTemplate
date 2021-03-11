CREATE DATABASE IF NOT EXISTS `docutemplate`;
USE `docutemplate`;
CREATE TABLE `docutemplate`.`projects` (`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, `name` VARCHAR(64) NOT NULL, `description` TEXT);
CREATE TABLE `docutemplate`.`section` (`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL, `project_id` INT(11) UNSIGNED NOT NULL, `title` VARCHAR(64) NOT NULL, `content` TEXT, `order` INT(11));

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_section` (IN `project_id` INT UNSIGNED, IN `section_id` INT UNSIGNED)  NO SQL
BEGIN

DECLARE sec_order INT;

SELECT `section`.`order` INTO @sec_order FROM `section` WHERE `section`.`id` = section_id;
DELETE FROM `section` WHERE `section`.`id` = section_id;
UPDATE `section` SET `section`.`order` = `section`.`order` - 1 WHERE `section`.`order` > @sec_order AND `section`.`project_id` = project_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `move_section` (IN `project_id` INT UNSIGNED, IN `section_id` INT UNSIGNED, IN `direction` VARCHAR(4))  NO SQL
BEGIN

DECLARE sec_order INT;

SELECT `section`.`order` INTO @sec_order FROM `section` WHERE `section`.`id` = section_id;

IF direction = "down" THEN
  UPDATE `section` SET `section`.`order` = `section`.`order` - 1 WHERE `section`.`order` = @sec_order + 1 AND `section`.`project_id` = project_id;
  UPDATE `section` SET `section`.`order` = `section`.`order` + 1 WHERE `section`.`id` = section_id;
ELSEIF direction = "up" THEN
  UPDATE `section` SET `section`.`order` = `section`.`order` + 1 WHERE `section`.`order` = @sec_order - 1 AND `section`.`project_id` = project_id;
  UPDATE `section` SET `section`.`order` = `section`.`order` - 1 WHERE `section`.`id` = section_id;
END IF;

END$$

DELIMITER ;

INSERT INTO `docutemplate`.`projects` (`name`, `description`) VALUES ("Project One", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."),
("Another Project", "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
INSERT INTO `docutemplate`.`section` (`section`.`project_id`, `section`.`title`, `section`.`content`, `section`.`order`) VALUES
(1, "Section 1", "quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum", 1),
(1, "Section 2", "quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum", 2),
(1, "Section 3", "quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum", 3),
(2, "Section A", "quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum", 1),
(2, "Section B", "quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum", 2),
(2, "Section C", "quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum

quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum", 3);
