CREATE TABLE `php7test_db`.`Users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(200) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`user_id`));
)