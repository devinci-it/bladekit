<?php

namespace Devinci\Bladekit\View\Layouts;

use Illuminate\View\Component;

class Grid extends Component
{
    public $name;
    public $gridTemplate;
    public $columns;
    public $gap;
    public $containerClass;
    public $columnClass;

    /**
     * Create a new component instance.
     *
     * @param string $name The base name used to generate dynamic class names for the container and columns.
     * @param string|null $gridTemplate A custom grid-template-columns value.
     * @param int $columns The number of equal-sized columns to render if gridTemplate is not provided.
     * @param string $gap The gap between columns.
     * @param string|null $containerClass Additional classes for the grid container.
     * @param string|null $columnClass Additional classes for each grid column.
     *
     * @return void
     */
    public function __construct($name, $gridTemplate = null, $columns = 3, $gap = '20px', $containerClass = null, $columnClass = null)
    {
        $this->name = $name;
        $this->gridTemplate = $gridTemplate;
        $this->columns = $columns;
        $this->gap = $gap;
        $this->containerClass = $containerClass ?? "{$name}-grid-container";
        $this->columnClass = $columnClass ?? "{$name}-grid-item";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('bladekit::layouts.grid');
    }
}
