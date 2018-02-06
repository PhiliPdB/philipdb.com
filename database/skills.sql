CREATE DATABASE IF NOT EXISTS website;
USE website;

DROP TABLE IF EXISTS skills;
CREATE TABLE skills (
    skill_id INT(11) NOT NULL AUTO_INCREMENT,
    skill_name VARCHAR(255) NOT NULL,
    skill_more_experience BOOLEAN NOT NULL DEFAULT FALSE,

    PRIMARY KEY (skill_id)
) ENGINE = InnoDB;
