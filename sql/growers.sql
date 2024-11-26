-- --------------------------------------------------------
-- Host:                         mysql.ppgrowers.com
-- Server version:               8.0.28-0ubuntu0.20.04.3 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table 2024_0829.audit_logs
DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `host` varchar(46) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.audit_logs: ~11 rows (approximately)
REPLACE INTO `audit_logs` (`id`, `description`, `subject_id`, `subject_type`, `user_id`, `properties`, `host`, `created_at`, `updated_at`) VALUES
	(1, 'audit:created', 1, 'App\\Models\\Product#1', 1, '{"name":"test product","description":"test product description","updated_at":"2024-10-13 23:57:23","created_at":"2024-10-13 23:57:23","id":1,"photo":null,"media":[]}', '136.36.127.94', '2024-10-14 06:57:23', '2024-10-14 06:57:23'),
	(2, 'audit:created', 1, 'App\\Models\\Client#1', 1, '{"name":"Harmons","updated_at":"2024-10-14 00:50:12","created_at":"2024-10-14 00:50:12","id":1}', '136.36.127.94', '2024-10-14 07:50:12', '2024-10-14 07:50:12'),
	(3, 'audit:created', 2, 'App\\Models\\Product#2', 1, '{"name":"test","description":"test","updated_at":"2024-10-22 18:48:10","created_at":"2024-10-22 18:48:10","id":2,"photo":null,"media":[]}', '136.36.127.94', '2024-10-23 01:48:10', '2024-10-23 01:48:10'),
	(4, 'audit:created', 3, 'App\\Models\\Product#3', 1, '{"name":"test","description":"test","updated_at":"2024-10-22 19:46:47","created_at":"2024-10-22 19:46:47","id":3,"photo":null,"media":[]}', '136.36.127.94', '2024-10-23 02:46:47', '2024-10-23 02:46:47'),
	(5, 'audit:created', 4, 'App\\Models\\Product#4', 1, '{"name":"test","description":"test","updated_at":"2024-10-22 19:47:11","created_at":"2024-10-22 19:47:11","id":4,"photo":null,"media":[]}', '136.36.127.94', '2024-10-23 02:47:11', '2024-10-23 02:47:11'),
	(6, 'audit:deleted', 1, 'App\\Models\\Product#1', 1, '{"id":1,"name":"test product","description":"test product description","created_at":"2024-10-13 23:57:23","updated_at":"2024-11-13 01:12:20","deleted_at":"2024-11-13 01:12:20","clients_prices_id":null,"team_id":null,"photo":null,"additional_photos":[],"media":[]}', '136.36.127.94', '2024-11-13 09:12:20', '2024-11-13 09:12:20'),
	(7, 'audit:deleted', 2, 'App\\Models\\Product#2', 1, '{"id":2,"name":"test","description":"test","created_at":"2024-10-22 18:48:10","updated_at":"2024-11-13 01:12:20","deleted_at":"2024-11-13 01:12:20","clients_prices_id":null,"team_id":null,"photo":null,"additional_photos":[],"media":[]}', '136.36.127.94', '2024-11-13 09:12:20', '2024-11-13 09:12:20'),
	(8, 'audit:deleted', 3, 'App\\Models\\Product#3', 1, '{"id":3,"name":"test","description":"test","created_at":"2024-10-22 19:46:47","updated_at":"2024-11-13 01:12:20","deleted_at":"2024-11-13 01:12:20","clients_prices_id":null,"team_id":null,"photo":null,"additional_photos":[],"media":[]}', '136.36.127.94', '2024-11-13 09:12:20', '2024-11-13 09:12:20'),
	(9, 'audit:deleted', 4, 'App\\Models\\Product#4', 1, '{"id":4,"name":"test","description":"test","created_at":"2024-10-22 19:47:11","updated_at":"2024-11-13 01:12:20","deleted_at":"2024-11-13 01:12:20","clients_prices_id":null,"team_id":null,"photo":{"id":1,"model_type":"App\\\\Models\\\\Product","model_id":4,"uuid":"d4c82648-708e-46c2-a6f1-3ce33822082b","collection_name":"photo","name":"6718013b6a486_4518826_slack_icon","file_name":"6718013b6a486_4518826_slack_icon.png","mime_type":"image\\/png","disk":"public","conversions_disk":"public","size":21584,"manipulations":[],"custom_properties":[],"generated_conversions":{"thumb":true,"preview":true},"responsive_images":[],"order_column":1,"created_at":"2024-10-22T19:47:11.000000Z","updated_at":"2024-10-22T19:47:12.000000Z","url":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/6718013b6a486_4518826_slack_icon.png","thumbnail":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/conversions\\/6718013b6a486_4518826_slack_icon-thumb.jpg","preview":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/conversions\\/6718013b6a486_4518826_slack_icon-preview.jpg","original_url":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/6718013b6a486_4518826_slack_icon.png","preview_url":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/conversions\\/6718013b6a486_4518826_slack_icon-preview.jpg"},"additional_photos":[],"media":[{"id":1,"model_type":"App\\\\Models\\\\Product","model_id":4,"uuid":"d4c82648-708e-46c2-a6f1-3ce33822082b","collection_name":"photo","name":"6718013b6a486_4518826_slack_icon","file_name":"6718013b6a486_4518826_slack_icon.png","mime_type":"image\\/png","disk":"public","conversions_disk":"public","size":21584,"manipulations":[],"custom_properties":[],"generated_conversions":{"thumb":true,"preview":true},"responsive_images":[],"order_column":1,"created_at":"2024-10-22T19:47:11.000000Z","updated_at":"2024-10-22T19:47:12.000000Z","url":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/6718013b6a486_4518826_slack_icon.png","thumbnail":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/conversions\\/6718013b6a486_4518826_slack_icon-thumb.jpg","preview":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/conversions\\/6718013b6a486_4518826_slack_icon-preview.jpg","original_url":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/6718013b6a486_4518826_slack_icon.png","preview_url":"https:\\/\\/ppgrowers.com\\/storage\\/1\\/conversions\\/6718013b6a486_4518826_slack_icon-preview.jpg"}]}', '136.36.127.94', '2024-11-13 09:12:20', '2024-11-13 09:12:20'),
	(10, 'audit:created', 5, 'App\\Models\\Product#5', 1, '{"name":"test","description":"sdfasdfas","updated_at":"2024-11-13 01:13:00","created_at":"2024-11-13 01:13:00","id":5,"photo":null,"additional_photos":[],"media":[]}', '136.36.127.94', '2024-11-13 09:13:00', '2024-11-13 09:13:00'),
	(11, 'audit:created', 1, 'App\\Models\\ClientPrice#1', 1, '{"product_id":5,"client_id":"1","price":null,"updated_at":"2024-11-13 01:13:00","created_at":"2024-11-13 01:13:00","id":1,"barcode_image":null,"media":[]}', '136.36.127.94', '2024-11-13 09:13:00', '2024-11-13 09:13:00'),
	(12, 'audit:created', 2, 'App\\Models\\ClientPrice#2', 1, '{"product_id":5,"client_id":"1","price":null,"updated_at":"2024-11-13 01:51:51","created_at":"2024-11-13 01:51:51","id":2,"barcode_image":null,"media":[]}', '136.36.127.94', '2024-11-13 09:51:52', '2024-11-13 09:51:52');

-- Dumping structure for table 2024_0829.cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.cache: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.cache_locks: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `team_fk_9986797` (`team_id`),
  CONSTRAINT `team_fk_9986797` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.clients: ~0 rows (approximately)
REPLACE INTO `clients` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`, `team_id`) VALUES
	(1, 'Harmons', '2024-10-14 07:50:12', '2024-10-14 07:50:12', NULL, NULL);

-- Dumping structure for table 2024_0829.client_client_price
DROP TABLE IF EXISTS `client_client_price`;
CREATE TABLE IF NOT EXISTS `client_client_price` (
  `client_id` bigint unsigned NOT NULL,
  `client_price_id` bigint unsigned NOT NULL,
  KEY `client_id_fk_9986807` (`client_id`),
  KEY `client_price_id_fk_9986807` (`client_price_id`),
  CONSTRAINT `client_id_fk_9986807` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `client_price_id_fk_9986807` FOREIGN KEY (`client_price_id`) REFERENCES `client_prices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.client_client_price: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.client_prices
DROP TABLE IF EXISTS `client_prices`;
CREATE TABLE IF NOT EXISTS `client_prices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `price` decimal(15,2) DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gtin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qb_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qb_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `team_id` bigint unsigned DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_fk_10111999` (`client_id`),
  KEY `team_fk_9986806` (`team_id`),
  KEY `product_fk_10501234` (`product_id`),
  CONSTRAINT `client_fk_10111999` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `product_fk_10501234` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `team_fk_9986806` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.client_prices: ~0 rows (approximately)
REPLACE INTO `client_prices` (`id`, `price`, `sku`, `mpn`, `gtin`, `upc`, `qb_1`, `qb_2`, `created_at`, `updated_at`, `deleted_at`, `client_id`, `team_id`, `product_id`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 09:13:00', '2024-11-13 09:51:51', '2024-11-13 09:51:51', 1, NULL, 5),
	(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 09:51:51', '2024-11-13 09:51:51', NULL, 1, NULL, 5);

-- Dumping structure for table 2024_0829.client_product
DROP TABLE IF EXISTS `client_product`;
CREATE TABLE IF NOT EXISTS `client_product` (
  `product_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  KEY `product_id_fk_10112000` (`product_id`),
  KEY `client_id_fk_10112000` (`client_id`),
  CONSTRAINT `client_id_fk_10112000` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_id_fk_10112000` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.client_product: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.content_categories
DROP TABLE IF EXISTS `content_categories`;
CREATE TABLE IF NOT EXISTS `content_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.content_categories: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.content_category_content_page
DROP TABLE IF EXISTS `content_category_content_page`;
CREATE TABLE IF NOT EXISTS `content_category_content_page` (
  `content_page_id` bigint unsigned NOT NULL,
  `content_category_id` bigint unsigned NOT NULL,
  KEY `content_page_id_fk_9558413` (`content_page_id`),
  KEY `content_category_id_fk_9558413` (`content_category_id`),
  CONSTRAINT `content_category_id_fk_9558413` FOREIGN KEY (`content_category_id`) REFERENCES `content_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `content_page_id_fk_9558413` FOREIGN KEY (`content_page_id`) REFERENCES `content_pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.content_category_content_page: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.content_pages
DROP TABLE IF EXISTS `content_pages`;
CREATE TABLE IF NOT EXISTS `content_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_text` longtext COLLATE utf8mb4_unicode_ci,
  `excerpt` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.content_pages: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.content_page_content_tag
DROP TABLE IF EXISTS `content_page_content_tag`;
CREATE TABLE IF NOT EXISTS `content_page_content_tag` (
  `content_page_id` bigint unsigned NOT NULL,
  `content_tag_id` bigint unsigned NOT NULL,
  KEY `content_page_id_fk_9558414` (`content_page_id`),
  KEY `content_tag_id_fk_9558414` (`content_tag_id`),
  CONSTRAINT `content_page_id_fk_9558414` FOREIGN KEY (`content_page_id`) REFERENCES `content_pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `content_tag_id_fk_9558414` FOREIGN KEY (`content_tag_id`) REFERENCES `content_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.content_page_content_tag: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.content_tags
DROP TABLE IF EXISTS `content_tags`;
CREATE TABLE IF NOT EXISTS `content_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.content_tags: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.faq_categories
DROP TABLE IF EXISTS `faq_categories`;
CREATE TABLE IF NOT EXISTS `faq_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.faq_categories: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.faq_questions
DROP TABLE IF EXISTS `faq_questions`;
CREATE TABLE IF NOT EXISTS `faq_questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` longtext COLLATE utf8mb4_unicode_ci,
  `answer` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_fk_9558427` (`category_id`),
  CONSTRAINT `category_fk_9558427` FOREIGN KEY (`category_id`) REFERENCES `faq_categories` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.faq_questions: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.media
DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.media: ~0 rows (approximately)
REPLACE INTO `media` (`id`, `model_type`, `model_id`, `uuid`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `conversions_disk`, `size`, `manipulations`, `custom_properties`, `generated_conversions`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\Product', 4, 'd4c82648-708e-46c2-a6f1-3ce33822082b', 'photo', '6718013b6a486_4518826_slack_icon', '6718013b6a486_4518826_slack_icon.png', 'image/png', 'public', 'public', 21584, '[]', '[]', '{"thumb": true, "preview": true}', '[]', 1, '2024-10-23 02:47:11', '2024-10-23 02:47:12'),
	(2, 'App\\Models\\Product', 5, '85d5f99d-7c54-4259-a338-b51a1f3cafd7', 'photo', '6733fd1309ee8_4518826_slack_icon', '6733fd1309ee8_4518826_slack_icon.png', 'image/png', 'public', 'public', 21584, '[]', '[]', '{"thumb": true, "preview": true}', '[]', 1, '2024-11-13 09:13:00', '2024-11-13 09:13:00');

-- Dumping structure for table 2024_0829.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.migrations: ~48 rows (approximately)
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_100000_create_password_resets_table', 1),
	(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(3, '2024_09_10_000001_create_audit_logs_table', 1),
	(4, '2024_09_10_000002_create_media_table', 1),
	(5, '2024_09_10_000003_create_permissions_table', 1),
	(6, '2024_09_10_000004_create_roles_table', 1),
	(7, '2024_09_10_000005_create_users_table', 1),
	(8, '2024_09_10_000006_create_teams_table', 1),
	(9, '2024_09_10_000007_create_user_alerts_table', 1),
	(10, '2024_09_10_000008_create_content_categories_table', 1),
	(11, '2024_09_10_000009_create_content_tags_table', 1),
	(12, '2024_09_10_000010_create_content_pages_table', 1),
	(13, '2024_09_10_000011_create_faq_categories_table', 1),
	(14, '2024_09_10_000012_create_faq_questions_table', 1),
	(15, '2024_09_10_000013_create_product_categories_table', 1),
	(16, '2024_09_10_000014_create_product_tags_table', 1),
	(17, '2024_09_10_000015_create_products_table', 1),
	(18, '2024_09_10_000016_create_task_statuses_table', 1),
	(19, '2024_09_10_000017_create_task_tags_table', 1),
	(20, '2024_09_10_000018_create_tasks_table', 1),
	(21, '2024_09_10_000019_create_orders_table', 1),
	(22, '2024_09_10_000020_create_clients_table', 1),
	(23, '2024_09_10_000021_create_client_prices_table', 1),
	(24, '2024_09_10_000022_create_settings_table', 1),
	(25, '2024_09_10_000023_create_order_items_table', 1),
	(26, '2024_09_10_000024_create_permission_role_pivot_table', 1),
	(27, '2024_09_10_000025_create_role_user_pivot_table', 1),
	(28, '2024_09_10_000026_create_user_user_alert_pivot_table', 1),
	(29, '2024_09_10_000027_create_content_category_content_page_pivot_table', 1),
	(30, '2024_09_10_000028_create_content_page_content_tag_pivot_table', 1),
	(31, '2024_09_10_000029_create_product_product_category_pivot_table', 1),
	(32, '2024_09_10_000030_create_product_product_tag_pivot_table', 1),
	(33, '2024_09_10_000031_create_client_product_pivot_table', 1),
	(34, '2024_09_10_000032_create_task_task_tag_pivot_table', 1),
	(35, '2024_09_10_000033_create_client_client_price_pivot_table', 1),
	(36, '2024_09_10_000034_add_relationship_fields_to_users_table', 1),
	(37, '2024_09_10_000035_add_relationship_fields_to_teams_table', 1),
	(38, '2024_09_10_000036_add_relationship_fields_to_faq_questions_table', 1),
	(39, '2024_09_10_000037_add_relationship_fields_to_products_table', 1),
	(40, '2024_09_10_000038_add_relationship_fields_to_tasks_table', 1),
	(41, '2024_09_10_000039_add_relationship_fields_to_orders_table', 1),
	(42, '2024_09_10_000040_add_relationship_fields_to_clients_table', 1),
	(43, '2024_09_10_000041_add_relationship_fields_to_client_prices_table', 1),
	(44, '2024_09_10_000042_add_relationship_fields_to_order_items_table', 1),
	(45, '2024_09_10_000043_add_verification_fields', 1),
	(46, '2024_09_10_000044_add_approval_fields', 1),
	(47, '2024_09_10_000045_create_qa_topics_table', 1),
	(48, '2024_09_10_000046_create_qa_messages_table', 1),
	(49, '2024_10_29_190619_create_cache_table', 2),
	(50, '2024_09_10_000041_AddProductIdToClientPricesTable', 3),
	(51, '2018_08_08_100000_create_telescope_entries_table', 4);

-- Dumping structure for table 2024_0829.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_cost` double(15,2) DEFAULT NULL,
  `order_total` double(15,2) DEFAULT NULL,
  `total_price` double(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  `team_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_fk_9986973` (`client_id`),
  KEY `team_fk_9935719` (`team_id`),
  CONSTRAINT `client_fk_9986973` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `team_fk_9935719` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.orders: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.order_items
DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `gtin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mpn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(15,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `total_price` double(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint unsigned DEFAULT NULL,
  `items_id` bigint unsigned DEFAULT NULL,
  `team_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_fk_9986962` (`product_id`),
  KEY `items_fk_9986974` (`items_id`),
  KEY `team_fk_9986972` (`team_id`),
  CONSTRAINT `items_fk_9986974` FOREIGN KEY (`items_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `product_fk_9986962` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `team_fk_9986972` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.order_items: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.password_resets: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.permissions: ~119 rows (approximately)
REPLACE INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'user_management_access', NULL, NULL, NULL),
	(2, 'permission_create', NULL, NULL, NULL),
	(3, 'permission_edit', NULL, NULL, NULL),
	(4, 'permission_show', NULL, NULL, NULL),
	(5, 'permission_delete', NULL, NULL, NULL),
	(6, 'permission_access', NULL, NULL, NULL),
	(7, 'role_create', NULL, NULL, NULL),
	(8, 'role_edit', NULL, NULL, NULL),
	(9, 'role_show', NULL, NULL, NULL),
	(10, 'role_delete', NULL, NULL, NULL),
	(11, 'role_access', NULL, NULL, NULL),
	(12, 'user_create', NULL, NULL, NULL),
	(13, 'user_edit', NULL, NULL, NULL),
	(14, 'user_show', NULL, NULL, NULL),
	(15, 'user_delete', NULL, NULL, NULL),
	(16, 'user_access', NULL, NULL, NULL),
	(17, 'audit_log_show', NULL, NULL, NULL),
	(18, 'audit_log_access', NULL, NULL, NULL),
	(19, 'team_create', NULL, NULL, NULL),
	(20, 'team_edit', NULL, NULL, NULL),
	(21, 'team_show', NULL, NULL, NULL),
	(22, 'team_delete', NULL, NULL, NULL),
	(23, 'team_access', NULL, NULL, NULL),
	(24, 'user_alert_create', NULL, NULL, NULL),
	(25, 'user_alert_show', NULL, NULL, NULL),
	(26, 'user_alert_delete', NULL, NULL, NULL),
	(27, 'user_alert_access', NULL, NULL, NULL),
	(28, 'content_management_access', NULL, NULL, NULL),
	(29, 'content_category_create', NULL, NULL, NULL),
	(30, 'content_category_edit', NULL, NULL, NULL),
	(31, 'content_category_show', NULL, NULL, NULL),
	(32, 'content_category_delete', NULL, NULL, NULL),
	(33, 'content_category_access', NULL, NULL, NULL),
	(34, 'content_tag_create', NULL, NULL, NULL),
	(35, 'content_tag_edit', NULL, NULL, NULL),
	(36, 'content_tag_show', NULL, NULL, NULL),
	(37, 'content_tag_delete', NULL, NULL, NULL),
	(38, 'content_tag_access', NULL, NULL, NULL),
	(39, 'content_page_create', NULL, NULL, NULL),
	(40, 'content_page_edit', NULL, NULL, NULL),
	(41, 'content_page_show', NULL, NULL, NULL),
	(42, 'content_page_delete', NULL, NULL, NULL),
	(43, 'content_page_access', NULL, NULL, NULL),
	(44, 'faq_management_access', NULL, NULL, NULL),
	(45, 'faq_category_create', NULL, NULL, NULL),
	(46, 'faq_category_edit', NULL, NULL, NULL),
	(47, 'faq_category_show', NULL, NULL, NULL),
	(48, 'faq_category_delete', NULL, NULL, NULL),
	(49, 'faq_category_access', NULL, NULL, NULL),
	(50, 'faq_question_create', NULL, NULL, NULL),
	(51, 'faq_question_edit', NULL, NULL, NULL),
	(52, 'faq_question_show', NULL, NULL, NULL),
	(53, 'faq_question_delete', NULL, NULL, NULL),
	(54, 'faq_question_access', NULL, NULL, NULL),
	(55, 'product_management_access', NULL, NULL, NULL),
	(56, 'product_category_create', NULL, NULL, NULL),
	(57, 'product_category_edit', NULL, NULL, NULL),
	(58, 'product_category_show', NULL, NULL, NULL),
	(59, 'product_category_delete', NULL, NULL, NULL),
	(60, 'product_category_access', NULL, NULL, NULL),
	(61, 'product_tag_create', NULL, NULL, NULL),
	(62, 'product_tag_edit', NULL, NULL, NULL),
	(63, 'product_tag_show', NULL, NULL, NULL),
	(64, 'product_tag_delete', NULL, NULL, NULL),
	(65, 'product_tag_access', NULL, NULL, NULL),
	(66, 'product_create', NULL, NULL, NULL),
	(67, 'product_edit', NULL, NULL, NULL),
	(68, 'product_show', NULL, NULL, NULL),
	(69, 'product_delete', NULL, NULL, NULL),
	(70, 'product_access', NULL, NULL, NULL),
	(71, 'customer_create', NULL, NULL, NULL),
	(72, 'customer_edit', NULL, NULL, NULL),
	(73, 'customer_show', NULL, NULL, NULL),
	(74, 'customer_delete', NULL, NULL, NULL),
	(75, 'customer_access', NULL, NULL, NULL),
	(76, 'task_management_access', NULL, NULL, NULL),
	(77, 'task_status_create', NULL, NULL, NULL),
	(78, 'task_status_edit', NULL, NULL, NULL),
	(79, 'task_status_show', NULL, NULL, NULL),
	(80, 'task_status_delete', NULL, NULL, NULL),
	(81, 'task_status_access', NULL, NULL, NULL),
	(82, 'task_tag_create', NULL, NULL, NULL),
	(83, 'task_tag_edit', NULL, NULL, NULL),
	(84, 'task_tag_show', NULL, NULL, NULL),
	(85, 'task_tag_delete', NULL, NULL, NULL),
	(86, 'task_tag_access', NULL, NULL, NULL),
	(87, 'task_create', NULL, NULL, NULL),
	(88, 'task_edit', NULL, NULL, NULL),
	(89, 'task_show', NULL, NULL, NULL),
	(90, 'task_delete', NULL, NULL, NULL),
	(91, 'task_access', NULL, NULL, NULL),
	(92, 'tasks_calendar_access', NULL, NULL, NULL),
	(93, 'order_create', NULL, NULL, NULL),
	(94, 'order_edit', NULL, NULL, NULL),
	(95, 'order_show', NULL, NULL, NULL),
	(96, 'order_delete', NULL, NULL, NULL),
	(97, 'order_access', NULL, NULL, NULL),
	(98, 'client_create', NULL, NULL, NULL),
	(99, 'client_edit', NULL, NULL, NULL),
	(100, 'client_show', NULL, NULL, NULL),
	(101, 'client_delete', NULL, NULL, NULL),
	(102, 'client_access', NULL, NULL, NULL),
	(103, 'client_price_create', NULL, NULL, NULL),
	(104, 'client_price_edit', NULL, NULL, NULL),
	(105, 'client_price_show', NULL, NULL, NULL),
	(106, 'client_price_delete', NULL, NULL, NULL),
	(107, 'client_price_access', NULL, NULL, NULL),
	(108, 'developer_access', NULL, NULL, NULL),
	(109, 'setting_create', NULL, NULL, NULL),
	(110, 'setting_edit', NULL, NULL, NULL),
	(111, 'setting_delete', NULL, NULL, NULL),
	(112, 'setting_access', NULL, NULL, NULL),
	(113, 'order_item_create', NULL, NULL, NULL),
	(114, 'order_item_edit', NULL, NULL, NULL),
	(115, 'order_item_show', NULL, NULL, NULL),
	(116, 'order_item_delete', NULL, NULL, NULL),
	(117, 'order_item_access', NULL, NULL, NULL),
	(118, 'order_management_access', NULL, NULL, NULL),
	(119, 'profile_password_edit', NULL, NULL, NULL);

-- Dumping structure for table 2024_0829.permission_role
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  KEY `role_id_fk_9558359` (`role_id`),
  KEY `permission_id_fk_9558359` (`permission_id`),
  CONSTRAINT `permission_id_fk_9558359` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_id_fk_9558359` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.permission_role: ~213 rows (approximately)
REPLACE INTO `permission_role` (`role_id`, `permission_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(1, 8),
	(1, 9),
	(1, 10),
	(1, 11),
	(1, 12),
	(1, 13),
	(1, 14),
	(1, 15),
	(1, 16),
	(1, 17),
	(1, 18),
	(1, 19),
	(1, 20),
	(1, 21),
	(1, 22),
	(1, 23),
	(1, 24),
	(1, 25),
	(1, 26),
	(1, 27),
	(1, 28),
	(1, 29),
	(1, 30),
	(1, 31),
	(1, 32),
	(1, 33),
	(1, 34),
	(1, 35),
	(1, 36),
	(1, 37),
	(1, 38),
	(1, 39),
	(1, 40),
	(1, 41),
	(1, 42),
	(1, 43),
	(1, 44),
	(1, 45),
	(1, 46),
	(1, 47),
	(1, 48),
	(1, 49),
	(1, 50),
	(1, 51),
	(1, 52),
	(1, 53),
	(1, 54),
	(1, 55),
	(1, 56),
	(1, 57),
	(1, 58),
	(1, 59),
	(1, 60),
	(1, 61),
	(1, 62),
	(1, 63),
	(1, 64),
	(1, 65),
	(1, 66),
	(1, 67),
	(1, 68),
	(1, 69),
	(1, 70),
	(1, 71),
	(1, 72),
	(1, 73),
	(1, 74),
	(1, 75),
	(1, 76),
	(1, 77),
	(1, 78),
	(1, 79),
	(1, 80),
	(1, 81),
	(1, 82),
	(1, 83),
	(1, 84),
	(1, 85),
	(1, 86),
	(1, 87),
	(1, 88),
	(1, 89),
	(1, 90),
	(1, 91),
	(1, 92),
	(1, 93),
	(1, 94),
	(1, 95),
	(1, 96),
	(1, 97),
	(1, 98),
	(1, 99),
	(1, 100),
	(1, 101),
	(1, 102),
	(1, 103),
	(1, 104),
	(1, 105),
	(1, 106),
	(1, 107),
	(1, 108),
	(1, 109),
	(1, 110),
	(1, 111),
	(1, 112),
	(1, 113),
	(1, 114),
	(1, 115),
	(1, 116),
	(1, 117),
	(1, 118),
	(1, 119),
	(2, 17),
	(2, 18),
	(2, 28),
	(2, 29),
	(2, 30),
	(2, 31),
	(2, 32),
	(2, 33),
	(2, 34),
	(2, 35),
	(2, 36),
	(2, 37),
	(2, 38),
	(2, 39),
	(2, 40),
	(2, 41),
	(2, 42),
	(2, 43),
	(2, 44),
	(2, 45),
	(2, 46),
	(2, 47),
	(2, 48),
	(2, 49),
	(2, 50),
	(2, 51),
	(2, 52),
	(2, 53),
	(2, 54),
	(2, 55),
	(2, 56),
	(2, 57),
	(2, 58),
	(2, 59),
	(2, 60),
	(2, 61),
	(2, 62),
	(2, 63),
	(2, 64),
	(2, 65),
	(2, 66),
	(2, 67),
	(2, 68),
	(2, 69),
	(2, 70),
	(2, 71),
	(2, 72),
	(2, 73),
	(2, 74),
	(2, 75),
	(2, 76),
	(2, 77),
	(2, 78),
	(2, 79),
	(2, 80),
	(2, 81),
	(2, 82),
	(2, 83),
	(2, 84),
	(2, 85),
	(2, 86),
	(2, 87),
	(2, 88),
	(2, 89),
	(2, 90),
	(2, 91),
	(2, 92),
	(2, 93),
	(2, 94),
	(2, 95),
	(2, 96),
	(2, 97),
	(2, 98),
	(2, 99),
	(2, 100),
	(2, 101),
	(2, 102),
	(2, 103),
	(2, 104),
	(2, 105),
	(2, 106),
	(2, 107),
	(2, 108),
	(2, 109),
	(2, 110),
	(2, 111),
	(2, 112),
	(2, 113),
	(2, 114),
	(2, 115),
	(2, 116),
	(2, 117),
	(2, 118),
	(2, 119);

-- Dumping structure for table 2024_0829.personal_access_tokens
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `clients_prices_id` bigint unsigned DEFAULT NULL,
  `team_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_prices_fk_10112001` (`clients_prices_id`),
  KEY `team_fk_9986809` (`team_id`),
  CONSTRAINT `clients_prices_fk_10112001` FOREIGN KEY (`clients_prices_id`) REFERENCES `client_prices` (`id`),
  CONSTRAINT `team_fk_9986809` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.products: ~0 rows (approximately)
REPLACE INTO `products` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`, `clients_prices_id`, `team_id`) VALUES
	(1, 'test product', 'test product description', '2024-10-14 06:57:23', '2024-11-13 09:12:20', '2024-11-13 09:12:20', NULL, NULL),
	(2, 'test', 'test', '2024-10-23 01:48:10', '2024-11-13 09:12:20', '2024-11-13 09:12:20', NULL, NULL),
	(3, 'test', 'test', '2024-10-23 02:46:47', '2024-11-13 09:12:20', '2024-11-13 09:12:20', NULL, NULL),
	(4, 'test', 'test', '2024-10-23 02:47:11', '2024-11-13 09:12:20', '2024-11-13 09:12:20', NULL, NULL),
	(5, 'test', 'sdfasdfas', '2024-11-13 09:13:00', '2024-11-13 09:13:00', NULL, NULL, NULL);

-- Dumping structure for table 2024_0829.product_categories
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.product_categories: ~0 rows (approximately)
REPLACE INTO `product_categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'test', NULL, '2024-11-13 09:52:13', '2024-11-13 09:52:13', NULL);

-- Dumping structure for table 2024_0829.product_product_category
DROP TABLE IF EXISTS `product_product_category`;
CREATE TABLE IF NOT EXISTS `product_product_category` (
  `product_id` bigint unsigned NOT NULL,
  `product_category_id` bigint unsigned NOT NULL,
  KEY `product_id_fk_9558452` (`product_id`),
  KEY `product_category_id_fk_9558452` (`product_category_id`),
  CONSTRAINT `product_category_id_fk_9558452` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_id_fk_9558452` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.product_product_category: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.product_product_tag
DROP TABLE IF EXISTS `product_product_tag`;
CREATE TABLE IF NOT EXISTS `product_product_tag` (
  `product_id` bigint unsigned NOT NULL,
  `product_tag_id` bigint unsigned NOT NULL,
  KEY `product_id_fk_9558453` (`product_id`),
  KEY `product_tag_id_fk_9558453` (`product_tag_id`),
  CONSTRAINT `product_id_fk_9558453` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_tag_id_fk_9558453` FOREIGN KEY (`product_tag_id`) REFERENCES `product_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.product_product_tag: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.product_tags
DROP TABLE IF EXISTS `product_tags`;
CREATE TABLE IF NOT EXISTS `product_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.product_tags: ~0 rows (approximately)
REPLACE INTO `product_tags` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'tesst', '2024-11-13 09:54:51', '2024-11-13 09:54:51', NULL);

-- Dumping structure for table 2024_0829.qa_messages
DROP TABLE IF EXISTS `qa_messages`;
CREATE TABLE IF NOT EXISTS `qa_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint unsigned NOT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qa_messages_topic_id_foreign` (`topic_id`),
  KEY `qa_messages_sender_id_foreign` (`sender_id`),
  CONSTRAINT `qa_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `qa_messages_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `qa_topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.qa_messages: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.qa_topics
DROP TABLE IF EXISTS `qa_topics`;
CREATE TABLE IF NOT EXISTS `qa_topics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creator_id` bigint unsigned NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `qa_topics_creator_id_foreign` (`creator_id`),
  KEY `qa_topics_receiver_id_foreign` (`receiver_id`),
  CONSTRAINT `qa_topics_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `qa_topics_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.qa_topics: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.roles: ~2 rows (approximately)
REPLACE INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', NULL, NULL, NULL),
	(2, 'User', NULL, NULL, NULL);

-- Dumping structure for table 2024_0829.role_user
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  KEY `user_id_fk_9558368` (`user_id`),
  KEY `role_id_fk_9558368` (`role_id`),
  CONSTRAINT `role_id_fk_9558368` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_fk_9558368` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.role_user: ~0 rows (approximately)
REPLACE INTO `role_user` (`user_id`, `role_id`) VALUES
	(1, 1),
	(3, 2),
	(4, 2),
	(5, 2),
	(6, 2),
	(2, 1);

-- Dumping structure for table 2024_0829.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.settings: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.tasks
DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status_id` bigint unsigned DEFAULT NULL,
  `assigned_to_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status_fk_9935619` (`status_id`),
  KEY `assigned_to_fk_9935623` (`assigned_to_id`),
  CONSTRAINT `assigned_to_fk_9935623` FOREIGN KEY (`assigned_to_id`) REFERENCES `users` (`id`),
  CONSTRAINT `status_fk_9935619` FOREIGN KEY (`status_id`) REFERENCES `task_statuses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.tasks: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.task_statuses
DROP TABLE IF EXISTS `task_statuses`;
CREATE TABLE IF NOT EXISTS `task_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.task_statuses: ~3 rows (approximately)
REPLACE INTO `task_statuses` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Open', NULL, NULL, NULL),
	(2, 'In progress', NULL, NULL, NULL),
	(3, 'Closed', NULL, NULL, NULL);

-- Dumping structure for table 2024_0829.task_tags
DROP TABLE IF EXISTS `task_tags`;
CREATE TABLE IF NOT EXISTS `task_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.task_tags: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.task_task_tag
DROP TABLE IF EXISTS `task_task_tag`;
CREATE TABLE IF NOT EXISTS `task_task_tag` (
  `task_id` bigint unsigned NOT NULL,
  `task_tag_id` bigint unsigned NOT NULL,
  KEY `task_id_fk_9935620` (`task_id`),
  KEY `task_tag_id_fk_9935620` (`task_tag_id`),
  CONSTRAINT `task_id_fk_9935620` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_tag_id_fk_9935620` FOREIGN KEY (`task_tag_id`) REFERENCES `task_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.task_task_tag: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.teams
DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owner_fk_9558391` (`owner_id`),
  CONSTRAINT `owner_fk_9558391` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.teams: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.telescope_entries
DROP TABLE IF EXISTS `telescope_entries`;
CREATE TABLE IF NOT EXISTS `telescope_entries` (
  `sequence` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  KEY `telescope_entries_batch_id_index` (`batch_id`),
  KEY `telescope_entries_family_hash_index` (`family_hash`),
  KEY `telescope_entries_created_at_index` (`created_at`),
  KEY `telescope_entries_type_should_display_on_index_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.telescope_entries: ~8 rows (approximately)
REPLACE INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) VALUES
	(1, '9d87c5c0-55f0-45d3-90a2-b0b31b41b7aa', '9d87c5c0-b8be-4196-9e39-df222b006606', 'e5a16b725485bdd16d22d3f79dc104e3', 1, 'exception', '{"class":"Spatie\\\\LaravelIgnition\\\\Exceptions\\\\ViewException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/resources\\/views\\/layouts\\/admin.blade.php","line":60,"message":"syntax error, unexpected token \\"@\\"","context":{"view":{"view":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/resources\\/views\\/layouts\\/admin.blade.php","data":{"errors":"<pre class=sf-dump id=sf-dump-1715648224 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\ViewErrorBag<\\/span> {<a class=sf-dump-ref>#411<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">bags<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1715648224\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n"}},"userId":1},"trace":{"7":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"8":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"9":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"10":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"11":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"12":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"13":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"14":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":69},"15":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":35},"16":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":918},"17":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":885},"18":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"19":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"20":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/app\\/Http\\/Middleware\\/IsAdmin.php","line":22},"21":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"22":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/app\\/Http\\/Middleware\\/TwoFactorMiddleware.php","line":28},"23":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"24":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/app\\/Http\\/Middleware\\/VerificationMiddleware.php","line":21},"25":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"26":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/app\\/Http\\/Middleware\\/ApprovalMiddleware.php","line":21},"27":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"28":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/app\\/Http\\/Middleware\\/SetLocale.php","line":24},"29":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"30":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/app\\/Http\\/Middleware\\/AuthGates.php","line":32},"31":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"32":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Middleware\\/SubstituteBindings.php","line":50},"33":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"34":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Auth\\/Middleware\\/Authenticate.php","line":57},"35":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"36":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/VerifyCsrfToken.php","line":78},"37":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"38":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Middleware\\/ShareErrorsFromSession.php","line":49},"39":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"40":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":121},"41":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":64},"42":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"43":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/AddQueuedCookiesToResponse.php","line":37},"44":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"45":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/EncryptCookies.php","line":67},"46":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"47":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"48":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"49":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":784},"50":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":748},"51":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":737},"52":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":200},"53":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"54":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/barryvdh\\/laravel-debugbar\\/src\\/Middleware\\/InjectDebugbar.php","line":59},"55":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"56":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"57":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ConvertEmptyStringsToNull.php","line":31},"58":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"59":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"60":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TrimStrings.php","line":40},"61":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"62":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ValidatePostSize.php","line":27},"63":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"64":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/PreventRequestsDuringMaintenance.php","line":99},"65":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"66":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/HandleCors.php","line":49},"67":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"68":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/TrustProxies.php","line":39},"69":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"70":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"71":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":175},"72":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":144},"73":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241120005125\\/public\\/index.php","line":51}},"line_preview":{"51":"                            @endforeach","52":"                        <\\/div>","53":"                    <\\/li>","54":"                @endif","55":"","56":"                <li class=\\"c-header-nav-item dropdown notifications-menu\\">","57":"                    <a href=\\"#\\" class=\\"c-header-nav-link\\" data-toggle=\\"dropdown\\">","58":"                        <i class=\\"far fa-bell\\"><\\/i>","59":"                        @php($alertsCount = \\\\Auth::user()->userUserAlerts()->where(\'read\', false)->count())","60":"                        @if($alertsCount > 0)","61":"                            <span class=\\"badge badge-warning navbar-badge\\">","62":"                                {{ $alertsCount }}","63":"                            <\\/span>","64":"                        @endif","65":"                    <\\/a>","66":"                    <div class=\\"dropdown-menu dropdown-menu-lg dropdown-menu-right\\">","67":"                        @if(count($alerts = \\\\Auth::user()->userUserAlerts()->withPivot(\'read\')->limit(10)->orderBy(\'created_at\', \'ASC\')->get()->reverse()) > 0)","68":"                            @foreach($alerts as $alert)","69":"                                <div class=\\"dropdown-item\\">","70":"                                    <a href=\\"{{ $alert->alert_link ? $alert->alert_link : \\"#\\" }}\\" target=\\"_blank\\" rel=\\"noopener noreferrer\\">"},"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"},"occurrences":1}', '2024-11-20 01:03:58'),
	(2, '9d87c5c0-71ca-4ce2-b75b-6133b1f08a52', '9d87c5c0-b8be-4196-9e39-df222b006606', NULL, 1, 'request', '{"ip_address":"136.36.127.94","uri":"\\/admin","method":"GET","controller_action":"App\\\\Http\\\\Controllers\\\\Admin\\\\HomeController@index","middleware":["web","auth","2fa","admin"],"headers":{"content-length":"0","connection":"close","host":"ppgrowers.com","priority":"u=0, i","cookie":"********","accept-language":"en-US,en;q=0.9","accept-encoding":"gzip, deflate, br, zstd","sec-fetch-dest":"document","sec-fetch-user":"?1","sec-fetch-mode":"navigate","sec-fetch-site":"none","accept":"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7","user-agent":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/131.0.0.0 Safari\\/537.36","upgrade-insecure-requests":"1","sec-ch-ua-platform":"\\"Windows\\"","sec-ch-ua-mobile":"?0","sec-ch-ua":"\\"Google Chrome\\";v=\\"131\\", \\"Chromium\\";v=\\"131\\", \\"Not_A Brand\\";v=\\"24\\"","cache-control":"max-age=0"},"payload":[],"session":{"_token":"********","_previous":{"url":"https:\\/\\/ppgrowers.com\\/admin"},"_flash":{"old":[],"new":[]},"log-viewer:shorter-stack-traces":false,"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":1,"auth":{"password_confirmed_at":1732060334}},"response_status":500,"response":"HTML Response","duration":265,"memory":32,"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"}}', '2024-11-20 01:03:58'),
	(3, '9d8b204a-b14f-4aaa-ad9e-091c6aacd065', '9d8b204b-3699-4d34-82cd-924f6657d60d', '1cafe5d373243ab219002dadae6b2e1b', 0, 'exception', '{"class":"Spatie\\\\LaravelIgnition\\\\Exceptions\\\\ViewException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/partials\\/categories.blade.php","line":6,"message":"Attempt to read property \\"name\\" on string","context":{"view":{"view":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/partials\\/categories.blade.php","data":{"errors":"<pre class=sf-dump id=sf-dump-597243540 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\ViewErrorBag<\\/span> {<a class=sf-dump-ref>#413<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">bags<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-597243540\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","categories":"<pre class=sf-dump id=sf-dump-1663635672 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#680<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1663635672\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","clients":"<pre class=sf-dump id=sf-dump-1354508823 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#720<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">Harmons<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1354508823\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","product":"<pre class=sf-dump id=sf-dump-1584926560 data-indent-pad=\\"  \\"><span class=sf-dump-note>App\\\\Models\\\\Product<\\/span> {<a class=sf-dump-ref>#508<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">connection<\\/span>: \\"<span class=sf-dump-str title=\\"5 characters\\">mysql<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">table<\\/span>: <span class=sf-dump-const title=\\"Uninitialized property\\">?<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">primaryKey<\\/span>: \\"<span class=sf-dump-str title=\\"2 characters\\">id<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">keyType<\\/span>: \\"<span class=sf-dump-str title=\\"3 characters\\">int<\\/span>\\"\\n  +<span class=sf-dump-public title=\\"Public property\\">incrementing<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">with<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">withCount<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">preventsLazyLoading<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">perPage<\\/span>: <span class=sf-dump-num>15<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">exists<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">wasRecentlyCreated<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributes<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">original<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">changes<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">casts<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"8 characters\\">datetime<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">classCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributeCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dateFormat<\\/span>: <span class=sf-dump-const>null<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">appends<\\/span>: <span class=sf-dump-note>array:2<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">photo<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"17 characters\\">additional_photos<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dispatchesEvents<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">observables<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">relations<\\/span>: <span class=sf-dump-note>array:4<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>categories<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#777<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>tags<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#722<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>clientPrices<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#721<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>team<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">touches<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">timestamps<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">usesUniqueIds<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">hidden<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">visible<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">fillable<\\/span>: <span class=sf-dump-note>array:6<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"4 characters\\">name<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"11 characters\\">description<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>3<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>4<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n    <span class=sf-dump-index>5<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">team_id<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">guarded<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str>*<\\/span>\\"\\n  <\\/samp>]\\n  +<span class=sf-dump-public title=\\"Public property\\">table<\\/span>: \\"<span class=sf-dump-str title=\\"8 characters\\">products<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dates<\\/span>: <span class=sf-dump-note>array:3<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">forceDeleting<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaConversions<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaCollections<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">deletePreservingMedia<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">unAttachedMediaLibraryItems<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1584926560\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","tags":"<pre class=sf-dump id=sf-dump-1792480566 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#692<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">tesst<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1792480566\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n"}},"userId":1},"trace":{"2":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"3":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"4":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"5":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"6":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"7":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"8":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"9":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/edit.blade.php","line":47},"10":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"11":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"12":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"13":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"14":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"15":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"16":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"17":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":69},"18":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":35},"19":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":918},"20":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":885},"21":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"22":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"23":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/IsAdmin.php","line":22},"24":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"25":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/TwoFactorMiddleware.php","line":28},"26":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"27":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/VerificationMiddleware.php","line":21},"28":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"29":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/ApprovalMiddleware.php","line":21},"30":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"31":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/SetLocale.php","line":24},"32":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"33":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/AuthGates.php","line":32},"34":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"35":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Middleware\\/SubstituteBindings.php","line":50},"36":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"37":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Auth\\/Middleware\\/Authenticate.php","line":57},"38":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"39":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/VerifyCsrfToken.php","line":78},"40":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"41":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Middleware\\/ShareErrorsFromSession.php","line":49},"42":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"43":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":121},"44":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":64},"45":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"46":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/AddQueuedCookiesToResponse.php","line":37},"47":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"48":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/EncryptCookies.php","line":67},"49":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"50":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"51":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"52":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":784},"53":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":748},"54":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":737},"55":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":200},"56":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"57":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/barryvdh\\/laravel-debugbar\\/src\\/Middleware\\/InjectDebugbar.php","line":59},"58":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"59":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"60":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ConvertEmptyStringsToNull.php","line":31},"61":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"62":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"63":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TrimStrings.php","line":40},"64":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"65":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ValidatePostSize.php","line":27},"66":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"67":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/PreventRequestsDuringMaintenance.php","line":99},"68":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"69":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/HandleCors.php","line":49},"70":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"71":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/TrustProxies.php","line":39},"72":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"73":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"74":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":175},"75":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":144},"76":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/public\\/index.php","line":51}},"line_preview":{"8":"        @endforeach","9":"    <\\/select>","10":"<\\/div>","11":""},"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"},"occurrences":1}', '2024-11-21 17:04:37'),
	(4, '9d8b204a-e1d7-40c9-804a-68cd9d8fb83a', '9d8b204b-3699-4d34-82cd-924f6657d60d', NULL, 1, 'request', '{"ip_address":"136.36.127.94","uri":"\\/admin\\/products\\/5\\/edit","method":"GET","controller_action":"App\\\\Http\\\\Controllers\\\\Admin\\\\ProductController@edit","middleware":["web","auth","2fa","admin"],"headers":{"content-length":"0","connection":"close","host":"ppgrowers.com","priority":"u=0, i","cookie":"********","accept-language":"en-US,en;q=0.9","accept-encoding":"gzip, deflate, br, zstd","referer":"https:\\/\\/ppgrowers.com\\/admin\\/products","sec-fetch-dest":"document","sec-fetch-user":"?1","sec-fetch-mode":"navigate","sec-fetch-site":"same-origin","accept":"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7","user-agent":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/131.0.0.0 Safari\\/537.36","upgrade-insecure-requests":"1","sec-ch-ua-platform":"\\"Windows\\"","sec-ch-ua-mobile":"?0","sec-ch-ua":"\\"Google Chrome\\";v=\\"131\\", \\"Chromium\\";v=\\"131\\", \\"Not_A Brand\\";v=\\"24\\""},"payload":[],"session":{"_token":"********","_flash":{"old":[],"new":[]},"_previous":{"url":"https:\\/\\/ppgrowers.com\\/admin\\/products\\/5\\/edit"},"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":1,"auth":{"password_confirmed_at":1732202576}},"response_status":500,"response":"HTML Response","duration":373,"memory":34,"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"}}', '2024-11-21 17:04:37'),
	(5, '9d8b2d48-4348-4960-8683-0639c3fb524f', '9d8b2d48-a6f0-469a-b9fc-c4d313622626', '1cafe5d373243ab219002dadae6b2e1b', 0, 'exception', '{"class":"Spatie\\\\LaravelIgnition\\\\Exceptions\\\\ViewException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/partials\\/categories.blade.php","line":6,"message":"Attempt to read property \\"name\\" on string","context":{"view":{"view":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/partials\\/categories.blade.php","data":{"errors":"<pre class=sf-dump id=sf-dump-1612846852 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\ViewErrorBag<\\/span> {<a class=sf-dump-ref>#413<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">bags<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1612846852\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","categories":"<pre class=sf-dump id=sf-dump-1706950835 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#680<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1706950835\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","clients":"<pre class=sf-dump id=sf-dump-992192729 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#720<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">Harmons<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-992192729\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","product":"<pre class=sf-dump id=sf-dump-54612405 data-indent-pad=\\"  \\"><span class=sf-dump-note>App\\\\Models\\\\Product<\\/span> {<a class=sf-dump-ref>#508<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">connection<\\/span>: \\"<span class=sf-dump-str title=\\"5 characters\\">mysql<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">table<\\/span>: <span class=sf-dump-const title=\\"Uninitialized property\\">?<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">primaryKey<\\/span>: \\"<span class=sf-dump-str title=\\"2 characters\\">id<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">keyType<\\/span>: \\"<span class=sf-dump-str title=\\"3 characters\\">int<\\/span>\\"\\n  +<span class=sf-dump-public title=\\"Public property\\">incrementing<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">with<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">withCount<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">preventsLazyLoading<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">perPage<\\/span>: <span class=sf-dump-num>15<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">exists<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">wasRecentlyCreated<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributes<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">original<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">changes<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">casts<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"8 characters\\">datetime<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">classCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributeCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dateFormat<\\/span>: <span class=sf-dump-const>null<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">appends<\\/span>: <span class=sf-dump-note>array:2<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">photo<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"17 characters\\">additional_photos<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dispatchesEvents<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">observables<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">relations<\\/span>: <span class=sf-dump-note>array:4<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>categories<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#777<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>tags<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#722<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>clientPrices<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#721<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>team<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">touches<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">timestamps<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">usesUniqueIds<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">hidden<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">visible<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">fillable<\\/span>: <span class=sf-dump-note>array:6<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"4 characters\\">name<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"11 characters\\">description<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>3<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>4<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n    <span class=sf-dump-index>5<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">team_id<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">guarded<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str>*<\\/span>\\"\\n  <\\/samp>]\\n  +<span class=sf-dump-public title=\\"Public property\\">table<\\/span>: \\"<span class=sf-dump-str title=\\"8 characters\\">products<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dates<\\/span>: <span class=sf-dump-note>array:3<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">forceDeleting<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaConversions<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaCollections<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">deletePreservingMedia<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">unAttachedMediaLibraryItems<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-54612405\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","tags":"<pre class=sf-dump id=sf-dump-470476094 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#692<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">tesst<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-470476094\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n"}},"userId":1},"trace":{"2":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"3":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"4":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"5":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"6":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"7":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"8":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"9":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/edit.blade.php","line":47},"10":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"11":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"12":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"13":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"14":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"15":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"16":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"17":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":69},"18":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":35},"19":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":918},"20":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":885},"21":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"22":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"23":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/IsAdmin.php","line":22},"24":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"25":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/TwoFactorMiddleware.php","line":28},"26":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"27":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/VerificationMiddleware.php","line":21},"28":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"29":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/ApprovalMiddleware.php","line":21},"30":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"31":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/SetLocale.php","line":24},"32":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"33":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/AuthGates.php","line":32},"34":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"35":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Middleware\\/SubstituteBindings.php","line":50},"36":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"37":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Auth\\/Middleware\\/Authenticate.php","line":57},"38":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"39":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/VerifyCsrfToken.php","line":78},"40":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"41":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Middleware\\/ShareErrorsFromSession.php","line":49},"42":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"43":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":121},"44":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":64},"45":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"46":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/AddQueuedCookiesToResponse.php","line":37},"47":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"48":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/EncryptCookies.php","line":67},"49":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"50":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"51":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"52":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":784},"53":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":748},"54":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":737},"55":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":200},"56":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"57":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/barryvdh\\/laravel-debugbar\\/src\\/Middleware\\/InjectDebugbar.php","line":59},"58":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"59":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"60":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ConvertEmptyStringsToNull.php","line":31},"61":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"62":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"63":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TrimStrings.php","line":40},"64":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"65":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ValidatePostSize.php","line":27},"66":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"67":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/PreventRequestsDuringMaintenance.php","line":99},"68":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"69":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/HandleCors.php","line":49},"70":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"71":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/TrustProxies.php","line":39},"72":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"73":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"74":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":175},"75":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":144},"76":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/public\\/index.php","line":51}},"line_preview":{"8":"        @endforeach","9":"    <\\/select>","10":"<\\/div>","11":""},"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"},"occurrences":2}', '2024-11-21 17:40:57'),
	(6, '9d8b2d48-6244-4306-9dd7-4d816072688e', '9d8b2d48-a6f0-469a-b9fc-c4d313622626', NULL, 1, 'request', '{"ip_address":"136.36.127.94","uri":"\\/admin\\/products\\/5\\/edit","method":"GET","controller_action":"App\\\\Http\\\\Controllers\\\\Admin\\\\ProductController@edit","middleware":["web","auth","2fa","admin"],"headers":{"content-length":"0","connection":"close","host":"ppgrowers.com","priority":"u=0, i","cookie":"********","accept-language":"en-US,en;q=0.9","accept-encoding":"gzip, deflate, br, zstd","referer":"https:\\/\\/ppgrowers.com\\/admin\\/products","sec-fetch-dest":"document","sec-fetch-user":"?1","sec-fetch-mode":"navigate","sec-fetch-site":"same-origin","accept":"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7","user-agent":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/131.0.0.0 Safari\\/537.36","upgrade-insecure-requests":"1","sec-ch-ua-platform":"\\"Windows\\"","sec-ch-ua-mobile":"?0","sec-ch-ua":"\\"Google Chrome\\";v=\\"131\\", \\"Chromium\\";v=\\"131\\", \\"Not_A Brand\\";v=\\"24\\"","cache-control":"max-age=0"},"payload":[],"session":{"_token":"********","_flash":{"old":[],"new":[]},"_previous":{"url":"https:\\/\\/ppgrowers.com\\/admin\\/products\\/5\\/edit"},"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":1,"auth":{"password_confirmed_at":1732202576}},"response_status":500,"response":"HTML Response","duration":317,"memory":34,"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"}}', '2024-11-21 17:40:57'),
	(7, '9d8b2d7d-2054-402c-9cc3-c8311fef9309', '9d8b2d7d-8a10-4475-81c3-0958c90e87fc', '1cafe5d373243ab219002dadae6b2e1b', 1, 'exception', '{"class":"Spatie\\\\LaravelIgnition\\\\Exceptions\\\\ViewException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/partials\\/categories.blade.php","line":6,"message":"Attempt to read property \\"name\\" on string","context":{"view":{"view":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/partials\\/categories.blade.php","data":{"errors":"<pre class=sf-dump id=sf-dump-1359959574 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\ViewErrorBag<\\/span> {<a class=sf-dump-ref>#413<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">bags<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1359959574\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","categories":"<pre class=sf-dump id=sf-dump-1828615883 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#680<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1828615883\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","clients":"<pre class=sf-dump id=sf-dump-2072072645 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#720<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">Harmons<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-2072072645\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","product":"<pre class=sf-dump id=sf-dump-1750328230 data-indent-pad=\\"  \\"><span class=sf-dump-note>App\\\\Models\\\\Product<\\/span> {<a class=sf-dump-ref>#508<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">connection<\\/span>: \\"<span class=sf-dump-str title=\\"5 characters\\">mysql<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">table<\\/span>: <span class=sf-dump-const title=\\"Uninitialized property\\">?<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">primaryKey<\\/span>: \\"<span class=sf-dump-str title=\\"2 characters\\">id<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">keyType<\\/span>: \\"<span class=sf-dump-str title=\\"3 characters\\">int<\\/span>\\"\\n  +<span class=sf-dump-public title=\\"Public property\\">incrementing<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">with<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">withCount<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">preventsLazyLoading<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">perPage<\\/span>: <span class=sf-dump-num>15<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">exists<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">wasRecentlyCreated<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributes<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">original<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">changes<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">casts<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"8 characters\\">datetime<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">classCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributeCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dateFormat<\\/span>: <span class=sf-dump-const>null<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">appends<\\/span>: <span class=sf-dump-note>array:2<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">photo<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"17 characters\\">additional_photos<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dispatchesEvents<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">observables<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">relations<\\/span>: <span class=sf-dump-note>array:4<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>categories<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#777<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>tags<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#722<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>clientPrices<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#721<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>team<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">touches<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">timestamps<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">usesUniqueIds<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">hidden<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">visible<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">fillable<\\/span>: <span class=sf-dump-note>array:6<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"4 characters\\">name<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"11 characters\\">description<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>3<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>4<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n    <span class=sf-dump-index>5<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">team_id<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">guarded<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str>*<\\/span>\\"\\n  <\\/samp>]\\n  +<span class=sf-dump-public title=\\"Public property\\">table<\\/span>: \\"<span class=sf-dump-str title=\\"8 characters\\">products<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dates<\\/span>: <span class=sf-dump-note>array:3<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">forceDeleting<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaConversions<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaCollections<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">deletePreservingMedia<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">unAttachedMediaLibraryItems<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1750328230\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","tags":"<pre class=sf-dump id=sf-dump-1497562832 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#692<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">tesst<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1497562832\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n"}},"userId":1},"trace":{"2":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"3":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"4":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"5":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"6":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"7":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"8":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"9":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/resources\\/views\\/admin\\/products\\/edit.blade.php","line":47},"10":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"11":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"12":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"13":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"14":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"15":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"16":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"17":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":69},"18":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":35},"19":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":918},"20":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":885},"21":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"22":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"23":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/IsAdmin.php","line":22},"24":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"25":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/TwoFactorMiddleware.php","line":28},"26":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"27":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/VerificationMiddleware.php","line":21},"28":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"29":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/ApprovalMiddleware.php","line":21},"30":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"31":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/SetLocale.php","line":24},"32":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"33":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/app\\/Http\\/Middleware\\/AuthGates.php","line":32},"34":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"35":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Middleware\\/SubstituteBindings.php","line":50},"36":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"37":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Auth\\/Middleware\\/Authenticate.php","line":57},"38":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"39":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/VerifyCsrfToken.php","line":78},"40":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"41":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Middleware\\/ShareErrorsFromSession.php","line":49},"42":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"43":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":121},"44":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":64},"45":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"46":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/AddQueuedCookiesToResponse.php","line":37},"47":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"48":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/EncryptCookies.php","line":67},"49":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"50":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"51":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"52":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":784},"53":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":748},"54":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":737},"55":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":200},"56":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"57":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/barryvdh\\/laravel-debugbar\\/src\\/Middleware\\/InjectDebugbar.php","line":59},"58":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"59":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"60":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ConvertEmptyStringsToNull.php","line":31},"61":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"62":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"63":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TrimStrings.php","line":40},"64":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"65":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ValidatePostSize.php","line":27},"66":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"67":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/PreventRequestsDuringMaintenance.php","line":99},"68":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"69":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/HandleCors.php","line":49},"70":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"71":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/TrustProxies.php","line":39},"72":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"73":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"74":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":175},"75":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":144},"76":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121021308\\/public\\/index.php","line":51}},"line_preview":{"8":"        @endforeach","9":"    <\\/select>","10":"<\\/div>","11":""},"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"},"occurrences":3}', '2024-11-21 17:41:31'),
	(8, '9d8b2d7d-45c9-439e-a950-11b4922fdf02', '9d8b2d7d-8a10-4475-81c3-0958c90e87fc', NULL, 1, 'request', '{"ip_address":"136.36.127.94","uri":"\\/admin\\/products\\/5\\/edit","method":"GET","controller_action":"App\\\\Http\\\\Controllers\\\\Admin\\\\ProductController@edit","middleware":["web","auth","2fa","admin"],"headers":{"content-length":"0","connection":"close","host":"ppgrowers.com","priority":"u=0, i","cookie":"********","accept-language":"en-US,en;q=0.9","accept-encoding":"gzip, deflate, br, zstd","referer":"https:\\/\\/ppgrowers.com\\/admin\\/products","sec-fetch-dest":"document","sec-fetch-user":"?1","sec-fetch-mode":"navigate","sec-fetch-site":"same-origin","accept":"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7","user-agent":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/131.0.0.0 Safari\\/537.36","upgrade-insecure-requests":"1","sec-ch-ua-platform":"\\"Windows\\"","sec-ch-ua-mobile":"?0","sec-ch-ua":"\\"Google Chrome\\";v=\\"131\\", \\"Chromium\\";v=\\"131\\", \\"Not_A Brand\\";v=\\"24\\"","cache-control":"max-age=0"},"payload":[],"session":{"_token":"********","_flash":{"old":[],"new":[]},"_previous":{"url":"https:\\/\\/ppgrowers.com\\/admin\\/products\\/5\\/edit"},"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":1,"auth":{"password_confirmed_at":1732202576}},"response_status":500,"response":"HTML Response","duration":342,"memory":34,"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"}}', '2024-11-21 17:41:31'),
	(9, '9d8b2efe-043f-49a3-9032-d13ad5820daa', '9d8b2efe-0623-44b2-b837-d8e996b5bc13', '761950dde17ff658bec35d4b64f0efe1', 1, 'exception', '{"class":"LogicException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/ConfigCacheCommand.php","line":73,"message":"Your configuration files are not serializable.","context":null,"trace":[{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":36},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Util.php","line":41},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":93},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Container.php","line":662},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":211},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/symfony\\/console\\/Command\\/Command.php","line":326},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":180},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Concerns\\/CallsCommands.php","line":67},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Concerns\\/CallsCommands.php","line":40},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/View\\/Components\\/Task.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/View\\/Components\\/Factory.php","line":58},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Collections\\/Traits\\/EnumeratesValues.php","line":240},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":36},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Util.php","line":41},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":93},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Container.php","line":662},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":211},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/symfony\\/console\\/Command\\/Command.php","line":326},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":180},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/symfony\\/console\\/Application.php","line":1096},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/symfony\\/console\\/Application.php","line":324},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/symfony\\/console\\/Application.php","line":175},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/Kernel.php","line":201},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121174507\\/artisan","line":35}],"line_preview":{"64":"        $this->files->put(","65":"            $configPath, \'<?php return \'.var_export($config, true).\';\'.PHP_EOL","66":"        );","67":"","68":"        try {","69":"            require $configPath;","70":"        } catch (Throwable $e) {","71":"            $this->files->delete($configPath);","72":"","73":"            throw new LogicException(\'Your configuration files are not serializable.\', 0, $e);","74":"        }","75":"","76":"        $this->components->info(\'Configuration cached successfully.\');","77":"    }","78":"","79":"    \\/**","80":"     * Boot a fresh copy of the application configuration.","81":"     *","82":"     * @return array","83":"     *\\/"},"hostname":"vps59844","occurrences":1}', '2024-11-21 17:45:44'),
	(10, '9d8b3153-cf1d-4b22-a4fa-83df90177398', '9d8b3153-d0f5-41d2-9b48-eee69ff56e69', 'b9bbba09a194f188cdfeccb49e814564', 1, 'exception', '{"class":"LogicException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/ConfigCacheCommand.php","line":73,"message":"Your configuration files are not serializable.","context":null,"trace":[{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":36},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Util.php","line":41},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":93},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Container.php","line":662},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":211},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/symfony\\/console\\/Command\\/Command.php","line":326},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":180},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Concerns\\/CallsCommands.php","line":67},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Concerns\\/CallsCommands.php","line":40},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/View\\/Components\\/Task.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/View\\/Components\\/Factory.php","line":58},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Collections\\/Traits\\/EnumeratesValues.php","line":240},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":36},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Util.php","line":41},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":93},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Container.php","line":662},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":211},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/symfony\\/console\\/Command\\/Command.php","line":326},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":180},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/symfony\\/console\\/Application.php","line":1096},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/symfony\\/console\\/Application.php","line":324},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/symfony\\/console\\/Application.php","line":175},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/Kernel.php","line":201},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121175138\\/artisan","line":35}],"line_preview":{"64":"        $this->files->put(","65":"            $configPath, \'<?php return \'.var_export($config, true).\';\'.PHP_EOL","66":"        );","67":"","68":"        try {","69":"            require $configPath;","70":"        } catch (Throwable $e) {","71":"            $this->files->delete($configPath);","72":"","73":"            throw new LogicException(\'Your configuration files are not serializable.\', 0, $e);","74":"        }","75":"","76":"        $this->components->info(\'Configuration cached successfully.\');","77":"    }","78":"","79":"    \\/**","80":"     * Boot a fresh copy of the application configuration.","81":"     *","82":"     * @return array","83":"     *\\/"},"hostname":"vps59844","occurrences":1}', '2024-11-21 17:52:15'),
	(11, '9d8b38ca-8305-4e4e-87f1-c910ca7e2696', '9d8b38ca-84de-4f5d-af87-353e13cefff7', 'd0577cb95223b7a5084a0dafe614c40a', 1, 'exception', '{"class":"LogicException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/ConfigCacheCommand.php","line":73,"message":"Your configuration files are not serializable.","context":null,"trace":[{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":36},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Util.php","line":41},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":93},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Container.php","line":662},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":211},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/symfony\\/console\\/Command\\/Command.php","line":326},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":180},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Concerns\\/CallsCommands.php","line":67},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Concerns\\/CallsCommands.php","line":40},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/View\\/Components\\/Task.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/View\\/Components\\/Factory.php","line":58},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Collections\\/Traits\\/EnumeratesValues.php","line":240},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/OptimizeCommand.php","line":37},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":36},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Util.php","line":41},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":93},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/BoundMethod.php","line":35},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Container\\/Container.php","line":662},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":211},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/symfony\\/console\\/Command\\/Command.php","line":326},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Console\\/Command.php","line":180},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/symfony\\/console\\/Application.php","line":1096},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/symfony\\/console\\/Application.php","line":324},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/symfony\\/console\\/Application.php","line":175},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Console\\/Kernel.php","line":201},{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/artisan","line":35}],"line_preview":{"64":"        $this->files->put(","65":"            $configPath, \'<?php return \'.var_export($config, true).\';\'.PHP_EOL","66":"        );","67":"","68":"        try {","69":"            require $configPath;","70":"        } catch (Throwable $e) {","71":"            $this->files->delete($configPath);","72":"","73":"            throw new LogicException(\'Your configuration files are not serializable.\', 0, $e);","74":"        }","75":"","76":"        $this->components->info(\'Configuration cached successfully.\');","77":"    }","78":"","79":"    \\/**","80":"     * Boot a fresh copy of the application configuration.","81":"     *","82":"     * @return array","83":"     *\\/"},"hostname":"vps59844","occurrences":1}', '2024-11-21 18:13:08'),
	(12, '9d8b3938-cb4a-4992-a8d9-dcfe94d965c4', '9d8b3939-312a-4cbc-86e4-2a9348b58ac8', 'b05654fb9b8bd99b557a7dd404ae348e', 1, 'exception', '{"class":"Spatie\\\\LaravelIgnition\\\\Exceptions\\\\ViewException","file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/resources\\/views\\/admin\\/products\\/partials\\/client_prices.blade.php","line":19,"message":"Attempt to read property \\"price\\" on null","context":{"view":{"view":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/resources\\/views\\/admin\\/products\\/partials\\/client_prices.blade.php","data":{"errors":"<pre class=sf-dump id=sf-dump-622436910 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\ViewErrorBag<\\/span> {<a class=sf-dump-ref>#1999<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">bags<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-622436910\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","categories":"<pre class=sf-dump id=sf-dump-641643761 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Database\\\\Eloquent\\\\Collection<\\/span> {<a class=sf-dump-ref>#2298<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => <span class=sf-dump-note title=\\"App\\\\Models\\\\ProductCategory\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">App\\\\Models<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>ProductCategory<\\/span> {<a class=sf-dump-ref>#2252<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">connection<\\/span>: \\"<span class=sf-dump-str title=\\"5 characters\\">mysql<\\/span>\\"\\n      #<span class=sf-dump-protected title=\\"Protected property\\">table<\\/span>: <span class=sf-dump-const title=\\"Uninitialized property\\">?<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">primaryKey<\\/span>: \\"<span class=sf-dump-str title=\\"2 characters\\">id<\\/span>\\"\\n      #<span class=sf-dump-protected title=\\"Protected property\\">keyType<\\/span>: \\"<span class=sf-dump-str title=\\"3 characters\\">int<\\/span>\\"\\n      +<span class=sf-dump-public title=\\"Public property\\">incrementing<\\/span>: <span class=sf-dump-const>true<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">with<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">withCount<\\/span>: []\\n      +<span class=sf-dump-public title=\\"Public property\\">preventsLazyLoading<\\/span>: <span class=sf-dump-const>false<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">perPage<\\/span>: <span class=sf-dump-num>15<\\/span>\\n      +<span class=sf-dump-public title=\\"Public property\\">exists<\\/span>: <span class=sf-dump-const>true<\\/span>\\n      +<span class=sf-dump-public title=\\"Public property\\">wasRecentlyCreated<\\/span>: <span class=sf-dump-const>false<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">attributes<\\/span>: <span class=sf-dump-note>array:6<\\/span> [ &#8230;6]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">original<\\/span>: <span class=sf-dump-note>array:6<\\/span> [ &#8230;6]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">changes<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">casts<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">classCastCache<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">attributeCastCache<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">dateFormat<\\/span>: <span class=sf-dump-const>null<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">appends<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">dispatchesEvents<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">observables<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">relations<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">touches<\\/span>: []\\n      +<span class=sf-dump-public title=\\"Public property\\">timestamps<\\/span>: <span class=sf-dump-const>true<\\/span>\\n      +<span class=sf-dump-public title=\\"Public property\\">usesUniqueIds<\\/span>: <span class=sf-dump-const>false<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">hidden<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">visible<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">fillable<\\/span>: <span class=sf-dump-note>array:5<\\/span> [ &#8230;5]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">guarded<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      +<span class=sf-dump-public title=\\"Public property\\">table<\\/span>: \\"<span class=sf-dump-str title=\\"18 characters\\">product_categories<\\/span>\\"\\n      #<span class=sf-dump-protected title=\\"Protected property\\">dates<\\/span>: <span class=sf-dump-note>array:3<\\/span> [ &#8230;3]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">forceDeleting<\\/span>: <span class=sf-dump-const>false<\\/span>\\n      +<span class=sf-dump-public title=\\"Public property\\">mediaConversions<\\/span>: []\\n      +<span class=sf-dump-public title=\\"Public property\\">mediaCollections<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">deletePreservingMedia<\\/span>: <span class=sf-dump-const>false<\\/span>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">unAttachedMediaLibraryItems<\\/span>: []\\n    <\\/samp>}\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-641643761\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","clients":"<pre class=sf-dump id=sf-dump-112638540 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#2382<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">Harmons<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-112638540\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","product":"<pre class=sf-dump id=sf-dump-1034587188 data-indent-pad=\\"  \\"><span class=sf-dump-note>App\\\\Models\\\\Product<\\/span> {<a class=sf-dump-ref>#2094<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">connection<\\/span>: \\"<span class=sf-dump-str title=\\"5 characters\\">mysql<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">table<\\/span>: <span class=sf-dump-const title=\\"Uninitialized property\\">?<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">primaryKey<\\/span>: \\"<span class=sf-dump-str title=\\"2 characters\\">id<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">keyType<\\/span>: \\"<span class=sf-dump-str title=\\"3 characters\\">int<\\/span>\\"\\n  +<span class=sf-dump-public title=\\"Public property\\">incrementing<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">with<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">withCount<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">preventsLazyLoading<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">perPage<\\/span>: <span class=sf-dump-num>15<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">exists<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">wasRecentlyCreated<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributes<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">original<\\/span>: <span class=sf-dump-note>array:8<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>id<\\/span>\\" => <span class=sf-dump-num>5<\\/span>\\n    \\"<span class=sf-dump-key>name<\\/span>\\" => \\"<span class=sf-dump-str title=\\"4 characters\\">test<\\/span>\\"\\n    \\"<span class=sf-dump-key>description<\\/span>\\" => \\"<span class=sf-dump-str title=\\"9 characters\\">sdfasdfas<\\/span>\\"\\n    \\"<span class=sf-dump-key>created_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>updated_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"19 characters\\">2024-11-13 01:13:00<\\/span>\\"\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>clients_prices_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n    \\"<span class=sf-dump-key>team_id<\\/span>\\" => <span class=sf-dump-const>null<\\/span>\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">changes<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">casts<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>deleted_at<\\/span>\\" => \\"<span class=sf-dump-str title=\\"8 characters\\">datetime<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">classCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">attributeCastCache<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dateFormat<\\/span>: <span class=sf-dump-const>null<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">appends<\\/span>: <span class=sf-dump-note>array:2<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">photo<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"17 characters\\">additional_photos<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dispatchesEvents<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">observables<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">relations<\\/span>: <span class=sf-dump-note>array:4<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    \\"<span class=sf-dump-key>categories<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#2386<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>tags<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#2375<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: []\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>clientPrices<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#2357<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n    \\"<span class=sf-dump-key>clients<\\/span>\\" => <span class=sf-dump-note title=\\"Illuminate\\\\Database\\\\Eloquent\\\\Collection\\n\\"><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">Illuminate\\\\Database\\\\Eloquent<\\/span><span class=\\"sf-dump-ellipsis sf-dump-ellipsis-note\\">\\\\<\\/span>Collection<\\/span> {<a class=sf-dump-ref>#2592<\\/a><samp data-depth=3 class=sf-dump-compact>\\n      #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [ &#8230;1]\\n      #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n    <\\/samp>}\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">touches<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">timestamps<\\/span>: <span class=sf-dump-const>true<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">usesUniqueIds<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">hidden<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">visible<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">fillable<\\/span>: <span class=sf-dump-note>array:6<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"4 characters\\">name<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"11 characters\\">description<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>3<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>4<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n    <span class=sf-dump-index>5<\\/span> => \\"<span class=sf-dump-str title=\\"7 characters\\">team_id<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">guarded<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str>*<\\/span>\\"\\n  <\\/samp>]\\n  +<span class=sf-dump-public title=\\"Public property\\">table<\\/span>: \\"<span class=sf-dump-str title=\\"8 characters\\">products<\\/span>\\"\\n  #<span class=sf-dump-protected title=\\"Protected property\\">dates<\\/span>: <span class=sf-dump-note>array:3<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-index>0<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">created_at<\\/span>\\"\\n    <span class=sf-dump-index>1<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">updated_at<\\/span>\\"\\n    <span class=sf-dump-index>2<\\/span> => \\"<span class=sf-dump-str title=\\"10 characters\\">deleted_at<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">forceDeleting<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaConversions<\\/span>: []\\n  +<span class=sf-dump-public title=\\"Public property\\">mediaCollections<\\/span>: []\\n  #<span class=sf-dump-protected title=\\"Protected property\\">deletePreservingMedia<\\/span>: <span class=sf-dump-const>false<\\/span>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">unAttachedMediaLibraryItems<\\/span>: []\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-1034587188\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n","tags":"<pre class=sf-dump id=sf-dump-835225301 data-indent-pad=\\"  \\"><span class=sf-dump-note>Illuminate\\\\Support\\\\Collection<\\/span> {<a class=sf-dump-ref>#2400<\\/a><samp data-depth=1 class=sf-dump-expanded>\\n  #<span class=sf-dump-protected title=\\"Protected property\\">items<\\/span>: <span class=sf-dump-note>array:1<\\/span> [<samp data-depth=2 class=sf-dump-compact>\\n    <span class=sf-dump-key>1<\\/span> => \\"<span class=sf-dump-str title=\\"5 characters\\">tesst<\\/span>\\"\\n  <\\/samp>]\\n  #<span class=sf-dump-protected title=\\"Protected property\\">escapeWhenCastingToString<\\/span>: <span class=sf-dump-const>false<\\/span>\\n<\\/samp>}\\n<\\/pre><script>Sfdump(\\"sf-dump-835225301\\", {\\"maxDepth\\":3,\\"maxStringLength\\":160})<\\/script>\\n"}},"userId":1},"trace":{"2":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"3":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"4":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"5":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"6":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"7":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"8":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"9":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/resources\\/views\\/admin\\/products\\/edit.blade.php","line":52},"10":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":123},"11":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Filesystem\\/Filesystem.php","line":124},"12":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/PhpEngine.php","line":58},"13":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Engines\\/CompilerEngine.php","line":72},"14":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":207},"15":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":190},"16":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/View.php","line":159},"17":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":69},"18":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Response.php","line":35},"19":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":918},"20":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":885},"21":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"22":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"23":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/app\\/Http\\/Middleware\\/IsAdmin.php","line":22},"24":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"25":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/app\\/Http\\/Middleware\\/TwoFactorMiddleware.php","line":28},"26":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"27":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/app\\/Http\\/Middleware\\/VerificationMiddleware.php","line":21},"28":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"29":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/app\\/Http\\/Middleware\\/ApprovalMiddleware.php","line":21},"30":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"31":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/app\\/Http\\/Middleware\\/SetLocale.php","line":24},"32":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"33":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/app\\/Http\\/Middleware\\/AuthGates.php","line":32},"34":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"35":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Middleware\\/SubstituteBindings.php","line":50},"36":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"37":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Auth\\/Middleware\\/Authenticate.php","line":57},"38":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"39":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/VerifyCsrfToken.php","line":78},"40":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"41":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/View\\/Middleware\\/ShareErrorsFromSession.php","line":49},"42":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"43":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":121},"44":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Session\\/Middleware\\/StartSession.php","line":64},"45":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"46":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/AddQueuedCookiesToResponse.php","line":37},"47":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"48":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Cookie\\/Middleware\\/EncryptCookies.php","line":67},"49":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"50":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"51":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":805},"52":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":784},"53":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":748},"54":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Routing\\/Router.php","line":737},"55":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":200},"56":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":144},"57":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/barryvdh\\/laravel-debugbar\\/src\\/Middleware\\/InjectDebugbar.php","line":59},"58":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"59":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"60":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ConvertEmptyStringsToNull.php","line":31},"61":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"62":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TransformsRequest.php","line":21},"63":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/TrimStrings.php","line":40},"64":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"65":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/ValidatePostSize.php","line":27},"66":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"67":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Middleware\\/PreventRequestsDuringMaintenance.php","line":99},"68":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"69":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/HandleCors.php","line":49},"70":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"71":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Http\\/Middleware\\/TrustProxies.php","line":39},"72":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":183},"73":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Pipeline\\/Pipeline.php","line":119},"74":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":175},"75":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/vendor\\/laravel\\/framework\\/src\\/Illuminate\\/Foundation\\/Http\\/Kernel.php","line":144},"76":{"file":"\\/home\\/pmwecode\\/ppgrowers.com\\/releases\\/20241121181230\\/public\\/index.php","line":51}},"line_preview":{"10":"    <\\/select>","11":"<\\/div>","12":"","13":"<!-- Client Pricing Fields -->","14":"<div id=\\"client-pricing-fields\\" class=\\"mt-4\\">","15":"    @foreach($product->clients as $client)","16":"        <div class=\\"form-row\\">","17":"            <div class=\\"form-group col-md-2\\">","18":"                <label for=\\"price-{{ $client->id }}\\">Price<\\/label>","19":"                <input type=\\"number\\" name=\\"prices[{{ $client->id }}]\\" id=\\"price-{{ $client->id }}\\" class=\\"form-control\\" value=\\"{{ $client->pivot->price }}\\" placeholder=\\"Enter price\\">","20":"            <\\/div>","21":"            <div class=\\"form-group col-md-2\\">","22":"                <label for=\\"sku-{{ $client->id }}\\">SKU<\\/label>","23":"                <input type=\\"text\\" name=\\"skus[{{ $client->id }}]\\" id=\\"sku-{{ $client->id }}\\" class=\\"form-control\\" value=\\"{{ $client->pivot->sku }}\\" placeholder=\\"Enter SKU\\">","24":"            <\\/div>","25":"            <div class=\\"form-group col-md-2\\">","26":"                <label for=\\"mpn-{{ $client->id }}\\">MPN<\\/label>","27":"                <input type=\\"text\\" name=\\"mpns[{{ $client->id }}]\\" id=\\"mpn-{{ $client->id }}\\" class=\\"form-control\\" value=\\"{{ $client->pivot->mpn }}\\" placeholder=\\"Enter MPN\\">","28":"            <\\/div>","29":"            <div class=\\"form-group col-md-2\\">"},"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"},"occurrences":1}', '2024-11-21 18:14:20'),
	(13, '9d8b3938-eb3d-412a-b5a5-d48a1c7472cb', '9d8b3939-312a-4cbc-86e4-2a9348b58ac8', NULL, 1, 'request', '{"ip_address":"136.36.127.94","uri":"\\/admin\\/products\\/5\\/edit","method":"GET","controller_action":"App\\\\Http\\\\Controllers\\\\Admin\\\\ProductController@edit","middleware":["web","auth","2fa","admin"],"headers":{"content-length":"0","connection":"close","host":"ppgrowers.com","priority":"u=0, i","cookie":"********","accept-language":"en-US,en;q=0.9","accept-encoding":"gzip, deflate, br, zstd","referer":"https:\\/\\/ppgrowers.com\\/admin\\/products","sec-fetch-dest":"document","sec-fetch-user":"?1","sec-fetch-mode":"navigate","sec-fetch-site":"same-origin","accept":"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/avif,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3;q=0.7","user-agent":"Mozilla\\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/131.0.0.0 Safari\\/537.36","upgrade-insecure-requests":"1","sec-ch-ua-platform":"\\"Windows\\"","sec-ch-ua-mobile":"?0","sec-ch-ua":"\\"Google Chrome\\";v=\\"131\\", \\"Chromium\\";v=\\"131\\", \\"Not_A Brand\\";v=\\"24\\"","cache-control":"max-age=0"},"payload":[],"session":{"_token":"********","_flash":{"old":[],"new":[]},"_previous":{"url":"https:\\/\\/ppgrowers.com\\/admin\\/products\\/5\\/edit"},"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":1,"auth":{"password_confirmed_at":1732202576}},"response_status":500,"response":"HTML Response","duration":318,"memory":34,"hostname":"vps59844","user":{"id":1,"name":"Developer","email":"phillip.madsen.21@gmail.com"}}', '2024-11-21 18:14:20');

-- Dumping structure for table 2024_0829.telescope_entries_tags
DROP TABLE IF EXISTS `telescope_entries_tags`;
CREATE TABLE IF NOT EXISTS `telescope_entries_tags` (
  `entry_uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`entry_uuid`,`tag`),
  KEY `telescope_entries_tags_tag_index` (`tag`),
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.telescope_entries_tags: ~8 rows (approximately)
REPLACE INTO `telescope_entries_tags` (`entry_uuid`, `tag`) VALUES
	('9d87c5c0-55f0-45d3-90a2-b0b31b41b7aa', 'Auth:1'),
	('9d87c5c0-71ca-4ce2-b75b-6133b1f08a52', 'Auth:1'),
	('9d8b204a-b14f-4aaa-ad9e-091c6aacd065', 'Auth:1'),
	('9d8b204a-e1d7-40c9-804a-68cd9d8fb83a', 'Auth:1'),
	('9d8b2d48-4348-4960-8683-0639c3fb524f', 'Auth:1'),
	('9d8b2d48-6244-4306-9dd7-4d816072688e', 'Auth:1'),
	('9d8b2d7d-2054-402c-9cc3-c8311fef9309', 'Auth:1'),
	('9d8b2d7d-45c9-439e-a950-11b4922fdf02', 'Auth:1'),
	('9d8b3938-cb4a-4992-a8d9-dcfe94d965c4', 'Auth:1'),
	('9d8b3938-eb3d-412a-b5a5-d48a1c7472cb', 'Auth:1');

-- Dumping structure for table 2024_0829.telescope_monitoring
DROP TABLE IF EXISTS `telescope_monitoring`;
CREATE TABLE IF NOT EXISTS `telescope_monitoring` (
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.telescope_monitoring: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `verified` tinyint(1) DEFAULT '0',
  `verified_at` datetime DEFAULT NULL,
  `verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor` tinyint(1) DEFAULT '0',
  `two_factor_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `team_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `team_fk_9558392` (`team_id`),
  CONSTRAINT `team_fk_9558392` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.users: ~2 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `approved`, `verified`, `verified_at`, `verification_token`, `two_factor`, `two_factor_code`, `remember_token`, `two_factor_expires_at`, `created_at`, `updated_at`, `deleted_at`, `team_id`) VALUES
	(1, 'Developer', 'phillip.madsen.21@gmail.com', NULL, '$2y$10$z.bi4fT/U5ZIPMOszHr9JeaSnn2c/5VbO6gUUnPdzfwjmFvYC0kxO', 1, 1, '2024-03-02 20:52:19', '', 0, '', NULL, NULL, NULL, '2024-08-30 07:52:59', NULL, NULL),
	(2, 'Linda Muir', 'linda@pacificplantgrowers.com', NULL, '$2y$10$QY5vM555jy08vBteNPK61emgcspDKoQbuIQW6j5onput8LlkrOCBK', 1, 1, '2024-08-30 00:56:11', NULL, 0, NULL, 'Z9cOLMT63ypDeA9ZVO4OWLrekZSzrhpETl2YpXpAuyzVHtIFQeUL2GAkLnOJ', NULL, '2024-08-30 07:56:10', '2024-08-30 07:56:11', NULL, NULL),
	(3, 'LfDfslpTPOoFOl', 'sandovalgenam872@gmail.com', NULL, '$2y$10$w/v5b5ImZ.X34z6Ab1j20O1XY.mKhCQknzLLL5mh86dBT4IzriyPi', 0, 0, NULL, 'xFvSkoViFCzpOl5SatZwkTlOaRYufAsPwwEDDy9u7iiCy8UXotFUGuy3U3RDujat', 0, NULL, NULL, NULL, '2024-10-14 12:10:29', '2024-11-20 09:18:08', '2024-11-20 09:18:08', NULL),
	(4, 'SjBurOUdiWqnAU', 'stantanneza@gmail.com', NULL, '$2y$10$kAOF7IoLz2/b2NPNP2ez8uvkoWWM5AnZ8pABdwQ5nC/VvFaVrAw9y', 0, 0, NULL, 'aYpKHLKhSMEFXwb62MvC8q2UqzyIetJ8T4dbiJGXnpT0ytlzyjFAY33H56Gkr0Ag', 0, NULL, NULL, NULL, '2024-10-19 18:18:45', '2024-11-20 09:18:08', '2024-11-20 09:18:08', NULL),
	(5, 'gpNkqGVZk', 'btemperansex48@gmail.com', NULL, '$2y$10$55YUF5CLZXoYt/DZPTm.E.b4IeBZP7/eIOWrjruvd5fjC2dK8pZUy', 0, 0, NULL, 'Q6CTK9FIkFlSCI67vqOGODNyKqZa777BV8Vjsp1wEIwUlgyEpMQx3qlee5SVsZaG', 0, NULL, NULL, NULL, '2024-10-23 22:14:28', '2024-11-20 09:18:08', '2024-11-20 09:18:08', NULL),
	(6, 'ulaBqGNCOpkFNK', 'rydolflambert159@gmail.com', NULL, '$2y$10$f.F9mdgHnanwS01wZOzRj.1f9WxT8MKZ7OTgvrkvN8Y6/rPnr56US', 0, 0, NULL, 'M603nzEDeNoqIk3pi79VGmbVfpEoL4gJ8xoU4kEBejxCnhnR7lcgRbrL4F3zjAnc', 0, NULL, NULL, NULL, '2024-10-27 09:11:54', '2024-11-20 09:18:08', '2024-11-20 09:18:08', NULL);

-- Dumping structure for table 2024_0829.user_alerts
DROP TABLE IF EXISTS `user_alerts`;
CREATE TABLE IF NOT EXISTS `user_alerts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `alert_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alert_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.user_alerts: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.user_user_alert
DROP TABLE IF EXISTS `user_user_alert`;
CREATE TABLE IF NOT EXISTS `user_user_alert` (
  `user_alert_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  KEY `user_alert_id_fk_9558396` (`user_alert_id`),
  KEY `user_id_fk_9558396` (`user_id`),
  CONSTRAINT `user_alert_id_fk_9558396` FOREIGN KEY (`user_alert_id`) REFERENCES `user_alerts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_id_fk_9558396` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.user_user_alert: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
