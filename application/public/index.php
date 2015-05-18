<?php

// thing that actually HAS to be done through configuration

if (!ini_get('date.timezone')) {
    date_default_timezone_set('Europe/Moscow');
}

$projectRoot = dirname(__DIR__);
$appRoot = $projectRoot . '/src';

if (!getenv('ENVIRONMENT')) {
    putenv('ENVIRONMENT=production');
}
if (getenv('ENVIRONMENT') !== 'production') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
}

require $projectRoot . '/vendor/autoload.php';
require $projectRoot . '/vendor/yiisoft/yii/framework/yii.php';

$config = require $appRoot .'/Config/web.php';
/** @type CWebApplication $application */
$application = Yii::createWebApplication($config);
$application->onBeginRequest = 'EnvironmentManager::setApplicationEnvironment';
$application->run();
