<?php

function getProjects() {
	require 'connection.php';

	// Get projects
	$projects = $connection->query("SELECT * FROM projects ORDER BY project_id DESC")->fetch_all(MYSQLI_ASSOC);

	// Add project links
	foreach ($projects as &$project) {
		$project['project_links'] = $connection->query("SELECT project_link_text, project_link_url FROM project_links WHERE project_link_project_id = " . $project['project_id'])->fetch_all(MYSQLI_ASSOC);
	}

	return $projects;
}
