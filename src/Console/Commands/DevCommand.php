<?php

namespace Devinci\Bladekit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Devinci\Bladekit\Services\BladekitCommandRegistrar;
use ReflectionClass;
use Symfony\Component\Console\Helper\Table;

class DevCommand extends Command
{
    protected $signature = 'bladekit:dev {subcommand?} {--h|help}';
    protected $description = 'This is a parent command for all dev subcommands.';

    public function handle()
    {
        $subcommand = $this->argument('subcommand');

        if ($this->option('help') || !$subcommand) {
            $this->displayHelp();
            return;
        }

        $subcommandClasses = $this->getSubcommandClasses();

        if ($subcommand === 'list:all') {
            $this->displayHelp();
        } elseif (isset($subcommandClasses[$subcommand])) {
            // Capture all input arguments and options
            $arguments = $this->arguments();
            $options = $this->options();

            // Remove 'subcommand' and 'help' from arguments
            unset($arguments['subcommand'], $arguments['help']);

            // Call the subcommand with the remaining arguments and options
            Artisan::call($subcommandClasses[$subcommand], array_merge($arguments, $options));
        } else {
            $this->error('Invalid subcommand.');
        }
    }

    private function getSubcommandClasses(): array
    {
        $subcommandDetails = [];
        $namespace = 'Devinci\\Bladekit\\Console\\Commands\\DevKit';
        $commandsPath = base_path('vendor/devinci-it/bladekit/src/Console/Commands/DevKit');

        if (File::isDirectory($commandsPath)) {
            foreach (File::files($commandsPath) as $file) {
                $className = pathinfo($file, PATHINFO_FILENAME);
                $fullClassName = $namespace . '\\' . $className;
                if (class_exists($fullClassName) && is_subclass_of($fullClassName, Command::class)) {
                    $formattedName = $this->formatCommandName($className);
                    $subcommandDetails[$formattedName] = $fullClassName;
                }
            }
        }
        return $subcommandDetails;
    }

    private function formatCommandName(string $className): string
    {
        // Replace uppercase letters with '-lowercase'
        $formattedName = strtolower(preg_replace('/([A-Z])/', '-$1', $className));
        // Remove leading dash if present
        $formattedName = ltrim($formattedName, '-');
        // Remove "-command" suffix if present
        if (substr($formattedName, -8) === '-command') {
            $formattedName = substr($formattedName, 0, -8);
        }
        return $formattedName;
    }

    private function displayHelp()
    {
        $this->info($this->description);
        $this->info('Available subcommands:');

        foreach ($this->getSubcommandClasses() as $subcommand => $className) {
            Artisan::call($className, ['--help' => true]);
            $output = Artisan::output();

            // Extract the Description and Usage sections from the output
            $description = $this->extractSection($output, 'Description:');
            $usage = $this->extractSection($output, 'Usage:');

// Display the subcommand and its details in a table
            $table = new Table($this->output);
            $table->setStyle('borderless'); // Set the table style to borderless for a modern look
            $table->setHeaders([
                '<fg=cyan;options=bold>Subcommand</>', // Use cyan and bold for the headers
                '<fg=cyan;options=bold>Details</>'
            ]);
            $table->setRows([
                ['<fg=green>' . $subcommand . '</>', '<fg=white>' . trim($description) . '</>'], // Use green for the subcommand and white for the description
                ['', '<fg=bright-yellow>' . trim(str_replace('bladekit:','',$usage)) . '</>'], // Use yellow for the usage
            ]);
            $table->render();
        }
    }

    private function extractSection(string $output, string $section): string
    {
        $pattern = "/^$section$(.*?)^(?=\w|$)/ms";
        preg_match($pattern, $output, $matches);
        return $matches[1] ?? '';
    }
}
