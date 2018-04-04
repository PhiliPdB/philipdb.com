<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('../php/main.php');

$main = new main(true);

$projects = $main->getProjects();
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

	<link rel="stylesheet" href="<?=$main->version("../css/main.css")?>">

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

	<!-- Projects -->
	<?php foreach ($projects as $project): ?>
		<div id="<?=$project['project_tag']?>" class="card">
			<!-- Titles -->
			<h2><?=$project['project_title']?></h2>
			<h4><?=$project['project_subtitle']?></h4>
			<!-- Description -->
			<p class="first"><?=$project['project_description']?></p>
			<!-- Project links -->
			<?php foreach ($project['project_links'] as $project_link): ?>
                <?php
                    // Parse variables in url string
                    $link = str_replace("{{domain}}", $_SERVER['HTTP_HOST'], $project_link['project_link_url']);
                 ?>
				<a class="button" href="<?=$link?>" target="_blank"><?=$project_link['project_link_text']?></a>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>

	<!-- More card -->
	<div id="more" class="card">
		<h2>More projects</h2>
		<h4>Web &amp; Android apps</h4>
		<p class="first">
			These are not my only projects. You can view more by clicking on the button below.
		</p>
		<a class="button" href="//projects.<?=$_SERVER['HTTP_HOST']?>>" target="_blank">Projects website</a>
	</div>

	<!-- Footer -->
	<?php require("../components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=$main->version("../js/script.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
