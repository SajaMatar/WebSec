CREATE DATABASE ProjectDB;

use ProjectDB;

CREATE TABLE users (
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL UNIQUE,
    passwd VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created DATETIME NOT NULL DEFAULT CURRENT_TIME(),
    invCounter INT NOT NULL DEFAULT 0
);


CREATE TABLE roles(
    ID INT NOT NULL AUTO_INCREMENT ,
    username VARCHAR(30) NOT NULL ,
    priv TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (ID),
    FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE PassReset( 
    email VARCHAR(100) NOT NULL UNIQUE ,
    token VARCHAR(255) NOT NULL PRIMARY KEY,
    created INT(20) UNSIGNED NOT NULL DEFAULT UNIX_TIMESTAMP()
);


INSERT INTO users(username,passwd,email,created) VALUES ('Admin','admin123','sajamatr20@gmail.com',CURRENT_TIME());
INSERT INTO Roles(username,priv) VALUES ('Admin',1);

CREATE USER 'SignAdmin'@'localhost' IDENTIFIED BY 'b04b95cf6ef5538f68314c*#$%&@%2cd4af998aed9e83123cadc3502e8cb6';
GRANT SELECT,INSERT,UPDATE,DELETE ON ProjectDB.users TO 'SignAdmin'@'localhost';
GRANT SELECT ON ProjectDB.roles TO 'SignAdmin'@'localhost';
GRANT SELECT,INSERT,DELETE ON ProjectDB.PassReset TO 'SignAdmin'@'localhost';
FLUSH PRIVILEGES;



 


