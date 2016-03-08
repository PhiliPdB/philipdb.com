<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

$current = 'home';
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
<html>
<head>
	<?php require('metatags.html'); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="My personal website" />
	<meta name="keywords" content="personal, website, philipdb, open, source" />
	
	<title>PhiliPdB</title>
	
	<link rel="stylesheet" href="<?=version('css/style.css')?>">

	<!-- Favicons -->
	<?php include('favicons.html') ?>
</head>
<body>
	<!-- Header -->
	<?php require('components/header.html') ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title" class="center">
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
		<p>
			After learning to create interactive websites on my 13th, I began making up own projects to expand my knowledge. Now I'm <?=get_age(1999,06,19)?> and I have developed multiple websites and Android apps. Sometimes it's hard to combine developing and school, but so far it has succeeded...
		</p>
		<a class="button" href="about">Learn more about me</a>
	</div>
	<div id="projects" class="card">
		<h2>Latest projects</h2>
		<div class="projects">
			<a class="project" id="mastermind" href="projects#mastermind">
				<img src="images/projects/mastermind.png" alt="MasterMind" width="512" height="512">
				<div class="description">
					<div class="title">MasterMind</div>
					<div class="subtitle">Web app</div>
				</div>
			</a>
			<a href="projects#woording" class="project" id="woording">
				<img src="images/projects/woording.png" alt="Woording" width="512" height="512">
				<div class="description">
					<div class="title">Woording</div>
					<div class="subtitle">Android app</div>
				</div>
			</a>
		</div>
		<a class="button" href="projects">View all my projects</a>
	</div>

	<!-- Footer -->
	<?php require('components/footer.html'); ?>

	<!-- Scripts -->
	<script src="<?=version('js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>