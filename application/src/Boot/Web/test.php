<?php

$projectRoot = dirname(dirname(dirname(__DIR__)));

putenv('ENVIRONMENT=testing');

require_once $projectRoot . '/public/index.php';
