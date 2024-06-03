<?php
namespace Devinci\Bladekit\View\Layouts;

use Illuminate\View\Component;

class Flex extends Component
{
    public $containerClass;
    public $direction;
    public $scroll;

    /**
     * Create a new component instance.
     *
     * @param string $containerClass
     * @param string $direction
     * @param string $scroll
     */
    public function __construct(
        $containerClass = '',
        $direction = 'horizontal',
        $scroll = 'auto'
    ) {
        $this->containerClass = $containerClass;
        $this->direction = $direction;
        $this->scroll = $scroll;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('bladekit::layouts.flex');
    }
}