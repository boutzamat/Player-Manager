DROP TABLE IF EXISTS `simple_cms_roles`;
CREATE TABLE IF NOT EXISTS `simple_cms_roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role` varchar(250) DEFAULT NULL,
  `status` enum('T','F') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `simple_cms_users`;
CREATE TABLE IF NOT EXISTS `simple_cms_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` enum('T','F') DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `simple_cms_riders`;
CREATE TABLE IF NOT EXISTS `simple_cms_riders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `team_id` int(10) unsigned DEFAULT NULL,
  `group_id` int(10) unsigned DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `rider_name` varchar(250) DEFAULT NULL,
  `q_1` tinyint(1) DEFAULT NULL,
  `q_2` tinyint(1) DEFAULT NULL,
  `q_3` tinyint(1) DEFAULT NULL,
  `f_sm` tinyint(1) DEFAULT NULL,
  `f_dm` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `simple_cms_teams`;
CREATE TABLE IF NOT EXISTS `simple_cms_teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,  
  `team_name` varchar(250) DEFAULT NULL,
  `number_from` varchar(250) DEFAULT NULL,
  `number_to` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `simple_cms_groups`;
CREATE TABLE IF NOT EXISTS `simple_cms_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `simple_cms_options`;
CREATE TABLE IF NOT EXISTS `simple_cms_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `tab_id` tinyint(3) unsigned DEFAULT NULL,
  `group` enum('borders','colors','fonts','sizes') DEFAULT NULL,
  `value` text,
  `description` text,
  `label` text,
  `type` enum('string','text','int','float','enum','color') NOT NULL DEFAULT 'string',
  `order` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`,`key`),
  KEY `tab_id` (`tab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `simple_cms_roles` (`id`, `role`, `status`) VALUES
(1, 'admin', 'T'),
(2, 'user', 'T');

INSERT INTO `simple_cms_options`(`id`, `key`, `tab_id`, `group`, `value`, `description`, `label`, `type`, `order`) VALUES
(NULL, 'info_box', 1, NULL, '', 'Info Box', NULL, 'text', 1);