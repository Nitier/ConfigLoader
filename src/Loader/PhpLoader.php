<?php

declare(strict_types=1);

namespace Nitier\ConfigLoader\Loader;

use Nitier\ConfigLoader\Interface\LoaderInterface;

/**
 * Php Loader
 * @copyright Copyright (c) 2025, Nitier
 * @license MIT
 * @link    https://github.com/nitier/configloader
 */
class PhpLoader implements LoaderInterface
{
    public static function supports(string $extension): bool
    {
        return in_array($extension, ['php', 'inc']);
    }

    public static function load(string $path): array
    {
        return require $path;
    }
}