CREATE TABLE `admins` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ADMINS ID',
  `admin_name` varchar(64) NOT NULL,
  `admin_email` varchar(64) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_type` enum('Root Admin','Content Manager','Sales Manager','Technical Operator') NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'CUSTOMERS ID',
  `customer_name` varchar(128) NOT NULL,
  `customer_email` varchar(64) NOT NULL,
  `customer_mobile` varchar(16) NOT NULL,
  `customer_address` varchar(256) NOT NULL,
  `customer_password` varchar(128) NOT NULL,
  `customer_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `products` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'PRODUCTS ID',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_summary` varchar(128) NOT NULL,
  `product_details` varchar(512) NOT NULL,
  `product_master_image` text NOT NULL,
  `product_image_one` text NULL,
  `product_image_two` text NULL,
  `product_image_three` text NULL,
  `product_price` double NOT NULL,
  `product_discount_price` double NULL,
  `discount_start` datetime NULL,
  `discount_ends` datetime NULL,
  `product_type` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `product_featured` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `product_tags` varchar(256) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `products_sc` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'PRODUCTS SC ID',
  `product_id` int(11) NOT NULL,
  `product_size` varchar(10) NOT NULL,
  `product_color` varchar(20) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_status` enum('In Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'CATEGORIES ID',
  `category_name` varchar(64) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'SUBCATEGORIES ID',
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(128) NOT NULL,
  `subcategory_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `subcategory_banner` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'DISCOUNTS ID',
  `discount_code` varchar(256) NOT NULL,
  `price_discount_amount` double NOT NULL,
  `quantity` int(11) null,
  `discount_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ORDERS ID',
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `sub_total` double NOT NULL,
  `delivery_charge` int(11) NOT NULL,
  `discount_amount` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_method` enum('Master Card','PayPal','Cash On Delivery') NOT NULL DEFAULT 'Cash On Delivery',
  `transaction_id` varchar(256) NOT NULL,
  `transaction_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Paid',
  `order_item_status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'ORDER ITEMS ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'INVOICES ID',
  `invoice_id` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_amount` double NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `shopcarts` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'SHOPCART ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'WISHLIST ID',
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'REVIEW ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `review_details` varchar(512) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL DEFAULT '5',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `slides` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'SLIDER ID',
  `slider_title` varchar(128) NOT NULL,
  `slider_image` text NOT NULL,
  `slider_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `slider_sequence` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `products_sc` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

ALTER TABLE `subcategories` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

ALTER TABLE `products` ADD FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

ALTER TABLE `order_items` ADD FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

ALTER TABLE `invoices` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

ALTER TABLE `orders` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

ALTER TABLE `shopcarts` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

ALTER TABLE `shopcarts` ADD FOREIGN KEY (`product_sc_id`) REFERENCES `products_sc` (`id`);

ALTER TABLE `wishlist` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

ALTER TABLE `wishlist` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

ALTER TABLE `reviews` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);


--INSERT DATA INTO TABLES CATEGORIES
INSERT INTO `categories` (`category_name`, `category_status`, `is_delete`, `created_at`, `updated_at`) VALUES
('ÁO NAM', 'Active', '0', NOW(), NOW()),
('QUẦN NAM', 'Active', '0', NOW(), NOW()),
('PHỤ KIỆN', 'Active', '0', NOW(), NOW())

--INSERT DATA INTO TABLES SUBCATEGORIES
INSERT INTO `SUBCATEGORIES` (`category_id`, `subcategory_name`, `subcategory_status`, `subcategory_banner`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Áo T-Shirt', 'Active', 'img-subcategory.jpg', '0', NOW(), NOW()),
(1, 'Áo Polo', 'Active', 'img-subcategory1.jpg', '0', NOW(), NOW()),
(1, 'Áo Sơ Mi', 'Active', 'img-subcategory2.jpg', '0', NOW(), NOW()),
(1, 'Áo Khoác', 'Active', 'img-subcategory3.jpg', '0', NOW(), NOW()),
(1, 'Áo Vest', 'Active', 'img-subcategory4.jpg', '0', NOW(), NOW()),
(1, 'Áo Hoodie', 'Active', 'img-subcategory5.jpg', '0', NOW(), NOW()),
(2, 'Quần Short', 'Active', 'img-subcategory6.jpg', '0', NOW(), NOW()),
(2, 'Quần Jean', 'Active', 'img-subcategory7.jpg', '0', NOW(), NOW()),
(2, 'Quần Jogger', 'Active', 'img-subcategory8.jpg', '0', NOW(), NOW()),
(2, 'Quần Kaki', 'Active', 'img-subcategory9.jpg', '0', NOW(), NOW()),
(2, 'Quần Âu', 'Active', 'img-subcategory10.jpg', '0', NOW(), NOW()),
(2, 'Quần Dài', 'Active', 'img-subcategory11.jpg', '0', NOW(), NOW()),
(3, 'Mũ(Nón)', 'Active', 'img-subcategory12.jpg', '0', NOW(), NOW()),
(3, 'Tất(Vớ)', 'Active', 'img-subcategory13.jpg', '0', NOW(), NOW()),
(3, 'Dây Nịt', 'Active', 'img-subcategory14.jpg', '0', NOW(), NOW()),
(3, 'Túi Xách', 'Active', 'img-subcategory15.jpg', '0', NOW(), NOW())

--INSERT DATA INTO TABLES PRODUCTS
INSERT INTO `products` (`category_id`, `subcategory_id`, `product_name`, `product_summary`, `product_details`, `product_master_image`, `product_image_one`, `product_image_two`, `product_image_three`, `product_price`, `product_tags`) VALUES
(1, 17, 'Áo T-Shirt Glaxy', 'Áo thun nam nữ Galaxy mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-galaxy.jpg', 'img-product-galaxy-1.jpg', 'img-product-galaxy-2.jpg', 'img-product-galaxy-3.jpg', 195000, 'Áo T-Shirt Nam'),
(1, 17, 'Áo T-Shirt Happen', 'Áo thun nam nữ Happen mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-happen.jpg', 'img-product-happen-1.jpg', 'img-product-happen-2.jpg', 'img-product-happen-3.jpg', 295000, 'Áo T-Shirt Nam'),
(1, 17, 'Áo T-Shirt Cross Cut', 'Áo thun nam nữ Cross Cut mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-cross-cut.jpg', 'img-product-cross-cut-1.jpg', 'img-product-cross-cut-2.jpg', 'img-product-cross-cut-3.jpg', 295000, 'Áo T-Shirt Nam'),
(1, 18, 'Áo Polo Zip Sleepy', 'Áo polo ngắn tay Zip Sleepy mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-zip-sleepy.jpg', 'img-product-zip-sleepy-1.jpg', 'img-product-zip-sleepy-2.jpg', 'img-product-zip-sleepy-3.jpg', 259000, 'Áo Polo Nam'),
(1, 18, 'Áo Polo Universe', 'Áo polo ngắn tay Universe mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-universe.jpg', 'img-product-universe-1.jpg', 'img-product-universe-2.jpg', 'img-product-universe-3.jpg', 249000, 'Áo Polo Nam'),
(1, 18, 'Áo Polo VietNamese City', 'Áo polo ngắn tay VietNamese City mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-vn-city.jpg', 'img-product-vn-city-1.jpg', 'img-product-vn-city-2.jpg', 'img-product-vn-city-3.jpg', 295000, 'Áo Polo Nam'),
(2, 23, 'Quần Short Túi Chéo', 'Quần short đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-tui-cheo.jpg', 'img-product-tui-cheo-1.jpg', 'img-product-tui-cheo-2.jpg', 'img-product-tui-cheo-3.jpg', 295000, 'Quần Short Nam'),
(2, 23, 'Quần Short Thêu Symbol', 'Quần short đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-symbol.jpg', 'img-product-symbol-1.jpg', 'img-product-symbol-2.jpg', 'img-product-symbol-3.jpg', 249000, 'Quần Short Nam'),
(2, 24, 'Quần Baggy Jean Rách', 'Quần jean đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-baggy-jean.jpg', 'img-product-baggy-jean-1.jpg', 'img-product-baggy-jean-2.jpg', 'img-product-baggy-jean-3.jpg', 295000, 'Quần Jean Nam')

--INSERT DATA INTO TABLE PRODUCT_SIZE_COLOR
INSERT INTO `products_sc` (`product_id`,`product_size`,`product_color`,`product_quantity`) VALUES
(1, 'M', 'Đen', 100),
(1, 'L', 'Đen', 100),
(1, 'XL', 'Đen', 100),
(1, 'M', 'Trắng', 100),
(1, 'L', 'Trắng', 100),
(1, 'XL', 'Trắng', 100),
(2, 'M', 'Đen', 50),
(2, 'L', 'Đen', 50),
(2, 'XL', 'Đen', 50),
(2, 'M', 'Vàng', 50),
(2, 'L', 'Vàng', 50),
(2, 'XL', 'Vàng', 50),
(2, 'M', 'Nâu', 50),
(2, 'L', 'Nâu', 50),
(2, 'XL', 'Nâu', 50),
(3, 'M', 'Nâu', 10),
(3, 'L', 'Nâu', 10),
(3, 'XL', 'Nâu', 10),
(3, 'M', 'Đen', 10),
(3, 'L', 'Đen', 10),
(3, 'XL', 'Đen', 10),
(4, 'M', 'Nâu', 10),
(4, 'L', 'Nâu', 10),
(4, 'XL', 'Nâu', 10),
(4, 'M', 'Đen', 10),
(4, 'L', 'Đen', 10),
(4, 'XL', 'Đen', 10),
(5, 'L', 'Đen', 10),
(5, 'XL', 'Đen', 10),
(5, 'M', 'Trắng', 10),
(5, 'L', 'Trắng', 10),
(5, 'XL', 'Trắng', 10),
(6, 'M', 'Xanh', 10),
(6, 'L', 'Xanh', 10),
(6, 'XL', 'Xanh', 10),
(7, 'M', 'Đen', 10),
(7, 'L', 'Đen', 10),
(7, 'XL', 'Đen', 10),
(7, 'M', 'Nâu', 10),
(7, 'L', 'Nâu', 10),
(7, 'XL', 'Nâu', 10),
(7, 'M', 'Be', 10),
(7, 'L', 'Be', 10),
(7, 'XL', 'Be', 10),
(8, 'M', 'Đen', 10),
(8, 'L', 'Đen', 10),
(8, 'XL', 'Đen', 10),
(8, 'M', 'Nâu', 10),
(8, 'L', 'Nâu', 10),
(8, 'XL', 'Nâu', 10),
(9, 'M', 'Xanh Xám', 10),
(9, 'L', 'Xanh Xám', 10),
(9, 'XL', 'Xanh Xám', 10)