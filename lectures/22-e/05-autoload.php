<?php

function takeCare() {
    require_once __DIR__ . '/02-magic-01.php';
}

spl_autoload_register('takeCare');

$magic = new Magician();
var_dump($magic);
