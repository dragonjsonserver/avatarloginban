CREATE TABLE `avatarloginbans` (
	`avatarloginban_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	`created` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
	`avatar_id` BIGINT(20) UNSIGNED NOT NULL,
	`end` TIMESTAMP NOT NULL,
	PRIMARY KEY (`avatarloginban_id`),
	UNIQUE KEY `avatar_id` (`avatar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
