<?php

namespace Devinci\Bladekit\Registrars;

use Devinci\Bladekit\Views\FormUnits\FileUpload;
use Devinci\Bladekit\Views\Components\Stack\AnchorRow;
use Devinci\Bladekit\Views\Components\Stack\ToggleSwitch;

use Devinci\Bladekit\Views\Layouts\BladeLayout;
use Devinci\Bladekit\Views\Layouts\Grid;
use Devinci\Bladekit\Views\Layouts\Flex;
use Devinci\Bladekit\Views\Layouts\Interstitial;

use Devinci\Bladekit\Views\Partials\Footer;
use Devinci\Bladekit\Views\Partials\Header;
use Devinci\Bladekit\Views\Partials\Navbar;

use Devinci\Bladekit\Views\UiCore\Button;
use Devinci\Bladekit\Views\UiCore\Dialog;
use Devinci\Bladekit\Views\UiCore\MenuDropdown;
use Devinci\Bladekit\Views\UiCore\Modal;
use Devinci\Bladekit\Views\UiCore\InlineCode;


use Devinci\Bladekit\Views\Widgets\PageHeader;
use Devinci\Bladekit\Views\Widgets\CodeSnippet;
use Devinci\Bladekit\Views\Widgets\TabPanel;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;

use Devinci\Bladekit\Views\UiControls\Checkmark;
use Devinci\Bladekit\Views\UiControls\Dropdown;
use Devinci\Bladekit\Views\UiControls\Menu;
use Devinci\Bladekit\Views\UiControls\MenuItem;
use Devinci\Bladekit\Views\UiControls\Radio;
use Devinci\Bladekit\Views\UiControls\Text;
use Devinci\Bladekit\Views\UiControls\Toggle;

use Devinci\Bladekit\Views\FormUnits\MultistepForm;
use Devinci\Bladekit\Views\FormUnits\FormGroup;
use Devinci\Bladekit\Views\FormUnits\FormInput;
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

        // *

        View::addNamespace('bladekit', __DIR__ . '/../../resources/views');
        View::addNamespace('bladekit-form', __DIR__ . '/../../resources/views/form-units');
        View::addNamespace('bladekit-widgets', base_path(__DIR__ . '/../../resources/views/widgets'));
        View::addNamespace('bladekit-layouts', base_path(__DIR__ . '/../../resources/views/layouts'));
        View::addNamespace('bladekit-uicore', base_path(__DIR__ . '/../../resources/views/uicore'));
        View::addNamespace('bladekit-partials', base_path(__DIR__ . '/../../resources/views/partials'));
        View::addNamespace('bladekit-uicontrols', base_path(__DIR__ . '/../../resources/views/uicontrols'));
        // *

        Blade::anonymousComponentNamespace(__DIR__ . "/../../resources/views/layouts");
        Blade::anonymousComponentNamespace(__DIR__ . "/../../resources/views/partials");
        Blade::anonymousComponentNamespace(__DIR__ . "/../../resources/views/uicore");
        Blade::anonymousComponentNamespace(__DIR__ . " /../../resources/views/widgets");
        Blade::anonymousComponentNamespace(__DIR__ . " /../../resources/views/uicontrols");
        Blade::anonymousComponentNamespace(__DIR__ . " /../../resources/views/form-units");
        // *

        Blade::component('bladekit-uicore::modal', Modal::class);
        Blade::component('bladekit-uicore::button', Button::class);
        Blade::component('bladekit-uicore::dialog', Dialog::class);
        Blade::component('bladekit-uicore::inline-code', InlineCode::class);
        Blade::component('bladekit-uicore::menu-dropdown', MenuDropdown::class);

        Blade::component('bladekit-widgets::page-header', PageHeader::class);
        Blade::component('bladekit-widgets::code-snippet', CodeSnippet::class);
        Blade::component('bladekit-widgets::tab-panel', TabPanel::class);

        Blade::component('bladekit-partials::header', Header::class);
        Blade::component('bladekit-partials::footer', Footer::class);
        Blade::component('bladekit-partials::navbar', Navbar::class);

        Blade::component('bladekit-layouts::interstitial', Interstitial::class);
        Blade::component('bladekit-layouts:blade-layout', BladeLayout::class);
        Blade::component('bladekit-layouts::grid', Grid::class);
        Blade::component('bladekit-layouts::flex', Flex::class);

        Blade::component('bladekit::stack.toggle-switch', ToggleSwitch::class);
        Blade::component('bladekit::stack.toggle-switch', ToggleSwitch::class);
        Blade::component('bladekit::stack.toggle-switch', ToggleSwitch::class);
        Blade::component('bladekit::stack.anchor-row',  AnchorRow::class);

        Blade::component('bladekit-uicontrols::menu', Menu::class);
        Blade::component('bladekit-uicontrols::menu-item',  MenuItem::class);
        Blade::component('bladekit-uicontrols::toggle',  Toggle::class);
        Blade::component('bladekit-uicontrols::dropdown',  Dropdown::class);
        Blade::component('bladekit-uicontrols::text',  Text::class);
        Blade::component('bladekit-uicontrols::radio',  Radio::class);
        Blade::component('bladekit-uicontrols::checkmark',  Checkmark::class);

        Blade::component('bladekit-form::file-upload', FileUpload::class);
        Blade::component('bladekit-form::form-input', FormInput::class);
        Blade::component('bladekit-form::form-group', FormGroup::class);
        Blade::component('bladekit-form::multistep-form', MultistepForm::class);    
    
        // *

        #$this->registerViews();
        $this->registerComponentNamespaces();
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
            throw new \RuntimeException('Views paths configuration is missing or invalid.');
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

