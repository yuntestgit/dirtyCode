SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE DATABASE  `examination` ;

CREATE TABLE `examination`.`data` (
  `id` int(11) NOT NULL auto_increment,
  `topic` int(11) NOT NULL,
  `q` text NOT NULL,
  `a1` text NOT NULL,
  `a2` text NOT NULL,
  `a3` text NOT NULL,
  `a4` text NOT NULL,
  `a5` text NOT NULL,
  `ans` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

CREATE TABLE `examination`.`topic` (
  `id` int(11) NOT NULL auto_increment,
  `name` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;