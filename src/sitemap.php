<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

$current = 'sitemap';
function version($file) {
	return $file . '?' . filemtime($file);
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require('../metatags.html'); ?>
	
	<title>Sitemap</title>
	
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
			<h1>Sitemap</h1>
		</div>
	</div>

	<div class="card">
		<h4>Main pages</h4>
		<ul class="links">
			<li><a href="/">Home</a></li>
			<li><a href="/about">About me</a></li>
			<li><a href="/projects">My projects</a></li>
			<li><a href="/skills">Skils</a></li>
			<li><a href="/contact">Contact</a></li>
		</ul>
	</div>

	<!-- Footer -->
	<?php require('../components/footer.html'); ?>
	
	<!-- Scripts -->
	<script src="<?=version('../js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>