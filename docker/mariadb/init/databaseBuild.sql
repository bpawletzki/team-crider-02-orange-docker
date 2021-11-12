use love_you_a_latte;
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
) ENGINE = InnoDB AUTO_INCREMENT = 13 DEFAULT CHARSET = utf8mb4;
CREATE TABLE `product` (
  `id` int(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL UNIQUE KEY,
  `image` text NOT NULL,
  `price` double(10, 2) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
CREATE TABLE `checkoutDetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15, 2) NOT NULL,
  `checkout_id` int(11) NOT NULL,
  `options` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_to_product` (`product_id`),
  KEY `fk_to_checkout` (`checkout_id`),
  CONSTRAINT `fk_to_checkout` FOREIGN KEY (`checkout_id`) REFERENCES `checkout` (`id`),
  CONSTRAINT `fk_to_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 14 DEFAULT CHARSET = utf8mb4;
--
-- Database: `love_you_a_latte`
--
INSERT INTO
  `product` (
    `id`,
    `name`,
    `code`,
    `image`,
    `price`,
    `description`
  )
VALUES
  (
    1,
    'Brewed Coffee Small',
    'brewedcoffee1',
    'product-images/brewed-coffee.jpg',
    2.00,
    '8oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'
  ),
  (
    2,
    'Brewed Coffee Medium',
    'brewedcoffee2',
    'product-images/brewed-coffee.jpg',
    2.50,
    '12oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'
  ),
  (
    3,
    'Brewed Coffee Large',
    'brewedcoffee3',
    'product-images/brewed-coffee.jpg',
    3.00,
    '16oz - We use all locally sourced Arabica beans. Floral, full-bodied, smoky aroma & distinct richness.'
  ),
  (
    4,
    'Cappucino Small',
    'cappucino1',
    'product-images/Cappucino.jpg',
    3.00,
    '8oz - Espresso with foamed milk layered on top. A heart warming drink anytime of day.'
  ),
  (
    5,
    'Cappucino Medium',
    'cappucino2',
    'product-images/Cappucino.jpg',
    3.50,
    '12oz - Espresso with foamed milk layered on top. A heart warming drink anytime of day.'
  ),
  (
    6,
    'Cappucino Large',
    'cappucino3',
    'product-images/Cappucino.jpg',
    4.00,
    '16oz - Espresso with foamed milk layered on top. A heart warming drink anytime of day.'
  ),
  (
    7,
    'Esspresso Small',
    'esspresso1',
    'product-images/Esspresso.jpg',
    1.95,
    '20ml - Ristretto shots are espresso shots pulled earlier, resulting in a slightly smaller but sweeter shot of espresso,'
  ),
  (
    8,
    'Esspresso Medium',
    'esspresso2',
    'product-images/Esspresso.jpg',
    2.45,
    '30ml - A concentrated thick coffee beverage with a layer of dense foam. Ingredients are exclusively coffee and water'
  ),
  (
    9,
    'Esspresso Large',
    'esspresso3',
    'product-images/Esspresso.jpg',
    2.95,
    '60ml - A double shot of espresso! Typical for use in coffee, latte, or cappucino.'
  ),
  (
    10,
    'Latte Small',
    'latte1',
    'product-images/Latte.jpg',
    3.00,
    '8oz - Freshly brewed espresso & perfectly steamed milk.'
  ),
  (
    11,
    'Latte Medium',
    'latte2',
    'product-images/Latte.jpg',
    3.50,
    '12oz - Freshly brewed espresso & perfectly steamed milk.'
  ),
  (
    12,
    'Latte Large',
    'latte3',
    'product-images/Latte.jpg',
    4.00,
    '16oz - Freshly brewed espresso & perfectly steamed milk.'
  );
CREATE TABLE employees (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(4096) NOT NULL,
    firstname VARCHAR(128) NOT NULL,
    lastname VARCHAR(128) NOT NULL,
    employeeid VARCHAR(128) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  );
CREATE TABLE accessfailed (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  );