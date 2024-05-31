<?php

namespace Devinci\Bladekit\View\Layouts;

use Illuminate\Console\View\Components\Component;
use Illuminate\Contracts\View\View;
use Closure;

class Flex extends Component
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
    public function render(): View|Closure|string
    {
        return view('bladekit::layout.flex');
    }
}
