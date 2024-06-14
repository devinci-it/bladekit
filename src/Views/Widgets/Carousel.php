<?php

namespace Devinci\Bladekit\Views\Widgets;
use Illuminate\View\Component;

class Carousel extends Component
{
    public $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function render()
    {
        return view('bladekit::widgets.carousel')
    }
}