-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 11:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Samsung', 'samsung', 'active', '2024-06-05 18:10:55', '2024-06-05 18:10:55'),
(3, 'LG', 'lg', 'active', '2024-06-05 12:21:22', '2024-06-05 12:21:22'),
(4, 'SONY', 'sony', 'active', '2024-06-05 12:21:32', '2024-06-05 12:21:32'),
(5, 'Software', 'software', 'active', '2024-06-07 19:22:37', '2024-06-07 19:22:37'),
(6, 'Others', 'others', 'active', '2024-06-07 19:22:45', '2024-06-07 19:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active',
  `is_featured` varchar(50) DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `photo`, `status`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 'Laptops', 'laptops', 'Lot of collection of Laptop', 'uploads/categories/product01_20240605_155217_666089b188eb9.png', 'active', 'yes', '2024-06-05 09:52:17', '2024-06-05 10:10:13'),
(3, 'Smartphones', 'smartphones', '<p>We have lot of smartphones collections</p>', 'uploads/categories/product07_20240605_161608_66608f48e3256.png', 'active', 'no', '2024-06-05 10:16:08', '2024-06-05 10:16:08'),
(4, 'Cameras', 'cameras', '<p>We have lot of cameras</p>', 'uploads/categories/product09_20240605_161655_66608f77e67a7.png', 'active', 'no', '2024-06-05 10:16:55', '2024-06-05 10:16:55'),
(5, 'Accessories', 'accessories', '<p>We have lot of accessories</p>', 'uploads/categories/shop03_20240605_161748_66608fac70d40.png', 'active', 'yes', '2024-06-05 10:17:48', '2024-06-05 10:17:48'),
(6, 'Software', 'software', '<p>Lots of software collection available</p>', 'uploads/categories/software_app_20240608_012005_6663b1c55a717.jpg', 'active', 'yes', '2024-06-07 19:20:05', '2024-06-07 19:20:05'),
(7, 'Books', 'books', '<p>Collection of lot of books&nbsp;</p>', 'uploads/categories/book_20240608_012722_6663b37a26104.jpg', 'active', 'no', '2024-06-07 19:27:22', '2024-06-07 19:27:22'),
(8, 'NCTB Books', 'nctb-books', '<p>National Curriculum and Text Book Board</p>', NULL, 'active', 'no', '2024-06-07 19:29:42', '2024-06-13 00:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `cupons`
--

CREATE TABLE `cupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cupon_code` varchar(255) DEFAULT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cupons`
--

INSERT INTO `cupons` (`id`, `cupon_code`, `discount_price`, `created_at`, `updated_at`) VALUES
(2, 'tech25', '250', '2024-06-09 21:15:50', '2024-06-09 21:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_06_05_152950_create_categories_table', 2),
(10, '2024_06_05_162236_create_sizes_table', 3),
(11, '2024_06_05_165034_create_settings_table', 4),
(12, '2024_06_05_180402_create_brands_table', 5),
(13, '2024_06_05_182436_create_products_table', 6),
(14, '2024_06_08_060238_create_carts_table', 7),
(15, '2024_06_10_024500_create_cupons_table', 8),
(16, '2024_06_12_025157_create_reviews_table', 9),
(17, '2024_06_13_014831_create_wishlists_table', 10),
(18, '2024_06_13_135806_create_orders_table', 11),
(19, '2024_06_13_142034_create_order_items_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Processing',
  `transaction_id` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT 'BDT',
  `order_note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `amount`, `address`, `status`, `transaction_id`, `currency`, `order_note`, `created_at`, `updated_at`) VALUES
(3, 'Munna', 'admin@gmail.com', '01611765966', '12248', 'Uttara, Sector-10, Road-12, House-27', 'completed', 'SDAWER342FD', 'BDT', 'Urgent need this product', '2024-06-13 09:09:27', '2024-06-13 21:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(5, '3', '4', '1', '11998', '2024-06-13 09:09:28', '2024-06-13 09:09:28'),
(6, '3', '6', '1', '250', '2024-06-13 09:09:28', '2024-06-13 09:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `condition` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `is_featured` varchar(255) DEFAULT 'false',
  `status` varchar(255) DEFAULT 'false',
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `summary`, `description`, `photo`, `stock`, `size`, `condition`, `price`, `discount`, `is_featured`, `status`, `cat_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(2, 'HP Probook Cover', 'hp-probook-cover', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 18px; line-height: 26px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, sans-serif;\">Key Features</h2><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, sans-serif; font-size: 15px;\"><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">MPN: 1A893AV</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Model: Probook 450 G8</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Processor: Intel Core i5-1135G7 (up to 4.2 GHz 8 MB cache)</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">RAM: 8GB DDR4, Storage: 512GB NVMe SSD</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Display: 15.6 inch diagonal FHD (1920 x 1080)</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Features: FingerPrint, Type-C</li></ul>', '<h2 style=\"margin-right: 0px; margin-bottom: 5px; margin-left: 0px; padding: 0px; font-weight: bold; font-size: 20px; line-height: 26px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, sans-serif; text-align: justify;\">HP Probook 450 G8 Core i5 11th Gen 512GB SSD 15.6 inch FHD Laptop</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 15px; color: rgb(1, 19, 45); line-height: 26px; font-family: &quot;Trebuchet MS&quot;, sans-serif; text-align: justify;\">HP Probook 450 G8 Laptop comes with Intel Core i5-1135G7 Processor (up to 4.2 GHz 8 MB cache), 8 GB DDR4-3200 SDRAM, 512GB SSD, Intel Iris Xe Graphics and Windows 11 Operating system.</p>', '[\"uploads\\/products\\/product02_20240605_194652_6660c0acdcc46.png\",\"uploads\\/products\\/product05_20240605_194652_6660c0acdd304.png\",\"uploads\\/products\\/shop03_20240605_194652_6660c0acdd571.png\"]', 10, 'Lg', 'new', '2000.00', '1000.00', 'on', 'on', 1, 1, '2024-06-05 13:31:45', '2024-06-13 20:56:05'),
(3, 'Lenovo IdeaPad Flex 5', 'lenovo-ideapad-flex-5', '<h2 style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 18px; line-height: 26px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, sans-serif;\">Key Features</h2><ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, sans-serif; font-size: 15px;\"><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">MPN: 82R900E0IN</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Model: IdeaPad Flex 5 14ALC7</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Processor: AMD Ryzen 5 5500U (2.1GHz up to 4.0GHz)</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">RAM: 16GB LPDDR4x Storage: 512GB SSD</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Display: 14\" WUXGA (1920x1200) IPS</li><li style=\"margin: 0px; padding: 0px 0px 10px; display: block; line-height: 20px;\">Features: Backlit Keyboard, Touch, Type-C</li></ul>', '<h2 style=\"margin-right: 0px; margin-bottom: 5px; margin-left: 0px; padding: 0px; font-weight: bold; font-size: 20px; line-height: 26px; color: rgb(0, 0, 0); font-family: &quot;Trebuchet MS&quot;, sans-serif;\">Lenovo IdeaPad Flex 5 14ALC7 AMD Ryzen 5 5500U 14\" Touchscreen Laptop</h2><p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; padding: 0px; font-size: 15px; color: rgb(1, 19, 45); line-height: 26px; font-family: &quot;Trebuchet MS&quot;, sans-serif;\">The Lenovo&nbsp;<span style=\"margin: 0px; padding: 0px; font-weight: bold;\">IdeaPad Flex 5 14ALC7</span>&nbsp;is a notebook that can adjust to your requirements and preferences. It has a 14-inch touchscreen display with WUXGA resolution, IPS technology, and Dolby Audio. It also offers a 360-degree hinge, allowing you to use it as a laptop, tablet, tent, or stand.&nbsp;</p>', '[\"uploads\\/products\\/product04_20240605_195051_6660c19b336fc.png\",\"uploads\\/products\\/shop01_20240605_195051_6660c19b350fe.png\",\"uploads\\/products\\/shop02_20240605_195051_6660c19b35345.png\"]', 12, 'Lg', 'new', '1000.00', '500.00', 'on', 'on', 1, 3, '2024-06-05 13:50:51', '2024-06-13 20:47:04'),
(4, 'MS Office 365', 'ms-office-365', '<p><span style=\"color: rgb(23, 43, 59); font-family: Poppins, sans-serif; font-size: 14px;\">Microsoft 365 brings together premium Office apps like Word, Excel, and PowerPoint with 1 TB of OneDrive cloud storage, advanced security, and more, to help you get things done on any device.</span><br></p>', '<p><span style=\"color: rgb(23, 43, 59); font-family: Poppins, sans-serif; font-size: 14px;\">Microsoft 365 brings together premium Office apps like Word, Excel, and PowerPoint with 1 TB of OneDrive cloud storage, advanced security, and more, to help you get things done on any device.</span><br></p>', '[\"uploads\\/products\\/ms_office_20240608_012200_6663b238b7848.jpg\"]', 9, 'Lg', 'new', '500.00', '200.00', 'on', 'on', 6, 5, '2024-06-07 19:22:00', '2024-06-13 20:45:36'),
(5, 'AnyMP4 Video Converter', 'anymp4-video-converter', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\">AnyMP4 Video Converter Ultimate 2024 Free Download. It is full offline installer standalone setup of AnyMP4 Video Converter Ultimate.</span><br></p>', '<h2 style=\"margin: 0.75em 0px 0.25em; padding: 0px; font-size: 26px; letter-spacing: -0.03em; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">Features of AnyMP4 Video Converter Ultimate 2024</h2><p style=\"margin: 0.25em 0px 0.75em; padding: 0px; line-height: 19.5px; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\">Below are some noticeable features which you’ll experience after AnyMP4 Video Converter Ultimate 2024 free download.</p><ul style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 20px; padding: 0px; list-style-position: outside; line-height: 19.5px; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\"><li style=\"margin: 0px; padding: 0px;\">Robust tool that converts&nbsp; any HD/SD&nbsp; 4K/1080p video formats.</li><li style=\"margin: 0px; padding: 0px;\">Provides preset video profiles from 4K to 1080p, 4K to 4K, and common video to 4K.</li><li style=\"margin: 0px; padding: 0px;\">Compatible with most popular portable devices for endless playback.</li><li style=\"margin: 0px; padding: 0px;\">Can convert audio files from movies to AAC, MP3, and M4A.</li><li style=\"margin: 0px; padding: 0px;\">User-friendly interface with built-in player for snapshots during playback.</li><li style=\"margin: 0px; padding: 0px;\">Supports multiple video and audio files at a time for fastest conversion.</li><li style=\"margin: 0px; padding: 0px;\">Batch conversion ensures the best picture and sound quality.</li><li style=\"margin: 0px; padding: 0px;\">Includes pre-built templates and basic video editing features.</li><li style=\"margin: 0px; padding: 0px;\">Converts audio files to popular, high-quality formats like M4A, AAC, FLAC, MP3, WMA, WAV, AC3, OGG, AIFF.</li><li style=\"margin: 0px; padding: 0px;\">Helps movie makers create professional-grade movies from pictures, home video, and music.</li></ul><h2 style=\"margin: 0.75em 0px 0.25em; padding: 0px; font-size: 26px; letter-spacing: -0.03em; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">AnyMP4 Video Converter Ultimate 2024 Technical Setup Details</h2><ul style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 20px; padding: 0px; list-style-position: outside; line-height: 19.5px; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\"><li style=\"margin: 0px; padding: 0px;\">Software Full Name: AnyMP4 Video Converter Ultimate 2024 Free Download<br></li><li style=\"margin: 0px; padding: 0px;\">Setup File Name: AnyMP4_Video_Converter_Ultimate_8.5.56.rar<br></li><li style=\"margin: 0px; padding: 0px;\">Full Setup Size: 3.5 MB<br></li><li style=\"margin: 0px; padding: 0px;\">Setup Type: Offline Installer / Full Standalone Setup:</li><li style=\"margin: 0px; padding: 0px;\">Compatibility Architecture: 32 Bit (x86) / 64 Bit (x64)</li><li style=\"margin: 0px; padding: 0px;\">Latest Version Release Added On: 07th Jun 2024</li></ul>', '[\"uploads\\/products\\/any_mp4_video_converter_20240608_013555_6663b57b6431a.png\"]', 0, '3.5 MB', 'new', '200.00', '10.00', 'on', 'false', 6, 5, '2024-06-07 19:35:55', '2024-06-07 19:35:55'),
(6, 'Adobe Illustrator 2024', 'adobe-illustrator-2024', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\">Adobe Illustrator 2024&nbsp; Download Latest Version for Windows. It is full offline installer standalone setup of Adobe Illustrator 2024.</span><br></p>', '<h2 style=\"margin: 0.75em 0px 0.25em; padding: 0px; font-size: 26px; letter-spacing: -0.03em; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">Adobe Illustrator 2024 Features</h2><p style=\"margin: 0.25em 0px 0.75em; padding: 0px; line-height: 19.5px; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\">Below are some noticeable features which you will experience after Adobe Illustrator 2024 Free Download</p><ul style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 20px; padding: 0px; list-style-position: outside; line-height: 19.5px; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\"><li style=\"margin: 0px; padding: 0px;\">Allows you to create high-quality logos, icons, drawings, typography and illustrations for print, web, video, and mobile.</li><li style=\"margin: 0px; padding: 0px;\">Ability to design and edit a variety of designs and shapes, logos, logos or badges, boxes, and more.</li><li style=\"margin: 0px; padding: 0px;\">Provides a rich collection of advanced drawing and painting tools allowing you to create captivating and modern illustrations.</li><li style=\"margin: 0px; padding: 0px;\">Supports all the major graphics formats such as EPS, FXG, PSD, TIFF, GIF, JPEG, SWF, SVG, DWG, or DXF.</li><li style=\"margin: 0px; padding: 0px;\">Provides digital photographers and designers with all the fundamental tools and functions they need from creating logos and icons to graphics and vectors.</li><li style=\"margin: 0px; padding: 0px;\">Offers a variety of brushes, text styles and visual effects that will transform your illustrations into visually captivating content.</li><li style=\"margin: 0px; padding: 0px;\">Includes a powerful image-tracing engine that keeps your designs and illustrations clean and accurate.</li><li style=\"margin: 0px; padding: 0px;\">Allows you to adjust the shape of a vector image as well as change its colors and stroke type without any hard efforts.</li><li style=\"margin: 0px; padding: 0px;\">Includes a wide range of robust Illustrator layers allowing you to completely secure your print-sharing designs as multi-page PDF documents</li></ul><h2 style=\"margin: 0.75em 0px 0.25em; padding: 0px; font-size: 26px; letter-spacing: -0.03em; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; text-align: justify;\">Adobe Illustrator 2024 Technical Setup Details</h2><p style=\"margin: 0.25em 0px 0.75em; padding: 0px; line-height: 19.5px; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\">Prior to start Adobe Illustrator 2024 Free Download, ensure the availability of the below listed system specifications</p><ul style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 20px; padding: 0px; list-style-position: outside; line-height: 19.5px; color: rgb(51, 51, 51); font-family: &quot;Segoe UI&quot;, Calibri, &quot;Myriad Pro&quot;, Myriad, &quot;Trebuchet MS&quot;, Helvetica, Arial, sans-serif; font-size: 13px; text-align: justify;\"><li style=\"margin: 0px; padding: 0px;\">Software Full Name:Adobe Illustrator 2024</li><li style=\"margin: 0px; padding: 0px;\">Setup File Name: Adobe_Illustrator_2024_v28.2.0.532.rar<br></li><li style=\"margin: 0px; padding: 0px;\">Setup Size: 1.7 GB<br></li><li style=\"margin: 0px; padding: 0px;\">Setup Type: Offline Installer / Full Standalone Setup</li><li style=\"margin: 0px; padding: 0px;\">Compatibility Mechanical: 32 Bit (x86) / 64 Bit (x64)</li><li style=\"margin: 0px; padding: 0px;\">Latest Version Release Added On: 10th Feb 2024</li></ul>', '[\"uploads\\/products\\/adobe_ai_20240608_014251_6663b71b3b63c.png\",\"uploads\\/products\\/ai_demo1_20240608_014251_6663b71b3da6f.jpg\",\"uploads\\/products\\/ai_demo2_20240608_014251_6663b71b3ddd3.jpg\"]', 4, '1.7GB', 'new', '300.00', '50.00', 'on', 'on', 6, 5, '2024-06-07 19:42:51', '2024-06-07 21:30:53'),
(7, 'Inventory MS (IMS)', 'inventory-ms-ims', '<p>Efficiently manage your inventory with our comprehensive solution. Track stock levels, streamline orders, and optimize warehouse operations effortlessly.<br></p>', '<p><b>User Authentication Module:</b></p><p>Description: This module manages user access to the inventory system. It includes functionalities for user registration, login, and password recovery.</p><p><u>Dashboard Module:</u></p><p>Description: The dashboard provides an overview of key inventory metrics, such as total stock, low-stock alerts, and recent transactions. It serves as a central hub for users to monitor and manage the inventory. Product Management Module: Description: This module allows users to add, edit, or remove products from the inventory. It includes fields for product details, such as name, description, quantity, price, and vendor information.</p><p><u>Inventory Tracking Module:</u></p><p>Description: This module tracks the movement of inventory items, including stock-in and stock-out transactions. It helps maintain an accurate record of inventory levels and provides insights into stock trends.</p><p><u>Order Management Module:</u></p><p>Description: Handles the processing of customer orders, including order creation, order fulfillment, and order status updates. It may also include features for generating invoices and packing slips.</p><p>Supplier Management Module:</p><p>Description: Manages information about suppliers, including contact details, product catalogs, and pricing. This module helps streamline communication with suppliers and ensures accurate procurement.</p><p><u>Alerts and Notifications Module:</u></p><p><span style=\"font-size: 1rem;\">Description: Sends alerts and notifications to users for low-stock levels, pending orders, or other important events. This helps prevent stock outs and ensures timely action on critical inventory matters.</span><br></p><p><span style=\"font-size: 1rem;\"><u>Reporting Module:</u></span><br></p><p><span style=\"font-size: 1rem;\">Description: Generates comprehensive reports on inventory performance, sales trends, and other key metrics. Users can customize reports to gain insights into specific aspects of their inventory.</span><br></p><p><span style=\"font-size: 1rem;\"><u>Barcode Scanning Module:</u></span><br></p><p><span style=\"font-size: 1rem;\">Description: Integrates barcode scanning technology to simplify the process of adding or removing products from the inventory. This enhances accuracy and efficiency in managing stock levels.</span></p>', '[\"uploads\\/products\\/inventory_management_20240608_015716_6663ba7c0956c.png\",\"uploads\\/products\\/Inventory-Management-System-1_20240608_015716_6663ba7c0cc2f.jpg\"]', 10, '40MB', 'new', '12000.00', '2.00', 'on', 'on', 6, 5, '2024-06-07 19:57:16', '2024-06-13 07:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `rating` varchar(10) DEFAULT '5',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `email`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(2, '2', 'admin@gmail.com', 'Feature are less than other', '3', '2024-06-11 21:16:45', '2024-06-11 21:16:45'),
(3, '2', 'admin@gmail.com', 'Got successfully', '5', '2024-06-11 21:17:07', '2024-06-11 21:17:07'),
(4, '2', 'admin@gmail.com', 'Good Product', '5', '2024-06-11 21:48:49', '2024-06-11 21:48:49'),
(5, '7', 'admin@gmail.com', 'Perfect working', '5', '2024-06-11 21:55:30', '2024-06-11 21:55:30');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `email`, `phone`, `address`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `logo`, `favicon`, `currency`, `currency_symbol`, `created_at`, `updated_at`) VALUES
(1, 'E-Shop', 'Our E-shop provides you a great user experience and provides all electronics product at a simple cost.', 'info@techzaint.com', '01611765966', 'Dhaka, Bangladesh', 'https://www.facebook.com/techzaint', 'https://www.twitter.com/techzaint', NULL, NULL, NULL, 'uploads/logo/ngGlzG66NQlah10J5DRtG13X9D07wpVK7JpKHhbR.png', NULL, 'BDT', '৳', '2024-06-05 16:59:32', '2024-06-05 11:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'xs', '2024-06-05 10:36:46', '2024-06-05 10:36:46'),
(2, 'sm', '2024-06-05 10:37:18', '2024-06-05 10:37:18'),
(3, 'md', '2024-06-05 10:41:46', '2024-06-05 10:41:46'),
(4, 'lg', '2024-06-05 10:41:58', '2024-06-05 10:41:58'),
(5, 'xlg', '2024-06-05 10:42:11', '2024-06-05 10:42:11'),
(7, 'None', '2024-06-07 23:06:51', '2024-06-07 23:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `photo`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Munna', 'admin@gmail.com', NULL, '$2y$10$v29c.HHRFLTu6WKMhoGeT.VmFdaScyEp3X.OMzQJ1W6fRq7up0KIG', '01611765966', 'Uttara, Sector-10, Road-12, House-27', 'uploads/users/img1_20240605_023608_665fcf186ae18.jpg', 'admin', NULL, '2024-06-04 19:03:00', '2024-06-13 03:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, '6', '1', '2024-06-12 20:19:51', '2024-06-12 20:19:51'),
(7, '5', '1', '2024-06-12 20:26:24', '2024-06-12 20:26:24'),
(8, '2', '1', '2024-06-12 20:29:34', '2024-06-12 20:29:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `cupons`
--
ALTER TABLE `cupons`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
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
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cupons`
--
ALTER TABLE `cupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
