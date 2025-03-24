<?php

declare(strict_types=1);

namespace Nitier\ConfigLoader\Loader;

use Nitier\ConfigLoader\Interface\LoaderInterface;

/**
 * Env Loader
 * @copyright Copyright (c) 2025, Nitier
 * @license MIT
 * @link    https://github.com/nitier/config-loader
 */
class EnvLoader implements LoaderInterface
{
    public static function supports(string $extension): bool
    {
        return $extension === 'env';
    }

    public static function load(string $path): array
    {
        if (!file_exists($path)) {
            throw new \RuntimeException(".env file not found: {$path}");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $config = [];

        foreach ($lines as $line) {
            // Skip comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Parse KEY=VALUE
            if (str_contains($line, '=')) {
                [$key, $value] = explode('=', $line, 2);
                $config[trim($key)] = self::parseValue(trim($value));
            }
        }

        return $config;
    }

    private static function parseValue(string $value): mixed
    {
        // Remove quotes
        if (preg_match('/^["\'](.*)["\']$/', $value, $matches)) {
            return $matches[1];
        }

        // Automatically convert to boolean or numeric values
        return match (strtolower($value)) {
            'true' => true,
            'false' => false,
            'null' => null,
            default => is_numeric($value) ?
            (str_contains($value, '.') ?
                (float) $value : (int) $value) : $value
        };
    }
}
