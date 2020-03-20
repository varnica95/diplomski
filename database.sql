CREATE DATABASE diplomski;

CREATE TABLE users(
                      id int(11) AUTO_INCREMENT PRIMARY KEY,
                      firstname TINYTEXT NOT NULL,
                      lastname TINYTEXT NOT NULL ,
                      username TINYTEXT NOT NULL ,
                      email TINYTEXT NOT NULL ,
                      gender VARCHAR(10) NOT NULL ,
                      birthdate DATETIME NOT NULL ,
                      password LONGTEXT NOT NULL ,
                      joined DATETIME NOT NULL
);

CREATE TABLE rememberme(
                         id int(11) AUTO_INCREMENT PRIMARY KEY,
                         user_id int(11),
                         hash LONGTEXT
);