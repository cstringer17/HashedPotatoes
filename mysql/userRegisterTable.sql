CREATE USER 'test'@'%' IDENTIFIED BY 'qwert_1337';

DROP DATABASE hashedpotatoes;

CREATE DATABASE hashedpotatoes CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

GRANT INSERT UPDATE DELETE ON hashedpotatoes.users TO 'test'@'%' WITH GRANT OPTION;

USE hashedpotatoes;

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    profilepicture VARCHAR(255) NOT NULL
);
