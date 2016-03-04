CREATE TABLE `pupils` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `pupils_name_unique` (`name`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
