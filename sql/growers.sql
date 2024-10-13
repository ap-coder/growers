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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.audit_logs: ~0 rows (approximately)

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.clients: ~0 rows (approximately)

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
  PRIMARY KEY (`id`),
  KEY `client_fk_10111999` (`client_id`),
  KEY `team_fk_9986806` (`team_id`),
  CONSTRAINT `client_fk_10111999` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `team_fk_9986806` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.client_prices: ~0 rows (approximately)

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.media: ~0 rows (approximately)

-- Dumping structure for table 2024_0829.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
	(48, '2024_09_10_000046_create_qa_messages_table', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.products: ~0 rows (approximately)

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.product_categories: ~0 rows (approximately)

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.product_tags: ~0 rows (approximately)

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table 2024_0829.users: ~2 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `approved`, `verified`, `verified_at`, `verification_token`, `two_factor`, `two_factor_code`, `remember_token`, `two_factor_expires_at`, `created_at`, `updated_at`, `deleted_at`, `team_id`) VALUES
	(1, 'Developer', 'phillip.madsen.21@gmail.com', '2024-09-10 18:26:50', '$2y$10$z.bi4fT/U5ZIPMOszHr9JeaSnn2c/5VbO6gUUnPdzfwjmFvYC0kxO', 1, 1, '2024-03-02 20:52:19', '', 0, '', NULL, NULL, '2024-08-30 07:56:10', '2024-08-30 07:52:59', NULL, NULL),
	(2, 'Linda Muir', 'linda@pacificplantgrowers.com', '2024-09-10 18:26:53', '$2y$10$QY5vM555jy08vBteNPK61emgcspDKoQbuIQW6j5onput8LlkrOCBK', 1, 1, '2024-08-30 00:56:11', NULL, 0, NULL, NULL, NULL, '2024-08-30 07:56:10', '2024-08-30 07:56:11', NULL, NULL);

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
