-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.27-0ubuntu1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for tbpos
DROP DATABASE IF EXISTS `tbpos`;
CREATE DATABASE IF NOT EXISTS `tbpos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tbpos`;


-- Dumping structure for table tbpos.customers
DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.customers: ~0 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
REPLACE INTO `customers` (`id`, `name`, `email`, `phone_number`, `avatar`, `address`, `city`, `state`, `zip`, `comment`, `company_name`, `account`, `created_at`, `updated_at`) VALUES
	(1, 'UMUM', 'umum@umum.com', '', 'no-foto.png', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;


-- Dumping structure for table tbpos.inventories
DROP TABLE IF EXISTS `inventories`;
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `in_out_qty` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `inventories_item_id_foreign` (`item_id`),
  KEY `inventories_user_id_foreign` (`user_id`),
  CONSTRAINT `inventories_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.inventories: ~34 rows (approximately)
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
REPLACE INTO `inventories` (`id`, `item_id`, `user_id`, `in_out_qty`, `remarks`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 12, 'Manual Edit of Quantity', '2016-01-23 21:44:16', '2016-01-23 21:44:16'),
	(2, 1, 2, 0, 'Manual Edit of Quantity', '2016-01-23 21:45:58', '2016-01-23 21:45:58'),
	(3, 2, 2, 15, 'Manual Edit of Quantity', '2016-01-23 21:51:40', '2016-01-23 21:51:40'),
	(4, 3, 2, 20, 'Manual Edit of Quantity', '2016-01-23 21:59:19', '2016-01-23 21:59:19'),
	(5, 4, 2, 10, 'Manual Edit of Quantity', '2016-01-23 22:06:54', '2016-01-23 22:06:54'),
	(6, 5, 2, 10, 'Manual Edit of Quantity', '2016-01-23 22:08:11', '2016-01-23 22:08:11'),
	(7, 6, 2, 6, 'Manual Edit of Quantity', '2016-01-23 22:10:17', '2016-01-23 22:10:17'),
	(8, 1, 2, -1, 'SL00001', '2016-01-23 15:50:45', '2016-01-23 15:50:45'),
	(9, 2, 2, -1, 'SL00001', '2016-01-23 15:50:45', '2016-01-23 15:50:45'),
	(10, 3, 2, -1, 'SL00001', '2016-01-23 15:50:45', '2016-01-23 15:50:45'),
	(11, 1, 2, -1, 'SALE2', '2016-01-23 22:59:44', '2016-01-23 22:59:44'),
	(12, 5, 2, -1, 'SALE3', '2016-01-24 14:33:35', '2016-01-24 14:33:35'),
	(13, 6, 2, -4, 'SALE3', '2016-01-24 14:33:35', '2016-01-24 14:33:35'),
	(14, 4, 2, -1, 'SALE3', '2016-01-24 14:33:35', '2016-01-24 14:33:35'),
	(15, 4, 2, -3, 'SL00004', '2016-01-24 20:05:26', '2016-01-24 20:05:26'),
	(16, 1, 2, -5, 'SL00005', '2016-01-24 20:11:13', '2016-01-24 20:11:13'),
	(17, 6, 2, -10, 'SL00005', '2016-01-24 20:11:13', '2016-01-24 20:11:13'),
	(18, 1, 2, -5, 'SL00007', '2016-01-24 22:17:47', '2016-01-24 22:17:47'),
	(19, 6, 2, -5, 'SL00007', '2016-01-24 22:17:47', '2016-01-24 22:17:47'),
	(20, 2, 2, -1, 'SL00008', '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(21, 3, 2, -1, 'SL00008', '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(22, 4, 2, -1, 'SL00008', '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(23, 5, 2, -1, 'SL00008', '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(24, 6, 2, -1, 'SL00008', '2016-01-24 22:24:41', '2016-01-24 22:24:41'),
	(25, 1, 2, -1, 'SL00008', '2016-01-24 22:24:41', '2016-01-24 22:24:41'),
	(26, 1, 2, -1, 'SL000010', '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(27, 2, 2, -1, 'SL000010', '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(28, 3, 2, -1, 'SL000010', '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(29, 4, 2, -1, 'SL000010', '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(30, 5, 2, -1, 'SL000010', '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(31, 4, 3, -16, 'SL000011', '2016-01-24 22:45:57', '2016-01-24 22:45:57'),
	(32, 3, 3, -11, 'SL000011', '2016-01-24 22:45:57', '2016-01-24 22:45:57'),
	(33, 2, 3, -1, 'SL000011', '2016-01-24 22:45:58', '2016-01-24 22:45:58'),
	(34, 5, 3, -1, 'SL000011', '2016-01-24 22:45:58', '2016-01-24 22:45:58'),
	(35, 6, 3, -1, 'SL000011', '2016-01-24 22:45:58', '2016-01-24 22:45:58'),
	(36, 2, 2, -1, 'SL000012', '2016-01-26 15:17:05', '2016-01-26 15:17:05'),
	(37, 3, 2, -1, 'SL000012', '2016-01-26 15:17:05', '2016-01-26 15:17:05'),
	(38, 1, 2, -1, 'SL000012', '2016-01-26 15:17:05', '2016-01-26 15:17:05');
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;


-- Dumping structure for table tbpos.items
DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `upc_ean_isbn` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `item_name` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `cost_price` decimal(9,2) NOT NULL,
  `grocery_price` decimal(9,2) NOT NULL,
  `selling_price` decimal(9,2) NOT NULL,
  `selling_price2` decimal(9,2) NOT NULL,
  `selling_price3` decimal(9,2) NOT NULL,
  `disc_currency` decimal(9,2) NOT NULL,
  `disc_persen` decimal(4,2) NOT NULL,
  `qty_min` int(11) NOT NULL,
  `qty_min_2` int(11) NOT NULL,
  `qty_min_3` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `deleted` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fk_cat` int(10) unsigned NOT NULL,
  `fk_location` int(10) unsigned NOT NULL,
  `satuan` int(10) unsigned NOT NULL,
  `barcode` int(12) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `barcode` (`barcode`),
  KEY `fk_cat` (`fk_cat`),
  KEY `FK_items_locations` (`fk_location`),
  KEY `FK_items_satuan` (`satuan`),
  CONSTRAINT `FK_items_item_group` FOREIGN KEY (`fk_cat`) REFERENCES `item_group` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_items_locations` FOREIGN KEY (`fk_location`) REFERENCES `locations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_items_satuan` FOREIGN KEY (`satuan`) REFERENCES `satuan` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.items: ~5 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
REPLACE INTO `items` (`id`, `upc_ean_isbn`, `item_name`, `size`, `description`, `avatar`, `cost_price`, `grocery_price`, `selling_price`, `selling_price2`, `selling_price3`, `disc_currency`, `disc_persen`, `qty_min`, `qty_min_2`, `qty_min_3`, `quantity`, `type`, `deleted`, `created_at`, `updated_at`, `fk_cat`, `fk_location`, `satuan`, `barcode`) VALUES
	(1, '0001', 'Semen Tiga Roda', '', 'Semen Tiga Roda Super', 'item1.png', 75000.00, 0.00, 85000.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, -3, 1, 'N', '2016-01-23 21:44:16', '2016-01-26 15:17:05', 1, 1, 6, 1453568700),
	(2, '002', 'Semen Bima', '', 'Semen Bima Pasuruan', 'item1.png', 70000.00, 0.00, 78000.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 10, 1, 'N', '2016-01-23 21:51:40', '2016-01-26 15:17:05', 1, 1, 6, 1453560700),
	(3, '0003', 'Semen Padang Super', '', 'Semen Padang Super', 'item1.png', 80000.00, 0.00, 95000.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 5, 1, 'N', '2016-01-23 21:59:19', '2016-01-26 15:17:05', 1, 1, 6, 1453561159),
	(4, 'PKPY001', 'Paku Payung Putih', '5cm', 'Paku payung ukuran 5cm', 'item4.jpg', 12000.00, 0.00, 15000.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, -12, 1, 'N', '2016-01-23 22:06:54', '2016-01-24 22:45:57', 2, 1, 1, 1453561614),
	(5, 'PKBTN001', 'Paku Beton 5cm', '5cm', 'Paku beton ukuran 5 cm', 'item5.jpg', 35000.00, 0.00, 40000.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, 6, 1, 'N', '2016-01-23 22:08:11', '2016-01-24 22:45:58', 2, 1, 1, 1453561691),
	(6, 'PRL001', 'Pipa Pralon 1/2"', '1/2"', 'Pipa pralon setengah inchi', 'no-foto.png', 20000.00, 0.00, 22000.00, 0.00, 0.00, 0.00, 0.00, 0, 0, 0, -15, 1, 'N', '2016-01-23 22:10:17', '2016-01-24 22:45:58', 3, 1, 7, 1453561817);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;


-- Dumping structure for table tbpos.item_group
DROP TABLE IF EXISTS `item_group`;
CREATE TABLE IF NOT EXISTS `item_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` enum('B','J') NOT NULL,
  `desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Group Barang';

-- Dumping data for table tbpos.item_group: ~2 rows (approximately)
/*!40000 ALTER TABLE `item_group` DISABLE KEYS */;
REPLACE INTO `item_group` (`id`, `code`, `name`, `type`, `desc`, `created_at`, `updated_at`) VALUES
	(1, 'SM001', 'SEMEN', 'B', 'Group barang untuk aneka semen', '2016-01-23 21:28:18', '2016-01-23 21:28:18'),
	(2, 'PK001', 'PAKU', 'B', 'Group barang untuk aneka paku', '2016-01-23 22:01:28', '2016-01-23 22:01:28'),
	(3, 'PRL001', 'Pipa Pralon', 'B', 'Group barang untuk aneka pipa pralon', '2016-01-23 22:02:12', '2016-01-23 22:02:12');
/*!40000 ALTER TABLE `item_group` ENABLE KEYS */;


-- Dumping structure for table tbpos.item_kit_items
DROP TABLE IF EXISTS `item_kit_items`;
CREATE TABLE IF NOT EXISTS `item_kit_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost_price` decimal(15,2) NOT NULL,
  `total_selling_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `item_kit_items_item_kit_id_foreign` (`item_kit_id`),
  KEY `item_kit_items_item_id_foreign` (`item_id`),
  CONSTRAINT `item_kit_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `item_kit_items_item_kit_id_foreign` FOREIGN KEY (`item_kit_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.item_kit_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `item_kit_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_kit_items` ENABLE KEYS */;


-- Dumping structure for table tbpos.item_kit_item_temps
DROP TABLE IF EXISTS `item_kit_item_temps`;
CREATE TABLE IF NOT EXISTS `item_kit_item_temps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost_price` decimal(15,2) NOT NULL,
  `total_selling_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `item_kit_item_temps_item_id_foreign` (`item_id`),
  CONSTRAINT `item_kit_item_temps_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.item_kit_item_temps: ~0 rows (approximately)
/*!40000 ALTER TABLE `item_kit_item_temps` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_kit_item_temps` ENABLE KEYS */;


-- Dumping structure for table tbpos.locations
DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `desc` text NOT NULL,
  `phone` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='untuk menampung data gudang';

-- Dumping data for table tbpos.locations: ~0 rows (approximately)
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
REPLACE INTO `locations` (`id`, `code`, `name`, `desc`, `phone`, `fax`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'GT001', 'Gudang Toko', 'Gudang untuk barang - barang material', '', '', '', '2016-01-23 21:27:10', '2016-01-23 21:27:10');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;


-- Dumping structure for table tbpos.location_move_items
DROP TABLE IF EXISTS `location_move_items`;
CREATE TABLE IF NOT EXISTS `location_move_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `loc_id` int(10) unsigned NOT NULL,
  `qty_in_out` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_location_move_items_items` (`item_id`),
  KEY `FK_location_move_items_location_move_tr` (`loc_id`),
  CONSTRAINT `FK_location_move_items_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_location_move_items_location_move_tr` FOREIGN KEY (`loc_id`) REFERENCES `location_move_tr` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Item mutasi gudangnya';

-- Dumping data for table tbpos.location_move_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `location_move_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `location_move_items` ENABLE KEYS */;


-- Dumping structure for table tbpos.location_move_tr
DROP TABLE IF EXISTS `location_move_tr`;
CREATE TABLE IF NOT EXISTS `location_move_tr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no` varchar(15) NOT NULL,
  `loc_from` int(10) unsigned NOT NULL,
  `loc_to` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `remarks` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `FK_location_move_tr_users` (`user_id`),
  KEY `FK__locations_from` (`loc_from`),
  KEY `FK__locations_to` (`loc_to`),
  CONSTRAINT `FK__locations_from` FOREIGN KEY (`loc_from`) REFERENCES `locations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK__locations_to` FOREIGN KEY (`loc_to`) REFERENCES `locations` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_location_move_tr_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Mutasi antar gudang';

-- Dumping data for table tbpos.location_move_tr: ~0 rows (approximately)
/*!40000 ALTER TABLE `location_move_tr` DISABLE KEYS */;
/*!40000 ALTER TABLE `location_move_tr` ENABLE KEYS */;


-- Dumping structure for table tbpos.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- Dumping structure for table tbpos.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


-- Dumping structure for table tbpos.receivings
DROP TABLE IF EXISTS `receivings`;
CREATE TABLE IF NOT EXISTS `receivings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `payment_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `receivings_supplier_id_foreign` (`supplier_id`),
  KEY `receivings_user_id_foreign` (`user_id`),
  CONSTRAINT `receivings_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  CONSTRAINT `receivings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.receivings: ~0 rows (approximately)
/*!40000 ALTER TABLE `receivings` DISABLE KEYS */;
/*!40000 ALTER TABLE `receivings` ENABLE KEYS */;


-- Dumping structure for table tbpos.receiving_items
DROP TABLE IF EXISTS `receiving_items`;
CREATE TABLE IF NOT EXISTS `receiving_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receiving_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `receiving_items_receiving_id_foreign` (`receiving_id`),
  KEY `receiving_items_item_id_foreign` (`item_id`),
  CONSTRAINT `receiving_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `receiving_items_receiving_id_foreign` FOREIGN KEY (`receiving_id`) REFERENCES `receivings` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.receiving_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `receiving_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving_items` ENABLE KEYS */;


-- Dumping structure for table tbpos.receiving_temps
DROP TABLE IF EXISTS `receiving_temps`;
CREATE TABLE IF NOT EXISTS `receiving_temps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `receiving_temps_item_id_foreign` (`item_id`),
  CONSTRAINT `receiving_temps_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.receiving_temps: ~0 rows (approximately)
/*!40000 ALTER TABLE `receiving_temps` DISABLE KEYS */;
REPLACE INTO `receiving_temps` (`id`, `item_id`, `cost_price`, `quantity`, `total_cost`, `created_at`, `updated_at`) VALUES
	(1, 1, 75000.00, 1, 75000.00, '2016-01-23 15:50:10', '2016-01-23 15:50:10');
/*!40000 ALTER TABLE `receiving_temps` ENABLE KEYS */;


-- Dumping structure for table tbpos.sales
DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `payment_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_user_id_foreign` (`user_id`),
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.sales: ~9 rows (approximately)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
REPLACE INTO `sales` (`id`, `customer_name`, `customer_id`, `user_id`, `payment_type`, `comments`, `created_at`, `updated_at`) VALUES
	(1, 'Budi', 1, 2, 'Cash', '', '2016-01-23 15:50:45', '2016-01-23 15:50:45'),
	(2, 'Harun', 1, 2, 'Cash', '', '2016-01-23 22:59:44', '2016-01-23 22:59:44'),
	(3, 'Heru Cs', 1, 2, 'Cash', '', '2016-01-24 14:33:35', '2016-01-24 14:33:35'),
	(4, 'Hari', 1, 2, 'Cash', '', '2016-01-24 20:05:25', '2016-01-24 20:05:25'),
	(5, 'Joni Dolop', 1, 2, 'Cash', '', '2016-01-24 20:11:12', '2016-01-24 20:11:12'),
	(7, 'Wahyu', 1, 2, 'Cash', '', '2016-01-24 22:17:47', '2016-01-24 22:17:47'),
	(8, 'Hamid', 1, 2, 'Cash', '', '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(10, 'Koko', 1, 2, 'Cash', '', '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(11, 'Hani RG', 1, 3, 'Cash', '', '2016-01-24 22:45:57', '2016-01-24 22:45:57'),
	(12, 'Amir Fauzi', 1, 2, 'Cash', '', '2016-01-26 15:17:04', '2016-01-26 15:17:04');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;


-- Dumping structure for table tbpos.sale_items
DROP TABLE IF EXISTS `sale_items`;
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `total_selling` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sale_items_sale_id_foreign` (`sale_id`),
  KEY `sale_items_item_id_foreign` (`item_id`),
  CONSTRAINT `sale_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.sale_items: ~26 rows (approximately)
/*!40000 ALTER TABLE `sale_items` DISABLE KEYS */;
REPLACE INTO `sale_items` (`id`, `sale_id`, `item_id`, `cost_price`, `selling_price`, `quantity`, `total_cost`, `total_selling`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 75000.00, 85000.00, 1, 75000.00, 85000.00, '2016-01-23 15:50:45', '2016-01-23 15:50:45'),
	(2, 1, 2, 70000.00, 78000.00, 1, 70000.00, 78000.00, '2016-01-23 15:50:45', '2016-01-23 15:50:45'),
	(3, 1, 3, 80000.00, 95000.00, 1, 80000.00, 95000.00, '2016-01-23 15:50:45', '2016-01-23 15:50:45'),
	(4, 2, 1, 75000.00, 85000.00, 1, 75000.00, 85000.00, '2016-01-23 22:59:44', '2016-01-23 22:59:44'),
	(5, 3, 5, 35000.00, 40000.00, 1, 35000.00, 40000.00, '2016-01-24 14:33:35', '2016-01-24 14:33:35'),
	(6, 3, 6, 20000.00, 22000.00, 4, 80000.00, 88000.00, '2016-01-24 14:33:35', '2016-01-24 14:33:35'),
	(7, 3, 4, 12000.00, 15000.00, 1, 12000.00, 15000.00, '2016-01-24 14:33:35', '2016-01-24 14:33:35'),
	(8, 4, 4, 12000.00, 15000.00, 3, 36000.00, 45000.00, '2016-01-24 20:05:25', '2016-01-24 20:05:25'),
	(9, 5, 1, 75000.00, 85000.00, 5, 375000.00, 425000.00, '2016-01-24 20:11:12', '2016-01-24 20:11:12'),
	(10, 5, 6, 20000.00, 22000.00, 10, 200000.00, 220000.00, '2016-01-24 20:11:13', '2016-01-24 20:11:13'),
	(11, 7, 1, 75000.00, 85000.00, 5, 375000.00, 425000.00, '2016-01-24 22:17:47', '2016-01-24 22:17:47'),
	(12, 7, 6, 20000.00, 22000.00, 5, 100000.00, 110000.00, '2016-01-24 22:17:47', '2016-01-24 22:17:47'),
	(13, 8, 2, 70000.00, 78000.00, 1, 70000.00, 78000.00, '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(14, 8, 3, 80000.00, 95000.00, 1, 80000.00, 95000.00, '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(15, 8, 4, 12000.00, 15000.00, 1, 12000.00, 15000.00, '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(16, 8, 5, 35000.00, 40000.00, 1, 35000.00, 40000.00, '2016-01-24 22:24:40', '2016-01-24 22:24:40'),
	(17, 8, 6, 20000.00, 22000.00, 1, 20000.00, 22000.00, '2016-01-24 22:24:41', '2016-01-24 22:24:41'),
	(18, 8, 1, 75000.00, 85000.00, 1, 75000.00, 85000.00, '2016-01-24 22:24:41', '2016-01-24 22:24:41'),
	(19, 10, 1, 75000.00, 85000.00, 1, 75000.00, 85000.00, '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(20, 10, 2, 70000.00, 78000.00, 1, 70000.00, 78000.00, '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(21, 10, 3, 80000.00, 95000.00, 1, 80000.00, 95000.00, '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(22, 10, 4, 12000.00, 15000.00, 1, 12000.00, 15000.00, '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(23, 10, 5, 35000.00, 40000.00, 1, 35000.00, 40000.00, '2016-01-24 22:26:38', '2016-01-24 22:26:38'),
	(24, 11, 4, 12000.00, 15000.00, 16, 192000.00, 240000.00, '2016-01-24 22:45:57', '2016-01-24 22:45:57'),
	(25, 11, 3, 80000.00, 95000.00, 11, 880000.00, 1045000.00, '2016-01-24 22:45:57', '2016-01-24 22:45:57'),
	(26, 11, 2, 70000.00, 78000.00, 1, 70000.00, 78000.00, '2016-01-24 22:45:58', '2016-01-24 22:45:58'),
	(27, 11, 5, 35000.00, 40000.00, 1, 35000.00, 40000.00, '2016-01-24 22:45:58', '2016-01-24 22:45:58'),
	(28, 11, 6, 20000.00, 22000.00, 1, 20000.00, 22000.00, '2016-01-24 22:45:58', '2016-01-24 22:45:58'),
	(29, 12, 2, 70000.00, 78000.00, 1, 70000.00, 78000.00, '2016-01-26 15:17:04', '2016-01-26 15:17:04'),
	(30, 12, 3, 80000.00, 95000.00, 1, 80000.00, 95000.00, '2016-01-26 15:17:05', '2016-01-26 15:17:05'),
	(31, 12, 1, 75000.00, 85000.00, 1, 75000.00, 85000.00, '2016-01-26 15:17:05', '2016-01-26 15:17:05');
/*!40000 ALTER TABLE `sale_items` ENABLE KEYS */;


-- Dumping structure for table tbpos.sale_temps
DROP TABLE IF EXISTS `sale_temps`;
CREATE TABLE IF NOT EXISTS `sale_temps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `selling_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `total_selling` decimal(9,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sale_temps_item_id_foreign` (`item_id`),
  CONSTRAINT `sale_temps_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.sale_temps: ~0 rows (approximately)
/*!40000 ALTER TABLE `sale_temps` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_temps` ENABLE KEYS */;


-- Dumping structure for table tbpos.satuan
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE IF NOT EXISTS `satuan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='untuk menampung data gudang';

-- Dumping data for table tbpos.satuan: ~6 rows (approximately)
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
REPLACE INTO `satuan` (`id`, `name`, `desc`, `created_at`, `updated_at`) VALUES
	(1, 'KGS', 'Kilogram', '2016-01-23 21:33:21', '0000-00-00 00:00:00'),
	(2, 'PCS', 'Pieces', '2016-01-23 21:33:33', '0000-00-00 00:00:00'),
	(3, 'UNIT', 'Unit Satuan', '2016-01-23 21:35:13', '0000-00-00 00:00:00'),
	(4, 'ONS', 'Satuan Ons', '2016-01-23 21:35:48', '0000-00-00 00:00:00'),
	(5, 'LUSIN', 'Satuan Lusin', '2016-01-23 21:36:03', '0000-00-00 00:00:00'),
	(6, 'SAK', 'Satuan Sak', '2016-01-23 21:37:28', '0000-00-00 00:00:00'),
	(7, 'INCH', 'Satuan Inchi', '2016-01-23 22:09:39', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;


-- Dumping structure for table tbpos.sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.sessions: ~0 rows (approximately)
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


-- Dumping structure for table tbpos.suppliers
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.suppliers: ~0 rows (approximately)
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
REPLACE INTO `suppliers` (`id`, `company_name`, `name`, `email`, `phone_number`, `avatar`, `address`, `city`, `state`, `zip`, `comments`, `account`, `created_at`, `updated_at`) VALUES
	(1, 'CV. UMUM', 'UMUM', 'umum@umum.com', '', 'no-foto.png', '', '', '', '', '', '0001', '2016-01-24 17:28:27', '2016-01-24 17:28:27');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;


-- Dumping structure for table tbpos.tutapos_settings
DROP TABLE IF EXISTS `tutapos_settings`;
CREATE TABLE IF NOT EXISTS `tutapos_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `languange` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.tutapos_settings: ~2 rows (approximately)
/*!40000 ALTER TABLE `tutapos_settings` DISABLE KEYS */;
REPLACE INTO `tutapos_settings` (`id`, `languange`, `created_at`, `updated_at`) VALUES
	(1, 'id', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(2, 'en', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tutapos_settings` ENABLE KEYS */;


-- Dumping structure for table tbpos.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table tbpos.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(2, 'admin', 'admin@skipper.org', '$2y$10$WEYUjE0P5Jn6.14yQ8Cfzex7q9qyhJggYgde6.JocbhtD97T/GlpS', '67Y7D8PBZxKq42FXAHhQHSH3KnoumC3h42sEtwd716hFAnpvvXqcRG66R9Uj', '2016-01-23 21:26:28', '2016-01-25 13:19:38'),
	(3, 'kasir1', 'kasir@umum.com', '$2y$10$EDr6SzRXZnLXHfbE57s1vuhzL4S88qrT3iA7mI3OViTb2rgTdQQge', 'n2aSzLBJ4QRfVpHU8t19Jah8Vsn7hOMqHmOmI2vpBZbaJiyEziIvpAr4VePG', '2016-01-24 22:43:55', '2016-01-24 22:56:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
