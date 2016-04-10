-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               5.6.22-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных dresscode
CREATE DATABASE IF NOT EXISTS `dresscode` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `dresscode`;


-- Дамп структуры для таблица dresscode.dr_category
CREATE TABLE IF NOT EXISTS `dr_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы dresscode.dr_category: ~4 rows (приблизительно)
/*!40000 ALTER TABLE `dr_category` DISABLE KEYS */;
REPLACE INTO `dr_category` (`id`, `name`, `sort_order`, `status`) VALUES
	(10, 'Ноутбуки', 1, 1),
	(11, 'Планшеты', 2, 1),
	(12, 'Мониторы', 3, 1),
	(13, 'Игровые компьютеры', 4, 1);
/*!40000 ALTER TABLE `dr_category` ENABLE KEYS */;


-- Дамп структуры для таблица dresscode.dr_product
CREATE TABLE IF NOT EXISTS `dr_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы dresscode.dr_product: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `dr_product` DISABLE KEYS */;
REPLACE INTO `dr_product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `description`, `is_new`, `is_recommended`, `status`) VALUES
	(104, 'Ноутбук Lenovo Z50-70', 10, 1635822, 17999, 1, 'Lenovo', 'Экран 15.6" (1920x1080) Full HD LED, глянцевое / Intel Core i5-4210U (1.7 - 2.7 ГГц) / RAM 6 ГБ / HDD 1 ТБ / nVidia GeForce 840M, 2 ГБ / DVD Super Multi / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / без ОС / 2.4 кг / черный\r\nПодробнее: http://rozetka.com.ua/lenovo_z5070_59-430340/p1635822/', 1, 1, 1),
	(105, 'Ноутбук Dell Inspiron 3542 Black', 10, 6936853, 7853, 1, 'Dell', 'Экран 15.6" (1366x768) HD WLED TrueLife, глянцевый / Intel Celeron 2957U (1.4 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics 4000 / DVD+/-RW / LAN / Wi-Fi / Bluetooth 4.0 / веб-камера / Linux / 2.4 кг / черный', 0, 1, 1),
	(106, 'Ноутбук HP Notebook 15-ac097ur  Red', 10, 7070574, 8399, 1, 'Hewlett Packard', 'Экран 15.6” (1366x768) HD LED, глянцевый / Intel Pentium N3700 (1.6 - 2.4 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 2.19 кг / красный', 0, 1, 1),
	(107, 'Ноутбук Asus X540LA Chocolate Black', 10, 7373063, 10499, 1, 'Asus', 'Экран 15.6" (1366x768) HD LED, глянцевый / Intel Core i3-4005U (1.7 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics 5500 / DVD+/-RW / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 1.9 кг / темно-коричневый', 0, 1, 1),
	(108, 'Ноутбук Asus EeeBook E502MA', 10, 5879343, 8990, 1, 'Asus', 'Экран 15.6" (1366x768) HD, глянцевый / Intel Pentium N3540 (2.16 - 2.66 ГГц) / RAM 4 ГБ / HDD 1 ТБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / DOS / 1.86 кг / белый', 1, 1, 1),
	(110, 'Ноутбук Apple MacBook Pro Retina 13', 10, 2686197, 92222, 1, 'Apple', 'Экран 13.3" IPS (2560x1600) Retina LED, глянцевый / Intel Core i7 (3.1 ГГц) / RAM 16 ГБ / SSD 1 TБ / Intel Iris Graphics 6100 / без ОД / Wi-Fi / Bluetooth / веб-камера / OS X Yosemite / 1.58 кг', 0, 1, 1),
	(111, 'Ноутбук Asus N552VW', 10, 6927643, 38887, 1, 'Asus', 'Экран 15.6" IPS (1920x1080) Full HD, матовый / Intel Core i7-6700HQ (2.6-3.5 ГГц) / RAM 16 ГБ / SSD 128 ГБ + HDD 1 ТБ / nVidia GeForce GTX 950M, 4 ГБ / DVD Blu-Ray Combo / LAN / Wi-Fi / Bluetooth / веб-камера / Windows 10 / 2.53 кг / мышь + сумка', 1, 1, 1),
	(112, 'Ноутбук Dell Inspiron 5558', 10, 6931443, 13199, 1, 'Dell', 'Экран 15.6" (1366x768) HD LED, глянцевый / Intel Core i3-5005U (2.0 ГГц) / RAM 4 ГБ / HDD 500 ГБ / nVidia GeForce 920M, 2 ГБ / DVD±RW / LAN / Wi-Fi / Bluetooth / веб-камера / Linux / 2 кг / синий', 0, 1, 1),
	(113, 'Ноутбук Lenovo Yoga 500-15', 10, 8021450, 22999, 1, 'Lenovo', 'Экран 15.6" IPS (1920x1080) Full HD, матовый, Multitouch / Intel Core i3-5005U (2.0 ГГц) / RAM 4 ГБ / SSHD 1 ТБ + 8 ГБ / nVidia GeForce GT 940M, 2 ГБ / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера HD / Windows 10 Home / 2.1 кг / белый', 1, 1, 1);
/*!40000 ALTER TABLE `dr_product` ENABLE KEYS */;


-- Дамп структуры для таблица dresscode.dr_product_order
CREATE TABLE IF NOT EXISTS `dr_product_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы dresscode.dr_product_order: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `dr_product_order` DISABLE KEYS */;
REPLACE INTO `dr_product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
	(8, 'Nikita Portyankin', '34773666343', '', 32, '2016-04-02 05:47:24', '{"113":10,"111":1,"108":1,"110":1,"112":1}', 1);
/*!40000 ALTER TABLE `dr_product_order` ENABLE KEYS */;


-- Дамп структуры для таблица dresscode.dr_user
CREATE TABLE IF NOT EXISTS `dr_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` char(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы dresscode.dr_user: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `dr_user` DISABLE KEYS */;
REPLACE INTO `dr_user` (`id`, `name`, `email`, `password`, `role`) VALUES
	(32, 'Nikita Portyankin', 'nikita.portyankin@gmail.com', 'aefcdab1008c9a576799273e2001cbb944f785f6', 'admin'),
	(33, 'Григорий Измайлов', 'grigor@mail.ru', 'fa6977c99b809db68e1c56888ec38bd004719b39', '');
/*!40000 ALTER TABLE `dr_user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
