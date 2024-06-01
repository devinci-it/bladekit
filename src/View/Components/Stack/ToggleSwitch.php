<?php
// src/View/Components/Widgets/ToggleSwitch.php

namespace Devinci\Bladekit\View\Components\Stack;
use Illuminate\View\Component;

class ToggleSwitch extends Component
{
    public $label;
    public $default;
    public $name;
    public $id;
    public $classes;
    public $icon;
    public $subtext;

    public function __construct($label = 'Toggle Switch', $default = false, $name = 'toggle', $id = null, $classes = '',$icon=null,$subtext='')
    {
        $this->label = $label;
        $this->default = $default;
        $this->subtext= $subtext??'';
        $this->name = $name;
        $this->id = $id ?? 'toggle-' . uniqid();
        $this->classes = $classes;
        $this->icon = $icon??'';
    }

    public function render()
    {
        return view('bladekit::components.stack.toggle-switch');
    }

}
