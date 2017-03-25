<?php 

$url = "https://www.linkedin.com/pub/dir/azhary/+";
$output = file_get_contents($url);
print_r($output);