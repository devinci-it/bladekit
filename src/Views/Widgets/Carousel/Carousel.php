<?php
// app/View/Components/Carousel.php
namespace Devinci\Bladekit\Views\Widgets\Carousel;

use Illuminate\View\Component;

class Carousel extends Component
{
    public $items;
    public $orientation;

    public function __construct($items, $orientation = 'horizontal')
    {
        $this->items = $items;
        $this->orientation = $orientation;
    }

    public function render()
    {
        return view('bladekit::widgets.carousel.index');
    }
}
