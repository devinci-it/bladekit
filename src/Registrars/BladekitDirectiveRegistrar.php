<?php

namespace Devinci\Bladekit\Registrars;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;

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
        self::registerIconDirective();
        self::registerViteStylesDirective();
        self::registerViteScriptsDirective();
        self::registerStylesDirective();
        self::registerScriptDirective();
    }

    /**
     * Register the @bladekitIcon directive.
     *
     * @return void
     */
    protected static function registerIconDirective()
    {
        Blade::directive('bladekitIcon', function ($expression) {
            $publicPath = public_path('vendor/bladekit/images/');
            $iconPath = trim($expression, '\'"');

            // Check if the icon file exists
            if (file_exists($publicPath . $iconPath)) {
                return "<?php echo asset('vendor/bladekit/images/' . $iconPath); ?>";
            } else {
                // Optionally, you can log an error message if the icon file is not found
                // error_log("Icon not found: $iconPath");

                // Return a default icon or an empty string as fallback
                return "";
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

}
