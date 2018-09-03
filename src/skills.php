<?php
// Enable PHP Gzip compression
ob_start("ob_gzhandler");

require('../php/main.php');

$main =  new main(true);

// Get skills from database
$skills = $main->getSkills();

$education = $main->getEducation();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require("../metatags.html"); ?>
	<!-- Search engine stuff -->
	<meta name="author" content="PhiliPdB">
	<meta name="description" content="Skills and experience of PhiliPdB" />
	<meta name="keywords" content="skills, experience, personal, website, philipdb, open, source, philip, de, bruin" />

	<title>Skills</title>

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
			<h1>My skills</h1>
		</div>
	</div>

	<div class="card">
		<h2>Technologies</h2>
        <p style="margin-top: -10px;">
            <small>In no particular order.</small>
        </p>
		<div class="columns first">
			<div>
				<h3>Day-to-day comfort</h3>
                <ul>
                    <?php foreach ($skills["day-to-day"] as $skill): ?>
                        <li><?=$skill["skill_name"]?></li>
                    <?php endforeach; ?>
                </ul>
			</div>
			<div>
				<h3>Experience with</h3>
                <ul>
                    <?php foreach ($skills["experience"] as $skill): ?>
                        <li><?=$skill["skill_name"]?></li>
                    <?php endforeach; ?>
                </ul>
			</div>
		</div>
		<a class="button" href="/contact">Want to contact me?</a>
	</div>

    <div class="card" id="education">
        <h2 class="sideways">Education</h2>

        <div class="first">
            <?php foreach ($education as $item): ?>
                <h3><?=$item["education_name"]?></h3>
                <p>
                    <?=$item["education_institution_name"]?><br>
                    <?=$item["education_start_year"]?> - <?=$item["education_end_year"] ? $item["education_end_year"] : "now"?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>

	<!-- Footer -->
	<?php require("../components/footer.php"); ?>

	<!-- Scripts -->
	<script src="<?=$main->version("../js/main.js")?>" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>
