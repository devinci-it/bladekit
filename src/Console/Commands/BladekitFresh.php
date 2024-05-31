<?php

namespace Devinci\Bladekit\Console\Commands;

use Illuminate\Console\Command;
use Devinci\Bladekit\Services\BladekitAssetRegistrar;

/**
 * Command to remove published Bladekit assets.
 *
 * This command removes published Bladekit assets from the public directory.
 * It provides an option to remove assets by tag, allowing selective removal.
 * After successful removal, it provides instructions to republish the assets.
 *
 * Quick Reference:
 *   - {tag?} : Optional argument specifying the tag of assets to remove.
 *              If provided, only assets with the specified tag will be removed.
 *              If not provided, all assets will be removed.
 */
class BladekitFresh extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bladekit:fresh {tag?}';

    /**
     * The description of the console command.
     *
     * @var string
     */
    protected $description = 'Remove published Bladekit assets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tag = $this->argument('tag');

        if ($tag) {
            BladekitAssetRegistrar::removeAsset($tag);
            $this->info("\n<fg=white;bg=blue> INFO </> <fg=blue>Assets with tag '$tag' have been removed successfully.</>");
            $this->line("<fg=white>To republish the assets, run 'php artisan vendor:publish --tag=$tag'</>");

        } else {
            $assets = BladekitAssetRegistrar::getAssets();
            foreach ($assets as $tag => $paths) {
                BladekitAssetRegistrar::removeAsset($tag);
                $this->info("\n       <bg=bright-blue;fg=bright-white> INFO </> <fg=bright-white>Assets with tag '$tag' have been removed successfully.</>");
                $this->line("        <fg=white>To republish the assets, run 'php artisan vendor:publish --tag=$tag'</>\n");

            }
        }
    }

}
