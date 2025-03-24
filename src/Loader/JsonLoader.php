<?php

declare(strict_types=1);

namespace Nitier\ConfigLoader\Loader;

use Nitier\ConfigLoader\Interface\LoaderInterface;

/**
 * Json Loader
 * @copyright Copyright (c) 2025, Nitier
 * @license MIT
 * @link    https://github.com/nitier/config-loader
 */
class JsonLoader implements LoaderInterface
{
    public static function supports(string $extension): bool
    {
        return $extension === 'json';
    }

    public static function load(string $path): array
    {
        return json_decode(file_get_contents($path), true);
    }
}
