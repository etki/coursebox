<?php

return array_replace_recursive(
    require __DIR__ . '/main.php',
    array(
        'controllerPath' => dirname(__DIR__) . '/Controllers',
        'viewPath' => dirname(__DIR__) . '/Views',
        'components' => array(
            'urlManager' => array(
                'urlFormat' => 'path',
                'rules' => array(
                    array('user/create', 'pattern' => 'api/v1/user', 'verb' => 'POST'),
                    array('user/list', 'pattern' => 'api/v1/user', 'verb' => 'GET'),
                    array('user/single', 'pattern' => 'api/v1/user/<id:\d+>', 'verb' => 'GET'),
                    array('auth/status', 'pattern' => 'api/v1/auth', 'verb' => 'GET'),
                    array('auth/login', 'pattern' => 'api/v1/auth', 'verb' => 'POST'),
                    array('auth/logout', 'pattern' => 'api/v1/auth', 'verb' => 'DELETE'),
                    array('post/new', 'pattern' => 'api/v1/post', 'verb' => 'POST'),
                    array('post/index', 'pattern' => 'api/v1/post', 'verb' => 'GET'),
                    'api/v1/user' => 'user',
                    '' => 'site/index'
                )
            ),
        ),
    )
);
