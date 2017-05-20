<?php

return[

    'settings'=>[
        'displayErrorDetails' => true,
        'determineRouterBeforeAppMiddleware' => false,
        'template_path' => __DIR__ . '/templates/',

        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'appa_pal_db',
            'username' => 'ahayek',
            'password' => 'ahayek',
            //'username' => 'hostfarb',
            //'password' => '1441001003ASDasd',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],

    ],

];