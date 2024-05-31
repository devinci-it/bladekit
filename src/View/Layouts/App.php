<?php

namespace Devinci\Bladekit\View\Layouts;

use Illuminate\View\Component;

class App extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('bladekit-layouts::app');
    }
}
