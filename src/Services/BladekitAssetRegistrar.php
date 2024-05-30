<?php
namespace Devinci\Bladekit\Services;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\File;

/**
 * Manages the registration and removal of Bladekit assets.
 *
 * This class provides methods to initialize asset paths, prompt for confirmation,
 * and modify directory permissions. It also offers functionality to retrieve asset paths,
 * add new assets, and remove published assets.
 *
 * Quick Reference:
 *   - initializeAssets(): Initializes the Bladekit assets by defining their paths.
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
            ];

        }

    }

    protected static function promptConfirmation(string $message, callable $callback): void
    {
        $confirmation = readline("$message (yes/no): ");
        if (strtolower($confirmation) === 'yes') {
            $callback();
        }
    }

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
        // Remove published assets corresponding to the tag
        $paths = self::$assets[$tag];
        foreach ($paths as $from => $to) {
            app('files')->deleteDirectory($to);
        }
    }
}