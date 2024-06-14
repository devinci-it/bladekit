<?php

namespace Devinci\Bladekit\Console\Commands\DevKit;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RegisterView extends Command
{
    protected $signature = 'bladekit:register-view 
                            {--namespace= : The namespace to register}
                            {--anon= : The namespace for anonymous component}
                            {--component= : The namespace and class for component}';

    protected $description = 'Registers BladeKit view namespaces and components';

    public function handle()
    {
        $filePath = __DIR__.'/../../../Registrars/BladekitViewRegistrar.php'; // Adjust the path accordingly
         if (!File::exists($filePath)) {
            $this->error('BladekitViewRegistrar.php not found.');
            return;
        }
        $contents = File::get($filePath);

        $namespace = $this->option('namespace');
        $anonNamespace = $this->option('anon');
        $component = $this->option('component');
     // Split the contents into sections based on the delimiters
     $sections = explode('// *', $contents);

     // Append the lines of code to the respective sections
     $sections[1] .= $this->getNamespaceCode($namespace);
     $sections[2] .= $this->getAnonymousNamespaceCode($anonNamespace);
     $sections[3] .= $this->getComponentCode($component);

     // Put the sections back together
     $newContent = implode('// *', $sections);

     // Write the modified content back to the file
     File::put($filePath, $newContent);

     $this->info('BladeKit view namespaces and components registered successfully.');
 }

 protected function getNamespaceCode($namespace)
 {
     if (!$namespace) {
         return '';
     }

     $normalizedNamespace = str_replace([' ', '-'], '', strtolower($namespace));
     return "
    View::addNamespace('bladekit-{$normalizedNamespace}', base_path(__DIR__ . '/../../resources/views/{$normalizedNamespace}'));
";
 }

 protected function getAnonymousNamespaceCode($anonNamespace)
 {
     if (!$anonNamespace) {
         return '';
     }

     $normalizedNamespace = str_replace([' ', '-'], '', strtolower($anonNamespace));
     return "
    Blade::anonymousComponentNamespace(__DIR__ . '/../../resources/views/{$normalizedNamespace}');
";
 }

 protected function getComponentCode($component)
 {
     if (!$component) {
         return '';
     }

     [$namespace, $class] = explode(' ', $component);
     $normalizedNamespace = str_replace([' ', '-'], '', strtolower($namespace));
     $normalizedClass = str_replace(' ', '-', strtolower($class));

     return "
    Blade::component('bladekit-{$normalizedNamespace}::{$normalizedClass}', \\Devinci\\Bladekit\\Views\\{$class}::class);
";
 }
}