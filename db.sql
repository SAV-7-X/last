-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 05:36 AM
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
-- Database: `aniket_exe`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `total_value` float NOT NULL DEFAULT 0,
  `discount_value` float DEFAULT 0,
  `final_value` float GENERATED ALWAYS AS (`total_value` - `discount_value`) STORED,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `coupon_id`, `quantity`, `total_value`, `discount_value`, `created_at`, `updated_at`) VALUES
(12, 15, '1', NULL, '2', 999, 999, '2025-05-09 21:24:45', '2025-05-09 21:24:45');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `type` enum('regular','featured','promotional','seasonal','special') NOT NULL DEFAULT 'regular',
  `visibility` enum('visible','hidden') NOT NULL DEFAULT 'visible',
  `filters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`filters`)),
  `featured_products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`featured_products`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `parent_id`, `image`, `display_order`, `type`, `visibility`, `filters`, `featured_products`, `created_at`, `updated_at`) VALUES
(1, 'Chair', 'Chair', 'Cozy Sofa for you', NULL, 'categories/x48aoAg52593dUxK1fczHVFmgyLJMzOwLEFs4lZb.png', 0, 'regular', 'hidden', '[]', '[]', NULL, NULL),
(2, 'Living Room', 'living-room', 'Furniture for your living room space', NULL, NULL, 1, 'regular', 'visible', NULL, NULL, NULL, NULL),
(3, 'Dining', 'dining', 'Tables, chairs and cabinets for dining area', NULL, NULL, 2, 'featured', 'visible', NULL, NULL, NULL, NULL),
(4, 'Bedroom', 'bedroom', 'Beds, wardrobes and other bedroom furniture', NULL, NULL, 3, 'seasonal', 'visible', NULL, NULL, NULL, NULL),
(5, 'Office', 'office', 'Desks, chairs and storage for your work space', NULL, NULL, 4, 'promotional', 'hidden', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `click_events`
--

CREATE TABLE `click_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `page` varchar(100) NOT NULL,
  `element_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('fixed','percentage') NOT NULL,
  `value` float NOT NULL,
  `description` text DEFAULT NULL,
  `min_cart_value` float DEFAULT 0,
  `max_usage` int(11) DEFAULT 0,
  `usage_count` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `likeable_type` varchar(255) NOT NULL,
  `likeable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_ref_id` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid','failed') DEFAULT 'pending',
  `order_status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `shipping_address` text DEFAULT NULL,
  `shipping_city` varchar(100) DEFAULT NULL,
  `shipping_zipcode` varchar(20) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_transaction_id` varchar(100) DEFAULT NULL,
  `payment_notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_ref_id`, `user_id`, `product_id`, `quantity`, `price`, `payment_status`, `order_status`, `notes`, `created_at`, `updated_at`, `shipping_address`, `shipping_city`, `shipping_zipcode`, `payment_method`, `payment_transaction_id`, `payment_notes`) VALUES
(1, 'ORD-680EE392C0200', 2, 1, 1, 999.00, 'paid', 'pending', 'No', '2025-04-27 20:41:02', '2025-05-08 17:10:12', 'New Vairihwa Colony Basti\n', 'Basti', '272001', 'cash_on_delivery', '#123455678', 'No');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sku` varchar(100) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `discount_price`, `stock`, `image`, `category`, `description`, `sku`, `tags`, `views`, `is_featured`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nordic Chair', 'nordic-chair', 1499.00, 999.00, 17, 'products/0C8aw2dHSGcMezXXqAwGTJ3TY6jpCvao01RATmlH.png', 'Chair', 'Nordic New Chair', 'nc_01', 'nordic_chair', 0, 1, 1, '2025-04-27 11:47:52', '2025-04-27 11:47:52', NULL),
(2, 'Milano Modern Sofa', 'milano-modern-sofa', 89999.00, 109999.00, 10, 'products/sofa.jpg', 'Living Room', 'Three-seater sofa with premium fabric upholstery and solid wooden legs. Perfect centerpiece for any modern living room.', 'LR-SOFA-001', 'Premium,Comfortable,Fabric', 0, 1, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(3, 'Aspen Dining Table', 'aspen-dining-table', 64999.00, NULL, 8, 'products/dining-table.jpg', 'Dining', 'Solid wood dining table for 6 people with elegant design and superior craftsmanship.', 'DIN-TBL-002', 'Solid Wood,Handcrafted,6-Seater', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(4, 'Vienna King Bed', 'vienna-king-bed', 94999.00, NULL, 5, 'products/king-bed.jpg', 'Bedroom', 'Elegant king size bed with upholstered headboard and solid wood frame. Includes slats for mattress support.', 'BED-KING-003', 'King Size,Memory Foam,Premium', 0, 1, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(5, 'Executive Office Desk', 'executive-office-desk', 49999.00, NULL, 12, 'products/office-desk.jpg', 'Office', 'Modern desk with storage and cable management. Features drawers and built-in organizational compartments.', 'OFF-DESK-004', 'Ergonomic,Cable Management,Storage', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(6, 'Scandinavian Armchair', 'scandinavian-armchair', 34999.00, 41999.00, 15, 'products/armchair.jpg', 'Living Room', 'Minimalist design with maximum comfort. Features soft fabric upholstery and solid wooden legs.', 'LR-CHAIR-005', 'Scandinavian,Cozy,Modern', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(7, 'Dining Chairs Set of 4', 'dining-chairs-set', 49999.00, NULL, 7, 'products/dining-chairs.jpg', 'Dining', 'Elegant dining chairs with wooden legs and fabric seats. Sold as a set of 4 matching chairs.', 'DIN-CHR-006', 'Set of 4,Upholstered,Comfortable', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(8, 'Modern Wardrobe', 'modern-wardrobe', 84999.00, NULL, 4, 'products/wardrobe.jpg', 'Bedroom', 'Spacious wardrobe with sliding doors and interior organization. Features multiple shelves and hanging spaces.', 'BED-WRD-007', 'Sliding Doors,Spacious,Storage', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(9, 'Ergonomic Office Chair', 'ergonomic-office-chair', 29999.00, NULL, 20, 'products/office-chair.jpg', 'Office', 'Premium office chair with adjustable features for maximum comfort during long work hours.', 'OFF-CHR-008', 'Adjustable,Lumbar Support,Ergonomic', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(10, 'Luxury Coffee Table', 'luxury-coffee-table', 24999.00, 29999.00, 10, 'products/coffee-table.jpg', 'Living Room', 'Modern coffee table with glass top and wooden base. Perfect for contemporary living rooms.', 'LR-TBL-009', 'Glass Top,Modern,Storage', 0, 1, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(11, 'Study Bookshelf', 'study-bookshelf', 39999.00, NULL, 8, 'products/bookshelf.jpg', 'Office', 'Tall bookshelf with multiple compartments for books and decorative items.', 'OFF-SHLF-010', 'Bookshelf,Spacious,Multi-tier', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(12, 'Queen Size Bed', 'queen-size-bed', 74999.00, 89999.00, 6, 'products/queen-bed.jpg', 'Bedroom', 'Elegant queen size bed with wooden headboard and sturdy construction.', 'BED-QUEEN-011', 'Queen Size,Wooden,Elegant', 0, 0, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL),
(13, 'Dining Buffet Cabinet', 'dining-buffet-cabinet', 59999.00, NULL, 5, 'products/buffet-cabinet.jpg', 'Dining', 'Spacious dining cabinet for storing dinnerware, with both open and closed storage options.', 'DIN-CAB-012', 'Storage,Wooden,Elegant', 0, 1, 1, '2025-04-29 01:30:24', '2025-04-29 01:30:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed','cancelled') NOT NULL DEFAULT 'pending',
  `deadline` date DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_members`
--

CREATE TABLE `project_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'member',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login_at` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_photo_path` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `last_login_at`, `password`, `phone`, `address`, `profile_photo_path`, `remember_token`, `created_at`, `updated_at`, `role`, `status`) VALUES
(1, 'Aniket', 'aniket_admin@gmail.com', '2025-03-19 12:32:39', NULL, '$2y$12$8OMbQwzdaVECJdKSmf4mV.CsMvNecklrAcwLgAHHS3BiZI0RvDUiO', NULL, NULL, NULL, 'r4hsa2VY1XUhcSMJeHl1TTW6lc515JqukT6FizURPhESemsoAEVR16wpVB9V', '2025-03-19 12:32:40', '2025-03-20 11:04:45', 'admin', 'active'),
(2, 'Adarsh Verma', 'sav7crack@gmail.com', NULL, NULL, '$2y$12$ciNzrE0Lwo7OFhv4bEMRW.qvkFXi0nKM6D2m/enAqWVeYOaccJFAe', NULL, NULL, NULL, NULL, '2025-03-19 12:58:51', '2025-03-21 01:00:32', 'customer', 'inactive'),
(5, 'John Doe', 'johndoe@example.com', '2025-03-19 13:15:00', NULL, '$2y$12$VqAKx.CLOSHHDHFlz1lKw.kW0z4LBcxUUsOa/Fd6P3fgDhFhwHggu', NULL, NULL, NULL, 'randomtoken123', '2025-03-19 13:15:00', '2025-03-19 13:15:00', 'customer', 'active'),
(6, 'Jane Smith', 'janesmith@example.com', '2025-03-19 13:20:00', NULL, '$2y$12$CkqNzzkgFdhVbs9G2ErFe2XhcoS.JDbDDpXJ0Qw8.s5kFC7YNEIiS', NULL, NULL, NULL, 'randomtoken456', '2025-03-19 13:20:00', '2025-03-19 13:20:00', 'customer', 'active'),
(7, 'Michael Johnson', 'michaelj@example.com', '2025-03-19 13:30:00', NULL, '$2y$12$GSHqZnUwaFzriqZg8BsDhw1FwXyvMk1zOZy4YZtxDpi1b5NwlT7yW', NULL, NULL, NULL, 'randomtoken789', '2025-03-19 13:30:00', '2025-03-19 13:30:00', 'customer', 'inactive'),
(8, 'Sarah Lee', 'sarahlee@example.com', '2025-03-19 13:35:00', NULL, '$2y$12$MIQFJcYSy8Zq8jqF2JXn3rF5OZgQ6.9QY4IjqV0XQK1yGHEr.jRYy', NULL, NULL, NULL, 'randomtoken012', '2025-03-19 13:35:00', '2025-03-19 13:35:00', 'customer', 'active'),
(9, 'David Wilson', 'davidwilson@example.com', '2025-03-19 13:40:00', NULL, '$2y$12$eQ7O4h6f5c.4.J0oLZoFhwFykjWlEZGzJhXq94A9rfmrCkNe4cUGa', NULL, NULL, NULL, 'randomtoken345', '2025-03-19 13:40:00', '2025-03-19 13:40:00', 'customer', 'inactive'),
(10, 'Olivia Brown', 'oliviabrown@example.com', '2025-03-19 13:50:00', NULL, '$2y$12$P5Htbh5D4Qvevj74L9W2g7fZUbv6VFA2I2eFFzFuP9HqdXzAkBqFC', NULL, NULL, NULL, 'randomtoken678', '2025-03-19 13:50:00', '2025-03-19 13:50:00', 'customer', 'active'),
(11, 'James Taylor', 'jamestaylor@example.com', '2025-03-19 13:55:00', NULL, '$2y$12$hEjzwFr4vNePvPA2y9zQmKJ5fqlS02gMFSInqP5tb3GlxZYow8lSu', NULL, NULL, NULL, 'randomtoken901', '2025-03-19 13:55:00', '2025-03-19 13:55:00', 'customer', 'inactive'),
(12, 'Emily Davis', 'emilydavis@example.com', '2025-03-19 14:00:00', NULL, '$2y$12$AqBEnDXsqF9mgbROEY9sdskc5BzHpqsnFY9TZw3cPOiF3d3IaFrr6', NULL, NULL, NULL, 'randomtoken234', '2025-03-19 14:00:00', '2025-03-19 14:00:00', 'customer', 'inactive'),
(13, 'Chris White', 'chriswhite@example.com', '2025-03-19 14:05:00', NULL, '$2y$12$Zl7fdd9kds9Ihqltfrpm9XfeLUHg4fxG0FmS0KvHTsOaOgWj30nPa', NULL, NULL, NULL, 'randomtoken567', '2025-03-19 14:05:00', '2025-03-19 14:05:00', 'customer', 'active'),
(14, 'Laura Green', 'lauragreen@example.com', '2025-03-19 14:10:00', NULL, '$2y$12$5nO5V0vYtDk7xjk9VHYWcR5O6R3lQd08MgtweGL4gqMh0d9bzvq1S', NULL, NULL, NULL, 'randomtoken890', '2025-03-19 14:10:00', '2025-03-19 14:10:00', 'customer', 'inactive'),
(15, 'Adarsh', 'user_a@gmail.com', NULL, NULL, '$2y$12$LBiH1RwT5oGHzNEwexrEyeDgCAzBsT4soXvh01w6Ay7DRioTFbWh.', '09454002295', 'New Vairihwa Colony Basti\nNew Vairihwa Colony Basti', 'profile-photos/profile-15-1746848098.png', 'uUxC2T4xKSfaazkPuGcWLPkyd9Qn8WhhpNerNNbGRJJZxL6RotV5yr7K4p0g', '2025-05-09 18:53:05', '2025-05-09 22:04:58', 'customer', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_index` (`parent_id`),
  ADD KEY `categories_type_index` (`type`),
  ADD KEY `categories_visibility_index` (`visibility`);

--
-- Indexes for table `click_events`
--
ALTER TABLE `click_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `click_events_user_id_foreign` (`user_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_likeable_type_likeable_id_index` (`likeable_type`,`likeable_id`);

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
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_team_id_foreign` (`team_id`);

--
-- Indexes for table `project_members`
--
ALTER TABLE `project_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `project_members_project_id_user_id_unique` (`project_id`,`user_id`),
  ADD KEY `project_members_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `click_events`
--
ALTER TABLE `click_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_members`
--
ALTER TABLE `project_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `click_events`
--
ALTER TABLE `click_events`
  ADD CONSTRAINT `click_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_members`
--
ALTER TABLE `project_members`
  ADD CONSTRAINT `project_members_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
