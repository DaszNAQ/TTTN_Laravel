-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 06:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Apple', NULL, NULL, NULL),
(2, 'Samsung', NULL, NULL, NULL),
(3, 'Sony', NULL, NULL, NULL),
(4, 'Dell', NULL, NULL, NULL),
(5, 'HP', NULL, NULL, NULL),
(6, 'Oppo', NULL, NULL, NULL),
(7, 'Xiaomi', NULL, NULL, NULL),
(8, 'Asus', NULL, NULL, NULL),
(9, 'Acer', NULL, NULL, NULL),
(10, 'Lenovo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Điện thoại', NULL, NULL, NULL),
(2, 'Laptop', NULL, NULL, NULL),
(3, 'Tablet', NULL, NULL, NULL),
(4, 'Đồng hồ', NULL, NULL, NULL),
(5, 'Phụ kiện', NULL, NULL, NULL),
(6, 'Tai nghe', NULL, NULL, NULL),
(7, 'Tivi', NULL, NULL, NULL),
(8, 'Camera', NULL, NULL, NULL),
(9, 'Máy tính bảng', NULL, NULL, NULL),
(10, 'Đồ gia dụng', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Khách hàng 1', '0909226963', 'customer1@gmail.com', 'Địa chỉ 1', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(2, 'Khách hàng 2', '0909998532', 'customer2@gmail.com', 'Địa chỉ 2', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(3, 'Khách hàng 3', '0909683131', 'customer3@gmail.com', 'Địa chỉ 3', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(4, 'Khách hàng 4', '0902175926', 'customer4@gmail.com', 'Địa chỉ 4', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(5, 'Khách hàng 5', '0901677788', 'customer5@gmail.com', 'Địa chỉ 5', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(6, 'Khách hàng 6', '0909913645', 'customer6@gmail.com', 'Địa chỉ 6', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(7, 'Khách hàng 7', '0908014057', 'customer7@gmail.com', 'Địa chỉ 7', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(8, 'Khách hàng 8', '0901776888', 'customer8@gmail.com', 'Địa chỉ 8', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(9, 'Khách hàng 9', '0905139564', 'customer9@gmail.com', 'Địa chỉ 9', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(10, 'Khách hàng 10', '0903320477', 'customer10@gmail.com', 'Địa chỉ 10', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL);

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_04_27_133921_create_categories_table', 1),
(3, '2025_04_27_133929_create_brands_table', 1),
(4, '2025_04_27_133933_create_products_table', 1),
(5, '2025_04_27_133938_create_users_table', 1),
(6, '2025_04_27_133942_create_customers_table', 1),
(7, '2025_04_27_133946_create_orders_table', 1),
(8, '2025_04_27_133950_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `note`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Ghi chú đơn hàng 1', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(2, 2, 'Ghi chú đơn hàng 2', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(3, 3, 'Ghi chú đơn hàng 3', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(4, 4, 'Ghi chú đơn hàng 4', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(5, 5, 'Ghi chú đơn hàng 5', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(6, 6, 'Ghi chú đơn hàng 6', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(7, 7, 'Ghi chú đơn hàng 7', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(8, 8, 'Ghi chú đơn hàng 8', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(9, 9, 'Ghi chú đơn hàng 9', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(10, 10, 'Ghi chú đơn hàng 10', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 7, 3, 5718000.00, '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(2, 2, 7, 3, 7056000.00, '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(3, 7, 6, 2, 7934000.00, '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL);

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
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `brand_id`, `price`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'iPhone 14 Pro Max', 1, 1, 33990000.00, 'Điện thoại cao cấp của Apple', 'products/9yvyjqcAL2P2NRPb4JPLYJ6G8Q4NmB5QF8FfdeTb.webp', '2025-04-27 06:49:53', '2025-04-27 08:08:15', NULL),
(2, 'Samsung Galaxy S24 Ultra', 1, 2, 29990000.00, 'Điện thoại flagship mới nhất của Samsung', 'products/PIbU4aM3iXG7SCIiL8Bl8z6GzvVI0weFhbnW3hV4.webp', '2025-04-27 06:49:53', '2025-04-28 01:59:08', NULL),
(3, 'Dell XPS 13 9315', 2, 4, 38990000.00, 'Laptop mỏng nhẹ, hiệu năng mạnh mẽ', 'products/QvKis2eqP91yQt60cx7VqYjIAE9nDMY4h9x3F8eP.webp', '2025-04-27 06:49:53', '2025-04-28 01:59:14', NULL),
(4, 'MacBook Pro M2 2023', 2, 1, 46990000.00, 'Laptop Apple chip M2 cực mạnh', 'products/saBXaznTXhh5gdzkrhXhw6tjCbmi2OgBsiKoK2fx.jpg', '2025-04-27 06:49:53', '2025-04-28 01:59:21', NULL),
(5, 'iPad Air 5', 3, 1, 16990000.00, 'Máy tính bảng mạnh mẽ cho học tập và làm việc', 'products/1p6Ss6cBHgqOKAHHPlEjySHPZF41TQiuNPwfg2cS.webp', '2025-04-27 06:49:53', '2025-04-28 01:59:29', NULL),
(6, 'Samsung Galaxy Tab S9', 3, 2, 20990000.00, 'Máy tính bảng Android cao cấp', 'products/gmNZPpAqF8D6YffAwXWVfLPN3j6XFpWoxfR6MWY2.jpg', '2025-04-27 06:49:53', '2025-04-28 01:59:39', NULL),
(7, 'Apple Watch Series 9', 4, 1, 11990000.00, 'Đồng hồ thông minh cao cấp Apple', 'products/sR3SfdLPhpVelMn2C1NjsyEGYWt7JiQ9b6XeA3q7.webp', '2025-04-27 06:49:53', '2025-04-28 01:59:52', NULL),
(8, 'Samsung Galaxy Watch 6', 4, 2, 7990000.00, 'Đồng hồ thông minh mới nhất của Samsung', 'products/mmHzMslBmmSDzVOuLLfwR3CYCxFo2RS9PNvbTO1X.jpg', '2025-04-27 06:49:53', '2025-04-28 02:00:02', NULL),
(9, 'Tai nghe AirPods Pro 2', 5, 1, 5990000.00, 'Tai nghe không dây chống ồn Apple', 'products/WdbhSIP9tY1UT1IvBMH8thfja9AFCppykaFiIvhT.jpg', '2025-04-27 06:49:53', '2025-04-28 02:00:11', NULL),
(10, 'Tai nghe Samsung Buds2 Pro', 5, 2, 4990000.00, 'Tai nghe Bluetooth cao cấp Samsung', 'products/DCR0JLEECqhFM1CUPFvpxtKuMdg5bGI0E4MCnCYF.jpg', '2025-04-27 06:49:53', '2025-04-28 02:00:20', NULL),
(11, 'Samsung Galaxy A06 4GB/64GB', 1, 2, 2000000.00, 'Nếu bạn đang tìm kiếm một chiếc điện thoại thông minh vừa mạnh mẽ vừa tinh tế, Samsung Galaxy A06 4GB/64GB chính là lựa chọn hoàn hảo cho bạn', 'products/Vpv9yKVV69BlMxm6FwuZI1ExlG7q1pyvAbjbN1Jg.jpg', '2025-05-09 20:19:07', '2025-05-09 20:19:07', NULL),
(12, 'Xiaomi Redmi Note 13 6GB/128GB', 1, 7, 3300000.00, 'Xiaomi Redmi Note 13 6GB/128GB là chiếc smartphone mới nhất của Xiaomi trong phân khúc giá rẻ.', 'products/ulETmf9GTI8zVDyAGO4BIg6VcFVSgrrJwwI0MYy2.jpg', '2025-05-09 20:20:39', '2025-05-09 20:20:39', NULL),
(13, 'iPhone 15 Pro Max', 1, 1, 27000000.00, 'iPhone 15 Pro Max 256GB đã chính thức ra mắt, mang đến một bước tiến đáng kể trong dòng iPhone cao cấp của Apple', 'products/20T4GLr1tUYvvEILHnGys4d8o06W66vn7SIdB7uX.jpg', '2025-05-09 20:37:46', '2025-05-09 20:37:46', NULL),
(14, 'iPhone 13 Pro Max 256GB', 1, 1, 15000000.00, 'Dù ra mắt hơn 2 năm, iPhone 13 Pro Max 256GB cũ đẹp vẫn nằm trong top lựa chọn cho người yêu thích sự hoàn hảo.', 'products/c46Pv2H8sa6KKCwGOzrTyqfYmY8cx1YATm78o7tU.jpg', '2025-05-09 20:38:18', '2025-05-09 20:38:18', NULL),
(15, 'iPhone 12 Pro Max', 1, 1, 10000000.00, 'Dù đã ra mắt một thời gian khá lâu, iPhone 12 Pro Max 128GB cũ 99% vẫn là \'ông hoàng\' trong lòng người dùng.', 'products/YqxiiM33j51e1JcpY4e6Hd88W82mmwqUEFxhvQse.jpg', '2025-05-09 20:38:52', '2025-05-09 20:38:52', NULL),
(16, 'iPhone 11 Pro Max', 1, 1, 8500000.00, 'iPhone 11 Pro Max vẫn là điểm sáng lớn trong các dòng smartphone khi sở hữu màn hình lớn, cấu hình mạnh mẽ cùng chip A13 Bionic', 'products/gjHdLnsCrYU3Q4ki7IJFWKEEpb8942v89Dr6fBmO.jpg', '2025-05-09 20:39:29', '2025-05-09 20:39:29', NULL),
(17, 'Google Tivi Sony 4K 65 inch K-65S30', 7, 3, 17000000.00, 'Màn hình ấn tượng của Google Tivi Mini LED Sony 4K 65 inch K-65S30 kết hợp cùng độ phân giải hình ảnh 4K', 'products/p38XR3RnJIjlAxhEAQC9JJMgRzIVM9ACCsKZ8YUz.png', '2025-05-09 20:41:46', '2025-05-09 20:41:46', NULL),
(18, 'MacBook Pro M4 14 Inch 10 CPU 10 GPU', 2, 1, 40000000.00, 'Sau nhiều đồn đoán và mong chờ, Apple đã chính thức ra mắt mẫu MacBook Pro M4 14 inch 1TB, đánh dấu một bước tiến mới trong dòng sản phẩm laptop cao cấp của hãng', 'products/xBPPrhXxoW7PMyCWOnn4MMDS0FPRhygJAte6hox8.jpg', '2025-05-09 20:44:59', '2025-05-09 20:44:59', NULL),
(19, 'Apple Watch Series 8 45mm GPS', 4, 1, 4500000.00, 'Apple Watch Series 8 GPS 45mm được ra mắt tại sự kiện Far Out ngày 8/9 Giờ Việt Nam vừa qua cùng với hàng loạt sản phẩm công nghệ khác như iPhone 14 Series, Apple Watch Ultra, Apple Watch SE 2 hay AirPods Pro 2.', 'products/Z4FSZaocFqqGvfBc8LvUKeDtDxjash6FCS5Aoev7.jpg', '2025-05-09 20:46:52', '2025-05-09 20:46:52', NULL),
(20, 'Samsung Galaxy Tab S10 FE', 3, 2, 8000000.00, 'Bạn đang tìm một chiếc tablet tầm trung mạnh mẽ, đa năng và hợp túi tiền? Galaxy Tab S10 FE Wifi có thể là câu trả lời! Với thiết kế sang trọng, bút S Pen thông minh, màn hình sắc nét và loạt tính năng AI hiện đại', 'products/HjcyIt7r4TcFuoyJvTpXnuuXb03MrZesOcuIF2Ie.jpg', '2025-05-09 20:48:37', '2025-05-09 20:48:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$cb4pnA2KiBzd7MJ5DIW6j.99xjCztVXt6vXeeakarJHn6uT5X3bWi', 'admin', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(2, 'User 1', 'user1@gmail.com', '$2y$10$KC5ehxqxBXctIgxhVfnF6uBP.rYQpih8TfESkDC/QSJJYt6.piD1i', 'user', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(3, 'User 2', 'user2@gmail.com', '$2y$10$DTeUssy9DaNc2yE.0/Ft7.BxuWAVWWhVfpjuWzTXRf4n.ZD6.9ZAa', 'user', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(4, 'User 3', 'user3@gmail.com', '$2y$10$l0VLhPM/b1i74uGG9JPD5.9GsWjUOMubHhUDAOCcchEDovRYAyRty', 'user', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(5, 'User 4', 'user4@gmail.com', '$2y$10$BeE6tQNEijG7wsW/VFWEnOzqtYoRMiM4EYMuLdiQ5YFJ04Lj8RsXi', 'user', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(6, 'User 5', 'user5@gmail.com', '$2y$10$.nhNE.4ISMaHd/4dOBwh..wDwKazJ7v1zh8J9YzDIY6F/QkuoyVo6', 'user', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(7, 'User 6', 'user6@gmail.com', '$2y$10$PbULYl9bAzum.kAZZUYNjeKRIJ6qO3zIFLa1LpxLV3OHT4X289tlO', 'user', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(8, 'User 7', 'user7@gmail.com', '$2y$10$BjFOTrJJnEs0LypFrJddLu0PgEmZKo51quhuS1iiSrC0hjj4YkZau', 'user', '2025-04-27 06:49:53', '2025-04-27 06:49:53', NULL),
(9, 'User 8', 'user8@gmail.com', '$2y$10$O9t11byi82Bk/nf2aHL1T.h/TGr0AwQ0ZTXVoVjMalsYIUqi2R.V6', 'user', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(10, 'User 9', 'user9@gmail.com', '$2y$10$ryzqF.fWDN0qiD10yJBaXuHpDsRkpctxnWNmtSMg5xHv9.MruchCO', 'user', '2025-04-27 06:49:54', '2025-04-27 06:49:54', NULL),
(11, 'naq', 'nq6122003@gmail.com', '$2y$10$qh0HBI2wijfnvMRdUd1bTOhMzTqZjetTg4UYyXrXChlSHU2rhoWza', 'admin', '2025-04-27 18:49:30', '2025-05-09 20:13:50', NULL),
(12, 'quanUser', 'pokemmo612@gmail.com', '$2y$10$YeGjV4FCCb.tyJX7cF4FgOiDfUPsVN2WVmfdYfJOdKwbrG2e6/52i', 'user', '2025-04-27 19:42:20', '2025-05-09 21:06:28', NULL),
(13, 'pocketUser', 'nn6593@gmail.com', '$2y$10$FnWELidb73QJ91el5ILTeOd2lrxa5Dca7Az2ubp2nUPZnNt.ecSoK', 'user', '2025-04-27 21:40:49', '2025-04-27 21:40:49', NULL);

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
  ADD KEY `products_brand_id_foreign` (`brand_id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
