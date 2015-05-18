<?php

use Etki\Coursebox\Tests\Support\Api;
use Codeception\Scenario;

/** @type Scenario $scenario */
$scenario->group('smoke');
$I = new SystemTester($scenario);
$I->wantTo('Poke in random pages and get 200\'s');
$I->amOnPage('/');
$I->sendGET(Api::getRoute(Api::ENDPOINT_USER));
$I->seeResponseCodeIs(200);
$I->sendGET(Api::getRoute(Api::ENDPOINT_POST));
$I->seeResponseCodeIs(200);

$I->amGoingTo('create default user');

$credentials = array('login' => 'login', 'password' => 'password',);
$I->sendPOST(Api::getRoute(Api::ENDPOINT_USER), $credentials);
$I->sendPOST(Api::getRoute(Api::ENDPOINT_AUTH), $credentials);
$I->sendGET(Api::getRoute(Api::ENDPOINT_AUTH));
$I->seeResponseCodeIs(200);
