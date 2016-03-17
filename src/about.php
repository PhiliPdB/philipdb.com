<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

$current = 'about';
function get_age($year, $month, $day) {
	$age = date("Y") - $year;
	if (date("m") < $month) $age -= 1;
	elseif (date("m") == $month && date("d") < $day) $age -= 1;
	return $age;
}
function version($file) {
	return $file . '?' . filemtime($file);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require('../metatags.html'); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="Page about PhiliPdB" />
	<meta name="keywords" content="personal, website, philipdb, open, source, philip, de, bruin, about, me" />
	
	<title>About me</title>
	
	<link rel="stylesheet" href="<?=version('../css/style.css')?>">

	<!-- Favicons -->
	<?php include('../favicons.html') ?>
</head>
<body>
	<!-- Google Analytics -->
	<?php include_once("../analytics.html"); ?>

	<!-- Header -->
	<?php require('../components/header.html'); ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title" class="center">
			<h1>Who am I?</h1>
		</div>
	</div>

	<div class="card">
		<h4>In short</h4>
		<p>
			I'm a Dutch, <?=get_age(1999,06,19)?> years old, student with a passion for Android and web development. Which resulted in multiple web and Android apps.
		</p>
	</div>
	<div class="card">
		<p>
			When is was 13, I started with learning HTML, CSS and JavaScript to create my first very own website. After knowing how te create a website I began to make little games in Javascript to expand my knowledge. After a year I wanted more and created a very simple Snake game for my Android phone. Now I'm an active Android and web developer and have worked with a lot of different programming languages. I didn't only develop web and Android apps. I have also worked with scripting languages like Python, which is great for scripting.
		</p>
	</div>

	<!-- Footer -->
	<?php require('../components/footer.html'); ?>
	
	<!-- Scripts -->
	<script src="<?=version('../js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>