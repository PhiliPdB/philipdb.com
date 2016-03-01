<?php 
function get_age($year, $month, $day) {
	$age = date("Y") - $year;
	if (date("m") < $month) $age -= 1;
	elseif (date("m") == $month && date("d") < $day) $age -= 1;
	return $age;
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<?php require('metatags.html'); ?>
	
	<title>PhiliPdB</title>
	
	<link rel="stylesheet" href="build/css/style.css">
</head>
<body>
	<!-- Header -->
	<div id="header_background"></div>
	<header>
		<h1>PhiliPdB</h1>
		<div class="navigation">
			<div class="link"><a href="about">About me</a></div>
			<div class="link"><a href="projects">Projects</a></div>
			<div class="link"><a href="skills">Skills</a></div>
			<div class="link"><a href="contact">Contact</a></div>
		</div>
	</header>

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
		<h1>About me</h1>
		<p>
			After learning to create interactive websites on my 13th, I began making up own projects to expand my knowledge. Now I'm <?=get_age(1999,06,19)?> and I have developed multiple websites and Android apps. Sometimes it's hard to combine developing and school, but so far it has succeeded...
		</p>
		<a class="button" href="about">Learn more about me</a>
	</div>
	<div id="projects" class="card">
		<h1>Latest projects</h1>
		<div class="projects">
			<div class="project" id="mastermind">
				<img src="projects/images/mastermind.jpg" alt="MasterMind">
				<div class="description">
					<div class="title">MasterMind</div>
					<div class="subtitle">Web app</div>
				</div>
			</div>
			<div class="project">
				<img src="projects/images/woording.png" alt="Woording">
				<div class="description">
					<div class="title">Woording</div>
					<div class="subtitle">Android app</div>
				</div>
			</div>
		</div>
		<a class="button" href="projects">View all my projects</a>
	</div>

	<!-- Footer -->
	<footer class="card">
		&copy; <?=date("Y")?> PhiliPdB
	</footer>

	<!-- Scripts -->
	<script src="build/js/script.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>