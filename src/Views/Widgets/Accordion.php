<?php

namespace Devinci\Bladekit\Views\Widgets;

use Illuminate\View\Component;

use Illuminate\Support\Str;
 
class Accordion extends Component
{
    public $id;

    public function __construct($id = null)
    {
        $this->id = $id ?: 'accordion-' . Str::random(8);
    }

    public function render()
    {
    return view ('bladekit::widgets.accordion');
       }
}