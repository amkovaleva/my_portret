-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 07 2022 г., 13:21
-- Версия сервера: 5.7.36-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `f0694443_portrait`
--

-- --------------------------------------------------------

--
-- Структура таблицы `addons`
--

DROP TABLE IF EXISTS `addons`;
CREATE TABLE `addons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `name_en` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_usd` decimal(10,0) NOT NULL DEFAULT '0',
  `price_eur` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `addons`
--

INSERT INTO `addons` (`id`, `name`, `name_en`, `price`, `price_usd`, `price_eur`) VALUES
(1, 'Видео процесса рисования', 'Drawing Process Video', '150.00', '150', '150'),
(2, 'Анимация из сканов портрета', 'Scanned Drawing Animation', '50.00', '50', '50'),
(3, 'Высокого качества скан портрета', 'High Quality Scanned Drawing', '20.00', '20', '20');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1638292796);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Administrator', NULL, NULL, 1638292795, 1638292795),
('user-management', 2, 'User Management', NULL, NULL, 1638292795, 1638292795);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'user-management');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `background_colors`
--

DROP TABLE IF EXISTS `background_colors`;
CREATE TABLE `background_colors` (
  `id` int(11) NOT NULL,
  `colour_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `background_colors`
--

INSERT INTO `background_colors` (`id`, `colour_id`) VALUES
(1, 1),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `bg_materials`
--

DROP TABLE IF EXISTS `bg_materials`;
CREATE TABLE `bg_materials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Бумага',
  `is_mount` tinyint(1) NOT NULL DEFAULT '1',
  `name_en` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Paper'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `bg_materials`
--

INSERT INTO `bg_materials` (`id`, `name`, `is_mount`, `name_en`) VALUES
(1, 'Бумага', 1, 'Paper'),
(2, 'Холст', 0, 'Canvas');

-- --------------------------------------------------------

--
-- Структура таблицы `cancel_reasons`
--

DROP TABLE IF EXISTS `cancel_reasons`;
CREATE TABLE `cancel_reasons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` text COLLATE utf8_bin NOT NULL,
  `description_en` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `cancel_reasons`
--

INSERT INTO `cancel_reasons` (`id`, `name`, `description`, `description_en`) VALUES
(1, 'Плохое фото', 'Вы прислали фото недостаточно хорошего качества', 'You send photo with not good enough quality');

-- --------------------------------------------------------

--
-- Структура таблицы `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
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
  `user_cookie` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `colours`
--

DROP TABLE IF EXISTS `colours`;
CREATE TABLE `colours` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Белый',
  `code` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '#fff',
  `name_en` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'White'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `colours`
--

INSERT INTO `colours` (`id`, `name`, `code`, `name_en`) VALUES
(1, 'Белый', '#fff', 'White'),
(2, 'Черный', '#000', 'Black'),
(3, 'Серый', '#ABACAC', 'Gray'),
(4, 'Темно-серый', '#3A3939', 'Dark grey'),
(5, 'ert', 'rrr', 'Whiteh');

-- --------------------------------------------------------

--
-- Структура таблицы `count_faces`
--

DROP TABLE IF EXISTS `count_faces`;
CREATE TABLE `count_faces` (
  `id` int(11) NOT NULL,
  `min` smallint(6) DEFAULT NULL,
  `max` smallint(6) DEFAULT NULL,
  `coefficient` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `count_faces`
--

INSERT INTO `count_faces` (`id`, `min`, `max`, `coefficient`) VALUES
(1, 1, 1, '1.00'),
(2, 2, 2, '1.50'),
(3, 3, 3, '1.80'),
(4, 4, 4, '2.00');

-- --------------------------------------------------------

--
-- Структура таблицы `delivery_types`
--

DROP TABLE IF EXISTS `delivery_types`;
CREATE TABLE `delivery_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `name_en` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `for_ru` tinyint(1) DEFAULT '1',
  `for_not_ru` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `delivery_types`
--

INSERT INTO `delivery_types` (`id`, `name`, `name_en`, `for_ru`, `for_not_ru`) VALUES
(1, 'Почта России', 'Russia mail', 1, 1),
(2, 'SDEC', 'SDEC', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `formats`
--

DROP TABLE IF EXISTS `formats`;
CREATE TABLE `formats` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'A4',
  `length` smallint(2) NOT NULL DEFAULT '40',
  `width` smallint(2) NOT NULL DEFAULT '30',
  `max_faces` smallint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `formats`
--

INSERT INTO `formats` (`id`, `name`, `length`, `width`, `max_faces`) VALUES
(1, 'A4', 30, 21, 2),
(2, 'A3', 40, 30, 4),
(3, 'A2', 50, 40, 4),
(4, 'A1', 70, 50, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `frames`
--

DROP TABLE IF EXISTS `frames`;
CREATE TABLE `frames` (
  `id` int(11) NOT NULL,
  `colour_id` int(11) NOT NULL DEFAULT '1',
  `format_id` int(11) NOT NULL DEFAULT '1',
  `width` decimal(5,2) NOT NULL DEFAULT '2.00',
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `imageFile` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `frames`
--

INSERT INTO `frames` (`id`, `colour_id`, `format_id`, `width`, `name`, `imageFile`) VALUES
(1, 1, 1, '1.50', 'Белая A4', '1.svg'),
(2, 2, 1, '1.50', 'Черная A4', '2.svg'),
(3, 1, 2, '1.50', 'Белая A3', '3.svg'),
(4, 2, 2, '1.50', 'Черная A3', '4.svg'),
(5, 1, 3, '1.50', 'Белая A2', '5.svg'),
(6, 2, 3, '1.50', 'Черная A2', '6.svg'),
(7, 1, 4, '1.50', 'Белая A1', '7.svg'),
(8, 2, 4, '1.50', 'Черная A1', '8.svg');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_bin NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('Da\\User\\Migration\\m000000_000001_create_user_table', 1638292781),
('Da\\User\\Migration\\m000000_000002_create_profile_table', 1638292781),
('Da\\User\\Migration\\m000000_000003_create_social_account_table', 1638292781),
('Da\\User\\Migration\\m000000_000004_create_token_table', 1638292781),
('Da\\User\\Migration\\m000000_000005_add_last_login_at', 1638292781),
('Da\\User\\Migration\\m000000_000006_add_two_factor_fields', 1638292781),
('Da\\User\\Migration\\m000000_000007_enable_password_expiration', 1638292781),
('Da\\User\\Migration\\m000000_000008_add_last_login_ip', 1638292781),
('Da\\User\\Migration\\m000000_000009_add_gdpr_consent_fields', 1638292781),
('m000000_000000_base', 1638292779),
('m140506_102106_rbac_init', 1638292789),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1638292789),
('m180523_151638_rbac_updates_indexes_without_prefix', 1638292789),
('m200409_110543_rbac_update_mssql_trigger', 1638292789),
('m211108_121706_create_formats_table', 1638292781),
('m211108_122916_create_frames_table', 1638292781),
('m211108_132404_create_mounts_table', 1638292782),
('m211108_134457_create_types_table', 1638292782),
('m211114_182855_add_admin_user', 1638292796),
('m211123_100125_create_count_faces_table', 1638292796),
('m211123_194014_create_cart_items_table', 1638292796),
('m211211_090933_change_mount_table', 1639215504),
('m211213_173146_change_order_table', 1640112329),
('m211221_143200_add_translation_to_tables', 1640112329),
('m220705_134209_create_addons_table', 1657030501),
('m220707_060650_create_order_addons_table', 1657182310);

-- --------------------------------------------------------

--
-- Структура таблицы `mounts`
--

DROP TABLE IF EXISTS `mounts`;
CREATE TABLE `mounts` (
  `id` int(11) NOT NULL,
  `frame_id` int(11) NOT NULL DEFAULT '1',
  `imageFile` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `portrait_format_id` int(11) NOT NULL,
  `colour_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `mounts`
--

INSERT INTO `mounts` (`id`, `frame_id`, `imageFile`, `portrait_format_id`, `colour_id`) VALUES
(1, 3, '1.svg', 1, 1),
(2, 4, '2.svg', 1, 1),
(3, 4, '3.svg', 1, 2),
(4, 5, '4.svg', 2, 1),
(5, 6, '5.svg', 2, 1),
(6, 6, '6.svg', 2, 2),
(7, 7, '7.svg', 3, 1),
(8, 8, '8.svg', 3, 1),
(9, 8, '9.svg', 3, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `pay_type_id` int(11) NOT NULL DEFAULT '1',
  `delivery_type_id` int(11) NOT NULL DEFAULT '1',
  `state` int(11) NOT NULL DEFAULT '1',
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `index` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `country` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `user_comment` text COLLATE utf8_bin,
  `track_info` text COLLATE utf8_bin,
  `cancel_reason_id` int(11) DEFAULT NULL,
  `shop_comment` text COLLATE utf8_bin,
  `feedback` text COLLATE utf8_bin,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `house` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `apartment` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cart_item_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `order_addons`
--

DROP TABLE IF EXISTS `order_addons`;
CREATE TABLE `order_addons` (
  `id` int(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL DEFAULT '0',
  `addon_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `paint_materials`
--

DROP TABLE IF EXISTS `paint_materials`;
CREATE TABLE `paint_materials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Карандаш',
  `name_en` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Pencil'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `paint_materials`
--

INSERT INTO `paint_materials` (`id`, `name`, `name_en`) VALUES
(1, 'Карандаш', 'Pencil'),
(2, 'Масло', 'Oil');

-- --------------------------------------------------------

--
-- Структура таблицы `pay_types`
--

DROP TABLE IF EXISTS `pay_types`;
CREATE TABLE `pay_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `name_en` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` text COLLATE utf8_bin NOT NULL,
  `description_en` text COLLATE utf8_bin NOT NULL,
  `for_ru` tinyint(1) DEFAULT '1',
  `for_not_ru` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `pay_types`
--

INSERT INTO `pay_types` (`id`, `name`, `name_en`, `description`, `description_en`, `for_ru`, `for_not_ru`) VALUES
(1, 'Карта Сбербанк', 'Sberbank card', 'Для оплаты переведите деньги на карту', 'For payment transfer money on card with number', 1, 0),
(2, 'Перевод на счет', 'Transfer on bank account', 'Для оплаты переведите деньги на счет по реквизитам', 'For payment transfer money on account number', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `portrait_types`
--

DROP TABLE IF EXISTS `portrait_types`;
CREATE TABLE `portrait_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Портрет',
  `name_en` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'Hyperrealism'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `portrait_types`
--

INSERT INTO `portrait_types` (`id`, `name`, `name_en`) VALUES
(1, 'Гиперреализм', 'Hyperrealism'),
(2, 'Фотореализм', 'Photorealism'),
(3, 'Набросок', 'Sketch');

-- --------------------------------------------------------

--
-- Структура таблицы `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `bg_material_id` int(11) NOT NULL DEFAULT '1',
  `paint_material_id` int(11) NOT NULL DEFAULT '1',
  `portrait_type_id` int(11) NOT NULL DEFAULT '1',
  `format_id` int(11) NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_usd` decimal(10,0) NOT NULL DEFAULT '0',
  `price_eur` decimal(10,0) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `prices`
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
-- Структура таблицы `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `timezone`, `bio`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) DEFAULT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
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
  `gdpr_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `unconfirmed_email`, `registration_ip`, `flags`, `confirmed_at`, `blocked_at`, `updated_at`, `created_at`, `last_login_at`, `last_login_ip`, `auth_tf_key`, `auth_tf_enabled`, `password_changed_at`, `gdpr_consent`, `gdpr_consent_date`, `gdpr_deleted`) VALUES
(1, 'admin', 'email@example.com', '$2y$10$VR2yK3how4haEQ5J81rJvOj/WgaJeRNc.uVujoqK2gSYn88TDpAk2', 'mmw00DtK1sZAO83yuXXpsWkyz3ISHVIO', NULL, NULL, 0, 1638292795, NULL, 1638292796, 1638292796, 1657028295, '::1', '', 0, 1638292796, 0, NULL, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `addons`
--
ALTER TABLE `addons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_en` (`name_en`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `background_colors`
--
ALTER TABLE `background_colors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `colour_id` (`colour_id`);

--
-- Индексы таблицы `bg_materials`
--
ALTER TABLE `bg_materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_en` (`name_en`);

--
-- Индексы таблицы `cancel_reasons`
--
ALTER TABLE `cancel_reasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-cart_items-background_color_id` (`background_color_id`),
  ADD KEY `fk-cart_items-frame_id` (`frame_id`),
  ADD KEY `fk-cart_items-base_id` (`base_id`),
  ADD KEY `fk-cart_items-material_id` (`material_id`),
  ADD KEY `fk-cart_items-portrait_type_id` (`portrait_type_id`),
  ADD KEY `fk-cart_items-format_id` (`format_id`),
  ADD KEY `fk-cart_items-mount_id` (`mount_id`);

--
-- Индексы таблицы `colours`
--
ALTER TABLE `colours`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `name_en` (`name_en`);

--
-- Индексы таблицы `count_faces`
--
ALTER TABLE `count_faces`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `delivery_types`
--
ALTER TABLE `delivery_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `formats`
--
ALTER TABLE `formats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `ind-formats-unique` (`length`,`width`);

--
-- Индексы таблицы `frames`
--
ALTER TABLE `frames`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk-frames-colour_id` (`colour_id`),
  ADD KEY `fk-frames-format_id` (`format_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `mounts`
--
ALTER TABLE `mounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ind-frame_mount_images-unique` (`portrait_format_id`,`colour_id`,`frame_id`),
  ADD KEY `fk-frame_mount_images-colour_id` (`colour_id`),
  ADD KEY `fk-frame_mount_images-frame_id` (`frame_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-orders-cancel_reason_id` (`cancel_reason_id`),
  ADD KEY `fk-orders-pay_type_id` (`pay_type_id`),
  ADD KEY `fk-orders-delivery_type_id` (`delivery_type_id`),
  ADD KEY `fk-orders-cart_item_id` (`cart_item_id`);

--
-- Индексы таблицы `order_addons`
--
ALTER TABLE `order_addons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ind-order_addons-unique` (`addon_id`,`cart_item_id`),
  ADD KEY `fk-order_addons-order_id` (`cart_item_id`);

--
-- Индексы таблицы `paint_materials`
--
ALTER TABLE `paint_materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_en` (`name_en`);

--
-- Индексы таблицы `pay_types`
--
ALTER TABLE `pay_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `portrait_types`
--
ALTER TABLE `portrait_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `name_en` (`name_en`);

--
-- Индексы таблицы `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `index-prices-unique` (`bg_material_id`,`paint_material_id`,`portrait_type_id`,`format_id`),
  ADD KEY `fk-prices-format_id` (`format_id`),
  ADD KEY `fk-prices-portrait_type_id` (`portrait_type_id`),
  ADD KEY `fk-prices-paint_material_id` (`paint_material_id`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_social_account_provider_client_id` (`provider`,`client_id`),
  ADD UNIQUE KEY `idx_social_account_code` (`code`),
  ADD KEY `fk_social_account_user` (`user_id`);

--
-- Индексы таблицы `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `idx_token_user_id_code_type` (`user_id`,`code`,`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_username` (`username`),
  ADD UNIQUE KEY `idx_user_email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `addons`
--
ALTER TABLE `addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `background_colors`
--
ALTER TABLE `background_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `bg_materials`
--
ALTER TABLE `bg_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `cancel_reasons`
--
ALTER TABLE `cancel_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT для таблицы `colours`
--
ALTER TABLE `colours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `count_faces`
--
ALTER TABLE `count_faces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `delivery_types`
--
ALTER TABLE `delivery_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `formats`
--
ALTER TABLE `formats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `frames`
--
ALTER TABLE `frames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `mounts`
--
ALTER TABLE `mounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `order_addons`
--
ALTER TABLE `order_addons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `paint_materials`
--
ALTER TABLE `paint_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `pay_types`
--
ALTER TABLE `pay_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `portrait_types`
--
ALTER TABLE `portrait_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `background_colors`
--
ALTER TABLE `background_colors`
  ADD CONSTRAINT `fk-background_colors-colour_id` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`);

--
-- Ограничения внешнего ключа таблицы `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `fk-cart_items-background_color_id` FOREIGN KEY (`background_color_id`) REFERENCES `background_colors` (`id`),
  ADD CONSTRAINT `fk-cart_items-base_id` FOREIGN KEY (`base_id`) REFERENCES `bg_materials` (`id`),
  ADD CONSTRAINT `fk-cart_items-format_id` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`),
  ADD CONSTRAINT `fk-cart_items-frame_id` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`),
  ADD CONSTRAINT `fk-cart_items-material_id` FOREIGN KEY (`material_id`) REFERENCES `paint_materials` (`id`),
  ADD CONSTRAINT `fk-cart_items-mount_id` FOREIGN KEY (`mount_id`) REFERENCES `mounts` (`id`),
  ADD CONSTRAINT `fk-cart_items-portrait_type_id` FOREIGN KEY (`portrait_type_id`) REFERENCES `portrait_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `frames`
--
ALTER TABLE `frames`
  ADD CONSTRAINT `fk-frames-colour_id` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`),
  ADD CONSTRAINT `fk-frames-format_id` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`);

--
-- Ограничения внешнего ключа таблицы `mounts`
--
ALTER TABLE `mounts`
  ADD CONSTRAINT `fk-frame_mount_images-colour_id` FOREIGN KEY (`colour_id`) REFERENCES `colours` (`id`),
  ADD CONSTRAINT `fk-frame_mount_images-frame_id` FOREIGN KEY (`frame_id`) REFERENCES `frames` (`id`),
  ADD CONSTRAINT `fk-frame_mount_images-portrait_format_id` FOREIGN KEY (`portrait_format_id`) REFERENCES `formats` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk-orders-cancel_reason_id` FOREIGN KEY (`cancel_reason_id`) REFERENCES `cancel_reasons` (`id`),
  ADD CONSTRAINT `fk-orders-cart_item_id` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_items` (`id`),
  ADD CONSTRAINT `fk-orders-delivery_type_id` FOREIGN KEY (`delivery_type_id`) REFERENCES `delivery_types` (`id`),
  ADD CONSTRAINT `fk-orders-pay_type_id` FOREIGN KEY (`pay_type_id`) REFERENCES `pay_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `order_addons`
--
ALTER TABLE `order_addons`
  ADD CONSTRAINT `fk-order_addons-addon_id` FOREIGN KEY (`addon_id`) REFERENCES `addons` (`id`),
  ADD CONSTRAINT `fk-order_addons-order_id` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_items` (`id`);

--
-- Ограничения внешнего ключа таблицы `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `fk-prices-bg_material_id` FOREIGN KEY (`bg_material_id`) REFERENCES `bg_materials` (`id`),
  ADD CONSTRAINT `fk-prices-format_id` FOREIGN KEY (`format_id`) REFERENCES `formats` (`id`),
  ADD CONSTRAINT `fk-prices-paint_material_id` FOREIGN KEY (`paint_material_id`) REFERENCES `paint_materials` (`id`),
  ADD CONSTRAINT `fk-prices-portrait_type_id` FOREIGN KEY (`portrait_type_id`) REFERENCES `portrait_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_social_account_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_token_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
