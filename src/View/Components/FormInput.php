<?php

namespace Devinci\Bladekit\View\Components;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $type;
    public $name;
    public $label;
    public $value;
    public $placeholder;
    public $options;
    public $icon;
    public $round;

    public function __construct($type, $name, $label, $value = '', $placeholder = '', $options = [], $icon = '', $round = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->options = $options;
        $this->icon = $icon;
        $this->round = $round;
    }

    public function render()
    {
        return view('components.form-input');
    }
}
