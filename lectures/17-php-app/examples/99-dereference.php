<?php

$var = 12;
$name = 'var';
echo '$$name: ', $$name, PHP_EOL, '<br/>';
echo "\${'v' . 'a' . 'r'}: ", ${'v' . 'a' . 'r'}, PHP_EOL, '<br/>';
echo '$var: ', "$var";
