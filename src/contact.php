<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('../php/main.php');

$main = new main();

// Send email when post data is there
if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["body"])
	&& filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	// Send email
    mail(
		"philip@philipdb.com",
		$_POST["subject"],
		$_POST["body"],
		implode("\r\n", [
            "From: philipdb.com <noreply@philipdb.com>",
            "Reply-to: " . $_POST["email"],
            "X-Mailer: PHP/" . phpversion()
        ])
	);
	// Clear post
	$_POST = [];
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require("../metatags.html"); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="Contact information of PhiliPdB" />
	<meta name="keywords" content="contact, email, personal, website, philipdb, open, source, philip, de, bruin" />

	<title>Contact</title>

	<link rel="stylesheet" href="<?=$main->version("../css/contact.css")?>">

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
			<h1>Contact</h1>
		</div>
	</div>

	<div class="card">
		<p>If you want an Android app or a website. I can do it all for you, so feel free to email me or fill in the form below.</p>
		<a class="button" href="mailto:philip@philipdb.com">Email me</a>
	</div>
	<div class="card">
		<h2>Contact form</h2>
		<form action="" method="POST">
			<div class="group">
				<input type="text" required id="name" name="name" autocomplete="name">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label for="name">Name</label>
			</div><br>
			<div class="group">
				<input type="email" required id="email" name="email" autocomplete="email" oninput="this.className = 'validate'">
				<span class="highlight"></span>
				<span class="bar"></span>
				<label for="email">Email</label>
			</div><br>
			<div class="group">
				<input type="text" required id="subject" name="subject" spellcheck>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label for="subject">Subject</label>
			</div><br>
			<div class="group">
				<textarea required id="body" name="body" rows="4" spellcheck></textarea>
				<span class="highlight"></span>
				<span class="bar"></span>
				<label for="body">Message</label>
			</div><br>

			<input type="submit" value="Send">
		</form>
	</div>

	<!-- Footer -->
	<?php require("../components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=$main->version("../js/main.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
