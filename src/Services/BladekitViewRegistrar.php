<?php

namespace Devinci\Bladekit\Services;


use Devinci\Bladekit\View\Components\Stack\AnchorRow;
use Devinci\Bladekit\View\Components\Stack\ToggleSwitch;

use Devinci\Bladekit\View\Layouts\App;
use Devinci\Bladekit\View\Layouts\Grid;
use Devinci\Bladekit\View\Layouts\Flex;
use Devinci\Bladekit\View\Layouts\Interstitial;

use Devinci\Bladekit\View\Partials\Footer;
use Devinci\Bladekit\View\Partials\Header;
use Devinci\Bladekit\View\Partials\Navbar;

use Devinci\Bladekit\View\UiCore\Dialog;
use Devinci\Bladekit\View\UiCore\Modal;
use Devinci\Bladekit\View\UiCore\InlineCode;


use Devinci\Bladekit\View\Widgets\PageHeader;
use Devinci\Bladekit\View\Widgets\CodeSnippet;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

class BladekitViewRegistrar
{
    protected $config;

    /**
     * Create a new instance of BladekitViewRegistrar.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Register all Blade components and write registration details to YAML file.
     *
     * @return void
     */
    public function register()
    {

        View::addNamespace('bladekit-widgets', base_path(__DIR__.'/../../resources/views/widgets'));
        View::addNamespace('bladekit-layouts', base_path(__DIR__.'/../../resources/views/layouts'));
        View::addNamespace('bladekit-uicore', base_path(__DIR__ . '/../../resources/views/uicore/'));
        View::addNamespace('bladekit-partials', base_path(__DIR__ . '/../../resources/views/partials/'));


        Blade::component('bladekit-uicore::modal',Modal::class);
        Blade::component('bladekit-uicore::dialog' ,Dialog::class);
        Blade::component('bladekit-uicore::inline-code' ,InlineCode::class);

        Blade::component('bladekit-widgets::page-header', PageHeader::class);
        Blade::component('bladekit-widgets::code-snippet', CodeSnippet::class);

        Blade::component('bladekit-partials::header', Header::class);
        Blade::component('bladekit-partials::footer', Footer::class);
        Blade::component('bladekit-partials::navbar', Navbar::class);



        Blade::component('bladekit-layouts::app', App::class);
        Blade::component('bladekit-layouts::grid', Grid::class);
        Blade::component('bladekit-layouts::flex',Flex::class);


        Blade::component('bladekit::stack.toggle-switch', ToggleSwitch::class);
        Blade::component('bladekit::stack.toggle-switch', ToggleSwitch::class);
        Blade::component('bladekit::stack.toggle-switch', ToggleSwitch::class);
        Blade::component('bladekit::stack.anchor-row',  AnchorRow::class);

        Blade::anonymousComponentNamespace(__DIR__."/../../resources/views/layouts");
        Blade::anonymousComponentNamespace(__DIR__."/../../resources/views/partials");
        Blade::anonymousComponentNamespace(__DIR__."/../../resources/views/uicore");
        Blade::anonymousComponentNamespace(__DIR__." /../../resources/view/widgets");

        $this->registerViews();
//        $this->registerComponentNamespaces();
    }

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerViews()
    {
        $this->validateViewPathsConfig();
        $this->checkForExistingNamespace();
        $this->addViewPaths();
    }

    protected function validateViewPathsConfig()
    {
        if (!isset($this->config['view_paths']) || !is_array($this->config['view_paths'])) {
            throw new \RuntimeException('View paths configuration is missing or invalid.');
        }
    }

    protected function checkForExistingNamespace()
    {
        if (View::exists('bladekit')) {
            throw new \RuntimeException('The bladekit namespace is already registered.');
        }
    }

    protected function addViewPaths()
    {
        foreach ($this->config['view_paths'] as $path) {
            $this->addViewPath($path);
        }
    }

    protected function addViewPath($path)
    {
        if (!is_dir($path)) {
            throw new \RuntimeException("Invalid view path: {$path}");
        }

        View::addNamespace('bladekit', $path);
    }

    /**
     * Register additional component namespaces.
     *
     * @return void
     */
    protected function registerComponentNamespaces()
    {
        $namespaces = $this->config['component_namespaces'] ?? [];
        foreach ($namespaces as $prefix => $namespace) {
            Blade::componentNamespace($namespace, $prefix);
        }
    }
}
