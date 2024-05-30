<?php

namespace Devinci\Bladekit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ScssPhp\ScssPhp\Compiler;

class CompileBladekitSass extends Command
{
    protected $signature = 'bladekit:compile-sass {--fresh : Force recompile and republish all SASS assets}';

    protected $description = 'Compile Bladekit SASS assets and prepare for publishing.';

    private $sassPath;
    private $buildPath;
    private $jsonFilePath;

    public function __construct()
    {
        parent::__construct();

        // Set paths
        $this->sassPath = __DIR__ . '/../../../resources/scss';
        $this->buildPath = __DIR__ . '/../../../build';
        $this->jsonFilePath = __DIR__ . '/../../../build/assets.json';
    }

    public function handle()
    {
        $this->ensureBuildDirectoryExists();

        $this->info('Compiling SASS assets...');

        $sassFiles = $this->getSassFiles();

        $this->compileAndPublish($sassFiles);

        $this->info('SASS assets compiled successfully!');

        // Create a single JSON file for all compiled assets
        $this->createAssetsJson();
    }

    private function getSassFiles()
    {
        return File::glob("$this->sassPath/*.scss");
    }

    private function ensureBuildDirectoryExists()
    {
        if (!File::isDirectory($this->buildPath)) {
            File::makeDirectory($this->buildPath, 0755, true);
        }
    }

    private function shouldCompileSass($sassFile, $outputFile)
    {
        // Compile SASS only if the output file doesn't exist or the SASS file is newer
        return !File::exists($outputFile) || File::lastModified($sassFile) > File::lastModified($outputFile);
    }

    private function compileSass($inputFile, $outputFile)
    {
        $sassContent = file_get_contents($inputFile);

        // Initialize scssphp compiler
        $compiler = new Compiler();

        // Set import paths if your SASS files have imports
        $compiler->setImportPaths(dirname($inputFile));

        // Compile SASS to CSS
        $cssContent = $compiler->compile($sassContent);

        file_put_contents($outputFile, $cssContent);
    }

    private function createJson($fileName, $outputFile)
    {
        $json = [
            'filename' => $fileName,
            'hash' => md5_file($outputFile),
            'path' => $outputFile,
        ];

        return $json;
    }

    private function compileAndPublish($sassFiles)
    {
        $assets = [];

        foreach ($sassFiles as $sassFile) {
            $fileName = pathinfo($sassFile, PATHINFO_FILENAME);
            $outputFile = "$this->buildPath/scss/$fileName.css";

            if ($this->option('fresh') || $this->shouldCompileSass($sassFile, $outputFile)) {
                $this->compileSass($sassFile, $outputFile);
            }

            $assets[] = $this->createJson($fileName, $outputFile);
        }

        return $assets;
    }

    private function createAssetsJson()
    {
        $sassFiles = $this->getSassFiles();
        $assets = $this->compileAndPublish($sassFiles);

        $json = json_encode($assets, JSON_PRETTY_PRINT);

        file_put_contents($this->jsonFilePath, $json);
    }
}
