<?php

return array_replace_recursive(
    require __DIR__ . '/main.php',
    array(
        'controllerPath' => dirname(__DIR__) . '/Controllers',
        'viewPath' => dirname(__DIR__) . '/Views',
        'components' => array(
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'useStrictParsing' => true,
                'rules' => array(
                    array('cors/options', 'pattern' => '.*', 'verb' => 'OPTIONS'),
                    
                    array('auth/status', 'pattern' => 'api/v1/auth', 'verb' => 'GET',),
                    array('auth/login', 'pattern' => 'api/v1/auth', 'verb' => 'POST',),
                    array('auth/logout', 'pattern' => 'api/v1/auth', 'verb' => 'DELETE',),

                    array('user/index', 'pattern' => 'api/v1/user', 'verb' => 'GET',),
                    array('user/create', 'pattern' => 'api/v1/user', 'verb' => 'POST',),
                    array('user/read', 'pattern' => 'api/v1/user/<id:\d+>', 'verb' => 'GET',),
                    array('user/update', 'pattern' => 'api/v1/user/<id:\d+>', 'verb' => 'PUT',),
                    array('user/delete', 'pattern' => 'api/v1/user/<id:\d+>', 'verb' => 'DELETE',),

                    array('post/index', 'pattern' => 'api/v1/post', 'verb' => 'GET',),
                    array('post/create', 'pattern' => 'api/v1/post', 'verb' => 'POST',),
                    array('post/read', 'pattern' => 'api/v1/post/<id:\d+>', 'verb' => 'GET',),
                    array('post/update', 'pattern' => 'api/v1/post/<id:\d+>', 'verb' => 'PUT',),
                    array('post/delete', 'pattern' => 'api/v1/post/<id:\d+>', 'verb' => 'DELETE',),
                    '' => 'site/index'
                )
            ),
            'session' => array(
                'class' => 'CDbHttpSession',
                'autoCreateSessionTable' => true,
                'timeout' => 3600,
            ),
        ),
    )
);
