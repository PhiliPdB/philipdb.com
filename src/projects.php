<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

$current = 'projects';
function version($file) {
	return $file . '?' . filemtime($file);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require('../metatags.html'); ?>

	<title>PhiliPdB - Projects</title>

	<link rel="stylesheet" href="<?=version('../css/style.css')?>">

	<!-- Favicons -->
	<?php include('../favicons.html') ?>
</head>
<body>
	<!-- Header -->
	<?php require('../components/header.html'); ?>

	<!-- Banner -->
	<div id="home">
		<div class="background_image"></div>
		<div id="title" class="center">
			<h1>Projects</h1>
		</div>
	</div>

	<!-- Cards -->
	<div id="mastermind" class="card">
		<h2>MasterMind</h2>
		<h4>Web app</h4>
		<p>
			This was a school assignment, where we (a friend and I) chose to create a Mastermind game. It was not very hard to create. Except the mobile version, because we couldn't use HTML5's Drag &amp; Drop API. So we had to use the Touch API to simulate drag &amp; drop.
		</p>
		<a class="button" href="https://github.com/PhiliPdB/MasterMind" target="_blank">View MasterMind on Github</a>
		<a class="button" href="//projects.philipdb.com/mastermind" target="_blank">Play MasterMind</a>
	</div>
	<div id="woording" class="card">
		<h2>Woording Android</h2>
		<h4>Android app</h4>
		<p>
			Me and two friends decided to create a service that helps you learn words. Actually they asked me to join. At first we created an API and a website, but that website wasn't great so they started to recreate the website, while I began working on the Android app. This app is still in beta, so the only way to get this is by signing up for the beta.
		</p>
		<a class="button" href="https://github.com/woording/woording-android" target="_blank">View Woording on Github</a>
		<a class="button" href="https://play.google.com/apps/testing/com.woording.android" target="_blank">Sign up for Woording Beta</a>
		<a class="button" href="https://woording.com" target="_blank">Go to Woording website</a>
	</div>
	
	<!-- Footer -->
	<?php require('../components/footer.html'); ?>
	
	<!-- Scripts -->
	<script src="<?=version('../js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>