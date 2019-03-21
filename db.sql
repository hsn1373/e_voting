  CREATE TABLE IF NOT EXISTS `election` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `list_of_choices` TEXT NOT NULL,
  `number_of_votes` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET utf8 COLLATE utf8_persian_ci AUTO_INCREMENT=1;

INSERT INTO `election` (`title`, `start_time`, `end_time`, `list_of_choices`,`number_of_votes`) VALUES
('election1', '2011-01-01 00:00:00', '2011-01-02 00:00:00', 'ali-hassan-hossein','100'),
('election2', '2012-01-01 00:00:00', '2012-01-02 00:00:00', 'javad-reza-mahmood-abas','200'),
('election3', '2013-01-01 00:00:00', '2013-01-02 00:00:00', 'maryam-mahbob-marzieh','300');
