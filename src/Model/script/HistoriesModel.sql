CREATE TABLE `php7test_db`.`Histories` (
  `history_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `amount` DOUBLE NULL,
  `country` VARCHAR(200) NULL,
  `active` TINYINT(1) NULL,
  `datetime` DATETIME NULL,
  PRIMARY KEY (`history_id`));


ADD INDEX `user_id_fk1_idx` (`user_id` ASC) VISIBLE;
ALTER TABLE `php7test_db`.`Histories` 
ADD CONSTRAINT `user_id_fk1`
  FOREIGN KEY (`user_id`)
  REFERENCES `php7test_db`.`Users` (`user_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
)