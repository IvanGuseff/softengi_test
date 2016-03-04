CREATE TABLE `tests` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`pupil_id` INT(11) NOT NULL,
	`types` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`correct` INT(11) NOT NULL DEFAULT '0',
	`incorrect` INT(11) NOT NULL DEFAULT '10',
	`created_at` TIMESTAMP NULL DEFAULT NULL,
	`updated_at` TIMESTAMP NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `tests_id_unique` (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
