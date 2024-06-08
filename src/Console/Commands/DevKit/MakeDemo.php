<?php

namespace Devinci\Bladekit\Console\Commands\DevKit;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bladekit:make-demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create demo sections for Blade kit components';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $componentNamespaces = [
            'bladekit' => 'bladekit',
            'bladekit-layouts' => 'layouts',
            'bladekit-partials' => 'partials',
            'bladekit-uicore' => 'uicore',
            'bladekit-widgets' => 'widgets',
            'bladekit-modules' => 'modules',
            'bladekit-page-essentials' => 'page-essentials',
            'bladekit-page' => 'page',
        ];

        foreach ($componentNamespaces as $namespace => $folder) {
            $demoFilePath = resource_path("views/demo/{$folder}.blade.php");

            if (!File::exists($demoFilePath)) {
                File::put($demoFilePath, '');
            }

            $this->generateDemoSection($namespace, $demoFilePath);
        }

        $this->info('Demo sections have been generated successfully.');
    }

    protected function generateDemoSection($namespace, $demoFilePath)
    {
        $sectionName = $this->getSectionName($namespace);
        $sectionContent = $this->getSectionContent($namespace);

        File::append($demoFilePath, $sectionContent);

        $this->info("Demo section for {$namespace} has been added to {$demoFilePath}.");
    }

    protected function getSectionName($namespace)
    {
        return ucfirst(str_replace('bladekit-', '', $namespace));
    }

    protected function getSectionContent($namespace)
    {
        $sectionName = $this->getSectionName($namespace);

        return <<<PHP

    <section id="{$namespace}-demo" class="demo-section">
        <h2>{$sectionName} Demos</h2>

        {{-- Include demos for {$sectionName} --}}
        @include('demo.{$namespace}')
    </section>

PHP;
    }
}
