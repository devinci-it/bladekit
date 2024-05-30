<?php

namespace Devinci\Bladekit\Console\Commands\DevKit;

use Illuminate\Console\Command;

class PlaceHolderCommand extends Command
{
    protected $signature = 'bladekit:place-holder {position} {--optional=}';
    protected $description = 'This is a placeholder command for the DevKit namespace.';

    public function handle($man = false)
    {
        if ($man) {
            $this->info('This is a placeholder command for the DevKit namespace. Replace with your own functionality.');
            return [$this->signature, $this->description];
        } else {

        $this->info('This is a placeholder command. Replace with your own functionality.');

    }


    }
}