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

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/devinci-it/bladekit'),
        ], 'bladekit-views');

        $this->publishes([
            __DIR__.'/../resources/css' => resource_path('css/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/fonts' => resource_path('fonts/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/icons' => resource_path('icons/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/images' => resource_path('images/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/js' => resource_path('js/vendor/devinci-it/bladekit'),
            __DIR__.'/../resources/scss' => resource_path('scss/vendor/devinci-it/bladekit'),
            // Add more directories as needed
        ], 'bladekit-assets');

        // Registering the blade directive for including styles
        Blade::directive('bladekitStyles', function () {
            // Define array of CSS files
            $cssFiles = [
                'css/reset.css',
                'css/buttons.css',
                'css/margin.css',
                'css/padding.css',
                'css/typography.css',
                'css/app.css',
                'css/styles.css',
                'css/form.css',
                'css/table.css',
                'css/sidebar.css',
                'scss/shadow.css',
                'scss/border.css',
                'scss/layout.css',
                'scss/margin.css',
                'scss/padding.css',
                'scss/bg.css',
            ];

            // Initialize output string
            $output = '';

            // Loop through each CSS file and add link tag
            foreach ($cssFiles as $cssFile) {
                $output .= '<link rel="stylesheet" href="' . asset($cssFile) . '">' . PHP_EOL;
            }

            return $output;
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
