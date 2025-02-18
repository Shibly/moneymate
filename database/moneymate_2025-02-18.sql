# ************************************************************
# Sequel Ace SQL dump
# Version 20085
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: localhost (MySQL 5.7.39)
# Database: moneymate
# Generation Time: 2025-02-18 16:31:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table account_transfers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_transfers`;

CREATE TABLE `account_transfers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `from_account_id` bigint(20) unsigned NOT NULL,
  `to_account_id` bigint(20) unsigned NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `exchange_amount` decimal(65,2) NOT NULL DEFAULT '0.00',
  `usd_amount` decimal(65,5) NOT NULL DEFAULT '0.00000',
  `transfer_date` date NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_transfers_user_id_foreign` (`user_id`),
  KEY `account_transfers_from_account_id_foreign` (`from_account_id`),
  KEY `account_transfers_to_account_id_foreign` (`to_account_id`),
  CONSTRAINT `account_transfers_from_account_id_foreign` FOREIGN KEY (`from_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `account_transfers_to_account_id_foreign` FOREIGN KEY (`to_account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `account_transfers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table bank_accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bank_accounts`;

CREATE TABLE `bank_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `bank_name_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(65,2) NOT NULL,
  `usd_balance` decimal(65,5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_accounts_user_id_foreign` (`user_id`),
  KEY `bank_accounts_bank_name_id_foreign` (`bank_name_id`),
  CONSTRAINT `bank_accounts_bank_name_id_foreign` FOREIGN KEY (`bank_name_id`) REFERENCES `bank_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bank_accounts` WRITE;
/*!40000 ALTER TABLE `bank_accounts` DISABLE KEYS */;

INSERT INTO `bank_accounts` (`id`, `user_id`, `bank_name_id`, `currency_id`, `account_name`, `account_number`, `balance`, `usd_balance`, `created_at`, `updated_at`)
VALUES
	(12,1,8,4,'Mahmudur Rahman','72347263432874',10000.00,82.30453,'2025-02-18 13:47:25','2025-02-18 13:58:50');

/*!40000 ALTER TABLE `bank_accounts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bank_names
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bank_names`;

CREATE TABLE `bank_names` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_names_user_id_foreign` (`user_id`),
  CONSTRAINT `bank_names_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `bank_names` WRITE;
/*!40000 ALTER TABLE `bank_names` DISABLE KEYS */;

INSERT INTO `bank_names` (`id`, `user_id`, `bank_name`, `created_at`, `updated_at`)
VALUES
	(1,1,'Al Arafa Bank','2025-02-16 15:46:45','2025-02-16 18:12:08'),
	(6,1,'Rupali Bank','2025-02-16 18:21:01','2025-02-16 18:21:01'),
	(8,1,'Jamuna Bank','2025-02-16 21:15:19','2025-02-16 21:15:34');

/*!40000 ALTER TABLE `bank_names` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table borrows
# ------------------------------------------------------------

DROP TABLE IF EXISTS `borrows`;

CREATE TABLE `borrows` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(65,2) NOT NULL,
  `exchange_amount` decimal(65,2) NOT NULL DEFAULT '0.00',
  `usd_amount` decimal(65,5) NOT NULL DEFAULT '0.00000',
  `date` date DEFAULT NULL,
  `debt_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `borrows_debt_id_foreign` (`debt_id`),
  KEY `borrows_account_id_foreign` (`account_id`),
  CONSTRAINT `borrows_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `borrows_debt_id_foreign` FOREIGN KEY (`debt_id`) REFERENCES `debts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table budget_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `budget_category`;

CREATE TABLE `budget_category` (
  `budget_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`budget_id`,`category_id`),
  KEY `budget_category_category_id_foreign` (`category_id`),
  CONSTRAINT `budget_category_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `budget_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table budget_expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `budget_expenses`;

CREATE TABLE `budget_expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `budget_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `expense_id` bigint(20) DEFAULT NULL,
  `amount` decimal(65,2) NOT NULL,
  `usd_amount` decimal(65,5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `budget_expenses_user_id_foreign` (`user_id`),
  KEY `budget_expenses_budget_id_foreign` (`budget_id`),
  KEY `budget_expenses_category_id_foreign` (`category_id`),
  CONSTRAINT `budget_expenses_budget_id_foreign` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `budget_expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `budget_expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table budgets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `budgets`;

CREATE TABLE `budgets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `budget_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `amount` decimal(65,2) NOT NULL,
  `updated_amount` decimal(65,2) DEFAULT NULL,
  `usd_amount` decimal(65,5) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `budgets_user_id_foreign` (`user_id`),
  CONSTRAINT `budgets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cache
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table cache_locks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('income','expense') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_user_id_foreign` (`user_id`),
  CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `user_id`, `name`, `type`, `created_at`, `updated_at`)
VALUES
	(1,1,'Monthly Income','income','2025-02-16 07:48:05','2025-02-16 07:48:05'),
	(3,1,'Electricity Bill','expense','2025-02-16 07:48:24','2025-02-16 07:48:24'),
	(5,1,'Internet Bill','expense','2025-02-16 07:49:06','2025-02-16 07:49:06'),
	(8,1,'Pocket Money','expense','2025-02-16 07:49:52','2025-02-16 07:49:52'),
	(9,1,'Medicine','expense','2025-02-16 07:50:16','2025-02-16 07:50:16'),
	(13,1,'House Rent','expense','2025-02-16 23:40:02','2025-02-16 23:40:02'),
	(14,1,'Transport','expense','2025-02-16 23:40:11','2025-02-16 23:40:11'),
	(15,1,'Online Income','income','2025-02-17 18:36:10','2025-02-17 18:36:10'),
	(16,1,'DPS','income','2025-02-17 18:36:17','2025-02-17 18:36:17');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table currencies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `currencies`;

CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_default` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'yes, no',
  `is_base` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'yes, no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;

INSERT INTO `currencies` (`id`, `name`, `exchange_rate`, `is_default`, `is_base`, `created_at`, `updated_at`)
VALUES
	(3,'USD',1.00,'no','yes','2025-02-16 09:02:20','2025-02-17 18:52:42'),
	(4,'BDT',121.50,'yes','no','2025-02-16 14:10:11','2025-02-17 18:52:42'),
	(5,'INR',80.00,'no','no','2025-02-16 14:10:21','2025-02-16 14:10:21');

/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table debt_collections
# ------------------------------------------------------------

DROP TABLE IF EXISTS `debt_collections`;

CREATE TABLE `debt_collections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `exchange_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date` date DEFAULT NULL,
  `debt_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `debt_collections_debt_id_foreign` (`debt_id`),
  KEY `debt_collections_account_id_foreign` (`account_id`),
  CONSTRAINT `debt_collections_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `debt_collections_debt_id_foreign` FOREIGN KEY (`debt_id`) REFERENCES `debts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table debts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `debts`;

CREATE TABLE `debts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `type` enum('lend','repayment','borrow','debt-collection') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `exchange_amount` decimal(65,2) NOT NULL DEFAULT '0.00',
  `usd_amount` decimal(65,5) NOT NULL DEFAULT '0.00000',
  `person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `debts_user_id_foreign` (`user_id`),
  KEY `debts_account_id_foreign` (`account_id`),
  CONSTRAINT `debts_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `debts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `amount` decimal(65,2) NOT NULL,
  `reference` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `attachment` mediumtext COLLATE utf8mb4_unicode_ci,
  `exchange_amount` decimal(65,2) NOT NULL DEFAULT '0.00',
  `usd_amount` decimal(65,5) NOT NULL DEFAULT '0.00000',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  KEY `expenses_account_id_foreign` (`account_id`),
  KEY `expenses_category_id_foreign` (`category_id`),
  CONSTRAINT `expenses_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expenses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table incomes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `incomes`;

CREATE TABLE `incomes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `reference` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income_date` date NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci,
  `attachment` mediumtext COLLATE utf8mb4_unicode_ci,
  `exchange_amount` decimal(65,2) DEFAULT '0.00',
  `usd_amount` decimal(65,5) DEFAULT '0.00000',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incomes_user_id_foreign` (`user_id`),
  KEY `incomes_account_id_foreign` (`account_id`),
  KEY `incomes_category_id_foreign` (`category_id`),
  CONSTRAINT `incomes_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `incomes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `incomes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table job_batches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table lends
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lends`;

CREATE TABLE `lends` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `exchange_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `usd_amount` decimal(65,5) NOT NULL DEFAULT '0.00000',
  `date` date DEFAULT NULL,
  `debt_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lends_debt_id_foreign` (`debt_id`),
  KEY `lends_account_id_foreign` (`account_id`),
  CONSTRAINT `lends_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lends_debt_id_foreign` FOREIGN KEY (`debt_id`) REFERENCES `debts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'0001_01_01_000000_create_users_table',1),
	(2,'0001_01_01_000001_create_cache_table',1),
	(3,'0001_01_01_000002_create_jobs_table',1),
	(4,'2023_05_09_165554_create_bank_names_table',1),
	(5,'2023_05_10_013504_create_categories_table',1),
	(6,'2023_05_10_093447_create_bank_accounts_table',1),
	(7,'2023_05_10_093453_create_incomes_table',1),
	(8,'2023_05_10_093458_create_expenses_table',1),
	(9,'2023_05_10_093508_add_user_id_to_tables',1),
	(10,'2023_05_12_213817_add_profile_pictire_to_users_table',1),
	(11,'2023_05_16_100804_add_additional_fields_to_incomes_table',1),
	(12,'2023_05_17_101320_create_options_table',1),
	(13,'2023_05_20_153108_create_budget_table',1),
	(14,'2023_05_20_153322_budget_category',1),
	(15,'2023_05_21_012355_add_user_id_to_budgets',1),
	(16,'2023_05_21_015617_create_budget_expenses_table',1),
	(17,'2023_05_21_090112_add_additional_columns_to_expenses_table',1),
	(18,'2023_05_26_133931_create_wallets_table',1),
	(19,'2023_05_27_161852_create_debts_table',1),
	(20,'2023_05_27_163118_create_lends_table',1),
	(21,'2023_05_27_163135_create_repayments_table',1),
	(22,'2023_05_27_163144_create_borrows_table',1),
	(23,'2023_05_27_163157_create_debt_collections_table',1),
	(24,'2023_06_07_190243_add_column_to_borrows_table',1),
	(25,'2023_06_07_190300_add_column_to_lends_table',1),
	(26,'2023_06_09_123346_add_account_id_to_repayments_table',1),
	(27,'2023_06_09_123417_add_account_id_to_debt_collections_table',1),
	(28,'2023_06_09_185224_create_account_transfer_table',1),
	(29,'2023_10_30_044934_create_currencies_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_reset_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table repayments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `repayments`;

CREATE TABLE `repayments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(65,2) NOT NULL,
  `exchange_amount` decimal(65,2) NOT NULL DEFAULT '0.00',
  `usd_amount` decimal(65,5) NOT NULL DEFAULT '0.00000',
  `date` date DEFAULT NULL,
  `debt_id` bigint(20) unsigned NOT NULL,
  `account_id` bigint(20) unsigned NOT NULL,
  `currency_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `repayments_debt_id_foreign` (`debt_id`),
  KEY `repayments_account_id_foreign` (`account_id`),
  CONSTRAINT `repayments_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `bank_accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `repayments_debt_id_foreign` FOREIGN KEY (`debt_id`) REFERENCES `debts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `profile_picture`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Shibly','shibly.phy@gmail.com',NULL,NULL,'$2y$12$J/ZfAkHFIgqy61Y4oOGb8OwhtfktK3sOKcZwEjWSwYmGDuPcJxiI.',NULL,'2025-02-13 18:36:45','2025-02-13 18:36:45');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wallets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wallets`;

CREATE TABLE `wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`),
  CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
