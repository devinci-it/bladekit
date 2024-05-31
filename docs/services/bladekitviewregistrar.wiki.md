Certainly! Here's the updated wiki page with a section for key points:

---

# BladekitViewRegistrar Class

## Overview
The `BladekitViewRegistrar` class is responsible for registering Blade components and writing their registration details to a YAML file. It provides methods to register anonymous component paths and component namespaces.

## Constructor
```php
/**
 * Create a new instance of BladekitViewRegistrar.
 *
 * @return void
 */
public function __construct()
```
- Initializes the `$yamlFilePath` property with the path to the YAML file where registration details will be stored.

## Methods

### `register()`
```php
/**
 * Register all Blade components and write registration details to YAML file.
 *
 * @return void
 */
public function register()
```
- Registers anonymous component paths and component namespaces.
- Writes the registration details to a YAML file.

### `registerAnonymousComponentPaths()`
```php
/**
 * Register anonymous component paths.
 *
 * @return void
 */
protected function registerAnonymousComponentPaths()
```
- Retrieves anonymous component paths from the configuration.
- Registers each path using Laravel's `Blade::anonymousComponentPath()` method.
- Writes the registered paths to the YAML file.

### `registerComponentNamespaces()`
```php
/**
 * Register component namespaces.
 *
 * @return void
 */
protected function registerComponentNamespaces()
```
- Retrieves component namespaces from the configuration.
- Registers each namespace using Laravel's `Blade::componentNamespace()` method.
- Writes the registered namespaces to the YAML file.

### `writeToYaml($key, $data)`
```php
/**
 * Write data to YAML file.
 *
 * @param string $key
 * @param array $data
 * @return void
 */
protected function writeToYaml($key, $data)
```
- Parses existing YAML data from the file or initializes an empty array.
- Writes the provided data under the specified key to the YAML file using Symfony's YAML component.

## Key Points

- The `BladekitViewRegistrar` class simplifies the process of registering Blade components in Laravel applications.
- It allows developers to specify anonymous component paths and component namespaces, which are then registered dynamically.
- Registration details are stored in a YAML file for easy management and debugging.

## Quick Reference

| Method                             | Parameters                | Description                                                                                                       |
|------------------------------------|---------------------------|-------------------------------------------------------------------------------------------------------------------|
| `__construct()`                    | None                      | Initializes the `$yamlFilePath` property with the path to the YAML file where registration details will be stored. |
| `register()`                       | None                      | Registers all Blade components and writes registration details to the YAML file.                                   |
| `registerAnonymousComponentPaths()` | None                      | Registers anonymous component paths and writes them to the YAML file.                                              |
| `registerComponentNamespaces()`    | None                      | Registers component namespaces and writes them to the YAML file.                                                    |
| `writeToYaml($key, $data)`         | `$key` (string), `$data` (array) | Writes data to the YAML file under the specified key.                                                              |

## Example Usage

```php
use Devinci\Bladekit\Services\BladekitViewRegistrar;

$registrar = new BladekitViewRegistrar();
$registrar->register();
```

---

