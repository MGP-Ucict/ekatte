CREATE DATABASE IF NOT EXISTS teritorial_units;
USE teritorial_units;
CREATE TABLE IF NOT EXISTS `ekatte` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ekatte` char(5) NOT NULL,
  `t_v_m`  varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `oblast` char(3) NOT NULL,
  `obshtina` char(5) NOT NULL,
  `kmetstvo` char(8) NOT NULL,
  `kind` tinyint unsigned NOT NULL,
  `category` tinyint unsigned NOT NULL,
  `altitude` tinyint unsigned NOT NULL,
  `document` char(4) NOT NULL,
  `name_en` varchar(255) NOT NULL,
  `nuts1` char(3) NOT NULL,
  `nuts2` char(4) NOT NULL,
  `nuts3` char(5) NOT NULL,
  `text` VARCHAR(100) NOT NULL,
  `oblast_name` VARCHAR(255) NOT NULL,
  `obshtina_name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT COLLATE=utf8_general_ci;