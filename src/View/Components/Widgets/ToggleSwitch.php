<?php
// src/View/Components/Widgets/ToggleSwitch.php

namespace Devinci\Bladekit\View\Components\Widgets;
use Illuminate\View\Component;

class ToggleSwitch extends Component
{
    public $label;
    public $default;
    public $name;
    public $id;
    public $classes;

    public function __construct($label = 'Toggle Switch', $default = false, $name = 'toggle', $id = null, $classes = '')
    {
        $this->label = $label;
        $this->default = $default;
        $this->name = $name;
        $this->id = $id ?? 'toggle-' . uniqid();
        $this->classes = $classes;
    }

    public function render()
    {
        return view('bladekit::components.widgets.toggle-switch');
    }
}
