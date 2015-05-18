<?php

use Codeception\Scenario;
use Etki\Coursebox\Tests\Support\Api;
use Etki\Coursebox\Tests\Support\DbHelper;

/** @type Scenario $scenario */

DbHelper::cleanUp();

$I = new SystemTester($scenario);
$I->wantTo('Create user and authorize');

$login = 'dummy user';
$password = 'dummy password';
$credentials = array('login' => $login, 'password' => $password);

$I->amGoingTo('ensure there is no such account yet');

$I->sendGET(Api::getRoute(Api::ENDPOINT_AUTH));
$I->seeResponseCodeIs(401);
$I->sendPOST(Api::getRoute(Api::ENDPOINT_AUTH), $credentials);
$I->seeResponseCodeIs(400);

$I->amGoingTo('Create new account');

$jsonPath = sprintf('$.data[?(@.login=%s)]', $login);
$I->sendGET(Api::getRoute(Api::ENDPOINT_USER));
$I->dontSeeResponseJsonMatchesJsonPath($jsonPath);
$I->sendPOST(Api::getRoute(Api::ENDPOINT_USER), $credentials);
$I->seeResponseCodeIs(200);
$idList = $I->grabDataFromResponseByJsonPath('$.data.id');
$id = reset($idList);

$I->amGoingTo('Verify account has been created');

$I->sendGET(Api::getRoute(Api::ENDPOINT_USER));
$I->seeResponseJsonMatchesJsonPath($jsonPath);

$I->sendGET(Api::getRoute(Api::ENDPOINT_USER, array($id)));
$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson(array('login' => $login,));

$I->amGoingTo('Verify auth is working');

$I->sendGET(Api::getRoute(Api::ENDPOINT_AUTH));
$I->seeResponseCodeIs(401);
$I->sendPOST(Api::getRoute(Api::ENDPOINT_AUTH), $credentials);
$I->seeResponseCodeIs(200);
$I->sendDELETE(Api::getRoute(Api::ENDPOINT_AUTH));
$I->seeResponseCodeIs(200);
$I->sendGET(Api::getRoute(Api::ENDPOINT_AUTH));
$I->seeResponseCodeIs(401);

$I->amGoingTo('update my identity');

$newCredentials = array('login' => 'super-login', 'password' => 'ultimate-password');
$data = $newCredentials;
$data['password'] = $credentials['password'];
$data['new-password'] = $newCredentials['password'];
$I->sendPOST(Api::getRoute(Api::ENDPOINT_AUTH), $credentials);
$I->seeResponseCodeIs(200);
$I->sendGET(Api::getRoute(Api::ENDPOINT_AUTH));
$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson(array('id' => $id, 'login' => $credentials['login'],));
$I->sendPUT(Api::getRoute(Api::ENDPOINT_USER, array($id,)), $data);
$I->seeResponseCodeIs(200);
$I->sendDELETE(Api::getRoute(Api::ENDPOINT_AUTH));
$I->seeResponseCodeIs(200);

$I->amGoingTo('delete my account');

$I->sendDELETE(Api::getRoute(Api::ENDPOINT_USER, array($id)));
$I->seeResponseCodeIs(401);
$I->sendPOST(Api::getRoute(Api::ENDPOINT_AUTH), $newCredentials);
$I->seeResponseCodeIs(200);
$I->sendDELETE(Api::getRoute(Api::ENDPOINT_USER, array($id)));
$I->seeResponseCodeIs(200);
$I->sendGET(Api::getRoute(Api::ENDPOINT_USER, array($id)));
$I->seeResponseCodeIs(404);
$I->sendGET(Api::getRoute(Api::ENDPOINT_USER));
$I->seeResponseCodeIs(200);
$I->dontSeeResponseJsonMatchesJsonPath(sprintf('$.data[?(@.login=%s)]', $login));
