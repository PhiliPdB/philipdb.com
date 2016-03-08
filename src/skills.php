<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

$current = 'skills';
function version($file) {
	return $file . '?' . filemtime($file);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<?php require('../metatags.html'); ?>
	
	<title>PhiliPdB - Skills</title>
	
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
			<h1>My skills</h1>
		</div>
	</div>

	<div class="card">
		<h2>Technologies</h2>
		<div class="columns">
			<div>
				<h3>Day&#45;to&#45;day comfort</h3>
				<ul>
					<li>Java &#40;Android&#41; &#47; Android studio</li>
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
					<li>Responsive Layout and Design</li>
					<li>Cross&#45;Browser Compatibility</li>
				</ul>
			</div>
		</div>
		<a class="button" href="/contanct">Want to contact me?</a>
	</div>

	<!-- Footer -->
	<?php require('../components/footer.html'); ?>
	
	<!-- Scripts -->
	<script src="<?=version('../js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>