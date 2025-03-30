<?php

$name = 'Alice';
$dish = 'Pasta';

// Escape arguments to prevent command injection
$name = escapeshellarg($name);
$dish = escapeshellarg($dish);

$output = shell_exec("node js/gemini-start.js $name $dish 2>&1");
echo $output;


?>