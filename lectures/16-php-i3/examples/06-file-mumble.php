<?php

print_r(scandir(__DIR__));
$filePath = __DIR__ . '/01-array-basic.php';
$contents = file_get_contents($filePath);
echo '<pre>', htmlentities($contents), '</pre>';
file_put_contents($filePath, $contents . ' // he-he');
