DROP USER 'test'@'%';

CREATE USER 'test'@'%' IDENTIFIED BY 'qwert_1337';

DROP DATABASE hashedpotatoes;

CREATE DATABASE hashedpotatoes CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE hashedpotatoes;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) UNIQUE,
    firstname VARCHAR(50) UNIQUE,
    lastname VARCHAR(50) UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    profilepicture VARCHAR(255) NOT NULL
);

GRANT SELECT ON hashedpotatoes.users TO 'test'@'%' WITH GRANT OPTION;
GRANT INSERT ON hashedpotatoes.users TO 'test'@'%' WITH GRANT OPTION;
GRANT DELETE ON hashedpotatoes.users TO 'test'@'%' WITH GRANT OPTION;
GRANT UPDATE ON hashedpotatoes.users TO 'test'@'%' WITH GRANT OPTION;

CREATE TABLE hashedpotatoes.passwordentrys (
  idpasswordEntrys INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL,
  password VARCHAR(255) NOT NULL,
  url VARCHAR(255) NULL,
  userid INT NULL,
  PRIMARY KEY (idpasswordEntrys),
  INDEX userid_idx (userid ASC) ,
  CONSTRAINT userid
    FOREIGN KEY (userid)
    REFERENCES hashedpotatoes.users (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

GRANT SELECT ON hashedpotatoes.passwordentrys TO 'test'@'%' WITH GRANT OPTION;
GRANT INSERT ON hashedpotatoes.passwordentrys TO 'test'@'%' WITH GRANT OPTION;
GRANT DELETE ON hashedpotatoes.passwordentrys TO 'test'@'%' WITH GRANT OPTION;
GRANT UPDATE ON hashedpotatoes.passwordentrys TO 'test'@'%' WITH GRANT OPTION;

ALTER TABLE `hashedpotatoes`.`passwordentrys` 
ADD COLUMN `username` VARCHAR(45) NULL AFTER `userid`;

ALTER TABLE `hashedpotatoes`.`passwordentrys` 
ADD COLUMN `keyy` BLOB(255) NULL AFTER `username`;


