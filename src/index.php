<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('php/helper.php');
require('php/database_helper.php');

$projects = getProjects(4);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require("metatags.html"); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="My personal website" />
	<meta name="keywords" content="personal, website, philipdb, open, source, philip, de, bruin" />

	<title>PhiliPdB</title>

	<link rel="stylesheet" href="<?=version("css/home.css")?>">

	<!-- Favicons -->
	<?php include("favicons.html") ?>
</head>
<body>
	<!-- Google Analytics -->
	<?php include_once("analytics.html"); ?>

	<!-- Header -->
	<?php require("components/header.php") ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title">
			<h1>Developer.</h1>
			<div class="buttons">
				<a href="contact">Contact</a>
				<a href="skills">Skills</a>
			</div>
		</div>
	</div>

	<!-- Cards -->
	<div id="about" class="card">
		<h2>About me</h2>
		<p class="first">
			After learning to create interactive websites on my 13th, I began making up own projects to expand my knowledge. Now I am <?=get_age(1999,06,19)?> years old and have developed multiple websites, web apps and Android apps. Sometimes it is sometimes hard to combine developing and school, but so far it has succeeded...
		</p>
		<a class="button" href="about">Learn more about me</a>
	</div>

	<!-- Projects -->
	<div id="projects" class="card">
		<h2>Latest projects</h2>
		<div class="projects">
			<?php foreach ($projects as $project): ?>
				<a id="<?=$project['project_tag']?>" class="project" href="projects#<?=$project['project_tag']?>">
					<img src="images/projects/<?=$project['project_tag']?>.png" alt="<?=$project['project_title']?>" width="512" height="512">
					<div class="description">
						<div class="title"><?=$project['project_title']?></div>
						<div class="subtitle"><?=$project['project_subtitle']?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<a class="button" href="projects">View all my projects</a>
	</div>

	<!-- Footer -->
	<?php require("components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=version("js/script.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
