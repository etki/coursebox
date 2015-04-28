<?php

$projectRoot = dirname(__DIR__);
$appRoot = $projectRoot . '/src';

defined('YII_DEBUG') or define('YII_DEBUG', true);

require $projectRoot . '/vendor/autoload.php';
require $projectRoot . '/vendor/yiisoft/yii/framework/yii.php';

$config = require $appRoot .'/Config/web.php';
Yii::createWebApplication($config)->run();
