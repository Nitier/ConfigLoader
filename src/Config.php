<?php

declare(strict_types=1);

namespace Nitier\ConfigLoader;

use Nitier\ConfigLoader\Loader;
use Nitier\ConfigLoader\Interface\LoaderInterface;

/**
 * Config Loader
 * @copyright Copyright (c) 2025, Nitier
 * @license MIT
 * @link    https://github.com/nitier/config-loader
 */
class Config
{
    /**
     * List of loaders
     * @var array<LoaderInterface>
     */
    private static array $loaders = [
        Loader\JsonLoader::class,
        Loader\PhpLoader::class,
        Loader\EnvLoader::class,
    ];

    /**
     * Load config from file(s)
     * @param string|array<string> $paths Path to config file(s)
     */
    public static function load(string|array $paths): array
    {
        $result = [];

        foreach ((array) $paths as $path) {
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $loaded = self::loadSingle($path, $extension);
            $result = self::mergeDeep($result, $loaded);
        }

        return $result;
    }

    /**
     * Add a loader
     * @param string $loaderClass Loader class
     */
    public static function addLoader(string $loaderClass): void
    {
        if (
            !class_exists($loaderClass) ||
            !is_subclass_of($loaderClass, LoaderInterface::class)
        ) {
            throw new \InvalidArgumentException("Loader must be a valid class implementing LoaderInterface");
        }
        // Add loader to the beginning of the list
        array_unshift(self::$loaders, $loaderClass);
    }

    /**
     * Load a single config file
     * @param string $path
     * @param string $extension
     * @throws \RuntimeException
     * @return array<mixed>
     */
    private static function loadSingle(string $path, string $extension): array
    {
        foreach (self::$loaders as $loader) {
            if ($loader::supports($extension)) {
                return $loader::load($path);
            }
        }

        throw new \RuntimeException("Unsupported config format: .{$extension}");
    }

    /**
     * Recursive merge of two arrays
     * @param array $base
     * @param array $override
     * @return array<mixed>
     */
    private static function mergeDeep(array $base, array $override): array
    {
        foreach ($override as $key => $value) {
            if (
                array_key_exists($key, $base) &&
                is_array($base[$key]) &&
                is_array($value)
            ) {
                $base[$key] = self::mergeDeep($base[$key], $value);
            } else {
                $base[$key] = $value;
            }
        }

        return $base;
    }
}