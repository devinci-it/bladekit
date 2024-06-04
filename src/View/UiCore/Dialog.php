<?php

namespace Devinci\Bladekit\View\UiCore;

use Illuminate\View\Component;

class Dialog extends Component
{
    public $size;
    public $maxHeight;

    public function __construct($size = 'medium', $maxHeight = '')
    {
        $this->size = $size;
        $this->maxHeight = $maxHeight;
    }

    public function render()
    {
        return view('bladekit::uicore.dialog');
    }
}
