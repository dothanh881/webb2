  -- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
  --
  -- Host: localhost    Database: shoppee
  -- ------------------------------------------------------
  -- Server version	8.0.35

  /*!40101 set @old_character_set_client=@@character_set_client */;
  /*!40101 set @old_character_set_results=@@character_set_results */;
  /*!40101 set @old_collation_connection=@@collation_connection */;
  /*!50503 set names utf8 */;
  /*!40103 set @old_time_zone=@@time_zone */;
  /*!40103 set time_zone='+00:00' */;
  /*!40014 set @old_unique_checks=@@unique_checks, unique_checks=0 */;
  /*!40014 set @old_foreign_key_checks=@@foreign_key_checks, foreign_key_checks=0 */;
  /*!40101 set @old_sql_mode=@@sql_mode, sql_mode='no_auto_value_on_zero' */;
  /*!40111 set @old_sql_notes=@@sql_notes, sql_notes=0 */;

  -- table structure for table `category`
  create table `category` (
    `category_id` int not null,
    `category_name` varchar(50) not null,
    primary key (`category_id`)
  ) engine=innodb default charset=utf8mb4;

  -- dumping data for table `category`
  insert into `category` (`category_id`, `category_name`)
  values (1, 'APPLE'),
        (2, 'SAMSUNG');

  -- table structure for table `customers`
  create table `user` (
    `user_id` varchar(255) not null  ,
    `email` varchar(100) not null,
    `username` varchar(100) not null,
      `password` varchar(100) not null,
      `street` varchar(255) not null,
    `district` varchar(30) not null,
    `city` varchar(100) not null,
    `phone_number` varchar(100) not null,
    `status` int not null DEFAULT 0,
    `is_admin` tinyint(1) not null DEFAULT 0,
    `register_date`  datetime not null default current_timestamp,
      `updated_at` datetime not null default current_timestamp,
      `fullname` VARCHAR(255) NOT NULL,
    primary key (`user_id`)
  ) engine=innodb default charset=utf8mb4;


  -- INSERT INTO `user` (`email`, `username`, `password`, `street`, `district`, `city`, `phone_number`, `status`, `is_admin`) 
  -- VALUES ('abc@email.com', 'user123', 'abc123', '273 An Duong Vuong', 'District 5', 'Ho Chi Minh', '0981776491', 1, 0),
  -- ('admin@email.com', 'admin', 'admin123', '273 An Duong Vuong', 'District 5', 'Ho Chi Minh', '0123456789', 1, 1);




  -- table structure for table `product`
  create table `product` (
    `item_id` int not null auto_increment,
    `category_id` int not null,
    `item_brand` varchar(255) not null,
    `item_name` varchar(255) not null,
    `item_quantity` int not null,
    `item_price` decimal(10,2) not null,
    `item_color` varchar(20) default null,
    `item_image` varchar(255),
    `item_discription` varchar(255) default null,
    `item_status` int not null,
    `item_rom` int default null,
    `item_ram` int default null,
    `size_screen` decimal(10,2) default null,
    `created_at` datetime not null default current_timestamp,
    `updated_at` datetime not null default current_timestamp,
    primary key (`item_id`),
    constraint `fk_product_category` foreign key (`category_id`) references `category` (`category_id`)
  ) engine=innodb default charset=utf8mb4;

  -- dumping data for table `product`

  INSERT INTO `product` (`item_id`, `category_id`, `item_brand`, `item_name`, `item_quantity`, `item_price`, `item_color`, `item_image`, `item_discription`, `item_status`, `item_rom`, `item_ram`, `size_screen`, `created_at`, `updated_at`)
  VALUES
  (1, 1, 'iphone', 'iPhone 15 Pro Max', 10, 1452, 'Blue', './assets/products/img1.png', 'iPhone 15 Pro Max is the most advanced iPhone with the largest screen, best battery life, strongest configuration and super durable, super light aerospace-standard Titanium frame design. iPhone 15 Pro Max possesses Apple most outstanding features. Accordingly, users will experience a high-end iPhone with "huge" performance with A17 Pro chip, titanium frame, upgraded zoom capabilities, new action buttons,...', 1, 512, 8, 6.7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (2, 1, 'iphone', 'iPhone 15 Pro Max', 10, 1452, 'Black','./assets/products/img2.png', 'iPhone 15 Pro Max is the most advanced iPhone with the largest screen, best battery life, strongest configuration and super durable, super light aerospace-standard Titanium frame design. iPhone 15 Pro Max possesses Apple most outstanding features. Accordingly, users will experience a high-end iPhone with "huge" performance with A17 Pro chip, titanium frame, upgraded zoom capabilities, new action buttons,...', 1, 512, 8, 6.7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (3, 1, 'iphone', 'iPhone 14 Plus', 10, 1129, 'Purple', './assets/products/img3.png', 'The appeal of the new generation iPhone 2022 with a large screen, the best battery ever, impressive night photography and a series of top-notch technologies, the iPhone 14 Plus brings users into advanced mobile experiences. Advanced, ready for an active, smart and convenient life', 1, 256, 6, 6.7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (4, 1, 'iphone', 'iPhone 14 Plus', 10, 1129, 'Yellow', './assets/products/img4.png', 'The appeal of the new generation iPhone 2022 with a large screen, the best battery ever, impressive night photography and a series of top-notch technologies, the iPhone 14 Plus brings users into advanced mobile experiences. Advanced, ready for an active, smart and convenient life', 1, 256, 6, 6.7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (5, 1, 'iphone', 'iPhone 13 Pro Max', 10, 1048, 'White', './assets/products/img5.png', 'iPhone 13 Pro Max has the best dual camera system ever, the fastest Apple A15 processor in the smartphone world and extremely long battery life, ready to accompany you all day long.', 1, 512, 6, 6.7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (6, 1, 'iphone', 'iPhone 12 Pro Max', 10, 484, 'Yellow', './assets/products/img6.png', 'In the last months of 2020, Apple officially introduced to users as well as iFans the new generation of iPhone 12 series with a series of breakthrough features, completely transformed design, powerful performance and one of That is the iPhone 12 Pro Max 128 GB', 1, 128, 6, 6.7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (7, 2, 'samsung', 'Samsung Galaxy S24 Ultra', 10, 1089, 'Blue', './assets/products/img7.png', 'Samsung Galaxy S24 Ultra is the smartest Galaxy phone ever with connection power, creative power and entertainment power all powered by Galaxy AI artificial intelligence. Completely new design from the classy Titanium frame, super camera with resolution up to 200MP and Snapdragon 8 Gen 3 for Galaxy processor will bring an unprecedented exciting experience for you', 1, 512, 12, 6.8, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (8, 2, 'samsung', 'Samsung Galaxy S22 Ultra 5G', 10, 605, 'Black', './assets/products/img8.png', 'Samsung Galaxy S24 Ultra is the smartest Galaxy phone ever with connection power, creative power and entertainment power all powered by Galaxy AI artificial intelligence. Completely new design from the classy Titanium frame, super camera with resolution up to 200MP and Snapdragon 8 Gen 3 for Galaxy processor will bring an unprecedented exciting experience for you', 1, 256, 12, 6.8, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (9, 2, 'samsung', 'Samsung Galaxy Z Fold5 5G', 10, 1493, 'Blue', './assets/products/img9.png', 'Joining Samsung Galaxy Z Flip 5 flexibly, you will experience a series of exciting breakthrough technologies and a completely new unique design. Where you can freely explore and confidently express your personality. The compactness, fit and fashion of the Z Flip 5 also help you stand out and be ready to "take on" all your favorite styles', 1, 512, 12, 7.6, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (10, 2, 'samsung', 'Samsung Galaxy S23 Ultra', 10, 1129, 'Green', './assets/products/img10.png', 'Proud to be the first Galaxy phone to possess a superb 200MP sensor, the Samsung Galaxy S23 Ultra takes users into a world of cutting-edge photography. The power is also explosive with the most powerful Snapdragon processor for revolutionary gaming performance. All wrapped up in a premium and sustainable design for now and the future.', 1, 512, 12, 6.8, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (11, 2, 'samsung', 'Samsung Galaxy S23 FE', 10, 524, 'Purple', './assets/products/img11.png', 'The Galaxy S23 FE 5G is the best Galaxy FE device Samsung has ever launched. Equipped with premium features from design to outstanding performance, an incredible night camera system. All combine to bring the perfect experience for work and entertainment', 1, 512, 8, 6.4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (12, 2, 'samsung', 'Samsung Galaxy A14', 10, 201, 'Silver', './assets/products/img12.png', 'Adding color and experience to your life, Samsung introduces the cheap Galaxy A14 4G with a series of new improvements. Everything is harmoniously combined from youthful design, 50MP camera system, sharp screen to super large battery, creating an attractive phone with many great advantages for young people', 1, 128, 4, 6.6, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
  (13, 2, 'samsung', 'Samsung Galaxy M54', 10, 1089, 'Silver', './assets/products/img13.png', 'Following the success of the Galaxy M53 5G, Samsung continues to launch the Samsung Galaxy M54 5G phone model. This launch, Samsung has upgraded performance, battery capacity and improved design to help bring the best product to you.', 1, 256, 8, 6.7, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

  -- table structure for table `order`
  create table `order` (
    `order_id` varchar(255) not null,
    `user_id` varchar(255) not null,
    `order_date` date not null,
    `order_total_price` decimal(10,2) not null,
    `method` varchar(50) not null,
    `order_status` varchar(20) not null,
    `city` varchar(100) default null,
    `district` varchar(30) default null,
    `street` varchar(255) default null,
    primary key (`order_id`),
    constraint `order_ibfk_1` foreign key (`user_id`) references `user` (`user_id`)
  ) engine=innodb default charset=utf8mb4;

  -- dumping data for table `order`

  -- table structure for table `order_detail`
  create table `order_detail` (
    `order_detail_price` decimal(10,2) not null,
    `order_detail_quantity` int not null,
    `order_id` VARCHAR(255) not null,
    `item_id` int not null,
    primary key (`order_id`,`item_id`),
    constraint `fk_order_detail_order_id` foreign key (`order_id`) references `order` (`order_id`),
    constraint `fk_order_detail_item_id` foreign key (`item_id`) references `product` (`item_id`)
  ) engine=innodb default charset=utf8mb4;

  -- dumping data for table `order_detail`

  -- table structure for table `cart`
  create table `cart` (
    `cart_id` int not null,
    `user_id` varchar(255) not null,
    `item_id` int not null,
    `cart_quantity` int ,
    `cart_price` decimal(10,2),
    `name` varchar(255) not null,
    `cart_image` varchar(255) not null,
    primary key (`cart_id`),
    constraint `fk_cart_user_id` foreign key (`user_id`) references `user` (`user_id`),
    constraint `fk_cart_item_id` foreign key (`item_id`) references `product` (`item_id`)
  ) engine=innodb default charset=utf8mb4;

  -- dumping data for table `cart`


    
    ALTER TABLE `cart`
    MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

   

  delimiter //

  create trigger `check_cart_quantity_before_insert_update` 
  before insert on `cart` 
  for each row 
  begin
      declare item_quantity int;

      -- lấy số lượng tồn kho của sản phẩm
      select `item_quantity` into item_quantity
      from `product`
      where `item_id` = new.`item_id`;

      -- kiểm tra nếu số lượng trong giỏ hàng vượt quá số lượng tồn kho
      if new.`cart_quantity` > item_quantity then
          signal sqlstate '45000'
          set message_text = 'the quantity in the cart exceeds the available quantity in stock.';
      end if;
  end;
  //

  delimiter ;


alter table `order` MODIFY order_date date not null DEFAULT current_timestamp();

alter table `order` MODIFY order_status varchar(50) not null DEFAULT 'Pending';
  /*!40101 set sql_mode=@old_sql_mode */;
  /*!40014 set foreign_key_checks=@old_foreign_key_checks */;
  /*!40014 set unique_checks=@old_unique_checks */;
  /*!40101 set character_set_client=@old_character_set_client */;
  /*!40101 set character_set_results=@old_character_set_results */;
  /*!40101 set collation_connection=@old_collation_connection */;
  /*!40111 set sql_notes=@old_sql_notes */;