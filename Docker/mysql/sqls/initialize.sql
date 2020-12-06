CREATE DATABASE pokemon;
use pokemon;

-- このファイルにテーブルとデータの初期化を書く。下記は例

CREATE TABLE `pokemons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) ,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO attributes (attribute_name, created, modified)
VALUES
  ('fire', now(), now()),
  ('water', now(), now()),
  ('rock', now(), now());

INSERT INTO pokemons (attribute_id, name, created, modified)
VALUES
  ( 1, 'ヒトカゲ', now(), now()),
  ( 2, 'ゼニガメ', now(), now()),
  ( 3, 'イシツブテ', now(), now());
