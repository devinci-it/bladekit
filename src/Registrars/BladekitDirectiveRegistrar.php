<?php

namespace Devinci\Bladekit\Registrars;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;

class BladekitDirectiveRegistrar
{
    public $npmJsUrl = [
        "prismjs"=>"https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js",
        "prismjs-line-numbers"=>"https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js"
    ];
        public $npmCssUrl = [
            "prismjs"=>"https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css"
        ];
    /**
     * Register all the Blade directives.
     *
     * @return void
     */
    public static function register()
    {
        self::registerIconDirective();
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
            return "<?php echo asset('assets/vendor/bladekit/icons/' . trim($expression, '\"')); ?>";
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
