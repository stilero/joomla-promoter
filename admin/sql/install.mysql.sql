CREATE TABLE IF NOT EXISTS `#__promoter_pings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `projects_id` int(11) NOT NULL,
  `servers_id` int(11) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `response_code` int(4) unsigned NOT NULL,
  `response_message` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `#__promoter_projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `description` text,
  `published` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `#__promoter_servers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `published` tinyint(1) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `last_response` datetime DEFAULT NULL,
  `working` tinyint(1) NOT NULL,
  `extended_ping` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

