<?php

use Codeception\Scenario;
use Etki\Coursebox\Tests\Support\Api;
use Etki\Coursebox\Tests\Support\DbHelper;

/** @type Scenario $scenario */

DbHelper::cleanUp();

$I = new SystemTester($scenario);
$I->wantTo('Post some posts and see them vanished on account delete');

$credentials = array('login' => 'login', 'password' => 'password');
$I->sendPOST(Api::getRoute(Api::ENDPOINT_USER), $credentials);
$I->seeResponseCodeIs(200);
$idList = $I->grabDataFromResponseByJsonPath('$.data.id');
$userId = reset($idList);

$I->sendPOST(Api::getRoute(Api::ENDPOINT_AUTH), $credentials);
$I->seeResponseCodeIs(200);

$post = array('title' => 'dummy title', 'content' => 'dummy content',);
$postJsonPath = sprintf('$.data[?(@.title=%s)]', $post['title']);

$I->sendGET(Api::getRoute(Api::ENDPOINT_POST));
$I->seeResponseCodeIs(200);
$I->dontSeeResponseJsonMatchesJsonPath($postJsonPath);

$I->sendPOST(Api::getRoute(Api::ENDPOINT_POST), $post);
$I->seeResponseCodeIs(200);
$idList = $I->grabDataFromResponseByJsonPath('$.data.id');
$id = reset($idList);

$I->sendGET(Api::getRoute(Api::ENDPOINT_POST));
$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson($post);

$I->sendGET(Api::getRoute(Api::ENDPOINT_POST, array($id)));
$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson($post);

$I->sendDELETE(Api::getRoute(Api::ENDPOINT_POST, array($id)));
$I->seeResponseCodeIs(200);

$I->sendGET(Api::getRoute(Api::ENDPOINT_POST));
$I->seeResponseCodeIs(200);
$I->dontSeeResponseContainsJson($post);

$I->sendPOST(Api::getRoute(Api::ENDPOINT_POST), $post);
$I->seeResponseCodeIs(200);

$I->sendGET(Api::getRoute(Api::ENDPOINT_POST));
$I->seeResponseCodeIs(200);
$I->seeResponseContainsJson($post);

$I->sendDELETE(Api::getRoute(Api::ENDPOINT_USER, array($userId)));
$I->seeResponseCodeIs(200);

$I->sendGET(Api::getRoute(Api::ENDPOINT_POST));
$I->seeResponseCodeIs(200);
$I->dontSeeResponseContainsJson($post);
