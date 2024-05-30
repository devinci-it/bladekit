<?php

namespace Devinci\Bladekit\Services;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;


/**
 * Manages the registration of Bladekit commands.
 *
 * This class dynamically registers Bladekit commands based on the provided namespaces.
 * It allows for the registration of base commands and, if dev mode is enabled,
 * additional commands from a dev namespace. The command classes are stored
 * in the `$commandClasses` property and can be retrieved using the
 * `getCommandClasses` method.
 *
 * Quick Reference:
 *   - initializeCommandClasses(): Initializes the command classes based on the provided namespaces.
 *   - getCommandClasses(): Retrieves the registered command classes.
 *   - isDevModeEnabled(): Checks if dev mode is enabled by reading the configuration value.
 */
class BladekitCommandRegistrar
{
    public $commandClasses;
    public $devMode;
    public $devCommandClasses=[];

    /**
     * Initialize the command classes.
     *
     * @return void
     */

    public function __construct($devMode)
    {

        $this->devMode= $devMode;
        $this->initializeCommandClasses();
    }

    public function initializeCommandClasses()
    {
        $baseNamespace = 'Devinci\Bladekit\Console\Commands';
        $devNamespace = 'Devinci\Bladekit\Console\Commands\DevKit';

        $baseCommands = $this::getCommandsFromNamespace($baseNamespace);
        Log::info('Base Commands: ', $baseCommands);
        $this->commandClasses = $baseCommands;

        if ($this->isDevModeEnabled()) {
            $devCommands = $this::getCommandsFromNamespace($devNamespace);
            $this->devCommandClasses= $devCommands;

            Log::info('Dev Commands: ', $devCommands);
            $this->commandClasses = array_merge($this->commandClasses, $devCommands);
        }
    }

    protected static function getCommandsFromNamespace(string $namespace): array
    {
        // Get the base directory for the namespace from the Composer autoloader
        $reflectionClass = new \ReflectionClass(\Devinci\Bladekit\BladekitServiceProvider::class);
        $baseDir = dirname($reflectionClass->getFileName());

        // Remove the base namespace from the namespace argument
        $baseNamespace = 'Devinci\\Bladekit\\';
        $relativeNamespace = str_replace($baseNamespace, '', $namespace);

        $commandsPath = $baseDir . '/' . str_replace('\\', '/', $relativeNamespace);
        $commandClasses = [];

        Log::info('Scanning Path: ' . $commandsPath);

        // Check if the commands directory exists
        if (File::isDirectory($commandsPath)) {
            // Iterate through files in the directory
            $files = File::files($commandsPath);
            Log::info('Files Found: ', $files);
            foreach ($files as $file) {
                $className = $namespace . '\\' . pathinfo($file, PATHINFO_FILENAME);

                // Check if the file is a PHP class
                if (class_exists($className) && is_subclass_of($className, Command::class)) {
                    $commandClasses[] = $className;
                }
            }
        }

        Log::info('Command Classes from Namespace ' . $namespace . ': ', $commandClasses);

        return $commandClasses;
    }
    /**
     * Check if dev mode is enabled.
     *
     * @return bool
     */
    protected function isDevModeEnabled(): bool
    {
        return $this->devMode;
    }

    /**
     * Get the registered command classes.
     *
     * @return array
     */
    public static function getCommandClasses(): array
    {
        if (config('bladekit.dev_mode')) {
            $devNamespace = 'Devinci\Bladekit\Console\Commands\DevKit';
            return BladekitCommandRegistrar::getCommandsFromNamespace($devNamespace);
        }else {
            Log::alert('Dev Mode is not enabled.');
        }
        return [];
        }
    }
