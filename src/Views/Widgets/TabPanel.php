<?php

namespace Devinci\Bladekit\Views\Widgets;

use Illuminate\View\Component;

class TabPanel extends Component
{
    public $tabs;  

    public function __construct($tabs)
    {
        $this->tabs = $tabs;
    }

    public function render()
    {
        return view('bladekit::widgets.tab-panel');
    }
}
