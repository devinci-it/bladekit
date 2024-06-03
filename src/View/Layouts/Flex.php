<?php

namespace Devinci\Bladekit\View\Layouts;

use Illuminate\View\Component;

class Flex extends Component
{
    public $containerClass;
    public $wrap;
    public $gridTemplate;
    public $columns;
    public $maxCol;
    public $maxRow;
    public $gap;
    public $columnClass;

    /**
     * Create a new component instance.
     *
     * @param string $containerClass
     * @param string $wrap
     * @param string $gridTemplate
     * @param int $columns
     * @param int|null $maxCol
     * @param int|null $maxRow
     * @param string|null $gap
     * @param string|null $columnClass
     */
    public function __construct(
        $containerClass = '',
        $wrap = 'wrap',
        $gridTemplate = '',
        $columns = 1,
        $maxCol = null,
        $maxRow = null,
        $gap = null,
        $columnClass = ''
    ) {
        $this->containerClass = $containerClass;
        $this->wrap = $wrap;
        $this->gridTemplate = $gridTemplate;
        $this->columns = $columns;
        $this->maxCol = $maxCol;
        $this->maxRow = $maxRow;
        $this->gap = $gap;
        $this->columnClass = $columnClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('bladekit-layouts::flex');
    }
}
