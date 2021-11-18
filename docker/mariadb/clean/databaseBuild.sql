use love_you_a_latte;
ALTER TABLE checkoutDetail DROP FOREIGN KEY fk_to_checkout; 
ALTER TABLE checkoutDetail DROP FOREIGN KEY fk_to_product; 
TRUNCATE checkoutDetail;
TRUNCATE checkout;
TRUNCATE product;
TRUNCATE employees;
TRUNCATE accessfailed;
DROP TABLE IF EXISTS checkout;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS checkoutDetail;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS accessfailed;
CREATE TABLE `checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkoutTime` datetime NOT NULL,
  `uuid` VARCHAR(255) NOT NULL,
  `accountid` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `product` (
  `id` int(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL UNIQUE KEY,
  `category` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `checkoutDetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `checkout_id` int(11) NOT NULL,
  `options` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_to_product` (`product_id`),
  KEY `fk_to_checkout` (`checkout_id`),
  CONSTRAINT `fk_to_checkout` FOREIGN KEY (`checkout_id`) REFERENCES `checkout` (`id`),
  CONSTRAINT `fk_to_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Database: `love_you_a_latte`
--

INSERT INTO `product` (`id`, `name`, `code`, `category`, `image`, `price`, `description`) VALUES
(1, 'Brewed Coffee Small', 'brewedcoffee1', 'hot', 'product-images/brewed-coffee.jpg', 2.00, '8oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'),
(2, 'Brewed Coffee Medium', 'brewedcoffee2', 'hot', 'product-images/brewed-coffee.jpg', 2.50, '12oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'),
(3, 'Brewed Coffee Large', 'brewedcoffee3', 'hot', 'product-images/brewed-coffee.jpg', 3.00, '16oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'),
(4, 'Cappucino Small', 'cappucino1', 'hot', 'product-images/cappucino.jpg', 3.00, '8oz - Espresso with foamed milk layered on top. A heart warming drink anytime of day.'),
(5, 'Cappucino Medium', 'cappucino2', 'hot', 'product-images/cappucino.jpg', 3.50, '12oz - Espresso with foamed milk layered on top. A heart warming drink anytime of day.'),
(6, 'Cappucino Large', 'cappucino3', 'hot', 'product-images/cappucino.jpg', 4.00, '16oz - Espresso with foamed milk layered on top. A heart warming drink anytime of day.'),
(7, 'Esspresso Small', 'esspresso1', 'hot', 'product-images/esspresso.jpg', 1.95, '20ml - Ristretto shots are espresso shots pulled earlier, resulting in a slightly smaller but sweeter shot of espresso,'),
(8, 'Esspresso Medium', 'esspresso2', 'hot', 'product-images/esspresso.jpg', 2.45, '30ml - A concentrated thick coffee beverage with a layer of dense foam. Ingredients are exclusively coffee and water'),
(9, 'Esspresso Large', 'esspresso3', 'hot', 'product-images/esspresso.jpg', 2.95, '60ml - A double shot of espresso! Typical for use in coffee, latte, or cappucino.'),
(10, 'Latte Small', 'latte1', 'hot', 'product-images/latte.jpg', 3.00, '8oz - Freshly brewed espresso & perfectly steamed milk.'),
(11, 'Latte Medium', 'latte2', 'hot', 'product-images/latte.jpg', 3.50, '12oz - Freshly brewed espresso & perfectly steamed milk.'),
(12, 'Latte Large', 'latte3', 'hot', 'product-images/latte.jpg', 4.00, '16oz - Freshly brewed espresso & perfectly steamed milk.'),
(13, 'Iced Coffee Small', 'icedcoffee1', 'iced', 'product-images/iced-coffee.jpg', 2.00, '8oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'),
(14, 'Iced Coffee Medium', 'icedcoffee2', 'iced', 'product-images/iced-coffee.jpg', 2.50, '12oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'),
(15, 'Iced Coffee Large', 'icedcoffee3', 'iced', 'product-images/iced-coffee.jpg', 3.00, '16oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'),
(16, 'Iced Cappucino Small', 'icedcappucino1', 'iced', 'product-images/iced-cappucino.jpg', 3.00, '8oz - Espresso with foamed milk layered on top. Sure to cool you down on a warm day.'),
(17, 'Iced Cappucino Medium', 'icedcappucino2', 'iced', 'product-images/iced-cappucino.jpg', 3.50, '8oz - Espresso with foamed milk layered on top. Sure to cool you down on a warm day.'),
(18, 'Iced Cappucino Large', 'icedcappucino3', 'iced', 'product-images/iced-cappucino.jpg', 4.00, '8oz - Espresso with foamed milk layered on top. Sure to cool you down on a warm day.'),
(19, 'Iced Esspresso Small', 'icedesspresso1', 'iced', 'product-images/iced-esspresso.jpg', 1.95, '20ml - A shot of espresso that has been pulled earlier, resulting in a slightly smaller but sweeter shot of espresso, and then poured over ice.'),
(20, 'Iced Esspresso Medium', 'icedesspresso2', 'iced', 'product-images/iced-esspresso.jpg', 2.45, '30ml - A concentrated thick coffee beverage with a layer of dense foam that is then poured over ice.'),
(21, 'Iced Esspresso Large', 'icedesspresso3', 'iced', 'product-images/iced-esspresso.jpg', 2.95, '60ml - A double shot of espresso! Typical for use in coffee, latte, or cappucino. Served over ice.'),
(22, 'Iced Latte Small', 'icedlatte1', 'iced', 'product-images/iced-latte.jpg', 3.00, '8oz - Freshly brewed espresso & cold milk over ice.'),
(23, 'Iced Latte Medium', 'icedlatte2', 'iced', 'product-images/iced-latte.jpg', 3.50, '12oz - Freshly brewed espresso & cold milk over ice.'),
(24, 'Iced Latte Large', 'icedlatte3', 'iced', 'product-images/iced-latte.jpg', 4.00, '16oz - Freshly brewed espresso & cold milk over ice.'),
(25, 'FrozoMocha Small', 'frozomocha1', 'frozen', 'product-images/frozo-mocha.jpg', 3.00, 'Placeholder'),
(26, 'FrozoMocha Medium', 'frozomocha2', 'frozen', 'product-images/frozo-mocha.jpg', 3.50, 'Placeholder'),
(27, 'FrozoMocha Large', 'frozomocha3', 'frozen', 'product-images/frozo-mocha.jpg', 4.00, 'Placeholder'),
(28, 'FrozoApplePie Small', 'frozoapple1', 'frozen', 'product-images/frozo-apple.jpg', 3.00, 'Placeholder'),
(29, 'FrozoApplePie Medium', 'frozoapple2', 'frozen', 'product-images/frozo-apple.jpg', 3.50, 'Placeholder'),
(30, 'FrozoApplePie Large', 'frozoapple3', 'frozen', 'product-images/frozo-apple.jpg', 4.00, 'Placeholder'),
(31, 'FrozoCinnamonRoll Small', 'frozocinnamon1', 'frozen', 'product-images/frozo-cinnamon.jpg', 3.00, 'Placeholder'),
(32, 'FrozoCinnamonRoll Medium', 'frozocinnamon2', 'frozen', 'product-images/frozo-cinnamon.jpg', 3.50, 'Placeholder'),
(33, 'FrozoCinnamonRoll Large', 'frozocinnamon3', 'frozen', 'product-images/frozo-cinnamon.jpg', 4.00, 'Placeholder');
CREATE TABLE employees (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(4096) NOT NULL,
    firstname VARCHAR(128) NOT NULL,
    lastname VARCHAR(128) NOT NULL,
    employeeid VARCHAR(128) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `love_you_a_latte`.`employees` (`id`,`username`,`password`,`firstname`,`lastname`,`employeeid`) VALUES
('1','admin','$2y$10$aqyI1V2FgBtEU/xsx9s.a.hM48PBLrSPshVndCyrIwx9TpPnRFxxS', 'Super', 'Admin', '0');


CREATE TABLE accessfailed (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
