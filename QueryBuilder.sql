-- Donut_Network
--   id
--   name
--   email
--   phone
--   relationship parent,sibling,acquaintance,friend,relative,other
--   donor_status lead,pitched,disagreed,donated
--   pledged_amount
--   pledge_type nach,cash/cheque,online,other
--   collection_by self,handover_to_mad
--   address MEDIUMTEXT
--   added_by_user_id
--   follow_up_on
--   collect_on
--   added_on
--
--
-- Donut_NetworkData
--   id
--   donut_network_id
--   name
--   value
--   data
--   added_on


CREATE TABLE IF NOT EXISTS `Donut_Network` (
	`id` INT (11)  unsigned NOT NULL auto_increment,
	`name` VARCHAR (100)   NOT NULL,
	`email` VARCHAR (100)  NULL,
	`phone` VARCHAR (100)   NOT NULL,
	`relationship` ENUM ('parent','sibling','acquaintance','friend','relative','other') DEFAULT NULL  NULL,
	`donor_status` ENUM ('lead','pledged','disagreed','donated') DEFAULT 'lead'  NOT NULL,
	`pledged_amount` VARCHAR (100)    NULL,
	`pledge_type` ENUM ('nach','cash/cheque','online','other') DEFAULT NULL  NULL,
	`collection_by` ENUM ('self','handover_to_mad') DEFAULT 'self'   NULL,
	`address` MEDIUMTEXT   NULL,
	`added_by_user_id` INT (11)  unsigned NOT NULL,
	`follow_up_on` DATETIME   NULL,
	`collect_on` DATETIME    NULL,
	`added_on` DATETIME    NOT NULL,
	PRIMARY KEY (`id`),
	KEY (`added_by_user_id`)
) DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `Donut_NetworkData` (
	`id` INT (11)  unsigned NOT NULL auto_increment,
	`donut_network_id` INT (11)  unsigned NOT NULL,
	`name` VARCHAR (100)   NOT NULL,
	`value` VARCHAR (100)   NOT NULL,
	`data` MEDIUMTEXT    NULL,
	`added_on` DATETIME    NOT NULL,
	PRIMARY KEY (`id`),
	KEY (`donut_network_id`)
) DEFAULT CHARSET=utf8 ;
