<?php

return [
    'app_name' => 'Example App',
    'debug' => true,
    'environment' => 'development',
    'timezone' => 'UTC',
    'database' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'database' => 'example_db',
        'username' => 'root',
        'password' => 'secret',
    ],
    'cache' => [
        'driver' => 'redis',
        'host' => '127.0.0.1',
        'port' => 6379,
        'prefix' => 'example_',
    ],
    'mail' => [
        'driver' => 'smtp',
        'host' => 'smtp.mailtrap.io',
        'port' => 2525,
        'username' => null,
        'password' => null,
        'encryption' => 'tls',
    ],
    'api' => [
        'version' => 'v1',
        'prefix' => 'api',
        'throttle' => 60,
    ],
];
