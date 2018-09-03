<?php $page = $_SERVER["REQUEST_URI"];?>

<nav id="navigation_drawer">
	<div class="navigation">
        <?php foreach ($main->navigation as $link=>$name): ?>
            <div class="link"><a href="<?=$link?>"><?=$name?></a></div>
        <?php endforeach; ?>
	</div>
</nav>
<div id="header_background"></div>
<header>
	<svg class="menu" fill="#FFFFFF" height="24" viewBox="0 0 24 24" width="24" onclick="app.drawer.open()">
		<path d="M0 0h24v24H0z" fill="none"/>
		<path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
	</svg>
	<h1>PhiliPdB</h1>
	<div class="navigation">
        <?php foreach ($main->navigation as $link=>$name): ?>
            <div class="link <?php if ($page === $link) echo "current"; ?>"><a href="<?=$link?>"><?=$name?></a></div>
        <?php endforeach; ?>
	</div>
</header>
