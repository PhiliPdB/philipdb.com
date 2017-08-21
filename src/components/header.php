<?php $page = $_SERVER["REQUEST_URI"];?>

<nav id="navigation_drawer">
	<div class="navigation">
		<div class="link"><a href="/">Home</a></div><hr>
		<div class="link"><a href="/about">About me</a></div><hr>
		<div class="link"><a href="/projects">Projects</a></div><hr>
		<div class="link"><a href="/skills">Skills</a></div><hr>
		<div class="link"><a href="/contact">Contact</a></div>
	</div>
</nav>
<div id="header_background"></div>
<header>
	<svg class="menu" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" onclick="openDrawer()">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
	</svg>
	<h1>PhiliPdB</h1>
	<div class="navigation">
		<div class="link <?php if ($page === '/') echo 'current'; ?>"><a href="/">Home</a></div>
		<div class="link <?php if ($page === '/about') echo 'current'; ?>"><a href="/about">About me</a></div>
		<div class="link <?php if ($page === '/projects') echo 'current'; ?>"><a href="/projects">Projects</a></div>
		<div class="link <?php if ($page === '/skills') echo 'current'; ?>"><a href="/skills">Skills</a></div>
		<div class="link <?php if ($page === '/contact') echo 'current'; ?>"><a href="/contact">Contact</a></div>
	</div>
</header>