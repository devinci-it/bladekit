<?php

namespace Devinci\Bladekit;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;


class DirectiveRegistry
{
    /**
     * Register all Bladekit directives.
     *
     * @return void
     */
    public static function registerAllDirectives()
    {
        self::registerBladekitStylesDirective();
        self::registerBladekitScriptsDirective();
        self::registerBladekitAssetDirective();
    }

    /**
     * Register the directive for including JS files.
     *
     * @return string The generated script tag.
     */
    protected static function registerBladekitScriptsDirective()
    {
        Blade::directive('bladekitScripts', function () {
            return '<script src="' . asset(static::getJsPath()) . '"></script>' . PHP_EOL;
        });
    }

    /**
     * Get the path for Bladekit JavaScript file.
     *
     * @return string The JavaScript file path.
     */
    protected static function getJsPath()
    {
        $publishedJsPath = public_path('js/vendor/devinci-it/bladekit/bladekit.js');
        return $publishedJsPath;
//        return file_exists($publishedJsPath) ? asset('js/vendor/devinci-it/bladekit/bladekit.js') : asset('js/vendor/devinci-it/bladekit/bladekit.js');
    }


    /**
     * Register the directive for including CSS files.
     *
     * @return string The generated link tags for CSS files.
     */
    protected static function registerBladekitStylesDirective()
    {
        Blade::directive('bladekitStyles', function () {
            $cssFiles = static::getCssFiles();

            return implode(PHP_EOL, array_map(function ($file) {
                return '<link rel="stylesheet" href="' . asset($file) . '">';
            }, $cssFiles));
        });
    }

    /**
     * Get Bladekit CSS files.
     *
     * @return array CSS files paths.
     */
    protected static function getCssFiles()
    {
        $publishedCssPath = public_path('vendor/devinci-it/bladekit/css/');

        if (file_exists($publishedCssPath)) {
            $cssFiles = glob($publishedCssPath . '*.css');
            return array_map('asset', $cssFiles);
        }

        $cssFiles = glob(__DIR__ . '/../resources/css/*.css');
        return array_map('asset', $cssFiles);
    }



    protected static function registerBladekitAssetDirective()
    {
        Blade::directive('bladekitAsset', function ($expression) {
            try {
                // Extract parameters from the expression
                preg_match('/(\'|")([^\'"]+)(\'|")/', $expression, $matches);
                $assetName = trim($matches[2]); // Assuming the expression only contains the asset name

                // Construct the full asset path within the published directory
                $publishedPath = "js/vendor/devinci-it/bladekit/js/$assetName";

                // Check if the published asset exists
                if (file_exists(public_path($publishedPath))) {
                    return asset($publishedPath); // Return the asset URL using the asset() helper function
                }

                // If the published asset does not exist, log a warning
                Log::warning("Published asset '$publishedPath' not found.");

                // Optionally, you can handle the missing asset further or return a fallback value
                return '';
            } catch (\Exception $e) {
                // Log the exception
                Log::error($e->getMessage());

                // Optionally, you can handle the exception further or return a fallback value
                return '';
            }
        });
    }


}
