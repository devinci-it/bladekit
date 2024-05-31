<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Name
    |--------------------------------------------------------------------------
    |
    | Define the name of your package here. This can be useful for various
    | purposes such as logging, debugging, or identifying the package.
    |
    */

    'package_name' => 'Bladekit',

    /*
    |--------------------------------------------------------------------------
    | Directory Paths
    |--------------------------------------------------------------------------
    |
    | Define various directory paths within your package. These paths can be
    | used throughout your application for referencing package resources.
    |
    */

    'package_root' => __DIR__.'/..',
    'resources_path' => __DIR__.'/../resources',
    'views_path' => __DIR__.'/../resources/views',
    'config_path' => __DIR__.'/../config',
    'bladekit_path' => __DIR__.'/../bladekit.yaml',


    /*
    |--------------------------------------------------------------------------
    | Anonymous Component Paths
    |--------------------------------------------------------------------------
    */
    'anonymous_component_paths' => [
        __DIR__ . '/../resources/views/components',

    ],

    /*
    |--------------------------------------------------------------------------
    | Component Namespaces
    |--------------------------------------------------------------------------
    */
    'component_namespaces' => [
        'bladekit' => 'Devinci\\Bladekit\\View\\Components',
        'bladekit-layout' => 'Devinci\\Bladekit\\View\\Layout\\',

    ],

    /*
    |--------------------------------------------------------------------------
    | View Paths
    |--------------------------------------------------------------------------
    */
    'view_paths' => [
            __DIR__ . '/../resources/views',
        ],

    /*
    |--------------------------------------------------------------------------
    | Logger
    |--------------------------------------------------------------------------
    */
    'logger' => [
        'path' => storage_path('logs/bladekit.log'),
        'level' => 'debug',
    ],

    /*
    |--------------------------------------------------------------------------
    | YAML File Path
    |--------------------------------------------------------------------------
    */
    'yaml_file_path' => __DIR__ . '/../bladekit_components.yaml',



    /*
    |--------------------------------------------------------------------------
    | Development Mode
    |--------------------------------------------------------------------------
    |
    | This value determines if the Bladekit is in development mode. This can
    | be set in the .env file using the BLADEKIT_DEV_MODE variable.
    | If not set, it defaults to false.
    |
    */

    'dev_mode' => env('BLADEKIT_DEV_MODE', true),

    /*
    |--------------------------------------------------------------------------
    | Logger
    |--------------------------------------------------------------------------
    |
    | Configuration for the Logger helper.
    |
    */

    'logger' => [
        'path' => storage_path('logs/bladekit.log'),
        'level' => 'debug',
        // Add any additional logger configurations here
    ],

];
