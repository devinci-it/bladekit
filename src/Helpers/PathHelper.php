<?php

namespace Devinci\Bladekit\Helpers;

use Illuminate\Support\Facades\Storage;

class PathHelper
{
    /**
     * Get the asset URL for an icon based on its name.
     *
     * @param string $iconName The name of the icon.
     * @return string|null The asset URL or null if not found.
     */
    protected static $manifest;

    public static function getIconAssetUrl($icon)
    {
        if (!static::$manifest) {
            static::$manifest = json_decode(file_get_contents(public_path('vendor/bladekit/manifest.json')), true);
        }

        $iconPath = "resources/icons/$icon";

        // Normalize the path for consistent comparison
        $normalizedIconPath = str_replace('\\', '/', $iconPath);

        if (isset(static::$manifest[$normalizedIconPath])) {
            $file = static::$manifest[$normalizedIconPath]['file'];
            return asset("vendor/bladekit/$file");
        }

        return '';
    }
    /**
     * Get the public path of a directory.
     *
     * @param string $directory The directory path relative to the public directory.
     * @return string The absolute public path.
     */
    public static function publicPath($directory = '')
    {
        return public_path($directory);
    }

    /**
     * Get the storage path.
     *
     * @param string $directory The directory path relative to the storage directory.
     * @return string The absolute storage path.
     */
    public static function storagePath($directory = '')
    {
        return storage_path($directory);
    }

    /**
     * Get the asset URL for a file in the public directory.
     *
     * @param string $filePath The path to the file relative to the public directory.
     * @return string The asset URL.
     */
    public static function assetUrl($filePath)
    {
        return asset(str_replace('\\', '/', $filePath));
    }

    /**
     * Check if a file exists in the public directory.
     *
     * @param string $filePath The path to the file relative to the public directory.
     * @return bool True if the file exists, false otherwise.
     */
    public static function fileExists($filePath)
    {
        return file_exists(public_path($filePath));
    }

    /**
     * Get the contents of a file in the public directory.
     *
     * @param string $filePath The path to the file relative to the public directory.
     * @return string|false The file contents or false on failure.
     */
    public static function fileContents($filePath)
    {
        return file_get_contents(public_path($filePath));
    }

    /**
     * Get the contents of a file in the storage directory.
     *
     * @param string $filePath The path to the file relative to the storage directory.
     * @return string|false The file contents or false on failure.
     */
    public static function storageFileContents($filePath)
    {
        return file_get_contents(storage_path($filePath));
    }

    /**
     * Write contents to a file in the storage directory.
     *
     * @param string $filePath The path to the file relative to the storage directory.
     * @param string $contents The contents to write to the file.
     * @return bool True on success, false on failure.
     */
    public static function writeStorageFile($filePath, $contents)
    {
        return file_put_contents(storage_path($filePath), $contents) !== false;
    }

    /**
     * Get the URL for a file in the storage directory.
     *
     * @param string $filePath The path to the file relative to the storage directory.
     * @return string The file URL.
     */
    public static function storageFileUrl($filePath)
    {
        return Storage::url($filePath);
    }
}
