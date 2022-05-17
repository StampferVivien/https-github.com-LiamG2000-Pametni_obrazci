
CREATE TABLE `uporabnik` (
  `id` int(11) NOT NULL,
  `uporabnisko_ime` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `geslo` varchar(100) NOT NULL,
  `slika` blob NOT NULL,
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

