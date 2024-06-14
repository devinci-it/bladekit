<?php

namespace Devinci\Bladekit\Registrars;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Devinci\Bladekit\Helpers\PathHelper;



class BladekitDirectiveRegistrar
{
    public $npmJsUrl = [];
        public $npmCssUrl = [];
    /**
     * Register all the Blade directives.
     *
     * @return void
     */
    public static function register()
    {
        self::registerViteStylesDirective();
        self::registerViteScriptsDirective();
        self::registerStylesDirective();
        self::registerScriptDirective();
        self::registerIconDirective();
        self::registerBladekitAssetDirective();
        self::registerBladekitSVGDirective();

    }

    /**
     * Register the @bladekitIcon directive.
     *
     * @return void
     */


    public static function registerIconDirective()
    {
        Blade::directive('bladekitIcon', function ($expression) {
            // Check if the expression is a valid variable name
            if (preg_match('/^\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/', $expression)) {
                return "<?php echo '<img src=\"' . e(PathHelper::getIconAssetUrl($expression)) . '\" alt=\"Icon\" class=\"anchor-icon\">'; ?>";
            } else {
                return '<?php echo ""; ?>'; // Return an empty string if $expression is not a valid variable
            }
        });
            }
    /**
     * Register the @bladekitStyles directive.
     *
     * @return void
     */
    protected static function registerStylesDirective()
    {
        Blade::directive('bladekitStyles', function ($expression) {

            $resetCssPath = public_path('assets/vendor/bladekit/css/reset.css');
            $indexCssPath = public_path('assets/vendor/bladekit/css/index.css');
            $sassIndexCssPath = public_path('assets/vendor/bladekit/css/index.css');

            $links = '';

            if (File::exists($resetCssPath)) {
                $links .= '<link rel="stylesheet" href="'. asset('assets/vendor/bladekit/css/reset.css') .'">';
            }

            if (File::exists($indexCssPath)) {
                $links .= '<link rel="stylesheet" href="'. asset('assets/vendor/bladekit/css/index.css') .'">';
            }

            if (File::exists($sassIndexCssPath)) {
                $links .= '<link rel="stylesheet" href="'. asset('assets/vendor/bladekit/css/index.css') .'">';
            }

            return $links;
        });
    }

    protected static function registerViteStylesDirective()
    {
        Blade::directive('bladekitViteStyles', function ($expression) {
            $publicPath = public_path('vendor/bladekit/css/');
            $cssFiles = array_filter(scandir($publicPath), function ($cssFile) {
                return substr($cssFile, -4) === '.css';
            });

            $links = '';
            foreach ($cssFiles as $cssFile) {
                $links .= '<link rel="stylesheet" href="' . asset('vendor/bladekit/css/' . $cssFile) . '">';
            }

            // Find the font file dynamically
            $fontPath = public_path('vendor/bladekit/assets/');
            $fontFiles = array_filter(scandir($fontPath), function ($fontFile) {
                return preg_match('/HubotSans.*\.woff2$/', $fontFile);
            });

            $fontFile = reset($fontFiles);
            $fontUrl = asset('vendor/bladekit/assets/' . $fontFile);

            // Append the font-face definition to the links
            $links .= "<style>
            @font-face {
                font-family: 'HubotSans';
                src: url('{$fontUrl}') format('woff2');
                font-weight: normal;
                font-style: normal;
            }
        </style>";

            return $links;
        });
    }
    protected static function registerViteScriptsDirective()
    {
        Blade::directive('bladekitViteScripts', function ($expression) {
            $publicPath = public_path('vendor/bladekit/js/');
            $jsFiles = array_filter(scandir($publicPath), function ($jsFile) {
                return substr($jsFile, -3) === '.js';
            });

            $scripts = '';
            foreach ($jsFiles as $jsFile) {
                $scripts .= '<script src="' . asset('vendor/bladekit/js/' . $jsFile) . '"></script>';
            }

            return $scripts;
        });
    }

    /**
     * Register the @bladekitScript directive.
     *
     * @return void
     */
    protected static function registerScriptDirective()
    {
        Blade::directive('bladekitScripts', function ($expression) {
            $scriptTags = '';

            // Script for bladekit.js
            $bladekitPath = public_path('assets/vendor/bladekit/js/bladekit.js');
            $bladekitAssetPath = asset(str_replace(public_path(), '', $bladekitPath));
            $scriptTags .= '<script src="' . $bladekitAssetPath . '"></script>';

            // External CDN links (if any)
            $externalScripts = json_decode($expression, true);

            if (is_array($externalScripts)) {
                foreach ($externalScripts as $script) {
                    $scriptTags .= '<script src="' . htmlspecialchars($script, ENT_QUOTES, 'UTF-8') . '"></script>';
                }
            }

            return $scriptTags;
        });
    }

    protected static function registerBladekitAssetDirective()
    {
        Blade::directive('bladekitAsset', function ($expression) {
            // Removing quotes around the expression if they exist
            $expression = trim($expression, "'\"");

            $imagePath = self::getBladekitAsset($expression);

            return $imagePath ? "<img src=\"$imagePath\" alt=\"$expression\">" : '';
        });
    }
    public static function getBladekitAsset($name)
    {
        $directory = public_path('vendor/bladekit/images');
        $files = File::files($directory);

        foreach ($files as $file) {
            if (strpos($file->getFilename(), $name) === 0) {
                return asset('vendor/bladekit/images/' . $file->getFilename());
            }
        }

        return null;
    }
    protected static function registerBladekitSVGDirective()
    {
        Blade::directive('bladekitSVG', function ($expression) {
            $params = self::parseExpression($expression);
            $name = $params[0];
            $size = $params[1] ?? null;
            $fill = $params[2] ?? null;

            $imagePath = self::getBladekitAsset($name);
            if ($imagePath) {
                $assetPath = asset(public_path('vendor/bladekit/icons/' . basename($imagePath)));
                $svgContent = file_get_contents($assetPath);

                if ($size) {
                    $svgContent = preg_replace('/(width|height)="[^"]*"/', '', $svgContent);
                    $svgContent = preg_replace('/<svg/', '<svg width="' . $size . '" height="' . $size . '"', $svgContent);
                }

                if ($fill) {
                    $svgContent = preg_replace('/fill="[^"]*"/', '', $svgContent);
                    $svgContent = preg_replace('/<svg/', '<svg fill="' . $fill . '"', $svgContent);
                }

                return $svgContent;
            }

            return '';
        });
    }

    protected static function parseExpression($expression)
    {
        return explode(',', str_replace(['(', ')', ' ', '\''], '', $expression));
    }
    
}
