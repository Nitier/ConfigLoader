<?php

use Nitier\ConfigLoader\Config;
use Symfony\Component\Yaml\Yaml;

require_once __DIR__ . '/../vendor/autoload.php';

class CustomLoader implements Nitier\ConfigLoader\Interface\LoaderInterface {
    public static function supports(string $extension): bool {
        return in_array($extension, ['yaml', 'yml']);
    }
    public static function load(string $path): array {
        return Yaml::parseFile($path);

    }
}

Config::addLoader(CustomLoader::class);
$result = Config::load([
    __DIR__ . '/configs/default.yaml',
    __DIR__ . '/configs/override.json',
    __DIR__ . '/configs/.env',
]);
var_export($result);