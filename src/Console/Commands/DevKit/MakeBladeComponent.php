<?php

namespace Devinci\Bladekit\Console\Commands\DevKit;

use Illuminate\Console\Command;
use Devinci\Bladekit\Helpers\StringHelper;

class MakeBladeComponent extends Command
{
    protected $signature = 'bladekit:make {name} {--view} {--wiki} {--props=*}';
    protected $description = 'Create a new Blade component with options';

    public function handle()
    {
        $name = $this->argument('name');
        $parts = preg_split("/[.\/\\\\]/", $name);
        $componentName = array_pop($parts);
        $namespace = implode('\\', $parts);
        $fqnamespace = 'Devinci\\Bladekit\\Views\\' . $namespace;

        $this->generateComponent($componentName, $fqnamespace);
        $this->updateBladeKitJson($name);
    }

    protected function generateComponent($name, $namespace)
    {
        $className = StringHelper::studlyCase($name);
        $componentName = $className;

        $this->generateComponentClass($namespace, $componentName);

        if ($this->option('view')) {
            $this->generateViewFile($name, $namespace);
            $this->generateViewDocstring($name, $this->option('props'));
        }

        if ($this->option('wiki')) {
            $this->generateWikiFile($namespace, $componentName);
        }
    }

    protected function generateComponentClass($namespace, $componentName)
    {
        $stub = file_get_contents(__DIR__ . '/../../../../stubs/component.stub');
        $namespaceLowerCase = strtolower($namespace);
        $componentNameLowerCase = strtolower($componentName);
        $stub = str_replace(
            ['{{namespace}}', '{{namespaceLowerCase}}', '{{componentName}}', '{{componentNameLowerCase}}'],
            [$namespace, $namespaceLowerCase, $componentName, $componentNameLowerCase],
            $stub
        );

        $componentPath = app_path(str_replace(['Devinci\\Bladekit', '\\'], ['src', DIRECTORY_SEPARATOR], $namespace) . DIRECTORY_SEPARATOR . $componentName . '.php');
        $directory = dirname($componentPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($componentPath, $stub);
    }

    protected function generateViewFile($name, $namespace)
    {
        $name = strtolower($name);
        $viewDir = resource_path("views/components/" . str_replace('\\', '/', $namespace));
        $viewPath = $viewDir . DIRECTORY_SEPARATOR . "{$name}.blade.php";

        if (!file_exists($viewDir)) {
            mkdir($viewDir, 0777, true);
        }

        if (!file_exists($viewPath)) {
            touch($viewPath);
        }
    }

    protected function generateViewDocstring($name, $props)
    {
        $propsArray = array_combine($props, array_fill(0, count($props), 'Description'));
        $docStringStub = file_get_contents(__DIR__ . '/../../../../stubs/view-docstring.stub');
        $docString = str_replace(['{{name}}', '{{props}}'], [$name, var_export($propsArray, true)], $docStringStub);
        $name = strtolower($name);
        $viewPath = resource_path("views/components/{$name}.blade.php");
        file_put_contents($viewPath, $docString, FILE_APPEND);
    }

    protected function generateWikiFile($namespace, $componentName)
    {
        $name = strtolower(preg_replace('/[^a-z0-9]/', '-', $componentName));
        $namespacePath = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($namespace));
        $wikiDirectory = resource_path('docs') . DIRECTORY_SEPARATOR . $namespacePath;

        if (!file_exists($wikiDirectory)) {
            mkdir($wikiDirectory, 0777, true);
        }

        $wikiPath = $wikiDirectory . DIRECTORY_SEPARATOR . "{$name}.md";

        if (!file_exists($wikiPath)) {
            touch($wikiPath);
            $this->info("Wiki file created: {$wikiPath}");
        } else {
            $this->info("Wiki file already exists: {$wikiPath}");
        }
    }

    protected function updateBladeKitJson($name)
    {
        $configFile = base_path('bladekit.json');

        if (!file_exists($configFile)) {
            $config = [
                'namespaces' => [
                    'bladekit' => [
                        'components' => []
                    ]
                ]
            ];
        } else {
            $config = json_decode(file_get_contents($configFile), true) ?: [];
        }

        if (!isset($config['namespaces']['bladekit']['components'])) {
            $config['namespaces']['bladekit']['components'] = [];
        }

        $config['namespaces']['bladekit']['components'][] = "bladekit:make $name --view --wiki";

        file_put_contents($configFile, json_encode($config, JSON_PRETTY_PRINT));
    }
}
