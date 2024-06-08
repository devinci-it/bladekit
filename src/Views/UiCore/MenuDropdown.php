<?php

namespace Devinci\Bladekit\Views\UiCore;

use Illuminate\View\Component;

class MenuDropdown extends Component
{
    /**
     * The menu items for the dropdown.
     *
     * @var array
     */
    public $menuItems;

    /**
     * Create a new component instance.
     *
     * @param array $menuItems
     * @return void
     */
    public function __construct($menuItems)
    {
        $this->menuItems = $menuItems;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('bladekit::uicore.menu-dropdown');

    }
}
