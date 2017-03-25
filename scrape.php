<?php 

$url = "https://www.linkedin.com/pub/dir/azhary/+";
$output = file_get_contents($url);
echo $output;