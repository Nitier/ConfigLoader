# Nitier ConfigLoader  

**A flexible configuration loader for PHP projects** with support for multiple formats and easy extensibility.  

## 📦 Installation  

```bash
composer require nitier/configloader
```

## 🌟 Features  

- Supports multiple formats: `.php`, `.json`, `.env`  
- Deep configuration merging  
- Easy integration of custom loaders  
- Automatic type conversion for `.env` files  
- PSR-4 compatible  

## 🚀 Quick Start  

### Basic Usage  
```php
use Nitier\ConfigLoader\Config;

// Load a single configuration file  
$config = Config::load('/path/to/config.php');

// Load multiple files with overrides  
$config = Config::load([
    '/path/to/base.json',
    '/path/to/override.env'
]);
```

## Example `.env` File  
```ini
APP_DEBUG=true
DB_HOST=localhost
DB_PORT=3306
```

## 🔌 Available Loaders  
| Format | Class        | Supported Extensions |
|--------|------------|----------------------|
| PHP    | `PhpLoader`  | `.php`, `.inc`       |
| JSON   | `JsonLoader` | `.json`              |
| ENV    | `EnvLoader`  | `.env`               |

## 🛠 Extending Functionality  

### Adding a Custom Loader  

1. Create a class implementing `LoaderInterface`:  
```php
namespace App\ConfigLoaders;
use Nitier\ConfigLoader\Interface\LoaderInterface;

class XmlLoader implements LoaderInterface
{
    public static function supports(string $extension): bool
    {
       return $extension === 'xml';
    }

    public static function load(string $path): array
    {
        // Your XML parsing implementation here
    }
}
```
2. Register the loader:  
```php
Config::addLoader(\App\ConfigLoaders\XmlLoader::class);
```

## ⚙️ Configuration  

### Loader Priorities  
Loaders are checked in the order they were registered. The most recently added loaders take priority.  

### Deep Merging  
When loading multiple configuration files, arrays are merged recursively:  
```php
// base.php
['db' => ['host' => 'localhost', 'user'=> 'test']]

// override.php
['db' => ['user'=> 'prod', 'port' => 3306]]

// Result
['db' => ['host' => 'localhost', 'user'=> 'prod', 'port' => 3306]]
```

## 📜 License  
MIT  