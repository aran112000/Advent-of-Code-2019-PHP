<?php
ini_set('xdebug.max_nesting_level', 15000);

require('src/Test.php');
require('src/Performance.php');
require('src/AdventOfCode.php');
require('src/Autoloader.php');

$day = 9; // Set to an integer to force a given day

if ($day === null) {
    $day = date('d');
}
$day = str_pad($day, 2, '0', STR_PAD_LEFT);

$class = "AdventOfCode\Day$day\Day$day";
(new $class())->init();
