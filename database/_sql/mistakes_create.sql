CREATE TABLE `mistakes` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`test_id` INT(11) NOT NULL,
	`sample` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`answer` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `mistakes_id_unique` (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
