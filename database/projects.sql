CREATE DATABASE IF NOT EXISTS website;
USE website;

DROP TABLE IF EXISTS projects;
CREATE TABLE projects (
	project_id INT(11) NOT NULL AUTO_INCREMENT,
	project_tag VARCHAR(255) NOT NULL,
	project_title VARCHAR(255) NOT NULL,
	project_subtitle VARCHAR(255) NOT NULL,
	project_description TEXT NOT NULL,
	project_date DATE NULL,
	project_creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY (project_id),
	UNIQUE KEY (project_tag)
) ENGINE = InnoDB;

DROP TABLE IF EXISTS project_links;
CREATE TABLE project_links (
	project_link_id INT(11) NOT NULL AUTO_INCREMENT,
	project_link_project_id INT(11) NOT NULL,
	project_link_text VARCHAR(255) NOT NULL,
	project_link_url VARCHAR(255) NOT NULL,

	PRIMARY KEY (project_link_id),
	FOREIGN KEY(project_link_project_id) REFERENCES projects(project_id) ON DELETE CASCADE
) ENGINE = InnoDB;
