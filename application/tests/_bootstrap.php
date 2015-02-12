<?php
// This is global bootstrap for autoloading

$projectRoot = dirname(__DIR__);

require_once $projectRoot . '/vendor/autoload.php';
require_once $projectRoot . '/vendor/yiisoft/yii/framework/yii.php';

$config = require_once $projectRoot . '/src/Config/web.php';

Yii::setPathOfAlias('fake-test-suites', __DIR__ . '/_support/FakeSuites');
Yii::import('fake-test-suites.*');

Yii::createWebApplication($config);