-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2021 at 08:53 PM
-- Server version: 5.7.36-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portrait`
--
CREATE DATABASE IF NOT EXISTS `portrait` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `portrait`;

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1638032604);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator', NULL, NULL, 1638032604, 1638032604),
('user-management', 2, 'User Management', NULL, NULL, 1638032604, 1638032604);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'user-management');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `background_colors`
--

DROP TABLE IF EXISTS `background_colors`;
CREATE TABLE IF NOT EXISTS `background_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `colour_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `colour_id` (`colour_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `background_colors`
--

INSERT INTO `background_colors` (`id`, `colour_id`) VALUES
(1, 1),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `bg_materials`
--

DROP TABLE IF EXISTS `bg_materials`;
CREATE TABLE IF NOT EXISTS `bg_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Бумага',
  `is_mount` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `bg_materials`
--

INSERT INTO `bg_materials` (`id`, `name`, `is_mount`) VALUES
(1, 'Бумага', 1),
(2, 'Холст с подрамником', 0);

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

DROP TABLE IF EXISTS `colours`;
CREATE TABLE IF NOT EXISTS `colours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Белый',
  `code` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '#fff',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`id`, `name`, `code`) VALUES
(1, 'Белый', '#fff'),
(2, 'Черный', '#000'),
(3, 'Светло-серый', '#ECECEC '),
(4, 'Темно-серый', '#4F4F4F');

-- --------------------------------------------------------

--
-- Table structure for table `count_faces`
--

DROP TABLE IF EXISTS `count_faces`;
CREATE TABLE IF NOT EXISTS `count_faces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` smallint(6) DEFAULT NULL,
  `max` smallint(6) DEFAULT NULL,
  `coefficient` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `count_faces`
--

INSERT INTO `count_faces` (`id`, `min`, `max`, `coefficient`) VALUES
(1, 1, 1, '1.00'),
(2, 2, 2, '1.50'),
(3, 3, 3, '1.80'),
(4, 4, 4, '2.00');

-- --------------------------------------------------------

--
-- Table structure for table `formats`
--

DROP TABLE IF EXISTS `formats`;
CREATE TABLE IF NOT EXISTS `formats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'A4',
  `length` smallint(2) NOT NULL DEFAULT '40',
  `width` smallint(2) NOT NULL DEFAULT '30',
  `max_faces` smallint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `ind-formats-unique` (`length`,`width`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `formats`
--

INSERT INTO `formats` (`id`, `name`, `length`, `width`, `max_faces`) VALUES
(1, 'A4', 30, 21, 2),
(2, 'A3', 40, 30, 4),
(3, 'A2', 50, 40, 4),
(4, 'A1', 70, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `frames`
--

DROP TABLE IF EXISTS `frames`;
CREATE TABLE IF NOT EXISTS `frames` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `colour_id` int(11) NOT NULL DEFAULT '1',
  `format_id` int(11) NOT NULL DEFAULT '1',
  `width` decimal(5,2) NOT NULL DEFAULT '2.00',
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `imageFile` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `fk-frames-colour_id` (`colour_id`),
  KEY `fk-frames-format_id` (`format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `frames`
--

INSERT INTO `frames` (`id`, `colour_id`, `format_id`, `width`, `name`, `imageFile`) VALUES
(1, 1, 1, '1.50', 'Белая A4', '1.png'),
(2, 2, 1, '1.50', 'Черная A4', '2.png'),
(3, 1, 2, '1.50', 'Белая A3', '3.png'),
(4, 2, 2, '1.50', 'Черная A3', '4.png'),
(5, 1, 3, '1.50', 'Белая A2', '5.png'),
(6, 2, 3, '1.50', 'Черная A2', '6.png'),
(7, 1, 4, '1.50', 'Белая A1', '7.png'),
(8, 2, 4, '1.50', 'Черная A1', '8.png');

-- --------------------------------------------------------

--
-- Table structure for table `frame_mount_images`
--

DROP TABLE IF EXISTS `frame_mount_images`;
CREATE TABLE IF NOT EXISTS `frame_mount_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mount_id` int(11) NOT NULL DEFAULT '1',
  `frame_id` int(11) NOT NULL DEFAULT '1',
  `imageFile` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind-frame_mount_images-unique` (`mount_id`,`frame_id`),
  KEY `fk-frame_mount_images-frame_id` (`frame_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `frame_mount_images`
--

INSERT INTO `frame_mount_images` (`id`, `mount_id`, `frame_id`, `imageFile`) VALUES
(1, 1, 3, '3_1.png'),
(2, 1, 4, '4_1.png'),
(3, 2, 4, '4_2.png'),
(4, 3, 5, '5_3.png'),
(5, 3, 6, '6_3.png'),
(6, 4, 6, '6_4.png'),
(7, 5, 7, '7_5.png'),
(8, 5, 8, '8_5.png'),
(9, 6, 8, '8_6.png');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_bin NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('Da\\User\\Migration\\m000000_000001_create_user_table', 1638032583),
('Da\\User\\Migration\\m000000_000002_create_profile_table', 1638032583),
('Da\\User\\Migration\\m000000_000003_create_social_account_table', 1638032583),
('Da\\User\\Migration\\m000000_000004_create_token_table', 1638032583),
('Da\\User\\Migration\\m000000_000005_add_last_login_at', 1638032583),
('Da\\User\\Migration\\m000000_000006_add_two_factor_fields', 1638032583),
('Da\\User\\Migration\\m000000_000007_enable_password_expiration', 1638032583),
('Da\\User\\Migration\\m000000_000008_add_last_login_ip', 1638032583),
('Da\\User\\Migration\\m000000_000009_add_gdpr_consent_fields', 1638032584),
('m000000_000000_base', 1638032581),
('m140506_102106_rbac_init', 1638032594),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1638032594),
('m180523_151638_rbac_updates_indexes_without_prefix', 1638032594),
('m200409_110543_rbac_update_mssql_trigger', 1638032594),
('m211108_121706_create_formats_table', 1638032584),
('m211108_122916_create_frames_table', 1638032584),
('m211108_132404_create_mounts_table', 1638032584),
('m211108_134457_create_types_table', 1638032584),
('m211114_182855_add_admin_user', 1638032604),
('m211123_100125_create_count_faces_table', 1638032604),
('m211123_194014_create_orders_table', 1638032604);

-- --------------------------------------------------------

--
-- Table structure for table `mounts`
--

DROP TABLE IF EXISTS `mounts`;
CREATE TABLE IF NOT EXISTS `mounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `colour_id` int(11) NOT NULL DEFAULT '1',
  `portrait_format_id` int(11) NOT NULL DEFAULT '1',
  `frame_format_id` int(11) NOT NULL DEFAULT '1',
  `add_length` decimal(5,2) NOT NULL DEFAULT '1.00',
  `add_width` decimal(5,2) NOT NULL DEFAULT '1.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ind-mounts-unique` (`colour_id`,`portrait_format_id`,`frame_format_id`),
  KEY `fk-mounts-format_id` (`portrait_format_id`),
  KEY `fk-mounts-frame_format_id` (`frame_format_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mounts`
--

INSERT INTO `mounts` (`id`, `colour_id`, `portrait_format_id`, `frame_format_id`, `add_length`, `add_width`) VALUES
(1, 1, 1, 2, '5.00', '4.50'),
(2, 2, 1, 2, '5.00', '4.50'),
(3, 1, 2, 3, '5.00', '5.00'),
(4, 2, 2, 3, '5.00', '5.00'),
(5, 1, 3, 4, '10.00', '5.00'),
(6, 2, 3, 4, '10.00', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portrait_type_id` int(11) NOT NULL DEFAULT '1',
  `format_id` int(11) NOT NULL DEFAULT '1',
  `material_id` int(11) NOT NULL DEFAULT '1',
  `base_id` int(11) NOT NULL DEFAULT '1',
  `frame_id` int(11) DEFAULT NULL,
  `faces_count` smallint(2) NOT NULL DEFAULT '1',
  `mount_id` int(11) DEFAULT NULL,
  `background_color_id` int(11) NOT NULL DEFAULT '1',
  `imageFile` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'ru',
  PRIMARY KEY (`id`),
  KEY `fk-orders-background_color_id` (`background_color_id`),
  KEY `fk-orders-mount_id` (`mount_id`),
  KEY `fk-orders-frame_id` (`frame_id`),
  KEY `fk-orders-base_id` (`base_id`),
  KEY `fk-orders-material_id` (`material_id`),
  KEY `fk-orders-portrait_type_id` (`portrait_type_id`),
  KEY `fk-orders-format_id` (`format_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `paint_materials`
--

DROP TABLE IF EXISTS `paint_materials`;
CREATE TABLE IF NOT EXISTS `paint_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Карандаш',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `paint_materials`
--

INSERT INTO `paint_materials` (`id`, `name`) VALUES
(1, 'Карандаш'),
(2, 'Масло');

-- --------------------------------------------------------

--
-- Table structure for table `portrait_types`
--

DROP TABLE IF EXISTS `portrait_types`;
CREATE TABLE IF NOT EXISTS `portrait_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Портрет',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `portrait_types`
--

INSERT INTO `portrait_types` (`id`, `name`) VALUES
(1, 'Гиперреализм'),
(3, 'Набросок'),
(2, 'Фотореализм');

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bg_material_id` int(11) NOT NULL DEFAULT '1',
  `paint_material_id` int(11) NOT NULL DEFAULT '1',
  `portrait_type_id` int(11) NOT NULL DEFAULT '1',
  `format_id` int(11) NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_usd` decimal(10,0) NOT NULL DEFAULT '0',
  `price_eur` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index-prices-unique` (`bg_material_id`,`paint_material_id`,`portrait_type_id`,`format_id`),
  KEY `fk-prices-format_id` (`format_id`),
  KEY `fk-prices-portrait_type_id` (`portrait_type_id`),
  KEY `fk-prices-paint_material_id` (`paint_material_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `bg_material_id`, `paint_material_id`, `portrait_type_id`, `format_id`, `price`, `price_usd`, `price_eur`) VALUES
(1, 1, 2, 1, 1, '30000.00', '430', '380'),
(2, 1, 2, 1, 2, '40000.00', '600', '540'),
(3, 1, 2, 1, 3, '60000.00', '910', '810'),
(4, 2, 2, 1, 1, '33000.00', '480', '430'),
(5, 2, 2, 1, 2, '47000.00', '670', '600'),
(6, 2, 2, 1, 3, '70000.00', '1000', '900'),
(7, 1, 1, 1, 1, '16000.00', '240', '210'),
(8, 1, 1, 1, 2, '20000.00', '340', '300'),
(9, 1, 1, 1, 3, '30000.00', '510', '460'),
(10, 1, 2, 2, 1, '18000.00', '270', '240'),
(11, 1, 2, 2, 2, '25000.00', '380', '340'),
(12, 1, 2, 2, 3, '38000.00', '570', '510'),
(13, 2, 2, 2, 1, '21000.00', '300', '270'),
(14, 2, 2, 2, 2, '29000.00', '420', '370'),
(15, 2, 2, 2, 3, '44000.00', '630', '560'),
(16, 1, 1, 2, 1, '10000.00', '150', '130'),
(17, 1, 1, 2, 2, '15000.00', '210', '190'),
(18, 1, 1, 2, 3, '22000.00', '320', '290'),
(19, 1, 2, 3, 1, '10000.00', '130', '120'),
(20, 1, 2, 3, 2, '14000.00', '180', '160'),
(21, 1, 1, 3, 1, '5000.00', '70', '60'),
(22, 1, 1, 3, 2, '7000.00', '100', '90');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `timezone`, `bio`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_social_account_provider_client_id` (`provider`,`client_id`),
  UNIQUE KEY `idx_social_account_code` (`code`),
  KEY `fk_social_account_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `created_at` int(11) NOT NULL,
  UNIQUE KEY `idx_token_user_id_code_type` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `confirmed_at` int(11) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  `last_login_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_tf_key` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_tf_enabled` tinyint(1) DEFAULT '0',
  `password_changed_at` int(11) DEFAULT NULL,
  `gdpr_consent` tinyint(1) DEFAULT '0',
  `gdpr_consent_date` int(11) DEFAULT NULL,
  `gdpr_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_user_username` (`username`),
  UNIQUE KEY `idx_user_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `unconfirmed_email`, `registration_ip`, `flags`, `confirmed_at`, `blocked_at`, `updated_at`, `created_at`, `last_login_at`, `last_login_ip`, `auth_tf_key`, `auth_tf_enabled`, `password_changed_at`, `gdpr_consent`, `gdpr_consent_date`, `gdpr_deleted`) VALUES
(1, 'admin', 'email@example.com', '$2y$10$50ko5EW89GIjSAEh.u.SZ.G35NPXEIUnzx6zqgGTq9MxnUE9ivGVy', '9TVSj-Dnrz4HV1CEYhhYY9F-t4ywsIk-', NULL, NULL, 0, 1638032604, NULL, 1638032604, 1638032604, NULL, NULL, '', 0, 1638032604, 0, NULL, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `background_colors`
--
ALTER TABLE `background_colors`
  ADD CONSTRAINT `fk-background_colors-colour_id` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`);

--
-- Constraints for table `frames`
--
ALTER TABLE `frames`
  ADD CONSTRAINT `fk-frames-colour_id` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`),
  ADD CONSTRAINT `fk-frames-format_id` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`);

--
-- Constraints for table `frame_mount_images`
--
ALTER TABLE `frame_mount_images`
  ADD CONSTRAINT `fk-frame_mount_images-frame_id` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`),
  ADD CONSTRAINT `fk-frame_mount_images-mount_id` FOREIGN KEY (`mount_id`) REFERENCES `mounts` (`id`);

--
-- Constraints for table `mounts`
--
ALTER TABLE `mounts`
  ADD CONSTRAINT `fk-mounts-colour_id` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`),
  ADD CONSTRAINT `fk-mounts-format_id` FOREIGN KEY (`portrait_format_id`) REFERENCES `formats` (`id`),
  ADD CONSTRAINT `fk-mounts-frame_format_id` FOREIGN KEY (`frame_format_id`) REFERENCES `formats` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk-orders-background_color_id` FOREIGN KEY (`background_color_id`) REFERENCES `background_colors` (`id`),
  ADD CONSTRAINT `fk-orders-base_id` FOREIGN KEY (`base_id`) REFERENCES `bg_materials` (`id`),
  ADD CONSTRAINT `fk-orders-format_id` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`),
  ADD CONSTRAINT `fk-orders-frame_id` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`),
  ADD CONSTRAINT `fk-orders-material_id` FOREIGN KEY (`material_id`) REFERENCES `paint_materials` (`id`),
  ADD CONSTRAINT `fk-orders-mount_id` FOREIGN KEY (`mount_id`) REFERENCES `mounts` (`id`),
  ADD CONSTRAINT `fk-orders-portrait_type_id` FOREIGN KEY (`portrait_type_id`) REFERENCES `portrait_types` (`id`);

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `fk-prices-bg_material_id` FOREIGN KEY (`bg_material_id`) REFERENCES `bg_materials` (`id`),
  ADD CONSTRAINT `fk-prices-format_id` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`),
  ADD CONSTRAINT `fk-prices-paint_material_id` FOREIGN KEY (`paint_material_id`) REFERENCES `paint_materials` (`id`),
  ADD CONSTRAINT `fk-prices-portrait_type_id` FOREIGN KEY (`portrait_type_id`) REFERENCES `portrait_types` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_social_account_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
