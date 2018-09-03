<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('php/main.php');

$main = new main(true);

$projects = $main->getProjects(4);

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

	<link rel="stylesheet" href="<?=$main->version("css/home.css")?>">

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

	<style>
		.overlay {
			position: fixed;
			z-index: 99999;
			top: 0;
			right: 0;
			color: white;
			width: 150px;
		}
	</style>
	<div class="overlay">
		<p>
			Speed: <span id="speed"></span><br>
			Direction: <span id="direction"></span>
		</p>
	</div>

	<!-- Cards -->
	<div id="about" class="card">
		<h2>About me</h2>
		<p class="first">
			After learning to create interactive websites on my 13th, I began making up own projects to expand my knowledge.
            Now I am <?=$main->get_age()?> years old and have developed multiple websites, web apps and Android apps.
            Sometimes it is hard to combine developing and studying, but so far it has succeeded...
		</p>
		<a class="button" href="about">Learn more about me</a>
	</div>

	<!-- Projects -->
	<div id="projects" class="card">
		<h2>Latest projects</h2>
		<div class="projects first">
			<?php foreach ($projects as $project): ?>
				<a id="<?=$project['project_tag']?>" class="project" href="projects#<?=$project['project_tag']?>">
					<img srcset="images/projects/<?=$project['project_tag']?>.png?w=250&h=250 250w,
                                 images/projects/<?=$project['project_tag']?>.png?w=400&h=400 400w,
                                 images/projects/<?=$project['project_tag']?>.png 512w"
                         sizes="(max-width:  320px) 300px,
                                (max-width: 1024px) 250px,
                                512px"
                         src="images/projects/<?=$project['project_tag']?>.png"
                         alt="<?=$project['project_title']?>"
                         width="512" height="512">
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
	<script src="<?=$main->version("js/main.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
