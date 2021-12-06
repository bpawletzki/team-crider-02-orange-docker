use love_you_a_latte;
CREATE DEFINER = CURRENT_USER TRIGGER `love_you_a_latte`.`checkoutDetail_AFTER_INSERT` 
AFTER INSERT ON `checkoutDetail` 
FOR EACH ROW
BEGIN
SET @exec_var = sys_exec(CONCAT('bash -c \'echo "hello" > /dev/udp/node-red/1881\'));
END;
