<?php

namespace Devinci\Bladekit\Views\UiCore;

use Illuminate\View\Component;

class Divider extends Component{
    public $thickness;
    public $spacing;
    public $orientation;
    public $length;

    public function __construct($thickness = '2px', $spacing = '10px', $orientation = 'horizontal', $length = '100px')
    {
        $this->thickness = $thickness;
        $this->spacing = $spacing;
        $this->orientation = $orientation;
        $this->length = $length;
    }

    public function render()
    {
        return view('bladekit::uicore.divider');
    }
}