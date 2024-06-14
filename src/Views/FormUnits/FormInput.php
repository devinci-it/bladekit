<?php
// app/View/Components/FormInput.php

namespace Devinci\Bladekit\Views\FormUnits;

use Illuminate\View\Component;

class FormInput extends Component
{
    public $label;
    public $name;
    public $type;
    public $value;
    public $placeholder;
    public $required;
    public $hideLabel;
    public $options;

    /**
     * Create a new component instance.
     *
     * @param string $label
     * @param string $name
     * @param string $type
     * @param mixed $value
     * @param string $placeholder
     * @param bool $required
     * @param bool $hideLabel
     * @param array $options
     * @return void
     */
    public function __construct($label, $name, $type = 'text', $value = '', $placeholder = '', $required = false, $hideLabel = false, $options = [])
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->hideLabel = $hideLabel;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-input');
    }
}
