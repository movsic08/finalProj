-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2023 at 09:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'nike', 1, '2023-09-16 19:05:39', '2023-09-16 19:05:39'),
(2, 'UnderArmour', 'underarmour', 1, '2023-09-16 19:05:50', '2023-09-16 19:05:50'),
(3, 'Jordan', 'jordan', 1, '2023-09-16 19:06:06', '2023-09-16 19:06:06'),
(4, 'Converse', 'converse', 1, '2023-09-16 19:06:15', '2023-09-16 19:06:15'),
(6, 'Lebron', 'lebron', 1, '2023-09-25 17:40:24', '2023-09-25 17:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(1, 'Gender', 'gender', '1.jpg', 1, 'Yes', '2023-09-16 18:28:41', '2023-09-16 18:28:41'),
(2, 'Activity', 'activity', '2.jpg', 1, 'Yes', '2023-09-16 18:59:52', '2023-09-16 18:59:52'),
(3, 'Season', 'season', '3.jpg', 1, 'Yes', '2023-09-16 19:00:54', '2023-09-16 19:00:55'),
(4, 'Type', 'type', '4.jpg', 1, 'Yes', '2023-09-16 19:01:15', '2023-09-16 19:01:16'),
(5, 'Basketball', 'basketball', '5.jpg', 1, 'Yes', '2023-09-25 17:38:31', '2023-09-25 17:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `slug`, `color`, `created_at`, `updated_at`) VALUES
(4, 'Blue', 'blue', '#003DFF', '2023-09-26 04:42:50', '2023-09-26 04:42:50'),
(5, 'Green', 'green', '#12FB06', '2023-09-26 05:16:16', '2023-09-26 05:16:16'),
(6, 'Dark Blue', 'dark-blue', '#0A2AB4', '2023-09-26 07:55:48', '2023-09-26 07:55:48'),
(7, 'Orange', 'orange', '#F98216', '2023-09-26 07:56:04', '2023-09-26 07:56:04'),
(8, 'White', 'white', '#FFFFFF', '2023-09-26 07:56:31', '2023-09-26 07:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `created_at`, `updated_at`) VALUES
(1, 2, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, NULL),
(2, 1, 'Regie', 'Ginez', 'regie@gmail.com', '09082341234', 170, 'Poblacion, Mabini Pangasinan', '2030-3 Apartel Mabini Resort', 'Mabini', 'Pangasinan', '2407', '2023-09-22 20:35:59', '2023-09-22 21:36:25'),
(3, 7, 'Ajay', 'Ortaleza', 'ajay@gmail.com', '09081231234', 170, 'Poblacion Alaminos Pangasinan', '2304 Pob Panga', 'Alaminos', 'Poblacion', '2407', '2023-09-25 17:56:01', '2023-09-25 17:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'DIS30PER', '30% discount', '<p>This is a 30% discount</p>', 3, 2, 'percent', 30.00, 2000.00, 1, '2023-08-17 13:01:35', '2023-10-26 13:01:40', NULL, NULL),
(2, '200DIS', '200 pesos full discount', '<p>This is a full 200 pesos discount on orders above 20000</p>', 1, 1, 'fixed', 200.00, 20000.00, 1, '2023-08-18 13:23:19', '2023-09-29 13:23:23', NULL, NULL),
(3, 'DIS200pesos', 'Discount of 200 pesos for any item at shoenivers', '<p>This is a discount for 200 pesos on any item</p>', 3, 3, 'fixed', 200.00, 1000.00, 1, '2023-08-26 02:06:52', '2023-09-27 02:07:05', '2023-09-25 18:07:29', '2023-09-25 18:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_08_30_122245_alter_users_table', 1),
(6, '2023_08_30_155427_create_categories_table', 1),
(7, '2023_08_31_145140_create_temp_image', 1),
(8, '2023_09_01_044051_create_sub_categories_table', 1),
(9, '2023_09_01_132446_create_brands_table', 1),
(10, '2023_09_01_154755_create_products_table', 1),
(11, '2023_09_02_003442_create_product_images_table', 1),
(12, '2023_09_03_121201_alter_categories_table', 1),
(13, '2023_09_04_012617_alter_products_table', 1),
(14, '2023_09_04_015217_alter_sub_categories_table', 1),
(15, '2023_09_04_125813_alter_products_table', 1),
(16, '2023_09_14_135809_alter_users_table', 1),
(17, '2023_09_14_232143_create_countries_table', 1),
(18, '2023_09_15_000338_create_orders_table', 1),
(19, '2023_09_15_000409_create_order_items_table', 1),
(20, '2023_09_15_000438_create_customer_addresses_table', 1),
(21, '2023_09_16_030017_drop_notes_column_from_customer_addresses', 1),
(22, '2023_09_16_031222_make_notes_nullable_in_orders', 1),
(23, '2023_09_16_050608_create_shipping_charges_table', 1),
(24, '2023_09_17_053336_create_discount_coupons_table', 1),
(25, '2023_09_22_125133_create_wishlists_table', 2),
(26, '2023_09_23_053933_alter_users_table', 3),
(27, '2023_09_23_090401_create_pages_table', 4),
(28, '2023_09_26_111046_create_colors_table', 5),
(29, '2023_09_26_131941_create_sizes_table', 6),
(30, '2023_09_26_162122_create_product_colors_table', 7),
(31, '2023_09_27_010925_create_product_sizes_table', 8),
(32, '2023_09_27_011729_create_product_sizes_table', 9),
(33, '2023_09_29_090801_create_product_variations_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code_id` int(11) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grandtotal` double(10,2) NOT NULL,
  `payment_status` enum('paid','not paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not paid',
  `status` enum('pending','shipped','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `coupon_code_id`, `discount`, `grandtotal`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 11647.00, 40.00, 'dis30percent', 5, 3494.10, 8192.90, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-18 00:54:31', '2023-09-18 00:54:31'),
(2, 2, 13635.00, 40.00, 'DIS30PER', 1, 4090.50, 9584.50, 'not paid', 'cancelled', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-18 05:14:28', '2023-09-19 10:23:59'),
(3, 2, 14579.00, 40.00, 'DIS30PER', 1, 4373.70, 10245.30, 'not paid', 'delivered', '2023-09-20 18:24:19', 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-18 05:15:17', '2023-09-19 10:24:23'),
(4, 2, 20463.00, 60.00, '200DIS', 2, 200.00, 20323.00, 'not paid', 'shipped', '2023-09-21 18:15:02', 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-18 05:31:41', '2023-09-19 10:15:41'),
(5, 2, 6343.00, 60.00, '', NULL, 0.00, 6403.00, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-19 17:46:48', '2023-09-19 17:46:48'),
(6, 2, 23140.00, 80.00, '', NULL, 0.00, 23220.00, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-19 17:49:16', '2023-09-19 17:49:16'),
(7, 2, 15206.00, 60.00, '', NULL, 0.00, 15266.00, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-19 17:53:08', '2023-09-19 17:53:08'),
(8, 2, 15206.00, 60.00, '', NULL, 0.00, 15266.00, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-19 17:53:48', '2023-09-19 17:53:48'),
(9, 2, 15206.00, 60.00, '', NULL, 0.00, 15266.00, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-19 17:54:10', '2023-09-19 17:54:10'),
(10, 2, 11181.00, 60.00, '', NULL, 0.00, 11241.00, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-22 17:40:40', '2023-09-22 17:40:40'),
(11, 2, 3727.00, 20.00, '', NULL, 0.00, 3747.00, 'not paid', 'pending', NULL, 'Arthur', 'Cervania', 'arthurcervania13@gmail.com', '09692696666', 170, 'Masidem Bani Pangasinan', NULL, 'Bani', 'Pangasinan', '2407', NULL, '2023-09-22 17:48:40', '2023-09-22 17:48:40'),
(12, 1, 15505.00, 40.00, '', NULL, 0.00, 15545.00, 'not paid', 'pending', NULL, 'Regie', 'Ginez', 'regie@gmail.com', '09082341234', 170, 'Poblacion, Mabini Pangasinan', NULL, 'Mabini', 'Pangasinan', '2407', 'This is my first order', '2023-09-22 20:35:59', '2023-09-22 20:35:59'),
(13, 7, 24031.00, 150.00, '', NULL, 0.00, 24181.00, 'not paid', 'delivered', '2023-09-20 07:00:18', 'Ajay', 'Ortaleza', 'ajay@gmail.com', '09081231234', 170, 'Poblacion Alaminos Pangasinan', '2304 Pob Panga', 'Alaminos', 'Poblacion', '2407', 'Please send with  care', '2023-09-25 17:56:01', '2023-09-25 18:03:16'),
(14, 7, 24031.00, 150.00, '', NULL, 0.00, 24181.00, 'not paid', 'pending', NULL, 'Ajay', 'Ortaleza', 'ajay@gmail.com', '09081231234', 170, 'Poblacion Alaminos Pangasinan', '2304 Pob Panga', 'Alaminos', 'Poblacion', '2407', NULL, '2023-09-25 17:57:13', '2023-09-25 17:57:13'),
(15, 7, 24031.00, 150.00, '', NULL, 0.00, 24181.00, 'not paid', 'pending', NULL, 'Ajay', 'Ortaleza', 'ajay@gmail.com', '09081231234', 170, 'Poblacion Alaminos Pangasinan', '2304 Pob Panga', 'Alaminos', 'Poblacion', '2407', NULL, '2023-09-25 17:59:22', '2023-09-25 17:59:22'),
(16, 7, 11537.00, 60.00, 'DIS200pesos', 3, 200.00, 11397.00, 'not paid', 'pending', NULL, 'Ajay', 'Ortaleza', 'ajay@gmail.com', '09081231234', 170, 'Poblacion Alaminos Pangasinan', '2304 Pob Panga', 'Alaminos', 'Poblacion', '2407', NULL, '2023-09-25 18:09:48', '2023-09-25 18:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 'Christiansen, Witting and Kris Jordan Activity Basketball voluptas-2394 quos', 1, 7828.00, 7828.00, '2023-09-18 00:54:31', '2023-09-18 00:54:31'),
(2, 1, 14, 'Simonis, Kulas and Lindgren UnderArmour Activity Basketball similique-9330 quo', 1, 3819.00, 3819.00, '2023-09-18 00:54:31', '2023-09-18 00:54:31'),
(3, 2, 12, 'Kuvalis Group Converse Gender Unisex aliquid-8717 cum', 1, 8751.00, 8751.00, '2023-09-18 05:14:28', '2023-09-18 05:14:28'),
(4, 2, 11, 'Green, Rolfson and Jacobs Jordan Gender Unisex odit-8306 fuga', 1, 4884.00, 4884.00, '2023-09-18 05:14:28', '2023-09-18 05:14:28'),
(5, 3, 8, 'Gibson, Gleason and King Converse Gender Women amet-8593 exercitationem', 1, 8723.00, 8723.00, '2023-09-18 05:15:17', '2023-09-18 05:15:17'),
(6, 3, 7, 'Kuhn-Koss Jordan Gender Women maxime-2663 est', 1, 5856.00, 5856.00, '2023-09-18 05:15:17', '2023-09-18 05:15:17'),
(7, 4, 8, 'Gibson, Gleason and King Converse Gender Women amet-8593 exercitationem', 1, 8723.00, 8723.00, '2023-09-18 05:31:41', '2023-09-18 05:31:41'),
(8, 4, 6, 'Hodkiewicz Ltd UnderArmour Gender Women nemo-7366 sequi', 2, 5870.00, 11740.00, '2023-09-18 05:31:41', '2023-09-18 05:31:41'),
(9, 5, 4, 'Gislason Group Converse Gender Men qui-4331 dolor', 2, 2734.00, 5468.00, '2023-09-19 17:46:48', '2023-09-19 17:46:48'),
(10, 5, 3, 'Rodriguez-Leannon Jordan Gender Men eligendi-7287 placeat', 1, 875.00, 875.00, '2023-09-19 17:46:48', '2023-09-19 17:46:48'),
(11, 6, 8, 'Reichel, Effertz and Smitham Converse Gender Women perferendis-3922 non', 2, 3794.00, 7588.00, '2023-09-19 17:49:16', '2023-09-19 17:49:16'),
(12, 6, 11, 'Douglas-Smitham Jordan Gender Unisex tempora-3254 dolores', 2, 7776.00, 15552.00, '2023-09-19 17:49:16', '2023-09-19 17:49:16'),
(13, 7, 27, 'Gusikowski LLC Jordan Type Athletic voluptas-1604 asperiores', 2, 4731.00, 9462.00, '2023-09-19 17:53:08', '2023-09-19 17:53:08'),
(14, 7, 30, 'Ward-Jenkins UnderArmour Type Casual deserunt-496 consequatur', 1, 5744.00, 5744.00, '2023-09-19 17:53:08', '2023-09-19 17:53:08'),
(15, 8, 27, 'Gusikowski LLC Jordan Type Athletic voluptas-1604 asperiores', 2, 4731.00, 9462.00, '2023-09-19 17:53:48', '2023-09-19 17:53:48'),
(16, 8, 30, 'Ward-Jenkins UnderArmour Type Casual deserunt-496 consequatur', 1, 5744.00, 5744.00, '2023-09-19 17:53:48', '2023-09-19 17:53:48'),
(17, 9, 27, 'Gusikowski LLC Jordan Type Athletic voluptas-1604 asperiores', 2, 4731.00, 9462.00, '2023-09-19 17:54:10', '2023-09-19 17:54:10'),
(18, 9, 30, 'Ward-Jenkins UnderArmour Type Casual deserunt-496 consequatur', 1, 5744.00, 5744.00, '2023-09-19 17:54:10', '2023-09-19 17:54:10'),
(19, 10, 36, 'Gaylord, Leffler and Treutel Converse Type Sneakers earum-8858 perferendis', 3, 3727.00, 11181.00, '2023-09-22 17:40:40', '2023-09-22 17:40:40'),
(20, 11, 36, 'Gaylord, Leffler and Treutel Converse Type Sneakers earum-8858 perferendis', 1, 3727.00, 3727.00, '2023-09-22 17:48:40', '2023-09-22 17:48:40'),
(21, 12, 20, 'Casper, Cummerata and Kuphal Converse Activity Cycling dolor-2627 qui', 1, 7762.00, 7762.00, '2023-09-22 20:35:59', '2023-09-22 20:35:59'),
(22, 12, 19, 'Brakus-Grady Jordan Activity Cycling est-1244 distinctio', 1, 7743.00, 7743.00, '2023-09-22 20:35:59', '2023-09-22 20:35:59'),
(23, 13, 31, 'Cartwright and Sons Jordan Type Casual consequuntur-4564 adipisci', 1, 4787.00, 4787.00, '2023-09-25 17:56:01', '2023-09-25 17:56:01'),
(24, 13, 30, 'Ward-Jenkins UnderArmour Type Casual deserunt-496 consequatur', 1, 5744.00, 5744.00, '2023-09-25 17:56:01', '2023-09-25 17:56:01'),
(25, 13, 37, 'Lebron 20', 3, 4500.00, 13500.00, '2023-09-25 17:56:01', '2023-09-25 17:56:01'),
(26, 14, 31, 'Cartwright and Sons Jordan Type Casual consequuntur-4564 adipisci', 1, 4787.00, 4787.00, '2023-09-25 17:57:13', '2023-09-25 17:57:13'),
(27, 14, 30, 'Ward-Jenkins UnderArmour Type Casual deserunt-496 consequatur', 1, 5744.00, 5744.00, '2023-09-25 17:57:13', '2023-09-25 17:57:13'),
(28, 14, 37, 'Lebron 20', 3, 4500.00, 13500.00, '2023-09-25 17:57:13', '2023-09-25 17:57:13'),
(29, 15, 31, 'Cartwright and Sons Jordan Type Casual consequuntur-4564 adipisci', 1, 4787.00, 4787.00, '2023-09-25 17:59:22', '2023-09-25 17:59:22'),
(30, 15, 30, 'Ward-Jenkins UnderArmour Type Casual deserunt-496 consequatur', 1, 5744.00, 5744.00, '2023-09-25 17:59:22', '2023-09-25 17:59:22'),
(31, 15, 37, 'Lebron 20', 3, 4500.00, 13500.00, '2023-09-25 17:59:22', '2023-09-25 17:59:22'),
(32, 16, 19, 'Brakus-Grady Jordan Activity Cycling est-1244 distinctio', 1, 7743.00, 7743.00, '2023-09-25 18:09:48', '2023-09-25 18:09:48'),
(33, 16, 8, 'Reichel, Effertz and Smitham Converse Gender Women perferendis-3922 non', 1, 3794.00, 3794.00, '2023-09-25 18:09:48', '2023-09-25 18:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(4, 'About Us', 'about-us', '<h1 class=\"\" style=\"text-align: center; \">About Us</h1><p style=\"text-align: center;\">Certainly! Here\'s a sample welcome message for Shoeniverse, your shoe store:</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">```</p><p style=\"text-align: center;\">Welcome to Shoeniverse!</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">Step into a world of style, comfort, and endless possibilities for your feet. At Shoeniverse, we\'re passionate about footwear, and we\'re thrilled to have you as part of our shoe-loving community.</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">Whether you\'re on the hunt for the perfect pair of sneakers to express your casual style, elegant heels to make a statement, or rugged boots for your outdoor adventures, we\'ve got you covered. Our extensive collection of shoes is curated to cater to every taste, occasion, and mood.</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">Explore our online store to discover the latest trends, classic designs, and exclusive brands that will elevate your shoe game. We\'re dedicated to delivering the highest quality footwear, so you can walk with confidence and comfort.</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">At Shoeniverse, customer satisfaction is our top priority. If you ever have questions or need assistance, our friendly team is here to help. Your shopping experience is important to us, and we strive to make it as seamless as possible.</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">Thank you for choosing Shoeniverse for all your shoe needs. We look forward to helping you find the perfect pair that reflects your unique style and personality.</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">Happy shopping, and step out in style with Shoeniverse!</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">Best regards,</p><p style=\"text-align: center;\">[Your Name]</p><p style=\"text-align: center;\">Founder, Shoeniverse</p><p style=\"text-align: center;\">```</p><p style=\"text-align: center;\"><br></p><p style=\"text-align: center;\">Feel free to customize this message with your own brand\'s voice and any specific details you\'d like to include.</p>', '2023-09-27 21:40:55', '2023-09-27 21:56:57'),
(5, 'Contact Us', 'contact-us', '<h1 style=\"text-align: center; \" class=\"\">Contact Us</h1><p style=\"text-align: center;\">We are located at Poblacion Alaminos Bani Pangasinan</p><p style=\"text-align: center;\">Facebook: Shoeniverse</p><p style=\"text-align: center;\">Phone: 0909 283 2348</p>', '2023-09-28 07:31:44', '2023-09-28 07:31:44'),
(6, 'FAQ', 'faq', '<h1 class=\"\">FAQ</h1><ul><li>What are the colors available in Shoeniverse?</li><li>What are the sizes available?</li><li>What are the options available</li></ul><p><br></p>', '2023-09-28 07:34:03', '2023-09-28 07:34:03'),
(7, 'Terms and Conditions', 'terms-and-conditions', '<h1 class=\"\">Terms and Conditions</h1><p>Your information is used to ensure that you are a valid member of the website</p>', '2023-09-28 07:34:53', '2023-09-28 07:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_returns` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_products` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `track_qty` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Powlowski PLC Nike Gender Men labore-4166 aut', 'powlowski-plc-nike-gender-men-labore-4166-aut', 'Dolore suscipit ut aspernatur itaque id repellat ipsa dolores. In dolores provident ipsam. Est earum odio sit sint qui numquam.', 'Dolore cumque nemo fugit alias expedita.', 'Eos et dolores qui vel est autem repellendus. Incidunt quos et corrupti consectetur voluptas sequi.', '', 5748.00, 6000.00, 1, 1, 1, 'No', '4689990301125', 'MDZGVPTU', 'Yes', 20, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(2, 'Welch, Ritchie and Schmitt UnderArmour Gender Men earum-3815 sapiente', 'welch-ritchie-and-schmitt-underarmour-gender-men-earum-3815-sapiente', 'Est eum delectus vel et accusantium. Ut non totam ea aut laboriosam. Voluptatem laudantium odio aut autem asperiores quam.', 'Expedita incidunt sed praesentium laboriosam id nam aut.', 'Quis praesentium deserunt autem sequi voluptates.', '', 9742.00, 10000.00, 1, 1, 2, 'No', '6011402241663659', 'SSCKSN34', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(3, 'Rodriguez-Leannon Jordan Gender Men eligendi-7287 placeat', 'rodriguez-leannon-jordan-gender-men-eligendi-7287-placeat', 'Ab necessitatibus quia quo eum consequuntur occaecati. Rerum voluptate corporis quos libero.', 'Unde unde sequi qui corporis magnam atque.', 'Sunt voluptas non nobis hic quasi distinctio doloremque. Consequuntur velit id recusandae.', '', 875.00, 1000.00, 1, 1, 3, 'Yes', '4929148477606419', 'KNBSIJSE', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(4, 'Gislason Group Converse Gender Men qui-4331 dolor', 'gislason-group-converse-gender-men-qui-4331-dolor', 'Aut voluptatibus rem dolorem accusantium minus odio a. Facere sequi itaque voluptas quibusdam necessitatibus. Dolorem ducimus quas sed optio.', 'Iusto sunt et minus et.', 'Est esse provident tempore blanditiis.', '', 2734.00, 3000.00, 1, 1, 4, 'No', '3528651579277176', 'GEMDFPLH', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(5, 'Kautzer-Corwin Nike Gender Women at-9268 minus', 'kautzer-corwin-nike-gender-women-at-9268-minus', 'Suscipit mollitia ut at fugit quasi non omnis natus. Eos maxime quo voluptate aliquam.', 'Molestiae impedit animi dolorem praesentium repellendus officiis nulla.', 'Enim quis consequatur reiciendis commodi aliquam aliquid.', '', 3865.00, 4000.00, 1, 2, 1, 'No', '2457265159943870', 'WTKRDELT', 'Yes', 46, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(6, 'Collier Ltd UnderArmour Gender Women dolor-6952 ut', 'collier-ltd-underarmour-gender-women-dolor-6952-ut', 'Recusandae eos non perferendis. Sit deleniti alias maiores aut labore. Dignissimos dicta nisi labore occaecati et voluptatem quod totam. Facilis quidem fuga molestiae aut. Sed sed beatae omnis ipsam.', 'Nulla vel saepe et quisquam. Tempore occaecati et in optio.', 'Blanditiis nemo officia harum consequatur natus molestiae veniam expedita. Consequuntur ullam nihil reiciendis molestias hic.', '', 2754.00, 3000.00, 1, 2, 2, 'No', '2337789763442520', 'ENLBOQC3QGH', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(7, 'Hauck-Lowe Jordan Gender Women ipsum-1353 sed', 'hauck-lowe-jordan-gender-women-ipsum-1353-sed', 'Saepe officia praesentium in eligendi ut sit nemo. Voluptas voluptate aut reprehenderit molestias provident excepturi.', 'Magni culpa quis culpa mollitia hic. Architecto modi dolor qui sapiente voluptatem.', 'Aspernatur minima amet aut in laboriosam.', '', 5886.00, 6000.00, 1, 2, 3, 'Yes', '2221860511611564', 'KYPGYVO34LX', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(8, 'Reichel, Effertz and Smitham Converse Gender Women perferendis-3922 non', 'reichel-effertz-and-smitham-converse-gender-women-perferendis-3922-non', 'Repudiandae qui quod non similique quae. Architecto quam molestiae aut ea cumque excepturi. Ut qui eius facere. Qui totam a a impedit.', 'Consectetur facilis mollitia distinctio aliquid nihil eveniet. In facere ipsum minus nulla.', 'Dolorem dolor fugiat labore sint. Quia voluptas magni odit.', '', 3794.00, 4000.00, 1, 2, 4, 'Yes', '3528660377110059', 'ZSYTRLKTD8J', 'Yes', 40, 1, '2023-09-19 09:51:13', '2023-09-25 18:09:48'),
(9, 'Connelly Ltd Nike Gender Unisex nisi-5569 esse', 'connelly-ltd-nike-gender-unisex-nisi-5569-esse', 'Et officiis modi et aut ipsum quasi. Sint animi pariatur nesciunt accusamus veritatis consequatur.', 'Et ipsa laborum nam ea quis sunt.', 'Occaecati vitae aut velit enim aut consequatur. Sunt eum facilis quidem minima aperiam est.', '', 3784.00, 4000.00, 1, 3, 1, 'No', '4485904223125633', 'XSLPXN8KAXT', 'Yes', 22, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(10, 'Gorczany, Gislason and Swaniawski UnderArmour Gender Unisex iste-8900 deleniti', 'gorczany-gislason-and-swaniawski-underarmour-gender-unisex-iste-8900-deleniti', 'Architecto sunt et sunt voluptas corporis rem reiciendis. Aliquid laboriosam provident voluptas cupiditate fugiat. Sed atque quasi et cumque ut quis voluptas eaque. Incidunt sed aut repellendus et nihil.', 'Deleniti harum autem iste consequatur autem.', 'Provident qui quam iure sint excepturi. Ut nesciunt eius incidunt harum.', '', 5724.00, 6000.00, 1, 3, 2, 'No', '3528684008460071', 'FCCEQWNKPNY', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(11, 'Douglas-Smitham Jordan Gender Unisex tempora-3254 dolores', 'douglas-smitham-jordan-gender-unisex-tempora-3254-dolores', 'Aut ut odit eius nobis commodi. Quae id ut alias perferendis veniam. Magni cumque assumenda laboriosam. Dolorem natus id et cumque temporibus ad at et.', 'Reprehenderit excepturi consequatur debitis ipsam in consequatur possimus. Veniam omnis dolore enim ex quia qui enim dolor.', 'Et aliquid excepturi cum vel. Qui error ut natus aut vero ea ducimus.', '', 7776.00, 8000.00, 1, 3, 3, 'Yes', '373332436584359', 'ZTAZJE1D', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(12, 'Collier, Weissnat and Kozey Converse Gender Unisex quidem-4223 voluptatem', 'collier-weissnat-and-kozey-converse-gender-unisex-quidem-4223-voluptatem', 'Non rerum eligendi impedit amet delectus nihil ratione. Voluptas amet repudiandae et dolor iste. Mollitia dolor et tempore.', 'Dignissimos quos rerum pariatur. Sequi id sequi est autem rerum iusto quasi.', 'Tempore quasi dignissimos nostrum harum.', '', 7705.00, 8000.00, 1, 3, 4, 'Yes', '4929860276650071', 'NAUZMVNJLSI', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(13, 'White Ltd Nike Activity Basketball dolor-3788 esse', 'white-ltd-nike-activity-basketball-dolor-3788-esse', 'Aliquid placeat quia explicabo deserunt qui. Eos qui qui totam quos aperiam est nam. Nostrum natus distinctio inventore aliquam illum recusandae et numquam.', 'Eum sit nam et sed totam. Ut sed aut ea itaque quia ad.', 'Et laborum dolore dolore ut optio.', '', 8713.00, 9000.00, 2, 4, 1, 'Yes', '4485998900991846', 'GXSYHFUI', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(14, 'Ernser, Dietrich and Haley UnderArmour Activity Basketball totam-55 libero', 'ernser-dietrich-and-haley-underarmour-activity-basketball-totam-55-libero', 'Ducimus qui tempore in praesentium optio officiis at. Accusantium necessitatibus itaque ad soluta explicabo magni quasi. Maxime porro hic iste eum quos dicta labore.', 'Quisquam voluptas distinctio eos assumenda qui delectus.', 'Sint veniam soluta sit asperiores et modi asperiores.', '', 2712.00, 3000.00, 2, 4, 2, 'No', '6011126820924667', 'MVVUNXWZRZK', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(15, 'Hane Ltd Jordan Activity Basketball mollitia-4001 neque', 'hane-ltd-jordan-activity-basketball-mollitia-4001-neque', 'Eligendi magni sint in laboriosam. Maxime quo inventore vel a. Tempora harum molestias optio facere corporis rerum.', 'Cum quae qui illum deserunt consequatur quam.', 'Aliquid temporibus doloremque autem.', '', 7777.00, 8000.00, 2, 4, 3, 'No', '4485258117820548', 'REUCIFI2VSP', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(16, 'Morissette LLC Converse Activity Basketball placeat-260 alias', 'morissette-llc-converse-activity-basketball-placeat-260-alias', 'Praesentium consequuntur aut quod aut. Consectetur qui amet mollitia autem sunt et voluptates. Odio similique fugiat voluptas tenetur cupiditate ullam.', 'Quae laudantium minima ut illo ducimus.', 'Et excepturi sapiente asperiores qui. Sapiente laudantium possimus aut eligendi quos.', '', 1738.00, 2000.00, 2, 4, 4, 'No', '4716797226339107', 'UQBMWHR1', 'Yes', 26, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(17, 'Friesen-Botsford Nike Activity Cycling harum-6263 ullam', 'friesen-botsford-nike-activity-cycling-harum-6263-ullam', 'Voluptate atque consequatur magni et nisi quasi. Amet ut veritatis aut eos sint non nihil. Perferendis repellat ratione nihil consectetur error.', 'Consequuntur vel nesciunt architecto voluptates beatae hic vel.', 'Et omnis nemo eligendi consectetur quaerat quo.', '', 9888.00, 10000.00, 2, 5, 1, 'Yes', '5324341997549387', 'HMFWHEA930A', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(18, 'Yundt LLC UnderArmour Activity Cycling dolores-6492 rem', 'yundt-llc-underarmour-activity-cycling-dolores-6492-rem', 'Eligendi fugit dicta accusamus vero et. Officiis laudantium consectetur quidem dolor itaque. Ut dicta velit omnis quis et vel reiciendis. Ipsum labore reprehenderit molestias explicabo est molestias expedita.', 'Non et corrupti eos ipsum. Ipsa est aut enim quibusdam.', 'Eligendi autem adipisci optio dolorum eveniet unde iure veniam.', '', 4877.00, 5000.00, 2, 5, 2, 'No', '5197508645050505', 'TJNVIGGR', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(19, 'Brakus-Grady Jordan Activity Cycling est-1244 distinctio', 'brakus-grady-jordan-activity-cycling-est-1244-distinctio', 'Quasi voluptas sit voluptate aperiam ex omnis. Optio veniam ut provident rem omnis enim. Temporibus enim cupiditate ea impedit.', 'Sapiente assumenda voluptatem aut illum eius ut.', 'Tenetur sapiente possimus et odit culpa eaque cupiditate.', '', 7743.00, 8000.00, 2, 5, 3, 'Yes', '4024007105707979', 'WVOBFPSP', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(20, 'Casper, Cummerata and Kuphal Converse Activity Cycling dolor-2627 qui', 'casper-cummerata-and-kuphal-converse-activity-cycling-dolor-2627-qui', 'Quia similique perferendis velit ipsum repellat ut temporibus. Sit porro nobis facere.', 'Incidunt non quos odit. Debitis deserunt aut eos saepe et optio cumque.', 'Assumenda aut voluptatem nesciunt aliquam. Nam est voluptas vitae id et odit aut.', '', 7762.00, 8000.00, 2, 5, 4, 'Yes', '6011680835407423', 'JCYKOGK9', 'Yes', 28, 1, '2023-09-19 09:51:13', '2023-09-22 20:35:59'),
(21, 'Mraz Ltd Nike Activity Dance nobis-3765 quibusdam', 'mraz-ltd-nike-activity-dance-nobis-3765-quibusdam', 'Distinctio totam est consectetur vitae doloremque id velit. Voluptas expedita qui sapiente quod quod sed. Magnam officia minima sunt odio consequatur velit quidem. Enim occaecati consequatur officiis qui enim enim.', 'Aut ut fugit ut doloribus.', 'Molestiae cupiditate omnis velit vitae.', '', 1880.00, 2000.00, 2, 6, 1, 'Yes', '4716845368538901', 'ECEUDIKI1OI', 'Yes', 18, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(22, 'Moen Ltd UnderArmour Activity Dance et-126 quibusdam', 'moen-ltd-underarmour-activity-dance-et-126-quibusdam', 'Ea consequuntur qui ab saepe. Quae non molestiae sint maxime soluta laborum autem. Velit quaerat laborum dignissimos et.', 'Inventore numquam aliquid culpa molestias ducimus molestiae vitae.', 'Asperiores et velit sit quia ullam quasi asperiores. Sint modi aut vitae occaecati.', '', 9850.00, 10000.00, 2, 6, 2, 'Yes', '4539817859671561', 'WUUUGZK56UX', 'Yes', 34, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(23, 'Abbott-Kessler Jordan Activity Dance libero-9445 commodi', 'abbott-kessler-jordan-activity-dance-libero-9445-commodi', 'Enim et quod dignissimos nihil. Fugit omnis aut rerum ab quisquam.', 'Ut cupiditate distinctio temporibus quaerat temporibus magnam quasi voluptatem. Rerum esse ut ea rem neque illum.', 'Enim est cumque aut minus odit est excepturi.', '', 7810.00, 8000.00, 2, 6, 3, 'No', '2221730554139551', 'YUQIKSYZRCF', 'Yes', 42, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(24, 'Lynch Ltd Converse Activity Dance aut-4559 magni', 'lynch-ltd-converse-activity-dance-aut-4559-magni', 'Quia quas minima rerum necessitatibus ea. Sed sit consequuntur quia velit quis nihil. Labore atque ut quos quia voluptates vero.', 'Ut dolorem est vitae occaecati aut. Perspiciatis deleniti tempore labore aut.', 'Eligendi quia illo fugit ullam non autem. Voluptatum vero cumque eum odio distinctio odio.', '', 1890.00, 2000.00, 2, 6, 4, 'No', '4929121439692793', 'IFHPTYFEKOE', 'Yes', 25, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(25, 'Weimann, Abshire and O\'Conner Nike Type Athletic eveniet-4902 aut', 'weimann-abshire-and-oconner-nike-type-athletic-eveniet-4902-aut', 'Eos voluptatum in fugiat vel molestias possimus eum. Nostrum similique temporibus voluptas aspernatur ut. Qui molestias deleniti vero expedita at. Quis ad distinctio qui quas nemo quasi.', 'Veniam quisquam alias et velit atque dolor. Sed omnis sint accusamus laboriosam cumque culpa aut.', 'Rerum excepturi sit est est. Aspernatur mollitia quia quis aspernatur.', '', 5887.00, 6000.00, 4, 7, 1, 'No', '6011761108170987', 'OSTPUER0', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(26, 'Reynolds Ltd UnderArmour Type Athletic voluptatem-852 voluptates', 'reynolds-ltd-underarmour-type-athletic-voluptatem-852-voluptates', 'Dolorem est et dolorem et. In voluptas accusantium eum quaerat et velit rerum. Et sed dolor ipsam maxime.', 'Totam eos nihil facere magni aut.', 'Quo rerum harum dignissimos exercitationem illo ut.', '', 1890.00, 2000.00, 4, 7, 2, 'No', '4929754823397', 'LHWDBGPM30X', 'Yes', 17, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(27, 'Gusikowski LLC Jordan Type Athletic voluptas-1604 asperiores', 'gusikowski-llc-jordan-type-athletic-voluptas-1604-asperiores', 'Voluptates soluta laudantium reiciendis aliquid. Et voluptate delectus ea est. Sequi aliquam officia ut eum.', 'Dolorem voluptas sequi quas deserunt rerum. Quod ipsam reiciendis esse modi dolores eos.', 'Eveniet alias molestiae eligendi dignissimos et. Voluptas explicabo ab tenetur et fugiat id est.', '', 4731.00, 5000.00, 4, 7, 3, 'Yes', '378202520685930', 'ASXKGLWZ', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(28, 'Hill LLC Converse Type Athletic et-8812 est', 'hill-llc-converse-type-athletic-et-8812-est', 'Aspernatur consequatur blanditiis veritatis ut officiis omnis. Rem delectus vitae dolor soluta mollitia et. Vitae sunt ratione quod hic nostrum vero incidunt. At ipsam eaque dolores laborum ex consequatur.', 'Perspiciatis repellat ducimus modi est quidem iure omnis.', 'Consequatur perspiciatis excepturi omnis nostrum.', '', 1759.00, 2000.00, 4, 7, 4, 'No', '4024007134553592', 'XQMCFJH2W4U', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(29, 'Keebler-Casper Nike Type Casual et-6689 quod', 'keebler-casper-nike-type-casual-et-6689-quod', 'Nisi aut quo sit id omnis. Qui architecto ducimus autem voluptas recusandae autem. Iste quos facere in id. Qui molestiae quas odio saepe deleniti aspernatur soluta.', 'Velit eum incidunt omnis aut. Excepturi necessitatibus et consequatur sequi et.', 'Ipsa quidem ea voluptates vitae.', '', 803.00, 1000.00, 4, 8, 1, 'No', '4485869874114493', 'AKGUZBNSOYM', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(30, 'Ward-Jenkins UnderArmour Type Casual deserunt-496 consequatur', 'ward-jenkins-underarmour-type-casual-deserunt-496-consequatur', 'Est possimus error nihil id qui perspiciatis. Autem et accusantium doloribus deserunt adipisci voluptate. Ut unde amet eos est ut in vel molestias.', 'Maxime esse quam sit. Ut et laudantium fugiat ut.', 'At nobis aspernatur quia libero fugit quaerat mollitia. Similique voluptatem ut fuga numquam sunt nobis animi.', '', 5744.00, 6000.00, 4, 8, 2, 'Yes', '4539603017608194', 'PEWFAWA7P5V', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(31, 'Cartwright and Sons Jordan Type Casual consequuntur-4564 adipisci', 'cartwright-and-sons-jordan-type-casual-consequuntur-4564-adipisci', 'Ipsum et reprehenderit voluptatem dolorem illo illo cum nisi. Culpa et a occaecati et. Voluptas ducimus animi optio amet alias. Modi omnis fugiat et quod nam autem unde.', 'Adipisci voluptatem qui eveniet molestiae.', 'Corrupti eligendi blanditiis temporibus. Odit sunt eos quos consectetur neque aperiam dolores.', '', 4787.00, 5000.00, 4, 8, 3, 'Yes', '4916848425693', 'BGDZBSM4AWK', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(32, 'Lockman-Ankunding Converse Type Casual neque-1950 voluptatem', 'lockman-ankunding-converse-type-casual-neque-1950-voluptatem', 'Dolore sequi eligendi sunt ducimus qui esse sint nesciunt. Inventore laboriosam soluta ipsam maxime reprehenderit. Sed assumenda laudantium qui odit. Sed iste corporis qui laborum.', 'Provident ipsam omnis id sunt accusantium voluptas. Voluptatibus nesciunt aut beatae autem illo ipsum inventore nemo.', 'Ratione nostrum cumque ipsam possimus neque quas et. Eos enim non eligendi laboriosam autem.', '', 5725.00, 6000.00, 4, 8, 4, 'Yes', '4725896943003571', 'PKUQZEV2', 'Yes', 40, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(33, 'Bogan PLC Nike Type Sneakers quo-2627 laudantium', 'bogan-plc-nike-type-sneakers-quo-2627-laudantium', 'Veritatis ipsum placeat assumenda temporibus vero est molestiae. Iure adipisci doloribus dignissimos molestias omnis et natus quasi. Ea sit non iste quia commodi velit.', 'Alias aliquam beatae cupiditate placeat temporibus. Vero asperiores quibusdam esse eos corrupti velit.', 'Nostrum qui aut nam atque est sed. Eum sit qui alias eos aspernatur aperiam.', '', 752.00, 1000.00, 4, 9, 1, 'No', '5169561643509307', 'YFAWLPCZ', 'Yes', 37, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(34, 'Koelpin LLC UnderArmour Type Sneakers inventore-9783 sit', 'koelpin-llc-underarmour-type-sneakers-inventore-9783-sit', 'Animi vel aut in aut facere aut. Facere cum repudiandae quasi nemo non sint temporibus velit. Quae tempora amet praesentium vitae eos vero non. Repudiandae dolores nobis necessitatibus enim enim aperiam eos sit.', 'Et voluptatem incidunt laborum reiciendis est sed.', 'Quisquam rerum aut ea vel amet rerum.', '', 5877.00, 6000.00, 4, 9, 2, 'No', '2468509445900971', 'UTPHQA9EMYG', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(35, 'Wolff, Lubowitz and Little Jordan Type Sneakers velit-1018 tempora', 'wolff-lubowitz-and-little-jordan-type-sneakers-velit-1018-tempora', 'Ut quia alias repudiandae sit voluptas sed. Quae veritatis qui qui consectetur dolor nobis. Aspernatur itaque pariatur minus ex hic fuga possimus ratione.', 'Ea rem quidem id dolore. Quis sed incidunt consectetur odio minus error et.', 'Nulla pariatur et quia sunt voluptatem aut voluptate.', '', 3827.00, 4000.00, 4, 9, 3, 'Yes', '5151534075546139', 'ENEIENPB', 'No', 0, 1, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(36, 'Gaylord, Leffler and Treutel Converse Type Sneakers earum-8858 perferendis', 'gaylord-leffler-and-treutel-converse-type-sneakers-earum-8858-perferendis', 'Accusantium sint magnam esse quis deserunt et. Est pariatur voluptas similique. Amet eveniet est tenetur nihil quis. Officiis cum velit consequatur consequatur velit eveniet.', 'Sequi quidem voluptatem dolore quia.', 'Quia placeat harum inventore.', '3,13,5', 3727.00, 4000.00, 4, 9, 4, 'No', '5460387943645039', 'ZZKGBUCN', 'Yes', 0, 1, '2023-09-19 09:51:13', '2023-09-22 17:54:26'),
(37, 'Lebron 20', 'lebron-20', '<p>THis is lebron 20</p>', '<p><b>This<font color=\"#00ffff\"> is leb</font>ron pro<span style=\"background-color: rgb(255, 156, 0);\">duct 20</span></b></p><p><b>k</b>jbakdj baksjdbaksb daksjbd aks</p><p style=\"text-align: justify;\">&nbsp;askjbdkja bsdk a</p>', '<p>This product must be returned in good quality within 12 days of purchasex</p>', '31,5,2', 4500.00, 5000.00, 5, 10, 6, 'Yes', 'nike 903', 'bi23ub4i2u3b4', 'Yes', -5, 1, '2023-09-25 17:47:37', '2023-09-25 17:59:22'),
(38, 'Air Force 1 Triple White', 'air-force-1-triple-white', '<p>This product is available for men, women and kids.</p><p>Sizes available:</p><ul><li>31 - 35</li><li><b>36 - 40</b></li><li><font color=\"#ff0000\">41 - 45</font></li></ul><p><font color=\"#ff0000\"><br></font></p><p><br></p>', '<p>This is Airforce 1</p>', '<p><br></p>', '4,14,37', 1999.00, NULL, 1, NULL, 1, 'Yes', 'air 1', NULL, 'Yes', 7, 1, '2023-09-25 18:41:53', '2023-09-25 18:44:37'),
(39, 'Lebron 2023', 'lebron-2023', NULL, '<p>This is an itme</p>', NULL, '', 3000.00, NULL, 5, 10, NULL, 'Yes', 'lebron 2023', NULL, 'No', NULL, 1, '2023-09-26 17:20:17', '2023-09-26 17:20:17'),
(40, 'Lebron 2023 AJ', 'lebron-2023-aj', NULL, NULL, NULL, '', 3000.00, NULL, 2, NULL, 3, 'Yes', 'lebron 20233', NULL, 'No', NULL, 1, '2023-09-26 17:31:04', '2023-09-26 17:31:04'),
(41, 'Kyrie 1', 'kyrie-1', NULL, NULL, NULL, '', 3000.00, NULL, 2, NULL, 3, 'No', 'kyrie 1', NULL, 'No', NULL, 1, '2023-09-26 17:34:51', '2023-09-26 17:34:51'),
(42, 'Kyrie 2', 'kyrie-2', NULL, NULL, NULL, '', 3000.00, NULL, 4, 8, 4, 'No', 'kyrie 2', NULL, 'No', NULL, 1, '2023-09-26 17:38:51', '2023-09-26 17:38:51'),
(43, 'Kyrie 3', 'kyrie-3', NULL, NULL, NULL, '', 3000.00, NULL, 2, 4, 2, 'No', 'kyrie 3', NULL, 'No', NULL, 1, '2023-09-26 17:40:46', '2023-09-26 17:40:46'),
(44, 'Kyrie 4', 'kyrie-4', NULL, NULL, NULL, '', 3000.00, NULL, 2, 5, 3, 'No', 'kyrie 4', NULL, 'No', NULL, 1, '2023-09-26 17:47:32', '2023-09-26 17:47:32'),
(45, 'Jrodan 123', 'jrodan-123', NULL, NULL, NULL, '', 1200.00, NULL, 5, 10, 3, 'No', 'jrodan 123', NULL, 'No', NULL, 1, '2023-09-26 19:15:07', '2023-09-26 19:15:07'),
(46, 'Jrodan222', 'jrodan222', NULL, NULL, NULL, '', 1000.00, NULL, 5, 10, NULL, 'No', 'jrode23', NULL, 'No', NULL, 1, '2023-09-26 19:18:10', '2023-09-26 19:18:10'),
(47, 'Miami 23', 'miami-23', NULL, NULL, NULL, '', 5000.00, NULL, 5, 10, NULL, 'No', 'asaca', NULL, 'No', NULL, 1, '2023-09-26 19:20:30', '2023-09-26 19:20:30'),
(48, 'America 24', 'america-24', NULL, NULL, NULL, '', 4500.00, NULL, 1, 1, 3, 'No', 'qweqweqw', NULL, 'No', NULL, 1, '2023-09-26 19:22:24', '2023-09-26 19:22:24'),
(49, 'Jordan 09', 'jordan-09', NULL, NULL, NULL, '', 1500.00, NULL, 1, 1, 3, 'No', 'ajsbjbkq2jb4', NULL, 'No', NULL, 1, '2023-09-26 19:24:19', '2023-09-26 19:24:19'),
(50, 'Jojin12', 'jojin12', NULL, NULL, NULL, '', 2000.00, NULL, 5, NULL, NULL, 'No', 'kj12bk3j1', NULL, 'No', NULL, 1, '2023-09-26 19:26:29', '2023-09-26 19:26:29'),
(51, 'Africa 123', 'africa-123', NULL, NULL, NULL, '', 2000.00, NULL, 2, 5, 3, 'No', 'asjdajs', NULL, 'No', NULL, 1, '2023-09-26 19:33:13', '2023-09-26 19:33:13'),
(52, 'Jordan 42', 'jordan-42', NULL, NULL, NULL, '', 2500.00, NULL, 1, 1, 3, 'No', 'asjbdkjasbd', NULL, 'No', NULL, 1, '2023-09-26 19:44:26', '2023-09-26 19:44:26'),
(53, 'Jor', 'jor', NULL, NULL, NULL, '', 5000.00, NULL, 4, 8, 4, 'No', 'dasdasdac32423', NULL, 'No', NULL, 1, '2023-09-26 19:46:43', '2023-09-26 19:46:43'),
(54, 'Jorer', 'jorer', NULL, NULL, NULL, '', 2400.00, NULL, 2, NULL, NULL, 'No', 'j2b4jb24', NULL, 'No', NULL, 1, '2023-09-26 19:48:12', '2023-09-26 19:48:12'),
(56, 'Min 12', 'min-12', NULL, NULL, NULL, '', 1900.00, NULL, 5, NULL, NULL, 'No', 'jabkjdbaj', NULL, 'No', NULL, 1, '2023-09-26 19:58:53', '2023-09-26 19:58:53'),
(59, 'MIla123', 'mila123', NULL, NULL, NULL, '', 2300.00, NULL, 1, 3, NULL, 'Yes', 'akjsdkjabs', NULL, 'No', NULL, 1, '2023-09-26 20:58:23', '2023-09-26 21:50:57'),
(60, 'Poole 14', 'poole-14', NULL, NULL, NULL, '', 5000.00, NULL, 3, NULL, NULL, 'Yes', '12hb3jh1v32jh', NULL, 'Yes', 10, 1, '2023-09-26 21:53:02', '2023-09-26 23:54:11'),
(61, 'Butler 20', 'butler-20', NULL, NULL, NULL, '', 2400.00, NULL, 5, NULL, NULL, 'Yes', 'jqwbekjqbw', NULL, 'Yes', 112, 1, '2023-09-26 22:11:32', '2023-09-26 23:53:46'),
(62, 'Jordan 40', 'jordan-40', NULL, NULL, NULL, '', 2400.00, NULL, 2, NULL, NULL, 'No', '123b1jh', NULL, 'Yes', 25, 1, '2023-09-27 00:18:54', '2023-09-27 00:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `track_qty` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_colors`
--

INSERT INTO `product_colors` (`id`, `product_id`, `color_id`, `track_qty`, `qty`, `created_at`, `updated_at`) VALUES
(24, 59, 7, 'Yes', 20, '2023-09-26 20:58:23', '2023-09-26 21:50:57'),
(25, 59, 8, 'No', NULL, '2023-09-26 20:58:23', '2023-09-26 21:47:30'),
(26, 59, 6, 'Yes', 5, '2023-09-26 21:34:29', '2023-09-26 21:50:57'),
(27, 59, 6, 'No', 4, '2023-09-26 21:45:34', '2023-09-26 21:45:34'),
(28, 59, 7, 'No', 4, '2023-09-26 21:45:34', '2023-09-26 21:45:34'),
(29, 59, 8, 'No', 4, '2023-09-26 21:45:34', '2023-09-26 21:45:34'),
(39, 61, 7, 'Yes', 12, '2023-09-26 23:53:46', '2023-09-26 23:53:46'),
(40, 60, 5, 'Yes', 10, '2023-09-26 23:54:11', '2023-09-26 23:54:11'),
(41, 60, 6, 'No', NULL, '2023-09-26 23:54:11', '2023-09-26 23:54:11'),
(46, 62, 7, 'Yes', 5, '2023-09-27 00:32:57', '2023-09-27 00:32:57'),
(47, 62, 8, 'Yes', 10, '2023-09-27 00:32:57', '2023-09-27 00:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '12-25-1693720543.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(2, 1, '2-110-1694926334.png', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(3, 1, '22-62-1693805310.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(4, 2, '9-11-1693704616.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(5, 2, '1-1-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(6, 2, '9-11-1693704616.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(7, 3, '12-25-1693720543.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(8, 3, '25-65-1693805485.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(9, 3, '18-58-1693805089.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(10, 4, '26-66-1693805542.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(11, 4, '8-8-1693645417.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(12, 4, '24-64-1693805418.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(13, 5, '20-60-1693805198.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(14, 5, '26-66-1693805542.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(15, 5, '23-63-1693805356.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(16, 6, '14-54-1693797472.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(17, 6, '15-55-1693797536.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(18, 6, '6-19-1693711477.jpeg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(19, 7, '1-109-1694926287.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(20, 7, '9-10-1693704615.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(21, 7, '12-51-1693723736.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(22, 8, '12-51-1693723736.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(23, 8, '14-54-1693797472.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(24, 8, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(25, 9, '29-69-1693805680.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(26, 9, '31-71-1693805800.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(27, 9, '12-51-1693723736.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(28, 10, '20-60-1693805198.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(29, 10, '18-58-1693805089.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(30, 10, '21-61-1693805264.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(31, 11, '11-14-1693705146.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(32, 11, '27-67-1693805590.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(33, 11, '1-1-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(34, 12, '1-1-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(35, 12, '9-10-1693704615.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(36, 12, '1-1-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(37, 13, '32-72-1693805855.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(38, 13, '10-12-1693705036.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(39, 13, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(40, 14, '1-109-1694926287.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(41, 14, '24-64-1693805418.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(42, 14, '30-70-1693805727.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(43, 15, '25-65-1693805485.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(44, 15, '8-8-1693645417.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(45, 15, '24-64-1693805418.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(46, 16, '12-51-1693723736.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(47, 16, '1-2-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(48, 16, '26-66-1693805542.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(49, 17, '22-62-1693805310.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(50, 17, '25-65-1693805485.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(51, 17, '1-109-1694926287.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(52, 18, '9-10-1693704615.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(53, 18, '1-1-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(54, 18, '26-66-1693805542.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(55, 19, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(56, 19, '25-65-1693805485.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(57, 19, '20-60-1693805198.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(58, 20, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(59, 20, '1-2-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(60, 20, '27-67-1693805590.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(61, 21, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(62, 21, '8-9-1693645418.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(63, 21, '21-61-1693805264.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(64, 22, '21-61-1693805264.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(65, 22, '27-67-1693805590.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(66, 22, '15-55-1693797536.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(67, 23, '26-66-1693805542.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(68, 23, '21-61-1693805264.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(69, 23, '32-72-1693805855.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(70, 24, '22-62-1693805310.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(71, 24, '20-60-1693805198.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(72, 24, '28-68-1693805635.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(73, 25, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(74, 25, '25-65-1693805485.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(75, 25, '29-69-1693805680.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(76, 26, '13-53-1693797413.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(77, 26, '8-9-1693645418.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(78, 26, '23-63-1693805356.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(79, 27, '1-2-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(80, 27, '13-53-1693797413.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(81, 27, '12-25-1693720543.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(82, 28, '14-54-1693797472.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(83, 28, '1-2-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(84, 28, '25-65-1693805485.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(85, 29, '30-70-1693805727.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(86, 29, '29-69-1693805680.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(87, 29, '25-65-1693805485.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(88, 30, '22-62-1693805310.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(89, 30, '21-61-1693805264.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(90, 30, '15-55-1693797536.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(91, 31, '12-25-1693720543.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(92, 31, '20-60-1693805198.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(93, 31, '15-55-1693797536.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(94, 32, '1-1-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(95, 32, '1-2-1694920183.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(96, 32, '8-9-1693645418.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(97, 33, '13-53-1693797413.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(98, 33, '24-64-1693805418.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(99, 33, '14-54-1693797472.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(100, 34, '13-53-1693797413.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(101, 34, '13-53-1693797413.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(102, 34, '15-55-1693797536.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(103, 35, '32-72-1693805855.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(104, 35, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(105, 35, '1-109-1694926287.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(106, 36, '10-13-1693705037.jpg', NULL, '2023-09-19 09:51:13', '2023-09-19 09:51:13'),
(107, 36, '18-58-1693805089.jpg', NULL, '2023-09-19 09:51:14', '2023-09-19 09:51:14'),
(108, 36, '14-54-1693797472.jpg', NULL, '2023-09-19 09:51:14', '2023-09-19 09:51:14'),
(109, 37, '37-109-1695692857.jpg', NULL, '2023-09-25 17:47:37', '2023-09-25 17:47:37'),
(110, 37, '37-110-1695692857.jpg', NULL, '2023-09-25 17:47:37', '2023-09-25 17:47:37'),
(111, 37, '37-111-1695692858.jpg', NULL, '2023-09-25 17:47:38', '2023-09-25 17:47:38'),
(112, 37, '37-112-1695692858.jpg', NULL, '2023-09-25 17:47:38', '2023-09-25 17:47:38'),
(113, 37, '37-113-1695692859.jpg', NULL, '2023-09-25 17:47:39', '2023-09-25 17:47:39'),
(114, 38, '38-114-1695696113.jpg', NULL, '2023-09-25 18:41:53', '2023-09-25 18:41:53'),
(115, 38, '38-115-1695696113.jpg', NULL, '2023-09-25 18:41:53', '2023-09-25 18:41:53'),
(116, 38, '38-116-1695696114.jpg', NULL, '2023-09-25 18:41:54', '2023-09-25 18:41:54'),
(118, 38, '38-118-1695696219.png', NULL, '2023-09-25 18:43:39', '2023-09-25 18:43:39'),
(119, 42, '42-119-1695778731.jpg', NULL, '2023-09-26 17:38:51', '2023-09-26 17:38:51'),
(120, 43, '43-120-1695778846.jpg', NULL, '2023-09-26 17:40:46', '2023-09-26 17:40:46'),
(121, 44, '44-121-1695779253.jpg', NULL, '2023-09-26 17:47:33', '2023-09-26 17:47:33'),
(122, 44, '44-122-1695779253.jpg', NULL, '2023-09-26 17:47:33', '2023-09-26 17:47:33'),
(123, 46, '46-123-1695784690.jpg', NULL, '2023-09-26 19:18:10', '2023-09-26 19:18:10'),
(124, 46, '46-124-1695784690.jpg', NULL, '2023-09-26 19:18:10', '2023-09-26 19:18:10'),
(125, 47, '47-125-1695784831.jpg', NULL, '2023-09-26 19:20:31', '2023-09-26 19:20:31'),
(126, 48, '48-126-1695784944.jpg', NULL, '2023-09-26 19:22:24', '2023-09-26 19:22:24'),
(127, 52, '52-127-1695786266.jpg', NULL, '2023-09-26 19:44:26', '2023-09-26 19:44:26'),
(128, 54, '54-128-1695786492.jpg', NULL, '2023-09-26 19:48:12', '2023-09-26 19:48:12'),
(129, 56, '56-129-1695787133.jpg', NULL, '2023-09-26 19:58:53', '2023-09-26 19:58:53'),
(132, 59, '59-132-1695790703.jpg', NULL, '2023-09-26 20:58:23', '2023-09-26 20:58:23'),
(133, 60, '60-133-1695793982.jpg', NULL, '2023-09-26 21:53:02', '2023-09-26 21:53:02'),
(134, 61, '61-134-1695795092.png', NULL, '2023-09-26 22:11:32', '2023-09-26 22:11:32'),
(135, 62, '62-135-1695802734.jpg', NULL, '2023-09-27 00:18:54', '2023-09-27 00:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `track_qty` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `product_id`, `size_id`, `track_qty`, `qty`, `created_at`, `updated_at`) VALUES
(1, 43, 2, 'No', NULL, '2023-09-26 17:40:46', '2023-09-26 17:40:46'),
(2, 44, 5, 'No', NULL, '2023-09-26 17:47:33', '2023-09-26 17:47:33'),
(3, 44, 3, 'No', NULL, '2023-09-26 17:47:33', '2023-09-26 17:47:33'),
(4, 44, 2, 'No', NULL, '2023-09-26 17:47:33', '2023-09-26 17:47:33'),
(5, 46, 5, 'No', NULL, '2023-09-26 19:18:10', '2023-09-26 19:18:10'),
(6, 46, 6, 'No', NULL, '2023-09-26 19:18:10', '2023-09-26 19:18:10'),
(7, 47, 2, 'No', NULL, '2023-09-26 19:20:31', '2023-09-26 19:20:31'),
(8, 47, 4, 'No', NULL, '2023-09-26 19:20:31', '2023-09-26 19:20:31'),
(9, 48, 5, 'No', NULL, '2023-09-26 19:22:24', '2023-09-26 19:22:24'),
(10, 48, 1, 'No', NULL, '2023-09-26 19:22:24', '2023-09-26 19:22:24'),
(11, 48, 3, 'No', NULL, '2023-09-26 19:22:24', '2023-09-26 19:22:24'),
(12, 52, 3, 'No', NULL, '2023-09-26 19:44:26', '2023-09-26 19:44:26'),
(13, 52, 2, 'No', NULL, '2023-09-26 19:44:26', '2023-09-26 19:44:26'),
(14, 52, 4, 'No', NULL, '2023-09-26 19:44:26', '2023-09-26 19:44:26'),
(15, 54, 2, 'No', NULL, '2023-09-26 19:48:12', '2023-09-26 19:48:12'),
(16, 54, 4, 'No', NULL, '2023-09-26 19:48:12', '2023-09-26 19:48:12'),
(17, 56, 2, 'No', NULL, '2023-09-26 19:58:53', '2023-09-26 19:58:53'),
(18, 56, 4, 'No', NULL, '2023-09-26 19:58:53', '2023-09-26 19:58:53'),
(22, 59, 3, 'No', NULL, '2023-09-26 20:58:23', '2023-09-26 20:58:23'),
(23, 59, 2, 'No', NULL, '2023-09-26 20:58:23', '2023-09-26 20:58:23'),
(24, 59, 4, 'No', NULL, '2023-09-26 20:58:23', '2023-09-26 20:58:23'),
(45, 61, 5, 'No', NULL, '2023-09-26 23:53:46', '2023-09-26 23:53:46'),
(46, 61, 3, 'No', NULL, '2023-09-26 23:53:46', '2023-09-26 23:53:46'),
(47, 61, 2, 'Yes', 100, '2023-09-26 23:53:46', '2023-09-26 23:53:46'),
(48, 60, 3, 'No', NULL, '2023-09-26 23:54:11', '2023-09-26 23:54:11'),
(49, 60, 2, 'No', NULL, '2023-09-26 23:54:11', '2023-09-26 23:54:11'),
(53, 62, 1, 'Yes', 10, '2023-09-27 00:32:57', '2023-09-27 00:32:57'),
(54, 62, 3, 'No', NULL, '2023-09-27 00:32:57', '2023-09-27 00:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `color_id`, `size_id`, `stock_quantity`, `created_at`, `updated_at`) VALUES
(60, 62, 5, 4, 3, '2023-09-29 22:50:46', '2023-09-29 23:08:12'),
(61, 62, 6, 4, 0, '2023-09-29 22:50:46', '2023-09-29 23:08:12'),
(62, 62, 5, 6, 3, '2023-09-29 22:50:46', '2023-09-29 23:08:12'),
(63, 62, 6, 6, 0, '2023-09-29 22:50:46', '2023-09-29 22:50:46'),
(64, 62, 4, 5, 3, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(65, 62, 4, 6, 2, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(66, 62, 4, 1, 0, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(67, 62, 4, 3, 3, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(68, 62, 6, 5, 4, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(69, 62, 6, 1, 5, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(70, 62, 6, 3, 0, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(71, 62, 5, 5, 5, '2023-09-29 22:56:32', '2023-09-29 22:56:49'),
(72, 62, 5, 1, 0, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(73, 62, 5, 3, 0, '2023-09-29 22:56:32', '2023-09-29 22:56:32'),
(74, 62, 4, 5, 3, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(75, 62, 4, 6, 2, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(76, 62, 4, 1, 0, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(77, 62, 4, 3, 3, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(78, 62, 6, 1, 5, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(79, 62, 6, 3, 0, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(80, 62, 5, 1, 0, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(81, 62, 5, 3, 0, '2023-09-29 22:56:49', '2023-09-29 22:56:49'),
(82, 62, 4, 5, 3, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(83, 62, 4, 6, 2, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(84, 62, 4, 1, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(85, 62, 4, 3, 3, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(86, 62, 4, 2, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(87, 62, 4, 4, 7, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(88, 62, 6, 1, 5, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(89, 62, 6, 3, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(90, 62, 6, 2, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(91, 62, 5, 1, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(92, 62, 5, 3, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(93, 62, 5, 2, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(94, 62, 7, 5, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(95, 62, 7, 6, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(96, 62, 7, 1, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(97, 62, 7, 3, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(98, 62, 7, 2, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(99, 62, 7, 4, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(100, 62, 8, 5, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(101, 62, 8, 6, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(102, 62, 8, 1, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(103, 62, 8, 3, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(104, 62, 8, 2, 0, '2023-09-29 23:08:12', '2023-09-29 23:08:12'),
(105, 62, 8, 4, 5, '2023-09-29 23:08:12', '2023-09-29 23:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, '170', 30.00, NULL, '2023-09-25 17:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `created_at`, `updated_at`) VALUES
(1, 33, '2023-09-26 05:35:42', '2023-09-26 05:49:10'),
(2, 41, '2023-09-26 05:42:26', '2023-09-26 05:42:26'),
(3, 40, '2023-09-26 05:42:32', '2023-09-26 05:42:32'),
(4, 42, '2023-09-26 05:43:27', '2023-09-26 05:43:27'),
(5, 21, '2023-09-26 05:43:34', '2023-09-26 05:43:34'),
(6, 32, '2023-09-26 05:43:42', '2023-09-26 05:43:42');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `showHome` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 1, 'Yes', 1, '2023-09-16 18:29:01', '2023-09-16 18:29:22'),
(2, 'Women', 'women', 1, 'Yes', 1, '2023-09-16 18:29:36', '2023-09-16 18:29:36'),
(3, 'Unisex', 'unisex', 1, 'Yes', 1, '2023-09-16 19:03:00', '2023-09-16 19:03:00'),
(4, 'Basketball', 'basketball', 1, 'Yes', 2, '2023-09-16 19:03:22', '2023-09-16 19:03:22'),
(5, 'Cycling', 'cycling', 1, 'Yes', 2, '2023-09-16 19:04:01', '2023-09-16 19:04:01'),
(6, 'Dance', 'dance', 1, 'Yes', 2, '2023-09-16 19:04:14', '2023-09-16 19:04:14'),
(7, 'Athletic', 'athletic', 1, 'Yes', 4, '2023-09-16 19:04:51', '2023-09-16 19:04:51'),
(8, 'Casual', 'casual', 1, 'Yes', 4, '2023-09-16 19:05:03', '2023-09-16 19:05:03'),
(9, 'Sneakers', 'sneakers', 1, 'Yes', 4, '2023-09-16 19:05:19', '2023-09-16 19:05:19'),
(10, 'For Kids', 'for-kids', 1, 'Yes', 5, '2023-09-25 17:39:08', '2023-09-25 17:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `temp_image`
--

CREATE TABLE `temp_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_image`
--

INSERT INTO `temp_image` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '1695692274.jpg', '2023-09-25 17:37:54', '2023-09-25 17:37:54'),
(2, '1695692309.jpg', '2023-09-25 17:38:29', '2023-09-25 17:38:29'),
(3, '1695692655.jpg', '2023-09-25 17:44:15', '2023-09-25 17:44:15'),
(4, '1695692655.jpg', '2023-09-25 17:44:15', '2023-09-25 17:44:15'),
(5, '1695692656.jpg', '2023-09-25 17:44:16', '2023-09-25 17:44:16'),
(6, '1695692656.jpg', '2023-09-25 17:44:16', '2023-09-25 17:44:16'),
(7, '1695692657.jpg', '2023-09-25 17:44:17', '2023-09-25 17:44:17'),
(8, '1695692680.jpg', '2023-09-25 17:44:40', '2023-09-25 17:44:40'),
(9, '1695692688.jpg', '2023-09-25 17:44:48', '2023-09-25 17:44:48'),
(10, '1695695852.jpg', '2023-09-25 18:37:32', '2023-09-25 18:37:32'),
(11, '1695695857.jpg', '2023-09-25 18:37:37', '2023-09-25 18:37:37'),
(12, '1695695863.jpg', '2023-09-25 18:37:43', '2023-09-25 18:37:43'),
(13, '1695695885.jpg', '2023-09-25 18:38:05', '2023-09-25 18:38:05'),
(14, '1695746021.png', '2023-09-26 08:33:41', '2023-09-26 08:33:41'),
(15, '1695746089.jpg', '2023-09-26 08:34:49', '2023-09-26 08:34:49'),
(16, '1695777592.jpg', '2023-09-26 17:19:52', '2023-09-26 17:19:52'),
(17, '1695777595.png', '2023-09-26 17:19:55', '2023-09-26 17:19:55'),
(18, '1695777877.jpg', '2023-09-26 17:24:37', '2023-09-26 17:24:37'),
(19, '1695777880.jpg', '2023-09-26 17:24:40', '2023-09-26 17:24:40'),
(20, '1695778087.jpg', '2023-09-26 17:28:07', '2023-09-26 17:28:07'),
(21, '1695778090.jpg', '2023-09-26 17:28:10', '2023-09-26 17:28:10'),
(22, '1695778245.jpg', '2023-09-26 17:30:45', '2023-09-26 17:30:45'),
(23, '1695778468.png', '2023-09-26 17:34:28', '2023-09-26 17:34:28'),
(24, '1695778470.jpg', '2023-09-26 17:34:30', '2023-09-26 17:34:30'),
(25, '1695778711.jpg', '2023-09-26 17:38:31', '2023-09-26 17:38:31'),
(26, '1695778833.jpg', '2023-09-26 17:40:33', '2023-09-26 17:40:33'),
(27, '1695779238.jpg', '2023-09-26 17:47:18', '2023-09-26 17:47:18'),
(28, '1695779241.jpg', '2023-09-26 17:47:21', '2023-09-26 17:47:21'),
(29, '1695784462.jpg', '2023-09-26 19:14:22', '2023-09-26 19:14:22'),
(30, '1695784465.jpg', '2023-09-26 19:14:25', '2023-09-26 19:14:25'),
(31, '1695784631.jpg', '2023-09-26 19:17:11', '2023-09-26 19:17:11'),
(32, '1695784669.jpg', '2023-09-26 19:17:49', '2023-09-26 19:17:49'),
(33, '1695784820.jpg', '2023-09-26 19:20:20', '2023-09-26 19:20:20'),
(34, '1695784920.jpg', '2023-09-26 19:22:00', '2023-09-26 19:22:00'),
(35, '1695785039.jpg', '2023-09-26 19:23:59', '2023-09-26 19:23:59'),
(36, '1695785162.jpg', '2023-09-26 19:26:02', '2023-09-26 19:26:02'),
(37, '1695785572.jpg', '2023-09-26 19:32:52', '2023-09-26 19:32:52'),
(38, '1695786252.jpg', '2023-09-26 19:44:12', '2023-09-26 19:44:12'),
(39, '1695786386.jpg', '2023-09-26 19:46:26', '2023-09-26 19:46:26'),
(40, '1695786473.jpg', '2023-09-26 19:47:53', '2023-09-26 19:47:53'),
(41, '1695786598.jpg', '2023-09-26 19:49:58', '2023-09-26 19:49:58'),
(42, '1695786895.jpg', '2023-09-26 19:54:55', '2023-09-26 19:54:55'),
(43, '1695787011.jpg', '2023-09-26 19:56:51', '2023-09-26 19:56:51'),
(44, '1695787119.jpg', '2023-09-26 19:58:39', '2023-09-26 19:58:39'),
(45, '1695787216.jpg', '2023-09-26 20:00:16', '2023-09-26 20:00:16'),
(46, '1695788494.jpg', '2023-09-26 20:21:34', '2023-09-26 20:21:34'),
(47, '1695790691.jpg', '2023-09-26 20:58:11', '2023-09-26 20:58:11'),
(48, '1695793969.jpg', '2023-09-26 21:52:49', '2023-09-26 21:52:49'),
(49, '1695794809.jpg', '2023-09-26 22:06:49', '2023-09-26 22:06:49'),
(50, '1695794887.jpg', '2023-09-26 22:08:07', '2023-09-26 22:08:07'),
(51, '1695795080.png', '2023-09-26 22:11:20', '2023-09-26 22:11:20'),
(52, '1695802722.jpg', '2023-09-27 00:18:42', '2023-09-27 00:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Regie Ginez', 'regie@gmail.com', '09692696666', 2, 1, NULL, '$2y$10$ll2gzvbP9Rie29V1DLN4t.SEoHmBccp.PVVbTxfd.vOt9jMB.qf4q', NULL, NULL, '2023-09-22 19:56:51'),
(2, 'John Mark', 'johnmark@gmail.com', NULL, 1, 1, NULL, '$2y$10$rahID.sIr299FCUoETzx9uPNY4VfFQvzWFjoiV.eafEx.dD8sAifm', NULL, NULL, NULL),
(7, 'AJ Ortaleza Aquino', 'ajay@gmail.com', '09080870977', 1, 1, NULL, '$2y$10$7IIfQZ05oIv8zySOEFPs/O9Nj3f.pLk/gmbX.z6hgmGqC.8Ot0DNu', NULL, '2023-09-25 17:52:21', '2023-09-25 17:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(9, 1, 4, '2023-09-22 17:33:55', '2023-09-22 17:33:55'),
(10, 1, 3, '2023-09-22 17:33:58', '2023-09-22 17:33:58'),
(11, 1, 2, '2023-09-22 17:34:01', '2023-09-22 17:34:01'),
(12, 2, 3, '2023-09-22 17:54:41', '2023-09-22 17:54:41'),
(13, 2, 13, '2023-09-22 17:54:44', '2023-09-22 17:54:44'),
(14, 7, 31, '2023-09-25 18:11:43', '2023-09-25 18:11:43'),
(15, 7, 35, '2023-09-25 18:11:46', '2023-09-25 18:11:46'),
(16, 7, 37, '2023-09-25 18:45:45', '2023-09-25 18:45:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_colors_product_id_foreign` (`product_id`),
  ADD KEY `product_colors_color_id_foreign` (`color_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sizes_product_id_foreign` (`product_id`),
  ADD KEY `product_sizes_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_image`
--
ALTER TABLE `temp_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `temp_image`
--
ALTER TABLE `temp_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD CONSTRAINT `product_colors_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_colors_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_sizes_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
