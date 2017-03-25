<?php 

$url = "https://facebook.com";
$output = file_get_contents($url);
print_r($output);