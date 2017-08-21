<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

function version($file) {
	return $file . '?' . filemtime($file);
}
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
	<div id="mastermind" class="card">
		<h2>MasterMind</h2>
		<h4>Web app</h4>
		<p class="first">
			This was a school assignment, where we (a friend and I) chose to create a Mastermind game. It was not very hard to create. Except the mobile version, because we couldn't use HTML5's Drag &amp; Drop API. So we had to use the Touch API to simulate drag &amp; drop.
		</p>
		<a class="button" href="https://github.com/PhiliPdB/MasterMind" target="_blank">View MasterMind on Github</a>
		<a class="button" href="//projects.philipdb.com/mastermind" target="_blank">Play MasterMind</a>
	</div>
	<div id="woording" class="card">
		<h2>Woording Android</h2>
		<h4>Android app</h4>
		<p class="first">
			Me and two friends decided to create a service that helps you learn words. Actually they asked me to join. At first we created an API and a website, but that website wasn't great so they started to recreate the website, while I began working on the Android app. Currently the project is a bit dead, but there are plans to bring it back to live again.
		</p>
		<a class="button" href="https://github.com/woording/" target="_blank">View Woording on Github</a>
	</div>
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