use love_you_a_latte;
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(4096) NOT NULL,
    firstname VARCHAR(128) NOT NULL,
    lastname VARCHAR(128) NOT NULL,
    userid VARCHAR(128) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
  );
 INSERT INTO `love_you_a_latte`.`users` (`id`,`username`,`password`,`firstname`,`lastname`,`userid`) VALUES
('1','user','$2y$10$aqyI1V2FgBtEU/xsx9s.a.hM48PBLrSPshVndCyrIwx9TpPnRFxxS', 'Joe', 'Regular', '0');
