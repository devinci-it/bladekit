<?php

namespace Devinci\Bladekit\Views\Components\Mods;

use Illuminate\View\Component;

class AccordionList extends Component
{
    public array $groups;

    /**
     * Create a new component instance.
     *
     * @param array $groups
     * @return void
     */
    public function __construct(array $groups)
    {
        $this->groups = $groups;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.bladekit.mods.accordion-list');
    }
}
