use love_you_a_latte;
ALTER TABLE `love_you_a_latte`.`checkoutDetail` 
ADD COLUMN `syrup` VARCHAR(256) NOT NULL AFTER `sweetener`;