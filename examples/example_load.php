<?php

use Nitier\ConfigLoader\Config;

require_once __DIR__ . '/../vendor/autoload.php';

$result = Config::load([
    __DIR__ . '/configs/default.php',
    __DIR__ . '/configs/override.json',
    __DIR__ . '/configs/.env',
]);

var_export($result);

