<?php

namespace Devinci\Bladekit\Views\Widgets;

use Illuminate\View\Component;

class AccordionSlide extends Component
{
    public $id;
    public $icon;
    public $minHeight;
    public $header;

    public function __construct($id, $header = '', $icon = '', $minHeight = '300px')
    {
        $this->id = $id;
        $this->icon = $icon;
        $this->minHeight = $minHeight;
        $this->header = $header;
    }
    public function render()
    {
        return view('bladekit::widgets.accordion-slide', [
            'id' => $this->id,
            'header' => $this->header,
            'icon' => $this->icon,
            'minHeight' => $this->minHeight,
        ]);    }
}
