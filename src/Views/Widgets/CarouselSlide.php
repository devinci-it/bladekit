<?php

namespace Devinci\Bladekit\Views\Widgets;

use Illuminate\View\Component;

class CarouselSlide extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('bladekit::widgets.carousel-slide');
    }
}
