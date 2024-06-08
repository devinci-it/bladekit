<?php

namespace Devinci\Bladekit\Views\Widgets\Carousel;

use Illuminate\View\Component;

class CarouselWrapper extends Component
{
    public $style;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($style = '')
    {
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('bladekit::widgets.carousel.carousel-wrapper');
    }
}
