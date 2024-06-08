<?php

// app/View/Components/CarouselItem.php
namespace Devinci\Bladekit\Views\Widgets\Carousel;

use Illuminate\View\Component;

class CarouselItem extends Component
{
    public $image;

    public function __construct($image)
    {
        $this->image = $image;
    }

    public function render()
    {
        return view('bladekit::widgets.carousel.carousel-item');
    }
}
