# BladekitFresh Command

## Overview

The `BladekitFresh` command removes published Bladekit assets from the public directory. It provides an option to remove assets by tag, allowing selective removal. After successful removal, it provides instructions to republish the assets.

## Usage

```bash
php artisan bladekit:fresh {tag?}
```

- `{tag?}`: Optional argument specifying the tag of assets to remove. If provided, only assets with the specified tag will be removed. If not provided, all assets will be removed.

## Examples

1. Remove all published Bladekit assets:
   ```bash
   php artisan bladekit:fresh
   ```

2. Remove assets with the tag 'fonts':
   ```bash
   php artisan bladekit:fresh fonts
   ```

## Notes

- After removing assets, users are provided with instructions on how to republish the assets using the `php artisan vendor:publish` command.

## See Also

- [BladekitServiceProvider](/docs/commands/bladekitfresh.wiki.md)
- [BladekitAssetRegistrar](/docs/commands/bladekitfresh.wiki.md)

