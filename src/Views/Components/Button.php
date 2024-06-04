<?php

namespace Devinci\Bladekit\Views\Components;

use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function render()
    {
        return $this->view("bladekit::uicore.button");
    }
}
