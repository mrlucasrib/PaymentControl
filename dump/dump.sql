CREATE TABLE `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text DEFAULT NULL,
  `value` float DEFAULT NULL,
  `date` date DEFAULT NULL,
  `external_tax` float DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
