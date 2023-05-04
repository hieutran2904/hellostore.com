-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2023 at 05:17 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hellostoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL COMMENT 'ADMINS ID',
  `admin_name` varchar(64) NOT NULL,
  `admin_email` varchar(64) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_type` enum('Root Admin','Content Manager','Sales Manager','Technical Operator') NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'CATEGORIES ID',
  `category_name` varchar(64) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'ÁO NAM', 'Active', '0', '2023-04-29 15:25:59', '2023-04-29 15:25:59'),
(2, 'QUẦN NAM', 'Active', '0', '2023-04-29 15:25:59', '2023-04-29 15:25:59'),
(3, 'PHỤ KIỆN', 'Active', '0', '2023-04-29 15:25:59', '2023-04-29 15:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL COMMENT 'CUSTOMERS ID',
  `customer_name` varchar(128) NOT NULL,
  `customer_email` varchar(64) NOT NULL,
  `customer_mobile` varchar(16) NOT NULL,
  `customer_address` varchar(256) NOT NULL,
  `customer_password` varchar(128) NOT NULL,
  `customer_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_email`, `customer_mobile`, `customer_address`, `customer_password`, `customer_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Trần Trung Hiếu', 'hieu29dhxd@gmail.com', '012345678', 'Nam Định', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Active', '0', '2023-04-30 14:01:53', NULL),
(2, 'tester 01', 'test@gmail.com', '123', 'Hà Nội', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Active', '0', '2023-05-03 09:24:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL COMMENT 'DISCOUNTS ID',
  `discount_code` varchar(256) NOT NULL,
  `price_discount_amount` double NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_code`, `price_discount_amount`, `quantity`, `discount_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'hihi', 50000, 100, 'Active', '0', NULL, NULL),
(2, 'haha', 70000, 100, 'Active', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL COMMENT 'INVOICES ID',
  `invoice_id` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_amount` double NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'ORDERS ID',
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `sub_total` double NOT NULL,
  `delivery_charge` double NOT NULL,
  `discount_amount` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_method` enum('Master Card','PayPal','Cash On Delivery') NOT NULL DEFAULT 'Cash On Delivery',
  `transaction_id` varchar(256) NOT NULL,
  `transaction_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Paid',
  `order_item_status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL COMMENT 'ORDER ITEMS ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'PRODUCTS ID',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_summary` varchar(128) NOT NULL,
  `product_details` varchar(512) NOT NULL,
  `product_master_image` text NOT NULL,
  `product_image_one` text DEFAULT NULL,
  `product_image_two` text DEFAULT NULL,
  `product_image_three` text DEFAULT NULL,
  `product_price` double NOT NULL,
  `product_discount_price` double DEFAULT NULL,
  `discount_start` datetime DEFAULT NULL,
  `discount_ends` datetime DEFAULT NULL,
  `product_type` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `product_featured` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `product_tags` varchar(256) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `product_name`, `product_summary`, `product_details`, `product_master_image`, `product_image_one`, `product_image_two`, `product_image_three`, `product_price`, `product_discount_price`, `discount_start`, `discount_ends`, `product_type`, `product_featured`, `product_tags`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 'Áo T-Shirt Glaxy', 'Áo thun nam nữ Galaxy mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-galaxy.jpg', 'img-product-galaxy-1.jpg', 'img-product-galaxy-2.jpg', 'img-product-galaxy-3.jpg', 195000, NULL, NULL, NULL, 'Active', 'NO', 'Áo T-Shirt Nam', '0', NULL, NULL),
(2, 1, 17, 'Áo T-Shirt Happen', 'Áo thun nam nữ Happen mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-happen.jpg', 'img-product-happen-1.jpg', 'img-product-happen-2.jpg', 'img-product-happen-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Áo T-Shirt Nam', '0', NULL, NULL),
(3, 1, 17, 'Áo T-Shirt Cross Cut', 'Áo thun nam nữ Cross Cut mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-cross-cut.jpg', 'img-product-cross-cut-1.jpg', 'img-product-cross-cut-2.jpg', 'img-product-cross-cut-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Áo T-Shirt Nam', '0', NULL, NULL),
(4, 1, 18, 'Áo Polo Zip Sleepy', 'Áo polo ngắn tay Zip Sleepy mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-zip-sleepy.jpg', 'img-product-zip-sleepy-1.jpg', 'img-product-zip-sleepy-2.jpg', 'img-product-zip-sleepy-3.jpg', 259000, NULL, NULL, NULL, 'Active', 'NO', 'Áo Polo Nam', '0', NULL, NULL),
(5, 1, 18, 'Áo Polo Universe', 'Áo polo ngắn tay Universe mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-universe.jpg', 'img-product-universe-1.jpg', 'img-product-universe-2.jpg', 'img-product-universe-3.jpg', 249000, NULL, NULL, NULL, 'Active', 'NO', 'Áo Polo Nam', '0', NULL, NULL),
(6, 1, 18, 'Áo Polo VietNamese City', 'Áo polo ngắn tay VietNamese City mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-vn-city.jpg', 'img-product-vn-city-1.jpg', 'img-product-vn-city-2.jpg', 'img-product-vn-city-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Áo Polo Nam', '0', NULL, NULL),
(7, 2, 23, 'Quần Short Túi Chéo', 'Quần short đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-tui-cheo.jpg', 'img-product-tui-cheo-1.jpg', 'img-product-tui-cheo-2.jpg', 'img-product-tui-cheo-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Quần Short Nam', '0', NULL, NULL),
(8, 2, 23, 'Quần Short Thêu Symbol', 'Quần short đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-symbol.jpg', 'img-product-symbol-1.jpg', 'img-product-symbol-2.jpg', 'img-product-symbol-3.jpg', 249000, NULL, NULL, NULL, 'Active', 'NO', 'Quần Short Nam', '0', NULL, NULL),
(9, 2, 24, 'Quần Baggy Jean Rách', 'Quần jean đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-baggy-jean.jpg', 'img-product-baggy-jean-1.jpg', 'img-product-baggy-jean-2.jpg', 'img-product-baggy-jean-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Quần Jean Nam', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_sc`
--

CREATE TABLE `products_sc` (
  `id` int(11) NOT NULL COMMENT 'PRODUCTS SC ID',
  `product_id` int(11) NOT NULL,
  `product_size` varchar(10) NOT NULL,
  `product_color` varchar(20) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_status` enum('In Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products_sc`
--

INSERT INTO `products_sc` (`id`, `product_id`, `product_size`, `product_color`, `product_quantity`, `product_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 'black', 100, 'In Stock', '0', NULL, NULL),
(2, 1, 'L', 'black', 100, 'In Stock', '0', NULL, NULL),
(3, 1, 'XL', 'black', 100, 'In Stock', '0', NULL, NULL),
(4, 1, 'M', 'white', 100, 'In Stock', '0', NULL, NULL),
(5, 1, 'L', 'white', 100, 'In Stock', '0', NULL, NULL),
(6, 1, 'XL', 'white', 100, 'In Stock', '0', NULL, NULL),
(7, 2, 'M', 'black', 50, 'In Stock', '0', NULL, NULL),
(8, 2, 'L', 'black', 50, 'In Stock', '0', NULL, NULL),
(9, 2, 'XL', 'black', 50, 'In Stock', '0', NULL, NULL),
(10, 2, 'M', 'beige', 50, 'In Stock', '0', NULL, NULL),
(11, 2, 'L', 'beige', 50, 'In Stock', '0', NULL, NULL),
(12, 2, 'XL', 'beige', 50, 'In Stock', '0', NULL, NULL),
(13, 2, 'M', 'brown', 50, 'In Stock', '0', NULL, NULL),
(14, 2, 'L', 'brown', 50, 'In Stock', '0', NULL, NULL),
(15, 2, 'XL', 'brown', 50, 'In Stock', '0', NULL, NULL),
(16, 3, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(17, 3, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(18, 3, 'XL', 'brown', 10, 'In Stock', '0', NULL, NULL),
(19, 3, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(20, 3, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(21, 3, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(22, 4, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(23, 4, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(24, 4, 'XL', 'brown', 10, 'In Stock', '0', NULL, NULL),
(25, 4, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(26, 4, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(27, 4, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(28, 5, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(29, 5, 'XL', 'black', 11, 'In Stock', '0', NULL, NULL),
(30, 5, 'M', 'white', 12, 'In Stock', '0', NULL, NULL),
(31, 5, 'L', 'white', 13, 'In Stock', '0', NULL, NULL),
(32, 5, 'XL', 'white', 14, 'In Stock', '0', NULL, NULL),
(33, 6, 'M', 'green', 10, 'In Stock', '0', NULL, NULL),
(34, 6, 'L', 'green', 10, 'In Stock', '0', NULL, NULL),
(35, 6, 'XL', 'green', 10, 'In Stock', '0', NULL, NULL),
(36, 7, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(37, 7, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(38, 7, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(39, 7, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(40, 7, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(41, 7, 'XL', 'brown', 10, 'In Stock', '0', NULL, NULL),
(42, 7, 'M', 'beige', 10, 'In Stock', '0', NULL, NULL),
(43, 7, 'L', 'beige', 10, 'In Stock', '0', NULL, NULL),
(44, 7, 'XL', 'beige', 10, 'In Stock', '0', NULL, NULL),
(45, 8, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(46, 8, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(47, 8, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(48, 8, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(49, 8, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(50, 8, 'XL', 'brown', 10, 'In Stock', '0', NULL, NULL),
(51, 9, 'M', 'cyan', 10, 'In Stock', '0', NULL, NULL),
(52, 9, 'L', 'cyan', 10, 'In Stock', '0', NULL, NULL),
(53, 9, 'XL', 'cyan', 10, 'In Stock', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL COMMENT 'REVIEW ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `review_details` varchar(512) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL DEFAULT '5',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(11) NOT NULL COMMENT 'SHIPPING ID',
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shipping_name` varchar(128) NOT NULL,
  `shipping_email` varchar(128) NOT NULL,
  `shipping_phone` varchar(128) NOT NULL,
  `shipping_address` varchar(512) NOT NULL,
  `shipping_city` varchar(128) NOT NULL,
  `shipping_zipcode` varchar(128) NOT NULL,
  `shipping_country` varchar(128) NOT NULL DEFAULT 'Việt Nam',
  `shipping_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopcarts`
--

CREATE TABLE `shopcarts` (
  `id` int(11) NOT NULL COMMENT 'SHOPCART ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shopcarts`
--

INSERT INTO `shopcarts` (`id`, `customer_id`, `product_sc_id`, `quantity`, `is_delete`, `created_at`, `updated_at`) VALUES
(17, 1, 1, 1, '0', '2023-05-03 10:06:56', NULL),
(18, 1, 25, 1, '0', '2023-05-03 10:12:16', NULL),
(19, 1, 16, 1, '0', '2023-05-03 10:28:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL COMMENT 'SLIDER ID',
  `slider_title` varchar(128) NOT NULL,
  `slider_image` text NOT NULL,
  `slider_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `slider_sequence` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL COMMENT 'SUBCATEGORIES ID',
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(128) NOT NULL,
  `subcategory_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `subcategory_banner` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_status`, `subcategory_banner`, `is_delete`, `created_at`, `updated_at`) VALUES
(17, 1, 'Áo T-Shirt', 'Active', 'img-subcategory.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(18, 1, 'Áo Polo', 'Active', 'img-subcategory1.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(19, 1, 'Áo Sơ Mi', 'Active', 'img-subcategory2.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(20, 1, 'Áo Khoác', 'Active', 'img-subcategory3.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(21, 1, 'Áo Vest', 'Active', 'img-subcategory4.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(22, 1, 'Áo Hoodie', 'Active', 'img-subcategory5.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(23, 2, 'Quần Short', 'Active', 'img-subcategory6.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(24, 2, 'Quần Jean', 'Active', 'img-subcategory7.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(25, 2, 'Quần Jogger', 'Active', 'img-subcategory8.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(26, 2, 'Quần Kaki', 'Active', 'img-subcategory9.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(27, 2, 'Quần Âu', 'Active', 'img-subcategory10.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(28, 2, 'Quần Dài', 'Active', 'img-subcategory11.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(29, 3, 'Mũ(Nón)', 'Active', 'img-subcategory12.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(30, 3, 'Tất(Vớ)', 'Active', 'img-subcategory13.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(31, 3, 'Dây Nịt', 'Active', 'img-subcategory14.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57'),
(32, 3, 'Túi Xách', 'Active', 'img-subcategory15.jpg', '0', '2023-04-29 15:38:57', '2023-04-29 15:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL COMMENT 'WISHLIST ID',
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
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
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_sc_id` (`product_sc_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `products_sc`
--
ALTER TABLE `products_sc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_sc_id` (`product_sc_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_sc_id` (`product_sc_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ADMINS ID';

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CATEGORIES ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CUSTOMERS ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DISCOUNTS ID', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'INVOICES ID';

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDERS ID';

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDER ITEMS ID';

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRODUCTS ID', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_sc`
--
ALTER TABLE `products_sc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRODUCTS SC ID', AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'REVIEW ID';

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHIPPING ID';

--
-- AUTO_INCREMENT for table `shopcarts`
--
ALTER TABLE `shopcarts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHOPCART ID', AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SLIDER ID';

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SUBCATEGORIES ID', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'WISHLIST ID';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_4` FOREIGN KEY (`product_sc_id`) REFERENCES `products_sc` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `products_sc`
--
ALTER TABLE `products_sc`
  ADD CONSTRAINT `products_sc_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_sc_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_sc_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_sc_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_sc_id`) REFERENCES `products_sc` (`id`);

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `shippings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD CONSTRAINT `shopcarts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `shopcarts_ibfk_2` FOREIGN KEY (`product_sc_id`) REFERENCES `products_sc` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `subcategories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `subcategories_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
