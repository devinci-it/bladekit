<?php

namespace Devinci\Bladekit\Services;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;

class BladekitDirectiveRegistrar
{
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
            $sassIndexCssPath = public_path('assets/vendor/bladekit/css/sass-index.css');

            $links = '';

            if (File::exists($resetCssPath)) {
                $links .= '<link rel="stylesheet" href="'. asset('assets/vendor/bladekit/css/reset.css') .'">';
            }

            if (File::exists($indexCssPath)) {
                $links .= '<link rel="stylesheet" href="'. asset('assets/vendor/bladekit/css/index.css') .'">';
            }

            if (File::exists($sassIndexCssPath)) {
                $links .= '<link rel="stylesheet" href="'. asset('assets/vendor/bladekit/css/sass-index.css') .'">';
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
        Blade::directive('bladekitScript', function ($expression) {
            return "<?php echo asset('assets/vendor/bladekit/js/' . trim($expression, '\"')); ?>";
        });
    }
}
