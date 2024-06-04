<?php

namespace Devinci\Bladekit\Console\Commands;

use Illuminate\Console\Command;
use Devinci\Bladekit\Console\Console;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\directoryExists;

class BundleAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bladekit:bundle-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $errors=[];
    protected $con;
    /**
     * Execute the console command.
     */
    public function handle(){
        $this->con= new Console();

        // Get the current working directory and assign to variable
        $curDir = shell_exec('pwd');
        $isRootDir=is_dir(trim($curDir) . "/vendor/devinci-it/bladekit");

        // Check if the current directory is the root directory of the package
        if ($isRootDir){
            // Change directory to the package root
            chdir(trim($curDir) . "/vendor/devinci-it/bladekit");

            // Run npm run build and discard the output
            $output = exec('npm run build > /dev/null',$output,$return_var);

            // Check if the command was successful
            if ($return_var == 0){
                $bundleLocation = trim($curDir) . "/vendor/devinci-it/bladekit/dist";
                $this->con->displayMessage('BLADEKIT: Assets Bundled Successfully at ' . $bundleLocation,'success');
                $this->con->displayMessageWithBorder('php artisan vendor:publish --tag=public --force'
                    ,'To make the bundled assets available, run the following command:');
            }else{
                $this->con->displayMessage('Error Bundling Assets, Please check the package root directory','error');
            }
        }
    }


}
