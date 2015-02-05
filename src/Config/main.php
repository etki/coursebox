<?php

$appRoot = dirname(__DIR__);
$projectRoot = dirname($appRoot);

return array(
    'name' => 'Coursebox 0.1.0',
    'id' => 'etki/coursebox',
    'basePath' => $appRoot,
    'runtimePath' => $appRoot . '/Runtime',
    'language' => 'ru',
    'aliases' => array(
        'app' => $appRoot,
        'vendor' => $projectRoot . '/vendor',
    ),
    'import' => array(
        'app.Components.*',
        'app.Controllers.*',
        'app.Models.*',
    ),
    'components' => array(
        'db' => require __DIR__ . '/db.php',
    )
);
