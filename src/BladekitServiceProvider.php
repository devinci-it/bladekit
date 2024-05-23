<?php

namespace Devinci\Bladekit;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladekitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bladekit');

        $this->registerComponents();

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/devinci-it/bladekit'),
        ], 'bladekit-views');

        // Publish CSS, fonts, icons, images, JS, and SCSS
        $this->publishes([
            __DIR__.'/../resources/css' => public_path('css/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/fonts' => public_path('fonts/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/icons' => public_path('icons/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/images' => public_path('images/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/js' => public_path('js/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/scss' => resource_path('scss/vendor/devinci-it/bladekit'),
            // Add more directories as needed
        ], 'bladekit-assets');

        // Include compiled JS file
        Blade::directive('bladekitScripts', function () {
            return '<script src="' . asset('js/vendor/devinci-it/bladekit/app.js') . '"></script>';
        });

        // Registering the blade directive for including styles
        Blade::directive('bladekitStyles', function () {
            return '<link rel="stylesheet" href="' . asset('css/vendor/devinci-it/bladekit/index.css') . '">' .
                '<link rel="stylesheet" href="' . asset('css/vendor/devinci-it/bladekit/shadow.css') . '">' .
                '<link rel="stylesheet" href="' . asset('css/vendor/devinci-it/bladekit/border.css') . '">' .
                '<link rel="stylesheet" href="' . asset('css/vendor/devinci-it/bladekit/layout.css') . '">' .
                '<link rel="stylesheet" href="' . asset('css/vendor/devinci-it/bladekit/margin.css') . '">' .
                '<link rel="stylesheet" href="' . asset('css/vendor/devinci-it/bladekit/padding.css') . '">' .
                '<link rel="stylesheet" href="' . asset('css/vendor/devinci-it/bladekit/bg.css') . '">';
        });
    }


    /**
     * Register Livewire and Blade components.
     *
     * @return void
     */
    protected function registerComponents()
    {
        $this->callAfterResolving('livewire.manager', function ($livewire) {
            $livewire->component('bladekit::livewire.search-bar', \Devinci\Bladekit\Livewire\SearchBar::class);
            $livewire->component('bladekit::livewire.search-component', \Devinci\Bladekit\Livewire\SearchComponent::class);
        });

        $this->callAfterResolving('blade.compiler', function ($bladeCompiler) {
            $bladeCompiler->component('bladekit::components.search-bar', 'search-bar');
            $bladeCompiler->component('bladekit::components.search-results', 'search-results');
        });
    }
}
