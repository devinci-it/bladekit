<?php

namespace Devinci\Bladekit;


use Devinci\Bladekit\Services\BladekitAssetRegistrar;
use Devinci\Bladekit\Services\BladekitCommandRegistrar;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Devinci\Bladekit\DirectiveRegistry;
use Devinci\Bladekit\Console\Commands\BladekitFresh;


use Illuminate\Support\Facades\ExceptionHandler;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
class BladekitServiceProvider extends ServiceProvider
{

    protected $commandRegistrar;
    protected $devMode;




    public function __construct($app)
    {

        parent::__construct($app);
        $this->registerConfig();

        $this->devMode = config('bladekit.dev_mode');

        $this->commandRegistrar = new BladekitCommandRegistrar($this->devMode);
    }

    public function register()
    {
        $this->loadConfigurationFiles($this->app);
    }
    /**
     * Bootstrap any package services.
     *
     * @return void
     */

    public function boot()
    {


        /*
        |--------------------------------------------------------------------------
        | Command Registration
        |--------------------------------------------------------------------------
        |
        */


        $this->commandRegistrar->initializeCommandClasses();

        if ($this->app->runningInConsole()) {
            $this->registerBladekitCommands();
        }

        /*
        |--------------------------------------------------------------------------
        | Asset Registration
        |--------------------------------------------------------------------------
        |
        */
        $assets = BladekitAssetRegistrar::getAssets();
        foreach ($assets as $tag => $paths) {
            $this->publishes($paths, $tag);
        }


    /*
      |--------------------------------------------------------------------------
      | Publish Opt Files
      |--------------------------------------------------------------------------
      |
     */




        DirectiveRegistry::registerAllDirectives();



    }

    protected function registerConfig():void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/bladekit.php', 'bladekit'
        );
    }

    protected function registerBladekitCommands():void
    {
        if ($this->app->runningInConsole()) {
            $commandClasses = $this->commandRegistrar->commandClasses;
            $this->commands($commandClasses);
        }
    }


    protected function loadConfigurationFiles($app)
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
     * Register Livewire and Blade components.
     *
     * @return void
     */
    protected function registerComponents() :void
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





}
