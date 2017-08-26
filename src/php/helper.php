<?php

function get_age($year, $month, $day) {
	$age = date('Y') - $year;
	if (date('m') < $month) $age -= 1;
	elseif (date('m') == $month && date('d') < $day) $age -= 1;
	return $age;
}

function version($file) {
	return $file . '?' . filemtime($file);
}
