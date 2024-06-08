### Documentation: `bladekit:make-demos` Command

#### Purpose

The `bladekit:make-demos` command automates the generation of demo sections for Blade kit components in Laravel. It creates demo sections for each specified namespace, allowing for organized and easy-to-access demonstrations of components.

#### Usage

```bash
php artisan bladekit:make-demos
```

#### Command Options

This command does not require any additional options.

#### Implementation Details

##### Command File Location

- **Command File**: `app/Console/Commands/DevKit/MakeDemoSections.php`

##### Namespace Mapping

The command uses a mapping array to define namespaces and their corresponding demo folder names:

```php
protected $componentNamespaces = [
    'bladekit' => 'bladekit',
    'bladekit-layouts' => 'layouts',
    'bladekit-partials' => 'partials',
    'bladekit-uicore' => 'uicore',
    'bladekit-widgets' => 'widgets',
    'bladekit-modules' => 'modules',
    'bladekit-page-essentials' => 'page-essentials',
    'bladekit-page' => 'page',
];
```

##### Demo File Generation

For each namespace, the command checks if a demo file exists in the `resources/views/demo` directory. If the file does not exist, it creates an empty file. Then, it generates a demo section in the file:

```php
protected function generateDemoSection($namespace, $demoFilePath)
{
    $sectionName = $this->getSectionName($namespace);
    $sectionContent = $this->getSectionContent($namespace);

    File::append($demoFilePath, $sectionContent);

    $this->info("Demo section for {$namespace} has been added to {$demoFilePath}.");
}

protected function getSectionContent($namespace)
{
    $sectionName = $this->getSectionName($namespace);

    return <<<PHP

<section id="{$namespace}-demo" class="demo-section">
    <h2>{$sectionName} Demos</h2>

    {{-- Include demos for {$sectionName} --}}
    @include('demo.{$namespace}')
</section>

PHP;
}
```

##### Demo Blade Files

Each demo blade file (`resources/views/demo/bladekit.blade.php`, etc.) includes demos for the corresponding namespace:

```blade
@foreach($bladekitComponents as $component)
    <x-bladekit::{{ $component }} />
@endforeach
```

##### Command Registration

The command is registered in `app/Console/Kernel.php`:

```php
protected $commands = [
    \Devinci\Bladekit\Console\Commands\DevKit\MakeDemoSections::class,
];
```

##### Running the Command

To generate demo sections, run:

```bash
php artisan bladekit:make-demos
```

This will create or append demo sections in the demo files for each Blade kit namespace defined.

#### Example Usage

1. **Run the Command:**

```bash
php artisan bladekit:make-demos
```

2. **Output:**

```bash
Demo section for bladekit has been added to resources/views/demo/bladekit.blade.php.
Demo section for bladekit-layouts has been added to resources/views/demo/layouts.blade.php.
...
```

#### Conclusion

The `bladekit:make-demos` command automates the creation of demo sections for Blade kit components. It maintains organization by namespace and simplifies the process of demonstrating newly added components.

