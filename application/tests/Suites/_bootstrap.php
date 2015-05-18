<?php
// This is global bootstrap for autoloading

use Codeception\Configuration;
use Codeception\Util\Autoload;

putenv('ENVIRONMENT=testing');

$projectRoot = dirname(dirname(__DIR__));

require_once $projectRoot . '/vendor/autoload.php';
require_once $projectRoot . '/vendor/yiisoft/yii/framework/yii.php';

$config = require_once $projectRoot . '/src/Config/web.php';

Yii::setPathOfAlias('fake-test-suites', Configuration::helpersDir() . '/FakeSuites');
Yii::import('fake-test-suites.*');

Yii::createWebApplication($config);
Autoload::registerSuffix(
    'Page',
    implode(DIRECTORY_SEPARATOR, array(__DIR__, 'Support', 'Pages',))
);

Yii::import('system.cli.commands.MigrateCommand');
$migrateCommand = new MigrateCommand('migrate', new CConsoleCommandRunner);
$migrateCommand->interactive = 0;
$migrateCommand->migrationPath = Yii::getPathOfAlias('application.Migrations');
$migrateCommand->actionUp(array(PHP_INT_MAX));
