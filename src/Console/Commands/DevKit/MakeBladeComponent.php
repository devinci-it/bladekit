<?php

namespace Devinci\Bladekit\Console\Commands\DevKit;

use Devinci\Bladekit\Console\Console;
use Illuminate\Console\Command;
use Devinci\Bladekit\Helpers\StringHelper;
class MakeBladeComponent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bladekit:make {name} {--view} {--wiki} {--props=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Blade component with options';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $withView = $this->option('view');
        $withWiki = $this->option('wiki');
        $props = $this->option('props');

        $this->generateComponent($name,$withView,$withWiki,$props);
    }

    protected function generateComponent($name, $withView, $withWiki, $props)
    {
        // Generate component class
        $className = StringHelper::studlyCase($name);
        $this->generateComponentClass($className);

        // Generate view file if --view option is provided
        if ($withView) {
            $this->generateViewFile($name);
            $this->generateViewDocstring($name, $props);
        }

        // Generate wiki file if --wiki option is provided
        if ($withWiki) {
            $this->generateWikiFile($name);
        }


    }

    protected function generateComponentClass($className)
    {
        $stub = file_get_contents(__DIR__.'/../../../../stubs/component.stub');
        $stub = str_replace('{{className}}', $className, $stub);

        $componentPath = app_path("View/Components/{$className}.php");
        file_put_contents($componentPath, $stub);
    }

    protected function generateViewFile($name)
    {
        $viewPath = resource_path("views/components/{$name}.blade.php");
        touch($viewPath);
    }

    protected function generateViewDocstring($name, $props)
    {
        $propsArray = [];
        foreach ($props as $prop) {
            $propsArray[$prop] = 'Description of '.$prop;
        }

        $docStringStub = file_get_contents(__DIR__.'/stubs/view-docstring.stub');
        $docString = str_replace(['{{name}}', '{{props}}'], [$name, var_export($propsArray, true)], $docStringStub);

        $viewPath = resource_path("views/components/{$name}.blade.php");
        file_put_contents($viewPath, $docString, FILE_APPEND);
    }

    protected function generateWikiFile($name)
    {
        $wikiPath = resource_path("wiki/{$name}.md");
        touch($wikiPath);
    }

}
