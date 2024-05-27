<?php

namespace Devinci\Bladekit;

use Illuminate\Support\Facades\Blade;

class DirectiveRegistry
{
    /**
     * Register all Bladekit directives.
     *
     * @return void
     */
    public static function registerAllDirectives()
    {
        self::registerBladekitAssetsDirective();
        self::registerBladekitStylesDirective();
        self::registerBladekitScriptsDirective();
        self::registerBladekitSvgDirective();
        // Add more directive registration calls as needed
    }

    protected static function registerBladekitAssetsDirective()
    {
        Blade::directive('bladekitAssets', function () {
            // Get the base URL for the package's CSS directory
            $baseUrl = (__DIR__.'/../resources/css/');

            // Generate the link tag for each CSS file
            $links = '';

            foreach (glob(public_path('vendor/devinci-it/bladekit/resources/css/*.css')) as $cssFile) {
                $fileName = basename($cssFile);
                $links .= '<link rel="stylesheet" href="' . $baseUrl . $fileName . '">' . PHP_EOL;
            }

            return $links;
        });
    }


    /**
     * Register the directive for including CSS files.
     *
     * @return void
     */
    protected static function registerBladekitStylesDirective()
    {
        Blade::directive('bladekitStyles', function () {
            $cssFiles = glob(resource_path('/css/*.css'));

            // If CSS files are not published, use the local resources path
            if (empty($cssFiles)) {
                $cssFiles = glob(__DIR__ . '/../resources/css/*.css');
            }

            $links = '';

            foreach ($cssFiles as $cssFile) {
                $links .= '<link rel="stylesheet" href="' . asset('vendor/devinci-it/bladekit/resources/css/' . basename($cssFile)) . '">' . PHP_EOL;
            }

            return $links;
        });
    }

    /**
     * Register the directive for including JS files.
     *
     * @return void
     */
    protected static function registerBladekitScriptsDirective()
    {
        Blade::directive('bladekitScripts', function () {
            $jsFiles = glob(public_path('vendor/devinci-it/bladekit/resources/js/*.js'));
            $scripts = '';

            foreach ($jsFiles as $jsFile) {
                $scripts .= '<script src="' . asset('vendor/devinci-it/bladekit/resources/js/' . basename($jsFile)) . '"></script>' . PHP_EOL;
            }

            return $scripts;
        });
    }

    /**
     * Register the directive for including SVG icons.
     *
     * @return void
     */
    protected static function registerBladekitSvgDirective()
    {
        Blade::directive('bladekitSvg', function ($expression) {
            return '<svg><use xlink:href="' . asset('vendor/devinci-it/bladekit/resources/icons/' . $expression . '.svg') . '"></use></svg>';
        });
    }
}
