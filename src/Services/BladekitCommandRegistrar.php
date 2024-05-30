<?php

namespace Devinci\Bladekit\Services;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

/**
 * Manages the registration of Bladekit commands.
 *
 * This class dynamically registers Bladekit commands based on the provided namespaces.
 * It allows for the registration of base commands and, if dev mode is enabled,
 * additional commands from a dev namespace. The command classes are stored
 * in the `$commandClasses` property and can be retrieved using the
 * `getCommandClasses` method.
 */
class BladekitCommandRegistrar
{
    public $commandClasses = [];
    public $devMode;
    public $devCommandClasses = [];

    /**
     * Initialize the command classes.
     *
     * @param bool $devMode
     */
    public function __construct(bool $devMode)
    {
        $this->devMode = $devMode;
        $this->initializeCommandClasses();
    }

    /**
     * Initialize the command classes based on the provided namespaces.
     *
     * @return void
     */
    public function initializeCommandClasses()
    {
        try {
            $baseNamespace = 'Devinci\\Bladekit\\Console\\Commands';
            $devNamespace = 'Devinci\\Bladekit\\Console\\Commands\\DevKit';

            $baseCommands = $this->getCommandsFromNamespace($baseNamespace);
            $this->commandClasses = $baseCommands;
            Log::info('Base Commands: ', $baseCommands);

            if ($this->isDevModeEnabled()) {
                $devCommands = $this->getCommandsFromNamespace($devNamespace);
                $this->devCommandClasses = $devCommands;
                Log::info('Dev Commands: ', $devCommands);
                $this->commandClasses = array_merge($this->commandClasses, $devCommands);
            }
        } catch (\Exception $e) {
            Log::error('Error initializing command classes: ' . $e->getMessage());
        }
    }

    /**
     * Get the command classes from the given namespace.
     *
     * @param string $namespace
     * @return array
     */
    protected function getCommandsFromNamespace(string $namespace): array
    {
        try {
            $reflectionClass = new \ReflectionClass(\Devinci\Bladekit\BladekitServiceProvider::class);
            $baseDir = dirname($reflectionClass->getFileName());
            $relativeNamespace = str_replace('Devinci\\Bladekit\\', '', $namespace);
            $commandsPath = $baseDir . '/' . str_replace('\\', '/', $relativeNamespace);

            if (File::isDirectory($commandsPath)) {
                $files = File::files($commandsPath);
                Log::info('Files Found: ' . count($files));

                $commandClasses = [];

                foreach ($files as $file) {
                    $className = $namespace . '\\' . pathinfo($file, PATHINFO_FILENAME);

                    if (class_exists($className) && is_subclass_of($className, Command::class)) {
                        $commandClasses[] = $className;
                    }
                }

                return $commandClasses;
            }
        } catch (\Exception $e) {
            Log::error('Error getting commands from namespace ' . $namespace . ': ' . $e->getMessage());
        }

        return [];
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
    public function getCommandClasses(): array
    {
        return $this->commandClasses;
    }
}
