<?php
namespace Devinci\Bladekit\Registrars;

use Illuminate\Support\Facades\Artisan;
use Devinci\Bladekit\Console\Commands\CompileSass;
use Illuminate\Support\Facades\File;

/**
 * Manages the registration and removal of Bladekit assets.
 *
 * This class provides methods to initialize asset paths, prompt for confirmation,
 * and modify directory permissions. It also offers functionality to retrieve asset paths,
 * add new assets, and remove published assets.
 *
 * Quick Reference:
 *   - initializeAssets(): Initializes the Bladekit assets by defining their paths and compiling Sass.
 *   - promptConfirmation(string $message, callable $callback): Prompts the user for confirmation
 *     with a given message and executes the provided callback function if the user responds with "yes".
 *   - modifyDirectoryPermissions(string $directory, int $permissions): Modifies the permissions
 *     of the specified directory to the provided permissions.
 *   - getAssets(): Retrieves the paths of the Bladekit assets.
 *   - addAsset(string $tag, array $paths): Adds a new asset path to the Bladekit assets.
 *   - removeAsset(string $tag): Removes published assets associated with the specified tag.
 */

class BladekitAssetRegistrar
{
    protected static $assets = [];

    /**
     * Initialize Bladekit assets and compile Sass.
     */
    protected static function initializeAssets()
    {
        if (empty(self::$assets)) {
            self::$assets = [
                'bladekit-views' => [
                    __DIR__ . '/../../resources/views' => resource_path('views/vendor/devinci-it/bladekit'),
                ],
                'bladekit-assets' => [
                    __DIR__ . '/../../resources/css' => public_path('assets/vendor/bladekit/css'),
                    __DIR__ . '/../../resources/fonts' => public_path('assets/vendor/bladekit/fonts'),
                    __DIR__ . '/../../resources/icons' => public_path('assets/vendor/bladekit/icons'),
                    __DIR__ . '/../../resources/images' => public_path('assets/vendor/bladekit/images'),
                    __DIR__ . '/../../resources/js' => public_path('assets/vendor/bladekit/js'),
                ],
                'bladekit-config' => [
                    __DIR__ . '/../../config/bladekit.php' => config_path('bladekit.php'),
                ],
                'bladekit-public'=>[
                    __DIR__.'/../../dist'=>public_path('vendor/bladekit')
                ]
            ];
        }

        self::appendGeneratedCssFiles();
    }



    /**
     * Append generated CSS files to the 'bladekit-assets'.
     */
    protected static function appendGeneratedCssFiles()
    {
        $cssFiles = self::getGeneratedCssFiles();

        foreach ($cssFiles as $cssFile) {
            $destinationPath = public_path('assets/vendor/bladekit/css/' . basename($cssFile));
            self::$assets['bladekit-assets'][$cssFile] = $destinationPath;
        }
    }

    /**
     * Get the paths of the generated CSS files.
     *
     * @return array
     */
    public static function getGeneratedCssFiles(): array
    {
        $cssDirectory = __DIR__ . '/../../build/scss';
        $cssFiles = glob($cssDirectory . '/*.css');
        return $cssFiles;
    }

    /**
     * Prompt for user confirmation.
     *
     * @param string $message
     * @param callable $callback
     */
    protected static function promptConfirmation(string $message, callable $callback): void
    {
        $confirmation = readline("$message (yes/no): ");
        if (strtolower($confirmation) === 'yes') {
            $callback();
        }
    }

    /**
     * Modify directory permissions.
     *
     * @param string $directory
     * @param int $permissions
     */
    protected static function modifyDirectoryPermissions(string $directory, int $permissions): void
    {
        if (!File::isDirectory($directory)) {
            throw new \RuntimeException("Directory does not exist: " . $directory);
        }

        if (!chmod($directory, $permissions)) {
            throw new \RuntimeException("Failed to modify permissions for directory: " . $directory);
        }
    }

    /**
     * Get the paths of the assets to be published.
     *
     * @return array
     */
    public static function getAssets(): array
    {
        self::initializeAssets();
        return self::$assets;
    }

    /**
     * Add an asset path to be published.
     *
     * @param string $tag
     * @param array $paths
     */
    public static function addAsset(string $tag, array $paths)
    {
        self::initializeAssets();
        self::$assets[$tag] = $paths;
    }

    /**
     * Remove published assets.
     *
     * @param string $tag
     */
    public static function removeAsset(string $tag)
    {
        $paths = self::$assets[$tag] ?? [];

        foreach ($paths as $from => $to) {
            app('files')->deleteDirectory($to);
        }

        unset(self::$assets[$tag]);
    }
}

