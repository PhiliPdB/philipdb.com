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
			I am a Dutch, <?=$main->get_age()?> years old, student with a passion for Android and web development.
            Which resulted in multiple web and Android apps.
		</p>
	</div>
	<div class="card">
		<h4>History</h4>
		<p>
			At the age of 13, I started with learning HTML, CSS and (a bit) JavaScript to create my first very own website.
            When I knew how to create a website I began to make little games in Javascript to expand my knowledge.
            Then I started to look into developing things for android. I first created a very simple snake game.
            After that, I continued developing Android and web apps. Sometimes even as school project.
		</p>
	</div>
	<div class="card">
		<h4>My current life</h4>
		<p>
            Now I am studying computer science and mathematics at Utrecht University, so I don't have lot of time to do side projects.

			<!--Now I am an active Android and web developer who combines school and development, but I do not only develop web and Android apps.
            Sometimes I work with Python, which is a great language for scripting. Also I have tried multiple frameworks and programming tools.-->
		</p>
	</div>

	<!-- Footer -->
	<?php require("../components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=$main->version("../js/script.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
