<?php

namespace Devinci\Bladekit\Services;

use Illuminate\Support\Facades\Blade;

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
        self::registerStyleDirective();
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
     * Register the @bladekitStyle directive.
     *
     * @return void
     */
    protected static function registerStyleDirective()
    {
        Blade::directive('bladekitStyle', function ($expression) {
            return "<?php echo asset('assets/vendor/bladekit/css/' . trim($expression, '\"')); ?>";
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
