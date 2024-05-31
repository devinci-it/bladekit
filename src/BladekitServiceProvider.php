<?php

namespace Devinci\Bladekit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Devinci\Bladekit\Services\BladekitAssetRegistrar;
use Devinci\Bladekit\Services\BladekitCommandRegistrar;
use Devinci\Bladekit\Services\BladekitDirectiveRegistrar;

class BladekitServiceProvider extends ServiceProvider
{
    protected $commandRegistrar;
    protected $devMode;

    /**
     * Constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->registerConfig();
        $this->devMode = config('bladekit.dev_mode');
        $this->commandRegistrar = new BladekitCommandRegistrar($this->devMode);

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadConfigurationFiles();
    }

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
        $this->registerAssets();
        $this->registerDirectives();
        $this->registerComponents();

        if ($this->app->runningInConsole()) {
            self::compileSass();
        }
    }

    /**
     * Register Bladekit commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->registerBladekitCommands();
    }

    /**
     * Register Bladekit assets.
     *
     * @return void
     */
    protected function registerAssets()
    {
        $assets = BladekitAssetRegistrar::getAssets();
        if (count($assets) > 0) {
            $this->registerPublishableAssets($assets);
        }
    }

    /**
     * Register Bladekit directives.
     *
     * @return void
     */
    protected function registerDirectives()
    {
        BladekitDirectiveRegistrar::register();
    }

    /**
     * Register Livewire and Blade components.
     *
     * @return void
     */
    protected function registerComponents()
    {
        $this->callAfterResolving('livewire.manager', function ($livewire) {
            $livewire->component('bladekit::livewire.search-bar', Livewire\SearchBar::class);
            $livewire->component('bladekit::livewire.search-component', Livewire\SearchComponent::class);
        });

        $this->callAfterResolving('blade.compiler', function ($bladeCompiler) {
            $bladeCompiler->component('bladekit::components.search-bar', 'search-bar');
            $bladeCompiler->component('bladekit::components.search-results', 'search-results');
        });
    }

    /**
     * Register publishable assets.
     *
     * @param array $assets
     * @return void
     */
    protected function registerPublishableAssets($assets)
    {
        foreach ($assets as $tag => $paths) {
            $this->publishes($paths, $tag);
        }
    }

    /**
     * Merge configuration from the config file.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/bladekit.php', 'bladekit'
        );
    }

    /**
     * Register Bladekit commands for console.
     *
     * @return void
     */
    protected function registerBladekitCommands()
    {
        if ($this->app->runningInConsole()) {
            $commandClasses = $this->commandRegistrar->commandClasses;
            $this->commands($commandClasses);
        }
    }

    /**
     * Load configuration files and publish them.
     *
     * @return void
     */
    protected function loadConfigurationFiles()
    {
        $configPath = __DIR__ . '/../config/bladekit.php';

        if (file_exists($configPath)) {
            $this->mergeConfigFrom($configPath, 'bladekit');
        }

        $this->publishes([
            $configPath => config_path('bladekit.php'),
        ], 'bladekit-config');
    }

    /**
     * Compile Sass files using the bladekit:compile-sass command.
     */
    protected static function compileSass()
    {
        Artisan::call('bladekit:compile-sass -vvv');
    }

}

