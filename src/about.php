<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('../php/main.php');

$main = new main();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require("../metatags.html"); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="This is all about me, PhiliPdB" />
	<meta name="keywords" content="about, who, i, am, me, personal, website, philipdb, open, source, philip, de, bruin" />

	<title>About me</title>

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
			<h1>Who am I?</h1>
		</div>
	</div>

	<!-- Main content -->
	<div class="card">
		<h4>In short</h4>
		<p>
			I am a Dutch, <?=$main->get_age()?> years old, student with a passion for Android and web development. Which resulted in multiple web and Android apps.
		</p>
	</div>
	<div class="card">
		<h4>History</h4>
		<p>
			When I was 13, I started with learning HTML, CSS and JavaScript to create my first very own website. After knowing how te create a website I began to make little games in Javascript to expand my knowledge. After a year I wanted more and created a very simple Snake game for my Android phone. After that, I continued developing Android apps, of which the result can be seen on my developer account.
		</p>
	</div>
	<div class="card">
		<h4>My current life</h4>
		<p>
			Now I am an active Android and web developer who combines school and development, but I do not only develop web and Android apps. Sometimes I work with Python, which is a great language for scripting. Also I have tried multiple frameworks and programming tools.
		</p>
	</div>

	<!-- Footer -->
	<?php require("../components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=$main->version("../js/script.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
