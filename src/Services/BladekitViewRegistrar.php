<?php
/*src/Services/BladekitViewRegistrar.php*/

namespace Devinci\Bladekit\Services;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Symfony\Component\Yaml\Yaml;


class BladekitViewRegistrar
{
    protected $yamlFilePath;
    protected $config;

    /**
     * Create a new class instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->yamlFilePath = config('bladekit.yaml_file_path');
        $this->config = config('bladekit');
    }

    /**
     * Register all Blade components and write registration details to YAML file.
     *
     * @return void
     */
    public function register()
    {
        $this->registerViews();
        $this->registerAnonymousComponentPaths();
        $this->registerComponentNamespaces();
    }

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerViews()
    {
        $this->validateViewPathsConfig();
        $this->checkForExistingNamespace();
        $this->addViewPaths();
    }

    protected function validateViewPathsConfig()
    {
        if (!isset($this->config['view_paths']) || !is_array($this->config['view_paths'])) {
            throw new \RuntimeException('View paths configuration is missing or invalid.');
        }
    }

    protected function checkForExistingNamespace()
    {
        if (View::exists('bladekit')) {
            throw new \RuntimeException('The bladekit namespace is already registered.');
        }
    }

    protected function addViewPaths()
    {
        foreach ($this->config['view_paths'] as $path) {
            $this->addViewPath($path);
        }
    }

    protected function addViewPath($path)
    {
        if (!is_dir($path)) {
            throw new \RuntimeException("Invalid view path: {$path}");
        }

        View::addNamespace('bladekit', $path);
    }


    /**
     * Register anonymous component paths.
     *
     * @return void
     */
    protected function registerAnonymousComponentPaths()
    {
        $configPaths = $this->config['anonymous_component_paths'] ?? [];

        foreach ($configPaths as $path) {
            Blade::anonymousComponentPath($path, 'bladekit');
        }

        $this->writeToYaml('anonymous_component_paths', $configPaths);
    }

    /**
     * Register component namespaces.
     *
     * @return void
     */
    protected function registerComponentNamespaces()
    {
        $namespaces = $this->config['component_namespaces'] ?? [];

        foreach ($namespaces as $prefix => $namespace) {
            Blade::componentNamespace($namespace, $prefix);
        }

        $this->writeToYaml('component_namespaces', $namespaces);
    }

    /**
     * Write data to YAML file.
     *
     * @param string $key
     * @param array $data
     * @return void
     */
    protected function writeToYaml($key, $data)
    {
        $yamlData = Yaml::dump([$key => $data], 4, 2);

        file_put_contents($this->yamlFilePath, $yamlData, FILE_APPEND);
    }
}
