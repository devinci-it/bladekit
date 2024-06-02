<?php

namespace Devinci\Bladekit\Console\Commands\DevKit;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Blade;

class ListComponents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bladekit:list-components';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all registered Blade components';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $components = Blade::getClassComponentAliases();

        foreach ($components as $alias => $class) {
            $this->line("{$alias} => {$class}");
        }

        return 0;
    }
}