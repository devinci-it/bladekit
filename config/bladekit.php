<?php

/**
 * Bladekit Configuration File
 *
 * This file is used to configure the Bladekit package. The settings defined
 * here can be accessed using the config() helper function in Laravel.
 */

return [

     /*
     |--------------------------------------------------------------------------
     | Directory Paths
     |--------------------------------------------------------------------------
     */

    'package_root' => __DIR__ . '/..',
    'resources_path' => __DIR__ . '/../resources',
    'views_path' => __DIR__ . '/../resources/views',
    'config_path' => __DIR__ . '/../config',
    'bladekit'=> __DIR__ . '/../bladekit.yaml',

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


    ];