use love_you_a_latte;
DROP TABLE IF EXISTS checkout;
DROP TABLE IF EXISTS product;
DROP TABLE IF EXISTS checkoutDetail;

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checkoutTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `product` (
  `id` int(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL UNIQUE KEY,
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
  PRIMARY KEY (`id`),
  KEY `fk_to_product` (`product_id`),
  KEY `fk_to_checkout` (`checkout_id`),
  CONSTRAINT `fk_to_checkout` FOREIGN KEY (`checkout_id`) REFERENCES `checkout` (`id`),
  CONSTRAINT `fk_to_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

--
-- Database: `love_you_a_latte`
--

INSERT INTO `product` (`id`, `name`, `code`, `image`, `price`, `description`) VALUES
(1, 'Brewed Coffee Small', 'brewedcoffee1', 'product-images/brewed-coffee.jpg', 2.00, 'placeholder'),
(2, 'Brewed Coffee Medium', 'brewedcoffee2', 'product-images/brewed-coffee.jpg', 2.50, 'placeholder'),
(3, 'Brewed Coffee Large', 'brewedcoffee3', 'product-images/brewed-coffee.jpg', 3.00, 'placeholder'),
(4, 'Cappucino Small', 'cappucino1', 'product-images/Cappucino.jpg', 3.00, 'placeholder'),
(5, 'Cappucino Medium', 'cappucino2', 'product-images/Cappucino.jpg', 3.50, 'placeholder'),
(6, 'Cappucino Large', 'cappucino3', 'product-images/Cappucino.jpg', 4.00, 'placeholder'),
(7, 'Esspresso Small', 'esspresso1', 'product-images/Esspresso.jpg', 1.95, 'placeholder'),
(8, 'Esspresso Medium', 'esspresso2', 'product-images/Esspresso.jpg', 2.45, 'placeholder'),
(9, 'Esspresso Large', 'esspresso3', 'product-images/Esspresso.jpg', 2.95, 'placeholder'),
(10, 'Latte Small', 'latte1', 'product-images/Latte.jpg', 3.00, 'placeholder'),
(11, 'Latte Medium', 'latte2', 'product-images/Latte.jpg', 3.50, 'placeholder'),
(12, 'Latte Large', 'latte3', 'product-images/Latte.jpg', 4.00, 'placeholder');



