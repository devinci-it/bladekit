# BladekitAssetRegistrar Class

---

## Overview

The `BladekitAssetRegistrar` class manages the registration and removal of Bladekit assets. It provides methods to initialize asset paths, prompt for confirmation, and modify directory permissions. Additionally, it offers functionality to retrieve asset paths, add new assets, and remove published assets.

## Outline/Overview

| Section                   | Description                                                                                   |
|---------------------------|-----------------------------------------------------------------------------------------------|
| Overview                  | Brief introduction to the purpose and functionality of the `BladekitAssetRegistrar` class.   |
| Methods                   | Detailed description of each method provided by the class.                                    |
| Example Usage             | Examples demonstrating how to use the class methods in practice.                              |
| See Also                  | Links to related classes or commands, if applicable.                                          |

## Quick Reference

- `initializeAssets()`: Initializes the Bladekit assets by defining their paths.
- `promptConfirmation(string $message, callable $callback)`: Prompts the user for confirmation with a given message and executes the provided callback function if the user responds with "yes".
- `modifyDirectoryPermissions(string $directory, int $permissions)`: Modifies the permissions of the specified directory to the provided permissions.
- `getAssets(): array`: Retrieves the paths of the Bladekit assets.
- `addAsset(string $tag, array $paths)`: Adds a new asset path to the Bladekit assets.
- `removeAsset(string $tag)`: Removes published assets associated with the specified tag.

## Example Usage

```php
use Devinci\Bladekit\Services\BladekitAssetRegistrar;

// Retrieve asset paths
$assets = BladekitAssetRegistrar::getAssets();

// Add a new asset
BladekitAssetRegistrar::addAsset('new-assets', ['/path/to/new/asset']);

// Remove published assets
BladekitAssetRegistrar::removeAsset('bladekit-assets');
```
## See Also

- [BladekitFresh (Command)](../commands/bladekitfresh.wiki.md)
