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
## Added


## Modified
resources/views/layouts/flex.blade.php, src/View/Layouts/Flex.php, 

## Removed


## Added
resources/views/components/button.blade.php, resources/views/components/stack/anchor-row.blade.php, resources/views/components/stack/toggle-switch.blade.php, resources/views/widgets/page-header.blade.php, src/Console/Commands/DevKit/ListComponents.php, src/View/Components/Button.php, src/View/Components/Stack/AnchorRow.php, src/View/Layouts/Interstitial.php, src/View/Widgets/PageHeader.php, 

## Modified
resources/css/app.css, resources/css/form.css, resources/views/layouts/app.blade.php, resources/views/layouts/grid.blade.php, resources/views/layouts/interstitial.blade.php, resources/views/welcome.blade.php, src/View/Layouts/App.php, src/View/Layouts/Flex.php, 

## Removed
resources/views/components/widgets/toggle-switch.blade.php, 

## Added


## Modified


## Removed


## Added
resources/views/Modal.blade.php, resources/views/layouts/Wide.blade.php, resources/views/widgets/Modal.blade.php, src/Apprentice/ComponentHandler.php, src/Console/Commands/DevKit/RegisterView.php, stubs/blade.stub, 

## Modified
apprentice, config/bladekit.php, docs/index.md, icon.svg, post-install.php, resources/views/components/app.blade.php, src/Console/Commands/DevKit/ListComponents.php, src/Console/Console.php, src/DirectiveRegistry.php, src/Services/BladekitViewRegistrar.php, stubs/component.stub, 

## Removed


## Added


## Modified


## Removed


## Added


## Modified
.gitignore, 

## Removed


## Added


## Modified


## Removed


