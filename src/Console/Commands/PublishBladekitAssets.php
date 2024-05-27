<?php

namespace Devinci\Bladekit\Console\Commands;

use Illuminate\Console\Command;

class PublishBladekitAssets extends Command
{
    protected $signature = 'bladekit:publish-assets';

    protected $description = 'Publish Bladekit assets to public directory';

    public function handle()
    {
        $sourcePath = base_path('vendor/devinci-it/bladekit/resources/css');
        $linkPath = public_path('assets/vendor/bladekit/css');

        if (!file_exists($linkPath)) {
            // Create the symbolic link
            symlink($sourcePath, $linkPath);
            $this->info('Bladekit assets published successfully.');
        } else {
            $this->warn('Bladekit assets already exist in public directory.');
        }
    }
}
