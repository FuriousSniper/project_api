
CREATE DATABASE praktykant_api;
USE praktykant_api;

CREATE TABLE words (
    id    INTEGER NOT NULL AUTO_INCREMENT,
    word  VARCHAR(30),
    PRIMARY KEY (id)
);