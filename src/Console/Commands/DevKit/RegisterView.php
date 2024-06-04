<?php

namespace Devinci\Bladekit\Console\Commands\DevKit;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class RegisterView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bladekit:register-view {name} {--namespace=} {--add-namespace}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically register a new Views Component';

    public function handle()
    {
        $componentName = $this->argument('name');
        $namespace = $this->option('namespace');

        // If namespace is not provided, prompt the user
        if (!$namespace) {
            $namespace = $this->ask('Enter the component namespace (e.g., BladeLayout\\Views\\Components\\):');
        }

        // Validate namespace format
        if (!preg_match('/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff\\\\]*$/', $namespace)) {
            $this->error('Invalid namespace format.');
            return;
        }

        // Prompt for new namespace if it doesn't end with \
        while (substr($namespace, -1) !== '\\') {
            $namespace = $this->ask('Namespace must end with \\, please re-enter the component namespace:');
        }

        $registrarPath = app_path('BladekitViewRegistrar.php');

        // Check if the registrar file exists
        if (!File::exists($registrarPath)) {
            $this->error('BladekitViewRegistrar.php does not exist.');
            return;
        }

        // Append registration code to the registrar file
        $registrationCode = "\nBlade::component('{$namespace}{$componentName}', {$namespace}\\{$componentName}::class);\n";
        File::append($registrarPath, $registrationCode);

        $this->info("Views Component {$componentName} has been registered under namespace {$namespace}.");

        // Add new namespace if --add-namespace option is provided
        if ($this->option('add-namespace')) {
            $this->addNamespace($namespace);
            $this->info("Namespace {$namespace} has been added.");
        }
    }

    private function addNamespace($namespace)
    {
        // Determine the directory path for the namespace
        $directory = str_replace('\\', '/', $namespace);
        $directory = strtolower($directory); // Convert to lowercase for consistency

        // Create the directory if it doesn't exist
        $path = base_path("resources/views/{$directory}");
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Create the blade component view if it doesn't exist
        $bladeViewPath = $path . "/{$componentName}.blade.php";
        if (!File::exists($bladeViewPath)) {
            File::put($bladeViewPath, "<!-- Blade component view for {$componentName} -->");
            $this->info("Blade component view for {$componentName} created at {$bladeViewPath}");
        }

        // Create the component PHP class if it doesn't exist
        $componentClassPath = app_path("Views/Components/{$directory}/{$componentName}.php");
        if (!File::exists($componentClassPath)) {
            $componentStub = File::get(__DIR__ . '/stubs/component.stub');
            $componentStub = str_replace('{{namespace}}', $namespace, $componentStub);
            $componentStub = str_replace('{{componentName}}', $componentName, $componentStub);
            File::put($componentClassPath, $componentStub);
            $this->info("Component class for {$componentName} created at {$componentClassPath}");
        }

        // Create the blade component view if it doesn't exist
        $bladeViewPath = $path . "/{$componentName}.blade.php";
        if (!File::exists($bladeViewPath)) {
            $bladeStub = File::get(__DIR__ . '/stubs/blade.stub');
            $bladeStub = str_replace('{{componentName}}', $componentName, $bladeStub);
            File::put($bladeViewPath, $bladeStub);
            $this->info("Blade component view for {$componentName} created at {$bladeViewPath}");
        }


        // Add the namespace
        View::addNamespace($directory, $path);
    }
}

