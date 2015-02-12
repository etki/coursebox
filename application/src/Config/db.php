<?php

$path = dirname(__DIR__) . '/Runtime/db.sqlite3';

return array(
    'connectionString' => 'sqlite:' . $path,
    'charset' => 'utf8',
);
