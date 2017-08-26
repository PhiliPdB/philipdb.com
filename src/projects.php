<?php
require('../php/database_helper.php');

// Enable PHP Gzip compression
ob_start("ob_gzhandler");

function version($file) {
	return $file . '?' . filemtime($file);
}

$projects = getProjects();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require("../metatags.html"); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="Some projects made by PhiliPdB" />
	<meta name="keywords" content="web, android, projects, personal, website, philipdb, open, source, philip, de, bruin" />

	<title>Projects</title>

	<link rel="stylesheet" href="<?=version("../css/style.css")?>">

	<!-- Favicons -->
	<?php include("../favicons.html") ?>
</head>
<body>
	<!-- Google Analytics -->
	<?php include_once("../analytics.html"); ?>

	<!-- Header -->
	<?php require("../components/header.php"); ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title">
			<h1>Projects</h1>
		</div>
	</div>

	<!-- Cards -->
	<?php foreach($projects as $project): ?>
		<div id="<?=$project['project_tag']?>" class="card">
			<!-- Titles -->
			<h2><?=$project['project_title']?></h2>
			<h4><?=$project['project_subtitle']?></h4>
			<!-- Description -->
			<p class="first"><?=$project['project_description']?></p>
			<!-- Project links -->
			<?php foreach($project['project_links'] as $project_link): ?>
				<a class="button" href="<?=$project_link['project_link_url']?>" target="_blank"><?=$project_link['project_link_text']?></a>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>

	<!-- More card -->
	<div id="more" class="card">
		<h2>More projects</h2>
		<h4>Web apps</h4>
		<p class="first">
			These are not my only projects. You can view more by clicking on the button below.
		</p>
		<a class="button" href="//projects.philipdb.com" target="_blank">Projects website</a>
	</div>

	<!-- Footer -->
	<?php require("../components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=version("../js/script.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>