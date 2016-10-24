<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

$current = "sitemap";
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
	<meta name="description" content="sitemap of philipdb.com" />
	<meta name="keywords" content="sitemap, personal, website, philipdb, open, source, philip, de, bruin" />

	<title>Sitemap</title>

	<link rel="stylesheet" href="<?=version("../css/style.css")?>">

	<!-- Favicons -->
	<?php include("../favicons.html") ?>
</head>
<body>
	<!-- Google Analytics -->
	<?php include_once("../analytics.html"); ?>

	<!-- Header -->
	<?php require("../components/header.html"); ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title" class="center">
			<h1>Sitemap</h1>
		</div>
	</div>

	<div class="card">
		<h3>Main pages</h3>
		<ul class="links">
			<li><a href="/">Home</a></li>
			<li><a href="/about">About me</a></li>
			<li><a href="/projects">My projects</a></li>
			<li><a href="/skills">Skils</a></li>
			<li><a href="/contact">Contact</a></li>
		</ul>
		<h3>Projects</h3>
		<ul class="links">
			<li><a href="/projects#mastermind">Mastermind</a></li>
			<li><a href="/projects#woording">Woording</a></li>
			<li><a href="//projects.philipdb.com">More projects</a></li>
		</ul>
	</div>

	<!-- Footer -->
	<?php require("../components/footer.html"); ?>

	<!-- Scripts -->
	<script src="<?=version("../js/script.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>