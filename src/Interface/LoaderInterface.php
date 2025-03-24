<?php

declare(strict_types=1);

namespace Nitier\ConfigLoader\Interface;

/**
 * Loader Interface
 */
interface LoaderInterface
{
    /**
     * Check if the loader supports a file extension
     * @param string $extension
     * @return bool
     */
    public static function supports(string $extension): bool;

    /**
     * Convert a file to an array
     * @param string $path
     * @return array<mixed>
     */
    public static function load(string $path): array;
}
