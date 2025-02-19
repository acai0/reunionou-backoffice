DROP TABLE IF EXISTS `user` ;
CREATE TABLE `user` (`id` BIGINT AUTO_INCREMENT NOT NULL,
`mail` VARCHAR(256) NOT NULL,
`fullname` VARCHAR(512) NOT NULL,
`username` VARCHAR(256) NOT NULL,
`password` CHAR(60) NOT NULL,
PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `event` ;
CREATE TABLE `event` (`id` BIGINT AUTO_INCREMENT NOT NULL,
`title` VARCHAR(512) NOT NULL,
`description` VARCHAR(512) NOT NULL,
`date` DATETIME NOT NULL,
`place` VARCHAR(512) NOT NULL,
`id_user` BIGINT NOT NULL,
PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `comment` ;
CREATE TABLE `comment` (`id` BIGINT AUTO_INCREMENT NOT NULL,
`id_event` BIGINT NOT NULL,
`id_user` BIGINT NOT NULL,
`content` VARCHAR(512) NOT NULL,
PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* insert into user values (1, 'a@a.com', alice, acai, root);
insert into event values (1, 'test', 'test', 2022-03-23, 'nancy', 1);
insert into comment values (1, 1,1,'test');