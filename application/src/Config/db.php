<?php

$dbName = 'db.sqlite3';

$environment = EnvironmentManager::getEnvironment();
if ($environment === EnvironmentManager::ENVIRONMENT_TESTING) {
    $dbName = 'db.testing.sqlite3';
}

$path = dirname(__DIR__) . '/Runtime/' . $dbName;

return array(
    'connectionString' => 'sqlite:' . $path,
    'charset' => 'utf8',
);
