<?php

return [
    'routingMap' => include '_routing.php',
    'configDb' => [
        'driver' => 'mysql:host=localhost;dbname=scotchbox;',
        'user' => 'root',
        'password' => 'root',
    ],
    'secure' => [
        'controller' => ['admin']
    ],
//    'components' => [
//        'request' => [
//            'class' => Request::class,
//        ]
//    ],
];