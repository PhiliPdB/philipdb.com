CREATE DATABASE IF NOT EXISTS website;
USE website;

DROP TABLE IF EXISTS education;
CREATE TABLE education (
    education_id INT(11) NOT NULL AUTO_INCREMENT,
    education_name VARCHAR(255) NOT NULL,
    education_start_year YEAR NOT NULL,
    education_end_year YEAR NULL DEFAULT NULL,
    education_institution_name VARCHAR(255) NOT NULL,

    PRIMARY KEY (education_id)
) ENGINE = InnoDB;
