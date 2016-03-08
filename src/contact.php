<?php 
// Enable PHP Gzip compression
ob_start('ob_gzhandler');

$current = 'contact';
function version($file) {
	return $file . '?' . filemtime($file);
}

// Send
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['body'])) {
	mail(
		"philip@philipdb.com",
		$_POST['subject'],
		$_POST['body'],
		"From: philipdb.com <noreply@philipdb.com>" . '\r\n' .
		"Reply-to: " . $_POST['email'] . '\r\n' .
		"X-Mailer: PHP/" . phpversion()
	);
	$_POST = array();
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<?php require('../metatags.html'); ?>
	
	<title>PhiliPdB - Contact</title>
	
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
			<h1>Contact</h1>
		</div>
	</div>

	<div class="card">
		<h2>Contact me</h2>
		<form action="" method="POST">
			<div class="group">
				<input type="text" required name="name" autocomplete>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Name</label>
			</div><br>
			<div class="group">
				<input type="email" required name="email" autocomplete>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Email</label>
			</div><br>
			<div class="group">
				<input type="subject" required name="subject" autocomplete spellcheck>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Subject</label>
			</div><br>
			<div class="group">
				<textarea required name="body" columns="70" rows="4" autocomplete spellcheck></textarea>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label>Message</label>
			</div><br>

			<input type="submit" value="Send">
		</form>
	</div>

	<!-- Footer -->
	<?php require('../components/footer.html'); ?>
	
	<!-- Scripts -->
	<script src="<?=version('../js/script.js')?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>