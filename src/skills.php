<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('../php/helper.php');

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require("../metatags.html"); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="Skills and experience of PhiliPdB" />
	<meta name="keywords" content="skills, experience, personal, website, philipdb, open, source, philip, de, bruin" />

	<title>Skills</title>

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
			<h1>My skills</h1>
		</div>
	</div>

	<div class="card">
		<h2>Technologies</h2>
		<div class="columns first">
			<div>
				<h3>Day&#45;to&#45;day comfort</h3>
				<ul>
					<li>Java &#40;Android&#41;</li>
					<li>JavaScript</li>
					<li>HTML5 &#47; CSS3 &#40;SCSS&#41;</li>
					<li>PHP</li>
					<li>Version Control &#40;GIT&#41;</li>
					<li>Python 3</li>
				</ul>
			</div>
			<div>
				<h3>Experience with</h3>
				<ul>
					<li>GulpJS</li>
					<li>Firebase</li>
					<li>&#40;Material&#41; AngularJS</li>
					<li>Arduino</li>
					<li>Databases &#40;SQL&#41;</li>
					<li>Responsive Layout and Design</li>
					<li>Cross&#45;Browser Compatibility</li>
				</ul>
			</div>
		</div>
		<a class="button" href="/contact">Want to contact me?</a>
	</div>

	<!-- Footer -->
	<?php require("../components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=version("../js/script.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>