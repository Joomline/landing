CREATE TABLE IF NOT EXISTS `#__landingmanagement_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `published` int(2) NOT NULL,
  `menu_title` varchar(200) NOT NULL,
  `input` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `site_id` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__landingmanagement_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `published` int(2) NOT NULL,
  `site_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__landingmanagement_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `metatitle` text NOT NULL,
  `metadesc` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `published` int(2) NOT NULL,
  `site_id` int(11) NOT NULL,
  `blocks` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#__landingmanagement_sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `alias` varchar(200) NOT NULL,
  `asset_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `introtext` text NOT NULL,
  `fulltext` text NOT NULL,
  `created` datetime NOT NULL,
  `ordering` int(11) NOT NULL,
  `metatitle` text NOT NULL,
  `metadesc` text NOT NULL,
  `hits` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `published` int(2) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `abstract` text NOT NULL,
  `main_blocks` text NOT NULL,
  `template` varchar(125) NOT NULL,
  `domain` varchar(125) NOT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `domain` (`domain`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

