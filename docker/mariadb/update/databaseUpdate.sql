use love_you_a_latte;
ALTER TABLE `love_you_a_latte`.`checkoutDetail` 
RENAME COLUMN options TO creamer,
ADD COLUMN pumps VARCHAR(256) NOT NULL DEFAULT 0;