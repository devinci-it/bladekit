<?php

namespace Devinci\Bladekit\Views\Widgets;

use Illuminate\View\Component;

class Carousel extends Component
{
    public $slides;
    public $orientation;
    public $theme;
    public $rowOrCol;
    public $size;
    public $autoScroll;

    /**
     * Create a new component instance.
     *
     * @param array $slides
     * @param string $orientation
     * @param string $theme
     * @param string $rowOrCol
     * @param string $size
     * @param bool $autoScroll
     */

    public function __construct($slides = [], $orientation = 'horizontal', $theme = 'light', $rowOrCol = 'one-row', $size = 'large', $autoScroll = false)
    {
        $this->slides = $slides;
        $this->orientation = $orientation;
        $this->theme = $theme;
        $this->rowOrCol = $rowOrCol;
        $this->size = $size;
        $this->autoScroll = $autoScroll;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('bladekit::widgets.carousel');
    }

    /**
     * Add a slide to the carousel.
     *
     * @param string $content
     * @return void
     */
    public function addSlide($content)
    {
        $this->slides[] = $content;
    }

    /**
     * Determine the size class based on the size.
     *
     * @return string
     */
    public function sizeClass()
    {
        switch ($this->size) {
            case 'large':
                return 'carousel large';
            case 'medium':
                return 'carousel medium';
            case 'small':
                return 'carousel small';
            default:
                return 'carousel large'; 
        }
    }

    /**
     * Determine the orientation class based on the orientation and rowOrCol.
     *
     * @return string
     */
    public function orientationClass()
    {
        switch ($this->orientation) {
            case 'horizontal':
                return 'horizontal ' . $this->rowOrCol;
            case 'vertical':
                return 'vertical ' . $this->rowOrCol;
            default:
                return 'horizontal one-row'; // Default to horizontal one-row if orientation is not recognized
        }
    }
}
