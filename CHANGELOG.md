## [0.2.0] - 2024-05-30

### Added

- Added methods to compile and include compiled CSS files in assets.
- Initial version of BladekitAssetRegistrar with basic asset management functionality.
- Added methods to compile and include compiled CSS files in assets.

# [0.2.1] 05-30-2024
### Fix
- Fixed issue with "compile-saas not found error" by moving the logic into the service provider and enclosing it in an `if` statement to ensure it only runs when in console mode.

## [0.3.0] - 05-30-2024

### Added

- Added `@bladekitStyles` feature.

### Changed

- Updated `BladekitFresh` command file by removing unused imports.

## [0.3.1] 

### Added
- `Services/BladekitViewRegistrar` class to register Bladekit views.


### Changed
- `config/bladekit.php` configuration file.
  - Directory paths for package root, resources, views, config, and bladekit path.
  - Anonymous component paths for Bladekit views.
  - Component namespaces for Bladekit view components.
  - Logger configuration with path and level.
  - YAML file path for Bladekit components.

## [0.3.2]

### Overview
Added BladekitViewRegistrar class to handle the registration of Blade components and views.
Refactored the class to include granular methods for better readability and maintainability.
Updated the class to bootstrap Bladekit views and configurations.
Modified the class to register layouts as view paths instead of component namespaces.
Added usage instructions and example code snippets in the comments for better understanding.

### Features
- Views 
  - Components Devinci\Bladekit\Layout\App , Devinci\Bladekit\Layout\Grid
  - Layouts : 'bladekit::layouts.app' , 'bladekit::layouts.grid'
