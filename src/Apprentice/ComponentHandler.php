<?php

namespace Devinci\Bladekit\Apprentice;


class ComponentHandler
{
    private $cliHelper;
    private $filesystem;

    public function __construct(CLIHelper $cliHelper)
    {
        $this->cliHelper = $cliHelper;
        $this->filesystem = new Filesystem();
    }

    public function registerViewComponent()
    {
        while (true) {
            $classNameSpace = $this->getNamespace();
            if ($classNameSpace === '🔙 Back to menu') {
                return;
            }

            $this->cliHelper->displayBorder('Registering a new view component');
            $this->cliHelper->displayMessage('This command will guide you through the process of registering a new view component.');

            $componentName = $this->cliHelper->ask('Enter the name of the view component:');
            $fqnamespace = "Devinci\\Bladekit\\Views\\" . $classNameSpace . "\\" . $componentName;

            $basePath = 'src';
            $mappedNamespace = 'Devinci\\Bladekit\\Views\\' . $classNameSpace;
            $srcPath = $this->convertToPath($mappedNamespace);
            $this->makeDirectory($srcPath);
            $this->createViewComponent($componentName, $mappedNamespace, $srcPath);
        }
    }

    private function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $this->cliHelper->displayMessage("Directory created successfully: " . $path);
    }

    private function convertToPath($namespace)
    {
        $namespace = str_replace("Devinci\\Bladekit\\", "src/", $namespace);
        return str_replace('\\', '/', $namespace);
    }

    private function getNamespace()
    {
        $finder = new Finder();
        $finder->directories()->in('src/Views')->depth('== 0');

        $directories = [];
        foreach ($finder as $dir) {
            $directories[] = $dir->getRelativePathname();
        }

        $directories[] = 'Create a new namespace';
        $directories[] = '🔙 Back to menu';

        $prompt = 'Select the namespace for the view component or enter a new one [Devinci\Bladekit\View\]:';
        $selected = 0;

        while (true) {
            echo "\033[H\033[J"; // Clear screen

            // Display prompt and choices
            $this->cliHelper->displayMessage( "\n\033[1m$prompt\033[0m\n",'info');

            foreach ($directories as $index => $choice) {
                if ($index === $selected) {
                    echo "\033[32m  |$choice\033[0m\n"; // Green for selected item
                } else {
                    echo "  $choice\n";
                }
            }

            // Read user input
            system('stty cbreak -echo');
            $char = ord(fgetc(STDIN));
            system('stty -cbreak echo');

            if ($char === 27) { // ANSI escape sequence
                $char = ord(fgetc(STDIN));
                if ($char === 91) { // Arrow keys
                    $char = ord(fgetc(STDIN));
                    if ($char === 65) { // Up arrow
                        $selected = ($selected > 0) ? $selected - 1 : count($directories) - 1;
                    } elseif ($char === 66) { // Down arrow
                        $selected = ($selected < count($directories) - 1) ? $selected + 1 : 0;
                    }
                }
            } elseif ($char === 10) { // Enter key
                break;
            }
        }

        $selectedChoice = $directories[$selected];

        if ($selectedChoice === 'Create a new namespace') {
            $namespace = $this->cliHelper->ask('Enter the new namespace:');
        } else {
            $namespace = $selectedChoice;
        }

        return $namespace;
    }

    private function createViewComponent($componentName, $namespace, $srcPath)
    {
        $directory = str_replace('\\', '/', $namespace);
        $directory = str_replace("devinci/bladekit/view/", '', strtolower($directory));

        $lastSlashPos = strrpos(strtolower($directory), '/');
        $nesting = substr($directory, 0, $lastSlashPos);
        $path = ("resources/views/{$nesting}");
        if (!$this->filesystem->isDirectory($path)) {
            $this->filesystem->makeDirectory($path, 0755, true);
        }

        $bladeViewPath = $path . "/{$componentName}.blade.php";
        if (!file_exists($bladeViewPath)) {
            $bladeStub = $this->filesystem->get(__DIR__ . '/stubs/blade.stub');
            $bladeStub = str_replace('{{componentName}}', $componentName, $bladeStub);
            $this->filesystem->put($bladeViewPath, $bladeStub);
        }

        $componentClassPath = $srcPath . "/" . ucwords($componentName) . ".php";
        $componentStub = $this->filesystem->get(__DIR__ . '/stubs/component.stub');
        $componentStub = str_replace('{{namespace}}', $namespace, $componentStub);
        $componentStub = str_replace('{{componentName}}', $componentName, $componentStub);
        $this->filesystem->put($componentClassPath, $componentStub);
    }
}
