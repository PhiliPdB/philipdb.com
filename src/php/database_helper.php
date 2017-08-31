<?php

function getProjects($limit = null) {
	require 'connection.php';

	// Build query
	$query = "SELECT * FROM projects ORDER BY project_id DESC";

	// Add limit when needed
	if ($limit != null) {
		$query .= " LIMIT $limit";
	}

	// Get projects
	$projects = $connection->query($query)->fetch_all(MYSQLI_ASSOC);

	// Add project links
	foreach ($projects as &$project) {
		$project['project_links'] = $connection->query("SELECT project_link_text, project_link_url FROM project_links WHERE project_link_project_id = " . $project['project_id'])->fetch_all(MYSQLI_ASSOC);
	}

	return $projects;
}
